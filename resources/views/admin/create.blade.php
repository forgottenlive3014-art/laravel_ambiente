@extends('layouts.app')

@section('title', 'Crear Dato Ambiental')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h4>Agregar Nuevo Dato Ambiental</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.environmental.store') }}">
                        @csrf

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="department" class="form-label">Departamento</label>
                                <input type="text" name="department" id="department" 
                                       class="form-control @error('department') is-invalid @enderror" 
                                       value="{{ old('department') }}" required>
                                @error('department')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="municipality" class="form-label">Municipio</label>
                                <input type="text" name="municipality" id="municipality" 
                                       class="form-control @error('municipality') is-invalid @enderror" 
                                       value="{{ old('municipality') }}" required>
                                @error('municipality')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="temperature" class="form-label">Temperatura (C)</label>
                                <input type="number" step="0.1" name="temperature" id="temperature" 
                                       class="form-control @error('temperature') is-invalid @enderror" 
                                       value="{{ old('temperature') }}" required>
                                @error('temperature')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="humidity" class="form-label">Humedad (%)</label>
                                <input type="number" name="humidity" id="humidity" 
                                       class="form-control @error('humidity') is-invalid @enderror" 
                                       value="{{ old('humidity') }}" required>
                                @error('humidity')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="co2_levels" class="form-label">CO2 (ppm)</label>
                                <input type="number" step="0.01" name="co2_levels" id="co2_levels" 
                                       class="form-control @error('co2_levels') is-invalid @enderror" 
                                       value="{{ old('co2_levels') }}" required>
                                @error('co2_levels')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="air_quality" class="form-label">Calidad del Aire</label>
                                <select name="air_quality" id="air_quality" 
                                        class="form-control @error('air_quality') is-invalid @enderror" required>
                                    <option value="">Seleccione</option>
                                    <option value="buena" {{ old('air_quality') == 'buena' ? 'selected' : '' }}>Buena</option>
                                    <option value="regular" {{ old('air_quality') == 'regular' ? 'selected' : '' }}>Regular</option>
                                    <option value="mala" {{ old('air_quality') == 'mala' ? 'selected' : '' }}>Mala</option>
                                </select>
                                @error('air_quality')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="record_date" class="form-label">Fecha de Registro</label>
                                <input type="date" name="record_date" id="record_date" 
                                       class="form-control @error('record_date') is-invalid @enderror" 
                                       value="{{ old('record_date', date('Y-m-d')) }}" required>
                                @error('record_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="recommendations" class="form-label">Recomendaciones</label>
                            <textarea name="recommendations" id="recommendations" rows="3" 
                                      class="form-control @error('recommendations') is-invalid @enderror" required>{{ old('recommendations') }}</textarea>
                            @error('recommendations')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-success">Guardar</button>
                            <a href="{{ route('admin.environmental.index') }}" class="btn btn-secondary">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection