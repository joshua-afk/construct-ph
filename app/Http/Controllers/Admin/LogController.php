<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Log;

class LogController extends Controller
{
    public function index(){
        $logs = Log::latest()->get();
    	return view('admin.logs.index', compact('logs'));
    }

    public function store(){
        // Log::insert([
        //     'user_id'     => session('user_id'),
        //     'type'        => request()->type,
        //     'description' => request()->description,
        //     'created_at'  => Carbon::now('Asia/Manila'),
        //     'updated_at'  => Carbon::now('Asia/Manila'),
        // ]);
    }
}
