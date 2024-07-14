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
<form action="/usuarios/upload_logo/r/logo_correos/" id="formpicturelogo_correos" method="post" enctype="multipart/form-data">
    <div style="display:none">
        <input name="archivo" id="selfile_logo_correos" type="file" size="35"/>
    </div>
	</form>
<div class="row m-t-30">
    <div class="col-md-4 col-xs-12">
        <div class="white-box">
            <div class="user-bg"> <img width="100%" alt="user" src="<?= HOMEDIR.DS ?>app/plugins/theme/plugins/images/large/IMG14.jpg">
                <div class="overlay-box">
                    <div class="user-content">
                        <a href="javascript:void(0)"><img src="<?= HOMEDIR.DS.'app/plugins/thumbnails/'.$object->GetFoto_perfil() ?>" id="profilepic"  class="thumb-lg img-circle" alt="img"></a>
                        <h4 class="text-white"><?= $object->GetP_nombre()." ".$object->GetP_apellido() ?></h4>
                        <h5 class="text-white"><?= $_SESSION["usuario"]; ?></h5> </div>
                </div>
            </div> 
        </div>
    </div>
    <div class="col-md-8 col-xs-12">
        <div class="white-box">
            <ul class="nav nav-tabs tabs customtab">
                <li class="active tab">
                    <a href="#settings" data-toggle="tab" aria-expanded="false"> <span class="visible-xs"><i class="fa fa-cog"></i></span> <span class="hidden-xs">Información Personal</span> </a>
                </li>
                <li class="tab">
                    <a href="#home" data-toggle="tab"> <span class="visible-xs"><i class="fa fa-home"></i></span> <span class="hidden-xs">Cambiar Clave</span> </a>
                </li>
                <?
                if($_SESSION['usuariosuscriptor'] == "0"){
                ?>
                <li class="tab">
                    <a href="#profile" data-toggle="tab"> <span class="visible-xs"><i class="fa fa-user"></i></span> <span class="hidden-xs">Firma Digital</span> </a>
                </li>
                <?
            	}
                ?>
            </ul>
            <form id="formUpdateUsuario" name="formUpdateUsuario" class="form-horizontal form-material" >
		        <div class="tab-content">
		        	<div class="tab-pane" id="profile">
	                    <div class="row">
	                    	<div class="col-md-12">
							<? 
							$firma_img=$con->Result($con->Query("SELECT * from usuarios where user_id = '$_SESSION[usuario]' and estado = '1'"),0,'firma');
							?>

	                    		<div class="row">
	                    			<div class="col-md-6">
										<div id="img-firma">
											<h2>Firma Digitalizada Actual</h2>
											<div class="jumbotron">
												<img id="firma_img" class="imtochange" src="<?=HOMEDIR?>/app/plugins/thumbnails/<?=$firma_img?>">
											</div>
											<input type="button" value="Cambiar Firma" id="view_signatures" class="btn btn-info">
										</div>
	                    			</div>
	                    			<div class="col-md-6">
										<div class="btn btn-warning m-b-20" id='uploadfirma' >
											<div class="biggerfont">
												Cargar Firma Desde Archivo...
											</div>
										</div>
										<input type="text" class="form-control" id="mytextsignature" placeholder="o Introducir Texto Personalizado">
										<div style="height: 300px; overflow: hidden; overflow-y: auto">
											
										<?
											$o = new MFuentes;
											$query = $o->ListarFuentes(" WHERE estado = '1'");
											while($row = $con->FetchAssoc($query)){
												$l = new MFuentes;
												$l->Createfuentes('id', $row[id]);
										?>			
											<style type="text/css">
											@font-face{
											   font-family: "<?= $l -> GetNombre() ?>";
											   src: url(<?= HOMEDIR ?>/app/views/assets/fonts/<?= $l -> GetUrl() ?>);
											}
											.show_font_<?= $l->GetId() ?>{
												font-family: "<?= $l -> GetNombre() ?>";
												font-size: 25px;
												clear: both;
												margin-top: 10px;
											}
											</style>	
											<div class="bloque_fuente" style="cursor:pointer" id='r<?= $l->GetId() ?>' onClick="CambiarFirma('<?= $l->GetId() ?>')">
												<div class="texttoshowinfont show_font_<?= $l->GetId() ?>">
													<?= $object->GetP_nombre()." ".$object->GetP_apellido() ?>
												</div>
											</div>
										<?
											}
										?>		
										</div>
	                    			</div>
	                    		</div>
									                        	


	                        </div>
	                        <div class="col-md-12"> 
	                        	<div class="row">
	                        		<div class="col-md-12"> 
								<?php
								$base_file = $con->Result($con->Query("select base_file from usuarios where user_id = '".$_SESSION['usuario']."'"), 0,'base_file');
								$clave_firma = $con->Result($con->Query("select clave_firma from usuarios where user_id = '".$_SESSION['usuario']."'"), 0,'clave_firma');
								if($base_file == ""){
								?>
									<div class="subtitle_password">Firma Digital(<?php echo $clave_firma; ?>) </div>
									<br>
									<div>No ha ingresado la Firma Digital por favor suba el archivo. Este proceso se realizara una vez.</div>
									<br>
									<input class="form-control" type="text" name="clave_firma" id="clave_firma" placeholder="Clave Firma Digital" />

									<input onchange="fnvalidar();" type='button' id="upload_firma" name="upload_firma" value='Subir Firma Digital' />
									<br>
									<script language="javascript" type="text/javascript" src="<?= ASSETS.DS ?>js/AjaxUpload.2.0.min.js"></script>
									<script type="text/javascript">
										var button = $('#upload_firma'), interval;
										new AjaxUpload('#upload_firma', {
									        action: '/usuarios/importar_firma/',
											onSubmit : function(file , ext){
												this.setData({clave_firma: $('#clave_firma').val()});
												if (! (ext && /^(crt)$/.test(ext))){
													// extensiones permitidas
													alert('Error: Solo se permiten archivos crt');
													// cancela upload
													return false;
												} else {
													//this.disable();
												}
											},
											onComplete: function(file, response){
												if(response == "error"){
													alert('Ingrese la clave de la Firma Digital');
												}else{
													alert(response);
												//alert('Firma Digital Cargada');
													document.location.reload(true);
												}
											}
										});
									function fnvalidar(){
										alert('ddd');
									}
									</script>
								<?php 
								}else{
									echo '<h2 class="text-muted">Firma Digital ('.$clave_firma.') </h2>';
									$datos = explode('-----', $base_file);
									echo "<div>$datos[2]</div>";
								}
								?>
									
								<h2 class="m-t-30">Configurar Firma Digital</h2>
									<?php
									$MUsuarios_configurar_firma_digital->CreateUsuarios_configurar_firma_digital('user_id', $_SESSION["usuario"]);
									$option = '
									<option value="">Seleccionar</option>
									<option value="nombre_usuario_firma">Nombre Usuario</option>
									<option value="profesional_firma">Cargo</option>
									<option value="nombre_area">Area</option>
									<option value="celular_firma">Telefono</option>
									<option value="email_firma">Email</option>';
									?>
									

									<div class="form-group">
										<label class="col-md-12">Campo 1:</label>
										<div class="col-md-12">
											<select id="campo1" class="form-control form-control-line" name="campo1"><?php echo $option; ?></select>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-12">Campo 2:</label>
										<div class="col-md-12">
											<select id="campo2" class="form-control form-control-line" name="campo2"><?php echo $option; ?></select>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-12">Campo 3:</label>
										<div class="col-md-12">
											<select id="campo3" class="form-control form-control-line" name="campo3"><?php echo $option; ?></select>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-12">Campo 4:</label>
										<div class="col-md-12">
											<select id="campo4" class="form-control form-control-line" name="campo4"><?php echo $option; ?></select>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-12">Campo 5:</label>
										<div class="col-md-12">
											<select id="campo5" class="form-control form-control-line" name="campo5"><?php echo $option; ?></select>
										</div>
									</div>
									<div class="form-group">
										<button type="button" class="btn btn-primary" id="ActualizarConfiguracionFirmaDigital">Actualizar Configuración Firma Digital</button>
									</div>
									</div>
								</div>
	                        </div>
							<script type="text/javascript">
								$('#campo1').val('<?php echo $MUsuarios_configurar_firma_digital->GetCampo1(); ?>');
								$('#campo2').val('<?php echo $MUsuarios_configurar_firma_digital->GetCampo2(); ?>');
								$('#campo3').val('<?php echo $MUsuarios_configurar_firma_digital->GetCampo3(); ?>');
								$('#campo4').val('<?php echo $MUsuarios_configurar_firma_digital->GetCampo4(); ?>');
								$('#campo5').val('<?php echo $MUsuarios_configurar_firma_digital->GetCampo5(); ?>');
							</script>
	                    </div>
	                </div>
	                <div class="tab-pane" id="home">
	                    <div class="row">
	                        <div class="col-md-12">
		                        <div class="form-group dn">
		                            <label class="col-md-12">Clave Actual</label>
		                            <div class="col-md-12">
		                                <input type='password' name='password' id='password' value='<? echo $object->Getpassword(); ?>' class="form-control form-control-line"/>
		                            </div>
		                        </div>
		                        <div class="form-group">
		                            <label class="col-md-12">Nueva Clave</label>
		                            <div class="col-md-12">
		                                <input autocomplete="off" type='password' name='newpassword' id='newpassword' placeholder="Escribe tu nueva contraseña" class="form-control form-control-line">
		                            </div>
		                            <div class="col-md-12"><div id="passstrength" class="m-t-10 b"></div></div>
		                            <div id="pswd_info">
									    <h4>La Clave debe contener las siguientes caracteristicas:</h4>
									    <ul>
									        <li id="length" class="mdi mdi-close text-danger">Minimo <strong>8 caracteres</strong></li>
									        <li id="letter" class="mdi mdi-close text-danger">Minimo <strong>1 Letra Minuscula</strong></li>
									        <li id="capital" class="mdi mdi-close text-danger">Minimo <strong>1 Letra Mayuscula</strong></li>
									        <li id="number" class="mdi mdi-close text-danger">Minimo <strong>1 N&uacute;mero</strong></li>
									        <li id="special" class="mdi mdi-close text-danger">Minimo <strong>2 caractéres Especiales </strong><br><small style="padding-left: 65px;">(@ # $ % & / ( ) = ? ¿ ¡ * - _ . ,)</small></li>
									    </ul>
									</div>
		                        </div>
		                        <div class="form-group">
		                            <label class="col-md-12">Confirmar Clave</label>
		                            <div class="col-md-12">
		                                <input autocomplete="off" type='password' name='checkpassword' id='checkpassword' placeholder="Vuelve a escribir tu nueva contraseña" class="form-control form-control-line">
		                            </div>
		                            <div class="col-md-12"><div id="viewpasswordchanged" class="m-t-10 b"></div></div>
		                        </div>
								<div class="form-group">
		                            <div class="col-sm-12">
		                        		<button type="button" class="btn btn-info" id="updateprofile">Cambiar Clave</button>
		                            </div>
		                        </div>
	                        </div>
	                    </div>
	                </div>
	                <div class="tab-pane active" id="settings">
	                	<div class="row">
							<div class="form-group col-md-6">
								<label class="col-md-12">Nombre:</label>
								<div class="col-md-12">
									<input type='text' class="form-control form-control-line" name='p_nombre' id='p_nombre' maxlength='' value='<? echo $object -> Getp_nombre(); ?>' />
								</div>
							</div>
							<div class="form-group col-md-6">
								<label class="col-md-12">Apellido:</label>
								<div class="col-md-12">
									<input type='text' class="form-control form-control-line" name='p_apellido' id='p_apellido' maxlength='' value='<? echo $object -> Getp_apellido(); ?>'  />
								</div>
							</div>
							<div class="form-group  col-md-12">
								<label class="col-md-12">Sexo:</label>
								<div class="col-md-12">
									<select name="sexo" id="sexo"   class="form-control form-control-line">
										<?
											$ar = array("h" => "Hombre", "m" => "Mujer");
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
								</div>
							</div>
							<div class="form-group col-md-6">
								<label class="col-md-12">Cédula:</label>
								<div class="col-md-12">
									<input type='text' class="form-control form-control-line" name='cedula' id='cedula' maxlength='' value='<? echo $object -> Getcedula(); ?>'  />
								</div>
							</div>
							<div class="form-group col-md-6">
								<label class="col-md-12">Lugar de Expedición:</label>
								<div class="col-md-12">
									<input type='text' class="form-control form-control-line" name='exp_cedula' id='exp_cedula' maxlength='' value='<? echo $object -> Getexp_cedula(); ?>'  />
								</div>
							</div>
							<div class="form-group col-md-4">
								<label class="col-md-12">Dirección:</label>
								<div class="col-md-12">
									<input type='text' class="form-control form-control-line" name='direccion' id='direccion' maxlength='' value='<? echo $object -> Getdireccion(); ?>'  />
								</div>
							</div>
							<div class="form-group col-md-4">
								<label class="col-md-12">Ciudad:</label>
								<div class="col-md-12">
									<input type='text' class="form-control form-control-line" name='ciudad' id='ciudad' maxlength='' value='<? echo $object -> Getciudad(); ?>'  />
								</div>
							</div>
							<div class="form-group col-md-4">
								<label class="col-md-12">Departamento:</label>
								<div class="col-md-12">
									<input type='text' class="form-control form-control-line" name='departamento' id='departamento' maxlength='' value='<? echo $object -> Getdepartamento(); ?>'  />
								</div>
							</div>
							<div class="form-group col-md-4">
								<label class="col-md-12">Teléfono:</label>
								<div class="col-md-12">
									<input type='text' class="form-control form-control-line" name='telefono' id='telefono' maxlength='' value='<? echo $object -> Gettelefono(); ?>'  />
								</div>
							</div>
							<div class="form-group col-md-4">
								<label class="col-md-12">Celular:</label>
								<div class="col-md-12">
									<input type='text' class="form-control form-control-line" name='celular' id='celular' maxlength='' value='<? echo $object -> Getcelular(); ?>'  />
								</div>
							</div>
							<div class="form-group col-md-4">
								<label class="col-md-12">Correo Electrónico:</label>
								<div class="col-md-12">
									<input type='text' autocomplete="off" class="form-control form-control-line" name='direccion_de_correo' id='direccion_de_correo' maxlength='' value='<? echo $object -> Getemail(); ?>'  />
								</div>
							</div>
							<div class="form-group col-md-6">
								<label class="col-md-12">Tarjeta Profesional:</label>
								<div class="col-md-12">
									<input type='text' class="form-control form-control-line" name='universidad' id='universidad' maxlength='' value='<? echo $object -> Getuniversidad(); ?>'  />
								</div>
							</div>
							<div class="form-group col-md-6">
								<label class="col-md-12">Cargo:</label>
								<div class="col-md-12">
									<input type='text' class="form-control form-control-line" name='t_profesional' id='t_profesional' maxlength='' value='<? echo $object -> Gett_profesional(); ?>'  />
								</div>
							</div>
							<?
							if($_SESSION['usuariosuscriptor'] == "0"){
							?>
							<div class="form-group col-md-12">
                    			<h4>Logo del Courrier de Correos Electrónicos</h4>	
								<div class="photo_encabezado">
								<?
								    $admin = new MSuper_admin;
								    $admin->CreateSuper_admin("id", "6");

							     	$logo_correos = ROOT.DS.'plugins/thumbnails/'.$object->Getlogo_correos();
							    	$exists = file_exists( $logo_correos );
							    	if ($object->Getlogo_correos() == "") {
							    		$logo_correos = HOMEDIR.DS.'app/plugins/thumbnails/'.$admin->GetFoto_perfil();
							    	}else{
							    		$logo_correos = HOMEDIR.DS.'app/plugins/thumbnails/'.$object->Getlogo_correos();
							    	}
							    #	echo $logo_correos;
								?>
									<img id="ppic_logo_correos"  class="imtochange" src="<?= $logo_correos  ?>" alt="" style="width:140px; height: 40px; cursor: pointer">
								</div>
								<div class="leyenda m-t-20">
									Se recomienda que la imagen esté en formato .png o .jpg y maneje una resolución
										no mayor y proporcional a 140 x 40 pixeles
								</div>
								<script>
									$("#ppic_logo_correos").click(function() {
										$("#selfile_logo_correos").click();
									});

									$("#selfile_logo_correos").change(function() {
										//alert("hola!");
										$("#formpicturelogo_correos").submit();
									});
								</script>
							</div>
							<?
						}
							?>
							<div class="form-group col-md-12 dn">
								<div class="col-md-1">
								<?
									if ($object->GetNotif_usuario() == '1') {
										echo "<input type='checkbox' class='form-control' id='notif_usuario' name='notif_usuario' checked='checked'>";
									}else{
										echo "<input type='checkbox' class='form-control' id='notif_usuario' name='notif_usuario'>";
									}
								?>
								</div>
								<label class="control-label col-md-11" style="text-align: left">Deseo Recibir Diariamente un Correo con las novedades de mi cuenta</label>
							</div>

							<div class="form-group col-md-12 dn">
								<div class="col-md-1">
								<?
									if ($object->GetNotif_admin() == '1') {
										echo "<input type='checkbox' class='form-control' id='notif_admin' name='notif_admin' checked='checked'>";
									}else{
										echo "<input type='checkbox' class='form-control' id='notif_admin' name='notif_admin'>";
									}
								?>
								</div>
								<label class="control-label col-md-11" style="text-align: left">Deseo Que el sistema me genere alertas de actividad en mi Area de trabajo (Solo Activo para Jefes de Area)</label>
							</div>

<?
						if($_SESSION['permisos_usuarios'] == "1"){
?>
							<div class="form-group col-md-12">
								<div class="col-md-1">
								<?
									if ($object->GetCorreos() == '1') {
										echo "<input type='checkbox' class='form-control' id='correos' name='correos' checked='checked'>";
									}else{
										echo "<input type='checkbox' class='form-control' id='correos' name='correos'>";
									}
								?>
								</div>
								<label class="control-label col-md-11" style="text-align: left">Deseo recibir un correo cada vez que se realicen expedientes nuevos</label>
							</div>
<?
						}
?>
		                        <div class="col-sm-12">
		                        	<div class="form-group">
		                                <button type="button" class="btn btn-info" id="UpdateProfileUser">Actualizar Perfil</button>
		                            </div>

		                            <div id="update_field"></div>
		                        </div>
	                        </div>
						</div>
	                </div>
	        	</div>
            </form>
        </div>
    </div>
</div>
<script>
$(document).ready(function(){

	$('#newpassword').keyup(function(e) {
		var strongRegex = new RegExp("^(?=.{8,})(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[A-Z]).*$", "g");
		var mediumRegex = new RegExp("^(?=.{7,})(((?=.*[A-Z])(?=.*[a-z]))|((?=.*[A-Z])(?=.*[0-9]))|((?=.*[a-z])(?=.*[0-9]))).*$", "g");
		var enoughRegex = new RegExp("(?=.{6,}).*", "g");

		var pswd = $(this).val();

	    if ( pswd.length < 8 ) {
		    $('#length').removeClass('text-success').addClass('text-error').removeClass('mdi-check').addClass("mdi-close");
		} else {
		    $('#length').removeClass('text-error').addClass('text-success').removeClass('mdi-close').addClass("mdi-check");
		}

		if ( pswd.match(/[a-z]/) ) {
		    $('#letter').removeClass('text-error').addClass('text-success').removeClass('mdi-close').addClass("mdi-check");
		} else {
		    $('#letter').removeClass('text-success').addClass('text-error').removeClass('mdi-check').addClass("mdi-close");
		}

		//validate capital letter
		if ( pswd.match(/[A-Z]/) ) {
		    $('#capital').removeClass('text-error').addClass('text-success').removeClass('mdi-close').addClass("mdi-check");
		} else {
		    $('#capital').removeClass('text-success').addClass('text-error').removeClass('mdi-check').addClass("mdi-close");
		}

		//val special char
		const specialRegex = /[@#$%&/()=?¿¡*-_.,]{2}/i;
		//validate specialchar
		if ( specialRegex.test(pswd)) {
		    $('#special').removeClass('text-error').addClass('text-success').removeClass('mdi-close').addClass("mdi-check");
		} else {
		    $('#special').removeClass('text-success').addClass('text-error').removeClass('mdi-check').addClass("mdi-close");
		}

		//validate number
		if ( pswd.match(/\d/) ) {
		    $('#number').removeClass('text-error').addClass('text-success').removeClass('mdi-close').addClass("mdi-check");
		} else {
		    $('#number').removeClass('text-success').addClass('text-error').removeClass('mdi-check').addClass("mdi-close");
		}


	     if (false == enoughRegex.test($(this).val())) {
	            $('#passstrength').addClass('text-danger');
	            $('#passstrength').removeClass('text-success');
	            $('#passstrength').removeClass('text-warning');
	            $('#passstrength').html('<b>La Clave no es lo Suficientemente Larga</b>');

	     } else if (strongRegex.test($(this).val())) {
	            $('#passstrength').removeClass('text-danger');
	            $('#passstrength').removeClass('text-warning');
	            $('#passstrength').addClass('text-success');
	            $('#passstrength').html('<b>La clave nueva es muy Segura</b>');
	     } else if (mediumRegex.test($(this).val())) {
	            $('#passstrength').addClass('text-warning');
	            $('#passstrength').removeClass('text-success');
	            $('#passstrength').removeClass('text-error');
	            $('#passstrength').html('<b>La clave nueva tiene una seguridad Media!</b>');
	     } else {
	            $('#passstrength').addClass('text-danger');
	            $('#passstrength').removeClass('text-success');
	            $('#passstrength').removeClass('text-warning');
	            $('#passstrength').html('<b>La Clave nueva es Muy Debil!</b>');
	     }
	     return true;

	}).focus(function() {
	    $('#pswd_info').show();
	}).blur(function() {
	    $('#pswd_info').hide();
	});

	$("#checkpassword").keyup(function(event) {
		if($('#newpassword').val() != $("#checkpassword").val()){
			$("#viewpasswordchanged").html("<div class='text-danger'><b>La nueva clave no coincide con la clave de verificacion</b></div>");
		}else{
			$("#viewpasswordchanged").html("");
		}
	});

	$('input').attr('autocomplete','off');
	
	$("#view_signatures").click(function(){
		$("#ListSignatures").slideDown();
	})

	$("#mytextsignature").keyup(function(){
		var x = "<?= $object->GetP_nombre()." ".$object->GetP_apellido() ?>";

		if ($(this).val() == "") {
			$(".texttoshowinfont").html(x);
		}else{
			$(".texttoshowinfont").html($(this).val());
		}
	})  
	$("#ActualizarConfiguracionFirmaDigital").click(function(){
		var str = $("#formUpdateUsuario").serialize();
		$.ajax({
			type: "POST",
			url: "/usuarios_configurar_firma_digital/actualizar/",
			data: str,
			success:function(msg){
				result = msg;
				Alert2(msg);
				//$("#update_field").html("<div class='alert alert-info'>"+result+"</div>");
			}
		});
	});
	$("#UpdateProfileUser").click(function(){
		$("#updateprofile").click();
	});
	$("#updateprofile").click(function(){

		var vp = $("#newpassword").val()
		var np = $("#checkpassword").val();
		$("#update_field").html("");
		if (vp != "") {
			if(np != vp){
				$("#viewpasswordchanged").html("<div class='text-danger'><b>La nueva clave no coincide con la clave de verificacion</b></div>");
			}else{
				if(np.length < 4){
					$("#viewpasswordchanged").html("<div class='text-danger'><b>La nueva clave debe tener minimo 4 caracteres</b></div>");
				}else{
					if($("#p_nombre").val() == ""){
						$("#update_field").html("<div class='alert alert-info'>Debes escribir un nombre</div>");
						return false;
					}if($("#p_apellido").val() == ""){
						$("#update_field").html("<div class='alert alert-info'>Debes escribir un nombre apellido</div>");
						return false;
					}
					if($("#direccion_de_correo").val() == ""){
						$("#update_field").html("<div class='alert alert-info'>El campo E-Mail es obligatorio</div>");
						return false;
					}else{
						var str = $("#formUpdateUsuario").serialize();
						$.ajax({
							type: "POST",
							url: "/dashboard/actualizarperfil/",
							data: str,
							success:function(msg){
								result = msg;
								Alert2(msg);
								//$("#update_field").html("<div class='alert alert-info'>"+result+"</div>");
							}
						});
					}
				}
			}
		}else{
			if($("#p_nombre").val() == ""){
				$("#update_field").html("<div class='alert alert-info'>Debes escribir un nombre</div>");
				return false;
			}if($("#p_apellido").val() == ""){
				$("#update_field").html("<div class='alert alert-info'>Debes escribir un nombre apellido</div>");
				return false;
			}
			if($("#direccion_de_correo").val() == ""){
				$("#update_field").html("<div class='alert alert-info'>El campo E-Mail es obligatorio</div>");
				return false;
			}else{
				var str = $("#formUpdateUsuario").serialize();
				$.ajax({
					type: "POST",
					url: "/dashboard/actualizarperfil/",
					data: str,
					success:function(msg){
						result = msg;
						Alert2(msg);
						//$("#update_field").html("<div class='alert alert-info'>"+result+"</div>");
					}
				});
			}
		}
	})


	$("#profilepic").click(function() {
                           alert("hola");
		$("#selfppic").click();
	});
	$("#selfppic").change(function() {
		$("#formppic").submit();
	});
	
	$("#newpassword").val("");
	$("#checkpassword").val("");

});

</script>
<script>
	function ShowField(id){

		$("#text_"+id).css("display", "none");
		$("#input_"+id).css("display", "block");
		$("#"+id).focus();
	}
	function HideField(id){

		$("#text_"+id).css("display", "block");
		$("#input_"+id).css("display", "none");
	}
	function LoadPage(id, selector){

		$("#navigation_menu > li").removeClass('active');
		$("#"+selector).addClass('active');
		$('#updateprofile').show();
		if (id == "table_data_user") {

			$("#table_password_user").slideUp("fast");
			$("#table_data_user").slideDown("slow");
			$("#table_firma_digital").slideUp("fast");
			$("#title_black").html("Información personal");
		}
		if (id == "table_password_user"){
			$("#table_data_user").slideUp("fast");
			$("#table_password_user").slideDown("slow");
			$("#table_firma_digital").slideUp("fast");
			$("#title_black").html("Cambiar la clave");
		}
		if (id == "table_firma_digital"){
			$('#updateprofile').hide();
			$("#table_data_user").slideUp("fast");
			$("#table_password_user").slideUp("fast");
			$("#table_firma_digital").slideDown("slow");
			$("#title_black").html("Firma Digital");
		}
	} 

	function CambiarFirma(idf){

		var x = "<?= $object->GetP_nombre()."+".$object->GetP_apellido() ?>";
		cn = "";
		if ($("#mytextsignature").val() == "") {
			cn = x;
		}else{
			cn = $("#mytextsignature").val();
			cn = cn.replaceAll(" ", '+');
		}
		var URL = "/usuarios/upload/"+idf+"/"+cn+"/";
		$.ajax({
			type: "POST",
			url: URL,
			success:function(msg){
				result = msg;
				window.location.reload();
			}
		});
	}
</script>
<form action="<?= HOMEDIR; ?>/usuarios/changedisplay/" id="formppic" method="post" enctype="multipart/form-data">
	<div style="display:none">
	<input name="archivo" id="selfppic" type="file" size="35"/>
	</div>
</form>
<form action="<?= HOMEDIR; ?>/usuarios/uploadfirma/" id="formfirma" method="post" enctype="multipart/form-data">
    <div style="display:none">
        <input name="archivo" id="selfilef" type="file" size="35"/>
    </div>
</form>
<script>
	$("#uploadfirma").click(function() {
		$("#selfilef").click();
	});
	$("#selfilef").change(function() {
		$("#formfirma").submit();
	});
</script>