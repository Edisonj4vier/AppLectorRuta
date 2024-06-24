$(document).ready(function() {
    // Inicialización de Select2
    $('.select2').select2({
        placeholder: "Seleccione una opción",
        allowClear: true,
    });

    // Cerrar alertas automáticamente después de 5 segundos
    setTimeout(function() {
        $('.alert').alert('close');
    }, 5000);

    // Manejo del botón de edición
    $('.edit-btn').on('click', function() {
        const id = $(this).data('id');
        $.get(`/app-lector-ruta/${id}/edit`, function(data) {
            const appLectorRuta = data.appLectorRuta;
            const usuarios = data.usuarios;
            const rutas = data.rutas;

            // Poblar opciones de select
            $('#edit_id_usuario').empty().append('<option value="">Seleccione Lector</option>');
            usuarios.forEach(usuario => {
                $('#edit_id_usuario').append(`<option value="${usuario.id}">${usuario.nombre}</option>`);
            });

            $('#edit_id_ruta').empty().append('<option value="">Seleccione Ruta</option>');
            rutas.forEach(ruta => {
                $('#edit_id_ruta').append(`<option value="${ruta.id}">${ruta.nombre}</option>`);
            });

            // Establecer valores seleccionados
            $('#edit_id_usuario').val(appLectorRuta.id_usuario).trigger('change');
            $('#edit_id_ruta').val(appLectorRuta.id_ruta).trigger('change');

            // Actualizar acción del formulario
            $('#editForm').attr('action', `/app-lector-ruta/${appLectorRuta.id}`);

            $('#editionModal').modal('show');
        });
    });

    // Manejo del formulario de eliminación con SweetAlert2
    $('.delete-form').on('submit', function(e) {
        e.preventDefault();
        const form = this;
        Swal.fire({
            title: '¿Está seguro?',
            text: "Esta acción no se puede deshacer.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });

    $('#form-agregar-editar').on('submit', function(e) {
        const idUsuario = $('#id_usuario').val();
        const idRuta = $('#id_ruta').val();

        if (!idUsuario && !idRuta) {
            e.preventDefault();
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Por favor, seleccione un lector y una ruta.',
            });
        } else if (!idUsuario) {
            e.preventDefault();
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Por favor, seleccione un lector.',
            });
        } else if (!idRuta) {
            e.preventDefault();
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Por favor, seleccione una ruta.',
            });
        }
    });

    // Mostrar alertas de éxito o error con SweetAlert2
    if (typeof successMessage !== 'undefined' && successMessage) {
        Swal.fire({
            icon: 'success',
            title: 'Éxito',
            text: successMessage,
        });
    }

    if (typeof errorMessage !== 'undefined' && errorMessage) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: errorMessage,
        });
    }
});
