<div class="row">
    <div class="col-md-12">
        <div class='btn btn-info m-t-10 m-b-10 pull-right' onclick='OpenWindow("/gestion/imprimir/<?= $object->GetId() ?>/")'>Imprimir</div>
    </div>
</div>


<?php 
    if ($object->GetTransferencia() == "1"){

        $qut = $con->Query("select user_recibe from gestion_transferencias where gestion_id = '".$object->GetId()."' and estado = '0'");
        $ut = $con->FetchAssoc($qut);
        $usuario_transfiere = $c->GetDataFromTable("usuarios", "a_i", $ut['user_recibe'], "p_nombre, p_apellido", " ");
?>
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-danger" role="alert">
                    ESTE EXPEDIENTE SE ENCUENTRA EN TRANSFERENCIA HACIA EL USUARIO <b><?= $usuario_transfiere ?></b>
                </div>
            </div>
        </div>

<?php } ?>

<? 

    $s = new Msuscriptores_contactos;
    $s->CreateSuscriptores_contactos("id", $object->Getsuscriptor_id());

    $estado_solicitud = $c->GetDataFromTable("estados_gestion", "id", $object->GetEstado_solicitud(), "nombre", " ");

    $tipo_d="";
    switch ($object->GetDocumento_salida()) {
        case 'S':
            $tipo_d= "Documento de Salida";
            break;
        case 'C':
            $tipo_d= "Comunicaciones Internas";
            break;
        case 'N':
            $tipo_d="Documento de Entrada";
            break;
        case 'A':
            $tipo_d= "Documento Generado Para Archivar";
            break;
        default:
            $tipo_d="Documento de Entrada";
            break;
    }

    $ar = array("0" => "Baja", "1" => "Media", "2" => "Alta");

    $city = new MCity;
    $city->CreateCity("code", $object->GetCiudad());

    $dp = new MProvince;
    $dp->CreateProvince("code", $city->GetProvince());
    $province = $dp->GetName();

    $of = new MSeccional;
    $of->CreateSeccional("id", $object->GetOficina());
    $oficina = $of->GetNombre();

    $area = new MAreas;
    $area->CreateAreas("id", $object->GetDependencia_destino());
    $narea = $area->GetNombre();


    $u = new MUsuarios;
    $u->CreateUsuarios("a_i", $object->Getnombre_destino());
    $nombreresponsable = $u->GetP_nombre()." ".$u->GetP_apellido();

    $ur = new MUsuarios;
    $ur->CreateUsuarios("user_id", $object->GetUsuario_registra());
    $nombreregistra = $ur->GetP_nombre()." ".$ur->GetP_apellido();

    $d = new MDependencias();
    $d->CreateDependencias("id", $object->GetId_dependencia_raiz());
    
    $dr = new MDependencias();
    $dr->CreateDependencias("id", $object->Gettipo_documento());

    $estado_archivo = $con->Query("select nombre from estadosx where valor = '".$object->GetEstado_archivo()."' and tipo = 'estado_archivo'");
    $estado_archivo = $con->Result($estado_archivo, 0, 'nombre');


    $codeText = HOMEDIR.DS.'s/'.$object->GetUri().'/'; 

?>

