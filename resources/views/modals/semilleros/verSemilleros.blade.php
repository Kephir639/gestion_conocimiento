<div class="modal fade" id="modalVerSemillero" tabindex="-1" aria-labelledby="modalVerSemilleroLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalVerSemilleroLabel">Lista de Semilleros</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Tabla de semilleros -->
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            
                            <th>Nombre</th>
                            <th>Iniciales</th>
                            <th>Fecha de Creación</th>
                            <th>Misión</th>
                            <th>Visión</th>
                            <th>Objetivo General</th>
                            <th>Objetivos Específicos</th>
                            
                        </tr>
                    </thead>
                    <tbody id="tablaSemilleros">
                        <!-- Aquí se inyectarán los datos dinámicamente -->
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>