<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;
use App\RelationshipConfiguration;
use DB;
use App;

class CheckListController extends Controller
{
   

    public function operationalAgreement(Employee $employee)
    {
        $computers = DB::table('relationship_configurations')
        ->join('computers', 'relationship_configurations.assignable_id', '=', 'computers.id')
        ->where('relationship_configurations.employee_id', '=', $employee->id)
        ->where('relationship_configurations.assignable_type', '=', 'App\Computer')
        ->get();

        $computersCount = DB::table('relationship_configurations')
        ->join('computers', 'relationship_configurations.assignable_id', '=', 'computers.id')
        ->where('relationship_configurations.employee_id', '=', $employee->id)
        ->where('relationship_configurations.assignable_type', '=', 'App\Computer')
        ->count();

        $tablets = DB::table('relationship_configurations')
        ->join('tablets', 'relationship_configurations.assignable_id', '=', 'tablets.id')
        ->where('relationship_configurations.employee_id', '=', $employee->id)
        ->where('relationship_configurations.assignable_type', '=', 'App\Tablet')
        ->get();

        $tabletsCount = DB::table('relationship_configurations')
        ->join('tablets', 'relationship_configurations.assignable_id', '=', 'tablets.id')
        ->where('relationship_configurations.employee_id', '=', $employee->id)
        ->where('relationship_configurations.assignable_type', '=', 'App\Tablet')
        ->count();

        $monitors = DB::table('relationship_configurations')
        ->join('monitors', 'relationship_configurations.assignable_id', '=', 'monitors.id')
        ->where('relationship_configurations.employee_id', '=', $employee->id)
        ->where('relationship_configurations.assignable_type', '=', 'App\Monitor')
        ->get();

        $monitorsCount = DB::table('relationship_configurations')
        ->join('monitors', 'relationship_configurations.assignable_id', '=', 'monitors.id')
        ->where('relationship_configurations.employee_id', '=', $employee->id)
        ->where('relationship_configurations.assignable_type', '=', 'App\Monitor')
        ->count();

        $perisfericos = DB::table('relationship_configurations')
        ->join('other_peripherals', 'relationship_configurations.assignable_id', '=', 'other_peripherals.id')
        ->where('relationship_configurations.employee_id', '=', $employee->id)
        ->where('relationship_configurations.assignable_type', '=', 'App\OtherPeripheral')
        ->get();

        $perisfericosCount = DB::table('relationship_configurations')
        ->join('other_peripherals', 'relationship_configurations.assignable_id', '=', 'other_peripherals.id')
        ->where('relationship_configurations.employee_id', '=', $employee->id)
        ->where('relationship_configurations.assignable_type', '=', 'App\OtherPeripheral')
        ->count();

        $pdf = \App::make('snappy.pdf.wrapper');

        $pdf = \PDF::loadView('reports.operational-agreements.download', [
            'employee' => $employee,
            'computers' => $computers,
            'computersCount' => $computersCount,
            'tablets' => $tablets,
            'tabletsCount' => $tabletsCount,
            'monitors' => $monitors,
            'monitorsCount' => $monitorsCount,
            'perisfericos' => $perisfericos,
            'perisfericosCount' => $perisfericosCount
        ]);

        return $pdf->stream();
        
    }


}
