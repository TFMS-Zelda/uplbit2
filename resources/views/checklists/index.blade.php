@extends('layouts.dashboard')
@section('title', 'checklist')

@section('content')
@section('titlePosition', 'checklists')
<section class="content">
    <div class="container-fluid">
        <div class="text-center">

            <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;"
                src={{ asset('/core/undraw/checklists.svg') }} alt="information-&-technologies">
        </div>

        <!-- table employees -->
        <!-- end split hisotry users -->
        <table class="table table-sm table-striped table-light table-hover table-fixed" id="table-employees">
            <thead class="thead-primary">
                <tr class="bg-gradient-primary text-white text-center">
                    <th>ID:</th>
                    <th>Nombre:</th>
                    <th>UGDN:</th>
                    <th>Área:</th>
                    <th>Ubicación:</th>
                    <th>Status</th>
                    <th>Acciones:</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($employees as $employee)
                <tr class="text-center">
                    <td>
                        <div class="col-auto text-center">
                            <i class="fas fa-sort-numeric-down-alt"></i><br>
                            <i class="fas fa-user"></i>
                            <br>
                            <div class="h5 mb-0 font-weight-bold text-muted">{{ $employee->id }} </div>

                        </div>
                    </td>
                    <td>
                        <div class="mb-0 font-weight-bold text-gray-600">
                            <img class="img-fluid rounded-circle"
                                src='{{ Storage::url('Employees-avatar/'.$employee->profile_avatar )}}'
                                alt="avatarEmployeeImage" width="40px">
                            <br>
                            {{ $employee->name }}
                            <br>
                            <i class="fa fa-id-email" aria-hidden="true"></i>
                            <small>{{ $employee->email_corporate }}</small>
                        </div>
                    </td>

                    <td>
                        <div class="mb-0 font-weight-bold text-gray-600">
                            <i class="fa fa-fingerprint"></i>
                            <br>
                            {{ $employee->ugdn }} <br>
                            CC: {{ $employee->citizenship_card }}
                        </div>
                    </td>
                    <td>
                        <div class="mb-0 font-weight-bold text-gray-600">
                            {{ $employee->work_area }}
                            <br>
                            {{ $employee->employee_type }} <br>

                        </div>
                    </td>
                    <td>
                        <div class="mb-0 font-weight-bold text-gray-600">
                            <i class="fa fa-map-marker-alt" aria-hidden="true"></i>
                            <br>
                            {{ $employee->country }} / {{ $employee->city }} <br>
                            <i class="fas fa-phone"></i> {{ $employee->phone }}
                        </div>
                    </td>
                    <td>
                        @if ($employee->status === 'Activo')
                        <h5><span class="badge badge-success">{{ $employee->status }} </span></h5>

                        @elseif ($employee->status === 'Inactivo') <h5><span
                                class="badge badge-danger">{{ $employee->status }}
                            </span></h5>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('reports.operational-agreements.download', $employee->id) }}"
                            class="btn btn-danger btn-circle btn-sm">
                            <i class="fa fa-file-pdf text-white" aria-hidden="true"></i> </a>

                        <a href="{{ route('managers.employees.edit', $employee->id)}}"
                            class="btn btn-warning btn-circle btn-sm">
                            <i class="fas fa-exclamation-triangle"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <!-- end table employees -->
    </div>

</section>
@endsection
@push('scripts')
<script src="{{ asset('/core/plugins/DataTables/datatables.min.js') }}"></script>
<script>
    $(document).ready(function () {
        $('#table-employees').DataTable({});
    });
    
</script>
@endpush