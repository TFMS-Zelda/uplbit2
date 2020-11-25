<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\RelationshipConfiguration;
use Illuminate\Http\Request;
use DB;
use App\Computer;
use App\Tablet;
use App\OtherPeripheral;
use App\Employee;


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

    // ruta para obtener todos los computers asignados en vuejs
    public function getComputers()
    {
        $computers = RelationshipConfiguration::with(['assignable', 'employee'])
        ->where('relationship_configurations.assignable_type', '=', 'App\Computer')
        ->get();
        return $computers;
    }

    // ruta para obtener todos las tablets asignados en vuejs
    public function getTablets()
    {
        $tablets = RelationshipConfiguration::with(['assignable', 'employee'])
        ->where('relationship_configurations.assignable_type', '=', 'App\Tablet')
        ->get();
        return $tablets;
    }


    // ruta para obtener todos los monitores asignados en vue js
    public function getMonitors()
    {
        $monitors = RelationshipConfiguration::with(['assignable', 'employee'])
        ->where('relationship_configurations.assignable_type', '=', 'App\Monitor')
        ->get();
        return $monitors;
    }

     // ruta para obtener todos los perisfericos asignados en vue js
    public function getOtherPeripherals()
    {
        $peripherals = RelationshipConfiguration::with(['assignable', 'employee'])
        ->where('relationship_configurations.assignable_type', '=', 'App\OtherPeripheral')
        ->get();
        return $peripherals;
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

    // Ruta para obtener los monitores disponibles para ser asignados
    public function allMonitorsByAssign(){
        $monitors = DB::table('monitors')->where('status', '=', 'Inactivo - No Asignado')->get();
        return $monitors;
    }

    // Ruta para obtener los perisfericos disponibles para ser asignados
    public function allOtherPeripheralsByAssign(){
        $peripherals = DB::table('other_peripherals')->where('status', '=', 'Inactivo - No Asignado')->get();
        return $peripherals;
    }

}
