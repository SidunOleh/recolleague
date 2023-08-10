<?php

namespace App\Http\Requests\Admin\ChatRequest;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'model' => 'required|string',
            'request_text' => 'required|array',
            'styles.*' => 'required|string',
            'styles' => 'sometimes|array',
            'styles.*' => 'sometimes|array',
            'temperature' => 'required|numeric|between:0,2',
            'max_tokens' => 'required|integer|min:1|max:4096',
            'presence_penalty' => 'required|numeric|between:-2,2',
            'frequency_penalty' => 'required|numeric|between:-2,2',
        ];
    }
}
