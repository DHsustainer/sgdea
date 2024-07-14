<?
    global $c;
    if($c->sql_quote($_REQUEST['p1']) != 'anexosbuscar'){
        $p1  = $c->sql_quote($_REQUEST['p1']);
        $status = 2;
        if ($p1 > 0) {
            $chck = $con->Query("SELECT * FROM alertas where id = '".$p1."'");
            $t = $con->FetchAssoc($chck);
            $type = $t["type"];
            $id_evento = $t["id_evento"];
            $ev = new MEvents_gestion;
            $ev->CreateEvents_gestion("id", $id_evento);
            if ($ev->Getrealizadopor() == "") {
                $path = ", realizadopor = '".$_SESSION['usuario']."', fecha_realizado = '".date("Y-m-d H:i:s")."'";
            }
            $con->Query("UPDATE alertas set status = '".$status."' where id = '$p1'");
            $con->Query("UPDATE alertas set status = '".$status."' where id_evento = '$id_evento'");
            if ($t['extra'] == "an") {
                $con->Query("UPDATE alertas set status = '".$status."' where extra = 'an' and id_gestion = '".$object->GetId()."'");
                $con->Query("UPDATE events_gestion set status = '".$status."' ".$path." where gestion_id = '".$object->GetId()."' and elm_type = 'an'");
            }
            $con->Query("UPDATE events_gestion set status = '".$status."' ".$path." where id = '$id_evento'");
        }
    }


    if ($_SESSION['suscriptor_id'] == "") {
        $type = "U";
        $user_id = $_SESSION['usuario'];
        $fieldto = 'usuario_leido';

        if ($object->Getusuario_leido() == "1") {
            $con->Query("update gestion set usuario_updated = '".date("Y-m-d H:i:s")."' where id = '".$object->GetId()."'");            
        }

    }else{
        $type = "S";
        $user_id = $_SESSION['suscriptor_id'];
        $fieldto = 'suscriptor_leido';

        if ($object->Getsuscriptor_leido() == "1") {
            $con->Query("update gestion set suscriptor_updated = '".date("Y-m-d H:i:s")."' where id = '".$object->GetId()."'");            
        }
    }



    $novedades = $con->Query("update alertas_suscriptor set estado = '1' where suscriptor_id = '".$user_id."' and estado = '0' and tipo_usuario = '".$type."' and id_gestion = '".$object->GetId()."'");

    $con->Query("update gestion set $fieldto = '0' where id = '".$object->GetId()."'");



?>
<?php
$radicado = $object->GetMin_rad();
switch (TIPO_RADICACION) {
    case '1':
        $radicado = $object->GetRadicado();
        break;
    case '2':
        if ($object->GetRadicado() != "") {
            $radicado = $object->GetMin_rad()." <small>(".$object->GetRadicado().")</small>";
        }else{
            $radicado = $object->GetMin_rad();
        }
        break;
    case '3':
        if ($object->GetMin_rad() != "") {
            $radicado = $object->GetRadicado()." <small>(".$object->GetMin_rad().")</small>";
        }else{
            $radicado = $object->GetRadicado();
        }

        break;
    default:
        $radicado = $object->GetMin_rad();
        break;
}
?>
<div class="row bg-title">
    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
        <h4 class="page-title"><?= CAMPOEXPEDIENTE ?>: <?= $radicado." - ".$object->GetObservacion() ?></h4> 
    </div>
    <div class="col-lg-8 col-sm-12 col-md-8 col-xs-12">       
<?

    $_SESSION["folder_exp"] = "0";
    $_SESSION['mayedit'] = "0";
    $sc = new MSeccional;
    $sc->CreateSeccional("id", $object->GetOficina());
    $city = new MCity;
    $city->CreateCity("code", $object->GetCiudad());
    $ar = new MAreas;
    $ar->CreateAreas("id", $object->GetDependencia_destino());
    $draiz = new MDependencias();
    $draiz->CreateDependencias("id", $object -> GetId_dependencia_raiz());
    $dep = new MDependencias();
    $dep->CreateDependencias("id", $object -> Gettipo_documento());
    $contact = new Msuscriptores_contactos;
    $contact->CreateSuscriptores_contactos("id", $object -> Getsuscriptor_id());
    $insuscriptor = false;
    $inshare = false;
    $gc = new MGestion_compartir;
    $qn = $gc->ListarGestion_compartir(" where usuario_nuevo = '".$_SESSION['usuario']."' and gestion_id = '".$object->GetId()."'");

    $com = $con->NumRows($qn);
    if ($com >= 1) {
        $inshare = true;
        $gc->CreateGestion_compartirQuery("usuario_nuevo='".$_SESSION['usuario']."' and gestion_id = '".$object->GetId()."'");
        $_SESSION['mayedit'] = $gc->GetType();
    }

    $sg = new MGestion_suscriptores;
    $qns = $sg->ListarGestion_suscriptores(" where id_suscriptor = '".$_SESSION['suscriptor_id']."' and id_gestion = '".$object->GetId()."'");
    $coms = $con->NumRows($qns);

    if ($coms >= 1) {
        $insuscriptor = true;
    }

    $nombreraiz=(strlen($draiz->GetNombre()) > 30 )? substr($draiz->GetNombre(), 0, 30)."...":$draiz->GetNombre();
    $nombredependencia=(strlen($dep->GetNombre()) > 30 )? substr($dep->GetNombre(), 0, 30)."...":$dep->GetNombre();
    $nombresuscriptor=(strlen($contact->GetNombre()) > 30 )? substr($contact->GetNombre(), 0, 30)."...":$contact->GetNombre();

    echo ' 
        <ol class="breadcrumb">
            <li class="breadcrumb-item fa fa-archive"><a href="/proceso/1/"></a></li>
            <li title="'.$draiz->GetNombre().'" class="breadcrumb-item">
                <a href="/dependencias/childs/'.$draiz->GetId().'/">'.$nombreraiz.'</a>
            </li>
            <li title="'.$dep->GetNombre().'" class="breadcrumb-item">
                <a href="/dependencias/explorar/'.$dep->GetId().'/">'.$nombredependencia.'</a>
            </li>
            <li title="'.$contact->GetNombre().'" class="breadcrumb-item">
                <a href="/dependencias/verradicaciones/'.$dep->GetId().'/'.$contact->GetId().'/">'.$nombresuscriptor.'</a>
            </li>
            <li class="breadcrumb-item active">
                <div id="boton-new-proces" style="float: left; background:#585858;">
                    <a class="no_link" href="#">';

    $rad =  explode("-", $object->GetNum_oficio_respuesta());

    global $f;
