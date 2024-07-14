<?
    global $c;
    $totalc = $c->GetTotalFromTable("seccional_principal", "");
    $totalof = $c->GetTotalFromTable("seccional", "");

    if (!isset($_SESSION['smallid']) || $_SESSION['smallid'] == '') {
        $smallid = $f->GenerarSmallId();
        $_SESSION['smallid'] = $smallid;
    }

    $u = new MUsuarios;
    $u->CreateUsuarios("user_id", $_SESSION['usuario']);

    $tipo_d = $con->Query("select * from dependencias where es_publico = 1 limit 0, 1");
    $tipo_dq = $con->FetchAssoc($tipo_d);
    $tipo_documento = $tipo_dq['id'];   

    $MPlantillas_email = new MPlantillas_email;
    $MPlantillas_email->CreatePlantillas_email('id', '58');
    $paso1 = $MPlantillas_email->GetContenido();

    $SegundoMensaje = new MPlantillas_email;
    $SegundoMensaje->CreatePlantillas_email('id', '59');    
    $paso2 = $SegundoMensaje->GetContenido();

    $TercerMensaje = new MPlantillas_email;
    $TercerMensaje->CreatePlantillas_email('id', '60'); 
    $paso3 = $TercerMensaje->GetContenido();

    $CuartoMensaje = new MPlantillas_email;
    $CuartoMensaje->CreatePlantillas_email('id', '61'); 
    $paso4 = $CuartoMensaje->GetContenido();

    $QuintoMensaje = new MPlantillas_email;
    $QuintoMensaje->CreatePlantillas_email('id', '62'); 
    $paso5 = $QuintoMensaje->GetContenido();

    $SextoMensaje = new MPlantillas_email;
    $SextoMensaje->CreatePlantillas_email('id', '63');  
    $paso6 = $SextoMensaje->GetContenido();

    $SeptimoMensaje = new MPlantillas_email;
    $SeptimoMensaje->CreatePlantillas_email('id', '64');    
    $paso7 = $SeptimoMensaje->GetContenido();

    $MPlantillas_email = new MPlantillas_email;
    $MPlantillas_email->CreatePlantillas_email('id', '68');
    $desactivar_registro = $MPlantillas_email->GetContenido();


    $query_eg = $con->Query("select * from province where Country = 'CO'");
    $departamentos = "";
    while($row_type = $con->FetchAssoc($query_eg)){
        $departamentos .= "<option value='".$row_type['code']."'>".$row_type['Name']."</option>";
    }

    $countnot = $con->Query("select * from notificaciones where user_id = '".$_SESSION['usuario']."' ");

    $counterfisicas = 0;
    $counterelectro = 0;
    while ($rownot = $con->FetchAssoc($countnot)) {
        if ($rownot['tipo_notificacion'] == "CE") {
            $counterelectro++;
        }
        if ($rownot['tipo_notificacion'] == "CC") {
            $counterfisicas++;
        }
    }


    $disable = false;

    #CORRESPONDENCIAELECTRONICA = "99";

    $totala = CORRESPONDENCIAFISICA + CORRESPONDENCIAELECTRONICA;
    $totalb = $counterfisicas + $counterelectro;


    if ($u->Getfreemium() == "1") {
        if ($totalb >= $totala) {
            $disable = true;
        }

        $CuartoMensaje = new MPlantillas_email;
        $CuartoMensaje->CreatePlantillas_email('id', '69'); 
        $paso4 = $CuartoMensaje->GetContenido();
    }

    if ($_SESSION['MODULES']['tipo_negocio_correpondencia'] == "2") {
        $disable = false;
    }


    #print_r($_SESSION['MODULES']);
    $lx = new MSuscriptores_tipos;
    $query_eg = $lx->ListarSuscriptores_tipos(""); 
    $pathtrs = "";
    while($row_type = $con->FetchAssoc($query_eg)){
        $pathtrs .= "<option value='".$row_type['id']."'>".$row_type['nombre']."</option>";
    }

    $query_eg = $lx->ListarSuscriptores_tipos(""); 
    $pathtrs = "";
    while($row_type = $con->FetchAssoc($query_eg)){
        $pathtrs .= "<option value='".$row_type['id']."'>".$row_type['nombre']."</option>";
    }



    
?>

<div class="row">
    <div class="col-md-12">
        <div>
<?php if ($disable): ?>
    <div class="jumbotron m-t-30">
        <?php echo $desactivar_registro ?>
    </div>
