@extends('layouts.dashboard')

@section('title', 'information-&-technologies')

@section('content')
@section('titlePosition', 'computers/create')


<section class="content">
    <div class="container-fluid">
        <h1 class="h3 mb-1 text-gray-800">Agregar Empleado</h1>
        <p class="mb-4 text-justify">
            Complete el siguiente formulario, recuerde que los campos marcados con <strong>*</strong> son de caracter
            obligatorio.
        </p>

        <div class="text-center">
            <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 20rem;"
                src="{{ asset('/core/undraw/employee-office.svg') }}">
        </div>

        <!-- import partials.errors-validation -->
        @include('partials.errors-validation')
        <!-- close import -->

        <form action="{{ route('managers.employees.store') }}" method="POST">
            @csrf

            <p class="h4 mb-1 text-gray-800">Employee Resume</p>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>*Nombre del Empleado:</label>
                            <input type="text" class="form-control" maxlength="128" name="name" placeholder="Enter Name"
                                value="{{ old('name') }}" required />
                        </div>

                        <div class="form-group col-md-6">
                            <label>*Email del Empleado:</label>
                            <input type="email" class="form-control" maxlength="128" name="email_corporate"
                                placeholder="Enter Email" value="{{ old('email_corporate') }}" required />
                            <small class="form-text text-gray-600">
                                The Email field cannot be duplicated
                            </small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>*Cargo del Empleado:</label>
                            <input type="text" class="form-control" maxlength="128" name="job_title"
                                placeholder="Enter Job Title" value="{{ old('job_title') }}" required />
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <div class="form-group">
                                <label>*Tipo de empleado:</label>
                                <select class="form-control" name="employee_type">
                                    <option value="">Escoger...</option>
                                    <option value="Empleado Contratista"
                                        {{ old('employee_type') == 'Empleado Contratista' ? 'selected' : ''}}>
                                        Empleado Contratista
                                    </option>
                                    <option value="Empleado Tercero"
                                        {{ old('employee_type') == 'Empleado Tercero' ? 'selected' : ''}}>
                                        Empleado Tercero
                                    </option>
                                    <option value="Empleado Pasante Universitario"
                                        {{ old('employee_type') == 'Empleado Pasante Universitario' ? 'selected' : ''}}>
                                        Empleado Pasante Universitario
                                    </option>
                                    <option value="Empleado Aprendiz Sena"
                                        {{ old('employee_type') == 'Empleado Aprendiz Sena' ? 'selected' : ''}}>
                                        Empleado Aprendiz Sena
                                    </option>
                                    <option value="Empleado Temporal"
                                        {{ old('employee_type') == 'Empleado Temporal' ? 'selected' : ''}}>
                                        Empleado Temporal
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label><code>*Cedula de Ciudadanía</code>:</label>
                            <input type="text" class="form-control selectValidationNumber" maxlength="10"
                                name="citizenship_card" placeholder="Enter Number" value="{{ old('citizenship_card') }}"
                                required />
                            <small class="form-text text-gray-600">
                                <code>The Citizenship Card field cannot be duplicated</code>
                            </small>
                        </div>

                        <div class="form-group col-md-4">
                            <label><code>*UGDN</code>:</label>
                            <input type="text" class="form-control selectValidationNumber" maxlength="8" name="ugdn"
                                placeholder="Enter UGDN" value="{{ old('ugdn') }}" required />
                            <small class="form-text text-gray-600">
                                <code>The UGDN field cannot be duplicated</code>
                            </small>
                        </div>

                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-md-12">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>*Estado:</label>
                            <select class="form-control" name="status" required readonly>
                                <option value="Activo" {{ old('status') == 'Activo' ? 'selected' : ''}}>
                                    Activo
                                </option>
                            </select>
                            <small class="form-text text-gray-600">
                                El Estado de un Empleado nuevo es Activo por defecto
                            </small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>*Area:</label>
                            <select class="form-control" name="work_area" required>
                                <option value="">Escoger...</option>
                                <option value="Despachos" {{ old('work_area') == 'Despachos' ? 'selected' : ''}}>
                                    Despachos
                                </option>
                                <option value="Finanzas - Cartera"
                                    {{ old('work_area') == 'Finanzas - Cartera' ? 'selected' : ''}}>
                                    Finanzas - Cartera
                                </option>
                                <option value="Finanzas - Contabilidad"
                                    {{ old('work_area') == 'Finanzas - Contabilidad' ? 'selected' : ''}}>
                                    Finanzas - Contabilidad
                                </option>
                                <option value="Finanzas - Facturacion"
                                    {{ old('work_area') == 'Finanzas - Facturacion' ? 'selected' : ''}}>
                                    Finanzas - Facturacion
                                </option>
                                <option value="Finanzas - Planeacion financiera"
                                    {{ old('work_area') == 'Finanzas - Planeacion financiera' ? 'selected' : ''}}>
                                    Finanzas - Planeacion financiera
                                </option>
                                <option value="Finanzas - IT"
                                    {{ old('work_area') == 'Finanzas - IT' ? 'selected' : ''}}>
                                    Finanzas - IT
                                </option>
                                <option value="Gerencia" {{ old('work_area') == 'Gerencia' ? 'selected' : ''}}>
                                    Gerencia
                                </option>
                                <option value="Investigacion & Desarollo"
                                    {{ old('work_area') == 'Investigacion & Desarollo' ? 'selected' : ''}}>
                                    Investigacion & Desarollo
                                </option>
                                <option value="Mantenimiento"
                                    {{ old('work_area') == 'Mantenimiento' ? 'selected' : ''}}>
                                    Mantenimiento
                                </option>
                                <option value="Mercadeo & Marketing"
                                    {{ old('work_area') == 'Mercadeo & Marketing' ? 'selected' : ''}}>
                                    Mercadeo & Marketing
                                </option>
                                <option value="SHE" {{ old('work_area') == 'SHE' ? 'selected' : ''}}>
                                    SHE
                                </option>
                                <option value="Laboratorio" {{ old('work_area') == 'Laboratorio' ? 'selected' : ''}}>
                                    Laboratorio
                                </option>
                                <option value="Produccion" {{ old('work_area') == 'Produccion' ? 'selected' : ''}}>
                                    Produccion
                                </option>
                                <option value="Recursos Humanos"
                                    {{ old('work_area') == 'Recursos Humanos' ? 'selected' : ''}}>
                                    Recursos Humanos
                                </option>
                                <option value="Registros" {{ old('work_area') == 'Registros' ? 'selected' : ''}}>
                                    Registros
                                </option>
                                <option value="Supply Chain" {{ old('work_area') == 'Supply Chain' ? 'selected' : ''}}>
                                    Supply Chain
                                </option>
                                <option value="Ventas" {{ old('work_area') == 'Ventas' ? 'selected' : ''}}>
                                    Ventas
                                </option>

                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <p class="h4 mb-1 text-gray-800">Ubicación</p>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>*Pais:</label>
                            <select class="form-control paisSelectClass" id="paisSelectId" name="country"
                                onchange="cargarCiudades()" required>
                                <option value="">Seleccione...</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>*Ciudad:</label>
                            <select class="form-control" name="city" id="ciudadSelectId" required>
                                <option value="">Seleccione...</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-md-12">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>*Telefono:</label>
                            <input type="text" class="form-control" minlength="10" maxlength="10" name="phone"
                                placeholder="Enter Number" value="{{ old('phone') }}" required />
                            <small class="form-text text-gray-600">
                                The Phone field cannot be duplicated
                            </small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>*Fecha de Creación:</label>
                            {{ Form::date('creation_date', new \DateTime(), ['class' => 'form-control', 'readonly'] ) }}
                        </div>
                    </div>
                </div>
            </div>


            <p class="h4 mb-1 text-gray-800">Company Assignment</p>
            @if($companies->isEmpty())
            <!-- 101 Error compañia no creada en el sistema -->
            <div class="row">
                <div class="col-md-12">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <div class="text-center">
                                <div class="error mx-auto" data-text="103">
                                    <p>101</p>
                                </div>
                                <p class="lead text-gray-800 mb-5">Error Company No Found</p>
                                <p class="text-gray-800 mb-0">
                                    <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 20rem;"
                                        src="{{ asset('/core/undraw/error-feeling.svg') }}">
                                    <br>
                                    No se encontro una compañia registrada en el sistema,
                                </p>

                                <a href="{{ route('companies.create') }}">&larr; Back to companies</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @else

            <div class="alert alert-primary">
                <p class="h4 mb-1 text-gray-800">
                    <i class="fa fa-landmark" aria-hidden="true"></i>
                    <h2>Company Relation!</h2>
                </p>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <h4>*Seleccione una Compañía:</h4>
                                <select class="form-control" name="company_id">
                                    @foreach($companies as $company)
                                    <option value="{{ $company->id }}">{{ $company->name }}
                                        {{ $company->kind_of_society }} , {{ $company->country }} - {{ $company->city }}
                                    </option>
                                    @endforeach
                                </select>
                                <small class="form-text text-gray-800">
                                    <strong>¿De que Compañía es el ingreso del siguiente empleado que desea
                                        registrar?</strong>
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif


            <div class="row">
                <div class="col-md-12">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>*Creado Por:</label>
                            <select class="form-control" name="user_id" required>
                                <option value="{{ auth()->user()->id }}">{{ auth()->user()->name }}</option>
                            </select>
                            <small class="form-text text-gray-600">
                                El usuario es detectado automáticamente por el sistema
                            </small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Confirmacion Modal, Editar Computer -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCreateEmployee">
                Guardar
            </button>
            <!-- Modal -->
            <div class="modal fade" id="modalCreateEmployee" tabindex="-1" role="dialog"
                aria-labelledby="modalCreateEmployee" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content card shadow mb-4">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true"><i class="fa fa-times text-danger" aria-hidden="true"></i>
                                </span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="col col-md-12">
                                <div class="card border-left-primary shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                    ¿Agregar Employee?
                                                </div>
                                                <div class="p mb-0 font-weight text-gray-800">
                                                    <p>Atención!
                                                        <br>
                                                        {{ Auth::user()->name }} <br>
                                                        ¿Desea registar el siguiente empleado en el sistema?
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-user-tie fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-secondary">Confirmar</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Close Modal -->
            <a href="#" class="btn btn-danger">Cancelar</a>


        </form>
    </div>
</section>
@endsection
@push('scripts')
<script src="{{ asset('/core/js/select-country-&-city-fix.js') }}"></script>
<script>
    $('.selectValidationNumber').on('input', function () {
        this.value = this.value.replace(/[^0-9]/g, '');
    });
</script>
@endpush