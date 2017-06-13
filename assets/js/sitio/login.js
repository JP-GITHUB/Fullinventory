'use strict';

$(document).ready(function() {
    $("#btn-enviar").click(function(e){
        e.preventDefault();
        var email = $("#email").val();
        var clave = $("#clave").val();
        
        if(email !== "" && clave !== ""){
            $.ajax({
                method: "POST",
                url: base_url + "Login/validar_usuario",
                data: { email: email, clave: clave }
            })
            .done(function(obj) {
                if(obj.estado == true){
                    window.location = base_url;
                }else{
                    alert(obj.mensaje);
                }
            });
        }else{
            alert("campos requeridos");
        }
        
    });
});