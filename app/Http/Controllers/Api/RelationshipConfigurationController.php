<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\RelationshipConfiguration;
use Illuminate\Http\Request;
use DB;
use App\Computer;

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

    public function getComputers()
    {
         $computers = RelationshipConfiguration::with(['assignable', 'user', 'employee'])
         ->where('relationship_configurations.assignable_type', '=', 'App\Computer')
         ->get();
         return $computers;
    }


}
