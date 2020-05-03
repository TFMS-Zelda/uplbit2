<?php

namespace App\Http\Controllers;

use App\RelationshipConfiguration;
use Illuminate\Http\Request;
use App\Computer;
use App\Employee;
use DB;
use Auth;
use RealRashid\SweetAlert\Facades\Alert;


class RelationshipConfigurationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $computers = \App\Computer::all()->count();
        $computersAssigns = DB::table('relationship_configurations')->where('assignable_type', '=', 'App\Computer')->count();
        // dd($computersAssigns);
        return view('relationship-&-configurations.index',[
            'computers' => $computers,
            'computersAssigns' => $computersAssigns

        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employees = Employee::get();

        return view('relationship-&-configurations.create', [
            'employees' => $employees,
        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function assign(Employee $employee)
    {
        $idSessionUser = Auth::id();
        return view('relationship-&-configurations.assign', [
        'idSessionUser' => $idSessionUser,
        'employee' => $employee
    
        ]);
    }

    public function assignmentsComputersIndex()
    {
        return view('relationship-&-configurations.assignments.computers');
    }


    public function destroyAssignmentComputer(RelationshipConfiguration $relationshipConfiguration)
    { 
         // $computers = DB::table('relationship_configurations')
        // ->join('computers', 'relationship_configurations.assignable_id', '=', 'computers.id')
        // ->where('relationship_configurations.assignable_id', '=', 3)
        // ->update(['status' => 'No Asignado']);

        // $relationshipConfiguration = RelationshipConfiguration::findOrFail($id);
        // \App\RelationshipConfiguration::with(['assignable'])
        //  ->where('relationship_configurations.assignable_type', '=', 'App\Computer')
        //  ->get();

        DB::table('relationship_configurations')
        ->join('computers', 'relationship_configurations.assignable_id', '=', 'computers.id')
        ->where('relationship_configurations.assignable_id', '=', $relationshipConfiguration->assignable_id)
        ->update(['status' => 'No Asignado']);
        $relationshipConfiguration->delete();



    }
}
