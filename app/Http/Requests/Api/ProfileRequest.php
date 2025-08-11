<?php

namespace App\Http\Requests\Api;

use App\Http\Requests\Api\Base\ApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends ApiRequest
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
            'name'                          => 'nullable', 'string', 'max:100',
            'email'                         => ['nullable', 'string', 'email', 'max:70', 'unique:users,email,' . $this->user()->id],
            'phone'                         => ['nullable', 'string', 'max:15', 'unique:users,phone,' . $this->user()->id],
            'address'                       => ['nullable', 'string', 'max:200'],
            'city'                          => ['nullable', 'string', 'max:50'],
            'image'                         => ['nullable', 'image', 'max:2048', 'mimes:png,jpg'],
            'cover_image'                   => ['nullable', 'image', 'max:2048', 'mimes:png,jpg'],
            'bio'                           => ['nullable', 'string', 'max:255'],
            'company_name'                  => ['nullable', 'string', 'max:50'],
            'website_link'                  => ['nullable', 'string', 'max:100'],
            'whatsapp'                      => ['nullable', 'string', 'max:15', 'unique:users,whatsapp,' . $this->user()->id],
            'facebook'                      => ['nullable', 'string', 'max:100'],
            'twitter'                       => ['nullable', 'string', 'max:100'],
            'instagram'                     => ['nullable', 'string', 'max:100'],
            'youtube'                       => ['nullable', 'string', 'max:100'],
            'linkedin'                      => ['nullable', 'string', 'max:100'],
            'telegram'                      => ['nullable', 'string', 'max:100'],
            'github'                        => ['nullable', 'string', 'max:100'],
            'vimeo'                         => ['nullable', 'string', 'max:100'],
            'tiktok'                        => ['nullable', 'string', 'max:100'],
            'snapchat'                      => ['nullable', 'string', 'max:100'],
            'pinterest'                     => ['nullable', 'string', 'max:100'],
        ];
    }


    // public function getSanitized()
    // {
    //     $data =  $this->validated();
    //     return $data;
    // }
}
