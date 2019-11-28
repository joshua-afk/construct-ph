<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmailUs;

class EmailUsController extends Controller
{
	public function create(){
		return view('contact-us');
	}

	public function store(Request $request){

		$data = $request->validate([
			'full_name' 	 => 'required',
			'email' 		 => 'required|email',
			'contact_number' => 'required',
			'message' 		 => 'required',
		]);
		
		Mail::to('sales@infoasia.com')->send(new EmailUs($request));
		return back();
	}
}
