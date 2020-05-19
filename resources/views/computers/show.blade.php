@extends('layouts.dashboard') @section('title', 'successrmation-&-technologies')
@section('content') @section('titlePosition', 'computers/show')

<section class="content">
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Descripción Equipo de computo {{ $computer->brand }}
                {{ $computer->model }} <br>
            </h1>
        </div>

        <div class="text-center">
            <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 20rem;"
                src="{{ asset('/core/undraw/computer.svg') }}">
        </div>

        <div class="card shadow mb-4">
            <!-- Card Header - Accordion -->
            <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button"
                aria-expanded="true" aria-controls="collapseCardExample">
                <h6 class="m-0 font-weight-bold text-primary">Check List</h6>
            </a>
            <!-- Card Content - Collapse -->
            <div class="collapse show" id="collapseCardExample">
                <div class="card-body">
                    <p>
                        Equipo de computo de Marca: <strong>{{ $computer->model }}</strong> y Módelo
                        <strong>{{ $computer->model }}</strong>. <br>

                        Registrado con el ServiceTag: <strong>{{ $computer->servicetag }}</strong> y Codigo Express
                        <strong>{{ $computer->servicecode }}</strong> <br>

                        Posee un sistema operativo <strong>{{ $computer->operating_system }}</strong>, con una capacidad
                        de
                        <strong>{{ $computer->hard_drive }}</strong> de almacenamiento interno. <br>

                        Tiene un Procesador <strong>{{ $computer->processor }}</strong> y una Memoria Ram de
                        <strong>{{ $computer->memory_ram }}</strong>
                    </p>
                </div>
            </div>
        </div>


    </div>
</section>
@endsection