<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Resources\Admin;
use App\Models\Resources\Company;
use App\Models\Resources\User;
use App\Models\Resources\Staff;
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

        // Valida i campi del form di modifica degli utenti
//        $request->validate([
//            'name' => ['required', 'string', 'max:24'],
//            'surname' => ['required', 'string', 'max:24'],
//            'birth_date' => ['required', 'date', 'before:today'],
//            'gender' => ['required', 'in:male,female,unknown'],
//            'username' => ['required', 'string', 'max:24', 'unique:' . $request->user()::class],
//            'email' => ['required', 'email', 'max:99'],
//            //'password' => ['required', 'confirmed', Rules\Password::defaults()],
//        ]);

//        // Aggiorna i campi dell'utente
//        $request->user()->name = $request->input('name');
//        $request->user()->surname = $request->input('surname');
//        $request->user()->usename = $request->input('username');


        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        // Salvataggio dell'immagine
        if ($request->hasFile('imageInput')) {
            $image = $request->file('imageInput');
            $imagePath = $image->storeAs("/",'image_account_' . $request->user()->id . '.jpg' , 'public' ); // Salva l'immagine nella cartella "public/images/profili"

            $request->user()->image_path = $imagePath;
        }

        $request->user()->save();

        return Redirect::route('account')->with('status', 'profile-updated');
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


    public function showUserInfo()
    {
        // Recupera l'istanza dell'utente loggato
        $account = Auth::user();
        //$companies = $this->showFavouriteCompany();

        return view('account')
            ->with('user', $account);
    }


////    TODO Implementare se c'è tempo
//    public function showFavouriteCompany()
//    {
//        $user = Auth::user();
//        $companies = Company::all();
//        return $companies;
//
//    }


}