<?php else: ?>
    <!-- Validation wizard -->
    <div class="card-body wizard-content">
        <div class="row">

            <?php if ($_SESSION['MODULES']['tipo_negocio_correpondencia'] != "2"): ?>

                <?
                    if ($_SESSION['MODULES']['tipo_negocio_correpondencia'] == "1") {
                        $cupo = $u->GetCupo();
                    }else{

                        $sadmin = new MSuper_admin;
                        $sadmin->CreateSuper_admin("id", "6");
                        $cupo = CUPOCUENTA;

                    }

                    if ($_SESSION['MODULES']['configuracion_pagos'] == "1"){
                    
                        $fcaducidad = substr($u->GetF_caducidad(), 0, 10);
?>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-7">
                                    <div class="pull-left">
                                        <h4 class="card-title">
                                            Fecha de Caducidad
                                        </h4>
                                        <H4 align="right" class="card-title text-success">
                                            <b><?= $fcaducidad ?></b>
                                        </H4>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="pull-right m-t-20">
                                        <button class='btn btn-danger' onclick="LoadModal('',  'Adquirir Licencia', '/usuarios_compras/nuevo/<?= $u->GetCupo() ?>/')">
                                            <?= "Extender Licencia" ?>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
<?                  


                    }elseif($_SESSION['MODULES']['configuracion_pagos'] == "2"){
?>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-7">
                                    <div class="pull-right">
                                        <h4 class="card-title">
                                            Saldo Actual
                                        </h4>
                                        <H4 align="right" class="card-title text-success">
                                            <b><?= $cupo ?></b>
                                        </H4>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="pull-right m-t-20">
                                        <button class='btn btn-danger' onclick="LoadModal('',  'Recargar Cuenta', '/usuarios_compras/nuevo/<?= $u->GetCupo() ?>/')">
                                            <?= ($cupo <= 0)?"REALIZAR PAGO":"COMPRAR MÁS SALDO" ?>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
<?
                    }
            ?>
            <?php endif ?>
        <form id='formgestion' action='/gestion/registrodecorrespondencia/' method='POST' class="validation-wizard wizard-circle m-t-40">
            <!-- Step 1 -->
                <?

                if ($_SESSION['MODULES']['configuracion_pagos'] == "1"){
                    
                    $fcaducidad = substr($u->GetF_caducidad(), 0, 10);
                    $allow = true;
                    
                    if ($fcaducidad < date("Y-m-d")) {
                        $allow = false;
                        echo "<div class='alert alert-danger' style='margin-top:50px; margin-bottom:50px'>Tu Suscripción ha expirado el día $fcaducidad. Extiende tu licencia para poder continuar disfrutando de nuestros servicios</div>";
                    }


                    if ($_SESSION['MODULES']['tipo_negocio_correpondencia'] == "2") {
                        $allow = true;
                    }

                }elseif($_SESSION['MODULES']['configuracion_pagos'] == "2"){
                    
                    $cupodeuda = $u->Getcupousuario() * -1 ;
                    $allow = true;
                    if ($u->GetCupo() < "4000") {
                        if ($u->GetCupo() <= $cupodeuda) {
                            $allow = false;
                            echo "<div class='alert alert-danger' style='margin-top:50px; margin-bottom:50px'>Tu Saldo disponible es menor a $ 300 y su capacidad de endeudamiento es $cupodeuda, recarga tu cuenta para poder continuar disfrutando de nuestros servicios</div>";
                        }else{
                            echo "<div class='alert alert-warning' style='margin-top:50px; margin-bottom:50px !important'>Tienes menos de $ 4.000 en tu saldo disponible, no olvides recargar tu cuenta para que puedas seguir disfrutando de nuestros servicios</div>";
                        }
                    }

                    if ($_SESSION['MODULES']['tipo_negocio_correpondencia'] == "2") {
                        $allow = true;
                    }

                }else{
                    $allow = true;
                }

                ?>
            <?php if ($allow): ?>
            <h6>Inicio</h6>
            <section>
                <div class="row m-t-20">
                    <div class="col-md-6 m-t-30">
                        <div class="form-group dn">
                            <!--<code>Si Desea que el sistema genere el citatorio seleccione la opcion "Notificaciones Judiciales", de lo contrario seleccione "Radicaciones o Envíos".</code><br><br>-->
                            <label for="salida_servidor">Seleccione el Medio de Certificación</label><br>
                            <select class="form-control form-control-lg m-b-30 required" name="salida_servidor" id="salida_servidor">
                                <option value="0">Correo Inscrito en la Demanda</option>
                                <option value="1">Selecciona una Opción</option>
                                <?php if ($_SESSION['correo_inscrito'] == "1"): ?>
                                    <option value="1">Servicio Postal Autorizado</option>
                                <?php endif ?>
                            </select>
                        </div>
                        <input type="hidden" name="id_gestion" id="id_gestion" class="form-control">
                        <div id="response_detail"></div>
                        <div class="form-group">
                            <!--<code>Si Desea que el sistema genere el citatorio seleccione la opcion "Notificaciones Judiciales", de lo contrario seleccione "Radicaciones o Envíos".</code><br><br>-->
                            <label for="suscriptor_id">Seleccione el Tipo de Correspondencia a Enviar </label><br>
                            <select class="form-control form-control-lg m-b-30 required" name="notif_tipo_documento" id="notif_tipo_documento">
                                <option value="">Selecciona una Opción</option>
                                <option value="Correspondencia Judicial" >Notificacion Judicial</option>
                                <!--<option value="Otras">Otro tipo de Correspondencia Judicial</option>-->
                                <option value="Correspondencia Certificada">Correo Certificado</option>
                            </select>
                        </div>
                        <?php if (CAMPOT5 != ""): ?>
                            <div class="tipo_documento_seleccion dn">
                                <div class="form-group">
                                <label for="campot5"><?= CAMPOT5 ?></label>
                                <?
                                    #echo "Select * from meta_listas where titulo = '".CAMPOT5."'";
                                    $x = $con->Query("Select * from meta_listas where titulo = '".CAMPOT5."'");
                                    $cont = $con->NumRows($x);
                                    $dat = $con->FetchAssoc($x);
                                    if ($cont > 0) {
                                ?>
                                        <select class="form-control" name='campot5' id='campot5'  >
                                            <option value="">Seleccione una Opción</option>
                                            <?
                                                $x = $con->Query("select * from meta_listas_valores where id_lista = '".$dat['id']."'");
                                                while ($ror = $con->FetchAssoc($x)) {
                                                    echo '<option value="'.$ror['valor'].'">'.$ror['titulo'].'</option>';
                                                }
                                            ?>
                                        </select>
                                <?
                                    }else{
                                ?>
                                        <input  class="form-control" type='text' name='campot5' id='campot5' maxlength='100'   />
                                <?
                                    }
                                ?>
                                </div>
                            </div>
                        <?php endif ?>

                        <input type="hidden" id="demandantes_nombre" class="form-control required">
                        <input type="hidden" id="" class="form-control required">
                        <div class="form-group">
                            <label for="nombresuscriptor">Remitente:</label>
                            <select class="form-control" id="responsble_firma" name="responsble_firma"  >
                                <?php if ($_SESSION['MODULES']['tipo_negocio_correpondencia'] == "3"): ?>
                                    <option value="">Seleccione un <?= RESPONSABLE ?></option>
                                    <option value="<?= $_SESSION['usuario'] ?>"><?= $u->GetP_nombre()." ".$u->GetP_apellido() ?></option>
                                    <?
                                        $responsables = $con->Query("Select u.p_nombre, u.p_apellido, u.user_id from usuarios as u inner join usuarios_funcionalidades as uf on uf.user_id = u.user_id where uf.id_funcionalidad = '35' and valor = '1'");
                                        while ($xx = $con->FetchAssoc($responsables)) {
                                            echo '<option value="'.$xx['user_id'].'">'.$xx['p_nombre'].' '.$xx['p_apellido'].'</option>';
                                        }
                                    ?>
                                <?php else: ?>
                                    <option value="<?= $_SESSION['usuario'] ?>"><?= $u->GetP_nombre()." ".$u->GetP_apellido() ?></option>
                                <?php endif ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="nombresuscriptor" id="remite_title">Nombre del Remitente:</label>
                            <input type="text" id="dtform" name="dtform"  class='input1_0 form-control dn' value="N">
                            <input type="hidden" value="N" name="suscriptor_id" id="suscriptor_id">
                            <input class="form-control required" type='text' name='nombresuscriptor' id='nombresuscriptor' placeholder="Escriba su nombre completo" maxlength='100'/>
                            <div id='bloquebusquedasuscriptor'></div>
                        </div>
                        <div class="form-group dn">
                            <label for="demandados_nombres" class="titulodestinatario" id="destino_title">Nombre del Destinatario:</label>
                            <input class="form-control" type='text' name='demandados_nombres' id='demandados_nombres' placeholder="Nombre del Destinatario" maxlength='100'/>
                        </div>
                        <div id="error_message" class="alert alert-danger dn"></div>                        
                    </div>
                    <div class="col-md-6 hidden-xs hidden-sm">
                        <div class="row m-t-20 dn  hidden-xs hidden-sm">
                            <div class="col-md-12">
                                <div class="jumbotron">
                                    <?php echo $paso3 ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group dn">
                                    <label for="Type_suscriptor">Tipo de Demandante:</label>
                                    <select class="form-control required" name="Type_suscriptor" id="Type_suscriptor">
                                        <?= $pathtrs ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 dn">
                                <div class="form-group">
                                    <label for="Identificacion_suscriptor">Número de Identificación: (Opcional)</label>
                                    <input class="form-control" type="text" placeholder="<?= SUSCRIPTORCAMPOIDENTIFICACION; ?>" id="Identificacion_suscriptor" name="Identificacion_suscriptor">
                                </div>
                            </div>
                        </div>

                        <div class="row dn">
                            <div class="col-md-4">
                                <div class="form-group">    
                                    <label for="departamento_remitente">Departamento de Destino:</label>
                                    <select class="form-control" id="departamento_remitente" name="departamento_remitente" onchange="dependencia_ciudad('departamento_remitente', 'ciudad_remitente')">
                                        <option value="">Seleccione un Departamento</option><?= $departamentos ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="ciudad_remitente">Ciudad de Destino:</label>
                                    <input class="form-control " type="hidden" placeholder="Ciudad" id="Ciudad_suscriptor" name="Ciudad_suscriptor">
                                    <select class="form-control" onchange="SetnamecityRemite('Ciudad_suscriptor')" id="ciudad_remitente" name="ciudad_remitente">
                                        <option value="">Seleccione una Ciudad</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="Direccion_suscriptor">Dirección de Residencia:</label>
                                    <input class="form-control " type="text" placeholder="<?= SUSCRIPTORCAMPODIRECCION; ?>" id="Direccion_suscriptor" name="Direccion_suscriptor">
                                </div>
                            </div>
                        </div>

                        <div class="row dn">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Telefonos_suscriptor">Número de Telefono:</label>
                                    <input class="form-control " type="text" placeholder="Telefonos" id="Telefonos_suscriptor" name="Telefonos_suscriptor">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Email_suscriptor">Dirección de Correo:</label>
                                    <input class="form-control " type="text" placeholder="E-mail" id="Email_suscriptor" name="Email_suscriptor">
                                </div>
                            </div>
                        </div>
                         <div class="row m-t-30">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="campot15">CUERPO DEL MENSAJE</label>
                                    <textarea type='text' class="form-control textarea_editor" rows="15" name='observacion2' id='observacion2' placeholder="Observación del Expediente"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class=" m-t-30 dn"> Si desea enviar correspondencia a un radicado no existente haga clic aqui:</label><br>
                            <button type="button" class="btn btn-primary btn-lg pull-right m-b-30" id="nuevoexpedientebtn">Continuar</button>
                        </div>
                    </div>
                    <div class="form-group dn">
                        <label for="suscriptor_id">Seleccione el Tiempo de Entrega: *</label><br>
                         <select name="comparecer" id="comparecer" style="width:100%; height:50px; margin-left:10px;" class="form-control m-b-30 required">
                            <option value="0">Servicio Normal</option>
                            <option value="1">Entrega Inmediata (24 Horas)</option>
                        </select>
                    </div>

                    <div class="form-group dn">
                        <label for="suscriptor_id">Servicio Postal Autorizado: *</label><br>
                        <select name="spostal" id="spostal" style="width:100%; height:50px; margin-left:10px;" class="form-control m-b-30 required">
                            <option value="<?= DEFAULTCOURRIER ?>">NOTIFICADOR JUDICIAL</option>
                            <?
                               
                                $cliente = new nusoap_client("http://laws.com.co/ws/GetPostalServices.wsdl", true);

                                $error = $cliente->getError();
                                if ($error) {
                                    echo "<h2>Constructor error</h2><pre>" . $error . "</pre>";
                                }

                                $array = array("id" => trim($_SERVER['HTTP_HOST']), "key" => trim($_SESSION['user_key']));
                                $result = $cliente->call("GetListadoOperadoresPostal", $array);
                                  
                                if ($cliente->fault) {
                                    echo "<h2>Fault</h2><pre>";
                                    echo "</pre>";
                                }else{
                                    $error = $cliente->getError();

                                    if ($error) {
                                        echo "<h2>Error</h2><pre>" . $error . "</pre>";
                                    }else {
                                        if ($result == "") {
                                            echo "No se creo el WS para ".trim($_SERVER['HTTP_HOST'])." -> ".trim($_SESSION['user_key']);
                                        }else{
                                            echo $result;
                                        }
                                    }
                                }
                            ?>
                        </select>
                    </div>  
                </div>
            </section>            
            <h6 id="destino_title">Información de(los) Destinatarios</h6>
            <section>
                <div class="row dn m-t-20 hidden-xs hidden-sm">
                    <div class="col-md-12">
                        <div class="jumbotron">
                            <?php echo $paso4 ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="list-group" id="add_suscriptor_fill"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 m-t-20 m-b-30 text-center">
                        <button type="button" class="btn btn-danger" onclick="AddDestinatario()"><span class="mdi mdi-plus"></span> Agregar <span class="titulodestinatario"></span></button>
                    </div>
                </div>                        
            </section>
            <h6>Información Adicional</h6>
            <section>
                <div class="row m-b-30">
                    <div class="col-md-12 m-t-30">
                        <label for="suscriptor_id">Número de Radicado:</label><br>
                        <input class="form-control" type='text' name='radicado' id='radicado' placeholder="Ingresar Numero de Radicado" <?= $c->Ayuda('47', 'tog') ?>/>                 
                    <input type="hidden" name="g_id_text" id="g_id_text" class="form-control <?= (PROCESOSNOTIFICACIONES == "0")?"required":"" ?> ">
                    <div id='bloquebusqueda'></div>           
                    </div>
                    
                    <input type="hidden" name="email_abogado" id="email_abogado" />
                    <input type="hidden" name="direccion_abogado" id="direccion_abogado" />
                    <input type="hidden" name="telefono_abogado" id="telefono_abogado" />
                    <input type="hidden" name="tarjeta_profesional_abogado" id="tarjeta_profesional_abogado" />
                    <input type="hidden" name="cargo_abogado" id="cargo_abogado" />
                    <input type="hidden" name="cedula_expedicion_abogado" id="cedula_expedicion_abogado" />
                    <?php if (CAMPOT1 != ""): ?>
                        <div class="col-md-12 m-t-30">
                            <label for="campot1"><?= CAMPOT1 ?></label>
                            <?
                                $x = $con->Query("Select * from meta_listas where titulo = '".CAMPOT1."'");
                                $cont = $con->NumRows($x);
                                $dat = $con->FetchAssoc($x);
                                if ($cont > 0) {
                            ?>
                                    <select class="form-control select2" type='text' name='campot1' id='campot1'>
                                        <option value="">Seleccione una Opción</option>
                                        <?
                                            $x = $con->Query("select * from meta_listas_valores where id_lista = '".$dat['id']."'");
                                            while ($ror = $con->FetchAssoc($x)) {
                                                echo '<option value="'.$ror['valor'].'">'.$ror['titulo'].'</option>';
                                            }
                                        ?>
                                    </select>
                            <?
                                }else{
                            ?>
                                    <input  class="form-control" type='text' name='campot1' id='campot1' maxlength='100' placeholder="Ej: JUZGADO QUINTO CIVIL MUNICIPAL" />
                            <?
                                }
                            ?>
                        </div>
                    <?php endif ?> 
                    <?php if (CAMPOT2 != ""): ?>    
                        <div class="col-md-6 m-t-30">
                            <label for="campot2"><?= CAMPOT2 ?></label>
                            <?
                                $x = $con->Query("Select * from meta_listas where titulo = '".CAMPOT2."'");
                                $cont = $con->NumRows($x);
                                $dat = $con->FetchAssoc($x);
                                if ($cont > 0) {
                            ?>
                                    <select class="form-control" name='campot2' id='campot2' >
                                        <option value="">Seleccione una Opción</option>
                                        <?
                                            $x = $con->Query("select * from meta_listas_valores where id_lista = '".$dat['id']."'");
                                            while ($ror = $con->FetchAssoc($x)) {
                                                echo '<option value="'.$ror['valor'].'">'.$ror['titulo'].'</option>';
                                            }
                                        ?>
                                    </select>
                            <?
                                }else{
                            ?>
                                    <input  class="form-control" type='text' name='campot2' id='campot2' maxlength='100'  />
                            <?
                                }
                            ?>
                        </div>
                    <?php endif ?> 
                    <?php if (CAMPOT15 != ""): ?>
                            <div class="col-md-6 m-t-30">
                                <label for="campot15"><?= CAMPOT15 ?></label>
                                <?
                                    #echo "Select * from meta_listas where titulo = '".CAMPOT15."'";
                                    $x = $con->Query("Select * from meta_listas where titulo = '".CAMPOT15."'");
                                    $cont = $con->NumRows($x);
                                    $dat = $con->FetchAssoc($x);
                                    if ($cont > 0) {
                                ?>
                                        <select class="form-control" name='campot15' id='campot15'  >
                                            <option value="">Seleccione una Opción</option>
                                            <?
                                                $x = $con->Query("select * from meta_listas_valores where id_lista = '".$dat['id']."'");
                                                while ($ror = $con->FetchAssoc($x)) {
                                                    echo '<option value="'.$ror['valor'].'">'.$ror['titulo'].'</option>';
                                                }
                                            ?>
                                        </select>
                                <?
                                    }else{
                                ?>
                                        <input  class="form-control" type='text' name='campot15' id='campot15' maxlength='100'   />
                                <?
                                    }
                                ?>
                            </div>
                        <?php endif ?>
                    <?php if (CAMPOT3 != ""): ?>
                            <div class="col-md-6 m-t-30">
                                <label for="campot3"><?= CAMPOT3 ?></label>
                                <?
                                    $x = $con->Query("Select * from meta_listas where titulo = '".CAMPOT3."'");
                                    $cont = $con->NumRows($x);
                                    $dat = $con->FetchAssoc($x);
                                    if ($cont > 0) {
                                ?>
                                        <select class="form-control" name='campot3' id='campot3' >
                                            <option value="">Seleccione una Opción</option>
                                            <?
                                                $x = $con->Query("select * from meta_listas_valores where id_lista = '".$dat['id']."'");
                                                while ($ror = $con->FetchAssoc($x)) {
                                                    echo '<option value="'.$ror['valor'].'">'.$ror['titulo'].'</option>';
                                                }
                                            ?>
                                        </select>
                                <?
                                    }else{
                                ?>
                                        <input  class="form-control" type='text' name='campot3' id='campot3' maxlength='100'  />
                                <?
                                    }
                                ?>
                            </div>
                    <?php endif ?> 
                    <?php if (CAMPOT4 != ""): ?>
                        <div class="col-md-6 m-t-30">
                            <label for="campot4"><?= CAMPOT4 ?></label>
                            <?
                                #echo "Select * from meta_listas where titulo = '".CAMPOT4."'";
                                $x = $con->Query("Select * from meta_listas where titulo = '".CAMPOT4."'");
                                $cont = $con->NumRows($x);
                                $dat = $con->FetchAssoc($x);
                                if ($cont > 0) {
                            ?>
                                    <select class="form-control" name='campot4' id='campot4' >
                                        <option value="">Seleccione una Opción</option>
                                        <?
                                            $x = $con->Query("select * from meta_listas_valores where id_lista = '".$dat['id']."'");
                                            while ($ror = $con->FetchAssoc($x)) {
                                                echo '<option value="'.$ror['valor'].'">'.$ror['titulo'].'</option>';
                                            }
                                        ?>
                                    </select>
                            <?
                                }else{
                            ?>
                                    <input  class="form-control" type='text' name='campot4' id='campot4' maxlength='100'  />
                            <?
                                }
                            ?>
                        </div>
                    <?php endif ?> 
                    <?php if (CAMPOT6 != ""): ?>
                        <div class="col-md-6 m-t-30">
                            <label for="campot6"><?= CAMPOT6 ?></label>
                            <?
                                #echo "Select * from meta_listas where titulo = '".CAMPOT6."'";
                                $x = $con->Query("Select * from meta_listas where titulo = '".CAMPOT6."'");
                                $cont = $con->NumRows($x);
                                $dat = $con->FetchAssoc($x);
                                if ($cont > 0) {
                            ?>
                                    <select class="form-control" name='campot6' id='campot6'  >
                                        <option value="">Seleccione una Opción</option>
                                        <?
                                            $x = $con->Query("select * from meta_listas_valores where id_lista = '".$dat['id']."'");
                                            while ($ror = $con->FetchAssoc($x)) {
                                                echo '<option value="'.$ror['valor'].'">'.$ror['titulo'].'</option>';
                                            }
                                        ?>
                                    </select>
                            <?
                                }else{
                            ?>
                                    <input  class="form-control" type='text' name='campot6' id='campot6' maxlength='100'   />
                            <?
                                }
                            ?>
                        </div>
                    <?php endif ?>
                    <?php if (CAMPOT7 != ""): ?>
                        <div class="col-md-6 m-t-30">
                            <label for="campot7"><?= CAMPOT7 ?></label>
                            <?
                                #echo "Select * from meta_listas where titulo = '".CAMPOT7."'";
                                $x = $con->Query("Select * from meta_listas where titulo = '".CAMPOT7."'");
                                $cont = $con->NumRows($x);
                                $dat = $con->FetchAssoc($x);
                                if ($cont > 0) {
                            ?>
                                    <select class="form-control" name='campot7' id='campot7' >
                                        <option value="">Seleccione una Opción</option>
                                        <?
                                            $x = $con->Query("select * from meta_listas_valores where id_lista = '".$dat['id']."'");
                                            while ($ror = $con->FetchAssoc($x)) {
                                                echo '<option value="'.$ror['valor'].'">'.$ror['titulo'].'</option>';
                                            }
                                        ?>
                                    </select>
                            <?
                                }else{
                            ?>
                                    <input  class="form-control" type='text' name='campot7' id='campot7' maxlength='100'   />
                            <?
                                }
                            ?>
                        </div>
                    <?php endif ?>
                    <?php if (CAMPOT8 != ""): ?>
                        <div class="col-md-6 m-t-30">
                            <label for="campot8"><?= CAMPOT8 ?></label>
                            <?
                                #echo "Select * from meta_listas where titulo = '".CAMPOT8."'";
                                $x = $con->Query("Select * from meta_listas where titulo = '".CAMPOT8."'");
                                $cont = $con->NumRows($x);
                                $dat = $con->FetchAssoc($x);
                                if ($cont > 0) {
                            ?>
                                    <select class="form-control" name='campot8' id='campot8' >
                                        <option value="">Seleccione una Opción</option>
                                        <?
                                            $x = $con->Query("select * from meta_listas_valores where id_lista = '".$dat['id']."'");
                                            while ($ror = $con->FetchAssoc($x)) {
                                                echo '<option value="'.$ror['valor'].'">'.$ror['titulo'].'</option>';
                                            }
                                        ?>
                                    </select>
                            <?
                                }else{
                            ?>
                                    <input  class="form-control" type='text' name='campot8' id='campot8' maxlength='100'  />
                            <?
                                }
                            ?>
                        </div>
                    <?php endif ?>
                
                
                    <?php if (CAMPOT14 != ""): ?>
                        <div class="col-md-6 m-t-30">
                            <label for="campot14"><?= CAMPOT14 ?></label>
                            <?
                                #echo "Select * from meta_listas where titulo = '".CAMPOT14."'";
                                $x = $con->Query("Select * from meta_listas where titulo = '".CAMPOT14."'");
                                $cont = $con->NumRows($x);
                                $dat = $con->FetchAssoc($x);
                                if ($cont > 0) {
                            ?>
                                    <select class="form-control" name='campot14' id='campot14'  >
                                        <option value="">Seleccione una Opción</option>
                                        <?
                                            $x = $con->Query("select * from meta_listas_valores where id_lista = '".$dat['id']."'");
                                            while ($ror = $con->FetchAssoc($x)) {
                                                echo '<option value="'.$ror['valor'].'">'.$ror['titulo'].'</option>';
                                            }
                                        ?>
                                    </select>
                            <?
                                }else{
                            ?>
                                    <input  class="form-control" type='date' name='campot14' id='campot14' maxlength='100'   />
                            <?
                                }
                            ?>
                        </div>
                    <?php endif ?>
                    <?php if (CAMPOT9 != ""): ?>
                        <div class="col-md-6 m-t-30">
                            <label for="campot9"><?= CAMPOT9 ?></label>
                            <?
                                #echo "Select * from meta_listas where titulo = '".CAMPOT9."'";
                                $x = $con->Query("Select * from meta_listas where titulo = '".CAMPOT9."'");
                                $cont = $con->NumRows($x);
                                $dat = $con->FetchAssoc($x);
                                if ($cont > 0) {
                            ?>
                                    <select class="form-control" name='campot9' id='campot9' >
                                        <option value="">Seleccione una Opción</option>
                                        <?
                                            $x = $con->Query("select * from meta_listas_valores where id_lista = '".$dat['id']."'");
                                            while ($ror = $con->FetchAssoc($x)) {
                                                echo '<option value="'.$ror['valor'].'">'.$ror['titulo'].'</option>';
                                            }
                                        ?>
                                    </select>
                            <?
                                }else{
                            ?>
                                    <input  class="form-control" type='text' name='campot9' id='campot9' maxlength='100'  />
                            <?
                                }
                            ?>
                        </div>
                    <?php endif ?>
                    <?php if (CAMPOT10 != ""): ?>
                        <div class="col-md-6 m-t-30">
                            <label for="campot10"><?= CAMPOT10 ?></label>
                            <?
                                #echo "Select * from meta_listas where titulo = '".CAMPOT10."'";
                                $x = $con->Query("Select * from meta_listas where titulo = '".CAMPOT10."'");
                                $cont = $con->NumRows($x);
                                $dat = $con->FetchAssoc($x);
                                if ($cont > 0) {
                            ?>
                                    <select class="form-control" name='campot10' id='campot10' >
                                        <option value="">Seleccione una Opción</option>
                                        <?
                                            $x = $con->Query("select * from meta_listas_valores where id_lista = '".$dat['id']."'");
                                            while ($ror = $con->FetchAssoc($x)) {
                                                echo '<option value="'.$ror['valor'].'">'.$ror['titulo'].'</option>';
                                            }
                                        ?>
                                    </select>
                            <?
                                }else{
                            ?>
                                    <input  class="form-control" type='text' name='campot10' id='campot10' maxlength='100'  />
                            <?
                                }
                            ?>
                        </div>
                    <?php endif ?>
                
                
                    <?php if (CAMPOT11 != ""): ?>
                        <div class="col-md-4 m-t-30">
                            <label for="campot11"><?= CAMPOT11 ?></label>
                            <?
                                #echo "Select * from meta_listas where titulo = '".CAMPOT11."'";
                                $x = $con->Query("Select * from meta_listas where titulo = '".CAMPOT11."'");
                                $cont = $con->NumRows($x);
                                $dat = $con->FetchAssoc($x);
                                if ($cont > 0) {
                            ?>
                                    <select class="form-control" name='campot11' id='campot11'  >
                                        <option value="">Seleccione una Opción</option>
                                        <?
                                            $x = $con->Query("select * from meta_listas_valores where id_lista = '".$dat['id']."'");
                                            while ($ror = $con->FetchAssoc($x)) {
                                                echo '<option value="'.$ror['valor'].'">'.$ror['titulo'].'</option>';
                                            }
                                        ?>
                                    </select>
                            <?
                                }else{
                            ?>
                                    <input  class="form-control" type='date' name='campot11' id='campot11' maxlength='100'   />
                            <?
                                }
                            ?>
                        </div>
                    <?php endif ?>
                    <?php if (CAMPOT12 != ""): ?>
                        <div class="col-md-4 m-t-30">
                            <label for="campot12"><?= CAMPOT12 ?></label>
                            <?
                                #echo "Select * from meta_listas where titulo = '".CAMPOT12."'";
                                $x = $con->Query("Select * from meta_listas where titulo = '".CAMPOT12."'");
                                $cont = $con->NumRows($x);
                                $dat = $con->FetchAssoc($x);
                                if ($cont > 0) {
                            ?>
                                    <select class="form-control" name='campot12' id='campot12'  >
                                        <option value="">Seleccione una Opción</option>
                                        <?
                                            $x = $con->Query("select * from meta_listas_valores where id_lista = '".$dat['id']."'");
                                            while ($ror = $con->FetchAssoc($x)) {
                                                echo '<option value="'.$ror['valor'].'">'.$ror['titulo'].'</option>';
                                            }
                                        ?>
                                    </select>
                            <?
                                }else{
                            ?>
                                    <input  class="form-control" type='date' name='campot12' id='campot12' maxlength='100'   />
                            <?
                                }
                            ?>
                        </div>
                    <?php endif ?>
                    <?php if (CAMPOT13 != ""): ?>
                        <div class="col-md-4 m-t-30">
                            <label for="campot13"><?= CAMPOT13 ?></label>
                            <?
                                #echo "Select * from meta_listas where titulo = '".CAMPOT13."'";
                                $x = $con->Query("Select * from meta_listas where titulo = '".CAMPOT13."'");
                                $cont = $con->NumRows($x);
                                $dat = $con->FetchAssoc($x);
                                if ($cont > 0) {
                            ?>
                                    <select class="form-control" name='campot13' id='campot13'  >
                                        <option value="">Seleccione una Opción</option>
                                        <?
                                            $x = $con->Query("select * from meta_listas_valores where id_lista = '".$dat['id']."'");
                                            while ($ror = $con->FetchAssoc($x)) {
                                                echo '<option value="'.$ror['valor'].'">'.$ror['titulo'].'</option>';
                                            }
                                        ?>
                                    </select>
                            <?
                                }else{
                            ?>
                                    <input  class="form-control" type='date' name='campot13' id='campot13' maxlength='100'   />
                            <?
                                }
                            ?>
                        </div>
                    <?php endif ?>
                </div>
            </section>


                    <!-- Step 4 -->
                    <h6>Cargar Documentos</h6>
                    <section>
                        <div class="row">
                            <div class="col-md-6 hidden-xs hidden-sm">
                                <div class="jumbotron">
                                    <?= $paso6 ?>
                                </div>
                                
                            </div>
                            <div class="col-md-6">
                                <div id='cargadocumentos'>          
                                    <div class="list-group" id="modecarga"></div>
                                    <div class="list-group" id="exp_actual"></div>
                                    <div class="list-group" id="listadocumentostipos"></div>
                                    <div class="list-group" id="anexos_expediente"></div>
                                </div>
                                <?php if (COTEJARDOCUMENTOS == "1"): ?>
                                <div class="row m-t-30">
                                    <div class="col-md-12 ">
                                        <div class="form-group">
                                            <label for="cotejar">¿Desea cotejar los documentos que serán enviados?: <br> <small>Nota: Al cotejar los documentos podría hacer que sus expediente sea mas pesado</small> </label>
                                            <select class="form-control" name="cotejar" id="cotejar">
                                                <option value="NO">Seleccione una Opción</option>
                                                <option value="SI">SI</option>
                                                <option value="NO">NO</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <?php endif ?>
                                <div align="center" class="m-t-30 m-b-30">
                                    <input type='button' class="btn btn-primary btn-lg" style="height:60px;line-height:40px;padding-left:50px; margin-top:50px; padding-right:50px;font-size: 22px" value='Realizar Envío' onClick="CreateCorrespondencia()" id="btnsent"/>
                                </div>
                            </div>
                        </div> 
                    </section>
                        <?
                            include(VIEWS.DS.'notificaciones/hidden_fields.php');
                        ?>
                    <?php endif ?>     
                </form>
            </div>
        <?php endif ?>
        </div>
    </div>
