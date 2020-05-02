@extends('layouts.dashboard')

@section('title', 'information-&-technologies')

@section('content')
@section('titlePosition', 'companies/create')

<section class="content">
    <div class="container-fluid">
        <h1 class="h3 mb-1 text-gray-800">
            <i class="fas fa-landmark text-muted">
            </i>
            Agregar Compañía
        </h1>
        <p class="mb-4 text-justify">
            <div class="alert alert-info">
                Complete el siguiente formulario, recuerde que los campos marcados * con son de caracter obligatorio.
            </div>
        </p>
        <div class="text-center">
            <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" src="{{ asset('/core/undraw/company-create.svg') }}"
                style="width: 20rem;">
        </div>

        <!-- import partials.errors-validation -->
        @include('partials.errors-validation')
        <!-- close import -->

        <!-- start form companies.store -->
        <form action="{{ route('companies.store') }}" method="POST">
            @csrf

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
                                placeholder="Enter Name" required="" type="text" value="{{ old('name') }}">
                        </div>

                        <div class="form-group col-md-2">
                            <label>
                                *Tipo de Sociedad:
                            </label>
                            <select name="kind_of_society" class="form-control" required>
                                <option value="">Escoger...</option>
                                <option value="S.A" {{ old('kind_of_society') == 'S.A' ? 'selected' : '' }}>
                                    S.A
                                </option>
                                <option value="S.A.S" {{ old('kind_of_society') == 'S.A.S' ? 'selected' : '' }}>
                                    S.A.S
                                </option>
                                <option value="LTDA" {{ old('kind_of_society') == 'LTDA' ? 'selected' : '' }}>
                                    LTDA
                                </option>
                                <option value="INC" {{ old('kind_of_society') == 'INC' ? 'selected' : '' }}>
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
                                placeholder="Enter Nit" required="" type="text" value="{{ old('nit') }}">
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
                                <option value="">Escoger...</option>
                                <option value="Colombia" {{ old('country') == 'Colombia' ? 'selected' : '' }}>
                                    Colombia
                                </option>
                            </select>
                        </div>

                        <div class="form-group col-md-4">
                            <label>
                                *Ciudad
                            </label>
                            <select name="city" class="form-control" required>
                                <option value="">Escoger...</option>
                                <option value="Bogota" {{ old('city') == 'Bogota' ? 'selected' : '' }}>
                                    Bogota
                                </option>
                            </select>

                        </div>
                        <div class="form-group col-md-4">
                            <label>
                                *Dirección
                            </label>
                            <input autofocus="" class="form-control" name="address" placeholder="Enter Address"
                                required="" type="text" value="{{ old('address') }}">
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
                                placeholder="Enter Web Page" required="" type="text" value="{{ old('url') }}">
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
                                required="" type="text" value="{{ old('person_contact') }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label>
                                *Correo de Contacto
                            </label>
                            <input autofocus="" class="form-control" name="email_contact" placeholder="Enter Email"
                                required="" type="email" value="{{ old('email_contact') }}">
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
                                value="{{ old('phone_contact') }}">
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
                                value="{{ old('extension_contact') }}">
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
                            <select autofocus="" class="form-control" name="user_id" required="">
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
                        <div class="form-group col-md-4">
                            <label>
                                *Fecha de Creación:
                            </label>
                            {{ Form::date('creation_date', new \DateTime(), ['class' => 'form-control', 'readonly'] ) }}
                        </div>
                    </div>
                </div>
            </div>

            <button class="btn btn-primary" data-target="#modalCreateCompany" data-toggle="modal" type="button">
                Guardar
            </button>

            <!-- Modal  modalCreateCompany-->
            <div aria-hidden="true" aria-labelledby="modalCreateCompany" class="modal fade" id="modalCreateCompany"
                role="dialog" tabindex="-1">
                <div class="modal-dialog" role="document">
                    <div class="modal-content card shadow mb-4">
                        <div class="modal-header">
                            <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                                <span aria-hidden="true">
                                    <i aria-hidden="true" class="fa fa-times text-danger">
                                    </i>
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
                                                    ¿Agregar Compañia?
                                                </div>
                                                <div class="p mb-0 font-weight text-gray-800">
                                                    <p>
                                                        Atención!
                                                        <br>
                                                        {{ Auth::user()->name }}
                                                        <br>
                                                        ¿Desea registrar esta compañia?
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-landmark fa-2x text-gray-300">
                                                </i>
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

<!-- import script selectValidationNumber  -->
<script src="{{ asset('/core/js/selectValidationNumber.js') }}"></script>
@endsection