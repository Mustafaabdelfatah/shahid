<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Lang;
use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
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
            $attr += [$locale.'.description' => 'Description'.Lang::get($locale)];

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
            $req += [$locale.'.description' => 'nullable'];
        }
        $req += ['status' => 'nullable'];
        $req += ['email' => 'nullable|string|max:100'];
        $req += ['phone' => 'nullable|string|max:100'];
        $req += ['address' => 'nullable|string|max:100'];
        $req += ['facebook' => 'nullable|string|max:100'];
        $req += ['category_service_id' => 'required|exists:category_services,id'];
        $req += ['features' => 'nullable|array|exists:features,id'];
        $req += ['features.*' => 'nullable|integer|exists:features,id'];
        $req += ['twitter' => 'nullable|string|max:100'];
        $req += ['instagram' => 'nullable|string|max:100'];
        $req += ['map' => 'nullable|string'];
        $req += ['sort' => 'nullable'];
        $method = $this->getMethod();
        if ($method == 'POST') {
            // If POST, image is required
            $req = array_merge($req, [
                'image.*' => 'required|image',
            ]);
        } elseif ($method == 'PUT') {
            // If PUT, image is nullable
            $req = array_merge($req, [
                'image.*' => 'nullable|image',
            ]);
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
