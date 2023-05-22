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
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredAccountController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.login')
            ->with('was_in_signup', true);
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        session()->put('was_in_signup', true);
        $request->validate([
            'name' => ['required', 'string', 'max:24'],
            'surname' => ['required', 'string', 'max:24'],
            'birth_date' => ['required', 'date', 'before:today'],
            'gender' => ['required', 'in:male,female,unknown'],
            'username' => ['required', 'string', 'max:24', 'unique:' . Account::class],
            'email' => ['required', 'email', 'max:99'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        $account = Account::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'username' => $request->username,
            'gender' => $request->gender,
            'email' => $request->email,
            'birth' => $request->birth_date,
            'password' => Hash::make($request->password),
        ]);

        User::create([
            'id' => $account->id
        ]);

        event(new Registered($account));
        Auth::login($account);
        $account->sendEmailVerificationNotification();

        return redirect(route('verification.notice'));
    }
}
