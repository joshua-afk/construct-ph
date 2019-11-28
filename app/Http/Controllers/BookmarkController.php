<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bookmark;

class BookmarkController extends Controller
{
    public function index(){
        $bookmarks = Bookmark::where('user_id', session('user_id'))->get();
        return view('bookmarks', compact('bookmarks'));
    }

    public function store()
    {
    	Bookmark::insert([
    		"user_id" 		=> request()->user_id,
    		"bookmark_type" => request()->bookmark_type,
    		"bookmark_id" 	=> request()->bookmark_id,
    		'created_at' 	=> now('Asia/Manila'),
    		'updated_at' 	=> now('Asia/Manila'),
    	]);

    	return redirect()->back();
    }

    public function destroy(){
    	Bookmark::where('user_id', request()->user_id)
    			->where('bookmark_type', request()->bookmark_type)
    			->where('bookmark_id', request()->bookmark_id)
    			->first()
    			->delete();
    			
    	return redirect()->back();
    }
}