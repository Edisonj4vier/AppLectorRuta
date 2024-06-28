<table id="appLectorRutaTable" class="table table-bordered table-hover">
    <thead>
    <tr>
        <th>Editar</th>
        <th>Eliminar</th>
        <th>Lector</th>
        <th>Rutas Asignadas</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($appLectorRutas as $appLectorRuta)
        <tr>
            <td class="table-actions">
                <button type="button" class="btn btn-warning btn-sm edit-btn" data-id="{{ $appLectorRuta->id }}">Editar</button>
            </td>
            <td class="table-actions">
                <form action="{{ route('app-lector-ruta.destroy', $appLectorRuta->id) }}" method="POST" class="delete-form">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                </form>
            </td>
            <td>{{ $appLectorRuta->usuario->nombre }}</td>
            <td>{{ $appLectorRuta->ruta->nombre }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
