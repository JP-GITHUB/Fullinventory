'use strict';
var Aviso;

Aviso = (function () {
    "use strict";
    var elem = $(".bb-alert");
    var hideHandler, that = {};
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
        $("#content-web").load("Proveedor/listar", function () { });
    });
});


//Proveedores

function show_frm_agregar_proveedor() {

    $(".modal-content").load("Proveedor/agregar", function () {

        $("#codigo_proveedor").blur(function () {
            if (existe_proveedor(this.value)) {

                this.value = '';
                Aviso.show('El código ingresado ya existe', "danger");
            }
        });

        $("#btn_guardar_proveedor").click(function (e) {
            e.preventDefault();
            agregar_proveedor();
        });
    });
}

function existe_proveedor(codigo) {

    var proveedor = {};
    var existe = false;

    proveedor.codigo = codigo;

    $.ajax({
        method: "POST",
        url: "Proveedor/existe_proveedor",
        data: proveedor,
        async: false
    })
        .done(function (obj) {

            existe = obj.existe;
        });
    return existe;
}

function agregar_proveedor() {
    var proveedor = {};
    proveedor.codigo = $("#codigo_proveedor").val();
    proveedor.nombre = $("#nombre_proveedor").val();
    proveedor.telefono = $("#telefono_proveedor").val();
    proveedor.direccion = $("#direccion_proveedor").val();
    proveedor.comuna = $("#comuna_proveedor").val();

    $.ajax({
        method: "POST",
        url: "Proveedor/agregar_proveedor",
        data: proveedor
    })
        .done(function (obj) {
            $('#contentModal').modal('hide');
            if (obj.estado) {
                buscar_proveedor();
                Aviso.show(obj.mensaje, "success");
            } else {
                Aviso.show(obj.mensaje, "danger");
            }
        });
}

function buscar_proveedor() {

    var input_filtro = $("#input-filtro").val();

    if (input_filtro == "") {
        recargar_proveedores();
    } else {
        $.ajax({
            method: "POST",
            url: "Proveedor/buscar_proveedor",
            data: { filtro: input_filtro }
        })
            .done(function (obj) {
                $("#content-web").html(obj);
            });
    }

}

function recargar_proveedores() {

    $("#content-web").load("Proveedor/listar");
}

function modificar_proveedor($codigo) {

    var proveedor = {};
    proveedor.codigo = $codigo;

    $.ajax({
        method: "POST",
        url: "Proveedor/modificar_proveedor",
        data: proveedor
    })
        .done(function (obj) {

            $(".modal-content").html(obj);

            $('#btn_guardar_cambios_proveedor').off("click");

            $("#btn_guardar_cambios_proveedor").click(function () {

                guardar_cambios_proveedor();

            });

        });
}

function cambiar_estado_proveedor(codigo, estado) {

    bootbox.addLocale("es", {
        OK: 'SI',
        CANCEL: 'NO',
        CONFIRM: 'SI'
    });
    bootbox.setLocale("es");
    bootbox.confirm({
        message: '¿Esta seguro que desea ' + ((estado == '1') ? 'Desactivar' : 'Activar') + ' el proveedor seleccionado?',
        title: 'Confirmar',
        callback: function (result) {
            if (result) {
                var proveedor = {};
                proveedor.codigo = codigo;
                proveedor.id_estado = estado;

                $.ajax({
                    method: "POST",
                    url: "Proveedor/cambiar_estado_proveedor",
                    data: proveedor
                })
                    .done(function (obj) {
                        if (obj.estado) {
                            buscar_proveedor();
                            Aviso.show(obj.mensaje, "success");
                        } else {
                            Aviso.show(obj.mensaje, "danger");
                        }
                    });
            } else {
                Aviso.show("No se realizaron cambios", "danger");
            }
        }
    });
}

function guardar_cambios_proveedor() {
    var proveedor = {};
    proveedor.codigo = $("#codigo_proveedor").val();
    proveedor.nombre = $("#nombre_proveedor").val();
    proveedor.telefono = $("#telefono_proveedor").val();
    proveedor.direccion = $("#direccion_proveedor").val();
    proveedor.comuna = $("#comuna_proveedor").val();

    $.ajax({
        method: "POST",
        url: "Proveedor/guardar_cambios_proveedor",
        data: proveedor
    })
        .done(function (obj) {
            $('#contentModal').modal('hide');
            if (obj.estado) {
                buscar_proveedor();
                Aviso.show(obj.mensaje, "success");
            } else {
                Aviso.show(obj.mensaje, "danger");
            }
        });
}

