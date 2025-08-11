<?php

namespace App\Http\Requests\Popular;

use Illuminate\Foundation\Http\FormRequest;

class PopularCityRequest extends FormRequest
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
            'city_id' => 'required|exists:cities,id',
            'status' => 'nullable',
            'unit_id' => 'required|array|exists:products,id',
            'unit_id.*' => 'required|integer|exists:products,id',
        ];
    }

    public function attributes()
    {
        return [
            'city_id' => 'City',
            'unit_id' => 'Unit',
            'status' => 'Status',
        ];
    }

    public function getSanitized()
    {
        $data = $this->validated();
        $data['status'] = isset($data['status']) == 'on' ? true : false;
        if (request()->isMethod('POST')) {
            $data['created_by'] = @auth()->guard('admin')->user()->id;
        } else {
            $data['updated_by'] = @auth()->guard('admin')->user()->id;
        }

        return $data;
    }
}
