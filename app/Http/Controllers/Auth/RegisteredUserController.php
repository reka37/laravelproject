<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
           'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        //    'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'password' => ['required']
        ]);

        $remember_token =  Hash::make(rand(11111111, 99999999));
          
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'remember_token' => $remember_token,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);
  
        return response()->json([
            'success' => true,
            'remember_token' => $remember_token,
            'name' => $request->name,
        ]);
        
    }
    
    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255'],
        //    'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'password' => ['required']
        ]);

        $user = User::whereEmail($request->email)->first();
        
        if($user && Hash::check($request->password, $user->password)) {
            $remember_token =  Hash::make(rand(11111111, 99999999));
          
            $user->remember_token = $remember_token;
            $user->save();

            Auth::login($user);

            return response()->json([
                'success' => true,
                'remember_token' => $remember_token,
                'name' => $user->name,
            ]);
        } else {
               return response()->json([
                'success' => false
            ]);
        }
    }

    public function logout() {
        Auth::logout();
        return response()->json([
                    'success' => true
        ]);
    }
}
