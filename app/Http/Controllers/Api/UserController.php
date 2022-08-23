<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        return response(User::all());
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response(['message' => 'Dados inválidos!']);
        }
        
        $user = new User([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => $request->get('password')
        ]);

        if ($user->save()) {
            return response(['message' => 'Usuário criado com sucesso!']);
        }

        return response(['message' => 'Erro ao criar usuário!']);
    }

    public function show($id)
    {
        $user = User::query()
            ->whereHas('address')
            ->find($id);

        if ($user) {
            return response($user);
        }

        return response(['message' => 'Usuário não encontrado.']);
    }

    public function update(Request $request, $id)
    {
        $user = User::query()
            ->whereHas('address')
            ->find($id);

        if ($user) {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required',
                'password' => 'required'
            ]);
    
            if ($validator->fails()) {
                return response(['message' => 'Dados inválidos!']);
            }

            $hasUpdated = $user->update([
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'password' => $request->get('password')
            ]);

            if ($hasUpdated) {
                return response(['message' => 'Usuário atualizado com sucesso!']);
            }
        }

        return response(['message' => 'Usuário não encontrado']);
    }

    public function destroy($id)
    {
        $user = User::query()
        ->whereHas('address')
        ->find($id);

        if ($user) {

            if ($user->delete()) {
                return response(['message' => 'Usuário removido com sucesso!']);
            }
        }

        return response(['message' => 'Usuário não encontrado']);
    }
}