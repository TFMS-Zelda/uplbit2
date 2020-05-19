@extends('layouts.dashboard')

@section('title', 'information-&-technologies')

@section('content')

@section('titlePosition', 'printers/edit')

<section class="content">
    <div class="container-fluid">
        <h1 class="h3 mb-1 text-gray-800">Editar Ci Impresora</h1>
        <div class="row">

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Placa
                                    Corporativa</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $printer->license_plate }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-barcode fa-2x text-gray-300"></i>
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
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Módelo & Serial
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ $printer->model }}
                                    {{ $printer->serial }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-print fa-2x text-gray-300"></i>
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
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Localización</div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                            {{ $printer->location }} </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-map-marker-alt fa-2x text-gray-300"></i>
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

                                    @if ($printer->status === 'Activo - Asignado')
                                    <span class="badge badge-success">{{ $printer->status }} </span>

                                    @elseif($printer->status === 'Inactivo - No Asignado')
                                    <span class="badge badge-danger">{{ $printer->status }} </span>

                                    @elseif($printer->status === 'En Mantenimiento')
                                    <span class="badge badge-warning">{{ $printer->status }} </span>

                                    @elseif($printer->status === 'Dañado')
                                    <span class="badge badge-black">{{ $printer->status }} </span </div> </div> <div
                                        class="col-auto">
                                    <i class="fas fa-clock fa-2x text-gray-300"></i>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <p class="mb-4 text-justify">
            Edite el siguiente formulario, recuerde que los campos marcados con <strong>*</strong> son de caracter
            obligatorio
        </p>

        <div class="text-center">
            <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 20rem;"
                src="{{ asset('/core/undraw/photocopy.svg') }}">
        </div>
        <!-- import partials.errors-validation -->
        @include('partials.errors-validation')
        <!-- close import -->

        <form action="{{ route('peripherals.printers.update', $printer->id) }}" method="POST">
            @csrf
            @method('PUT')

            <p class="h4 mb-1 text-gray-800">Printer Resume</p>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>*Marca:</label>
                            <select class="form-control BrandSelectClass" name="brand" id="brandSelectId"
                                onchange="cargarModelos()" required>
                                <option value="{{ $printer->brand }}" @if (old($printer->
                                    brand)=='{{ $printer->brand }}') selected="selected" @endif>
                                    {{ $printer->brand }}
                                </option>

                                <option style="font-size: 2pt; background-color: #E9EFF7;" disabled>&nbsp;</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>*Módelo:</label>
                            <select class="form-control" name="model" id="modelSelectId" required>
                                <option value="{{ $printer->model }}" @if (old($printer->
                                    model)=='{{ $printer->model }}' )
                                    selected="selected" @endif>
                                    {{ $printer->model }}
                                </option>

                                <option style="font-size: 2pt; background-color: #E9EFF7;" disabled>&nbsp;</option>
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
                                placeholder="Enter Serial" value="{{ $printer->serial }}" required />
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
                                    {{ old('printer_functions', $printer->printer_functions) == 'Impresión/Escanea/Copia/Fax' ? 'selected' : ''}}>
                                    Impresión/Escanea/Copia/Fax</option>

                                <option value="Impresión/Escanea/Copia"
                                    {{ old('printer_functions', $printer->printer_functions) == 'Impresión/Escanea/Copia' ? 'selected' : ''}}>
                                    Impresión/Escanea/Copia</option>

                                <option value="Impresión"
                                    {{ old('printer_functions', $printer->printer_functions) == 'Impresión' ? 'selected' : ''}}>
                                    Impresión</option>
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label>*Resolución:</label>
                            <select class="form-control" name="resolution" required>
                                <option value="">Escoger...</option>

                                <option value="600 x 600 dpi, Up To Fine 1200 dpi"
                                    {{ old('resolution', $printer->resolution) == '600 x 600 dpi, Up To Fine 1200 dpi' ? 'selected' : ''}}>
                                    600 x 600 dpi, Up To Fine 1200 dpi</option>

                                <option value="No Aplica"
                                    {{ old('resolution', $printer->resolution) == 'No Aplica' ? 'selected' : ''}}>No
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
                            <input type="text" class="form-control" name="cpu" maxlength="128"
                                value="{{ $printer->cpu }}" placeholder="Enter Size" required autofocus
                                onkeyup="javascript:this.value=this.value.toUpperCase();">
                        </div>
                        <div class="form-group col-md-4">
                            <label>*Memoria</label>
                            <input type="text" class="form-control" name="memory" maxlength="128"
                                value="{{ $printer->memory }}" placeholder="Enter Size" required autofocus
                                onkeyup="javascript:this.value=this.value.toUpperCase();">
                        </div>
                        <div class="form-group col-md-4">
                            <label>*Discuo Duro</label>
                            <input type="text" class="form-control" name="hard_disk" maxlength="128"
                                value="{{ $printer->hard_disk }}" placeholder="Enter Size" required autofocus
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
                                    {{ old('paper_sources', $printer->paper_sources) == 'Estándar: 1 Bandeja + 1 BMP - Máximo: 5 Bandejas + 1 BMP' ? 'selected' : ''}}>
                                    Estándar: 1 Bandeja + 1 BMP - Máximo: 5 Bandejas + 1 BMP</option>

                                <option value="Estándar: 1 Bandeja + 1 BMP - Máximo: 5 Bandejas + 1 BMP"
                                    {{ old('paper_sources', $printer->paper_sources) == 'Estándar: 1 Bandeja + 1 BMP - Máximo: 5 Bandejas + 1 BMP' ? 'selected' : ''}}>
                                    Estándar: 1 Bandeja + 1 BMP - Máximo: 5 Bandejas + 1 BMP</option>

                                <option value="1 Bandeja"
                                    {{ old('paper_sources', $printer->paper_sources) == '1 Bandeja' ? 'selected' : ''}}>
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
                                    {{ old('input_capacity', $printer->input_capacity) == 'Estandar: 600 Hojas - Maximo: 2,600 Hojas' ? 'selected' : ''}}>
                                    Estandar: 600 Hojas - Maximo: 2,600 Hojas</option>

                                <option value="Predefinida"
                                    {{ old('input_capacity', $printer->input_capacity) == 'Predefinida' ? 'selected' : ''}}>
                                    Predefinida</option>
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label>*Capacidad de Salida:</label>
                            <select class="form-control" name="output_capacity" required>
                                <option value="">Escoger...</option>
                                <option value="Estandar: 250 Hojas - Maximo: 250 Hojas"
                                    {{ old('output_capacity', $printer->output_capacity) == 'Estandar: 250 Hojas - Maximo: 250 Hojas' ? 'selected' : ''}}>
                                    Estandar: 250 Hojas - Maximo: 250 Hojas</option>

                                <option value="Predefinida"
                                    {{ old('output_capacity', $printer->output_capacity) == 'Predefinida' ? 'selected' : ''}}>
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
                                maxlength="7" value="{{ $printer->license_plate }}" placeholder="Enter Placa" required
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
                                    {{ old('location', $printer->location) == 'UPL Oficina - Bogota' ? 'selected' : ''}}>
                                    UPL Oficina - Bogota</option>

                                <option value="UPL Oficina - Planta Madrid"
                                    {{ old('location', $printer->location) == 'UPL Oficina - Planta Madrid' ? 'selected' : ''}}>
                                    UPL Oficina - Planta Madrid</option>

                                <option value="UPL Bodega - Antioquia"
                                    {{ old('location', $printer->location) == 'UPL Bodega - Antioquia' ? 'selected' : ''}}>
                                    UPL Bodega - Antioquia</option>

                                <option value="UPL Bodega - Meta"
                                    {{ old('location', $printer->location) == 'UPL Bodega - Meta' ? 'selected' : ''}}>
                                    UPL Bodega - Meta</option>

                                <option value="UPL Bodega - Risaralda"
                                    {{ old('location', $printer->location) == 'UPL Bodega - Risaralda' ? 'selected' : ''}}>
                                    UPL Bodega - Risaralda</option>

                                <option value="UPL Bodega - Casanare"
                                    {{ old('location', $printer->location) == 'UPL Bodega - Casanare' ? 'selected' : ''}}>
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
                                maxlength="14" value="{{ $printer->mac_adrress }}" placeholder="Enter Mac" required
                                autofocus onkeyup="javascript:this.value=this.value.toUpperCase();">
                            <small class="form-text text-gray-600">
                                The Mac Address field cannot be duplicated
                            </small>
                        </div>
                        <div class="form-group col-md-4">
                            <label><code>*Ip Address:</code></label>
                            <input type="text" class="form-control" value="{{ $printer->ip_address }}" id="ipv4"
                                name="ip_address" placeholder="xxx.xxx.xxx.xxx" />
                            <small class="form-text text-gray-600">
                                The Ip Address field cannot be duplicated
                            </small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="alert alert-danger">
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
                                    <option value="" @if (old($printer->
                                        article->provider->id) == '{{ $printer->article->provider->id }}' )
                                        selected="selected" @endif>
                                        {{ $printer->article->provider->name }}
                                    </option>
                                    <option style="font-size: 2pt; background-color: #E9EFF7;" disabled>&nbsp;
                                    </option>

                                    @foreach ($providers as $key => $value)
                                    <option value="{{ $key }}">{{ $value }} </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-md-4">
                                <h4>*Seleccione un Articulo:</h4>
                                <select class="form-control" name="article_id" id="article">
                                    <option value="{{ $printer->article_id }} " @if (old($printer->
                                        article_id) == '{{ $printer->article_id }}' )
                                        selected="selected" @endif>
                                        {{ $printer->article->invoice_number }}
                                    </option>
                                    <option style="font-size: 2pt; background-color: #E9EFF7;" disabled>&nbsp;
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
                            <label>*Estado Impresora:</label>
                            <select class="form-control" name="status" v required>
                                <option value="Activo - Asignado"
                                    {{ old('status', $printer->status) == 'Activo - Asignado' ? 'selected' : ''}}>
                                    Activo - Asignado
                                </option>

                                <option value="Inactivo - No Asignado"
                                    {{ old('status', $printer->status) == 'Inactivo - No Asignado' ? 'selected' : ''}}>
                                    Inactivo - No Asignado
                                </option>

                                <option value="En Mantenimiento"
                                    {{ old('status', $printer->status) == 'En Mantenimiento' ? 'selected' : ''}}>
                                    En Mantenimiento
                                </option>

                                <option value="Dañado"
                                    {{ old('status', $printer->status) == 'Dañado' ? 'selected' : ''}}>
                                    Dañado
                                </option>

                                <option value="Retirado - Baja de Activo"
                                    {{ old('status', $printer->status) == 'Retirado - Baja de Activo' ? 'selected' : ''}}>
                                    Retirado - Baja de Activo
                                </option>

                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-8">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>*Inicio de Garantía:</label>
                            {{ Form::date('warranty_start', date($printer->warranty_start), ['class' => 'form-control']) }}

                        </div>
                        <div class="form-group col-md-4">
                            <label>*Fin de Garantía:</label>
                            {{ Form::date('warranty_end', date($printer->warranty_end), ['class' => 'form-control']) }}
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
            <div class="alert alert-secondary col col-md-12">
                <!-- timeline comments -->
                <div class="container">
                    @foreach ($printer->comments as $comment)
                    <ul class="timeline">

                        <li>
                            <!-- begin timeline-time -->
                            <div class="timeline-time">
                                <span class="date">
                                    {{ $comment-> created_at -> diffForHumans()}}</span>
                                <span class="time">{{ $printer-> created_at -> toDateTimeString()}} </span>
                            </div>
                            <!-- end timeline-time -->
                            <!-- begin timeline-icon -->
                            <div class="timeline-icon">
                                <a href="javascript:;">&nbsp;</a>
                            </div>
                            <!-- end timeline-icon -->
                            <!-- begin timeline-body -->
                            <div class="timeline-body">
                                <div class="timeline-header">
                                    <span class="userimage"><img src="{{ $comment->user->avatar }} " alt=""></span>
                                    <span class="username"><a href="javascript:;">{{ $comment-> user -> name}} </a>
                                        <small></small></span>
                                    <span class="pull-right text-muted">
                                        {{ $comment-> user -> email}}
                                    </span>
                                </div>
                                <div class="timeline-content">

                                    <div class="text-xm text-justify bg-gray-100">
                                        <p class="text-gray-800">{{ $comment-> body}} </p>
                                    </div>

                                </div>
                                <div class="timeline-likes">
                                    <div class="stats-right">
                                        <span class="stats-text">259 Shares</span>
                                        <span class="stats-text">Última Actualización,
                                            <span
                                                class="time">{{ Carbon\Carbon::parse($printer->updated_at)->format('l jS \\of F Y ') }}
                                            </span>

                                        </span>
                                    </div>
                                    <div class="stats">
                                        <span class="stats-total">
                                            <i class="fas fa-bell"></i>
                                        </span>
                                        <i class="fas fa-print"></i>
                                        <span class="stats-total">{{ $printer-> license_plate}} </span>
                                    </div>
                                </div>
                            </div>
                            <!-- end timeline-body -->
                        </li>
                    </ul>
                    @endforeach

                    <div class="timeline-comment-box">
                        <div class="user"><img src="{{ Auth::user()->avatar }} ">
                        </div>
                        <div class="input">
                            <div class="input-group">
                                <input type="text" class="form-control rounded-corner" name="body"
                                    value="{{ old('body') }}" placeholder="Write a comment..." required />

                            </div>
                            <small class="form-text text-muted">
                                Ingrese los comentarios pertinentes
                            </small>
                        </div>
                    </div>
                </div>
                <!-- end timeline -->
            </div>

            <!-- Modal-->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalEditPrinter">
                Editar
            </button>

            <!-- Modal modalEditPrinter-->
            <div class="modal fade" id="modalEditPrinter" tabindex="-1" role="dialog" aria-labelledby="modalEditPrinter"
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
                                                    ¿Actualizar Perisferico Impresora?
                                                </div>
                                                <div class="p mb-0 font-weight text-gray-800">
                                                    <p>Atención!
                                                        <br>
                                                        {{ Auth::user()->name }} <br>
                                                        ¿Desea actualizar la siguiente Impresora?
                                                        <ul>
                                                            <li>
                                                                <div class="h6 mb-0 font-weight-bold text-gray-800">
                                                                    <i class="fa fa-cog fa-spin" aria-hidden="true"></i>
                                                                    Placa: {{ $printer->license_plate }}
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="h6 mb-0 font-weight-bold text-gray-800">
                                                                    <i class="fas fa-barcode" aria-hidden="true"></i>
                                                                    Serial: {{ $printer->serial }}
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-printer fa-2x text-gray-300"></i>
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
<!-- Custom scripts-->
<script src="{{ asset('/core/js/select-brand-&-model-printer-fix.js') }}"></script>
<script src="{{ asset('/core/js/selectValidationNumber.js') }}"></script>
<script src="{{ asset('/core/js/macAddress-fix.js') }}"></script>
@endpush