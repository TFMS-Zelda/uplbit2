<?php

namespace App\Http\Controllers;

use App\Provider;
use App\Company;
use App\Article;


use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\StoreProviderRequest;
use DB;
use App\Http\Requests\UpdateProviderRequest;


class ProviderController extends Controller
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

        $providers = \App\Provider::orderBy('id', 'DESC')
        ->paginate(10);   
        $totalProviderRegistrados = \App\Provider::count();
             
        return view('providers.index', [
            'providers' => $providers,
            'totalProviderRegistrados' => $totalProviderRegistrados,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = DB::table('companies')->get();
        if ($companies->isEmpty()) {
            Alert::error('Error, Crear Provedor', '
            No se encontro una compañia registrada en el sistema.')->persistent('Close');
        
            return view('providers.create', [
                'companies' => $companies,
            ]);
          
        } else {
            # code...
            return view('providers.create', [
                'companies' => $companies,
            ]);
        }

        return view('providers.create', compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProviderRequest $request)
    {
        $provider = new \App\Provider;
        if ($provider) {
            # code...
            $provider->create($request->all());
            $alertCompañiaCreada = alert()->success('Provedor Creado','Correctamente en el sistema...');
            return redirect()->route('providers.index', compact('alertProvedorCreado'));

        } else {
            # code...
            $errorCreateProvider = alert()->danger('Provedor no Creado', 'Se ha presentado un error');
            return redirect()->route('providers.index', compact('errorCreateProvider'));

        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function show(Provider $provider)
    {
        return view('providers.show', compact('provider'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function edit(Provider $provider)
    {
        $companies = DB::table('companies')->get();
        return view('providers.edit', [
            'provider' => $provider,
            'companies' => $companies,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProviderRequest $request, Provider $provider)
    {
        $provider->update($request->all());
        Alert::success('Success!', 'Provedor' . ' ' . $provider->name . 'Actualizado correctamente en el sistema');
        return redirect()->route('providers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function destroy(Provider $provider)
    {
        try {

            $provider->delete();
            alert()->info('Atención','El Provedor' . ' ' . $provider->provider . ' ' . $provider->kind_of_society . ' ' . 'a sido eliminado correctamente del sistema');
    
            return redirect()->route('providers.index');
        
        } catch (\Illuminate\Database\QueryException $e){
            
            return alert()->error('ErrorAlert','Se ha presentado un error en el sistema al momento de eliminar el Provedor.' . ' ' .  $provider->provider . ' ' . $provider->kind_of_society . $e);

        }

       
    }

}
