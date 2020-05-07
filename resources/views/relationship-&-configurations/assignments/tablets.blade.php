@extends('layouts.dashboard')

@section('title', 'relationship-&-configurations/assignments')

@section('content')
@section('titlePosition', 'relationship-&-configurations/assignments/tablets')


<section class="content">
    <div class="container-fluid">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total (Asignaciones)
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $tablets }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-tablet fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <p>
            <h1 class="h3 mb-1 text-gray-800">Tablets corporativas asignadas </h1>
        </p>
        <assignments-tablets />
    </div>
</section>
@endsection