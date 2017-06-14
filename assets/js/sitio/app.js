'use strict';
var Aviso;

$(document).ready(function () {
    inicializar_box();
    $('#aside-productos a').click(function (e) {
        e.preventDefault();
        $("#content-web").load("Producto/listar", function () { });
    });

    $('#aside-inventario a').click(function (e) {
        e.preventDefault();
        $("#content-web").load("Inventario/listar", function () { });
    });

   $('#aside-locales a').click(function (e) {
        e.preventDefault();
        $("#content-web").load("Local/listar", function () { });
    });

    $('#aside-proveedores a').click(function (e) {
        e.preventDefault();
        $("#content-web").load("", function () { });
    });
});

/** Productos */
function frm_agregar_producto() {
    $(".modal-content").load("Producto/agregar", function () {
        $("#btn-guardar-producto").click(function (e) {
            e.preventDefault();
            guardar_producto();
        });
    });
}

function frm_modificar_producto(codigo_producto) {
    $(".modal-content").load("Producto/modificar", {"codigo_producto" : codigo_producto}, function () {
        $("#btn_guardar_cambios").click(function (e) {
            e.preventDefault();
            modificar_producto();
        });
    });
}

function agregar_producto() {
    var producto = {};
    producto.codigo = $("#codigo-producto").val();
    producto.nombre = $("#nombre-producto").val();
    producto.descripcion = $("#descripcion-producto").val();
    producto.imagen = $("#imagen-producto").val();
    producto.cantidad = $("#cantidad-producto").val();
    producto.codproveedor = $("#codproveedor-producto").val();

    $.ajax({
        method: "POST",
        url: "Producto/agregar_producto",
        data: producto
    })
    .done(function (obj) {
        if (obj.estado) {
            $('#productosModal').modal('hide');
            buscar_productos();
            Aviso.show("Producto Ingresado Correctamente", "success");
        } else {
            Aviso.show(obj.mensaje, "danger");
        }
    });
}

function recargar_productos() {
    $("#content-web").load("Producto/listar");
}

function modificar_producto() {
    var producto = {};
    producto.codigo = $("#codigo-producto").val();
    producto.nombre = $("#nombre-producto").val();
    producto.descripcion = $("#descripcion-producto").val();
    producto.imagen = $("#imagen-producto").val();
    producto.cantidad = $("#cantidad-producto").val();
    producto.codproveedor = $("#codproveedor-producto").val();

    $.ajax({
        method: "POST",
        url: "Producto/modificar_producto",
        data: producto
    })
    .done(function (obj) {
        if (obj.estado) {
            $('#productosModal').modal('hide');
            Aviso.show(obj.mensaje, "success");
            buscar_productos();

        } else {
            Aviso.show(obj.mensaje, "danger");
        }
    });
}

function buscar_productos() {
    var input_filtro = $("#input-filtro").val();
    
    if(input_filtro == ""){
        recargar_productos();
    }else{
        $.ajax({
            method: "POST",
            url: "Producto/buscar_productos",
            data: {filtro: input_filtro}
        })
        .done(function (obj) {
            $("#content-web").html(obj);
        });
    }
}
/** Fin Productos */

/** Locales */
function frm_agregar_local() {
    $("#localModal .modal-content").load("Local/agregar", function () {
        $("#btn-guardar-local").click(function (e) {
            e.preventDefault();
            agregar_local();
        });
    });
}

function frm_modificar_local(codigo_local) {
    $("#localModal .modal-content").load("Local/modificar", {"codigo_local" : codigo_local});
}

function frm_departamentos_local(codigo_local) {
    $("#localModal .modal-content").load("Departamento/listar", {"local" : codigo_local}, function () {});
}

function agregar_local() {
    var local = {};
    local.codigo = $("#codigo-local").val();
    local.nombre = $("#nombre-local").val();
    local.direccion = $("#direccion-local").val();
    local.comuna = $("#comuna-local").val();

    $.ajax({
        method: "POST",
        url: "Local/agregar_local",
        data: local
    })
    .done(function (obj) {
        if (obj.estado) {
            $('#localModal').modal('hide');
            $("#content-web").load("Local/listar");
            Aviso.show("Local Ingresado Correctamente", "success");
        } else {
            Aviso.show(obj.mensaje, "danger");
        }
    });
}
/** Fin locales */

