<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }


//    public function showFavouriteCompany()
//    {
//        // Recupera l'istanza dell'utente loggato
//        $user = Auth::user();
//
////        if($user){
////            $userFavouriteCompany= $user->;
////        }
//
//        return view('aziende')
//            ->with('companies', $companies);
//    }

    public function showUserInfo()
    {
        // Recupera l'istanza dell'utente loggato
        $user = Auth::user();

        // Recupera l'istanza dell'utente loggato
        if($user){
            $username= $user->username;
            $name = $user->name;
            $surname = $user->surname;
        }

        return view('account')
            ->with('username', $username)
            ->with('name', $name)
            ->with('surname', $surname);
    }
}
