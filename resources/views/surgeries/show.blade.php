<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name', 'Laravel') }} | Quirúrgicos</title>
    <style>
        @page { size: A4 }

        @page {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 11pt;
            text-align: justify;
            margin-top: 2cm;
            margin-bottom: 2.5cm;
            margin-inside: 1.5cm;
            margin-outside: 1.5cm;
        }

        @page {
            border-top: 0.5pt black dotted;
        }


        @page {
            @top {
                font-size: 8pt;
                font-style: italic;
                content: flow(header);
            }

            @bottom {
                font-size: 9pt;
                content: "Página " counter(page) " de " counter(pages)
            }
        }


        header { prince-flow: static(header, start) }

        body {
            font-family: Arial, Helvetica, sans-serif;
            padding-top: 5px;
        }

        table.logo, table.logo tr, table.logo td {
            border: none;
        }

        .centro {
            text-align: center;
        }

        table {
            border-collapse: collapse;
            border: solid 1px black;
            width: 100%;
        }

        table tr {
            height: 30px;
        }

        table tr.sign {
            height: 60px;
        }

        td {
            border: solid thin black;
            padding-left: 5px;
            font-size: 10pt;
        }

        table th {
            text-align: left;
            padding-left: 10px;
            background-color: #cdcdcd;
            border: solid thin black;
            text-transform: uppercase;
        }

        h2 {
            text-align: center;
        }

        .title {
            display: block;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            font-size: 8pt;
            text-transform: uppercase;
            text-align: right;
        }

        span.office {
            display: block;
            font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
            font-size: 6pt;
        }

        ul li, ol li {
            padding-bottom: 13px;
        }

        p.item {
            margin-left: 23px;
            text-align: justify;
        }

        strong {
            text-transform: uppercase;
        }

        h1, h2, h3, h4, h5, h6 {
            text-transform: uppercase;
        }

        .footer {
            position: relative;
            right: 0;
            bottom: 0;
            left: 0;
            padding: 1rem;
            text-align: center;
        }
        
        .font-8 {
            font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
            font-size: 8pt;
            padding-top: 50px;
        }
    </style>
</head>
<body>
    <header>
        <table class="logo">
            <tr>
                <td><img src="{{ public_path('img/medicure-logo.png') }}" width="50"></td>
                <td>
                    <span class="title">
                        {{ config('app.owner', 'Yoel Diomedez Apps') }}  <br>
                        "{{ config('app.name', 'Laravel') }}"
                    </span>
                </td>
            </tr>
        </table>
    </header>
    
    <h2>Informe Operatorio-Quirúrgico</h2>
    
    <table>
        <tr>
            <th style="width: 100px;">Fecha</th>
            <th>Hora Inicio</th>
            <th>Hora Termino</th>
            <th>Cama №</th>
            <th>Uso de Oxígeno</th>
        </tr>
        <tr>
            <td>
                {{ Carbon\Carbon::parse($surgery->date)->format('d/m/Y') }} 
            </td>
            <td>
                {{ $surgery->start_time }}
            </td>
            <td>
                {{ $surgery->end_time }}
            </td>
            <td>
                {{ $surgery->bed_num }}
            </td>
            <td>
                {{ $surgery->oxygen_use }} (L) 
            </td>
        </tr>
    </table>
    <br>
    <table>
        <tr>
            <th>Paciente</th>
            <th>Tipo de Anestesia</th>
        </tr>
        <tr>
            <td>
                {{ $surgery->patient->document_type }}:
                {{ $surgery->patient->document_numb }} -
                {{ $surgery->patient->names }}
                {{ $surgery->patient->surnames }} 
            </td>
            <td>
                {{ $surgery->anesthesia_type }}
            </td>
        </tr>
    </table>
    <br>
    <table>
        <tr>
            <th>Diagnóstico Pre-Operatorio</th>
            <th>Diagnóstico Post-Operatorio</th>
        </tr>
        <tr>
            <td>
                <strong>{{ $surgery->preDiagnosis->code }}</strong> {{ $surgery->preDiagnosis->disease }}<br>
            </td>
            <td>
                <strong>{{ $surgery->postDiagnosis->code }}</strong> {{ $surgery->postDiagnosis->disease }}<br>
            </td>
        </tr>
    </table>
    <h4>Especialistas</h4>
    <table>
        <tr>
            <th>Cargo</th>
            <th>Especialidad</th>
            <th>Nombres y Apellidos</th>
        </tr>
        @foreach ($surgery->users as $employee)      
        <tr>
            <td>{{ $employee->position }}</td>
            <td>{{ $employee->specialty }}</td>
            <td>{{ $employee->patient->names }} {{ $employee->patient->surnames }} </td>
        </tr>
        @endforeach
    </table>
    <br>
    <table>
        <thead>
            <tr>
                <th >Procedimientos y Hallazgos</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <p> 
                        {{ $surgery->procedure_findings }}
                    </p>
                </td>
            </tr>
        </tbody>
    </table>
    <br>
    <table>
        <thead>
            <tr>
                <th>Equipos</th>
                <th>Insumos</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <p> 
                        {{ $surgery->equipment }}
                    </p>
                </td>
                <td>
                    <p> 
                        {{ $surgery->supplies }}
                    </p>
                </td>
            </tr>
        </tbody>
    </table>
    <br>
    <table>
        <thead>
            <tr>
                <th>Observaciones</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <p> 
                        {{ $surgery->observations }}
                    </p>
                </td>
            </tr>
        </tbody>
    </table>
    <div class="footer">
        <table class="logo">
            <tr>
            @foreach ($surgery->users as $employee)
                <td class="font-8">
                    ____________________________ <br>
                    {{ $employee->patient->names }}
                    {{ $employee->patient->surnames }}<br>

                    {{ $employee->specialty }} <br>

                    <strong>CMP:</strong> {{ $employee->cmp }} -
                    <strong>RNE:</strong> {{ $employee->rne }}
                </td>
                @break($loop->iteration == 3)
            @endforeach
            </tr>
        </table>
        <br>
        <table class="logo">
            <tr>
            @foreach ($surgery->users as $employee)
                @continue($loop->iteration < 4)
                <td class="font-8">
                    ____________________________ <br>
                    {{ $employee->patient->names }}
                    {{ $employee->patient->surnames }}<br>

                    {{ $employee->specialty }} <br>

                    <strong>CMP:</strong> {{ $employee->cmp }} -
                    <strong>RNE:</strong> {{ $employee->rne }}
                </td>            
                @break($loop->iteration == 6)
            @endforeach            
            </tr>
        </table>
        <br>
        <table class="logo">
            <tr>
            @foreach ($surgery->users as $employee)
                @continue($loop->iteration < 7)
                <td class="font-8">
                    ____________________________ <br>
                    {{ $employee->patient->names }}
                    {{ $employee->patient->surnames }}<br>

                    {{ $employee->specialty }} <br>

                    <strong>CMP:</strong> {{ $employee->cmp }} -
                    <strong>RNE:</strong> {{ $employee->rne }}
                </td>
                @break($loop->iteration == 9) 
            @endforeach            
            </tr>
        </table>
    </div>
</body>
</html>