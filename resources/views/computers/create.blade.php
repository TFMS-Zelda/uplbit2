@extends ('layouts.dashboard')
@section('title', 'information-&-technologies')
@section('content')
@section('titlePosition', 'computers/create')
<link rel="stylesheet" href="{{ asset('/core/plugins/DataTables/datatables.css') }}">

<style>
    input[type="text"],
    input[type="email"],
    textarea {
        background - color: #E9EFF7;
    }
</style>

<section class="content">
    <div class="container-fluid">
        <h1 class="h3 mb-1 text-gray-800">Agregar Equipo de computo</h1>
        <p class="mb-4 text-justify">
            Complete el siguiente formulario, recuerde que los campos marcados con <strong>*</strong> son de caracter
            obligatorio.
        </p>

        <div class="text-center">
            <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 20rem;"
                src="{{ asset('/core/undraw/computer.svg') }}">
        </div>

        <!-- import partials.errors-validation -->
        @include('partials.errors-validation')
        <!-- close import -->

        <!-- start form companies.store -->
        <form action="{{ route('computers.store') }}" method="POST">
            @csrf
            <p class="h4 mb-1 text-gray-800">Computer Resume</p>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>*Tipo de Máquina:</label>
                            <select class="form-control" name="type_machine" required autofocus>
                                <option value="">Escoger...</option>
                                <option value="Laptop" {{ old('type_machine') == 'Laptop' ? 'selected' : ''}}>
                                    Laptop
                                </option>
                                <option value="Desktop" {{ old('type_machine') == 'Desktop' ? 'selected' : ''}}>
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
                        <div class="form-group col-md-4">
                            <label><code>*ServiceTag</code>:</label>
                            <input type="text" class="form-control" name="servicetag" maxlength="64"
                                value="{{ old('servicetag') }}" placeholder="Enter Code" required autofocus
                                onkeyup="javascript:this.value=this.value.toUpperCase();">
                            <small class="form-text text-gray-600">
                                <code>The Service Tag field cannot be duplicated</code>
                            </small>
                        </div>
                        <div class="form-group col-md-4">
                            <label>*ServiceCode:</label>
                            <input type="text" class="form-control" name="servicecode" maxlength="64"
                                value="{{ old('servicetag') }}" placeholder="Enter Code" required autofocus
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
                                <option value="">Escoger...</option>
                                <option value="Windows 10 Pro 64 Bits"
                                    {{ old('operating_system') == 'Windows 10 Pro 64 Bits' ? 'selected' : ''}}>
                                    Windows 10 Pro 64 Bits
                                </option>
                                <option value="Windows 8 Pro 64 Bits"
                                    {{ old('operating_system') == 'Windows 8 Pro 64 Bits' ? 'selected' : ''}}>
                                    Windows 8 Pro 64 Bits
                                </option>
                                <option value="Windows 7 Pro 64 Bits"
                                    {{ old('operating_system') == 'Windows 7 Pro 64 Bits' ? 'selected' : ''}}>
                                    Windows 7 Pro 64 Bits
                                </option>
                            </select>
                        </div>

                        <div class="form-group col-md-4">
                            <label>*Disco Duro:</label>
                            <select class="form-control" name="hard_drive" required autofocus>
                                <option value="">Escoger...</option>
                                <option value="500 GB Mecanico"
                                    {{ old('hard_drive') == '500 GB Mecanico' ? 'selected' : ''}}>
                                    500 GB Mecanico
                                </option>
                                <option value="1 TB Mecanico"
                                    {{ old('hard_drive') == '1 TB Mecanico' ? 'selected' : ''}}>
                                    1 TB Mecanico
                                </option>
                                <option value="256 GB SSD" {{ old('hard_drive') == '256 GB SSD' ? 'selected' : ''}}>
                                    256 GB SSD
                                </option>
                                <option value="500 GB SSD" {{ old('hard_drive') == '500 GB SSD' ? 'selected' : ''}}>
                                    500 GB SSD
                                </option>
                                <option value="1 TB SSD" {{ old('hard_drive') == '1 TB SSD' ? 'selected' : ''}}>
                                    1 TB SSD
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
                                <option value="">Escoger...</option>

                                <option value="Intel(R) Core(TM) i7-8550 CPU @1.80GHz"
                                    {{ old('processor') == 'Intel(R) Core(TM) i7-8550 CPU @1.80GHz' ? 'selected' : ''}}>
                                    Intel(R) Core(TM) i7-8550 CPU @1.80GHz
                                </option>
                                <option value="Intel(R) Core(TM) i7-7600U CPU @1.80GHz"
                                    {{ old('processor') == 'Intel(R) Core(TM) i7-7600U CPU @1.80GHz' ? 'selected' : ''}}>
                                    Intel(R) Core(TM) i7-7600U CPU @1.80GHz
                                </option>
                                <option value="Intel(R) Core(TM) i7-6500U CPU @1.80GHz"
                                    {{ old('processor') == 'Intel(R) Core(TM) i7-6500U CPU @1.80GHz' ? 'selected' : ''}}>
                                    Intel(R) Core(TM) i7-6500U CPU @1.80GHz
                                </option>
                                <option value="Intel(R) Core(TM) i7-5600U CPU @1.80GHz"
                                    {{ old('processor') == 'Intel(R) Core(TM) i7-5600U CPU @1.80GHz' ? 'selected' : ''}}>
                                    Intel(R) Core(TM) i7-5600U CPU @1.80GHz
                                </option>
                                <option value="Intel(R) Core(TM) i5-8250U CPU @1.80GHz"
                                    {{ old('processor') == 'Intel(R) Core(TM) i5-8250U CPU @1.80GHz' ? 'selected' : ''}}>
                                    Intel(R) Core(TM) i5-8250U CPU @1.80GHz
                                </option>
                                <option value="Intel(R) Core(TM) i5-7200U CPU @1.80GHz"
                                    {{ old('processor') == 'Intel(R) Core(TM) i5-7200U CPU @1.80GHz' ? 'selected' : ''}}>
                                    Intel(R) Core(TM) i5-7200U CPU @1.80GHz
                                </option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label>*Memoria Ram:</label>
                            <select class="form-control" name="memory_ram" required autofocus>
                                <option value="">Escoger...</option>
                                <option value="16 GB DDR 4" {{ old('memory_ram') == '16 GB DDR 4' ? 'selected' : ''}}>
                                    16 GB DDR 4
                                </option>
                                <option value="8 GB DDR 4" {{ old('memory_ram') == '8 GB DDR 4' ? 'selected' : ''}}>
                                    8 GB DDR 4
                                </option>
                                <option value="4 GB DDR 4" {{ old('memory_ram') == '4 GB DDR 4' ? 'selected' : ''}}>
                                    4 GB DDR 4
                                </option>
                                <option value="8 GB DDR 3" {{ old('memory_ram') == '8 GB DDR 3' ? 'selected' : ''}}>
                                    8 GB DDR 3
                                </option>
                                <option value="4 GB DDR 3" {{ old('memory_ram') == '4 GB DDR 3' ? 'selected' : ''}}>
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
                                value="{{ old('charger_model') }}" placeholder="Enter Code" required autofocus
                                onkeyup="javascript:this.value=this.value.toUpperCase();">
                        </div>
                        <div class="form-group col-md-4">
                            <label>*Serial del Cargador:</label>
                            <input type="text" class="form-control" name="charger_serial" maxlength="64"
                                value="{{ old('charger_serial') }}" placeholder="Enter Serial" required autofocus
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
                                value="{{ old('hostname') }}" placeholder="Enter Name" required autofocus
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
                                <option value="UPL" {{ old('workgroup') == 'UPL' ? 'selected' : ''}}>
                                    UPL
                                </option>
                                <option value="WORKGROUP" {{ old('workgroup') == 'WORKGROUP' ? 'selected' : ''}}>
                                    WORKGROUP
                                </option>
                                <option value="No Aplica" {{ old('workgroup') == 'No Aplica' ? 'selected' : ''}}>
                                    No Aplica
                                </option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label>*Nombre de Dominio:</label>
                            <select class="form-control" name="domain_name" required autofocus>
                                <option value="">Escoger...</option>
                                <option value="Upl.com" {{ old('domain_name') == 'Upl.com' ? 'selected' : ''}}>
                                    Upl.com
                                </option>
                                <option value="No Aplica" {{ old('domain_name') == 'No Aplica' ? 'selected' : ''}}>
                                    No Aplica
                                </option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label>*Tipo de Licencia:</label>
                            <select class="form-control" name="license" required autofocus>
                                <option value="">Escoger...</option>
                                <option value="OEM" {{ old('license') == 'OEM' ? 'selected' : ''}}>
                                    OEM
                                </option>
                                <option value="Retail" {{ old('license') == 'Retail' ? 'selected' : ''}}>
                                    Retail
                                </option>
                                <option value="GVLK" {{ old('license') == 'GVLK' ? 'selected' : ''}}>
                                    GVLK
                                </option>
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
                            <input type="text" class="form-control selectValidationNumber" name="license_plate" min="0"
                                maxlength="7" value="{{ old('license_plate') }}" placeholder="Enter 000*" required
                                autofocus>
                            <small class="form-text text-gray-600">
                                The License Plate field cannot be duplicated
                            </small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="alert alert-primary">
                <p class="h4 mb-1 text-gray-800">Provider & Article Relation</p>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="provider">*Seleccione un Provedor:</label>
                                <select class="form-control" name="provider" id="provider">
                                    <option value="">Select Provider</option>
                                    @foreach ($providers as $key => $value)
                                    <option value="{{ $key }}">{{ $value }} </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="provider">*Seleccione un Articulo:</label>
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
                        <div class="form-group col-md-4">
                            <label>*Agregado Por:</label>
                            <select class="form-control" name="user_id" required autofocus>
                                <option value="{{ auth()->user()->id }}">{{ auth()-> user() -> name}}</option>
                            </select>
                            <small class="form-text text-gray-600">
                                El usuario es detectado automáticamente por el sistema
                            </small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>*Estado del Monitor:</label>
                            <select class="form-control" name="status" required>
                                <option value="Inactivo - No Asignado"
                                    {{ old('status') == 'Inactivo - No Asignado' ? 'selected' : ''}}>Inactivo - No
                                    Asignado
                                </option>
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

            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCreateCompañy">
                Enviar
            </button>

            <!-- Modal  modalCreateCompañy-->
            <div aria-hidden="true" aria-labelledby="modalCreateCompañy" class="modal fade" id="modalCreateCompañy"
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
                                                    ¿Agregar equipo de computo?
                                                </div>
                                                <div class="p mb-0 font-weight text-gray-800">
                                                    <p>
                                                        Atención!
                                                        <br>
                                                        {{ Auth::user()->name }}
                                                        <br>
                                                        ¿Desea registrar el siguiente equipo de computo?
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-laptop fa-2x text-gray-300">
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
<script src="{{ asset('/core/js/select-brand-&-models-fix.js') }}"></script>
@endpush