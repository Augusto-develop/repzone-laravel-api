<?php

namespace App\Http\Requests\Cidade;

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
        return [
            'estado' => 'required|string|max:2',
            'nome' => 'required|string|max:100',
        ];
    }

    public function messages(): array
    {
        return [
            'estado.required' => 'O estado é obrigatório.',
            'estado.max' => 'O estado pode ter no máximo 2 caracteres.',
            'nome.required' => 'O nome da cidade é obrigatório.',
            'nome.max' => 'O nome da cidade pode ter no máximo 100 caracteres.',
        ];
    }
}
