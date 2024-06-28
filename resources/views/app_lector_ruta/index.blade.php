@extends('layouts.app')
@section('content')
    <h2 class="mb-4 text-center">Registro de ruta del lector</h2>
    @section('content')
        <h2 class="mb-4 text-center">Registro de ruta del lector</h2>
        <form id="form-agregar-editar" action="{{ route('app-lector-ruta.store') }}" method="POST" class="mb-4">
            @csrf
            <div class="mb-3">
                <label for="id_usuario" class="form-label">Lector</label>
                <select class="form-select select2" id="id_usuario" name="id_usuario">
                    <option value="">Seleccione Lector</option>
                    @foreach ($usuarios as $usuario)
                        <option value="{{ $usuario['id'] }}">{{ $usuario['nombre_usuario'] }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="id_ruta" class="form-label">Ruta</label>
                <select class="form-select select2" id="id_ruta" name="id_ruta">
                    <option value="">Seleccione Ruta</option>
                    @foreach ($rutas as $ruta)
                        <option value="{{ $ruta['id'] }}">{{ $ruta['nombreruta'] }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Asignar Ruta</button>
        </form>
        <div id="table-container">
            <!-- La tabla se llenará dinámicamente -->
            @include('partials.table')
        </div>
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
