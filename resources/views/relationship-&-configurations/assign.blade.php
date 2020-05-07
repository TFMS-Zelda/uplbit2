@extends('layouts.dashboard')

@section('title', 'relationship-&-configurations/assign')

@section('content')
@section('titlePosition', 'relationship-&-configurations/assign')


<section class="content">
    <div class="container-fluid">
        {{-- variabls de entorno para ser pasada por props a vuejs --}}
        @php
        $id_user = $idSessionUser;
        $id_employee = $employee->id;
        @endphp
        <div class="card shadow mb-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">User
                                        {{ $employee->id }} </div>
                                    <div class="h6 mb-0 font-weight-bold text-gray-800">
                                        <h4><i class="fas fa-user-circle"></i> {{ $employee->name }}</h4>
                                        <h4><i class="fas fa-envelope-open-text"></i> {{ $employee->email_corporate }}
                                        </h4>
                                        <h4> <i class='fas fa-fingerprint'></i> {{ $employee->ugdn }}</h4>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <img src='{{ Storage::url('Employees-avatar/'.$employee->profile_avatar )}}'
                                        style="width:150px; height: 150px; float:left; border-radius:50%; margin-right: 25px;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <p>
            Seleccione el tipo de ci que asignara al empleado {{ $employee->name }}.
        </p>
        <ul>
            <li>
                <assign-computer :id_user="{{ json_encode($id_user) }}"
                    :id_employee="{{ json_encode($id_employee) }}" />
            </li>
            <li>
                <assign-tablet :id_user="{{ json_encode($id_user) }}" :id_employee="{{ json_encode($id_employee) }}" />
            </li>
        </ul>


</section>
@endsection