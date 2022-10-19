<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if($validate->fails()) {
            return response()->json([
                'status'=>400,
                'message' => 'failed'
            ]);
        }


        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);

        $user->save();

        return response()->json([
            'status'=>200,
            'message' => 'created'
        ]);

    }

    public function login(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if($validate->fails()) {
            return response()->json([
                'status'=>400,
                'message' => 'bad'
            ]);
        }

        $credentials = request(['email','password']);

        if(!Auth::attempt($credentials)) {
            return response()->json([
                'status'=>500,
                'message' => 'unauthorized'
            ]);
        }

        $getUser = User::where('email', $request->email)->first();

        $userToken = $getUser->createToken('authToken')->plainTextToken;

        return response()->json([
            'status'=>200,
            'message' => 'loggedin',
            'token'=>$userToken
        ]);
    }


    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'status'=>200,
            'message' => 'loggedout'
        ]);
    }
}
