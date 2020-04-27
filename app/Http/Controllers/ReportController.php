<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// BarryPDF
use PDF;


use App\MaintenanceComputer;
use App\MaintenancePrinter;


class ReportController extends Controller
{

    public function downloadReportMaintenanceComputer(MaintenanceComputer $historyMaintenance) {
        // dd($historyMaintenance);
        $pdf = PDF::loadView('reports.maintenance-of-computers.download', compact('historyMaintenance'));
        return $pdf->stream();
    }

    public function downloadReportMaintenancePrinter(MaintenancePrinter $historyMaintenance) {
        $pdf = PDF::loadView('reports.maintenance-of-printers.download', compact('historyMaintenance'));
        return $pdf->stream();
    }
}
