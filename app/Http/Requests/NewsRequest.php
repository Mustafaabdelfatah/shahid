<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Str;

class NewsRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function attributes()
    {
        $attr = [];
        foreach (config('translatable.locales') as $locale) {
            $attr += [$locale.'.title' => 'Title '.Lang::get($locale)];
            $attr += [$locale . '.sub_title' => 'Sub title ' . Lang::get($locale)];
            $attr += [$locale.'.description' => 'Description'.Lang::get($locale)];
            $attr += [$locale.'.meta_title' => 'Meta title '.Lang::get($locale)];
            $attr += [$locale.'.meta_description' => 'Meta description '.Lang::get($locale)];
            $attr += [$locale.'.meta_key' => 'Meta key '.Lang::get($locale)];
        }
        $attr += ['sort' => 'Sort'];
        $attr += ['status' => 'Status'];

        return $attr;
    }

    public function rules()
    {
        $req = [];
        foreach (config('translatable.locales') as $locale) {
            $req += [$locale.'.title' => 'required'];
            $req += [$locale . '.sub_title' => 'required'];
            $req += [$locale.'.description' => 'nullable'];
            $req += [$locale.'.meta_title' => 'nullable'];
            $req += [$locale.'.meta_description' => 'nullable'];
            $req += [$locale.'.meta_key' => 'nullable'];
        }
        $req += ['status' => 'nullable'];
        // $req += ['image' => 'required', 'image', 'mimes:png,jpg', 'max:4000'];
        $req += ['category' => 'required'];
        $req += ['tags' => 'required'];
        $req += ['sort' => 'nullable', 'numeric', 'integer', 'min:1'];
        $method = $this->getMethod();
        if ($method == 'POST') {
            // If POST, image is required
            $req = array_merge($req, [
                'image.*' => 'required|image|mimes:png,jpg|max:4000',
            ]);
        } elseif ($method == 'PUT') {
            // If PUT, image is nullable
            $req = array_merge($req, [
                'image.*' => 'nullable|image|mimes:png,jpg|max:4000',
            ]);
        }
        return $req;
    }

    public function getSanitized()
    {
        $data = $this->validated();
        $data['status'] = isset($data['status']) ? true : false;
        foreach (config('translatable.locales') as $locale) {
            $data[$locale]['slug'] = $this->generateSlug($data[$locale]['title']);
            if (request()->isMethod('POST')) {
                $data['created_by'] = @auth()->guard('admin')->user()->id;
            } else {
                $data['updated_by'] = @auth()->guard('admin')->user()->id;
            }
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
