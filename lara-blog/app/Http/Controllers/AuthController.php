<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends StateController
{
    public function Register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "name" => "required|min:3|string",
            "email" => "required|email|unique:users,email",
            "password" => "required|min:8",
        ]);

        if ($validator->fails()) {
            return $this->sendResponse("Can't Register Now Please Check Your information!", $validator->errors(), false, 404);
        }

        $user = User::create($request->all());
        $data['token']=$user->createToken("justfortest")->plainTextToken;
        $data['name']=$user->name;
        return $this->sendResponse("User Created Successfully!", $data);
    }

    public function Login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $data['token'] = $user->createToken('justfortest')->plainTextToken;
            $data['name'] = $user->name;
            return $this->sendResponse('User Login Successfully!', $data);
        }

        return $this->sendResponse("Error in Credintials!", [], false, 404);
    }

    public function Logout(Request $request)
    {
            request()->user()->tokens()->delete();
            return $this->sendResponse('User Logout Successfully!',[]);
    }
}
