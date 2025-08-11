<?php

namespace App\Http\Requests\Publisher;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
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
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => 'required',
            'phone' => 'required|numeric|min:11',
            'status' => 'nullable',
            // 'role' => 'nullable',
            // 'roles' => 'required', 'array',
            'created_by' => 'nullable',
            'updated_by' => 'nullable',
            'parent_id' => 'nullable',

        ] : [
            'name' => 'required|string|max:255',
            'email' => ['required', 'email'],
            'password' => 'nullable',
            // 'role' => 'nullable',
            // 'roles' => 'required', 'array',
            'phone' => 'required|numeric|min:11',
            'status' => 'nullable',
            'created_by' => 'nullable',
            'updated_by' => 'nullable',
            'parent_id' => 'nullable',
        ];


    }

    public function getSanitized()
    {
        $data =  $this->validated();
        $data['status'] = isset($data['status']) == 'on' ? true : false;
        $data['parent_id']  =@auth()->user()->id;
        $data['role']  ='employee';
        if (request()->isMethod('POST')) {
            $data['created_by']  =@auth()->user()->id;

        } else {
            $data['updated_by']  = @auth()->user()->id;
        }
        return $data;

    }
}
