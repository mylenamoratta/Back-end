<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CityController extends Controller
{
    
    public function index()
    {
       return response(City::all());
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:50',
            'state_id' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return response(['message' => 'Dados inválidos!']);
        }

        $city = new City([
            'name' => $request->get('name'),
            'state_id' => $request->get('state_id')
        ]);

        if($city->save()) {
            return response(['message' => 'Cidade criada com sucesso!']);
        }

        return response(['message' => 'Erro ao criar cidade!']);
    }

    public function show($id)
    {
        $city = City::find($id);

        if ($city) {
            return response($city);
        }

        return response(['message' => 'Cidade não encontrada!']);
    }

    public function update(Request $request, $id)
    {
        $city = City::find($id);

        if ($city) {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:50',
                'state_id' => 'required|integer'
            ]);
    
            if ($validator->fails()) {
                return response(['message' => 'Dados inválidos!']);
            }
    
           $hasUpdated = $city->update([
                'name' => $request->get('name'),
                'state_id' => $request->get('state_id')
            ]);

            if ($hasUpdated) {
                return response(['message' => 'Cidade atulizada com sucesso!']);
            }
        }

        return response(['message' => 'Cidade não encontrada!']);
    }


    public function destroy($id)
    {
        $city = City::find($id);

        if ($city) {
            
            if ($city->delete()) {
                return response(['message' => 'Cidade excluida com sucesso!']);
            }

            return response(['message' => 'Cidade não encontrada!']);
        }
    }
}
