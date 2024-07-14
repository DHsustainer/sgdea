<?
#print_r($_SESSION['MODULES']);
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

	#echo "-->".$u->Getfreemium()." - ".CORRESPONDENCIAFISICA." - ".CORRESPONDENCIAELECTRONICA." - ";


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

	#echo $counterfisicas." ".$counterelectro;

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
	$query_eg = $lx->ListarSuscriptores_tipos("where correspondencia = '1'"); 
	$pathtrs = "";
	while($row_type = $con->FetchAssoc($query_eg)){
		$pathtrs .= "<option value='".$row_type['id']."'>".$row_type['nombre']."</option>";
	}

	$query_eg = $lx->ListarSuscriptores_tipos("where correspondencia = '2'"); 
	$pathtrs = "";
	while($row_type = $con->FetchAssoc($query_eg)){
		$pathtrs .= "<option value='".$row_type['id']."'>".$row_type['nombre']."</option>";
	}

	#if ($_SESSION['usuario'] == 'info@laws.com.co') {
	#	echo CUPOUSUARIONUEVO;
	#}

	
?>

<div class="row m-t-20">
	<div class="col-md-12 panel">
	 	<div class="white-panel">
<?php if ($disable): ?>
	<div class="jumbotron m-t-30">
		<?php echo $desactivar_registro ?>
	</div>
