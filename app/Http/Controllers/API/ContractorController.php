<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Company;

class ContractorController extends Controller
{
    public function index(){
    	$contractors =
        Company::orderBy('company_name')
               ->where('type', 'contractor')
    		   ->with('country', 'region', 'province', 'city')
    		   ->get();

    	$paginate_contractors =
        Company::orderBy('company_name')
               ->where('type', 'contractor')
    		   ->with('country', 'region', 'province', 'city')
    		   ->paginate(12);
    								    
        return compact('contractors', 'paginate_contractors');
    }

    public function search($search){
        $company =
        Company::orderBy('company_name')
               ->where('type', 'contractor')
               ->where('company_name', 'like', '%' . $search . '%')
               ->with('country', 'region', 'province', 'city')
               ->get();
        return compact('company');
    }

    public function scroll()
    {
        $paginate_contractors =
        Company::orderBy('company_name')
               ->where('type', 'contractor')
               ->with('region')
               ->select('id', 'code', 'company_name', 'category', 'pcab_license', 'region_id')
               ->paginate(12);
        return response()->json($paginate_contractors);
    }
}
