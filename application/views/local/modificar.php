<div style="padding:20px;">
	<form>
		<h2>Modificar Local</h2>
		<div class="form-group">
			<label for="">Código</label>
			<input type="text" class="form-control" id="codigo-producto" placeholder="Código">
		</div>
		<div class="form-group">
			<label for="">Nombre</label>
			<input type="text" class="form-control" id="nombre-producto" placeholder="Nombre">
		</div>
		<div class="form-group">
			<label for="">Dirección</label>
			<input type="text" class="form-control" id="direccion-producto" placeholder="Dirección">
		</div>
        <div class="form-group">
            <label for="">Comuna</label>
			<select class="form-control" id ="comuna"> 
            <?php foreach($Comunas as $comuna) { ?>
                <option value="<?php echo $comuna['id']?>"><?php echo $comuna['nombre']?></option>          
            <?php } ?>
            </select>
		</div>
		<div class="form-groupr">
			<button type="button" id="btn-guardar-producto" class="btn btn-warning">Guardar</button>
			<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>		
		</div>
	</form>
</div>