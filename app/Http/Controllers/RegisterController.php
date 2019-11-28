<?php

namespace App\Http\Controllers;

use App\Events\UserLoggedIn;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use App\User;
use App\Mail\UserRegistered;
use Illuminate\Support\Facades\URL;

class RegisterController extends Controller
{
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function index()
    {
        return view('authentication.register');
    }

    public function store()
    {
        $validated_attr = request()->validate([
            'username'      => 'required|min:6|unique:users',
            'type'          => 'required',
            'email'         => 'required|email|unique:users',
            'first_name'    => 'required',
            'last_name'     => 'required',
            'birthdate'     => 'required',
            'password'      => 'required|min:6',
            're-password'   => 'required|same:password',
            'mobile_number' => 'nullable|digits:11',
        ], [
            're-password.required' => 'Password confirmation is required.',
            're-password.same'     => 'Your password does not match.',
        ]);

        // Update the value of attributes
        $validated_attr['birthdate'] = Carbon::parse(request()->birthdate);
        $validated_attr['password']  = Hash::make(request()->password);

        unset($validated_attr['re-password']);

        // Register User
        $eloquent = $this->user->create($validated_attr + [
            'code'       => $this->uuid(),
            'image'      => null,
            'status'     => 'pending',
            'created_at' => now('Asia/Manila'),
            'updated_at' => now('Asia/Manila')
        ]);

        // Get the registered user data
        $user = User::where('email', request()->email)->first();

        $this->sendUserActivation($user);

        if ($eloquent) {
            if ($user->type === 4) {
                // Login User
                event(new UserLoggedIn($user, 'Login', 'User Logged In.'));
                return redirect('/companies/create');
            } else {
                session()->flash('registered', 'Account successfully created!');
                return redirect('/login');
            }
        }
        return redirect()->back()->withInput();
    }

    protected function sendUserActivation($user)
    {
        $validation_url = URL::signedRoute('user.validate', ['code' => $user->code]);
        $validation_data = [
            'validation_url' => $validation_url,
            'full_name' => $user->first_name.' '.$user->last_name,
            'email' => $user->email,
            'message' => 'Validation url',
        ];
        return Mail::to($user->email)->send(new UserRegistered($validation_data));
    }
}
