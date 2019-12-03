<?php

namespace App\Http\Controllers;

use App\Company;
use Illuminate\Http\Request;

class SortContractorController extends Controller
{
    public function index(){
    	return redirect('/contractors');
    }

    public function store()
    {
    	$category = (request()->category !== 'N/A') ? request()->category : null;

    	return $companies_list = Company::orderBy('company_name')
    							 ->where('type', 'contractor')
    							 ->where('category', $category)
    							 // ->where('region_id', request()->location)
    							 // ->with('region')
    							 ->select('id', 'code', 'company_name', 'category', 'pcab_license')
    							 ->paginate(12);

        $companies_names = Company::orderBy('company_name')
                                 ->where('type', 'contractor')
                                 ->select('company_name', 'code')
                                 ->get();

    	$classifications = $this->classifications();
    	$regions         = $this->regions();

    	return view('contractor.index', compact('companies_list', 'companies_names', 'regions', 'classifications'));
    }
}
    