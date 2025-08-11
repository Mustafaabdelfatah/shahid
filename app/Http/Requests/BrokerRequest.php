<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BrokerRequest extends FormRequest
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
            'email' => 'required|string|email|max:255|unique:users'.$this->id,
            'password' => 'required',
            'status' => 'nullable',
            'role' => 'required'
        ]: [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users'.$this->id,
            'password' => 'nullable',
            'role' => 'required',
           'status' => 'nullable',
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