/*
    if (strlen($object->GetNum_oficio_respuesta()) > 25) {
        # code...
        echo " <div class='black_space' title='Ciudad: ".$city->GetName()."'>".$city->GetCode()."</div>";
        echo " <div class='black_space' title='Oficina: ".$sc->GetNombre()."'>".$f->zerofill($sc->GetId(),3)."</div>";
        echo " <div class='black_space' title='Area: ".$ar->GetNombre()."'>".$f->zerofill($ar->GetId(),3)."</div>";
        echo " <div class='black_space' title='Serie: ".$draiz->GetNombre()."'>".$f->zerofill($draiz->GetId_c(),3)."</div>";
        echo " <div class='black_space' title='Sub-Serie: ".$dep->GetNombre()."'>".$f->zerofill($dep->GetId_c(),3)."</div>";
        echo " <div class='black_space' title='Fecha de Registro'>".$f->zerofill($object->Getf_recibido(),3)."</div>";
        echo " <div class='black_space' title='Consecutivo del Dia'>".$f->zerofill(end($rad),3)."</div>";
    }else{
        echo " <div class='black_space' title='Fecha de Registro'>".substr($object->GetNum_oficio_respuesta(), 0, 4)."</div>";
        echo " <div class='black_space' title='Area: ".$ar->GetNombre()."'>".$f->zerofill($ar->GetId(),3)."</div>";
        echo " <div class='black_space' title='Serie: ".$draiz->GetNombre()."'>".$f->zerofill($draiz->GetId_c(),3)."</div>";
        echo " <div class='black_space' title='Sub-Serie: ".$dep->GetNombre()."'>".$f->zerofill($dep->GetId_c(),3)."</div>";
        echo " <div class='black_space' title='Consecutivo del Dia'>".$f->zerofill(end($rad),3)."</div>";
    }*/
    echo '              </a>
                    </div>
                </li>
            </ol>

            ';
            echo '
            </div>
            </div>
<div class="row">
    <div class="col-md-12 panel">
        <div class="white-panel">
        <div id="form" class="row" >
            <div class="col-md-12 col-xs-12">';

    $cview = false;
    $noedit = false;

    if ($object->Getestado_archivo() == "1") {
        if ($_SESSION['archivo_gestion'] == "1") {
            $cview = true;
        }
    }

    if ($object->Getestado_archivo() == "2") {
        if ($_SESSION['archivo_central'] == "1") {
            $cview = true;
            $noedit = true;
        }
    }

    if ($object->Getestado_archivo() == "4") {
        if ($_SESSION['archivo_gestion_nuevo'] == "1") {
            $cview = true;
            $noedit = true;
        }
    }

    if ($object->GetEstado_archivo() <= "0") {
        if ($_SESSION['archivo_historico'] == "1" || $_SESSION['typefolder'] == "3") {
            $cview = true;
            $noedit = true;
        }
    }

    $estado_archivo = $con->Query("select nombre from estadosx where valor = '".$object->GetEstado_archivo()."' and tipo = 'estado_archivo'");
    $estado_archivo = $con->Result($estado_archivo, 0, 'nombre');


    $p_location =  "<div class='alert alert-warning m-b-10' ".$c->Ayuda('328', 'tog').">Este ".CAMPOEXPEDIENTE." se encuentra $estado_archivo</div>";


    $usua = new MUsuarios;

    $usua->CreateUsuarios("user_id", $_SESSION['usuario']);

    $isboss = false;

    if ($_SESSION['t_cuenta'] == "1" && $usua->GetRegimen() == $object->GetDependencia_destino()) {

        $isboss = true;

    }

    if ($_SESSION['sadmin'] == "1") {
        $isboss = true;
    }

    $haveshared = false;

    $conx = $con->NumRows($con->Query("select * from gestion_anexos_permisos where gestion_id = '".$object->GetId()."' and usuario_permiso = '".$_SESSION['usuario']."'"));

    if ($conx >= 1) {

        $haveshared = true;

    }

     $haveshared2 = false;

    $conx = $con->NumRows($con->Query("select * from gestion_anexos_permisos_documentos where gestion_id = '".$object->GetId()."' and usuario_permiso = '".$_SESSION['usuario']."'"));

    if ($conx >= 1) {

        $haveshared2 = true;

    }

 

