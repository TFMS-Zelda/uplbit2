<?php

namespace App\Http\Controllers;

use App\Tablet;
use Illuminate\Http\Request;
use DB;
use RealRashid\SweetAlert\Facades\Alert;
use App\Services\ProviderOrArticle;

use App\Comment;
use Auth;
use App\Http\Requests\StoreTabletRequest;
use App\Http\Requests\UpdateTabletRequest;
use App\Provider;
use App\Article;


class TabletController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $totalTabletInStock = Tablet::count();
        $tablets = \App\Tablet::orderBy('id', 'DESC')
        ->paginate(10);

        //Consulta cantidad de tablets status = 'No Asignado'
        $tabletsNoAsignados = DB::table('computers')->where('status', 'like', '%No Asignado%')->count('id');
        $tabletsAsignados = DB::table('computers')->where('status', 'like', '%Asignado%')->count('id');

        return view('tablets.index', compact('tablets', 'totalTabletInStock', 'tabletsNoAsignados', 'tabletsAsignados'));
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
            return view('tablets.create', compact('articles', 'providers'));
            
        } else {
        
            alert()->html('<i>Provedor ó Articulo, no registrado en el sistema</i>',"
        
            <div role='alert' class='alert alert-danger alert-dismissible'>
                <button aria-label='Close' data-dismiss='alert' class='close' type='button'><span
                aria-hidden='true'>×</span></button>
            <h2 class='alert-heading'>Error!</h2>
            <p>Pueda que no tenga registros relacionados para registrar una tablet cooporativa en el inventario en este momento!</p>
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
    public function store(StoreTabletRequest $request)
    {
        $tablet = new \App\Tablet;
        $tablet->create($request->all());

        // se obtiene el ultimo registro creado
        $tablet = \App\Tablet::all()->last();

        // se obtiene el id del computer
        $idTablet = $tablet->id;

        // se obtiene el id del usuario que esta en la sesion
        $sessionIdUser = Auth::id();

            // se agrega una relacion polimorfica en tabla comments se agrega modelo y se crea un nuevo comentario
            $comment = new Comment();
            $comment->user_id = $sessionIdUser;
            $comment->commentable_id = $tablet->id;
            
            $comment->body =  $request->body;
            $tablet->comments()->save($comment);

            Alert::success('Success!', 'Tablet coorporativa' . ' ' .  $tablet->license_plate . ' ' . 'Registrado correctamente en el sistema');
            return redirect()->route('tablets.index');


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tablet  $tablet
     * @return \Illuminate\Http\Response
     */
    public function show(Tablet $tablet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tablet  $tablet
     * @return \Illuminate\Http\Response
     */
    public function edit(Tablet $tablet)
    {
        if ($tablet->status != 'Activo - Asignado') {
            # code...
             // Nota: este es un servicio
            $providers = app(ProviderOrArticle::class)->getProviders();
            $commentsTablet = \App\Tablet::find($tablet)->pluck('comments')->collapse();

            return view('tablets.edit', [
                'tablet' => $tablet,
                'commentsTablet' => $commentsTablet,
                'providers' => $providers,
            ]);
        } else {
            # code...
            alert()->error('Nota','No puede editar esta tablet corporativa en este momento porque esta asignada a un
            empleado en este momento');
            return redirect()->route('tablets.index');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tablet  $tablet
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTabletRequest $request, Tablet $tablet)
    {
        $tablet->update($request->all());
        $sessionIdUser = Auth::id();

        $comment = new Comment();
        $comment->user_id = $sessionIdUser;
        $comment->commentable_id = $tablet->id;
    
        $comment->body =  $request->body;
        // dd($comment);

        $tablet->comments()->save($comment);
        Alert::success('Success!', 'Tablet coorporativa' . ' ' . $tablet->license_plate . 'Actualizada correctamente en el sistema');

        return redirect()->route('tablets.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tablet  $tablet
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tablet $tablet)
    {
        $exists = $tablet->assignments()->where('assignable_id', $tablet->id)->exists();
        try {
            if ($exists === true) {
                # code...
                // return 'No puede eliminarse porque esta asignado';
                alert()->error('Error!','No puede eliminar esta tablet corporativa porque esta asignada a un empleado en este momento')->persistent('Close');

                return redirect()->route('tablets.index');

            } else {
                # code...
                if ($tablet->status  === 'Inactivo - No Asignado' ) {
                    # code...
                    // return 'se puede eliminar porque contiene el status';
                    alert()->success('Nota','La Tablet Corporativa' . ' ' . $tablet->license_plate . ' ' . 'a sido eliminada 
                    correctamente del sistema');

                    $updateStatusPostDelete = 'Eliminado - Baja de Activo';
                    $whenUserDeleteTablet = Auth::id();
                    \App\Tablet::where('id','=', $tablet->id)->update(['status' => $updateStatusPostDelete, 'user_id' => $whenUserDeleteTablet]);

                    $tablet->delete();

                    return redirect()->route('tablets.index');

                } else {
                    # code...
                    // return 'no se puede eliminar porque no contiene el status';
                    alert()->error('Error!','No puede Eliminar esta Tablet Corporativa, porque el estado actual es'
                    . ' ' . $tablet->status)->persistent('Close');

                    return redirect()->route('tablets.index');
                }
            }
            
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function removeDisabledTablets(){
        $tabletsRetiradas = DB::table('tablets')->where('status', '=', 'Eliminado - Baja de Activo')->count();
        $tabletsRemoveInventary = DB::table('tablets')->where('status', '=', 'Eliminado - Baja de Activo')->get();

        return view('tablets.remove-&-disabled-tablets', [
            'tabletsRemoveInventary' => $tabletsRemoveInventary,
            'tabletsRetiradas' => $tabletsRetiradas
        ]);
        
    }
}
