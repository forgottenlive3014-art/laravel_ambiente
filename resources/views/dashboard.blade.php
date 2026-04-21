@extends('layouts.app')

@section('title', 'Panel Ambiental')

@section('content')
<div class="dash-hero">
    <div class="hero-badge">🌿 Tu portal ambiental</div>
    <h1>Información que <em>transforma</em> El Salvador</h1>
    <p>Explora datos, estadísticas y guías sobre el medioambiente en nuestro país. El conocimiento es el primer paso para el cambio.</p>
</div>

<div class="search-wrap">
    <div class="search-box">
        <span>🔍</span>
        <input type="text" placeholder="Busca sobre clima, biodiversidad, reciclaje..." id="searchInput" />
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
        <div class="pill" data-categoria="energia">⚡ Energías Renovables</div>
        <div class="pill" data-categoria="ciudades">🏙️ Ciudades Verdes</div>
        <div class="pill" data-categoria="agricultura">🌱 Agricultura</div>
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
                <span>📅 15 Enero, 2026</span>
                <span>⏱️ 8 min lectura</span>
                <span>👁️ 12.4K vistas</span>
            </div>
            <p>El cambio climático está afectando gravemente a El Salvador con sequías prolongadas, tormentas más intensas y pérdida de biodiversidad. Conoce cómo podemos adaptarnos y mitigar estos efectos.</p>
            <a href="#" class="btn-read">Leer artículo completo →</a>
        </div>
    </div>
</div>

<div class="section-wrap" style="margin-top:48px">
    <div class="section-header">
        <h2>🌿 Últimas Noticias Ambientales</h2>
        <a href="#">Ver todas →</a>
    </div>

    <div class="articles-grid" id="articlesGrid">
        <div class="article-card" data-categoria="sostenibilidad">
            <div class="article-img" style="background-image: url('https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?w=600')"></div>
            <div class="article-body">
                <span class="tag">♻️ Sostenibilidad</span>
                <h4>El Salvador avanza en energías renovables</h4>
                <p>El país ha logrado que el 65% de su matriz energética provenga de fuentes renovables como geotermia, hidroeléctrica y solar.</p>
                <div class="article-footer">
                    <span>📅 10 Abr, 2026</span>
                    <span>⏱️ 5 min</span>
                </div>
            </div>
        </div>

        <div class="article-card" data-categoria="biodiversidad">
            <div class="article-img" style="background-image: url('https://images.unsplash.com/photo-1518020382113-a7e8fc38eac9?w=600')"></div>
            <div class="article-body">
                <span class="tag">🐾 Biodiversidad</span>
                <h4>Conservación del jaguar en El Salvador</h4>
                <p>Proyectos de conservación buscan proteger al felino más grande de América, en peligro de extinción en el país.</p>
                <div class="article-footer">
                    <span>📅 7 Abr, 2026</span>
                    <span>⏱️ 4 min</span>
                </div>
            </div>
        </div>

        <div class="article-card" data-categoria="agua">
            <div class="article-img" style="background-image: url('https://images.unsplash.com/photo-1437622368342-7a3d73a34c8f?w=600')"></div>
            <div class="article-body">
                <span class="tag">💧 Agua</span>
                <h4>Protección del Lago de Ilopango</h4>
                <p>Iniciativas para limpiar y conservar uno de los pulmones acuáticos más importantes de El Salvador.</p>
                <div class="article-footer">
                    <span>📅 3 Abr, 2026</span>
                    <span>⏱️ 6 min</span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="stats-section" id="datos">
    <div class="inner">
        <span class="section-label">📊 El planeta en números</span>
        <h2>Los datos que debemos conocer en El Salvador</h2>

        <div class="data-grid">
            <div class="data-card">
                <span class="icon">🌡️</span>
                <span class="number">+1.8°C</span>
                <span class="label">Aumento temperatura en El Salvador</span>
                <span class="trend">↑ vs siglo pasado</span>
            </div>
            <div class="data-card">
                <span class="icon">🌊</span>
                <span class="number">85%</span>
                <span class="label">Ríos contaminados</span>
                <span class="trend">↑ alerta</span>
            </div>
            <div class="data-card">
                <span class="icon">🌲</span>
                <span class="number">35%</span>
                <span class="label">Pérdida de cobertura forestal</span>
                <span class="trend">↑ preocupante</span>
            </div>
            <div class="data-card">
                <span class="icon">♻️</span>
                <span class="number">65%</span>
                <span class="label">Energía renovable</span>
                <span class="trend good">↑ líder en CA</span>
            </div>
        </div>
    </div>
</div>

<div class="tips-section" id="consejos">
    <div class="section-header">
        <h2>💡 Acciones que hacen la diferencia</h2>
        <a href="#">Ver guías completas →</a>
    </div>

    <div class="tips-grid">
        <div class="tip-card">
            <div class="tip-icon">♻️</div>
            <div class="tip-content">
                <h4>Recicla correctamente en tu municipio</h4>
                <p>Infórmate sobre los días y lugares de recolección de residuos reciclables en {{ Auth::user()->municipio ?? 'tu municipio' }}.</p>
            </div>
        </div>
        <div class="tip-card">
            <div class="tip-icon">💡</div>
            <div class="tip-content">
                <h4>Ahorra energía en casa</h4>
                <p>Cambia a focos LED y desconecta electrodomésticos que no uses. Puedes ahorrar hasta 30% en tu factura eléctrica.</p>
            </div>
        </div>
        <div class="tip-card">
            <div class="tip-icon">🚶</div>
            <div class="tip-content">
                <h4>Movilidad sostenible</h4>
                <p>Usa bicicleta o transporte público. En San Salvador hay más de 50 km de ciclovías disponibles.</p>
            </div>
        </div>
        <div class="tip-card">
            <div class="tip-icon">💧</div>
            <div class="tip-content">
                <h4>Cuida el agua</h4>
                <p>El Salvador enfrenta estrés hídrico. Repara fugas y no dejes correr el agua innecesariamente.</p>
            </div>
        </div>
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
@endsection

@push('scripts')
<script>
    function buscarArticulo() {
        const busqueda = document.getElementById('searchInput').value.toLowerCase();
        const articulos = document.querySelectorAll('.article-card');
        
        articulos.forEach(articulo => {
            const titulo = articulo.querySelector('h4').textContent.toLowerCase();
            const descripcion = articulo.querySelector('p').textContent.toLowerCase();
            
            if (titulo.includes(busqueda) || descripcion.includes(busqueda) || busqueda === '') {
                articulo.style.display = 'block';
            } else {
                articulo.style.display = 'none';
            }
        });
    }

    document.querySelectorAll('.pill').forEach(pill => {
        pill.addEventListener('click', function() {
            const categoria = this.dataset.categoria;
            const articulos = document.querySelectorAll('.article-card');
            
            articulos.forEach(articulo => {
                if (categoria === 'todo' || articulo.dataset.categoria === categoria) {
                    articulo.style.display = 'block';
                } else {
                    articulo.style.display = 'none';
                }
            });
        });
    });
</script>
@endpush