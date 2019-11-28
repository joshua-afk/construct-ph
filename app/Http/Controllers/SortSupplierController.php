<?php

namespace App\Http\Controllers;

use App\Company;
use Illuminate\Http\Request;

class SortSupplierController extends Controller
{
    public function index()
    {
    	return redirect('/suppliers');
    }

    public function sort()
    {
        $companies_list  = Company::orderBy('company_name')
                                  ->where('type', 'supplier')
                                  ->where('category', request()->category)
                                 ->where('region_id', request()->location)
                                  ->with('region.name')
                                  ->select('id', 'code', 'company_name', 'category', 'pcab_license')
                                  ->get();
        $classifications = $this->classifications();
        $regions         = $this->regions();
        return view('supplier.index', compact('companies_list', 'classifications', 'regions'));
    }
}
