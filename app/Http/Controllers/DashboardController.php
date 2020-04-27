<?php

namespace App\Http\Controllers;
use RealRashid\SweetAlert\Facades\Alert;


use Illuminate\Http\Request;

class DashboardController extends Controller
{
     //information-&-technologies
     public function index(){

        return \view('information-&-technologies.dashboard');
    }
}
