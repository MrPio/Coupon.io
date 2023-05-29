<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Resources\Admin;
use App\Models\Resources\Company;
use App\Models\Resources\Promotion;
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
    public function updateUser(ProfileUpdateRequest $request): \Illuminate\Http\JsonResponse
    {
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

        return response()->json(['redirect' => route('account')]);
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

        if($account->role()=='user'){
        return view('account')
            ->with('account', $account);}
        else return view('account_not_user')
            ->with('account', $account);
    }
}
