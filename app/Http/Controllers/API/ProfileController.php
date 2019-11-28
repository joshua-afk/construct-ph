<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\User;
use App\ResumeTraining;

class ProfileController extends Controller
{
    public function show($username)
    {
        $user                 = User::where('username', $username)->first();
        $account_experiences  = $user->experiences;
        $account_educations   = $user->educations;
        $account_affiliations = $user->affiliations;
        $account_licensures   = $user->licensures;
        $resume_trainings     = ResumeTraining::where('user_id', $user->id)->get();

        return compact('account_educations', 'account_experiences', 'resume_trainings', 'account_licensures', 'account_affiliations');
    }
}
