<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class RegisterController extends Controller
{

    public function register(RegisterRequest $request)
    {
        $email = $request->input('email');


        $existingUser = User::where('email', $email)->first();

        if ($existingUser) {

            switch ($request->input('register')) {
                case 1:
                    $existingUser->update(['google_id' => $request->input('google_id')]);
                    break;
                case 2:
                    $existingUser->update(['facebook_id' => $request->input('facebook_id')]);
                    break;
                default:
                 break;
            }

            $user = $existingUser;
        } else {

            $data = $request->only('name', 'email');

            switch ($request->input('register')) {
                case 1:
                    $data['google_id'] = $request->input('google_id');
                    break;
                case 2:
                    $data['facebook_id'] = $request->input('facebook_id');
                    break;
                default:
                    $data['password'] = Hash::make($request->password);
            }

            $user = User::create($data);
        }

        $token = $user->createToken('company')->accessToken;

        return response()->json([
            'status' => 'Success',
            'token' => $token,
            'name' => $user->name,
            'message' => 'User registered successfully.',
        ]);
    }

    public function login(Request $request)
    {
        $credentials = $request->only(['email', 'password']);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('company')->accessToken;

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
