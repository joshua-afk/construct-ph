<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;

class SupplierController extends Controller
{
    public function index()
    {
    	$companies_list  = Company::orderBy('company_name')
    							  ->where('type', 'supplier')
    							  ->with('region.name')
    							  ->select('id', 'code', 'company_name', 'category', 'pcab_license')
    							  ->get();
		  $classifications = $this->classifications();
      $regions         = $this->regions();
    	return view('supplier.index', compact('companies_list', 'classifications', 'regions'));
    }
}
        