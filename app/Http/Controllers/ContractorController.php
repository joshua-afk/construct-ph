<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;

class ContractorController extends Controller
{
    public function index()
    {
    	$companies_list = Company::orderBy('company_name')
    							 ->where('type', 'contractor')
    							 ->with('region')
    							 ->select('id', 'code', 'company_name', 'category', 'pcab_license', 'region_id')
                                 ->take(10)
    							 ->get();

        $companies_names = Company::orderBy('company_name')
                                 ->where('type', 'contractor')
                                 ->select('company_name', 'code')
                                 ->get();

    	$classifications = $this->classifications();
    	$regions         = $this->regions();
		return view('contractor.index', compact('companies_list', 'regions', 'classifications', 'companies_names'));
    }
}