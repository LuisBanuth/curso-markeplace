<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
        return [
            'name'=>            'required',
            'description'=>     'required|min:10|max:100',
        ];
    }

    public function messages() {
        return [
            'min' => 'Campo deve ter no mínimo :min caracteres',
            'max' => 'Camo deve ter no máximo :max caracteres',
            'required' => 'Campo obrigatório'
        ];
    }
}
