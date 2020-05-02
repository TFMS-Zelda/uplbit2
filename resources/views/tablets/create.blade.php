@extends ('layouts.dashboard')

@section('title', 'information-&-technologies')

@section('content')
@section('titlePosition', 'tablets/create')

<section class="content">
    <div class="container-fluid">
        <h1 class="h3 mb-1 text-gray-800">Agregar Tablet coorporativa</h1>
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

        <!-- start form companies.store -->
        <form action="{{ route('tablets.store') }}" method="POST">
            @csrf
            <p class="h4 mb-1 text-gray-800">Tablet Resume</p>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>*Marca:</label>
                            <select class="form-control" name="brand" required autofocus>
                                <option value="">Seleccione...</option>
                                <option value="Samsung" {{ old('brand') == 'Samsung' ? 'selected' : ''}}>
                                    Samsung
                                </option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label>*Módelo:</label>
                            <select class="form-control" name="model" required autofocus>
                                <option value="">Seleccione...</option>
                                <option value="Galaxy Tab A" {{ old('model') == 'Galaxy Tab A' ? 'selected' : ''}}>
                                    Galaxy Tab A
                                </option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label>*Color:</label>
                            <select class="form-control" name="color" required>
                                <option value="">Seleccione...</option>
                                <option value="Negro" {{ old('color') == 'Negro' ? 'selected' : ''}}>
                                    Negro
                                </option>
                                <option value="Blanco" {{ old('color') == 'Blanco' ? 'selected' : ''}}>
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
                                value="{{ old('serial') }}" placeholder="Enter Serial" required autofocus
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
                                    {{ old('screen') == '255.4 mm (10.1”) WUXG (1920x1200) TFT LCD' ? 'selected' : ''}}>
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
                                    {{ old('processor') == 'Qualcomm Snapdragon 450 Quad-Core 1.8 GHz' ? 'selected' : ''}}>
                                    Qualcomm Snapdragon 450 Quad-Core 1.8 GHz
                                </option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label>*Memoria:</label>
                            <select class="form-control" name="memory" required>
                                <option value="">Seleccione...</option>
                                <option value="2 GB" {{ old('memory') == '2 GB' ? 'selected' : ''}}>
                                    2 GB
                                </option>
                                <option value="3 GB" {{ old('memory') == '3 GB' ? 'selected' : ''}}>
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
                                    {{ old('camera') == '8.0 MP AF + Frontal de 2.0 MP' ? 'selected' : ''}}>
                                    8.0 MP AF + Frontal de 2.0 MP
                                </option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label>*Batería:</label>
                            <select class="form-control" name="battery" required>
                                <option value="">Seleccione...</option>
                                <option value="7.300 mAh" {{ old('battery') == '7.300 mAh' ? 'selected' : ''}}>
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
                                    {{ old('operating_system') == 'Android 9 Pie' ? 'selected' : ''}}>
                                    Android 9 Pie
                                </option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label>*Lápiz Óptico:</label>
                            <select class="form-control" name="optical_pencil" required>
                                <option value="">Seleccione...</option>
                                <option value="Si" {{ old('optical_pencil') == 'Si' ? 'selected' : ''}}>
                                    Si
                                </option>
                                <option value="No" {{ old('optical_pencil') == 'No' ? 'selected' : ''}}>
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
                                <option value="TA12WS" {{ old('charger_model') == 'TA12WS' ? 'selected' : ''}}>
                                    TA12WS
                                </option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label>*Serial del cargador:</label>
                            <input type="text" class="form-control" name="charger_serial" maxlength="128"
                                value="{{ old('charger_serial') }}" placeholder="Enter Serial" required autofocus
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
                                <option value="1 GB Mensual" {{ old('data_plan') == '1 GB Mensual' ? 'selected' : ''}}>
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
                                value="{{ old('sim_card') }}" placeholder="Enter Code" required autofocus>
                            <small>
                                <code> The Code Chip field cannot be duplicated</code>
                            </small>
                        </div>
                        <div class="form-group col-md-4">
                            <label>*Pin de Bloqueo:</label>
                            <input type="text" class="form-control selectValidationNumber" name="pin" minlength="4"
                                maxlength="4" value="{{ old('pin') }}" placeholder="Enter Pin" required autofocus>
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
                                maxlength="16" value="{{ old('imei') }}" placeholder="Enter Serial" required autofocus>
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
                                minlength="10" maxlength="10" value="{{ old('phone_number') }}"
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
                                maxlength="7" value="{{ old('license_plate') }}" placeholder="Enter 000*" required
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
                                <option value="Bogota" {{ old('location') == 'Bogota' ? 'selected' : ''}}>
                                    Bogota
                                </option>
                                <option value="Cundinamarca" {{ old('location') == 'Cundinamarca' ? 'selected' : ''}}>
                                    Cundinamarca
                                </option>
                                <option value="Antioquia" {{ old('location') == 'Antioquia' ? 'selected' : ''}}>
                                    Antioquia
                                </option>
                                <option value="Meta" {{ old('location') == 'Meta' ? 'selected' : ''}}>
                                    Meta
                                </option>
                                <option value="Valle" {{ old('location') == 'Valle' ? 'selected' : ''}}>
                                    Valle
                                </option>
                                <option value="Caldas" {{ old('location') == 'Caldas' ? 'selected' : ''}}>
                                    Caldas
                                </option>
                                <option value="Nariño" {{ old('location') == 'Nariño' ? 'selected' : ''}}>
                                    Nariño
                                </option>
                                <option value="Casanare" {{ old('location') == 'Casanare' ? 'selected' : ''}}>
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
                            <select class="form-control" name="status" required autofocus>
                                <option value="Inactivo - No Asignado"
                                    {{ old('status') == 'Inactivo - No Asignado' ? 'selected' : ''}}>
                                    Inactivo - No Asignado
                                </option>

                            </select>
                            <small>
                                Este Estado es predefinido por el sistema
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
                            <input type="date" class="form-control" name="warranty_start"
                                value="{{ old('warranty_start') }}" required autofocus>
                        </div>
                        <div class="form-group col-md-4">
                            <label>*Fin de Garantía:</label>
                            <input type="date" class="form-control" name="warranty_end"
                                value="{{ old('warranty_end') }}" required autofocus>
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
                            <label>*Agregado Por:</label>
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
                        <div class="form-group col-md-12">
                            <textarea name="body" class="form-control" required autofocus>{{ old('body') }}</textarea>
                            <small class="form-text text-gray-600">
                                Ingrese algun comentario u observación
                            </small>
                        </div>
                    </div>
                </div>
            </div>

            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCreateTablet">
                Enviar
            </button>

            <!-- Modal  modalCreateTablet-->
            <div aria-hidden="true" aria-labelledby="modalCreateTablet" class="modal fade" id="modalCreateTablet"
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
                                                    ¿Agregar Tablet coorporativa?
                                                </div>
                                                <div class="p mb-0 font-weight text-gray-800">
                                                    <p>
                                                        Atención!
                                                        <br>
                                                        {{ Auth::user()->name }}
                                                        <br>
                                                        ¿Desea registrar la siguiente tablet corporativa?
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