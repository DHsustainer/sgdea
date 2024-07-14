<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>



<html xmlns='http://www.w3.org/1999/xhtml'  style="height:100%;">

<head>

   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <title>#TITLE#</title>

   <!-- <link rel='stylesheet' type='text/css' href='http://assets.audiosjuridicos.com/styles/comunes.css'/>-->

    <link rel='stylesheet' type='text/css' href='<?=ASSETS?>/styles/formularios.css'/>

    <link rel='stylesheet' type='text/css' href='<?=ASSETS?>/styles/del.css?f=<?php echo date('YmdHis'); ?>'/>

   <!-- <link rel='stylesheet' type='text/css' href='<?=ASSETS?>/css/bt.css'/> -->

    <link rel='stylesheet' href='https://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css' />

    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css"> -->

   <script src="https://code.jquery.com/jquery-1.11.0.min.js"></script>

    <script src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>

    <script language='javascript' type='text/javascript' src='https://code.jquery.com/ui/1.10.3/jquery-ui.js'></script>

    <script language='javascript' type='text/javascript' src='<?=ASSETS?>/js/jscripts.js?f=<?php echo date("YmdHi"); ?>'></script>

    <script language='javascript' type='text/javascript' src='<?=ASSETS?>/js/jquery.tablesorter.min.js'></script>

    <meta name="hitracker-verification-code" content="b86fcc63a2ae22e02c16794feeeeec3a1c78e39db90c3a445f727d3d2c729ced">

    <link href="<?= HOMEDIR ?>/app/plugins/font-awesome-4.7.0/css/font-awesome.css" rel="stylesheet">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="<?= HOMEDIR ?>/app/plugins/bootstrap-3.3.7-dist/css/bootstrap.min.css">

   <script language='javascript' type='text/javascript' src="https://code.highcharts.com/highcharts.js"></script>

    <script language='javascript' type='text/javascript' src="https://code.highcharts.com/modules/exporting.js"></script>

    <link href="<?=ASSETS?>/images/favicon.png" rel='icon' type='image/x-icon'/>

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link type="text/css" rel="stylesheet" media="all" href="<?= ASSETS.DS ?>css/chat.css" />

    <link rel="stylesheet" href="<?= ASSETS.DS ?>css/menu_chat.css" type="text/css">

    <script type="text/javascript" src="<?= ASSETS.DS ?>js/menu_chat.js" language="javascript"></script>

    <script type="text/javascript" src="<?= ASSETS.DS ?>js/chat.js" language="javascript"></script>

    <link rel='stylesheet' type='text/css' href='<?= HOMEDIR.DS ?>app/plugins/select2/css/select2.min.css'/>
    <script language='javascript' type='text/javascript' src='<?= HOMEDIR.DS ?>app/plugins/select2/js/select2.min.js'></script>



</head>

<body  style="height:100%;">

    <div id="box_sesiones" class="alert alert-danger alert-dismissible fade in" role="alert"> 

        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> 

        <h4>Alerta!</h4> 

        <p>Su sesión ha sido abierta en otro dispositivo ¿desea cerrarla?.</p> 

        <p> 

            <button type="button" class="btn btn-danger" onClick="CerrarSesiones('1')" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">Cerrar Todas las Sesiones Abiertas</span></button> 

            <button type="button" class="btn btn-default"  onClick="CerrarSesiones('0')" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">Ignorar</span></button> 

        </p> 

    </div>    

    <div id="mascara_registro">

        <div id="mascara_contenido">

            <div id="barra_menu">

                <div class="titulo" id="titulo_bloque_mascara"></div>

                <div id="cerrar" class="boton fa fa-close"></div>

                <div class="multimedia" id="modal-data-append">

<!--



<div id="nextelementoarchivo" class="boton fa fa-angle-right disabled"></div>

                    <div id="prevelementoarchivo" class="boton fa fa-angle-left disabled"></div>

                    <div id="menu_files" class="boton fa fa-bars">

                        <div id="bars-menu" class="bars-menu scrollable">

                            <div class="list-group" id="panelContent2">

                            </div>

                        </div>

                    </div>-->

                </div>
                <div id="verresumendocumento" class="boton fa fa-info" onclick="AbrirResumenDocumento()"></div>

            </div>

            <div id="contenido_bloquex" class="scrollable"></div>

        </div>

    </div> 

    <div id="view_event"></div>

    <style>


/*
body{

    background-color: #FFF !important;

}*/

