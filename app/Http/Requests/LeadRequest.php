<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class LeadRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [

            'priority'=>'required',
            'company_name' => 'required',
            'product_name' => 'required',
            'email' => 'required|email',
            'client_name' => 'required',
            'title' => 'required',
            'function' => 'required',
            'country_id' => 'required',
            'state_id' => 'required',
            'city_id' => 'required',
            'phone' => 'required|regex:/^\d{5,15}?$/',
            'mobile' => 'regex:/^\d{5,15}?$/',
            'company_site'=>'required|url'


        ];
    }

    /**
     * Get the validator instance for the request.
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function getValidatorInstance()
    {
        $this->merge(['tags' => implode(',', $this->get('tags', []))]);
        return parent::getValidatorInstance();
    }

	public function messages()
	{
		return [
			'phone.regex' => 'Phone number can be only numbers',
			'mobile.regex' => 'Mobile number can be only numbers',
			'fax.regex' => 'Fax number can be only numbers',
            'country_id.required'=>'The country field is required.',
            'state_id.required'=>'The state field is required.',
            'city_id.required'=>'The city field is required.',
            'clint_name.required'=>'The agent name field is required.'
		];
	}
}
