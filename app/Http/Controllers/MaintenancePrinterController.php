<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMaintenancePrinterRequest;
use App\Http\Requests\UpdateMaintenancePrinterRequest;
use App\MaintenancePrinter;
use App\Printer;
use DB;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Storage;

class MaintenancePrinterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //code..
        $totalPrinters = Printer::count();
        $totalMaintenancePrinters = MaintenancePrinter::count();
        $totalMaintenancesPreventivo = DB::table('maintenance_printers')->where('maintenance_type', '=', 'Mantenimiento Preventivo')->count();
        $totalMaintenancesCorrectivo = DB::table('maintenance_printers')->where('maintenance_type', '=', 'Mantenimiento Correctivo')->count();
        $totalReportesGarantia = DB::table('maintenance_printers')->where('maintenance_type', '=', 'Reporte por Garantia')->count();

        $printers = \App\Printer::all();

        return view('maintenances.maintenance-of-printers.index', [
            'totalPrinters' => $totalPrinters,
            'totalMaintenancePrinters' => $totalMaintenancePrinters,
            'totalMaintenancesPreventivo' => $totalMaintenancesPreventivo,
            'totalMaintenancesCorrectivo' => $totalMaintenancesCorrectivo,
            'totalReportesGarantia' => $totalReportesGarantia,

            'printers' => $printers,

        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Printer $printer)
    {
        return view('maintenances.maintenance-of-printers.create', compact('printer'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMaintenancePrinterRequest $request)
    {
        //code..
        $maintenancePrinter = new \App\MaintenancePrinter;

        $maintenancePrinter->maintenance_date = $request->maintenance_date;
        $maintenancePrinter->maintenance_type = $request->maintenance_type;
        $maintenancePrinter->maintenance_description = $request->maintenance_description;
        $maintenancePrinter->responsible_maintenance = $request->responsible_maintenance;
        $maintenancePrinter->observations = $request->observations;
        $maintenancePrinter->user_id = $request->user_id;
        $maintenancePrinter->printer_id = $request->printer_id;

        // PDF -> Upload attachments
        if ($request->hasFile('attachments')) {

            $nombre = $request->attachments->getClientOriginalName();
            $request->attachments->storeAs('public/Attachments-maintenances/Maintenance-printers/', $nombre);
            $maintenancePrinter->attachments = $nombre;

            $maintenancePrinter->save();
            $maintenancePrinterLast = MaintenancePrinter::all()->last();

            Alert::success('Success!', $maintenancePrinterLast->maintenance_type . ' ' . 'N°' . ' ' . $maintenancePrinterLast->id . ' ' .
                'Registrado correctamente en el sistema')
                ->persistent('Close');

            return redirect()->route('maintenances.maintenance-of-printers.history');

        } else {

            $maintenancePrinter->save();
            $maintenancePrinterLast = MaintenancePrinter::all()->last();

            Alert::info('Nota!', 'Registro un mantenimiento de una impresora sin adjuntos!!, El mantenimiento a sido registrado correctamente en el sistema' . ' ' . $maintenancePrinterLast->maintenance_type . ' ' . 'N°' . ' ' . $maintenancePrinterLast->id)
                ->persistent('Close');
            return redirect()->route('maintenances.maintenance-of-printers.history');

        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MaintenancePrinter  $maintenancePrinter
     * @return \Illuminate\Http\Response
     */
    public function show(MaintenancePrinter $historyMaintenance)
    {
        return view('maintenances.maintenance-of-printers.show', compact('historyMaintenance'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MaintenancePrinter  $maintenancePrinter
     * @return \Illuminate\Http\Response
     */
    public function edit(MaintenancePrinter $historyMaintenance)
    {
        return view('maintenances.maintenance-of-printers.edit', compact('historyMaintenance'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MaintenancePrinter  $maintenancePrinter
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMaintenancePrinterRequest $request, MaintenancePrinter $historyMaintenance)
    {

        $historyMaintenance->maintenance_date = $request->maintenance_date;
        $historyMaintenance->maintenance_type = $request->maintenance_type;
        $historyMaintenance->maintenance_description = $request->maintenance_description;
        $historyMaintenance->responsible_maintenance = $request->responsible_maintenance;
        $historyMaintenance->observations = $request->observations;
        $historyMaintenance->user_id = $request->user_id;
        $historyMaintenance->printer_id = $request->printer_id;

        // PDF -> Upload attachments
        if ($request->hasFile('attachments')) {
            Storage::delete('public/Attachments-maintenances/Maintenance-printers/' . $historyMaintenance->attachments);

            $file = $request->hasFile('attachments');
            $nombre = $request->attachments->getClientOriginalName();
            $file = $request->attachments->storeAs('public/Attachments-maintenances/Maintenance-computers/', $nombre);
            $historyMaintenance->attachments = $nombre;
            $historyMaintenance->update();

            Alert::success('Success!', $historyMaintenance->maintenance_type . ' ' . 'N°' . ' ' . $historyMaintenance->id . ' ' .
                'Actualizado correctamente en el sistema')
                ->persistent('Close');

            return redirect()->route('maintenances.maintenance-of-printers.history');

        } else {
            Storage::delete('public/Attachments-maintenances/Maintenance-printers/' . $historyMaintenance->attachments);
            $historyMaintenance->attachments = null;
            $historyMaintenance->update();

            Alert::info('Nota!', 'Actualizo un mantenimiento de una impresora sin adjuntos y se a registrado correctamente en el sistema' . ' ' . $historyMaintenance->maintenance_type . ' ' . 'N°' . ' ' . $historyMaintenance->id)
                ->persistent('Close');
            return redirect()->route('maintenances.maintenance-of-printers.history');

        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MaintenancePrinter  $maintenancePrinter
     * @return \Illuminate\Http\Response
     */
    public function destroy(MaintenancePrinter $maintenancePrinter)
    {
        //
    }

    public function historyMaintenances()
    {
        $totalMaintenances = MaintenancePrinter::count();
        $historyMaintenances = \App\MaintenancePrinter::all();

        return view('maintenances.maintenance-of-printers.history', compact('historyMaintenances', 'totalMaintenances'));
    }
}
