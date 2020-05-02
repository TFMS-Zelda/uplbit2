@extends('layouts.dashboard')

@section('title', 'information-&-technologies')
@section('content')

@section('titlePosition', 'computers/create')

<section class="content">
    <div class="container-fluid">
        <h1 class="h3 mb-1 text-gray-800">Editar * Perisferico: {{ $otherPeripheral->type_other_peripherals }} </h1>

        <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Placa
                                    Corporativa</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ $otherPeripheral->license_plate }}
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
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Serial
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ $otherPeripheral->serial }}
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
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Estado
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ $otherPeripheral->status }}
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
                src="{{ asset('/core/undraw/monitor.svg') }}">
        </div>
        <!-- import partials.errors-validation -->
        @include('partials.errors-validation')
        <!-- close import -->
        <form action="{{ route('peripherals.other-peripherals.update', $otherPeripheral->id) }}" method="POST">
            @csrf
            @method('PUT')

            <p class="h4 mb-1 text-gray-800">Peripherals Resume</p>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>*Perisferico:</label>
                            <select class="form-control BrandSelectClass" name="type_device" id="brandSelectId"
                                onchange="cargarModelos()" required>
                                <option value="{{ $otherPeripheral->brand }}" @if (old($otherPeripheral->
                                    brand)=='{{ $otherPeripheral->brand }}') selected="selected" @endif>
                                    {{ $otherPeripheral->brand }}
                                </option>

                                <option style="font-size: 2pt; background-color: #E9EFF7;" disabled>&nbsp;</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>*Tipo de Perisferico:</label>
                            <select class="form-control" name="type_other_peripherals" id="modelSelectId" required>
                                <option value="{{ $otherPeripheral->model }}" @if (old($otherPeripheral->
                                    model)=='{{ $otherPeripheral->model }}' )
                                    selected="selected" @endif>
                                    {{ $otherPeripheral->model }}
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
                            <label>*Marca:</label>
                            <input type="text" class="form-control" maxlength="128" name="brand"
                                placeholder="Enter Brand" value="{{ $otherPeripheral->brand }}" required />
                        </div>
                        <div class="form-group col-md-4">
                            <label>*Modelo:</label>
                            <input type="text" class="form-control" maxlength="128" name="model"
                                placeholder="Enter Model" value="{{ $otherPeripheral->model }}" required />
                        </div>
                        <div class="form-group col-md-4">
                            <label>*Serial:</label>
                            <input type="text" class="form-control" maxlength="128" name="serial"
                                placeholder="Enter Serial" value="{{ $otherPeripheral->serial }}" required />
                            <small class="form-text text-gray-600">
                                The Serial field cannot be duplicated
                            </small>
                        </div>
                    </div>
                </div>
            </div>

            <p class="h4 mb-1 text-gray-800">Información Corporativa</p>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label><code>*Placa Corporativa:</code></label>
                            <input type="text" class="form-control" maxlength="7" name="license_plate"
                                placeholder="Enter 000*" value="{{ $otherPeripheral->license_plate }}" required />
                            <small class="form-text text-gray-600">
                                <code>The Placa field cannot be duplicated</code>
                            </small>
                        </div>

                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>*Localización:</label>
                            <select class="form-control" name="location" required>
                                <option value="">Escoger...</option>
                                <option value="UPL Oficina - Bogota"
                                    {{ old('location', $otherPeripheral->location) == 'UPL Oficina - Bogota' ? 'selected' : ''}}>
                                    UPL Oficina - Bogota</option>
                                <option value="UPL Oficina - Planta Madrid"
                                    {{ old('location', $otherPeripheral->location) == 'UPL Oficina - Planta Madrid' ? 'selected' : ''}}>
                                    UPL Oficina - Planta Madrid</option>
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label>*Estado del Monitor:</label>
                            <select class="form-control" name="status" v required>
                                <option value="Activo - Asignado"
                                    {{ old('status', $otherPeripheral->status) == 'Activo - Asignado' ? 'selected' : ''}}>
                                    Activo - Asignado
                                </option>

                                <option value="Inactivo - No Asignado"
                                    {{ old('status', $otherPeripheral->status) == 'Inactivo - No Asignado' ? 'selected' : ''}}>
                                    Inactivo - No Asignado
                                </option>

                                <option value="En Mantenimiento"
                                    {{ old('status', $otherPeripheral->status) == 'En Mantenimiento' ? 'selected' : ''}}>
                                    En Mantenimiento
                                </option>

                                <option value="Dañado"
                                    {{ old('status', $otherPeripheral->status) == 'Dañado' ? 'selected' : ''}}>
                                    Dañado
                                </option>

                                <option value="Retirado - Baja de Activo"
                                    {{ old('status', $otherPeripheral->status) == 'Retirado - Baja de Activo' ? 'selected' : ''}}>
                                    Retirado - Baja de Activo
                                </option>

                            </select>
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
                                    <option value="" @if (old($otherPeripheral->
                                        article->provider->id) == '{{ $otherPeripheral->article->provider->id }}' )
                                        selected="selected" @endif>
                                        {{ $otherPeripheral->article->provider->name }}
                                    </option>
                                    <option style="font-size: 2pt; background-color: #E9EFF7;" disabled>&nbsp;</option>

                                    @foreach ($providers as $key => $value)
                                    <option value="{{ $key }}">{{ $value }} </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-md-4">
                                <h4>*Seleccione un Articulo:</h4>
                                <select class="form-control" name="article_id" id="article">
                                    <option value="{{ $otherPeripheral->article_id }} " @if (old($otherPeripheral->
                                        article_id) == '{{ $otherPeripheral->article_id }}' )
                                        selected="selected" @endif>
                                        {{ $otherPeripheral->article->invoice_number }}
                                    </option>
                                    <option style="font-size: 2pt; background-color: #E9EFF7;" disabled>&nbsp;</option>
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
                            {{ Form::date('warranty_start', date($otherPeripheral->warranty_start), ['class' => 'form-control']) }}

                        </div>
                        <div class="form-group col-md-4">
                            <label>*Fin de Garantía:</label>
                            {{ Form::date('warranty_end', date($otherPeripheral->warranty_end), ['class' => 'form-control']) }}
                        </div>
                    </div>
                </div>
            </div>

            <p class="h4 mb-1 text-gray-800">Descripción & características</p>
            <small>Detalle acontinuación la descripcion del perisferico adquirido...</small>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <textarea class="form-control" id="description" name="description_of_characteristics"
                                maxlength="1024" required
                                autofocus>{{ $otherPeripheral->description_of_characteristics }}</textarea>
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
                    @foreach ($otherPeripheral->comments as $comment)
                    <ul class="timeline">

                        <li>
                            <!-- begin timeline-time -->
                            <div class="timeline-time">
                                <span class="date">
                                    {{ $comment-> created_at -> diffForHumans()}}</span>
                                <span class="time">{{ $otherPeripheral-> created_at -> toDateTimeString()}} </span>
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
                                        <span class="stats-text">Ultima Actualizacion
                                            <span class="time">{{ $otherPeripheral-> created_at -> toDateTimeString()}}
                                            </span>

                                        </span>
                                    </div>
                                    <div class="stats">
                                        <span class="stats-total">
                                            <i class="fas fa-bell"></i>
                                        </span>
                                        <i class="fas fa-laptop"></i>
                                        <span class="stats-total">{{ $otherPeripheral->license_plate}} </span>
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

            <!-- Modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalEdit">
                Editar
            </button>

            <!-- Modal modalEdit-->
            <div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="modalEdit"
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
                                                    ¿Actualizar Perisferico?
                                                </div>
                                                <div class="p mb-0 font-weight text-gray-800">
                                                    <p>Atención!
                                                        <br>
                                                        {{ Auth::user()->name }} <br>
                                                        ¿Desea actualizar el siguiente Perisferico?
                                                        <ul>
                                                            <li>
                                                                <div class="h6 mb-0 font-weight-bold text-gray-800">
                                                                    <i class="fa fa-cog fa-spin" aria-hidden="true"></i>
                                                                    Placa: {{ $otherPeripheral->license_plate }}
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="h6 mb-0 font-weight-bold text-gray-800">
                                                                    <i class="fas fa-asterisk" aria-hidden="true"></i>
                                                                    Serial: {{ $otherPeripheral->serial }}
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-asterisk fa-2x text-gray-300"></i>
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
            <!-- Close Modal -->
            <a href="#" class="btn btn-danger">Cancelar</a>
        </form>
    </div>
</section>
@endsection
@push('scripts')
<!-- Custom scripts-->
<script src="{{ asset('/core/js/select-brand-&-model-otherPeripheral-fix.js') }}"></script>
<script src="{{ asset('/core/plugins/ckeditor/ckeditor.js') }}"></script>
<script>
    // CkEditor
    CKEDITOR.config.heigth = 400;
    CKEDITOR.config.width = 'auto';
    CKEDITOR.replace('description');
</script>
@endpush