</div>
<div id="listadosuscriptores" class="dn"></div>

<link href="<?= HOMEDIR ?>/app/plugins/theme/plugins/bower_components/jquery-wizard-master/steps.css" rel="stylesheet">

<!-- Form Wizard JavaScript -->
<script src="<?= HOMEDIR ?>/app/plugins/theme/plugins/bower_components/moment/moment.js"></script>
<script src="<?= HOMEDIR ?>/app/plugins/theme/plugins/bower_components/jquery.steps-1.1.0/jquery.steps.min.js"></script>
<script src="<?= HOMEDIR ?>/app/plugins/theme/plugins/bower_components/jquery-wizard-master/jquery.validate.js"></script>
<link rel='stylesheet' type='text/css' href='<?= HOMEDIR.DS ?>app/plugins/select2/css/select2.min.css'/>
<script language='javascript' type='text/javascript' src='<?= HOMEDIR.DS ?>app/plugins/select2/js/select2.min.js'></script>
<script src="<?= HOMEDIR ?>/app/plugins/theme/plugins/bower_components/templates/notifications.js?f=<?php echo date('YmdHis'); ?>"></script>

<!--
<link href="<?= HOMEDIR ?>/app/plugins/theme/plugins/bower_components/html5-editor/bootstrap-wysihtml5.css" rel="stylesheet"  />
<script src="<?= HOMEDIR ?>/app/plugins/theme/plugins/bower_components/html5-editor/wysihtml5-0.3.0.js"></script>
<script src="<?= HOMEDIR ?>/app/plugins/theme/plugins/bower_components/html5-editor/bootstrap-wysihtml5.js"></script>
<script>
    $(document).ready(function () {
        $('.textarea_editor').wysihtml5();
    });
