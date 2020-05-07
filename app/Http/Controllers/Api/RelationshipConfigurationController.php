<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\RelationshipConfiguration;
use Illuminate\Http\Request;
use DB;
use App\Computer;
use App\Tablet;


class RelationshipConfigurationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $a = DB::table('relationship_configurations')
        // ->join('computers', 'relationship_configurations.assignable_id', '=', 'computers.id')
        // ->join('other_peripherals', 'relationship_configurations.assignable_id', '=', 'other_peripherals.id')
        //        ->select('relationship_configurations.body', 'computers.model', 'other_peripherals.brand' )

        // // ->where('relationship_configurations.assignable_type', '=', 'App\Computer')
        // ->get();
        // return $a;

        //  $games = RelationshipConfiguration::with('assignable')
        //  ->where('relationship_configurations.assignable_type', '=', 'App\Computer')
        //  ->get();
        //  return $games;
    }

    // ruta para obtener todos los computers asignados
    public function getComputers()
    {
        $computers = RelationshipConfiguration::with(['assignable', 'user', 'employee'])
        ->where('relationship_configurations.assignable_type', '=', 'App\Computer')
        ->get();
        return $computers;
    }

    // ruta para obtener todos las tablets asignados
    public function getTablets()
    {
        $tablets = RelationshipConfiguration::with(['assignable', 'user', 'employee'])
        ->where('relationship_configurations.assignable_type', '=', 'App\Tablet')
        ->get();
        return $tablets;
    }

    // Ruta para obtener los computers disponibles para ser asignados
    public function allComputersByAssign(){
        $computers = DB::table('computers')->where('status', '=', 'Inactivo - No Asignado')->get();
        return $computers;
    }

    // Ruta para obtener las tablets disponibles para ser asignados
    public function allTabletsByAssign(){
        $tablets = DB::table('tablets')->where('status', '=', 'Inactivo - No Asignado')->get();
        return $tablets;
    }



}
