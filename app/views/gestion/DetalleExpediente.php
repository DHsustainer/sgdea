<?
    echo "->".$_SESSION['mayedit'];
        if ($_SESSION['suscriptor_id'] == "" && $_SESSION['mayedit'] == "1") {

            if(!$bloquear_del_todo){

?>

            <div class='opc' onclick='OpenWindow("/gestion/imprimir/<?= $object->GetId() ?>/")' style="width:auto; ">Imprimir</div>

            <?php if($_SESSION['editar'] == 1 || $object->Getnombre_destino() == $usua->GetA_i() || strtolower($object->GetUsuario_registra()) == strtolower($usua->GetUser_id()) || $_SESSION['mayedit'] == "1"){ ?><div class='opc' id='edit_opcgestion' onclick='EditGestion()' style="width:auto; ">Editar Formulario</div><?php } ?>

            <div class='opc' id='save_opcgestion' onclick='UpdateGestion()' style="width:auto; display:none;" >Guardar Formulario</div>

<?

            }

        }else{

            if(!$bloquear_del_todo){

            ?>

                <div class='opc' onclick='OpenWindow("/gestion/imprimir/<?= $object->GetId() ?>/")' style="width:auto; ">Imprimir</div>

            <?php

            }

            if (($_SESSION['archivo_central'] == "1" || $_SESSION['archivo_historico'] == "1") && $_SESSION['suscriptor_id'] == "") {

                if(!$bloquear_del_todo){

            ?>

                <div class='opc' id='edit_opcgestion2' onclick='EditGestion2()' style="width:auto; ">Editar Formulario</div>

                <div class='opc' id='save_opcgestion' onclick='UpdateGestion()' style="width:auto; display:none;" >Guardar Formulario</div>

            <?php

                }

            }

        }

