<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckListController extends Controller
{
    //code...
    public function index()
    {
        return view('checklists.index');
    }
}
