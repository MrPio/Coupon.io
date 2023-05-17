<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Resources\Account;
use App\Models\Resources\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredAccountController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:'.Account::class],
            'password' => ['required', Rules\Password::defaults()],
        ]);

        $account = Account::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);

        User::create([
            'account_id' => $account->id
        ]);

        event(new Registered($account));

        Auth::login($account);

        return redirect(RouteServiceProvider::HOME);
    }
}
