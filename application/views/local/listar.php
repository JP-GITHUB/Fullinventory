<div class="section-local">
    <h1 class="text-center">Locales</h1>
    <div class="col-md-10">
        <form class="form-inline">
            <div class="form-group">
                <input type="text" class="form-control" id="input-filtro" placeholder="Local">
            </div>
            <button type="button" onclick="buscar_local(true);" class="btn btn-info">Buscar</button>
            <button type="button" id="btn-agregar" onclick="frm_agregar_local();" class="btn btn-success" data-toggle="modal" data-target="#localModal">Agregar Nuevo</button>
        </form>
    </div>
    <br><br>
    <div>
    <?php foreach ($Locales as $item):?>
        <div class="col-sm-4 col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading"><?php echo $item['nombre'];?></div>
                <div class="panel-body">
                    <p>Código: <?php echo $item['codigo'];?></p>
                    <p>Dirección: <?php echo $item['direccion'];?></p>
                    <p>
                        <button type="button" class="btn btn-primary btn-sm" role="button" data-toggle="modal" data-target="#localModal" onclick="frm_departamentos_local('<?php echo $item['codigo'];?>');">Departamentos</button>
                    </p>
                    <p>
                        <a href="#" class="btn btn-warning" role="button" data-toggle="modal" data-target="#localModal" onclick="frm_modificar_local('<?php echo $item['codigo'];?>');">Modificar</a> 
                        <a href="#" class="btn btn-danger" role="button">Deshabilitar</a>
                    </p>
                </div>
            </div>
        </div>
    <?php endforeach;?>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="localModal" tabindex="-1" role="dialog" aria-labelledby="localModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content"></div>
        </div>
    </div>
</div>