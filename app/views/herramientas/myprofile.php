<?
	global $f;
	global $c;
?>
<script type="text/javascript">
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip(); 
        $('[data-toggle="popover"]').popover()
    });
</script>

<div class="row m-t-30">
	<div class="col-md-12">
		<div class="white-box">
			<div class="row">
				<div class="col-md-2">
					<img id="profilepic" src="<?= HOMEDIR.DS.'app/plugins/thumbnails/'.$object->GetFoto_perfil() ?>" width="130px">
				</div>
				<div class="col-md-10">
					<h2>
					<?= $object->GetP_nombre()." ".$object->GetP_apellido() ?> <span class="account_name"><br>(<?= $object->GetUser_id(); ?>)</span>
					</h2>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="white-box">
			<div class="row">
				<div class="col-md-3">
					<div id="menu_list">
						<h4>Configurar Cuenta</h4>
						<ul id="navigation_menu" class="list-group">
							<li style="cursor:pointer;" id="btn_information" class="list-group-item active " onClick="LoadPage('table_data_user', 'btn_information')"  <?= $c->Ayuda('185', 'tog') ?>>Información Personal</li>
							<li style="cursor:pointer;" id="btn_password" class="list-group-item "  onClick="LoadPage('table_password_user', 'btn_password')"  <?= $c->Ayuda('186', 'tog') ?>>Cambiar Clave</li>
							<?php if ($_SESSION['tech_support'] == '1'): ?>
								<li style="cursor:pointer;" id="btn_oconfig" class="list-group-item "  onClick="LoadPage('table_config_user', 'btn_oconfig')"  <?= $c->Ayuda('186', 'tog') ?>>Otras Configuraciones</li>
							<?php endif ?>
							<?php if($_SESSION['permisos_usuarios'] == "1"){ ?>
							<li style="cursor:pointer;" id="btn_permisos" class="list-group-item "  onClick="LoadPage('table_permisos_user', 'btn_permisos')"  <?= $c->Ayuda('187', 'tog') ?>>Permisos</li>
							<li style="cursor:pointer;" id="btn_accesos" class="list-group-item "  onClick="LoadPage('table_accesos_user', 'btn_accesos')"  <?= $c->Ayuda('188', 'tog') ?>>Configurar accesos</li>
							<?php } ?>
						</ul>
					</div>
				</div>
				<div class="col-md-9">
					<div id="data_content">
						<h4 id="title_black">Informacion Personal</h4>
						<div id="body_data" style="width:100%">
							<form id="formUpdateUsuario" name="formUpdateUsuario" class="form-material">
								<input type='hidden' name='a_i' id='a_i' value='<? echo $object -> GetA_i(); ?>' />
								<table id="table_data_user" width="100%">
									<tr>
										<td height="25px;" width="190px">Nombre:</td>
										
										<td class="input_regular" id="input_p_nombre">
											<input type='text' class="form-control" name='p_nombre' id='p_nombre' maxlength='' value='<? echo $object -> Getp_nombre(); ?>' />
										</td>
									</tr>
									<tr>
										<td height="25px;" width="190px">Apellido:</td>
										
										<td class="input_regular" id="input_p_apellido"><input type='text' name='p_apellido' id='p_apellido' maxlength='' value='<? echo $object -> Getp_apellido(); ?>' class="form-control" /></td>
									</tr>
									<tr>
										<td height="25px;">Sexo</td>
										<? 
											$ar = array("h" => "Hombre", "m" => "Mujer");
										?>
										
										<td class="input_regular" id="input_sexo">
											<select name="sexo" id="sexo"  class="form-control" 
												<?
													if ($object -> Getsexo() == "h") {
														echo "<option value='h'>Hombre</option>";
														echo "<option value='m'>Mujer</option>";
													}elseif ($object -> Getsexo() == "m") {
														echo "<option value='m'>Mujer</option>";
														echo "<option value='h'>Hombre</option>";
													}else{
														echo "<option value='0'>Seleccione una Opción</option>";
														echo "<option value='h'>Hombre</option>";
														echo "<option value='m'>Mujer</option>";
													}
												?>
											</select>
										</td>
									</tr>
									<tr>
										<td height="25px;">Cédula</td>
										
										<td class="input_regular" id="input_cedula"><input type='text' name='cedula' id='cedula' maxlength='' value='<? echo $object -> Getcedula(); ?>' class="form-control" /></td>
									</tr>
									<tr style="display:none">
										<td height="25px;">Lugar de Expedición</td>
										
										<td class="input_regular" id="input_exp_cedula"><input type='text' name='exp_cedula' id='exp_cedula' maxlength='' value='<? echo $object -> Getexp_cedula(); ?>' class="form-control" /></td>
									</tr>
									<tr>
										<td height="25px;">Dirección</td>
										
										<td class="input_regular" id="input_direccion"><input type='text' name='direccion' id='direccion' maxlength='' value='<? echo $object -> Getdireccion(); ?>' class="form-control" /></td>
									</tr>
									<tr>
										<td height="25px;">Ciudad</td>
										
										<td class="input_regular" id="input_ciudad"><input type='text' name='ciudad' id='ciudad' maxlength='' value='<? echo $object -> Getciudad(); ?>' class="form-control" /></td>
									</tr>
									<tr style="display:none">
										<td height="25px;">Departamento</td>
										
										<td class="input_regular" id="input_departamento"><input type='text' name='departamento' id='departamento' maxlength='' value='<? echo $object -> Getdepartamento(); ?>' class="form-control" /></td>
									</tr>
									<tr>
										<td height="25px;">Teléfono</td>
										
										<td class="input_regular" id="input_telefono"><input type='text' name='telefono' id='telefono' maxlength='' value='<? echo $object -> Gettelefono(); ?>' class="form-control" /></td>
									</tr>
									<tr>
										<td height="25px;">Celular</td>
										
										<td class="input_regular" id="input_celular"><input type='text' onBlur="dHideField('celular')" name='celular' id='celular' maxlength='' value='<? echo $object -> Getcelular(); ?>' class="form-control" /></td>
									</tr>
									<tr>
										<td height="25px;">Correo Electrónico</td>
										
										<td class="input_regular" id="input_email"><input type='text' name='email' id='email' maxlength='' value='<? echo $object -> Getemail(); ?>' class="form-control" /></td>
									</tr>
									<tr>
										<td height="25px;">Universidad</td>
										
										<td class="input_regular" id="input_universidad"><input type='text' name='universidad' id='universidad' maxlength='' value='<? echo $object -> Getuniversidad(); ?>' class="form-control" /></td>
									</tr>
									<?php if ($_SESSION['MODULES']['demandas_en_linea'] != '1'): ?>
										
									<tr>
										<td height="25px;">Validar Fecha de Caducidad al Iniciar Sesión</td>
										<? 
											$ar = array("NO" => "NO", "SI" => "SI", "" => "NO");
										?>
										
										<td class="input_regular" id="input_t_persona">
											<select name="t_persona" id="t_persona"  class="form-control" >
												<?
													if ($object -> Gett_persona() == "SI") {
														echo "<option value='SI'>SI</option>";
														echo "<option value='NO'>NO</option>";
													}else{
														echo "<option value='NO'>NO</option>";
														echo "<option value='SI'>SI</option>";
													}
												?>
											</select>
										</td>
									</tr>
									<tr>
										<?
											$f_caducidad = explode(" ", $object->GetF_caducidad());
											$f_caducidad = $f_caducidad[0];
										?>
										<td height="25px;">Fecha de Caducidad</td>
										
										<td class="input_regular" id="input_caducidad">
											<input type='date' name='caducidad' id='caducidad' value='<? echo $f_caducidad; ?>' class="form-control" />
										</td>
									</tr>
									<?php endif ?>
									<tr style="display:none">
										<td height="25px;">Cargo</td>
										
										<td class="input_regular" id="input_t_profesional"><input type='text' name='t_profesional' id='t_profesional' maxlength='' value='<? echo $object -> Gett_profesional(); ?>' class="form-control" /></td>
									</tr>
									<tr>
										<td colspan="3" height="25px;">
											<label for="notif_usuario">Deseo recibir correos de los movimientos generados en mi cuenta</label>
											<?
												if ($object->GetNotif_usuario() == '1') {
													echo "<input type='checkbox' id='notif_usuario' name='notif_usuario' checked='checked'>";
												}else{
													echo "<input type='checkbox' id='notif_usuario' name='notif_usuario'>";
												}
											?>
										</td>
									</tr>
									<tr>
										<td colspan="3" height="25px;">
											<hr>
										</td>
									</tr>
								<?
									$seccional = new MSeccional;
									$seccional->CreateSeccional("id", $object->GetSeccional());
									$cityu = new MCity;
									$cityu->CreateCity("code", $seccional->GetCiudad());
									$dptou = new MProvince;
									$dptou->CreateProvince("code", $cityu->GetProvince());
									$area = new MAreas;
									$area->CreateAreas("id", $object->GetRegimen());
								?>
									<tr>
										<td height="25px;">Departamento</td>
										
										<td class="input_regular" id="input_dpto_oficina">
											<select id="dpto_oficina" placeholder="dpto_oficina" class="form-control">
												<option value="">Seleccione un Departamento</option>
											</select>
											<script type="text/javascript">
												setTimeout(function(){ $('#dpto_oficina').val("<?php echo $cityu->GetProvince(); ?>").change(); }, 3000);
											</script>
										</td>
									</tr>
									<tr>
										<td height="25px;">Seccional Principal</td>
										
										<td class="input_regular" id="input_ciudad_oficina">
											<select name='ciudad_oficina' id='ciudad_oficina'  class="important form-control">
							      				<option value="">Seleccione una Ciudad</option>
											</select>	
											<script type="text/javascript">
												setTimeout(function(){ $('#ciudad_oficina').val("<?php echo $cityu->GetCode(); ?>").change(); }, 4000);
											</script>
										</td>
									</tr>
									<tr>
										<td height="25px;">Oficina</td>
										
										<td class="input_regular" id="input_oficina">
											<select name='oficina' id='oficina'  class="form-control important">
												<option value="">Seleccione una Oficina</option>
											</select>	
											<script type="text/javascript">
												setTimeout(function(){ $('#oficina').val("<?php echo $seccional->GetId(); ?>").change(); }, 5000);
											</script>
										</td>
									</tr>
									<tr>
										<td height="25px;"><?= CAMPOAREADETRABAJO; ?></td>
										
										<td class="input_regular" id="input_area">
											<select id="area" placeholder="<?= CAMPOAREADETRABAJO; ?>" name='area' id='area' class="form-control important" >
												<option value="">Seleccione una Oficina</option>
												<?
													$s = new MAreas;
													$lits = $s->ListarAreas();
													while ($row = $con->FetchAssoc($lits)) {
														echo "<option value='".$row['id']."'>".$row["nombre"]."</option>";
													}
												?>
											</select>
											<script type="text/javascript">
												setTimeout(function(){ $('#area').val("<?php echo $object->GetRegimen(); ?>").change(); }, 6000);
											</script>	
										</td>
									</tr>
									<tr>
										<td height="25px;">¿Desea mover todos los expedientes a la nueva area?</td>
										
										<td class="input_regular" id="input_area">
											<select id="mover_expedientes"  name='mover_expedientes' id='mover_expedientes' class="form-control" >
												<option value="NO">Seleccione una Oficina</option>
												<option value="NO">NO</option>
												<option value="SI">SI</option>
											</select>
											
										</td>
									</tr>
								</table>
								<br>
								<table id="table_password_user"  style="display:none"  width="90%">
									<tr>
										<td height="60px">
											<label for="newpassword"> Nueva Clave:</label>
											<input type='password' name='newpassword' id='newpassword' placeholder="Escribe tu nueva contraseña" class="form-control" />
										</td>
									</tr>
									<tr>
										<td height="30px">
											&nbsp;
										</td>
									</tr>
									<tr>
										<td height="60px">
											<label for="checkpassword"> Confirmar Cave:</label>
											<input type='password' name='checkpassword' id='checkpassword' placeholder="Vuelve a escribir tu nueva contraseña" class="form-control"  />
											<input type='hidden' name='password' id='password' maxlength='' value='<? echo $object -> Getpassword(); ?>' size="50"/>
										</td>
									</tr>
								</table>
								<br>
								<table id="table_config_user" style="display:none"  width="100%">
									<tr>
										<td height="60px" colspan="3">
											<label for="newpassword"> Cambiar Clave Única ID:</label>
										</td>
									</tr>
									<tr>
										<td height="25px;" width="150px">Clave Única</td>
										
										<td class="input_regular"  width="250px" id="input_c_unica"><input type='text' onBlur="dHideField('c_unica')" name='c_unica' id='c_unica' maxlength='' value='<? echo $object -> GetId(); ?>' class="form-control" /></td>
										<td></td>
									</tr>
									<tr>
										<td height="60px" colspan="3">
											<label for="newpassword"> Configurar Servidor SMTP PRIVADO:</label>
										</td>
									</tr>
									<tr>
										<td height="25px;">SMPTH HOST</td>
										<td class="input_regular" id="input_smtp_host">
											<input type='text' onBlur="dHideField('smtp_host')" name='smtp_host' id='smtp_host' maxlength='' value='<? echo $object -> Getsmtp_host(); ?>' placeholder="smtp.gmail.com" class="form-control" />
										</td>
										<td rowspan="6">
											<div>
												<button class="btn btn-danger pull-right" id="testConnection">Probar Conexión</button>
											</div>
											<div style="height: 400px; overflow: none; overflow-y: auto; clear: both; padding: 20px">
												<small id="testConnectionOutPut"></small>
											</div>
										</td>
									</tr>
									<tr>
										<td height="25px;">SMPTH PUERTO</td>
										<td class="input_regular" id="input_smtp_puerto">
											<input type='text' onBlur="dHideField('smtp_puerto')" name='smtp_puerto' id='smtp_puerto' maxlength='' value='<? echo $object -> Getsmtp_puerto(); ?>' placeholder="465" class="form-control" />
										</td>
									</tr>
									<tr>
										<td height="25px;">SMPTH USUARIO</td>
										<td class="input_regular" id="input_smtp_user">
											<input type='text' onBlur="dHideField('smtp_user')" name='smtp_user' id='smtp_user' maxlength='' value='<? echo $object -> Getsmtp_user(); ?>' placeholder="tucorreo@gmail.com" class="form-control" />
										</td>
									</tr>
									<tr>
										<td height="25px;">SMPTH CLAVE</td>
										<td class="input_regular" id="input_smtp_pww">
											<input type='password' onBlur="dHideField('smtp_pww')" name='smtp_pww' id='smtp_pww' maxlength='' value='<? echo $object -> Getsmtp_pww(); ?>' class="form-control" />
										</td>
									</tr>
									<tr>
										<td height="25px;">SMPTH AUTH</td>
										<td class="input_regular" id="input_smtp_aut">
											<input type='text' onBlur="dHideField('smtp_aut')" name='smtp_aut' id='smtp_aut' maxlength='' value='<? echo $object -> Getsmtp_aut(); ?>' placeholder="1" class="form-control" />
										</td>
									</tr>
									<tr>
										<td height="25px;">SMPTH USAR SMTP</td>
										<td class="input_regular" id="input_smtp_es">
											<input type='text' onBlur="dHideField('smtp_es')" name='smtp_es' id='smtp_es' maxlength='' value='<? echo $object -> Getsmtp_es(); ?>' placeholder="1" class="form-control" />
										</td>
									</tr>
									<tr>
										<td height="25px;">SMPTH HELO</td>
										<td class="input_regular" id="input_smtp_helo">
											<input type='text' onBlur="dHideField('smtp_helo')" name='smtp_helo' id='smtp_helo' maxlength='' value='<? echo $object -> Getsmtp_helo(); ?>' placeholder="gmail.com" class="form-control" />
										</td>
									</tr>
									<tr>
										<td height="25px;">SMPTH CONEXIÓN</td>
										<td class="input_regular" id="input_smtp_tls">
											<input type='text' onBlur="dHideField('smtp_tls')" name='smtp_tls' id='smtp_tls' maxlength='' value='<? echo $object -> Getsmtp_tls(); ?>' placeholder="ssl" class="form-control" />
										</td>
									</tr>
								</table>
								<table id="table_permisos_user"  style="display:none"  width="90%">
									<tr>
										<td>
											<?php include_once(VIEWS.DS.'usuarios_funcionalidades'.DS.'ListarCrear.php'); ?>
										</td>
									</tr>
								</table>
								<table id="table_accesos_user"  style="display:none"  width="100%">
									<tr>
										<td>
											<?php include_once(VIEWS.DS.'usuarios_configurar_accesos'.DS.'Listar_accesos.php'); ?>
										</td>
									</tr>
								</table>
							</form>
							<br>
							<input type="button" value="Guardar Cambios"  id="updateprofile" class="btn btn-info">
						</div>
						<div id="right_bloq">
							<div id="update_field">
								&nbsp;
							</div>
						</div>
						<div class="clear"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
