<?php

namespace App\Http\Controllers\Search;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Company;
use App\Classification;
use Mapper;

class ContractorController extends Controller
{
    public function store()
    {
        if (!session()->has('user_id')) {
            return redirect('/login')->with(['login' => 'Please login to continue.', 'redirect' => '/search/contractors/'. request()->code]);
        }

        return redirect('/search/contractors/'.request()->code);
    }

    public function show($code)
    {
        if (!session()->has('user_id')) {
            return redirect('/login')->with(['login' => 'Please login to continue.', 'redirect' => '/search/contractors/'. request()->code]);
        }

    	$contractor     = Company::where('type', 'contractor')
                                    ->where('code', $code)
                                    ->with('region')
                                    ->select('id', 'code', 'company_name', 'category', 'pcab_license', 'longtitude', 'latitude', 'region_id')
                                    ->firstOrFail();

        $companies_list = Company::orderBy('company_name')
                                 ->where('type', 'contractor')
                                 ->with('region.name')
                                 ->select('id', 'code', 'company_name', 'category', 'pcab_license')
                                 ->get();
                                    
        $classifications = $this->classifications();
        $regions         = $this->regions();
									
    	$classifications = Classification::orderBy('name')->get();

        Mapper::map($contractor->latitude, $contractor->longtitude, ['zoom' => 15]);

    	return view('search.contractors', compact('contractor', 'companies_list', 'classifications', 'regions'));
    }
}