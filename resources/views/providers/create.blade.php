@extends('layouts.dashboard')

@section('title', 'information-&-technologies')

@section('content')
@section('titlePosition', 'companies/create')

<section class="content">
    <div class="container-fluid">
        <h1 class="h3 mb-1 text-gray-800"><i class="fas fa-briefcase"></i>
            Crear Provedor</h1>
        <p class="mb-4 text-justify">
            <div class="alert alert-info">
                Complete el siguiente formulario, recuerde que los campos marcados con <strong>*</strong> son de
                caracter obligatorio.
            </div>
        </p>

        <div class="text-center">
            <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 20rem;"
                src="{{ asset('/core/undraw/create-provider.svg') }}">
        </div>

        <!-- import partials.errors-validation -->
        @include('partials.errors-validation')
        <!-- close import -->

        <!-- start form providers.store -->
        <form action="{{ route('providers.store') }}" method="POST">
            @csrf

            <p class="h4 mb-1 text-gray-800">Resume Provider</p>
            <div class="row">
                <div class="col-md-8">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>*Nombre del Provedor:</label>
                            <input type="text" class="form-control" maxlength="128" name="name" placeholder="Enter Name"
                                value="{{ old('name') }}" required />
                        </div>
                        <div class="form-group col-md-4">
                            <label>*Tipo de Sociedad</label>
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
                            <label>*Representante de Ventas:</label>
                            <input type="text" class="form-control" placeholder="Enter Name"
                                value="{{ old('sales_representative') }}" name="sales_representative" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label>*Teléfono de Contacto:</label>
                            <input type="text" class="form-control selectValidationNumber"
                                value="{{ old('phone_contact') }}" name="phone_contact" maxlength="7"
                                placeholder="Enter Phone" maxlength="7" required>
                            <small class="form-text text-gray-600">
                                The Phone Contact field cannot be duplicated
                            </small>
                        </div>
                        <div class="form-group col-md-2">
                            <label>*Extension:</label>
                            <input type="text" class="form-control selectValidationNumber"
                                value="{{ old('extension_contact') }}" name="extension_contact"
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
                                value="{{ old('email_contact') }}" name="email_contact" required>
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
                            <label>*Fecha de Creación:</label>
                            {{ Form::date('creation_date', new \DateTime(), ['class' => 'form-control', 'readonly'] ) }}
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
                                <option value="">Escoger...</option>
                                <option value="Colombia" {{ old('country') == 'Colombia' ? 'selected' : '' }}>
                                    Colombia
                                </option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>*Ciudad</label>
                            <select class="form-control" name="city" required>
                                <option value="">Escoger...</option>
                                <option value="Barranquilla" {{ old('city') == 'Barranquilla' ? 'selected' : '' }}>
                                    Barranquilla
                                </option>
                                <option value="Bogota" {{ old('city') == 'Bogota' ? 'selected' : '' }}>
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
                                value="{{ old('address') }}" name="address" required>
                            <small class="form-text text-gray-600">
                                The Address field cannot be duplicated
                            </small>
                        </div>
                        <div class="form-group col-md-6">
                            <label>*Web Page:</label>
                            <input type="text" class="form-control" value="{{ old('url') }}" name="url"
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
                                <option value="30 Dias" {{ old('billing_period') == '30 Dias' ? 'selected' : '' }}>
                                    30 Dias
                                </option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label>*Tipo de Pago:</label>
                            <select class="form-control" name="payment_type">
                                <option value="">Escoger...</option>
                                <option value="Contado" {{ old('payment_type') == 'Contado' ? 'selected' : '' }}>
                                    Contado
                                </option>
                                <option value="Credito" {{ old('payment_type') == 'Credito' ? 'selected' : '' }}>
                                    Credito
                                </option>
                                <option value="Contra entrega"
                                    {{ old('payment_type') == 'Contra entrega' ? 'selected' : '' }}>
                                    Contra entrega
                                </option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            @if($companies->isEmpty())
            <!-- 101 Error compañia no creada en el sistema -->
            <div class="row">
                <div class="col-md-12">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <div class="text-center">
                                <div class="error mx-auto" data-text="101">
                                    <p>101</p>
                                </div>
                                <p class="lead text-gray-700 mb-5">Error Company No Found</p>
                                <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 20rem;"
                                    src="{{ asset('/core/undraw/error-feeling.svg') }}">
                                <br>
                                <p class="text-gray-800 mb-0">No se encontro una compañia en el sistema
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
                                <option value="">Seleccione...</option>
                                @foreach($companies as $company)
                                <option value="{{ $company->id }}"
                                    {{ old('company_id') == $company->id ? 'selected' : '' }}>
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
            @endif

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

            <!-- confirmacion modal, crear provider -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCreateProvider">
                Guardar
            </button>

            <!-- Modal  modalCreateProvider-->
            <div aria-hidden="true" aria-labelledby="modalCreateProvider" class="modal fade" id="modalCreateProvider"
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
                                                    ¿Agregar Provedor?
                                                </div>
                                                <div class="p mb-0 font-weight text-gray-800">
                                                    <p>
                                                        Atención!
                                                        <br>
                                                        {{ Auth::user()->name }}
                                                        <br>
                                                        ¿Desea registrar este provedor?
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-briefcase fa-2x text-gray-300">
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