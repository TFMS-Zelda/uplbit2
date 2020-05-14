<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{public_path('/core/css/bulma.css')}}">

    <title>Document</title>
</head>

<body>
    <img src="{{ public_path('/core/image/logoUpl.jpg') }}" alt="logoUpl" style="width: 10rem;">
    <section class="hero is-ligth">
        <div class="hero-body">
            <div class="container">
                <h1 class="title">
                    Operational Level Agreement
                </h1>
                <h2 class="subtitle">
                    {{ $employee->name }}
                    <br>
                    {{ $employee->email_corporate }}
                    <br>
                    {{ $employee->job_title }} ~ {{ $employee->ugdn }}
                </h2>
            </div>
        </div>
    </section>
    <div class="container">
        <div class="notification">
            <p class="has-text-black has-text-justified">
                Por la presente acta se hace constar la entrega que hace
                <strong>Uniphos Plant Limited</strong> al
                empleado de los siguientes recursos tecnológicos los cuales son detallados a continuacion:
            </p>
        </div>


        @if ($computers->isEmpty())
        <div class="notification is-danger">
            <strong>No Se le asigna Equipo de computo</strong>
        </div>
        @else
        <div class="notification is-primary is-light">
            <h3 class="title is-3">Equipo de computo</h3>
            <h2 class="subtitle">
                Se le asignan {{ $computersCount }} Cí
            </h2>
            <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
                <thead>
                    <tr>
                        <th class="has-text-centered"><abbr>Activo:</abbr></th>
                        <th class="has-text-centered">Marca y Módelo:</th>
                        <th class="has-text-centered"><abbr>Características:</abbr></th>
                        <th class="has-text-centered"><abbr>Placa Corporativa:</abbr></th>
                        <th class="has-text-centered"><abbr>Cargador:</abbr></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($computers as $computer)
                    <tr>
                        <td class="has-text-centered">{{ $computer->id }}</td>
                        <td class="has-text-centered">{{ $computer->type_machine }}: {{ $computer->brand }} <br>
                            {{ $computer->model }}
                            <span class="tag is-link is-light"><strong>
                                    ServiceTag: {{ $computer->servicetag }}</strong></span>
                        </td>
                        <td class="has-text-centered">{{ $computer->operating_system }}<br>
                            {{ $computer->processor }} {{ $computer->memory_ram }}
                            <br>
                            {{ $computer->hard_drive }}
                        </td>
                        <td class="has-text-centered">
                            <span class="tag is-link is-light"><strong>
                                    Placa: {{ $computer->license_plate }}</strong></span> <br>
                            {{ $computer->status }}

                        </td>
                        <td class="has-text-centered">
                            <span class="tag is-link is-light"><strong>Modelo:
                                    {{ $computer->charger_model }}</strong></span>
                            <span class="tag is-link is-light"><strong>Serial:
                                    {{ $computer->charger_serial }}</strong></span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif

        @if ($tablets->isEmpty())
        <div class="notification is-danger">
            <strong>No se le asigna Tablet Coporativa</strong>
        </div>
        @else
        <div class="notification is-link is-light">
            <h3 class="title is-3">Tablet Corporativa</h3>
            <h2 class="subtitle">
                Se le asignan {{ $tabletsCount }} Cí
            </h2>
            <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
                <thead>
                    <tr>
                        <th class="has-text-centered"><abbr>Activo:</abbr></th>
                        <th class="has-text-centered">Marca y Módelo:</th>
                        <th class="has-text-centered"><abbr>Características:</abbr></th>
                        <th class="has-text-centered"><abbr>Placa Corporativa:</abbr></th>
                        <th class="has-text-centered"><abbr>Plan de Datos:</abbr></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tablets as $tablet)
                    <tr>
                        <td class="has-text-centered">{{ $tablet->id }}</td>
                        <td class="has-text-centered">{{ $tablet->brand }}: {{ $tablet->model }} <br>
                            <span class="tag is-link is-light"><strong>
                                    Serial: {{ $tablet->serial }}</strong></span>
                        </td>
                        <td class="has-text-centered">{{ $tablet->operating_system }}<br>
                            {{ $tablet->processor }} {{ $tablet->memory }}
                            <br>
                            {{ $tablet->screen }}
                        </td>
                        <td class="has-text-centered">
                            <span class="tag is-link is-light"><strong>
                                    Placa: {{ $tablet->license_plate }}</strong></span> <br>
                            {{ $tablet->status }}

                        </td>
                        <td class="has-text-centered">
                            <span class="tag is-link is-light"><strong>IMEI:
                                    {{ $tablet->imei }}</strong></span>
                            <span class="tag is-link is-light"><strong>Número de Teléfono:
                                    {{ $tablet->phone_number }}</strong></span>
                            <span class="tag is-link is-light"><strong>SimCard:
                                    {{ $tablet->sim_card }}</strong></span>
                            <span class="tag is-danger is-light"><strong>Pin:
                                    {{ $tablet->pin }}</strong></span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif

        @if ($monitors->isEmpty())
        <div class="notification is-danger">
            <strong>No se le asigna Monitor Corporativo</strong>
        </div>
        @else
        <div class="notification is-warning is-light">
            <h3 class="title is-3">Monitor Corporativo</h3>
            <h2 class="subtitle">
                Se le asignan {{ $monitorsCount }} Cí
            </h2>
            <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
                <thead>
                    <tr>
                        <th class="has-text-centered"><abbr>Activo:</abbr></th>
                        <th class="has-text-centered">Marca y Módelo:</th>
                        <th class="has-text-centered"><abbr>Características:</abbr></th>
                        <th class="has-text-centered"><abbr>Placa Corporativa:</abbr></th>
                        <th class="has-text-centered"><abbr>Cargador:</abbr></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($monitors as $monitor)
                    <tr>
                        <td class="has-text-centered">{{ $monitor->id }}</td>
                        <td class="has-text-centered">{{ $monitor->brand }}: {{ $monitor->model }} <br>
                            <span class="tag is-link is-light"><strong>
                                    Serial: {{ $monitor->serial }}</strong></span>
                        </td>
                        <td class="has-text-centered">{{ $monitor->screen_type }}<br>
                            {{ $monitor->screen_format }} {{ $monitor->backlight }}
                            <br>
                            {{ $monitor->input_connector_type }}
                        </td>
                        <td class="has-text-centered">
                            <span class="tag is-link is-light"><strong>
                                    Placa: {{ $monitor->license_plate }}</strong></span> <br>
                            {{ $monitor->status }}

                        </td>
                        <td class="has-text-centered">
                            <span class="tag is-link is-light"><strong>Cargador:
                                    {{ $monitor->power_supply }}</strong></span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif

        @if ($perisfericos->isEmpty())
        <div class="notification is-danger">
            <strong>No se le asigna Perisfericos Corporativos</strong>
        </div>
        @else
        <div class="notification is-black is-light">
            <h3 class="title is-3">Perisférico Corporativo</h3>
            <h2 class="subtitle">
                Se le asignan {{ $perisfericosCount }} Cí
            </h2>
            <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
                <thead>
                    <tr>
                        <th class="has-text-centered"><abbr>Activo:</abbr></th>
                        <th class="has-text-centered">Tipo de Perisférico:</th>
                        <th class="has-text-centered"><abbr>Marca y Módelo:</abbr></th>
                        <th class="has-text-centered"><abbr>Placa Corporativa:</abbr></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($perisfericos as $perisferico)
                    <tr>
                        <td class="has-text-centered">{{ $perisferico->id }}</td>
                        <td class="has-text-centered">{{ $perisferico->type_device }}:
                            {{ $perisferico->type_other_peripherals }} <br>
                            <span class="tag is-link is-light"><strong>
                                    Serial: {{ $perisferico->serial }}</strong></span>
                        </td>
                        <td class="has-text-centered">{{ $perisferico->brand }}<br>
                            {{ $perisferico->model }}
                        </td>
                        <td class="has-text-centered">
                            <span class="tag is-link is-light"><strong>
                                    Placa: {{ $perisferico->license_plate }}</strong></span> <br>
                            {{ $perisferico->status }}

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif

        <div class="notification">
            <p class="has-text-black has-text-justified">
                La finalidad de los anteriores recursos tecnológicos es para el desarrollo de sus funciones y el
                cumplimiento de las obligaciones que ha adquirido en virtud del contrato laboral suscrito.

                Los recursos tecnológicos se entregan en perfecto estado de uso y conservación,respondiendo el empleado
                por la pérdida, daños, sustracciones o averías del mismo, cuando haya sido por negligencia o descuido,
                para lo cual, con la suscripción del presente acuerdo de nivel operativo, autoriza expresamente y de
                manera irrevocable a la empresa, para que proceda a descontar de su salario, liquidación y/o
                prestaciones sociales,
                el valor de la reparación o sustitución.

                El empleado no podrá usar, gozar o disponer de los recursos tecnológicos de propiedad de la compañía
                para la realización o ejecución de actividades distintas a las que le corresponden conforme a las
                funciones que le han sido asignadas en virtud del presente acuerdo. Por lo tanto, durante la vigencia
                del acuerdo de nivel operativo, la compañía podrá adelantar inspecciones y controles para verificar el
                cumplimiento de esta obligación.

                El empleado se compromete a realizar la devolución de los recursos tecnológicos a la terminación del
                contrato laboral, en las mismas condiciones que le fue entregado, salvo el deterioro normal causado por
                el uso. Es de anotar, que dichos recursos tecnológicos revisará un tercero y el costo de cualquier
                novedad presentada respecto a la funcionalidad, completitud e integridad
                en éste, será descontada de su salario, liquidación y/o prestaciones sociales según corresponda

                Se suscribe en la ciudad de Bogotá en la fecha de creación del empleado <strong>
                    {{ Carbon\Carbon::parse($employee->created_at)->format('l jS \\of F Y ') }}.</strong> registrada en
                el sistema

            </p>
        </div>
    </div>

</body>

</html>