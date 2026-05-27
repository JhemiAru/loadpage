<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Support\Facades\Auth; 
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class controllerLogin extends Controller
{
    public function log(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            return redirect()->intended(route('inicio'));
        }

        return back()->withErrors([
            'email' => 'Contraseña o correo incorrectos',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('inicio');
    }

    public function startAdmin() 
    {
        return view('panel.inicio');
    }
}
