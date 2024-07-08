<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MarquesRequest extends FormRequest
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
            'name'=>['required','min:3'],
            'logo'=>['image','max:2000'],
            'description'=>['min:8'],
            'slogan'=>['min:4'],
            'propertie'=>['array','exists:properties,id','required'],
            'user_id'=>['exists:users,id']
        ];
    }
}
