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

	class Gestion{

		public function GetData($key, $cedula, $nit_suscriptor,$nombre_suscriptor,$tipo_suscriptor,$Direccion_suscriptor,$Telefonos_suscriptor,$Email_suscriptor,$radicado,$dependencia_destino, $observacion, $id_externo, $fecha_ingreso) {

			global $con;

			global $c;

			global $f;

			try {

				$checkKey = $c->wscontrol($key);

				$output = array();

				if ($checkKey) {

			        $output['0'] = "logged";

			        #CODE STARTS HERE



			        $arrcedulas = explode(':::', $cedula);

			        if(count($arrcedulas)>1){

			        	$cedula =  $arrcedulas[0];

			        	$cedular =  $arrcedulas[1];



			        	$MUsuarios = new MUsuarios;

						$MUsuarios->CreateUsuarios("id", $c->sql_quote($cedula));



						$MUsuariosr = new MUsuarios;

						$MUsuariosr->CreateUsuarios("id", $c->sql_quote($cedular));

			        }else{

			        	$cedula =  $arrcedulas[0];

			        	$cedular =  $arrcedulas[0];



			        	$MUsuarios = new MUsuarios;

						$MUsuarios->CreateUsuarios("id", $c->sql_quote($cedula));



						$MUsuariosr = new MUsuarios;

						$MUsuariosr->CreateUsuarios("id", $c->sql_quote($cedula));

			        }

# 	/*

			        /*$MUsuarios = new MUsuarios;

					$MUsuarios->CreateUsuarios("id", $c->sql_quote($cedula));

					$dependencia = new MDependencias;

					$dependencia->CreateDependencias("id", $dependencia_destino);

					if($MUsuarios->GetId() == '' || $MUsuarios->GetId() == 0){

						$output['1'] = "0";

						$output['2'] = "El usuario es obligatorio";

						return join(",", $output );

					}*/



					$dependencia = new MDependencias;

					$dependencia->CreateDependencias("id", $dependencia_destino);

					if($MUsuariosr->GetId() == '' || $MUsuariosr->GetId() == 0){

						$output['1'] = "0";

						$output['2'] = "El usuario es obligatorio";

						return join(",", $output );

					}







					if($id_externo == '' || strlen($id_externo) == 0){

						$output['1'] = "0";

						$output['2'] = "El ID externo es obligatorio";

						return join(",", $output );

					}



					$MSuscriptores_contactos = new MSuscriptores_contactos;

			        $MSuscriptores_contactos->CreateSuscriptores_contactos('identificacion',$nit_suscriptor);

			        if($MSuscriptores_contactos->GetId() == '' || $MSuscriptores_contactos->GetId() == 0){



						if($nit_suscriptor == '' || $nombre_suscriptor == '' || $Email_suscriptor == ''){

							$output['1'] = "0";

							$output['2'] = "El nit nombre email del suscriptor son obligatorios";

							return join(",", $output );

						}



					}

					$varfecha = explode(':::', $fecha_ingreso);

					$f_recibido = $varfecha[0];

					if($f_recibido == ''){

						$f_recibido = date('Y-m-d');

					}					



					if(count($varfecha) > 1){

						$fecha_vencimiento = $varfecha[1];

					}else{

						$fecha = date_create($f_recibido);

						date_add($fecha, date_interval_create_from_date_string('3 days'));

						$fecha_vencimiento = date_format($fecha, 'Y-m-d');

					}

					

					$Ciudad_suscriptor = $MUsuariosr->GetCiudad();

			       	$dtform = $nombre_radica;

			      	$nombre_destino = $MUsuariosr->GetA_i();

			      	$ciudad = $MUsuariosr->GetCiudad();

			      	$usuario_registra = $MUsuarios->GetUser_id();

			      	$oficina = $MUsuariosr->GetSeccional();

			      	$area_principal = $MUsuariosr->GetRegimen();

			      	$user_id = $MUsuariosr->GetUser_id();

			      	$nombre_usuario = $MUsuariosr->GetP_nombre().' '.$MUsuariosr->GetP_apellido();

			      	$q_strx = "SELECT ciudad from seccional WHERE id='".$oficina."'";

					$queryx = $con->Query($q_strx);

					$ciudadcodigo = $con->Result($queryx, 0, "ciudad");

					$ciudad = $ciudadcodigo;

			        $MSuscriptores_contactos = new MSuscriptores_contactos;

			        $MSuscriptores_contactos->CreateSuscriptores_contactos('identificacion',$nit_suscriptor);

			        if($MSuscriptores_contactos->GetId() == '' || $MSuscriptores_contactos->GetId() == 0){

						$createsuscr = $MSuscriptores_contactos->InsertSuscriptores_contactos($c->sql_quote($nit_suscriptor), $nombre_suscriptor, $c->sql_quote($tipo_suscriptor), $MUsuariosr->GetUser_id(), date("Y-m-d"));

						$suscriptor_id = $c->GetMaxIdTabla("suscriptores_contactos", "id");

						$suscd = new MSuscriptores_contactos_direccion;

						$suscd->InsertSuscriptores_contactos_direccion($suscriptor_id, $c->sql_quote($Direccion_suscriptor), $ciudadcodigo, $c->sql_quote($Telefonos_suscriptor), $c->sql_quote($Email_suscriptor), "");

						$suscriptor_id = $c->GetMaxIdTabla("suscriptores_contactos_direccion", "id");

						$nombre_radica = $nombre_suscriptor;

					} else {

						$suscriptor_id =  $MSuscriptores_contactos->GetId();

						$nombre_radica = $MSuscriptores_contactos->GetNombre();

						$MSuscriptores_contactos_direccion = new MSuscriptores_contactos_direccion;

						$MSuscriptores_contactos_direccion->CreateSuscriptores_contactos_direccion('id_contacto',$suscriptor_id);

						$Direccion_suscriptor =  $MSuscriptores_contactos_direccion->GetDireccion();

					}





			        

					

			        $folio = 1;

			        $tipo_documento = $dependencia->GetId();

			        $dependencia_destino = $MUsuariosr->GetRegimen();

			        $estado_respuesta = "NO";

			        $fecha_respuesta = "";

			        $prioridad  = "2";

			        $estado_solicitud = "1";

			        $estado_archivo = "1";

			        $id_dependencia_raiz = $dependencia->GetDependencia();

			      	$num_oficio_respuesta = $ciudadcodigo.'-'.$f->zerofill($oficina,3).'-001-'.$f->zerofill($dependencia_destino,3);

			      	$MGestion = new MGestion;

					$nr = $MGestion->GetNRadicado($num_oficio_respuesta, $ciudad, $oficina, $dependencia_destino, $id_dependencia_raiz, $tipo_documento);

					$minr = $MGestion->GetMinRadicado();

					// USANDO LA FUNCION DE INSERTAR DEL OBJETO PARA ENVIAR LA INFORMACION A LA BASE DE DATOA			

					$create = $MGestion->InsertGestion($radicado, $f_recibido, $nombre_radica, $folio, $tipo_documento, $dependencia_destino, $nombre_destino, $fecha_vencimiento, $estado_respuesta, $nr, $fecha_respuesta, $observacion, $prioridad, $estado_solicitud, $suscriptor_id, $ciudad, $usuario_registra, $estado_archivo, $oficina, $id_dependencia_raiz, $minr, "" ,$id_externo);

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

					// USANDO LA FUNCION DE INSERTAR DEL OBJETO PARA ENVIAR LA INFORMACION A LA BASE DE DATOA			

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

					$output['1'] = "1";

					$output['2'] = "Registro Exitoso!";

					$output['3'] = $id;

#	*/

					return join(",", $output );

				}else{

					$output[0] = "invalid Key";

					return join(",", $output );

				}

			}catch(Exception $e){

				$output[0] = "some Exception $e";

				return join(",", $output );

			}

	    }

	    function UpdateGestion($key, $estado_solicitud, $nombre_destino, $tipo_documento, $observacion, $estado_archivo, $id_externo) {

	        global $con;

	        global $c;

	        global $f;

	        try {

	            $checkKey = $c->wscontrol($key);

	            $output = array();

	            if ($checkKey) {

	                $output['0'] = "logged";

	                $object = new MGestion;

					$object->CreateGestion("id_servicio", $id_externo);

					$path = "";

		    		$change = false;

		    		$changeuser = false;

		    		$constrain = "WHERE id_servicio = '".$id_externo."'";

		    		$fields = array();

		    		$updates= array();

					$idnr = new MUsuarios;

					$idnr->CreateUsuarios("id", $nombre_destino);

		    		if($object->GetNombre_destino() != $nombre_destino && strlen($nombre_destino) > 0){

						$responsablea = $c->GetDataFromTable("usuarios", "a_i", $object->GetNombre_destino(), "p_nombre, p_apellido", $separador = " ");

						$responsableb = $c->GetDataFromTable("usuarios", "id", $nombre_destino, "p_nombre, p_apellido", $separador = " ");

						$id_n = $c->GetDataFromTable("usuarios", "id", $nombre_destino, "a_i", $separador = " ");

						$q_strx = "SELECT ciudad from seccional WHERE id='".$idnr->GetSeccional()."'";

						$queryx = $con->Query($q_strx);

						$ciudad = $con->Result($queryx, 0, "ciudad");

						$ciudada = $c->GetDataFromTable("city", "code", $object->GetCiudad(), "Name", $separador = " ");

						$ciudadb = $c->GetDataFromTable("city", "code", $ciudad, "Name", $separador = " ");

						$oficinaa = $c->GetDataFromTable("seccional", "id", $object->GetOficina(), "nombre", $separador = " ");

						$oficinab = $c->GetDataFromTable("seccional", "id", $idnr->GetSeccional(), "nombre", $separador = " ");

						$areaa = $c->GetDataFromTable("areas", "id", $object->GetDependencia_destino(), "nombre", $separador = " ");

						$areab = $c->GetDataFromTable("areas", "id", $idnr->GetRegimen(), "nombre", $separador = " ");

		    			$path .= "<li>Se edito el campo Ciudad '".$ciudada."' por '".$ciudadb."' </li>";

		    			$path .= "<li>Se edito el campo Oficina '".$oficinaa."' por '".$oficinab."' </li>";

		    			$path .= "<li>Se edito el campo Area de Trabajo '".$areaa."' por '".$areab."' </li>";

		    			$path .= "<li>Se edito el campo usuario destino '".$responsablea."' por '".$responsableb."' </li>";

		    			$change = true;

		    			$changeuser = true;

		    			array_push($fields, 'nombre_destino');

		    			array_push($updates, $id_n);

		    			array_push($fields, 'dependencia_destino');

		    			array_push($updates, $idnr->GetRegimen());

		    			array_push($fields, 'ciudad');

		    			array_push($updates, $ciudad);

		    			array_push($fields, 'oficina');

		    			array_push($updates, $idnr->GetSeccional());

		    		}

		    		if($object->GetEstado_respuesta() != $estado_solicitud && strlen($estado_solicitud) > 0){

		    			$path .= "<li>Se edito el campo Estado de respuesta de '".$object->GetEstado_respuesta()."' por '$estado_solicitud' </li>";

		    			$change = true;

		    			if($estado_solicitud == 'SI'){

		    				$con->Query("UPDATE alertas set status = '2' where id_gestion = '".$object->GetId()."'");

							$con->Query("UPDATE events_gestion set status = '2' where gestion_id = '".$object->GetId()."'");

							$con->Query("UPDATE alertas SET keep_alive = '0' where id_gestion = '".$object->GetId()."' and type = '0'");

							$con->Query("UPDATE alertas SET keep_alive = '0' where id_gestion = '".$object->GetId()."' and type = '1' and status = '2'");

		    			}

		    			array_push($fields, 'estado_respuesta');

		    			array_push($updates, $estado_solicitud);

		    		}

		    		if($object->GetObservacion() != $observacion && strlen($observacion) > 0){

		    			$path .= "<li>Se edito el campo observacion de '".$object->GetObservacion()."' por '$observacion' </li>";

		    			$change = true;

		    			array_push($fields, 'observacion');

		    			array_push($updates, $observacion);

		    		}

		    		if($object->GetEstado_archivo() != $estado_archivo && strlen($estado_archivo) > 0){

		    			$ar2 = array("1" => "Archivo de Gestión", "2" => "Archivo Central", "3" => "Archivo Histórico", "-1" => "Eliminación", "-2" => "Conservación Total", "-3" => "Digitalización", "-4" => "Selección", "-5" => "MicroFilmación");

		    			$path .= "<li>Se edito el campo archivo de '".$ar2[$object->GetEstado_archivo()]."' por '".$ar2[$estado_archivo]."' </li>";

		    			$change = true;

		    			$con->Query("UPDATE alertas set status = '2' where id_gestion = '".$object->GetId()."'");

						$con->Query("UPDATE events_gestion set status = '2' where gestion_id = '".$object->GetId()."'");

						$con->Query("UPDATE alertas SET keep_alive = '0' where id_gestion = '".$object->GetId()."' and type = '0'");

						$con->Query("UPDATE alertas SET keep_alive = '0' where id_gestion = '".$object->GetId()."' and type = '1' and status = '2'");

						array_push($fields, 'estado_archivo');

		    			array_push($updates, $estado_archivo);

		    		}

					if($object->GetTipo_documento() != $tipo_documento && strlen($tipo_documento) > 0){

						$subseriea = $c->GetDataFromTable("dependencias", "id", $object->GetTipo_documento(), "nombre", $separador = " ");

						$subserieb = $c->GetDataFromTable("dependencias", "id", $tipo_documento, "nombre", $separador = " ");

		    			$path .= "<li>Se edito el campo Sub Serie de '".$subseriea."' por '$subserieb' </li>";

		    			$change = true;

		    			$dx = new MDependencias;

		    			$dx->CreateDependencias("id", $tipo_documento);

		    			$dy = new MDependencias;

		    			$dy->CreateDependencias("id", $dx->GetDependencia());

		    			$seriea = $c->GetDataFromTable("dependencias", "id", $object->GetId_dependencia_raiz(), "nombre", $separador = " ");

		    			$serieb = $c->GetDataFromTable("dependencias", "id", $dy->GetId(), "nombre", $separador = " ");

		    			$path .= "<li>Se edito el campo Serie de '".$seriea."' por '$serieb' </li>";

		    			array_push($fields, 'tipo_documento');

		    			array_push($updates, $tipo_documento);

		    			array_push($fields, 'id_dependencia_raiz');

		    			array_push($updates, $dy->GetId());

		    		}

					if($change){

						$objecte = new MEvents_gestion;

						$create = $object->UpdateGestion($constrain, $fields, $updates, $output);

						$objecte->InsertEvents_gestion($_SESSION['usuario'], $object->GetId (), date("Y-m-d"), "Expediente ".$object->GetNum_oficio_respuesta()." Editado", "Se ha editado la informacion del Expediente  <ul>".$c->sql_quote($path)."</ul>", date("Y-m-d"), 0, date("H:i:s"), 0, 0, 0, date("Y-m-d"), 0, $_SESSION['seccional'], $_SESSION['area_principal'], $_SESSION['area_principal'], "*", "eexp", $object->GetId());

					}

					if ($changeuser) {

						$objecte = new MEvents_gestion;

						$us = new MUsuarios;

						$us->CreateUsuarios("a_i", $_REQUEST['nombre_destino']);

						$objecte->InsertEvents_gestion($_SESSION['usuario'], $object->GetId (), date("Y-m-d"), "Expediente ".$object->GetNum_oficio_respuesta()." Transferido", "El Expediente ha sido transferndo al usuario ".$us->GetP_nombre()." ".$us->GetP_apellido(), date("Y-m-d"), 0, date("H:i:s"), 0, 0, 0, date("Y-m-d"), 0, $_SESSION['seccional'], $_SESSION['area_principal'], $_SESSION['area_principal'], $us->GetA_i(), "texp", $us->GetA_i());

					}

/*

					*/

					$output['1'] = "1";

					$output['2'] = "Registro Actualizado!".$create;

					$output['3'] = $create;

				//SI NO SE ENVIO CORRECTAMENTE ENTONCES GENERA ERROR SINO ENVIA OK

	                return join(",", $output );

	            }else{

	                $output[0] = "invalid Key";

	                return join(",", $output );

	            }

	        }catch(Exception $e){

	            $output[0] = "some Exception $e";

	            return join(",", $output );

	        }

	    }

		function UpdateGestionCodigoExterno($key, $id_externo, $id_gestion) {
	        global $con;
	        global $c;
	        global $f;
	        try {
	            $checkKey = $c->wscontrol($key);
	            $output = array();
	            if ($checkKey) {
	            	$con->Query("UPDATE gestion set id_servicio = '".$id_externo."' where id = '".$id_gestion."' and id_servicio = '0'");
	                $output['0'] = "logged";
	                $output['1'] = "1";
					$output['2'] = "Registro Actualizado!";
					$output['3'] = "";
	                return join(",", $output );
	            }else{
	                $output[0] = "invalid Key";
	                return join(",", $output );
	            }
	        }catch(Exception $e){
	            $output[0] = "some Exception $e";
	            return join(",", $output );
	        }
	    }
	}

	#ESTA FUNCION NOS GENERA EL ARCHIVO WSDL QUE ES EL ARCHIVO DE CONFIGURACION DEL SEBSER

    $server = new soap_server();

    $server->configureWSDL("siw.gestion", "urn:siw.gestion");

    $server->register("Gestion.GetData",

    			        array("key" => "xsd:string", "cedula" => "xsd:string", "nit_suscriptor" => "xsd:string", "nombre_suscriptor" => "xsd:string", "tipo_suscriptor" => "xsd:string", "Direccion_suscriptor" => "xsd:string", "Telefonos_suscriptor" => "xsd:string", "Email_suscriptor" => "xsd:string", "radicado" => "xsd:string", "dependencia_destino" => "xsd:string", "observacion" => "xsd:string", "id_externo" => "xsd:string", "fecha_ingreso" => "xsd:string"),

				        array("return" => "xsd:string"),

				        "urn:Siw.Gestion",

				        "urn:Siw.Gestion#GetData",

				        "rpc",

				        "encoded",

				        "Servicio de prueba");

      $server->register("Gestion.UpdateGestion",

    			        array("key" => "xsd:string", "estado_solicitud" => "xsd:string", "nombre_destino" => "xsd:string", "tipo_documento" => "xsd:string", "observacion" => "xsd:string", "estado_archivo" => "xsd:string", "id_externo" => "xsd:string"),

				        array("return" => "xsd:string"),

				        "urn:Siw.Gestion",

				        "urn:Siw.Gestion#UpdateGestion",

				        "rpc",

				        "encoded",

				        "Servicio de prueba");

      $server->register("Gestion.UpdateGestionCodigoExterno",

    			        array("key" => "xsd:string", "id_externo" => "xsd:string", "id_gestion" => "xsd:string"),

				        array("return" => "xsd:string"),

				        "urn:Siw.Gestion",

				        "urn:Siw.Gestion#UpdateGestionCodigoExterno",

				        "rpc",

				        "encoded",

				        "Servicio de prueba");

    $server->service($HTTP_RAW_POST_DATA);

?>