<form class="form-horizontal" role="form">
    <div class="form-body">
    <div class="row <?= M_CAMPORADEXTERNO ?>">
        <div class="col-md-12">
            <label class="control-label col-md-3 font-12"><?= CAMPORADEXTERNO ?>:</label>
            <div class="col-md-9">
                <?= "<p class='form-control-static'>&nbsp;".$object->GetRadicado()."</p>" ?>
            </div>
        </div>
    </div>    
    <div class="row  <?= M_CAMPORADRAPIDO ?>">
        <div class="col-md-12">
            <label class="control-label col-md-3 font-12"><?= CAMPORADRAPIDO ?>:</label>
            <div class="col-md-9">
                <?= "<p class='form-control-static'>".$object->GetMin_rad()."</p>" ?>
            </div>
        </div>
    </div>
    <div class="row <?= M_ASUNTO ?>">
        <div class="col-md-12">
            <label class="control-label col-md-3 font-12"><?= ASUNTO ?>:</label>
            <div class="col-md-9">
                <?= "<p class='form-control-static'>".$object->Getobservacion()."</p>" ?>
            </div>
        </div>

    </div>
    <?php if (CAMPOT1 != ""): ?>
        <div class="row">
            <div class="col-md-12">
                <label class="control-label col-md-3 font-12"><?= CAMPOT1 ?>:</label>
                <div class="col-md-9">
                    <?= "<p class='form-control-static'>&nbsp;".$object->GetCampot1()."</p>" ?>
                </div>
            </div>
        </div>
    <?php endif ?>
    <?php if (CAMPOT2 != ""): ?>
        <div class="row">
            <div class="col-md-12">
                <label class="control-label col-md-3 font-12"><?= CAMPOT2 ?>:</label>
                <div class="col-md-9">
                    <?= "<p class='form-control-static'>&nbsp;".$object->GetCampot2()."</p>" ?>
                </div>
            </div>
        </div>
    <?php endif ?>
    <?php if (CAMPOT3 != ""): ?>
        <div class="row">
            <div class="col-md-12">
                <label class="control-label col-md-3 font-12"><?= CAMPOT3 ?>:</label>
                <div class="col-md-9">
                    <?= "<p class='form-control-static'>&nbsp;".$object->GetCampot3()."</p>" ?>
                </div>
            </div>
        </div>
    <?php endif ?>
    <?php if (CAMPOT4 != ""): ?>
        <div class="row">
            <div class="col-md-12">
                <label class="control-label col-md-3 font-12"><?= CAMPOT4 ?>:</label>
                <div class="col-md-9">
                    <?= "<p class='form-control-static'>&nbsp;".$object->GetCampot4()."</p>" ?>
                </div>
            </div>
        </div>
    <?php endif ?>
    <?php if (CAMPOT5 != ""): ?>
        <div class="row">
            <div class="col-md-12">
                <label class="control-label col-md-3 font-12"><?= CAMPOT5 ?>:</label>
                <div class="col-md-9">
                    <?= "<p class='form-control-static'>&nbsp;".$object->GetCampot5()."</p>" ?>
                </div>
            </div>
        </div>
    <?php endif ?>    
     <?php if (CAMPOT6 != ""): ?>
        <div class="row">
            <div class="col-md-12">
                <label class="control-label col-md-3 font-12"><?= CAMPOT6 ?>:</label>
                <div class="col-md-9">
                    <?= "<p class='form-control-static'>&nbsp;".$object->GetCampot6()."</p>" ?>
                </div>
            </div>
        </div>
    <?php endif ?>
    <?php if (CAMPOT7 != ""): ?>
        <div class="row">
            <div class="col-md-12">
                <label class="control-label col-md-3 font-12"><?= CAMPOT7 ?>:</label>
                <div class="col-md-9">
                    <?= "<p class='form-control-static'>&nbsp;".$object->GetCampot7()."</p>" ?>
                </div>
            </div>
        </div>
    <?php endif ?>
    <?php if (CAMPOT8 != ""): ?>
        <div class="row">
            <div class="col-md-12">
                <label class="control-label col-md-3 font-12"><?= CAMPOT8 ?>:</label>
                <div class="col-md-9">
                    <?= "<p class='form-control-static'>&nbsp;".$object->GetCampot8()."</p>" ?>
                </div>
            </div>
        </div>
    <?php endif ?>
    <?php if (CAMPOT9 != ""): ?>
        <div class="row">
            <div class="col-md-12">
                <label class="control-label col-md-3 font-12"><?= CAMPOT9 ?>:</label>
                <div class="col-md-9">
                    <?= "<p class='form-control-static'>&nbsp;".$object->GetCampot9()."</p>" ?>
                </div>
            </div>
        </div>
    <?php endif ?>
    <?php if (CAMPOT10 != ""): ?>
        <div class="row">
            <div class="col-md-12">
                <label class="control-label col-md-3 font-12"><?= CAMPOT10 ?>:</label>
                <div class="col-md-9">
                    <?= "<p class='form-control-static'>&nbsp;".$object->GetCampot10()."</p>" ?>
                </div>
            </div>
        </div>
    <?php endif ?>    
     <?php if (CAMPOT11 != ""): ?>
        <div class="row">
            <div class="col-md-12">
                <label class="control-label col-md-3 font-12"><?= CAMPOT11 ?>:</label>
                <div class="col-md-9">
                    <?= "<p class='form-control-static'>&nbsp;".$object->GetCampot11()."</p>" ?>
                </div>
            </div>
        </div>
    <?php endif ?>
    <?php if (CAMPOT12 != ""): ?>
        <div class="row">
            <div class="col-md-12">
                <label class="control-label col-md-3 font-12"><?= CAMPOT12 ?>:</label>
                <div class="col-md-9">
                    <?= "<p class='form-control-static'>&nbsp;".$object->GetCampot12()."</p>" ?>
                </div>
            </div>
        </div>
    <?php endif ?>
    <?php if (CAMPOT13 != ""): ?>
        <div class="row">
            <div class="col-md-12">
                <label class="control-label col-md-3 font-12"><?= CAMPOT13 ?>:</label>
                <div class="col-md-9">
                    <?= "<p class='form-control-static'>&nbsp;".$object->GetCampot13()."</p>" ?>
                </div>
            </div>
        </div>
    <?php endif ?>
    <?php if (CAMPOT14 != ""): ?>
        <div class="row">
            <div class="col-md-12">
                <label class="control-label col-md-3 font-12"><?= CAMPOT14 ?>:</label>
                <div class="col-md-9">
                    <?= "<p class='form-control-static'>&nbsp;".$object->GetCampot14()."</p>" ?>
                </div>
            </div>
        </div>
    <?php endif ?>
    <?php if (CAMPOT15 != ""): ?>
        <div class="row">
            <div class="col-md-12">
                <label class="control-label col-md-3 font-12"><?= CAMPOT15 ?>:</label>
                <div class="col-md-9">
                    <?= "<p class='form-control-static'>&nbsp;".$object->GetCampot15()."</p>" ?>
                </div>
            </div>
        </div>
    <?php endif ?>   
        <div class="row">
        <?
            $tieneestadosq = $con->Query("Select * from estados_gestion where dependencia='".$object->Gettipo_documento()."'");
            $tieneestados = $con->NumRows($tieneestadosq);

            if ($tieneestados > 0) {
                $estado_solicitud = $c->GetDataFromTable("estados_gestion", "id", $object->GetEstado_personalizado(), "nombre", " ");
        ?>
            <div class="col-md-12">
                <label class="control-label col-md-3 font-12">Estado Personalizado:</label>
                <div class="col-md-9">
                    <p class="form-control-static"> <?= $estado_solicitud ?> </p>
                </div>
            </div>
        <?
            }
        ?>
        </div>
        <div class="row <?= M_SUSCRIPTORCAMPONOMBRE ?>">
             <div class="col-md-12">
                <label class="control-label col-md-3 font-12"><?= SUSCRIPTORCAMPONOMBRE ?>:</label>
                <div class="col-md-9">
                    <p class="form-control-static"> <?= $s->GetNombre() ?> </p>
                </div>
            </div>
        </div>
        <div class="row <?= M_SOPORTE ?>">
             <div class="col-md-12">
                <label class="control-label col-md-3 font-12"><?= SOPORTE ?>:</label>
                <div class="col-md-9">
                    <p class="form-control-static"> <?= $estado_solicitud ?> </p>
                </div>
            </div>
        </div>
        <div class="row <?= M_TIPO_DOCUMENTO ?>">
            <div class="col-md-12">
                <label class="control-label col-md-3 font-12"><?= TIPO_DOCUMENTO ?>:</label>
                <div class="col-md-9">
                    <p class="form-control-static"> <?= $tipo_d ?> </p>
                </div>
            </div>
        </div>
        <div class="row <?= M_ESTADO ?>">
            <div class="col-md-12">
                <label class="control-label col-md-3 font-12"> <?= ESTADO ?>:</label>
                <div class="col-md-3">
                    <p class="form-control-static"> <?= $object->Getestado_respuesta() ?> </p>
                </div>
        </div>
        <div class="row <?= M_PRIORIDAD ?>">
                <label class="control-label col-md-3 font-12"><?= PRIORIDAD ?>:</label>
                <div class="col-md-3">
                    <p class="form-control-static"> <?= $ar[$object->Getprioridad()] ?> </p>
                </div>
            </div>
        </div>
        <div class="row <?= M_FECHA_APERTURA ?>">
             <div class="col-md-12">
                <label class="control-label col-md-3 font-12"><?= FECHA_APERTURA ?>:</label>
                <div class="col-md-9">
                    <p class="form-control-static"> <?= $object->Getf_recibido() ?> </p>
                </div>
            </div>
        </div>
        <div class="row <?= M_FECHA_RESPUESTA ?>">
            <div class="col-md-12">
                <label class="control-label col-md-3 font-12"><?= FECHA_RESPUESTA ?>:</label>
                <div class="col-md-4">
                    <p class="form-control-static"> <?= $object->Getfecha_vencimiento() ?> </p>
                </div>
        </div>
        <div class="row <?= M_FECHA_CIERRE ?>">
                <label class="control-label col-md-1 font-12"><?= M_FECHA_CIERRE ?>:</label>
                <div class="col-md-4">
                    <p class="form-control-static" align="right"> <?= $object->Getfecha_respuesta() ?> </p>
                </div>
            </div>
        </div>
        <div class="row <?= M_FOLIOS ?>">
             <div class="col-md-12">
                <label class="control-label col-md-3 font-12"><?= FOLIOS ?>:</label>
                <div class="col-md-9">
                    <p class="form-control-static"> <?= $object->Getfolio() ?> </p>
                </div>
            </div>
        </div>
        <div class="row <?= M_DEPARTAMENTO ?>">
             <div class="col-md-12">
                <label class="control-label col-md-3 font-12"><?= DEPARTAMENTO ?>:</label>
                <div class="col-md-9">
                    <p class="form-control-static"> <?= $province ?> </p>
                </div>
            </div>
        </div>
        <div class="row <?= M_CIUDAD ?>">
             <div class="col-md-12">
                <label class="control-label col-md-3 font-12"><?= CIUDAD ?>:</label>
                <div class="col-md-9">
                    <p class="form-control-static"> <?= $city->GetName() ?> </p>
                </div>
            </div>
        </div>
        <div class="row <?= M_OFICINA ?>">
             <div class="col-md-12">
                <label class="control-label col-md-3 font-12"><?= OFICINA ?>:</label>
                <div class="col-md-9">
                    <p class="form-control-static"> <?= $oficina ?> </p>
                </div>
            </div>
        </div>
        <div class="row <?= M_CAMPOAREADETRABAJO ?>">
             <div class="col-md-12">
                <label class="control-label col-md-3 font-12"><?= CAMPOAREADETRABAJO ?>:</label>
                <div class="col-md-9">
                    <p class="form-control-static"> <?= $narea ?> </p>
                </div>
            </div>
        </div>
        <div class="row <?= M_RESPONSABLE ?>">
             <div class="col-md-12">
                <label class="control-label col-md-3 font-12"><?= RESPONSABLE ?>:</label>
                <div class="col-md-9">
                    <p class="form-control-static"> <?= $nombreresponsable ?> </p>
                </div>
            </div>
        </div>
        <?php if ($object->GetTransferencia() == "1"): ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-danger" role="alert">
                        ESTE EXPEDIENTE SE ENCUENTRA EN TRANSFERENCIA HACIA EL USUARIO <b><?= $usuario_transfiere ?></b>
                    </div>
                </div>
            </div>
        <?php endif ?>
        <div class="row">
             <div class="col-md-12">
                <label class="control-label col-md-3 font-12">Cotejado por:</label>
                <div class="col-md-9">
                    <p class="form-control-static"> <?= $nombreregistra ?> </p>
                </div>
            </div>
        </div>
        <div class="row <?= M_SERIE ?>">
             <div class="col-md-12">
                <label class="control-label col-md-3 font-12"><?= SERIE ?>:</label>
                <div class="col-md-9">
                    <p class="form-control-static"> <?= $d->GetNombre() ?> </p>
                </div>
            </div>
        </div>
        <div class="row <?= M_SUB_SERIE ?>">
             <div class="col-md-12">
                <label class="control-label col-md-3 font-12"><?= SUB_SERIE ?>:</label>
                <div class="col-md-9">
                    <p class="form-control-static"> <?= $dr->GetNombre() ?> </p>
                </div>
            </div>
        </div>
        <div class="row <?= M_OBSERVACION ?>">
             <div class="col-md-12">
                <label class="control-label col-md-3 font-12"><?= OBSERVACION ?>:</label>
                <div class="col-md-9">
                    <p class="form-control-static"> <?= $object->Getobservacion2() ?> </p>
                </div>
            </div>
        </div>
        <div class="row <?= M_UBICACION ?>">
             <div class="col-md-12">
                <label class="control-label col-md-3 font-12"><?= UBICACION ?>:</label>
                <div class="col-md-9">
                    <?
                    
                    
                    if ($_SESSION['archivo_central'] == '1' || $_SESSION['tech_support'] == "1" || $_SESSION['archivo_gestion'] == "1") {
                         echo '<select name="estado_archivo" id="estado_archivo" placeholder="'.UBICACION.'"  class="form-control" onchange="UpdateFieldGestion(\'estado_archivo\', \'estado_archivo\', \''.$object->GetId().'\')" >';

                    

                    $estado_archivo = $con->Query("select * from estadosx where tipo = 'estado_archivo' and estado = '1' and valor in(1, 2, 4, -99)");



                   while ($arc = $con->FetchAssoc($estado_archivo)) {

                        $sel = "";

                        if ($object->GetEstado_archivo() == $arc['valor']) {

                            $sel = 'selected = "selected"';

                        }

                        echo '<option value="'.$arc['valor'].'" '.$sel.'>'.$arc['nombre'].'</option>';

                    }



                    $valh = $d->GetT_h();



                    if ($d->GetT_h() != 0) {

                        $valhistorico = $con->Query("select * from estadosx where valor = '".$valh."' and tipo = 'estado_archivo'");

                        echo "select * from estadox where valor = '".$valh."' and tipo = 'estado_archivo'";

                        

                        while ($arch = $con->FetchAssoc($valhistorico)) {

                            $sel = "";

                            if ($object->GetEstado_archivo() == $arch['valor']) {

                                $sel = 'selected = "selected"';

                            }

                            echo '<option value="'.$arch['valor'].'" '.$sel.'>'.$arch['nombre'].'</option>';

                        }

                    }

                    echo "</select>";
                    }else{
                        echo '<p class="form-control-static"> '.$estado_archivo.' </p>';    
                    }
                    ?>
                    
                </div>
            </div>
        </div>
        <div class="row <?= M_URI ?>">
             <div class="col-md-12">
                <label class="control-label col-md-3 font-12"> <?= URI ?>:</label>
                <div class="col-md-9">
                    <p class="form-control-static"> <?= "<a href='".$codeText."' target='_blank'>".$codeText."</a>" ?> </p>
                </div>
            </div>
        </div>
    </div>
