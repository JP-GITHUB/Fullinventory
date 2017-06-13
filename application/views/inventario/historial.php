<br/>
<div class="col-xs-12 col-sm-9 col-md-9">
    <h1 class="text-center">Historial</h1>

    <div class="col-xs-12 col-sm-7 col-md-7">
        <div class="panel panel-default center_div">
            <div class="panel-body">
                <table id="example" class="display" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Tipo</th>
                            <th>Fecha Movimiento</th>
                            <th>Cantidad</th>
                        </tr>
                    </thead>
                    <tbody>
                        <% for(var i=0; i<historial.length; i++) { %>
                        <tr>
                            <td><%= historial[i].descripcion %></td>
                            <td><%= historial[i].fecha_movimiento %></td>
                            <td><%= historial[i].cantidad %></td>
                        </tr>
                        <% } %>                          
                    </tbody>
                </table>
            </div>
        </div>  
    </div>
    <div class="col-xs-12 col-sm-5 col-md-5">
        <div class="panel panel-default center_div">
            <div class="panel-body">
                <div id="container" style="min-width: 310px; height: 385px; margin: 0 auto"></div>
            </div>
        </div>    
    </div>
</div>

<div class="col-xs-12 col-sm-9 col-md-9">
    <br/>  
    <a href="#" id="btn-volver-inventario" class="btn btn-default">Volver</a> 
</div>