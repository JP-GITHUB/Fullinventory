<div style="padding:20px;">
	<form>
		<h2>Agregar Producto</h2>
		<div class="col-md-12">
			<div class="form-group">
				<label for="">Código</label>
				<input type="text" class="form-control" id="codigo_producto" placeholder="Código">
			</div>
		</div>
		<div class="col-md-12">
			<div class="form-group">
				<label for="">Nombre</label>
				<input type="text" class="form-control" id="nombre_productos" placeholder="Nombre">
			</div>
		</div>		
		<div class="col-md-9">
			<div class="form-group">
				<label for="">Descripción</label>
				<input type="text" class="form-control" id="descripcion_producto" placeholder="Descripción">
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group">
				<label for="">Cantidad</label>
				<input type="number" class="form-control" id="cantidad_producto" placeholder="Cantidad">
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label for="">Departamento</label>
				<select class="form-control" id="departamento_producto">
				<?php foreach($departamentos as $departamento) { ?>
					<option value="<?php echo  $departamento['codigo']; ?>"><?php echo  $departamento['nombre']; ?></option>
				<?php } ?>
				</select>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label for="">Cod. Proveedor</label>
				<select class="form-control" id="codproveedor_producto">
				<?php foreach($proveedores as $proveedor) { ?>
					<option value="<?php echo  $proveedor['codigo']; ?>"><?php echo  $proveedor['nombre']; ?></option>
				<?php } ?>
				</select>
			</div>
		</div>
		
		<div class="col-md-12">
			<div class="form-group">
				<label for="">Seleccione Imagen</label>
				<label class="field prepend-icon append-button file">
					<input type="file" id="archivo_imagen" accept="image/*" name="file1">								
				</label>
			</div>
		</div>			
		
		<div class="form-group">
			<button type="button" id="btn-guardar-producto" class="btn btn-warning">Guardar</button>
			<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
		</div>
	</form>
</div>