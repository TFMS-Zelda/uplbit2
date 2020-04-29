<?php

namespace App\Http\Controllers;

use App\MaintenanceOtherPeripheral;
use App\OtherPeripheral;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use DB;
use Storage;
use App\Http\Requests\StoreMaintenanceOtherPeripheralRequest;
use App\Http\Requests\UpdateMaintenanceOtherPeripheralRequest;



class MaintenanceOtherPeripheralController extends Controller
{
 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         //code..
        $totalOtherPeripherals = OtherPeripheral::count();
        $totalMaintenance = MaintenanceOtherPeripheral::count();
        $totalMaintenancesPreventivo  = DB::table('maintenance_other_peripherals')->where('maintenance_type', '=', 'Mantenimiento Preventivo')->count();
        $totalMaintenancesCorrectivo  = DB::table('maintenance_other_peripherals')->where('maintenance_type', '=', 'Mantenimiento Correctivo')->count();
        $totalReportesGarantia  = DB::table('maintenance_other_peripherals')->where('maintenance_type', '=', 'Reporte por Garantia')->count();
       
        $OtherPeripherals = \App\OtherPeripheral::orderBy('id', 'DESC')
        ->paginate(10);

        return view('maintenances.maintenance-of-other-peripherals.index', [
            'OtherPeripherals' => $OtherPeripherals,
            'totalMaintenance' => $totalMaintenance,
            'totalOtherPeripherals' => $totalOtherPeripherals,
            'totalMaintenancesPreventivo' => $totalMaintenancesPreventivo,
            'totalMaintenancesCorrectivo' => $totalMaintenancesCorrectivo,
            'totalReportesGarantia' => $totalReportesGarantia,

            // 'printers' => $printers,

        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(OtherPeripheral $otherPeripheral)
    {
        return view('maintenances.maintenance-of-other-peripherals.create', compact('otherPeripheral'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMaintenanceOtherPeripheralRequest $request)
    {
        
        $maintenanceOtherPeripheral = new \App\MaintenanceOtherPeripheral;

        $maintenanceOtherPeripheral->maintenance_date = $request->maintenance_date;
        $maintenanceOtherPeripheral->maintenance_type = $request->maintenance_type;
        $maintenanceOtherPeripheral->maintenance_description = $request->maintenance_description;
        $maintenanceOtherPeripheral->responsible_maintenance = $request->responsible_maintenance;
        $maintenanceOtherPeripheral->observations = $request->observations;
        $maintenanceOtherPeripheral->user_id = $request->user_id;
        $maintenanceOtherPeripheral->other_peripherals_id = $request->other_peripherals_id;
        
        // PDF -> Upload attachments 
        if ($request->hasFile('attachments')) {

            $nombre = $request->attachments->getClientOriginalName();
            $request->attachments->storeAs('public/Attachments-maintenances/Maintenance-other-peripherals/', $nombre);
            $maintenanceOtherPeripheral->attachments = $nombre;
        
            $maintenanceOtherPeripheral->save();
            $maintenanceOtherPeripheralLast = MaintenanceOtherPeripheral::all()->last();
            
            Alert::success('Success!', $maintenanceOtherPeripheralLast->maintenance_type . ' ' . 'N°' . ' ' . $maintenanceOtherPeripheralLast->id . ' ' .
            'Registrado correctamente en el sistema')
            ->persistent('Close');
            
            return redirect()->route('maintenances.maintenance-of-other-peripherals.history');
        
        } else {
            
            $maintenanceOtherPeripheral->save();
            $maintenanceOtherPeripheralLast = MaintenanceOtherPeripheral::all()->last();

            Alert::info('Nota!', 'Registro un mantenimiento sin adjuntos y se a registrado correctamente en el sistema' . ' ' .  $maintenanceOtherPeripheralLast->maintenance_type . ' ' . 'N°' . ' ' . $maintenanceOtherPeripheralLast->id)
            ->persistent('Close');
            return redirect()->route('maintenances.maintenance-of-other-peripherals.history');

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MaintenanceOtherPeripheral  $maintenanceOtherPeripheral
     * @return \Illuminate\Http\Response
     */
    
     public function show(MaintenanceOtherPeripheral $historyMaintenance)
    {
        $first = DB::table('maintenance_computers')
        ->where('attachments')->find($historyMaintenance); 
         
        return view('maintenances.maintenance-of-other-peripherals.show', compact('historyMaintenance', 'first'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MaintenanceOtherPeripheral  $maintenanceOtherPeripheral
     * @return \Illuminate\Http\Response
     */
    public function edit(MaintenanceOtherPeripheral $historyMaintenance)
    {
         return view('maintenances.maintenance-of-other-peripherals.edit', compact('historyMaintenance'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MaintenanceOtherPeripheral  $maintenanceOtherPeripheral
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMaintenanceOtherPeripheralRequest $request, MaintenanceOtherPeripheral $historyMaintenance)
    {
        $historyMaintenance->maintenance_date = $request->maintenance_date;
        $historyMaintenance->maintenance_type = $request->maintenance_type;
        $historyMaintenance->maintenance_description = $request->maintenance_description;
        $historyMaintenance->responsible_maintenance = $request->responsible_maintenance;
        $historyMaintenance->observations = $request->observations;
        $historyMaintenance->user_id = $request->user_id;
        $historyMaintenance->other_peripherals_id = $request->other_peripherals_id;
        
        // PDF -> Upload attachments 
        if ($request->hasFile('attachments')) {
            Storage::delete('public/Attachments-maintenances/Maintenance-other-peripherals/'.$historyMaintenance->attachments);

            $file = $request->hasFile('attachments');
            $nombre = $request->attachments->getClientOriginalName();
            $file = $request->attachments->storeAs('public/Attachments-maintenances/Maintenance-other-peripherals/', $nombre);
            $historyMaintenance->attachments= $nombre;
            $historyMaintenance->update();
            
            Alert::success('Success!', $historyMaintenance->maintenance_type . ' ' . 'N°' . ' ' . $historyMaintenance->id . ' ' .
            'Actualizado correctamente en el sistema')
            ->persistent('Close');
            
            return redirect()->route('maintenances.maintenance-of-other-peripherals.history');
        
        } else {
            Storage::delete('public/Attachments-maintenances/Maintenance-printers/'.$historyMaintenance->attachments);
            $historyMaintenance->attachments = null;
            $historyMaintenance->update();

            Alert::info('Nota!', 'Actualizo un mantenimiento de un perisférico sin adjuntos y se a registrado correctamente en el sistema' . ' ' .  $historyMaintenance->maintenance_type . ' ' . 'N°' . ' ' . $historyMaintenance->id)
            ->persistent('Close');
            return redirect()->route('maintenances.maintenance-of-other-peripherals.history');

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MaintenanceOtherPeripheral  $maintenanceOtherPeripheral
     * @return \Illuminate\Http\Response
     */
    public function destroy(MaintenanceOtherPeripheral $maintenanceOtherPeripheral)
    {
        //
    }

     public function historyMaintenances()
    {
        $totalMaintenances = MaintenanceOtherPeripheral::count();

        $historyMaintenances = \App\MaintenanceOtherPeripheral::orderBy('id', 'DESC')
        ->paginate(10);
        return view('maintenances.maintenance-of-other-peripherals.history', compact('historyMaintenances', 'totalMaintenances'));
    }
}
