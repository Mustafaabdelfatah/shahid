<?php

namespace App\Http\Requests\Api\Unit;

use Locale;
use Illuminate\Support\Str;
use App\Helpers\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Lang;
use App\Http\Requests\Api\Base\ApiRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UnitRequest extends ApiRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
    protected function failedValidation(Validator $validator)
    {
        $message = $validator->errors()->messages();
        // Use the custom ApiResponse helper to format the response
        $response = ApiResponse::apiResponse(
            JsonResponse::HTTP_UNPROCESSABLE_ENTITY, // HTTP status code for validation errors
            $message,
            []
        );
        // Throw an HttpResponseException with the formatted response
        throw new HttpResponseException($response);
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
        }
        $attr += ['price' => 'price'];
        $attr += ['service_charges' => 'service charges'];
        $attr += ['category_id' => 'Category'];
        $attr += ['size' => 'Size'];
        $attr += ['code' => 'Code'];
        $attr += ['approve' => 'Approve'];
        $attr += ['sort' => 'Sort'];
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
        $rules = [];

        foreach (config('translatable.locales') as $locale) {
            $rules["$locale.title"] = 'required|string';
            $rules["$locale.description"] = 'nullable|string';
        }

        $rules['price'] = 'required|numeric';
        $rules['service_charges'] = 'nullable|numeric';
        $rules['properties.*'] = 'required|integer|exists:properties,id';
        $rules['category_id'] = 'required|integer|exists:categories,id';
        // $rules['country_id'] = 'required|integer|exists:countries,id';
        // $rules['state_id'] = 'required|integer|exists:states,id';
        // $rules['city_id'] = 'required|integer|exists:cities,id';
        $rules['district_id'] = 'nullable|integer|exists:districts,id';
        $rules['size'] = 'required|numeric';
        $rules['rooms'] = 'nullable|numeric';
        $rules['bathroom'] = 'nullable|numeric';
        $rules['floor'] = 'nullable|numeric';
        $rules['location'] = 'nullable|string';
        $rules['type'] = 'required|string|in:rent,sale';
        $rules['paying'] = 'required|string|in:Installment,cash';
        $rules['image.*'] = 'required|image';
        $rules['video'] = 'nullable|mimetypes:video/mp4,video/x-msvideo,video/quicktime|max:51200';
        $rules['approve'] = 'nullable';
        return $rules;
    }


    public function getSanitized()
    {
        $data = $this->validated();
        $data['user_id'] = auth()->id();
        $data['approve'] = 1;
        // foreach (config('translatable.locales') as $locale) {
        //     $data['translations'][$locale]['slug'] = $this->generateSlug($data['translations'][$locale]['title']);
        // }
        return $data;
    }
    private function generateSlug($title)
    {
        return Str::slug($title);
    }
}
