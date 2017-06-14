<div style="padding:20px;">
	<form>
		<h2>Agregar Local</h2>
		<div class="form-group">
			<label for="">Código</label>
			<input type="text" class="form-control" id="codigo-local" placeholder="Código">
		</div>
		<div class="form-group">
			<label for="">Nombre</label>
			<input type="text" class="form-control" id="nombre-local" placeholder="Nombre">
		</div>
		<div class="form-group">
			<label for="">Dirección</label>
			<input type="text" class="form-control" id="direccion-local" placeholder="Dirección">
		</div>
        <div class="form-group">
            <label for="">Comuna</label>
			<select class="form-control" id ="comuna-local"> 
            <?php foreach($Comunas as $comuna) { ?>
                <option value="<?php echo $comuna['id']?>"><?php echo $comuna['nombre']?></option>          
            <?php } ?>
            </select>
		</div>
		<div class="form-group">
			<button type="button" id="btn-guardar-local" class="btn btn-warning">Guardar</button>
			<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>		
		</div>
	</form>
</div>