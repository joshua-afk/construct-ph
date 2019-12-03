<?php

namespace App\Http\Controllers;

use App\Company;
use App\User;

class CompanyController extends Controller
{
    public function index()
    {
        return abort(404);
    }

    public function show($company)
    {
        $company = Company::where('code', $company)->firstOrFail();
        $ratings_average = (count($company->reviews) !== 0) ?
                           (array_sum($company->reviews->pluck('rate')->toArray()) / count($company->reviews)) :
                           0 ;
        return view('company.show', compact('company', 'ratings_average'));
    }

    public function create()
    {
        $user 	 = User::select('first_name', 'last_name')
                       ->findOrFail(session('user_id'));
        $regions = $this->regions();
        $cities  = $this->cities();
        return view('company.create', compact('user', 'regions', 'cities'));
    }

    public function store()
    {
        Company::insert([
            'code'                       => $this->uuid(),
            'pcab_license'               => request()->pcab,
            'user_id'                    => session('user_id'),
            'company_name'               => request()->company_name,
            'category'                   => request()->category,
            'type'                       => request()->type,
            'authorized_managing_office' => request()->contact_first_name . ' ' . request()->contact_last_name,
            'region_id'                  => request()->region,
            'city_id'                    => request()->city,
            'zip_code'                   => request()->zip_code,
            'address_type' 	             => 'permanent',
            'mobile_number'              => request()->mobile_number,
            'email'                      => request()->email,
            'status'                     => 'active',
            'created_at'                 => now('Asia/Manila'),
            'updated_at'                 => now('Asia/Manila')
        ]);

        return redirect('/account/companies');
    }
}
