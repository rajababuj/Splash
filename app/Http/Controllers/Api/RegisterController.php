<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Hash;



class RegisterController extends Controller
{
    public function register(RegisterRequest $request)
    {
        
        $input = $request->validated();
        if (User::where('email', $input['email'])->exists()) {
            return $this->sendError('Validation Error.', ['email' => ['The email address is already registered.']]);
        }
        $input['password'] = Hash::make($input['password']);
        $user = User::create($input);
        $success['token'] =  $user->createToken('company')->accessToken;
        // dd($success);
        $success['name'] =  $user->name;
        return response()->json([
            'status' => 'Success',
            'token' => $success,
            'message' => 'User register successfully.',
        ]);
    }

    public function login(Request $request)
    {
        $credentials = $request->only(['email', 'password']);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('company')->accessToken;
            // dd($token);
            $user_id = $user->id;

            return response()->json([
                'status' => 'success',
                'message' => 'Logged in successfully!',
                'token' => $token,
                'user_id' => $user_id,
            ]);
        } else {
            return $this->sendError('Unauthorised.', ['error' => 'Unauthorised']);
        }
    }
}
