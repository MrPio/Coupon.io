<?php

namespace App\Http\Requests;

use App\Models\Resources\Account;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\Response;


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
            'name' => ['string', 'required' , 'max:24'],
            'surname' => [ 'string', 'required' , 'max:24'],
            'birth' => ['date', 'required' , 'before:today'],
            'gender' => ['string','in:male,female,unknown','required'],
            'phone' => ['string', 'required' , 'max:24'],
            'username' => ['string', 'required' , 'max:24', Rule::unique(Account::class)->ignore($this->user()->id)],
            'email' => ['email', 'required' , 'max:99', Rule::unique(Account::class)->ignore($this->user()->id)],
        ];
    }

    /**
     * Override: response in formato JSON
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY));
    }
}
