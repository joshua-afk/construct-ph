<?php

namespace App\Http\Controllers\Account;

use App\Events\UserImageChanged;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileImageController extends Controller
{
    public function update()
    {
        if (request()->camera_image === null) {
            // Sanitize the uploaded image
            if(request()->hasFile('profile_image')){
                $file = request()->file('profile_image')->getClientOriginalName();
                $file_name = pathinfo($file, PATHINFO_FILENAME);
                $file_extension = request()->file('profile_image')->getClientOriginalExtension();
                $file_store = $file_name.'_'.time().'.'.$file_extension;
            } else {
                $file_store = 'no-image.jpg';
            }   
        } else {
            // Set name for base64 image
            $file_store = strtolower(str_random(10) .'_'. time() .'.'. 'jpg');

            // Decode base64 to jpeg
            $sanitized_camera_image = str_replace('data:image/jpeg;base64,', '', request()->camera_image);
            $base64_decoded = base64_decode(str_replace(' ', '+', $sanitized_camera_image));
        }

    	// Get user
    	$user = User::findOrFail(session('user_id'));

    	// Delete if user has image
    	if ($user->image != 'no-image.jpg') {
    		Storage::delete('public/images/profile-images/'.$user->image);
    	}

    	// Store image name in database
        $eloquent = $user->update([
            'image' => $file_store,
            'updated_at' => now('Asia/Manila'),
        ]);

        event(new UserImageChanged($user));

    	// If saved put the file in storage
    	if ($eloquent) {
            if (request()->camera_image === null) {
                if ($file_store != 'no-image.jpg') {
                    request()->file('profile_image')->storeAs('public/images/profile-images/', $file_store);
                }
            } else {
                Storage::put('public/images/profile-images/'.$file_store, $base64_decoded);
            }
    	}
    	return back();
    }
}
