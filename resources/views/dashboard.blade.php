@extends('layouts.app')

@section('title', 'Dashboard Ambiental - El Salvador')

@section('content')
<div class="dash-hero">
    <div class="hero-badge">Portal ambiental</div>
    <h1>Informacion que transforma El Salvador</h1>
    <p>Explora datos y guias sobre el medioambiente en el pais.</p>
</div>

<div class="section-wrap">
    <div class="section-header">
        <h2>Datos Ambientales por Departamento</h2>
    </div>

    <div class="table-responsive" style="background: white; border-radius: 16px; padding: 20px;">
        <table class="table table-bordered">
            <thead style="background-color: #2d6a4f; color: white;">
                <tr>
                    <th>Departamento</th>
                    <th>Municipio</th>
                    <th>Temperatura</th>
                    <th>Humedad</th>
                    <th>Calidad del Aire</th>
                    <th>CO2 (ppm)</th>
                    <th>Recomendaciones</th>
                    <th>Fecha</th>
                </tr>
            </thead>
            <tbody>
                @forelse($environmentalData as $data)
                <tr>
                    <td>{{ $data->department ?? 'N/A' }}</td>
                    <td>{{ $data->municipality ?? 'N/A' }}</td>
                    <td>{{ $data->temperature ?? 'N/A' }}°C</td>
                    <td>{{ $data->humidity ?? 'N/A' }}%</td>
                    <td>
                        @if(($data->air_quality ?? '') == 'buena')
                            <span class="badge bg-success">Buena</span>
                        @elseif(($data->air_quality ?? '') == 'regular')
                            <span class="badge bg-warning">Regular</span>
                        @else
                            <span class="badge bg-danger">Mala</span>
                        @endif
                    </td>
                    <td>{{ $data->co2_levels ?? 'N/A' }}</td>
                    <td>{{ $data->recommendations ?? 'N/A' }}</td>
                    <td>{{ $data->record_date ?? 'N/A' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center">No hay datos ambientales registrados.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="container mt-4 mb-4">
    <div class="alert alert-success">
        <strong>Bienvenido, {{ Auth::user()->name }}</strong><br>
        Municipio: {{ Auth::user()->municipio ?? 'No especificado' }} | 
        Rol: {{ Auth::user()->role == 'admin' ? 'Administrador' : 'Usuario' }}
    </div>
</div>
@endsection