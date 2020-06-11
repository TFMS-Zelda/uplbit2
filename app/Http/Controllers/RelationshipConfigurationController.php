<?php

namespace App\Http\Controllers;

use App\RelationshipConfiguration;
use App\Comment;

use Illuminate\Http\Request;
use App\Computer;
use App\Tablet;
use App\Employee;
use App\OtherPeripheral;
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
        $computers = Computer::all()->count();
        $computersAssigns = DB::table('relationship_configurations')->where('assignable_type', '=', 'App\Computer')->count();

        $tablets = Tablet::all()->count();
        $tabletsAssigns = DB::table('relationship_configurations')->where('assignable_type', '=', 'App\Tablet')->count();
        // dd($computersAssigns);
        return view('relationship-&-configurations.index',[
            'computers' => $computers,
            'computersAssigns' => $computersAssigns,
            'tablets' => $tablets,
            'tabletsAssigns' => $tabletsAssigns,

        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employees = \App\Employee::orderBy('id', 'DESC')
        ->get();


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

    public function storeRelationComputers(Request $request)
    {
        $this->validate($request, [
            'body' => 'required|min:4|max:512',
            'assignment_date' => 'required|date',
            'user_id' => 'required|numeric',
            'employee_id' => 'required|numeric',
        ]);

        $computersAssigns = new \App\RelationshipConfiguration;
        
        $computersAssigns->user_id = $request->user_id;
        $computersAssigns->employee_id = $request->employee_id;
        $computersAssigns->body = $request->body;
        $computersAssigns->assignment_date = $request->assignment_date;

        // obtener el id del computer 
        $idComputer = $request->selectComputer;
        $computer = Computer::find($idComputer);
    
        $computersAssigns->assignable_id = $computer->id;

        // añadir el comentario en la tabla comments
        $comment = new Comment();
        $comment->user_id = Auth::id();
        $comment->commentable_id = $computer->id;
        $comment->body =  $request->body;

        $computer->comments()->save($comment);
        $computer->assignments()->save($computersAssigns);
        DB::table('relationship_configurations')
        ->join('computers', 'relationship_configurations.assignable_id', '=', 'computers.id')
        ->where('relationship_configurations.assignable_id', '=', $computer->id)
        ->update(['status' => 'Activo - Asignado']);
        
        return $request->all();
    
    }

    public function storeRelationTablets(Request $request)
    {
        $this->validate($request, [
            'body' => 'required|min:4|max:512',
            'assignment_date' => 'required|date',
            'user_id' => 'required|numeric',
            'employee_id' => 'required|numeric',
            'selectTablet' => 'required|numeric',
        ]);

        $tabletsAssigns = new \App\RelationshipConfiguration;
        
        $tabletsAssigns->user_id = $request->user_id;
        $tabletsAssigns->employee_id = $request->employee_id;
        $tabletsAssigns->body = $request->body;
        $tabletsAssigns->assignment_date = $request->assignment_date;

        // obtener el id del computer 
        $idTablet = $request->selectTablet;
        $tablet = Tablet::find($idTablet);
    
        $tabletsAssigns->assignable_id = $tablet->id;

        // añadir el comentario en la tabla comments
        $comment = new Comment();
        $comment->user_id = Auth::id();
        $comment->commentable_id = $tablet->id;
        $comment->body =  $request->body;

        $tablet->comments()->save($comment);
        $tablet->assignments()->save($tabletsAssigns);
        DB::table('relationship_configurations')
        ->join('tablets', 'relationship_configurations.assignable_id', '=', 'tablets.id')
        ->where('relationship_configurations.assignable_id', '=', $tablet->id)
        ->update(['status' => 'Activo - Asignado']);
        
        return $request->all();
    
    }

    public function storeRelationMonitors(Request $request)
    {
        $this->validate($request, [
            'body' => 'required|min:4|max:512',
            'assignment_date' => 'required|date',
            'user_id' => 'required|numeric',
            'employee_id' => 'required|numeric',
            'selectMonitor' => 'required|numeric',
        ]);

        $monitorAssigns = new \App\RelationshipConfiguration;
        
        $monitorAssigns->user_id = $request->user_id;
        $monitorAssigns->employee_id = $request->employee_id;
        $monitorAssigns->body = $request->body;
        $monitorAssigns->assignment_date = $request->assignment_date;

        // obtener el id del monitor 
        $idMonitor = $request->selectMonitor;
        $monitor = \App\Monitor::find($idMonitor);
    
        $monitorAssigns->assignable_id = $monitor->id;

        // añadir el comentario en la tabla comments
        $comment = new Comment();
        $comment->user_id = Auth::id();
        $comment->commentable_id = $monitor->id;
        $comment->body =  $request->body;

        $monitor->comments()->save($comment);
        $monitor->assignments()->save($monitorAssigns);
        DB::table('relationship_configurations')
        ->join('monitors', 'relationship_configurations.assignable_id', '=', 'monitors.id')
        ->where('relationship_configurations.assignable_id', '=', $monitor->id)
        ->update(['status' => 'Activo - Asignado']);
        
        return $request->all();
    }

    public function storeRelationOtherPeripherals(Request $request)
    {
        $this->validate($request, [
            'body' => 'required|min:4|max:512',
            'assignment_date' => 'required|date',
            'user_id' => 'required|numeric',
            'employee_id' => 'required|numeric',
            'selectPeripheral' => 'required|numeric',
        ]);

        $peripheralAssigns = new \App\RelationshipConfiguration;
        
        $peripheralAssigns->user_id = $request->user_id;
        $peripheralAssigns->employee_id = $request->employee_id;
        $peripheralAssigns->body = $request->body;
        $peripheralAssigns->assignment_date = $request->assignment_date;

        // obtener el id del perisferico 
        $idPeripheral = $request->selectPeripheral;
        $peripheral = \App\OtherPeripheral::find($idPeripheral);
    
        $peripheralAssigns->assignable_id = $peripheral->id;

        // añadir el comentario en la tabla comments
        $comment = new Comment();
        $comment->user_id = Auth::id();
        $comment->commentable_id = $peripheral->id;
        $comment->body =  $request->body;

        $peripheral->comments()->save($comment);
        $peripheral->assignments()->save($peripheralAssigns);
        DB::table('relationship_configurations')
        ->join('other_peripherals', 'relationship_configurations.assignable_id', '=', 'other_peripherals.id')
        ->where('relationship_configurations.assignable_id', '=', $peripheral->id)
        ->update(['status' => 'Activo - Asignado']);
        
        return $request->all();
    }

    public function assignmentsComputersIndex()
    {
        $computers = DB::table('relationship_configurations')->where('assignable_type', '=', 'App\Computer')->count('id');

        // dd($computer);
        if ($computers >= 1) {
            # code...
            return view('relationship-&-configurations.assignments.computers', [
                'computers' => $computers,
            ]);

        } else {
            # code...
            alert()->info('Info','No tiene equipos de computo asignados en este momento')->persistent('Close');
            return redirect()->route('relationship-&-configurations.index');
        }
    }

    public function assignmentsTabletsIndex()
    {
        $tablets = DB::table('relationship_configurations')->where('assignable_type', '=', 'App\Tablet')->count('id');
         // dd($computer);
        if ($tablets >= 1) {
            # code...
            return view('relationship-&-configurations.assignments.tablets', [
                'tablets' => $tablets,
            ]);

        } else {
            # code...
            alert()->info('Info','No tiene Tablets corporativas asignadas en este momento')->persistent('Close');
            return redirect()->route('relationship-&-configurations.index');
        }
    }

    public function assignmentsMonitorsIndex()
    {
        $monitors = DB::table('relationship_configurations')->where('assignable_type', '=', 'App\Monitor')->count('id');
         // dd($computer);
        if ($monitors >= 1) {
            # code...
            return view('relationship-&-configurations.assignments.monitors', [
                'monitors' => $monitors,
            ]);

        } else {
            # code...
            alert()->info('Info','No tiene Monitores asignados en este momento')->persistent('Close');
            return redirect()->route('relationship-&-configurations.index');
        }
    }

    public function assignmentsOtherPeripheralsIndex()
    {
        $peripherals = DB::table('relationship_configurations')->where('assignable_type', '=', 'App\OtherPeripheral')->count('id');
        if ($peripherals >= 1) {
            # code...
            return view('relationship-&-configurations.assignments.other-peripherals', [
                'peripherals' => $peripherals,
            ]);

        } else {
            # code...
            alert()->info('Info','No tiene Perisféricos asignados en este momento')->persistent('Close');
            return redirect()->route('relationship-&-configurations.index');
        }
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
        ->update(['status' => 'Inactivo - No Asignado']);
        $relationshipConfiguration->delete();
    }

    
    public function destroyAssignmentTablet(RelationshipConfiguration $relationshipConfiguration)
    { 
        DB::table('relationship_configurations')
        ->join('tablets', 'relationship_configurations.assignable_id', '=', 'tablets.id')
        ->where('relationship_configurations.assignable_id', '=', $relationshipConfiguration->assignable_id)
        ->update(['status' => 'Inactivo - No Asignado']);
        $relationshipConfiguration->delete();
    }

    public function destroyAssignmentMonitor(RelationshipConfiguration $relationshipConfiguration)
    { 
        DB::table('relationship_configurations')
        ->join('monitors', 'relationship_configurations.assignable_id', '=', 'monitors.id')
        ->where('relationship_configurations.assignable_id', '=', $relationshipConfiguration->assignable_id)
        ->update(['status' => 'Inactivo - No Asignado']);
        $relationshipConfiguration->delete();
    }

    public function destroyAssignmentOtherPeripheral(RelationshipConfiguration $relationshipConfiguration)
    { 
        DB::table('relationship_configurations')
        ->join('other_peripherals', 'relationship_configurations.assignable_id', '=', 'other_peripherals.id')
        ->where('relationship_configurations.assignable_id', '=', $relationshipConfiguration->assignable_id)
        ->update(['status' => 'Inactivo - No Asignado']);
        $relationshipConfiguration->delete();
    }

    

}
