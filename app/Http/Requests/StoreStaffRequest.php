<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rules\Password;
use Symfony\Component\HttpFoundation\Response;

class StoreStaffRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('isAdmin');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|max:32',
            'surname' => 'required|max:32',
            'username' => 'required|unique:App\Models\Resources\Account,username|max:64',
            'password' => ['required', Password::defaults()],
            'gender' => 'in:male,female,unknown',
            'birth' => 'date|before:now',
            'email' => 'email|max:256',
            'phone' => 'max:32',
            'companies' => 'required|array|min:1'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY));
    }
}
