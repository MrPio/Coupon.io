<?php

namespace App\Http\Requests;

use App\Models\Resources\Account;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['string', 'max:24'],
            'surname' => [ 'string', 'max:24'],
            'birth_date' => ['date', 'before:today'],
            'gender' => ['in:male,female,unknown'],
            'phone' => ['string', 'max:24'],
            'username' => ['string', 'max:24', Rule::unique(Account::class)->ignore($this->user()->id)],
            'email' => ['email', 'max:99', Rule::unique(Account::class)->ignore($this->user()->id)],
            //'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ];
    }
}
