<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index() : JsonResponse {
        $users = User::orderBy('id', 'desc')->paginate(2);

        return response()->json([
            'status' => true,
            'users' => $users,
        ], 200);
    }

    public function show(User $user) : JsonResponse {
        return response()->json([
            'status' => true,
            'user' => $user,
        ], 200);
    }

    public function store(UserRequest $request) : JsonResponse {
        DB::beginTransaction();

        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Usuário cadastrado com sucesso!',
                'user' => $user,
            ], 201);
        } catch (Exception $e) {
            DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => 'Falha ao criar usuário',
                'error' => $e->getMessage(),
            ], 400);
        }
    }

    public function update(UserRequest $request, User $user) : JsonResponse {
        DB::beginTransaction();

        try {
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Usuário editado com sucesso!',
                'user' => $user,
            ], 200);
        } catch(Exception $e) {
            DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => 'Falha ao editar usuário',
                'error' => $e->getMessage(),
            ], 400);
        }
    }

    public function destroy(User $user) : JsonResponse {
        try {
            $user->delete();
            
            return response()->json([
                'status' => true,
                'message' => 'Usuário excluído com sucesso!',
                'user' => $user,
            ], 200);

        } catch(Exception $e) {
            DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => 'Falha ao excluir usuário',
                'error' => $e->getMessage(),
            ], 400);
        }
    }
}