<?php else: ?>
    <!-- Validation wizard -->
    <div class="card-body wizard-content">
    	<div class="row">

			<div class="col-md-6">
				<h4 class="card-title">Ventanilla de Registro de Correspondencia</h4>
        		<h6 class="card-subtitle text-muted">El sistema le guiará paso a paso durante el proceso de Registro</h6>
			</div>
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
						<div class="col-md-6">
							<div class="row">
								<div class="col-md-7">
									<div class="pull-right">
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
                    <div class="col-md-6 hidden-xs hidden-sm">
						<?=  '<img src="'.ASSETS.DS.'images/IM03.png" width="100%">'; ?>
                    </div>
					

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
                        <div class="form-group" id="radfield">
                        	<!--<code>Si el envío que va a realizar cuenta con un número de radicado, escríbalo, de lo contrario de clic en "Continuar".</code><br><br>-->
                        	<label for="suscriptor_id">Número de Radicado:</label><br>
                        	<input type="text" name="g_id_text" id="g_id_text" class="form-control <?= (PROCESOSNOTIFICACIONES == "0")?"required":"" ?> ">

							<div id='bloquebusqueda'></div>           
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

    					<input type="hidden" id="demandantes_nombre" class="form-control required">

    					<div class="row m-t-20 dn  hidden-xs hidden-sm">
                    <div class="col-md-12">
                        <div class="jumbotron">
							<?php echo $paso3 ?>
						</div>
                    </div>
                </div>
                <div class="row">
                	<div class="col-md-12">
                        <div class="form-group">
                            <label for="nombresuscriptor" id="remite_title">Remitente:</label>
                            <input type="text" id="dtform" name="dtform"  class='input1_0 form-control dn' value="N">
                            <input type="hidden" value="N" name="suscriptor_id" id="suscriptor_id">
                            <input class="form-control required" type='text' name='nombresuscriptor' id='nombresuscriptor' placeholder="Escriba su nombre completo" maxlength='100'/>
                            <div id='bloquebusquedasuscriptor'></div>
                        </div>
                        <div class="form-group">
                            <label for="demandados_nombres">Nombre del Destinatario:</label>
                            <input class="form-control" type="text" id="demandados_nombres" name="demandados_nombres">
                        </div>
                		<div class="form-group dn">
                            <label for="Type_suscriptor">Tipo de Destinatario:</label>
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

						<div id="error_message" class="alert alert-danger dn"></div>
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
            <!--<h6>Seleccionar Tipo de Correspondencia</h6>
            <section>
                <div class="row m-t-20">
                    <div class="col-md-6">
                        <div class="jumbotron">
							<?php echo $paso2 ?>
						</div>
                    </div>
                </div>
            </section> -->
            <!-- Step 2 -->
            
            <h6 id="destino_title">Información de(los) Citado / Notificado(s)</h6>
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
            <!-- Step 3 -->
            <h6>Detalles de la Correspondencia</h6>
            <section class="m-b-30">
            	<div class="jumbotron dn hidden-xs hidden-sm">
					<?php echo $paso5 ?>
				</div>
				<div class="row  m-t-20 m-b-20" >
                	<div class="col-md-12" >
                		<h2 id="titleform">Datos del Proceso</h4>
                	</div>
                </div>
                <hr class="m-t-0 m-b-20">
				<div class="row">
				    <div class="col-md-12">
				        <div class="form-group">
				            <label class="control-label col-md-2"><?= ASUNTO ?> </label>
				            <div class="col-md-10">
				                <textarea class="form-control required" type='text' name='observacion' id='observacion' placeholder="Asunto" style="height:50px" <?= $c->Ayuda('33', 'tog') ?>></textarea>
				            </div>
				        </div>
				    </div>
				</div>
				<?php if ($_SESSION['buscador_global'] == "1"): ?>
					<div class="row m-t-30 ">
						<div class="col-md-6">
							<label for="departamento"><?= DEPARTAMENTO ?>:</label>
							<select name="departamento" id="departamento" class='form-control important disabled' disabled="disabled" <?= $c->Ayuda('37', 'tog') ?>>
								<option value="">Seleccione un Departamento</option>
							</select>
						</div>
						<div class="col-md-6">
							<label for="ciudad"><?= CIUDAD ?>:</label>
							<select name="ciudad" id="ciudad" class=' form-control important disabled' disabled="disabled" <?= $c->Ayuda('38', 'tog') ?>>
								<option value="">Seleccione una Ciudad</option>
							</select>
						</div>
					</div>
					<div class="row m-t-30 ">
						<div class="col-md-6">
							<label for="oficina"><?= OFICINA ?>:</label>
							<select name="oficina" id="oficina" class=' form-control important disabled' disabled="disabled"<?= $c->Ayuda('39', 'tog') ?>>
								<option value="">Seleccione una Oficina</option>
							</select>
						</div>
						<div class="col-md-6">
							<label for="dependencia_destino"><?= CAMPOAREADETRABAJO; ?></label>
							<select placeholder="<?= CAMPOAREADETRABAJO; ?>"  name="dependencia_destino" id="dependencia_destino" class=' form-control important disabled' disabled="disabled" <?= $c->Ayuda('40', 'tog') ?> >
								<option value="">Seleccione un <?= CAMPOAREADETRABAJO; ?></option>
							</select>
							<input class="form-control" type='text' name='areatemp' id='areatemp' style="display:none" />
						</div>
					</div>
					<div class="row m-t-30 ">
						<div class="col-md-6">
							<label for="nombre_destino"><?= RESPONSABLE ?></label>
							<select disabled="disabled" name="nombre_destino" id="nombre_destino" class='form-control important disabled' <?= $c->Ayuda('41', 'tog') ?>>
								<option value="">Seleccione un Usuario de Destino</option>
							</select>
						</div>
					</div>
					<div class="row m-t-30 ">
						<div class="col-md-6">
							<label for="id_dependencia_raiz"><?= SERIE ?></label>
							<select class="form-control important disabled" id="id_dependencia_raiz" name="id_dependencia_raiz"  disabled="disabled" >
								<option value="">Seleccione una Serie</option>
								<?
									$s = new MDependencias;
									$q = $s->ListarDependencias(" where dependencia = '0' and id_version = '".$_SESSION['id_trd_empresa']."'");
									while ($row = $con->FetchAssoc($q)) {
										echo "<option value='".$row['id']."'> ".$row['nombre']."</option>";
									}
								?>
							</select>
						</div>
						<div class="col-md-6">
							<label for="tipo_documento"><?= SUB_SERIE ?></label>
							<select class="form-control required disabled" id="tipo_documento" name="tipo_documento" disabled="disabled" <?= $c->Ayuda('44', 'tog') ?>>
								<option value="">Seleccione una Sub-Serie</option>
								<?
									$qs = $con->Query("SELECT *,(select nombre from dependencias where id = areas_dependencias.id_dependencia_raiz) as nd,(select nombre from dependencias where id = areas_dependencias.id_dependencia) as ndd FROM areas_dependencias WHERE id_area = '38' and id_dependencia_raiz = '1' order by id limit 1000");

									while ($ror = $con->FetchAssoc($qs)) {
										echo "<option value='".$ror['id_dependencia']."'>".$ror['ndd']."</option>";
									}
								?>
							</select>
						</div>
					</div>
					<script>	
						$(document).ready(function() {
							dependencia_estadoinExistence('departamento');
							$("#departamento").change(function(){
								dependencia_ciudadinExistence("departamento","ciudad");
							});
							$("#ciudad").change(function(){
								dependencia_item("ciudad","oficina", "/seccional/listadooficinasseccional");
					//			$("#num_oficio_respuesta").val(zeroFill($("#ciudad").val(), 3));
								setTimeout(function(){
									if($("#oficina").val() != "" && $("#oficina").val()  != "Seleccione una Oficina"){
										$("#oficina").change();
									}
								}, 500);
							});
							$("#oficina").change(function(){
								dependencia_item("oficina","dependencia_destino", "/usuarios/ListadoAreasOficinaNew");
					//			$("#num_oficio_respuesta").val(zeroFill($("#ciudad").val(), 3)+"-"+zeroFill($("#oficina").val(), 3));
								setTimeout(function(){
									if($("#dependencia_destino").val() != "" && $("#dependencia_destino").val()  != "Seleccione un Area de Trabajo"){
										$("#dependencia_destino").change();
									}
								}, 500);
							});
							$("#autorad").on("change", function(){
								if ($(this).val() == "SI") {
									$("#num_oficio_respuesta").val($("#num_oficio_respuesta_hid").val());
								}else{
									$("#num_oficio_respuesta_hid").val($("#num_oficio_respuesta").val());
									$("#num_oficio_respuesta").val("");
								}
							})
							$("body").css("cursor", "wait");
							setTimeout(function(){
								$("#departamento option[value="+ $("#mydpto").val() +"]").attr("selected",true);
							}, 500);
							setTimeout(function(){
								dependencia_ciudadinExistence("departamento","ciudad");
							}, 500);
							setTimeout(function(){
								$("#ciudad option[value="+ $("#mycity").val() +"]").attr("selected",true);
								dependencia_item("ciudad","oficina", "/seccional/listadooficinasseccional");
							//	$("#num_oficio_respuesta").val(zeroFill($("#ciudad").val(), 3));
								$("body").css("cursor", "default");
								setTimeout(function(){
									if($("#oficina").val() != "" && $("#oficina").val()  != "Seleccione una Oficina"){
										$("#oficina").change();
									}
								}, 500);
							}, 500);
							$("#dependencia_destino").change(function(){
								dependencia_item("dependencia_destino","nombre_destino", "/usuarios/ListadoUsuariosAreasOficina3New/"+$("#oficina").val());
								//$("#num_oficio_respuesta").val(   $("#anho_rad").val()+zeroFill($("#dependencia_destino").val(), 3) );
					            dependencia_item('dependencia_destino','id_dependencia_raiz','/areas_dependencias/GetSeriesArea/');
					            setTimeout(function(){
									if($("#id_dependencia_raiz").val() != "" && $("#id_dependencia_raiz").val()  != "Seleccione una Serie"){
										$("#id_dependencia_raiz").change();
									}
								}, 500);
							});
							$("#id_dependencia_raiz").change(function(){
								dependencia_item2('dependencia_destino', 'id_dependencia_raiz','tipo_documento', '/areas_dependencias/GetSubSeriesArea/');
								setTimeout(function(){
									if($("#tipo_documento").val() != "" && $("#tipo_documento").val()  != "Seleccione una Sub-Serie"){
										$("#tipo_documento").change();
									}
								}, 500);
							});
						});
					</script>							
				<?php else: ?>
					<?
						$city = $con->Query("Select id_tabla from  usuarios_configurar_accesos where user_id = '".$_SESSION['usuario']."' and tabla = 'city'");
						$d = $con->FetchAssoc($city);
						$city = $d['id_tabla'];
					?>
					<div class="row m-t-30 dn">
						<div class="col-md-6">
							<label for="ciudad"><?= CIUDAD ?>:</label>
							<input  class="form-control" type='text' name="ciudad" id="ciudad" value="<?= $city ?>" />
						</div>
						<div class="col-md-6">
							<label for="oficina"><?= OFICINA ?>:</label>
							<input  class="form-control" type='text' name="oficina" id="oficina" value="<?= $u->GetSeccional() ?>" />
						</div>
						<div class="col-md-6">
							<label for="dependencia_destino"><?= CAMPOAREADETRABAJO; ?></label>
							<input  class="form-control" type='text' name="dependencia_destino" id="dependencia_destino" value="<?= $u->GetRegimen() ?>" />
						</div>
						<div class="col-md-6">
							<label for="nombre_destino"><?= RESPONSABLE ?></label>
							<input  class="form-control" type='text' name="nombre_destino" id="nombre_destino" value="<?= $u->GetA_i() ?>" />
						</div>
					</div>
					<div class="row m-t-30 dn">
						<div class="col-md-6">
							<label for="id_dependencia_raiz"><?= SERIE ?></label>
							<select class="form-control important " id="id_dependencia_raiz" name="id_dependencia_raiz"   >
								<?
									$s = new MDependencias;
									$q = $s->ListarDependencias(" where dependencia = '0' and id_version = '".$_SESSION['id_trd_empresa']."'");
									while ($row = $con->FetchAssoc($q)) {
										echo "<option value='".$row['id']."'> ".$row['nombre']."</option>";
									}
								?>
							</select>
						</div>
						<div class="col-md-6">
							<label for="tipo_documento"><?= SUB_SERIE ?></label>
							<select class="form-control required " id="tipo_documento" name="tipo_documento"  <?= $c->Ayuda('44', 'tog') ?>>
								<option value="">Seleccione una Sub-Serie</option>
								<?
									$qs = $con->Query("SELECT *,(select nombre from dependencias where id = areas_dependencias.id_dependencia_raiz) as nd,(select nombre from dependencias where id = areas_dependencias.id_dependencia) as ndd FROM areas_dependencias WHERE id_area = '38' and id_dependencia_raiz = '1' order by id limit 1000");

									while ($ror = $con->FetchAssoc($qs)) {
										echo "<option value='".$ror['id_dependencia']."'>".$ror['ndd']."</option>";
									}
								?>
							</select>
						</div>
					</div>
					<script>	
						$(document).ready(function() {
							/*dependencia_item('dependencia_destino','id_dependencia_raiz','/areas_dependencias/GetSeriesArea/');
					            setTimeout(function(){
									if($("#id_dependencia_raiz").val() != "" && $("#id_dependencia_raiz").val()  != "Seleccione una Serie"){
										$("#id_dependencia_raiz").change();
									}
								}, 1000);*/
							$("#id_dependencia_raiz").change(function(){
								dependencia_item2('dependencia_destino', 'id_dependencia_raiz','tipo_documento', '/areas_dependencias/GetSubSeriesArea/');
								setTimeout(function(){
									if($("#tipo_documento").val() != "" && $("#tipo_documento").val()  != "Seleccione una Sub-Serie"){
										$("#tipo_documento").change();
									}
								}, 1000);
							});
						});
					</script>		
				<?php endif ?>
				
				
			
				<?php if (M_INFORMACION_ADICIONAL == "1"): ?>    
					<h2 class="box-title m-t-30"><?= INFORMACION_ADICIONAL ?></h2>
				<?php endif ?>
			    <hr class="m-t-0 m-b-20">
				<div class="row m-t-30">
					<div class="col-md-6">
						<label for="radicado"><?= CAMPORADEXTERNO ?></label>
						<input class="form-control" type='text' name='radicado' id='radicado' placeholder="Ingresar Numero de Radicado" <?= $c->Ayuda('47', 'tog') ?>/>					
					</div>
					<div class="col-md-6">
						<label for="responsble_firma">Parte Interesada</label>
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
						<input type="hidden" name="email_abogado" id="email_abogado" />
			            <input type="hidden" name="direccion_abogado" id="direccion_abogado" />
			            <input type="hidden" name="telefono_abogado" id="telefono_abogado" />
			            <input type="hidden" name="tarjeta_profesional_abogado" id="tarjeta_profesional_abogado" />
			            <input type="hidden" name="cargo_abogado" id="cargo_abogado" />
			            <input type="hidden" name="cedula_expedicion_abogado" id="cedula_expedicion_abogado" />
					</div>
				</div>
					<div id="formjudicial">
						<!--<h3 class="box-title m-t-30 text-warning dn">Diligencie la siguiente información ÚNICAMENTE si la correspondencia a enviar son Notificaciones Judiciales</h3>-->
					    <hr>
						<div class="row m-t-30 m-b-30">
						<?php if (CAMPOT1 != ""): ?>
							<div class="col-md-4 m-t-30">
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
							<div class="col-md-4 m-t-30">
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
							<div class="col-md-4 m-t-30">
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
					</div>
					<div class="row m-t-30 m-b-30">
						<?php if (CAMPOT5 != ""): ?>
							<div class="col-md-4 m-t-30 tipo_documento_seleccion">
								<label for="campot5"><?= CAMPOT5 ?></label>
								<?
									#echo "Select * from meta_listas where titulo = '".CAMPOT5."'";
									$x = $con->Query("Select * from meta_listas where titulo = '".CAMPOT5."'");
									$cont = $con->NumRows($x);
									$dat = $con->FetchAssoc($x);
									if ($cont > 0) {
								?>
										<select class="form-control" name='campot5' id='campot5' >
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
										<input  class="form-control" type='text' name='campot5' id='campot5' maxlength='100'  />
								<?
									}
								?>
							</div>

							<div class="col-md-4 m-t-30 dn  ">
								<label for="generar_notificacion">¿Generar Formato de Notificación?</label>

								<select class="form-control" name='generar_notificacion' id='generar_notificacion' >
									<option value="">Seleccione una Opción</option>
									<option value="S">SI</option>
									<option value="N">NO</option>
								</select>
							</div>
						<?php endif ?>
						<?php if (CAMPOT6 != ""): ?>
							<div class="col-md-4 m-t-30">
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
							<div class="col-md-4 m-t-30 dn ">
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
							<div class="col-md-4 m-t-30  ">
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
					</div>
					<div class="row m-t-30 m-b-30">
						<?php if (CAMPOT14 != ""): ?>
							<div class="col-md-6 m-t-30 tipo_documento_seleccion">
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
							<div class="col-md-4 dn m-t-30">
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
					</div>
					<div class="row m-t-30">	
						<?php if (CAMPOT11 != ""): ?>
							<div class="col-md-4 m-t-30 tipo_documento_seleccion">
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
							<div class="col-md-4 m-t-30 tipo_documento_seleccion">
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
							<div class="col-md-4 m-t-30 tipo_documento_seleccion">
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
					</div>	
						<div class="row m-t-30">
							<div class="col-md-12">
								<div class="form-group">
									<label for="campot15">CUERPO DEL MENSAJE</label>
									<textarea type='text' class="form-control textarea_editor" rows="15" name='observacion2' id='observacion2' placeholder="Observación del Expediente"></textarea>
                                </div>
							</div>
						</div>
                    </section>
                    <!-- Step 4 -->
                    <h6>Cargar Documentos</h6>
                    <section>
                    	<div class="row m-t-20 m-b-20" >
                        	<div class="col-md-12" >
                        		<h2 id="titledocsx"></h4>
                        	</div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 hidden-xs hidden-sm">
                            	<div class="jumbotron">
                            		<?= $paso6 ?>
                            	</div>
								
                            </div>
                            <div class="col-md-6">
                            	<div id='cargadocumentos'>			
									<div style="margin-top:50px" class="list-group" id="modecarga"></div>
									<div style="margin-top:50px" class="list-group" id="exp_actual"></div>
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
                    <div class="dn">
                    	<input type="text"  name="documento_salida" id="documento_salida" value="N">
						<input type="text"  name="es_externo" id="es_externo" value="NO">
                    	<input type="text"  name="g_id" id="g_id" value="N">
                    	<select name="autorad" id="autorad"><option value="SI">SI</option></select>
						<input type='text' name='folio' id='folio' placeholder="Numero de Folios:" maxlength='3' />
						<input type='text' name='num_oficio_respuesta' id='num_oficio_respuesta' placeholder="Número de Radicado Interno"/>
						<input type='text' name='num_oficio_respuesta_hid' id='num_oficio_respuesta_hid' maxlength='100' />
						<input type='text' name='anho_rad' id='anho_rad' value="<?= date('Y-') ?>" maxlength='100' />							
						<input type='text' name='f_recibido' id='f_recibido' placeholder="Fecha de Recibido:" value="<?= date('Y-m-d') ?>" />
						<input type='text' name='fecha_vencimiento' id='fecha_vencimiento' placeholder="Fecha de Vencimiento Respuesta:" />
						<input type='text' name='prioridad' id='prioridad' placeholder="Fecha de Vencimiento Respuesta:" value="1" />
						<input type='text' name='estado_solicitud' id='estado_solicitud' placeholder="estado de la solicitud" value="1" />
						<input type='text' name='nombre_radica' id='nombre_radica' placeholder="Nombre de quien radica:" />
						<select name="estado_respuesta" id="estado_respuesta"><option value="Abierto">Abierto</option></select>
						<input type='text' name='fecha_respuesta' id='fecha_respuesta' placeholder="Fecha_respuesta:" />
						<input type='text' name='usuario_registra' id='usuario_registra' placeholder="Usuario_registra:" value="<?= $_SESSION['usuario'] ?>" />
						<input type='text' name='estado_archivo' id='estado_archivo' placeholder="Estado_archivo:" value="1" />
						
						<br><?$cy = new MCity;$cy->CreateCity("code", $_SESSION['ciudad']);?>
						<input type='text' id='mydpto' value="<?= $cy->GetProvince() ?>" />
						<input type='text' id='mycity' value="<?= $cy->GetCode() ?>" />
						<input type="text" value="<?= HOMEDIR.DS."app/plugins/thumbnails/".$u->GetFirma(); ?>" name="firma_abogado" id="firma_abogado">
						<input type="text" value="<?= $u->GetId(); ?>" name="cedula_abogado" id="cedula_abogado">
                    </div>
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
        /*errorPlacement: function (error, element) {
            error.insertAfter(element)
        },*/
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

	desinatario = "Citado / Notificado";
	pfisico = "<?= PERMITIRFISICO ?>";
	function AddDestinatario(){

		rem = "<?= $pathtrs ?>";
		dptos = "<?= $departamentos ?>";
		id = getRandomArbitrary(0, 10000);

		totala = parseInt(<?= CORRESPONDENCIAFISICA ?>);
		totalb = parseInt(<?= $counterfisicas ?>);

		es_gratis = <?= $u->Getfreemium() ?>;
		disablef = '';


		if (es_gratis == 1) {
			if (totalb >= totala) {
				disablef = 'disabled';
			}
		}
		destin = '<span class="titulodestinatario">'+desinatario+'</span>';

		cola = "col-md-6";
		dn = "";
		colb = "col-md-4";
		if (desinatario != "Citado / Notificado") {
			cola = "col-md-12";
			colb = "col-md-4";
			dn = " dn ";
		}
		pfisicovar = "";
		if(pfisico == "1"){
			pfisicovar = '<option value="CC" >Físico</option><option value="CC/CE"  >Físico y Electrónico</option>';
		}
		
		/*

		var selectsuscriptor = "";
		selectsuscriptor = '';
		if(haveexp == ""){
		}else{
			selectsuscriptor = '<select></select>';
		}
		*/

		// <input class="form-control required destinatario_nombre" onkeyup="BuscarJs(\''+id+'\')" type="text" name="nombre_destinatario[]" id="nombre_destinatario'+id+'" placeholder="Escriba su nombre completo" data-role="'+id+'"/>

		// AddDestinatarioRole("N", "2438", "");


		//alert(totala+" - "+totalb+" - "+es_gratis+" - "+disablef);
		var ls = $("#listadosuscriptores").html();
		if(ls != ""){
			listanombres = '<label  for="n_destinatario_lista'+id+'">Nombre Completo:</label><select class="form-control required destinatario_nombre" onchange="GetDestinatario(\''+id+'\')" id="n_destinatario_lista'+id+'" placeholder="Escriba su nombre completo" data-role="'+id+'"><option>Seleccione una Opción</option>'+ls+'<option value="otro">otro</option></select>';
			
			$("#camponombre"+id).addClass("dn");
			//AddDestinatarioRole("40", "SANDER CADENA", "4486")
		}else{
			listanombres = "";
			$("#campolistanombre"+id).addClass("dn");
		}

		$("#add_suscriptor_fill").append('<div class="list-group-item" id="elm'+id+'"><div class="row"><div class="col-md-10"><h3>Agregar '+destin+'</h3></div><div class="col-md-2"><button type="button" class="btn btn-primary mdi mdi-delete pull-right" onClick=" RemoveDestinatario(\'elm'+id+'\')"></button></div></div><div class="row"><div class="col-md-4"><div class="form-group" id="campolistanombre'+id+'">'+listanombres+'</div><div class="form-group" id="camponombre'+id+'"><label for="nombre_destinatario'+id+'">Nombre Completo:</label><input type="text" id="dtform'+id+'" name="dtform[]" data-role="'+id+'" value="N" class="form-control dn"><input class="form-control required destinatario_nombre midestinatario_nombre" onkeyup="BuscarJs(\''+id+'\')" type="text" name="nombre_destinatario[]" id="nombre_destinatario'+id+'" placeholder="Escriba su nombre completo" data-role="'+id+'"/><div id="bloque_busqueda_destinatario'+id+'" class="bloque_busqueda_destinatario"></div></div></div><div class="col-md-4 "><div class="form-group"><label for="tipo_destinatario'+id+'">Tipo de '+destin+':</label><select class="form-control" name="tipo_destinatario[]" id="tipo_destinatario'+id+'"><option value="0">Seleccione el Tipo de '+destin+'</option><option value="0">OTRO</option>'+rem+'</select></div></div><div class="'+colb+'"><div class="form-group"><label for="identificacion_destinatario'+id+'">Número de Identificación:</label><input class="form-control" type="text" id="identificacion_destinatario'+id+'" name="identificacion_destinatario[]"></div></div></div><div class="row dn  fila_notificado"><div class="col-md-12"><div class="form-group"><label for="nombre_notificado'+id+'">Demandado:</label><input class="form-control required destinatario_nombre nombredemandado" type="text" name="nombre_notificado[]" id="nombre_notificado'+id+'" placeholder="Escriba su nombre completo" data-role="'+id+'"/></div></div></div><div class="row"><div class="col-md-8"><div class="form-group"><label>Medio de Comunicación *</label><br><select name="titulo[]" id="titulo'+id+'" class="form-control m-b-30 tipo_correspondencia_select required" data-role="'+id+'" onchange="tipo_correspondencia_select(\''+id+'\')"><option value="CE">Correo Electrónico</option>'+pfisicovar+'<option value="SMS">Solo Mensaje deTexto</option></select></div></div><div class="col-md-4"><div class="form-group"><label>Enviar a Teléfono Celular *</label><br><select name="sms[]" id="sms'+id+'" class="form-control m-b-30 required" onchange="sms_select(\''+id+'\')"><option value="NO">Seleccione una Opción</option><option value="SI">SI</option><option value="NO">NO</option></select></div></div></div><div class="row" id="col_fisico'+id+'"><div class="col-md-4"><div class="form-group"><label for="departamento_destinatario'+id+'">Departamento de Destino:</label><select class="form-control" id="departamento_destinatario'+id+'" name="departamento_destinatario[]" onchange="dependencia_ciudad(\'departamento_destinatario'+id+'\', \'ciudad_destinatario'+id+'\')"><option value="-">Seleccione un Departamento</option>'+dptos+'</select></div></div><div class="col-md-4"><div class="form-group"><label for="ciudad_destinatario'+id+'">Ciudad de Destino:</label><input type="hidden" id="namecity'+id+'" name="namecity[]"><select class="form-control" onchange="Setnamecity(\''+id+'\')" id="ciudad_destinatario'+id+'" name="ciudad_destinatario[]"><option value="-">Seleccione una Ciudad</option></select></div></div><div class="col-md-4"><div class="form-group"><label for="direccion_destinatario'+id+'">Dirección de Destino:</label><input class="form-control" type="text" id="direccion_destinatario'+id+'" name="direccion_destinatario[]"></div></div></div><div class="row"><div class="'+colb+'" id="col_telefono'+id+'"><div class="form-group"><label for="telefono_destinatario'+id+'">Numero de Telefono:</label><input class="form-control" type="text" placeholder="Número Celular Ej: 3108009525" id="telefono_destinatario'+id+'" name="telefono_destinatario[]"></div></div><div class="'+colb+'"  id="col_email'+id+'"><div class="form-group"><label for="email_destinatario'+id+'">Correo Electrónico:</label><input class="form-control" type="text" placeholder="E-mail" id="email_destinatario'+id+'" name="email_destinatario[]"></div></div><div class="col-md-4"><code>Si deasea agregar mas de un correo electrónico para este destinatario, por favor separarlos con ; (Punto y coma) </code></div><div class="col-md-4 dn"><div class="form-group"><label for="es_juridica'+id+'">¿Naturaleza del '+destin+':</label><select class="form-control" id="es_juridica'+id+'" name="es_juridica[]"><option value="Personal Natural">Seleccione una Opción</option><option value="Personal Natural">Persona Natural</option><option value="Personal Juridica">Persona Jurídica O Entidad Judicial</option></select></div></div></div></div>');
			
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
			//	AddDestinatario()				

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


    $("#campot5").change(function(){

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

	});
	$("#notif_tipo_documento").change(function(){
		//;
		$("#radfield").removeClass("dn");

		switch ($(this).val()) {
		  	case "Correspondencia Judicial":
			    //NOTIFICACIONES JUDICIALES
				desinatario = "Citado / Notificado";
				$("#remite_title").html("Cliente / Demandante");
				$("#destino_title").html("Información del/los Demandado(s) o Citado(s)");
				$("#formgestion-t-1").html('<span class="step">2</span> Información del/los Demandado(s) o Citado(s)');
				$(".titulodestinatario").html("Citado / Notificado");
				$("#formjudicial").removeClass("dn");
				$(".tipo_documento_seleccion").removeClass("dn");
				$('#tipo_documento option[value="2"]').attr("selected", true);
				$(".fila_notificado").removeClass("dn");

		    break;
		  case "Correspondencia Certificada":
		  		//RADICACIONES O ENVIOS
				desinatario = "Destinatario";
		    	$("#remite_title").html("Remitente");
				$("#destino_title").html("Información del/los Destinatario(s)");
				$("#formgestion-t-1").html('<span class="step">2</span> Información del/los Destinatario(s)');
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
				$("#destino_title").html("Información del/los Destinatario(s)");
				$("#formgestion-t-1").html('<span class="step">2</span> Información del/los Destinatario(s)');
				$(".titulodestinatario").html("Destinatario");
				$("#formjudicial").removeClass("dn");
				$(".fila_notificado").addClass("dn");
				$(".tipo_documento_seleccion").addClass("dn");
				$('#tipo_documento option[value="14"]').attr("selected", true);
		    break;
		  default:
				desinatario = "Destinatario";
		    	$("#remite_title").html("Remitente");
				$("#destino_title").html("Información del/los Destinatario(s)");
				$("#formgestion-t-1").html('<span class="step">2</span> Información del/los Destinatario(s)');
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
	
	$("#btnsent").val("Enviando...");
    $("#btnsent").prop('disabled', true);

	var hay = "";
	
	$(".filename").each(function(){
		if($(this).val() != ""){
			hay += $(this).val();
		}
	})

	$(".active_check").each(function(){
		var date = $(this).prop("checked"); 
		if (date){
			hay += $(this).attr('id')	;
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
    //$("#formgestion").submit(); 
}



</script>
<?
	if($_REQUEST['id'] != ""){
		echo '<script>GetDetailExpediente("'.$_REQUEST['id'].'", "'.$_REQUEST['cn'].'")</script>';
	}
?>

<button type="button" class="btn btn-primary btn-lg" style="display: none" data-role="0" id="myXlargemodalbtn" data-toggle="modal" data-target="#myXModal">G</button>
<div class="modal fade bs-example-modal-lg" id="myXModal" tabindex="-1" role="dialog" aria-labelledby="myXLargeModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" id="aria-colse" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title" id="myXModalLabel">Cargar Soportes y Tipologías de los Documentos</h4>
      </div>
      <div class="modal-body">
        <div class="row" style="margin:0px" id="myXLargeModalBody"></div>
      </div>    
    </div>
  </div>
</div>