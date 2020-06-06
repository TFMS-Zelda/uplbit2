<?php

namespace App\Http\Controllers;

use App\Company;
use App\User;

use Illuminate\Http\Request;
use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;


use RealRashid\SweetAlert\Facades\Alert;

class CompanyController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = \App\Company::orderBy('id', 'DESC')
        ->paginate(10);

        $totalCompaniesRegistradas = \App\Company::all()->count();
        return \view('companies.index', [
            'companies' => $companies,
            'totalCompaniesRegistradas' => $totalCompaniesRegistradas,

        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return \view('companies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCompanyRequest $request)
    {
        $company = new \App\Company;
        $company->create($request->all());

        Alert::success('Success!', 'Compañia' . ' ' . $company->name . ' ' . 'registrada correctamente en el sistema');
        return redirect()->route('companies.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        return view('companies.show', compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        return view('companies.edit', [
            'company' => $company,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCompanyRequest $request, Company $company)
    {
        $company->update($request->all());
        Alert::success('Success!', 'Compañia' . ' ' . $company->name . ' ' . 'a sido actualizada correctamente en el sistema');
        return redirect()->route('companies.index');        return redirect()->route('companies.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        Alert::info('Info!', 'La Compañía' . ' ' . $company->name . ' ' . 'no puede eliminarse porque es componente del sistema');
        return redirect()->route('companies.index');
        
    }
}