/** Departamento */
function frm_agregar_departamento() {
    var local = $("#depto-codlocal").val();
    $("#localModal .modal-content").load("Departamento/agregar", function () {
        $("#btn-volver-departamentos").click(function (e) {
            $("#localModal .modal-content").load("Departamento/listar", {"local" : local});
        });
        /*$("#btn-guardar-local").click(function (e) {
            e.preventDefault();
            agregar_departamento();
        });*/
    });
}

function frm_modificar_departamento(codigo_departamento) {
    var local = $("#depto-codlocal").val();
    $("#localModal .modal-content").load("Departamento/modificar", {"codigo_departamento" : codigo_departamento}, function(){
        $("#btn-volver-departamentos").click(function (e) {
            $("#localModal .modal-content").load("Departamento/listar", {"local" : local});
        });
    });
}

function agregar_departamento() {
    var local = {};
    local.codigo = $("#codigo-local").val();
    local.nombre = $("#nombre-local").val();
    local.direccion = $("#direccion-local").val();
    local.comuna = $("#comuna-local").val();

    $.ajax({
        method: "POST",
        url: "Departamento/agregar_departamento",
        data: local
    })
    .done(function (obj) {
        if (obj.estado) {
            $('#localModal').modal('hide');
            $("#content-web").load("Departamento/listar");
            Aviso.show("Local Ingresado Correctamente", "success");
        } else {
            Aviso.show(obj.mensaje, "danger");
        }
    });
}
/** Fin Departamento */

function mostrar_historial(producto, departamento) {
    $(".section-historial").load("/inventario/historial/" + departamento + "/" + producto, function () {
        $('#example').DataTable({
            "columns": [
                { "data": "tipo" },
                { "data": "fecha_movimiento" },
                { "data": "cantidad" }
            ],
            "scrollX": "100%",
            "scrollCollapse": true,
            "searching": false
        });

        mostrar_grafico();

        $(".section-inventario").addClass("hidden");
        $(".section-historial").removeClass("hidden");

        $("#btn-volver-inventario").click(function () {
            $(".section-inventario").removeClass("hidden");
            $(".section-historial").addClass("hidden");
        });
    });
}

function mostrar_grafico() {

    //Obtener info Grafico.

    Highcharts.chart('container', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Grafico de Movimientos'
        },
        /*subtitle: {
            text: 'Source: WorldClimate.com'
        },*/
        xAxis: {
            categories: [
                'Ene',
                'Feb',
                'Mar',
                'Abr',
                'May',
                'Jun',
                'Jul',
                'Ago',
                'Sep',
                'Oct',
                'Nov',
                'Dic'
            ],
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Cantidades'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: 'Ventas',
            data: [49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4]

        }, {
            name: 'Mermas',
            data: [83.6, 78.8, 98.5, 93.4, 106.0, 84.5, 105.0, 104.3, 91.2, 83.5, 106.6, 92.3]

        }, {
            name: 'Total',
            data: [48.9, 38.8, 39.3, 41.4, 47.0, 48.3, 59.0, 59.6, 52.4, 65.2, 59.3, 51.2]

        }]
    });
}


function inicializar_box(){
    Aviso = (function () {
        var elem,
            hideHandler,
            that = {};

        that.init = function (options) {
            elem = $(options.selector);
        };

        that.show = function (text, tipo) {
            clearTimeout(hideHandler);
            elem.removeClass("alert-warning alert-success alert-danger alert-alert alert-info");

            switch (tipo) {
                case 'success':
                    elem.addClass("alert-success");
                    break;
                case 'warning':
                    elem.addClass("alert-warning");
                    break;
                case 'danger':
                    elem.addClass("alert-danger");
                    break;
                case 'alert':
                    elem.addClass("alert-alert");
                    break;
                case 'info':
                default:
                    elem.addClass("alert-info");
                    break;
            }
            elem.find("span").html(text);
            elem.delay(200).fadeIn().delay(2000).fadeOut();
        };

        return that;
    }());

    Aviso.init({
        "selector": ".bb-alert"
    });
}