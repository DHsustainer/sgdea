<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= HOMEDIR ?>/app/plugins/theme/plugins/images/favicon.png">
    <title>#TITLE#</title>
    <!-- Bootstrap Core CSS -->
    <link href="<?= HOMEDIR ?>/app/plugins/theme/ampleadmin/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Menu CSS -->
    <link href="<?= HOMEDIR ?>/app/plugins/theme/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css" rel="stylesheet">
    <!-- toast CSS -->
    <link href="<?= HOMEDIR ?>/app/plugins/theme/plugins/bower_components/toast-master/css/jquery.toast.css" rel="stylesheet">
    <!-- morris CSS -->
    <link href="<?= HOMEDIR ?>/app/plugins/theme/plugins/bower_components/morrisjs/morris.css" rel="stylesheet">
    <!-- chartist CSS -->
    <link href="<?= HOMEDIR ?>/app/plugins/theme/plugins/bower_components/chartist-js/dist/chartist.min.css" rel="stylesheet">
    <link href="<?= HOMEDIR ?>/app/plugins/theme/plugins/bower_components/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.css" rel="stylesheet">
    <!-- animation CSS -->
    <link href="<?= HOMEDIR ?>/app/plugins/theme/ampleadmin/css/animate.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?= HOMEDIR ?>/app/plugins/theme/ampleadmin/css/style.css" rel="stylesheet">
    <link rel='stylesheet' type='text/css' href='<?=ASSETS?>/styles/smindel.css?f=<?php echo date('YmdHis'); ?>'/>
    <!-- color CSS -->
    <link href="<?= HOMEDIR ?>/app/plugins/theme/ampleadmin/css/colors/megna.css" id="theme" rel="stylesheet">

    <link href="<?= HOMEDIR ?>/app/plugins/font-awesome-4.7.0/css/font-awesome.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>

<![endif]-->
    <script src="<?= HOMEDIR ?>/app/plugins/theme/plugins/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="<?= HOMEDIR ?>/app/plugins/theme/ampleadmin/bootstrap/dist/js/bootstrap.min.js"></script>
    <script language='javascript' type='text/javascript' src='<?=ASSETS?>/js/Pjscripts.js?f=<?php echo date("YmdHi"); ?>'></script>
</head>

<body class="fix-header">
    <!-- ============================================================== -->
    <!-- Preloader -->
    <!-- ============================================================== -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> 
        </svg>
    </div>
    <!-- ============================================================== -->
    <!-- Wrapper -->
    <!-- ============================================================== -->
    <div id="wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        #HEADER#
        <!-- End Top Navigation -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav slimscrollsidebar">
                <div class="sidebar-head">
                    <h3><span class="fa-fw open-close"><i class="ti-menu hidden-xs"></i><i class="ti-close visible-xs"></i></span> <span class="hide-menu">Menú Principal</span></h3> </div>
                <ul class="nav" id="side-menu">


                    <li> <a href="/dashboard/" class="waves-effect <?=($_GET[m]=='dashboard' && $_GET[action]!='')?'active':'';?> "><i class="mdi mdi-av-timer fa-fw" data-icon="v"></i> <span class="hide-menu"> Inicio </span></a>
                    </li>

                    <?
                        $object = new MSuscriptores_contactos;
                        $object->CreateSuscriptores_contactos("id", $_SESSION["suscriptor_id"]);
                        

                        if ($object->GetType() == "1") {
                            if(SUSCRIPTORESENABLEDCREAR == "1"){
?>
                            <li> <a href="#d" class="waves-effect <?=(($_GET['m']=='gestion' && $_GET['action']=='nuevo') || $_GET['m']=='gestion' && $_GET['action']=='nuevomultiple')?'active':'';?>"><i class="mdi mdi-plus-box fa-fw" data-icon="v"></i> <span class="hide-menu"> Registrar <span class="fa arrow"></span></span></a>
                                <ul class="nav nav-second-level collapse out" aria-expanded="false" style="">
                                    <li> <a href="/gestion/nuevo/"><i class=" fa-fw">1</i><span class="hide-menu">Registro Individual</span></a> </li>
                                    <li> <a href="/gestion/carga/"><i class=" fa-fw">2</i><span class="hide-menu">Registro Masivo</span></a> </li>
                                </ul>
                            </li>
<?
                            }
                        }else{
                           if(SUSCRIPTORESENABLEDCREAR == "1"){
?>                          
                            <li> <a href="/gestion/nuevo/" class="waves-effect <?=(($_GET['m']=='gestion' && $_GET['action']=='nuevo') || $_GET['m']=='gestion' && $_GET['action']=='nuevomultiple')?'active':'';?>"><i class="mdi mdi-plus-box fa-fw" data-icon="v"></i> <span class="hide-menu"> Crear Registro</span></a>
                            </li>
<?
                            }
                        }

                    ?>
                    <!--<li>
                        <a href="/gestion/explorar/" class="waves-effect <?=(($_GET[m]=='gestion' && $_GET[action]=='explorar') || $_GET[m]=='gestion' && $_GET[action]=='ver')?'active':'';?>">
                            <i class="mdi mdi-archive fa-fw"></i> 
                            <span class="hide-menu">Mis Expedientes</span>
                        </a>
                    </li>-->
                    
                    <li class="devider"></li>
                    <li><a href="<?= HOMEDIR.DS."login".DS."kill".DS ?>" class="waves-effect"><i class="mdi mdi-logout fa-fw"></i> <span class="hide-menu">Cerrar Sesión</span></a></li>
                    <li><a href="http://ventanilla.comfatolima.com.co/app/plugins/uploadsfiles/MANUAL_CLIENTES.pdf" class="waves-effect"><i class="fa fa-circle-o text-danger"></i> <span class="hide-menu">Manual de Usuario</span></a></li>
                    
                </ul>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Left Sidebar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page Content -->
        <!-- ============================================================== -->
        <div id="page-wrapper">
            <div class="container-fluid">
                #CONTENIDO#
            </div>
            <!-- /.container-fluid -->
            <footer class="footer text-center"> <?= date('Y-m-d') ?> &copy; <?= PROJECTNAME ?> by Laws Leyes Sistematizadas </footer>
        </div>
        <!-- ============================================================== -->
        <!-- End Page Content -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
<div id="mascara_registro">
<div id="mascara_contenido">
<div id="barra_menu">
<div class="titulo" id="titulo_bloque_mascara"></div>
<div id="cerrar" class="boton fa fa-close"></div>
<div class="multimedia" id="modal-data-append"></div>
<div id="verresumendocumento" class="boton fa fa-info" onclick="AbrirResumenDocumento()"></div>
</div>
<div id="contenido_bloquex" class="scrollable"></div>
</div>
</div>
<style>
#mascara_contenido {
width: 100% !important;
left: 0px !important;
}

#mascara_registro #barra_menu .multimedia {
display: none;
}


#mascara_registro{

width:100%;

height: 100%;

background: RGBA(6,6,6, 0.9);

z-index: 9999;

position: absolute;

display: none;

top:0;

left:0;

}

#mascara_registro #barra_menu{

height: 50px;

width: 100%;

background-color: #FCFCFC;

border-bottom: 1px solid #DDD;

}

#mascara_contenido .titulo{

float:left;

line-height: 50px;

font-size: 18px;

margin-left: 10px;

}

#mascara_registro #cerrar{



}

#mascara_registro #barra_menu .boton{

width: 50px;

height: 50px;

float: right;

cursor: pointer;

line-height: 50px;

text-align: center;

border-left: 1px solid #DDD;

color: #72777C;

font-size: 20px;

font-weight: normal;

}

#mascara_registro #barra_menu .multimedia{

float:right;

}

#mascara_registro .boton:hover{

background-color: #DDD;

color: #000;

}

#contenido_bloquex{

overflow-y: auto;

height: 92%;

width: 100%;

border: 1px solid #ccc;

margin: 0 auto;

text-align: left;

}

#mascara_contenido{

width:97%;

text-align: center;

margin:0 auto;

background: #FFF;

margin-top: 15px;

padding: 0px;

position: fixed;

top: 0px;

left:20px;

}

#mascara_precarga, #box-osx{

width:100%;

height: 100%;

background: RGBA(0,0,0, 0.75);

z-index: 999;

position: absolute;

top:0;

left:0;

text-align: center;

display: none;

}

#box-osx #container_osx #cerrar_precarga_osx{

right:0px;

float: right;

cursor: pointer;

font-weight: bold;

}

#box-osx #container_osx{

color: #000;

font-weight: bold;

overflow-y:none;

overflow-x:none;

margin: 0 auto;

margin-top: 5px;

width: 98%;

height: 92%;

border-left: 10px solid #0090DD;

overflow: hidden;

}

#container_osx p{

font-size: 13px;

text-align: justify;

font-weight: normal;

padding: 10px;

}

#cerrar_precarga{

background: URL(<?=ASSETS?>/images/x.png) no-repeat;

width: 30px;

height: 30px;

position: relative;

float: right;

margin-top: 0px;

cursor: pointer;

}

.popover, .tooltip{
    
width: 250px !important; /* Max Width of the popover (depending on the container!) */
    
}

#box_sesiones{

z-index: 99999!important;

margin-top: 50px;

margin-left: 50px;

position: absolute;

display: none;

}




</style>
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <!-- Menu Plugin JavaScript -->
    <script src="<?= HOMEDIR ?>/app/plugins/theme/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>
    <!--slimscroll JavaScript -->
    <script src="<?= HOMEDIR ?>/app/plugins/theme/ampleadmin/js/jquery.slimscroll.js"></script>
    <!--Wave Effects -->
    <script src="<?= HOMEDIR ?>/app/plugins/theme/ampleadmin/js/waves.js"></script>
    <!--Counter js -->
    <script src="<?= HOMEDIR ?>/app/plugins/theme/plugins/bower_components/waypoints/lib/jquery.waypoints.js"></script>
    <script src="<?= HOMEDIR ?>/app/plugins/theme/plugins/bower_components/counterup/jquery.counterup.min.js"></script>
    <!--Morris JavaScript -->
    <script src="<?= HOMEDIR ?>/app/plugins/theme/plugins/bower_components/raphael/raphael-min.js"></script>
    <script src="<?= HOMEDIR ?>/app/plugins/theme/plugins/bower_components/morrisjs/morris.js"></script>
    <!-- chartist chart -->
    <script src="<?= HOMEDIR ?>/app/plugins/theme/plugins/bower_components/chartist-js/dist/chartist.min.js"></script>
    <script src="<?= HOMEDIR ?>/app/plugins/theme/plugins/bower_components/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.min.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="<?= HOMEDIR ?>/app/plugins/theme/ampleadmin/js/custom.min.js"></script>
    <!-- Custom tab JavaScript -->
    <script src="<?= HOMEDIR ?>/app/plugins/theme/ampleadmin/js/cbpFWTabs.js"></script>
    <script type="text/javascript">
        (function () {
                [].slice.call(document.querySelectorAll('.sttabs')).forEach(function (el) {
                new CBPFWTabs(el);
            });
        })();
        
    </script>
    <script src="<?= HOMEDIR ?>/app/plugins/theme/plugins/bower_components/toast-master/js/jquery.toast.js"></script>
    <!--Style Switcher -->
    <script src="<?= HOMEDIR ?>/app/plugins/theme/plugins/bower_components/styleswitcher/jQuery.style.switcher.js"></script>

</body>

</html>
