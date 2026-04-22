@extends('layouts.app')

@section('title', 'Editar Usuario')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-warning">
                    <h4 class="mb-0">✏️ Editar Usuario: {{ $user->name }}</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.users.update', $user->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="form-label">Nombre completo *</label>
                            <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email *</label>
                            <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nueva Contraseña</label>
                            <input type="password" name="password" class="form-control" placeholder="Dejar vacío para no cambiar">
                            <small class="text-muted">Mínimo 8 caracteres (solo si quieres cambiar)</small>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Rol *</label>
                            <select name="role" class="form-control" required>
                                <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>Usuario Normal</option>
                                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Administrador</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Municipio</label>
                            <input type="text" name="municipio" class="form-control" value="{{ $user->municipio }}">
                        </div>
                        <button type="submit" class="btn btn-warning">🔄 Actualizar</button>
                        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Cancelar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection