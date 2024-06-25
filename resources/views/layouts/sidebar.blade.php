<nav id="sidebar">
    <div class="sidebar-header">
        <h3>App Lector Ruta</h3>
    </div>

    <ul class="list-unstyled components">
        <li class="{{ Request::is('lecturas*') ? 'active' : '' }}">
            <a href="{{ route('lecturas.index') }}">
                <i class="fas fa-book"></i> Lecturas
            </a>
        </li>
        <li class="{{ Request::is('rutas*') ? 'active' : '' }}">
            <a href="{{ route('app-lector-ruta.index') }}">
                <i class="fas fa-route"></i> Rutas
            </a>
        </li>
    </ul>
</nav>


