<?php

namespace App\Http\Controllers;

use App\Computer;
use Illuminate\Http\Request;
use App\Http\Requests\StoreComputerRequest;
use App\Http\Requests\UpdateComputerRequest;
use RealRashid\SweetAlert\Facades\Alert;
use DB;
use Auth;
use App\Comment;
use App\Services\ProviderOrArticle;
use App\Article;
use App\Provider;

class ComputerController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $totalComputerInStock = Computer::count();
        $computers = \App\Computer::orderBy('id', 'DESC')
        ->get();

        //Consulta cantidad de computers status = 'No Asignado'
        $computersNoAsignados = DB::table('computers')->where('status', 'like', '%No Asignado%')->count('id');
        $computersAsignados = DB::table('computers')->where('status', 'like', '%Asignado%')->count('id');

        return view('computers.index', compact('computers', 'totalComputerInStock', 'computersNoAsignados', 'computersAsignados'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $providersValidation = Provider::count();
        $articlesValidation = Article::count();

        if ($providersValidation >= 1 && $articlesValidation >= 1 ) {
             # code...
            // Nota: este es un servicio
            $providers = app(ProviderOrArticle::class)->getProviders();
            return view('computers.create', compact('providers'));
            
        } else {
           
            alert()->html('<i>Provedor ó Articulo, no registrado en el sistema</i>',"
        
            <div role='alert' class='alert alert-danger alert-dismissible'>
                <button aria-label='Close' data-dismiss='alert' class='close' type='button'><span
                aria-hidden='true'>×</span></button>
            <h2 class='alert-heading'>Error!</h2>
            <p>Pueda que no tenga registros relacionados para crear un Equipo de computo en este momento!</p>
            <hr>

            <p><h4>Actualmente tiene registrado:</h4>
            <img class='img-fluid' style='width: 50px;'
            src='/core/undraw/error-cloud.svg'> <br>
            </p>
            <h3>$providersValidation , Provedores registrados</h3>
            <h3>$articlesValidation , Articulos registrados de un provedor</h3>
            <hr> 
            </div>
          ",'error')->persistent('Close');
            
            return redirect()->route('computers.index');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreComputerRequest $request)
    {
        $computer = new \App\Computer;
        $computer->create($request->all());

        // se obtiene el ultimo computer creado
        $computer = Computer::all()->last();
        
        // se obtiene el id del usuario que esta en la sesion
        $sessionIdUser = Auth::id();

        // se agrega una relacion polimorfica en tabla comments se agrega modelo y se crea un nuevo comentario
        $comment = new Comment();
        $comment->user_id = $sessionIdUser;
        $comment->commentable_id = $computer->id;
    
        $comment->body =  $request->body;
        $computer->comments()->save($comment);

        Alert::success('Success!', 'Equipo de Computo' . $computer->license_plate . 'Registrado correctamente en el sistema');
        return redirect()->route('computers.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Computer  $computer
     * @return \Illuminate\Http\Response
     */
    public function show(Computer $computer)
    {
        $idComputer = $computer->id;
        return view('computers.show', compact('computer', 'idComputer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Computer  $computer
     * @return \Illuminate\Http\Response
     */
    public function edit(Computer $computer)
    {
          // Nota: este es un servicio
        $providers = app(ProviderOrArticle::class)->getProviders();
        $commentsComputer = Computer::find($computer)->pluck('comments')->collapse();

        return view('computers.edit', [
            'computer' => $computer,
            'commentsComputer' => $commentsComputer,
            'providers' => $providers,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Computer  $computer
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateComputerRequest $request, Computer $computer)
    {
        $computer->update($request->all());
          
        $sessionIdUser = Auth::id();

        $comment = new Comment();
        $comment->user_id = $sessionIdUser;
        $comment->commentable_id = $computer->id;
    
        $comment->body =  $request->body;
        // dd($comment);

        $computer->comments()->save($comment);

        Alert::success('Success!', 'Equipo de Computo' . $computer->license_plate . 'Actualizado correctamente en el sistema');

        return redirect()->route('computers.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Computer  $computer
     * @return \Illuminate\Http\Response
     */

    public function destroy(Computer $computer)
    {
        $exists = $computer->assignments()->where('assignable_id', $computer->id)->exists();
        try {
            if ($exists === true) {
                # code...
                // return 'No puede eliminarse porque esta asignado';
                alert()->error('Error!','No puede Eliminar este Equipo de Computo porque esta asignado a un empleado en este momento')->persistent('Close');

                return redirect()->route('computers.index');

            } else {
                # code...
                if ($computer->status  === 'Inactivo - No Asignado' ) {
                    # code...
                    // return 'se puede eliminar porque contiene el status';
                    alert()->success('Nota','El Equipo de Computo' . ' ' . $computer->license_plate . ' ' . 'a sido eliminado 
                    correctamente del sistema');

                    $updateStatusPostDelete = 'Eliminado - Baja de Activo';
                    $whenUserDeleteComputer = Auth::id();
                    Computer::where('id','=', $computer->id)->update(['status' => $updateStatusPostDelete, 'user_id' => $whenUserDeleteComputer]);

                    $computer->delete();

                    return redirect()->route('computers.index');

                } else {
                    # code...
                    // return 'no se puede eliminar porque no contiene el status';
                    alert()->error('Error!','No puede Eliminar este Equipo de Computo, porque el estado actual es'
                    . ' ' . $computer->status)->persistent('Close');

                    return redirect()->route('computers.index');
                }

            }
            
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function removeDisabledComputers()
    {
        $computersRemoveInventary = DB::table('computers')->where('status', '=', 'Eliminado - Baja de Activo')->get();
        $computersRemove = DB::table('computers')->where('status', '=', 'Eliminado - Baja de Activo')->count();

        return view('computers.remove-&-disabled-computers', [
            'computersRemoveInventary' => $computersRemoveInventary,
            'computersRemove' => $computersRemove
        ]);
    }  
}













//  try {
//             if ($computer->status  === 'Retirado - Baja de Activo' ) {
//                 $updateStatusPostDelete = 'Retirado - Baja de Activo';
//                 $whenUserDeleteComputer = Auth::id();
//                 Computer::where('id','=', $computer->id)->update(['status' => $updateStatusPostDelete, 'user_id' => $whenUserDeleteComputer ]);
//                 $computer->delete();
//                 alert()->info('Atención','El equipo de computo' . ' ' . $computer->license_plate . ' ' . 'a sido eliminado
//                 correctamente del sistema');
//                 return redirect()->route('computers.remove-&-disabled-computers');
//             } else {

//                 Alert::error('Error, Eliminar Computer', 'No puede eliminar este equipo de computo porque el estado actual es'
//                 . ' ' . $computer->status)->persistent('Close');

//                 return redirect()->route('computers.index');
//                 }
//             } catch (\Illuminate\Database\QueryException $e) {
//                 return alert()->error('Error','se presento un error al momento de eliminar el siguiente equipo de computo del sistema' + $e);
//         }