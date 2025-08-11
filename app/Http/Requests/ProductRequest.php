<?php

namespace App\Http\Requests;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Lang;
use Illuminate\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            $attr += [$locale . '.title' => 'Title ' . Lang::get($locale)];
            $attr += [$locale . '.description' => 'Description ' . Lang::get($locale)];
            $attr += [$locale . '.meta_title' => 'Meta title ' . Lang::get($locale)];
            $attr += [$locale . '.meta_description' => 'Meta description ' . Lang::get($locale)];
            $attr += [$locale . '.meta_key' => 'Meta key ' . Lang::get($locale)];
        }
        $attr += ['price' => 'price'];
        $attr += ['service_charges' => 'service charges'];
        $attr += ['category_id' => 'Category'];
        $attr += ['size' => 'Size'];
        $attr += ['status' => 'Status'];
        $attr += ['main_category' => 'main_category'];
        $attr += ['rooms' => 'Rooms'];
        $attr += ['bathroom' => 'Bathroom'];
        $attr += ['floor' => 'Floor'];
        $attr += ['primum' => 'primum'];
        $attr += ['building_number' => 'building_number'];
        $attr += ['location' => 'Location'];
        $attr += ['type' => 'Type'];
        $attr += ['image[]' => 'Images'];
        $attr += ['video' => 'Video'];
        $attr += ['plan' => 'Plan'];
        $attr += ['project_id' => 'Project'];
        $attr += ['state_id' => 'State'];
        $attr += ['user_id' => 'user_id'];
        $attr += ['city_id' => 'City'];
        $attr += ['gates_id' => 'Gates'];
        $attr += ['district_id' => 'District'];

        return $attr;
    }

    public function rules()
    {
        $req = [];

        // For each locale defined in the config, define rules for translatable fields
        foreach (config('translatable.locales') as $locale) {
            $req = array_merge($req, [
                $locale . '.title' => 'nullable',
                $locale . '.description' => 'nullable|min:120',
                $locale . '.meta_title' => 'nullable',
                $locale . '.meta_description' => 'nullable',
                $locale . '.meta_key' => 'nullable',
            ]);
        }

        // Other non-translatable fields
        $req = array_merge($req, [
            'price' => 'required|numeric',
            'finance' => 'nullable|string',
            'service_charges' => 'nullable|numeric',
            'properties' => 'nullable|array|exists:properties,id',
            'Furnished' => ['nullable', 'string', 'min:1'],
            'Finishing_type' => ['nullable', 'string', 'min:1'],
            'properties.*' => 'nullable|integer|exists:properties,id',
            'code' => 'nullable|string',
            'user_id' => 'nullable|integer|exists:users,id',
            // 'project_id' => 'nullable|integer|exists:projects,id',
            'category_id' => 'required|integer|exists:categories,id',
            // 'country_id' => ['required', 'integer', 'exists:countries,id'],
            // 'state_id' => ['required', 'integer', 'exists:states,id'],
            // 'city_id' => ['required', 'integer', 'exists:cities,id'],
            'gates_id' => ['nullable', 'integer', 'exists:gates,id'],
            'district_id' => ['nullable'],
            'admin_id' => ['nullable', 'integer', 'exists:admins,id'],
            'size' => 'required|numeric',
            'rooms' => 'nullable|numeric',
            'bathroom' => 'nullable|numeric',
            'floor' => 'nullable|numeric',
            'status' => 'nullable|string',
            'approve' => 'nullable|string',
            'primum' => 'nullable|string',
            'building_number' => 'nullable|string',
            'location' => 'nullable|string',
            'gates' => 'nullable|array',
            'gates.*' => 'exists:gates,id',
            'type' => 'required|string|in:rent,sale',
            'paying' => 'required|string|in:Installment,cash',
            'main_category' => 'nullable|string|in:Administrative,Residential,Commercial',
            'delivery_date' => 'nullable|digits:4|integer|min:2025',
            'fawry' => 'nullable|string',
            'notes' => 'nullable|string',
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
    public function withValidator(Validator $validator)
    {
        $validator->after(function ($validator) {
            // Check if both ar.title and en.title are empty
            if (empty($this->ar['title']) && empty($this->en['title'])) {
                $validator->errors()->add('locales', __('At least one title must be provided in Arabic or English'));
            }
            if (empty($this->ar['description']) && empty($this->en['description'])) {
                $validator->errors()->add('locales', __('At least one description must be provided in Arabic or English'));
            }
        });
    }

    public function getSanitized()
    {
        $data = $this->validated();

        $data['status'] = isset($data['status']) ? true : false;
        $data['approve'] = isset($data['approve']) ? true : false;
        $data['finance'] = isset($data['finance']) ? true : false;
        $data['fawry'] = isset($data['fawry']) ? true : false;
        $data['primum'] = isset($data['primum']) ? true : false;

        $data['for_sale'] = 0;

        $data['status'] = 1;
        $data['approve'] = 1;

        foreach (config('translatable.locales') as $locale) {
            $data[$locale]['slug'] = $this->generateSlug($data[$locale]['title']);
        }
        if (request()->isMethod('POST')) {
            $data['created_by'] = @auth()->guard('admin')->user()->id;
            $data['admin_id'] = @auth()->guard('admin')->user()->id;
        } else {
            $data['updated_by'] = @auth()->guard('admin')->user()->id;
        }
        // Translate automatically from Arabic to other languages
        foreach (config('translatable.locales') as $locale) {
            if ($locale !== 'ar' && empty($data[$locale]['title'])) {
                $data[$locale]['title'] = $this->translateAutomatically($data['ar']['title'], $locale);
                $data[$locale]['description'] = $this->translateAutomatically($data['ar']['description'], $locale);
            }
        }

// Automatic translation from English to Arabic if Arabic is empty
        if (empty($data['ar']['title']) && !empty($data['en']['title'])) {
            $data['ar']['title'] = $this->translateAutomatically($data['en']['title'], 'ar');
            $data['ar']['description'] = $this->translateAutomatically($data['en']['description'], 'ar');
        }
        return $data;
    }

    private function generateSlug($title)
    {
        $slug = Str::slug($title);
        $slug = preg_replace('/[^a-z0-9-]/', '', $slug);

        return $slug;
    }
    public function translateAutomatically($text, $locale)
    {
        // Avoid sending empty text for translation
        if (empty($text)) {
            return '';
        }

        $sourceLang = $locale === 'ar' ? 'en' : 'ar';

        $response = Http::get('https://api.mymemory.translated.net/get', [
            'q' => $text,
            'langpair' => "{$sourceLang}|{$locale}",
        ]);

        if ($response->successful() && isset($response->json()['responseData']['translatedText'])) {
            return $response->json()['responseData']['translatedText'];
        }

        return $text; // Return the original text if translation fails
    }
}
