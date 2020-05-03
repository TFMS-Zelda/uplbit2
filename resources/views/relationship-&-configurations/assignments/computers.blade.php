@extends('layouts.dashboard')

@section('title', 'relationship-&-configurations/create')

@section('content')
@section('titlePosition', 'relationship-&-configurations/assignments/computers')


<section class="content">
    <div class="container-fluid">
        <h1 class="h3 mb-1 text-gray-800">Equipos de computo asignados </h1>
        <assignments-computers />
    </div>
</section>
@endsection