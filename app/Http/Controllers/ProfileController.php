<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Resources\Admin;
use App\Models\Resources\Company;
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


    public function showUserInfo()
    {
        // Recupera l'istanza dell'utente loggato
        $user = Auth::user();

        if ($user) {
            $username = $user->username;
            $name = $user->name;
            $surname = $user->surname;
            $gender = $user->gender;
            $phone = $user->phone;
            $email = $user->email;

            $companies= $this->showFavouriteCompany();

            $role = $this->setRole();
            $privilege = $this->setPrivilege();
        }

        return view('account')
            ->with('username', $username)
            ->with('name', $name)
            ->with('surname', $surname)
            ->with('role', $role)
            ->with('privilege', $privilege)
            ->with('phone',$phone)
            ->with('gender',$gender)
            ->with('email',$email)
            ->with('companies', $companies);
    }

    public function setRole()
    {
        $user = Auth::user();

        $admins = Admin::all();
        $staffs = Staff::all();
        foreach ($admins as $admin) {
            if ($user->id == $admin->account_id) {
                return 'admin';
            }
        }
        foreach ($staffs as $staff) {
            if ($user->id == $staff->account_id) {
                return 'staff';
            }
        }

        return 'user';
    }

    public function setPrivilege()
    {
        $user = Auth::user();
        $staffs = Staff::all();

        foreach ($staffs as $staff) {
            if ($user->id == $staff->account_id && $staff->privileged) {
                return 1;
            }
        }
        return 0;
    }


//    TODO specializzare per aziende preferite
    public function showFavouriteCompany()
    {
        $user = Auth::user();
        $companies = Company::all();
        return $companies;

    }




}
