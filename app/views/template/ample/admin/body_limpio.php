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
    <!--alerts CSS -->
    <link href="<?= HOMEDIR ?>/app/plugins/theme/plugins/bower_components/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">
    <!-- Custom CSS -->
    <link href="<?= HOMEDIR ?>/app/plugins/theme/ampleadmin/css/style.css" rel="stylesheet">
    <!-- color CSS -->
    <link href="<?= HOMEDIR ?>/app/plugins/theme/ampleadmin/css/colors/<?= $sadmin->GetEstilo() ?>.css" id="theme" rel="stylesheet">
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
            <footer class="footer text-center"> <?= date("Y") ?> &copy; <?= PROJECTNAME ?> by Laws Leyes Sistematizadas </footer>
        </div>

        <!-- sample modal content -->
        <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
        <!-- /.modal -->
        <!-- Button trigger modal -->

        <!-- sample modal content -->
        <div id="myModalLarge" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
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
        <!-- End Page Content -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
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
    <script src="<?= HOMEDIR ?>/app/plugins/theme/plugins/bower_components/toast-master/js/jquery.toast.js"></script>
    <!--Style Switcher -->
    <script src="<?= HOMEDIR ?>/app/plugins/theme/plugins/bower_components/styleswitcher/jQuery.style.switcher.js"></script>
    <script language='javascript' type='text/javascript' src='<?=ASSETS?>/js/Njscripts.js?f=<?php echo date("YmdHi"); ?>'></script>
    
    <style>
        @media (min-width: 768px){
            .navbar-static-top {
                padding-left: 0px;
            }
            #page-wrapper {
                position: inherit;
                margin: 0px;
            }
        }
    </style>
</body>

</html>