<div style="padding:20px;">
	<form>
		<h2>Modificar Departamento</h2>
		<div class="form-group">
			<label for="">Código</label>
			<input type="text" class="form-control" id="codigo_departamento" placeholder="Código" readonly value="<?php echo $departamento['codigo']; ?>">
		</div>
		<div class="form-group">
			<label for="">Nombre</label>
			<input type="text" class="form-control" id="nombre_departamento" placeholder="Nombre" value="<?php echo $departamento['nombre']; ?>">
		</div>
		
		<div class="form-groupr">
			<button type="button" id="btn_guardar_cambios_departamento" class="btn btn-warning">Guardar</button>
			<button type="button" id="btn-volver-departamentos" class="btn btn-default">Volver</button>	
		</div>
	</form>
</div>