<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LocationController extends Controller
{
    public function regions()
    {
    	$regions = $this->regions();
    	return json_encode('regions');
    }

    public function cities(Region $id)
    {
    	$cities = $this->cities();
    	return json_encode('cities');
    }
}