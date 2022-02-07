<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     *  valida la richiesta di modifica o di creazione
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function valida(Request $request){

        return $request->validate([
            'cognome' => 'required',
            'indirizzo' => '',
            'cellulare' => 'required|numeric',
            'codice_fiscale' => '|size:16',
            'sede' => '',
            'ddn' => 'date|after:01-01-1910|before:01-01-2005'
        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profile = auth()->user()->profile;
        if(isset($profile)){
            return redirect(route('profile.show', ['profile' => $profile->id]));
        }else{
            return redirect(route("profile.create"));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('profile.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributes = $this->valida($request);
        Profile::addNew(
            $attributes
        );
        return redirect(route('profile.show', ['profile' => auth()->user()->profile->id]));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show(Profile $profile)
    {
        return view('profile.show', ['profile' => $profile]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function edit(Profile $profile)
    {
        return view('profile.edit', ['profile' => $profile]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Profile $profile)
    {
        $attributes = $this->valida($request);
        $profile->update($attributes);
        return redirect(route('profile.show', ['profile' => $profile->id]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profile $profile)
    {
        $profile->delete();
        return redirect('/');
    }
}
