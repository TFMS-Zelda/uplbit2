<?php

namespace App\Http\Controllers;

use App\Article;
use App\Provider;
use App\Comment;

use Illuminate\Http\Request;
use Auth;
use DB;
use RealRashid\SweetAlert\Facades\Alert;
use Storage;

use App\Services\ProviderOrArticle;

class ArticleController extends Controller
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
        //Code.
        $articles = \App\Article::orderBy('id', 'DESC')
        ->paginate(10);
        $totalArticlesRegister = \App\Article::count();

        return view('articles.index', [
            'articles' => $articles,
            'totalArticlesRegister' => $totalArticlesRegister

            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $providers = DB::table('providers')->get();
        if ($providers->isEmpty()) {
            Alert::error('Error, Crear Articulo', '
            No se encontro un provedor registrado en el sistema.')->persistent('Close');
           
            return view('articles.create', [
                'providers' => $providers,
            ]);
          
        } else {
            # code...
            return view('articles.create', [
                'providers' => $providers,
            ]);
        }
    
        return view('articles.create', compact('providers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'area' => 'required|string|max:128',
            'invoice_date' => 'required|date|before:expiration_date',
            'expiration_date' => 'required|date|after:invoice_date',
            'remission' => 'required|max:64|unique:articles,remission',
            'quotation' => 'required|max:64|unique:articles,quotation',
            'quantity' => 'required|numeric',
            'total_value' => 'required|string|max:128',
            'total_bill' => 'required|string|max:128',
            'total_in_letters' => 'required|string|max:512',
            'invoice_number' => 'required|unique:articles|max:64',
            'seller' => 'required|string|max:128|regex:/^[\pL\s\-]+$/u',   
            'digital_invoice' => 'required|unique:articles|max:1024|mimes:pdf',
            'observations' => 'required|min:4|max:1024',
            'provider_id' => 'required|numeric',
            'user_id' => 'required|numeric',
        ]);

        $article = new \App\Article;

        $article->area = $request->area;
        $article->invoice_date = $request->invoice_date;
        $article->expiration_date = $request->expiration_date;
        $article->remission = $request->remission;
        $article->quotation = $request->quotation;
        $article->quantity = $request->quantity;
        $article->total_value = $request->total_value;
        $article->total_bill = $request->total_bill;
        $article->total_in_letters = $request->total_in_letters;
        $article->invoice_number = $request->invoice_number;
        $article->seller = $request->seller;
        $article->observations = $request->observations;

        $article->user_id = $request->user_id;
        $article->provider_id = $request->provider_id;

        // PDF -> Upload File Digital Invoice
        if ($request->hasFile('digital_invoice')) {

            $nombre = $request->digital_invoice->getClientOriginalName();
            $request->digital_invoice->storeAs('public/Invoices-articles-providers', $nombre);
            $article->digital_invoice = $nombre;
        
            $article->save();
            Alert::success('Success!', 'Articulo con' . ' ' . 'Factura #:' . ' ' . $article->invoice_number . 'Registrado correctamente en el sistema');
            return redirect()->route('articles.index');
    
        } else {
            Alert::danger('Error!', 'Se presentó un error al momento de registrar un articulo en el sistema');

        }
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        return view('articles.show', [
            'article' => $article

        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        $providers = DB::table('providers')->get();
        return view('articles.edit', [
            'providers' => $providers,
            'article' => $article,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        $this->validate($request, [
            'area' => 'required|string|max:128',
            'invoice_date' => 'required|date|before:expiration_date',
            'expiration_date' => 'required|date|after:invoice_date',
            'remission' => 'required|max:64|unique:articles,remission,'.$article->id,
            'quotation' => 'required|max:64|unique:articles,quotation,'.$article->id,
            'quantity' => 'required|numeric',
            'total_value' => 'required|string|max:128',
            'total_bill' => 'required|string|max:128',
            'total_in_letters' => 'required|string|max:512',
            'invoice_number' => 'required|max:64|unique:articles,invoice_number,'.$article->id,
            'seller' => 'required|string|max:128|regex:/^[\pL\s\-]+$/u',   
            'digital_invoice' => 'required|unique:articles|max:1024|mimes:pdf,digital_invoice,'.$article->id,
            'observations' => 'required|min:4|max:1024',
            'provider_id' => 'required|numeric',
            'user_id' => 'required|numeric',
        ]);   

        $article->area = $request->area;
        $article->invoice_date = $request->invoice_date;
        $article->expiration_date = $request->expiration_date;
        $article->remission = $request->remission;
        $article->quotation = $request->quotation;
        $article->quantity = $request->quantity;
        $article->total_value = $request->total_value;
        $article->total_bill = $request->total_bill;
        $article->total_in_letters = $request->total_in_letters;
        $article->invoice_number = $request->invoice_number;
        $article->seller = $request->seller;
        $article->observations = $request->observations;

        $article->user_id = $request->user_id;
        $article->provider_id = $request->provider_id;

        if ($request->hasFile('digital_invoice')) {
            Storage::delete('public/Invoices-articles-providers/'.$article->digital_invoice);

            $file = $request->hasFile('digital_invoice');
            $nombre = $request->digital_invoice->getClientOriginalName();
            $file = $request->digital_invoice->storeAs('public/Invoices-articles-providers', $nombre);
            $article->digital_invoice= $nombre;

            $article->update();
            Alert::success('Success!', 'Articulo con' . ' ' . 'Factura #:' . ' ' . $article->invoice_number . 'Actualizado correctamente en el sistema');
            return redirect()->route('articles.index');
           
        } else {
            # code...
            Alert::danger('Error!', 'Se presento un error al momento de actualizar el articulo' . ' ' . $article->invoice_number);

        }  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        try {

            $article->delete();
            alert()->info('Atención','El Articulo, con factura #' . ' ' . $article->invoice_number . ' ' . 'a sido eliminado
            correctamente del provedor' . ' ' . $article->provider->name . ' ' . 'y del sistema');
    
            return redirect()->route('articles.index');
        
        } catch (\Illuminate\Database\QueryException $e){
            
            return alert()->error('ErrorAlert','se presento un error al momento de eliminar el articulo.' + $e);

        }
       
    }


}
