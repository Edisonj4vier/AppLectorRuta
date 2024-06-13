<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>App Lector Ruta</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.0-beta1/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">App Lector Ruta</h2>

    <form action="{{ route('app-lector-ruta.store') }}" method="POST" class="mb-4">
        @csrf
        <div class="mb-3">
            <label for="id_usuario" class="form-label">Lector</label>
            <select class="form-select" id="id_usuario" name="id_usuario">
                @foreach ($usuarios as $usuario)
                    <option value="{{ $usuario->id }}">{{ $usuario->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="id_ruta" class="form-label">Ruta</label>
            <select class="form-select" id="id_ruta" name="id_ruta">
                @foreach ($rutas as $ruta)
                    <option value="{{ $ruta->id }}">{{ $ruta->nombre }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Agregar</button>
    </form>

    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Edita</th>
            <th>Elimina</th>
            <th>Lector</th>
            <th>Ruta</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($appLectorRutas as $appLectorRuta)
            <tr>
                <td><a href="#" class="btn btn-warning">Edita</a></td>
                <td>
                    <form action="{{ route('app-lector-ruta.destroy', $appLectorRuta->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Elimina</button>
                    </form>
                </td>
                <td>{{ $appLectorRuta->usuario->nombre }}</td>
                <td>{{ $appLectorRuta->ruta->nombre }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
</body>
</html>
