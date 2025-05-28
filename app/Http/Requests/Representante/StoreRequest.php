<?php

namespace App\Http\Requests\Representante;

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
            'nome' => 'required|string|max:150'  
        ];
    }

    public function messages(): array
    {
        return [           
            'nome.required' => 'O nome é obrigatório.',
            'nome.max' => 'O nome pode ter no máximo 150 caracteres.',
        ];
    }
}
