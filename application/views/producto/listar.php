<div class="section-productos">
    <h1 class="text-center">Productos</h1>
    <div class="col-md-10">
        <form class="form-inline">
            <div class="form-group">
                <input type="text" class="form-control" id="input-filtro" placeholder="Producto">
            </div>
            <button type="button" onclick="buscar_productos(true);" class="btn btn-info">Buscar</button>
            <button type="button" id="btn-agregar" onclick="frm_agregar_producto();" class="btn btn-success" data-toggle="modal" data-target="#productosModal">Agregar Nuevo</button>
        </form>
    </div>
    <br><br>
    <div>
    <?php foreach ($Productos as $item):?>
        <div class="col-sm-4 col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading head-panel-productos"><?php echo $item['nombre'];?> <small><?php echo $item['descripcion'];?></small></div>
                <div class="panel-body">
                    <p>Código: <?php echo $item['codigo'];?></p>
                    <p>
                        <a href="#" class="btn btn-warning" role="button" data-toggle="modal" data-target="#productosModal" onclick="frm_modificar_producto('<?php echo $item['codigo'];?>');">Modificar</a> 
                        <a href="#" class="btn btn-danger" role="button">Eliminar</a>
                    </p>
                </div>
            </div>
        </div>
    <?php endforeach;?>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="productosModal" tabindex="-1" role="dialog" aria-labelledby="productosModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content"></div>
        </div>
    </div>
</div>