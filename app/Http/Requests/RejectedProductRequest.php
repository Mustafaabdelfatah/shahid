<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Lang;

class RejectedProductRequest extends FormRequest
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
            $attr += [$locale.'.message' => 'Message '.Lang::get($locale)];
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
        foreach (config('translatable.locales') as $locale) {
            $req += [$locale.'.message' => 'required', 'string'];
        }
        $req += ['product_id' => ['required', 'integer', 'exists:products,id']];
        $req += ['user_id' => ['required', 'integer', 'exists:users,id']];
        $req += ['created_by' => ['nullable']];
        $req += ['updated_by' => ['nullable']];

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
