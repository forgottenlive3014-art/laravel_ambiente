@extends('layouts.app')

@section('title', 'Crear Usuario')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h4 class="mb-0">➕ Crear Nuevo Usuario</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.users.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Nombre completo *</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email *</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Contraseña *</label>
                            <input type="password" name="password" class="form-control" required>
                            <small class="text-muted">Mínimo 8 caracteres</small>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Rol *</label>
                            <select name="role" class="form-control" required>
                                <option value="user">Usuario Normal</option>
                                <option value="admin">Administrador</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Municipio</label>
                            <input type="text" name="municipio" class="form-control" placeholder="Opcional">
                        </div>
                        <button type="submit" class="btn btn-success">💾 Crear Usuario</button>
                        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Cancelar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection