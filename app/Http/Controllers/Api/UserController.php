<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $credentials = [
            'email'=>$request->email,
            'password'=>$request->password
        ];

        if(Auth::attempt($credentials))
        {
            $token = Auth::user()->createToken('myapptoken')->plainTextToken;
            session()->put('token',$token);

            return response()->json([
                'isLoggedIn'=>true,
                'user'=>auth()->user(),
                'token'=>$token
            ]);
        }
        return response()->json("Usuario y/o contraseña invalido",422);

    }

    public function checkToken(){
        try {
            [$id,$token] = explode('|',request('token'));
            $token = hash('sha256',$token);
            $tokenModel = PersonalAccessToken::where("token",$token)->first();
            //dd($tokenModel->tokenable);
            if($tokenModel)
            {
                return response()->json([
                    'isLoggedIn'=>true,
                    'user'=>auth()->user(),
                    'token'=>request('token')
                ]);
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
        
        return response()->json("Usuario invalido",422);
    }
    
    public function logout()
    {
        [$id,$token] = explode('|',request('token'));
        if(Auth::user())
            Auth::user()->tokens()->where('id',$id)->delete();
        else
            PersonalAccessToken::where('id',$id)->delete();
        session()->flush();
        return response()->json("Ok");
    }

}