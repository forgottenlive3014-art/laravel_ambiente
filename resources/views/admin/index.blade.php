@extends('layouts.app')

@section('title', 'Administrar Datos Ambientales')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Administrar Datos Ambientales</h1>
        <a href="{{ route('admin.environmental.create') }}" class="btn btn-success">
            Agregar Nuevo Dato
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-success">
                <tr>
                    <th>ID</th>
                    <th>Departamento</th>
                    <th>Municipio</th>
                    <th>Temperatura</th>
                    <th>Humedad</th>
                    <th>Calidad del Aire</th>
                    <th>CO2 (ppm)</th>
                    <th>Recomendaciones</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($datos as $dato)
                <tr>
                    <td>{{ $dato->id }}</td>
                    <td>{{ $dato->department }}</td>
                    <td>{{ $dato->municipality }}</td>
                    <td>{{ $dato->temperature }}°C</td>
                    <td>{{ $dato->humidity }}%</td>
                    <td>
                        @if($dato->air_quality == 'buena')
                            <span class="badge bg-success">Buena</span>
                        @elseif($dato->air_quality == 'regular')
                            <span class="badge bg-warning">Regular</span>
                        @else
                            <span class="badge bg-danger">Mala</span>
                        @endif
                    </td>
                    <td>{{ $dato->co2_levels }}</td>
                    <td>{{ $dato->recommendations }}</td>
                    <td>{{ $dato->record_date }}</td>
                    <td>
                        <a href="{{ route('admin.environmental.edit', $dato->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        
                        <form action="{{ route('admin.environmental.destroy', $dato->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Eliminar este registro?')">
                                Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="10" class="text-center">
                        No hay datos ambientales registrados.
                        <br>
                        <a href="{{ route('admin.environmental.create') }}" class="btn btn-success mt-2">
                            Agregar el primer dato
                        </a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection