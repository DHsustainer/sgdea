<?
	$NOMUSUARIO = ""; $NOMDOCUMENTO = ""; $NUMRADICACION = ""; $NOMFORMULARIO = ""; $NOMSUSCRIPTOR = ""; $NOTIFICACION = "";
	$IMUSUARIO = ""; $NOMDOCUMENTO = ""; $NUMRADICACION = ""; $NOMFORMULARIO = ""; $NOMSUSCRIPTOR = ""; $NOTIFICACION = "";
	$NOMDOCUMENTO = ""; $TITULO_PROCESO = ""; $MAIL_REMITENTE = ""; $LEERMENSAJE = ""; $USERNAMEX = ""; $GUIA = "";
	$ASUNTO = ""; $DATOSGUIA = ""; $ALTEVENTO = ""; $TITULOEVENTO = ""; $MENSAJERIA = ""; $FECHAVENCIMIENTO = "";

	$i++;
	global $con;
	$c = new Consultas;
	$filter= $rrt["nombre"];
	$lnid = $con->Result($con->Query("select * from log where id='".$rrt["log"]."'"), 0, "fecha");

	$b=array( "#NOMUSUARIO#", "#NOMDOCUMENTO#", "#NUMRADICACION#", "#NOMFORMULARIO#", "#NOMSUSCRIPTOR#", "#NOTIFICACION#",
	          "#NOMDOCUMENTO#", "#TITULO_PROCESO#", "#MAIL_REMITENTE#", "#LEERMENSAJE#", "#USERNAMEX#", "#GUIA#",
	          "#ASUNTO#", "#DATOSGUIA#", "#ALTEVENTO#", "#TITULOEVENTO#", "#MENSAJERIA#", "#FECHAVENCIMIENTO#", "#CANTIDAD#");

	$viewer =  array(	".doc" => "google" , "docx" => "google" , ".zip" => "google" , ".rar" => "google" , ".tar" => "google"				  ,".xls" => "google" , "xlsx" => "google" , ".ppt" => "google" , ".pps" => "google" 
						, "pptx" => "google","ppsx" => "google" , ".pdf" => "google" , ".txt" => "google" , ".jpg" => "image"
						, "jpeg" => "image" ,".bmp" => "image"  , ".gif" => "image" , ".png" => "image" , ".dib" => "image" 
						, ".tif" => "image" ,"tiff" => "image" , "mpeg" => "video" , ".avi" => "video" , ".mp4" => "video" 
						, "midi" => "audio" ,".acc" => "audio" , ".wma" => "audio" , ".ogg" => "audio" , ".mp3" => "audio" 
						, ".flv" => "video" ,".wmv" => "video" , ".csv" => "google",".DOC" => "google" , "DOCX" => "google" 
						, ".ZIP" => "google",".RAR" => "google" , ".TAR" => "google" ,".XLS" => "google" , "XLSX" => "google"
						,".PPT" => "google", ".PPS" => "google" ,"PPTX" => "google" , "PPSX" => "google" , ".PDF" => "google"
					    ,".TXT" => "google" , ".JPG" => "image" , "JPEG" => "image" , ".BMP" => "image" , ".GIF" => "image" 
					    ,".PNG" => "image" , ".DIV" => "image" , ".TIF" => "image" , "TIFF" => "image" , "MPEG" => "video" 
					    ,".AVI" => "video" , ".MP4" => "video" , "MIDI" => "audio" , ".ACC" => "audio" , ".WMA" => "audio" 
					    ,".OGG" => "audio" , ".MP3" => "audio" , ".FLV" => "video" , ".WMV" => "video" , ".CSV" => "google");

	$g = new MGestion;
	$g->CreateGestion("id", $rrt['id_gestion']);

	$ev = new MEvents_gestion;
	$ev->CreateEvents_gestion("id", $rrt["id_evento"]);

	$user_event = new MUsuarios;
	$user_event->CreateUsuarios("user_id", $rrt['13']);

	$suscriptordata = $c->GetDataFromTable("dependencias", "id", $g->GetTipo_documento(), "nombre", " ")." - ".$c->GetDataFromTable("suscriptores_contactos", "id", $g->GetSuscriptor_id(), "nombre", " ").""; 


	$radicado = ($g->GetRadicado() == "" )?$g->GetMin_rad():$g->GetRadicado();

	$NUMRADICACION = "<a href='/gestion/ver/".$g->GetId().trim("/".DIRECCIONARALERTAS."/ ").$rrt[0]."/'>".$suscriptordata." (<small>".$radicado."</small>)</a>";


