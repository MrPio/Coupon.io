<?php

namespace App\Http\Requests;

use App\Models\Resources\Account;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Symfony\Component\HttpFoundation\Response;

class StaffUpdateRequest extends FormRequest
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
        $validation_rules = [
            'name' => 'required|max:32',
            'surname' => 'required|max:32',
            'username' => ['sometimes', 'required', Rule::unique(Account::class)->ignore($this->route('staff'))],
            'gender' => 'in:male,female,unknown',
            'birth' => 'date|before:now',
            'email' => 'email|max:256',
            'phone' => 'max:32',
            'privileged'=>'required|bool',
            'companies' => 'sometimes|required_if:privileged,0|array|min:1'
        ];
        if ($this->request->has('validate_password')){
            $validation_rules['password'] = [Password::defaults()];
        }
        return $validation_rules;
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY));
    }
}
