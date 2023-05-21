<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name', 'Laravel') }} | Historias</title>
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
    
    <h2>Historia Clínica: {{ $record->patient->document_numb }}</h2>

    <h4>1. Datos Generales</h4>
    
    <table>
        <tr>
            <th style="width: 150px;">Fecha y Hora</th>
            <th>Especialista</th>
            <th>Servicio</th>
        </tr>
        <tr>
            <td>
                {{ Carbon\Carbon::parse($record->created_at)->format('d/m/Y H:m') }}
            </td>
            <td>
                {{ $record->employee->patient->names }}
                {{ $record->employee->patient->surnames }} 
            </td>
            <td>
                {{ $record->service->concept }}
            </td>
        </tr>
    </table>

    <h4>2. Identificación del Paciente</h4>

    <table>
        <tr>
            <th style="width: 200px">Documento</th>
            <th>Nombres y Apellidos</th>
            <th>Edad</th>
            <th>Sexo</th>
        </tr>
        <tr>
            <td>
                {{ $record->patient->document_type }} - {{ $record->patient->document_numb }}
            </td>
            <td>
                {{ $record->patient->names }}
                {{ $record->patient->surnames }} 
            </td>
            <td>
                {{ Carbon\Carbon::parse($record->patient->birthdate)->age }} Año(s)
            </td>
            <td>
                {{ $record->patient->gender }}
            </td>
        </tr>

        <tr>
            <th>F. Nacimiento</th>
            <th>Tutor</th>
            <th colspan="2">Procedencia</th>
        </tr>
        <tr>
            <td>
                {{ Carbon\Carbon::parse($record->patient->birthdate)->format('d/m/Y') }}
            </td>
            <td>
                {{ $record->patient->relative }}
            </td>
            <td colspan="2">
                {{ $record->patient->address }}           
            </td>
        </tr>
    </table>

    <h4>3. Resumen de Historia Clínica</h4>

    <table>
        <tr>
            <th>3.1. Síntomas Principales</th>
            <th>3.2. Historia de la Enfermedad</th>
        </tr>
        <tr>
            <td><p>{{ $record->record->symptom }}</p></td>
            <td><p>{{ $record->record->history }}</p></td>
        </tr>
        <tr>
            <th>3.3. Antecedentes Fisiológicos</th>
            <th>3.4. Antecedentes Patológicos</th>
        </tr>
        <tr>
            <td><p>{{ $record->record->physiological_background }}</p></td>
            <td><p>{{ $record->record->pathological_background }}</p></td>
        </tr>
    </table>
    <br>
    <table>
        <tr>
            <th colspan="4" style="text-align: center;">3.5 Funciones Vitales</th>
        </tr>
        <tr>
            <th>Temp (°C)</th>
            <th>Peso (kg)</th>
            <th>Talla (cm)</th>
            <th>IMC</th>
        </tr>
        <tr>
            <td>{{ $record->triage->temperature }}</td>
            <td>{{ $record->triage->weight }}</td>
            <td>{{ $record->triage->height }}</td>
            <td>{{ $record->triage->bmi }}</td>
        </tr>
        <tr>
            <th>SpO2 (%)</th>
            <th>F.C. (x')</th>
            <th>F.R. (x')</th>
            <th>P/A (mmHg)</th>
        </tr>
        <tr>
            <td>{{ $record->triage->oxygen_saturation }}</td>
            <td>{{ $record->triage->heart_rate }}</td>
            <td>{{ $record->triage->respiratory_rate }}</td>
            <td>{{ $record->triage->blood_pressure }}</td>
        </tr>
    </table>

    <h4>3.6 Exámen Físico</h4>

    <p>{{ $record->record->physical_exam }}</p>

    <h4>3.7. Impresión Dignóstica</h4>

    <h4>3.7.1. Exámenes Auxiliares</h4>

    <p>{{ $record->record->auxiliary_exams }}</p>

    <h4>3.7.2. Diagnósticos</h4>

    <table>
        <thead>
            <tr>
                <th>Tipo</th>
                <th>CIE-10</th>
                <th>Enfermedad</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($record->record->diagnoses as $diagnosis)
                <tr>
                    <td>{{ $diagnosis->pivot->type }}</td>
                    <td>{{ $diagnosis->code }}</td>
                    <td>{{ $diagnosis->disease }}</td>
                </tr> 
            @empty
                <tr>
                    <td colspan="3"  style="text-align: center;">Diágnostico en proceso.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <h4>3.7.3. Indicaciones</h4>

    <p>{{ $record->record->instruction }}</p>

    <h4>3.7.4. Tratamiento</h4>

    <p>{{ $record->record->treatment }}</p>

    <table class="logo footer" >
        <tr>
            <td class="font-8">
                ____________________________ <br>

                {{ $record->employee->patient->names }}
                {{ $record->employee->patient->surnames }} <br>

                {{ $record->employee->specialty }} <br>
                <strong>CMP:</strong> {{ $record->employee->cmp }} -
                <strong>RNE:</strong> {{ $record->employee->rne }}
            </td>
        </tr>
    </table>
</body>
</html>