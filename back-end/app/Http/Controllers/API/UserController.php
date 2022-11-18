<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // On récupère tous les utilisateurs
        $users = User::orderByDesc('created_at')->get();
        // On retourne les informations des utilisateurs en JSON
        return response()->json($users);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
    // On retourne les informations des utilisateurs en JSON
    return response()->json($user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        // dd($user);
        $this->validate($request, [
            'name' => 'required|string|max:100',
            'email' => 'required|string|email|max:100',

        ]);
        // On modifie l'utilisateur
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);
        // On retourne les informations du sondage modifié en JSON
        return response()->json([
            'status' => 'Profil mis à jour avec succès'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        // On supprime le message de contact
        $user->delete();
        // On retourne la réponse JSON
        return response()->json([
            'status' => 'Profil supprimé avec succès'
        ]);
    }
}
