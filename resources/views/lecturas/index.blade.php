@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <h1 class="mb-4 text-center">Lecturas</h1>

        <form id="filter-form" class="mb-4">
            <div class="row g-3">
                <div class="col-md-2">
                    <label for="year" class="form-label">Año</label>
                    <select name="year" id="year" class="form-select">
                        @for ($i = date('Y'); $i >= date('Y') - 5; $i--)
                            <option value="{{ $i }}" {{ request('year') == $i ? 'selected' : '' }}>{{ $i }}</option>
                        @endfor
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="month" class="form-label">Mes</label>
                    <select name="month" id="month" class="form-select">
                        @for ($i = 1; $i <= 12; $i++)
                            <option value="{{ $i }}" {{ request('month') == $i ? 'selected' : '' }}>{{ date('F', mktime(0, 0, 0, $i, 1)) }}</option>
                        @endfor
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="search" class="form-label">Buscar</label>
                    <input type="text" name="search" id="searchInput" class="form-control" value="{{ request('search') }}" placeholder="Cuenta, Medidor, Abonado...">
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary">Filtrar</button>
                </div>
            </div>
        </form>

        <div class="d-flex justify-content-between mb-3">
            <div>
                <button class="btn btn-primary" id="sincronizar">Sincronizar</button>
            </div>
            <div>
                <span class="me-3">Fecha: {{ date('d/m/Y') }}</span>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-striped" id="lecturasTable">
                <thead class="table-dark">
                <tr>
                    <th>Acciones</th>
                    <th><a href="{{ $lecturas->url($lecturas->currentPage()) }}&sort=cuenta&direction={{ request('direction') == 'asc' ? 'desc' : 'asc' }}">Cuenta</a></th>
                    <th><a href="{{ $lecturas->url($lecturas->currentPage()) }}&sort=medidor&direction={{ request('direction') == 'asc' ? 'desc' : 'asc' }}">Medidor</a></th>
                    <th>Clave</th>
                    <th><a href="{{ $lecturas->url($lecturas->currentPage()) }}&sort=abonado&direction={{ request('direction') == 'asc' ? 'desc' : 'asc' }}">Abonado</a></th>
                    <th>Ruta</th>
                    <th><a href="{{ $lecturas->url($lecturas->currentPage()) }}&sort=lectura&direction={{ request('direction') == 'asc' ? 'desc' : 'asc' }}">Lectura</a></th>
                    <th>Promedio</th>
                    <th>Observación</th>
                    <th>Mes</th>
                    <th>Año</th>
                </tr>
                </thead>
                <tbody>
                @foreach($lecturas as $lectura)
                    <tr>
                        <td>
                            <button class="btn btn-sm btn-warning edit-btn" data-id="{{ $lectura->cuenta }}">Modificar</button>
                            <button class="btn btn-sm btn-danger delete-btn" data-id="{{ $lectura->cuenta }}">Eliminar</button>
                        </td>
                        <td>{{ $lectura->cuenta }}</td>
                        <td>{{ $lectura->medidor }}</td>
                        <td>{{ $lectura->clave }}</td>
                        <td>{{ $lectura->abonado }}</td>
                        <td>{{ $lectura->ruta }}</td>
                        <td>{{ number_format($lectura->lectura, 2) }}</td>
                        <td>{{ number_format($lectura->promedio_actual, 2) }}</td>
                        <td>{{ $lectura->validacion }}</td>
                        <td>{{ $lectura->mes }}</td>
                        <td>{{ $lectura->anio }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        {{ $lecturas->appends(request()->except('page'))->links() }}
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // ... (código existente para sincronizar, editar y eliminar)

            $('#filter-form').submit(function(e) {
                e.preventDefault();
                var url = '{{ route("lecturas.index") }}?' + $(this).serialize();
                window.location = url;
            });
        });
    </script>
@endpush
