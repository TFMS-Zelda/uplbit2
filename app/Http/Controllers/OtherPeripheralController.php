<?php

namespace App\Http\Controllers;

use App\OtherPeripheral;
use Illuminate\Http\Request;

class OtherPeripheralController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $otherPeripherals = \App\OtherPeripheral::orderBy('id', 'DESC')
        ->paginate(10);

        return view('peripherals.other-peripherals.index', compact('otherPeripherals'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $articles = \App\Article::orderBy('id', 'DESC')
        ->paginate(10);

        return view('peripherals.other-peripherals.create', compact('articles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        
        $otherPeripheral = new \App\OtherPeripheral;
        $otherPeripheral->create($request->all());
        
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\OtherPeripheral  $otherPeripheral
     * @return \Illuminate\Http\Response
     */
    public function show(OtherPeripheral $otherPeripheral)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\OtherPeripheral  $otherPeripheral
     * @return \Illuminate\Http\Response
     */
    public function edit(OtherPeripheral $otherPeripheral)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\OtherPeripheral  $otherPeripheral
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OtherPeripheral $otherPeripheral)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\OtherPeripheral  $otherPeripheral
     * @return \Illuminate\Http\Response
     */
    public function destroy(OtherPeripheral $otherPeripheral)
    {
        //
    }
}
