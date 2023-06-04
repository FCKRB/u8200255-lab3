<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;


class ReplaceBodykitRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $versionss = ['RoketBunny', 'Buddy Club', ' Top-Tuning'];
        return [
            'version' => ['required', 'string', Rule::in($versions)],
            'name' => ['required', 'string'],
            'manufacture_year' => ['required', 'numeric', 'min:1970'],
            'bodykit_shop_id' => ['required', 'numeric', 'exists:bodykit_shops,id'],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors();
        throw new HttpResponseException(response()->json(["code" => 400, "message" => $errors], 400));
    }
}