</script>
-->
<script type="text/javascript">
    (function($) {
        if ($('.select2').length){
            $(".select2").select2();
        }
    })(jQuery);

    //Custom design form example
    $(".tab-wizard").steps({
        headerTag: "h6",
        bodyTag: "section",
        transitionEffect: "fade",
        titleTemplate: '<span class="step">#index#</span> #title#',
        labels: {
            finish: "Submit",
            previous: "Anterior"
            
        },
        onFinished: function (event, currentIndex) {
            swal("Form Submitted!", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lorem erat eleifend ex semper, lobortis purus sed.");

        }
    });
    var form = $(".validation-wizard").show();

    $(".validation-wizard").steps({
        headerTag: "h6",
        bodyTag: "section",
        transitionEffect: "fade",
        titleTemplate: '<span class="step">#index#</span> #title#',
        labels: {
            finish: "Submit",
            previous: "Anterior"
        },
        onStepChanging: function (event, currentIndex, newIndex) {
            return currentIndex > newIndex || !(3 === newIndex && Number($("#age-2").val()) < 18) && (currentIndex < newIndex && (form.find(".body:eq(" + newIndex + ") label.error").remove(), form.find(".body:eq(" + newIndex + ") .error").removeClass("error")), form.validate().settings.ignore = ":disabled,:hidden", form.valid())
        },
        onFinishing: function (event, currentIndex) {
            return form.validate().settings.ignore = ":disabled", form.valid()
        },
        onFinished: function (event, currentIndex) {
            swal("Form Submitted!", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lorem erat eleifend ex semper, lobortis purus sed.");
        }
    }), $(".validation-wizard").validate({
        errorPlacement: function(error, element) {
            // Append error within linked label
            $( element )
                .closest( "form" )
                    .find( "label[for='" + element.attr( "id" ) + "']" )
                        .append( error );
            $( element )
                .closest( "form" )
                    .find( "label[for='" + element.attr( "id" ) + "']" )
                        .addClass( 'text-danger' );
        },
        errorElement: "span",
        messages: {
            user: {
                required: " (*)",
                minlength: " (must be at least 3 characters)"
            }
        },
        ignore: "input[type=hidden]",
        errorClass: "text-danger",
        successClass: "text-success",
        highlight: function (element, errorClass) {
            $(element).addClass(errorClass)
        },
        unhighlight: function (element, errorClass) {
            $(element).removeClass(errorClass)
            //$(element).parent().removeClass(errorClass)
        },

        rules: {
            email: {
                email: !0
            }
        }
    })

</script>
<style type="text/css">
    .text-danger{
            border-color: #f44336;
    }
</style>
<script type="text/javascript">
    function updateession(){
        var URL = '/login/updateession/';
        $.ajax({
            type: 'POST',
            url: URL,
            success:function(msg){
                
            }
        });
    }
    updateession();
    setInterval("updateession();",420000);
</script>
<script type="text/javascript">
    
    $("#g_id_text").on("keyup", function(){
        $("#bloquebusqueda").fadeIn();              
        $.ajax({
            type: "POST",
            url: '/gestion/explorar/'+$(this).val()+"/",
            success: function(msg){
                result = msg;
                $("#bloquebusqueda").html(result);                  
            }
        });             
    });
    function onTecla(e){    
        var num = e?e.keyCode:event.keyCode;
        if (num == 9 || num == 27){
            $("#bloquebusqueda").fadeOut();     
        }
    }
    document.onkeydown = onTecla;
    if(document.all){
        document.captureEvents(Event.KEYDOWN);  
    }
    $("#nuevoexpedientebtn").click(function(){
        <?php if (PROCESOSNOTIFICACIONES == "0"): ?>
            if ($("#id_gestion").val() == "") {
                $("#error_message").removeClass("dn");
                $("#error_message").html("Debe ingresar un número de radicado existente");
            }else{
                $("#error_message").addClass("dn");
                $(".wizard-content .actions ul li >a").eq(1).click();
            }
        <?php else: ?>
                $("#error_message").addClass("dn");
                $(".wizard-content .actions ul li >a").eq(1).click();
        <?php endif ?>
    })

    $("#nombresuscriptor").on("keyup", function(){

        if($(this).val().length > 4){
            $("#bloquebusquedasuscriptor").fadeIn();                
            $.ajax({
                type: "POST",
                url: '/suscriptores_contactos/buscarremitente/'+$(this).val()+"/",
                success: function(msg){
                    result = msg;
                    $("#bloquebusquedasuscriptor").html(result);                    
                }
            });             
        }
    });
    function onTecla(e){    
        var num = e?e.keyCode:event.keyCode;
        if (num == 9 || num == 27){
            $("#bloquebusquedasuscriptor").fadeOut();       
        }
    }
    document.onkeydown = onTecla;
    if(document.all){
        document.captureEvents(Event.KEYDOWN);  
    }

    function AddSuscriptor(id, nombre){

        $(".hideform").slideDown("fast");

        $.ajax({
            type: "POST",
            dataType: "json",
            url: "/suscriptores_contactos/buscarJsuscriptor/"+id+"/",
            success:function(msg){
                result = msg;

                $("#Identificacion_suscriptor").val(msg["Identificacion_suscriptor"]);
                //$("#nombresuscriptor").val($("#suscriptor_id option:selected").text());
                if(id != "N"){
                    $("#Type_suscriptor").val(msg["Type_suscriptor"]);
                }
                $("#Direccion_suscriptor").val(msg["Direccion_suscriptor"]);
                $("#Ciudad_suscriptor").val(msg["Ciudad_suscriptor"]);
                $("#Telefonos_suscriptor").val(msg["Telefonos_suscriptor"]);
                $("#Email_suscriptor").val(msg["Email_suscriptor"]);
                $("#departamento_remitente").val(msg["departamento"]);
                dependencia_ciudad('departamento_remitente', 'ciudad_remitente');
                setTimeout(function(){
                    $("#ciudad_remitente").val(msg["municipio"]);
                }, 1000);
            }
        });
        $("#nombresuscriptor").val(nombre);
        $("#dtform").val(id);
        $("#suscriptor_id").val(id);
        $("#nombre_radica").val(nombre);
        $("#bloquebusquedasuscriptor").fadeOut();       
    }
    function Hideform(){
        $("#bloquebusquedasuscriptor").fadeOut();
        $("#id_suscriptor").val("");
        $("#suscriptor_id").val("");
        $("#datasuscriptor").html("");                  
    }

    function Setnamecity(role){
        $("#namecity"+role).val($("#ciudad_destinatario"+role+" option:selected").text()+" - "+$("#departamento_destinatario"+role+" option:selected").text());
    }

    function SetnamecityRemite(role){
        $("#"+role).val($("#ciudad_remitente option:selected").text()+" - "+$("#departamento_remitente option:selected").text());
    }

    desinatario = "Destinatario / Notificado";
    pfisico = "<?= PERMITIRFISICO ?>";
    function AddDestinatario(){

        rem = "<?= $pathtrs ?>";
        dptos = "<?= $departamentos ?>";
        id = getRandomArbitrary(0, 10000);

        totala = parseInt("<?= CORRESPONDENCIAFISICA ?>");
        totalb = parseInt("<?= $counterfisicas ?>");

        es_gratis = "<?= $u->Getfreemium() ?>";
        disablef = '';


        if (es_gratis == 1) {
            if (totalb >= totala) {
                disablef = 'disabled';
            }
        }
        destin = '<span class="titulodestinatario">'+desinatario+'</span>';

        cola = "col-md-6";
        dn = "";
        colb = "col-md-6";
        if (desinatario != "Destinatario / Notificado") {
            cola = "col-md-12";
            colb = "col-md-6";
            dn = " dn ";
        }
        pfisicovar = "";
        if(pfisico == "1"){
            pfisicovar = '<option value="CC" >Físico</option><option value="CC/CE"  >Físico y Electrónico</option>';
        }
     

        var ls = $("#listadosuscriptores").html();
        if(ls != ""){
            listanombres = '<label  for="n_destinatario_lista'+id+'">Nombre Completo:</label><select class="form-control required destinatario_nombre" onchange="GetDestinatario(\''+id+'\')" id="n_destinatario_lista'+id+'" placeholder="Escriba su nombre completo" data-role="'+id+'"><option>Seleccione una Opción</option>'+ls+'<option value="otro">otro</option></select>';
            
            $("#camponombre"+id).addClass("dn");
            //AddDestinatarioRole("40", "SANDER CADENA", "4486")
        }else{
            listanombres = "";
            $("#campolistanombre"+id).addClass("dn");
        }

        $("#add_suscriptor_fill").append('<div class="list-group-item" id="elm'+id+'"><div class="row"><div class="col-md-10"><h3>Agregar '+destin+'</h3></div><div class="col-md-2"><button type="button" class="btn btn-primary mdi mdi-delete pull-right" onClick=" RemoveDestinatario(\'elm'+id+'\')"></button></div></div><div class="row"><div class="col-md-4"><div class="form-group" id="campolistanombre'+id+'">'+listanombres+'</div><div class="form-group" id="camponombre'+id+'"><label for="nombre_destinatario'+id+'">Nombre Completo:</label><input type="text" id="dtform'+id+'" name="dtform[]" data-role="'+id+'" value="N" class="form-control dn"><input class="form-control required destinatario_nombre midestinatario_nombre" onkeyup="BuscarJs(\''+id+'\')" type="text" name="nombre_destinatario[]" id="nombre_destinatario'+id+'" placeholder="Escriba su nombre completo" data-role="'+id+'"/><div id="bloque_busqueda_destinatario'+id+'" class="bloque_busqueda_destinatario"></div></div></div><div class="col-md-4 "><div class="form-group"><label for="tipo_destinatario'+id+'">Tipo de '+destin+':</label><select class="form-control" name="tipo_destinatario[]" id="tipo_destinatario'+id+'"><option value="0">Seleccione el Tipo de '+destin+'</option><option value="0">OTRO</option>'+rem+'</select></div></div><div class="col-md-4"><div class="form-group"><label for="identificacion_destinatario'+id+'">Número de Identificación:</label><input class="form-control" type="text" id="identificacion_destinatario'+id+'" name="identificacion_destinatario[]"></div></div></div><div class="row dn  fila_notificado"><div class="col-md-12"><div class="form-group"><label for="nombre_notificado'+id+'">Demandado:</label><input class="form-control required destinatario_nombre nombredemandado" type="text" name="nombre_notificado[]" id="nombre_notificado'+id+'" placeholder="Escriba su nombre completo" data-role="'+id+'"/></div></div></div><div class="row"><div class="col-md-6"><div class="form-group"><label>Medio de Comunicación *</label><br><select name="titulo[]" id="titulo'+id+'" class="form-control m-b-30 tipo_correspondencia_select required" data-role="'+id+'" onchange="tipo_correspondencia_select(\''+id+'\')"><option value="CE">Correo Electrónico</option>'+pfisicovar+'<option value="SMS">Solo Mensaje deTexto</option></select></div></div><div class="col-md-6"><div class="form-group"><label>Enviar a Teléfono Celular *</label><br><select name="sms[]" id="sms'+id+'" class="form-control m-b-30 required" onchange="sms_select(\''+id+'\')"><option value="NO">Seleccione una Opción</option><option value="SI">SI</option><option value="NO">NO</option></select></div></div></div><div class="row" id="col_fisico'+id+'"><div class="col-md-4"><div class="form-group"><label for="departamento_destinatario'+id+'">Departamento de Destino:</label><select class="form-control" id="departamento_destinatario'+id+'" name="departamento_destinatario[]" onchange="dependencia_ciudad(\'departamento_destinatario'+id+'\', \'ciudad_destinatario'+id+'\')"><option value="-">Seleccione un Departamento</option>'+dptos+'</select></div></div><div class="col-md-4"><div class="form-group"><label for="ciudad_destinatario'+id+'">Ciudad de Destino:</label><input type="hidden" id="namecity'+id+'" name="namecity[]"><select class="form-control" onchange="Setnamecity(\''+id+'\')" id="ciudad_destinatario'+id+'" name="ciudad_destinatario[]"><option value="-">Seleccione una Ciudad</option></select></div></div><div class="col-md-4"><div class="form-group"><label for="direccion_destinatario'+id+'">Dirección de Destino:</label><input class="form-control" type="text" id="direccion_destinatario'+id+'" name="direccion_destinatario[]"></div></div></div><div class="row"><div class="'+colb+'" id="col_telefono'+id+'"><div class="form-group"><label for="telefono_destinatario'+id+'">Numero de Telefono:</label><input class="form-control" type="text" placeholder="Número Celular Ej: 3108009525" id="telefono_destinatario'+id+'" name="telefono_destinatario[]"></div></div><div class="'+colb+'"  id="col_email'+id+'"><div class="form-group"><label for="email_destinatario'+id+'">Correo Electrónico:</label><input class="form-control" type="text" placeholder="E-mail" id="email_destinatario'+id+'" name="email_destinatario[]"></div></div></div><div class="col-md-4 dn"><div class="form-group"><label for="es_juridica'+id+'">¿Naturaleza del '+destin+':</label><select class="form-control" id="es_juridica'+id+'" name="es_juridica[]"><option value="Personal Natural">Seleccione una Opción</option><option value="Personal Natural">Persona Natural</option><option value="Personal Juridica">Persona Jurídica O Entidad Judicial</option></select></div></div></div></div>');
            
            $("#col_fisico"+id).addClass("dn");

            if(ls != ""){
                $("#camponombre"+id).addClass("dn");
                //AddDestinatarioRole("40", "SANDER CADENA", "4486")
            }else{
                $("#campolistanombre"+id).addClass("dn");
            }

    }
    function GetDestinatario(id){
        if ($("#n_destinatario_lista"+id).val() == "otro") {
            
            $("#camponombre"+id).removeClass("dn");
            $("#campolistanombre"+id).addClass("dn");

        }else{
            sus = $("#n_destinatario_lista"+id+" option:selected").text();
            var nombre = sus.split(" Tipo:");
            AddDestinatarioRole($("#n_destinatario_lista"+id).val(), nombre[0], id);
        }
    }
    function tipo_correspondencia_select(id){
        var elm = $("#titulo"+id);
        role = elm.attr("data-role");

        switch ($("#titulo"+id+" option:selected").val()) {
            case "CE":
                $("#col_fisico"+id).addClass("dn");
                $("#col_email"+id).removeClass("dn");
            break;
            case "SMS":
                $("#col_fisico"+id).addClass("dn");
                $("#col_email"+id).addClass("dn");
            break;
            default:
                $("#col_fisico"+id).removeClass("dn");
                if($("#titulo"+id+" option:selected").val() == "CC"){
                    $("#col_email"+id).addClass("dn");
                }
            break;
        }

    }
    function sms_select(id){
        if($("#sms"+id+" option:selected").val() == "NO"){
            $("#col_telefono"+id).addClass("dn");
        }else{
            $("#col_telefono"+id).removeClass("dn");
        }
        // Retorna un número aleatorio entre min (incluido) y max (excluido)
    }
    function getRandomArbitrary(min, max) {
        return parseInt(Math.random() * (max - min) + min);
    }
    function RemoveDestinatario(id){
        $("#"+id).remove();
    }

    function BuscarJs(id){
        if($("#nombre_destinatario"+id).val().length > 4){
            $("#bloque_busqueda_destinatario"+id).fadeIn();
            $("#nombre_notificado"+id).val($("#nombre_destinatario"+id).val());
            $.ajax({
                type: "POST",
                url: '/suscriptores_contactos/destbuscar/'+$("#nombre_destinatario"+id).val()+"/"+id+"/",
                success: function(msg){
                    result = msg;
                    $("#bloque_busqueda_destinatario"+id).html(result);                 
                }
            });             
        }
    }
    
    document.onkeydown = onTeclaDestinatario;
    if(document.all){
        document.captureEvents(Event.KEYDOWN);  
    }
    
    function onTeclaDestinatario(e){    
        var num = e?e.keyCode:event.keyCode;
        if (num == 9 || num == 27){
            $(".bloque_busqueda_destinatario").fadeOut();       
        }
    }



    function GetDetailExpediente(id, rad){
        $("#bloquebusqueda").fadeOut(); 
        $("#g_id_text").val(rad);
        $("#error_message").addClass("dn");
        $.ajax({
            type: "POST",
            dataType: "json",
            url: '/gestion/getdetailexpediente/'+id+"/",
            success: function(msg){
                
                AddSuscriptor(msg["id_suscriptor"], msg["nombre_suscriptor"]);
                GetListadoSuscriptores(id);
                $('#id_gestion').val(msg["id_gestion"]);
                $('#observacion').val(msg["observacion"]);
                $('#radicado').val(msg["radicado"]);
                $('#campot1').val(msg["campot1"]);
                $('#campot2').val(msg["campot2"]);
                $('#campot3').val(msg["campot3"]);
                $('#campot4').val(msg["campot4"]);
                $('#campot5').val(msg["campot5"]);
                $('#campot6').val(msg["campot6"]);
                $('#campot7').val(msg["campot7"]);
                $('#campot8').val(msg["campot8"]);
                $('#campot9').val(msg["campot9"]);
                $('#campot10').val(msg["campot10"]);
                $('#campot11').val(msg["campot11"]);
                $('#campot12').val(msg["campot12"]);
                $('#campot13').val(msg["campot13"]);
                $('#campot14').val(msg["campot14"]);
                $('#campot15').val(msg["campot15"]);
                $('#demandantes_nombre').val(msg["demandantes_nombre"]);
                $('#demandados_nombres').val(msg["demandados_nombres"]);
                result = msg;
                $("#response_detail").html(result); 
            //  AddDestinatario()               

            }
        }); 
        $.ajax({
            type: "POST",
            url: '/gestion_anexos/getanexosexpediente/'+id+"/",
            success: function(msg){
                
                result = msg;
                $("#anexos_expediente").html(result);                   

            }
        }); 
    }

    function GetListadoSuscriptores(id){
        $.ajax({
            type: "POST",
            url: '/gestion/getsuscriptoresexpediente/'+id+"/",
            success: function(msg){
                result = msg;
                $("#listadosuscriptores").html(msg);
                //$("#anexos_expediente").html(result);                 
            }
        });     
    }

    function AddDestinatarioRole(id, nombre, role){
        $(".hideform").slideDown("fast");
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "/suscriptores_contactos/buscarJsuscriptor/"+id+"/",
            success:function(msg){
                result = msg;
                $("#identificacion_destinatario"+role).val(msg["Identificacion_suscriptor"]);
                if(id != "N"){
                    $("#tipo_destinatario"+role).val(msg["Type_suscriptor"]);
                }
                $("#direccion_destinatario"+role).val(msg["Direccion_suscriptor"]);
                $("#ciudad_destinatario"+role).val(msg["Ciudad_suscriptor"]);
                $("#telefono_destinatario"+role).val(msg["Telefonos_suscriptor"]);
                $("#email_destinatario"+role).val(msg["Email_suscriptor"]);
                $('#es_juridica'+role+' option[value="'+msg["natural_juridica"]+'"]').attr("selected", true);
                $("#departamento_destinatario"+role).val(msg["departamento"]);
                dependencia_ciudad('departamento_destinatario'+role, 'ciudad_destinatario'+role);
                setTimeout(function(){
                    $("#ciudad_destinatario"+role).val(msg["municipio"]);
                }, 1000);
                
            }


        });
        $("#nombre_destinatario"+role).val(nombre);
        if($("#demandados_nombres").val() != ""){
            $("#nombre_notificado"+role).val($("#demandados_nombres").val());
        }else{
            $("#nombre_notificado"+role).val(nombre)
        }
        $("#dtform"+role).val(id);
        $("#bloque_busqueda_destinatario"+role).fadeOut();      
        //$("#observacion").val($("#notif_tipo_documento").val() + " DE "+$("#nombresuscriptor").val()+" VS "+$(".destinatario_nombre").eq(0).val());

    }

    $("#demandados_nombres").keyup(function(event) {
        $(".nombredemandado").val($(this).val());
    });
    $("#demandados_nombres").change(function(event) {
        $(".nombredemandado").val($(this).val());
    });

    $("#tipo_documento").change(function(){


        $.ajax({
            type: "POST",
            url: "/meta_big_data/doform/"+$("#tipo_documento").val()+"/"+$("#suscriptor_id").val()+"/",
            success:function(msg){
                result = msg;
                var URL = '/gestion_anexos/getcargapublica/'+$("#tipo_documento").val()+"/";
                $.ajax({
                    type: 'POST',
                    url: URL,
                    success:function(msg){
                        if (msg != "") {
                            $("#modecarga").css("display","block");
                            $("#listadocumentostipos").css("display","block");
                            $("#listadocumentostipos").html(msg);
                        }else{
                            $("#modecarga").css("display","none");
                            $("#listadocumentostipos").css("display","none");
                        }

                        if($("#notif_tipo_documento option:selected").val() == "Correspondencia Judicial"){
                            switch ($("#campot5 option:selected").val()) {
                                case "Artículo 292 del C.G.P.":
                                    
                                    $("#modecarga").html('<div class="list-group-item"><div class="row" style="padding:0px; margin:0px"><div class="col-md-7" style="padding-top:10px !important">Artículo 292 del C.G.P.</div><div class="col-md-5" style="padding-right:5px; padding-left:5px;"><button style="float:left" type="button" class="btn btn-warning" onClick="LoadHModal(View292(), \'Vista Previa Notificación 292\')"><span class="fa fa-eye"></span> Visualizar Documento</button></div></div></div>');
                                break;
                                case "Artículo 291 del C.G.P":
                                
                                    $("#modecarga").html('<div class="list-group-item"><div class="row" style="padding:0px; margin:0px"><div class="col-md-7" style="padding-top:10px !important">Artículo 291 del C.G.P</div><div class="col-md-5" style="padding-right:5px; padding-left:5px;"><button style="float:left" type="button" class="btn btn-warning" onClick="LoadHModal(View291(), \'Vista Previa Notificación 291\')"><span class="fa fa-eye"></span> Visualizar Documento</button></div></div></div>');
                                break;
                                case "Artículo 8 del decreto 806":

                                    $("#modecarga").html('<div class="list-group-item"><div class="row" style="padding:0px; margin:0px"><div class="col-md-7" style="padding-top:10px !important">Verificar Información</div><div class="col-md-5" style="padding-right:5px; padding-left:5px;"><button style="float:left" type="button" class="btn btn-warning" onClick="LoadHModal(CheckDocument(\'76\'), \'Vista De Datos\')"><span class="fa fa-eye"></span> Ver Documento</button></div></div></div>');

                                break;
                              default:

                                    $("#modecarga").html('<div class="list-group-item"><div class="row" style="padding:0px; margin:0px"><div class="col-md-7" style="padding-top:10px !important">Verificar Información</div><div class="col-md-5" style="padding-right:5px; padding-left:5px;"><button style="float:left" type="button" class="btn btn-warning" onClick="LoadHModal(CheckDocument(\'74\'), \'Vista De Datos\')"><span class="fa fa-eye"></span> Ver Documento</button></div></div></div>');
                                break;
                            }


                        }else{
                            $("#modecarga").html('<div class="list-group-item"><div class="row" style="padding:0px; margin:0px"><div class="col-md-7" style="padding-top:10px !important">Verificar Información</div><div class="col-md-5" style="padding-right:5px; padding-left:5px;"><button style="float:left" type="button" class="btn btn-warning" onClick="LoadHModal(CheckDocument(\'74\'), \'Vista De Datos\')"><span class="fa fa-eye"></span> Ver Documento</button></div></div></div>');
                        }
                        //window.location.reload();
                    }

                }); 
                
            }
        });
    });


    $("#notif_tipo_documento").change(function(){
        //;
        $("#radfield").removeClass("dn");

        switch ($(this).val()) {
            case "Correspondencia Judicial":
                //NOTIFICACIONES JUDICIALES
                desinatario = "Destinatario / Notificado";
                $("#remite_title").html("Suscriptor/ Destinatario");
                $("#formgestion-t-1").html('<span class="step">2</span> Información del/los Destinatario(s)');
                $("#destino_title").html("Información del/los Destinatario(s)");
                $("#formgestion-t-2").html('<span class="step">3</span> Información Adicional');
                $(".titulodestinatario").html("Destinatario / Notificado");
                $("#formjudicial").removeClass("dn");
                $(".tipo_documento_seleccion").removeClass("dn");
                $('#tipo_documento option[value="2"]').attr("selected", true);
                $(".fila_notificado").removeClass("dn");

            break;
          case "Correspondencia Certificada":
                //RADICACIONES O ENVIOS
                desinatario = "Destinatario";
                $("#remite_title").html("Remitente");
                $("#formgestion-t-1").html('<span class="step">2</span> Información del/los Destinatario(s)');
                $("#destino_title").html("Información del/los Destinatario(s)");
                $("#formgestion-t-2").html('<span class="step">3</span> Información Adicional');
                $(".titulodestinatario").html("Destinatario");
                $("#formjudicial").addClass("dn");
                $(".tipo_documento_seleccion").addClass("dn");
                $(".fila_notificado").addClass("dn");
                $('#tipo_documento option[value="14"]').attr("selected", true);
            break;
          case "Otras":
                // OTRO TIPO DE CORRESPONDENCIA JUDICIAL
                desinatario = "Destinatario";
                $("#remite_title").html("Remitente");
                $("#formgestion-t-1").html('<span class="step">2</span> Información del/los Destinatario(s)');
                $("#destino_title").html("Información del/los Destinatario(s)");
                $("#formgestion-t-2").html('<span class="step">3</span> Información Adicional');
                $(".titulodestinatario").html("Destinatario");
                $("#formjudicial").removeClass("dn");
                $(".fila_notificado").addClass("dn");
                $(".tipo_documento_seleccion").addClass("dn");
                $('#tipo_documento option[value="14"]').attr("selected", true);
            break;
          default:
                desinatario = "Destinatario";
                $("#remite_title").html("Remitente");
                $("#formgestion-t-1").html('<span class="step">2</span> Información del/los Destinatario(s)');
                $("#destino_title").html("Información del/los Destinatario(s)");
                $("#formgestion-t-2").html('<span class="step">3</span> Información Adicional');
                $(".titulodestinatario").html("Destinatario");
                $("#formjudicial").addClass("dn");
                $(".tipo_documento_seleccion").addClass("dn");
                $(".fila_notificado").addClass("dn");
                $('#tipo_documento option[value="14"]').attr("selected", true);
            break;
        }

        setTimeout(function(){
            $('#tipo_documento').trigger('change');
        }, 5000);

        AddDestinatario()
        
    });


function CreateCorrespondencia(){
    
    var hay = "";

    $("#btnsent").val("Enviando...");
    $("#btnsent").prop('disabled', true);
    
    $(".filename").each(function(){
        if($(this).val() != ""){
            hay += $(this).val();
        }
    })

    $(".active_check").each(function(){
        var date = $(this).prop("checked"); 
        if (date){
            hay += $(this).attr('id')   ;
        }
    })

    if(hay == ""){
        if(confirm("Desea enviar el correo sin anexos")){
            $("#formgestion").submit(); 
        }else{
            return false;
        }
    }else{
        $("#formgestion").submit(); 
    }

}


    $("#bloque_cuerpo_data").addClass("dn");
    $("#bloque_cuerpo_gestion").removeClass("col-md-7");
    $("#bloque_cuerpo_gestion").removeClass("col-md-12");

</script>
<?
    $radicado = $g->GetRadicado();

    if ($radicado == "") {
        $radicado = $g->GetMin_rad();
        # code...
    }
?>
<script>GetDetailExpediente("<?= $g->GetId() ?>", "<?= $radicado ?>")</script>
