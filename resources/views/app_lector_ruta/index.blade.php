@extends('layouts.app')

@section('content')
    <h2 class="mb-4 text-center">Registro de ruta del lector</h2>
    <form id="form-agregar-editar" action="{{ route('app-lector-ruta.store') }}" method="POST" class="mb-4">
        @csrf
        <div class="mb-3">
            <label for="id_usuario" class="form-label">Lector</label>
            <select class="form-select select2" id="id_usuario" name="id_usuario">
                <option value="">Seleccione Lector</option>
                @foreach ($usuarios as $usuario)
                    <option value="{{ $usuario->id }}">{{ $usuario->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="id_ruta" class="form-label">Ruta</label>
            <select class="form-select select2" id="id_ruta" name="id_ruta">
                <option value="">Seleccione Ruta</option>
                @foreach ($rutas as $ruta)
                    <option value="{{ $ruta->id }}">{{ $ruta->nombre }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Agregar</button>
    </form>
    @if(session('route_added') && $appLectorRutas->count() > 0)
        <table id="appLectorRutaTable" class="table table-bordered table-hover">
            <thead>
            <tr>
                <th>Editar</th>
                <th>Eliminar</th>
                <th>Lector</th>
                <th>Ruta</th>
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
    @else
        <p class="text-center">No hay rutas registradas. Agregue una nueva ruta para mostrar la tabla.</p>
    @endif

    @include('partials.confirmation-modal')
    @include('partials.edition-modal')

    @if(session('success'))
        <script>
            let successMessage = "{{ session('success') }}";
        </script>
    @endif

    @if(session('error'))
        <script>
            let errorMessage = "{{ session('error') }}";
        </script>
    @endif
@endsection
