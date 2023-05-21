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
        $view = view('auth.login');
        if (session('was_in_signup')) {
            $view->with('was_in_signup', true);
            session()->put('was_in_signup', false);
        }
        return $view;
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required']
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if (Auth::user()->role() == 'user') {
                return redirect()->intended(RouteServiceProvider::HOME);
            } else if (Auth::user()->role() == 'staff') {
                return redirect()->intended(route('staff'));
            } else if (Auth::user()->role() == 'admin') {
                return redirect()->intended(route('admin'));
            }
        }

        return back()->withErrors([
            'username' => 'Le credenziali inserite non sono corrette.',
        ])->onlyInput('username');
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