?>
            <div class="clear"></div>

            <div class="table" id="formprimible">

                <?

                    if ($_SESSION['suscriptor_id'] == "") {

                ?>

                <?

                    }

                ?>

                <form id='FormUpdategestion' action='/gestion/actualizar/<?= $object->GetId() ?>/' method='POST'> 

                    <div style='display:none;'>

                        <input type='hidden' name='id' id='id' value='<? echo $object -> GetId(); ?>' />

                        <!--<input type='hidden' name='num_oficio_respuesta' id='num_oficio_respuesta' maxlength='' value='<? echo $object -> Getnum_oficio_respuesta(); ?>' />-->

                    </div>
                    <?php if ($object->GetTransferencia() == "1"): ?>
                    <?
                        $qut = $con->Query("select user_recibe from gestion_transferencias where gestion_id = '".$object->GetId()."' and estado = '0'");
                        $ut = $con->FetchAssoc($qut);
                        $usuario_transfiere = $c->GetDataFromTable("usuarios", "a_i", $ut['user_recibe'], "p_nombre, p_apellido", $separador = " ");
                    ?>
                            <div class="row">
                                <div class="col-md-12"><div class="alert alert-danger" role="alert">ESTE EXPEDIENTE SE ENCUENTRA EN TRANSFERENCIA HACIA EL USUARIO <b><?= $usuario_transfiere ?></b></div></div>
                            </div>
                    <?php endif ?>

                        <div class="row">

                            <div class="col-md-3 responsiveness_text"><strong>Rad. Externo:</strong></div>

                            <div class="col-md-9 responsiveness_text">

                                <?= "<span class='tempspace'>".$object->GetRadicado()."</span>" ?>

                                <input type='text' style="" class="no_editable input1" name='radicado' id='radicado' maxlength='' value='<? echo $object -> Getradicado(); ?>' />

                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-3 responsiveness_text"><strong>Radicado:</strong></div>

                            <div class="col-md-9 responsiveness_text">

                                <?= "<span>".$object->GetMin_rad()."</span>" ?>

                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-3 responsiveness_text">
                                <strong>Asunto:</strong>
                            </div>
                            <div class="col-md-9 responsiveness_text">
                                 <? echo "<span class='tempspace'>".$object -> Getobservacion()."</span>"; ?>
                                <textarea class="no_editable input1"  name='observacion'  style="width:300px; height:60px" id='observacion'><? echo $object -> Getobservacion(); ?></textarea>
                            </div>
                        </div>

                        <?
                            $tieneestadosq = $con->Query("Select * from estados_gestion where dependencia = '".$object->Gettipo_documento()."'");
                            $tieneestados = $con->NumRows($tieneestadosq);

                            if ($tieneestados > 0) {
                        ?>
                        <div class="row">
                            <div class="col-md-3 responsiveness_text">
                                <strong>
                                    Estado Personalizado:  
                                </strong>
                            </div>
                            <div class="col-md-9 responsiveness_text">
                               <? 
                                $estado_solicitud = $c->GetDataFromTable("estados_gestion", "id", $object -> GetEstado_personalizado(), "nombre", $separador = " ");

                                if ($estado_solicitud == "") {
                                    $estado_solicitud = "Seleccione una Opción";
                                }

                                echo "<span class='tempspace'>".$estado_solicitud."</span>"; 
                                echo '<select name="estado_personalizado" id="estado_personalizado"  class="no_editable input1" disabled="disabled" style="">';
                                        echo "<option value='".$object->GetEstado_personalizado()."'>".$estado_solicitud."</option>";
                                    $es = new MEstados_gestion();
                                    $listestados_gestion = $es->ListarEstados_gestion("where id != '".$object->GetEstado_personalizado()."' and dependencia = '".$object->Gettipo_documento()."'");
                                        while ($rowx = $con->FetchAssoc($listestados_gestion)) {
                                            echo "<option value='".$rowx['id']."'>".$rowx['nombre']."</option>";
                                        }
                                echo "</select>";
                                ?>  
                            </div>
                        </div>
                        <?
                            }else{
                        ?>
                                <input type="hidden" id="estado_personalizado" name="estado_personalizado" value="">
                        <?
                            }
                        ?>

                        <div class="row">

                            <div class="col-md-3 responsiveness_text"><strong>Suscriptor:</strong></div>

                            <div class="col-md-9 responsiveness_text">

                                <? 

                                    $s = new Msuscriptores_contactos;

                                    $s->CreateSuscriptores_contactos("id", $object -> Getsuscriptor_id());

                                    echo "<span class='tempspace'>".$s->GetNombre()."</span>";

                                ?>

                                <select name='suscriptor_id' id='suscriptor_id'  class="no_editable input1" style="display:none;" disabled="disabled" >

                                    <option value="<?= $s->GetId() ?>"><?= $s->GetNombre() ?></option>

                                    <?

                                        $que = $s->ListarSuscriptores_contactos();

                                        while ($rc = $con->FetchAssoc($que)) {

                                            echo "<option value='".$rc['id']."'>".$rc['nombre']."</option>";

                                        }

                                    ?>

                                </select>

                                <input type="text" id="searchbformsuscriptor_id" class="no_editable input1"  style=""  value="<?= $s->GetNombre() ?>" >

                                <div id="bloquebusqueda" class="bloquebusqueda_suscriptor_id"></div>

                            </div>

                        </div>

                    <script type="text/javascript">

                        $("#searchbformsuscriptor_id").on("keyup", function(){

                            $(".bloquebusqueda_suscriptor_id").fadeIn();            

                            $.ajax({

                                type: "POST",

                                url: '/usuarios/GestListadoUsuariosSuscriptores2/'+$(this).val()+"/",

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

                        }

                    </script>

                        <div class="row">
                            <div class="col-md-3 responsiveness_text">
                                <strong>
                                    Soporte:  
                                </strong>
                            </div>
                            <div class="col-md-3 responsiveness_text">
                               <? 
                                $estado_solicitud = $c->GetDataFromTable("estados_gestion", "id", $object -> GetEstado_solicitud(), "nombre", $separador = " ");
                                echo "<span class='tempspace'>".$estado_solicitud."</span>"; 
                                echo '<select name="estado_solicitud" id="estado_solicitud"  class="no_editable input1" disabled="disabled" style="">';
                                        echo "<option value='".$object->GetEstado_solicitud()."'>".$estado_solicitud."</option>";
                                    $es = new MEstados_gestion();
                                    $listestados_gestion = $es->ListarEstados_gestion("where id != '".$object->GetEstado_solicitud()."' and dependencia = '0'");
                                        while ($rowx = $con->FetchAssoc($listestados_gestion)) {
                                            echo "<option value='".$rowx['id']."'>".$rowx['nombre']."</option>";
                                        }
                                echo "</select>";
                                ?>  
                            </div>

                            <div class="col-md-3 responsiveness_text">

                                <strong>

                                    Fecha Apertura:

                                </strong>

                            </div>

                            <div class="col-md-3 responsiveness_text">

                                 <input type='text' class="no_editable input1 datepicker" name='fecha_recibido'  style="" id='fecha_recibido' maxlength='' value='<? echo $object -> Getf_recibido(); ?>' />

                                <? echo "<span class='tempspace'>".$object -> Getf_recibido()."</span>"; ?>

                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-3 responsiveness_text">

                                <strong>Documento de:</strong>

                            </div>

                            <div class="col-md-3 responsiveness_text">

                                <? echo "<span class='tempspace'>";
                                $tipo_d="Entrada";
                                if($object -> GetDocumento_salida() == 'S'){

                                     $tipo_d= "Salida";

                                }
                                if($object -> GetDocumento_salida() == 'C'){

                                     $tipo_d= "Comunicaciones Internas";

                                }                            
                                echo $tipo_d;
                                echo "</span>"; ?>

                                <select name='documento_salida' id='documento_salida'  class="no_editable input1"  style=" width:80px"  disabled="disabled" >
                                    <option value='N'>Entrada</option>
                                    <option value='S'>Salida</option>                                    
                                    <option value='C'>Comunicaciones Internas</option>
                                </select>
                                <script type="text/javascript">
                                    $('#documento_salida').val('<?php echo $object -> GetDocumento_salida(); ?>');
                                </script>
                            </div>

                            <div class="col-md-3 responsiveness_text">

                                <strong>Fecha Vence:</strong>

                            </div>

                            <div class="col-md-3 responsiveness_text">

                                <? echo "<span class='tempspace'>".$object -> Getfecha_vencimiento()."</span>"; ?>

                                <input type='text' class="no_editable input1 datepicker" name='fecha_vencimiento'  style="" id='fecha_vencimiento' maxlength='' value='<? echo $object -> Getfecha_vencimiento(); ?>' />

                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-3 responsiveness_text">

                                <strong>Estado</strong>

                            </div>

                            <div class="col-md-3 responsiveness_text">

                                <? echo "<span class='tempspace'>".$object -> Getestado_respuesta()."</span>"; ?>

                                <select name='estado_respuesta' id='estado_respuesta'  class="no_editable input1"  style=" width:80px"  disabled="disabled" >

                                    <? echo ($object -> Getestado_respuesta() == "SI")?"<option value='Cerrado'>Cerrado</option><option value='Abierto'>Abierto</option>":"<option value='Abierto'>Abierto</option><option value='Cerrado'>Cerrado</option>"; ?>

                                </select>

                            </div>

                            <div class="col-md-3 responsiveness_text">

                                <strong>Fecha Cierre:</strong>

                            </div>

                            <div class="col-md-3 responsiveness_text">

                                <input type='text' class="no_editable input1 datepicker" name='fecha_respuesta'  style="" id='fecha_respuesta' maxlength='' value='<? echo $object -> Getfecha_respuesta(); ?>' />

                                <? echo "<span class='tempspace'>".$object -> Getfecha_respuesta()."</span>"; ?>

                            </div>

                        </div>

                         <div class="row">

                            <div class="col-md-3 responsiveness_text">

                                <strong>Prioridad:</strong>

                            </div>

                            <div class="col-md-3 responsiveness_text">

                                <? 

                                    $ar = array("0" => "Baja", "1" => "Media", "2" => "Alta");

                                    echo "<span class='tempspace'>".$ar[$object -> Getprioridad()]."</span>"; 

                                    echo '<select name="prioridad" id="prioridad"  class="no_editable input1" disabled="disabled" style=" width:80px">';

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

                            <div class="col-md-3 responsiveness_text">

                                <strong># Folios:</strong>

                            </div>

                            <div class="col-md-3 responsiveness_text">

                                <? echo $object -> Getfolio(); ?>

                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-3 responsiveness_text">

                                <strong>Departamento:</strong>

                            </div>

                            <div class="col-md-9 responsiveness_text">

                                <? 

                                    $city = new MCity;

                                    $city->CreateCity("code", $object->GetCiudad());

                                    $dp = new MProvince;

                                    $dp->CreateProvince("code", $city->GetProvince());

                                    $province = $dp->GetName();

                                    echo "<span class='tempspace'>".$province."</span>";

                                    echo '  <select placeholder="departamento" style=" width:300px" name="departamento" id="departamento" class="no_editable input1  important " disabled="disabled">

                                                <option value="'.$dp->GetCode().'">'.$dp->GetName().'</option>

                                            </select>';

                                ?>

                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-3 responsiveness_text">

                                <strong>Ciudad:</strong>

                            </div>

                            <div class="col-md-9 responsiveness_text">

                                <? 

                                    echo "<span class='tempspace'>".$city->GetName()."</span>";

                                    echo '  <select placeholder="ciudad" style=" width:300px" name="ciudad" id="ciudad" class="no_editable input1  important " disabled="disabled">

                                                <option value="'.$city->GetCode().'">'.$city->GetName().'</option>

                                            </select>';

                                ?>

                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-3 responsiveness_text">

                                <strong>Oficina:</strong>

                            </div>

                            <div class="col-md-9 responsiveness_text">

                                <? 

                                    $of = new MSeccional;

                                    $of->CreateSeccional("id", $object->GetOficina());

                                    $oficina = $of->GetNombre();

                                    echo "<span class='tempspace'>".$oficina."</span>";

                                    echo '  <select placeholder="oficina" style=" width:300px" name="oficina" id="oficina" class="no_editable input1  important " disabled="disabled">

                                                <option value="'.$of->GetId().'">'.$oficina.'</option>

                                            </select>';

                                ?>

                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-3 responsiveness_text">

                                <strong><?= CAMPOAREADETRABAJO ?>:</strong>

                            </div>

                            <div class="col-md-9 responsiveness_text">

                                <? 

                                    $area = new MAreas;

                                    $area->CreateAreas("id", $object->GetDependencia_destino());

                                    $narea = $area->GetNombre();

                                    echo "<span class='tempspace'>".$narea."</span>";

                                    echo '  <select placeholder="dependencia_destino" style=" width:300px" name="dependencia_destino" id="dependencia_destino" class="no_editable input1  important"   onchange="dependencia_item(\'dependencia_destino\',\'id_dependencia_raiz\',\'/areas_dependencias/GetSeriesArea/\')"  disabled="disabled">

                                                <option value="'.$area->GetId().'">'.$narea.'</option>

                                            </select>';

                                ?>

                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-3 responsiveness_text">

                                <strong>Responsable:</strong>

                            </div>

                            <div class="col-md-9 responsiveness_text">

                                <? 

                                    $u = new MUsuarios;

                                    $u->CreateUsuarios("a_i", $object -> Getnombre_destino());

                                    $nombreresponsable = $u->GetP_nombre()." ".$u->GetP_apellido();

                                    echo "<span class='tempspace'>".$nombreresponsable."</span>";

                                    echo '  <select placeholder="nombre_destino" style=" width:300px" name="nombre_destino" id="nombre_destino" class="no_editable input1  important" disabled="disabled">

                                                <option value="'.$object->Getnombre_destino().'">'.$nombreresponsable.'</option>

                                            </select>';

                                ?>

                            </div>

                        </div>
                        <?php if ($object->GetTransferencia() == "1"): ?>
                            <div class="row">
                                <div class="col-md-12"><div class="alert alert-danger" role="alert">ESTE EXPEDIENTE SE ENCUENTRA EN TRANSFERENCIA HACIA EL USUARIO <b><?= $usuario_transfiere ?></b></div></div>
                            </div>
                        <?php endif ?>

                         <div class="row">

                            <div class="col-md-3 responsiveness_text">

                                <strong>Cotejado por:</strong>

                            </div>

                            <div class="col-md-9 responsiveness_text">

                                <? 
                                    $ur = new MUsuarios;
                                    $ur->CreateUsuarios("user_id", $object -> GetUsuario_registra());
                                    $nombreregistra = $ur->GetP_nombre()." ".$ur->GetP_apellido();
                                    echo "<span class='tempspace'>".$nombreregistra."</span>";
                                ?>

                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-3 responsiveness_text">

                                <strong>Serie:</strong>

                            </div>

                            <div class="col-md-9 responsiveness_text">

                                <? 

                                    $d = new MDependencias();

                                    $d->CreateDependencias("id", $object -> GetId_dependencia_raiz());

                                    echo "  <span class='tempspace'>".$d->GetNombre()."</span>";

                                    echo '  <select placeholder="id_dependencia_raiz" style=" width:300px" name="id_dependencia_raiz" id="id_dependencia_raiz" class="no_editable input1  important" disabled="disabled" onchange="dependencia_item2(\'dependencia_destino\', \'id_dependencia_raiz\',\'tipo_documento\', \'/areas_dependencias/GetSubSeriesArea/\')">

                                                <option value="'.$d->GetId().'">'.$d->GetNombre().'</option>

                                            </select>';

                                ?>

                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-3 responsiveness_text">

                                <strong>Sub Serie:</strong>

                            </div>

                            <div class="col-md-9 responsiveness_text">

                                <? 

                                    $d = new MDependencias();

                                    $d->CreateDependencias("id", $object -> Gettipo_documento());

                                    echo "  <span class='tempspace'>".$d->GetNombre()."</span>";

                                    echo '  <select placeholder="tipo_documento" style=" width:300px" name="tipo_documento" id="tipo_documento" class="no_editable input1  important" disabled="disabled">

                                                <option value="'.$d->GetId().'">'.$d->GetNombre().'</option>

                                            </select>';

                                ?>

                            </div>

                        </div>



                        <div class="row">

                            <div class="col-md-3 responsiveness_text">

                                <strong>Observacion:</strong>

                            </div>

                            <div class="col-md-9 responsiveness_text">

                                 <? echo "<span class='tempspace'>".$object -> Getobservacion2()."</span>"; ?>

                                <textarea class="no_editable input1"  name='observacion2'  style="width:300px; height:60px" id='observacion2'><? echo $object -> Getobservacion2(); ?></textarea>

                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-3 responsiveness_text">

                                <strong>Ubicación:</strong>

                            </div>

                            <div class="col-md-9 responsiveness_text">

                                 <? 

                                    $ar2 = array("1" => "Archivo de Gestión", "2" => "Archivo Central", "3" => "Archivo Histórico", "-1" => "Eliminación", "-2" => "Conservación Total", "-3" => "Digitalización", "-4" => "Selección", "-5" => "MicroFilmación", "-6" => "Hibrido", "-7" => "Digitalizar y Eliminar", "-8" => "Seleccionar y Eliminar", "-9" => "Conservación Total y Digitalización");

                                    echo "<span class='tempspace tempspace2'>".$ar2[$object -> Getestado_archivo()]."</span>"; 

                                    $valh = $d->GetT_h();

                                    $nomh = "Historico: (".$ar2[$valh].")";

                                    echo '<select name="estado_archivo"   id="estado_archivo"  class="no_editable input1 input2" disabled="disabled" >';

                                    if ($object->Getestado_archivo() == "-99") {
                                        echo    "  
                                                <option value='-99'>Eliminar</option>
                                                <option value='".$valh."'>".$nomh."</option>
                                                <option value='1'>Archivo de Gestión</option>
                                                <option value='2'>Archivo Central</option>";
                                    }else{
                                        if ($object -> Getestado_archivo() == "1") {
                                            echo    "   <option value='1'>Archivo de Gestión</option>
                                                        <option value='2'>Archivo Central</option>
                                                        <option value='".$valh."'>".$nomh."</option>
                                                        <option value='-99'>Eliminar</option>";
                                        }elseif ($object -> Getestado_archivo() == "2") {

                                            echo    "   <option value='2'>Archivo Central</option>
                                                        <option value='1'>Archivo de Gestión</option>
                                                        <option value='".$valh."'>".$nomh."</option>
                                                        <option value='-99'>Eliminar</option>";
                                        }else{
                                            echo    "   <option value='".$valh."'>".$nomh."</option>
                                                        <option value='1'>Archivo de Gestión</option>
                                                        <option value='2'>Archivo Central</option>
                                                        <option value='-99'>Eliminar</option>";
                                        }
                                    }
                                    echo "</select>";
                            ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 responsiveness_text">
                                <strong>Enlace de Consulta Publica (URI):</strong>
                            </div>
                            <div class="col-md-9 responsiveness_text">
                                <?php 
                                    $codeText = HOMEDIR.DS.'s/'.$object->GetUri().'/'; 
                                    echo "<a href='".$codeText."' target='_blank'>".$codeText."</a>";
                                ?>
                            </div>
                        </div>
                <?
                    if ($_SESSION['suscriptor_id'] == "") {
                ?>
                        <div class="row">
                            <div class="col-md-4">
                                <?
                                    if ($_SESSION['mayedit'] == "1") {
                                        if ($_SESSION['MODULES']['foleado_electronico'] == "1") {
                                            if(!$bloquear_del_todo){
                                ?>
                                        <div class='opc' onclick='OpenWindow("/gestion/inventario/<?= $object->GetId() ?>/")' style="width:auto; " title="Foliado Electrónico">Fol. Electrónico</div>
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
                                    <div class='opc' onclick='OpenWindow("/dependencias/TRD/<?= $object->GetDependencia_destino() ?>/")' style="width:auto; ">Consultar TRD</div>
                                <?
                                        }
                                    }
                                ?>
                            </div>
                            <div class="col-md-4">
                                <?
                                    if ($_SESSION['MODULES']['foleado_electronico'] == "1") {
                                        if(!$bloquear_del_todo){
                                ?>
                                    <div class='opc' onclick='OpenWindow("/dependencias/TVD/<?= $object->GetId() ?>/")' style="width:auto; ">Consultar TVD</div>
                                <?
                                        }
                                    }
                                ?>
                            </div>

                            <div class="col-md-12">
                            <?
                                if ($_SESSION['mayedit'] == "1") {
                                    if ($_SESSION['MODULES']['foleado_electronico'] == "1") {
                                        if(!$bloquear_del_todo){
                            ?>
                                            <div class='opc' id="myexportbutton" onclick='ExportarResumen("<?= $object->GetId() ?>")' style="width:auto;">
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
                <?
                    }
                ?>
                    </form>
                </div>


<script type="text/javascript">

    function changetext(text){

        $('.nanexo').prop('readonly', true);

        $('.nanexo').removeClass('editable');

        $('.nanexo').addClass('no_editable');

        $(text).removeClass('no_editable');

        $(text).addClass('editable');

        $(text).prop('readonly', false);

    }

    $(".nanexo").keypress(function(e) {

        if(e.which == 13) {

            $('.nanexo').prop('readonly', true);

            $('.nanexo').removeClass('editable');

            $('.nanexo').addClass('no_editable');

            $.ajax({

                url:'/caratula/opcion/<?=$object->GetId()?>/nom_anexo/',

                data:{name:$(this).val(),id_anexo:this.id},

                type:'POST',

                success:function(msg){

                    alert('Nombre modificado');

                }

            })

        }

    });

    $(".nanexo").on('blur', function() {

        $(this).prop('readonly', true);

        $(this).removeClass('editable');

        $(this).addClass('no_editable');

        /* Act on the event */

    });

    $(document).ready(function() {

        $('.datepicker').datepicker({

            dateFormat: 'yy-mm-dd',

            monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio', 'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],

            dayNames: ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'], // For formatting

            dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'], // For formatting

            dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sa'] // Column headings for days starting at Sunday                

        });

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

