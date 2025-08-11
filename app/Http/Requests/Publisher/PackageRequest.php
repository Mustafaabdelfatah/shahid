<?php

namespace App\Http\Requests\Publisher;

use Illuminate\Foundation\Http\FormRequest;

class PackageRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'package_id' => 'required', 'integer', 'exists:packages,id',
            'date_package_id' => 'required', 'integer', 'exists:date_packages,id',
            'user_id' => 'nullable', 'integer', 'exists:users,id',
            'unit_id' => 'required', 'integer', 'exists:products,id'
        ];
    }

    public function getSanitized()
    {
        $data = $this->validated();
        $data['user_id']  = @auth()->user()->id;
        return $data;
    }
}
 