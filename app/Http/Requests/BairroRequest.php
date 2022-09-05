<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class BairroRequest extends FormRequest
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
            'codigo_municipio' => ['required', 'integer'],
            'nome' => ['required'],
            'status' => ['required', 'integer']
        ];
    }

    public function messages()
    {
        return [
            'codigo_municipio.required' => 'O atributo \'codigo_municipio\' é obrigatório.',
            'codigo_municipio.integer' => 'O atributo \'codigo_municipio\' precisa ser do tipo inteiro.',
            'nome.required' => 'O atributo \'nome\' é obrigatório.',
            'status.required' => 'O atributo \'status\' é obrigatório'
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
