<?
include('headers.php');
    include_once(MODELS.DS.'UsuariosM.php');
    include_once(MODELS.DS.'Suscriptores_contactosM.php');
	include_once(MODELS.DS.'Suscriptores_contactos_direccionM.php');
	include_once(MODELS.DS.'Dependencias_documentosM.php');
	include_once(MODELS.DS.'DependenciasM.php');
	include_once(MODELS.DS.'Gestion_suscriptoresM.php');
	include_once(MODELS.DS.'GestionM.php');
	include_once(MODELS.DS.'Events_gestionM.php');
	include_once(MODELS.DS.'Dependencias_alertasM.php');
	include_once(MODELS.DS.'Gestion_anexos_permisosM.php');
	include_once(MODELS.DS.'Super_adminM.php');
	include_once(MODELS.DS.'AreasM.php');

	include_once(MODELS.DS.'Gestion_anexosM.php');
	require_once(PLUGINS.DS.'tcpdf/tcpdf.php');
	require_once(PLUGINS.DS.'FPDI/fpdi.php');

	class Gestion{
		public function SetDataXml($xmlstring) {
			global $con;
			global $c;
			global $f;
			$xml = @(array)simplexml_load_string($xmlstring,'SimpleXMLElement',LIBXML_NOCDATA);
			if(count($xml) <= 0){
				$xml = @(array) $xmlstring['parametros'];
			}

			$ip_consumo = $_SERVER['REMOTE_ADDR'];

			$keyid = $c->sql_quote($xml['keyid']);
			$tipokey = $c->sql_quote($xml['tipokey']);
			$ipconsumo = $c->sql_quote($xml['ipconsumo']);
			$codigo_proceso = $c->sql_quote($xml['codigo_proceso']);

			/*Consultar Datos Key*/
			$st = $con->Query("select * from ws_keys where llave= '".$keyid."'");
            $row_ws_keys = $con->FetchAssoc($st);

            /*Se verifica el estado*/
            if($row_ws_keys['estado'] == '0'){
            	$output['salida'] = 'ERROR';
            	$output['mensaje'] = 'La keyid actualmente esta deshabilitada';
        	 	$xml = $this->array2xml($output);
       		 	return $xml;
            }
            if($row_ws_keys['tipokey'] != 'SET'){
            	$output['salida'] = 'ERROR';
            	$output['mensaje'] = 'La keyid no es para consultar expedientes';
        	 	$xml = $this->array2xml($output);
       		 	return $xml;
            }
            /*Se verifica la ip*/
            if($row_ws_keys['ipkey'] != $ip_consumo){
             	$output['salida'] = 'ERROR';
            	$output['mensaje'] = 'Se esta consumiendo el servicio desde una IP no autorizada';
        	 	$xml = $this->array2xml($output);
       		 	return $xml;
            }
            if($codigo_proceso == '' && $codigo_proceso == '0'){
             	$output['salida'] = 'ERROR';
            	$output['mensaje'] = 'El codigo proceso es obligatorio';
        	 	$xml = $this->array2xml($output);
       		 	return $xml;
            }

            $g = new MGestion;
			$g->CreateGestion("min_rad", $codigo_proceso);
			$id_gestion = $g->GetId();
			if($id_gestion <= 0){
				$output['salida'] = 'ERROR';
            	$output['mensaje'] = 'El codigo proceso no existe';
        	 	$xml = $this->array2xml($output);
       		 	return $xml;
			}
			$stg = $con->Query("select min_rad as codigo_proceso,(select nombre from suscriptores_contactos where id = suscriptor_id) as nombre_proceso, (SELECT prefijo FROM `areas` where id = dependencia_destino) as codigo_procedimiento,  (SELECT nombre FROM `areas` where id = dependencia_destino) as nombre_procedimiento,
LPAD((SELECT id FROM `dependencias` where id = id_dependencia_raiz),4,'0') as codigo_serie, (SELECT nombre FROM `dependencias` where id = id_dependencia_raiz) as nombre_serie,LPAD((SELECT id FROM `dependencias` where id = tipo_documento),4,'0') as codigo_suberie,(SELECT nombre FROM `dependencias` where id = tipo_documento) as nombre_subserie,id as identicador_exp, observacion as titulo_exp,f_recibido as fecha_apertura,fecha_vencimiento as fecha_cierre,observacion2 as palabras_clave_expediente,estado_respuesta estado, uri as URI from gestion where min_rad = '".$codigo_proceso."'");
            $row_gestion = $con->FetchAssoc($stg);

			$output['salida'] = 'ok';
			$output['mensaje'] = "Consulta Exitosa!";
        	$output['expediente'] = $row_gestion;

    	 	$xml = $this->array2xml($output);
   		 	return $xml;

		}
		public function AddDataXml($xmlstring) {
			global $con;
			global $c;
			global $f;
			$xml = @(array)simplexml_load_string($xmlstring,'SimpleXMLElement',LIBXML_NOCDATA);
			if(count($xml) <= 0){
				$xml = @(array) $xmlstring['parametros'];
			}
			$teml = @(array)$xml['documento'];
			$xml['documento'] = [];
			$xml['documento'] = $teml;

			$ip_consumo = $_SERVER['REMOTE_ADDR'];

			$keyid = $c->sql_quote($xml['keyid']);
			$tipokey = $c->sql_quote($xml['tipokey']);
			$ipconsumo = $c->sql_quote($xml['ipconsumo']);
			$codigo_proceso = $c->sql_quote($xml['codigo_proceso']);
			$documento = $c->sql_quote($xml['documento']);

			if(count($documento[0]) <= 0){
				$documento_temp = $documento;
				$documento = [];
				$documento[0] = $documento_temp;
			}

			for ($i=0; $i < count($documento); $i++) {
				$teml = @(array)$documento[$i];
				$documento[$i] = [];
				$documento[$i] = $teml;
			}

			for ($i=0; $i < count($documento); $i++) {
				if($documento[$i]['nombre_documento'] == ''){
	            	$output['salida'] = 'ERROR';
	            	$output['mensaje'] = 'El nombre del documento es obligatorio'.$i;
	        	 	$xml = $this->array2xml($output);
	       		 	return $xml;
	            }
	            if($documento[$i]['formato_documento'] == ''){
	            	$output['salida'] = 'ERROR';
	            	$output['mensaje'] = 'El formato del documento es obligatorio';
	        	 	$xml = $this->array2xml($output);
	       		 	return $xml;
	            }
	            if($documento[$i]['paginas_documento'] == ''){
	            	$output['salida'] = 'ERROR';
	            	$output['mensaje'] = 'Las paginas del documento es obligatorio';
	        	 	$xml = $this->array2xml($output);
	       		 	return $xml;
	            }
	            if($documento[$i]['tamano_documento'] == ''){
	            	$output['salida'] = 'ERROR';
	            	$output['mensaje'] = 'El tamaño del documento es obligatorio';
	        	 	$xml = $this->array2xml($output);
	       		 	return $xml;
	            }
	            if($documento[$i]['base64_documento'] == ''){
	            	$output['salida'] = 'ERROR';
	            	$output['mensaje'] = 'La base64 del documento es obligatorio';
	        	 	$xml = $this->array2xml($output);
	       		 	return $xml;
	            }
			}

			/*Consultar Datos Key*/
			$st = $con->Query("select * from ws_keys where llave= '".$keyid."'");
            $row_ws_keys = $con->FetchAssoc($st);

            /*Se verifica el estado*/
            if($row_ws_keys['estado'] == '0'){
            	$output['salida'] = 'ERROR';
            	$output['mensaje'] = 'La keyid actualmente esta deshabilitada';
        	 	$xml = $this->array2xml($output);
       		 	return $xml;
            }
            if($row_ws_keys['tipokey'] != 'ADD'){
            	$output['salida'] = 'ERROR';
            	$output['mensaje'] = 'La keyid no es para crear expedientes';
        	 	$xml = $this->array2xml($output);
       		 	return $xml;
            }
            /*Se verifica la ip*/
            if($row_ws_keys['ipkey'] != $ip_consumo){
             	$output['salida'] = 'ERROR';
            	$output['mensaje'] = 'Se esta consumiendo el servicio desde una IP no autorizada';
        	 	$xml = $this->array2xml($output);
       		 	return $xml;
            }
            if($codigo_proceso == '' && $codigo_proceso == '0'){
             	$output['salida'] = 'ERROR';
            	$output['mensaje'] = 'El codigo proceso es obligatorio';
        	 	$xml = $this->array2xml($output);
       		 	return $xml;
            }

            $g = new MGestion;
			$g->CreateGestion("min_rad", $codigo_proceso);
			$id_gestion = $g->GetId();
			if($id_gestion <= 0){
				$output['salida'] = 'ERROR';
            	$output['mensaje'] = 'El codigo proceso no existe';
        	 	$xml = $this->array2xml($output);
       		 	return $xml;
			}
	        $us = $con->FetchAssoc($con->Query("select * from usuarios where a_i = '".$g->GetNombre_destino()."'"));
	        $filename=UPLOADS.DS.$id_gestion.'/';
	        if (!file_exists($filename)) {
	            mkdir(UPLOADS.DS . $id_gestion, 0777);
	        }
	        $filename=UPLOADS.DS.$id_gestion.'/anexos/';
	        if (!file_exists($filename)) {
	            mkdir(UPLOADS.DS . $id_gestion.'/anexos', 0777);
	        }

	        $id_gestion_anexos_temp = '';
	        for ($i=0; $i < count($documento); $i++) {
		        $archivo_nombre = $documento[$i]['nombre_documento'];
		        $cantidad = $documento[$i]['paginas_documento'];
		        $tipoarchi = $documento[$i]['formato_documento'];
		        $id_anexo_externo = '';
		        $data_archivo = $documento[$i]['base64_documento'];

		        $arrarch = explode(".", $archivo_nombre);
		        $ext = end($arrarch);		        
		        $rand = $c->GetIdRecursivoTabla("url","gestion_anexos",$ext);
		        $fname = $rand.".".$ext;
		      
		        $fh = fopen(UPLOADS.DS . $id_gestion.'/anexos/'.$fname, 'w');
		        fwrite($fh, base64_decode($data_archivo));
		        fclose($fh);

		        $an = new MGestion_anexos;
		        $an->InsertGestion_anexos($id_gestion, $archivo_nombre, $fname, $us['user_id'], date("Y-m-d"), date("H:i:s"), $_SERVER['REMOTE_ADDR'], "", "1", $i, $i,$cantidad, $tipoarchi, "1", $id_anexo_externo);
		        $id_gestion_anexos = $c->GetMaxIdTabla("gestion_anexos", "id");
		        $c->SendContabilizadorDocumentos($cantidad, $g->GetTipo_documento(), $g->GetId(), "AN");

		        $MEvents_gestion = new MEvents_gestion;
		        $title = "Nuevo Documento";
		        $description = "Se ha creado un nuevo documento llamado: \"".$archivo_nombre."\"";
				$MEvents_gestion->InsertEvents_gestion($us['user_id'], $id_gestion, date("Y-m-d"), $title, $description, date("Y-m-d"), 0, date("H:i:s"), 0, 0, 0, date("Y-m-d"), 0, $g->GetOficina(), $g->GetDependencia_destino(), $g->GetDependencia_destino(), $us['a_i'], "dfis", $id_notificacion);

				$ane = $con->FetchAssoc($con->Query("select * from gestion_anexos where id = '".$id_gestion_anexos."'"));
				if($id_gestion_anexos_temp != ''){
					$id_gestion_anexos_temp .= ',';
				}
				$id_gestion_anexos_temp .= $ane['hash'];
			}

			$output['salida'] = 'OK';
        	$output['mensaje'] = 'Carga Exitosa!';
        	$output['codigos_add'] = $id_gestion_anexos_temp;
    	 	$xml = $this->array2xml($output);
   		 	return $xml;
		}
		public function GetDataXml($xmlstring) {
			global $con;
			global $c;
			global $f;

			$xml = '';
			$xml = @(array)simplexml_load_string($xmlstring,'SimpleXMLElement',LIBXML_NOCDATA);
			if(count($xml) <= 0){
				$xml = @(array) $xmlstring['parametros'];
			}
			$teml = @(array)$xml['fecha_apertura'];
			$xml['fecha_apertura'] = [];
			$xml['fecha_apertura'] = $teml;

			$teml = @(array)$xml['fecha_cierre'];
			$xml['fecha_cierre'] = [];
			$xml['fecha_cierre'] = $teml;

			$ip_consumo = $_SERVER['REMOTE_ADDR'];

			$keyid = $c->sql_quote($xml['keyid']);
			$tipokey = $c->sql_quote($xml['tipokey']);
			$ipconsumo = $c->sql_quote($xml['ipconsumo']);
			$departamento = $c->sql_quote($xml['departamento']);
			$municipio = $c->sql_quote($xml['municipio']);
			$oficina = $c->sql_quote($xml['oficina']);
			$dependencia = $c->sql_quote($xml['dependencia']);
			$responsable = $c->sql_quote($xml['responsable']);
			$nombre_serie = $c->sql_quote($xml['nombre_serie']);
			$nombre_subserie = $c->sql_quote($xml['nombre_subserie']);
			$titulo_exp = $c->sql_quote($xml['titulo_exp']);
			$radicado = $c->sql_quote($xml['radicado']);
			$fecha_apertura = $c->sql_quote($xml['fecha_apertura']['anio'].'-'.$xml['fecha_apertura']['mes'].'-'.$xml['fecha_apertura']['dia']);
			$fecha_cierre = $c->sql_quote($xml['fecha_cierre']['anio'].'-'.$xml['fecha_cierre']['mes'].'-'.$xml['fecha_cierre']['dia']);
			$nit_suscriptor = $c->sql_quote($xml['nit_suscriptor']);
			$nombre_suscriptor = $c->sql_quote($xml['nombre_suscriptor']);
			$direccion_suscriptor = $c->sql_quote($xml['direccion_suscriptor']);
			$telefonos_suscriptor = $c->sql_quote($xml['telefonos_suscriptor']);
			$email_suscriptor = $c->sql_quote($xml['email_suscriptor']);
			$codigo_externo = $c->sql_quote($xml['codigo_externo']);

			$tipo_suscriptor = 'CLIENTE';

			/*Consultar Datos Key*/
			$st = $con->Query("select * from ws_keys where llave= '".$keyid."'");
            $row_ws_keys = $con->FetchAssoc($st);

            /*Se verifica el estado*/
            if($row_ws_keys['estado'] == '0'){
            	$output['salida'] = 'ERROR';
            	$output['mensaje'] = 'La keyid actualmente esta deshabilitada';
        	 	$xml = $this->array2xml($output);
       		 	return $xml;
            }
            if($row_ws_keys['tipokey'] != 'GET'){
            	$output['salida'] = 'ERROR';
            	$output['mensaje'] = 'La keyid no es para crear expedientes';
        	 	$xml = $this->array2xml($output);
       		 	return $xml;
            }
            /*Se verifica la ip*/
            if($row_ws_keys['ipkey'] != $ip_consumo){
             	$output['salida'] = 'ERROR';
            	$output['mensaje'] = 'Se esta consumiendo el servicio desde una IP no autorizada';
        	 	$xml = $this->array2xml($output);
       		 	return $xml;
            }
            /*Se verifica el titulo*/
            if($titulo_exp == ''){
             	$output['salida'] = 'ERROR';
            	$output['mensaje'] = 'No se ingreso el titulo del expediente';
        	 	$xml = $this->array2xml($output);
       		 	return $xml;
            }
            if($fecha_apertura == '' || $fecha_apertura == '0000-00-00'){
             	$output['salida'] = 'ERROR';
            	$output['mensaje'] = 'No se ingreso la fecha inicial';
        	 	$xml = $this->array2xml($output);
       		 	return $xml;
            }
            if($fecha_cierre == '' || $fecha_cierre == '0000-00-00'){
             	$output['salida'] = 'ERROR';
            	$output['mensaje'] = 'No se ingreso la fecha final';
        	 	$xml = $this->array2xml($output);
       		 	return $xml;
            }
            if($nit_suscriptor == ''){
             	$output['salida'] = 'ERROR';
            	$output['mensaje'] = 'No se ingreso el nit del suscriptor';
        	 	$xml = $this->array2xml($output);
       		 	return $xml;
            }
            if($nombre_suscriptor == ''){
             	$output['salida'] = 'ERROR';
            	$output['mensaje'] = 'No se ingreso el nombre del suscriptor';
        	 	$xml = $this->array2xml($output);
       		 	return $xml;
            }
            if($email_suscriptor == ''){
             	$output['salida'] = 'ERROR';
            	$output['mensaje'] = 'No se ingreso el email del suscriptor';
        	 	$xml = $this->array2xml($output);
       		 	return $xml;
            }

            /*verificar_formulario*/
            if($row_ws_keys['formulario'] > 0){
            	$teml = @(array)$xml['formulario'];

				$xml['formulario'] = [];
				$xml['formulario'] = $teml;
            	$formulario = [];
            	$formulario = $c->sql_quote($xml['formulario']);
				if(count($formulario[0]) <= 0){
					$formulario_temp = $formulario;
					$formulario = [];
					$formulario[0] = $formulario_temp;
				}
				for ($i=0; $i < count($formulario); $i++) {
					$resulg = $con->Query("select * from meta_referencias_campos where id_referencia = '".$row_ws_keys['formulario']."'");
					while($rowf = $con->FetchAssoc($resulg)){
						if($formulario[$i][$rowf['slug']] == ''){
			            	$output['salida'] = 'ERROR';
			            	$output['mensaje'] = 'El "'.$rowf['titulo_campo'].'" del formulario es obligatorio';
			        	 	$xml = $this->array2xml($output);
			       		 	return $xml;
			            }
			        }
		        }
            }

            /*Se verifica el susuario respnsable*/
            $MUsuarios = new MUsuarios;
			$MUsuarios->CreateUsuarios("a_i", $c->sql_quote($row_ws_keys['usuario_destino']));
            $MUsuariosr = new MUsuarios;
			$MUsuariosr->CreateUsuarios("a_i", $c->sql_quote($row_ws_keys['usuario_destino']));
			if($MUsuariosr->GetId() == '' || $MUsuariosr->GetId() == 0){
				$output['salida'] = "ERROR";
				$output['mensaje'] = "El usuario responsable no existe.";
				$xml = $this->array2xml($output);
       		 	return $xml;
			}
			if($codigo_externo == '' || strlen($codigo_externo) == 0){
				$output['salida'] = "ERROR";
				$output['mensaje'] = "El ID externo es obligatorio";
				$xml = $this->array2xml($output);
       		 	return $xml;
			}
			if($radicado == '' || strlen($radicado) == 0){
				$output['salida'] = "ERROR";
				$output['mensaje'] = "El Radicado es obligatorio";
				$xml = $this->array2xml($output);
       		 	return $xml;
			}
			$f_recibido = $fecha_apertura;
			$fecha_vencimiento = $fecha_cierre;
			$observacion = $titulo_exp;

			/*generar variables insert*/
			$dependencia = new MDependencias;
			$dependencia->CreateDependencias("id", $row_ws_keys['subserie']);

			$nombre_destino = $MUsuariosr->GetA_i();
	      	$usuario_registra = $MUsuarios->GetUser_id();
	      	$oficina = $row_ws_keys['oficina'];
	      	$area_principal = $row_ws_keys['area'];
	      	$user_id = $MUsuariosr->GetUser_id();
	      	$nombre_usuario = $MUsuariosr->GetP_nombre().' '.$MUsuariosr->GetP_apellido();
			$ciudadcodigo = $row_ws_keys['ciudad'];
			$ciudad = $row_ws_keys['ciudad'];

			$MSuscriptores_contactos = new MSuscriptores_contactos;
	        $MSuscriptores_contactos->CreateSuscriptores_contactos('identificacion',$nit_suscriptor);
	        if($MSuscriptores_contactos->GetId() == '' || $MSuscriptores_contactos->GetId() == 0){
				$createsuscr = $MSuscriptores_contactos->InsertSuscriptores_contactos($c->sql_quote($nit_suscriptor), $nombre_suscriptor, $c->sql_quote($tipo_suscriptor), $MUsuariosr->GetUser_id(), date("Y-m-d"));
				$suscriptor_id = $c->GetMaxIdTabla("suscriptores_contactos", "id");
				$suscd = new MSuscriptores_contactos_direccion;
				$suscd->InsertSuscriptores_contactos_direccion($suscriptor_id, $c->sql_quote($Direccion_suscriptor), $ciudadcodigo, $c->sql_quote($Telefonos_suscriptor), $c->sql_quote($Email_suscriptor), "");
				$suscriptor_id = $c->GetMaxIdTabla("suscriptores_contactos_direccion", "id");
				$nombre_radica = $nombre_suscriptor;
			}else{
				$suscriptor_id =  $MSuscriptores_contactos->GetId();
				$nombre_radica = $MSuscriptores_contactos->GetNombre();
				$MSuscriptores_contactos_direccion = new MSuscriptores_contactos_direccion;
				$MSuscriptores_contactos_direccion->CreateSuscriptores_contactos_direccion('id_contacto',$suscriptor_id);
				$Direccion_suscriptor =  $MSuscriptores_contactos_direccion->GetDireccion();
			}



			$folio = 1;
	        $tipo_documento = $row_ws_keys['subserie'];
	        $dependencia_destino = $row_ws_keys['area'];
	        $estado_respuesta = "Abierto";
	        $fecha_respuesta = "";
	        $prioridad  = "2";
	        $estado_solicitud = "1";
	        $estado_archivo = "1";
	        $id_dependencia_raiz = $row_ws_keys['serie'];
	      	//$num_oficio_respuesta = $ciudadcodigo.'-'.$f->zerofill($oficina,3).'-001-'.$f->zerofill($dependencia_destino,3);

	        $a = new MAreas;
			$a->CreateAreas("id", $dependencia_destino);

			$d = new MDependencias;
			$d->CreateDependencias("id", $tipo_documento);

			$dr = new MDependencias;
			$dr->CreateDependencias("id", $id_dependencia_raiz);

	      	$num_oficio_respuesta = date("Y")."-".$a->GetPrefijo()."-".$dr->GetId_c()."-".$d->GetId_c();
	      	$MGestion = new MGestion;
			$nr = $MGestion->GetNRadicado($num_oficio_respuesta, $ciudad, $oficina, $dependencia_destino, $id_dependencia_raiz, $tipo_documento);
			$minr = $MGestion->GetMinRadicado();
			// USANDO LA FUNCION DE INSERTAR DEL OBJETO PARA ENVIAR LA INFORMACION A LA BASE DE DATOA			
			$create = $MGestion->InsertGestion($radicado, $f_recibido, $nombre_radica, $folio, $tipo_documento, $dependencia_destino, $nombre_destino, $fecha_vencimiento, $estado_respuesta, $nr, $fecha_respuesta, $observacion, $prioridad, $estado_solicitud, $suscriptor_id, $ciudad, $usuario_registra, $estado_archivo, $oficina, $id_dependencia_raiz, $minr, "N" ,$id_externo);
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
			if ($suscriptor_id != "") {
				$s = new MGestion_suscriptores();
				$s->InsertGestion_suscriptores($id, $suscriptor_id, $usuario_registra, "1", "1", date("Y-m-d "));
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
			$aertasau = $con->Query("Select * from dependencias_alertas where id_dependencia = '".$tipo_documento."' and automatica = 'SI'");
			while ($rowau = $con->FetchAssoc($aertasau)) {
				$alerta = $rowau['id'];
				$gestion = $id;
				$depa = new MDependencias_alertas;
				$depa->CreateDependencias_alertas("id", $alerta);
				$fecha = date("Y-m-d");
				$fecha_c = date_create($fecha);//aca le pasas la fecha actual o ala que le queres sumar los dias.
				date_modify($fecha_c, $depa->GetDias_alerta()." day");//sumas los dias que te hacen falta.
				$fecha_a = date_format($fecha_c, "Y-m-d");//retornas la fecha en el formato que mas te guste.
			}

			/*SE CREA EL FORMULARIO*/
			if($row_ws_keys['formulario'] > 0){
				$formulario = [];
				$formulario = $c->sql_quote($xml['formulario']);
				if(count($formulario[0]) <= 0){
					$formulario_temp = $formulario;
					$formulario = [];
					$formulario[0] = $formulario_temp;
				}
		        for ($i=0; $i < count($formulario); $i++) {
			        $checkInsert = $con->Query("select * from meta_referencias_campos where id_referencia = '".$row_ws_keys['formulario']."'");
					$smallid = $f->GenerarSmallId();
					while ($rrrx = $con->FetchAssoc($checkInsert)) {
						$con->Query("INSERT INTO meta_big_data (type_id, ref_id, campo_id, valor, grupo_id, tipo_form, fecha_registro) VALUES ('".$id."', '".$row_ws_keys['formulario']."', '".$rrrx['id']."', '".$formulario[$i][$rrrx['slug']]."', '".$smallid."', '1', '".date("Y-m-d")."')");
					}
				}
            }

			$output['salida'] = "OK";
			$output['mensaje'] = "Registro Exitoso!";
			$output['radicado'] = $minr;
			$xml = $this->array2xml($output);
   		 	return $xml;
	    }
	    public function array2XML($data, $rootNodeName = 'results', $xml=NULL){
		    if ($xml == null){
		        $xml = simplexml_load_string("<?xml version='1.0' encoding='utf-8'?><$rootNodeName />");
		    }
		    foreach($data as $key => $value){
		        if (is_numeric($key)){
		            $key = "nodeId_". (string) $key;
		        }
		        if (is_array($value)){
		            $node = $xml->addChild($key);
		            $this->array2XML($value, $rootNodeName, $node);
		        } else {
		            $value = htmlentities($value);
		            $xml->addChild($key, $value);
		        }
		    }
		    return html_entity_decode($xml->asXML());
		}
	}

	#ESTA FUNCION NOS GENERA EL ARCHIVO WSDL QUE ES EL ARCHIVO DE CONFIGURACION DEL SEBSER
    $server = new soap_server();
    $server->configureWSDL("ws.xml.gestion", "urn:ws.xml.gestion");
    $server->register("Gestion.GetDataXml",
    			        array("xmlstring" => "xsd:string"),
				        array("return" => "xsd:string"),
				        "urn:ws.xml.gestion",
				        "urn:ws.xml.gestion#GetDataXml",
				        "rpc",
				        "encoded",
				        "Creacion de expediente spor medio de un string XML");
    $server->register("Gestion.AddDataXml",
    			        array("xmlstring" => "xsd:string"),
				        array("return" => "xsd:string"),
				        "urn:ws.xml.gestion",
				        "urn:ws.xml.gestion#AddDataXml",
				        "rpc",
				        "encoded",
				        "Agregar documentos a un expediente por medio de un string XML");
    $server->register("Gestion.SetDataXml",
    			        array("xmlstring" => "xsd:string"),
				        array("return" => "xsd:string"),
				        "urn:ws.xml.gestion",
				        "urn:ws.xml.gestion#SetDataXml",
				        "rpc",
				        "encoded",
				        "Consultar un expediente por medio de un string XML");
   if (!isset( $HTTP_RAW_POST_DATA)) $HTTP_RAW_POST_DATA =file_get_contents( 'php://input' );
   $server->service($HTTP_RAW_POST_DATA);
?>