@extends('layouts.dashboard')

@section('title', 'information-&-technologies')

@section('content')
@section('titlePosition', 'printers/create')

<style>
    input[type="text"],
    input[type="email"] textarea {
        background-color: #E9EFF7;
    }
</style>

<section class="content">
    <div class="container-fluid">
        <h1 class="h3 mb-1 text-gray-800">Agregar Impresora</h1>
        <p class="mb-4 text-justify">
            Complete el siguiente formulario, recuerde que los campos marcados con <strong>*</strong> son de caracter
            obligatorio.
        </p>

        <div class="text-center">
            <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 20rem;"
                src="{{ asset('/core/undraw/photocopy.svg') }}">
        </div>
        <!-- import partials.errors-validation -->
        @include('partials.errors-validation')
        <!-- close import -->

        <form action="{{ route('peripherals.printers.store') }}" method="POST">
            @csrf

            <p class="h4 mb-1 text-grasy-800">Printer Resume</p>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>*Marca:</label>
                            <select class="form-control BrandSelectClass" name="brand" id="brandSelectId"
                                onchange="cargarModelos()" required>
                                <option value="">Seleccione...</option>

                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>*Módelo:</label>
                            <select class="form-control" name="model" id="modelSelectId" required>
                                <option value="">Seleccione...</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label><code>*Serial Impresora:</code></label>
                            <input type="text" class="form-control" maxlength="64" name="serial"
                                placeholder="Enter Serial" value="{{ old('serial') }}" required />
                            <small class="form-text">
                                <code> The Serial field cannot be duplicated</code>
                            </small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>*Funciones de Impresión:</label>
                            <select class="form-control" name="printer_functions" required>
                                <option value="">Escoger...</option>

                                <option value="Impresión/Escanea/Copia/Fax"
                                    {{ old('printer_functions') == 'Impresión/Escanea/Copia/Fax' ? 'selected' : ''}}>
                                    Impresión/Escanea/Copia/Fax</option>

                                <option value="Impresión/Escanea/Copia"
                                    {{ old('printer_functions') == 'Impresión/Escanea/Copia' ? 'selected' : ''}}>
                                    Impresión/Escanea/Copia</option>

                                <option value="Impresión"
                                    {{ old('printer_functions') == 'Impresión' ? 'selected' : ''}}>
                                    Impresión</option>
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label>*Resolución:</label>
                            <select class="form-control" name="resolution" required>
                                <option value="">Escoger...</option>

                                <option value="600 x 600 dpi, Up To Fine 1200 dpi"
                                    {{ old('resolution') == '600 x 600 dpi, Up To Fine 1200 dpi' ? 'selected' : ''}}>
                                    600 x 600 dpi, Up To Fine 1200 dpi</option>

                                <option value="No Aplica" {{ old('resolution') == 'No Aplica' ? 'selected' : ''}}>No
                                    Aplica</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>*CPU</label>
                            <input type="text" class="form-control" name="cpu" maxlength="128" value="{{ old('cpu') }}"
                                placeholder="Enter Size" required autofocus
                                onkeyup="javascript:this.value=this.value.toUpperCase();">
                        </div>
                        <div class="form-group col-md-4">
                            <label>*Memoria</label>
                            <input type="text" class="form-control" name="memory" maxlength="128"
                                value="{{ old('memory') }}" placeholder="Enter Size" required autofocus
                                onkeyup="javascript:this.value=this.value.toUpperCase();">
                        </div>
                        <div class="form-group col-md-4">
                            <label>*Disco Duro</label>
                            <input type="text" class="form-control" name="hard_disk" maxlength="128"
                                value="{{ old('hard_disk') }}" placeholder="Enter Size" required autofocus
                                onkeyup="javascript:this.value=this.value.toUpperCase();">
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>*Fuentes de Papel:</label>
                            <select class="form-control" name="paper_sources" required>
                                <option value="">Escoger...</option>

                                <option value="Estándar: 1 Bandeja + 1 BMP - Máximo: 5 Bandejas + 1 BMP"
                                    {{ old('paper_sources') == 'Estándar: 1 Bandeja + 1 BMP - Máximo: 5 Bandejas + 1 BMP' ? 'selected' : ''}}>
                                    Estándar: 1 Bandeja + 1 BMP - Máximo: 5 Bandejas + 1 BMP</option>

                                <option value="Estándar: 1 Bandeja + 1 BMP - Máximo: 5 Bandejas + 1 BMP"
                                    {{ old('paper_sources') == 'Estándar: 1 Bandeja + 1 BMP - Máximo: 5 Bandejas + 1 BMP' ? 'selected' : ''}}>
                                    Estándar: 1 Bandeja + 1 BMP - Máximo: 5 Bandejas + 1 BMP</option>

                                <option value="1 Bandeja" {{ old('paper_sources') == '1 Bandeja' ? 'selected' : ''}}>
                                    1 Bandeja</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>*Capacidad de Entrada:</label>
                            <select class="form-control" name="input_capacity" required>
                                <option value="">Escoger...</option>

                                <option value="Estandar: 600 Hojas - Maximo: 2,600 Hojas"
                                    {{ old('input_capacity') == 'Estandar: 600 Hojas - Maximo: 2,600 Hojas' ? 'selected' : ''}}>
                                    Estandar: 600 Hojas - Maximo: 2,600 Hojas</option>

                                <option value="Predefinida"
                                    {{ old('input_capacity') == 'Predefinida' ? 'selected' : ''}}>
                                    Predefinida</option>
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label>*Capacidad de Salida:</label>
                            <select class="form-control" name="output_capacity" required>
                                <option value="">Escoger...</option>
                                <option value="Estandar: 250 Hojas - Maximo: 250 Hojas"
                                    {{ old('output_capacity') == 'Estandar: 250 Hojas - Maximo: 250 Hojas' ? 'selected' : ''}}>
                                    Estandar: 250 Hojas - Maximo: 250 Hojas</option>

                                <option value="Predefinida"
                                    {{ old('output_capacity') == 'Predefinida' ? 'selected' : ''}}>
                                    Predefinida</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <p class="h4 mb-1 text-gray-800">Informacion Corporativa</p>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label><code>*Placa Corporativa:</code></label>
                            <input type="text" class="form-control selectValidationNumber" name="license_plate"
                                maxlength="7" value="{{ old('license_plate') }}" placeholder="Enter Placa" required
                                autofocus>
                            <small class="form-text text-gray-600">
                                The License Plate field cannot be duplicated
                            </small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>*Localización:</label>
                            <select class="form-control" name="location" required>
                                <option value="">Escoger...</option>

                                <option value="UPL Oficina - Bogota"
                                    {{ old('location') == 'UPL Oficina - Bogota' ? 'selected' : ''}}>
                                    UPL Oficina - Bogota</option>

                                <option value="UPL Oficina - Planta Madrid"
                                    {{ old('location') == 'UPL Oficina - Planta Madrid' ? 'selected' : ''}}>
                                    UPL Oficina - Planta Madrid</option>

                                <option value="UPL Bodega - Antioquia"
                                    {{ old('location') == 'UPL Bodega - Antioquia' ? 'selected' : ''}}>
                                    UPL Bodega - Antioquia</option>

                                <option value="UPL Bodega - Meta"
                                    {{ old('location') == 'UPL Bodega - Meta' ? 'selected' : ''}}>
                                    UPL Bodega - Meta</option>

                                <option value="UPL Bodega - Risaralda"
                                    {{ old('location') == 'UPL Bodega - Risaralda' ? 'selected' : ''}}>
                                    UPL Bodega - Risaralda</option>

                                <option value="UPL Bodega - Casanare"
                                    {{ old('location') == 'UPL Bodega - Casanare' ? 'selected' : ''}}>
                                    UPL Bodega - Casanare</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label><code>*Mac Address:</code></label>
                            <input type="text" id="inputMacAddress" class="form-control" name="mac_adrress"
                                maxlength="14" value="{{ old('mac_adrress') }}" placeholder="Enter Mac" required
                                autofocus onkeyup="javascript:this.value=this.value.toUpperCase();">
                            <small class="form-text text-gray-600">
                                The Mac Address field cannot be duplicated
                            </small>
                        </div>
                        <div class="form-group col-md-4">
                            <label><code>*Ip Address:</code></label>
                            <input type="text" class="form-control" id="ipv4" name="ipv4"
                                placeholder="xxx.xxx.xxx.xxx" />
                            <small class="form-text text-gray-600">
                                The Ip Address field cannot be duplicated
                            </small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="alert alert-success">
                <p class="h4 mb-1 text-gray-800"></p>
                <i class="fa fa-link" aria-hidden="true"></i>

                <h2>Provider & Article Relation!</h2>
                <p>Seleccione un Provedor para obtener los articulos registrados y relacionados...</p>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <h4>*Seleccione un Provedor:</h4>
                                <select class="form-control" name="provider" id="provider">
                                    <option value="">Select Provider</option>
                                    @foreach ($providers as $key => $value)
                                    <option value="{{ $key }}">{{ $value }} </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-md-4">
                                <h4>*Seleccione un Articulo:</h4>
                                <select class="form-control" name="article_id" id="article">
                                    <option value="">Please Select Provider</option>
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
                            <label>*Estado:</label>
                            <select class="form-control" name="status" required autofocus>
                                <option value="Inactivo - No Asignado"
                                    {{ old('location') == 'Inactivo - No Asignado' ? 'selected' : ''}}>
                                    Inactivo - No Asignado</option>
                            </select>
                            <small>
                                El estado Inactivo - No Asignado es seleccionado por el sistema
                            </small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-8">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>*Inicio de Garantía:</label>
                            <input type="date" class="form-control" name="warranty_start" required autofocus>
                        </div>
                        <div class="form-group col-md-4">
                            <label>*Fin de Garantía:</label>
                            <input type="date" class="form-control" name="warranty_end" required autofocus>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>*Agregado Por:</label>
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

            <p class="h4 mb-1 text-gray-800">Comentarios</p>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <textarea name="body" class="form-control" required autofocus>{{ old('body') }}</textarea>
                            <small class="form-text text-gray-600">
                                Ingrese algun comentario u observación
                            </small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Confirmacion Modal, Agregar Printer -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCreatePrinter">
                Agregar
            </button>
            <!-- Modal -->
            <div class="modal fade" id="modalCreatePrinter" tabindex="-1" role="dialog"
                aria-labelledby="modalCreatePrinter" aria-hidden="true">
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
                                                    ¿Agregar Printer?
                                                </div>
                                                <div class="p mb-0 font-weight text-gray-800">
                                                    <p>Atención!
                                                        <br>
                                                        {{ Auth::user()->name }} <br>
                                                        ¿Desea registar la siguiente impresora en el sistema?
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-print fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Registrar</button>
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
<!-- Custom scripts-->
<script src="{{ asset('/core/js/select-brand-&-model-printer-fix.js') }}"></script>
<script src="{{ asset('/core/js/selectValidationNumber.js') }}"></script>
<script src="{{ asset('/core/js/macAddress-fix.js') }}"></script>
@endpush