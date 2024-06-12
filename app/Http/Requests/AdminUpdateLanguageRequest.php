<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminUpdateLanguageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize() : bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules() : array
    {
        $languageId = $this->route("language");
        
        return [
            "language" => ["required", "string", "unique:languages,language,".$languageId, "max:255"],
            "name" => ["required", "string", "max:255"],
            "slug" => ["required", "string", "max:255", "unique:languages,slug,".$languageId],
            "default" => ["required", "boolean"],
            "status" => ["required", "boolean"],
        ];
    }
}
