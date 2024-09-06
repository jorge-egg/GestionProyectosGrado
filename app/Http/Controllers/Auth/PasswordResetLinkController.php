<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use App\Models\UsuariosUser;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        // Buscar el usuario en UsuariosUser en lugar de User
        $usuarioUser = UsuariosUser::where('email', $request->input('email'))->first();

        if (!$usuarioUser) {
            return back()->withErrors(['email' => 'No se encontró un usuario con ese correo.']);
        }

        // Ahora puedes proceder a enviar el enlace de restablecimiento usando el sistema de Laravel
        $status = Password::sendResetLink(
            ['email' => $usuarioUser->email]
        );

        return $status === Password::RESET_LINK_SENT
                    ? back()->with('status', __($status))
                    : back()->withErrors(['email' => __($status)]);
    }
}
