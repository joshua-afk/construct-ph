<?php

namespace App\Http\Controllers\Account;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\AccountWork;

class WorkController extends Controller
{
    public function store(Request $request){

    	$start = Carbon::parse($request->started_at);
    	$end   = Carbon::parse($request->ended_at);

    	$account_work = new AccountWork;
    	$account_work->job_title 	   = $request->job_title;
    	$account_work->started_at 	   = $start;
    	$account_work->ended_at 	   = $end;
    	$account_work->reponsibilities = $request->responsibilities;
    	$account_work->accomplishments = $request->accomplishments;
    	$account_work->skills 		   = $request->skills;
    	$account_work->save();

    	return redirect()->back();
    }

    public function update(Request $request){

    }
}
