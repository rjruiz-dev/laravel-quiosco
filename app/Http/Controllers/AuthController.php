<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegistroRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(RegistroRequest $request){
        // Validar el registro
        $data = $request->validated();

        // Crear el usuario
        $user = User::create([
            'name'      => $data['name'],
            'email'     => $data['email'],
            'password'  => bcrypt($data['password'])
        ]);

        // Retornar una respuesta
        return [
            'token' => $user->createToken('token')->plainTextToken,
            'user'  => $user
        ];
    }

    public function login(LoginRequest $request){
        // return "desde login";
        $data = $request->validated();

        // revisar el password
        if(!Auth::attempt($data)){
            return response([
                'errors' => ['El email o el password son incorrectos']
            ], 422); // 422 es necesario enviarlo, por defecto es 200 = ok
        }

        // autenticar al usuario 
        $user = Auth::user();
        // generar y retornar un token
        return [
            'token' => $user->createToken('token')->plainTextToken,
            'user'  => $user
        ];

        
    }

    public function logout(Request $request){
        // return "Logout...";
        $user = $request->user();
        $user->currentAccessToken()->delete(); // elimina el token

        // retorna usuario como vacio
        return [
            'user' => null
        ];
    }
}
