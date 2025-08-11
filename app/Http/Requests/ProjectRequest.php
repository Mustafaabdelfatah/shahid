<?php

namespace App\Http\Requests;

use Locale;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Lang;
use Illuminate\Foundation\Http\FormRequest;

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
    public function attributes(): array
    {
        $attr = [];
        foreach (config('translatable.locales') as $locale) {
            $attr += [
                "{$locale}.title" => "Title " . Lang::get($locale),
                "{$locale}.description" => "Description " . Lang::get($locale),
            ];
        }
        $attr += [
            'status' => 'Status',
            'address' => 'Address',
            'image' => 'Images',
            'image.*' => 'Each image',
            'user_id' => 'Developer name',
        ];

        return $attr;
    }
    public function rules(): array
    {
        $req = [];

        // For each locale defined in the config, define rules for translatable fields
        foreach (config('translatable.locales') as $locale) {
            $req += [
                "{$locale}.title" => 'required|string|max:255',
                "{$locale}.description" => 'nullable|string',
            ];
        }

        // Other non-translatable fields
        $req += [
            'construction_status' => ['nullable'],
            'method_payment' => ['nullable'],
            'finish_type' => ['nullable', 'string', 'in:core_and_shell,half_finished,fully_finished'],
            'user_id' => ['nullable', 'exists:users,id'],
            'price' => ['required', 'numeric'],
            'spaces' => ['nullable', 'string'],
            'map' => ['nullable'],
            'delivery_date' => ['nullable'],
            'status' => ['nullable'],
            'finance' => ['nullable'],
            'address' => ['nullable'],
            'properties.*' => 'nullable|integer|exists:properties,id',
        ];
        $method = $this->getMethod();
        if ($method == 'POST') {
            // If POST, image is required
            $req += [
                'image' => 'nullable|array',
                'image.*' => 'nullable|image',
                'cover' => 'nullable|image',
            ];
        } elseif ($method == 'PUT') {
            // If PUT, image is nullable
            $req += [
                'image' => 'nullable|array',
                'image.*' => 'nullable|image',
                'cover' => 'nullable|image',

            ];
        }

        return $req;
    }


    public function getSanitized()
    {
        $data = $this->validated();
        $data['status'] = isset($data['status']) ? true : false;
        $data['finance'] = isset($data['finance']) ? true : false;

        // foreach (config('translatable.locales') as $locale) {
        //     $data[$locale]['slug'] = $this->generateSlug($data[$locale]['title']);
        // }
        // if (request()->isMethod('POST')) {
        //     $data['created_by'] = @auth()->guard('admin')->user()->id;
        // }
        return $data;
    }

    private function generateSlug($title)
    {
        $slug = Str::slug($title);
        $slug = preg_replace('/[^a-z0-9-]/', '', $slug);

        return $slug;
    }
}
