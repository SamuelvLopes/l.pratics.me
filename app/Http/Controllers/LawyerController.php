<?php

namespace App\Http\Controllers;

use App\Models\Lawyer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LawyerController extends Controller
{
    public function index()
    {
        return Lawyer::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'oab' => 'required|unique:lawyers',
            'fone' => 'required',
            
        ]);

        return Lawyer::create($request->all());
    }

    public function show(Lawyer $lawyer)
    {
        return $lawyer;
    }

    public function update(Request $request, Lawyer $lawyer)
    {
        $request->validate([
            'name' => 'required',
            'oab' => 'required|unique:lawyers,oab,' . $lawyer->id,
            'fone' => 'required',
        ]);

        $lawyer->update($request->all());

        return $lawyer;
    }

    public function destroy(Lawyer $lawyer)
    {
        $lawyer->delete();

        return response()->noContent();
    }

    public function findByOab($oab)
    {
        $lawyer = Lawyer::where('oab', $oab)->first();

        if (!$lawyer) {
            return response()->json(['message' => 'Lawyer not found'], 404);
        }

        return response()->json($lawyer);
    }
}
