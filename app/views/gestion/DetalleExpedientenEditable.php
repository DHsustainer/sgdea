<script type="text/javascript">

    $(document).ready(function(){

        $('[data-toggle="tooltip"]').tooltip(); 

        $('[data-toggle="popover"]').popover()

    });

</script>

<div class="row p-20">
<?php 
    if (M_IMPRIMIRRADICADO == '1') {
?>
    <div class="col-md-12">

        <div class='btn btn-warning m-t-10 m-b-10 pull-right' <?= $c->Ayuda(84, 'tog') ?> onclick='OpenWindow("/gestion/imprimir/<?= $object->GetId() ?>/")' ><?= IMPRIMIRRADICADO ?></div>

    </div>

<?php 
    }
    if ($_SESSION['MODULES']['seguimiento'] == '1') {
?>
        <div class="col-md-12">
            <div class='btn btn-info m-t-10 m-b-10' onclick='LoadModal("",  "Solicitúd de Seguimiento de Expediente", "/gestion_seguimiento/nuevo/<?= $object->GetId() ?>/")'>Solicitar Dependencia</div>
        </div>
<?php

    }
    
?>
</div>




<?php 

    if ($object->GetTransferencia() == "1"){




        $qut = $con->Query("select user_recibe, id from gestion_transferencias where gestion_id = '".$object->GetId()."' and estado = '0'");

        $ut = $con->FetchAssoc($qut);

        $usuario_transfiere = $c->GetDataFromTable("usuarios", "a_i", $ut['user_recibe'], "p_nombre, p_apellido", " ");
        if ($usuario_transfiere == " ") {
            $con->Query("UPDATE gestion set transferencia = '0' where id = '".$object->GetId()."' ");
        }else{

?>

        <div class="row">

            <div class="col-md-12">

                <div class="alert alert-danger" role="alert" <?= $c->Ayuda(325, 'tog') ?>>

                    ESTE EXPEDIENTE SE ENCUENTRA EN TRANSFERENCIA HACIA EL USUARIO <b><?= $usuario_transfiere ?></b>

                </div>

            </div>

        </div>



<?php

        } 
    }



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



    $ar2 = array("1" => "Archivo de Gestión", "2" => "Archivo Central", "3" => "Archivo Histórico", "-1" => "Eliminación", "-2" => "Conservación Total", "-3" => "Digitalización", "-4" => "Selección", "-5" => "MicroFilmación", "-6" => "Hibrido", "-7" => "Digitalizar y Eliminar", "-8" => "Seleccionar y Eliminar", "-9" => "Conservación Total y Digitalización");



    $codeText = HOMEDIR.DS.'s/'.$object->GetUri().'/'; 



?>







