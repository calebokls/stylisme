<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ManequinaRequest extends FormRequest
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
             'files'=>$this->isMethod('post')? ['required']:[],
             'files.*'=>$this->isMethod('post')? ['file','mimetypes:image/jpeg,image/png,video/mp4,video/quicktime,video/x-msvideo']:[],
            'description'=>['required','min:3']
        ];
    }
}
