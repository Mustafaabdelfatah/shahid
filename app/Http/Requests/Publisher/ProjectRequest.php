<?php

namespace App\Http\Requests\Publisher;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Lang;
use Locale;

class ProjectRequest extends FormRequest
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
            $attr += [$locale.'.title' => 'Title '.Lang::get($locale)];
            $attr += [$locale.'.description' => 'Description '.Lang::get($locale)];
            $attr += [$locale.'.address' => 'Address '.Lang::get($locale)];
        }
        $attr += ['status' => 'Status'];
        $attr += ['location' => 'Location'];
        $attr += ['image[]' => 'Images'];

        return $attr;
    }

    public function rules()
    {
        $req = [];

        // For each locale defined in the config, define rules for translatable fields
        foreach (config('translatable.locales') as $locale) {
            $req += [$locale.'.title' => 'required'];
            $req += [$locale.'.description' => 'nullable'];
        }

        // Other non-translatable fields
        $req += ['country_id' => ['required', 'integer', 'exists:countries,id']];
        $req += ['state_id' => ['required', 'integer', 'exists:states,id']];
        $req += ['city_id' => ['required', 'integer', 'exists:cities,id']];
        $req += ['district_id' => ['nullable', 'integer', 'exists:districts,id']];
        $req += ['user_id' => ['nullable', 'integer', 'exists:users,id']];
        $req += ['status' => 'nullable'];
        $req += ['address' => 'nullable'];
        $method = $this->getMethod();
        if ($method == 'POST') {
            //     // If POST, image is required
            $req += ['image' => 'required|image|mimes:png,jpg'];
        } elseif ($method == 'PUT') {
            //     // If PUT, image is nullable
            $req += ['image' => 'nullable|image|mimes:png,jpg'];
        }

        return $req;
    }

    public function getSanitized()
    {
        $data = $this->validated();
        $data['user_id'] = @auth()->user()->id;
        $data['status'] = 1;

        return $data;
    }
}
