<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>

<html xmlns='http://www.w3.org/1999/xhtml'>

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <title>#TITLE#</title>



    <!-- <link rel='stylesheet' type='text/css' href='http://assets.audiosjuridicos.com/styles/comunes.css'/>

    <link rel='stylesheet' type='text/css' href='http://assets.audiosjuridicos.com/styles/formularios.css'/> -->

    <link rel='stylesheet' type='text/css' href='<?=ASSETS?>/styles/del.mini.css'/>

    <link rel='stylesheet' type='text/css' href='<?=ASSETS?>/styles/formularios.css'/>

    <!-- <link rel='stylesheet' type='text/css' href='<?=ASSETS?>/css/bt.css'/> -->

    <link rel='stylesheet' href='https://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css' />

    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css"> -->

    <script src="https://code.jquery.com/jquery-1.11.0.min.js"></script>

    <script src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>

    <script language='javascript' type='text/javascript' src='https://code.jquery.com/ui/1.10.3/jquery-ui.js'></script>

    <script language='javascript' type='text/javascript' src='<?=ASSETS?>/js/jscripts.js?f=<?php echo date("YmdHi"); ?>'></script>

    <script language='javascript' type='text/javascript' src='<?=ASSETS?>/js/jquery.tablesorter.min.js'></script>

    <link href="<?= HOMEDIR ?>/app/plugins/font-awesome-4.7.0/css/font-awesome.css" rel="stylesheet">



    <!-- Latest compiled and minified CSS -->

    <link rel="stylesheet" href="<?= HOMEDIR ?>/app/plugins/bootstrap-3.3.7-dist/css/bootstrap.min.css">

    <link href="<?=ASSETS?>/images/favicon.png" rel='icon' type='image/x-icon'/>





    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!–[if lt IE 8]>

    <script src="https://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>

    <![endif]–>

</head>

<body>



  <div id='wrapper'>

    <!-- header  -->

    <div id="header">#HEADER#</div>

    <!-- end: header  -->       

    <!-- contenido -->

    <div id='content' class="app_container">
        <div class="containerx" style="padding: 10px; ">
            <div class="row">
                <div class="col-md-12">
                    <h2><span class="fa fa-sliders"></span>Administrador de Aplicaciones</h2>
                </div>
            </div>
        <?
            if ($_SESSION['MODULES']['formularios'] == "1") {

            $module = $_REQUEST['m'];
        ?>  
           <div class="row">
             <div class="col-md-12" id="main_form_suscriptores_modulos">
                 <div class="row">
                    <div class="col-md-2">
                       <div class="navbar navbar-default">
                          <br>
                          <div class="container-fluid">
                             <div class="navbar-header">
                                <button class="navbar-toggle" data-toggle="collapse" data-target="#mainNav">
                                   <span class="icon-bar"></span>
                                   <span class="icon-bar"></span>
                                   <span class="icon-bar"></span>
                                </button>
                             </div>
                          </div>
                          <div>
                             <div>
                                <div class="collapse navbar-collapse" id="mainNav">
                                   <ul id="navlist" class="nav nav-pills nav-stacked">
                                      <li role="presentation" id="alistas" class="<?= ($module === "suscriptores_tipos_proyectos")?"active":"" ?>">
                                         <a href="/suscriptores_tipos_proyectos/">
                                            <span class="fa fa-list"></span> Proyectos
                                         </a>
                                      </li>
                                      <li role="presentation" id="fmeta" class="<?= ($module === "suscriptores_modulos")?"active":"" ?>">
                                         <a href="/suscriptores_modulos/1/">
                                            <span class="fa fa-gears"></span> Modulos
                                         </a>
                                      </li>
                                      <li role="presentation" id="fmeta" class="<?= ($module === "suscriptores_paquetes_negocios")?"active":"" ?>">
                                         <a href="/suscriptores_paquetes_negocios/1/">
                                            <span class="fa fa-line-chart"></span> Paquetes de Negocios
                                         </a>
                                      </li>
                                      <li role="presentation" id="fmeta" class="<?= ($module === "suscriptores_reglas_negocios_generales")?"active":"" ?>">
                                         <a href="/suscriptores_reglas_negocios_generales/1/">
                                            <span class="fa fa-puzzle-piece"></span> Reglas de Negocios
                                         </a>
                                      </li>
                                      <li role="presentation" id="fmeta" class="<?= ($module === "suscriptores_negocios")?"active":"" ?>">
                                         <a href="/suscriptores_negocios/1/">
                                            <span class="fa fa-money"></span> Administrar Negocios
                                         </a>
                                      </li>
                                   </ul>
                                </div>
                             </div>
                          </div>
                          <br>
                       </div>
                    </div>
                    <div class="col-md-10 body_metadatos">#CONTENIDO#</div>
                 </div>
              </div>
           </div>
            <!-- Modal -->
            <div class="modal fade bs-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">
                            <!-- TITULO DE VENTANA MODAL-->
                        </h4>
                    </div>
                    <div class="modal-body">
                        <!-- BODY DE VENTANA MODAL -->
                    </div>
                </div>
              </div>
              <br>
            </div>
        <?
            }
        ?>

        </div>
        <style>
            .body_metadatos {
                background-color: #f8f8f8;
                border-top: 1px solid #e7e7e7;
                border-left: 1px solid #e7e7e7;
                border-bottom: 1px solid #e7e7e7;
                border-top-left-radius: 4px;
                padding-top:20px;
                padding-right:30px;
                padding-bottom:20px;
                margin-bottom:20px;
            }
            .tmain {
                font-size: 15px;
                font-weight: 700;
                color: #959595;
                text-transform: uppercase;
                margin-bottom: 15px;
            }
            .align-right {
                text-align: right;
            }
            .margin_bottom {
                margin-bottom: 20px !important;
            }
            #body-metadatosjs, #inner-metadatosjs{
                background-color: #FFF;
                border-radius: 4px;
                padding:20px;
            }
            input[type='text'], input[type='password'], input[type='time'] {
                height: 46px !important;
            }
            select {
                max-width: 100%;
            }
            .fullwidth {
                width: 100%;
                height: 40px;
            }
            .iconbox {
                width: 50px !important;
            }

            .nav-pills>li>a {
                border-radius: 0px;
            }

            .nav>li>a {
                padding: 10px 10px;
            }
            .navbar-collapse {
                padding-right: 0px;
                padding-left: 0px;
            }
        </style>
    </div>

  </div>



</body>

</html>



<!-- Latest compiled and minified JavaScript 

-->

<script src="<?= HOMEDIR ?>/app/plugins/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>