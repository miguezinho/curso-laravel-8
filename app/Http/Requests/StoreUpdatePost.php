<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule as ValidationRule;

class StoreUpdatePost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->segment(3);

        $rules =  [
            'title' => ['required', 'min:3', 'max:160', ValidationRule::unique('posts')->ignore($id)],
            'content' => ['nullable', 'min:5', 'max: 10000'],
            'image' => ['required', 'image'],
        ];

        if ($this->method() == 'PUT') {
            $rules['image'] = ['nullable', 'image'];
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'min' => 'Esse campo deve ter no mínimo :min caracteres',
            'max' => 'Esse campo deve ter no máximo :max caracteres',
            'required' => 'Esse campo é obrigatório',
        ];
    }
}
