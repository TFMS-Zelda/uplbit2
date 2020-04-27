<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Company;
use Illuminate\Http\Request;
use App\Http\Requests\StoreEmployeeRequest;
use RealRashid\SweetAlert\Facades\Alert;
use DB;
//Intervention Image
use Image;



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
        $employees = \App\Employee::orderBy('id', 'DESC')
        ->paginate(10); 
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
        Alert::success('Success!', 'Empleado' . $employee->name . 'Registrado correctamente en el sistema');

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
            'citizenship_card' => "required|digits:10|numeric|unique:employees,citizenship_card," .$employee->id,
            'email_corporate' => "required|email|max:128|unique:employees,email_corporate,".$employee->id,
            'job_title' => 'required|string|max:128',
            'employee_type' => 'required|string|max:128',
            'ugdn' => "required|digits:8|numeric|unique:employees,ugdn,".$employee->id,
            'status' => 'required|string|max:64',
            'work_area' => 'required|string|max:64',
            'country' => 'required|string|max:64',
            'city' => 'required|string|max:64',
            'phone' => "required|digits:10|numeric|unique:employees,phone,".$employee->id,
            'creation_date' => 'required|date',
            'company_id' => 'required|numeric',
            'user_id' => 'required|numeric',
            'profile_avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024',

        ]);

    
       
        if ($request->hasFile('profile_avatar')) {
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
    
            # code...
            $slugNameEmployee = $request->name;
            $avatarProfile = Image::make($request->profile_avatar)->fit(273, 270)
            ->save( public_path('/core/image/EmployeesAvatar/' .$slugNameEmployee . '.' . $request->profile_avatar->extension()));
            

            $employee->profile_avatar = '/core/image/EmployeesAvatar/' . $slugNameEmployee . '.' . $request->profile_avatar->extension();

            $employee->save();

            Alert::success('Success!', 'Empleado' . $employee->name . 'Actualizado correctamente en el sistema');
            return redirect()->route('managers.employees.index');

        } else {
            return 'error';
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {

            $employee = Employee::findOrFail($id);
       
            alert()->info('Empleado Eliminado','
                El empleado' . ' ' . $employee->name . ' a sido eliminado correctamente del sistema
            ');

            return redirect()->route('managers.employees.index');
        
        } catch (\Illuminate\Database\QueryException $e){
            
            return alert()->error('Error Empleado No Eliminado', 'se a presentado un error al momento de eliminar el empleado' + $e);

        }
       
    }
}
