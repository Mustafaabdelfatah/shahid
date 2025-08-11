<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Lang;

class CityRequest extends FormRequest
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
        $attr += ['status' => 'Status'];
        $attr += ['sort' => 'Sort'];
        $attr += ['country_id' => 'Country Name'];
        $attr += ['state_id' => 'State Name'];

        return $attr;
    }

    public function rules()
    {
        $req = [];
        foreach (config('translatable.locales') as $locale) {
            $req += [$locale.'.title' => 'required', 'string'];
        }
        $req += ['status' => 'nullable'];
        $req += ['country_id' => ['required', 'integer', 'exists:countries,id']];
        $req += ['state_id' => ['required', 'integer', 'exists:states,id']];

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
