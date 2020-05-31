<?php

namespace App\Http\Controllers;

use App\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Validator;
use Illuminate\Support\Facades\Auth;
use App\User;

class AuthController extends Controller
{
    public function login(Request $request)
    {

        //Validate data
        $response = array('response' => '', 'success'=>false);
        $validator = Validator::make($request->all(),  [
                'email' => 'required|email',
                'password' => 'required'
            ]
        );

        //Response fails
        if ($validator->fails()) {
            $response['response'] = $validator->messages();
            return response()->json($response['response']);
        }else{
            $credentials = request(['email', 'password']);

            if (!Auth::attempt($credentials)) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Unauthorized'], 401);
            }
            $user = $request->user();
            $tokenResult = $user->createToken('Personal Access Token');
            $token = $tokenResult->token;

            return response()->json([
                'access_token' => $tokenResult->accessToken,
                'token_type'   => 'Bearer'
            ]);
        }

    }

    public function register(Request $request)
    {

        //Validate data
        $response = array('response' => '', 'success'=>false);
        $validator = Validator::make($request->all(),  [
                'name' => 'required|min:2',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:8']
        );

        //Response fails
        if ($validator->fails()) {
            $response['response'] = $validator->messages();
            return response()->json($response['response']);
        }else{
            //Create user
            $response = User::create([
                'name'     => $request->name,
                'email'    => $request->email,
                'password' =>  bcrypt($request->password),
            ]);
            return response()->json([
                'message' => 'Usuario creado satisfactoriamente'], 201);

        }

    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json(['message' =>'Logout realizado']);
    }

}
