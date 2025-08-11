<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Lang;
use Locale;

class CountryRequest extends FormRequest
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
            $attr += [$locale.'.title' => 'Title '.Lang::get($locale)];
        }
        $attr += ['status' => 'Status'];
        $attr += ['sort' => 'Sort'];

        return $attr;
    }

    public function rules()
    {
        $req = [];
        // For each locale defined in the config, define rules for translatable fields
        foreach (config('translatable.locales') as $locale) {
            $req += [$locale.'.title' => 'required'];
        }
        // Other non-translatable fields
        $req += ['status' => 'nullable'];
        $req += ['sort' => ['nullable', 'numeric', 'integer', 'min:1']];

        return $req;
    }

    public function getSanitized()
    {
        $data = $this->validated();
        $data['status'] = isset($data['status']) ? true : false;
        if (request()->isMethod('POST')) {
            $data['created_by'] = @auth()->guard('admin')->user()->id;
        } else {
            $data['updated_by'] = @auth()->guard('admin')->user()->id;
        }

        return $data;
    }
}
