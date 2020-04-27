@extends('layouts.dashboard')

@section('title', 'information-&-technologies')

@section('content')
@section('titlePosition', 'managers/user/show')

<!-- Profile -->
<div class="box box-primary">
    <div class="box-body">

        <h3 class="text-center">{{ $user->name }}</h3>
        <figure class="text-center">
            <img src="{{ auth()->user()->avatar }}" class="img-thumbnail" alt="profile-image" width="100px">
        </figure>

        <p class="text-center">{{ $user->job_title }}</p>

        <ul class="list-group">
            <li class="list-group-item">
                <strong>Subida al sistema: </strong>
                <code>{{ Carbon\Carbon::parse($user->create_at )->format('l jS \\of F Y ') }}</code> </li>
            <li class="list-group-item">
                <strong>Última actualización realizada:</strong>
                <code> {{ Carbon\Carbon::parse($user->updated_at )->format('l jS \\of F Y ') }}</code>
            </li>
        </ul>
    </div>
</div>
@endsection
