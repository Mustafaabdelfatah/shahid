<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Lang;
use Illuminate\Foundation\Http\FormRequest;

class CategoryJobRequest extends FormRequest
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
    public function attributes()
    {
        $attr = [];
        foreach (config('translatable.locales') as $locale) {
            $attr += [$locale . '.title' => 'Title ' . Lang::get($locale)];
        }

        return $attr;
    }

    public function rules()
    {
        $req = [];
    
        // For each locale defined in the config, define rules for translatable fields
        foreach (config('translatable.locales') as $locale) {
            $req += [$locale . '.title' => 'required'];
        }
        
        $method = $this->getMethod();
        if ($method == 'POST') {
            // If POST, image is required
            $req += ['image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'];
        } elseif ($method == 'PUT') {
            // If PUT, image is nullable
            $req += ['image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'];
        }
    
        return $req;
    }

    public function getSanitized()
    {
        $data = $this->validated();

        return $data;
    }
}
