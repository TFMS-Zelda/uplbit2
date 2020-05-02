<?php

namespace App\Http\Controllers;

use App\RelationshipConfiguration;
use Illuminate\Http\Request;

class RelationshipConfigurationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('relationship-&-configurations.index');
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
     * @param  \App\RelationshipConfiguration  $relationshipConfiguration
     * @return \Illuminate\Http\Response
     */
    public function show(RelationshipConfiguration $relationshipConfiguration)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\RelationshipConfiguration  $relationshipConfiguration
     * @return \Illuminate\Http\Response
     */
    public function edit(RelationshipConfiguration $relationshipConfiguration)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\RelationshipConfiguration  $relationshipConfiguration
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RelationshipConfiguration $relationshipConfiguration)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\RelationshipConfiguration  $relationshipConfiguration
     * @return \Illuminate\Http\Response
     */
    public function destroy(RelationshipConfiguration $relationshipConfiguration)
    {
        //
    }
}
