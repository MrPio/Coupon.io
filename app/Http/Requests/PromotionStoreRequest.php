<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\Response;

class PromotionStoreRequest extends FormRequest {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return Gate::allows('isStaff');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'discount' => 'required|numeric|min:0|max:99999',
            'discount_type' => 'required',
            'product_price' => 'required|numeric|max:99999',
            'product_url' => 'required|max:1024',
            'product_image_path' => 'required|max:1024',
            'company_id' => 'required',
            'category_id' => 'required',
            'product_name' => 'required|max:40',
            'starting_from' => 'required|date|after_or_equal::today',
            'ends_on' => 'required|date|after:starting_from',
            'amount' => 'required|max:9999',
            'description' => 'required|max:1000',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY));
    }
}
