<?php
global $c;
$radicado = $object->GetMin_rad();
switch (TIPO_RADICACION) {
    case '1':
        $radicado = $object->GetRadicado();
        break;
    case '2':
        $radicado = $object->GetMin_rad()." <small>(".$object->GetRadicado().")</small>";
        break;
    case '3':
        $radicado = $object->GetRadicado()." <small>(".$object->GetMin_rad().")</small>";
        break;
    default:
        $radicado = $object->GetMin_rad();
        break;
}
?>
<div class="row bg-title">
    <div class="col-lg-5 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title">Expediente: <?= $radicado." - ".$object->GetObservacion() ?></h4> 
    </div>
     
    <div class="col-lg-7 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
<?

    

    $_SESSION["folder_exp"] = "0";
    $_SESSION['mayedit'] = "1";
    $sc = new MSeccional;
    $sc->CreateSeccional("id", $object->GetOficina());
    $city = new MCity;
    $city->CreateCity("code", $object->GetCiudad());
    $ar = new MAreas;
    $ar->CreateAreas("id", $object->GetDependencia_destino());
    # code...
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
        $gc->CreateGestion_compartirQuery("usuario_nuevo = '".$_SESSION['usuario']."' and gestion_id = '".$object->GetId()."'");
        $_SESSION['mayedit'] = $gc->GetType();

    }
    $sg = new MGestion_suscriptores;
    $qns = $sg->ListarGestion_suscriptores(" where id_suscriptor = '".$_SESSION['suscriptor_id']."' and id_gestion = '".$object->GetId()."'");
    $coms = $con->NumRows($qns);
    if ($coms >= 1) {
        $insuscriptor = true;
    }
        $sc = new MSeccional;
        $sc->CreateSeccional("id", $object->GetOficina());
        $city = new MCity;
        $city->CreateCity("code", $object->GetCiudad());
        $ar = new MAreas;
        $ar->CreateAreas("id", $object->GetDependencia_destino());
        $nombreraiz =           (strlen($draiz->GetNombre()) > 40 )? substr($draiz->GetNombre(), 0, 40)."...":$draiz->GetNombre();
        $nombredependencia =    (strlen($dep->GetNombre()) > 40 )? substr($dep->GetNombre(), 0, 40)."...":$dep->GetNombre();
        $nombresuscriptor =     (strlen($contact->GetNombre()) > 40 )? substr($contact->GetNombre(), 0, 40)."...":$contact->GetNombre();
        echo '
                <!--<li class="breadcrumb-item"><a href="'.HOMEDIR.'/suscriptores_contactos/dependenciassus2/'.$id.'/'.$idd.'/">'.$nombreraiz.'</a></li>-->
                <li class="breadcrumb-item"><a href="'.HOMEDIR.'/suscriptores_contactos/verradicaciones/'.$id.'/'.$ids.'/">'.$nombredependencia.'</a></li>';    
        echo '  <li class="breadcrumb-item active">
                    <div id="boton-new-proces black" style="float: left;background: #585858;margin-top: -6px; border-radius:6px">
                            <a class="no_link" href="#">';
        $rad =  explode("-", $object->GetNum_oficio_respuesta());
        global $f;
       /* if (strlen($object->GetNum_oficio_respuesta()) > 25) {
            # code...
            echo "                  <div style='background:#585858;' class='black_space'>".$city->GetCode()."<div class='toosltip'>Ciudad:<br>".$city->GetName()."</div></div>";
            echo "                  <div  style='background:#585858;'  class='black_space'>".$f->zerofill($sc->GetId(),3)."<div class='toosltip'>Oficina<br>".$sc->GetNombre()."</div></div>";
            echo "                  <div  style='background:#585858;'  class='black_space'>".$f->zerofill($ar->GetId(),3)."<div class='toosltip'>Area:<br>".$ar->GetNombre()."</div></div>";
            echo "                  <div  style='background:#585858;'  class='black_space'>".$f->zerofill($draiz->GetId_c(),3)."<div class='toosltip'>Serie:<br>".$draiz->GetNombre()."</div></div>";
            echo "                  <div  style='background:#585858;'  class='black_space'>".$f->zerofill($dep->GetId_c(),3)."<div class='toosltip'>Sub-Serie<br>".$dep->GetNombre()."</div></div>";
            echo "                  <div  style='background:#585858;'  class='black_space'>".$f->zerofill($object->Getf_recibido(),3)."<div class='toosltip'><br>Fecha de Registro</div></div>";
            echo "                  <div  style='background:#585858;'  class='black_space'>".$f->zerofill(end($rad),3)."<div class='toosltip'><br>Consecutivo del Dia</div></div>";
        }else{
            echo "                  <div  style='background:#585858;'  class='black_space'>".substr($object->GetNum_oficio_respuesta(), 0, 4)."<div class='toosltip'><br>Fecha de Registro</div></div>";
            echo "                  <div  style='background:#585858;'  class='black_space'>".$f->zerofill($ar->GetId(),3)."<div class='toosltip'>Area:<br>".$ar->GetNombre()."</div></div>";
            echo "                  <div  style='background:#585858;'  class='black_space'>".$f->zerofill($draiz->GetId_c(),3)."<div class='toosltip'>Serie:<br>".$draiz->GetNombre()."</div></div>";
            echo "                  <div  style='background:#585858;'  class='black_space'>".$f->zerofill($dep->GetId_c(),3)."<div class='toosltip'>Sub-Serie<br>".$dep->GetNombre()."</div></div>";
            echo "                  <div  style='background:#585858;'  class='black_space'>".$f->zerofill(end($rad),3)."<div class='toosltip'><br>Consecutivo</div></div>";
        }*/
        echo '              </a>
                        </div>
                    </li>';


