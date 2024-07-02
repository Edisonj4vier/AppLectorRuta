@extends('layouts.app')
<<<<<<< HEAD

@section('content')
    <div class="container">
        <h1>Lecturas</h1>
=======
@section('content')
    <div class="container-fluid">
        <h1 class="mb-4 text-center">Lecturas</h1>
>>>>>>> temp-branch
        <div class="d-flex justify-content-between mb-3">
            <div>
                <button class="btn btn-primary" id="sincronizar">Sincronizar</button>
            </div>
            <div>
<<<<<<< HEAD
                <span class="me-3">Mes: {{ $mes }}</span>
                <button class="btn btn-success" id="agregarLectura">Agregar lectura</button>
            </div>
        </div>

        <table class="table table-bordered">
=======
                <span class="me-3">Fecha: {{ date('d/m/Y') }}</span>
            </div>
        </div>
        <div class="table-responsive">
        <table class="table table-bordered ">
>>>>>>> temp-branch
            <thead>
            <tr>
                <th>Eliminar</th>
                <th>Modificar</th>
                <th># Reg</th>
                <th>Cuenta</th>
                <th>Medidor</th>
                <th>Clave</th>
                <th>Abonado</th>
                <th>Ruta</th>
                <th>Lectura</th>
                <th>Promedio</th>
<<<<<<< HEAD
                <th>Observación</th>
                <th>Mes</th>
                <th>Año</th>
            </tr>
            </thead>
            <tbody>
            @foreach($lecturas as $lectura)
                <tr>
                    <td><button class="btn btn-sm btn-danger">Eliminar</button></td>
                    <td><button class="btn btn-sm btn-warning">Modificar</button></td>
                    <td>{{ $lectura->reg ?? '' }}</td>
                    <td>{{ $lectura->cuenta ?? '' }}</td>
                    <td>{{ $lectura->medidor ?? '' }}</td>
                    <td>{{ $lectura->clave ?? '' }}</td>
                    <td>{{ $lectura->abonado ?? '' }}</td>
                    <td>{{ $lectura->ruta ?? '' }}</td>
                    <td>{{ $lectura->lectura ?? '' }}</td>
                    <td>{{ $lectura->promedio ?? '' }}</td>
                    <td>{{ $lectura->observacion ?? '' }}</td>
                    <td>{{ $lectura->mes ?? '' }}</td>
                    <td>{{ $lectura->anio ?? '' }}</td>
=======
                <th>Rango Inferior</th>
                <th>Rango Superior</th>
                <th>Observación</th>
                <th>Mes</th>
                <th>Año</th>
                <th>Mensaje</th>
            </tr>
            </thead>
            <tbody>
            @foreach($lecturas as $index => $lectura)
                <tr>
                    <td><button class="btn btn-sm btn-danger">Eliminar</button></td>
                    <td><button class="btn btn-sm btn-warning">Modificar</button></td>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $lectura->cuenta }}</td>
                    <td>{{ $lectura->medidor }}</td>
                    <td>{{ $lectura->clave }}</td>
                    <td>{{ $lectura->abonado }}</td>
                    <td>{{ $lectura->ruta }}</td>
                    <td>{{ $lectura->lectura }}</td>
                    <td>{{ $lectura->promedio }}</td>
                    <td>{{ $lectura->rango_inferior }}</td>
                    <td>{{ $lectura->rango_superior }}</td>
                    <td>{{ $lectura->observacion }}</td>
                    <td>{{ $lectura->mes }}</td>
                    <td>{{ $lectura->anio }}</td>
                    <td>{{ $lectura->mensaje }}</td>
>>>>>>> temp-branch
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
<<<<<<< HEAD
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#sincronizar').click(function() {
                // Lógica para sincronizar
                alert('Sincronizando...');
            });

            $('#agregarLectura').click(function() {
                // Lógica para agregar lectura
                alert('Agregando lectura...');
            });
        });
    </script>
@endpush
=======
    </div>
@endsection
>>>>>>> temp-branch
