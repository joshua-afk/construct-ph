<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\User;
use Carbon\Carbon;

class AdminAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$uuid = (string) Str::uuid();

        User::insert([
        	'code'     		 => $uuid,
        	'username'  	 => 'admin.admin',
        	'email' 		 => null,
        	'password' 		 => Hash::make('password'),
        	'first_name' 	 => 'Admin',
        	'last_name' 	 => 'Admin',
        	'image' 		 => null,
        	'birthdate' 	 => null,
        	'mobile' 		 => null,
        	'phone' 		 => null,
            'type'           => 1,
        	'status'		 => 'active',
        	'date_activated' => Carbon::now('Asia/Manila'),
        	'created_at'	 => Carbon::now('Asia/Manila'),
        	'updated_at' 	 => Carbon::now('Asia/Manila'),
        ]);
    }
}
