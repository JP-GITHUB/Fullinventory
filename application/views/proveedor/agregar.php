<div style="padding:20px;">
	<form>
		<h2>Agregar Proveedor</h2>
		<div class="form-group">
			<label for="">Código</label>
			<input type="text" class="form-control" id="codigo_proveedor" placeholder="Código">
		</div>
		<div class="form-group">
			<label for="">Nombre</label>
			<input type="text" class="form-control" id="nombre_proveedor" placeholder="Nombre">
		</div>
        <div class="form-group">
			<label for="">Teléfono</label>
			<input type="text" class="form-control" id="telefono_proveedor" placeholder="Teléfono">
		</div>
		<div class="form-group">
			<label for="">Dirección</label>
			<input type="text" class="form-control" id="direccion_proveedor" placeholder="Dirección">
		</div>
		<div class="form-group">
            <label for="">Comuna</label>
			<select class="form-control" id ="comuna_proveedor"> 
            <?php foreach($comunas as $comuna) { ?>
                <option value="<?php echo $comuna['id']?>"><?php echo $comuna['nombre']?></option>          
            <?php } ?>
            </select>
		</div>
		<div class="form-groupr">
			<button type="button" id="btn_guardar_proveedor" class="btn btn-warning">Guardar</button>
			<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>		
		</div>
	</form>
</div>