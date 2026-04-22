@extends('layouts.app')

@section('title', 'Dashboard Ambiental - El Salvador')

@section('content')
<div class="dash-hero">
    <div class="hero-badge">🌿 Tu portal ambiental</div>
    <h1>Información que <em>transforma</em> El Salvador</h1>
    <p>Explora datos, estadísticas y guías sobre el medioambiente en nuestro país.</p>
</div>

<div class="search-wrap">
    <div class="search-box">
        <span>🔍</span>
        <input type="text" id="searchInput" placeholder="Busca por departamento, temperatura, recomendaciones...">
        <button onclick="buscarArticulo()">Buscar</button>
    </div>
</div>

<div class="categories">
    <p class="cat-title">Explorar por tema</p>
    <div class="cat-pills">
        <div class="pill active" data-categoria="todo">🌍 Todo</div>
        <div class="pill" data-categoria="clima">🌡️ Cambio Climático</div>
        <div class="pill" data-categoria="sostenibilidad">♻️ Sostenibilidad</div>
        <div class="pill" data-categoria="biodiversidad">🐾 Biodiversidad</div>
        <div class="pill" data-categoria="agua">💧 Agua & Océanos</div>
    </div>
</div>

<div class="section-wrap" id="articulos">
    <div class="section-header">
        <h2>📰 Artículo Destacado</h2>
        <a href="#">Ver todos →</a>
    </div>
    <div class="featured-card">
        <div class="featured-img"></div>
        <div class="featured-body">
            <span class="tag">🌡️ Cambio Climático</span>
            <h3>El Salvador: Impactos del cambio climático en la región</h3>
            <div class="meta">
                <span>📅 {{ date('d M, Y') }}</span>
                <span>⏱️ 8 min lectura</span>
                <span>👁️ 12.4K vistas</span>
            </div>
            <p>El cambio climático está afectando gravemente a El Salvador con sequías prolongadas, tormentas más intensas y pérdida de biodiversidad. Conoce cómo podemos adaptarnos y mitigar estos efectos.</p>
            <a href="#" class="btn-read">Leer artículo completo →</a>
        </div>
    </div>
</div>

