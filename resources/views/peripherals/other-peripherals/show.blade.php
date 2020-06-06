@extends('layouts.dashboard') @section('title', 'information-&-technologies')
@section('content') @section('titlePosition', 'other-peripherals/show')

<section class="content">
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Descripción Perisférico {{ $otherPeripheral->brand }}
                {{ $otherPeripheral->model }} <br>
            </h1>
        </div>

        <div class="text-center">
            <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 20rem;"
                src="{{ asset('/core/undraw/other-peripherals.svg') }}">
        </div>

        <h1 class="h3 mb-0 text-gray-800"> <i class="fas fa-asterisk"></i> Check List</h1>
        <p>
            Perisférico de {{ $otherPeripheral->type_device }}
            <strong>{{ $otherPeripheral->type_other_peripherals }}</strong> Marca
            <strong>{{ $otherPeripheral->brand }}</strong> y Módelo
            <strong>{{ $otherPeripheral->model }}</strong>. <br>

            Registrado con el serial <strong>{{ $otherPeripheral->serial }}</strong>. <br>

        </p>

        <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-info-circle"></i> Información</h1>
        <p>
            <ul>
                <li> <i class="fas fa-barcode"></i>
                    <strong>Placa Corporativa:</strong>
                    {{ $otherPeripheral->license_plate }}
                </li>
                <li>
                    @if ($otherPeripheral->status === 'Activo - Asignado')
                    <h5><span class="badge badge-success">{{ $otherPeripheral->status }} </span></h5>

                    @elseif($otherPeripheral->status === 'Inactivo - No Asignado')
                    <h5><span class="badge badge-danger">{{ $otherPeripheral->status }} </span></h5>

                    @elseif($otherPeripheral->status === 'Dañado - Reportado')
                    <h5><span class="badge badge-dark">{{ $otherPeripheral->status }} </span></h5>
                    @endif
                </li>
                <li>
                    <strong>Garantia:</strong> desde el
                    <strong>
                        {{ Carbon\Carbon::parse($otherPeripheral->warranty_start)->format('l jS \\of F Y ') }}</strong>
                    hasta el
                    <strong>{{ Carbon\Carbon::parse($otherPeripheral->warranty_end)->format('l jS \\of F Y ') }}
                    </strong>
                </li>
            </ul>
        </p>

        <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-asterisk"></i> Detalle y Características</h1>
        <textarea id="observations" disabled>
            {{ $otherPeripheral->description_of_characteristics }}
        </textarea>
        <br>

        <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-file-invoice-dollar"></i> Provedor y Facturación</h1>

        <div class="card shadow mb-4">
            <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button"
                aria-expanded="true" aria-controls="collapseCardExample">
                <p class="text-dark">
                    Factura Digital <br>
                    El Perisférico a sido comprado desde el provedor
                    <strong>{{ $otherPeripheral->article->provider->name }}</strong>, con el número de factura
                    <strong>{{ $otherPeripheral->article->invoice_number }}</strong>, el día
                    {{ Carbon\Carbon::parse($otherPeripheral->article->invoice_date)->format('l jS \\of F Y ') }}</strong>
                </p>
            </a>
            <div class="collapse show" id="collapseCardExample">
                <div class="card-body">
                    <embed src="/storage/Invoices-articles-providers/{{ $otherPeripheral->article->digital_invoice }}"
                        style="width:942px; height:768px;" frameborder="0">
                </div>
            </div>
        </div>

        <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-history"></i> Historial y Trazabilidad</h1>
        <p> Acontinuación encontrara la trazabilidad del Perisférico desde el día
            <strong>{{ Carbon\Carbon::parse($otherPeripheral->created_at)->format('l jS \\of F Y ') }}</strong>, fecha
            en
            la cúal el equipo de computo se registro en el sistema.
        </p>
        <div class="row">
            <div class="col-md-12">
                <div class="form-row">

                    <div class="alert alert-secondary form-group col-md-12">
                        <!-- timeline comments -->
                        <div class="container">
                            @foreach ($otherPeripheral->comments as $comment)
                            <ul class="timeline">
                                <li>
                                    <!-- begin timeline-time -->
                                    <div class="timeline-time">
                                        <span class="date">
                                            {{ $comment->created_at->diffForHumans() }}</span>
                                        <span class="time">{{ $otherPeripheral->created_at->toDateTimeString() }}
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
                                                <span class="stats-text">{{ $otherPeripheral->id }}</span>
                                                <span class="stats-text">Ultima Actualización
                                                    <span
                                                        class="time">{{ $otherPeripheral->created_at->toDateTimeString() }}
                                                    </span>

                                                </span>
                                            </div>
                                            <div class="stats">
                                                <span class="stats-total">
                                                    <i class="fas fa-bell"></i>
                                                </span>
                                                <i class="fas fa-laptop"></i>
                                                <span class="stats-total">{{ $otherPeripheral->license_plate }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end timeline-body -->
                                </li>
                            </ul>
                            @endforeach

                        </div>
                        <!-- end timeline -->
                    </div>
                    <!-- end comentarios -->
                </div>
            </div>
        </div>

    </div>
</section>
@endsection
@push('scripts')
<script src="{{ asset('/core/plugins/ckeditor/ckeditor.js') }}"></script>
<script>
    // CkEditor
    CKEDITOR.config.heigth = 400;
    CKEDITOR.config.width = 'auto';
    CKEDITOR.replace('observations');
</script>
@endpush