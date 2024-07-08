<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ModelyRequest extends FormRequest
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
        $rules =  [
            'name'=>['required','min:3'],
            'price'=>['required','integer','min:4'],
            'description'=>['required','min:8'],
            'genre'=>['required'],
            'user_id'=>['exists:users,id'],
            'marque'=>['exists:marques,id'],
            'taille'=>['required','array','exists:tailles,id'],
            ];

            if(request()->isMethod('PUT') || request()->isMethod('PATCH'))
            {
                $rules['pictures'] = ['array'];
                $rules['pictures.*']= ['image','max:2000'];
            }elseif(request()->isMethod('POST'))
            {
                $rules['pictures'] = ['required','array'];
                $rules['pictures.*']= ['image','max:2000'];
            }

            return $rules;
    }
}
