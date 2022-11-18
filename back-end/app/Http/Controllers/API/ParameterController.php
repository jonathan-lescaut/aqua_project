<?php

namespace App\Http\Controllers\API;

use App\Models\Parameter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ParameterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // On récupère tous les caté
        $parameter = Parameter::all();
        // On retourne les informations des caté en JSON
        return response()->json($parameter);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'c°' => 'required|max:10',
            'ph' => 'required|max:10',
            'kh' => 'required|max:10',
            'gh' => 'required|max:10',
            'no2' => 'required|max:10',
            'no3' => 'required|max:10',
            'project_id' => 'required'

        ]);
        // On crée un nouvel utilisateur
        $parameter = Parameter::create([
            'c°' => $request->c°,
            'ph' => $request->ph,
            'kh' => $request->kh,
            'gh' => $request->gh,
            'no2' => $request->no2,
            'no3' => $request->no3,
            'project_id' => $request->project_id,


        ]);
        // On retourne les informations du nouvel utilisateur en JSON
        return response()->json([
            'status' => 'Success',
            'data' => $parameter,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Parameter $parameter)
    {
        return response()->json($parameter);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Parameter $parameter)
    {
        $this->validate($request, [
            'c°' => 'required|max:10',
            'ph' => 'required|max:10',
            'kh' => 'required|max:10',
            'gh' => 'required|max:10',
            'no2' => 'required|max:10',
            'no3' => 'required|max:10',
            'project_id' => 'required',

        ]);
        // On crée un nouvel utilisateur
        $parameter->update([
            'c°' => $request->c°,
            'ph' => $request->ph,
            'kh' => $request->kh,
            'gh' => $request->gh,
            'no2' => $request->no2,
            'no3' => $request->no3,
            'project_id' => $request->project_id,


        ]);
        // On retourne les informations du nouvel utilisateur en JSON
        return response()->json([
            'status' => 'Mise à jour avec succèss'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Parameter $parameter)
    {
        // On supprime l'utilisateur
        $parameter->delete();
        // On retourne la réponse JSON
        return response()->json([
            'status' => 'Supprimée avec succès'
        ]);
    }
}
