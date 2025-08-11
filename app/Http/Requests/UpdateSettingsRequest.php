<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Lang;
use Locale;

class UpdateSettingsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function attributes()
    {
        $attr = [];
        foreach (config('translatable.locales') as $locale) {
            $attr += [$locale.'.meta_title' => 'Meta title '.Lang::get($locale)];
            $attr += [$locale.'.meta_description' => 'Meta description '.Lang::get($locale)];
            $attr += [$locale.'.meta_key' => 'Meta key '.Lang::get($locale)];
        }

        return $attr;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        $req = [];

        // For each locale defined in the config, define rules for translatable fields
        foreach (config('translatable.locales') as $locale) {
            $req += [$locale.'.meta_title' => 'nullable'];
            $req += [$locale.'.meta_description' => 'nullable'];
            $req += [$locale.'.meta_key' => 'nullable'];
        }

        $req += ['logo_web' => 'nullable|image|max:2048'];
        $req += ['name' => 'nullable|string|max:100'];
        $req += ['email' => 'nullable|string|max:100'];
        $req += ['phone' => 'nullable|string|max:100'];
        $req += ['facebook' => 'nullable|string|max:100'];
        $req += ['twitter' => 'nullable|string|max:100'];
        $req += ['instagram' => 'nullable|string|max:100'];
        $req += ['youtube' => 'nullable|string|max:100'];
        $req += ['linkedin' => 'nullable|string|max:100'];
        $req += ['whatsapp' => 'nullable|string|max:100'];
        $req += ['telegram' => 'nullable|string|max:100'];
        $req += ['github' => 'nullable|string|max:100'];
        $req += ['vimeo' => 'nullable|string|max:100'];
        $req += ['tiktok' => 'nullable|string|max:100'];
        $req += ['snapchat' => 'nullable|string|max:100'];
        $req += ['pinterest' => 'nullable|string|max:100'];
        $req += ['map' => 'nullable|string|max:100'];
        $req += ['address' => 'nullable|string|max:100'];
        $req += ['favicon_web' => 'nullable|image|max:2048'];

        return $req;
    }

    public function getSanitized()
    {
        $data = $this->validated();
        if (request()->isMethod('POST')) {
            $data['created_by'] = @auth()->guard('admin')->user()->id;
        } else {
            $data['updated_by'] = @auth()->guard('admin')->user()->id;
        }

        return $data;
    }
}