<form class="form-material form-horizontal" role="form" id='FormUpdategestion' action='/gestion/actualizar/<?= $object->GetId() ?>/' method='POST'>

    <div style='display:none;'>

        <input type='hidden' name='id' id='id' value='<? echo $object -> GetId(); ?>' />

    </div>

    <div class="form-body">

        <div class="row <?= M_CAMPORADEXTERNO ?>">

            <div class="col-md-12">

                <div class="form-group">

                    <label class="control-label col-md-3 font-12" <?= $c->Ayuda(300, 'tog') ?>><?= CAMPORADEXTERNO ?>:</label>

                    <div class="col-md-9">

                        <input type='text' class="form-control" placeholder="<?= CAMPORADEXTERNO ?>" onblur='UpdateFieldGestion("radicado", "radicado", "<?= $object->GetId() ?>")' name='radicado' id='radicado' maxlength='' value='<?= $object->GetRadicado() ?>' />

                    </div>

                </div>

            </div>

        </div>

        <div class="row <?= M_CAMPOIDRAD ?>">

            <div class="col-md-12">

                <div class="form-group">

                    <label class="control-label col-md-3 font-12" <?= $c->Ayuda(300, 'tog') ?>><?= CAMPOIDRAD ?>:</label>

                    <div class="col-md-9">

                        <input type='text' class="form-control" placeholder="<?= CAMPOIDRAD ?>" onblur='UpdateFieldGestion("num_oficio_respuesta", "num_oficio_respuesta", "<?= $object->GetId() ?>")' name='num_oficio_respuesta' id='num_oficio_respuesta' maxlength='' value='<?= $object->GetNum_oficio_respuesta() ?>' />

                    </div>

                </div>

            </div>

        </div>

        <div class="row <?= CAMPORADRAPIDO ?>">

            <div class="col-md-12">

                <div class="form-group">

                    <label class="control-label col-md-3 font-12" <?= $c->Ayuda(301, 'tog') ?>><?= CAMPORADRAPIDO ?>:</label>

                    <div class="col-md-9">

                        <p class="form-control-static text-muted"> <?= $object->GetMin_rad() ?> </p>

                    </div>

                </div>

            </div>

        </div>

        <div class="row <?= M_ASUNTO ?>">

            <div class="col-md-12">

                <div class="form-group">

                    <label class="control-label col-md-3 font-12" <?= $c->Ayuda(302, 'tog') ?>><?= ASUNTO ?>:</label>

                    <div class="col-md-9">

                        <textarea class="form-control height-100"  placeholder="<?= ASUNTO ?>" onblur='UpdateFieldGestion("observacion", "observacion", "<?= $object->GetId() ?>")' name='observacion' id='observacion'><?= $object->Getobservacion() ?></textarea>

                    </div>

                </div>

            </div>

        </div>
        <div class="row <?= M_ESTADO ?> m-b-10">
            <label class="control-label col-md-3 font-12" <?= $c->Ayuda(306, 'tog') ?>><?= ESTADO ?>:</label>
            <div class="col-md-9">
                 <select name='estado_respuesta' id='estado_respuesta' class="form-control" placeholder="<?= ESTADO ?>">
                        <? 
                        $qestado = $con->Query("select * from estados_gestion where dependencia = 0");
                        while ($rowestado = $con->FetchAssoc($qestado)) {
                            $sel = ($rowestado['nombre'] == $object->Getestado_respuesta())?"selected='selected'":"";
                            echo '<option value="'.$rowestado['nombre'].'" '.$sel.'>'.$rowestado['nombre'].'</option>';
                        }
                    ?>
                </select>
            </div>
            <script type="text/javascript">
                $("#estado_respuesta").change(function(){
                    //alert($(this).val());
                    if ($(this).val() == "Anaquel") {
                        $("#fecha_estado_anaquel").removeClass("dn");

                    }else{
                        UpdateFieldGestion("estado_respuesta", "estado_respuesta", "<?= $object->GetId() ?>");
                        if ($(this).val() == "Cerrado") {
                            var f = new Date();
                            //alert(f.getFullYear()+"-"+(f.getMonth() +1)+"-"+f.getDate());
                            $("#fecha_respuesta").val(f.getFullYear()+"-"+(f.getMonth() +1)+"-"+f.getDate());
                            UpdateFieldGestion("fecha_respuesta", "fecha_respuesta", "<?= $object->GetId() ?>");
                        } 
                    }
                })
            </script>
        </div>
        <div class="row dn m-t-20 m-b-20" id="fecha_estado_anaquel">
             <div class="col-md-12">
                <label class="control-label col-md-4 font-12">Fecha de Cambio de Estado:</label>
                <div class="col-md-8">
                    <input type='date' class="form-control" name='fechaestadoanaquel' id='fechaestadoanaquel' placeholder="Estado Anaquel" />
                </div>
            </div>
            <div class="col-md-12 m-t-20">
                <button type="button" class="btn btn-warning pull-right" onclick='UpdateFieldGestion("fechaestadoanaquel", "fechaestadoanaquel", "<?= $object->GetId() ?>")'>Cambiar Estado</button>
            </div>
        </div>

        <div class="row">

        <?

            $tieneestadosq = $con->Query("Select * from estados_gestion where dependencia='".$object->Gettipo_documento()."'");

            $tieneestados = $con->NumRows($tieneestadosq);



            if ($tieneestados > 0) {

                $estado_solicitud = $c->GetDataFromTable("estados_gestion", "id", $object->GetEstado_personalizado(), "nombre", " ");

        ?>

            <div class="col-md-12">

                <div class="form-group">

                    <label class="control-label col-md-3 font-12" <?= $c->Ayuda(330, 'tog') ?>>Estado Personalizado:</label>

                    <div class="col-md-9">

                        <select name="estado_personalizado" id="estado_personalizado" placeholder="Estado Personalizado"  onchange='UpdateFieldGestion("estado_personalizado", "estado_personalizado", "<?= $object->GetId() ?>")' class="form-control select2">

                            <option value='0'>Seleccione una Opción</option>

                            <?

                                while ($rowx = $con->FetchAssoc($tieneestadosq)) {

                                    $st = "";

                                    if ($object->GetEstado_personalizado() == $rowx['id']) {

                                        $st = "selected = 'selected'";

                                    }

                                    echo "<option value='".$rowx['id']."' $st>".$rowx['nombre']."</option>";

                                }

                            ?>

                        </select>

                    </div>

                </div>

            </div>

        <?

            }else{

             echo '<input type="hidden" id="estado_personalizado" name="estado_personalizado" value="">';

            }

        ?>

        </div>

        <div class="row">
             <div class="col-md-12">
                <label class="control-label col-md-3 font-12" <?= $c->Ayuda(303, 'tog') ?>><?= SUSCRIPTORCAMPONOMBRE ?>:</label>
                <div class="col-md-9">
                    <input type="text" id="searchbformsuscriptor_id"  placeholder="<?= SUSCRIPTORCAMPONOMBRE ?>" class="form-control"  value="<?= $s->GetNombre() ?>" >
                    <div id="bloquebusqueda" class="bloquebusqueda_suscriptor_id"></div>
                    <script type="text/javascript">
                        $("#searchbformsuscriptor_id").on("keyup", function(){
                            $(".bloquebusqueda_suscriptor_id").fadeIn();    
                            var valvalor = $(this).val().replaceAll(' ', '+');
                            $.ajax({
                                type: "POST",
                                url: '/usuarios/GestListadoUsuariosSuscriptores2/'+valvalor+"/",
                                success: function(msg){
                                    result = msg;
                                    $(".bloquebusqueda_suscriptor_id").html(result);                 
                                }
                            });             
                        })
                        function onTecla(e){    
                            var num = e?e.keyCode:event.keyCode;
                            if (num == 9 || num == 27){
                                $(".bloquebusqueda_suscriptor_id").fadeOut();        
                            }
                        }
                        document.onkeydown = onTecla;
                        if(document.all){
                            document.captureEvents(Event.KEYDOWN);  
                        }
                        function AddUsuarioToListado2(nombre, email, id){
                            $('#searchbformsuscriptor_id').val(nombre);
                            $('#suscriptor_id').val(id);
                            $(".bloquebusqueda_suscriptor_id").hide(); 

                            UpdateFieldGestion("suscriptor_id", "suscriptor_id", "<?= $object->GetId() ?>");
                            UpdateFieldGestion("searchbformsuscriptor_id", "nombre_radica", "<?= $object->GetId() ?>");
                        }
                    </script>
                    <? 
                        $s = new Msuscriptores_contactos;
                        $s->CreateSuscriptores_contactos("id", $object -> Getsuscriptor_id());
                    ?>
                    <input type="hidden" name='suscriptor_id'  placeholder="<?= SUSCRIPTORCAMPONOMBRE ?>" id='suscriptor_id' value="<?= $s->GetId() ?>">
                </div>
            </div>
        </div>
        <div class="row <?= M_SOPORTE ?>">

             <div class="col-md-12">

                <label class="control-label col-md-3 font-12" <?= $c->Ayuda(304, 'tog') ?>><?= SOPORTE ?>:</label>

                <div class="col-md-9">

                    <select name="estado_solicitud" id="estado_solicitud" onchange='UpdateFieldGestion("estado_solicitud", "estado_solicitud", "<?= $object->GetId() ?>")'  placeholder="<?= SOPORTE ?>" class="form-control">

                        <?

                            $es = new MEstados_gestion();

                            $listestados_gestion = $es->ListarEstados_gestion("where dependencia = '-1'");

                                while ($rowx = $con->FetchAssoc($listestados_gestion)) {

                                    $is = ($rc['id'] == $object -> GetEstado_solicitud())?"selected='selected'":"";

                                    echo "<option value='".$rowx['id']."'>".$rowx['nombre']."</option>";

                                }

                        ?>

                    </select>

                </div>

            </div>

        </div>

        <?php if (CAMPOT1 != ""): ?>

        <hr>

        <div class="row <?= M_CAMPOT1 ?>">

            <div class="col-md-12">

                <div class="form-group">

                    <label class="control-label col-md-3 font-12"<?= $c->Ayuda(339, 'tog') ?>><?= CAMPOT1 ?>:</label>

                    <div class="col-md-9">

                    <?

                        $x = $con->Query("Select * from meta_listas where titulo = '".CAMPOT1."'");

                        $cont = $con->NumRows($x);

                        $dat = $con->FetchAssoc($x);



                        if ($cont > 0) {

                    ?>

                            <select class="form-control select2" type='text'  placeholder="<?= CAMPOT1 ?>" onchange='UpdateFieldGestion("campot1", "campot1", "<?= $object->GetId() ?>")' name='campot1' id='campot1'>

                                <option value="">Seleccione una Opción</option>

                                <?

                                    $x = $con->Query("select * from meta_listas_valores where id_lista = '".$dat['id']."'");

                                    while ($ror = $con->FetchAssoc($x)) {

                                        $is = ($ror['valor'] == $object->GetCampot1())?"selected='selected'":"";

                                        echo '<option value="'.$ror['valor'].'" '.$is.'>'.$ror['titulo'].'</option>';

                                    }

                                ?>

                            </select>

                            

                    <?

                        }else{

                    ?>

                            <input class="form-control" type='text' name='campot1'   placeholder="<?= CAMPOT1 ?>"  onblur='UpdateFieldGestion("campot1", "campot1", "<?= $object->GetId() ?>")' id='campot1' maxlength='100'  value="<?= $object->GetCampot1() ?>" />

                    <?

                        }

                    ?>

                    </div>

                </div>

            </div>

        </div>

    <?php endif ?>

    <?php if (CAMPOT2 != ""): ?>

        <div class="row <?= M_CAMPOT2 ?>">

            <div class="col-md-12">

                <div class="form-group">

                    <label class="control-label col-md-3 font-12"<?= $c->Ayuda(340, 'tog') ?>><?= CAMPOT2 ?>:</label>

                    <div class="col-md-9">

                    <?

                        $x = $con->Query("Select * from meta_listas where titulo = '".CAMPOT2."'");

                        $cont = $con->NumRows($x);

                        $dat = $con->FetchAssoc($x);



                        if ($cont > 0) {

                    ?>

                            <select class="form-control select2" type='text'    placeholder="<?= CAMPOT2 ?>"  onchange='UpdateFieldGestion("campot2", "campot2", "<?= $object->GetId() ?>")' name='campot2' id='campot2'>

                                <option value="">Seleccione una Opción</option>

                                <?

                                    $x = $con->Query("select * from meta_listas_valores where id_lista = '".$dat['id']."'");

                                    while ($ror = $con->FetchAssoc($x)) {

                                        $is = ($ror['valor'] == $object->GetCampot2())?"selected='selected'":"";

                                        echo '<option value="'.$ror['valor'].'" '.$is.'>'.$ror['titulo'].'</option>';

                                    }

                                ?>

                            </select>

                            

                    <?

                        }else{

                    ?>

                            <input class="form-control" type='text' name='campot2'   placeholder="<?= CAMPOT2 ?>"  onblur='UpdateFieldGestion("campot2", "campot2", "<?= $object->GetId() ?>")'  id='campot2' value="<?= $object->GetCampot2() ?>" maxlength='100'/>

                    <?

                        }

                    ?>

                    </div>

                </div>

            </div>

        </div>

    <?php endif ?>

    <?php if (CAMPOT15 != ""): ?>

        <div class="row <?= M_CAMPOT15 ?>">

            <div class="col-md-12">

                <div class="form-group">

                    <label class="control-label col-md-3 font-12"<?= $c->Ayuda(353, 'tog') ?>><?= CAMPOT15 ?>:</label>

                    <div class="col-md-9">

                    <?

                        $x = $con->Query("Select * from meta_listas where titulo = '".CAMPOT15."'");

                        $cont = $con->NumRows($x);

                        $dat = $con->FetchAssoc($x);



                        if ($cont > 0) {

                    ?>

                            <select class="form-control select2" type='text'   placeholder="<?= CAMPOT15 ?>"  onchange='UpdateFieldGestion("campot15", "campot15", "<?= $object->GetId() ?>")' name='campot15' id='campot15'>

                                <option value="">Seleccione una Opción</option>

                                <?

                                    $x = $con->Query("select * from meta_listas_valores where id_lista = '".$dat['id']."'");

                                    while ($ror = $con->FetchAssoc($x)) {

                                        $is = ($ror['valor'] == $object->GetCampot15())?"selected='selected'":"";

                                        echo '<option value="'.$ror['valor'].'" '.$is.'>'.$ror['titulo'].'</option>';

                                    }

                                ?>

                            </select>

                            

                    <?

                        }else{

                    ?>

                            <input class="form-control" type='text' name='campot15'   placeholder="<?= CAMPOT15 ?>"   onblur='UpdateFieldGestion("campot15", "campot15", "<?= $object->GetId() ?>")'  id='campot15' value="<?= $object->GetCampot15() ?>" maxlength='100'/>

                    <?

                        }

                    ?>

                    </div>

                </div>

            </div>

        </div>

    <?php endif ?>


    <?php if (CAMPOT3 != ""): ?>

        <div class="row <?= M_CAMPOT3 ?>">

            <div class="col-md-12">

                <div class="form-group">

                    <label class="control-label col-md-3 font-12"<?= $c->Ayuda(341, 'tog') ?>><?= CAMPOT3 ?>:</label>

                    <div class="col-md-9">

                    <?

                        $x = $con->Query("Select * from meta_listas where titulo = '".CAMPOT3."'");

                        $cont = $con->NumRows($x);

                        $dat = $con->FetchAssoc($x);



                        if ($cont > 0) {

                    ?>

                            <select class="form-control select2" type='text'   placeholder="<?= CAMPOT3 ?>" onchange='UpdateFieldGestion("campot3", "campot3", "<?= $object->GetId() ?>")' name='campot3' id='campot3'>

                                <option value="">Seleccione una Opción</option>

                                <?

                                    $x = $con->Query("select * from meta_listas_valores where id_lista = '".$dat['id']."'");

                                    while ($ror = $con->FetchAssoc($x)) {

                                        $is = ($ror['valor'] == $object->GetCampot3())?"selected='selected'":"";

                                        echo '<option value="'.$ror['valor'].'" '.$is.'>'.$ror['titulo'].'</option>';

                                    }

                                ?>

                            </select>

                            

                    <?

                        }else{

                    ?>

                            <input class="form-control" type='text' name='campot3'   placeholder="<?= CAMPOT3 ?>"   onblur='UpdateFieldGestion("campot3", "campot3", "<?= $object->GetId() ?>")'  id='campot3' value="<?= $object->GetCampot3() ?>" maxlength='100'/>

                    <?

                        }

                    ?>

                    </div>

                </div>

            </div>

        </div>

    <?php endif ?>

    <?php if (CAMPOT4 != ""): ?>

        <div class="row <?= M_CAMPOT4 ?>">

            <div class="col-md-12">

                <div class="form-group">

                    <label class="control-label col-md-3 font-12"<?= $c->Ayuda(342, 'tog') ?>><?= CAMPOT4 ?>:</label>

                    <div class="col-md-9">

                    <?

                        $x = $con->Query("Select * from meta_listas where titulo = '".CAMPOT4."'");

                        $cont = $con->NumRows($x);

                        $dat = $con->FetchAssoc($x);



                        if ($cont > 0) {

                    ?>
                            <select class="form-control select2" type='text'  placeholder="<?= CAMPOT4 ?>" onchange='UpdateFieldGestion("campot4", "campot4", "<?= $object->GetId() ?>")' name='campot4' id='campot4'>

                                <option value="">Seleccione una Opción</option>

                                <?

                                    $x = $con->Query("select * from meta_listas_valores where id_lista = '".$dat['id']."'");

                                    while ($ror = $con->FetchAssoc($x)) {

                                        $is = ($c->sql_quote($ror['valor']) == $c->sql_quote(utf8_encode($object->GetCampot4())))?"selected='selected'":"";

                                        echo '<option value="'.$ror['valor'].'" '.$is.'>'.$ror['titulo'].'</option>';

                                    }

                                ?>

                            </select>                           

                    <?

                        }else{

                    ?>

                            <input class="form-control" type='text' name='campot4'   placeholder="<?= CAMPOT4 ?>"  onblur='UpdateFieldGestion("campot4", "campot4", "<?= $object->GetId() ?>")'  id='campot4' value="<?= $object->GetCampot4() ?>" maxlength='100'/>

                    <?

                        }

                    ?>

                    </div>

                </div>

            </div>

        </div>

    <?php endif ?>

    <?php if (CAMPOT5 != ""): ?>

        <div class="row <?= M_CAMPOT5 ?>">

            <div class="col-md-12">

                <div class="form-group">

                    <label class="control-label col-md-3 font-12"<?= $c->Ayuda(343, 'tog') ?>><?= CAMPOT5 ?>:</label>

                    <div class="col-md-9">

                    <?

                        $x = $con->Query("Select * from meta_listas where titulo = '".CAMPOT5."'");

                        $cont = $con->NumRows($x);

                        $dat = $con->FetchAssoc($x);



                        if ($cont > 0) {

                    ?>

                            <select class="form-control select2" type='text'   placeholder="<?= CAMPOT5 ?>" onchange='UpdateFieldGestion("campot5", "campot5", "<?= $object->GetId() ?>")' name='campot5' id='campot5'>

                                <option value="">Seleccione una Opción</option>

                                <?

                                    $x = $con->Query("select * from meta_listas_valores where id_lista = '".$dat['id']."'");

                                    while ($ror = $con->FetchAssoc($x)) {

                                        $is = ($ror['valor'] == $object->GetCampot5())?"selected='selected'":"";

                                        echo '<option value="'.$ror['valor'].'" '.$is.'>'.$ror['titulo'].'</option>';

                                    }

                                ?>

                            </select>

                            

                    <?

                        }else{

                    ?>

                            <input class="form-control" type='text' name='campot5'   placeholder="<?= CAMPOT5 ?>"  onblur='UpdateFieldGestion("campot5", "campot5", "<?= $object->GetId() ?>")'  id='campot5' value="<?= $object->GetCampot5() ?>" maxlength='100'/>

                    <?

                        }

                    ?>

                    </div>

                </div>

            </div>

        </div>

    <?php endif ?>

    <?php if (CAMPOT6 != ""): ?>

        <div class="row <?= M_CAMPOT6 ?>">

            <div class="col-md-12">

                <div class="form-group">

                    <label class="control-label col-md-3 font-12"<?= $c->Ayuda(344, 'tog') ?>><?= CAMPOT6 ?>:</label>

                    <div class="col-md-9">

                    <?

                        $x = $con->Query("Select * from meta_listas where titulo = '".CAMPOT6."'");

                        $cont = $con->NumRows($x);

                        $dat = $con->FetchAssoc($x);



                        if ($cont > 0) {

                    ?>

                            <select class="form-control select2" type='text'   placeholder="<?= CAMPOT6 ?>"   onchange='UpdateFieldGestion("campot6", "campot6", "<?= $object->GetId() ?>")' name='campot6' id='campot6'>

                                <option value="">Seleccione una Opción</option>

                                <?

                                    $x = $con->Query("select * from meta_listas_valores where id_lista = '".$dat['id']."'");

                                    while ($ror = $con->FetchAssoc($x)) {

                                        $is = ($ror['valor'] == $object->GetCampot6())?"selected='selected'":"";

                                        echo '<option value="'.$ror['valor'].'" '.$is.'>'.$ror['titulo'].'</option>';

                                    }

                                ?>

                            </select>

                            

                    <?

                        }else{

                    ?>

                            <input class="form-control" type='text' name='campot6'  placeholder="<?= CAMPOT6 ?>"   onblur='UpdateFieldGestion("campot6", "campot6", "<?= $object->GetId() ?>")'  id='campot6' value="<?= $object->GetCampot6() ?>" maxlength='100'/>

                    <?

                        }

                    ?>

                    </div>

                </div>

            </div>

        </div>

    <?php endif ?>

    <?php if (CAMPOT7 != ""): ?>

        <div class="row <?= M_CAMPOT7 ?>">

            <div class="col-md-12">

                <div class="form-group">

                    <label class="control-label col-md-3 font-12"<?= $c->Ayuda(345, 'tog') ?>><?= CAMPOT7 ?>:</label>

                    <div class="col-md-9">

                    <?

                        $x = $con->Query("Select * from meta_listas where titulo = '".CAMPOT7."'");

                        $cont = $con->NumRows($x);

                        $dat = $con->FetchAssoc($x);



                        if ($cont > 0) {

                    ?>

                            <select class="form-control select2" type='text'   placeholder="<?= CAMPOT7 ?>" onchange='UpdateFieldGestion("campot7", "campot7", "<?= $object->GetId() ?>")' name='campot7' id='campot7'>

                                <option value="">Seleccione una Opción</option>

                                <?

                                    $x = $con->Query("select * from meta_listas_valores where id_lista = '".$dat['id']."'");

                                    while ($ror = $con->FetchAssoc($x)) {

                                        $is = ($ror['valor'] == $object->GetCampot7())?"selected='selected'":"";

                                        echo '<option value="'.$ror['valor'].'" '.$is.'>'.$ror['titulo'].'</option>';

                                    }

                                ?>

                            </select>

                            

                    <?

                        }else{

                    ?>

                            <input class="form-control" type='text' name='campot7'   placeholder="<?= CAMPOT7 ?>" onblur='UpdateFieldGestion("campot7", "campot7", "<?= $object->GetId() ?>")'  id='campot7' value="<?= $object->GetCampot7() ?>" maxlength='100'/>

                    <?

                        }

                    ?>

                    </div>

                </div>

            </div>

        </div>

    <?php endif ?>

    <?php if (CAMPOT8 != ""): ?>

        <div class="row <?= M_CAMPOT8 ?>">

            <div class="col-md-12">

                <div class="form-group">

                    <label class="control-label col-md-3 font-12"<?= $c->Ayuda(346, 'tog') ?>><?= CAMPOT8 ?>:</label>

                    <div class="col-md-9">

                    <?

                        $x = $con->Query("Select * from meta_listas where titulo = '".CAMPOT8."'");

                        $cont = $con->NumRows($x);

                        $dat = $con->FetchAssoc($x);



                        if ($cont > 0) {

                    ?>

                            <select class="form-control select2" type='text'   placeholder="<?= CAMPOT8 ?>" onchange='UpdateFieldGestion("campot8", "campot8", "<?= $object->GetId() ?>")' name='campot8' id='campot8'>

                                <option value="">Seleccione una Opción</option>

                                <?

                                    $x = $con->Query("select * from meta_listas_valores where id_lista = '".$dat['id']."'");

                                    while ($ror = $con->FetchAssoc($x)) {

                                        $is = ($ror['valor'] == $object->GetCampot8())?"selected='selected'":"";

                                        echo '<option value="'.$ror['valor'].'" '.$is.'>'.$ror['titulo'].'</option>';

                                    }

                                ?>

                            </select>

                            

                    <?

                        }else{

                    ?>

                            <input class="form-control" type='text' name='campot8'   placeholder="<?= CAMPOT8 ?>" onblur='UpdateFieldGestion("campot8", "campot8", "<?= $object->GetId() ?>")'  id='campot8' value="<?= $object->GetCampot8() ?>" maxlength='100'/>

                    <?

                        }

                    ?>

                    </div>

                </div>

            </div>

        </div>

    <?php endif ?>

    <?php if (CAMPOT9 != ""): ?>

        <div class="row <?= M_CAMPOT9 ?>">

            <div class="col-md-12">

                <div class="form-group">

                    <label class="control-label col-md-3 font-12"<?= $c->Ayuda(347, 'tog') ?>><?= CAMPOT9 ?>:</label>

                    <div class="col-md-9">

                    <?

                        $x = $con->Query("Select * from meta_listas where titulo = '".CAMPOT9."'");

                        $cont = $con->NumRows($x);

                        $dat = $con->FetchAssoc($x);



                        if ($cont > 0) {

                    ?>

                            <select class="form-control select2" type='text'   placeholder="<?= CAMPOT9 ?>" onchange='UpdateFieldGestion("campot9", "campot9", "<?= $object->GetId() ?>")' name='campot9' id='campot9'>

                                <option value="">Seleccione una Opción</option>

                                <?

                                    $x = $con->Query("select * from meta_listas_valores where id_lista = '".$dat['id']."'");

                                    while ($ror = $con->FetchAssoc($x)) {

                                        $is = ($ror['valor'] == $object->GetCampot9())?"selected='selected'":"";

                                        echo '<option value="'.$ror['valor'].'" '.$is.'>'.$ror['titulo'].'</option>';

                                    }

                                ?>

                            </select>

                            

                    <?

                        }else{

                    ?>

                            <input class="form-control" type='text' name='campot9'   placeholder="<?= CAMPOT9 ?>"  onblur='UpdateFieldGestion("campot9", "campot9", "<?= $object->GetId() ?>")'  id='campot9' value="<?= $object->GetCampot9() ?>" maxlength='100'/>

                    <?

                        }

                    ?>

                    </div>

                </div>

            </div>

        </div>

    <?php endif ?>
    <?php if (CAMPOT14 != ""): ?>

        <div class="row <?= M_CAMPOT14 ?>">

            <div class="col-md-12">

                <div class="form-group">

                    <label class="control-label col-md-3 font-12"<?= $c->Ayuda(352, 'tog') ?>><?= CAMPOT14 ?>:</label>

                    <div class="col-md-9">

                    <?

                        $x = $con->Query("Select * from meta_listas where titulo = '".CAMPOT14."'");

                        $cont = $con->NumRows($x);

                        $dat = $con->FetchAssoc($x);



                        if ($cont > 0) {

                    ?>

                            <select class="form-control select2" type='text'   placeholder="<?= CAMPOT14 ?>"   onchange='UpdateFieldGestion("campot14", "campot14", "<?= $object->GetId() ?>")' name='campot14' id='campot14'>

                                <option value="">Seleccione una Opción</option>

                                <?

                                    $x = $con->Query("select * from meta_listas_valores where id_lista = '".$dat['id']."'");

                                    while ($ror = $con->FetchAssoc($x)) {

                                        $is = ($ror['valor'] == $object->GetCampot14())?"selected='selected'":"";

                                        echo '<option value="'.$ror['valor'].'" '.$is.'>'.$ror['titulo'].'</option>';

                                    }

                                ?>

                            </select>

                            

                    <?

                        }else{

                    ?>

                            <input class="form-control" type='text' name='campot14'   placeholder="<?= CAMPOT14 ?>"  onblur='UpdateFieldGestion("campot14", "campot14", "<?= $object->GetId() ?>")'  id='campot14' value="<?= $object->GetCampot14() ?>" maxlength='100'/>

                    <?

                        }

                    ?>

                    </div>

                </div>

            </div>

        </div>

    <?php endif ?>
    <?php if (CAMPOT10 != ""): ?>

        <div class="row <?= M_CAMPOT10 ?>">

            <div class="col-md-12">

                <div class="form-group">

                    <label class="control-label col-md-3 font-12"<?= $c->Ayuda(348, 'tog') ?>><?= CAMPOT10 ?>:</label>

                    <div class="col-md-9">

                    <?

                        $x = $con->Query("Select * from meta_listas where titulo = '".CAMPOT10."'");

                        $cont = $con->NumRows($x);

                        $dat = $con->FetchAssoc($x);



                        if ($cont > 0) {

                    ?>

                            <select class="form-control select2" type='text'   placeholder="<?= CAMPOT10 ?>"   onchange='UpdateFieldGestion("campot10", "campot10", "<?= $object->GetId() ?>")' name='campot10' id='campot10'>

                                <option value="">Seleccione una Opción</option>

                                <?

                                    $x = $con->Query("select * from meta_listas_valores where id_lista = '".$dat['id']."'");

                                    while ($ror = $con->FetchAssoc($x)) {

                                        $is = ($ror['valor'] == $object->GetCampot10())?"selected='selected'":"";

                                        echo '<option value="'.$ror['valor'].'" '.$is.'>'.$ror['titulo'].'</option>';

                                    }

                                ?>

                            </select>

                            

                    <?

                        }else{

                    ?>

                            <input class="form-control" type='text' name='campot10'   placeholder="<?= CAMPOT10 ?>"   onblur='UpdateFieldGestion("campot10", "campot10", "<?= $object->GetId() ?>")'  id='campot10' value="<?= $object->GetCampot10() ?>" maxlength='100'/>

                    <?

                        }

                    ?>

                    </div>

                </div>

            </div>

        </div>

    <?php endif ?>

    <?php if (CAMPOT11 != ""): ?>

        <div class="row <?= M_CAMPOT11 ?>">

            <div class="col-md-12">

                <div class="form-group">

                    <label class="control-label col-md-3 font-12"<?= $c->Ayuda(349, 'tog') ?>><?= CAMPOT11 ?>:</label>

                    <div class="col-md-9">

                    <?

                        $x = $con->Query("Select * from meta_listas where titulo = '".CAMPOT11."'");

                        $cont = $con->NumRows($x);

                        $dat = $con->FetchAssoc($x);



                        if ($cont > 0) {

                    ?>

                            <select class="form-control select2" type='text'   placeholder="<?= CAMPOT11 ?>"  onchange='UpdateFieldGestion("campot11", "campot11", "<?= $object->GetId() ?>")' name='campot11' id='campot11'>

                                <option value="">Seleccione una Opción</option>

                                <?

                                    $x = $con->Query("select * from meta_listas_valores where id_lista = '".$dat['id']."'");

                                    while ($ror = $con->FetchAssoc($x)) {

                                        $is = ($ror['valor'] == $object->GetCampot11())?"selected='selected'":"";

                                        echo '<option value="'.$ror['valor'].'" '.$is.'>'.$ror['titulo'].'</option>';

                                    }

                                ?>

                            </select>

                            

                    <?

                        }else{

                    ?>

                            <input class="form-control" type='date' name='campot11'  placeholder="<?= CAMPOT11 ?>"   onblur='UpdateFieldGestion("campot11", "campot11", "<?= $object->GetId() ?>")'  id='campot11' value="<?= $object->GetCampot11() ?>" maxlength='100'/>

                    <?

                        }

                    ?>

                    </div>

                </div>

            </div>

        </div>

    <?php endif ?>

    <?php if (CAMPOT12 != ""): ?>

        <div class="row <?= M_CAMPOT12 ?>">

            <div class="col-md-12">

                <div class="form-group">

                    <label class="control-label col-md-3 font-12"<?= $c->Ayuda(350, 'tog') ?>><?= CAMPOT12 ?>:</label>

                    <div class="col-md-9">

                    <?

                        $x = $con->Query("Select * from meta_listas where titulo = '".CAMPOT12."'");

                        $cont = $con->NumRows($x);

                        $dat = $con->FetchAssoc($x);



                        if ($cont > 0) {

                    ?>

                            <select class="form-control select2" type='text'   placeholder="<?= CAMPOT12 ?>"  onchange='UpdateFieldGestion("campot12", "campot12", "<?= $object->GetId() ?>")' name='campot12' id='campot12'>

                                <option value="">Seleccione una Opción</option>

                                <?

                                    $x = $con->Query("select * from meta_listas_valores where id_lista = '".$dat['id']."'");

                                    while ($ror = $con->FetchAssoc($x)) {

                                        $is = ($ror['valor'] == $object->GetCampot12())?"selected='selected'":"";

                                        echo '<option value="'.$ror['valor'].'" '.$is.'>'.$ror['titulo'].'</option>';

                                    }

                                ?>

                            </select>

                            

                    <?

                        }else{

                    ?>

                            <input class="form-control" type='date' name='campot12'  placeholder="<?= CAMPOT12 ?>"   onblur='UpdateFieldGestion("campot12", "campot12", "<?= $object->GetId() ?>")'  id='campot12' value="<?= $object->GetCampot12() ?>" maxlength='100'/>

                    <?

                        }

                    ?>

                    </div>

                </div>

            </div>

        </div>

    <?php endif ?>

    <?php if (CAMPOT13 != ""): ?>

        <div class="row <?= M_CAMPOT13 ?>">

            <div class="col-md-12">

                <div class="form-group">

                    <label class="control-label col-md-3 font-12"<?= $c->Ayuda(351, 'tog') ?>><?= CAMPOT13 ?>:</label>

                    <div class="col-md-9">

                    <?

                        $x = $con->Query("Select * from meta_listas where titulo = '".CAMPOT13."'");

                        $cont = $con->NumRows($x);

                        $dat = $con->FetchAssoc($x);



                        if ($cont > 0) {

                    ?>

                            <select class="form-control select2" type='text'   placeholder="<?= CAMPOT13 ?>"   onchange='UpdateFieldGestion("campot13", "campot13", "<?= $object->GetId() ?>")' name='campot13' id='campot13'>

                                <option value="">Seleccione una Opción</option>

                                <?

                                    $x = $con->Query("select * from meta_listas_valores where id_lista = '".$dat['id']."'");

                                    while ($ror = $con->FetchAssoc($x)) {

                                        $is = ($ror['valor'] == $object->GetCampot13())?"selected='selected'":"";

                                        echo '<option value="'.$ror['valor'].'" '.$is.'>'.$ror['titulo'].'</option>';

                                    }

                                ?>

                            </select>

                            

                    <?

                        }else{

                    ?>

                            <input class="form-control" type='date' name='campot13'  placeholder="<?= CAMPOT13 ?>"   onblur='UpdateFieldGestion("campot13", "campot13", "<?= $object->GetId() ?>")'  id='campot13' value="<?= $object->GetCampot13() ?>" maxlength='100'/>

                    <?

                        }

                    ?>

                    </div>

                </div>

            </div>

        </div>

    <?php endif ?>

    

    
    <hr>   

        <div class="row <?= M_TIPO_DOCUMENTO ?>">
            <div class="col-md-12">
                <label class="control-label col-md-3 font-12" <?= $c->Ayuda(305, 'tog') ?>><?= TIPO_DOCUMENTO ?>:</label>
                <div class="col-md-9">
                    <p class="form-control-static text-muted"> <?= $tipo_d ?> </p>
                    <input type='hidden' name='documento_salida' id='documento_salida' value='<? echo $object->GetDocumento_salida(); ?>' />
                </div>
            </div>
        </div>
        
        <div class="row <?= M_PRIORIDAD ?>">
            <label class="control-label col-md-3 font-12" <?= $c->Ayuda(307, 'tog') ?>><?= PRIORIDAD ?>:</label>
            <div class="col-md-9">
                <? 

                    $ar = array("0" => "Baja", "1" => "Media", "2" => "Alta");

                    echo '<select name="prioridad" id="prioridad"  class="form-control"  placeholder="Prioridad" onchange="UpdateFieldGestion(\'prioridad\', \'prioridad\', \''.$object->GetId().'\')" >';
                    if ($object -> Getprioridad() == "0") {
                        echo    "  
                                    <option value='0'>Baja</option>
                                    <option value='1'>Media</option>
                                    <option value='2'>Alta</option>
                                ";
                    }elseif ($object -> Getprioridad() == "1") {
                        echo    "  
                                    <option value='1'>Media</option>
                                    <option value='0'>Baja</option>
                                    <option value='2'>Alta</option>
                                ";
                    }else{
                        echo    "  
                                    <option value='2'>Alta</option>
                                    <option value='0'>Baja</option>
                                    <option value='1'>Media</option>
                                ";
                    }
                    echo "</select>";
                ?>
            </div>
        </div>
        <div class="row <?= M_FECHA_APERTURA ?>">
             <div class="col-md-12">
                <label class="control-label col-md-3 font-12" <?= $c->Ayuda(308, 'tog') ?>><?= FECHA_APERTURA ?>:</label>
                <div class="col-md-9">
                    <input type='date' class="form-control" name='fecha_recibido' id='f_recibido' maxlength='' value='<? echo $object -> Getf_recibido(); ?>'  onchange="UpdateFieldGestion('f_recibido', 'f_recibido', '<?= $object->GetId() ?>')" />
                </div>
            </div>
        </div>
        <div class="row <?= M_FECHA_RESPUESTA ?>">

            <div class="col-md-12">
                <label class="control-label col-md-3 font-12" <?= $c->Ayuda(309, 'tog') ?>><?= FECHA_RESPUESTA ?>:</label>
                <div class="col-md-9">
                    <input type='date' class="form-control" name='fecha_vencimiento'  style="" id='fecha_vencimiento' maxlength='' value='<? echo $object -> Getfecha_vencimiento(); ?>'  onchange="UpdateFieldGestion('fecha_vencimiento', 'fecha_vencimiento', '<?= $object->GetId() ?>')"  />
                </div>
            </div>
        </div>
        <div class="row <?= M_FECHA_CIERRE ?>">
            <div class="col-md-12">
                <label class="control-label col-md-3 font-12" <?= $c->Ayuda(310, 'tog') ?>><?= FECHA_CIERRE ?>:</label>
                <div class="col-md-9">
                    <input type='date' class="form-control" name='fecha_respuesta'  onchange="UpdateFieldGestion('fecha_respuesta', 'fecha_respuesta', '<?= $object->GetId() ?>')"   style="" id='fecha_respuesta' maxlength='' value='<? echo $object -> Getfecha_respuesta(); ?>' />
                </div>
            </div>
        </div>
        <div class="row <?= M_FOLIOS ?>">
             <div class="col-md-12 m-b-10 m-t-10">
                <label class="control-label col-md-3 font-12" <?= $c->Ayuda(311, 'tog') ?>><?= FOLIOS ?>:</label>
                <div class="col-md-9">
                    <p class="form-control-static text-muted"> <?= $object->Getfolio() ?> </p>
                </div>
            </div>
        </div>
        <div class="row <?= M_DEPARTAMENTO ?>">

             <div class="col-md-12 m-b-10 m-t-10">

                <label class="control-label col-md-3 font-12" <?= $c->Ayuda(312, 'tog') ?>><?= DEPARTAMENTO ?>:</label>

                <div class="col-md-9 p-t-10">
                <? 



                    $city = new MCity;

                    $city->CreateCity("code", $object->GetCiudad());

                    $dp = new MProvince;

                    $dp->CreateProvince("code", $city->GetProvince());

                    $province = $dp->GetName();




                    if ($_SESSION['buscador_global'] == "1"){
                        
                        echo '  <select placeholder="departamento"  name="departamento" id="departamento" class="form-control">

                                    <option value="'.$dp->GetCode().'">'.$dp->GetName().'</option>

                                </select>';
    
                    }else{
                        echo '  <select placeholder="departamento"  name="departamento" id="departamento" class="form-control dn">

                                    <option value="'.$dp->GetCode().'">'.$dp->GetName().'</option>

                                </select>';
                        echo $dp->GetName();                        
                    }

                ?>

                </div>

            </div>

        </div>

        <div class="row <?= M_CIUDAD ?>">

             <div class="col-md-12 m-b-10 m-t-10">

                <label class="control-label col-md-3 font-12" <?= $c->Ayuda(313, 'tog') ?>><?= CIUDAD ?>:</label>

                <div class="col-md-9 p-t-10">

                    <? 

                        if ($_SESSION['buscador_global'] == "1"){
    
                            echo '  <select placeholder="ciudad" name="ciudad" id="ciudad" class="form-control"  >

                                        <option value="'.$city->GetCode().'">'.$city->GetName().'</option>

                                    </select>';
                        }else{
                            echo '  <select placeholder="ciudad" name="ciudad" id="ciudad" class="form-control dn"  >

                                        <option value="'.$city->GetCode().'">'.$city->GetName().'</option>

                                    </select>';
                            echo $city->GetName();
                        }        

                    ?>

                </div>

            </div>

        </div>

        <div class="row <?= M_OFICINA ?>">

             <div class="col-md-12 m-b-10 m-t-10">

                <label class="control-label col-md-3 font-12" <?= $c->Ayuda(314, 'tog') ?>><?= OFICINA ?>:</label>

                <div class="col-md-9 p-t-10">

                 <? 



                    $of = new MSeccional;

                    $of->CreateSeccional("id", $object->GetOficina());

                    $oficina = $of->GetNombre();


                    if ($_SESSION['buscador_global'] == "1"){
    
                        echo '  <select placeholder="oficina" name="oficina" id="oficina" class="form-control" >

                                    <option value="'.$of->GetId().'">'.$oficina.'</option>

                                </select>';
                    }else{
                        echo '  <select placeholder="oficina" name="oficina" id="oficina" class="form-control dn" >

                                    <option value="'.$of->GetId().'">'.$oficina.'</option>

                                </select>';
                        echo $oficina;
                        
                    }       

                ?>

                </div>

            </div>

        </div>

        <div class="row <?= M_CAMPOAREADETRABAJO  ?>">

             <div class="col-md-12 m-b-10 m-t-10">

                <label class="control-label col-md-3 font-12" <?= $c->Ayuda(315, 'tog') ?>><?= CAMPOAREADETRABAJO ?>:</label>

                <div class="col-md-9 p-t-10">

                 <? 



                    $area = new MAreas;

                    $area->CreateAreas("id", $object->GetDependencia_destino());

                    $narea = $area->GetNombre();



                    if ($_SESSION['buscador_global'] == "1"){
    
                        echo '  <select name="dependencia_destino" id="dependencia_destino" class="form-control"    onchange="dependencia_item(\'dependencia_destino\',\'id_dependencia_raiz\',\'/areas_dependencias/GetSeriesArea/\')">

                                    <option value="'.$area->GetId().'">'.$narea.'</option>

                                </select>';
                    }else{

                        echo '  <select name="dependencia_destino" id="dependencia_destino" class="form-control dn"    onchange="dependencia_item(\'dependencia_destino\',\'id_dependencia_raiz\',\'/areas_dependencias/GetSeriesArea/\')">

                                    <option value="'.$area->GetId().'">'.$narea.'</option>

                                </select>';

                        echo $narea;
                        
                    }

                ?>

                </div>

            </div>

        </div>

        <div class="row <?= M_RESPONSABLE ?>">

             <div class="col-md-12 m-b-10 m-t-10">

                <label class="control-label col-md-3 font-12" <?= $c->Ayuda(316, 'tog') ?>><?= RESPONSABLE ?>:</label>

                <div class="col-md-9 p-t-10">

                <? 



                    $u = new MUsuarios;

                    $u->CreateUsuarios("a_i", $object -> Getnombre_destino());

                    $nombreresponsable = $u->GetP_nombre()." ".$u->GetP_apellido();



                    if ($_SESSION['buscador_global'] == "1"){
    
                        echo '  <select name="nombre_destino" id="nombre_destino" class="form-control"  >

                                    <option value="'.$object->Getnombre_destino().'">'.$nombreresponsable.'</option>

                                </select>';
                    }else{
                        echo $nombreresponsable;

                        echo '  <select name="nombre_destino" id="nombre_destino" class="form-control dn"  >

                                    <option value="'.$object->Getnombre_destino().'">'.$nombreresponsable.'</option>

                                </select>';
                    }


                
                ?>
                </div>
                <?php if ($object->GetTransferencia() == "1"): ?>
                    <?php if ($object->Getnombre_destino() == $_SESSION['user_ai']): ?>
                        <?php if ($ut['user_recibe'] != $_SESSION['user_ai']): ?>    
                            <?php
                                echo '
                                    <button type="button" class="btn btn-danger  m-r-10 m-b-10 pull-right m-t-20" onclick="EliminarGestion_transferencias(\''.$ut['id'].'\')"  '.$c->ayuda('32', 'tog').'>
                                        <i class="fa fa-times"></i> Cancelar Transferencia
                                    </button>
                                ';
                            ?>
                        <?php endif ?>
                    <?php endif ?>
                <?php else: ?>
                    <?php if (M_ALERTA_TRANSFERENCIAS != "dn"): ?>
                        <?php if ($ut['user_recibe'] != $_SESSION['user_ai']): ?>    
                            <div class='btn btn-info m-r-10 m-b-10 pull-right m-t-20' <?= $c->Ayuda(83, 'tog') ?> onclick='UpdateGestion()'>Transferir</div>
                        <? endif ?>
                    <? endif ?>
                <?php endif ?>
            </div>

        </div>

        <?php if ($object->GetTransferencia() == "1"): ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-danger" role="alert" <?= $c->Ayuda(325, 'tog') ?>>
                        ESTE EXPEDIENTE SE ENCUENTRA EN TRANSFERENCIA HACIA EL USUARIO <b><?= $usuario_transfiere ?></b>
                    </div>
                </div>
            </div>

        <?php endif ?>
        <div class="row <?= M_COTEJADO?>">

             <div class="col-md-12">

                <label class="control-label col-md-3 font-12" <?= $c->Ayuda(317, 'tog') ?>><?= COTEJADO ?>:</label>

                <div class="col-md-9">

                    <p class="form-control-static text-muted"> <?= $nombreregistra ?> </p>

                </div>

            </div>

        </div>
        <div class="row <?= M_SERIE  ?>">

             <div class="col-md-12 m-b-10 m-t-10">

                <label class="control-label col-md-3 font-12" <?= $c->Ayuda(318, 'tog') ?>><?= SERIE ?>:</label>

                <div class="col-md-9 p-t-10">

                 <? 



                    $d = new MDependencias();

                    $d->CreateDependencias("id", $object -> GetId_dependencia_raiz());



                    
                    if ($_SESSION['buscador_global'] == "1"){
    
                        echo '  <select name="id_dependencia_raiz" id="id_dependencia_raiz"   placeholder="'.SERIE.'" class="form-control"  onchange="dependencia_item2(\'dependencia_destino\', \'id_dependencia_raiz\',\'tipo_documento\', \'/areas_dependencias/GetSubSeriesArea/\'); UpdateFieldGestion(\'id_dependencia_raiz\', \'id_dependencia_raiz\', \''.$object->GetId().'\')">

                                    <option value="'.$d->GetId().'">'.$d->GetNombre().'</option>

                                </select>';
                    }else{

                        echo '  <select name="id_dependencia_raiz" id="id_dependencia_raiz"   placeholder="'.SERIE.'" class="form-control dn"  onchange="dependencia_item2(\'dependencia_destino\', \'id_dependencia_raiz\',\'tipo_documento\', \'/areas_dependencias/GetSubSeriesArea/\'); UpdateFieldGestion(\'id_dependencia_raiz\', \'id_dependencia_raiz\', \''.$object->GetId().'\')">

                                    <option value="'.$d->GetId().'">'.$d->GetNombre().'</option>

                                </select>';

                        echo $d->GetNombre();
                        
                    }


                ?>

                </div>

            </div>

        </div>

        <div class="row <?= M_SUB_SERIE ?>">

             <div class="col-md-12 m-b-10 m-t-10">

                <label class="control-label col-md-3 font-12" <?= $c->Ayuda(319, 'tog') ?>><?= SUB_SERIE ?>:</label>

                <div class="col-md-9 p-t-10">

                <? 



                    $d = new MDependencias();

                    $d->CreateDependencias("id", $object -> Gettipo_documento());




                    if ($_SESSION['buscador_global'] == "1"){
                        echo '  <select name="tipo_documento" id="tipo_documento"   class="form-control" placeholder="'.SUB_SERIE.'" onchange="UpdateFieldGestion(\'tipo_documento\', \'tipo_documento\', \''.$object->GetId().'\')" >

                                    <option value="'.$d->GetId().'">'.$d->GetNombre().'</option>

                                </select>';
    
                    }else{
                        echo '  <select name="tipo_documento" id="tipo_documento" class="form-control" placeholder="'.SUB_SERIE.'" onchange="UpdateFieldGestion(\'tipo_documento\', \'tipo_documento\', \''.$object->GetId().'\')" >
                                    <option value="'.$d->GetId().'">'.$d->GetNombre().'</option>
                                </select>';
                        
                       # echo $d->GetNombre();
                    }        

                ?>

                </div>

            </div>

        </div>
        <?php if ($ut['user_recibe'] == $_SESSION['user_ai']): ?>
            <div class="row dn">
                <div class="col-md-12">
                        <?php
                        echo '
                            <button type="button" class="btn btn-danger  m-r-10 m-t-10 m-b-10 pull-right " onclick="RechazarSolicitud(\''.$ut['id'].'\')"  '.$c->ayuda('31', 'tog').'>
                                <i class="fa fa-times"></i> Rechazar Solicitud
                            </button>
                            <button type="button" class="btn btn-info m-r-10  m-t-10 m-b-10 pull-right  " onclick="AceptarSolicitud(\''.$ut['id'].'\')"  '.$c->ayuda('30', 'tog').'>
                                <i class="fa fa-check"></i> Aceptar Solicitud
                            </button>
                        ';
                    ?>
                </div>
            </div>
        <?php endif ?>

        <div class="row <?= M_OBSERVACION ?>">

             <div class="col-md-12">

                <label class="control-label col-md-3 font-12" <?= $c->Ayuda(320, 'tog') ?>><?= OBSERVACION ?>:</label>

                <div class="col-md-9">

                     <textarea class="form-control height-100"  name='observacion2'  id='observacion2' onblur='UpdateFieldGestion("observacion2", "observacion2", "<?= $object->GetId() ?>")'  placeholder="<?= OBSERVACION ?>"   ><? echo $object -> Getobservacion2(); ?></textarea>

                </div>

            </div>

        </div>

        <div class="row <?= M_UBICACION ?>">

             <div class="col-md-12">

                <label class="control-label col-md-3 font-12" <?= $c->Ayuda(321, 'tog') ?>><?= UBICACION ?>:</label>

                <div class="col-md-9">
                <? 



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

                ?>

                </div>

            </div>

        </div>

        <div class="row <?= M_URI ?>">

             <div class="col-md-12">

                <label class="control-label col-md-3 font-12" <?= $c->Ayuda(322, 'tog') ?>><?= URI ?>:</label>

                <div class="col-md-9">

                    <p class="form-control-static text-muted"> <?= "<a href='".$codeText."' target='_blank'>".$codeText."</a>" ?> </p>

                </div>

            </div>

        </div>

        <div class="row  m-b-30 m-t-30">

            <div class="col-md-4">

                <?

                    if ($_SESSION['mayedit'] == "1") {

                        if ($_SESSION['MODULES']['foleado_electronico'] == "1") {

                            if(!$bloquear_del_todo){

                ?>

                        <div class='btn btn-info' onclick='OpenWindow("/gestion/inventario/<?= $object->GetId() ?>/")' style="width:auto; " title="Foliado Electrónico" <?= $c->Ayuda('322', 'tog') ?>>Fol. Electrónico</div>

                <?

                            }

                        }

                    }

                ?>

            </div>

            <div class="col-md-4">

                <?

                    if ($_SESSION['MODULES']['foleado_electronico'] == "1") {

                        if(!$bloquear_del_todo){

                ?>

                    <div class='btn btn-info' onclick='OpenWindow("/dependencias/TRD/<?= $object->GetDependencia_destino() ?>/")' style="width:auto; " <?= $c->Ayuda('323', 'tog') ?>>Consultar TRD</div>

                <?

                        }

                    }

                ?>

            </div>

            <div class="col-md-4" >

                <?

                    if ($_SESSION['MODULES']['foleado_electronico'] == "1") {

                        if(!$bloquear_del_todo){

                ?>

                    <div class='btn btn-info' onclick='OpenWindow("/dependencias/TVD/<?= $object->GetId() ?>/")' style="width:auto; " <?= $c->Ayuda('324', 'tog') ?>>Consultar TVD</div>

                <?

                        }

                    }

                ?>

            </div>



            <div class="col-md-12 m-t-20" style="display:none">

            <?

                if ($_SESSION['mayedit'] == "1") {

                    if ($_SESSION['MODULES']['foleado_electronico'] == "1") {

                        if(!$bloquear_del_todo){

            ?>

                            <div class='btn btn-info' id="myexportbutton" onclick='ExportarResumen("<?= $object->GetId() ?>")' style="width:auto;">

                                Exportar Al Expediente

                            </div>

                            <div id="mypanelresult"></div>

            <?

                        }

                    }

                }

            ?>

            </div>

        </div>      

    </div>