?>     

        </ol>
    </div>
</div>
<div class="row">
    <div class="col-md-12 panel">
        <div class="white-panel">
<?

    $cview = false;

    $noedit = false;

    if ($object->Getestado_archivo() == "1") {

        if ($_SESSION['archivo_gestion'] == "1") {

            $cview = true;

        }

        $path = "en el archivo de Gestión";

    }

    if ($object->Getestado_archivo() == "2") {

        if ($_SESSION['archivo_central'] == "1") {

            $cview = true;

        }

        $path = "en el archivo de Central";

    }

    if ($object->GetEstado_archivo() <= "0") {

        if ($_SESSION['archivo_historico'] == "1" || $_SESSION['typefolder'] == "3") {

            $cview = true;

            $noedit = true;

        }

        $path = "ARCHIVADO";

    }

    /*if ($cview) {

        $path = "puede ingresar";

    }else{

        $path = "no puede ingresar";

    }*/

    $p_location =  "<div class='alert alert-warning' role='alert' align='center'>Este expediente se encuentra $path</div>";

?>

    <?

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

    ?>      

        <?php 

        if ($object->Getestado_archivo() == "2" || $object->Getestado_archivo() == "3") {

            $_SESSION['mayedit'] = 0;

        }


        $ocultarform = 'style="display:none;"';

        if($_SESSION['mayedit'] != "0") { 

            $ocultarform = "";

        
        }



        ?>


<!-- A PARTIR DE AQUI DEBE IR LA CONDICION -->
    <input type="hidden" id="id" value="<?=  $object->GetId() ?>">
        <div id="form" >

            <div id="crear-nota" class="right table scrollable bodyexpediente" style="height:100%; width:58%; float:left; padding-left: 10px; padding-right: 0px;; padding-top: 0px;">

<div id="form" class="white" <?php echo $ocultarform; ?>>

    <form id="upload" method="post" action="/gestion_anexos/cargar/<?=$object->GetId()?>/" enctype="multipart/form-data">

