<div class="section-departamento">
    <h1 class="text-center">Departamentos</h1>
    <div class="col-md-10">
        <form class="form-inline">
            <input type="hidden" id="depto-codlocal" value="<?php echo $local;?>"/>
            <!--
            <div class="form-group">
                <input type="text" class="form-control" id="input-filtro" placeholder="Local">
            </div>
            <button type="button" onclick="buscar_departamento(true);" class="btn btn-info">Buscar</button>
            -->
            <button type="button" onclick="frm_agregar_departamento();" class="btn btn-success">Agregar Nuevo</button>
        </form>
    </div>
    <br><br>
    <div>
    
    <div class="row" style="padding:5px">
        <?php if(count($Departamentos) === 0):?>
            <p class="text-center">Sin locales para mostrar...</p>
        <?php endif;?>

        <?php foreach ($Departamentos as $item):?>
            <div class="col-sm-12 col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading"></div>
                    <div class="panel-body">
                        <p>Código: <?php echo $item['codigo'];?></p>
                        <p>Nombre: <?php echo $item['nombre'];?></p>
                        <p>
                            <a href="#" class="btn btn-warning" role="button" onclick="frm_modificar_departamento('<?php echo $item['codigo'];?>');">Modificar</a> 
                            <a href="#" class="btn btn-danger" role="button">Deshabilitar</a>
                        </p>
                    </div>
                </div>
            </div>
        <?php endforeach;?>
        </div>

        <!--button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>-->
    </div>
</div>