</form>

<script type="text/javascript">

$(document).ready(function() {





    dependencia_estadoinExistence('departamento');



    $("#departamento").change(function(){



        dependencia_ciudadinExistence("departamento","ciudad");



        $("#ciudad").attr("disabled", true); $("#ciudad").addClass("disabled"); $("#ciudad option:selected").text("Seleccione una opcion"); $("#ciudad option:selected").val("");



        $("#oficina").attr("disabled", true); $("#oficina").addClass("disabled"); $("#oficina option:selected").text("Seleccione una opcion"); $("#oficina option:selected").val("");



        $("#dependencia_destino").attr("disabled", true); $("#dependencia_destino").addClass("disabled"); $("#dependencia_destino option:selected").text("Seleccione una opcion"); $("#dependencia_destino option:selected").val("");



        $("#nombre_destino").attr("disabled", true); $("#nombre_destino").addClass("disabled"); $("#nombre_destino option:selected").text("Seleccione una opcion"); $("#nombre_destino option:selected").val("");



        $("#id_dependencia_raiz").attr("disabled", true); $("#id_dependencia_raiz").addClass("disabled"); $("#id_dependencia_raiz option:selected").text("Seleccione una opcion"); $("#id_dependencia_raiz option:selected").val("");



        $("#tipo_documento").attr("disabled", true); $("#tipo_documento").addClass("disabled"); $("#tipo_documento option:selected").text("Seleccione una opcion"); $("#tipo_documento option:selected").val("");



    });



    $("#ciudad").change(function(){



        dependencia_item("ciudad","oficina", "/seccional/listadooficinasseccional");



        $("#oficina").attr("disabled", true); $("#oficina").addClass("disabled"); $("#oficina option:selected").text("Seleccione una opcion"); $("#oficina option:selected").val("");

        $("#dependencia_destino").attr("disabled", true); $("#dependencia_destino").addClass("disabled"); $("#dependencia_destino option:selected").text("Seleccione una opcion"); $("#dependencia_destino option:selected").val("");

        $("#nombre_destino").attr("disabled", true); $("#nombre_destino").addClass("disabled"); $("#nombre_destino option:selected").text("Seleccione una opcion"); $("#nombre_destino option:selected").val("");

        $("#id_dependencia_raiz").attr("disabled", true); $("#id_dependencia_raiz").addClass("disabled"); $("#id_dependencia_raiz option:selected").text("Seleccione una opcion"); $("#id_dependencia_raiz option:selected").val("");

        $("#tipo_documento").attr("disabled", true); $("#tipo_documento").addClass("disabled"); $("#tipo_documento option:selected").text("Seleccione una opcion"); $("#tipo_documento option:selected").val("");



    });



    $("#oficina").change(function(){



        dependencia_item("oficina","dependencia_destino", "/usuarios/ListadoAreasOficinaNew");



        $("#dependencia_destino").attr("disabled", true); $("#dependencia_destino").addClass("disabled"); $("#dependencia_destino option:selected").text("Seleccione una opcion"); $("#dependencia_destino option:selected").val("");

        $("#nombre_destino").attr("disabled", true); $("#nombre_destino").addClass("disabled"); $("#nombre_destino option:selected").text("Seleccione una opcion"); $("#nombre_destino option:selected").val("");

        $("#id_dependencia_raiz").attr("disabled", true); $("#id_dependencia_raiz").addClass("disabled"); $("#id_dependencia_raiz option:selected").text("Seleccione una opcion"); $("#id_dependencia_raiz option:selected").val("");

        $("#tipo_documento").attr("disabled", true); $("#tipo_documento").addClass("disabled"); $("#tipo_documento option:selected").text("Seleccione una opcion"); $("#tipo_documento option:selected").val("");



    });



    $("#dependencia_destino").change(function(){



        dependencia_item("dependencia_destino","nombre_destino", "/usuarios/ListadoUsuariosAreasOficina3New/"+$("#oficina").val());

        $("#nombre_destino").attr("disabled", true); $("#nombre_destino").addClass("disabled"); $("#nombre_destino option:selected").text("Seleccione una opcion"); $("#nombre_destino option:selected").val("");

        $("#id_dependencia_raiz").attr("disabled", true); $("#id_dependencia_raiz").addClass("disabled"); $("#id_dependencia_raiz option:selected").text("Seleccione una opcion"); $("#id_dependencia_raiz option:selected").val("");

        $("#tipo_documento").attr("disabled", true); $("#tipo_documento").addClass("disabled"); $("#tipo_documento option:selected").text("Seleccione una opcion"); $("#tipo_documento option:selected").val("");



    });



    dependencia_ciudadinExistence("departamento","ciudad");

    dependencia_item("ciudad","oficina", "/seccional/listadooficinasseccional");



    setTimeout(function(){

        dependencia_item("oficina","dependencia_destino", "/usuarios/ListadoAreasOficinaNew");

    }, 1000);



    setTimeout(function(){

        dependencia_item("dependencia_destino","nombre_destino", "/usuarios/ListadoUsuariosAreasOficina3New/"+$("#oficina").val());

    }, 1000);



    setTimeout(function(){

        dependencia_item("dependencia_destino","id_dependencia_raiz","/areas_dependencias/GetSeriesArea/");

    }, 1000);



    setTimeout(function(){

        dependencia_item2('dependencia_destino', 'id_dependencia_raiz','tipo_documento', '/areas_dependencias/GetSubSeriesArea/')

    }, 1000);



});

