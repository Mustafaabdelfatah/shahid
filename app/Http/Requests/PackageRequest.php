<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Lang;
use Locale;

class PackageRequest extends FormRequest
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
        }

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
        $req += ['type' => 'required|in:gold,bronze,silver,normal'];
        $req += ['status' => 'nullable'];

        $method = $this->getMethod();
        if ($method == 'POST') {
            $req += ['list.*.price' => 'required|string'];
            $req += ['list.*.duration' => 'required|string'];
        } elseif ($method == 'PUT') {
            $req += ['list.*.price' => 'nullable|string'];
            $req += ['list.*.duration' => 'nullable|string'];
        }

        return $req;
    }

    public function getSanitized()
    {
        $data = $this->validated();
        $data['status'] = isset($data['status']) ? true : false;

        return $data;
    }
}
