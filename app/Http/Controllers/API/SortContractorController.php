<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Company;

class SortContractorController extends Controller
{
    public function index()
    {
      $category = (request()->category !== 'N/A') ? request()->category : null;

      $paginate_contractors =
      Company::orderBy('company_name')
             ->where('type', 'contractor')
             ->where('category', $category)
             ->where('region_id', request()->location)
             ->with('region')
             ->select('id', 'code', 'company_name', 'category', 'pcab_license')
             ->paginate(12);

      return response()->json($paginate_contractors);
    }
}
