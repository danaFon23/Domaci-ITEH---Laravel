<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function registration(Request $request)  
    {
        $validator = Validator::make($request->all(), [   
            'name'=> 'required|string|max:255',        
            'email'=> 'required|string|max:255|email|unique:users',
            'password'=> 'required|string|min:8',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());
        }
        $user = User::create([  
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json(['data' => $user, 'access_token' => $token, 'token_type' => 'Bearer']);
        
    }

    public function login(Request $request)
    {
        if(!Auth::attempt($request->only('email', 'password')))
            return response()->json(['message'=>'Korisnik ne postoji u bazi'],401);
        
        $user = User::where('email', $request['email'])->firstOrFail();
        
   
        $token = $user->createToken('auth_token')->plainTextToken;
        
        return response()->json(['message'=>'Zdravo '.$user->name.'! Dobrodosli na pocetnu stranu!', 'access_token'=>$token, 'token_type'=>'Bearer']);
    }

    public function logout(Request $request)
    {
        $name = $request->user()->name;
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Korisnik '.$name. 'je uspesno izlogovan i token je uspesno obrisan!']);
    }






}
