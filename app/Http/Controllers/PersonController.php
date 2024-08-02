<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PersonController extends Controller
{
    public function index()
    {
        return Person::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'rg' => 'required',
            'cpf' => 'required|unique:people',
            'cep' => 'required',
            'endereco' => 'required',
            'naturalidade' => 'required',
            'data_solicitacao_inss' => 'required|date',
        ]);

        return Person::create($request->all());
    }

    public function show(Person $person)
    {
        return $person;
    }

    public function update(Request $request, Person $person)
    {
        $request->validate([
            'name' => 'required',
            'rg' => 'required',
            'cpf' => 'required|unique:people,cpf,' . $person->id,
            'cep' => 'required',
            'endereco' => 'required',
            'naturalidade' => 'required',
            'data_solicitacao_inss' => 'required|date',
        ]);

        $person->update($request->all());

        return $person;
    }

    public function destroy(Person $person)
    {
        $person->delete();

        return response()->noContent();
    }

    public function findByCpf($cpf)
    {
        $person = Person::where('cpf', $cpf)->first();

        if (!$person) {
            return response()->json(['message' => 'Person not found'], 404);
        }

        return response()->json($person);
    }
}