#menu_files:hover .bars-menu{

    display: block;

}

.bars-menu{

    width: 400px;

    margin-left: -350px;

    background-color: #fff;

    display: none; 

     height:500px;

    overflow: hidden;

    overflow-y: auto;

    }

    .bars-menu a{

        z-index: 9999;

        height: 40px;

        line-height: 40px;

        font-size: 20px;

        clear: both;

        }

        .bars-menu a .nom_anexo{

    font-size: 14px;

        text-align: left;

        font-family: "Segoe UI", arial;



    }

    .bars-menu .pag{

        font-size: 14px;

        text-align: left;

        font-family: "Segoe UI", arial;

        color: #1263A1;

        background-color: #FFF;

        padding: 5px;

        border-radius: 4px;

    }

    .bars-menu .pag.darker{

        background-color: transparent;

        color: #FFF;

        font-weight: bold;

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



        .new-menu-item ul{

            background: #1579C4;

        }



        .nav>li>a {

            /*padding: 0px 15px;*/
            padding: 0px;

        }

        .navbar-default {

            background-color: #1263a1;

            border-color: #1263a1;

        }



        .nav-pills>li>a {

            /*border-radius: 20px; */
            border-radius: 0px; 

        }

        .navbar-collapse {
             padding-right: 0px; 
             padding-left: 0px; 
         }

         @media (min-width: 992px){
            
            #col_container .col-md-11 {
                width: 93.66666667%;
            }
            #col_container #men_container {
                width: 6.3333333%;
            }
            

 
        }

        @media (min-width: 768px){
            .navbar {
                border-radius: 0px !important; 
                left: -2px !important;
            }
        }


                

    </style>

        <div id="box-osx">

            <div id="cerrar_precarga" class="button"></div> 

            <div id="container_osx"></div>

        </div>

        <div id='wrapper'>

            <!-- header  -->

            <div class="row" style="margin:0px; padding:0px" id="col_header">

                <div class="col-md-12" style=" margin-bottom:0px !important; " id="mheader">

                    <div id="header">#HEADER#</div>

                </div>

            </div>

            <div class="row" style="margin:0px; padding:0px" id="col_container">

                <div class="col-md-1" style="margin-bottom:0px;" id="men_container">


                    <div class="navbar navbar-default">

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

                            <div id="mid-wrapper">

                                <div class="collapse navbar-collapse" id="mainNav">

                                   <ul id="del-left-bar" class="nav nav-pills nav-stacked">
    <?

                if ($_SESSION['usuario'] != "") {

                    if ($_SESSION['suscriptor_id'] == "") {

                        global $c;
                        $getDocsToSign = $c->GetDocumentosParaFirmar();

    ?>

                                <li role="presentation">

                                    <a href="/dashboard/">

                                        <div class="new-menu-item <?=($_GET[m]=='dashboard')?'active':'';?>">

                                                <div class="i-icon fa fa-home"></div>

                                                <!--<div class="i-text">Inicio</div>-->
                                        </div>

                                    </a>
                                    <div class="main_submenu">
                                        <ul class="nav">
                                            <li role="presentation" class="titulo"><a href="/dashboard/">INICIO</a></li>
                                        </ul>
                                    </div>

                                </li>

                                <li role="presentation" clas="new-menu-item">

                                    <a href="/gestion/getareas/0/">

                                        <div class="new-menu-item <?=($_GET[m]=='proceso' || $_GET[m]== 'dependencias' || $_GET[m]=='caratula' || $_GET[m]=='gestion_compartir' || $_GET[m]=='solicitudes_documentos' || $_GET[m]=='gestion_transferencias' || $_GET[m]=='gestion' && $_GET[action]!='nuevo')?'active':'';?>">

                                                <div class="i-icon fa fa-archive"></div>

                                                <!--<div class="i-text">Gestión</div> -->

                                        </div>

                                    </a>
                                    <div class="main_submenu">
                                        <ul class="nav">
                                            <li role="presentation" class="titulo">
                                                <a href="/gestion/getareas/0/">GESTI&Oacute;N</a>
                                            </li>
                                        </ul>
                                    </div>

                                </li>
<?
                        if ($_SESSION['recepcion'] == "1") {
?>    
                                <li role="presentation">
                                    <a href="/gestion/nuevo/">
                                        <div class="new-menu-item <?=($_GET[m]=='gestion' && $_GET[action]=='nuevo')?'active':'';?>">
                                                <div class="i-icon fa fa-plus"></div>
                                                <!--<div class="i-text">Recepción</div> -->
                                        </div>
                                    </a>
                                    <div class="main_submenu">
                                        <ul class="nav">
                                            <li role="presentation" class="titulo"><a href="/gestion/nuevo/">RECEPCION</a></li>
                                        </ul>
                                    </div>
                                </li>
<?
                        }
?>                                
                                <!--<li role="presentation">
                                    <a href="/suscriptores_contactos/listarx/">
                                        <div class="new-menu-item <?=($_GET[m]=='suscriptores' || $_GET[m]=='suscriptores_contactos')?'active':'';?>">
                                                <div class="i-icon fa fa-users"></div>
                                                <div class="i-text">Suscriptores</div>
                                        </div>
                                    </a>
                                </li> -->
<?
                        if ($_SESSION['informes'] == "1") {
?>    
                                <li role="presentation" id="itemmenuinformes">
                                    <a href="/informes/">
                                        <div class="new-menu-item <?=($_GET[m]=='informes')?'active':'';?>">
                                                <div class="i-icon fa fa-pie-chart"></div>
                                                <!--<div class="i-text">Informes</div>-->
                                        </div>
                                    </a>
                                    <div class="main_submenu">
                                        <ul class="nav">
                                            <li role="presentation" class="titulo"><a href="/informes/">INFORMES</a></li>
                                        </ul>
                                    </div>

                                </li>
<? 
                        }

                        if ($_SESSION['usuarios'] == "1" || $_SESSION['permisos_usuarios'] == "1" || $_SESSION['areas_trabajo'] == "1" || $_SESSION['otras_herramientas'] == "1" || $_SESSION['t_cuenta'] == "1" || $_SESSION['sadmin'] == "1" || $_SESSION['p_suscriptores'] == "1") {
?>                          
                                <li role="presentation" id="itemmenuconfigurar">
                                    <a href="/herramientas/usuarios/#usua">
                                        <div class="new-menu-item <?=($_GET[m]=='herramientas' || $_GET[m]== 'dependencias' && $_GET[id] == 'views_minutas')?'active':'';?>">
                                            <div class="i-icon fa fa-gear"></div>
                                            <!--<div class="i-text">Configurar</div> -->
                                        </div>
                                    </a>
                                    <div class="main_submenu">
                                        <ul class="nav">
                                            <li role="presentation" class="titulo"><a href="/herramientas/usuarios/#usua">CONFIGURAR</a></li>
<?
                                        if ($_SESSION['sadmin'] == "1") {
?>                                              
                                            <li role="presentation"><a href="/herramientas/empresa/#adminis" class="a_menu"><?= CAMPOENTIDAD ?></a></li>
<?
                                        }
                                        if ($_SESSION['areas_trabajo'] == "1") {
?>  
                                            <li role="presentation"><a href="/herramientas/oficinas/#gest" class="a_menu"><?= CAMPOSEDES ?></a></li>
                                            <li role="presentation"><a href="/herramientas/areas/#grup" class="a_menu"><?= CAMPOAREADETRABAJO; ?></a></li>
<?
                                        }
                                        if ($_SESSION['usuarios'] == "1" || $_SESSION['permisos_usuarios'] == "1" || $_SESSION['t_cuenta'] == "1" || $_SESSION['sadmin'] == "1") {
?>  
                                            <li role="presentation"><a href="/herramientas/usuarios/#usua" class="a_menu"><?= CAMPOFUNCIONARIOS ?></a></li>
<?
                                        }
                                        if ($_SESSION['p_suscriptores'] == "1") {
?>  
                                            <li role="presentation"><a href="/herramientas/suscriptores/#contacts" class="a_menu"><?= SUSCRIPTORCAMPONOMBRE ?></a></li>
<?
                                        }
                                        if ($_SESSION['otras_herramientas'] == "1") {
?>  
                                            <li role="presentation"><a href="/herramientas/otras/#planti" class="a_menu">Otras Herramientas</a></li>
<?
                                        }
?>
                                        </ul>
                                    </div>
                                </li>
<? 
                        }
                        if ($_SESSION['modulos_externos'] == "1") {
?>          
                            <li role="presentation" id="impr_box_main_menu">
                                <a href="/informes/">
                                    <div class="new-menu-item <?=($_GET[m]=='extras')?'active':'';?> impr_box_main_menu">
                                        <div class="i-icon fa fa-bars"></div>
                                    </div>
                                </a>
                                <div class="main_submenu">
                                    <ul class="nav">
                                        <li role="presentation" class="titulo"><a href="#">OTROS MODULOS</a></li>
                                        <li role="presentation"><a href="/dependencias/TRD/<?= $_SESSION['area_principal'] ?>/" target="_blank" class="a_menu"><span class="fa fa-table"></span> Ver TRD</a></li>
                                    <?

                                        $permisos = $_SESSION['vector'][1];

                                        if ($permisos[0] == "") {
                                            echo '<li role="presentation"><a href="#" class="a_menu">No hay modulos adicionales implementados</a></li>';
                                        }else{
                                            for ($k=0; $k < count($permisos) ; $k++) { 
                                                $link = explode(":", $permisos[$k]) ;
                                                echo '  <li role="presentation">
                                                            <a href="/'.$link[1].'/" class="a_menu">
                                                                <span class="fa '.$link[2].'"></span> '.$link[0].'
                                                            </a>
                                                        </li>';
                                            }
                                        }
                                    ?>
                                    </ul>
                                </div>                                    
                            </li>
<?                      }

                    }else{
?>
                            <li role="presentation">
                                <a href="/dashboard/">
                                    <div class="new-menu-item  <?=($_GET[action]!='nuevo')?'active':'';?>">
                                            <div class="i-icon fa fa-archive"></div>
                                            <!--<div class="i-text">Gestión</div>-->
                                    </div>
                                </a>
                            </li>
                            <li role="presentation">
                                <a href="/gestion/nuevo/">
                                    <div class="new-menu-item <?=($_GET[m]=='gestion' && $_GET[action]=='nuevo')?'active':'';?>">
                                            <div class="i-icon fa fa-plus"></div>
                                            <!--<div class="i-text">Recepción</div> -->
                                    </div>
                                </a>
                            </li>
    <?
                    }
                }
    ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-md-11" style="margin-bottom: 0px; padding-bottom: 0px; background:#FFF" id="col-md-content">
                    <div id='content' class="app_container">#CONTENIDO#</div>
                </div>
            </div>
                <!-- end: header  -->       
                <!-- contenido -->
        </div>
        <!-- end: contenido -->      
        <!-- contenido 
        <div id='footer' class="sizecontainer">#FOOTER#</div>
        -->
        <!-- end: contenido -->      
        <div id="new_chatbox">
            <div class="row">
                <div class="col-md-3 col-izquierda scrollable">
                    <div class="row header-lchatbox">
                        <ul class="nav nav-pills" id="listmenuchatboxes">
                          <li role="presentation" id="openchatboxrecent" class="active"><a href="#">Conversaciones</a></li>
                          <li role="presentation" id="openchatboxnew"><a href="#">Nueva</a></li>
                        </ul>
                    </div>
                    <div class="row coluserschat scrollable" id="activechats">
                        <div class="col-md-12">
                            <div class="list-group" id="listadoconversaciones"></div>
                        </div>
                    </div>


                    <div class="row coluserschat scrollable" id="listchatschats">
                        <div class="col-md-12">
                            <div class="list-group">
