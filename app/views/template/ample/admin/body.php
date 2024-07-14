<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <?
        $sadmin = new MSuper_admin;
        $sadmin->CreateSuper_admin("id", "6");
    ?>
    <link rel="icon" type="image/png" sizes="16x16" href="<?= HOMEDIR.DS.'app/plugins/thumbnails/'.$sadmin->GetImajotipo() ?>">
    <title>#TITLE#</title>
    <!-- Bootstrap Core CSS -->
    <link href="<?= HOMEDIR ?>/app/plugins/theme/ampleadmin/bootstrap/dist/css/bootstrap.css" rel="stylesheet">
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
    <!--alerts CSS -->
    <link href="<?= HOMEDIR ?>/app/plugins/theme/plugins/bower_components/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">
    <link href="<?= HOMEDIR ?>/app/plugins/theme/ampleadmin/css/animate.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?= HOMEDIR ?>/app/plugins/theme/ampleadmin/css/style.css?f=<?php echo date('YmdHis'); ?>" rel="stylesheet">
    <link rel='stylesheet' type='text/css' href='<?=ASSETS?>/styles/smindel.css?f=<?php echo date('YmdHis'); ?>'/>
    <!-- color CSS -->
    <link href="<?= HOMEDIR ?>/app/plugins/theme/ampleadmin/css/colors/<?= $sadmin->GetEstilo() ?>.css" id="theme" rel="stylesheet">
    <link href="<?= HOMEDIR ?>/app/plugins/font-awesome-4.7.0/css/font-awesome.css" rel="stylesheet">

    <link href="<?= HOMEDIR ?>/app/plugins/theme/plugins//bower_components/datatables/media/css/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

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
<?
        global $c;
        if ($_SESSION['usuario'] != "") {
?>

            <li> 
                <a href="/dashboard/" class="waves-effect <?=($_GET[m]=='dashboard' && $_GET[action]!='')?'active':'';?> ">
                    <i class="mdi mdi-av-timer fa-fw" <?= $c->Ayuda("4", "tog") ?>></i> 
                    <span class="hide-menu" > <?= CAMPOINICIOTITULO ?></span>
                </a>
            </li>
<?           
        if (PROCESOSNOTIFICACIONES == "0"){
            if ($_SESSION['recepcion'] == "1") {     
?>    
                <li> 
                    <a href="/gestion/nuevov2/" class="waves-effect <?=($_GET[m]=='gestion' && $_GET[action]=='nuevov2')?'active':'';?>">
                        <i class="mdi mdi-plus-box fa-fw" data-icon="v"></i> 
                        <span class="hide-menu"> Ventanilla</span>
                    </a>
                </li>
<?
            }
        }
        if (INTERFAZCORRESPONDENCIAV2 == "0") {
            if ($_SESSION['correspondencia'] == '1') {
?>


                <li> 
                    <a href="/gestion/correo/">
                        <i class="mdi mdi-email-outline fa-fw" data-icon="v"></i> 
                        <span class="hide-menu"> Realizar Envíos</span>
                    </a> 
                </li>

                <!--<li> 
                    <a href="#" class="waves-effect <?=($_GET[m]=='gestion' && $_GET[action]=='correo')?'active':'';?>">
                        <i class="mdi mdi-plus-box fa-fw" data-icon="v"></i> 
                        <span class="hide-menu"> Correspondencia<span class="fa arrow"></span> </span>
                    </a>
                    <ul class="nav nav-second-level">
                        <li> 
                            <a href="/gestion/correo/">
                                <i class="mdi mdi-plus-one fa-fw" data-icon="v"></i> 
                                <span class="hide-menu"> Correspondencia Unitaria</span>
                            </a> 
                        </li>
                    </ul>
                </li>    
                <li> 
                    <a href="/importar_procesos/correspondencia/" class="waves-effect <?=($_GET[m]=='importar_procesos' && $_GET[action]=='correspondencia')?'active':'';?>">
                        <i class="mdi mdi-asterisk fa-fw" data-icon="v"></i> 
                        <span class="hide-menu"> Crear Correspondencia</span>
                    </a> 
                </li>
                -->





<?          
            }      
        }
        if($_SESSION['usuariosuscriptor'] == "0"){

?>             
            <li>
                <a href="/gestion/getareas/0/" class="waves-effect <?=($_GET[m]=='proceso' || $_GET[m]== 'dependencias' || $_GET[m]=='caratula' || $_GET[m]=='gestion_compartir' || $_GET[m]=='solicitudes_documentos' || $_GET[m]=='gestion_transferencias' || ($_GET[m]=='gestion' && ($_GET[action]!='nuevo' && $_GET[action]!='correo')))?'active':'';?>">
                    <i class="mdi mdi-archive fa-fw"></i> 
                    <span class="hide-menu" <?= $c->Ayuda("5", "tog") ?>>Fichero</span>
                    
                </a>
            </li>
<?           
        }
        if (ACTIVARACTUACIONES == "1"){
?>   
            <li class=""> 
                <a href="/calendario/" class="waves-effect <?=($_GET[m]=='calendario')?'active':'';?>">
                    <i class="mdi mdi-calendar fa-fw" data-icon="v"></i> 
                    <span class="hide-menu"> Tablero de Actividades</span>
                </a>
            </li>                   
            <!--<li role="presentation">
                <a href="/suscriptores_contactos/listarx/">
                    <div class="new-menu-item">
                            <div class="i-icon fa fa-users"></div>
                            <div class="i-text">Suscriptores</div>
                    </div>
                </a>
            </li> -->
<?
        }
            if ($_SESSION['informes'] == "1") {
?>    
                <li> 
                    <a href="/informes/" class="waves-effect <?=($_GET[m]=='informes')?'active':'';?>">
                        <i class="mdi mdi-chart-areaspline fa-fw" data-icon="v"></i> 
                        <span class="hide-menu"> Informes</span>
                    </a>
                </li>

<? 
            }

            if ($_SESSION['usuarios'] == "1" || $_SESSION['permisos_usuarios'] == "1" || $_SESSION['areas_trabajo'] == "1" || $_SESSION['otras_herramientas'] == "1" || $_SESSION['t_cuenta'] == "1" || $_SESSION['sadmin'] == "1" || $_SESSION['p_suscriptores'] == "1") {
?>                  
                <li> <a href="index.html" class="waves-effect <?=($_GET[m]=='herramientas' || $_GET[m]== 'dependencias' && $_GET[id] == 'views_minutas')?'active':'';?>"><i class="mdi mdi-wrench fa-fw" data-icon="v"></i> <span class="hide-menu"> Configuración<span class="fa arrow"></span> </span></a>
                    <ul class="nav nav-second-level">
                    <?php if ($_SESSION['sadmin'] == "1"): ?>
                        <li> 
                            <a href="/herramientas/empresa/#adminis">
                                <i class="mdi mdi-factory fa-fw"></i>
                                <span class="hide-menu"><?= CAMPOENTIDAD ?></span>
                            </a> 
                        </li>
                    <?php endif ?>
                    <?php if ($_SESSION['areas_trabajo'] == "1"): ?>
                        <li> 
                            <a href="/herramientas/oficinas/#gest">
                                <i class="mdi mdi-briefcase fa-fw"></i>
                                <span class="hide-menu"><?= CAMPOSEDES ?></span>
                            </a> 
                        </li>
                        <li> 
                            <a href="/herramientas/areas/#grup">
                                <i class="mdi mdi-account-multiple fa-fw"></i>
                                <span class="hide-menu"><?= CAMPOAREADETRABAJO; ?></span>
                            </a> 
                        </li>
                    <?php endif ?>
                    <?php if ($_SESSION['usuarios'] == "1" || $_SESSION['permisos_usuarios'] == "1" || $_SESSION['t_cuenta'] == "1" || $_SESSION['sadmin'] == "1"): ?>
                        <li> 
                            <a href="/herramientas/usuarios/#usua">
                                <i class="mdi mdi-worker fa-fw"></i>
                                <span class="hide-menu"><?= CAMPOFUNCIONARIOS ?></span>
                            </a> 
                        </li>
                    <?php endif ?>
                    <?php if ($_SESSION['p_suscriptores'] == "1"): ?>
                        <li> 
                            <a href="/herramientas/suscriptores/#contacts">
                                <i class="mdi mdi-account fa-fw"></i>
                                <span class="hide-menu"><?= SUSCRIPTORCAMPONOMBRE ?></span>
                            </a> 
                        </li>
                    <?php endif ?>
                    <?php if ($_SESSION['otras_herramientas'] == "1"): ?>
                        <li> 
                            <a href="/herramientas/otras/#planti">
                                <i class="mdi mdi-react fa-fw"></i>
                                <span class="hide-menu">Otras Herramientas</span>
                            </a> 
                        </li>
                    <?php endif ?>

                    </ul>
                </li>        
<? 
            }


            if ($_SESSION['modulos_externos'] == "1") {
            #if ($_SESSION['modulos_externos'] != "9") {
                
?>          
                <li> 
                    <a href="index.html" class="waves-effect <?=($_GET[m]=='extras')?'active':'';?>">
                        <i class="mdi mdi-alert-outline fa-fw" data-icon="v"></i> 
                        <span class="hide-menu"> Otros Modulos <span class="fa arrow"></span> </span>
                    </a>
                    <ul class="nav nav-second-level">
                <?
                if ($_SESSION['MODULES']['correspondencia'] == '0') {
                ?>
                        <li> 
                            <a href="/dependencias/TRD/<?= $_SESSION['area_principal'] ?>/">
                                <i class="mdi mdi-table fa-fw"></i>
                                <span class="hide-menu"> Ver TRD</span>
                            </a> 
                        </li>
                        <li> 
                            <a href="/gestion_anexos/checkfolder/">
                                <i class="mdi mdi-check fa-fw"></i>
                                <span class="hide-menu"> Corregir</span>
                            </a> 
                        </li>

                        
                        <?
                }

                            $permisos = $_SESSION['vector'][1];

                            if ($permisos[0] == "") {
                                echo '  <li> 
                                            <a href="#">
                                                <i class=" fa-fw">1</i>
                                                <span class="hide-menu"> No hay modulos adicionales implementados</span>
                                            </a> 
                                        </li>';
                            }else{
                                for ($k=0; $k < count($permisos) ; $k++) { 
                                    $link = explode(":", $permisos[$k]) ;
                                    if ($link[0] != "") {
                                        # code...
                                    echo '  <li>
                                                <a href="/'.$link[1].'/" class="a_menu">
                                                    <i class="fa '.$link[2].' fa-fw"></i>
                                                    <span class="hide-menu">'.$link[0].'</span> 
                                                </a>
                                            </li>';
                                    }
                                }
                            }
                        ?>
                    </ul>
                </li>      
<?          
            }
            #}
        }
?>     
                    <li class="devider dn"></li>
                    <!--<li><a href="<?= HOMEDIR.DS."login".DS."kill".DS ?>" class="waves-effect"><i class="mdi mdi-logout fa-fw"></i> <span class="hide-menu">Cerrar Sesión</span></a></li>-->
                    <li class="dn"><a href="/ayuda/" class="waves-effect"><i class="mdi mdi-help-circle-outline"></i> <span class="hide-menu">Ayuda!</span></a></li>
                    
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
            <footer class="footer text-center"> <?= date("Y") ?> &copy; <?= PROJECTNAME ?> by Sistema desarrollado por Jorge Ardila y Sander Cadena, Contacto: <a href="mailto:jorge.ardila@laws.com.co" target="_blank">jorge.ardila@laws.com.co</a> </footer>
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
            <div class="" id="modal-data-append"></div>
            <div id="verresumendocumento" class="boton fa fa-info" onclick="AbrirResumenDocumento()"></div>
        </div>
    <div id="contenido_bloquex" class="scrollable"></div>
    </div>
</div>

<!-- sample modal content -->
        <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title" id="myModalLabel"></h4> </div>
                    <div class="modal-body" id="myModalBody"></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-info waves-effect" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
        <!-- Button trigger modal -->

        <!-- sample modal content -->

        <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title" id="myLargeModalLabel"></h4> </div>
                    <div class="modal-body" id="myLargeModalBody"></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>

        <div id="myRegularModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title" id="myRegularModalLabel"></h4> </div>
                    <div class="modal-body" id="myRegularModalBody"></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-info waves-effect" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <span data-toggle="modal" data-target=".bs-example-modal-lg" id="mylargemodalbtn"></span>
        <span data-toggle="modal" data-target="#myRegularModal"  id="myregularmodalbtn" ></span>
        <!-- /.modal -->
        <!-- Button trigger modal -->
        <!-- Sweet Alert Triggers-->
        <div id="sa-basic"></div>
        <div id="sa-title"></div>
        <div id="sa-success"></div>
        <div id="sa-error"></div>
        <div id="sa-warning"></div>
        <div id="titulo_alerta"></div>
        <div id="sub_titulo_alerta"></div>
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
    <!-- Sweet-Alert  -->
    <script src="<?= HOMEDIR ?>/app/plugins/theme/plugins/bower_components/sweetalert/sweetalert.min.js"></script>
    <script src="<?= HOMEDIR ?>/app/plugins/theme/plugins/bower_components/sweetalert/jquery.sweet-alert.custom.js"></script>
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

    <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip(); 
            $('[data-toggle="popover"]').popover()
        });
    </script>
    <script src="<?= HOMEDIR ?>/app/plugins/theme/plugins/bower_components/toast-master/js/jquery.toast.js"></script>
    <!--Style Switcher -->
    <script src="<?= HOMEDIR ?>/app/plugins/theme/plugins/bower_components/styleswitcher/jQuery.style.switcher.js"></script>
    <script language='javascript' type='text/javascript' src='<?=ASSETS?>/js/Njscripts.js?f=<?php echo date("YmdHi"); ?>'></script>
    <script language='javascript' type='text/javascript' src='<?=ASSETS?>/js/jscripts.js?f=<?php echo date("YmdHi"); ?>'></script>
    <script src="<?= HOMEDIR ?>/app/plugins/theme/plugins/bower_components/datatables/jquery.dataTables.min.js"></script>
</body>

</html>