#aplicar tambien si es jefe de esa area...
if ((($object->Getnombre_destino() == $usua->GetA_i() || $insuscriptor || $inshare || strtolower($object->GetUsuario_registra()) == strtolower($usua->GetUser_id()) || $isboss || $haveshared || $haveshared2) && $cview) || $_SESSION['suscriptor_id'] != "") {

        if ($_SESSION['suscriptor_id'] != "") {

            $con->Query("insert consultas_varias (suscriptor_id, gestion_id, fecha, ip, type, estado) VALUES ('".$_SESSION['suscriptor_id']."', '".$object->GetId()."', '".date("Y-m-d H:i:s")."', '".$_SERVER['REMOTE_ADDR']."', 'IE', '0')");

            $con->Query("UPDATE consultas_varias set estado = '1', fecha = '".date("Y-m-d H:i:s")."', ip = '".$_SERVER['REMOTE_ADDR']."' where suscriptor_id = '".$_SESSION['suscriptor_id']."' and gestion_id = '".$object->GetId()."'");

        }

        if ($object->Getnombre_destino() == $usua->GetA_i() || strtolower($object->GetUsuario_registra()) == strtolower($usua->GetUser_id()) || $isboss) {

            $_SESSION['mayedit'] = "1";

        }

        if ($object->Getestado_archivo() == "2" || $object->Getestado_archivo() == "3") {
            $_SESSION['mayedit'] = 0;
        }

        $ocultarform = 'style="display:none;"';

        if($_SESSION['mayedit'] == "1") { 
            $ocultarform = "";
        }
?>


<div class="row">
    <div class="col-md-12 panel">
        <div class="white-panel">
        <div id="form" class="row" >
            <div class="col-md-7 col-xs-12 p-t-0">
                <div id="form" class="white" <?php echo $ocultarform; ?>>
                    <form id="upload" method="post" action="/gestion_anexos/cargar/<?=$object->GetId()?>/" enctype="multipart/form-data">
<?
    if (false == $noedit) {
        if (M_PDFA == "1"){
            echo '<div class="alert alert-info mensaje_alerta" style="margin-bottom:0px">'.PDFA.'</div>';
        }

?>
            <div class="row">
                <div class="<?= ($_SESSION['MODULES']['inmaterializacion'] == "0")?"col-md-12":"col-md-6" ?>  col-sm-12 col-xs-12"  <?= $c->Ayuda('329', 'tog') ?>>
                    <div id="drop" style="margin-left: auto; margin-right: auto;" class="dropzone  dropify-message <?= $pathw ?> fullwidthblock">

                        <a class="m-b-30 m-t-30">
                            <span class="mdi mdi-cloud-upload cloudicon"></span> 
                            <br>Arrastra los Archivos o haga clic aqui<br><br>
                        </a>
                        <div style="display:none">
                            <input type="file" name="upl" multiple />
                        </div>
                        <ul></ul>
                    </div>
                </div>
                <?php if ($_SESSION['MODULES']['digitalizacion'] == "0"): ?>
                            
<?
            $pathw = (trim($_SESSION['MODULES']['inmaterializacion']) == "1")?" ":"fullwidthblock";
            if ($_SESSION['MODULES']['inmaterializacion'] == "1") {

?>
                <div class="col-md-6 hidden-xs hidden-sm">
                    <div id="dropdocto text-info " class="dropify-message" <?= $c->Ayuda(78, 'tog') ?>>
                        <div class="m-b-30 text-center">
                            <span class="mdi mdi-file-pdf cloudicon"></span> <br>
                            <a href="/documentos_gestion/nuevo/<?= $object->GetId() ?>/" class="btn btn-info">Producir Documento</a>
                        </div>
                    </div>
                </div>
<?
            }
?>                    
                        <?php endif ?>
            </div>
               
<?
    }

?>

<style>
   
.dropify-message{
    color: #CCC;
}
.dropify-message a{
    font-weight: normal;
    color: #CCC;
    text-align:center;
}
.dropify-message .cloudicon{
    font-size: 50px;
}
#drop {
    text-align: center;
    font-weight: bold;
}

