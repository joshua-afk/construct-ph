<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\JobInvitation;

class JobInvitationController extends Controller
{
    public function index()
    {
        $job_invitations = JobInvitation::where('entity_id', session('user_id'))->get();
    	return view('job-invitations', compact('job_invitations'));
    }
}