<?
                                $result = $con->Query("select user_id from usuarios where user_id != '".$_SESSION['usuario']."' order by p_nombre");
                                
                                for($i=0;$i<$con->NumRows($result);$i++){
                                    $amigo = $con->Result($result,$i,"user_id");
                                    echo UserChat($amigo);
                                    
                                }
?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="row header-lchatbox lchatbox2">
                        <h3>Conversación con <span id="namechatopen">-</span></h3>
                        <span class="fa fa-close btn_cerrar_chat" id="cerrarchat"></span>
                    </div>
                    <div class="row">
                        <div class="col-md-12" id="loadchatboxbody">
                                <br><br>
                                <div class="bg-info mensajeinfo">Selecciona una Conversación</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script type="text/javascript">
            $("#openchatboxrecent").click(function(){
                $("#listmenuchatboxes a").removeClass("active");
                $(this).addClass("active");
                $("#listchatschats").slideUp();
                $("#activechats").slideDown();

                var URL = '/chat/LoadConversaciones/';
                $.ajax({
                    type: 'POST',
                    url: URL,
                    success: function(msg){
                        result = msg;
                        $("#listadoconversaciones").html(result);
                        
                        $("#chatwith"+$("#idtochatname").val()).addClass("active");
                        
                    }
                }); 


            })

            $("#openchatboxrecent").click();
            $("#openchatboxnew").click(function(){
                $("#listadoconversaciones a").removeClass("active");
                $(this).addClass("active");
                $("#activechats").slideUp();
                $("#listchatschats").slideDown();
            })

            function  AbrirChatbox(id, chatbox, nombre){
                $("#listadoconversaciones a").removeClass("active");
                $("#namechatopen").html(nombre);
                $("#"+id).addClass("active");

                //alert("jiji")
                if (typeof(refreshIntervalId) != "undefined") {
                    //alert("jeje");
                    clearInterval(refreshIntervalId);
                    clearInterval(refreshIntervalAd);
                    
                }; 
             //S   alert("jaja")

                var URL = '/chat/LoadChat/'+chatbox+'/';
                $.ajax({
                    type: 'POST',
                    url: URL,
                    success: function(msg){
                        result = msg;
                        $("#loadchatboxbody").html(result);
                        $("#historychat").animate({ scrollTop: $('#historychat')[0].scrollHeight}, 100);

                        /* later */
                        
                        


                        
                        // Some code here!
                    }
                }); 
            }

            $("#cerrarchat").click(function(){
                $("#new_chatbox").fadeOut();
            })

            $("#chat").click(function(){
                $("#new_chatbox").fadeIn();
            })
        </script>