#drop.in {
    z-index: 9999;
    position: fixed;
    width: 100%;
    height: 90%;
    top: 70px;
    left:0px;

    background-color: #373a3d;
    -webkit-box-shadow: inset 0 -1px 0 rgba(0,0,0,.15);
    box-shadow: inset 0 -1px 0 rgba(0,0,0,.15);
    -webkit-transition: width .6s ease;
    -o-transition: width .6s ease;
    transition: width .6s ease;

    background-image: -webkit-linear-gradient(45deg,rgba(0,0,0,.15) 25%,transparent 25%,transparent 50%,rgba(0,0,0,.15) 50%,rgba(0,0,0,.15) 75%,transparent 75%,transparent);
    background-image: -o-linear-gradient(45deg,rgba(0,0,0,.15) 25%,transparent 25%,transparent 50%,rgba(0,0,0,.15) 50%,rgba(0,0,0,.15) 75%,transparent 75%,transparent);
    background-image: linear-gradient(45deg,rgba(0,0,0,.15) 25%,transparent 25%,transparent 50%,rgba(0,0,0,.15) 50%,rgba(0,0,0,.15) 75%,transparent 75%,transparent);
    -webkit-background-size: 40px 40px;
    background-size: 40px 40px;

    -webkit-animation: progress-bar-stripes 2s linear infinite;
    -o-animation: progress-bar-stripes 2s linear infinite;
    animation: progress-bar-stripes 2s linear infinite;
}

#drop.hover {
    background-color: #373a3d;
    -webkit-box-shadow: inset 0 -1px 0 rgba(0,0,0,.15);
    box-shadow: inset 0 -1px 0 rgba(0,0,0,.15);
    -webkit-transition: width .6s ease;
    -o-transition: width .6s ease;
    transition: width .6s ease;

    background-image: -webkit-linear-gradient(45deg,rgba(0,0,0,.15) 25%,transparent 25%,transparent 50%,rgba(0,0,0,.15) 50%,rgba(0,0,0,.15) 75%,transparent 75%,transparent);
    background-image: -o-linear-gradient(45deg,rgba(0,0,0,.15) 25%,transparent 25%,transparent 50%,rgba(0,0,0,.15) 50%,rgba(0,0,0,.15) 75%,transparent 75%,transparent);
    background-image: linear-gradient(45deg,rgba(0,0,0,.15) 25%,transparent 25%,transparent 50%,rgba(0,0,0,.15) 50%,rgba(0,0,0,.15) 75%,transparent 75%,transparent);
    -webkit-background-size: 40px 40px;
    background-size: 40px 40px;

    -webkit-animation: progress-bar-stripes 2s linear infinite;
    -o-animation: progress-bar-stripes 2s linear infinite;
    animation: progress-bar-stripes 2s linear infinite;

    content: "Arrastre sus documentos aqui";
}

#drop.fade {
    -webkit-transition: all 0.3s ease-out;
    -moz-transition: all 0.3s ease-out;
    -ms-transition: all 0.3s ease-out;
    -o-transition: all 0.3s ease-out;
    transition: all 0.3s ease-out;
    opacity: 1;
}
.dropzone{
    border: none;
    cursor:pointer;
    text-align: center;
}
#upload:hover{
    background-color: #373a3d;
    -webkit-box-shadow: inset 0 -1px 0 rgba(0,0,0,.15);
    box-shadow: inset 0 -1px 0 rgba(0,0,0,.15);
    -webkit-transition: width .6s ease;
    -o-transition: width .6s ease;
    transition: width .6s ease;

    background-image: -webkit-linear-gradient(45deg,rgba(0,0,0,.15) 25%,transparent 25%,transparent 50%,rgba(0,0,0,.15) 50%,rgba(0,0,0,.15) 75%,transparent 75%,transparent);
    background-image: -o-linear-gradient(45deg,rgba(0,0,0,.15) 25%,transparent 25%,transparent 50%,rgba(0,0,0,.15) 50%,rgba(0,0,0,.15) 75%,transparent 75%,transparent);
    background-image: linear-gradient(45deg,rgba(0,0,0,.15) 25%,transparent 25%,transparent 50%,rgba(0,0,0,.15) 50%,rgba(0,0,0,.15) 75%,transparent 75%,transparent);
    -webkit-background-size: 40px 40px;
    background-size: 40px 40px;

    -webkit-animation: progress-bar-stripes 2s linear infinite;
    -o-animation: progress-bar-stripes 2s linear infinite;
    animation: progress-bar-stripes 2s linear infinite;

}

#upload{
    background-color: #373a3d; 
    padding: 10px; 
    margin-top:25px
}

#upload ul{
    list-style:none;
    margin-bottom:0px !important;
    padding-left:0px;
}
#upload ul li{
    background-color:#CCC;
    background-image:-webkit-linear-gradient(top, #333639, #303335);
    background-image:-moz-linear-gradient(top, #333639, #303335);
    background-image:linear-gradient(top, #333639, #303335);
    border-top:1px solid #3d4043;
    border-bottom:1px solid #2b2e31;
    padding:15px;
    height: 75px;
    position: relative;
}
#upload ul li input{
    display: none;
}
#upload ul li p{
    width: 70%;
    overflow: hidden;
    white-space: nowrap;
    color: #EEE;
    font-size: 16px;
    font-weight: bold;
    position: absolute;
    left: 100px;
    text-align:left;
}
#upload ul li i{
    font-weight: normal;
    font-style:normal;
    color:#7f7f7f;
    display:block;
}
#upload ul li canvas{
    top: 15px;
    left: 32px;
    position: absolute;
}
#upload ul li span{
    width: 15px;
    height: 12px;
    background: url('<?= HOMEDIR.DS ?>app/views/assets/images/icons.png') no-repeat;
    position: absolute;
    top: 34px;
    right: 33px;
    cursor:pointer;
}
#upload ul li.working span{
    height: 16px;
    background-position: 0 -12px;
}
#upload ul li.error p{
    color:red;
}

