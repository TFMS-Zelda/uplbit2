<?php

namespace App\Http\Controllers;
use RealRashid\SweetAlert\Facades\Alert;

use DB;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
     //information-&-technologies
    public function index(){
        $computers = \App\Computer::all('id')
        ->count();

        $tablets = \App\Tablet::all('id')
        ->count();
        
        $printers = \App\Printer::all('id')
        ->count();

        $monitors = \App\Monitor::all('id')
        ->count();

        $peripherals = \App\OtherPeripheral::all('id')
        ->count();

        $companies = \App\Company::all('id')
        ->count();

        $providers = \App\Provider::all('id')
        ->count();

        $articles = \App\Article::all('id')
        ->count();


        return \view('information-&-technologies.dashboard', [
            'computers' => $computers,
            'tablets' => $tablets,
            'printers' => $printers,
            'monitors' => $monitors,
            'peripherals' => $peripherals,
            'companies' => $companies,
            'providers' => $providers,
            'articles' => $articles,
        ]);
    }
}
