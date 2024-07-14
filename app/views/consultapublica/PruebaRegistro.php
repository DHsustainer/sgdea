<?
	global $c;
  	$sadmin = new MSuper_admin;
    $sadmin->CreateSuper_admin("id", "6");
    $uri = "";
    if ($sadmin->GetFoto_perfil() == "") {
      	$uri = HOMEDIR.DS."app/views/assets/images/logo_expedientes2.png";
    }else{
    	$uri = HOMEDIR.DS.'app/plugins/thumbnails/'.$sadmin->GetFoto_perfil();
    }

    $MPlantillas_email = new MPlantillas_email;
	$MPlantillas_email->CreatePlantillas_email('id', '66');
	$contenido_email = $MPlantillas_email->GetContenido();
?>
<div class="row bg-title">
    <div class="col-lg-12 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title">FORMATO DE REGISTRO DEL <?= PROJECTNAME ?></h4> </div>
</div>
<div class="row">
	<div class="col-md-12 panel">
	 	<div class="white-panel">
	 		<div class="row p-30">
	 			<div class="col-md-12">
<?php
					include(VIEWS.DS.'consultapublica/RegistroExitoso.php');
	
/*
	if ($email != "") {
		# code...

		switch ($registrar) {
			case '1':

				$fvencimiento = "2099-12-31";
				$seccional = "31";
				$email_contacto = "";
				$area = "38";

				$sec = $con->Query("select id from seccional where direccion = '".$seccional_siamm."'");
				$secf = $con->FetchAssoc($sec);
				
				if($secf['id'] != ""){
				    $seccional = $secf['id'];
				}else{
				    $seccional = "31";
				}

#1 Cobros Mensuales
#2 Cobro por Recarga
#0 Ilimitado


				if ($_SESSION['MODULES']['configuracion_pagos'] == "1"){
					
					$cupo = 0;
					
					$fecha = date("Y-m-d");
					$fecha_c = date_create($fecha);//aca le pasas la fecha actual o ala que le queres sumar los dias.
					date_modify($fecha_c, "+".CUPOUSUARIONUEVO." day");//sumas los dias que te hacen falta.
					$fvencimiento = date_format($fecha_c, "Y-m-d");//retornas la fecha en el formato que mas te guste.

				}elseif($_SESSION['MODULES']['configuracion_pagos'] == "2"){
					
					$fvencimiento = "2099-12-31";
	    			$cupo = CUPOUSUARIONUEVO;

				}else{
					
					$fvencimiento = "2099-12-31";
					$cupo = 0;

				}

				$con->Query("INSERT into usuarios (id, user_id, p_nombre, s_nombre, p_apellido, s_apellido, password, direccion, telefono, email, ciudad, t_profesional, universidad,  cedula, celular, departamento, id_empresa, isAdministrador, t_cuenta, seccional, regimen, estado, f_caducidad, t_persona, procesos, seccional_siamm, freemium, f_registro, cupo, cupo_usuario	)
					values ('$identificacion','".strtolower($email)."','$p_nombre','','$p_apellido','','".md5($identificacion)."', '$direccion','$celular','$email', '$ciudad', '', '$tp','$identificacion','$celular','', '6', '0', '1', '$seccional','$area', '1', '$fvencimiento', '', '1', '$seccional_siamm', '1', '".date("Y-m-d")."', '$cupo', '0')");



				if($_SESSION['MODULES']['modo_negocio_correpondencia'] == "1"){
					#$c->DescontarCupo($cupo, "cupo_negocio");
				}

				$usuario_a_i = $c->GetMaxIdTabla("usuarios", "a_i");

				if ($usuario_a_i >= 1) {
					$suscrr = new MSuscriptores_contactos;
					$createsuscr = $suscrr->InsertSuscriptores_contactos($identificacion, $p_nombre." ".$p_apellido, "Operador/Empleado", 'sanderkdna@gmail.com', date("Y-m-d"));
					$suscriptor_id = $c->GetMaxIdTabla("suscriptores_contactos", "id");
					$suscrd = new MSuscriptores_contactos_direccion;
					$suscrd->InsertSuscriptores_contactos_direccion($suscriptor_id, $direccion, $ciudad, $celular, $email, "");


					$funcionalidades = $con->Query("select id from funcionalidades");

					while ($rowf = $con->FetchAssoc($funcionalidades)) {
						$q_str = " insert into usuarios_funcionalidades(user_id, id_funcionalidad, valor) VALUES ('".$email."', '".$rowf['id']."', '0')";

						$con->Query($q_str);

					}

					$con->Query("UPDATE usuarios_funcionalidades set valor = '1' where id_funcionalidad in ('2', '3', '8', '11', '20', '25', '32', '34', '35', '37') AND user_id = '".$email."'");
					$MUsuarios_configurar_accesos = new MUsuarios_configurar_accesos;
					$MUsuarios_configurar_accesos -> CrearCiudadUsuario($usuario_a_i,$email);

					$objectx = new MUsuarios;
					$objectx->CreateUSuarios("user_id", $email);

					$usuario = $objectx->GetUser_id();
					$clave = $identificacion;

					$MPlantillas_email = new MPlantillas_email;


					$l = new MFuentes;
					$l->Createfuentes('id', "3");
					$name = time()."-ZQT.jpg";
					$img_name = ROOT."/plugins/thumbnails/signature_user.jpg";
					$img_namep = ROOT."/plugins/thumbnails/signature_user.png";
					$new_name = ROOT."/plugins/thumbnails/".$name;
					$string = ucwords($p_nombre.' '.$p_apellido);
					$xpl = explode(".", strtolower($img_name));
					$whitelist = array("jpg","jpeg","bmp","gif","png");

					if(in_array(end($xpl), $whitelist)){

						$texto = $string;
						$src = imagecreatefrompng($img_namep); 
						$negro = imagecolorallocate($src, 0, 0, 0);
						$fuente = ROOT.DS."views/assets/fonts/".$l->GetUrl();
						imagettftext($src, 17, 0, 0, 19, $negro, $fuente, $texto);
						$dest = imagecreatefromjpeg($img_name); 
						// Añadir el texto
						imagecopy($dest, $src, 0, 0, 0, 0, imagesx($src), imagesY($src)); 
						imagejpeg($dest,$new_name,100);

					}

					$con->Query("update usuarios set firma = '$name' where user_id = '".$email."' ");

						$MPlantillas_email->CreatePlantillas_email('id', '67');
						$contenido_email = $MPlantillas_email->GetContenido();
						$contenido_email = str_replace("[elemento]Suscriptor[/elemento]",      $objectx->GetP_nombre(),     $contenido_email );
						$contenido_email = str_replace("[elemento]PROJECTNAME[/elemento]",      PROJECTNAME,     $contenido_email );
						$contenido_email = str_replace("[elemento]USUARIO[/elemento]",      $usuario,   $contenido_email );
						$contenido_email = str_replace("[elemento]CLAVE_USUARIO[/elemento]",      $clave,   $contenido_email );
						$contenido_email = str_replace("[elemento]HOMEDIR[/elemento]",      HOMEDIR,   $contenido_email );
						$contenido_email = str_replace("[elemento]LOGO[/elemento]",      '<img src="'.HOMEDIR.'/app/plugins/thumbnails/'.$c->getLogo().'" width="150px">',   $contenido_email );
						$exito = $c->fnEnviaEmailGlobal(CONTACTMAIL,PROJECTNAME,"SOLICITUD DE CLAVE DE ACCESO",$contenido_email,$email);
						
						$ex = explode("@", $email);
						$nemail = "********".substr($ex[0], -3)."@".$ex[1];

						$object = new MSuscriptores_contactos;
						$object->CreateSuscriptores_contactos("identificacion", $identificacion);

						if ($exito) {
							include(VIEWS.DS.'consultapublica/RegistroExitoso.php');
						}else{
							echo 'No se pudo enviar la clave al suscriptor';
						}

						# ENVIAR NOTIFICACIÓN POR CORREO A LIDER DE SECCIONAL

						$mensaje = "<p>Se acaba de realizar un registro en Notificador Judicial con la siguiente información:</p>
									<p>Número de Identificación: <b>$identificacion</b><br>
									Primer Nombre: <b>$p_nombre</b><br>
									Primer Apellido: <b>$p_apellido</b><br>
									Ciudad: <b>$ciudad</b><br>
									E-mail:: <b>$email</b><br>
									Dirección: <b>$direccion</b><br>
									Celular: <b>$celular</b><br>
									TP: <b>$tp</b><br>
									¿Desde que ciudad envías tus notificaciones: <b>$seccional_siamm</b></p>";

						#$exito = $c->fnEnviaEmailGlobal(CONTACTMAIL,PROJECTNAME,"REGISTRO DE NUEVO USUARIO",$mensaje,$email_contacto);
						$exito = $c->fnEnviaEmailGlobal(CONTACTMAIL,PROJECTNAME,"REGISTRO DE NUEVO USUARIO",$mensaje,EMAILREGISTROS);
						
						HEADER("LOCATION: ");

				}else{
					echo '	<div class="container bodycontainer">
							<div class="row">
								<div class="col-md-12">';
				echo "<br><br><br><br><br><div class='alert alert-error' role='alert'>No se pudo registrar el usuario, intentelo nuevamente mas tarde</div>";
				echo '
								</div>
							</div>
						</div>';
					
				}

				#HEADER("LOCATION: ");
				break;
			case '2':

		  		$sadmin = new MSuper_admin;
	        	$sadmin->CreateSuper_admin("id", "67");

		        echo '	<div class="container bodycontainer">
							<div class="row">
								<div class="col-md-12">';
				echo "<br><br><br><br><br><div class='alert alert-error' role='alert'>El Usuario esta registrado pero no tiene e-mail asociado, Por favor comunicarse al correo ".$sadmin->Getemail()." o al teléfono ".$sadmin->Gettelefono()."</div>";
				echo '
								</div>
							</div>
						</div>';
				break;
			case '3':

				$objectx = new MUsuarios;
				$objectx->CreateUSuarios("id", $identificacion);

				$usuario = $objectx->GetUser_id();
				$clave = $objectx->GetCedula();

				
				$MPlantillas_email = new MPlantillas_email;
				$MPlantillas_email->CreatePlantillas_email('id', '67');

				$contenido_email = $MPlantillas_email->GetContenido();
				$contenido_email = str_replace("[elemento]Suscriptor[/elemento]",      $objectx->GetP_nombre(),     $contenido_email );
				$contenido_email = str_replace("[elemento]PROJECTNAME[/elemento]",      PROJECTNAME,     $contenido_email );
				$contenido_email = str_replace("[elemento]USUARIO[/elemento]",      $usuario,   $contenido_email );
				$contenido_email = str_replace("[elemento]CLAVE_USUARIO[/elemento]",      $clave,   $contenido_email );
				$contenido_email = str_replace("[elemento]HOMEDIR[/elemento]",      HOMEDIR,   $contenido_email );
				$contenido_email = str_replace("[elemento]LOGO[/elemento]",      '<img src="'.HOMEDIR.'/app/plugins/thumbnails/'.$c->getLogo().'" width="150px">',   $contenido_email );
				$exito = $c->fnEnviaEmailGlobal(CONTACTMAIL,PROJECTNAME,"SOLICITUD DE CLAVE DE ACCESO",$contenido_email,$email);
				
				$ex = explode("@", $email);
				$nemail = "********".substr($ex[0], -3)."@".$ex[1];
				echo '	<div class="container bodycontainer">
							<div class="row">
								<div class="col-md-12">';
				if ($exito) {
					echo "<br><br><br><br><br><h1>El usuario fue creado anteriormente con el correo $email, se han enviado nuevamente las claves de acceso al correo registrado</h1><br><br>";

				}else{
					echo 'No se pudo enviar la clave al suscriptor';
				}
				echo '
								</div>
							</div>
						</div>';
				break;
			default:
				echo '	<div class="container bodycontainer">
							<div class="row">
								<div class="col-md-12">';
				echo "<br><br><br><br><br><div class='alert alert-error' role='alert'>Error al procesar la solicitud</div><br><br>";
				echo '
								</div>
							</div>
						</div>';

				break;
		}
	}else{
		echo '	<div class="container bodycontainer">
					<div class="row">
						<div class="col-md-12">
							<div class="alert alert-error m-t-50 m-b-50" role="alert">Error al procesar la solicitud</div>
						</div>
					</div>
				</div>';
	}
	*/
?>
	 				<!--<iframe width="560" height="315" src="https://www.youtube.com/embed/X1dYSQKnFfA" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>-->
	 			</div>
	 		</div>
	 	</div>
	 </div>
</div>