<?
        function UserChat($amigo){

            $userchat = new MUsuarios();
            $userchat->CreateUsuarios("user_id", $amigo);

            $nomamigo = substr($userchat->GetP_nombre()." ".$userchat->GetP_apellido(), 0, 20);

            $avatar = $userchat->GetFoto_perfil();
            $estadochat = $userchat->GetEstadochat();

            $status =  array('0' => 'status-offline.png' , '1' => 'status.png' , '2' => 'status-away.png' , '3' => 'status-busy.png');

            return '  <a href="#" class="list-group-item" onClick="AbrirChatbox(\'chatwith'.$userchat->GetA_i().'\', \''.$userchat->GetUser_id().'\', \''.$userchat->GetP_nombre().' '.$userchat->GetP_apellido().' \')" id="chatwith'.$userchat->GetA_i().'"> 
                        
                        <img src="'.HOMEDIR.DS.'app/plugins/thumbnails/'.$avatar.'"  border="0" width="30" height="30" " alt="">
                        '.strtolower($nomamigo).'
                        <img src="'.HOMEDIR.DS.'app/views/assets/images/'.$status[$estadochat].'" border="0" width="16" height="16" />
                    </a>';

        }
?>
        <style type="text/css">

            #new_chatbox{
                z-index:999;
                position: fixed;
                background-color: #FFF;
                bottom: 0px;
                width: 1000px;
                height: 550px;
                right:0px;
                color:#000;
                border: 1px solid #CCC;
                border-right: none;
                border-bottom: none;
                border-top-left-radius: 4px;
                display: none;
                /*
                */
            }

            #new_chatbox .row{
                margin:0px;
            }

            .header-lchatbox{
                padding: 10px;
                height: 60px;
                border-bottom: 1px solid rgba(120, 130, 140, 0.13);

            }
            .header-lchatbox ul.nav-pills li a{
                padding: 10px 15px !important;
                border-radius: 4px;
            }
            .header-lchatbox ul.nav-pills li a:hover{
                color: #FFF;
            }
            .col-izquierda{
                border-right: 1px solid rgba(120, 130, 140, 0.13);
                height: 550px;
                overflow: hidden;
                overflow-y: auto;
            }

            .coluserschat{
                padding-top: 20px;
            }

            #listchatschats{
                display: none;
            }

            .header-lchatbox h3{
                margin:0px;
                padding: 0px;
                line-height: 60px;
                font-weight: bold;
                margin-left: 10px;
            }

            .lchatbox2{
                height: 80px;
            }

            .btn_cerrar_chat{
                width: 70px;
                height: 80px;
                float: right;
                cursor: pointer;
                line-height: 80px;
                text-align: center;
                border-left: 1px solid #DDD;
                color: #72777C;
                font-size: 20px;
                font-weight: normal;
                margin-top: -10px;
                margin-right: -10px;
            }

            .btn_cerrar_chat:hover{
                background-color: #DDD;
            }

            .mensajeinfo{
                line-height: 70px;
                text-align: center;
                font-family: "Segoe UI";
                height: 70px;
                text-transform: uppercase;
            }

            .usuariodesconectado{
                font-size:10px;
                text-transform: lowercase;
                color: #8d9ea7;
            }
            .usuarioenlinea{
                font-size:10px;
                text-transform: lowercase;
                color: #7ace4c;
            }
            .usuarioausente{
                font-size:10px;
                text-transform: lowercase;
                color: #ffbb44;
            }
            .usuarioocupado{
                font-size:10px;
                text-transform: lowercase;
                color: #f33155;
            }

            .textoamigonombre{
                margin-left:5px;
                font-size: 13px;
                font-family: "Segoe UI";
                text-transform: capitalize;
                margin-top: 2px;
            }
            .textobadge{
                text-align: center;
                margin-top: 10px;
            }

        </style>

    </body>

