<?php

namespace App\Http\Requests\Admin\Profile;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(Admin::class)->ignore($this->user()->id)],
            'phone' => ['required', 'numeric', 'digits_between:10,15'],
            'city' => ['required', 'string', 'max:255'],
            'country' => ['required', 'string', 'max:255'],
            'bio' => ['nullable', 'string', 'max:255'],
            'positions' => ['nullable', 'string'],
            'image' => ['nullable', 'image','mimes:jpg,jpeg,png','max:2048'],
            'cover_imgae' => ['nullable', 'image','mimes:jpg,jpeg,png','max:2048']
        ];
    }
}

