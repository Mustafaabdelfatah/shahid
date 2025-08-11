<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Lang;
use Locale;

class CategoryRequest extends FormRequest
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
        }
        $attr += ['section_name' => 'Section_name'];
        $attr += ['status' => 'Status'];
        $attr += ['sort' => 'Sort'];

        return $attr;
    }

    public function rules()
    {
        $req = [];
        // For each locale defined in the config, define rules for translatable fields
        foreach (config('translatable.locales') as $locale) {
            $req += [$locale.'.title' => 'required', 'string'];
            $req += [$locale.'.sub_title' => 'required', 'string'];
        }
        // Other non-translatable fields
        $req += ['status' => 'nullable'];
        $req += ['sort' => ['nullable', 'numeric', 'integer', 'min:1']];

        $method = $this->getMethod();
        if ($method == 'POST') {
            //     // If POST, image is required
            $req += ['image' => 'required|image'];
        } elseif ($method == 'PUT') {
            //     // If PUT, image is nullable
            $req += ['image' => 'nullable|image'];
        }

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
