<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AddressController extends Controller
{
    
    public function index()
    {
        return response(Address::all());
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'zip_code' => 'required|integer',
            'street' => 'required|string|max:100',
            'number' => 'required|integer',
            'complement' => 'string|max:20',
            'district' => 'required|string|max:50',
            'city_id' => 'required|integer',
            'user_id' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return response(['message' => 'Dados inválidos!']);
        }
        
        $address = new Address([
            'zip_code' => $request->get('zip_code'),
            'street' => $request->get('street'),
            'number' => $request->get('number'),
            'complement' => $request->get('complement'),
            'district' => $request->get('district'),
            'city_id' => $request->get('city_id'),
            'user_id' => $request->get('user_id')
        ]);

        if ($address->save()) {
            return response(['message' => 'Endereço criado com sucesso!']);
        }

        return response(['message' => 'Erro ao criar endereço!']);
    }

    public function show($id)
    {
        $address = Address::find($id);

        if ($address) {
            return response($address);
        }

        return response(['message' => 'Endereço não encontrado!']);
    }

    public function update(Request $request, $id)
    {
        $address = Address::find($id);

        if ($address) {

            $validator = Validator::make($request->all(), [
                'zip_code' => 'required|integer',
                'street' => 'required|string|max:100',
                'number' => 'required|integer',
                'complement' => 'string|max:20',
                'district' => 'required|string|max:50',
                'city_id' => 'required|integer',
                'user_id' => 'required|integer'
            ]);
    
            if ($validator->fails()) {
                return response(['message' => 'Dados inválidos!']);
            }

            $hasUpdated = $address->update([
                'zip_code' => $request->get('zip_code'),
                'street' => $request->get('street'),
                'number' => $request->get('number'),
                'complement' => $request->get('complement'),
                'district' => $request->get('district'),
                'city_id' => $request->get('city_id'),
                'user_id' => $request->get('user_id')
            ]);

            if ($hasUpdated) {
                return response(['message' => 'Endereço atualizado com sucesso!']);
            }
        }

        return response(['message' => 'Endereço não encontrado!']);
    }

    public function destroy($id)
    {
        $address = Address::find($id);

        if ($address) {

            if ($address->delete()) {
                return response(['message' => 'Endereço removido com sucesso!']);
            }
        }

        return response(['message' => 'Endereço não encontrado!']);
    }
}
