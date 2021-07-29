@extends('layouts.dashboard')

@section('title', 'information-&-technologies')

@section('content')
@section('titlePosition', 'articles/create')


<section class="content">
    <div class="container-fluid">
        <h1 class="h3 mb-1 text-gray-800"><i class="fas fa-cart-arrow-down fa-1x text-muted"></i>
            Agregar Articulo</h1>
        <p class="mb-4 text-justify">
            <div class="alert alert-info">
                Complete el siguiente formulario, recuerde que los campos marcados con <strong>*</strong> son de
                caracter obligatorio.
            </div>
        </p>

        <div class="text-center">
            <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 20rem;"
                src="{{ asset('/core/undraw/deliveries.svg') }}">
        </div>

        <!-- import partials.errors-validation -->
        @include('partials.errors-validation')
        <!-- close import -->

        <!-- start form articles.store -->

        <form action="{{ route('articles.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <p class="h4 mb-1 text-gray-800">Resume Article</p>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>*Área:</label>
                            <select class="form-control" name="area" required autofocus>
                                <option value="">Escoger...</option>
                                <option value="Despachos" {{ old('area') == 'Despachos' ? 'selected' : '' }}>
                                    Despachos
                                </option>
                                <option value="Finanzas - Cartera"
                                    {{ old('area') == 'Finanzas - Cartera' ? 'selected' : '' }}>
                                    Finanzas - Cartera
                                </option>
                                <option value="Finanzas - Contabilidad"
                                    {{ old('area') == 'Finanzas - Contabilidad' ? 'selected' : '' }}>
                                    Finanzas - Contabilidad
                                </option>
                                <option value="Finanzas - Control Interno"
                                    {{ old('area') == 'Finanzas - Control Interno' ? 'selected' : '' }}>
                                    Finanzas - Control Interno
                                </option>
                                <option value="Finanzas - Contabilidad"
                                    {{ old('area') == 'Finanzas - Contabilidad' ? 'selected' : '' }}>
                                    Finanzas - Contabilidad
                                </option>
                                <option value="Finanzas - Facturacion"
                                    {{ old('area') == 'Finanzas - Facturacion' ? 'selected' : '' }}>
                                    Finanzas - Facturacion
                                </option>
                                <option value="Finanzas - IT" {{ old('area') == 'Finanzas - IT' ? 'selected' : '' }}>
                                    Finanzas - IT
                                </option>
                                <option value="Finanzas - Planeacion Financiera"
                                    {{ old('area') == 'Finanzas - Planeacion Financiera' ? 'selected' : '' }}>
                                    Finanzas - Planeacion Financiera
                                </option>
                                <option value="Finanzas - Tesoreria"
                                    {{ old('area') == 'Finanzas - Tesoreria' ? 'selected' : '' }}>
                                    Finanzas - Tesoreria
                                </option>
                                <option value="Importaciones" {{ old('area') == 'Importaciones' ? 'selected' : '' }}>
                                    Importaciones
                                </option>
                                <option value="Mantenimiento" {{ old('area') == 'Mantenimiento' ? 'selected' : '' }}>
                                    Mantenimiento
                                </option>
                                <option value="Mercadeo" {{ old('area') == 'Mercadeo' ? 'selected' : '' }}>
                                    Mercadeo
                                </option>
                                <option value="Recursos Humanos"
                                    {{ old('area') == 'Recursos Humanos' ? 'selected' : '' }}>
                                    Recursos Humanos
                                </option>
                                <option value="Registros" {{ old('area') == 'Registros' ? 'selected' : '' }}>
                                    Registros
                                </option>
                                <option value="SHE" {{ old('area') == 'SHE' ? 'selected' : '' }}>
                                    SHE
                                </option>
                                <option value="Supply Chain" {{ old('area') == 'Supply Chain' ? 'selected' : '' }}>
                                    Supply Chain
                                </option>
                                <option value="Ventas" {{ old('area') == 'Ventas' ? 'selected' : '' }}>
                                    Ventas
                                </option>
                            </select>
                            <small class="form-text text-gray-600">
                                Escoga una área de la compañia la cual asignara el Articulo ingresado
                            </small>
                        </div>
                    </div>
                </div>
            </div>

            <p class="h4 mb-1 text-gray-800">Información de Facturación</p>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label>*Fecha de Factura:</label>
                            <input type="date" class="form-control" name="invoice_date"
                                value="{{ old('invoice_date') }}" required autofocus>
                        </div>
                        <div class="form-group col-md-3">
                            <label>*Fecha de Expiración:</label>
                            <input type="date" class="form-control" name="expiration_date"
                                value="{{ old('expiration_date') }}" required autofocus>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>*Remisión:</label>
                            <input type="text" class="form-control" name="remission" maxlength="64"
                                value="{{ old('remission') }}" placeholder="Enter Remission" required autofocus
                                onkeyup="javascript:this.value=this.value.toUpperCase();">
                            <small class="form-text text-gray-600">
                                The Remission field cannot be duplicated
                            </small>
                        </div>
                        <div class="form-group col-md-4">
                            <label>*Cotización:</label>
                            <input type="text" class="form-control" name="quotation" maxlength="64"
                                value="{{ old('quotation') }}" placeholder="Enter Quotation" required autofocus
                                onkeyup="javascript:this.value=this.value.toUpperCase();">
                            <small class="form-text text-gray-600">
                                The Quotation field cannot be duplicated
                            </small>
                        </div>
                    </div>
                </div>
            </div>

            <p class="h4 mb-1 text-gray-800">Importe & Precio </p>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-row">
                        <div class="form-group col-md-2">
                            <label>*Cantidad:</label>
                            <input type="number" class="form-control selectValidationNumber" name="quantity"
                                value="{{ old('quantity') }}" placeholder="Enter Quantity" min="0" max="1000" required
                                autofocus>
                        </div>

                        <div class="form-group col-md-2">
                            <label>*Valor Unitario:</label>
                            <input type="text" class="form-control" id="valorUnitario" name="unit_value" maxlength="64"
                                value="{{ old('unit_value') }}" placeholder="Enter Total" required autofocus>
                            <div class="valid-feedback">
                                <i class="fas fa-money-bill-alt"></i> Valor Total del Articulo
                            </div>
                        </div>

                        <div class="form-group col-md-2">
                            <label>*Valor Total:</label>
                            <input type="text" class="form-control" id="valorTotal" name="total_value" maxlength="64"
                                value="{{ old('total_value') }}" placeholder="Enter Total" required autofocus>
                            <div class="valid-feedback">
                                <i class="fas fa-money-bill-alt"></i> Valor Total del Articulo
                            </div>
                        </div>

                        <div class="form-group col-md-4">
                            <label>*Valor Total de Factura:</label>
                            <input type="text" class="form-control" id="valorTotalFactura" name="total_bill"
                                maxlength="64" value="{{ old('total_bill') }}" placeholder="Enter Total" required
                                autofocus>
                            <div class="valid-feedback">
                                <i class="fas fa-money-bill-alt"></i> Valor Total de la Factura
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col col-md-12">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label>*Valor en Letras:</label>
                            <textarea class="form-control " name="total_in_letters" onpaste="return false"
                                maxlength="128" onkeypress="return soloLetras(event)" required autofocus
                                onkeyup="javascript:this.value=this.value.toUpperCase();">{{ old('total_in_letters') }}</textarea>
                            <small class="form-text text-gray-600">
                                Escriba el valor total en letras
                            </small>
                        </div>
                    </div>
                </div>
            </div>

            <p class="h4 mb-1 text-gray-800">Factura Digital & Cloud </p>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>*Número de la Factura:</label>
                            <input type="text" class="form-control" name="invoice_number" maxlength="64"
                                value="{{ old('invoice_number') }}" placeholder="Enter Number" required autofocus
                                onkeyup="javascript:this.value=this.value.toUpperCase();">
                            <small class="form-text text-gray-600">
                                The Invoice Number field cannot be duplicated
                            </small>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>*Nombre del Vendedor:</label>
                            <input type="text" class="form-control" name="seller" maxlength="64"
                                value="{{ old('seller') }}" placeholder="Enter Name" required autofocus>
                        </div>
                    </div>

                    <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 10rem;"
                        src="{{ asset('/core/undraw/share-link.svg') }}">

                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <div class="alert alert-info">
                                <small class="form-text text-muted">
                                    Importe la factura del provedor. <br>
                                    <strong>Nota:</strong> Solo esta permitido en formado PDF con un
                                    tamaño máximo de 1 MB
                                </small>
                            </div>

                            <br>
                            <input type="file" class="form-control col-md-8" name="digital_invoice"
                                accept="file/PDF, image/PDF" required>
                        </div>
                    </div>
                </div>
            </div>

            <p class="h4 mb-1 text-gray-800">Resume & Observations</p>
            <small>Detalle acontinuación la descripcion de facturación y productos adquiridos...</small>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <textarea class="form-control" id="observations" name="observations" maxlength="1024"
                                required autofocus>{{ old('observations') }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            @if($providers->isEmpty())
            <!-- 101 Error compañia no creada en el sistema -->
            <div class="row">
                <div class="col-md-12">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <div class="text-center">
                                <div class="error mx-auto" data-text="103">
                                    <p>103</p>
                                </div>
                                <p class="lead text-gray-800 mb-5">Error Provider No Found</p>
                                <p class="text-gray-800 mb-0">
                                    <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 20rem;"
                                        src="{{ asset('/core/undraw/error-feeling.svg') }}">
                                    <br>
                                    No se encontro un provedor registrado en el sistema
                                </p>

                                <a href="{{ route('providers.create') }}">&larr; Back to providers</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @else

            <div class="alert alert-secondary">
                <p class="h4 mb-1 text-gray-800"></p>
                <i class="fa fa-landmark fa-2x" aria-hidden="true"></i>

                <h2>Provider Relation!</h2>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <h4>*Seleccione un Provedor:</h4>
                                <select class="form-control" name="provider_id">
                                    <option value="">Seleccione...</option>
                                    @foreach($providers as $provider)
                                    <option value="{{ $provider->id }}"
                                        {{ old('provider_id') == $provider->id ? 'selected' : '' }}>
                                        {{ $provider->name }} - {{ $provider->kind_of_society }} </option>
                                    @endforeach
                                </select>
                                <small class="form-text text-gray-800">
                                    <strong>¿De que Provedor es el ingreso de Articulo que desea registrar?</strong>
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

            <!-- Confirmacion Modal, Agregar Article -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCreateArticle">
                Agregar
            </button>
            <!-- Modal -->
            <div class="modal fade" id="modalCreateArticle" tabindex="-1" role="dialog"
                aria-labelledby="modalCreateArticle" aria-hidden="true">
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
                                                    ¿Agregar Articulo?
                                                </div>
                                                <div class="p mb-0 font-weight text-gray-800">
                                                    <p>
                                                        Atención!
                                                        <br>
                                                        {{ Auth::user()->name }}
                                                        <br>
                                                        ¿Desea registrar el siguiente articulo?
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-shopping-cart fa-2x text-gray-300"></i>
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
<script src="{{ asset('/core/plugins/autonumeric/dist/autoNumeric.min.js') }}"></script>
<!-- import script fixFormatMoneyAutoNumeric  -->
<script src="{{ asset('/core/plugins/ckeditor/ckeditor.js') }}"></script>
<script>
    // CkEditor
    CKEDITOR.config.heigth = 400;
    CKEDITOR.config.width = 'auto';
    CKEDITOR.replace('observations');
</script>

<!-- import script fixFormatChangeForLetter  -->
<script src="{{ asset('/core/js/fixFormatChangeForLetter.js') }}"></script>

<!-- import script fixFormatMoneyAutoNumeric  -->
<script src="{{ asset('/core/js/fixFormatMoneyAutoNumeric.js') }}"></script>
@endpush
