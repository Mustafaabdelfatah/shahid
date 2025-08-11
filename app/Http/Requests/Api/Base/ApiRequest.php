<?php

namespace App\Http\Requests\Api\Base;

use Locale;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Lang;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;

abstract class ApiRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    abstract public function authorize();

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    abstract public function rules();

    protected function failedValidation(Validator $validator)
{
    $errors = (new ValidationException($validator))->errors();

    if (!empty($errors)) {
        $transformedErrors = [];

        foreach ($errors as $field => $messages) {
            // Retrieve error messages in both Arabic and English
            $arabicMessages = [];
            $englishMessages = [];

            foreach ($messages as $message) {
                // Load the error messages for each locale
                $localeMessages = [];

                foreach (config('translatable.locales') as $locale) {
                    // Set the locale for translation
                    App::setLocale($locale);

                    // Translate the error message for the current locale
                    $localeMessages[$locale] = __($message);
                }

                $arabicMessages[] = $localeMessages['ar'];
                $englishMessages[] = $localeMessages['en'];
            }

            $transformedErrors[] = [
                'field' => $field,
                'arabic_message' => $arabicMessages,
                'english_message' => $englishMessages
            ];
        }

        throw new HttpResponseException(
            response()->json(
                [
                    'status' => 'error',
                    'errors' => $transformedErrors
                ],
                JsonResponse::HTTP_BAD_REQUEST
            )
        );
    }
}

    
}

    
    
