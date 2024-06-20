// public/js/app.js

$(document).ready(function() {
    // Inicialización de Select2
    $('.select2').select2({
        placeholder: "Seleccione una opción",
        allowClear: true,
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
        if (formToSubmit) {
            formToSubmit.submit();
        }
    });

    $('.edit-btn').on('click', function() {
        const id = $(this).data('id');
        $.get(`/app-lector-ruta/${id}/edit`, function(data) {
            const appLectorRuta = data.appLectorRuta;
            const usuarios = data.usuarios;
            const rutas = data.rutas;

            // Populate select options
            $('#edit_id_usuario').empty().append('<option value="">Seleccione Lector</option>');
            usuarios.forEach(usuario => {
                $('#edit_id_usuario').append(`<option value="${usuario.id}">${usuario.nombre}</option>`);
            });

            $('#edit_id_ruta').empty().append('<option value="">Seleccione Ruta</option>');
            rutas.forEach(ruta => {
                $('#edit_id_ruta').append(`<option value="${ruta.id}">${ruta.nombre}</option>`);
            });

            // Set selected values
            $('#edit_id_usuario').val(appLectorRuta.id_usuario);
            $('#edit_id_ruta').val(appLectorRuta.id_ruta);

            // Update form action
            $('#editForm').attr('action', `/app-lector-ruta/${appLectorRuta.id}`);

            $('#editionModal').modal('show');
        });
    });
});

