<?php

namespace App\Http\Controllers;

use App\OtherPeripheral;
use Illuminate\Http\Request;
use App\Provider;
use App\Article;
use RealRashid\SweetAlert\Facades\Alert;
use DB;
use Auth;
use App\Comment;
use App\Services\ProviderOrArticle;;
use App\Http\Requests\StoreOtherPeripheralsRequest;
use App\Http\Requests\UpdateOtherPeripheralsRequest;


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
        $providersValidation = Provider::count();
        $articlesValidation = Article::count();

        if ($providersValidation >= 1 && $articlesValidation >= 1 ) {
             # code...
            // Nota: este es un servicio
            $providers = app(ProviderOrArticle::class)->getProviders();
            return view('peripherals.other-peripherals.create', compact('providers'));
            
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
            
            return redirect()->route('peripherals.other-peripherals.index');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOtherPeripheralsRequest $request)
    {
        $otherPeripheral = new \App\OtherPeripheral;
        $otherPeripheral->create($request->all());
        
        // se obtiene el ultimo computer creado
        $thePeripheral = OtherPeripheral::all()->last();

        // se obtiene el id del usuario que esta en la sesion
        $sessionIdUser = Auth::id();

        // se agrega una relacion polimorfica en tabla comments se agrega modelo y se crea un nuevo comentario
        $comment = new Comment();
        $comment->user_id = $sessionIdUser;
        $comment->commentable_id = $thePeripheral->id;
    
        $comment->body =  $request->body;
        $thePeripheral->comments()->save($comment);

        Alert::success('Success!', 'Perisferico Ci' . ' ' . $thePeripheral->license_plate . ' ' . 'Registrado correctamente en el sistema');

        return redirect()->route('peripherals.other-peripherals.index');
    
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
        // Nota: este es un servicio
        $providers = app(ProviderOrArticle::class)->getProviders();
        $commentsOtherPeripherals = OtherPeripheral::find($otherPeripheral)->pluck('comments')->collapse();

        return view('peripherals.other-peripherals.edit', [
            'otherPeripheral' => $otherPeripheral,
            'commentsOtherPeripherals' => $commentsOtherPeripherals,
            'providers' => $providers,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\OtherPeripheral  $otherPeripheral
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOtherPeripheralsRequest $request, OtherPeripheral $otherPeripheral)
    {
        $otherPeripheral->update($request->all());
          
        $sessionIdUser = Auth::id();

        $comment = new Comment();
        $comment->user_id = $sessionIdUser;
        $comment->commentable_id = $otherPeripheral->id;
    
        $comment->body =  $request->body;
        // dd($comment);

        $otherPeripheral->comments()->save($comment);

        Alert::success('Success!', 'Perisferico' . $otherPeripheral->license_plate . 'Actualizado correctamente en el sistema');

        return redirect()->route('peripherals.other-peripherals.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\OtherPeripheral  $otherPeripheral
     * @return \Illuminate\Http\Response
     */
    public function destroy(OtherPeripheral $otherPeripheral)
    {
        $exists = $otherPeripheral->assignments()->where('assignable_id', $otherPeripheral->id)->exists();
        try {
            if ($exists === true) {
                # code...
                // return 'No puede eliminarse porque esta asignado';
                alert()->error('Error!','No puede Eliminar este Perisférico porque esta asignado a un empleado en este momento')->persistent('Close');

                return redirect()->route('peripherals.other-peripherals.index');

            } else {
                # code...
                if ($otherPeripheral->status  === 'Inactivo - No Asignado' ) {
                    # code...
                    // return 'se puede eliminar porque contiene el status';
                    alert()->success('Nota','El Perisférico' . ' ' . $otherPeripheral->license_plate . ' ' . 'a sido eliminado 
                    correctamente del sistema');

                    $updateStatusPostDelete = 'Eliminado - Baja de Activo';
                    $whenUserDeletePeripheral = Auth::id();
                    OtherPeripheral::where('id','=', $otherPeripheral->id)->update(['status' => $updateStatusPostDelete, 'user_id' => $whenUserDeletePeripheral]);

                    $computer->delete();

                    return redirect()->route('peripherals.other-peripherals.index');

                } else {
                    # code...
                    // return 'no se puede eliminar porque no contiene el status';
                    alert()->error('Error!','No puede Eliminar este Perisférico, porque el estado actual es'
                    . ' ' . $otherPeripheral->status)->persistent('Close');

                    return redirect()->route('peripherals.other-peripherals.index');
                }

            }
            
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    

    public function removeDisabledOtherPeripheral()
    {
        $otherPeripheralRemoveInventary = DB::table('other_peripherals')->where('status', '=', 'Eliminado - Baja de Activo')->get();
        $peripheralRemove = DB::table('other_peripherals')->where('status', '=', 'Eliminado - Baja de Activo')->count();

        return view('peripherals.other-peripherals.remove-&-disabled-other-peripherals', [
            'otherPeripheralRemoveInventary' => $otherPeripheralRemoveInventary,
            'peripheralRemove' => $peripheralRemove
        ]);
    }
}
