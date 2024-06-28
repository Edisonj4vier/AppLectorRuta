$(document).ready(function() {
    // Inicialización de Select2
    $('.select2').select2({
        placeholder: "Seleccione una opción",
        allowClear: true,
        width: '100%'
    });

    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');
        $('#content').toggleClass('active');
    });


    $(document).ready(function() {
        $('#sincronizar').click(function() {
            // Lógica para sincronizar
            alert('Sincronizando...');
        });
        $('#agregarLectura').click(function() {
            // Lógica para agregar lectura
            alert('Agregando lectura...');
        });
    });    // Cerrar alertas automáticamente después de 5 segundos
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
    $('.delete-btn').click(function() {
        var usuarioId = $(this).data('usuario-id');
        if (confirm('¿Estás seguro de que quieres eliminar todas las asignaciones de este usuario?')) {
            $.ajax({
                url: '{{ route("app-lector-ruta.destroy") }}',
                type: 'DELETE',
                data: {
                    usuario_id: usuarioId,
                    _token: '{{ csrf_token() }}'
                },
                success: function(result) {
                    if (result.success) {
                        alert(result.message);
                        location.reload();
                    } else {
                        alert('Error: ' + result.message);
                    }
                },
                error: function(xhr) {
                    alert('Error: ' + xhr.responseJSON.message);
                }
            });
        }
    });

    $('#editForm').on('submit', function(e) {
        e.preventDefault();
        const form = $(this);
        const url = form.attr('action');
        const method = 'PUT';
        const data = form.serialize();

        $.ajax({
            url: url,
            method: method,
            data: data,
            success: function(response) {
                if (response.success) {
                    const row = $('tr[data-id="' + response.id + '"]');
                    row.find('td:eq(2)').text(response.usuario);
                    row.find('td:eq(3)').text(response.ruta);
                    $('#editionModal').modal('hide');
                    Swal.fire({
                        icon: 'success',
                        title: 'Éxito',
                        text: response.message,
                    });
                    fetchData(1);
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: response.message,
                    });
                }
            },
            error: function(xhr) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: xhr.responseJSON ? xhr.responseJSON.message : 'Hubo un problema al actualizar el registro.',
                });
            }
        });
    });

    // Manejo del formulario de eliminación
    $('.delete-form').on('submit', function(e) {
        e.preventDefault();
        const form = $(this);
        const url = form.attr('action');

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
                $.ajax({
                    url: url,
                    method: 'DELETE',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.success) {
                            form.closest('tr').remove();
                            Swal.fire({
                                icon: 'success',
                                title: 'Éxito',
                                text: response.message,
                            });
                            if ($('#appLectorRutaTable tbody tr').length === 0) {
                                $('#appLectorRutaTable').hide();
                                $('<p class="text-center">No hay rutas registradas. Agregue una nueva ruta para mostrar la tabla.</p>').insertAfter('#appLectorRutaTable');
                            }
                            fetchData(1);
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: response.message,
                            });
                        }
                    },
                    error: function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Hubo un problema al comunicarse con el servidor.',
                        });
                    }
                });
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
    // Manejo de la paginación
    $(document).on('click', '.pagination a', function(e) {
        e.preventDefault();
        let page = $(this).attr('href').split('page=')[1];
        fetchData(page);
    });

    function fetchData(page) {
        $.ajax({
            url: '/app-lector-ruta?page=' + page,
            success: function(data) {
               $('#table-container').html(data);
            }
        });
    }
    const table = document.querySelector('table');
    const editModal = new bootstrap.Modal(document.getElementById('editModal'));

    table.addEventListener('click', function(e) {
        const target = e.target.closest('button');
        if (!target) return;

        const row = target.closest('tr');
        const id = row.dataset.id;

        if (target.classList.contains('edit-btn')) {
            // Lógica para editar
            document.getElementById('editId').value = id;
            document.getElementById('editLectura').value = row.cells[8].textContent;
            document.getElementById('editObservacion').value = row.cells[11].textContent;
            editModal.show();
        } else if (target.classList.contains('delete-btn')) {
            // Lógica para eliminar
            Swal.fire({
                title: '¿Estás seguro?',
                text: "No podrás revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminar!'
            }).then((result) => {
                if (result.isConfirmed) {
                    deleteLectura(id);
                }
            });
        }
    });

    document.getElementById('saveEdit').addEventListener('click', function() {
        const id = document.getElementById('editId').value;
        const lectura = document.getElementById('editLectura').value;
        const observacion = document.getElementById('editObservacion').value;
        updateLectura(id, lectura, observacion);
    });

    function updateLectura(id, lectura, observacion) {
        $.ajax({
            url: `/lecturas/${id}`,
            method: 'PUT',
            data: {
                lectura: lectura,
                observacion: observacion,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
                if (data.success) {
                    Swal.fire('Actualizado!', 'La lectura ha sido actualizada.', 'success');
                    editModal.hide();
                    // Actualizar la fila en la tabla
                    const row = $(`tr[data-id="${id}"]`);
                    row.find('td:eq(8)').text(lectura);
                    row.find('td:eq(11)').text(observacion);
                } else {
                    Swal.fire('Error!', 'Hubo un problema al actualizar la lectura.', 'error');
                }
            },
            error: function() {
                Swal.fire('Error!', 'Hubo un problema al comunicarse con el servidor.', 'error');
            }
        });
    }

    function deleteLectura(id) {
        $.ajax({
            url: `/lecturas/${id}`,
            method: 'DELETE',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
                if (data.success) {
                    Swal.fire('Eliminado!', 'La lectura ha sido eliminada.', 'success');
                    // Eliminar la fila de la tabla
                    $(`tr[data-id="${id}"]`).remove();
                } else {
                    Swal.fire('Error!', 'Hubo un problema al eliminar la lectura.', 'error');
                }
            },
            error: function() {
                Swal.fire('Error!', 'Hubo un problema al comunicarse con el servidor.', 'error');
            }
        });
    }
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
