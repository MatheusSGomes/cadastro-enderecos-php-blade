<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PessoaRequest extends FormRequest
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
            'nome' => ['required'],
            'sobrenome' => ['required'],
            'idade' => ['required', 'integer'],
            'login' => ['required'],
            'senha' => ['required'],
            'status' => ['required', 'integer'],
            'enderecos' => ['required', 'array']
        ];
    }

    public function messages()
    {
        return [
            'nome.required' => 'O atributo \'nome\' é obrigatório',
        ];
    }
}
