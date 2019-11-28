<?php

namespace App\Http\Controllers\Search;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Company;
use App\Classification;

class SupplierController extends Controller
{
    public function show($code){
    	$company         = Company::where('type', 'supplier')->where('code', $code)->firstOrFail();
    	$companies_list  = Company::where('type', 'supplier')
    						->orderBy('company_name')
    						->get();
    	$classifications = Classification::orderBy('name')->get();
    	return view('search.all_suppliers', compact('company', 'companies_list', 'classifications'));
    }
}
