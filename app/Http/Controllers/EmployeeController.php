<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Company;
use App\RelationshipConfiguration;
use Illuminate\Http\Request;
use App\Http\Requests\StoreEmployeeRequest;
use RealRashid\SweetAlert\Facades\Alert;
use DB;
//Intervention Image
use Image;
use Storage;
use Auth;


class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(){
        $this->middleware('auth');
    }

    public function index()
    {
        //code
        $employees = \App\Employee::all();
    
        $totalEmployeesActivos = DB::table('employees')->where('status', 'like', '%Activo%')->count('id');
        return view('managers.employees.index', [
            'employees' => $employees,
            'totalEmployeesActivos' => $totalEmployeesActivos,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = DB::table('companies')->get();
        if ($companies->isEmpty()) {
            Alert::error('Error, Crear Empleado', '
            No se encontro una compañia registrada en el sistema.')->persistent('Close');
        
            return view('managers.employees.create', [
                'companies' => $companies,
            ]);
        
        } else {
            # code...
            return view('managers.employees.create', [
                'companies' => $companies,
            ]);
        }
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEmployeeRequest $request)
    {
        $employee = new \App\Employee;
        $employee->create($request->all());
        Alert::success('Success!', 'Empleado' . $employee->name . ' ' . 'Registrado correctamente en el sistema');

        return redirect()->route('managers.employees.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        return view('managers.employees.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        $companies = Company::all();

        return view('managers.employees.edit', [
            'employee' => $employee,
            'companies' => $companies,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        $this->validate($request, [
            'name' => 'required|string|max:128',
            'citizenship_card' => "required|digits_between:7,10|numeric|unique:employees,citizenship_card," .$employee->id,
            'email_corporate' => "required|email|max:128|unique:employees,email_corporate,".$employee->id,
            'job_title' => 'required|string|max:128',
            'employee_type' => 'required|string|max:128',
            'ugdn' => "required|digits:8|numeric|unique:employees,ugdn,".$employee->id,
            'status' => 'required|string|max:64',
            'work_area' => 'required|string|max:64',
            'country' => 'required|string|max:64',
            'city' => 'required|string|max:64',
            'phone' => "required|digits_between:7,10|numeric|unique:employees,phone,".$employee->id,
            'creation_date' => 'required|date',
            'company_id' => 'required|numeric',
            'user_id' => 'required|numeric',
            'profile_avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:1024',

        ]);

          $employee->name = $request->name;
          $employee->citizenship_card = $request->citizenship_card;
          $employee->email_corporate = $request->email_corporate;
          $employee->job_title = $request->job_title;
          $employee->employee_type = $request->employee_type;
          $employee->ugdn = $request->ugdn;
          $employee->status = $request->status;
          $employee->work_area = $request->work_area;
          $employee->country = $request->country;
          $employee->city = $request->city;
          $employee->phone = $request->phone;
          $employee->creation_date = $request->creation_date;
          $employee->company_id = $request->company_id;
          $employee->user_id = $request->user_id;

         // File -> Upload Update Profile Avatae 
         if ($request->hasFile('profile_avatar')) {
            Storage::delete('public/Employees-avatar/'.$employee->profile_avatar);
            // $file = $request->hasFile('profile_avatar');
            $nombre = $request->profile_avatar->getClientOriginalName();
            $file = $request->profile_avatar->storeAs('public/Employees-avatar', $nombre);
            $employee->profile_avatar= $nombre;
            $employee->update();
            
            Alert::success('Success!', 'Empleado' . ' '. $employee->name . ' ' . 'UGDN°' . ' ' . $employee->ugdn . ' ' .
            'Actualizado correctamente en el sistema')
            ->persistent('Close');
            
            return redirect()->route('managers.employees.index');
        
        } else {

            $employee->update();

            Alert::success('Success!', 'El Empleado' . ' '. $employee->name . ' ' . ' con UGDN' . ' ' . $employee->ugdn . ' ' .
            'a sido actualizado con exito, el avatar no a sido actualido por el usuario')
            ->persistent('Close');
            return redirect()->route('managers.employees.index');

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        // $exists = $employee->assignments()->where('assignable_id', $employee->id)->exists();
        $exists = \App\RelationshipConfiguration::where('employee_id', '=',  $employee->id)->exists();
        try {
            if ($exists === true) {
                # code...
                // return 'No puede eliminarse porque esta asignado';
                alert()->error('Error!','No puede eliminar este Empleado, porque tiene CI´s asignados')->persistent('Close');

                return redirect()->route('managers.employees.index');

            } else {
                # code...
                if ($employee->status  === 'Inactivo' ) {
                    # code...
                    // return 'se puede eliminar porque contiene el status';
                    alert()->success('Nota','El Empleado' . ' ' . $employee->name . ' ' . $employee->ugdn . ' ' . 'a sido eliminado 
                    correctamente del sistema');

                    $updateStatusPostDelete = 'Eliminado';
                    $whenUserDelete = Auth::id();
                    Employee::where('id','=', $employee->id)->update(['status' => $updateStatusPostDelete, 'user_id' => $whenUserDelete]);

                    $employee->delete();

                    return redirect()->route('managers.employees.index');

                } else {
                    # code...
                    // return 'no se puede eliminar porque no contiene el status';
                    alert()->error('Error!','No puede Eliminar este Empleado, porque el estado actual es'
                    . ' ' . $employee->status)->persistent('Close');

                    return redirect()->route('managers.employees.index');
                }
            }
            
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function removeDisabledEmployees()
    {
        $employeeRemoveInventary = DB::table('employees')->where('status', '=', 'Eliminado')->get();
        $employeesRemove = DB::table('employees')->where('status', '=', 'Eliminado')->count();

        return view('managers.employees.remove-&-disabled-employees', [
            'employeeRemoveInventary' => $employeeRemoveInventary,
            'employeesRemove' => $employeesRemove
        ]);
    }
}
