<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EntityOtherClassification;
use App\User;

class SortProfessionalController extends Controller
{
    public function index()
    {
    	return redirect('/professional');
    }

    public function store()
    {
        // return request()->all();
        
        // validate if one of the sorting is null

    	$classifications = $this->classifications();
        $regions = $this->regions();

        $classification_professional = 
        EntityOtherClassification::where('classification_id', request()->classification)
                                 ->where('entity_type', 1)
                                 ->select('entity_id')
                                 ->get()
                                 ->pluck('entity_id');

    	$professionals = User::whereIn('id', [$classification_professional])
                               ->where('type', 3)
                               ->where('region', request()->location)
        					   ->orderBy('username')
        					   ->with(['preference', 'other_classifications'])
        					   ->get();

        return view('professional.index', compact('classifications', 'professionals', 'regions'));
    }
}
