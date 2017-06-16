<div class="section-productos">
    <h1 class="text-center">Productos</h1>
    <div class="col-md-10">
        <form class="form-inline">
            <div class="form-group">
                <input type="text" id="nombre_producto" class="form-control" id="" placeholder="Producto">
            </div>
            <button type="button" onclick="buscar_productos(true);" class="btn btn-info">Buscar</button>
            <button type="button" id="btn-agregar" class="btn btn-success" onclick="agregar_producto();" data-toggle="modal" data-target="#productosModal">Agregar Nuevo</button>
        </form>
    </div>
    <br><br>
    <div id="listado_productos">       

    </div>

    <!-- Modal -->
    <div class="modal fade" id="productosModal" tabindex="-1" role="dialog" aria-labelledby="productosModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content"></div>
        </div>
    </div>
</div>