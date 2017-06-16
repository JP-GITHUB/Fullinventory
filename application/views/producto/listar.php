   <?php if(count($productos) === 0):?>
            <p class="text-center">No se han encontrado resultados...</p>
    <?php endif;?>
    <?php foreach ($productos as $producto):?>
        <div class="col-sm-4 col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <?php echo $producto['nombre'];?>
                </div>
                    <div class="panel-body">
                    <div class="col-sm-1 col-md-1"></div>
                    <div class="col-sm-10 col-md-10">
                        <img src="<?php echo base_url('assets/images/' .$producto['imagen'] )?>" style="width:100%px;height:150px;">
                    </div>
                     <p>Código:
                       <?php echo $producto['codigo'];?>
                    </p>
                    <p><small><?php echo $producto['descripcion'];?></small></p>
                    <p>
                        <a href="#" class="btn btn-warning" data-toggle="modal" data-target="#contentModal" onclick="modificar_producto('<?php echo $producto['codigo'];?>');"
                            role="button">Modificar</a>
                        <a href="#" class="btn btn-danger" role="button">Eliminar</a>
                    </p>
                </div>
            </div>
        </div>
    <?php endforeach;?>