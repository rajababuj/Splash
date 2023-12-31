<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Exception;

class LoginController extends Controller
{

    
    public function Login()
    {

        return view('login');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function postLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

         
        if (!$user) {
            return redirect()->route('user.login')->with('error', 'Email does not exist.');
        }
        if (!Hash::check($request->password, $user->password)) {
            return redirect()->route('user.login')->with('error', 'Password mismatch.');
        }

        if (Auth::attempt($credentials)) {
            return redirect()->route('user.home');
        } else {
            return redirect()->route('user.login')->with('error', 'Email and password do not match.');
        }
        // if (Auth::guard('users')->attempt($credentials)) {
        //     return redirect()->route('home')->with('success', 'Login Successfull');
        // } else {
        //     return redirect()->back()->with('error', 'Invalid credentials');
        // }
    }
    


    public function logout()
    {
        auth()->logout();
        return redirect()->route('user.login')->with('success', 'You have been successfully logged out');
    }

    public function signInwithGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
    public function callbackToGoogle()
    {
        try {

            $user = Socialite::driver('google')->user();

            $finduser = User::where('gauth_id', $user->id)->first();

            if ($finduser) {

                Auth::login($finduser);

                return redirect('/dashboard');
            } else {
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'gauth_id' => $user->id,
                    'gauth_type' => 'google',
                    'password' => encrypt('admin@123')
                ]);

                Auth::login($newUser);

                return redirect('/product' 
            
            );
            }
        } catch (Exception $e) {
            // dd($e->getMessage());
        }
    }
   
}
