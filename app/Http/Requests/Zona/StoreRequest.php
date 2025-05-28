<?php

namespace App\Http\Requests\Zona;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'representante_id' => 'required|uuid|exists:representantes,id',
            'cidade_id' => [
                'required',
                'uuid',
                'exists:cidades,id',
                Rule::unique('cidade_representante')->where(function ($query) {
                    return $query->where('representante_id', $this->input('representante_id'));
                }),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'representante_id.required' => 'O representante é obrigatório.',
            'representante_id.uuid' => 'O ID do representante deve ser um UUID válido.',
            'representante_id.exists' => 'O representante selecionado não existe.',
            'cidade_id.required' => 'A cidade é obrigatória.',
            'cidade_id.uuid' => 'O ID da cidade deve ser um UUID válido.',
            'cidade_id.exists' => 'A cidade selecionada não existe.',
            'cidade_id.unique' => 'Este representante já está cadastrado para esta cidade.',
        ];
    }
}
