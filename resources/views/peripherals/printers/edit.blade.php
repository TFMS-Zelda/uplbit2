@extends('layouts.dashboard')

@section('title', 'information-&-technologies')

@section('content')

@section('titlePosition', 'printers/edit')
<!-- import css timeline comments -->
<link href="{{ asset('/css/views/comments/comments.css') }}" rel="stylesheet">


<style>
    input[type="text"],
    input[type="email"],
    textarea {
        background-color: #E9EFF7;
    }
</style>

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
                                    <span class="badge badge-black">{{ $printer->status }} </span>

                                    @elseif($printer->status === 'Retirado - Baja de Activo')
                                    <span class="badge badge-primary">{{ $printer->status }} </span>
                                    @endif

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

        <p class="mb-4 text-justify">
            Edite el siguiente formulario, recuerde que los campos marcados con <strong>*</strong> son de caracter
            obligatorio
        </p>

        <div class="text-center">
            <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 20rem;"
                src="{{ asset('/core/undraw/photocopy.svg') }}">

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


        <form action="{{ route('peripherals.printers.update', $printer->id) }}" method="POST">
            @csrf
            @method('PUT')


            <p class="h4 mb-1 text-gray-800">Computer Resume</p>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>*Marca de Impresora:</label>
                            <select class="form-control" name="brand" required>
                                <option value="{{ $printer->brand }}" style="font-weight: bold;">{{ $printer->brand }}
                                </option>
                                <option value="">Escoger...</option>
                                <option value="Kyocera">Kyocera</option>
                                <option value="Epson">Epson</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label>*Módelo de Impresora:</label>
                            <select class="form-control" name="model" required>
                                <option value="{{ $printer->model }}" style="font-weight: bold;">{{ $printer->model }}
                                </option>
                                <option value="">Escoger...</option>
                                <option value="ECOSYS M3550idn">ECOSYS M3550idn</option>
                                <option value="ECOSYS M3655idn">ECOSYS M3655idn</option>
                                <option value="Epson EcoTank L355">Epson EcoTank L355</option>
                                <option value="Epson EcoTank L375">Epson EcoTank L375</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label><code>*Serial:</code></label>
                            <input type="text" class="form-control" name="serial" maxlength="128"
                                placeholder="Enter Serial" value="{{ $printer->serial }}" required autofocus
                                onkeyup="javascript:this.value=this.value.toUpperCase();">
                            <small class="form-text text-gray-600">
                                The Serial field cannot be duplicated
                            </small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>*Funciones de Impresión:</label>
                            <select class="form-control" name="printer_functions" required>
                                <option value="{{ $printer->printer_functions }}" style="font-weight: bold;">
                                    {{ $printer->printer_functions }}</option>
                                <option value="">Escoger...</option>
                                <option value="Impresión/Escanea/Copia/Fax">Impresión/Escanea/Copia/Fax</option>
                                <option value="Impresión/Escanea/Copia">Impresión/Escanea/Copia</option>
                                <option value="Impresión">Impresión</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>*Resolución:</label>
                            <select class="form-control" name="resolution" required>
                                <option value="{{ $printer->resolution }}" style="font-weight: bold;">
                                    {{ $printer->resolution }}</option>
                                <option value="">Escoger...</option>
                                <option value="600 x 600 dpi, Up To Fine 1200 dpi">600 x 600 dpi, Up To Fine 1200 dpi
                                </option>
                                <option value="No Aplica">No Aplica</option>
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
                            <label>*Disco Duro</label>
                            <input type="text" class="form-control" name="hard_disk" maxlength="128"
                                value="{{ $printer->hard_disk}}" placeholder="Enter Size" required autofocus
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
                                <option value="{{ $printer->paper_sources }}" style="font-weight: bold;">
                                    {{ $printer->paper_sources }}</option>
                                <option value="">Escoger...</option>
                                <option value="Estándar: 1 Bandeja + 1 BMP - Máximo: 5 Bandejas + 1 BMP">Estándar: 1
                                    Bandeja + 1 BMP - Máximo: 5 Bandejas + 1 BMP</option>
                                <option value="1 Bandeja">1 Bandeja</option>
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
                                <option value="{{ $printer->input_capacity }}" style="font-weight: bold;">
                                    {{ $printer->input_capacity }}</option>
                                <option value="">Escoger...</option>
                                <option value="Estándar: 600 Hojas -  Máximo: 2,600 Hojas">Estándar: 600 Hojas - Máximo:
                                    2,600 Hojas</option>
                                <option value="Predefinida">Predefinida</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>*Capacidad de Salida:</label>
                            <select class="form-control" name="output_capacity" required>
                                <option value="{{ $printer->output_capacity }}" style="font-weight: bold;">
                                    {{ $printer->output_capacity }}</option>
                                <option value="">Escoger...</option>
                                <option value="Estándar: 250  Hojas -  Máximo: 250 Hojas">Estándar: 250 Hojas - Máximo:
                                    250 Hojas</option>
                                <option value="Predefinida">Predefinida</option>
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
                        <div class="form-group col-md-12">
                            @if($articles->isEmpty())
                            <!-- 101 Error compañia no creada en el sistema -->
                            <div class="text-center">
                                <div class="error mx-auto" data-text="104">
                                    <p>104</p>
                                </div>
                                <p class="lead text-gray-800 mb-5">Error Articles No Found</p>
                                <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 20rem;"
                                    src="{{ asset('/core/undraw/error-feeling.svg') }}">
                                <br>
                                <p class="text-gray-800 mb-0">No se ha encotrado un Articulo registrado en el sistema,
                                    primero agrege una Articulo.

                                </p>

                                <a href="{{ route('articles.create') }}">&larr; Back to articles</a>
                            </div>
                            @else

                            <p class="h4 mb-1 text-gray-800">Invoice Provider</p>
                            <div class="alert alert-info">
                                <small class="form-text text-gray-600">
                                    Acontinuación relacionara los datos de facturación correspondiente a la compra del
                                    equipo de computo que va a registar
                                    en el sistema...
                                </small>
                            </div>

                            <div class="card mb-4 py-3 border-left-primary">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table
                                            class="table table-light  table-striped table-bordered table-sm  table-hover"
                                            id="table-articles" width="100%" cellspacing="0">
                                            <thead>
                                                <tr class="bg-gradient-primary text-white text-center">
                                                    <th></th>
                                                    <th><i class="fas fa-sort-numeric-down-alt"></i> ID:</th>
                                                    <th><i class="fa fa-landmark" aria-hidden="true"></i> ¿De que
                                                        Provedor?</th>
                                                    <th><i class="fa fa-file-invoice-dollar" aria-hidden="true"></i>
                                                        Número de
                                                        Factura</th>
                                                    <th><i class="fas fa-search-dollar"></i> Valor de Factura</th>
                                                    <th>Fecha de Factura</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($articles as $article)
                                                <tr class="text-center">
                                                    <td class="text-center">
                                                        <button type="button" class="btn btn-outline-primary btn-sm">
                                                            <i class="fas fa-check"></i>
                                                        </button>
                                                    </td>
                                                    <th>{{ $article->id }}</th>
                                                    <td>{{ $article->provider->name }}</td>
                                                    <td>{{ $article->invoice_number }}</td>
                                                    <td>{{ $article->total_bill }}</td>
                                                    <td>
                                                        {{ Carbon\Carbon::parse($article->invoice_date)->format('l jS \\of F Y ') }}
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="spinner-grow text-primary" role="status">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                    <div class="spinner-grow text-secondary" role="status">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                    <div class="spinner-grow text-success" role="status">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                    <div class="spinner-grow text-danger" role="status">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                    <div class="spinner-grow text-warning" role="status">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                    <div class="spinner-grow text-info" role="status">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                    <div class="spinner-grow text-light" role="status">
                                        <span class="sr-only">Loading...</span>
                                    </div>

                                    <!-- hidden id_article -->
                                    <div class="form-group">
                                        <input type="hidden" class="form-control" id="writeSelectIdArticle"
                                            name="article_id" value="{{ $printer->article->id }} " required readonly>
                                    </div>
                                    <!-- end hidden id_article -->

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-row">

                                                <div class="form-group col-md-4">
                                                    <label><i class="fa fa-angle-double-right" aria-hidden="true"> </i>
                                                        Provedor</label>
                                                    <input type="text" class="form-control" maxlength="64"
                                                        id="writeSelectProvider"
                                                        value="{{ $printer->article->provider->name }}"
                                                        placeholder="Push Table" readonly />

                                                </div>

                                                <div class="form-group col-md-4">
                                                    <label><i class="fa fa-angle-double-right" aria-hidden="true"></i>
                                                        Número de Factura </i></label>
                                                    <input type="text" class="form-control" maxlength="64"
                                                        id="writeSelectInvoiceNumber"
                                                        value="{{ $printer->article->invoice_number }}"
                                                        placeholder="Push Table" readonly />

                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label><i class="fa fa-angle-double-right" aria-hidden="true"></i>
                                                        Valor de Factura</label>
                                                    <input type="text" class="form-control" maxlength="64"
                                                        id="writeSelectInvoiceTotal"
                                                        value="{{ $printer->article->total_bill }}"
                                                        placeholder="Push Table" readonly />

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="alert alert-warning">
                                        <small class="form-text text-gray-600">
                                            Seleccione un <code>Id</code> de la Tabla Invoice Provider, donde podra
                                            encontrar los
                                            datos de provedor y
                                            la facturación correspondiente
                                            a la compra del equipo de computo que va registrar en el sistema...
                                        </small>
                                    </div>

                                </div>
                            </div>
                            @endif

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
                                <option value="{{ $printer->location }}" style="font-weight: bold;">
                                    {{ $printer->location }}</option>
                                <option value="">Escoger...</option>
                                <option value="UPL Oficina - Bogota">UPL Oficina - Bogota</option>
                                <option value="UPL Oficina - Planta Madrid">UPL Oficina - Planta Madrid</option>
                                <option value="UPL Bodega - Antioquia">UPL Bodega - Antioquia</option>
                                <option value="UPL Bodega - Meta">UPL Bodega - Meta</option>
                                <option value="UPL Bodega - Risaralda">UPL Bodega - Risaralda</option>
                                <option value="UPL Bodega - Casanare">UPL Bodega - Casanare</option>
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
                            <input type="text" class="form-control" name="mac_adrress" maxlength="64"
                                value="{{ $printer->mac_adrress }}" placeholder="Enter Mac" required autofocus
                                onkeyup="javascript:this.value=this.value.toUpperCase();">
                            <small class="form-text text-gray-600">
                                The Mac Address field cannot be duplicated
                            </small>
                        </div>
                        <div class="form-group col-md-4">
                            <label><code>*Ip Address:</code></label>
                            <input type="text" class="form-control" name="ip_address" maxlength="64"
                                value="{{ $printer->ip_address }}" placeholder="Enter Ip" required autofocus
                                onkeyup="javascript:this.value=this.value.toUpperCase();">
                            <small class="form-text text-gray-600">
                                The Ip Address field cannot be duplicated
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
                            <select class="form-control" name="status" required autofocus>
                                <option value="{{ $printer->status }}" style="font-weight: bold;">
                                    {{ $printer->status }}</option>
                                <option value="">Escoger...</option>
                                <option value="Activo - Asignado">Activo - Asignado</option>
                                <option value="Inactivo - No Asignado">Inactivo - No Asignado</option>
                                <option value="En Mantenimiento">En Mantenimiento</option>
                                <option value="Dañado">Dañado</option>
                                <option value="Retirado - Baja de Activo">Retirado - Baja de Activo</option>
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
                            {{ Form::date('warranty_start', $printer->warranty_start , ['class' => 'form-control' , 'required'] ) }}
                        </div>
                        <div class="form-group col-md-4">
                            <label>*Fin de Garantía:</label>
                            {{ Form::date('warranty_end', $printer->warranty_end , ['class' => 'form-control' , 'required'] ) }}
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

            <div class="alert alert-secondary col col-md-12">
                <!-- timeline comments -->
                <div class="container">
                    @foreach ($printer->comments as $comment)
                    <ul class="timeline">

                        <li>
                            <!-- begin timeline-time -->
                            <div class="timeline-time">
                                <span class="date">
                                    {{ $comment->created_at->diffForHumans() }}</span>
                                <span class="time">{{ $printer->created_at->toDateTimeString() }} </span>
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
                                    <span class="username"><a href="javascript:;">{{ $comment->user->name }} </a>
                                        <small></small></span>
                                    <span class="pull-right text-muted">
                                        {{ $comment->user->email }}
                                    </span>
                                </div>
                                <div class="timeline-content">

                                    <div class="text-xm text-justify bg-gray-100">
                                        <p class="text-gray-800">{{ $comment->body }} </p>
                                    </div>

                                </div>
                                <div class="timeline-likes">
                                    <div class="stats-right">
                                        <span class="stats-text">259 Shares</span>
                                        <span class="stats-text">Ultima Actualizacion
                                            <span class="time">{{ $printer->created_at->toDateTimeString() }} </span>

                                        </span>
                                    </div>
                                    <div class="stats">
                                        <span class="stats-total">
                                            <i class="fas fa-bell"></i>
                                        </span>
                                        <i class="fas fa-laptop"></i>
                                        <span class="stats-total">{{ $printer->license_plate }} </span>
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
                                <input type="text" class="form-control rounded-corner" name="body" required
                                    placeholder="Write a comment...">

                            </div>
                            <small class="form-text text-muted">
                                Ingrese los comentarios pertinentes
                            </small>
                        </div>
                    </div>
                </div>
                <!-- end timeline -->
            </div>

            <!-- Confirmacion Modal, Editar Computer -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalEditarPrinter">
                Editar
            </button>
            <!-- Modal -->
            <div class="modal fade" id="modalEditarPrinter" tabindex="-1" role="dialog"
                aria-labelledby="modalEditarPrinter" aria-hidden="true">
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
                                                    ¿Actualizar Printer?
                                                </div>
                                                <div class="p mb-0 font-weight text-gray-800">
                                                    <p>Atención!
                                                        <br>
                                                        {{ Auth::user()->name }} <br>
                                                        ¿Desea actualizar la siguiente impresora?
                                                        <ul class="list-unstyled">
                                                            <li>
                                                                <div class="h6 mb-0 font-weight-bold text-gray-800">
                                                                    Placa: <code>{{ $printer->license_plate }}</code><br>
                                                                    {{ $printer->brand }} , {{ $printer->model }}
                                                                </div>
                                                            </li>
                                                        </ul>
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
                            <button type="submit" class="btn btn-primary">Confirmar</button>
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
<script>
    // Validacion: Solo permite escribir caracteres numericos
    $('.selectValidationNumber').on('input', function () {
        this.value = this.value.replace(/[^0-9]/g, '');
    });

    $(document).ready(function () {
        $('#table-articles').DataTable();
    });

    // script  mediante un click en la tabla captura todos los valores y los pasa por un arreglo
    var table = document.getElementById('table-articles');

    for (var i = 1; i < table.rows.length; i++) {
        table.rows[i].onclick = function () {
            document.getElementById("writeSelectIdArticle").value = this.cells[1].innerHTML;
            document.getElementById("writeSelectProvider").value = this.cells[2].innerHTML;
            document.getElementById("writeSelectInvoiceNumber").value = this.cells[3].innerHTML;
            document.getElementById("writeSelectInvoiceTotal").value = this.cells[4].innerHTML;

        };
    }

</script>
@endsection