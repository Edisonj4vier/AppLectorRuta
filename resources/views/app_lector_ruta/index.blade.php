<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>App Lector Ruta</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.0-beta1/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">App Lector Ruta</h2>
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <form action="{{ route('app-lector-ruta.store') }}" method="POST" class="mb-4">
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
                    <form action="{{ route('app-lector-ruta.destroy', $appLectorRuta->id) }}" method="POST" class="delete-form">
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

@include('partials.confirmation-modal')
@include('partials.edition-modal')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.0-beta1/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('#id_usuario').select2({
            placeholder: "Seleccione Lector",
            allowClear: true
        });
        $('#id_ruta').select2({
            placeholder: "Seleccione Ruta",
            allowClear: true
        });
        setTimeout(function() {
            $('.alert').alert('close');
        }, 5000);
        let formToSubmit;
        $('.delete-form').on('submit', function(e) {
            e.preventDefault();
            formToSubmit = this;
            $('#confirmationModal').modal('show');
        });

        $('#confirmDelete').on('click', function() {
            $('#confirmationModal').modal('hide');
            if(formToSubmit) {
                formToSubmit.submit();
            }
        });
    });
</script>
</body>
</html>
