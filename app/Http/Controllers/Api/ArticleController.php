<?php

namespace App\Http\Controllers\Api;
use Illuminate\Support\Facades\Response;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function getAllArticlesByIdProvider($id){
        $articles = \App\Article::where('provider_id', $id)
        ->pluck('invoice_number', 'id');
        return Response::json($articles);
    }
}
