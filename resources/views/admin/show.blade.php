@extends('layouts.app')

@section('title', 'Ver Dato Ambiental')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-info text-white">
                    <h4 class="mb-0"> Detalle del Dato Ambiental</h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>ID</th>
                            <td>{{ $dato->id }}</td>
                        </tr>
                        <tr>
                            <th>Departamento</th>
                            <td>{{ $dato->department }}</td>
                        </tr>
                        <tr>
                            <th>Municipio</th>
                            <td>{{ $dato->municipality }}</td>
                        </tr>
                        <tr>
                            <th>Temperatura</th>
                            <td>{{ $dato->temperature }} °C</td>
                        </tr>
                        <tr>
                            <th>Humedad</th>
                            <td>{{ $dato->humidity }} %</td>
                        </tr>
                        <tr>
                            <th>Calidad del Aire</th>
                            <td>{{ ucfirst($dato->air_quality) }}</td>
                        </tr>
                        <tr>
                            <th>CO₂</th>
                            <td>{{ $dato->co2_levels }} ppm</td>
                        </tr>
                        <tr>
                            <th>Recomendaciones</th>
                            <td>{{ $dato->recommendations }}</td>
                        </tr>
                        <tr>
                            <th>Fecha de Registro</th>
                            <td>{{ $dato->record_date }}</td>
                        </tr>
                    </table>
                    
                    <a href="{{ route('admin.environmental.index') }}" class="btn btn-secondary">Volver</a>
                    
                    @if(Auth::user()->role === 'admin')
                        <a href="{{ route('admin.environmental.edit', $dato->id) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('admin.environmental.destroy', $dato->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('¿Eliminar?')">Eliminar</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection