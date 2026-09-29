<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LivroRequest;
use App\Models\Livro;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class LivroController extends Controller
{
    public function index(): JsonResponse
    {
        $livros = Livro::orderBy('id', 'desc')->paginate(2);

        return response()->json([
            'status' => true,
            'livros' => $livros,
        ], 200);
    }

    public function show(Livro $livro): JsonResponse
    {
        return response()->json([
            'status' => true,
            'livro' => $livro,
        ], 200);
    }

    public function store(LivroRequest $request): JsonResponse
    {
        DB::beginTransaction();

        try {
            $livro = Livro::create([
                'titulo' => $request->titulo,
                'autor' => $request->autor,
                'genero' => $request->genero,
                'numero_paginas' => $request->numero_paginas,
                'avaliacao' => $request->avaliacao,
                'data_lancamento' => $request->data_lancamento,
            ]);

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Livro cadastrado com sucesso!',
                'livro' => $livro,
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => 'Falha ao criar livro',
                'error' => $e->getMessage(),
            ], 400);
        }
    }

    public function update(LivroRequest $request, Livro $livro): JsonResponse
    {
        DB::beginTransaction();

        try {
            $livro->update([
                'titulo' => $request->titulo,
                'autor' => $request->autor,
                'genero' => $request->genero,
                'numero_paginas' => $request->numero_paginas,
                'avaliacao' => $request->avaliacao,
                'data_lancamento' => $request->data_lancamento,
            ]);

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Livro editado com sucesso!',
                'livro' => $livro,
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => 'Falha ao editar livro',
                'error' => $e->getMessage(),
            ], 400);
        }
    }

    public function destroy(Livro $livro): JsonResponse
    {
        try {
            $livro->delete();

            return response()->json([
                'status' => true,
                'message' => 'Livro excluído com sucesso!',
                'livro' => $livro,
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => 'Falha ao excluir livro',
                'error' => $e->getMessage(),
            ], 400);
        }
    }
}