</html>

<script>

function SendMessage(e){
    if(!e)
        e=window.event;
    if(e.keyCode)
        code=e.keyCode;
    else
        code=e.which;
    if(code===13){
        id = $("#tochatname").val();
        str = "message="+$("#inputmessagechat").val()+"&to_message="+id
        Seturl = "/chat/enviarmensaje/";
        $.ajax({
            type: "POST",
            url: Seturl,
            data: str,
            success:function(msg){
                
                loadcontactschat();
                loadmessageschat(id, 'SI');
                $("#inputmessagechat").val("");
            }
        });   
    }
}

function loadcontactschat(){

    $("#openchatboxrecent").click(); 
}
function loadmessageschat(id, enable = "SI"){
    
        Seturl = "/chat/GetHistoryChat/"+id+"/";
        $.ajax({
            type: "POST",
            url: Seturl,
            success:function(msg){
                $("#historychat").html(msg);
                if (enable == "SI") {
                    $("#historychat").animate({ scrollTop: $('#historychat')[0].scrollHeight}, 100);
                }
            }
        });
}

$(".menur").click(function () {

    // Set the effect type

    var effect = 'slide';

    // Set the options for the effect type chosen

    var options = { direction: $('.ulx').left };

    // Set the duration (default: 400 milliseconds)

    var duration = 500;

    $('#myDiv').toggle(effect, options, duration);

});

