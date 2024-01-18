<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();
        if(Auth::user() && Auth::user()->role == 'admin' ) {
            return redirect()->route('adm.dashboard');
        }
        else if (Auth::user() && Auth::user()->role == 'guru') {
            return redirect()->route('guru.dashboard');
        }
        else if (Auth::user() && Auth::user()->role == 'walikelas') {
            return redirect()->route('wk.dashboard');
        }
        else if (Auth::user() && Auth::user()->role == 'bk') {
            return redirect()->route('bk.dashboard');
        }
        else if (Auth::user() && Auth::user()->role == 'keuangan') {
            return redirect()->route('keu.dashboard');
        }
        else {
            Auth::guard('web')->logout();
            return redirect()->route('login')->with('status', 'Anda tidak diijinkan untuk masuk ke halaman ini');
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
