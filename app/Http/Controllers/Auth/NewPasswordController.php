<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use App\Models\UsuariosUser;
use App\Models\User;


class NewPasswordController extends Controller
{
    /**
     * Display the password reset view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function create(Request $request)
    {
        return view('auth.reset-password', ['request' => $request]);
    }

    /**
     * Handle an incoming new password request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

     // Buscar el usuario en UsuariosUser
     $usuarioUser = UsuariosUser::where('email', $request->input('email'))->first();

     if (!$usuarioUser) {
         return back()->withErrors(['email' => 'Usuario no encontrado.']);
     }

     // Recuperar el usuario en la tabla User y actualizar la contraseña
     $user = User::find($usuarioUser->usua_users);
     $user->password = Hash::make($request->input('password'));
     $user->save();

     return redirect()->route('login')->with('status', 'Contraseña restablecida con éxito.');
    }
}
