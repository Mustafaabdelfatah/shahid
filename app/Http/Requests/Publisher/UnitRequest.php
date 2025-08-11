<?php

namespace App\Http\Requests\Publisher;

use Locale;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Lang;
use Illuminate\Foundation\Http\FormRequest;

class UnitRequest extends FormRequest
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
            $attr += [$locale.'.meta_title' => 'Meta title '.Lang::get($locale)];
            $attr += [$locale.'.meta_description' => 'Meta description '.Lang::get($locale)];
            $attr += [$locale.'.meta_key' => 'Meta key '.Lang::get($locale)];
        }
        $attr += ['price' => 'price'];
        $attr += ['service_charges' => 'service charges'];
        $attr += ['category_id' => 'Category'];
        $attr += ['size' => 'Size'];
        $attr += ['plan' => 'plan'];
        $attr += ['code' => 'Code'];
        $attr += ['approve' => 'Approve'];
        $attr += ['gates' => 'gates'];
        $attr += ['rooms' => 'Rooms'];
        $attr += ['bathroom' => 'Bathroom'];
        $attr += ['floor' => 'Floor'];
        $attr += ['feature' => 'Feature'];
        $attr += ['location' => 'Location'];
        $attr += ['type' => 'Type'];
        $attr += ['image[]' => 'Images'];
        $attr += ['video' => 'Video'];

        return $attr;
    }

    public function rules()
    {
        $req = [];

        // For each locale defined in the config, define rules for translatable fields
        foreach (config('translatable.locales') as $locale) {
            $req = array_merge($req, [
                $locale.'.title' => 'required',
                $locale.'.description' => 'required|min:120',
                $locale.'.meta_title' => 'nullable',
                $locale.'.meta_description' => 'nullable',
                $locale.'.meta_key' => 'nullable',
            ]);
        }

        // Other non-translatable fields
        $req = array_merge($req, [
            'price' => 'required|numeric',
            'service_charges' => 'nullable|numeric',
            'properties' => 'nullable|array|exists:properties,id',
            'Furnished' => ['nullable', 'string', 'min:1'],
            'Finishing_type' => ['nullable', 'string', 'min:1'],
            'properties.*' => 'nullable|integer|exists:properties,id',
            'code' => 'nullable|string',
            // 'project_id' => 'nullable|integer|exists:projects,id',
            'category_id' => 'required|integer|exists:categories,id',
            // 'country_id' => ['required', 'integer', 'exists:countries,id'],
            // 'state_id' => ['required', 'integer', 'exists:states,id'],
            // 'city_id' => ['required', 'integer', 'exists:cities,id'],
            'district_id' => ['nullable'],
            'admin_id' => ['nullable', 'integer', 'exists:admins,id'],
            'size' => 'required|numeric',
            'rooms' => 'nullable|numeric',
            'bathroom' => 'nullable|numeric',
            'floor' => 'nullable|numeric',
            'status' => 'nullable|string',
            'approve' => 'nullable|string',
            'feature' => 'nullable|string',
            'location' => 'nullable|string',
            'gates' => 'nullable|array',
            'gates.*' => 'exists:gates,id',
            'type' => 'required|string|in:rent,sale',
            'paying' => 'required|string|in:Installment,cash',
        ]);

        $method = $this->getMethod();
        if ($method == 'POST') {
            // If POST, image is required
            $req = array_merge($req, [
                'plan' => 'nullable|image',
                'image.*' => 'required|image',
                'video_unit' => 'nullable|mimetypes:video/mp4,video/x-msvideo,video/quicktime|max:200000',
            ]);
        } elseif ($method == 'PUT') {
            // If PUT, image is nullable
            $req = array_merge($req, [
                'plan' => 'nullable|image',
                'image.*' => 'nullable|image',
                'video_unit' => 'nullable|mimetypes:video/mp4,video/x-msvideo,video/quicktime|max:200000',

            ]);
        }

        return $req;
    }

    public function getSanitized()
    {
        $data = $this->validated();

        $data['approve'] = isset($data['approve']) ? true : false;
        if (auth()->check()) {
            $user = auth()->user();

            // Debugging: Log user type
            Log::info('User Type:', ['type' => $user->type]);

            $userType = strtolower($user->role);

            if ($userType === 'broker' || $userType === 'agency') {
                $data['approve'] = 1;
            }
            $data['user_id'] = $user->id;
        } else {
            // Handle the case where the user is not authenticated
            $data['user_id'] = null; // or any other default value you need
        }
        // $data['user_id'] = @auth()->user()->id;
        foreach (config('translatable.locales') as $locale) {
            $data[$locale]['slug'] = $this->generateSlug($data[$locale]['title']);
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
