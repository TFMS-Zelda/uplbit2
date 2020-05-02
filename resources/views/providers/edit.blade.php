@extends('layouts.dashboard')

@section('title', 'information-&-technologies')
@section('content')
@section('titlePosition', 'providers/edit')

<section class="content">
    <div class="container-fluid">
        <h1 class="h3 mb-1 text-gray-800"><i class="fas fa-briefcase"></i>
            Editar Provedor</h1>
        <p class="mb-4 text-justify">
            <div class="alert alert-info">
                Complete el siguiente formulario, recuerde que los campos marcados con <strong>*</strong> son de
                caracter obligatorio.
            </div>
        </p>

        <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Provedor</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $provider->name }}
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
                                    {{ $provider->nit }}
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
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Representante de
                                    Ventas</div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                            {{ $provider->sales_representative }} </div>
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
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Fecha de creación
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ Carbon\Carbon::parse($provider->date_creation)->format('l jS \\of F Y ') }} <br>
                                    <small>
                                        {{ $provider->created_at->diffForHumans() }}
                                    </small>
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
                src="{{ asset('/core/undraw/provider-shop.svg') }}">
        </div>

        <!-- import partials.errors-validation -->
        @include('partials.errors-validation')
        <!-- close import -->

        <!-- start form providers.update -->

        <form action="{{ route('providers.update', $provider->id) }}" method="POST">
            @csrf
            @method('PUT')

            <p class="h4 mb-1 text-gray-800">Resume Provider</p>
            <div class="row">
                <div class="col-md-8">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>*Nombre del Provedor:</label>
                            <input type="text" class="form-control" maxlength="128" name="name" placeholder="Enter Name"
                                value="{{ $provider->name }}" required />
                        </div>
                        <div class="form-group col-md-4">
                            <label>*Tipo de Sociedad</label>
                            <select name="kind_of_society" class="form-control" required>
                                <option value="S.A"
                                    {{ old('kind_of_society', $provider->kind_of_society) == 'S.A' ? 'selected' : '' }}>
                                    S.A
                                </option>
                                <option value="S.A.S"
                                    {{ old('kind_of_society', $provider->kind_of_society) == 'S.A.S' ? 'selected' : '' }}>
                                    S.A.S
                                </option>
                                <option value="LTDA"
                                    {{ old('kind_of_society', $provider->kind_of_society) == 'LTDA' ? 'selected' : '' }}>
                                    LTDA
                                </option>
                                <option value="INC"
                                    {{ old('kind_of_society', $provider->kind_of_society) == 'INC' ? 'selected' : '' }}>
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
                                placeholder="Enter Nit" required="" type="text" value="{{ $provider->nit }}">
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
                            <label>*Representante de Ventas:</label>
                            <input type="text" class="form-control" placeholder="Enter Name"
                                value="{{ $provider->sales_representative }}" name="sales_representative" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label>*Teléfono de Contacto:</label>
                            <input type="text" class="form-control selectValidationNumber"
                                value="{{ $provider->phone_contact }}" name="phone_contact" maxlength="7"
                                placeholder="Enter Phone" maxlength="7" required>
                            <small class="form-text text-gray-600">
                                The Phone Contact field cannot be duplicated
                            </small>
                        </div>
                        <div class="form-group col-md-2">
                            <label>*Extension:</label>
                            <input type="text" class="form-control selectValidationNumber"
                                value="{{ $provider->extension_contact }}" name="extension_contact"
                                placeholder="Enter Extension" maxlength="10" required>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-8">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>*Correo de Contacto</label>
                            <input type="email" class="form-control" placeholder="Enter Email"
                                value="{{ $provider->email_contact }}" name="email_contact" required>
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
                        <div class="form-group col-md-2">
                            <label>*Fecha de Creación:</label>
                            {{ Form::date('creation_date', $provider->creation_date , ['class' => 'form-control' , 'readonly' , 'required'] ) }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-8">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>*Pais</label>
                            <select class="form-control" name="country" required>
                                <option value="Colombia"
                                    {{ old('country', $provider->country) == 'Colombia' ? 'selected' : '' }}>
                                    Colombia
                                </option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>*Ciudad</label>
                            <select class="form-control" name="city" required>
                                <option value="Barranquilla"
                                    {{ old('city', $provider->city) == 'Barranquilla' ? 'selected' : '' }}>
                                    Barranquilla
                                </option>
                                <option value="Bogota" {{ old('city', $provider->city) == 'Bogota' ? 'selected' : '' }}>
                                    Bogota
                                </option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>*Dirección</label>
                            <input type="text" class="form-control" placeholder="Enter Address"
                                value="{{ $provider->address }}" name="address" required>
                            <small class="form-text text-gray-600">
                                The Address field cannot be duplicated
                            </small>
                        </div>
                        <div class="form-group col-md-6">
                            <label>*Web Page:</label>
                            <input type="text" class="form-control" value="{{ $provider->url }}" name="url"
                                placeholder="Enter Web Page" maxlength="128" required>
                            <small class="form-text text-gray-600">
                                The Web Page Url field cannot be duplicated
                            </small>
                        </div>
                    </div>
                </div>
            </div>

            <p class="h4 mb-1 text-gray-800">Información de Facturación</p>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>*Periodo de Facturación:</label>
                            <select class="form-control" name="billing_period">
                                <option value="">Escoger...</option>
                                <option value="30 Dias"
                                    {{ old('billing_period', $provider->billing_period) == '30 Dias' ? 'selected' : '' }}>
                                    30 Dias
                                </option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label>*Tipo de Pago:</label>
                            <select class="form-control" name="payment_type">
                                <option value="">Escoger...</option>
                                <option value="Contado"
                                    {{ old('payment_type', $provider->payment_type) == 'Contado' ? 'selected' : '' }}>
                                    Contado
                                </option>
                                <option value="Credito"
                                    {{ old('payment_type', $provider->payment_type) == 'Credito' ? 'selected' : '' }}>
                                    Credito
                                </option>
                                <option value="Contra entrega"
                                    {{ old('payment_type', $provider->payment_type) == 'Contra entrega' ? 'selected' : '' }}>
                                    Contra entrega
                                </option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label><code>*Compañia</code></label>
                            <select class="form-control" name="company_id">
                                <option value="">Seleccione...</option>
                                @foreach($companies as $company)
                                <option value="{{ $company->id }}"
                                    {{ old('company_id', $company->id) == $company->id ? 'selected' : '' }}>
                                    {{ $company->name }} - {{ $company->kind_of_society }} </option>
                                @endforeach
                            </select>
                            <small class="form-text text-gray-600">
                                <code>¿De que compañia relacionara el siguiente provedor?</code>
                            </small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>*Creado Por:</label>
                            <select class="form-control" name="user_id" required autofocus>
                                <option value="{{ auth()->user()->id }}">{{ auth()->user()->name }}</option>
                            </select>
                            <small class="form-text text-gray-600">
                                El usuario es detectado automáticamente por el sistema
                            </small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- confirmacion modal, edit provider -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalEditCompany">
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
                                                    ¿Actualizar Provedor?
                                                </div>
                                                <div class="p mb-0 font-weight text-gray-800">
                                                    <p>Atención!
                                                        <br>
                                                        {{ Auth::user()->name }} <br>
                                                        ¿Desea actualizar el siguiente Provedor?
                                                        <ul>
                                                            <li>
                                                                <div class="h6 mb-0 font-weight-bold text-gray-800">
                                                                    {{ $provider->name }} -
                                                                    {{ $provider->kind_of_society }}
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
    </div>
</section>

<!-- import script selectValidationNumber  -->
<script src="{{ asset('/core/js/selectValidationNumber.js') }}"></script>
@endsection