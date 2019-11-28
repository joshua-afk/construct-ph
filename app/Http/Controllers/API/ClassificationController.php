<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClassificationController extends Controller
{
    public function __invoke(){
    	$classifications = $this->classifications();
    	return json_encode($classifications);
    }
}
