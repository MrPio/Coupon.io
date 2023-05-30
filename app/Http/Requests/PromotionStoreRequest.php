<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\Response;

class PromotionStoreRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('isStaff');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'is_coupled' => 'bool',

            'company_id' => 'required',
            'category_id' => 'required',
            'starting_from' => 'required|date|after_or_equal::today',
            'ends_on' => 'required|date|after:starting_from',
            'amount' => 'required|max:9999',

            'discount' => 'required_if:is_coupled,false|numeric|min:0|max:9999',
            'discount_type' => 'required_if:is_coupled,false',
            'product_name' => 'required_if:is_coupled,false|max:40',
            'product_price' => 'required_if:is_coupled,false|numeric|max:99999',
            'product_url' => 'required_if:is_coupled,false|max:1024',
            'product_image_path' => 'required_if:is_coupled,false|max:1024',
            'product_description' => 'required_if:is_coupled,false|max:1000',

            'extra_percentage_discount' => 'required_if:is_coupled,true|numeric|min:1|max:100',
            'promotion_1' => 'required_if:is_coupled,true|different:promotion_2|different:promotion_3|different:promotion_4',
            'promotion_2' => 'required_if:is_coupled,true|different:promotion_3|different:promotion_4',
            'promotion_3'=>'',
            'promotion_4'=>'',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY));
    }
}
