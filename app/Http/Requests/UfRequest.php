<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UfRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'sigla' => ['required','unique:tb_uf','max:3'],
            'nome' => ['required'],
            'status' => ['required'],
        ];
    }

    public function message()
    {
        return [
            'sigla.required' => 'O chave \"sigla\" é obrigatório.',
            'sigla.unique' => 'Não foi possível cadastrar, pois já existe um registro de UF com a mesma sigla.',
            'sigla.max' => 'A chave UF deve ter no máximo 3 caracteres.',
            'nome.required' => 'O nome da UF é obrigatório.',
            'status.required' => 'O status da UF é obrigatório.',
        ];
    }

    public function failedValidation($validator)
    {
        throw new HttpResponseException(response()->json([
            'mensagem' => $validator->messages()->first(),
            'status' => 503
        ], 503));
    }
}
