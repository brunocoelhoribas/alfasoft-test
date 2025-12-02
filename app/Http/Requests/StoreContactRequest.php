<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreContactRequest extends FormRequest {
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array {
        return [
            'country_code' => 'required|string',
            'number' => [
                'required',
                'digits:9',
                Rule::unique('contacts')->where(function ($query) {
                    return $query->where('country_code', $this->country_code);
                }),
            ],
        ];
    }
}
