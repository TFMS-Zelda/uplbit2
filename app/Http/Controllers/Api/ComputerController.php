<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Computer;
use DB;


class ComputerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $computers = DB::table('computers')->where('status', 'like', '%No Asignado%')->get();
        return $computers;

    }



 
}
