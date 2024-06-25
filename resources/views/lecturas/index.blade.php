@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Lecturas</h1>
        <div class="d-flex justify-content-between mb-3">
            <div>
                <button class="btn btn-primary" id="sincronizar">Sincronizar</button>
            </div>
            <div>
                <span class="me-3">Mes: {{ $mes }}</span>
                <button class="btn btn-success" id="agregarLectura">Agregar lectura</button>
            </div>
        </div>

        <table class="table table-bordered">
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
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
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