.menu-expediente{
    font-size: 30px;
    border-right:1px solid #E5E5E5;
}
.submenu_box{
    background: #f7fafc;
    border:1px solid #E5E5E5;
}

</style>  

<script type="text/javascript">


    $(document).bind('dragover', function (e) {

        var pos = 50;

        var dropZone = $('#drop'),

            timeout = window.dropZoneTimeout;

        if (!timeout) {

            $('#folders-list-content').animate({ scrollTop : 0 }, 'fast');

            dropZone.addClass('in');

        } else {

            clearTimeout(timeout);

        }

        var found = false,

            node = e.target;

        do {

            if (node === dropZone[0]) {

                found = true;

                break;

            }

            node = node.parentNode;

        } while (node != null);

        if (found) {

            dropZone.addClass('hover');

        } else {

            dropZone.removeClass('hover');

        }

        window.dropZoneTimeout = setTimeout(function () {

            window.dropZoneTimeout = null;

            dropZone.removeClass('in hover');

            $('#folders-list-content').animate({ scrollTop : 0 }, 'fast');

        }, 100);

    });

</script>    
    </form>    
</div>

<ul class="nav nav-pills" id="menu_tab">
<?
    $path = "";
    $r = $con->Result($con->Query("select count(*) as t from ref_tables where dependencia_id = '".$object->Gettipo_documento()."'"), 0, 't');
    if ($r <= 0) {
        $path = "style='display:none'";
    }
    $pathwf = "";
    $rwf = $con->Result($con->Query("select count(*) as t from wf_gestion_mapas where id_gestion = '".$object->GetId()."'"), 0, 't');

    if ($rwf <= 0) {
        $pathwf = "style='display:none'";
    }
    #if ($object->Getnombre_destino() == $usua->GetA_i() || $_SESSION['mayedit'] == "1" || $isboss ) {
?>
        <li class=" opcion menu-expediente anexos " id="cargador_box_upfiles_menu" > 
            <a href="/gestion/ver/<?= $object->GetId() ?>/anexos/" class="fa fa-folder-open" aria-expanded="false" <?= $c->Ayuda('61', 'tog') ?>></a> 
        </li>
        <li class="opcion menu-expediente anexos " id="cargador_box_actuaciones"> 
            <a href="/gestion/ver/<?= $object->GetId() ?>/actuaciones/"  class="fa fa-history"  aria-expanded="false" <?= $c->Ayuda('62', 'tog') ?>></a> 
        </li>
<?
    if ($_SESSION['MODULES']['inmaterializacion'] == "1") {
?>         
<?php   if ($_SESSION['MODULES']['digitalizacion'] == "0"): ?>
                            
            <li class="opcion menu-expediente anexos docsnew hidden-xs " id="cargador_box_crfiles_menu"> 
                <a href="/gestion/ver/<?= $object->GetId() ?>/documentos/"  class="fa fa-file-pdf-o"  aria-expanded="false" <?= $c->Ayuda('63', 'tog') ?>></a> 
            </li>
        <?php endif ?>   
<?
    }

?>        
<?
    if ($_SESSION['MODULES']['actuaciones'] == "1") {
?>    
<?php if ($_SESSION['MODULES']['digitalizacion'] == "0"): ?>
                            
        <li class="opcion menu-expediente anexos" id="cargador_box_alertas"> 
            <a href="/gestion/ver/<?= $object->GetId() ?>/alertas/"  class="fa fa-bell"  aria-expanded="false" <?= $c->Ayuda('64', 'tog') ?>></a> 
        </li>
<?php endif ?>
<?
    }

?>  
<?
        if ($_SESSION['MODULES']['workflow'] == "1") {
?>
<?php if ($_SESSION['MODULES']['digitalizacion'] == "0"): ?>
                            
            <li class="opcion menu-expediente hidden-xs " id="cargador_box_upfiles_menu"> 
                <a href="/flujos/gestion/<?= $object->GetId() ?>/S/"  class="fa fa-cubes"  aria-expanded="false" <?= $c->Ayuda('65', 'tog') ?>></a> 
            </li>
                        <?php endif ?>
<?                
        }
?>
        <li class="opcion menu-expediente anexos hidden-xs dn" id="cargador_box_suscriptores"> 
            <a href="/gestion/ver/<?= $object->GetId() ?>/suscriptores/"  class="fa fa-users"  aria-expanded="false" <?= $c->Ayuda('66', 'tog') ?>></a> 
        </li>
        <li class="opcion menu-expediente anexos <?= M_ALERTA_COMPARTIDOS ?> " id="cargador_box_compartir"> 
            <a href="/gestion/ver/<?= $object->GetId() ?>/compartir/"  class="fa fa-share-alt"  aria-expanded="false" <?= $c->Ayuda('67', 'tog') ?>></a> 
        </li>
        <?php if ($_SESSION['MODULES']['digitalizacion'] == "0"): ?>
                            
