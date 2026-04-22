@extends('layouts.app')

@section('title', 'Administrar Datos Ambientales')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>📊 Administrar Datos Ambientales</h1>
        <a href="{{ route('admin.environmental.create') }}" class="btn btn-success">➕ Agregar Nuevo Dato</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-success">
                <tr>
                    <th>ID</th><th>Departamento</th><th>Municipio</th><th>Temperatura</th>
                    <th>Humedad</th><th>Calidad</th><th>CO₂</th><th>Fecha</th><th>Acciones</th>
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
                    <td>{{ ucfirst($dato->air_quality) }}</td>
                    <td>{{ $dato->co2_levels }} ppm</td>
                    <td>{{ $dato->record_date }}</td>
                    <td>
                        <a href="{{ route('admin.environmental.edit', $dato->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('admin.environmental.destroy', $dato->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar este registro?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="9" class="text-center">No hay datos registrados</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection