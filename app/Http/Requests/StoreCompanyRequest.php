<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StoreCompanyRequest extends FormRequest
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
            'name' => 'required|unique:App\Models\Resources\Company,name|max:64',
            'place' => 'required|max:64',
            'logo' => 'required|max:64',
            'url' => 'required|max:1024',
            'type' => 'required|max:9',
            'color' => 'max:7',  // TODO: find a better way to do this
            'description' => 'required|max:1024',
            'featured' => 'required|boolean',
        ];
    }
}