<?
        if ($_SESSION['MODULES']['correo_electronico'] == "1"){
?>            
        <!--<li class="opcion menu-expediente anexos dn" id="cargador_box_inbox"> 
            <a href="/gestion/ver/<?= $object->GetId() ?>/inbox/"   class="fa fa-at"  aria-expanded="false" <?= $c->Ayuda('68', 'tog') ?>></a> 
        </li> -->
<?
        }
        if ($_SESSION['MODULES']['correo_fisico'] == "1"){
?>            
        <li class="opcion menu-expediente anexos " id="cargador_box_mailbox"> 
            <a href="/gestion/ver/<?= $object->GetId() ?>/correspondencia/"  class="fa fa-envelope"  aria-expanded="false" <?= $c->Ayuda('69', 'tog') ?>></a> 
        </li>
<?
        }
?>
        <?php endif ?>
        <!--<div class="opcion menu-expediente fa fa-bars impr_box_del_menu" title="Otras Herramientas">
            <ul>
                <?
                    $permisos = $_SESSION['vector'][0];
                    if ($permisos[0] == "") {
                        echo '<li><a href="#" class="link-blanco">No hay modulos extras Implementados</a></li>';
                    }else{
                        $z = 0;
                        for ($k=0; $k < count($permisos) ; $k++) { 
                            $link = explode(":", $permisos[$k]);
                            if ($link[3] == "*" || $link[3] == $dep->GetId() ) {
                                $z++;
                                echo '<li>
                                        <a href="gestion/ver/'.$object->GetId().'/'.$link[1].'/" class="link-blanco">
                                            <span class="fa '.$link[2].'"></span>
                                            '.$link[0].'
                                        </a>
                                    </li>';
                            }
                        }
                        if ($z == 0) {
                            echo '<li><a href="#" class="link-blanco">No hay modulos extras Implementados</a></li>';
                        }
                    }
                ?>
            </ul>
        </div>
        <style>
            .impr_box_del_menu ul, .impr_box_main_menu ul {
                background: #1579C4;
                margin-top: 7px;
            }
        </style> -->

</ul>
<div id="container_activities " class="p-10 p-t-30" style="width: 100%;">
    <div id="cargador_box_upfiles"></div>
</div>

<button type="button" class="btn btn-primary btn-lg" style="display: none" data-role="0" id="mymodalxx" data-toggle="modal" data-target="#myModal">G</button>
<div class="modal fade bs-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" id="aria-colse" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title" id="myModalLabel">Cargar Soportes y Tipologías de los Documentos</h4>
      </div>
      <div class="modal-body">
        <div class="row" style="margin:0px">
            <div class="col-md-12" id="listar-anexos-actualizar">
                
            </div>
        </div>
      </div>    
    </div>
  </div>
</div>
<script type="text/javascript">
    $('#myModal').on('shown.bs.modal', function () {
        $('#myInput').focus()
    })
</script>
<script src="<?=ASSETS?>/js/jquery.knob.js"></script>

<!-- jQuery File Upload Dependencies -->

<script src="<?=ASSETS?>/js/jquery.ui.widget.js"></script>

<script src="<?=ASSETS?>/js/jquery.iframe-transport.js"></script>

<script src="<?=ASSETS?>/js/jquery.fileupload.js"></script>

<!-- Our main JS file -->

<script src="<?=ASSETS?>/js/script.js"></script>

<script type="text/javascript">

    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip(); 
        $('[data-toggle="popover"]').popover()
    });

    function LoadSeleccion(id){
        var URL = '/gestion_anexos/listar_actualizar/'+id+'/';   
        $.ajax({
            type: 'POST',
            url: URL,
            success:function(msg){
                $("#listar-anexos-actualizar").html(msg);
            } 
        });
        if ($("#mymodalxx").attr('data-role') == "0") {
            $("#mymodalxx").click();
            $("#mymodalxx").attr("data-role", "1"); 
        }

    }

    $("#aria-colse").click(function(){
        $("#mymodalxx").attr("data-role", "0");
        window.location.reload();
    })

    <?

        $myaction = $_REQUEST['cn'];

        $arx = array(   '' =>  '/gestion/GetAnexos/'.$object->GetId().'/0/1/',                                 

                        'anexos' => '/gestion/GetAnexos/'.$object->GetId().'/0/1/', 

                        'anexosbuscar' => '/gestion/GetAnexosBuscar/'.$object->GetId().'/'.$_REQUEST['p1'].'/', 

                        'actuaciones' => '/gestion/GetActuaciones/'.$object->GetId().'/1/',

                        'documentos' => '/gestion/GetDocumentos/'.$object->GetId().'/',

                        'formularios' => '/gestion/GetFormularios/'.$object->GetId().'/'.$dep->GetId().'/',

                        'alertas' => '/gestion/GetAlertas/'.$object->GetId().'/'.$dep->GetId().'/',

                        'suscriptores' => '/gestion/GetSuscriptores/'.$object->GetId().'/',

                        'compartir' => '/gestion/GetShared/'.$object->GetId().'/',

                        'inbox' => '/gestion/GetInbox/'.$object->GetId().'/',

                        'correspondencia' => '/gestion/GetMailbox/'.$object->GetId().'/'

                    );

        $ary = array(

                        '' =>  'cargador_box_upfiles_menu',                                     

                        "anexos" => 'cargador_box_upfiles_menu', 

                        "anexosbuscar" => 'cargador_box_upfiles_menu',

                        'actuaciones' => 'cargador_box_actuaciones',

                        'documentos' => 'cargador_box_crfiles_menu',

                        'formularios' => 'cargador_box_forms',

                        'alertas' => 'cargador_box_alertas',

                        'suscriptores' => 'cargador_box_suscriptores',

                        'compartir' => 'cargador_box_compartir',

                        'inbox' => 'cargador_box_inbox',

                        'correspondencia' => 'cargador_box_mailbox'

                    );

        if ($permisos[0] != "") {

            for ($k=0; $k < count($permisos) ; $k++) { 

                $link = explode(":", $permisos[$k]);

                if ($link[3] == "*" || $link[3] == $dep->GetId() ) {

                    $ary[$link[1]] = $link[1];

                    $arx[$link[1]] = "/".$link[1]."/".$object->GetId()."/";

                }

            }

        }

    ?>

    showfiles('<?= $arx[$myaction] ?>', '<?= $ary[$myaction] ?>');

    function EditGestion(id){

        $('#FormUpdategestion .input1').removeClass('no_editable');

        $('#FormUpdategestion .input1').addClass('editable');

        $('#FormUpdategestion .input1').prop('disabled', false);

        $('#edit_opcgestion').hide();

        $('#save_opcgestion').show();

        $('#FormUpdategestion .tempspace').css("display","none");

    } 

    function EditGestion2(id){

        $('#FormUpdategestion .input2').removeClass('no_editable');

        $('#FormUpdategestion .input2').addClass('editable');

        $('#FormUpdategestion .input2').prop('disabled', false);

        $('#edit_opcgestion2').hide();

        $('#save_opcgestion').show();

        $('#FormUpdategestion .tempspace2').css("display","none");

    } 

    function GetFilterdAnexos(){

        $('#menu_tab > div').removeClass('active');
        $("#cargador_box_actuaciones").addClass('active');
        $('#cargador_box_upfiles').slideUp('fast');
        //location.replace();
        
        var URL = '/gestion/GetActuaciones/<?= $object->GetId() ?>/1/';
        var str = $("#formfilterexp").serialize();

        $.ajax({
            type: 'POST',
            url: URL,
            data: str,
            success: function(msg){
                result = msg;
                $('#cargador_box_upfiles').html(result);
                $('#cargador_box_upfiles').slideDown('fast');
            }
        }); 
    }

</script>

            </div>

<?  

            $bloquear_del_todo = false;

        }else{

            $bloquear_del_todo = true;

            echo '
            </div>
            </div>
<div class="row">
    <div class="col-md-12 panel">
        <div class="white-panel">
        <div id="form" class="row" >
            <div class="col-md-12 col-xs-12">
                <div class="col-md-7 col-xs-12">';
            echo "  <div class='alert alert-danger m-t-30' role='alert' >El expediente que intenta explorar no se encuentra registrado en su ".CAMPOAREADETRABAJO." o no esta compartido con usted</div>";
            echo "</div>";

        }

?>

            <div class="col-md-5 col-xs-12 p-t-20">

                <h4 class="hidden"><?= CAMPOIDRAD ?> <? echo $object -> Getnum_oficio_respuesta(); ?></h4>

                <?= $p_location ?>
                <?= ($object->GetRweb() == "1")?"<div class='alert alert-info m-b-10'>Expediente Registrado desde la Web</div>":"" ?>
                <div id="newbloque_formularios">
                    
                    <ul class="nav nav-tabs" id="formnavigation">
                        <li role="presentation" id="mainelm" class="active" <?= $c->Ayuda(80, 'tog') ?>>
                            <a href="#" onClick="AbrirFormulario('main', '<?= $object->GetId() ?>', 'mainelm')">
                                Datos del <?= CAMPOEXPEDIENTE ?>
                            </a>
                        </li>
                    <?
                        
                    $queryforms = $con->Query("select ref_id, grupo_id from meta_big_data where type_id = '".$object->GetId()."' and tipo_form = '1' group by grupo_id");
                    
                    
                    while ($rowform = $con->FetchAssoc($queryforms)) {
                        $nomform = $c->GetDataFromTable("meta_referencias_titulos", "id", $rowform['ref_id'], "titulo", $separador = " ");

                        echo '  <li role="presentation" id="'.$rowform['grupo_id'].'" '.$c->Ayuda(82, 'tog').'>
                                    <a href="#" onClick="AbrirFormulario(\'form\', \''.$rowform['grupo_id'].'\', \''.$rowform['grupo_id'].'\')">'.$nomform.'
                                    </a>
                                </li>';
                        
                    }
                    ?>
                        <li role="presentation" id="newform"  <?= $c->Ayuda(81, 'tog') ?>>
                            <a href="#" onClick="AbrirFormulario('newform', '<?= $object->GetId() ?>', 'newform')" class="fa fa-plus"></a>
                        </li>

                    </ul>
                    <div id="contenedor_formulario" class="scrollable p-l-10" style="border-left:1px solid rgba(120, 130, 140, 0.13)"></div>
                </div>

                <script type="text/javascript">
                    function AbrirFormulario(tipo, id, selector){
                        $("#formnavigation li").removeClass("active");

                        $("#"+selector).addClass("active");

                        if (tipo == "main") {
                            $("#mainelm").addClass("active");
                        };

                        var URL = '/gestion/verform/'+id+'/'+tipo+'/';
                        $.ajax({
                            type: 'POST',
                            url: URL,
                            success: function(msg){
                                $('#contenedor_formulario').html(msg);
                            }
                        });

                    }

                    AbrirFormulario('main', '<?= $object->GetId() ?>');
                </script>

            </div>
        </div>
    </div>
