<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\JobInvitation;

class JobInvitationController extends Controller
{
    public function index()
    {
        // if (session('user_type') == 2) {
        // 	$entity_type === 1;
        // } elseif (session('user_type') == 3) {
        // 	$entity_type === 2;
        // }

        $job_invitations = JobInvitation::where('entity_id', session('user_id'))->get();
        return json_encode($job_invitations);
    }
}
