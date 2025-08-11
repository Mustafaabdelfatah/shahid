<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        return $this->isMethod('POST') ? [
            'name' => 'required|string|max:255',
            'email' => ['nullable', 'email', Rule::unique('users', 'email')],
            'password' => 'required',
            'status' => 'nullable',
            'role' => 'required',
            'phone' => 'required',
            'backup_number' => 'nullable',
            'created_by' => 'nullable',
            'updated_by' => 'nullable',
        ] : [
            'name' => 'required|string|max:255',
            'email' => ['nullable', 'email'],
            'password' => 'nullable',
            'phone' => 'nullable',
            'backup_number' => 'nullable',
            'role' => 'nullable',
            'status' => 'nullable',
            'created_by' => 'nullable',
            'updated_by' => 'nullable',
        ];
        

    }

    public function getSanitized()
    {
        $data =  $this->validated();
        $data['status'] = isset($data['status']) == 'on' ? true : false;
        if (request()->isMethod('POST')) {
            $data['created_by']  =@auth()->guard('admin')->user()->id;
        } else {
            $data['updated_by']  = @auth()->guard('admin')->user()->id;
        }
        return $data;
       
    }
}
