<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\UserClick;
use App\Classification;

class ProfessionalController extends Controller
{
    public function index()
    {
    	
    	// $search          = [];
    	$professionals   = User::where('type', 3)
        					   ->orderBy('username')
        					   ->with(['preference', 'other_classifications'])
        					   ->get();
    	$classifications = $this->classifications();
       	$regions         = $this->regions();
       	
    	return view('professional.index', compact('professionals', 'classifications', 'regions'));
    }
}
