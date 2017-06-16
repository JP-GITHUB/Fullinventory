<div class="section-productos">
    <h1 class="text-center">Productos</h1>
    <div class="col-md-10">
        <form class="form-inline">
            <div class="form-group">
                <input type="text" id="nombre_producto" class="form-control" id="" placeholder="Producto">
            </div>
            <button type="button" onclick="buscar_productos();" class="btn btn-info">Buscar</button>
            <button type="button" id="btn-agregar" class="btn btn-success" onclick="frm_agregar_producto();" data-toggle="modal" data-target="#contentModal">Agregar Nuevo</button>
        </form>
    </div>
    <br><br>
    <div id="listado_productos">       

    </div>    
</div>