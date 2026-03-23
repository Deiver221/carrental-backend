<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        //Validador de inputs
        $validator = Validator::make($request->all(), [
            "name" => "required|string|max:20",
            "email" => "required|email|unique:users",
            "password" => "required|string|min:8|same:confirmed_password"
        ]);
        //Error por si falla validador
        if ($validator->fails()) {
            return response()->json(["errors" => $validator->errors()->all()]);
        }
        //Crear usuario
        $user = User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password),
            "role" => 'client'
        ]);

        $input['name'] = $request->name;
        $input['email'] = $request->email;
        $input['role'] = 'client';
        $input['token'] = $user->createToken('App')->plainTextToken;


        return response()->json($input);
    }

    public function login(Request $request)
    {
        if(!Auth::attempt($request->only('email', 'password'))){
            return response()->json(['errors' => ['Credenciales incorrectas']]);
            }
        $user = Auth::user();

        $input['name'] = $user->name;
        $input['email'] = $user->email;
        $input['role'] = $user->role;
        $input['token'] = $user->createToken('App')->plainTextToken;


        return response()->json($input);
    }

    public function profile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "name" => "required|string|max:20",
            "email" => "required|email",
        ]);
        //Error por si falla validador
        if ($validator->fails()) {
            return response()->json(["errors" => $validator->errors()->all()]);
        }
        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;
        $input['role'] = $user->role;
        
        
        if($request->password){
            $user->password = Hash::make($request->password);
        }
        $user->save();

        $input['name'] = $user->name;
        $input['email'] = $user->email;
        $input['role'] = 'client';
        
        return response()->json($input);
        
    }
}
