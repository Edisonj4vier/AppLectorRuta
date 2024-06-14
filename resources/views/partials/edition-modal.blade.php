<!-- Modal de Edición -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Editar Usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="edit_id_usuario" class="form-label">Lector</label>
                        <select class="form-select select2" id="edit_id_usuario" name="id_usuario">
                            <option value="">Seleccione Lector</option>
                            @foreach ($usuarios as $usuario)
                                <option value="{{ $usuario->id }}">{{ $usuario->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="edit_id_ruta" class="form-label">Ruta</label>
                        <select class="form-select select2" id="edit_id_ruta" name="id_ruta">
                            <option value="">Seleccione Ruta</option>
                            @foreach ($rutas as $ruta)
                                <option value="{{ $ruta->id }}">{{ $ruta->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="saveChanges">Guardar</button>
            </div>
        </div>
    </div>
</div>
