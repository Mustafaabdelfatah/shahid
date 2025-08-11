<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TeamRequest extends FormRequest
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
            'title'     => 'string|required|max:200|min:3',
            'manger_id' => 'required', 'integer', 'exists:users,id',
            'status' =>'nullable',
            'employees' => 'nullable|array',
            'employees.*' => 'required|integer|exists:users,id',
            
        ];
    }
    public function getSanitized()
    {
        $data = $this->validated();
        $data['status'] = isset($data['status']) ? true : false;
        if (request()->isMethod('POST')) {
            $data['created_by']  =@auth()->guard('admin')->user()->id;
        } else {
            $data['updated_by']  = @auth()->guard('admin')->user()->id;
        }
        return $data;
    }
    
}