switch ($rrt['extra']) {
	case "rad":
		# Se ha creado un nuevo expediente #NUMRADICACION# asignado al usuario: #NOMUSUARIO#
	break;
	case "trexp":
		# Se ha transferido el expediente n&uacute;mero  #NUMRADICACION# al usuario: #NOMUSUARIO#
		$NUMRADICACION = "<a href='/gestion_transferencias/listar/'>".$suscriptordata." (<small>".$g->GetMin_rad()."</small>)</a>";
	break;
	case "anu":
		# NOMUSUARIO# ha actualizado la informaci&oacute;n en un documento obligatorio llamado #NOMDOCUMENTO# en el expediente #NUMRADICACION#
		$ga = new MGestion_anexos;
		$ga->CreateGestion_anexos("id", $rrt['id_act']);
		$ruta = HOMEDIR.DS."app/archivos_uploads/gestion/".$g->GetId().trim("/anexos/ ").$ga->GetUrl()."";
		$extension = substr($ga->GetUrl(), strlen($ga->GetUrl())-4, strlen($ga->GetUrl()));  
		$NOMDOCUMENTO  = "<b><span class='smaplink' onClick='AbrirDocumento(\"".$ruta."\", \"".$viewer[$extension]."\", \"".$ga->GetNombre()."\", \"4\", \"".$ga->GetId()."\")'>".$ga->GetNombre()."</span></b>";
	break;
	case "aveg":
		# Tienes #CANTIDAD# en Archivo Gesti&oacute;n que deben pasar a Archivo Central por vencimiento #NOMDOCUMENTO#.
		$CANTIDAD = "<a href='/gestion/vencimientoexpedientesarchivo/1/'>".'('.$rrt['id_act'].') expedientes </a>';
    	$NOMDOCUMENTO = "";

    	if($rrt['id_evento'] > 0){
    		$NOMDOCUMENTO = " en el ".CAMPOAREADETRABAJO." de ".$c->GetDataFromTable("dependencias", "id", $rrt['id_evento'], "nombre", " ");
    	}

	break;
	case "avec":
		# Tienes #CANTIDAD# en Archivo Central que deben pasar a Archivo Hist&oacute;rico por vencimiento #NOMDOCUMENTO#.
		$CANTIDAD = "<a href='/gestion/vencimientoexpedientesarchivo/2/'>".'('.$rrt['id_act'].') expedientes </a>';
    	$NOMDOCUMENTO = "";

    	if($rrt['id_evento'] > 0){
    		$NOMDOCUMENTO = " en el ".CAMPOAREADETRABAJO." de ".$c->GetDataFromTable("dependencias", "id", $rrt['id_evento'], "nombre", " ");
    	}

	break;
	case "avecm":
		# Tienes #CANTIDAD# para recibir en el Archivo Central
		$cantidadq = $con->Result($con->Query("SELECT count(*) cantidad FROM `gestion_cambio_ubicacion_archivo` where estado_archivo_destino = '2' and estado = '0'"), 0, "cantidad");
    	$CANTIDAD = "<a href='/gestion/vencimientoexpedientesarchivo/11/'>".'('.$cantidadq.') expedientes </a>';
    	$NOMDOCUMENTO = "";

	break;
	case "avehm":
		# Tienes #CANTIDAD# para recibir en el Archivo Historico
		$cantidadq = $con->Result($con->Query("SELECT count(*) cantidad FROM `gestion_cambio_ubicacion_archivo` where estado_archivo_destino = '3' and estado = '0'"), 0, "cantidad");
    	$CANTIDAD = "<a href='/gestion/vencimientoexpedientesarchivo/22/'>".'('.$cantidadq.') expedientes </a>';
    	$NOMDOCUMENTO = "";

	break;
	case "aisnc":
		# Tienes #CANTIDAD# con la informaci&oacute;n incompleta
		$cantidadq = $con->Result($con->Query("SELECT count(*) as cantidad FROM `suscriptores_contactos` s inner join suscriptores_contactos_direccion sc on s.id = sc.id_contacto where s.estado = '1' and (sc.ciudad = '' or sc.direccion = '' or s.identificacion = '' or s.nombre = '')"), 0, "cantidad");
    	$CANTIDAD = "<a href='/herramientas/suscriptores/#contacts/'>".'('.$cantidadq.') suscriptores </a>';
    	$NOMDOCUMENTO = "";
	break;
	case "aecv":
		# El permiso sobre el expediente #NUMRADICACION# compartido con el usuario: #NOMUSUARIO# caduca el #FECHAVENCIMIENTO#.
		$l = new MGestion_compartir;
		$l->Creategestion_compartir('id', $rrt['id_act']);
		$FECHAVENCIMIENTO = $l -> Getfecha_caducidad();
	break;
	case "aecvv":
		# El permiso sobre el expediente #NUMRADICACION# caduca el #FECHAVENCIMIENTO#.
		$l = new MGestion_compartir;
		$l->Creategestion_compartir('id', $rrt['id_act']);
		$FECHAVENCIMIENTO = $l -> Getfecha_caducidad();
	break;
	case "an":
		$ga = new MGestion_anexos;
		$ga->CreateGestion_anexos("id", $rrt['id_act']);
		
		# Se han cargado #NOMDOCUMENTO# en el expediente #NUMRADICACION#
		$NOMDOCUMENTO  = "<span>Nuevos Documentos $listanexos</span>";
	break;
	case "pr":
		# #NOMUSUARIO# ha creado un documento llamado #NOMDOCUMENTO# que debe ser revisado por usted antes de ser exportado #NUMRADICACION#
		$doc = new MDocumentos_gestion;
    	$doc->CreateDocumentos_gestion("id", $rrt['id_act']);
		$NOMDOCUMENTO  = "<a href='/documentos_gestion/nuevo/".$g->GetId()."/".$doc->GetId()."/'>".$doc->GetNombre()."</a>";
	break;
	case "doc":
		# #NOMUSUARIO# ha creado un documento llamado #NOMDOCUMENTO# en el expediente #NUMRADICACION#
		$doc = new MDocumentos_gestion;
    	$doc->CreateDocumentos_gestion("id", $rrt['id_act']);

		$NOMDOCUMENTO  = "<a href='/documentos_gestion/nuevo/".$g->GetId()."/".$doc->GetId()."/'>".$doc->GetNombre()."</a>";

	break;
	case "edoc":
		# #NOMUSUARIO# ha editado el documento #NOMDOCUMENTO# perteneciente al expediente #NUMRADICACION#
		$ga = new MGestion_anexos;
		$ga->CreateGestion_anexos("id", $rrt['id_act']);
		$ruta = HOMEDIR.DS."app/archivos_uploads/gestion/".$g->GetId().trim("/anexos/ ").$ga->GetUrl()."";
		$extension = substr($ga->GetUrl(), strlen($ga->GetUrl())-4, strlen($ga->GetUrl()));  
		$ALTEVENTO = "<span>".$ev->GetDescription()."</span>";
		#$NOMDOCUMENTO  = "<b><span class='smaplink' onClick='AbrirDocumento(\"".$ruta."\", \"".$viewer[$extension]."\", \"".$ga->GetNombre()."\", \"4\", \"".$ga->GetId()."\")'>".$ga->GetNombre()."</span></b>";
		$NOMDOCUMENTO  = "<b>".$ga->GetNombre()."</b>";

	break;
	case "form":
		# #NOMUSUARIO# ha creado un formulario de tipo #NOMFORMULARIO# en el expediente #NUMRADICACION#
		$bigd = new MBig_data;
    	$bigd->CreateBig_data("id", $rrt['id_act']);

    	$maindoc = new MRef_tables;
    	$maindoc->CreateRef_tables("id", $bigd->GetRef_tables_id());

		$NOMFORMULARIO  = "<a href='#'>".$maindoc->GetTitle()." - ".$bigd->GetCol_1()."</a>";

	break;
	case "eform":
		# #NOMUSUARIO# ha editado la informacion del formulario #NOMFORMULARIO# en el expediente #NUMRADICACION#
		$bigd = new MBig_data;
    	$bigd->CreateBig_data("id", $rrt['id_act']);

    	$maindoc = new MRef_tables;
    	$maindoc->CreateRef_tables("id", $bigd->GetRef_tables_id());

		$ALTEVENTO = "<span>".$ev->GetDescription()."</span>";
		$NOMFORMULARIO  = "<a href='#'>".$maindoc->GetTitle()." - ".$bigd->GetCol_1()." </a>";

	break;
	case "sus":
		# #NOMUSUARIO# ha agregado al suscriptor #NOMFORMULARIO# a el expediente #NUMRADICACION#
		$gs = new MGestion_suscriptores;
    	$gs->CreateGestion_suscriptores("id", $rrt['id_act']);

    	$suscriptor = new MSuscriptores_contactos;
    	$suscriptor->CreateSuscriptores_contactos("id", $gs->GetId_suscriptor());

		$NOMFORMULARIO  = "<a href='#/'>".$suscriptor->GetNombre()." </a>";

	break;
	case "esus":
		# #NOMUSUARIO# ha editado la configuraci&oacute;n del suscriptor #NOMSUSCRIPTOR# en el expediente #NUMRADICACION#
		$gs = new MGestion_suscriptores;
    	$gs->CreateGestion_suscriptores("id", $rrt['id_act']);

    	$suscriptor = new MSuscriptores_contactos;
    	$suscriptor->CreateSuscriptores_contactos("id", $gs->GetId_suscriptor());

		$ALTEVENTO = "<span>".$ev->GetDescription()."</span>";
		$NOMSUSCRIPTOR  = "<a href='#/'>".$suscriptor->GetNombre()." </a>";

	break;
	case "doca":
		# #NOMUSUARIO# ha revisado el documento #NOMDOCUMENTO# en el expediente #NUMRADICACION#
		$docp = new MDocumentos_gestion_permisos;
		$docp->CreateDocumentos_gestion_permisos("id", $rrt['id_act']);

    	$doc = new MDocumentos_gestion;
    	$doc->CreateDocumentos_gestion("id", $docp->GetId_documento());

		$NOMDOCUMENTO  = "<a href='/documentos_gestion/nuevo/".$g->GetId()."/".$doc->GetId()."/'>".$doc->GetNombre()."</a>";

	break;
	case "A":
		# #NOMUSUARIO# ha creeado un evento #TITULOEVENTO# en el expediente #NUMRADICACION#
	    $ev = new MEvents_gestion;
    	$ev->CreateEvents_gestion("id", $rrt["id_act"]);

		$TITULOEVENTO = "<b>".$ev->GetTitle()."</b>";
		$ALTEVENTO = "<span>".$ev->GetId().$ev->GetDescription()."</span>";

	break;
	case "expdpc":
		# #NOMUSUARIO# ha exportado el documento #NOMDOCUMENTO# en el expediente #NUMRADICACION#
		$ga = new MGestion_anexos;
		$ga->CreateGestion_anexos("id", $rrt['id_act']);

		$ruta = HOMEDIR.DS."app/archivos_uploads/gestion/".$g->GetId().trim("/anexos/ ").$ga->GetUrl()."";
		$extension = substr($ga->GetUrl(), strlen($ga->GetUrl())-4, strlen($ga->GetUrl()));  
		$NOMDOCUMENTO  = "<b><span class='smaplink' onClick='AbrirDocumento(\"".$ruta."\", \"".$viewer[$extension]."\", \"".$ga->GetNombre()."\", \"4\", \"".$ga->GetId()."\")'>".$ga->GetNombre()."</span></b>";
	break;
	case "texp":
		# #NOMUSUARIO# le ha dado asignado el expediente #NUMRADICACION#
		$ALTEVENTO = "<span>".$ev->GetDescription()."</span>";
	break;
	case "eexp":
		# #NOMUSUARIO# ha editado el expediente #NUMRADICACION#
		$ALTEVENTO = "<span>".$ev->GetDescription()."</span>";
	break;
	case "eexpr":
		# #NOMUSUARIO# ha rechazado recibir el expediente #NUMRADICACION#
		$ALTEVENTO = "<span>".$ev->GetDescription()."</span>";
	break;
	case "comp":
		# #NOMUSUARIO# le ha dado acceso al expediente #NUMRADICACION# al usuario #USERNAMEX#
		$gc = new MGestion_compartir;
		$gc->CreateGestion_compartir("id", $rrt["id_act"]);
		$USERNAMEX = $c->GetDataFromTable("usuarios", "user_id", $gc->GetUsuario_nuevo(), "p_nombre, p_apellido", " ");
		$ALTEVENTO = "<blockquote class='m-l-30 m-t-10'><p>".$gc->GetObservacion()."</p></blockquote>";

	break;
	case "mejd":
		# #NOMUSUARIO# ha enviado un #LEERMENSAJE# #ASUNTO# en el expediente #NUMRADICACION# a #USERNAMEX#
		$to = new MMailer_from_message;
		$to->CreateMailer_from_message("id", $rrt['id_act']);
		$msj = new MMailer_message;
		$msj->CreateMailer_message("message_id", $to->GetMessage_code());

    	$USERNAMEX  = "<b>".$to->GetEmail()."</b>";
    	$LEERMENSAJE   = "<a href='/gestion/ver/".$g->GetId()."/inbox/'>Mensaje de datos (".$msj->GetSubject().")</a>";

	break;
	case "reciv":
		# El mensaje de datos #LEERMENSAJE# enviado a #USERNAMEX# del expediente #NUMRADICACION# ha tenido acuse de recibo
		$to = new MMailer_from_message;
		$to->CreateMailer_from_message("id", $rrt['id_act']);
		$msj = new MMailer_message;
		$msj->CreateMailer_message("message_id", $to->GetMessage_code());

    	$USERNAMEX     = "<b>".$to->GetEmail()."</b>";
    	$LEERMENSAJE   = "<a href='/gestion/ver/".$g->GetId()."/inbox/'>Mensaje de datos (".$msj->GetSubject().")</a>";

	break;
	case "newmsj":
		# Ha recibido un #LEERMENSAJE# del usuario #NOMUSUARIO#  relacionado con el en el expediente #NUMRADICACION#
		$to = new MMailer_from_message;
		$to->CreateMailer_from_message("id", $rrt['id_act']);
		$msj = new MMailer_message;
		$msj->CreateMailer_message("message_id", $to->GetMessage_code());

    	$USERNAMEX     = "<b>".$to->GetEmail()."</b>";
    	$LEERMENSAJE   = "<a href='/gestion/ver/".$g->GetId()."/inbox/'>Mensaje de datos (".$msj->GetSubject().")</a>";

	break;
	case "lsus":
		# El suscriptor #NOMUSUARIO# ha cargado un documento llamado #NOMDOCUMENTO# en el expediente #NUMRADICACION#
		$ga = new MGestion_anexos;
		$ga->CreateGestion_anexos("id", $rrt['id_act']);

		$ruta = HOMEDIR.DS."app/archivos_uploads/gestion/".$g->GetId().trim("/anexos/ ").$ga->GetUrl()."";
		$extension = substr($ga->GetUrl(), strlen($ga->GetUrl())-4, strlen($ga->GetUrl()));  
		$NOMDOCUMENTO  = "<b><span class='smaplink' onClick='AbrirDocumento(\"".$ruta."\", \"".$viewer[$extension]."\", \"".$ga->GetNombre()."\", \"4\", \"".$ga->GetId()."\")'>".$ga->GetNombre()."</span></b>";

	break;
	case "rdoc":
		# El usuario #NOMUSUARIO# le ha solicitado la revisi&oacute;n/firma de un documento #NOMDOCUMENTO# en el expediente #NUMRADICACION#
		$ga = new MGestion_anexos;
		$ga->CreateGestion_anexos("id", $rrt['id_act']);

		$ruta = HOMEDIR.DS."app/archivos_uploads/gestion/".$g->GetId().trim("/anexos/ ").$ga->GetUrl()."";
		$extension = substr($ga->GetUrl(), strlen($ga->GetUrl())-4, strlen($ga->GetUrl()));  
		$NOMDOCUMENTO  = "<b>".$ga->GetNombre()."</b>";
		$ALTEVENTO = "<span>Hola!</span>";

	break;
	case "rdocs":
		# El usuario #NOMUSUARIO# le ha solicitado al suscriptor #USERNAMEX# la revisi&oacute;n/firma de un documento #NOMDOCUMENTO# en el expediente #NUMRADICACION#
		$ga = new MGestion_anexos;
		$ga->CreateGestion_anexos("id", $rrt['id_act']);

		$ruta = HOMEDIR.DS."app/archivos_uploads/gestion/".$g->GetId().trim("/anexos/ ").$ga->GetUrl()."";
		$extension = substr($ga->GetUrl(), strlen($ga->GetUrl())-4, strlen($ga->GetUrl()));  
		$USERNAMEX   = $c->GetDataFromTable("suscriptores_contactos", "id", $ev->GetUser_id(), "nombre", " ");
		$NOMDOCUMENTO  = "<b>".$ga->GetNombre()."</b>";

	break;
	case "crdocs":
		# El suscriptor #NOMUSUARIO# ha revisado el documento #NOMDOCUMENTO# perteneciente al expediente #NUMRADICACION#
		$ga = new MGestion_anexos;
		$ga->CreateGestion_anexos("id", $rrt['id_act']);

		$ruta = HOMEDIR.DS."app/archivos_uploads/gestion/".$g->GetId().trim("/anexos/ ").$ga->GetUrl()."";
		$extension = substr($ga->GetUrl(), strlen($ga->GetUrl())-4, strlen($ga->GetUrl()));  
		$NOMDOCUMENTO  = "<b>".$ga->GetNombre()."</b>";

	break;
	case "crdoc":
		# El usuario #NOMUSUARIO# ha revisado el documento #NOMDOCUMENTO# perteneciente al expediente #NUMRADICACION#
		$docp = new MGestion_anexos_permisos;
		$docp->CreateGestion_anexos_permisos("id", $rrt['id_act']);

		$ga = new MGestion_anexos;
		$ga->CreateGestion_anexos("id", $docp->GetId_documento());

		$ruta = HOMEDIR.DS."app/archivos_uploads/gestion/".$g->GetId().trim("/anexos/ ").$ga->GetUrl()."";
		$extension = substr($ga->GetUrl(), strlen($ga->GetUrl())-4, strlen($ga->GetUrl()));  
		$NOMDOCUMENTO  = "<b><span class='smaplink' onClick='AbrirDocumento(\"".$ruta."\", \"".$viewer[$extension]."\", \"".$ga->GetNombre()."\", \"4\", \"".$ga->GetId()."\")'>".$ga->GetNombre()."</span></b>";

	break;
	// case "cert":
	// 	# el servicio numero #DATOSGUIA# del expediente #NUMRADICACION# ha tenido actualizaciones
	// 	$m = new MNotificaciones;
	// 	$m->CreateNotificaciones("id", $rrt['id_act']);

	// 	$cliente = new nusoap_client("http://laws.com.co/ws/GetDetailPostalO.wsdl", true);
    //     $error = $cliente->getError();
    //     if ($error) {
    //         $datos .= "<h2>Constructor error</h2><pre>" . $error . "</pre>";
    //     }

    //     $array = array("id" => $m->GetId_postal());
    //     $result = $cliente->call("GetDetalleOperador", $array);
    //     if ($cliente->fault) {
    //         $datos .= "<h2>Fault</h2><pre>";
    //         $datos .= "</pre>";
    //     }else{
    //         $error = $cliente->getError();
    //         if ($error) {
    //             $datos .= "<h2>Error</h2><pre>" . $error . "</pre>";
    //         }else {
    //             if ($result == "") {
    //                 $datos .= "No se creo el WS";
    //             }else{
    //                 $x  = explode(",", $result);
    //                 $MENSAJERIA = "<b>".$x[0]."</b>";
    //                 $msj = $x[2];
    //             }
    //         }
    //     }		
    //     $DATOSGUIA = "<a href='".$msj.$m->GetGuia_id()."' target='_blank'>".$m->GetGuia_id()."</a>";


	// break;
	// case "dfis":
	// 	# el servicio numero #DATOSGUIA# del expediente #NUMRADICACION# ha tenido actualizaciones (GUIA DIGITALIZADA Y CARGADA AL EXPEDIENTE)
	// 	$m = new MNotificaciones;
	// 	$m->CreateNotificaciones("id", $rrt['id_act']);

	// 	$cliente = new nusoap_client("http://laws.com.co/ws/GetDetailPostalO.wsdl", true);
    //     $error = $cliente->getError();

    //     if ($error) {
    //         $datos .= "<h2>Constructor error</h2><pre>" . $error . "</pre>";
    //     }

    //     $array = array("id" => $m->GetId_postal());
    //     $result = $cliente->call("GetDetalleOperador", $array);

    //     if ($cliente->fault) {
    //         $datos .= "<h2>Fault</h2><pre>";
    //         $datos .= "</pre>";
    //     }else{
    //         $error = $cliente->getError();
    //         if ($error) {
    //             $datos .= "<h2>Error</h2><pre>" . $error . "</pre>";
    //         }else {
    //             if ($result == "") {
    //                 $datos .= "No se creo el WS";
    //             }else{
    //                 $x  = explode(",", $result);
    //                 $MENSAJERIA = "<b>".$x[0]."</b>";
    //                 $msj = $x[2];
    //             }
    //         }
    //     }
    //     $DATOSGUIA = "<a href='".$msj.$m->GetGuia_id()."' target='_blank'>".$m->GetGuia_id()."</a>";

	// break;
	// case "rfis":
	// 	# Un servicio del expediente #NUMRADICACION# ha sido recibida en la empresa de mensajeria #MENSAJERIA# con el numero de guia #DATOSGUIA#
	// 	$m = new MNotificaciones;
	// 	$m->CreateNotificaciones("id", $rrt['id_act']);

	// 	$cliente = new nusoap_client("http://laws.com.co/ws/GetDetailPostalO.wsdl", true);
    //     $error = $cliente->getError();

    //     if ($error) {
    //         $datos .= "<h2>Constructor error</h2><pre>" . $error . "</pre>";
    //     }

    //     $array = array("id" => $m->GetId_postal());
    //     $result = $cliente->call("GetDetalleOperador", $array);

    //     if ($cliente->fault) {
    //         $datos .= "<h2>Fault</h2><pre>";
    //         $datos .= "</pre>";
    //     }else{
    //         $error = $cliente->getError();
    //         if ($error) {
    //             $datos .= "<h2>Error</h2><pre>" . $error . "</pre>";
    //         }else {
    //             if ($result == "") {
    //                 $datos .= "No se creo el WS";
    //             }else{
    //                 $x  = explode(",", $result);
    //                 $MENSAJERIA = "<b>".$x[0]."</b>";
    //                 $msj = $x[2];
    //             }
    //         }
    //     }
	// 	$DATOSGUIA = "<a href='".$msj.$m->GetGuia_id()."' target='_blank'>".$m->GetGuia_id()."</a>";

	// break;
	case "nfis":
		# Se ha enviado correspondencia fisica en el expediente #NUMRADICACION#

	break;
	case "ev":
		# #NOMUSUARIO# ha creado un nuevo evento/actuaci&oacute;n programada en el expediente #NUMRADICACION#
		$ALTEVENTO = "<span>".$ev->GetDescription()."</span>";

	break;
	case "vexp":
		# El Expediente #NUMRADICACION# est&aacute; pronto a vencerse

	break;
	case "avoe":
		# Tienes una actividad llamada "#TITULOEVENTO#" sin realizar desde #FECHAVENCIMIENTO# en el expediente #NUMRADICACION#
		$TITULOEVENTO = "<b>".$ev->GetTitle()."</b>";
		$FECHAVENCIMIENTO = "<b>".$f->nicetime($ev->GetFecha())."</b>";
		$ALTEVENTO = "<span>".$ev->GetDescription()."</span>";

	break;
	case "dcu":
		# Se ha compartido el documento #NOMDOCUMENTO# del expediente #NUMRADICACION#	
		$MGestion_anexos_permisos_documentos = new MGestion_anexos_permisos_documentos;
		$MGestion_anexos_permisos_documentos->CreateGestion_anexos_permisos_documentos("id", $rrt["id_act"]);

		$ga = new MGestion_anexos;
		$ga->CreateGestion_anexos("id", $MGestion_anexos_permisos_documentos->GetId_documento());

		$ruta = HOMEDIR.DS."app/archivos_uploads/gestion/".$g->GetId().trim("/anexos/ ").$ga->GetUrl()."";
		$extension = substr($ga->GetUrl(), strlen($ga->GetUrl())-4, strlen($ga->GetUrl()));  
		$NOMDOCUMENTO = "<b>".$ga->GetNombre()."</b>";

	break;
	case "avne":
		# Tienes una actividad llamada #TITULOEVENTO# para realizar el día de hoy en el expediente #NUMRADICACION#
		$TITULOEVENTO = "<b>".$ev->GetTitle()."</b>";
		$ALTEVENTO = "<span>".$ev->GetDescription()."</span>";

	break;
	case "nsdoc":
		# NO ESTÁ DEFINIDA ESTA ALERTA!
		$sol = new MSolicitudes_documentos;
		$sol->CreateSolicitudes_documentos("id", $rrt['id_act']);

		if ($sol->GetGestion_id() != "0") {
			$g = new MGestion;
			$g->CreateGestion("id", $sol->GetGestion_id());
		}
		$ALTEVENTO = "<span>".$sol->GetObservacion()."</span>";

	break;
	case "dndoc":
		# NO ESTÁ DEFINIDA ESTA ALERTA!
		$sol = new MSolicitudes_documentos;
		$sol->CreateSolicitudes_documentos("id", $rrt['id_act']);

		if ($sol->GetGestion_id() != "0") {
			$g = new MGestion;
			$g->CreateGestion("id", $sol->GetGestion_id());
		}
		$ALTEVENTO = "<span>".$sol->GetRespuesta()."</span>";

	break;
	
	default:
		# code...
		break;
}

    $c=array( "$NOMUSUARIO", "$NOMDOCUMENTO", "$NUMRADICACION", "$NOMFORMULARIO", "$NOMSUSCRIPTOR", "$NOTIFICACION",
              "$TITULO_PROCESO<a href='".HOMEDIR.DS."correo/ver/".$bptahx[1]."/'><strong>$titulo</strong></a>",
              "$MAIL_REMITENTE<a href='".HOMEDIR.DS."correo/veracuse/".$bptah[1].".1/'>Ver Mensaje</a>",
              "$NOMDOCUMENTO", "$LEERMENSAJE",  "$USERNAMEX", "$GUIA", "$ASUNTO", "$DATOSGUIA", "$ALTEVENTO",
              "$TITULOEVENTO", "$MENSAJERIA", "$FECHAVENCIMIENTO", "$CANTIDAD" );

    $filter=str_replace($b,$c,$filter);   
    $checked = "";
    $statusact = $aar[$rrt['type']];
    $typeact = $aar2[$rrt['type']];
    $exc = array("aveg", "avec", "nsdoc", 'dndoc',"avecm", "avehm", "aisnc", "aecvv","aecv");
    if(!in_array($rrt['extra'], $exc)){
		$bgp = 'background-color:#FFF';
      	if ($g->GetPrioridad() == "2") {
			$bgp = 'color: #8a6d3b; background-color: #fcf8e3; border-color: #faebcc;';
			$iconflag = "<span class='label label-rouded label-error hidden-xs pull-right'>PRIORIDAD ALTA</span>";
      	}elseif ($g->GetPrioridad() == "1") {
      		$iconflag = "<span class='label label-rouded label-warning hidden-xs pull-right'>PRIORIDAD MEDIA</span>";
      	}elseif ($g->GetPrioridad() == "0") {
      		$iconflag = "<span class='label label-rouded label-info hidden-xs pull-right'>PRIORIDAD NORMAL</span>";
      	}else{
      		$iconflag = "<span class='label label-rouded label-info hidden-xs pull-right'>PRIORIDAD NORMAL</span>";
      	}
    }else {
      	
      	$iconflag = "<span class='label label-rouded label-error hidden-xs pull-right'>PRIORIDAD ALTA</span>";
    }
    if($rrt["status"] == "2"){
        $checked = 'checked="checked"';
    }
    if ($rrt['type'] == 1 && $rrt["status"] == "0" && $lnid < date("Y-m-d")) {
		$statusact = $aar[2];
		$typeact = $aar2[$rrt['type']]." ".$aar2[2];
    }

	$time = "".$f->ObtenerFecha4($rrt['fechahora']);
	
	$qay = $con->Query("select * from ayuda_elementos where id = '25' and estado = '1'");
	$roway = $con->FetchAssoc($qay);

	if ($_SESSION['showhelps'] == "1") {
		$ayuda = 'data-toggle="popover" data-trigger="hover" data-content="'.$roway['texto'].'" data-placement="'.$roway['posicion'].'"';		
	}

      $datos .= '	<div class="comment-body">
                  		<div class="user-img hidden-xs hidden-sm"> 
                  			<img src="'.HOMEDIR.DS.'app/plugins/thumbnails/'.$user_event->GetFoto_perfil().'" alt="user" class="img-circle"> 
                  		</div>
                  		<div class="mail-contnet">
                  			<h5>'.$user_event->GetP_nombre().' '. $user_event->GetP_apellido().'</h5>
                  			<span class="time">'.$time.'</span> 
                  			'.$iconflag.' 
                  			<br>
                  			<span class="mail-desc"> 
                  				<div class="checkbox checkbox-success pull-left m-r-10 m-t-10 hidden-xs" '.$ayuda.'>
	                  				<label for="act_'.$rrt[0].'"> </label>
	                                <input type="checkbox" '.$checked.' onChange="ChangeStatusAlerta(\''.$rrt[0].'\')" id="act_'.$rrt[0].'">
	                            </div>'.$filter.$ALTEVENTO.'</span> 
                  		</div>
              		</div>';

        #$datos .= "<div $styloresaltado class='notification_bloq ".$typeact."'><div class='notificationicon ".$statusact."'></div><div class='flag_icon'>".$iconflag."</div><div class='checkbox'>".$aar2['id']."</div><div class='texto'>".$filter.$ALTEVENTO.$time."</div><div class='clearb'></div></div>";						

	?>