</script>

<link rel='stylesheet' type='text/css' href='<?= HOMEDIR.DS ?>app/plugins/select2/css/select2.min.css'/>

<script language='javascript' type='text/javascript' src='<?= HOMEDIR.DS ?>app/plugins/select2/js/select2.min.js'></script>

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

        valor = $("#"+valor).val().replaceAll(' ', "+");
        campo = campo.replaceAll(' ', '+');

        var URL = '/gestion/actualizarcampoproceso/'+valor+'/'+campo+'/'+id+'/';
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


<div class="button-box dn">
    <button class="tst1 btn btn-info">Info Message</button>
</div>       
<?php if ($ut['user_recibe'] == $_SESSION['user_ai']): ?>    
<script>
function RechazarSolicitud(id){
    if(confirm('Esta seguro desea Rechazar esta solicitud de transferencia')){
        t = prompt("Escriba porque desea rechazar esta solicitud");
        var URL = '/gestion_transferencias/rechazar/'+id+'/';
        var st = "observaciona="+t
        $.ajax({
            type: 'POST',
            url: URL,
            data: st,
            success: function(msg){
                alert(msg);
                window.location.reload();
            }
        });
    }
}   

function AceptarSolicitud(id){
    if(confirm('Esta seguro desea Aceptar esta solicitud de transferencia')){
        area     = $("#dependencia_destino").val();
        serie    = $("#id_dependencia_raiz").val();
        subserie = $("#tipo_documento").val();
        if (serie == "Seleccione una Serie" || subserie == "Seleccione una Sub-Serie") {
            alert("Debe seleccionar una serie y una subserie documental");
        }else{

            var URL = '/gestion_transferencias/aceptarsolicitud/'+id+'/';
            var st = "area="+area+"&serie="+serie+"&subserie="+subserie;

            $.ajax({
                type: 'POST',
                url: URL,
                data: st,
                success: function(msg){
                    alert("Solicitud Aceptada!");
                    $("#salidadedato").html(msg);
                    window.location.reload();
                }
            });
        }
    }
}
</script>       
<?php endif ?>
<?php if ($object->Getnombre_destino() == $_SESSION['user_ai']): ?>
<script>
    function EliminarGestion_transferencias(id){
        if(confirm('Esta seguro desea eliminar esta solicitud de transferencia')){
            var URL = '/gestion_transferencias/eliminar/'+id+'/';
            $.ajax({
                type: 'POST',
                url: URL,
                success: function(msg){
                    alert(msg);
                    window.location.reload();
                }
            });
        }
        
}
</script>   
<?php endif ?>