var TipoGuardado = 'table_data_user';
$(document).ready(function(){
				
	$("#updateprofile").click(function(){
		var vp = $("#newpassword").val()
		var np = $("#checkpassword").val();
		if (TipoGuardado == "table_password_user") {
			if(np != vp){
				$("#update_field").html("<div class='alert alert-info'>La nueva clave no coincide con la verificacion</div>");
			}else{
				if(np.length < 4){
					$("#update_field").html("<div class='alert alert-info'>La nueva clave debe tener minimo 4 caracteres</div>");
				}else{
					if($("#p_nombre").val() == ""){
						$("#update_field").html("<div class='alert alert-info'>Debes escribir un nombre</div>");
						return false;
					}if($("#p_apellido").val() == ""){
						$("#update_field").html("<div class='alert alert-info'>Debes escribir un nombre apellido</div>");
						return false;
					}
					if($("#email").val() == ""){
						$("#update_field").html("<div class='alert alert-info'>El campo E-Mail es obligatorio</div>");
						return false;
					}else{
						var str = $("#formUpdateUsuario").serialize();
						$.ajax({
							type: "POST",
							url: "/herramientas/actualizarperfil/",
							data: str,
							success:function(msg){
								result = msg;
								alert(msg);
								//$("#update_field").html("<div class='alert alert-info'>"+result+"</div>");
							}
						});
					}
				}
			}
		}else if (TipoGuardado == "table_data_user"){
			if($("#p_nombre").val() == ""){
				$("#update_field").html("<div class='alert alert-info'>Debes escribir un nombre</div>");
				return false;
			}if($("#p_apellido").val() == ""){
				$("#update_field").html("<div class='alert alert-info'>Debes escribir un nombre apellido</div>");
				return false;
			}
			if($("#email").val() == ""){
				$("#update_field").html("<div class='alert alert-info'>El campo E-Mail es obligatorio</div>");
				return false;
			}else{
				var str = $("#formUpdateUsuario").serialize();
				$.ajax({
					type: "POST",
					url: "/herramientas/actualizarperfil/",
					data: str,
					success:function(msg){
						result = msg;
						alert(msg);
						//$("#update_field").html("<div class='alert alert-info'>"+result+"</div>");
					}
				});
			}
		} else if (TipoGuardado == "table_config_user"){
			if($("#p_nombre").val() == ""){
				$("#update_field").html("<div class='alert alert-info'>Debes escribir un nombre</div>");
				return false;
			}if($("#p_apellido").val() == ""){
				$("#update_field").html("<div class='alert alert-info'>Debes escribir un nombre apellido</div>");
				return false;
			}
			if($("#email").val() == ""){
				$("#update_field").html("<div class='alert alert-info'>El campo E-Mail es obligatorio</div>");
				return false;
			}else{
				var str = $("#formUpdateUsuario").serialize();
				$.ajax({
					type: "POST",
					url: "/herramientas/actualizarperfil/",
					data: str,
					success:function(msg){
						result = msg;
						alert(msg);
						//$("#update_field").html("<div class='alert alert-info'>"+result+"</div>");
					}
				});
			}
		} else if (TipoGuardado == "table_permisos_user"){
			var str = $("#formUpdateUsuario").serialize();
			$.ajax({
				type: "POST",
				url: "/usuarios_funcionalidades/actualizarPermisos/",
				data: str,
				success:function(msg){
					result = msg;
					alert(msg);
					//$("#update_field").html("<div class='alert alert-info'>"+result+"</div>");
				}
			});
		} if (TipoGuardado == "table_accesos_user"){
			var str = $("#formUpdateUsuario").serialize();
			$.ajax({
				type: "POST",
				url: "/usuarios_configurar_accesos/actualizarConfigurarAccesos/",
				data: str,
				success:function(msg){
					result = msg;
					alert(msg);
					//$("#update_field").html("<div class='alert alert-info'>"+result+"</div>");
				}
			});
		}else{
			return false;
		}
			
	})


	$("#testConnection").click(function(){
		$("#testConnectionOutPut").html("Probando la conexión...");
		$.ajax({
			type: "POST",
			url: "/dashboard/pruebacorreos/<?= $object->GetUser_id() ?>/",
			success:function(msg){
				result = msg;
				$("#testConnectionOutPut").html(result);
			}
		});	
		return false;
	})
	
});
</script>
<script>
	function LoadPage(id, selector){
		$("#navigation_menu > li").removeClass('active');
		$("#"+selector).addClass('active');
		$('#updateprofile').show()
		TipoGuardado = id;
		switch (id) {
			case "table_data_user":
				
				$("#table_password_user").slideUp("fast");
				$("#table_permisos_user").slideUp("fast");
				$("#table_data_user").slideDown("slow");
				$("#table_accesos_user").slideUp("fast");
				$("#table_config_user").slideUp("slow");
				$("#title_black").html("Información personal");
				break;
			case "table_password_user":
				
				$("#table_password_user").slideDown("slow");
				$("#table_permisos_user").slideUp("fast");
				$("#table_data_user").slideUp("fast");
				$("#table_accesos_user").slideUp("fast");
				$("#table_config_user").slideUp("slow");
				$("#title_black").html("Cambiar la clave");
				break;
			case "table_permisos_user":
				
				$('#updateprofile').hide();
				$("#table_password_user").slideUp("fast");
				$("#table_permisos_user").slideDown("slow");
				$("#table_data_user").slideUp("fast");
				$("#table_accesos_user").slideUp("fast");
				$("#table_config_user").slideUp("slow");
				$("#title_black").html("Permisos del usuario <?= $object->GetP_nombre()." ".$object->GetP_apellido() ?>");
				break;
			case "table_accesos_user":
				
				$("#table_password_user").slideUp("fast");
				$("#table_permisos_user").slideUp("fast");
				$("#table_data_user").slideUp("fast");
				$("#table_accesos_user").slideDown("slow");
				$("#table_config_user").slideUp("slow");
				$("#title_black").html("Configurar accesos del usuario  <?= $object->GetP_nombre()." ".$object->GetP_apellido() ?>");
				$('#updateprofile').hide();
				break;
			case "table_config_user":
				$("#table_password_user").slideUp("fast");
				$("#table_permisos_user").slideUp("fast");
				$("#table_data_user").slideUp("fast");
				$("#table_accesos_user").slideUp("fast");
				$("#table_config_user").slideDown("slow");
				$("#title_black").html("Configuraciones Generales");
				break;				
			default:
				
				$("#table_password_user").slideUp("fast");
				$("#table_permisos_user").slideUp("fast");
				$("#table_data_user").slideDown("slow");
				$("#table_accesos_user").slideUp("fast");
				$("#table_config_user").slideUp("slow");
				$("#title_black").html("Información personal");
				break;
		}
	} 
</script>
<script>
$(document).ready(function(){
	dependencia_estadoinExistence('dpto_oficina');
	$("#dpto_oficina").change(function(){
		dependencia_ciudadinExistence("dpto_oficina","ciudad_oficina");
	});
	$("#ciudad_oficina").change(function(){
		dependencia_item("ciudad_oficina","oficina", "/seccional/listadooficinasseccional");
		//$("#num_oficio_respuesta").val(zeroFill($("#ciudad_oficina").val(), 3));
	});
});
</script>