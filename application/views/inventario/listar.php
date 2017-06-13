<div>
    <div class="section-inventario">
        <h1 class="text-center">Inventario</h1>
        <div class="col-md-10">
            <form class="form-inline">
                <div class="form-group">
                    <input type="text" class="form-control" id="input-filtro" placeholder="Producto">
                </div>
                <button type="button" class="btn btn-info">Buscar</button>
            </form>
        </div>
        <br><br>
        <div>
         <?php foreach ($Registros as $item):?>
            <div class="col-sm-4 col-md-3">
                <div class="panel panel-default">
                    <div class="panel-heading"><?php echo $item['nombre'];?> <small><?php echo $item['descripcion'];?></small></div>
                    <div class="panel-body">
                        <p>Código: <?php echo $item['codigo'];?></p>
                        <p>Ultimo Inventario: <?php echo $item['fecha_movimiento'];?></p>
                        <p>Cantidad Total: <?php echo $item['cantidad'];?></p>
                        <p>
                            <a href="#" class="btn btn-warning pull-right" onclick="mostrar_historial('<?php echo $item['codigo'];?>', '<?php echo $item['departamento_codigo'];?>');">Ver historial</a> 
                        </p>
                    </div>
                </div>
            </div>
        <?php endforeach;?>
        </div>
    </div>
    <div class="section-historial hidden"></div>
</div>
