<?php

namespace App\Http\Controllers\Setting;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Region;
use App\City;

class GeneralController extends Controller
{
    public function __invoke()
    {
        $user = User::findOrFail(session('user_id'));
        return view('settings.general', compact('user'));	
    }
}
