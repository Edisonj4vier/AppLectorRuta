<!-- resources/views/partials/edition-modal.blade.php -->

<div class="modal fade" id="editionModal" tabindex="-1" aria-labelledby="editionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="editionModalLabel">Editar Ruta del Lector</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit_id_usuario" class="form-label">Lector</label>
                        <select class="form-select" id="edit_id_usuario" name="id_usuario">
                            <option value="">Seleccione Lector</option>
                            <!-- Options will be populated by JS -->
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="edit_id_ruta" class="form-label">Ruta</label>
                        <select class="form-select" id="edit_id_ruta" name="id_ruta">
                            <option value="">Seleccione Ruta</option>
                            <!-- Options will be populated by JS -->
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>
