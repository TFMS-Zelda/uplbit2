@extends ('layouts.dashboard')

@section('title', 'information-&-technologies')

@section('content')


@section('titlePosition', 'tablets/edit')

<section class="content">
    <div class="container-fluid">
        <h1 class="h3 mb-1 text-gray-800">Editar Tablet corporativa</h1>
        <p class="mb-4 text-justify">
            Complete el siguiente formulario, recuerde que los campos marcados con <strong>*</strong> son de caracter
            obligatorio.
        </p>

        <div class="text-center">
            <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 20rem;"
                src="{{ asset('/core/undraw/tablet.svg') }}">
        </div>

        <!-- import partials.errors-validation -->
        @include('partials.errors-validation')
        <!-- close import -->

        <!-- start form tablets.update -->
        <form action="{{ route('tablets.update', $tablet->id) }}" method="POST">
            @csrf
            @method('PUT')
            <p class="h4 mb-1 text-gray-800">Tablet Resume</p>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>*Marca:</label>
                            <select class="form-control" name="brand" required autofocus>
                                <option value="">Seleccione...</option>
                                <option value="Samsung"
                                    {{ old('brand', $tablet->brand) == 'Samsung' ? 'selected' : ''}}>
                                    Samsung
                                </option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label>*Módelo:</label>
                            <select class="form-control" name="model" required autofocus>
                                <option value="">Seleccione...</option>
                                <option value="Galaxy Tab A"
                                    {{ old('model', $tablet->model) == 'Galaxy Tab A' ? 'selected' : ''}}>
                                    Galaxy Tab A
                                </option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label>*Color:</label>
                            <select class="form-control" name="color" required>
                                <option value="">Seleccione...</option>
                                <option value="Negro" {{ old('color', $tablet->color) == 'Negro' ? 'selected' : ''}}>
                                    Negro
                                </option>
                                <option value="Blanco" {{ old('color', $tablet->color) == 'Blanco' ? 'selected' : ''}}>
                                    Blanco
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
                            <label><code>*Serial:</code></label>
                            <input type="text" class="form-control" name="serial" maxlength="128"
                                value="{{ $tablet->serial }}" placeholder="Enter Serial" required autofocus
                                onkeyup="javascript:this.value=this.value.toUpperCase();">
                            <small>
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
                            <label>*Pantalla & Screen Format:</label>
                            <select class="form-control" name="screen" required autofocus>
                                <option value=''>Seleccione...</option>
                                <option value="255.4 mm (10.1”) WUXG (1920x1200) TFT LCD"
                                    {{ old('screen', $tablet->screen) == '255.4 mm (10.1”) WUXG (1920x1200) TFT LCD' ? 'selected' : ''}}>
                                    255.4 mm (10.1”) WUXG (1920x1200) TFT LCD
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
                                <option value="">Seleccione...</option>
                                <option value="Qualcomm Snapdragon 450 Quad-Core 1.8 GHz"
                                    {{ old('processor', $tablet->processor) == 'Qualcomm Snapdragon 450 Quad-Core 1.8 GHz' ? 'selected' : ''}}>
                                    Qualcomm Snapdragon 450 Quad-Core 1.8 GHz
                                </option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label>*Memoria:</label>
                            <select class="form-control" name="memory" required>
                                <option value="">Seleccione...</option>
                                <option value="2 GB" {{ old('memory', $tablet->memory) == '2 GB' ? 'selected' : ''}}>
                                    2 GB
                                </option>
                                <option value="3 GB" {{ old('memory', $tablet->memory) == '3 GB' ? 'selected' : ''}}>
                                    3 GB
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
                            <label>*Cámara:</label>
                            <select class="form-control" name="camera" required autofocus>
                                <option value="">Seleccione...</option>
                                <option value="8.0 MP AF + Frontal de 2.0 MP"
                                    {{ old('camera', $tablet->camera) == '8.0 MP AF + Frontal de 2.0 MP' ? 'selected' : ''}}>
                                    8.0 MP AF + Frontal de 2.0 MP
                                </option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label>*Batería:</label>
                            <select class="form-control" name="battery" required>
                                <option value="">Seleccione...</option>
                                <option value="7.300 mAh"
                                    {{ old('battery', $tablet->battery) == '7.300 mAh' ? 'selected' : ''}}>
                                    7.300 mAh
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
                            <label>*Sistema Operativo:</label>
                            <select class="form-control" name="operating_system" required autofocus>
                                <option value="">Seleccione...</option>
                                <option value="Android 9 Pie"
                                    {{ old('operating_system', $tablet->operating_system) == 'Android 9 Pie' ? 'selected' : ''}}>
                                    Android 9 Pie
                                </option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label>*Lápiz Óptico:</label>
                            <select class="form-control" name="optical_pencil" required>
                                <option value="">Seleccione...</option>
                                <option value="Si"
                                    {{ old('optical_pencil', $tablet->optical_pencil) == 'Si' ? 'selected' : ''}}>
                                    Si
                                </option>
                                <option value="No"
                                    {{ old('optical_pencil', $tablet->optical_pencil) == 'No' ? 'selected' : ''}}>
                                    No
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
                            <label>*Módelo del cargador:</label>
                            <select class="form-control" name="charger_model" required autofocus>
                                <option value="">Seleccione...</option>
                                <option value="TA12WS"
                                    {{ old('charger_model', $tablet->charger_model) == 'TA12WS' ? 'selected' : ''}}>
                                    TA12WS
                                </option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label>*Serial del cargador:</label>
                            <input type="text" class="form-control" name="charger_serial" maxlength="128"
                                value="{{ $tablet->charger_serial }}" placeholder="Enter Serial" required autofocus
                                onkeyup="javascript:this.value=this.value.toUpperCase();">
                            <small>
                                <code> The Serial field cannot be duplicated</code>
                            </small>
                        </div>
                    </div>
                </div>
            </div>

            <p class="h4 mb-1 text-gray-800">Plan de Datos & Resume</p>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>*Plan de datos mensual:</label>
                            <select class="form-control" name="data_plan" required autofocus>
                                <option value="">Seleccione...</option>
                                <option value="1 GB Mensual"
                                    {{ old('data_plan', $tablet->data_plan) == '1 GB Mensual' ? 'selected' : ''}}>
                                    1 GB Mensual
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
                            <label>*<i class="fa fa-microchip" aria-hidden="true"></i> Sim Card:
                            </label>
                            <input type="text" class="form-control" name="sim_card" maxlength="128"
                                value="{{ $tablet->sim_card }}" placeholder="Enter Code" required autofocus>
                            <small>
                                <code> The Code Chip field cannot be duplicated</code>
                            </small>
                        </div>
                        <div class="form-group col-md-4">
                            <label>*Pin de Bloqueo:</label>
                            <input type="text" class="form-control selectValidationNumber" name="pin" minlength="4"
                                maxlength="4" value="{{ $tablet->pin }}" placeholder="Enter Pin" required autofocus>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label><code>*Imei:</code></label>
                            <input type="text" class="form-control selectValidationNumber" name="imei" minlength="16"
                                maxlength="16" value="{{ $tablet->imei }}" placeholder="Enter Serial" required
                                autofocus>
                            <small>
                                <code> The Imei field cannot be duplicated</code>
                            </small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label><i class="fa fa-phone" aria-hidden="true"></i> *Número de Sim:</label>
                            <input type="text" class="form-control selectValidationNumber" name="phone_number"
                                minlength="10" maxlength="10" value="{{ $tablet->phone_number }}"
                                placeholder="Enter Number" required autofocus>
                            <small>
                                The Phone Number field cannot be duplicated
                            </small>
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
                                maxlength="7" value="{{ $tablet->license_plate }}" placeholder="Enter 000*" required
                                autofocus>
                            <small class="form-text text-gray-600">
                                <code>The License Plate field cannot be duplicated</code>
                            </small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>*Ubicación & Localización:</label>
                            <select class="form-control" name="location" required autofocus>
                                <option value="">Seleccione...</option>
                                <option value="Bogota"
                                    {{ old('location', $tablet->location) == 'Bogota' ? 'selected' : ''}}>
                                    Bogota
                                </option>
                                <option value="Cundinamarca"
                                    {{ old('location', $tablet->location) == 'Cundinamarca' ? 'selected' : ''}}>
                                    Cundinamarca
                                </option>
                                <option value="Antioquia"
                                    {{ old('location', $tablet->location) == 'Antioquia' ? 'selected' : ''}}>
                                    Antioquia
                                </option>
                                <option value="Meta"
                                    {{ old('location', $tablet->location) == 'Meta' ? 'selected' : ''}}>
                                    Meta
                                </option>
                                <option value="Valle"
                                    {{ old('location', $tablet->location) == 'Valle' ? 'selected' : ''}}>
                                    Valle
                                </option>
                                <option value="Caldas"
                                    {{ old('location', $tablet->location) == 'Caldas' ? 'selected' : ''}}>
                                    Caldas
                                </option>
                                <option value="Nariño"
                                    {{ old('location', $tablet->location) == 'Nariño' ? 'selected' : ''}}>
                                    Nariño
                                </option>
                                <option value="Casanare"
                                    {{ old('location', $tablet->location) == 'Casanare' ? 'selected' : ''}}>
                                    Casanare
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
                            <label>*Estado:</label>
                            <select class="form-control" name="status" v required>
                                <option value="Activo - Asignado"
                                    {{ old('status', $tablet->status) == 'Activo - Asignado' ? 'selected' : ''}}>
                                    Activo - Asignado
                                </option>

                                <option value="Inactivo - No Asignado"
                                    {{ old('status', $tablet->status) == 'Inactivo - No Asignado' ? 'selected' : ''}}>
                                    Inactivo - No Asignado
                                </option>

                                <option value="Dañado - Reportado"
                                    {{ old('status', $tablet->status) == 'Dañado - Reportado' ? 'selected' : ''}}>
                                    Dañado - Reportado
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
                            <input type="date" class="form-control" name="warranty_start"
                                value="{{ $tablet->warranty_start }}" required autofocus>
                        </div>
                        <div class="form-group col-md-4">
                            <label>*Fin de Garantía:</label>
                            <input type="date" class="form-control" name="warranty_end"
                                value="{{ $tablet->warranty_end }}" required autofocus>
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
                                    <option value="" @if (old($tablet->
                                        article->provider->id) == '{{ $tablet->article->provider->id }}' )
                                        selected="selected" @endif>
                                        {{ $tablet->article->provider->name }}
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
                                    <option value="{{ $tablet->article_id }} " @if (old($tablet->
                                        article_id) == '{{ $tablet->article_id }}' )
                                        selected="selected" @endif>
                                        {{ $tablet->article->invoice_number }}
                                    </option>
                                    <option style="font-size: 2pt; background-color: #E9EFF7;" disabled>&nbsp;</option>

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
                            <label>*Actualizado Por:</label>
                            <select class="form-control" name="user_id" required autofocus>
                                <option value="{{ auth()->user()->id }}">{{ auth()-> user() -> name}}-
                                    {{ auth()-> user() -> ugdn}}</option>
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
                        <div class="alert alert-secondary form-group col-md-12">
                            <!-- timeline comments -->
                            <div class="container">
                                @foreach ($tablet->comments as $comment)
                                <ul class="timeline">
                                    <li>
                                        <!-- begin timeline-time -->
                                        <div class="timeline-time">
                                            <span class="date">
                                                {{ $comment->created_at->diffForHumans() }}</span>
                                            <span class="time">{{ $tablet->created_at->toDateTimeString() }}
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
                                                    <span class="stats-text">Ultima Actualizacion hace:
                                                        <span class="time">{{ $tablet->updated_at->diffForHumans() }}
                                                        </span>

                                                    </span>
                                                </div>
                                                <div class="stats">
                                                    <span class="stats-total">
                                                        <i class="fas fa-bell"></i>
                                                    </span>
                                                    <i class="fas fa-tablet"></i>
                                                    <span class="stats-total">{{ $tablet->license_plate }}
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

            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalEditTablet">
                Editar
            </button>

            <!-- Modal  modalEditTablet-->
            <div aria-hidden="true" aria-labelledby="modalEditTablet" class="modal fade" id="modalEditTablet"
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
                                                    ¿Editar Tablet corporativa?
                                                </div>
                                                <div class="p mb-0 font-weight text-gray-800">
                                                    <p>
                                                        Atención!
                                                        <br>
                                                        {{ Auth::user()->name }}
                                                        <br>
                                                        ¿Desea editar la siguiente tablet corporativa?
                                                        <ul>
                                                            <li>{{ $tablet->brand }}</li>
                                                            <li>{{ $tablet->model }}</li>
                                                            <li>{{ $tablet->license_plate }}</li>
                                                        </ul>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-tablet fa-2x text-gray-300">
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
@endsection
@push('scripts')
<!-- Custom scripts-->
<script src="{{ asset('/core/js/selectValidationNumber.js') }}"></script>
@endpush