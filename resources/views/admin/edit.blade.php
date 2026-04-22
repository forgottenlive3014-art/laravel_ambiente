@extends('layouts.app')

@section('title', 'Editar Dato Ambiental')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-warning">
                    <h4 class="mb-0">✏️ Editar Dato Ambiental</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.environmental.update', $dato->id) }}">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Departamento *</label>
                                <input type="text" name="department" class="form-control" value="{{ $dato->department }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Municipio *</label>
                                <input type="text" name="municipality" class="form-control" value="{{ $dato->municipality }}" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Temperatura (°C) *</label>
                                <input type="number" step="0.1" name="temperature" class="form-control" value="{{ $dato->temperature }}" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Humedad (%) *</label>
                                <input type="number" name="humidity" class="form-control" value="{{ $dato->humidity }}" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">CO₂ (ppm) *</label>
                                <input type="number" step="0.01" name="co2_levels" class="form-control" value="{{ $dato->co2_levels }}" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Calidad del Aire *</label>
                                <select name="air_quality" class="form-control" required>
                                    <option value="buena" {{ $dato->air_quality == 'buena' ? 'selected' : '' }}>Buena</option>
                                    <option value="regular" {{ $dato->air_quality == 'regular' ? 'selected' : '' }}>Regular</option>
                                    <option value="mala" {{ $dato->air_quality == 'mala' ? 'selected' : '' }}>Mala</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Fecha de Registro *</label>
                                <input type="date" name="record_date" class="form-control" value="{{ $dato->record_date }}" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Recomendaciones *</label>
                            <textarea name="recommendations" class="form-control" rows="3" required>{{ $dato->recommendations }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-warning">🔄 Actualizar</button>
                        <a href="{{ route('admin.environmental.index') }}" class="btn btn-secondary">Cancelar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection