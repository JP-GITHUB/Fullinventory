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
        <link rel="stylesheet" href="<?=base_url();?>assets/css/sitio/aside.css">
        <link rel="stylesheet" href="<?=base_url();?>assets/css/sitio/site.css">
        <link rel="stylesheet" href="<?=base_url();?>assets/libs/DataTables/datatables.min.css">
        <link rel="stylesheet" href="<?=base_url();?>assets/css/bootbox.css">
    </head>
    <body>
        <nav class="navbar navbar-default navHeader">

            <div class="container-fluid">
            <div class="navbar-header">
                <a href="#" class="navbar-brand">FullInventory</a>
            </div>
            <div class="collapse navbar-collapse">
                <div class="navbar-right">
                    <p class="navbar-text">
                        <?php echo $this->session->info_usuario['nombre'] ." ". $this->session->info_usuario['apellido']; ?>
                        <br />
                        Local: <?php echo $this->session->info_usuario['local_codigo']; ?>
                    </p>
                    <p class="navbar-text"><a href="<?php echo base_url('Login/logout') ?>" class="navbar-link">Cerrar Sesión</a></p>
                </div>
            </div>
            </div>
        </nav>

        <nav id="aside-web" class="navbar navbar-default sidebar" role="navigation">
            <div class="container-fluid">
            <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-sidebar-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>      
            </div>
            <div class="collapse navbar-collapse" id="bs-sidebar-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li id="aside-inicio"><a href="/">Inicio<span class="pull-right hidden-xs showopacity glyphicon glyphicon-home"></span></a></li>  
                <li id="aside-productos"><a href="#">Productos<span class="pull-right hidden-xs showopacity glyphicon glyphicon-th-list"></span></a></li>
                <li id="aside-proveedores"><a href="#">Proveedores<span class="pull-right hidden-xs showopacity glyphicon glyphicon-apple"></span></a></li>
                <?php if($this->session->info_usuario['rol_id'] == 1):?>
                    <li id="aside-locales"><a href="#">Locales<span class="pull-right hidden-xs showopacity glyphicon glyphicon-send"></span></a></li>
                <?php endif;?>
                <li id="aside-inventario"><a href="#">Inventario<span class="pull-right hidden-xs showopacity glyphicon glyphicon-tags"></span></a></li>
                <!--<li id="aside-configuracion"><a href="#">Configuración<span class="pull-right hidden-xs showopacity glyphicon glyphicon-wrench"></span></a></li>-->
            </ul>
            </div>
        </div>
        </nav>
		<div id="content-web" class="container-fluid">

        </div>
        <div class="bb-alert alert alert-success" style="display:none;">
                    <span></span>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="contenModal" tabindex="-1" role="dialog" aria-labelledby="contenModal">
            <div class="modal-dialog" role="document">
                <div class="modal-content"></div>
            </div>
        </div>

        <script>var base_url = '<?php echo base_url() ?>';</script>
        <script src="<?=base_url();?>assets/js/jquery-3.2.1.min.js"></script>
        <script src="<?=base_url();?>assets/js/bootstrap.min.js"></script>
        <script src="<?=base_url();?>assets/libs/DataTables/datatables.min.js"></script>
        <script src="<?=base_url();?>assets/libs/HighCharts/highcharts.js"></script>
        <script src="<?=base_url();?>assets/js/sitio/app.js"></script>
        <script src="<?=base_url();?>assets/js/bootbox.js"></script>
    </body>
</html>