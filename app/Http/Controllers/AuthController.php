<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Mockery\Exception;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    //
    public function register(Request $request)
    {
        $data = $request->validate([
            "name" => "required",
            "email" => "required|email|unique:users",
            "password" => "required|confirmed|min:8",
            "telephone" => "required|unique:users"
        ]);
        $data['password'] = Hash::make($request->input('password'));
        $user = User::create($data);
        return response()->json([
            'status' => 201,
            'data' => $user,
            "token"=>null
        ]);
    }


    public function login(Request $request)
    {
        $data=$request->validate([
            "email"=>"required|email",
            "password"=>"required",
        ]);
        $token =JWTAuth::attempt($data);

        if (!empty($token)){
            return response()->json([
                'status'=>200,
                'data'=>auth()->user(),
                'token'=>$token,
            ]);
        }else{
           return response()->json([
               'status'=>false,
               'token' =>$token,
           ]);
        }
    }

    public function logout()
    {
        auth()->logout();
        return response()->json([
            'status'=>true,
            'message' =>"Deconnexion success !!!",
        ]);
    }
    public function refresh()
    {
        $newToken = auth()->refresh();
        return response()->json([
            'status'=>true,
            "token" =>$newToken,
        ]);
    }
}
