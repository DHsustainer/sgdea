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
	$MPlantillas_email->CreatePlantillas_email('id', '29');
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
	 				<header>
	          			<h2>CREAR CUENTA DE USUARIO</h2>
	        		</header>
	    		</div>
	 			<div class="col-md-12">
<?php
	switch ($registrar) {
		case '1':

		
			$suscrr = new MSuscriptores_contactos;
			$createsuscr = $suscrr->InsertSuscriptores_contactos($identificacion, $nombre, $type, 'sanderkdna@gmail.com', date("Y-m-d"));

			$suscriptor_id = $c->GetMaxIdTabla("suscriptores_contactos", "id");

			$suscd = new MSuscriptores_contactos_direccion;
			$suscd->InsertSuscriptores_contactos_direccion($suscriptor_id, $direccion, $ciudad, $telefonos, $email, "");

			$objectx = new MSuscriptores_contactos;;

			$objectx->CreateSuscriptores_contactos("id", $suscriptor_id);
			$usuario = $objectx->GetCod_ingreso();
			$clave = $objectx->GetDec_pass();
			$gestion = new MGestion;
			$gestion->CreateGestion("id", $id_gestion);
			$SSC = new MSuscriptores_contactos_direccion;
			$query = $SSC->ListarSuscriptores_contactos_direccion("WHERE id_contacto = '".$objectx -> GetId()."'");	    
			$email = $con->Result($query, 0, 'email'); 
			
			$MPlantillas_email = new MPlantillas_email;

			$MPlantillas_email->CreatePlantillas_email('id', '6');
			$contenido_email = $MPlantillas_email->GetContenido();
			$contenido_email = str_replace("[elemento]Suscriptor[/elemento]",      $objectx->GetNombre(),     $contenido_email );
			$contenido_email = str_replace("[elemento]PROJECTNAME[/elemento]",      PROJECTNAME,     $contenido_email );
			$contenido_email = str_replace("[elemento]rad_completo[/elemento]",      $gestion->GetNum_oficio_respuesta(),     $contenido_email );
			$contenido_email = str_replace("[elemento]responsable[/elemento]", $_SESSION['nombre'],     	   $contenido_email );
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
				echo $contenido_email;

				echo "<br><div align='center'><a href='".HOMEDIR.'/index.php?m=login&action=check&username='.$object->GetCod_ingreso().'&pass='.$object->GetDec_pass()."' class='btn btn-primary btn-lg'>Ingresar</a></div>";

			}else{
				echo 'No se pudo enviar la clave al suscriptor';
			}
				#HEADER("LOCATION: ");
			break;
		case '2':

		  		$sadmin = new MSuper_admin;
	        	$sadmin->CreateSuper_admin("id", "6");

	        echo '	<div class="container bodycontainer">
						<div class="row">
							<div class="col-md-12">';
			echo "<br><br><br><br><br><div class='alert alert-error' role='alert'>El suscriptor esta registrado pero no tiene e-mail, Por favor comunicarse al correo ".$sadmin->Getemail()." o al teléfono ".$sadmin->Gettelefono()."</div>";
			echo '
							</div>
						</div>
					</div>';
			break;
		case '3':

			$objectx = new MSuscriptores_contactos;;

			$objectx->CreateSuscriptores_contactos("id", $object->GetId());
			$usuario = $objectx->GetCod_ingreso();
			$clave = $objectx->GetDec_pass();
			$gestion = new MGestion;
			$gestion->CreateGestion("id", $id_gestion);
			$SSC = new MSuscriptores_contactos_direccion;
			$query = $SSC->ListarSuscriptores_contactos_direccion("WHERE id_contacto = '".$objectx -> GetId()."'");	    
			$email = $con->Result($query, 0, 'email'); 
			
			$MPlantillas_email = new MPlantillas_email;

			$MPlantillas_email->CreatePlantillas_email('id', '6');
			$contenido_email = $MPlantillas_email->GetContenido();
			$contenido_email = str_replace("[elemento]Suscriptor[/elemento]",      $objectx->GetNombre(),     $contenido_email );
			$contenido_email = str_replace("[elemento]PROJECTNAME[/elemento]",      PROJECTNAME,     $contenido_email );
			$contenido_email = str_replace("[elemento]rad_completo[/elemento]",      $gestion->GetNum_oficio_respuesta(),     $contenido_email );
			$contenido_email = str_replace("[elemento]responsable[/elemento]", $_SESSION['nombre'],     	   $contenido_email );
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
				echo "<br><br><br><br><br><div class='alert alert-info' role='alert'>El suscriptor esta registrado, envío las claves de acceso al correo $nemail</div><br><br>";

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
?>
	 			</div>
	 		</div>
	 	</div>
	 </div>
</div>