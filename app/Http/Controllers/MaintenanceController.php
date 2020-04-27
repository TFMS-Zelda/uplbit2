<?php

namespace App\Http\Controllers;

use App\Maintenance;
use Illuminate\Http\Request;
use App\MaintenanceComputer;
use App\MaintenancePrinter;



class MaintenanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $totalMaintenanceComputer = MaintenanceComputer::count();
        $totalMaintenancePrinter = MaintenancePrinter::count();


        return view('maintenances.index', [
            'totalMaintenanceComputer' => $totalMaintenanceComputer,
            'totalMaintenancePrinter' => $totalMaintenancePrinter,


        ]);
    }


}
