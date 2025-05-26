<?php

namespace App\Http\Requests\Cliente;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
        $clienteId = $this->route('cliente'); 

        return [
            'cpf' => [
                'required',
                'string',
                'max:11',
                'unique:clientes,cpf' . ($clienteId ? ',' . $clienteId : ''),
            ],
            'nome' => 'required|string|max:150',
            'datanasc' => 'required|date',
            'sexo' => 'required|in:M,F',
            'endereco' => 'required|string|max:255',
            'estado' => 'required|string|size:2',
            'cidade' => 'required|string|max:100',
        ];
    }

    public function messages(): array
    {
        return [
            'cpf.required' => 'O CPF é obrigatório.',
            'cpf.size' => 'O CPF deve ter exatamente 11 caracteres.',
            'cpf.unique' => 'Este CPF já está cadastrado.',
            'nome.required' => 'O nome é obrigatório.',
            'nome.max' => 'O nome pode ter no máximo 150 caracteres.',
            'datanasc.required' => 'A data de nascimento é obrigatória.',
            'datanasc.date' => 'A data de nascimento deve ser uma data válida.',
            'sexo.required' => 'O sexo é obrigatório.',
            'sexo.in' => 'O sexo deve ser "M" ou "F".',
            'endereco.required' => 'O endereço é obrigatório.',
            'endereco.max' => 'O endereço pode ter no máximo 255 caracteres.',
            'estado.required' => 'O estado é obrigatório.',
            'estado.size' => 'O estado deve ter exatamente 2 caracteres.',
            'cidade.required' => 'A cidade é obrigatória.',
            'cidade.max' => 'A cidade pode ter no máximo 100 caracteres.',
        ];
    }
}
