<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Str;

class PropertyRequest extends FormRequest
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
        $attr += ['sort' => 'Sort'];
        $attr += ['status' => 'Status'];

        return $attr;
    }

    public function rules(): array
    {
        $req = [];
        foreach (config('translatable.locales') as $locale) {
            $req += [$locale.'.title' => 'required'];
        }
        $req += ['status' => 'nullable'];
        $req += ['sort' => 'nullable', 'numeric', 'integer', 'min:1'];

        return $req;
    }

    public function getSanitized()
    {
        $data = $this->validated();
        $data['status'] = isset($data['status']) ? true : false;

        foreach (config('translatable.locales') as $locale) {
            $data[$locale]['slug'] = $this->generateSlug($data[$locale]['title']);
        }
        if (request()->isMethod('POST')) {
            $data['created_by'] = @auth()->guard('admin')->user()->id;
        } else {
            $data['updated_by'] = @auth()->guard('admin')->user()->id;
        }

        return $data;
    }

    private function generateSlug($title)
    {
        $slug = Str::slug($title);
        $slug = preg_replace('/[^a-z0-9-]/', '', $slug);

        return $slug;
    }
}
