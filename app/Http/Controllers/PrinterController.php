<?php

namespace App\Http\Controllers;

use App\Article;
use App\Comment;
use App\Http\Requests\StorePrinterRequest;
use App\Http\Requests\UpdatePrinterRequest;
use App\Printer;
use App\Provider;
use App\Services\ProviderOrArticle;
use Auth;
use DB;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PrinterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $printers = \App\Printer::all();
        $printersTotal = \App\Printer::all()->count();

        return view('peripherals.printers.index', compact('printers', 'printersTotal'));
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

        if ($providersValidation >= 1 && $articlesValidation >= 1) {
            # code...
            // Nota: este es un servicio
            $providers = app(ProviderOrArticle::class)->getProviders();
            return view('peripherals.printers.create', compact('providers'));

        } else {

            alert()->html('<i>Provedor ó Articulo, no registrado en el sistema</i>', "

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
          ", 'error')->persistent('Close');

            return redirect()->route('peripherals.printers.index');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePrinterRequest $request)
    {
        $printer = new \App\Printer;
        $printer->create($request->all());

        // se obtiene el ultimo computer creado
        $printer = Printer::all()->last();

        // se obtiene el id del computer
        $idprinter = $printer->id;

        // se obtiene el id del usuario que esta en la sesion
        $sessionIdUser = Auth::id();

        // se agrega una relacion polimorfica en tabla comments se agrega modelo y se crea un nuevo comentario
        $comment = new Comment();
        $comment->user_id = $sessionIdUser;
        $comment->commentable_id = $printer->id;

        $comment->body = $request->body;
        $printer->comments()->save($comment);

        Alert::success('Success!', 'Perisferico Ci: Impresora' . ' ' . $printer->license_plate . ' ' . 'Registrado correctamente en el sistema');

        return redirect()->route('peripherals.printers.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Printer  $printer
     * @return \Illuminate\Http\Response
     */
    public function show(Printer $printer)
    {
        return view('peripherals.printers.show', compact('printer'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Printer  $printer
     * @return \Illuminate\Http\Response
     */
    public function edit(Printer $printer)
    {
        // Nota: este es un servicio
        $providers = app(ProviderOrArticle::class)->getProviders();
        $commentsPrinter = \App\Printer::find($printer)->pluck('comments')->collapse();

        return view('peripherals.printers.edit', [
            'printer' => $printer,
            'commentsPrinter' => $commentsPrinter,
            'providers' => $providers,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Printer  $printer
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePrinterRequest $request, Printer $printer)
    {
        $printer->update($request->all());
        $sessionIdUser = Auth::id();

        $comment = new Comment();
        $comment->user_id = $sessionIdUser;
        $comment->commentable_id = $printer->id;

        $comment->body = $request->body;
        // dd($comment);

        $printer->comments()->save($comment);

        Alert::success('Success!', 'Perisferico Ci Impresora' . ' ' . $printer->license_plate . ' ' . 'Actualizado correctamente en el sistema');

        return redirect()->route('peripherals.printers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Printer  $printer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Printer $printer)
    {
        try {
            if ($printer->status === 'Retirado - Baja de Activo') {
                $updateStatusPostDelete = 'Retirado - Baja de Activo';
                $whenUserDeletePrinter = Auth::id();
                Printer::where('id', '=', $printer->id)->update(['status' => $updateStatusPostDelete, 'user_id' => $whenUserDeletePrinter]);
                $printer->delete();
                alert()->info('Atención', 'La impresora' . ' ' . $printer->license_plate . ' ' . 'a sido eliminada
                correctamente del sistema');
                return redirect()->route('peripherals.printers.remove-&-disabled-printers');
            } else {

                Alert::error('Error, Eliminar Printer', 'No puede eliminar esta perisferico - impresora porque el estado actual es'
                    . ' ' . $printer->status)->persistent('Close');

                return redirect()->route('peripherals.printers.index');
            }
        } catch (\Illuminate\Database\QueryException $e) {
            return alert()->error('Error', 'Se presento un error al momento de eliminar la siguiente impresora del sistema'+$e);
        }
    }

    public function removeDisabledPrinters()
    {
        $printersRemoveInventary = DB::table('printers')->where('status', 'like', '%Retirado - Baja de Activo%')->get();
        $printersRemove = DB::table('printers')->where('status', 'like', '%Retirado - Baja de Activo%')->count();

        return view('peripherals.printers.remove-&-disabled-printers', [
            'printersRemoveInventary' => $printersRemoveInventary,
            'printersRemove' => $printersRemove,
        ]);
    }
}
