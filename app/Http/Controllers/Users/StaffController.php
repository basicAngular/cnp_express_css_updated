<?php

namespace App\Http\Controllers\Users;

use App\Helpers\Thumbnail;
use App\Http\Controllers\UserController;
use App\Http\Requests\InviteRequest;
use App\Http\Requests\StaffRequest;
use App\Mail\InviteStaff;
use App\Repositories\InviteUserRepository;
use App\Repositories\UserRepository;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Efriandika\LaravelSettings\Facades\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Yajra\Datatables\Datatables;

class StaffController extends UserController
{
    private $date_format = 'd-m-Y';
    private $emailSettings;
    private $siteNameSettings;
    /**
     * @var UserRepository
     */
    private $userRepository;
    /**
     * @var InviteUserRepository
     */
    private $inviteUserRepository;

    /**
     * StaffController constructor.
     * @param UserRepository $userRepository
     * @param InviteUserRepository $inviteUserRepository
     */
    public function __construct(UserRepository $userRepository,
            InviteUserRepository $inviteUserRepository)
    {

        $this->middleware('authorized:staff.read', ['only' => ['index', 'data']]);
        $this->middleware('authorized:staff.write', ['only' => ['create', 'store', 'update', 'edit']]);
        $this->middleware('authorized:staff.delete', ['only' => ['delete']]);

        parent::__construct();
        $this->userRepository = $userRepository;
        $this->inviteUserRepository = $inviteUserRepository;
        $this->date_format = config('settings.date_format');
        $this->emailSettings = Settings::get('site_email');
        $this->siteNameSettings = Settings::get('site_name');

        view()->share('type', 'staff');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = trans('staff.staffs');
        return view('user.staff.index', compact('title'));
    }

    public function admin()
    {
        //$title = trans('admin.admin');
        $title = 'Admin';
        return view('user.admin.index', compact('title'));
    }

    public function client()
    {
        $title = 'Client';
        return view('user.client.index', compact('title'));
    }

    public function broker()
    {
        $title = 'Broker';
        return view('user.broker.index', compact('title'));
    }
    
    /*add admin*/
    public function addAdmin()
    {
        //$title = trans('staff.new');
        $title = 'Add Admin';
        return view('user.admin.create', compact('title'));
    }

    /*add broker */
    public function addBroker()
    {
        //$title = trans('staff.new');
        $title = 'Add Broker';
        return view('user.broker.create', compact('title'));
    }

