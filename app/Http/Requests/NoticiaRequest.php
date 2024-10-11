<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NoticiaRequest extends FormRequest
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
            'data' => ['required'],
            'autor' => ['required'],
            'titulo' => ['required'],
            'descricao' => ['required'],
            'categoria_id' => ['required', 'exists:categoria,id']
        ];
    }

    public function messages(): array
    {
        return [
            'data.required' => 'A data deve ser informada',
            'autor.required' => 'O autor deve ser informado',
            'titulo.required' => 'O título deve ser informado',
            'descricao.required' => 'A descrição deve ser informada',
            'categoria_id.required' => 'A categoria deve ser informada',
            'categoria_id.exists' => 'A categoria não existe'
        ];
    }    

}
