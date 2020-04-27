@extends('layouts.dashboard')

@section('title', 'information-&-technologies')


@section('content')

@section('titlePosition', 'computers/edit')

<style>
    input[type="text"],
    input[type="email"],
    textarea {
        background-color: #E9EFF7;
    }
</style>

<section class="content">
    <div class="container-fluid">
        <h1 class="h3 mb-1 text-gray-800">Editar Employee</h1>
        <div class="row">

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Empleado</div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">
                                    {{ $employee->name }}                                   
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-id-card fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Contacto
                                </div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">
                                    {{ $employee->email_corporate }}
                                    <br>
                                    <i class="fas fa-id-card-alt"></i>
                                    {{ $employee->citizenship_card }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-envelope-open-text fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Estado</div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <div class="h6 mb-0 mr-3 font-weight-bold text-gray-800">
                                           @if ($employee->status === 'Activo')
                                           <i class="fas fa-fingerprint"></i>
                                           {{ $employee->ugdn }} <span class="badge badge-success">{{ $employee->status }} </span>

                                           @else
                                           <i class="fas fa-fingerprint"></i>
                                           {{ $employee->ugdn }} <span class="badge badge-secondary">{{ $employee->status }} </span>

                                           @endif
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-fingerprint fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Historial
                                </div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">
                                    Fecha de Creación: <br>
                                    {{ $employee->created_at }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-clock fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center">
            <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 20rem;"
                src="{{ asset('/core/undraw/employee-office.svg') }}">

            @if (count($errors) > 0)
            <div class="col-xl-12 col-md-6 mb-4">
                <div class="card border-left-danger shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Error:
                                    <p>Algunos campos contienen errores...</p>
                                </div>
                                <i class="fas fa-exclamation-triangle fa-2x text-danger"></i>
                                <hr>
                                <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 20rem;"
                                    src="{{ asset('/core/undraw/error.svg') }}">

                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>
                                        <a href="#" class="btn btn-ligth btn-sm btn-icon-split">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-flag text-gray-800"></i>
                                            </span>
                                            <span class="text">{{ $error }}</span>
                                        </a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-cog fa-spin fa-3x text-danger"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>

        <form action="{{ route('managers.employees.update', $employee->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row">
            <div class="col-md-6">
                <div class="card border-left-secondary shadow h-100 py-2">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">Employee {{ $employee->id }} </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <h2>{{ $employee->name }}</h2>
                            <br>
                        </div>
                      </div>
                      <div class="col-auto">
                        <img src="{{ $employee->profile_avatar }}"
                            style="width:150px; height: 150px; float:left; border-radius:50%; margin-right: 25px;">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <label>Update Profile Image</label>
            <input type="file" name="profile_avatar" required>

    
            <br>
            <br>
            <p class="h4 mb-1 text-gray-800">Employee Resume</p>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>*Nombre del Empleado:</label>
                            <input type="text" class="form-control" maxlength="128" name="name" placeholder="Enter Name"
                                value="{{ $employee->name }}" required />
                        </div>

                        <div class="form-group col-md-4">
                            <label>*Email del Empleado:</label>
                            <input type="email" class="form-control" maxlength="128" name="email_corporate"
                                placeholder="Enter Email" value="{{ $employee->email_corporate }}" required />
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
                                placeholder="Enter Job Title" value="{{ $employee->job_title }}" required />
                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-md-6">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>*Tipo de Empleado:</label>
                            <select class="form-control" name="employee_type">
                                <option value="{{ $employee->employee_type }}">{{ $employee->employee_type }}</option>
                                <option value="Contratista">Contratista</option>
                                <option value="Tercero">Tercero</option>
                                <option value="Aprendiz Universitario">Aprendiz Universitario</option>
                                <option value="Aprendiz SENA">Aprendiz SENA</option>
                                <option value="Temporal">Temporal</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label><code>*Cedula de Ciudadanía:</code></label>
                            <input type="text" class="form-control selectValidationNumber" maxlength="10"
                                name="citizenship_card" placeholder="Enter Number"
                                value="{{ $employee->citizenship_card}}" required />
                            <small class="form-text text-gray-600">
                                The Citizenship Card field cannot be duplicated
                            </small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-row">
                        <div class="form-group col-md-2">
                            <label><code>*UGDN</code></label>
                            <input type="text" class="form-control selectValidationNumber" maxlength="8" name="ugdn"
                                placeholder="Enter UGDN" value="{{ $employee->ugdn }}" required />
                            <small class="form-text text-gray-600">
                                The UGDN field cannot be duplicated
                            </small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label><code>*Estado</code></label>
                            <select class="form-control" name="status" required readonly>
                                <option value="Activo">Activo</option>
                                <option value="Inactivo">Inactivo</option>

                            </select>
                            <small class="form-text text-gray-600">
                               <code>Puede cambiar el Estado del Empleado en este momento</code>
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
                            <select class="form-control" name="work_area">
                                <option value="{{ $employee->work_area }} ">{{ $employee->work_area }}</option>
                                <option value="Despachos">Despachos</option>
                                <option value="Finanzas - Cartera">Finanzas - Cartera</option>
                                <option value="Finanzas - Contabilidad">Finanzas - Contabilidad</option>
                                <option value="Finanzas - Facturacion">Finanzas - Facturacion</option>
                                <option value="Finanzas - Planeacion financiera">Finanzas - Planeacion financiera
                                </option>
                                <option value="Finanzas - IT">Finanzas - IT</option>
                                <option value="Gerencia">Gerencia</option>
                                <option class="Investigacion & Desarollo">Investigacion & Desarollo</option>
                                <option value="Mantenimiento">Mantenimiento</option>
                                <option value="Mercadeo & Marketing">Mercadeo & Marketing</option>
                                <option value="SHE">SHE</option>
                                <option value="Laboratorio">Laboratorio</option>
                                <option value="Produccion">Produccion</option>
                                <option value="Registros">Registros</option>
                                <option value="Supply Chain">Supply Chain</option>
                                <option value="Ventas">Ventas</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-8">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>*País:</label>
                            <select class="form-control" name="country" required autofocus>
                                <option value="{{ $employee->country }} ">{{ $employee->country }}</option>
                                <option value="Colombia">Colombia</option>
                                <option value="Ecuador">Ecuador</option>
                            </select>
                        </div>

                        <div class="form-group col-md-4">
                            <label>*Ciudad:</label>
                            <select class="form-control" name="city" required autofocus>
                                <option value="{{ $employee->city }} ">{{ $employee->city }}</option>
                                <option value="Bogota">Bogota</option>
                                <option value="Cundinamarca - Madrid">Cundinamarca - Madrid</option>
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
                            <input type="text" class="form-control" maxlength="10" name="phone"
                                placeholder="Enter Number" value="{{ $employee->phone }}" required />
                            <small class="form-text text-gray-600">
                                The Phone field cannot be duplicated
                            </small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>*Fecha de Creación:</label>
                            {{ Form::date('creation_date', new \DateTime(), ['class' => 'form-control', 'readonly'] ) }}
                        </div>
                    </div>
                </div>
            </div>

            <p class="h4 mb-1 text-gray-800">Relation Company</p>

            @if($companies->isEmpty())
            <!-- 101 Error compañia no creada en el sistema -->
            <div class="row">
                <div class="col-md-12">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <div class="text-center">
                                <div class="error mx-auto" data-text="103">
                                    <p>103</p>
                                </div>
                                <p class="lead text-gray-800 mb-5">Error Company No Found</p>
                                <p class="text-gray-800 mb-0">No se ha encotrado una Compañia en el sistema,
                                    primero agrege una Compañia.
                                    <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 20rem;"
                                        src="{{ asset('/core/undraw/error-feeling.svg') }}">
                                </p>

                                <a href="{{ route('companies.create') }}">&larr; Back to companies</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @else
            <div class="row">
                <div class="col-md-12">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label><code>*Compañia</code></label>
                            <select class="form-control" name="company_id">
                                @foreach($companies as $company)
                                <option value="{{ $company->id }}">{{ $company->name }}
                                    {{ $company->kind_of_society }} , {{ $company->country }} - {{ $company->city }}
                                </option>
                                @endforeach
                            </select>
                            <small class="form-text text-gray-600">
                               <code>¿De que Compañia relacionara este Empleado?</code>
                            </small>
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
            <!-- Confirmacion Modal, Agregar Article -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalEditarEmployee">
                Guardar
            </button>
            <!-- Modal -->
            <div class="modal fade" id="modalEditarEmployee" tabindex="-1" role="dialog"
                aria-labelledby="modalEditarEmployee" aria-hidden="true">
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
                                                    ¿Editar Employee?
                                                </div>
                                                <div class="p mb-0 font-weight text-gray-800">
                                                    <p>Atención!
                                                        <br>
                                                        {{ Auth::user()->name }} <br>
                                                        ¿Desea editar el anterior Empleado?, <br>
                                                        {{ $employee->name }}

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
                            <button type="submit" class="btn btn-primary">Guardar</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Close Modal -->
            <a href="#" class="btn btn-danger">Editar</a>

        </form>
    </div>
</section>

<script>
    // Validacion: Solo permite escribir caracteres numericos
    $('.selectValidationNumber').on('input', function () {
        this.value = this.value.replace(/[^0-9]/g, '');
    });

</script>
@endsection