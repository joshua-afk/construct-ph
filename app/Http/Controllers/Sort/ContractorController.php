<?php

namespace App\Http\Controllers\Sort;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Classification;
use App\CompanyClassification;

class ContractorController extends Controller
{
    public function show($code){
    	$classification = Classification::where('code', $code)->first();
    	return $companies 		= CompanyClassification::where('classification_id', $classification->id)
    											->with('company')
    											// ->pluck('company')
    											->paginate(12);
    	// return view();
    }
}
