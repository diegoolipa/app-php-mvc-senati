<!-- views/producto/index.php -->
<div class="row mb-4">
    <div class="col">
        <h2>Listado de Tipo Documentos</h2>
    </div>
    <div class="col text-end">
        <a href="<?= BASE_URL ?>/reports/pdf" class="btn btn-secondary">
            <i class="fas fa-file-pdf"></i> Exportar PDF
        </a>
        <a href="<?= BASE_URL ?>/reports/excel" class="btn btn-success">
            <i class="fas fa-file-excel"></i> Exportar Excel
        </a>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#TipoDocumentoModal">
            <i class="fas fa-plus"></i> Nuevo Tipo Documento
        </button>
    </div>
</div>

<!-- Filtros -->
<div class="shadow-none p-3 mb-5 bg-body-tertiary rounded">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="fas fa-search"></i>
                    </span>
                    <input
                        type="text"
                        class="form-control"
                        id="searchProduct"
                        placeholder="Buscar producto por nombre..."
                        onkeyup="searchProducts(event)">
                    <button class="btn btn-outline-secondary" type="button" onclick="clearSearch()">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="table-responsive">
    <table class="table table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Sigla</th>
                <th>Orden</th>
                <th>Fecha Creación</th>
                <th>Fecha Actualización</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody id="tablaTipoDocumento">
            <!-- Los productos se cargarán aquí dinámicamente -->
        </tbody>
    </table>
</div>


<!-- Modal para Crear/Editar Producto -->
<div class="modal fade" id="TipoDocumentoModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Nuevo Tipo Documento</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="tipoDocumentoForm">
                    <input type="hidden" id="tipoDocumentoId">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="sigla" class="form-label">Sigla</label>
                        <input type="text" class="form-control" id="sigla" required>
                    </div>
                    <div class="mb-3">
                        <label for="orden" class="form-label">Orden</label>
                        <input type="number" class="form-control" id="orden" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times"></i> Cerrar
                </button>
                <button type="button" class="btn btn-primary" onclick="crear()">
                    <i class="fas fa-save"></i> Guardar
                </button>
            </div>
        </div>
    </div>
</div>