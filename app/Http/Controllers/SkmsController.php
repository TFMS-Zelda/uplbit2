<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Skms;
use Auth;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class SkmsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $articlesKnowledge = Skms::count();
        $skms = Skms::orderBy('id', 'DESC')
            ->get();

        // dd($articlesKnowledge);
        $cmdb = 1;
        $cms = 1;
        $kedb = 1;
        return view('skms.index', compact('articlesKnowledge', 'skms', 'cmdb', 'cms', 'kedb'));
    }

    public function create()
    {
        return view('skms.create');
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'classification_file' => 'required|string|max:128',
            'category_file' => 'required|max:128',
            'name_file' => 'required|string|max:128|unique:skms',
            'creation_date' => 'required|date|max:128',
            'impact_level' => 'required|string|max:128',
            'user_id' => 'required|numeric',
            'code_file' => 'required|max:128|unique:skms',
            'status' => 'required|string|max:64',
            'digital_file' => 'required|unique:skms|max:5120|mimes:pdf',
        ]);

        $skms = new \App\Skms;
        $skms->classification_file = $request->classification_file;
        $skms->category_file = $request->category_file;
        $skms->name_file = $request->name_file;
        $skms->creation_date = $request->creation_date;
        $skms->impact_level = $request->impact_level;
        $skms->code_file = $request->code_file;
        $skms->user_id = $request->user_id;
        $skms->status = $request->status;

        // PDF -> Upload File Digital
        if ($request->hasFile('digital_file')) {
            $nombre = $request->digital_file->getClientOriginalName();
            $request->digital_file->storeAs('public/SKMS/Helpfile', $nombre);
            $skms->digital_file = $nombre;

            $skms->save();

            // se obtiene el id del usuario que esta en la sesion
            $sessionIdUser = Auth::id();

            // se agrega una relacion polimorfica en tabla comments se agrega modelo y se crea un nuevo comentario
            $comment = new Comment();
            $comment->user_id = $sessionIdUser;
            $comment->commentable_id = $skms->id;

            $comment->body = $request->body;
            $skms->comments()->save($comment);

            Alert::success('Success!', 'Árticulo Helpfile Knowledge' . $skms->name_file . 'agregado correctamente en la SKMS del sistema');
            return redirect()->route('skms.index');
        } else {
            Alert::danger('Error!', 'Se presentó un error al momento de agregar Árticulo Helpfile Knowledge');

        }

    }

    public function show($id)
    {
        $skms = Skms::findOrFail($id);
        // dd($skms->name_file);
        return view('skms.show', compact('skms'));
    }
}
