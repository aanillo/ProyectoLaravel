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

   
    public function doLogin(Request $request)
{
    $validator = Validator::make($request->all(), [
        "email" => "required|email:rfc,dns|exists:users,email",
        "password" => "required",
    ], [
        "email.required" => "El campo de correo electrónico es obligatorio.",
        "email.email" => "Por favor, introduce un correo electrónico válido.",
        "email.exists" => "El correo electrónico no está registrado.",
        "password.required" => "El campo de contraseña es obligatorio.",
    ]);

    if ($validator->fails()) {
        return redirect()->route('login')->withErrors($validator)->withInput();
    }

    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        return redirect()->intended('/home');
    }

    return redirect()->route('login')->withErrors(['credentials' => 'Credenciales incorrectas'])->withInput();
}

   
    public function showRegister(){
        return view('registerform');
    }

    
    public function doRegister(Request $request){
        $validator = Validator::make($request->all(), [
            "name" => "required|string|max:20",
            "email" => "required|email:rfc,dns|unique:users,email",
            "password" => "required|min:5|max:20|regex:/[a-z]/|regex:/[A-Z]/|regex:/[0-9]/",
            "password_repeat" => "required|same:password"
        ], [
            "name.required" => "El campo de nombre es obligatorio.",
            "name.string" => "El nombre debe contener solo caracteres válidos.",
            "name.max" => "El nombre no debe superar los 20 caracteres.",
            "email.required" => "El campo de correo electrónico es obligatorio.",
            "email.email" => "Por favor, introduce un correo electrónico válido.",
            "email.unique" => "Este correo ya está registrado.",
            "password.required" => "La contraseña es obligatoria.",
            "password.min" => "La contraseña debe contener al menos 5 caracteres.",
            "password.max" => "La contraseña no debe superar los 20 caracteres.",
            "password.regex" => "La contraseña debe contener al menos una letra minúscula, una mayúscula y un dígito.",
            "password_repeat.required" => "Debes confirmar tu contraseña.",
            "password_repeat.same" => "Las contraseñas no coinciden.",
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

    public function logout(){
        Auth::logout(); 
        return view('loginform');
    }


    public function deleteUser(Request $request){
        $user = Auth::user();

        if ($user) {
            $user->delete();
            Auth::logout();
            return redirect()->route('login')->with('status', 'Tu cuenta ha sido eliminada con éxito.');
        }

        return redirect()->route('login')->withErrors(['error' => 'No se pudo eliminar tu cuenta.']);
    }


}
