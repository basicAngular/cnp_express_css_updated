<?php

namespace App\Http\Controllers;
use Sentinel;

class SiteController extends Controller {
    protected $user;
    protected $non_read_meeages;
    protected $last_meeages;

    public function __construct() {

    }

    public function index()
    {
        $title = 'CPN Express';
        return view('site.index', compact('title'));
    }
}