<?

    if (false == $noedit) {

        echo '<div class="alert alert-info" align="center" style="margin-bottom:0px">Para garantizar a los documentos en soporte de papel la preservación,  reproducción con exactitud  y el foliado  electrónico, deben ser guardado con el estándar PDF/A.</div>';

     

?>
            <div id="drop" style="margin-left: auto; margin-right: auto;" class="dropzone  dropify-message <?= $pathw ?> fullwidthblock">

                    <a class="m-b-30 m-t-30">
                    <span class="mdi mdi-cloud-upload cloudicon"></span> 
                    <br>
                        Arrastra los Archivos o haga clic aqui
                        <br><br>
                    </a>
                <div style="display:none">
                    <input type="file" name="upl" multiple />
                </div>
                <ul></ul>

            </div>

              <!--<div id="drop" class="dropzone <?= $pathw ?>">

                        Cargar Documentos

                        <br>

                        <a>Buscar</a>

                        <input type="file" name="upl" multiple />

                    </div>-->


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

    #drop{

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

        var pos = $("#crear-nota").offset().top - 130;

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
<?
    $acta = "";
    $actb = "";

    if ($_REQUEST['cn'] == 'alertas') {
        $acta = "";
        $actb = "active";
    }else{
        $actb = "";
        $acta = "active";
    }
?>
<ul class="nav nav-pills submenu_box menu-expediente" id="menu_tab">
    <li class="<?= $acta ?>"> 
        <a href="/gestion/ver/<?= $object->GetId() ?>/anexos/" id="cargador_box_upfiles_menu" class="opcion menu-expediente anexos fa fa-folder-open"  aria-expanded="false" title="Doc. Cargados"  data-toggle="tooltip"></a> 
    </li>
    <li class="<?= $actb ?> opcion menu-expediente anexos " id="cargador_box_alertas"> 
        <a href="/gestion/ver/<?= $object->GetId() ?>/alertas/"  class="fa fa-history"  aria-expanded="false" ></a> 
    </li>
</ul>

<div id="container_activities " class="p-10 p-t-30" style="width: 100%; border-left:1px solid #E5E5E5; border-bottom:1px solid #E5E5E5">
    <div id="cargador_box_upfiles"></div>
</div>

<script src="<?=ASSETS?>/js/jquery.knob.js"></script>

<!-- jQuery File Upload Dependencies -->

<script src="<?=ASSETS?>/js/jquery.ui.widget.js"></script>

<script src="<?=ASSETS?>/js/jquery.iframe-transport.js"></script>

<script src="<?=ASSETS?>/js/jquery.fileupload.js"></script>

<!-- Our main JS file -->

<script src="<?=ASSETS?>/js/script.js"></script>

<script type="text/javascript">

    <?

        $myaction = $_REQUEST['cn'];

        $arx = array(   '' =>  '/gestion/GetAnexos/'.$object->GetId().'/0/1/',                                 

                        'anexos' => '/gestion/GetAnexos/'.$object->GetId().'/0/1/', 

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

        $('#menu_tab > div').removeClass('activa');
        $("#cargador_box_actuaciones").addClass('activa');
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

                    <div id="form" >

                        <div id="crear-nota" class="right table scrollable" style="height:100%; width:58%; float:left; padding-left: 0px; padding-right: 0px;; padding-top: 0px;">';

            echo "          <div class='da-message error' style='padding:26px'>El expediente que intenta explorar no se encuentra registrado en su ".CAMPOAREADETRABAJO." o no esta compartido con usted</div>";

            echo "      </div>

                    </div>";

        }

?>

            <div class="scrollable dataexpediente m-t-20" style="width:40%; float:left; padding:10px;">
                <div id="newbloque_formularios">
                    <ul class="nav nav-tabs" id="formnavigation">
                      <li role="presentation" id="mainelm" class="active"><a href="#" onClick="AbrirFormulario('main', '<?= $object->GetId() ?>', 'mainelm')">Form. Principal</a></li>
                    <?
                        
                        $queryforms = $con->Query("select ref_id, grupo_id from meta_big_data where type_id = '".$object->GetId()."' and tipo_form = '1' group by grupo_id");
                        
                        
                        while ($rowform = $con->FetchAssoc($queryforms)) {
                            $nomform = $c->GetDataFromTable("meta_referencias_titulos", "id", $rowform['ref_id'], "titulo", $separador = " ");

                            echo '<li role="presentation" id="'.$rowform['grupo_id'].'"><a href="#" onClick="AbrirFormulario(\'form\', \''.$rowform['grupo_id'].'\', \''.$rowform['grupo_id'].'\')">'.$nomform.'</a></li>';
                            
                        }
                    ?>
                    </ul>
                    <div id="contenedor_formulario" class="scrollable p-l-10" style="border-left:1px solid #ddd"></div>
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

                <!--

                <div style='float:right; margin-right:5px;' onclick='EditarGestion_suscriptores(<?= $object->GetId() ?>)'>

                    <div class='btn btn-info btn-circle' title='editar'></div>

                </div> 

                -->


            </div>

        </div>

<?

?>

    </div>

</div>

<style type="text/css">

    .title_rad{

        float:left;

        font-weight: bold;

        font-size:16px;

        line-height: 20px;

        margin-bottom: 10px;

    }

    .alt_rad{

        float:left;

        font-size:14px;

        line-height: 20px;

        margin-bottom: 10px;

    }

    .title2{

        height: 30px;

        line-height: 30px;

    }

    .width60{ width:72%; float:left; border-bottom:1px solid #EEE; padding-bottom: 4px; padding-top: 3px;}

    .width50{ width:47%; float:left; border-bottom:1px solid #EEE; padding-bottom: 4px; padding-top: 3px;}

    .width30{ width:27%; float:left; border-bottom:1px solid #EEE; padding-bottom: 4px; padding-top: 3px;}

    .width40{ width:37%; float:left; border-bottom:1px solid #EEE; padding-bottom: 4px; padding-top: 3px;}

    .width25{ width:22%; float:left; border-bottom:1px solid #EEE; padding-bottom: 4px; padding-top: 3px;}

    ul.uldisciplinados{

        list-style: none;

        padding: 0px;

        margin:0px;

    }

    ul.uldisciplinados li{

        font-size: 14px;

        text-transform: uppercase;

    }

    .black_space{

        height: 30px;
        line-height: 18px;
        color: #fff;
        background-color: #585858;
        padding: 8px;
        float: left;
        border-radius: 6px


    }

    .black_space:hover{

        background-color: #4D4D4D;

    }

    .black_space:hover .toosltip{

        display: block;

    }

    .black_space .toosltip{

        /* max-width: 0px; */
        min-width: 50px;
        float: right;
        background-color: #4D4D4D;
        text-align: left;
        height: 29px;
        font-size: 12px;
        line-height: 14px;
        color: #FFF !important;
        position: relative;
        margin-left: 4px;
        margin-top: -7px;
        padding-left: 8px;
        padding-right: 8px;
        display: none;

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