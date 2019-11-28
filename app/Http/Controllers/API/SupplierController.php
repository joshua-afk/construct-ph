<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Company;

class SupplierController extends Controller
{
    public function index(){
    	$suppliers 		  = Company::where('type', 'supplier')
                                    ->orderBy('company_name')
    								->with('country', 'region', 'province', 'city')
    								->get();
    	$paginate_suppliers = Company::where('type', 'supplier')
                                    ->orderBy('company_name')
    								->with('region','city')
    								->paginate(12);
        return compact('suppliers', 'paginate_suppliers');
    }

    public function search($search){
        $supplier = Company::where('type', 'supplier')
                            ->orderBy('company_name')
                            ->where('company_name', 'like', '%' . $search . '%')
                            ->with('country', 'region', 'province', 'city')
                            ->get();
        return compact('supplier');
    }

    public function scroll(){
        $paginate_suppliers = Company::where('type', 'supplier')
                                ->orderBy('company_name')
                                ->with('region', 'city')
                                ->paginate(12);
        return response()->json($paginate_suppliers);
    }
}
