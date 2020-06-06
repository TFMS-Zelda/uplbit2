@extends('layouts.dashboard') @section('title', 'information-&-technologies')
@section('content') @section('titlePosition', 'monitors/show')

<section class="content">
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Descripción Monitor {{ $monitor->brand }}
                {{ $monitor->model }} <br>
            </h1>
        </div>

        <div class="text-center">
            <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 20rem;"
                src="{{ asset('/core/undraw/monitor.svg') }}">
        </div>

        <h1 class="h3 mb-0 text-gray-800"> <i class="fas fa-tv"></i> Check List</h1>
        <p>
            Monitor Corporativo Marca <strong>{{ $monitor->brand }}</strong> y Módelo
            <strong>{{ $monitor->model }}</strong>. <br>

            Registrado con el serial: <strong>{{ $monitor->serial }}</strong>. <br>

            Tiene formato <strong>{{ $monitor->screen_format }}</strong>, con un tipo de pantalla
            <strong>{{ $monitor->backlight }}</strong> de entrada <strong>{{ $monitor->input_connector_type }}</strong>
            a una resolución máxima de <strong>{{ $monitor->maximum_resolution }}</strong>. <br>

            <i class="fas fa-battery-three-quarters"></i> Salida de corriente
            <strong>{{ $monitor->power_supply }}</strong> .
        </p>

        <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-info-circle"></i> Información</h1>
        <p>
            <ul>
                <li> <i class="fas fa-barcode"></i>
                    <strong>Placa Corporativa:</strong>
                    {{ $monitor->license_plate }}
                </li>
                <li>
                    @if ($monitor->status === 'Activo - Asignado')
                    <h5><span class="badge badge-success">{{ $monitor->status }} </->
                    </h5>

                    @elseif($monitor->status === 'Inactivo - No Asignado')
                    <h5><span class="badge badge-danger">{{ $monitor->status }} </span></h5>

                    @elseif($monitor->status === 'Dañado - Reportado')
                    <h5><span class="badge badge-dark">{{ $monitor->status }} </span></h5>
                    @endif
                </li>
                <li>
                    <strong>Garantia:</strong> desde el
                    <strong> {{ Carbon\Carbon::parse($monitor->warranty_start)->format('l jS \\of F Y ') }}</strong>
                    hasta el <strong>{{ Carbon\Carbon::parse($monitor->warranty_end)->format('l jS \\of F Y ') }}
                    </strong>
                </li>
                <li>
                    Se encuentra en la ciudad de <strong>{{ $monitor->location }}</strong>
                </li>
            </ul>
        </p>

        <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-file-invoice-dollar"></i> Provedor y Facturación</h1>
        <div class="card shadow mb-4">
            <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button"
                aria-expanded="true" aria-controls="collapseCardExample">
                <p class="text-dark">
                    Factura Digital <br>
                    La monitor Corporativo fue comprada desde el provedor
                    <strong>{{ $monitor->article->provider->name }}</strong>, con el número de factura
                    <strong>{{ $monitor->article->invoice_number }}</strong>, el día
                    {{ Carbon\Carbon::parse($monitor->article->invoice_date)->format('l jS \\of F Y ') }}</strong>
                </p>
            </a>
            <div class="collapse show" id="collapseCardExample">
                <div class="card-body">
                    <embed src="/storage/Invoices-articles-providers/{{ $monitor->article->digital_invoice }}"
                        style="width:942px; height:768px;" frameborder="0">
                </div>
            </div>
        </div>

        <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-history"></i> Historial y Trazabilidad</h1>
        <p> Acontinuación encontrara la trazabilidad del Monitor Corporativo desde el día
            <strong>{{ Carbon\Carbon::parse($monitor->created_at)->format('l jS \\of F Y ') }}</strong>, fecha en
            la cúal se registro en el sistema.
        </p>
        <div class="row">
            <div class="col-md-12">
                <div class="form-row">

                    <div class="alert alert-secondary form-group col-md-12">
                        <!-- timeline comments -->
                        <div class="container">
                            @foreach ($monitor->comments as $comment)
                            <ul class="timeline">
                                <li>
                                    <!-- begin timeline-time -->
                                    <div class="timeline-time">
                                        <span class="date">
                                            {{ $comment->created_at->diffForHumans() }}</span>
                                        <span class="time">{{ $monitor->created_at->toDateTimeString() }}
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
                                                <span class="stats-text">{{ $monitor->id }}</span>
                                                <span class="stats-text">Ultima Actualizacion
                                                    <span class="time">{{ $monitor->created_at->toDateTimeString() }}
                                                    </span>

                                                </span>
                                            </div>
                                            <div class="stats">
                                                <span class="stats-total">
                                                    <i class="fas fa-bell"></i>
                                                </span>
                                                <i class="fas fa-monitor"></i>
                                                <span class="stats-total">{{ $monitor->license_plate }}
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