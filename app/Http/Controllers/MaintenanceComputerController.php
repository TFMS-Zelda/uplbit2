<?php

namespace App\Http\Controllers;

use App\MaintenanceComputer;
use Illuminate\Http\Request;
use App\Computer;
use App\Http\Requests\StoreMaintenanceComputerRequest;
use App\Http\Requests\UpdateMaintenanceComputerRequest;

use RealRashid\SweetAlert\Facades\Alert;
use DB;
use Storage;

class MaintenanceComputerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $totalComputers = Computer::count();
        $totalMaintenances = MaintenanceComputer::count();
        $totalMaintenancesPreventivo  = DB::table('maintenance_computers')->where('maintenance_type', '=', 'Mantenimiento Preventivo')->count();
        $totalMaintenancesCorrectivo  = DB::table('maintenance_computers')->where('maintenance_type', '=', 'Mantenimiento Correctivo')->count();
        $totalReportesGarantia  = DB::table('maintenance_computers')->where('maintenance_type', '=', 'Reporte por Garantia')->count();

        $computers = \App\Computer::orderBy('id', 'DESC')
        ->paginate(10);

        return view('maintenances.maintenance-of-computers.index', [
            'totalComputers' => $totalComputers,
            'computers' => $computers,
            'totalMaintenances' => $totalMaintenances,
            'totalMaintenancesPreventivo' => $totalMaintenancesPreventivo,
            'totalMaintenancesCorrectivo' => $totalMaintenancesCorrectivo,
            'totalReportesGarantia' => $totalReportesGarantia,

        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Computer $computer)
    {   
        
        return view('maintenances.maintenance-of-computers.create', compact('computer'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMaintenanceComputerRequest $request)
    {

        $maintenanceComputer = new \App\MaintenanceComputer;

        $maintenanceComputer->maintenance_date = $request->maintenance_date;
        $maintenanceComputer->maintenance_type = $request->maintenance_type;
        $maintenanceComputer->maintenance_description = $request->maintenance_description;
        $maintenanceComputer->responsible_maintenance = $request->responsible_maintenance;
        $maintenanceComputer->observations = $request->observations;
        $maintenanceComputer->user_id = $request->user_id;
        $maintenanceComputer->computer_id = $request->computer_id;
        
        // PDF -> Upload attachments 
        if ($request->hasFile('attachments')) {

            $nombre = $request->attachments->getClientOriginalName();
            $request->attachments->storeAs('public/Attachments-maintenances/Maintenance-computers/', $nombre);
            $maintenanceComputer->attachments = $nombre;
        
            $maintenanceComputer->save();
            $maintenanceComputerLast = MaintenanceComputer::all()->last();
            
            Alert::success('Success!', $maintenanceComputerLast->maintenance_type . ' ' . 'N°' . ' ' . $maintenanceComputerLast->id . ' ' .
            'Registrado correctamente en el sistema')
            ->persistent('Close');
            
            return redirect()->route('maintenances.maintenance-of-computers.index');
        
        } else {
            
            $maintenanceComputer->save();
            $maintenanceComputerLast = MaintenanceComputer::all()->last();

            Alert::info('Nota!', 'Registro un mantenimiento sin adjuntos y se a registrado correctamente en el sistema' . ' ' .  $maintenanceComputerLast->maintenance_type . ' ' . 'N°' . ' ' . $maintenanceComputerLast->id)
            ->persistent('Close');
            return redirect()->route('maintenances.maintenance-of-computers.history');

        }


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MaintenanceComputer  $maintenanceComputer
     * @return \Illuminate\Http\Response
     */
    public function show(MaintenanceComputer $historyMaintenance)
    {
        $first = DB::table('maintenance_computers')
        ->where('attachments')->find($historyMaintenance); 
         
        return view('maintenances.maintenance-of-computers.show', compact('historyMaintenance', 'first'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MaintenanceComputer  $maintenanceComputer
     * @return \Illuminate\Http\Response
     */
    public function edit(MaintenanceComputer $historyMaintenance)
    {
        
        // dd($historyMaintenance);
        return view('maintenances.maintenance-of-computers.edit', compact('historyMaintenance'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MaintenancesComputer  $maintenancesComputer
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMaintenanceComputerRequest $request, MaintenanceComputer $historyMaintenance)
    {        
        $historyMaintenance->maintenance_date = $request->maintenance_date;
        $historyMaintenance->maintenance_type = $request->maintenance_type;
        $historyMaintenance->maintenance_description = $request->maintenance_description;
        $historyMaintenance->responsible_maintenance = $request->responsible_maintenance;
        $historyMaintenance->observations = $request->observations;
        $historyMaintenance->user_id = $request->user_id;
        $historyMaintenance->computer_id = $request->computer_id;
        
        // PDF -> Upload attachments 
        if ($request->hasFile('attachments')) {
            Storage::delete('public/Attachments-maintenances/Maintenance-computers/'.$historyMaintenance->attachments);

            $file = $request->hasFile('attachments');
            $nombre = $request->attachments->getClientOriginalName();
            $file = $request->attachments->storeAs('public/Attachments-maintenances/Maintenance-computers/', $nombre);
            $historyMaintenance->attachments= $nombre;
            $historyMaintenance->update();
            
            Alert::success('Success!', $historyMaintenance->maintenance_type . ' ' . 'N°' . ' ' . $historyMaintenance->id . ' ' .
            'Actualizado correctamente en el sistema')
            ->persistent('Close');
            
            return redirect()->route('maintenances.maintenance-of-computers.history');
        
        } else {
            Storage::delete('public/Attachments-maintenances/Maintenance-computers/'.$historyMaintenance->attachments);
            $historyMaintenance->attachments = null;

            $historyMaintenance->update();
            

            Alert::info('Nota!', 'Actualizo un mantenimiento de equipo de computo sin adjuntos y se a registrado correctamente en el sistema' . ' ' .  $historyMaintenance->maintenance_type . ' ' . 'N°' . ' ' . $historyMaintenance->id)
            ->persistent('Close');
            return redirect()->route('maintenances.maintenance-of-computers.history');

        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MaintenanceComputer  $maintenanceComputer
     * @return \Illuminate\Http\Response
     */
    public function destroy(MaintenanceComputer $historyMaintenance)
    {
        //
    }


    public function historyMaintenances()
    {
        $totalMaintenances = MaintenanceComputer::count();

        $historyMaintenances = \App\MaintenanceComputer::orderBy('id', 'DESC')
        ->paginate(10);
        return view('maintenances.maintenance-of-computers.history', compact('historyMaintenances', 'totalMaintenances'));
    }
}
