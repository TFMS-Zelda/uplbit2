<?php

namespace App\Http\Controllers;

use App\Monitor;
use App\Article;
use App\Provider;
use App\Services\ProviderOrArticle;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\StoreMonitorRequest;

use Auth;
use App\Comment;
use App\Http\Requests\UpdateMonitorRequest;
use DB;

class MonitorController extends Controller
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
        $monitors = \App\Monitor::orderBy('id', 'DESC')
        ->paginate(10);
        $totalMonitor = Monitor::get()->count();
        return view('peripherals.monitors.index', compact('monitors', 'totalMonitor'));
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
            return view('peripherals.monitors.create', compact('providers'));
            
        } else {
        
            alert()->html('<i>Provedor ó Articulo, no registrado en el sistema</i>',"
        
            <div role='alert' class='alert alert-danger alert-dismissible'>
                <button aria-label='Close' data-dismiss='alert' class='close' type='button'><span
                aria-hidden='true'>×</span></button>
            <h2 class='alert-heading'>Error!</h2>
            <p>Pueda que no tenga registros relacionados para regitrar un monitor como perisferico en este momento!</p>
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
            
            return redirect()->route('peripherals.monitors.index');
        
        }
    }   

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMonitorRequest $request)
    {
        $monitor = new \App\monitor;
        $monitor->create($request->all());

        // se obtiene el ultimo computer creado
        $monitor = Monitor::all()->last();
    
        // se obtiene el id del usuario que esta en la sesion
        $sessionIdUser = Auth::id();
                
        // se agrega una relacion polimorfica en tabla comments se agrega modelo y se crea un nuevo comentario
        $comment = new Comment();
        $comment->user_id = $sessionIdUser;
        $comment->commentable_id = $monitor->id;
        $comment->body =  $request->body;
        $monitor->comments()->save($comment);
        Alert::success('Success!', 'Perisferico de Tipo Monitor' . $monitor->license_plate . 'Registrado correctamente en el sistema');
        return redirect()->route('peripherals.monitors.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Monitor  $monitor
     * @return \Illuminate\Http\Response
     */
    public function show(Monitor $monitor)
    {
        return view('peripherals.monitors.show', compact('monitor'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Monitor  $monitor
     * @return \Illuminate\Http\Response
     */
    public function edit(Monitor $monitor)
    {
        if ($monitor->status != 'Activo - Asignado') {
            # code...
             // Nota: este es un servicio
            $providers = app(ProviderOrArticle::class)->getProviders();
            $commentsTablet = Monitor::find($monitor)->pluck('comments')->collapse();

            return view('peripherals.monitors.edit', [
                'monitor' => $monitor,
                'commentsTablet' => $commentsTablet,
                'providers' => $providers,
            ]);
        } else {
            # code...
            alert()->error('Nota','No puede editar este Monitor porque esta asignado a un empleado en este momento' );
            return redirect()->route('peripherals.monitors.index');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Monitor  $monitor
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMonitorRequest $request, Monitor $monitor)
    {
        $monitor->update($request->all());
        
        $sessionIdUser = Auth::id();

        $comment = new Comment();
        $comment->user_id = $sessionIdUser;
        $comment->commentable_id = $monitor->id;
    
        $comment->body =  $request->body;

        $monitor->comments()->save($comment);

        Alert::success('Success!', 'Monitor:' . ' ' . $monitor->license_plate . ' ' .'Actualizado correctamente en el sistema');

        return redirect()->route('peripherals.monitors.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Monitor  $monitor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Monitor $monitor)
    {
        $exists = $monitor->assignments()->where('assignable_id', $monitor->id)->exists();
        try {
            if ($exists === true) {
                # code...
                // return 'No puede eliminarse porque esta asignado';
                alert()->error('Error!','No puede Eliminar este Monitor porque esta asignado a un empleado en este momento')->persistent('Close');

                return redirect()->route('peripherals.monitors.index');

            } else {
                # code...
                if ($monitor->status  === 'Inactivo - No Asignado' ) {
                    # code...
                    // return 'se puede eliminar porque contiene el status';
                    alert()->success('Nota','El Monitor' . ' ' . $monitor->license_plate . ' ' . 'a sido eliminado 
                    correctamente del sistema');

                    $updateStatusPostDelete = 'Eliminado - Baja de Activo';
                    $whenUserDeleteMonitor = Auth::id();
                    \App\Monitor::where('id','=', $monitor->id)->update(['status' => $updateStatusPostDelete, 'user_id' => $whenUserDeleteMonitor]);

                    $monitor->delete();

                    return redirect()->route('peripherals.monitors.remove-&-disabled-monitors');

                } else {
                    # code...
                    // return 'no se puede eliminar porque no contiene el status';
                    alert()->error('Error!','No puede Eliminar este Monitor, porque el estado actual es'
                    . ' ' . $monitor->status)->persistent('Close');

                    return redirect()->route('peripherals.monitors.index');
                }
            }
            
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function removeDisabledMonitors()
    {
        $monitorsRemoveInventary = DB::table('monitors')->where('status', '=', 'Eliminado - Baja de Activo')->get();
        $monitorsRemove = DB::table('monitors')->where('status', '=', 'Eliminado - Baja de Activo')->count();

        return view('peripherals.monitors.remove-&-disabled-monitors', [
            'monitorsRemoveInventary' => $monitorsRemoveInventary,
            'monitorsRemove' => $monitorsRemove
        ]);
    }


}
