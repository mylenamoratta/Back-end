<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StateController extends Controller
{
    public function index()
    {
        return response(State::all());
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:50'
        ]);

        if ($validator->fails()) {
            return response(['message' => 'Dados inválidos!']);
        }

        $state = new State([
            'name' => $request->get('name')
        ]);

        if ($state->save()) {
            return response(['message' => 'Estado criado com sucesso!']);
        }

        return response(['message' => 'Erro ao criar estado!']);
    }

    public function show($id)
    {
        $state = State::find($id);

        if ($state) {
            return response($state);
        }

        return response(['message' => 'Estado não encontrado!']);
    }

    public function update(Request $request, $id)
    {
        $user = State::find($id);

        if ($user) {

            $validator = Validator::make($request->all(), [
                'name' => 'required|max:50'
            ]);
    
            if ($validator->fails()) {
                return response(['message' => 'Dados inválidos!']);
            }

            $hasUpdated = $user->update([
                'name' => $request->get('name')
            ]);

            if ($hasUpdated) {
                return response(['message' => 'Estado atualizado com sucesso!']);
            }
        }

        return response(['message' => 'Estado não encontrado!']);
    }

    public function destroy($id)
    {
        $state = State::find($id);

        if ($state) {

            if ($state->delete()) {
                return response(['message' => 'Estado removido com sucesso!']);
            }
        }

        return response(['message' => 'Estado não encontrado!']);
    }
}
