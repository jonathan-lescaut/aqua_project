<?php

namespace App\Http\Controllers\API;

use App\Models\Living;
use App\Models\Project;
use App\Models\Material;
use App\Models\Decoration;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // On récupère tous les caté
        $project = Project::all();
        // On retourne les informations des caté en JSON
        return response()->json($project);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'title_project' => 'required|max:100',
            'start_project' => 'required',
            'user_id' => 'required',

        ]);
        // On crée un nouvel caté
        $project = Project::create([
            'title_project' => $request->title_project,
            'start_project' => $request->start_project,
            'user_id' => $request->user_id,

        ]);

        // table pivot LIVING
        $livings = $request->living_id;
        if (!empty($livings)) {
            for ($i = 0; $i < count($livings); $i++) {
                $living = Living::find($livings[$i]);
                $project->livings()->attach($living);
            }
        }
        // table pivot MATERIAL
        $materials = $request->material_id;
        if (!empty($materials)) {
            for ($i = 0; $i < count($materials); $i++) {
                $material = Material::find($materials[$i]);
                $project->materials()->attach($material);
            }
        }

        // table pivot DECORATION
        $decorations = $request->decoration_id;
        if (!empty($decorations)) {
            for ($i = 0; $i < count($decorations); $i++) {
                $decoration = Decoration::find($decorations[$i]);
                $project->decorations()->attach($decoration);
            }
        }

        // On retourne les informations de caté en JSON
        return response()->json([
            'status' => 'Success',
            'data' => $project,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return response()->json($project);

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $this->validate($request, [
            'title_project' => 'required|max:100',
            'start_project' => 'required',
            'user_id' => 'required',
        ]);
        // On crée un nouvel utilisateur
        $project->update([
            'title_project' => $request->title_project,
            'start_project' => $request->start_project,
            'user_id' => $request->user_id,

        ]);

        // Array à fournir pour la méthode sync
        $updateTabId = array();

        //Update living pivot
        $livings = $request->living_id;
        if (!empty($livings)) {
            for ($i = 0; $i < count($livings); $i++) {
                $living = Living::find($livings[$i]);
                array_push($updateTabId, $living->id);
            }
            $project->livings()->sync($updateTabId);
        }

        //Update material pivot
        $materials = $request->material_id;
        if (!empty($materials)) {
            for ($i = 0; $i < count($materials); $i++) {
                $material = Material::find($materials[$i]);
                array_push($updateTabId, $material->id);
            }
            $project->materials()->sync($updateTabId);
        }

        //Update decoration pivot
        $decorations = $request->decoration_id;
        if (!empty($decorations)) {
            for ($i = 0; $i < count($decorations); $i++) {
                $decoration = Decoration::find($decorations[$i]);
                array_push($updateTabId, $decoration->id);
            }
            $project->decorations()->sync($updateTabId);
        }

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
    public function destroy(Project $project)
    {
        // On supprime l'utilisateur
        $project->delete();
        // On retourne la réponse JSON
        return response()->json([
            'status' => 'Supprimée avec succès'
        ]);
    }
}
