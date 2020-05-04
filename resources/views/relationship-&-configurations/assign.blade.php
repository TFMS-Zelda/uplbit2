@extends('layouts.dashboard')

@section('title', 'relationship-&-configurations/assign')

@section('content')
@section('titlePosition', 'relationship-&-configurations/assign')


<section class="content">
    <div class="container-fluid">
        @php
        $id_user = $idSessionUser;
        $id_employee = $employee->id;
        @endphp
        <div class="card shadow mb-4">
            <!-- Card Header - Accordion -->
            <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button"
                aria-expanded="true" aria-controls="collapseCardExample">
                <h6 class="m-0 font-weight-bold text-primary">Asignación</h6>
            </a>
            <!-- Card Content - Collapse -->
            <div class="collapse show" id="collapseCardExample">
                <div class="card-body">
                    ¿Que Cí desea Asignar?
                    <br />
                    <assign-computer :id_user="{{ json_encode($id_user) }}"
                        :id_employee="{{ json_encode($id_employee) }}" />
                </div>
            </div>
        </div>

</section>
@endsection