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
	 			<div class="col-md-6">
<?php
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
/*
1 Cobros Mensuales
2 Cobro por Recarga
0 Ilimitado
*/

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

				$con->Query("INSERT into usuarios (id, user_id, p_nombre, s_nombre, p_apellido, s_apellido, password, direccion, telefono, email, ciudad, t_profesional, universidad,  cedula, celular, departamento, id_empresa, isAdministrador, t_cuenta, seccional, regimen, estado, f_caducidad, t_persona, procesos, seccional_siamm, freemium, f_registro, cupo, cupo_usuario, valor_cuota)
					values ('$identificacion','".strtolower($email)."','$p_nombre','','$p_apellido','','".md5($identificacion)."', '$direccion','$celular','$email', '$ciudad', '', '$tp','$identificacion','$celular','', '6', '0', '1', '$seccional','$area', '1', '$fvencimiento', '', '1', '$seccional_siamm', '0', '".date("Y-m-d")."', '$cupo', '0', '10')");



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


					$funcionalidades = $con->Query("select * from funcionalidades");

					while ($rowf = $con->FetchAssoc($funcionalidades)) {
						$q_str = " insert into usuarios_funcionalidades(user_id, id_funcionalidad, valor) VALUES ('".$email."', '".$rowf['id']."', '".$rowf['campo_default']."')";

						$con->Query($q_str);

					}

					/*$qfuncionalidades = $con->Query("select id from funcionalidades where campo_default = '1' ");
					while ($funct = $con->FetchAssoc($qfuncionalidades)) {
						$con->Query("UPDATE usuarios_funcionalidades set valor = '1' where id_funcionalidad = '".$funct['id']."' AND user_id = '".$email."'");	
					}*/
					
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


/*REGISTRO DE EXPEDIENTE DE CARPETA CIUDADANA*/
		if (EXPEDIENTEDEFAULTUSUARIOS == "1") {
			# code...

			$tipo_d = $con->Query("select id, dependencia from dependencias where id = '".SERIEDEFAULTCC."' ");
			$tipo_dq = $con->FetchAssoc($tipo_d);
			$tipo_documento = $tipo_dq['id'];
			$id_dependencia_raiz = $tipo_dq['dependencia'];

			$u = new MUsuarios;
			$u->CreateUsuarios('a_i', USERDEFAULTCC);

			$se = new MSeccional;
			$se->CreateSeccional("id", $u->GetSeccional());

			$sp = new MSeccional_principal;
			$sp->CreateSeccional_principal("ciudad_origen", $se->GetCiudad());

			$d = new MDependencias;
			$d->CreateDependencias("id", $tipo_documento);

			$dr = new MDependencias;
			$dr->CreateDependencias("id", $id_dependencia_raiz);

			$a = new MAreas;
			$a->CreateAreas("id", $u->GetRegimen());

			$gs = new MGestion_suscriptores;

			$ciudad_expediente = $se->GetCiudad();

			$id_gestion = $c->sql_quote($_REQUEST['id_gestion']);
			$radicado = $c->sql_quote($_REQUEST['radicado']);
			$f_recibido = date("Y-m-d");
			$nombre_radica = $c->sql_quote($_REQUEST['nombre_radica']);
			$folio = "0";
			$dependencia_destino = $u->GetRegimen();
			$nombre_destino = $u->GetA_i();
			$fecha_vencimiento = "";
			$estado_respuesta = $c->sql_quote($_REQUEST['estado_respuesta']);
			$fecha_respuesta = "";
			$ar = date("Y")."-".$a->GetPrefijo()."-".$dr->GetId_c()."-".$d->GetId_c();
			$num_oficio_respuesta = ($c->sql_quote($_REQUEST['num_oficio_respuesta']) == "" )?$ar:$c->sql_quote($_REQUEST['num_oficio_respuesta']);
			$prioridad = "1";
			$estado_solicitud = "1";
			$usuario_registra = $u->GetUser_id();
			$estado_archivo = "1";
			$oficina = $u->GetSeccional();
			$autorad = "SI";
			$dtform = "";
			$documento_salida=$c->sql_quote($_REQUEST['documento_salida']);;
			$salida_servidor = $c->sql_quote($_REQUEST['salida_servidor']);
			$observacion .= "EXPEDIENTE DEL USUARIO ".$c->sql_quote($_REQUEST['pnombre'])." ".$c->sql_quote($_REQUEST['papellido'])." ".$tp;
			$es_publico = $c->sql_quote($_REQUEST['expediente_publico']);
			$es_publico = ($es_publico == "on")?"1":"0";

			// DEFINIENDO EL OBJETO

			#	exit;

				$object = new MGestion;
				#print_r($_REQUEST);
				if($c->sql_quote($_REQUEST['num_oficio_respuesta']) == "" ){
					$nr = $object->GetNRadicado($num_oficio_respuesta, $ciudad_expediente, $oficina, $dependencia_destino, $id_dependencia_raiz, $tipo_documento);
				}else{
					$nr = $c->sql_quote($_REQUEST['num_oficio_respuesta']);
				}
				
				$minr = $object->GetMinRadicado($documento_salida);

				

				// USANDO LA FUNCION DE INSERTAR DEL OBJETO PARA ENVIAR LA INFORMACION A LA BASE DE DATOA


				if ($id_gestion == "") {
					# code...

					$create = $object->InsertGestion($identificacion, $f_recibido, $nombre_radica, $folio, $tipo_documento, $dependencia_destino, $nombre_destino, $fecha_vencimiento, $estado_respuesta, $nr, $fecha_respuesta, $observacion, $prioridad, $estado_solicitud, $suscriptor_id, $ciudad_expediente, $usuario_registra, $estado_archivo, $oficina, $id_dependencia_raiz, $minr,$documento_salida, "0", $observacion2, "0", $c->sql_quote($_REQUEST['campot1']), $c->sql_quote($_REQUEST['campot2']), $c->sql_quote($_REQUEST['campot3']), $c->sql_quote($_REQUEST['campot4']), $c->sql_quote($_REQUEST['campot5']), $c->sql_quote($_REQUEST['campot6']), $c->sql_quote($_REQUEST['campot7']), $c->sql_quote($_REQUEST['campot8']), $c->sql_quote($_REQUEST['campot9']), $c->sql_quote($_REQUEST['campot10']), $c->sql_quote($_REQUEST['campot11']), $c->sql_quote($_REQUEST['campot12']), $c->sql_quote($_REQUEST['campot13']), $c->sql_quote($_REQUEST['campot14']), $c->sql_quote($_REQUEST['campot15']), "", $es_publico);

					$id = $c->GetMaxIdTabla("gestion", "id");

			    	$g = new MGestion;
					$g->CreateGestion("id", $id);

				}else{


					$id = $id_gestion;

			    	$g = new MGestion;
					$g->CreateGestion("id", $id);

				}
				$folder_id = '0';

				if (CARPETAGENERICA != "") {
					$object = new MGestion_folder;
					// USANDO LA FUNCION DE INSERTAR DEL OBJETO PARA ENVIAR LA INFORMACION A LA BASE DE DATOA			
					$create = $object->InsertGestion_folder(CARPETAGENERICA, "0", $g->GetId(), $_SESSION['usuario'], date("Y-m-d"), "1", "1");

					$folder_id = $c->GetMaxIdTabla("gestion_folder", "id");
				}


				$filename=UPLOADS.DS.$id.'/';
				if (!file_exists($filename)) {
				    mkdir(UPLOADS.DS . $id, 0777);
				}
				$filename=UPLOADS.DS.$id.'/anexos/';
				if (!file_exists($filename)) {
				    mkdir(UPLOADS.DS . $id.'/anexos', 0777);
				}

				$nsss = $c->sql_quote($_REQUEST['pnombre'])." ".$c->sql_quote($_REQUEST['papellido']);
				$suscrr = new MSuscriptores_contactos;
				$createsuscr = $suscrr->InsertSuscriptores_contactos($c->sql_quote($_REQUEST['identificacion']), $nsss, "1", $u->GetUser_id(), date("Y-m-d"), "0");

				$rsid = $c->GetMaxIdTabla("suscriptores_contactos", "id");

				$suscd = new MSuscriptores_contactos_direccion;
				$suscd->InsertSuscriptores_contactos_direccion($rsid, $c->sql_quote($_REQUEST['direccion']), $c->sql_quote($_REQUEST['ciudad']), $c->sql_quote($_REQUEST['celular']), $c->sql_quote($_REQUEST['email']), "", "NO", "", "");

				$gs->InsertGestion_suscriptores($id, $rsid, $u->GetUser_id(), "1", "1", date("Y-m-d"));
				$con->Query("update gestion set suscriptor_id = '".$rsid."', nombre_radica = '".$nsss."' where id = '".$id."' ");

				$con->Query("INSERT INTO alertas_suscriptor (suscriptor_id, alerta, id_gestion, fechahora, estado, type, tipo_usuario, id_anexo, extra) VALUES ('".$u->GetUser_id()."', 'Se creó una cuenta de usuario', '0', '".date("Y-m-d H:i:s")."', '1', 'global', 'U', NULL, NULL)");
		}

			



/*FIN DE REGISTRO DE EXPEDIENTE DE CARPETA CIUDADANA*/
	$exito = true;
		if ($exito) {
			include(VIEWS.DS.'consultapublica/RegistroExitoso.php');
			/*
			echo '<img src="'.ASSETS.DS.'images/IM01.jpg" width="100%">';
			echo "<!--<h2>Su cuenta de usuario fue creada exitosamente, puedes ingresar haciendo clic en el botón 'Ingresar Ahora', también enviamos su clave de usuario y contraseña a su correo electrónico $email para futuros ingresos</h2> --><br>";

			echo "<br><div align='center'><a href='".HOMEDIR.'/index.php?m=login&action=check&username='.$email.'&pass='.$identificacion."' class='btn btn-primary btn-lg'> Si el sistema no lo redirecciona en uns segundos haga clic aqui</a></div>";
			*/
			
			echo "<script> window.location.href='".HOMEDIR."/index.php?m=login&action=check&username=".$email."&pass=".$identificacion."&vtoken=NO' </script>";

		}else{
			echo 'Se creó el Usuario, pero No se pudo enviar la clave al suscriptor';
		}

						# ENVIAR NOTIFICACIÓN POR CORREO A LIDER DE SECCIONAL

						$mensaje = "<p>Se acaba de realizar un registro en Santander Unido con la siguiente información:</p>
									<p>Número de Identificacion: <b>$identificacion</b><br>
									Nombre: <b>$p_nombre</b><br>
									Nombre del comercio: <b>$p_apellido</b><br>
									Tipo de Comercio: <b>$tp</b><br>
									Ciudad: <b>$ciudad</b><br>
									E-mail:: <b>$email</b><br>
									Direccion: <b>$direccion</b><br>
									Celular: <b>$celular</b><br>
									Seccional: <b>$seccional_siamm</b></p>";

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
?>
	 			</div>
	 			<div class="col-md-6">
	 				<!--<iframe width="560" height="315" src="https://www.youtube.com/embed/X1dYSQKnFfA" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>-->
	 			</div>
	 		</div>
	 	</div>
	 </div>
</div>