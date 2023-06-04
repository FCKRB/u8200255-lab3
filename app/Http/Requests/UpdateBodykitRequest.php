<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;


class UpdateBodykitRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $versions = ['RoketBunny', 'Buddy Club', ' Top-Tuning'];
        return [
            'version' => ['string', Rule::in($versions)],
            'name' => ['string'],
            'manufacture_year' => ['numeric', 'min:1970'],
            'bodykit_shop_id' => ['numeric', 'exists:bodykit_shops,id'],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors();
        throw new HttpResponseException(response()->json(["code" => 400, "message" => $errors], 400));
    }
}
