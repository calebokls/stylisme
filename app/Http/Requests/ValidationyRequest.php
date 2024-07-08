<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidationyRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'nom'=>['required','min:3','string'],
            'prenom'=>['required','min:3','string'],
            'photo'=>['max:2000'],
            'piece'=>['required'],
            'validary'=>['boolean'],
            'user_id'=>['exists:users,id'],
            'image_data'=>['required']
        ];
    }
}