</div>

<style type="text/css">

     .black_space{
        height: 30px;
        line-height: 18px;
        color: #fff;
        background-color: #585858;
        padding: 8px;
        float: left;
        border-radius: 6px
    }

</style>

    <div style="display:none">

        <p><strong>Upload Files:</strong>

            <form method="post" id="sendfiles" enctype="multipart/form-data"> 

                <input type="file" name="pictures[]" id="pictures[]" class="selfile" multiple onChange="makeFileList();" />

            </form>

        </p>

        <ul id="fileList"><li>No Files Selected</li></ul>

        <div id="output1"></div>

        <div id="fmid">id</div>

        <div class="progress">

            <div class="bar"></div>

            <div class="percent">0%</div>

        </div>

    </div>

<script src="<?= HOMEDIR.DS ?>/app/plugins/malsup/jquery.form.js"></script> 

<script>

    $(document).ready(function() { 

        var options = { 

            target:        '#output1',      // target element(s) to be updated with server response 

            beforeSubmit:  showRequest,    // pre-submit callback 

            success:       showResponse,  // post-submit callback 

            // other available options: 

            url:       "/meta_big_data/upload/",   // override for form's 'action' attribute 

            type:      "POST",        // 'get' or 'post', override for form's 'method' attribute 

            //dataType:  null        // 'xml', 'script', or 'json' (expected server response type) 

            clearForm: true,        // clear all form fields after successful submit 

            resetForm: true        // reset the form after successful submit 

             // $.ajax options can be used here too, for example: 

            //timeout:   3000 

        }; 

        // bind form using 'ajaxForm' 

        $('#sendfiles').ajaxForm(options); 

    }); 

    // pre-submit callback 

function showRequest(formData, jqForm, options) { 

        // formData is an array; here we use $.param to convert it to a string to display it 

        // but the form plugin does this for you automatically when it submits the data 

    var queryString = $.param(formData); 

        // jqForm is a jQuery object encapsulating the form element.  To access the 

        // DOM element for the form do this: 

        // var formElement = jqForm[0]; 

    //alert('About to submit: \n\n' + queryString); 

        // here we could return false to prevent the form from being submitted; 

        // returning anything other than false will allow the form submit to continue 

    return true; 

} 

// post-submit callback 

function showResponse(responseText, statusText, xhr, $form)  { 

    // for normal html responses, the first argument to the success callback 

    // is the XMLHttpRequest object's responseText property 

    // if the ajaxForm method was passed an Options Object with the dataType 

    // property set to 'xml' then the first argument to the success callback 

    // is the XMLHttpRequest object's responseXML property 

    // if the ajaxForm method was passed an Options Object with the dataType 

    // property set to 'json' then the first argument to the success callback 

    // is the json data object returned by the server 

    //alert('status: ' + statusText + '\n\nresponseText: \n' + responseText); 

    $("#elm"+$("#fmid").text()).val(responseText);

    var imagenes = responseText.split(";");

    var mylist = $("#mylist"+$("#fmid").text()).val();

    $("#minilista"+$("#fmid").text()).html(imagenes.length+" Documentos Cargados");

    $("body").css("cursor", "normal");

    alert("Documentos Cargados Correctamente")

    str = "valor="+mylist+responseText+"&id="+$("#fmid").text();

    $.ajax({

        type: "POST",

        url: "/meta_big_data/actualizar/",

        data: str,

        success:function(msg){

            result = msg;

            //$("#update_field").html("<div class='alert alert-info'>"+result+"</div>");

        }

    });

}   

function makeFileList() {

        var input = document.getElementById("pictures[]");

        var cont = 0;

        //alert(input.files[i].name);

        var milistado = "innerlista"+$("#fmid").text();

        var ul =   document.getElementById("fileList");

        var minl = document.getElementById(milistado);

        while (ul.hasChildNodes()) {

            ul.removeChild(ul.firstChild);

        }

        for (var i = 0; i < input.files.length; i++) {

            cont++;

            var li = document.createElement("li");

            li.innerHTML = input.files[i].name;

            ul.appendChild(li);

        }

        if(!ul.hasChildNodes()) {

            var li = document.createElement("li");

            li.innerHTML = 'No Files Selected';

            ul.appendChild(li);

        }

        //while (minl.hasChildNodes()) {

        //    minl.removeChild(minl.firstChild);

        //}

        for (var i = 0; i < input.files.length; i++) {

            cont++;

            var li = document.createElement("li");

            li.innerHTML = input.files[i].name;

            minl.appendChild(li);

        }

        if(!minl.hasChildNodes()) {

            var li = document.createElement("li");

            li.innerHTML = 'No Files Selected';

            minl.appendChild(li);

        }

        $("#num").html(cont);

    }

</script>   