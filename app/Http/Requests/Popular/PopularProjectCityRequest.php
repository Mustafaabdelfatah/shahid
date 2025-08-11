<?php

namespace App\Http\Requests\Popular;

use Illuminate\Foundation\Http\FormRequest;

class PopularProjectCityRequest extends FormRequest
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
            'project_id' => 'required|array|exists:projects,id',
            'project_id.*' => 'required|integer|exists:projects,id',
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
