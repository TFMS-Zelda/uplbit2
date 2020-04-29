@extends ('layouts.dashboard')

@section('title', 'information-&-technologies')
@section('content')

@section('titlePosition', 'maintenances.maintenance-of-other-peripherals/show')

<style>
    input[type="text"],
    input[type="email"],
    textarea {
        background - color: #E9EFF7;
    }
</style>
<section class="content">
    <div class="container-fluid">
        <section class="bg-success text-center text-white">
            <h2 class="p-3"> <i class="fas fa-wrench fa-spin"></i>
                <em>Reporte de Mantenimiento N° {{ $historyMaintenance->id }}</em>
            </h2>
        </section>

        <div class="text-center">
            <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 20rem;"
                src="{{ asset('/core/undraw/conference.svg') }}">
        </div>

        <section>
            <div class="container-fluid">
                <!-- Earnings (Monthly) Card Example -->
                <div class="col-12 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        {{ $historyMaintenance->maintenance_type }}
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        Realizado:
                                        {{ Carbon\Carbon::parse($historyMaintenance->created_at)->format('l jS \\of F Y ') }}
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-wrench fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card shadow mb-4">
                    <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button"
                        aria-expanded="true" aria-controls="collapseCardExample">
                        <h6 class="m-0 font-weight-bold text-primary">
                            Marca: {{ $historyMaintenance->otherPeripheral->brand }} <br>
                            Módelo: {{ $historyMaintenance->otherPeripheral->model }} <br>
                            Placa: {{ $historyMaintenance->otherPeripheral->license_plate }}

                        </h6>
                    </a>
                    <div class="collapse show" id="collapseCardExample">
                        <div class="card-body">
                            <i class="fas fa-user-secret"></i>

                            Mantenimiento realizado por: <strong>{{ $historyMaintenance->responsible_maintenance }}
                            </strong><br>
                            Mantenimiento reportado por: <strong>{{ $historyMaintenance->user->name }}</strong>
                            <br>
                            Log... Última fecha de actualización:

                            {{ Carbon\Carbon::parse($historyMaintenance->otherPeripheral->updated_at)->format('l jS \\of F Y ') }},
                            <strong>{{ $historyMaintenance->otherPeripheral->updated_at->diffForHumans() }}</strong>
                        </div>
                    </div>
                </div>

                @if($historyMaintenance->attachments != null)
                <div class="card shadow mb-4">
                    <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button"
                        aria-expanded="true" aria-controls="collapseCardExample">
                        <h6 class="m-0 font-weight-bold text-primary">
                            Reporte de garantia con Adjuntos,
                            Documento / Ruta Definida: <code>{{ $historyMaintenance->attachments }}</code>
                        </h6>

                    </a>
                    <div class="collapse show" id="collapseCardExample">
                        <div class="card-body">
                            <embed
                                src="/storage/Attachments-maintenances/Maintenance-computers/{{ $historyMaintenance->attachments }}"
                                style="width:942px; height:768px;" frameborder="0">
                        </div>
                    </div>
                </div>

                @else
                <div class="card shadow mb-4">
                    <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button"
                        aria-expanded="true" aria-controls="collapseCardExample">
                        <h6 class="m-0 font-weight-bold text-primary">Adjuntos & Reportes</h6>
                    </a>
                    <div class="collapse show" id="collapseCardExample">
                        <div class="card-body">
                            <div role="alert" class="alert alert-danger alert-dismissible">
                                <button aria-label="Close" data-dismiss="alert" class="close" type="button"><span
                                        aria-hidden="true">×</span></button>
                                <h2 class="alert-heading">Nota!</h2>
                                <p>
                                    El siguiente reporte de mantenimiento no contiene adjuntos.</p>
                                <hr>

                                <p>
                                    <h4>Attachments no found</h4>
                                    <img class="img-fluid" style="width: 50px;"
                                        src="{{ asset('/core/undraw/error-cloud.svg') }}"> <br>
                                </p>
                                <p>
                                    <strong>
                                        {{ $historyMaintenance->responsible_maintenance }},
                                        {{ $historyMaintenance->maintenance_type }}
                                    </strong>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                <p class="h4 mb-1 text-gray-800"><i class="fas fa-wrench"></i> </i>Descripción del Mantenimiento:</p>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <textarea class="form-control" maxlength="512" disabled
                                    id="maintenance_description">{{ $historyMaintenance->maintenance_description }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <p class="h4 mb-1 text-gray-800"> <i class="fas fa-user-secret"></i> </i>Observaciones:</p>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <textarea class="form-control" maxlength="512" disabled
                                    id="observations">{{ $historyMaintenance->observations }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <i class="fa fa-history" aria-hidden="true"></i>
                Mantenimiento reportado por: <strong>{{ $historyMaintenance->user->name}}</strong> <br>
                <i class="fa fa-clock" aria-hidden="true"></i>
                Mantenimiento reportado el dia: <code>
                    {{ Carbon\Carbon::parse($historyMaintenance->created_at)->format('l jS \\of F Y ') }}
                </code>
        </section>
    </div>
</section>

@endsection
@push('scripts')
<!-- Ckeditor plugin  -->
<script src="{{ asset('/core/plugins/ckeditor/ckeditor.js') }}"></script>

<script>
    // CkEditor
      CKEDITOR.config.heigth = 400;
      CKEDITOR.config.width = 'auto';
      CKEDITOR.replace('maintenance_description');
      CKEDITOR.replace('observations');

</script>
@endpush