/** Productos */
function frm_agregar_producto() {
    $(".modal-content").load("Producto/agregar", function () {
        $("#btn-guardar-producto").click(function (e) {
            e.preventDefault();
            agregar_producto();
        });
    });
}

function frm_modificar_producto(codigo_producto) {
    $(".modal-content").load("Producto/modificar", { "codigo_producto": codigo_producto }, function () {
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

    if (input_filtro == "") {
        recargar_productos();
    } else {
        $.ajax({
            method: "POST",
            url: "Producto/buscar_productos",
            data: { filtro: input_filtro }
        })
            .done(function (obj) {
                $("#content-web").html(obj);
            });
    }
}
/** Fin Productos */

/** Locales */
function frm_agregar_local() {
    $("#contentModal .modal-content").load("Local/agregar", function () {
        $("#btn-guardar-local").click(function (e) {
            e.preventDefault();
            agregar_local();
        });
    });
}

function buscar_local() {

    var input_filtro = $("#input-filtro").val();

    if (input_filtro == "") {
        recargar_local();
    } else {
        $.ajax({
            method: "POST",
            url: "Local/buscar_local",
            data: { filtro: input_filtro }
        })
            .done(function (obj) {
                $("#content-web").html(obj);
            });
    }
}

function recargar_local() {
    $("#content-web").load("Local/listar");
}

function frm_modificar_local(codigo_local) {
    $("#contentModal .modal-content").load("Local/modificar", { "codigo_local": codigo_local }, function () {

        $('#btn_guardar_local').off("click");

        $('#btn_guardar_local').click(function () {
            guardar_cambios_local();
        });

    });
}

function guardar_cambios_local() {

    var local = {};
    local.codigo = $("#codigo-local").val();
    local.nombre = $("#nombre-local").val();
    local.direccion = $("#direccion-local").val();
    local.comuna = $("#comuna-local").val();

    $.ajax({
        method: "POST",
        url: "Local/guardar_cambios_local",
        data: local
    })
        .done(function (obj) {
            $('#contentModal').modal('hide');
            if (obj.estado) {
                buscar_local();
                Aviso.show(obj.mensaje, "success");
            } else {
                Aviso.show(obj.mensaje, "danger");
            }
        });
}

function frm_departamentos_local(codigo_local) {
    $("#contentModal .modal-content").load("Departamento/listar", { "local": codigo_local }, function () { });
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
                $('#contentModal').modal('hide');
                $("#content-web").load("Local/listar");
                Aviso.show("Local Ingresado Correctamente", "success");
            } else {
                Aviso.show(obj.mensaje, "danger");
            }
        });
}

function cambiar_estado_local(codigo, estado) {

    bootbox.addLocale("es", {
        OK: 'SI',
        CANCEL: 'NO',
        CONFIRM: 'SI'
    });
    bootbox.setLocale("es");
    bootbox.confirm({
        message: '¿Esta seguro que desea ' + ((estado == '1') ? 'Desactivar' : 'Activar') + ' el local seleccionado?',
        title: 'Confirmar',
        callback: function (result) {
            if (result) {
                var local = {};
                local.codigo = codigo;
                local.id_estado = estado;

                $.ajax({
                    method: "POST",
                    url: "Local/cambiar_estado_local",
                    data: local
                })
                    .done(function (obj) {
                        if (obj.estado) {
                            buscar_local();
                            Aviso.show(obj.mensaje, "success");
                        } else {
                            Aviso.show(obj.mensaje, "danger");
                        }
                    });
            } else {
                Aviso.show("No se realizaron cambios", "danger");
            }
        }
    });
}

/** Fin locales */

/** Departamento */
function frm_agregar_departamento() {

    var local = $("#depto-codlocal").val();

    $("#contentModal .modal-content").load("Departamento/agregar", function () {
        $("#btn-volver-departamentos").click(function (e) {
            $("#contentModal .modal-content").load("Departamento/listar", { "local": local });
        });
        $("#btn_guardar_departamento").click(function (e) {
            e.preventDefault();
            agregar_departamento(local);
        });
    });
}

