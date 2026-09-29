<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class LivroRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function failedValidation(Validator $validator)
    {
        $response = response()->json([
            'status' => false,
            'errors' => $validator->errors(),
        ], 422);

        throw new HttpResponseException($response);
    }

    /**
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'titulo' => 'required|string|max:255',
            'autor' => 'required|string|max:255',
            'genero' => 'required|string|max:255',
            'numero_paginas' => 'required|integer|min:1',
            'avaliacao' => 'required|numeric|between:0,10',
            'data_lancamento' => 'required|date',
        ];
    }

    public function messages(): array
    {
        return [
            'titulo.required' => 'O campo título é obrigatório.',
            'titulo.string' => 'O campo título deve ser uma string.',
            'titulo.max' => 'O campo título não pode ter mais de :max caracteres.',
            'autor.required' => 'O campo autor é obrigatório.',
            'autor.string' => 'O campo autor deve ser uma string.',
            'autor.max' => 'O campo autor não pode ter mais de :max caracteres.',
            'genero.required' => 'O campo gênero é obrigatório.',
            'genero.string' => 'O campo gênero deve ser uma string.',
            'genero.max' => 'O campo gênero não pode ter mais de :max caracteres.',
            'numero_paginas.required' => 'O campo número de páginas é obrigatório.',
            'numero_paginas.integer' => 'O campo número de páginas deve ser um número inteiro.',
            'numero_paginas.min' => 'O campo número de páginas deve ser no mínimo :min.',
            'avaliacao.required' => 'O campo avaliação é obrigatório.',
            'avaliacao.numeric' => 'O campo avaliação deve ser numérico.',
            'avaliacao.between' => 'O campo avaliação deve estar entre :min e :max.',
            'data_lancamento.required' => 'O campo data de lançamento é obrigatório.',
            'data_lancamento.date' => 'O campo data de lançamento deve ser uma data válida.',
        ];
    }
}