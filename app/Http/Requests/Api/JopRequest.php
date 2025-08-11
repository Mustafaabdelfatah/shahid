<?php

namespace App\Http\Requests\Api;

use App\Http\Requests\Api\Base\ApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class JopRequest extends ApiRequest
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
            'job_id' => 'required',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'contact_number' => 'required|string|max:15',
            'email' => 'nullable|email',
            'notice_period' => 'nullable|integer',
            'work_link' => 'nullable|url',
            'resume' => 'nullable|file|mimes:doc,docx,pdf,rtf',
            'current_salary' => 'nullable|numeric',
            'expected_salary' => 'nullable|numeric',
        ];
    }
    public function getSanitized()
    {
        $data = $this->validated();


        return $data;
    }

}

