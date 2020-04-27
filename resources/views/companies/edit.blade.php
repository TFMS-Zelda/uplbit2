@extends('layouts.dashboard')

@section('title', 'information-&-technologies')
@section('content')
@section('titlePosition', 'companies/edit')

<style>
    input[type="text"],
    input[type="email"],
    textarea {
        background-color: #E9EFF7;
    }
</style>

<section class="content">
    <div class="container-fluid">
        <h1 class="h3 mb-1 text-gray-800"><i class="fas fa-landmark"></i>
            Editar Compañia</h1>
        <p class="mb-4 text-justify">
            <div class="alert alert-info">
                Edite el siguiente formulario, recuerde que los campos marcados con <strong>*</strong> son de
                caracter obligatorio.
            </div>
        </p>

        <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Compañia</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $company->name }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-landmark fa-2x text-gray-300"></i>
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
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Nit
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ $company->nit }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-address-card fa-2x text-gray-300"></i>
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
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Host Name</div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                            {{ $company->hostname }} </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-laptop fa-2x text-gray-300"></i>
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
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Estado
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ $company->status }}
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
                src="{{ asset('/core/undraw/company.svg') }}">
        </div>

        <!-- import partials.errors-validation -->
        @include('partials.errors-validation')
        <!-- close import -->

        <!-- start form companies.update -->
        <form action="{{ route('companies.update', $company->id) }}" method="POST">
            @csrf
            @method('PUT')

            <p class="h4 mb-1 text-gray-800">
                Resume Company
            </p>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>
                                *Nombre Compañia:
                            </label>
                            <input autofocus="" class="form-control" maxlength="128" name="name"
                                placeholder="Enter Name" required="" type="text" value="{{ $company->name }}">
                        </div>

                        <div class="form-group col-md-2">
                            <label>
                                *Tipo de Sociedad:
                            </label>
                            <select name="kind_of_society" class="form-control" required>
                                <option value="S.A"
                                    {{ old('kind_of_society', $company->kind_of_society) == 'S.A' ? 'selected' : '' }}>
                                    S.A
                                </option>
                                <option value="S.A.S"
                                    {{ old('kind_of_society', $company->kind_of_society) == 'S.A.S' ? 'selected' : '' }}>
                                    S.A.S
                                </option>
                                <option value="LTDA"
                                    {{ old('kind_of_society', $company->kind_of_society) == 'LTDA' ? 'selected' : '' }}>
                                    LTDA
                                </option>
                                <option value="INC"
                                    {{ old('kind_of_society', $company->kind_of_society) == 'INC' ? 'selected' : '' }}>
                                    INC
                                </option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>
                                <code>*Nit:</code>
                            </label>
                            <input autofocus="" class="form-control selectValidationNumber" maxlength="9" name="nit"
                                placeholder="Enter Nit" required="" type="text" value="{{ $company->nit }}">
                            <small class="form-text text-gray-600">
                                <code>The Nit field cannot be duplicated</code>
                            </small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>
                                *Pais
                            </label>
                            <select name="country" class="form-control" required>
                                <option value="Colombia"
                                    {{ old('country', $company->country) == 'Colombia' ? 'selected' : '' }}>
                                    Colombia
                                </option>
                            </select>
                        </div>

                        <div class="form-group col-md-4">
                            <label>
                                *Ciudad
                            </label>
                            <select name="city" class="form-control" required>
                                <option value="Bogota" {{ old('city', $company->city) == 'Bogota' ? 'selected' : '' }}>
                                    Bogota
                                </option>
                            </select>

                        </div>
                        <div class="form-group col-md-4">
                            <label>
                                *Dirección
                            </label>
                            <input autofocus="" class="form-control" name="address" placeholder="Enter Address"
                                required="" type="text" value="{{ $company->address }}">
                            <small class="form-text text-gray-600">
                                The Address field cannot be duplicated
                            </small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>
                                *Web Page:
                            </label>
                            <input autofocus="" class="form-control" maxlength="128" name="url"
                                placeholder="Enter Web Page" required="" type="text" value="{{ $company->url }}">
                            <small class="form-text text-gray-600">
                                The Web Page Url field cannot be duplicated
                            </small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>
                                *Persona de Contacto
                            </label>
                            <input autofocus="" class="form-control" name="person_contact" placeholder="Enter Name"
                                required="" type="text" value="{{ $company->person_contact }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label>
                                *Correo de Contacto
                            </label>
                            <input autofocus="" class="form-control" name="email_contact" placeholder="Enter Email"
                                required="" type="email" value="{{ $company->email_contact }}">
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
                        <div class="form-group col-md-4">
                            <label>
                                *Teléfono de Contacto:
                            </label>
                            <input autofocus="" class="form-control selectValidationNumber" maxlength="7"
                                name="phone_contact" placeholder="Enter Phone" required="" type="text"
                                value="{{ $company->phone_contact }}">
                            <small class="form-text text-gray-600">
                                The Phone Contact field cannot be duplicated
                            </small>
                        </div>
                        <div class="form-group col-md-2">
                            <label>
                                *Extension:
                            </label>
                            <input autofocus="" class="form-control selectValidationNumber" maxlength="10"
                                name="extension_contact" placeholder="Enter Extension" required="" type="text"
                                value="{{ $company->extension_contact }}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>
                                *Creado Por:
                            </label>
                            <select autofocus="" class="form-control" name="user_id" required>
                                <option value="{{ auth()->user()->id }}">
                                    {{ auth()->user()->name }}
                                </option>
                            </select>
                            <small class="form-text text-gray-600">
                                El usuario es detectado automaticamente por el sistema
                            </small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-row">
                        <div class="form-group col-md-2">
                            <label>
                                *Fecha de Creación:
                            </label>
                            {{ Form::date('creation_date', $company->creation_date , ['class' => 'form-control' , 'readonly' , 'required'] ) }}
                        </div>
                    </div>
                </div>
            </div>

            <button class="btn btn-primary" data-target="#modalEditCompany" data-toggle="modal" type="button">
                Editar
            </button>

            <!-- Modal  modalEditCompany-->
            <div class="modal fade" id="modalEditCompany" tabindex="-1" role="dialog" aria-labelledby="modalEditCompany"
                aria-hidden="true">
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
                                                    ¿Actualizar Compañia?
                                                </div>
                                                <div class="p mb-0 font-weight text-gray-800">
                                                    <p>Atención!
                                                        <br>
                                                        {{ Auth::user()->name }} <br>
                                                        ¿Desea actualizar la siguiente Compañia?
                                                        <ul>
                                                            <li>
                                                                <div class="h6 mb-0 font-weight-bold text-gray-800">
                                                                    {{ $company->name }}
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-landmark fa-2x text-gray-300"></i>
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
        <!-- end form companies.update -->
    </div>
</section>

<!-- import script selectValidationNumber  -->
<script src="{{ asset('/core/js/selectValidationNumber.js') }}"></script>
@endsection