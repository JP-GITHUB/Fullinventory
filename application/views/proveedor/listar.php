<div class="section-proveedores">
    <h1 class="text-center">Proveedores</h1>
    <div class="col-md-10">
        <form class="form-inline">
            <div class="form-group">
                <input type="text" class="form-control" id="input-filtro" placeholder="Proveedor">
            </div>
            <button type="button" onclick="buscar_proveedor();" class="btn btn-info">Buscar</button>
            <button type="button" id="btn_agregar_proveedor" onclick="show_frm_agregar_proveedor();" class="btn btn-success" data-toggle="modal" data-target="#contenModal">Agregar Nuevo</button>
        </form>
    </div>
    <br><br>
    <div>
    <?php if(count($proveedores) > 0) {
        
        foreach ($proveedores as $proveedor):?>
            <div class="col-sm-4 col-md-3">
                <div class="panel panel-default">
                    <div class="panel-heading"><?php echo $proveedor['nombre'];?></div>
                    <div class="panel-body">
                        <p>Código: <?php echo $proveedor['codigo'];?></p>
                        <p>Teléfono: <?php echo $proveedor['numero_telefonico'];?></p>
                        <p>
                            <a href="#" class="btn btn-warning" role="button" data-toggle="modal" data-target="#contenModal" onclick="modificar_proveedor('<?php echo $proveedor['codigo'];?>');">Modificar</a> 
                            <a href="#" class="btn <?php echo (($proveedor['id_estado'] == '1') ? 'btn-danger' : 'btn-success'); ?>" role="button" onclick="cambiar_estado_proveedor('<?php echo $proveedor['codigo'];?>','<?php echo $proveedor['id_estado'];?>');"><?php echo (($proveedor['id_estado'] == '1') ? 'Desactivar' : 'Activar'); ?></a>
                        </p>
                    </div>
                </div>
            </div>
        <?php endforeach; 
        } else {?>
        <div class="col-sm-3 col-md-3"></div>
        <div class="col-sm-6 col-md-6">
            <h5>No se han encontrado resultados...</h5>
        </div>
    <?php }?>
    </div>    
</div>