function OpenHelper(who){

    $("#box-osx").fadeIn("fast");

    Seturl = "/ayuda/panel/"+who+"/";

    $.ajax({

        type: "POST",

        url: Seturl,

        success:function(msg){

            result = msg;

            $("#container_osx").html(result);

        }

    });    

}

function OpenTutorial(who, id){

    $("#lista_helper li").removeClass('active');

    $("#lista_helper #"+id).addClass('active');

        Seturl = "/ayuda/ver/"+who+"/";

            $.ajax({

                type: "POST",

                url: Seturl,

                success:function(msg){

                    result = msg;

                    $("#content_menu").html(result);

                }

            });  

        }

        $(document).ready(function(){

            $("#cerrar_precarga").click(function() {

                $("#box-osx").fadeOut("fast");

            });



            $('[data-toggle="tooltip"]').tooltip(); 

            $('[data-toggle="popover"]').popover()

});
</script>

<!-- Latest compiled and minified JavaScript 

-->

<script src="<?= HOMEDIR ?>/app/plugins/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>

<script type="text/javascript">
/*si el body es menor que el tamaño de la pantalla, (document) entonces el tamaño del content es igual al tamaño de la pantalla.
content 
*/

    //alert("Ventana: "+$(window).height()+" Body: "+$("body").height()); 

    if ($("body").height() < $(window).height()-100) {
    //alert("plop?");
        $("#content").css("min-height", $(window).height()+"px")

    }
        
    var elt = $("#col_header");  
    var elt2 = $("#col_container");
    elt.css("position","fixed");
    elt.css("z-index","999");
    elt.css("top","0px");
    elt.css("width","100%");
    elt2.css("margin-top","70px");

    /*$("#folders-content").css("height", $(window).height() -100 );

    $("#folders-content").addClass("scrollable");

    $("#content").css("height", $(window).height() -70 );*/

/*
    $(document).ready(function() {

        $(window).scroll(function () {
            var elt = $("#col_header");    
            var selt = $("#col_header"); 

            Bt = window.name = window.pageYOffset;

            if (Bt > 0){
                elt.css("position","fixed");
                elt.css("z-index","999");
                elt.css("top","0px");
                elt.css("width","100%");

            }else{
                elt.css("position","relative");
                elt.css("top","auto");
                elt.css("z-index","0");
            }

        });
  
    });*/
</script>