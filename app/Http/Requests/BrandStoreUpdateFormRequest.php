<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class BrandStoreUpdateFormRequest extends FormRequest
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
        // $id = Request::get('id');
        return [
            'name' => "required|min:3|max:190|unique:brands,name,{$id},id"
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'O campo nome é obrigatório.',
            'name.min' => 'O campo nome precisa de pelo menos 3 caracteres.',
            'name.max' => 'O campo nome pode ter no máximo 190 caracteres.',
            'name.unique' => 'O nome já está em uso.',
        ];
    }
}
