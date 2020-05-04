<?php

namespace App\Http\Controllers;

use App\RelationshipConfiguration;
use App\Comment;

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

    
    }
    

    public function assignmentsComputersIndex()
    {
        $computer = DB::table('relationship_configurations')->where('assignable_type', '=', 'App\Comouter')->count('id');
        $computers = Computer::all()->count();
        if ($computers >= 1) {
            return view('relationship-&-configurations.assignments.computers');
        } else {
             alert()->html('<i>No hay equipos de computo asignados</i>',"
        
            <div role='alert' class='alert alert-danger alert-dismissible'>
                <button aria-label='Close' data-dismiss='alert' class='close' type='button'><span
                aria-hidden='true'>×</span></button>
            <h2 class='alert-heading'>Error!</h2>
            <p>Actualmente no existen asignaciones de equipos de computo registradas en el sistema!</p>
            <hr>

            <p><h4>Actualmente tiene registrado " . ' ' . $computers . ' ' ." equipos de computo:</h4>
           
            </p>
            <hr> 
            </div>
          ",'error')->persistent('Close');
            
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
}
