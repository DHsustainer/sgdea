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
	$query_eg = $lx->ListarSuscriptores_tipos("where correspondencia = '2'"); 
	$pathtrs = "";
	while($row_type = $con->FetchAssoc($query_eg)){
		$pathtrs .= "<option value='".$row_type['id']."'>".$row_type['nombre']."</option>";
	}

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
				<h4 class="card-title">Formulario de Creación de <?= CAMPOEXPEDIENTE ?></h4>
        		<h6 class="card-subtitle text-muted">El sistema le guiará paso a paso durante el proceso de Registro</h6>
			</div>
        <form id='formgestion' action='/gestion/registrov2/' method='POST' class="validation-wizard wizard-circle m-t-40">
            <!-- Step 1 -->
			<?
				$allow = true;
			?>
			<?php if ($allow): ?>
            <h6>Inicio</h6>
            <section>
                <div class="row m-t-20">
                    <div class="col-md-12">
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

					    <div class="row  m-t-20 m-b-20" >
		                	<div class="col-md-12" >
		                		<h2 id="titleform">METADATOS DEL EXPEDIENTE</h4>
		                	</div>
		                </div>
		                <hr class="m-t-0 m-b-20">
		                <div class="row m-t-30 m-b-30">
		                	<div class="col-md-12">
		                		<h2 class="box-title <?= M_INFORMACION_GENERAL ?>"><?= INFORMACION_GENERAL ?></h2>
		                	</div>
		            	</div>
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
						<div class="row m-t-30 m-b-30">
							<div class="col-md-<?= (M_CAMPOIDRAD == "dn")?"12":"6" ?>">
								<label for="radicado"><?= CAMPORADEXTERNO ?></label>
								<input class="form-control" type='text' name='radicado' id='radicado' value="<?= PREFIJORAD ?>" placeholder="Ingresar Numero de Radicado" <?= $c->Ayuda('47', 'tog') ?>/>					
							</div>

							<div class="col-md-6 <?= M_CAMPOIDRAD ?>">
								<label for="num_oficio_respuesta"><?= CAMPOIDRAD ?></label>
								<input type='text' class="form-control" name='num_oficio_respuesta' id='num_oficio_respuesta' placeholder="<?= CAMPOIDRAD ?>"/>
							</div>


							<div class="col-md-6 dn">
								<label for="responsble_firma">Parte Interesada</label>
								<select class="form-control" id="responsble_firma" name="responsble_firma"  >
									<?php if ($_SESSION['buscador_global'] == "1"): ?>
										<option value="">Seleccione un <?= RESPONSABLE ?></option>
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
						<?php if (EXPEDIENTESPUBLICOS == "1"): ?>    
						<div class="row m-t-30">
							<div class="col-md-12">
								<label for="expediente_publico">
									<input type="checkbox" id="expediente_publico" name="expediente_publico" value="S"  class="m-r-10" <?= $c->Ayuda('54', 'tog') ?>>Deseo hacer este expediente público. 
								</label>
							</div>
						</div>
						<?php endif ?>
						<?php if (M_DESTINO_DOCUMENTO == "1"): ?>    
							<div class="row m-b-30">
		                		<div class="col-md-12">
									<hr class="m-b-20">
									<h2 class="box-title m-t-30"><?= DESTINO_DOCUMENTO ?></h2>
								</div>
							</div>
                    	<?php endif ?>
						<?php if ($_SESSION['buscador_global'] == "1"): ?>
							<div class="row m-t-30">
								<div class="col-md-6">
									<label for="departamento"><?= DEPARTAMENTO ?>:</label>
									<select name="departamento" id="departamento" class='form-control required disabled' disabled="disabled" <?= $c->Ayuda('37', 'tog') ?>>
										<option value="">Seleccione un Departamento</option>
									</select>
								</div>
								<div class="col-md-6">
									<label for="ciudad"><?= CIUDAD ?>:</label>
									<select name="ciudad" id="ciudad" class=' form-control required disabled' disabled="disabled" <?= $c->Ayuda('38', 'tog') ?>>
										<option value="">Seleccione una Ciudad</option>
									</select>
								</div>
							</div>
							<div class="row m-t-30">
								<div class="col-md-4">
									<label for="oficina"><?= OFICINA ?>:</label>
									<select name="oficina" id="oficina" class=' form-control required disabled' disabled="disabled"<?= $c->Ayuda('39', 'tog') ?>>
										<option value="">Seleccione una Oficina</option>
									</select>
								</div>
								<div class="col-md-4">
									<label for="dependencia_destino"><?= CAMPOAREADETRABAJO; ?></label>
									<select placeholder="<?= CAMPOAREADETRABAJO; ?>"  name="dependencia_destino" id="dependencia_destino" class=' form-control required disabled' disabled="disabled" <?= $c->Ayuda('40', 'tog') ?> >
										<option value="">Seleccione una <?= CAMPOAREADETRABAJO; ?></option>
									</select>
									<input class="form-control" type='text' name='areatemp' id='areatemp' style="display:none" />
								</div>
								<div class="col-md-4">
									<label for="nombre_destino"><?= RESPONSABLE ?></label>
									<select disabled="disabled" name="nombre_destino" id="nombre_destino" class='form-control required disabled' <?= $c->Ayuda('41', 'tog') ?>>
										<option value="">Seleccione un Usuario</option>
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
										}, 1000);
									});
									$("#oficina").change(function(){
										dependencia_item("oficina","dependencia_destino", "/usuarios/ListadoAreasOficinaNew");
							//			$("#num_oficio_respuesta").val(zeroFill($("#ciudad").val(), 3)+"-"+zeroFill($("#oficina").val(), 3));
										setTimeout(function(){
											if($("#dependencia_destino").val() != "" && $("#dependencia_destino").val()  != "Seleccione un Area de Trabajo"){
												$("#dependencia_destino").change();
											}
										}, 1000);
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
									}, 1000);
									setTimeout(function(){
										dependencia_ciudadinExistence("departamento","ciudad");
									}, 2000);
									setTimeout(function(){
										$("#ciudad option[value="+ $("#mycity").val() +"]").attr("selected",true);
										dependencia_item("ciudad","oficina", "/seccional/listadooficinasseccional");
									//	$("#num_oficio_respuesta").val(zeroFill($("#ciudad").val(), 3));
										$("body").css("cursor", "default");
										setTimeout(function(){
											if($("#oficina").val() != "" && $("#oficina").val()  != "Seleccione una Oficina"){
												$("#oficina").change();
											}
										}, 1000);
									}, 3000);
									$("#dependencia_destino").change(function(){
										dependencia_item("dependencia_destino","nombre_destino", "/usuarios/ListadoUsuariosAreasOficina3New/"+$("#oficina").val());
										//$("#num_oficio_respuesta").val(   $("#anho_rad").val()+zeroFill($("#dependencia_destino").val(), 3) );
							            dependencia_item('dependencia_destino','id_dependencia_raiz','/areas_dependencias/GetSeriesArea/');
							            setTimeout(function(){
											if($("#id_dependencia_raiz").val() != "" && $("#id_dependencia_raiz").val()  != "Seleccione una Serie"){
												$("#id_dependencia_raiz").change();
											}
										}, 1000);
									});
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
							<script>	
								$(document).ready(function() {
									dependencia_item('dependencia_destino','id_dependencia_raiz','/areas_dependencias/GetSeriesArea/');
							            setTimeout(function(){
											if($("#id_dependencia_raiz").val() != "" && $("#id_dependencia_raiz").val()  != "Seleccione una Serie"){
												$("#id_dependencia_raiz").change();
											}
										}, 1000);
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

						<div class="row m-t-30">
							<div class="col-md-6">
								<label for="id_dependencia_raiz"><?= SERIE ?></label>
								<select class="form-control required disabled" id="id_dependencia_raiz" name="id_dependencia_raiz"  disabled="disabled" >
									<option value="">Seleccione <?= SERIE ?></option></select>
							</div>
							<div class="col-md-6">
								<label for="tipo_documento"><?= SUB_SERIE ?></label>
								<select class="form-control required disabled" id="tipo_documento" name="tipo_documento" disabled="disabled" <?= $c->Ayuda('44', 'tog') ?>>
									<option value="">Seleccione <?= SUB_SERIE ?></option>
								</select>
							</div>
						</div>
						<?php if (M_INFORMACION_ADICIONAL == "1"): ?>
							<div class="row m-t-30">		
		                		<div class="col-md-12">    
									<hr class="m-t-30 m-b-20">
									<h2 class="box-title m-t-30"><?= INFORMACION_ADICIONAL ?></h2>
								</div>
							</div>
                        <?php endif ?>
		                <div class="row m-t-20 m-b-30">
					        <div class="col-md-6 <?= M_TIPO_DOCUMENTO ?>">
					            <div class="form-group">
					                <label class="control-label"><?= TIPO_DOCUMENTO ?>:</label>
					                <select  name="documento_salida" id="documento_salida" class='form-control important' <?= $c->Ayuda('34', 'tog') ?>>
										<option value="N">Selecciona una Opción</option>
										<option value="N">Documento de Entrada</option>
										<option value="S">Documento de Salida</option>
										<option value="C">Comunicaciones Internas</option>
										<option value="A">Archivo Central</option>
									</select>
								</div>
					        </div>
					        <div class="col-md-6 <?= M_ALERTA_COMPARTIDOS ?>">
								<div class="col-md-6">
									<label for="nombre_destino_compartir_con">¿Compartir?</label>
									<select   name="nombre_destino_compartir_con" id="nombre_destino_compartir_con" class='form-control ' onchange="fnNombreDestinoCompartirCon();" <?= $c->Ayuda('42', 'tog') ?>>
										<option value="4">No compartir con Ninguno</option>
										<option value="1">Todos los <?= RESPONSABLE ?>(S) del <?= CAMPOAREADETRABAJO; ?></option>
										<option value="2">Todos los <?= RESPONSABLE ?>(S) del <?= CAMPOENTIDAD ?></option>
										<option value="3">Agregar otro <?= RESPONSABLE ?></option>
									</select>
									<div  id="seleccion_compartir_con2" style="max-height: 100px; overflow: auto; width: 350px;"></div>
									<div  id="seleccion_compartir_con"></div>							
									<input type="hidden"  name="cantidadusuariosagregados" id="cantidadusuariosagregados" value="0">
								</div>
								<div class="col-md-6">
									<label>
										<input type="radio" name="losusuariospuedenalcompartir" value="0" class="m-r-10" checked <?= $c->Ayuda('52', 'tog') ?>>
										Compartir Para Consulta
									</label>
									<label>
										<input type="radio" name="losusuariospuedenalcompartir" value="1" class="m-r-10" <?= $c->Ayuda('53', 'tog') ?>>
										Compartir con Interacción
									</label>
									<label for="informerporemail">
										<input type="checkbox" id="informerporemail" name="informerporemail" value="S" checked class="m-r-10" <?= $c->Ayuda('54', 'tog') ?>>Informar a los usuarios por email
									</label>
								</div>
							</div>
						</div>		       		
						<div class="row ">
							<div class="col-md-4 <?= M_FECHA_APERTURA ?>">
								<label for="f_recibido"><?= FECHA_APERTURA ?></label>
								<input class="form-control datepicker" type='date' name='f_recibido' id='f_recibido' placeholder="Fecha de Recibido:" maxlength='' value="<?= date('Y-m-d') ?>" <?= $c->Ayuda('48', 'tog') ?> />
							</div>
							<div class="col-md-4 <?= M_FECHA_RESPUESTA ?>">
								<label for="fecha_vencimiento"><?= FECHA_RESPUESTA ?></label>
								<input class="form-control datepicker" type='date' name='fecha_vencimiento' id='fecha_vencimiento' placeholder="Fecha de Vencimiento Respuesta:" maxlength='' <?= $c->Ayuda('49', 'tog') ?> />
							</div>
							<div class="col-md-4 <?= M_PRIORIDAD ?>">
							  <label for="prioridad"><?= PRIORIDAD ?></label>
							  <select name='prioridad' id='prioridad' class='form-control' <?= $c->Ayuda('50', 'tog') ?> >
									<option value="1">Seleccione la prioridad de la solicitud</option>
									<option value="0">Baja</option>
									<option value="1">Media</option>
									<option value="2">Alta</option>
								</select>
							</div>
						</div>

						<div class="row m-t-20 m-b-30  <?= M_OBSERVACION ?>">
							<div class="col-md-12">
								<label for="observacion2"><?= OBSERVACION ?></label>
								<textarea type='text' name='observacion2' class="form-control" id='observacion2' placeholder="<?= OBSERVACION ?>"></textarea>	
							</div>
						</div>
						<hr class="m-t-30 m-b-30">                         
						<div class="row m-b-30">
						<?
						/*
							$lista = $con->Query("select * from meta_referencias_titulos where titulo = 'CAMPOST'");
							$idlista = $con->Result($lista, 0, 'id');
							
							$listado = $con->Query("select * from meta_referencias_campos where id_referencia = '$idlista' and placeholder != '' order by orden");

							while($rlista 	= $con->FetchAssoc($listado)){
								echo $rlista['slug']."-";
							}*/
						?>


						<?php if (CAMPOT1 != ""): ?>
							<div class="col-md-6 m-t-30  <?= M_CAMPOT1 ?>">
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
							<div class="col-md-3 m-t-30 <?= M_CAMPOT2 ?>">
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
					<div class="col-md-3 m-t-30  <?= M_CAMPOT15 ?>">
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
						<?php if (CAMPOT7 != ""): ?>
							<div class="col-md-4 m-t-30 tipo_documento_seleccion  <?= M_CAMPOT7 ?>">
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
						<?php if (CAMPOT3 != ""): ?>
								<div class="col-md-4 m-t-30  <?= M_CAMPOT3 ?>">
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
							<div class="col-md-4 m-t-30  <?= M_CAMPOT4 ?>">
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
							<div class="col-md-4 m-t-30 tipo_documento_seleccion  <?= M_CAMPOT5 ?>">
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
						<?php endif ?>
						<?php if (CAMPOT6 != ""): ?>
							<div class="col-md-4 m-t-30  <?= M_CAMPOT6 ?>">
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
						<?php if (CAMPOT8 != ""): ?>
							<div class="col-md-4 m-t-30 tipo_documento_seleccion  <?= M_CAMPOT8 ?>">
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
						<?php if (CAMPOT9 != ""): ?>
							<div class="col-md-6 m-t-30  <?= M_CAMPOT9 ?>">
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
						<?php if (CAMPOT14 != ""): ?>
							<div class="col-md-6 m-t-30 tipo_documento_seleccion  <?= M_CAMPOT14 ?>">
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
						
						<?php if (CAMPOT10 != ""): ?>
							<div class="col-md-4 m-t-30  <?= M_CAMPOT10 ?>">
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
					<div class="col-md-4 m-t-30 tipo_documento_seleccion  <?= M_CAMPOT11 ?>">
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
					<div class="col-md-4 m-t-30 tipo_documento_seleccion  <?= M_CAMPOT12 ?>">
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
					<div class="col-md-4 m-t-30 tipo_documento_seleccion  <?= M_CAMPOT13 ?>">
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
            <!-- Step 2 -->
            <h6 id="destino_title"><?= SUSCRIPTORCAMPONOMBRE ?></h6>
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
            <h6>Cargar Documentos</h6>
            <section>
            	<div class="row m-t-20 m-b-20" >
                	<div class="col-md-12" >
                		<h2 id="titledocsx"></h4>
                	</div>
                </div>
                <div class="row">
                    <div class="col-md-6 hidden-xs hidden-sm">
						
                    </div>
                    <div class="col-md-6">
                    	<div id='cargadocumentos'>			
							<div style="margin-top:50px" class="list-group" id="exp_actual"></div>
							<div class="list-group" id="listadocumentostipos"></div>
                    		<div class="list-group" id="anexos_expediente"></div>
						</div>
						<div align="center" class="m-t-30 m-b-30">
							<input type='button' class="btn btn-primary btn-lg" style="height:60px;line-height:40px;padding-left:50px; margin-top:50px; padding-right:50px;font-size: 22px" value='Guardar' onClick="CreateCorrespondencia()"/>
						</div>
                    </div>
                </div> 
            </section>
                    <div class="dn">
						<input type="text"  name="es_externo" id="es_externo" value="NO">
                    	<input type="text"  name="g_id" id="g_id" value="N">
                    	<select name="autorad" id="autorad"><option value="SI">SI</option></select>
						<input type='text' name='folio' id='folio' placeholder="Numero de Folios:" maxlength='3' />
						<input type='text' name='num_oficio_respuesta_hid' id='num_oficio_respuesta_hid' maxlength='100' />
						<input type='text' name='anho_rad' id='anho_rad' value="<?= date('Y-') ?>" maxlength='100' />							
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

<link href="<?= HOMEDIR ?>/app/plugins/theme/plugins/bower_components/jquery-wizard-master/steps.css" rel="stylesheet">

<!-- Form Wizard JavaScript -->
<script src="<?= HOMEDIR ?>/app/plugins/theme/plugins/bower_components/moment/moment.js"></script>
<script src="<?= HOMEDIR ?>/app/plugins/theme/plugins/bower_components/jquery.steps-1.1.0/jquery.steps.min.js"></script>
<script src="<?= HOMEDIR ?>/app/plugins/theme/plugins/bower_components/jquery-wizard-master/jquery.validate.js"></script>
<link rel='stylesheet' type='text/css' href='<?= HOMEDIR.DS ?>app/plugins/select2/css/select2.min.css'/>
<script language='javascript' type='text/javascript' src='<?= HOMEDIR.DS ?>app/plugins/select2/js/select2.min.js'></script>
<script src="<?= HOMEDIR ?>/app/plugins/theme/plugins/bower_components/templates/notifications.js"></script>
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
		nombreb = $(this).val().replaceAll(" ", "+");
		$.ajax({
			type: "POST",
			url: '/gestion/explorar/'+nombreb+"/",
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
		$(".wizard-content .actions ul li >a").eq(1).click();
	})


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

	desinatario = "<?= SUSCRIPTORCAMPONOMBRE ?>";
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
		

		$("#add_suscriptor_fill").append('<div class="list-group-item" id="elm'+id+'"><div class="row"><div class="col-md-10"><h3>Agregar '+destin+'</h3></div><div class="col-md-2"><button type="button" class="btn btn-primary mdi mdi-delete pull-right" onClick="RemoveDestinatario(\'elm'+id+'\')"></button></div></div><div class="row"><div class="col-md-4"><div class="form-group"><label for="nombre_destinatario'+id+'">Nombre Completo:</label><input type="text" id="dtform'+id+'" name="dtform[]" data-role="'+id+'" value="N" class="form-control dn"><input class="form-control required destinatario_nombre" onkeyup="BuscarJs(\''+id+'\')" type="text" name="nombre_destinatario[]" id="nombre_destinatario'+id+'" placeholder="Escriba su nombre completo" data-role="'+id+'"/><div id="bloque_busqueda_destinatario'+id+'" class="bloque_busqueda_destinatario"></div></div></div><div class="col-md-4"><div class="form-group"><label for="tipo_destinatario'+id+'">Tipo de '+destin+':</label><select class="form-control" name="tipo_destinatario[]" id="tipo_destinatario'+id+'"><option value="53">Seleccione el Tipo de '+destin+'</option><option value="53">OTRO</option>'+rem+'</select></div></div><div class="col-md-4"><div class="form-group"><label for="identificacion_destinatario'+id+'">Número de Identificación:</label><input class="form-control" type="text" id="identificacion_destinatario'+id+'" placeholder="Sin Espacios ni puntos" name="identificacion_destinatario[]"></div></div></div><div class="row"><div class="col-md-6" id="col_telefono'+id+'"><div class="form-group"><label for="telefono_destinatario'+id+'">Numero de Telefono:</label><input class="form-control" type="text" placeholder="Número Celular Ej: 3108009525" id="telefono_destinatario'+id+'" name="telefono_destinatario[]"></div></div><div class="col-md-6"  id="col_email'+id+'"><div class="form-group"><label for="email_destinatario'+id+'">Correo Electrónico:</label><input class="form-control" type="text" placeholder="E-mail" id="email_destinatario'+id+'" name="email_destinatario[]"></div></div></div><div class="row" id="col_fisico'+id+'"><div class="col-md-4"><div class="form-group"><label for="departamento_destinatario'+id+'">Departamento:</label><select class="form-control" id="departamento_destinatario'+id+'" name="departamento_destinatario[]" onchange="dependencia_ciudad(\'departamento_destinatario'+id+'\', \'ciudad_destinatario'+id+'\')"><option value="-">Seleccione un Departamento</option>'+dptos+'</select></div></div><div class="col-md-4"><div class="form-group"><label for="ciudad_destinatario'+id+'">Ciudad:</label><input type="hidden" id="namecity'+id+'" name="namecity[]"><select class="form-control" onchange="Setnamecity(\''+id+'\')" id="ciudad_destinatario'+id+'" name="ciudad_destinatario[]"><option value="-">Seleccione una Ciudad</option></select></div></div><div class="col-md-4"><div class="form-group"><label for="direccion_destinatario'+id+'">Dirección:</label><input class="form-control" type="text" id="direccion_destinatario'+id+'" name="direccion_destinatario[]"></div></div></div></div>');

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
			nombreb = $("#nombre_destinatario"+id).val().replaceAll(" ", "+");
			$.ajax({
				type: "POST",
				url: '/suscriptores_contactos/destbuscar/'+nombreb+"/"+id+"/",
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
		$.ajax({
			type: "POST",
			dataType: "json",
			url: '/gestion/getdetailexpediente/'+id+"/",
			success: function(msg){
				
				AddSuscriptor(msg["id_suscriptor"], msg["nombre_suscriptor"]);
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

				result = msg;
				$("#response_detail").html(result);					

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
	    $("#nombre_notificado"+role).val(nombre);
		$("#dtform"+role).val(id);
		$("#bloque_busqueda_destinatario"+role).fadeOut();		
	//	$("#observacion").val($("#notif_tipo_documento").val() + " DE "+$("#nombresuscriptor").val()+" VS "+$(".destinatario_nombre").eq(0).val());
	}

	$("#tipo_documento").change(function(){

	    $.ajax({
	        type: "POST",
	        url: "/meta_big_data/doform/"+$("#tipo_documento").val()+"/",
	        success:function(msg){
	            result = msg;
		        /*$("#modecarga").html(msg);
		        if(msg == "No hay formulario"){
		        	$("#modecarga").html("<div class='alert alert-info'>No hay información adicional para ingresar haga clic en siguiente</div>");
		        }else{
		        	$("#modecarga").html(msg);
		        } */
			    var URL = '/gestion_anexos/getcargapublica/'+$("#tipo_documento").val()+"/";
		        $.ajax({
		            type: 'POST',
		            url: URL,
		            success:function(msg){
		                if (msg != "") {
		                	$("#listadocumentostipos").css("display","block");
		                	$("#listadocumentostipos").html(msg);
		                }else{
		                	$("#listadocumentostipos").css("display","none");
		                }

		            }

		        }); 
		        
	        }
	    });
	});



	
	AddDestinatario()

function CreateCorrespondencia(){
    $("#formgestion").submit(); 
}


	var cantidadusuariosagregados = 0;
	var arrusuariosagregados = [];
	function fnNombreDestinoCompartirConE(){
		$('#nombre_destino_compartir_con').val("");
		$('#seleccion_compartir_con').html('');
	}
	function fnNombreDestinoCompartirCon(){
		if($('#nombre_destino_compartir_con').val() == "3"){
			var html = '<div class="input-group"><input type="text" id="dtformcompartircom" name="dtformcompartircom" placeholder="Nombre Usuario" class="form-control important"><span class="input-group-btn"><button class="btn btn-danger" type="button"  onClick="fnNombreDestinoCompartirConE();">X</button></span></div><div id="bloquebusquedacompartircom"></div>';
			$('#seleccion_compartir_con').html(html);
			$('#seleccion_compartir_con2').append('<label id="usuarios_idlabel'+cantidadusuariosagregados+'"></label><input type="hidden" name="usuarios_id'+cantidadusuariosagregados+'" id="usuarios_id'+cantidadusuariosagregados+'" value="N">');
			cantidadusuariosagregados++;
			$('#nombre_destino_compartir_con').val("");
			$('#cantidadusuariosagregados').val(cantidadusuariosagregados);
			$("#dtformcompartircom").on("keyup", function(){
				$("#bloquebusquedacompartircom").fadeIn();					
				$.ajax({
					type: "POST",
					url: '/usuarios/ListadoUsuariosTodos/'+$(this).val()+"/",
					success: function(msg){
						result = msg;
						$("#bloquebusquedacompartircom").html(result);					
					}
				});				
			});
		}
		if($('#nombre_destino_compartir_con').val() == "2"){
			$.ajax({
				type: "POST",
				url: '/usuarios/ListadoUsuariosTodos2/0/',
				success: function(msg){
					result = msg;
					if(result != ''){
						var arr = result.split('###');
						for (var i = 0; i < arr.length; i++) {
							var hght = arr[i].split('|');
							if((arrusuariosagregados[hght[0]] == undefined || arrusuariosagregados[hght[0]] == 'undefined') && $('#nombre_destino').val() != hght[0]){
								$('#seleccion_compartir_con2').append('<label id="usuarios_idlabel'+cantidadusuariosagregados+'"></label><input type="hidden" name="usuarios_id'+cantidadusuariosagregados+'" id="usuarios_id'+cantidadusuariosagregados+'" value="N">');
								cantidadusuariosagregados++;
								$('#cantidadusuariosagregados').val(cantidadusuariosagregados);
								AddUsuario(hght[0], hght[1]);
							}
						}
					}				
				}
			});
		}
		if($('#nombre_destino_compartir_con').val() == "1"){
			$.ajax({
				type: "POST",
				url: '/usuarios/ListadoUsuariosTodos2/'+$("#oficina").val()+'/'+$('#dependencia_destino').val()+'/',
				success: function(msg){
					result = msg;
					if(result != ''){
						var arr = result.split('###');
						for (var i = 0; i < arr.length; i++) {
							var hght = arr[i].split('|');
							if((arrusuariosagregados[hght[0]] == undefined || arrusuariosagregados[hght[0]] == 'undefined') && $('#nombre_destino').val() != hght[0]){
								$('#seleccion_compartir_con2').append('<label id="usuarios_idlabel'+cantidadusuariosagregados+'"></label><input type="hidden" name="usuarios_id'+cantidadusuariosagregados+'" id="usuarios_id'+cantidadusuariosagregados+'" value="N">');
								cantidadusuariosagregados++;
								$('#cantidadusuariosagregados').val(cantidadusuariosagregados);
								AddUsuario(hght[0], hght[1]);
							}	
						}
					}				
				}
			});
		}
		if($('#nombre_destino_compartir_con').val() == "4"){
			$('#seleccion_compartir_con2').html('');
			cantidadusuariosagregados = 0;
			arrusuariosagregados = [];
			arrusuariosagregados = undefined;
			arrusuariosagregados = new Array();
		}
	}

	function AddUsuario(id, nombre){
		if (id == "N") {
			$(".hideform").slideDown("fast");
		}else{
			$(".hideform").slideUp("fast");
		}
		if((arrusuariosagregados[id] == undefined || arrusuariosagregados[id] == 'undefined') && $('#nombre_destino').val() != id){
			$('#usuarios_idlabel'+(cantidadusuariosagregados-1)).html('-'+nombre+'<br>');
			$('#usuarios_id'+(cantidadusuariosagregados-1)).val(id);
			$('#seleccion_compartir_con').html('');
			arrusuariosagregados[id] = nombre;
		}else{
			alert('El usuario ya se ha seleccionado');
		}
	}

function CreateCorrespondencia(){
    $("#formgestion").submit(); 
}


</script>
<?
	if($_REQUEST['id'] != ""){
		echo '<script>GetDetailExpediente("'.$_REQUEST['id'].'", "'.$_REQUEST['cn'].'")</script>';
	}
?>