</form>


<script type="text/javascript">

    (function($) {

        if ($('.select2').length){

            $(".select2").select2();

        }

    })(jQuery);

    function UpdateFieldGestion(valor, campo, id){
        
        if(campo == "estado_archivo"){
            if(!confirm("Está seguro que desea cambiar el estado  del expediente")){
                return false;
            }
        }

        var URL = '/gestion/actualizarcampoproceso/'+$("#"+valor).val()+'/'+campo+'/'+id+'/';
        $.ajax({
            type: 'POST',
            url: URL,
            success:function(msg){
                if(msg == "1"){
                    mensaje = "";
                    if(campo == "estado_archivo"){
                        mensaje = "Estado del Expediente Actualizado";
                        window.location.reload();
                    }else{
                        mensaje = "El Campo "+$("#"+valor).attr('placeholder')+" fue Actualizado";
                    }
                    $.toast({
                        heading: '',
                        text: mensaje,
                        position: 'top-right',
                        loaderBg:'#ff6849',
                        icon: 'info',
                        hideAfter: 3000, 
                        stack: 6
                    });
                }
            }
        })

    }


$(document).ready(function() {
    $(".tst1").click(function(){
       $.toast({
        heading: 'Welcome to my Elite admin',
        text: 'Use the predefined ones, or specify a custom position object.',
        position: 'top-right',
        loaderBg:'#ff6849',
        icon: 'info',
        hideAfter: 3000, 
        stack: 6
      });

    });
});
          

</script>