function frm_modificar_departamento(codigo_departamento) {

    var local = $("#depto-codlocal").val();

    $("#contentModal .modal-content").load("Departamento/modificar", { "codigo_departamento": codigo_departamento }, function () {
        $("#btn-volver-departamentos").click(function (e) {
            $("#contentModal .modal-content").load("Departamento/listar", { "local": local });
        });

        $("#btn_guardar_cambios_departamento").click(function (e) {

            guardar_cambios_departamento(local);
                        
        });
    });
}

function guardar_cambios_departamento(local) {
    
    var departamento = {};
    departamento.local = local;
    departamento.codigo = $("#codigo_departamento").val();
    departamento.nombre = $("#nombre_departamento").val();

    $.ajax({
        method: "POST",
        url: "Departamento/guardar_cambios_departamento",
        data: departamento
    })
        .done(function (obj) {
            $("#contentModal .modal-content").load("Departamento/listar", { "local": local });
            if (obj.estado) {                
                Aviso.show(obj.mensaje, "success");
            } else {
                Aviso.show(obj.mensaje, "danger");
            }
        });
}

function agregar_departamento(local) {

    var departamento = {};
    departamento.local = local;
    departamento.codigo = $("#codigo_departamento").val();
    departamento.nombre = $("#nombre_departamento").val();

    $.ajax({
        method: "POST",
        url: "Departamento/agregar_departamento",
        data: departamento
    })
        .done(function (obj) {
            $("#contentModal .modal-content").load("Departamento/listar", { "local": local });
            if (obj.estado) {
                Aviso.show(obj.mensaje, "success");
            } else {
                Aviso.show(obj.mensaje, "danger");
            }
        });
}

function cambiar_estado_departamento(codigo, estado, local) {

    bootbox.addLocale("es", {
        OK: 'SI',
        CANCEL: 'NO',
        CONFIRM: 'SI'
    });
    bootbox.setLocale("es");
    bootbox.confirm({
        message: '¿Esta seguro que desea ' + ((estado == '1') ? 'Desactivar' : 'Activar') + ' el departamento seleccionado?',
        title: 'Confirmar',
        callback: function (result) {
            if (result) {
                var departamento = {};
                departamento.codigo = codigo;
                departamento.id_estado = estado;

                $.ajax({
                    method: "POST",
                    url: "Departamento/cambiar_estado_departamento",
                    data: departamento
                })
                    .done(function (obj) {
                        $("#contentModal .modal-content").load("Departamento/listar", { "local": local });
                        if (obj.estado) {
                            Aviso.show(obj.mensaje, "success");
                        } else {
                            Aviso.show(obj.mensaje, "danger");
                        }
                    });
            } else {
                Aviso.show("No se realizaron cambios", "danger");
            }
        }
    });

}
/** Fin Departamento */

function mostrar_historial(producto, departamento) {
    var filtro = {'departamento': departamento, 'producto': producto};

    $(".section-historial").load("Inventario/historial", filtro, function () {
        $('#example').DataTable({
            "ordering": false,
            "columns": [
                { "data": "tipo" },
                { "data": "fecha_movimiento" },
                { "data": "cantidad" }
            ],
            "scrollX": "100%",
            "scrollCollapse": true,
            "searching": false
        });

        mostrar_grafico(filtro);

        $(".section-inventario").addClass("hidden");
        $(".section-historial").removeClass("hidden");

        $("#btn-volver-inventario").click(function () {
            $(".section-inventario").removeClass("hidden");
            $(".section-historial").addClass("hidden");
        });
    });
}

function mostrar_grafico(filtro) {

   $.ajax({
        method: "POST",
        url: "Inventario/obtener_movimientos",
        data: filtro
    })
    .done(function( obj ) {
        Highcharts.chart('container', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Grafico de Movimientos'
                },
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
                colors: ["#0BBF1D", "#FF0000", "#1025AF"],
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
                    data: obj.datos.ventas

                }, {
                    name: 'Mermas',
                    data: obj.datos.mermas

                }, {
                    name: 'Total',
                    data: obj.datos.total

                }]
            });
    });

}


function inicializar_box() {
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