<!-- ===== TABLA DE DATOS AMBIENTALES (para TODOS los usuarios) ===== -->
<div class="section-wrap">
    <div class="section-header">
        <h2>📊 Datos Ambientales por Departamento</h2>
        @if(Auth::user()->role === 'admin')
            <a href="{{ route('admin.environmental.index') }}">➕ Administrar Datos</a>
        @endif
    </div>

    <div class="table-responsive" style="background: white; border-radius: 16px; padding: 20px; box-shadow: 0 4px 24px rgba(0,0,0,0.10);">
        <table class="table table-bordered table-hover" style="width: 100%; border-collapse: collapse;">
            <thead style="background-color: #2d6a4f; color: white;">
                <tr>
                    <th style="padding: 12px;">ID</th>
                    <th style="padding: 12px;">Departamento</th>
                    <th style="padding: 12px;">Municipio</th>
                    <th style="padding: 12px;">Temperatura</th>
                    <th style="padding: 12px;">Humedad</th>
                    <th style="padding: 12px;">Calidad del Aire</th>
                    <th style="padding: 12px;">CO₂ (ppm)</th>
                    <th style="padding: 12px;">Recomendaciones</th>
                    <th style="padding: 12px;">Fecha</th>
                </tr>
            </thead>
            <tbody>
                @forelse($environmentalData as $data)
                <tr style="border-bottom: 1px solid #e8f5ec;">
                    <td style="padding: 10px;">{{ $data->id }}</td>
                    <td style="padding: 10px;"><strong>{{ $data->department }}</strong></td>
                    <td style="padding: 10px;">{{ $data->municipality }}</td>
                    <td style="padding: 10px;">{{ $data->temperature }}°C</td>
                    <td style="padding: 10px;">{{ $data->humidity }}%</td>
                    <td style="padding: 10px;">
                        <span class="badge" style="background: 
                            @if($data->air_quality == 'buena') #2d6a4f
                            @elseif($data->air_quality == 'regular') #f4a261
                            @else #e63946
                            @endif; color: white; padding: 5px 12px; border-radius: 20px;">
                            {{ ucfirst($data->air_quality) }}
                        </span>
                    </td>
                    <td style="padding: 10px;">{{ $data->co2_levels }}</td>
                    <td style="padding: 10px;">{{ $data->recommendations }}</td>
                    <td style="padding: 10px;">{{ $data->record_date }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" style="text-align: center; padding: 40px;">
                        ⚠️ No hay datos ambientales registrados.
                        @if(Auth::user()->role === 'admin')
                            <br><a href="{{ route('admin.environmental.create') }}" class="btn btn-success mt-2">➕ Agregar primer dato</a>
                        @endif
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="stats-section" id="datos">
    <div class="inner">
        <h2>📊 Datos ambientales de El Salvador</h2>
        <div class="data-grid">
            <div class="data-card"><span class="icon">🌡️</span><span class="number">{{ $highlights['promedio_temperatura'] }}°C</span><span class="label">Temperatura promedio</span></div>
            <div class="data-card"><span class="icon">💧</span><span class="number">{{ $highlights['promedio_humedad'] }}%</span><span class="label">Humedad promedio</span></div>
            <div class="data-card"><span class="icon">🌫️</span><span class="number">{{ $highlights['calidad_aire_general'] }}</span><span class="label">Calidad del aire</span></div>
            <div class="data-card"><span class="icon">⚠️</span><span class="number">{{ $highlights['departamento_mas_afectado'] }}</span><span class="label">Zona crítica</span></div>
        </div>
    </div>
</div>

<div class="tips-section" id="consejos">
    <div class="section-header">
        <h2>💡 Acciones que hacen la diferencia</h2>
        <a href="#">Ver guías completas →</a>
    </div>
    <div class="tips-grid">
        @foreach($recommendations as $title => $description)
        <div class="tip-card">
            <div class="tip-icon">🌱</div>
            <div class="tip-content">
                <h4>{{ $title }}</h4>
                <p>{{ $description }}</p>
            </div>
        </div>
        @endforeach
    </div>
</div>

<div class="cta-banner">
    <div class="cta-inner">
        <div class="cta-text">
            <h3>🌱 Comparte tu conocimiento con la comunidad</h3>
            <p>¿Tienes una historia, iniciativa o consejo para compartir? EcoMundo es de todos. Publica tu contenido y llega a miles de personas comprometidas con el planeta.</p>
        </div>
        <div class="cta-actions">
            <a href="#" class="btn-white">Publicar artículo</a>
            <a href="#" class="btn-ghost">Explorar comunidad</a>
        </div>
    </div>
</div>

<div class="container mt-4 mb-4">
    <div class="alert alert-success">
        <strong>👋 ¡Bienvenido, {{ Auth::user()->name }}!</strong><br>
        📍 Tu municipio: {{ Auth::user()->municipio ?? 'No especificado' }} | 
        👑 Rol: {{ Auth::user()->role == 'admin' ? 'Administrador' : 'Usuario' }} | 
        📅 Fecha de ingreso: {{ Auth::user()->created_at->format('d/m/Y') }}
    </div>
</div>

<script>
function buscarArticulo() {
    let busqueda = document.getElementById('searchInput').value.toLowerCase();
    let tabla = document.querySelector('.table-responsive table tbody');
    let filas = tabla.querySelectorAll('tr');
    
    filas.forEach(fila => {
        let texto = fila.innerText.toLowerCase();
        if (texto.includes(busqueda) || busqueda === '') {
            fila.style.display = '';
        } else {
            fila.style.display = 'none';
        }
    });
}

document.querySelectorAll('.pill').forEach(pill => {
    pill.addEventListener('click', function() {
        document.querySelectorAll('.pill').forEach(p => p.classList.remove('active'));
        this.classList.add('active');
    });
});
</script>
@endsection