    /*create client */
    public function addClient()
    {
        //$title = trans('staff.new');
        $title = 'Add Client';
        return view('user.client.create', compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = trans('staff.new');
        return view('user.staff.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StaffRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StaffRequest $request)
    {
        if ($request->hasFile('user_avatar_file')) {
            $file = $request->file('user_avatar_file');
            $file = $this->userRepository->uploadAvatar($file);
            $request->merge([
                'user_avatar' => $file->getFileInfo()->getFilename(),
            ]);
            $this->generateThumbnail($file);
        }
        $user = Sentinel::registerAndActivate($request->only('first_name', 'last_name', 'email', 'password'));
        $role = Sentinel::findRoleBySlug('staff');
        $role->users()->attach($user);
        $user = $this->userRepository->find($user->id);
        foreach ($request->get('permissions', []) as $permission) {
            $user->addPermission($permission);
        }
        $user->user_id = $this->user->id;
        $user->phone_number = $request->phone_number;
        $user->user_avatar = $request->user_avatar;
        $user->user_type = $request->user_type;
        $user->save();
        if ($request->user_type =='1') {
            return redirect("staff/admin");
        }
        elseif ($request->user_type =='2') {
            return redirect("staff/broker");
        }
        elseif ($request->user_type =='3') {
            return redirect("staff/client");
        }
        else {
            return redirect("staff");
        }
    }


    public function edit($staff)
    {
        $staff = $this->userRepository->find($staff);
        if ($staff->id == '1') {
            return redirect('staff');
        } else {
            $title = trans('staff.edit');
            return view('user.staff.edit', compact('title', 'staff'));
        }
    }


    public function update(StaffRequest $request, $staff)
    {
        $staff = $this->userRepository->find($staff);
        if ($request->password != "") {
            $staff->password = bcrypt($request->password);
        }

        if ($request->hasFile('user_avatar_file')) {
            $file = $request->file('user_avatar_file');
            $file = $this->userRepository->uploadAvatar($file);

            $request->merge([
                'user_avatar' => $file->getFileInfo()->getFilename(),
            ]);

            $this->generateThumbnail($file);

        } else {
            $request->merge([
                'user_avatar' => $staff->user_avatar,
            ]);
        }

        foreach ($staff->getPermissions() as $key => $item) {
            $staff->removePermission($key);
        }

        foreach ($request->get('permissions', []) as $permission) {
            $staff->addPermission($permission);
        }

        $staff->first_name = $request->first_name;
        $staff->last_name = $request->last_name;
        $staff->phone_number = $request->phone_number;
        $staff->email = $request->email;
        $staff->user_avatar = $request->user_avatar;
        $staff->save();

        return redirect("staff");
    }

    public function show($staff)
    {
        $staff = $this->userRepository->find($staff);
        $title = trans('staff.show_staff');
        $action = "show";
        return view('user.staff.show', compact('title', 'staff','action'));
    }

    public function delete($staff)
    {
        $staff = $this->userRepository->find($staff);
        $title = trans('staff.delete_staff');
        return view('user.staff.delete', compact('title', 'staff'));
    }


    public function destroy($staff)
    {
        $staff = $this->userRepository->find($staff);
        if ($staff->id != '1') {
            $staff->delete();
        }
        return redirect('staff');
    }

    public function data(Datatables $datatables)
    {
        $dateFormat = config('settings.date_format');
        $staffs = $this->userRepository->getAllNew()->with('staffSalesTeam')
            ->get()
            ->filter(function ($user) {
                return ($user->inRole('staff') && $user->id!=$this->user->id && $user->user_type =1);
            })->map(function ($user) use ($dateFormat){
                return [
                    'id' => $user->id,
                    'full_name' => $user->full_name,
                    'email' => $user->email,
                    'created_at' => date($dateFormat,strtotime($user->created_at)),
                    'count_uses' => $user->staffSalesTeam->count()
                ];
            });

        return $datatables->collection($staffs)
            ->addColumn('actions', '@if(Sentinel::getUser()->hasAccess([\'staff.write\']) || Sentinel::inRole(\'admin\'))
                                        <a href="{{ url(\'staff/\' . $id . \'/edit\' ) }}" title="{{ trans(\'table.edit\') }}">
                                            <i class="fa fa-fw fa-pencil text-warning"></i> </a>
                                     @endif
                                     <a href="{{ url(\'staff/\' . $id . \'/show\' ) }}" title="{{ trans(\'table.details\') }}" >
                                            <i class="fa fa-fw fa-eye text-primary"></i> </a>
                                     @if(Sentinel::getUser()->hasAccess([\'staff.delete\']) || Sentinel::inRole(\'admin\') && $count_uses==0)
                                        <a href="{{ url(\'staff/\' . $id . \'/delete\' ) }}" title="{{ trans(\'table.delete\') }}">
                                            <i class="fa fa-fw fa-trash text-danger"></i> </a>
                                      @endif')
            ->removeColumn('id')
            ->removeColumn('count_uses')
            ->rawColumns(['actions'])->make();
    }

    public function adminData(Datatables $datatables, $userType)
    {
        return $userType;

        $dateFormat = config('settings.date_format');
        $staffs = $this->userRepository->getUserByType($userType)->with('staffSalesTeam')
            ->get()
            ->filter(function ($user) {
                return ($user->inRole('staff') && $user->id!=$this->user->id && $user->user_type =1);
            })->map(function ($user) use ($dateFormat){
                return [
                    'id' => $user->id,
                    'full_name' => $user->full_name,
                    'email' => $user->email,
                    'created_at' => date($dateFormat,strtotime($user->created_at)),
                    'count_uses' => $user->staffSalesTeam->count()
                ];
            });

           return $datatables->collection($staffs)
            ->addColumn('actions', '@if(Sentinel::getUser()->hasAccess([\'staff.write\']) || Sentinel::inRole(\'admin\'))
                                        <a href="{{ url(\'staff/\' . $id . \'/edit\' ) }}" title="{{ trans(\'table.edit\') }}">
                                            <i class="fa fa-fw fa-pencil text-warning"></i> </a>
                                     @endif
                                     <a href="{{ url(\'staff/\' . $id . \'/show\' ) }}" title="{{ trans(\'table.details\') }}" >
                                            <i class="fa fa-fw fa-eye text-primary"></i> </a>
                                     @if(Sentinel::getUser()->hasAccess([\'staff.delete\']) || Sentinel::inRole(\'admin\') && $count_uses==0)
                                        <a href="{{ url(\'staff/\' . $id . \'/delete\' ) }}" title="{{ trans(\'table.delete\') }}">
                                            <i class="fa fa-fw fa-trash text-danger"></i> </a>
                                      @endif')
            ->removeColumn('id')
            ->removeColumn('count_uses')
            ->rawColumns(['actions'])->make();
    }

    /**
     * @param $file
     */
    private function generateThumbnail($file)
    {
        Thumbnail::generate_image_thumbnail(public_path() . '/uploads/avatar/' . $file->getFileInfo()->getFilename(),
            public_path() . '/uploads/avatar/' . 'thumb_' . $file->getFileInfo()->getFilename());
    }


    public function invite()
    {
        $title = trans('staff.invite_staffs');
        $date_format = config('settings.date_format');
        return view('user.staff.invite', compact('title','date_format'));
    }

    public function inviteSave(InviteRequest $request)
    {
        if (filter_var($this->emailSettings, FILTER_VALIDATE_EMAIL)) {
            $emails = array_filter(array_unique(explode(';', $request->emails)));

            foreach ($emails as $key => $email) {
                $this->inviteUserRepository->deleteWhere([
                    'claimed_at' => null,
                    'email' => $email,
                ]);
                $user_email = $this->userRepository->usersWithTrashed($email)->count();
                if (0 == $user_email) {
                    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        $invite = $this->inviteUserRepository->createInvite(['email' => trim($email)]);
                        $inviteUrl = url('invite/'.$invite->code);
                        Mail::to($email)->send(new InviteStaff([
                            'from' => $this->emailSettings,
                            'subject' => 'Invite to '.$this->siteNameSettings,
                            'inviteUrl' => $inviteUrl,
                        ]));
                    } else {
                        flash(trans('Email '.$email.' is not valid.'))->error();
                    }
                } else {
                    flash(trans('Email '.$email.' is already taken.'))->error();
                }
            }
        } else {
            flash(trans('staff.invalid-email'))->error();
        }

        return redirect('staff/invite');
    }

    public function inviteCancel($id)
    {
        $title = trans('staff.invite_cancel');

        $invite = $this->inviteUserRepository->findWhere([
            'id' => $id,
        ])->first();

        return view('user.staff.invite-cancel', compact('title', 'invite'));
    }

    public function inviteCancelConfirm($id)
    {
        $this->inviteUserRepository->deleteWhere([
            'id' => $id,
            'claimed_at' => null,
        ]);

        return redirect('staff/invite');
    }
}
