<div style="padding:20px;">
    <form>
        <h2>Modificar Producto</h2>
        <div class="form-group">
            <label for="">Código</label>
            <input type="text" class="form-control" id="codigo-producto" readonly placeholder="Código" value="<%= producto.codigo %>">
        </div>
        <div class="form-group">
            <label for="">Nombre</label>
            <input type="text" class="form-control" id="nombre-producto" placeholder="Nombre" value="<%= producto.nombre %>">
        </div>
        <div class="form-group">
            <label for="">Descripción</label>
            <input type="text" class="form-control" id="descripcion-producto" placeholder="Descripción" value="<%= producto.descripcion %>">
        </div>
        <div class="form-group">
            <label for="">Imagen</label>
            <input type="text" class="form-control" id="imagen-producto" placeholder="Imagen" value="<%= producto.imagen %>">
        </div>
        <div class="form-group">
            <label for="">Cantidad</label>
            <input type="number" class="form-control" id="cantidad-producto" placeholder="Cantidad" value="<%= producto.cantidad_minima %>">
        </div>
        <div class="form-group">
            <label for="">Cod. Proveedor</label>
            <select class="form-control" id="codproveedor-producto">
                <% for(var i=0; i<proveedores.length; i++) { %>
                    <option value="<%= proveedores[i].codigo %>"><%= proveedores[i].nombre %></option>
                <% } %>
            </select>            
        </div>
        <div class="form-groupr">
            <button type="button" id="btn_guardar_cambios" class="btn btn-warning">Guardar</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>
    </form>
</div>