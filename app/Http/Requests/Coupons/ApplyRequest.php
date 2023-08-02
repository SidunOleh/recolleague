<?php

namespace App\Http\Requests\Coupons;

use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ApplyRequest extends FormRequest
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
            'coupon' => [
                'required',
                'string',
                Rule::exists('coupons')->where(function (Builder $query) {
                    return $query->where('status', true)
                        ->where('user_id', null);
                }),
            ],
        ];
    }
}
