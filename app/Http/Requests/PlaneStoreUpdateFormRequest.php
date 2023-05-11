<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlaneStoreUpdateFormRequest extends FormRequest
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
            'qtd_passengers'    => 'required|integer',
            'class'             => 'required|in:economic,luxury', //pode validar pegando o indice do array que contem na tabela e fazer um implode
            'brand_id'          => 'required|exists:brands,id',
        ];
    }

    public function messages()
    {
        return [
            'qtd_passengers.required' => 'O campo Quantidade de passageiros é obrigatório.',
            'qtd_passengers.integer' => 'O campo Quantidade de passageiros deve ser um número inteiro.',
            'class.required' => 'O campo Classe é obrigatório.',
            'class.in' => 'O valor do campo Classe é inválido.',
            'brand_id.required' => 'O campo Companhia aérea é obrigatório.',
            'brand_id.exists' => 'O valor do campo Companhia aérea é inválido.',
        ];
    }
}
