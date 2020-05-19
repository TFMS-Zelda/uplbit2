@extends('layouts.dashboard')

@section('title', 'information-&-technologies')
@section('content')

@section('titlePosition', 'computers/edit')

<section class="content">
    <div class="container-fluid">
        <h1 class="h3 mb-1 text-gray-800">Editar Equipo de Computo</h1>
        <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Placa
                                    Corporativa</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $computer->license_plate }}
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
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Service Tag
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ $computer->servicetag }}
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
                                            {{ $computer->hostname }} </div>
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
                                    {{ $computer->status }}
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
                src="{{ asset('/core/undraw/computer.svg') }}">
        </div>
        <!-- import partials.errors-validation -->
        @include('partials.errors-validation')
        <!-- close import -->

        <!-- start form computers.update -->
        <form action="{{ route('computers.update', $computer->id) }}" method="POST">
            @csrf
            @method('PUT')
            <p class="h4 mb-1 text-gray-800">Computer Resume</p>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>*Tipo de Máquina:</label>
                            <select class="form-control" name="type_machine" required autofocus>
                                <option value="">Escoger...</option>
                                <option value="Laptop"
                                    {{ old('type_machine', $computer->type_machine) == 'Laptop' ? 'selected' : '' }}>
                                    Laptop
                                </option>
                                <option value="Desktop"
                                    {{ old('type_machine', $computer->type_machine) == 'Desktop' ? 'selected' : '' }}>
                                    Desktop
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
                            <label>*Marca:</label>
                            <select class="form-control BrandSelectClass" name="brand" id="brandSelectId"
                                onchange="cargarModelos()" required>
                                <option value="{{ $computer->brand }}" @if (old($computer->
                                    brand)=='{{ $computer->brand }}') selected="selected" @endif>
                                    {{ $computer->brand }}
                                </option>

                                <option style="font-size: 2pt; background-color: #E9EFF7;" disabled>&nbsp;</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>*Módelo:</label>
                            <select class="form-control" name="model" id="modelSelectId" required>
                                <option value="{{ $computer->model }}" @if (old($computer->
                                    model)=='{{ $computer->model }}' )
                                    selected="selected" @endif>
                                    {{ $computer->model }}
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
                        <div class="form-group col-md-4">
                            <label><code>*ServiceTag</code>:</label>
                            <input type="text" class="form-control" name="servicetag" maxlength="64"
                                value="{{ $computer->servicetag }}" placeholder="Enter Code" required autofocus
                                onkeyup="javascript:this.value=this.value.toUpperCase();">
                            <small class="form-text text-gray-600">
                                <code>The Service Tag field cannot be duplicated</code>
                            </small>
                        </div>
                        <div class="form-group col-md-4">
                            <label>*ServiceCode:</label>
                            <input type="text" class="form-control" name="servicecode" maxlength="64"
                                value="{{ $computer->servicecode }}" placeholder="Enter Code" required autofocus
                                onkeyup="javascript:this.value=this.value.toUpperCase();">
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>*Sistema Operativo:</label>
                            <select class="form-control" name="operating_system" required autofocus>
                                <option value="Windows 7 Pro 64 Bits"
                                    {{ old('operating_system', $computer->operating_system) == 'Windows 10 Pro 64 Bits' ? 'selected' : '' }}>
                                    Windows 10 Pro 64 Bits
                                </option>
                                <option value="Windows 8 Pro 64 Bits"
                                    {{ old('operating_system', $computer->operating_system) == 'Windows 8 Pro 64 Bits' ? 'selected' : '' }}>
                                    Windows 8 Pro 64 Bits
                                </option>
                                <option value="Windows 7 Pro 64 Bits"
                                    {{ old('operating_system', $computer->operating_system) == 'Windows 7 Pro 64 Bits' ? 'selected' : '' }}>
                                    Windows 7 Pro 64 Bits
                                </option>
                            </select>
                        </div>

                        <div class="form-group col-md-4">
                            <label>*Disco Duro:</label>
                            <select class="form-control" name="hard_drive" required autofocus>
                                <option value="500 GB Mecanico"
                                    {{ old('hard_drive', $computer->hard_drive) == '500 GB Mecanico' ? 'selected' : '' }}>
                                    500 GB Mecanico
                                </option>
                                <option value="1 TB Mecanico"
                                    {{ old('hard_drive', $computer->hard_drive) == '1 TB Mecanico' ? 'selected' : '' }}>
                                    1 TB Mecanico
                                </option>
                                <option value="256 GB SSD"
                                    {{ old('hard_drive', $computer->hard_drive) == '256 GB SSD' ? 'selected' : '' }}>
                                    256 GB SSD
                                </option>
                                <option value="500 GB SSD"
                                    {{ old('hard_drive', $computer->hard_drive) == '500 GB SSD' ? 'selected' : '' }}>
                                    500 GB SSD
                                </option>
                                <option value="1 TB SSD"
                                    {{ old('hard_drive', $computer->hard_drive) == '1 TB SSD"' ? 'selected' : '' }}>
                                    1 TB SSD"
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
                            <label>*Procesador:</label>
                            <select class="form-control" name="processor" required autofocus>
                                <option value="Intel(R) Core(TM) i7-8550 CPU @1.80GHz"
                                    {{ old('processor', $computer->processor) == 'Intel(R) Core(TM) i7-8550 CPU' ? 'selected' : '' }}>
                                    Intel(R) Core(TM) i7-8550 CPU @1.80GHz
                                </option>
                                <option value="Intel(R) Core(TM) i7-8550 CPU @1.80GHz"
                                    {{ old('processor,', $computer->processor) == 'Intel(R) Core(TM) i7-8550 CPU @1.80GHz' ? 'selected' : '' }}>
                                    Intel(R) Core(TM) i7-8550 CPU @1.80GHz
                                </option>
                                <option value="Intel(R) Core(TM) i7-7600U CPU @1.80GHz"
                                    {{ old('processor,', $computer->processor) == 'Intel(R) Core(TM) i7-7600U CPU @1.80GHz' ? 'selected' : '' }}>
                                    Intel(R) Core(TM) i7-7600U CPU @1.80GHz
                                </option>
                                <option value="Intel(R) Core(TM) i7-6500U CPU @1.80GHz"
                                    {{ old('processor,', $computer->processor) == 'Intel(R) Core(TM) i7-6500U CPU @1.80GHz' ? 'selected' : '' }}>
                                    Intel(R) Core(TM) i7-6500U CPU @1.80GHz
                                </option>
                                <option value="Intel(R) Core(TM) i7-5600U CPU @1.80GHz"
                                    {{ old('processor,', $computer->processor) == 'Intel(R) Core(TM) i7-5600U CPU @1.80GHz' ? 'selected' : '' }}>
                                    Intel(R) Core(TM) i7-5600U CPU @1.80GHz
                                </option>
                                <option value="Intel(R) Core(TM) i5-8250U CPU @1.80GHz"
                                    {{ old('processor,', $computer->processor) == 'Intel(R) Core(TM) i5-8250U CPU @1.80GHz' ? 'selected' : '' }}>
                                    Intel(R) Core(TM) i5-8250U CPU @1.80GHz
                                </option>
                                <option value="Intel(R) Core(TM) i5-7200U CPU @1.80GHz"
                                    {{ old('processor,', $computer->processor) == 'Intel(R) Core(TM) i5-7200U CPU @1.80GHz' ? 'selected' : '' }}>
                                    Intel(R) Core(TM) i5-7200U CPU @1.80GHz
                                </option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label>*Memoria Ram:</label>
                            <select class="form-control" name="memory_ram" required autofocus>
                                <option value="">Escoger...</option>
                                <option value="16 GB DDR 4"
                                    {{ old('memory_ram', $computer->memory_ram) == '16 GB DDR 4' ? 'selected' : '' }}>
                                    16 GB DDR 4
                                </option>
                                <option value="8 GB DDR 4"
                                    {{ old('memory_ram', $computer->memory_ram) == '8 GB DDR 4' ? 'selected' : '' }}>
                                    8 GB DDR 4
                                </option>
                                <option value="4 GB DDR 4"
                                    {{ old('memory_ram', $computer->memory_ram) == '4 GB DDR 4' ? 'selected' : '' }}>
                                    4 GB DDR 4
                                </option>
                                <option value="8 GB DDR 3"
                                    {{ old('memory_ram', $computer->memory_ram) == '8 GB DDR 3' ? 'selected' : '' }}>
                                    8 GB DDR 3
                                </option>
                                <option value="4 GB DDR 3"
                                    {{ old('memory_ram', $computer->memory_ram) == '4 GB DDR 3' ? 'selected' : '' }}>
                                    4 GB DDR 3
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
                            <label>*Módelo del Cargador:</label>
                            <input type="text" class="form-control" name="charger_model" maxlength="64"
                                value="{{ $computer->charger_model }}" placeholder="Enter Code" required autofocus
                                onkeyup="javascript:this.value=this.value.toUpperCase();">
                        </div>
                        <div class="form-group col-md-4">
                            <label>*Serial del Cargador:</label>
                            <input type="text" class="form-control" name="charger_serial" maxlength="64"
                                value="{{ $computer->charger_serial }}" placeholder="Enter Serial" required autofocus
                                onkeyup="javascript:this.value=this.value.toUpperCase();">
                            <small class="form-text text-gray-600">
                                The Charger Serial field cannot be duplicated
                            </small>
                        </div>
                    </div>
                </div>
            </div>

            <p class="h4 mb-1 text-gray-800">Configuración Básica</p>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label><code>*Host Name:</code></label>
                            <input type="text" class="form-control" name="hostname" maxlength="64"
                                value="{{ $computer->hostname }}" placeholder="Enter Name" required autofocus
                                onkeyup="javascript:this.value=this.value.toUpperCase();">
                            <small class="form-text text-gray-600">
                                <code>The Host Name field cannot be duplicated</code>
                            </small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>*Work Group:</label>
                            <select class="form-control" name="workgroup" required autofocus>
                                <option value="">Escoger...</option>
                                <option value="UPL" {{ old('workgroup') == 'UPL' ? 'selected' : '' }}>
                                    UPL
                                </option>
                                <option value="WORKGROUP"
                                    {{ old('workgroup', $computer->workgroup) == 'WORKGROUP' ? 'selected' : '' }}>
                                    WORKGROUP
                                </option>
                                <option value="No Aplica"
                                    {{ old('workgroup', $computer->workgroup) == 'No Aplica' ? 'selected' : '' }}>
                                    No Aplica
                                </option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label>*Nombre de Dominio:</label>
                            <select class="form-control" name="domain_name" required autofocus>
                                <option value="">Escoger...</option>
                                <option value="Upl.com"
                                    {{ old('domain_name', $computer->domain_name) == 'Upl.com' ? 'selected' : '' }}>
                                    Upl.com
                                </option>
                                <option value="No Aplica"
                                    {{ old('domain_name', $computer->domain_name) == 'No Aplica' ? 'selected' : '' }}>
                                    No Aplica
                                </option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label>*Tipo de Licencia:</label>
                            <select class="form-control" name="license" required autofocus>
                                <option value="">Escoger...</option>
                                <option value="OEM" {{ old('license', $computer->license) == 'OEM' ? 'selected' : '' }}>
                                    OEM
                                </option>
                                <option value="Retail"
                                    {{ old('license', $computer->license) == 'Retail' ? 'selected' : '' }}>
                                    Retail
                                </option>
                                <option value="GVLK"
                                    {{ old('license', $computer->license) == 'GVLK' ? 'selected' : '' }}>
                                    GVLK
                                </option>
                            </select>
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
                                    <option value="" @if (old($computer->
                                        article->provider->id) == '{{ $computer->article->provider->id }}' )
                                        selected="selected" @endif>
                                        {{ $computer->article->provider->name }}
                                    </option>
                                    <option style="font-size: 2pt; background-color: #E9EFF7;" disabled>;</option>

                                    @foreach ($providers as $key => $value)
                                    <option value="{{ $key }}">{{ $value }} </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-md-4">
                                <h4>*Seleccione un Articulo:</h4>
                                <select class="form-control" name="article_id" id="article">
                                    <option value="{{ $computer->article_id }} " @if (old($computer->
                                        article_id) == '{{ $computer->article_id }}' )
                                        selected="selected" @endif>
                                        {{ $computer->article->invoice_number }}
                                    </option>
                                    <option style="font-size: 2pt; background-color: #E9EFF7;" disabled>&nbsp;</option>

                                </select>
                            </div>

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
                            <input type="text" class="form-control selectValidationNumber" name="license_plate" min="0"
                                maxlength="7" value="{{ $computer->license_plate }}" placeholder="Enter 000*" required
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

            <div class='alert alert-dark'>
                <div class="row">
                    <div class="col-md-12">
                        <h2>Estado!</h2>
                        <p>El estado Activo - Asignado solo podra ser aplicado en el Módulo de Asignaciones...
                        </p>
                        <div class="form-row">

                            <div class="form-group col-md-4">

                                <select class="form-control" name="status" v required>

                                    <option value="Inactivo - No Asignado"
                                        {{ old('status', $computer->status) == 'Inactivo - No Asignado' ? 'selected' : ''}}>
                                        Inactivo - No Asignado
                                    </option>

                                    <option value="Dañado - Reportado"
                                        {{ old('status', $computer->status) == 'Dañado - Reportado' ? 'selected' : ''}}>
                                        Dañado - Reportado
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-8">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>*Inicio de Garantía:</label>
                            {{ Form::date('warranty_start', date($computer->warranty_start), ['class' => 'form-control']) }}

                        </div>
                        <div class="form-group col-md-4">
                            <label>*Fin de Garantía:</label>
                            {{ Form::date('warranty_end', date($computer->warranty_end), ['class' => 'form-control']) }}
                        </div>
                    </div>
                </div>
            </div>

            <p class="h4 mb-1 text-gray-800">Comentarios</p>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-row">

                        <div class="alert alert-secondary form-group col-md-12">
                            <!-- timeline comments -->
                            <div class="container">
                                @foreach ($computer->comments as $comment)
                                <ul class="timeline">
                                    <li>
                                        <!-- begin timeline-time -->
                                        <div class="timeline-time">
                                            <span class="date">
                                                {{ $comment->created_at->diffForHumans() }}</span>
                                            <span class="time">{{ $computer->created_at->toDateTimeString() }}
                                            </span>
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
                                                <span class="userimage"><img src="{{ $comment->user->avatar }} "
                                                        alt=""></span>
                                                <span class="username"><a href="javascript:;">{{ $comment->user->name }}
                                                    </a>
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
                                                        <span
                                                            class="time">{{ $computer->created_at->toDateTimeString() }}
                                                        </span>

                                                    </span>
                                                </div>
                                                <div class="stats">
                                                    <span class="stats-total">
                                                        <i class="fas fa-bell"></i>
                                                    </span>
                                                    <i class="fas fa-laptop"></i>
                                                    <span class="stats-total">{{ $computer->license_plate }}
                                                    </span>
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
                        <!-- end comentarios -->
                    </div>
                </div>
            </div>

            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalEditComputer">
                Enviar
            </button>

            <!-- Modal modalEditComputer-->
            <div class="modal fade" id="modalEditComputer" tabindex="-1" role="dialog"
                aria-labelledby="modalEditComputer" aria-hidden="true">
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
                                                    ¿Actualizar Equipo de computo?
                                                </div>
                                                <div class="p mb-0 font-weight text-gray-800">
                                                    <p>Atención!
                                                        <br>
                                                        {{ Auth::user()->name }} <br>
                                                        ¿Desea actualizar la siguiente Equipo de computo?
                                                        <ul>
                                                            <li>
                                                                <div class="h6 mb-0 font-weight-bold text-gray-800">
                                                                    {{ $computer->license_plate }} -
                                                                    {{ $computer->hostname }}
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-laptop fa-2x text-gray-300"></i>
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
<script src="{{ asset('/core/js/select-brand-&-models-fix.js') }}"></script>
@endpush