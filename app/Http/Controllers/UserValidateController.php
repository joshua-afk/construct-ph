<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserValidateController extends Controller
{
    public function __invoke($code)
    {
    	if (!request()->hasValidSignature()) {
    		abort(401);
    	}
    	return $code;
    }
}
