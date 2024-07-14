<?php
class ClassApp
{
	public function fnLogin($Datos)
	{
		global $con;
		global $c;

		include_once(MODELS.DS.'UsuariosM.php');
		$MUsuarios = new MUsuarios;

		$d = explode('|',$Datos);
		$username = strtolower(trim($c->sql_quote($d[0])));
		$password = md5($c->sql_quote($d[1]));

		$result = explode("@@",$MUsuarios->CheckSession($username, $password));

		$datosreturno['iten']['continuar'] = 'S';

		if($result[0] == "1"){
			$datosreturno['iten']['mensaje'] = "Su nombre de usuario o clave es incorrecto ";
			$datosreturno['iten']['continuar'] = 'N';
		}else if($result[0] == "2"){
			$datosreturno['iten']['mensaje'] = "Su cuenta de usuario se encuentra desactivada";	
			$datosreturno['iten']['continuar'] = 'N';				
		}else{

			$datosdependencias = $con->FetchAssoc($con->Query("
				select GROUP_CONCAT(concat(id,'|',nombre,'|',dependencia)  SEPARATOR  '^' ) as datosdependencias
				from dependencias where dependencia = '1'"));

			$datosreturno['iten']['datosdependencias'] = $datosdependencias['datosdependencias'];

			/*$datosreferencia = $con->FetchAssoc($con->Query("
				select GROUP_CONCAT(concat(col_1,'|',col_2,'|',col_3,'|',col_4,'|',col_5,'|',col_6,'|',col_7,'|',col_8,'|',col_9,'|',col_10,'|',col_11,'|',col_12,'|',col_13,'|',col_14,'|',col_15,'|',col_16,'|',col_17,'|',col_18,'|',col_19,'|',col_20,'|',col_21,'|',col_22,'|',col_23,'|',col_24,'|',col_25,'|',col_26,'|',col_27,'|',col_28,'|',col_29,'|',col_30,'|',type_1,'|',type_2,'|',type_3,'|',type_4,'|',type_5,'|',type_6,'|',type_7,'|',type_8,'|',type_9,'|',type_10,'|',type_11,'|',type_12,'|',type_13,'|',type_14,'|',type_15,'|',type_16,'|',type_17,'|',type_18,'|',type_19,'|',type_20,'|',type_21,'|',type_22,'|',type_23,'|',type_24,'|',type_25,'|',type_26,'|',type_27,'|',type_28,'|',type_29,'|',type_30)  SEPARATOR  '^' ) as datosreferencia
				from suscriptores_referencias where id = '1'"));

			$datosreturno['iten']['datosreferencia'] = $datosreferencia['datosreferencia'];*/

			$datosreturno['iten']['datos'] = $con->FetchAssoc($con->Query("
				select concat(p_nombre,' ',s_nombre,' ',p_apellido,' ',s_apellido) as nombre, cedula, a_i, email, foto_perfil, seccional, regimen,ciudad,(SELECT nombre FROM areas where id = regimen) nombre_area, (SELECT nombre FROM seccional where id = usuarios.seccional) as nombre_oficina,(select count(*) from gestion where usuario_registra = usuarios.user_id) as consecutivo
				from usuarios where user_id = '$username'"));

			$datosreturno['iten']['datos']['nombre_area'] =html_entity_decode ($datosreturno['iten']['datos']['nombre_area']);
		}

		return $datosreturno;
	}

	public function fnCargaDatos($Datos)
	{
		global $con;
		global $c;

		$d = explode('|',$Datos);
		$a_i = strtolower(trim($c->sql_quote($d[0])));
		$maxsuscriptores = strtolower(trim($c->sql_quote($d[1])));
		$maxexpediemtes = strtolower(trim($c->sql_quote($d[2])));

		$con->Query("SET SESSION group_concat_max_len  = 1000000;");
		$sql = "SELECT GROUP_CONCAT(concat(sc.id, '|', sc.identificacion, '|', sc.nombre, '|', sc.type, '|', sd.direccion, '|', sd.ciudad, '|', sd.email,'|',sc.dependencia)  SEPARATOR  '^' ) as datoss 
FROM suscriptores_contactos sc inner join suscriptores_contactos_direccion sd on sc.id = sd.id_contacto
where sc.estado= '1' and sc.id >= $maxsuscriptores";
		$datsus = $con->FetchAssoc($con->Query($sql));
		$datosreturno['iten']['datossuscriptores'] = $datsus['datoss'];

		$sql = "SELECT GROUP_CONCAT(concat(id,'|',min_rad,'|',f_recibido,'|',(select concat(p_nombre,' ',p_apellido) from usuarios where user_id = gestion.usuario_registra),'|',(select concat(p_nombre,' ',p_apellido) from usuarios where a_i = gestion.nombre_destino),'|',(SELECT GROUP_CONCAT(concat(sc.nombre,'/',sc.type)  SEPARATOR  ', ' ) FROM gestion_suscriptores gs inner join suscriptores_contactos sc on gs.id_suscriptor = sc.id where gs.id_gestion = gestion.id),'|',concat((select nombre from dependencias where id = gestion.id_dependencia_raiz),'-',(select nombre from dependencias where id = gestion.tipo_documento)),'|',(select nombre from areas where id = gestion.dependencia_destino),'|',(select sum(cantidad) from gestion_anexos where gestion_id = gestion.id and estado = '1'),'|',(select nombre from estados_gestion where id = gestion.estado_solicitud),'|',case when estado_archivo = 1 then 'Archivo de Gestión' else case when estado_archivo = 2 then 'Archivo Central' else 'Archivo Histórico' end end,'|',observacion,'|',suscriptor_id)  SEPARATOR  '^' ) as datosexpedientes FROM gestion where id > $maxexpediemtes";
		$datsus = $con->FetchAssoc($con->Query($sql));
		$datosreturno['iten']['datosexpedientes'] = $datsus['datosexpedientes'];

		return $datosreturno;
	}

	public function fnCrearExpedienteServidor($datos){

		global $con;
		global $c;
		global $f;

		include_once(MODELS.DS.'UsuariosM.php');
	    include_once(MODELS.DS.'Suscriptores_contactosM.php');
		include_once(MODELS.DS.'Suscriptores_contactos_direccionM.php');
		include_once(MODELS.DS.'Dependencias_documentosM.php');
		include_once(MODELS.DS.'DependenciasM.php');
		include_once(MODELS.DS.'Gestion_suscriptoresM.php');
		include_once(MODELS.DS.'Gestion_anexosM.php');
		include_once(MODELS.DS.'GestionM.php');
		include_once(MODELS.DS.'Events_gestionM.php');
		include_once(MODELS.DS.'Gestion_anexos_firmasM.php');
		include_once(MODELS.DS.'Firmas_usuariosM.php');
		include_once(MODELS.DS.'Dependencias_alertasM.php');
		include_once(MODELS.DS.'Dian_facturacionM.php');
		include_once(MODELS.DS.'Gestion_anexos_permisosM.php');
		include_once(MODELS.DS.'Super_adminM.php');
		include_once(MODELS.DS.'Mailer_messageM.php');
		include_once(MODELS.DS.'Mailer_attachmentsM.php');
		include_once(MODELS.DS.'Mailer_from_messageM.php');
		include_once(MODELS.DS.'NotificacionesM.php');
		include_once(MODELS.DS.'Mailer_replysM.php');
		include_once(MODELS.DS.'SortM.php');

		$d = explode('|',$datos);
		$minr = (trim($c->sql_quote($d[0])));
		$f_recibido = (trim($c->sql_quote($d[1])));
		$tipo_documento = (trim($c->sql_quote($d[2])));
		$nombre_destino = (trim($c->sql_quote($d[3])));
		$observacion = (trim($c->sql_quote($d[4])));
		$suscriptor_id = (trim($c->sql_quote($d[5])));
		$firma = (trim($c->sql_quote($d[6])));
		$qr = (trim($c->sql_quote($d[7])));
		$acuse = (trim($c->sql_quote($d[8])));
		$fisico = (trim($c->sql_quote($d[9])));
		$archivos = (trim($c->sql_quote($d[10])));

		$MUsuarios = new MUsuarios;
		$MUsuarios->CreateUsuarios("a_i", $nombre_destino);

		$dependencia = new MDependencias;
		$dependencia->CreateDependencias("id", $tipo_documento);

		$tot  = $con->Query("select dependencia from suscriptores_contactos WHERE id = '".$suscriptor_id."'");
		$suscriptor_id_padre = $con->Result($tot, 0, "dependencia");

		$Ciudad_suscriptor = $MUsuarios->GetCiudad();
        
      	$nombre_destino = $MUsuarios->GetA_i();
      	$ciudad = $MUsuarios->GetCiudad();
      	$usuario_registra = $MUsuarios->GetUser_id();
      	$oficina = $MUsuarios->GetSeccional();
      	$area_principal = $MUsuarios->GetRegimen();
      	$user_id = $MUsuarios->GetUser_id();
      	$nombre_usuario = $MUsuarios->GetP_nombre().' '.$MUsuarios->GetP_apellido();
      	$nombre_radica = $nombre_usuario;
      	$dtform = $nombre_radica;
      	$q_strx = "SELECT ciudad from seccional WHERE id='".$oficina."'";
		$queryx = $con->Query($q_strx);
		$ciudadcodigo = $con->Result($queryx, 0, "ciudad");
		$ciudad = $ciudadcodigo;

		$fecha = date_create($f_recibido);
		date_add($fecha, date_interval_create_from_date_string('3 days'));
		$fecha_vencimiento = date_format($fecha, 'Y-m-d');
		$folio = 1;
        $tipo_documento = $dependencia->GetId();
        $dependencia_destino = $MUsuarios->GetRegimen();
        $estado_respuesta = "NO";
        $fecha_respuesta = "";

         $prioridad  = "2";
        $estado_solicitud = "1";
        $estado_archivo = "1";
        $id_dependencia_raiz = $dependencia->GetDependencia();
      	$num_oficio_respuesta = $ciudadcodigo.'-'.$f->zerofill($oficina,3).'-001-'.$f->zerofill($dependencia_destino,3);
      	$MGestion = new MGestion;
		$nr = $MGestion->GetNRadicado($num_oficio_respuesta, $ciudad, $oficina, $dependencia_destino, $id_dependencia_raiz, $tipo_documento);
		// USANDO LA FUNCION DE INSERTAR DEL OBJETO PARA ENVIAR LA INFORMACION A LA BASE DE DATOA			
		$create = $MGestion->InsertGestion($radicado, $f_recibido, $nombre_radica, $folio, $tipo_documento, $dependencia_destino, $nombre_destino, $fecha_vencimiento, $estado_respuesta, $nr, $fecha_respuesta, $observacion, $prioridad, $estado_solicitud, $suscriptor_id, $ciudad, $usuario_registra, $estado_archivo, $oficina, $id_dependencia_raiz, $minr);
		$id = $c->GetMaxIdTabla("gestion", "id");
		$filename=UPLOADS.DS.$id.'/';
		if (!file_exists($filename)) {
		    mkdir(UPLOADS.DS . $id, 0777);
		}
		$filename=UPLOADS.DS.$id.'/anexos/';
		if (!file_exists($filename)) {
		    mkdir(UPLOADS.DS . $id.'/anexos', 0777);
		}
		$dogc = new MDependencias_documentos;
		$listdoc = $dogc->ListarDependencias_documentos("WHERE id_dependencia = '$tipo_documento'");
		$i;
		while ($rx = $con->FetchAssoc($listdoc)) {
			$i++;
			$an = new MGestion_anexos;
			$an->InsertGestion_anexos($id, $rx['nombre'], "", $usuario_registra, date("Y-m-d"), date("H:i:s"), $_SERVER['REMOTE_ADDR'], "", "1", $i, $i);
			$gestion_anexos_id = $c->GetMaxIdTabla("gestion_anexos", "id");
		}

		if ($suscriptor_id != "") {
			$s = new MGestion_suscriptores();
			$s->InsertGestion_suscriptores($id, $suscriptor_id, $usuario_registra, "1", "1", date("Y-m-d "));
			$s->InsertGestion_suscriptores($id, $suscriptor_id_padre, $usuario_registra, "1", "1", date("Y-m-d "));
		}

		$call = "*";
		if ($nombre_destino == "0") {
			$call = "*";
		}elseif ($nombre_destino == "-1") {
			$call = "areaboss";
		}else{
			$call = $nombre_destino;
		}
		$objecte = new MEvents_gestion;			
		$objecte->InsertEvents_gestion($usuario_registra, $id, date("Y-m-d"), "Creación de Radicación", "Se ha creado la radicación $nr", date("Y-m-d"), 0, date("H:i:s"), 0, 0, 0, date("Y-m-d"), 0, $oficina, $area_principal, $area_principal, $call, "rad", $id);
		/*Crear archivos*/
		$archivossdsd = explode(",",$archivos);
		foreach ($archivossdsd as $key => $value) {
			$archivo_nombre = $value;
			$car = new MGestion_anexos;
			$tot  = $con->Query("select count(*) as max from gestion_anexos WHERE gestion_id = '".$id."' and folder_id = '0'");
			$fol = $con->Result($tot, 0, "max");
			$fol += 1;
			$rand = md5(date('Y-m-d').rand().$user_id);
			$arrarch = explode(".", $archivo_nombre);
			$ext = end($arrarch);
			$fname = $rand.".".$ext;
			copy(UPLOADS.DS."temporal".DS.$archivo_nombre,UPLOADS.DS . $id.'/anexos/'.$fname);
	        $size = filesize(UPLOADS.DS . $id.'/anexos/'.$fname);
	        $hash = hash("sha256", $archivo_nombre.$fname.$user_id.$_SERVER[REMOTE_ADDR].date("Y-m-d").date("H:i:s").$size);
			//base 64
			$base_file = '';
			$con->Query("INSERT into gestion_anexos (timest, gestion_id,nombre,url,user_id, ip, fecha, hora, folio, folder_id, folio_final, is_publico, orden, hash, base_file) values ('".date("Y-m-d H:i:s")."', '$id','".$archivo_nombre."','".$fname."','$user_id', '$_SERVER[REMOTE_ADDR]', '".date("Y-m-d")."', '".date("H:i:s")."', '".$fol."', '0', '".$fol."', '1', '".$fol."', '".$hash."', '".$base_file."')");
			$anexo_id = $c->GetMaxIdTabla("gestion_anexos", "id");
		}

		if($qr == 'S'){

		}
		if($acuse == 'S'){

			$MSuscriptores_contactos = new MSuscriptores_contactos;
			$MSuscriptores_contactos->CreateSuscriptores_contactos("id", $suscriptor_id_padre);

			$Email_suscriptor = $MSuscriptores_contactos->GetUser_id();

			$anexos_listado = "";
			$archivos_anexos_listado = "";
			$gestion_anexos_firmas_id = "";
			$mensaje_email = "Aceptación de la infracción #$minr"; 
			$mensajerespuesta = $c->EmailCertificadoExterno($gestion_anexos_firmas_id, $id,$user_id,$oficina, $area_principal, $Email_suscriptor, $mensaje_email, "", $anexos_listado, $archivos_anexos_listado, "", "2", $id);

			$datosreturno['iten']['mensajerespuesta'] = $mensajerespuesta;
		}
		if($fisico == 'S'){

			$MSuscriptores_contactos = new MSuscriptores_contactos;
			$MSuscriptores_contactos->CreateSuscriptores_contactos("id", $suscriptor_id_padre);

			$MSuscriptores_contactos_direccion = new MSuscriptores_contactos_direccion;
			$MSuscriptores_contactos_direccion->CreateSuscriptores_contactos_direccion("id_contacto", $suscriptor_id_padre);

			$anexos_listado = "";
			$spostal = "me6x3P4pjiXKh2ePnnzSJn6CMkqQyPtkdtYL4tz01Kc=";
			$titulo = "CC";
			$direccion = $MSuscriptores_contactos_direccion->GetDireccion().' - '.$MSuscriptores_contactos_direccion->GetCiudad();
			$comparecer = "0";
			$nom_destinatario = $MSuscriptores_contactos->GetNombre();
			$dcontenido = "Aceptación de la infracción #$minr"; 
			$mensajerespuesta = $c->EnvioFisicoExterno($user_id,$dcontenido,$id,$titulo, $spostal, $suscriptor_id_padre, $direccion, $comparecer, $nom_destinatario, $anexos_listado, "anexo");
			$datosreturno['iten']['mensajerespuesta2'] = $mensajerespuesta;
		}


		$datosreturno['iten']['continuar'] = 'S';
		$datosreturno['iten']['id'] = $id;
		return $datosreturno;
	}

	public function fnCrearArchivo($datos){

		global $c;
		global $f;

		$d = explode('@@@',$datos);
		$nombre = (trim($c->sql_quote($d[0])));
		$base64 = ($d[1]);

		$min_rad = "temporal";
		$filename=UPLOADS.DS.$min_rad.'/';
		if (!file_exists($filename)) {
		    mkdir(UPLOADS.DS . $min_rad, 0777);
		}

		$fh = fopen(UPLOADS.DS.$min_rad.DS.$nombre, 'w');
        fwrite($fh, base64_decode($base64));
        fclose($fh);
        $datosreturno['iten']['continuar'] = 'S';
        return $datosreturno;
	}
}