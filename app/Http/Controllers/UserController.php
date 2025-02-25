<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //
    public function showLogin()
    {
        return view('loginform');
    }

    // Procesar login
    public function doLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "email" => "required|email:rfc,dns|exists:users,email",
            "password" => "required",
        ]);

        if ($validator->fails()) {
            return redirect()->route('login')->withErrors($validator)->withInput();
        }

        $credentials = $request->only('email', 'password');
        
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            return view('principal', compact('user'));
        }

        return redirect()->route('login')->withErrors(['credentials' => 'Credenciales incorrectas'])->withInput();
    }

    // Mostrar formulario de registro
    public function showRegister()
    {
        return view('registerform');
    }

    // Procesar registro
    public function doRegister(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "name" => "required|string|max:20",
            "email" => "required|email:rfc,dns|unique:users,email",
            "password" => "required|min:5|max:20|regex:/[a-z]/|regex:/[A-Z]/|regex:/[0-9]/",
            "password_repeat" => "required|same:password"
        ], [
            "password.min" => "La contraseña debe contener 5 caracteres mínimo",
            "password.max" => "La contraseña debe contener 20 caracteres máximo",
            "password.regex" => "La contraseña debe contener una minúscula, una mayúscula y un dígito",
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }
        
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('login');
    }
}
