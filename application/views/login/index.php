<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Fullinventory</title>
        <!-- Viewport mobile tag for sensible mobile support -->
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

        <link rel="icon" href="/images/icon_inventario.gif">
        <link rel="stylesheet" href="<?=base_url();?>assets/css/reset.css">
        <link href="<?=base_url();?>assets/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="<?=base_url();?>assets/css/sitio/site.css">
    </head>
    <body>
        <nav class="navbar navbar-default navHeader">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a href="#" class="navbar-brand">FullInventory</a>
                </div>
            </div>
        </nav>
		<div id="container-view" class="container-fluid">
            <div class="panel panel-default headerLogin"  >
                <div class="panel-heading">
                    <div class="panel-title" style="text-align: center;"><h3>Inicio Sesión</h3></div>                        
                </div>     
                <div style="padding-top:30px" class="panel-body" >
                <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>                        
                    <form>                                
                        <div style="margin-bottom: 25px" class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            <input type="email" id="email" name="email" placeholder="Email" class="form-control">                                        
                        </div>                            
                        <div style="margin-bottom: 25px" class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                            <input type="password" id="clave" name="clave" placeholder="Clave" class="form-control">
                        </div>
                        <div style="margin-top:10px; text-align:center;" class="form-group">
                            <div class="col-sm-12 controls">
                                <input type="button" id="btn-enviar" class="btn btn-warning" value="Ingresar">                                   
                            </div>
                        </div>
                    </form>     
                </div>                     
            </div>
        </div>

        <script>var base_url = '<?php echo base_url() ?>';</script>
        <script src="<?=base_url();?>assets/js/jquery-3.2.1.min.js"></script>
        <script src="<?=base_url();?>assets/js/bootstrap.min.js"></script>
        <script src="<?=base_url();?>assets/js/sitio/login.js"></script>
    </body>
</html>