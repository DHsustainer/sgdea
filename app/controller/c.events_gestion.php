<?
session_start();
#error_reporting(E_ALL);
#ini_set('display_errors', '1');
	//Invocando archivos que seran usados en nuestro controlador generico	
	include_once('app/basePaths.inc.php');
	include_once(MODELS.DS.'Events_gestionM.php');
	include_once(ROOT.DS.'DALC'.DS.'/mySql.php');
	include_once(MODELS.DS.'Dependencias_alertasM.php');
	include_once(MODELS.DS.'Gestion_anexosM.php');
	include_once(MODELS.DS.'GestionM.php');
	include_once(MODELS.DS.'Suscriptores_contactosM.php');
	include_once(MODELS.DS.'Suscriptores_contactos_direccionM.php');
	include_once(MODELS.DS.'UsuariosM.php');
	include_once(MODELS.DS.'Super_adminM.php');
	include_once(MODELS.DS.'Plantilla_documento_configuracionM.php');
	include_once(MODELS.DS.'Plantillas_emailM.php');

	include_once('consultas.php');
	include_once('funciones.php');	
	include_once(PLUGINS.DS.'dompdf/dompdf_config.inc.php');

	// Definiendo variables y conectandonos con la base de datos
	$con = new ConexionBaseDatos;
	$con->Connect($con);
	
	// Llamando al objeto a controlar		
	$ob = new CEvents_gestion;
	$c = new Consultas;
	$f = new Funciones;
	
	// DEFINIMOS EN UN VECTOR LOS CAMPOS QUE VAMOS A EDITAR
	$ar2 = array('gestion_id', 'fecha', 'title', 'description', 'status', 'time', 'avisar_a', 'es_publico');
	// DEFINIMOS EN OTRO VECTOR LOS NUEVOS DATOS QUE VAMOS A METER	
	$ar1 = array($c->sql_quote($_REQUEST['gestion_id']), $c->sql_quote($_REQUEST['fecha']), $c->sql_quote($_REQUEST['title']), $c->sql_quote($_REQUEST['description']), $c->sql_quote($_REQUEST['status']), $c->sql_quote($_REQUEST['time']), $c->sql_quote($_REQUEST['avisar_a']), $c->sql_quote($_REQUEST['es_publico']));	
	// DEFINIMOS LOS ESTADOS DE SALIDA
	$output = array('registro actualizado', 'no se pudo actualizar'); 
	// Y POR ULTIMO DEFINIMOS EL CONTRAIN PARA LA ACTUALIZACION	
	$constrain = 'WHERE id = '.$_REQUEST['id'];
	
		// LA FUNCION SQLQUOTE de la clase Consultas se encarga de fultrar las variables recibidas por GET o por POST para evitar la inyeccion de SQL
		// esta funcion solo funciona cuando se ha establecido conexion con la base de datos
		// SI LA ACTION CAPTURADA ES LISTAR ENTONCES LISTA
		if($c->sql_quote($_REQUEST['action']) == 'listar')
			$ob->VistaListar('');	
		// SINO SI ES NUEVO ENTONCES CARGA EL FORMULARIO INSERTAR	
		elseif($c->sql_quote($_REQUEST['action']) == 'nuevo')	
			$ob->VistaInsertar();
		// SINO SI ES INSERTAR ENTONCES CARGA EL INSERTAR	
		elseif($c->sql_quote($_REQUEST['action']) == 'registrar')
		// CAPTURA LAS VARIAABLES Y ENVIALAS A LA FUNCION INSERTAR		
			$ob->Insertar($c->sql_quote($_REQUEST["user_id"]), $c->sql_quote($_REQUEST["gestion_id"]), $c->sql_quote($_REQUEST["fecha"]), $c->sql_quote($_REQUEST["title"]), $c->sql_quote($_REQUEST["description"]), $c->sql_quote($_REQUEST["added"]), $c->sql_quote($_REQUEST["status"]), $c->sql_quote($_REQUEST["time"]), $c->sql_quote($_REQUEST["alerted"]), $c->sql_quote($_REQUEST["avisar_a"]), $c->sql_quote($_REQUEST["type_event"]), $c->sql_quote($_REQUEST["fecha_vencimiento"]), '0', '0', '0', '0',  $c->sql_quote($_REQUEST["grupo"]),  $c->sql_quote($_REQUEST["es_publica"]), $c->sql_quote($_REQUEST["C_F_0"]), $c->sql_quote($_REQUEST["es_recordatorio"]), $c->sql_quote($_REQUEST["title_select"]), $c->sql_quote($_REQUEST["tipoalerta"]));
		// SINO SI ES EDITAR ENTONCES CARGA EL FORMULARIO EDITAR	
		elseif($c->sql_quote($_REQUEST['action']) == 'editar')
			$ob->VistaEditar($c->sql_quote($_REQUEST['id']));	
		// SINO SI ES ACTUALIZAR ENTONCES ENVIA UNA ACTUALIZACION CON LOS PARAMETROS CAPTURADOS
		elseif($c->sql_quote($_REQUEST['action']) == 'actualizar')
			$ob->Editar($constrain, $ar2, $ar1, $output, $c->sql_quote($_REQUEST["gestion_id"]));
		// SINO SI ES ELIMINAR ENTONCES CARGA LA FUNCION ELIMINAR
		elseif($c->sql_quote($_REQUEST['action']) == 'eliminar')
			$ob->Eliminar($c->sql_quote($_REQUEST['id']));
		elseif($c->sql_quote($_REQUEST['action']) == 'getevento')
			$ob->GetEvento($c->sql_quote($_REQUEST['id']));
		// SINO SI ES NUEVO BUSCAR CARGA EL BUSCADOR			
		elseif($c->sql_quote($_REQUEST['action']) == 'buscar')
			$ob->Buscar($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['cn']));		
		elseif($c->sql_quote($_REQUEST['action']) == 'activatealerta')
			$ob->ActivarAlerta($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['cn']));					
		elseif($c->sql_quote($_REQUEST['action']) == 'exportaractuaciones')
			$ob->ExportarActuaciones($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['cn']));					

		else
		// SI NO ES NINGUNA DE LAS ANTERIORES ENTONCES CARGA POR DEFECTO LA VISTA DE LISTADO		
			$ob->VistaListar('');		
	
	// DEFINIENDO LA CLASE DEL CONTROLADOR DEL OBJETO QUE TIENE HERENCIA CON EL CONTROLADOR GENERICO PARA CARGAR LA INTERFAZ
	class CEvents_gestion extends MainController{
		
		// DEFINIENDO LA FUNCION LISTAR 		
		function VistaListar(){
			// CREANDO UN NUEVO MODELO			
			$object = new MEvents_gestion;
			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL			
			global $con;
			//CARGANDO LA PAGINA DE INTERFAZ			
			$pagina = $this->load_template('Listar Events_gestion');			
			// CARGANDO LLAMANDO LA FUNCION LSITAR LIBROS DEL MODELO (FUNCION QUE TRAE DE LA BASE DE DATOS EL LISTADO DE LIBROS
			// DE NO RECIBIR PARAMETROS ESTA FUNCION TRAE EL LISTADO COMPLETO DE LIBROS
			$query = $object->ListarEvents_gestion();	    
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();
				// SI LA CONSULTA NO SE EJECUTA ENTONCES RETORNA VACIO
		   		if($con->NumRows($query) <= 0 || $query !=''){
					// SI LA CONSULTA SE EJECUTA ENTONCES CARGA EL LISTADO DE LIBROS DE LA VISTA
					include_once(VIEWS.DS.'events_gestion/Listar.php');	   			
					// OBTIENE EL CONTENIDO DEL BÚFER ACTUAL Y ELIMINA EL BÚFER DE SALIDA ACTUAL.			
					$table = ob_get_clean();	
					// SI NO TRAE NINGUNA VARIABLE ENTONCES GENERA UN ERROR
					if($message != '')
					$pagina = $this->replace_content('/\#ERROR_MESSAGE\#/ms', $message , $pagina);
					// DE LO CONTRARIO ENTONCES CARGA EL CONTENIDO DE LA PAGINA																
					$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $table , $pagina);
				}else{
					// SI NO SE EJECUTA LA CONSULTA ENTONCES GENERA MENSAJE DE ERROR
		   			$pagina = $this->replace_content('/\#CONTENIDO\#/ms' ,'<h1>No existen resultados</h1>' , $pagina);	
				}
			// RETORNAME LA PAGINA CARGADA		
			$this->view_page($pagina);
		}
		// FUNCION QUE CARGA LA VISTA DE INSERTAR (FORMULARIO DE INSERTAR)
		function VistaInsertar(){
			//CARGA EL TEMPLATE
			$pagina = $this->load_template('Crear Events_gestion');			
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();
			include_once(VIEWS.DS.'events_gestion/FormInsertEvents_gestion.php');				
			// OBTIENE EL CONTENIDO DEL BÚFER ACTUAL Y ELIMINA EL BÚFER DE SALIDA ACTUAL.						
			$path = ob_get_clean();	
			// ASIGNANDOLE A LA VARIABLE  EL CONTENIDO DEL BUFFER																																																															
			$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $path  , $pagina);
			// CARGAMOS LA PAGINA EN EL BROWSER	
			$this->view_page($pagina);		
		}
		// FUCNION QUE CARGA LA VISTA PARA EDITAR EL CONTENIDO DE UN REGISTRO
		function VistaEditar($x){
			// CARGA EL TEMPLATE			
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA 	// INVOCAMOS UN NUEVO OBJETO
		 	$object = new MEvents_gestion;
			// LO CREAMOS 			
			$object->CreateEvents_gestion('id', $x);
			// Y FINALMENTE CARGAMOS LA VISTA DE EDICION QUE MUESTRA EL CONTENIDO			
			include_once(VIEWS.DS.'events_gestion/FormUpdateEvents_gestion.php');		
	 	}	
	 	function Buscar($x, $cn = 'id'){
	 		// INVOCAMOS UN NUEVO OBJETO						
			$object = new MEvents_gestion;
			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL						
			global $con;
			// CARGA EL TEMPLATE						
			$pagina = $this->load_template('Listado de Events_gestion');			
			// OBTENEMOS EL LISTADO DE LIBROS DE ACUERDO A LOS PARAMETROS QUE LE ENVIAMOS						
			$query = $object->ListarEvents_gestion('WHERE '.$cn.' = "'.$x.'"');	    
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();		
		   		if($con->NumRows($query) <= 0 || $query !=''){
					// SI LA CONSULTA NO SE EJECUTA ENTONCES RETORNA VACIO							
					include_once(VIEWS.DS.'events_gestion/Listar.php');	   			
					// OBTIENE EL CONTENIDO DEL BÚFER ACTUAL Y ELIMINA EL BÚFER DE SALIDA ACTUAL.								 								
					$table = ob_get_clean();	
					// ASIGNANDOLE A LA VARIABLE  EL CONTENIDO DEL BUFFER																																																		
					$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $table , $pagina);
				}else{
						// ASIGNANDOLE A LA VARIABLE  EL CONTENIDO DEL BUFFER																			
			   			$pagina = $this->replace_content('/\#CONTENIDO\#/ms' ,'<h1>No existen resultados</h1>' , $pagina);	
				}		
			// CARGAMOS LA PAGINA EN EL BROWSER				
			$this->view_page($pagina);
	 	}		
		// FUNCION QUE OBTIENE UNA SERIE DE DATOS Y LOS INSERTA EN LA BASE DE DATOS		
		function Insertar($user_id, $gestion_id, $fecha, $title, $description, $added, $status, $time, $alerted, $avisar_a, $type_event, $fecha_vencimiento, $id_generico = "0", $seccional = "0", $oficina = "0", $area = "0", $grupo = "0", $es_publica = "0", $adjunto = "", $recordatorio = "", $title_select = "0", $tipoalerta = ""){
			// DEFINIENDO EL OBJETO			
			global $con;
			global $c;

			$object = new MEvents_gestion;
			$es_publica = ($es_publica == "on")?"1":"0";
			$recordatorio = ($recordatorio == "on")?"1":"0";

			$g = new MGestion;
			$g->CreateGestion("id", $gestion_id);

			if ($grupo == "AllOficina") {
				$q = $con->Query("Select a_i from usuarios where seccional = '".$_SESSION['seccional']."' and regimen = '".$_SESSION['area_principal']."'");
				while ($row = $con->FetchAssoc($q)) {
					
					$id = $c->GetMaxIdTabla("events_gestion", "id");
					$id += 1;
					// USANDO LA FUNCION DE INSERTAR DEL OBJETO PARA ENVIAR LA INFORMACION A LA BASE DE DATOA			
					$create = $object->InsertEvents_gestion($user_id, $gestion_id, $fecha, $title, $description, $added, $status, $time, $alerted, $avisar_a, $type_event, $fecha_vencimiento, $title_select, $_SESSION['seccional'], $_SESSION['area_principal'], $_SESSION['area_principal'], $row['a_i'], "ev",  $id, $es_publica, $recordatorio, $tipoalerta);

					if ($title_select != "" || $title_select != "0") {
						# code...
						$aertasau = $con->Query("Select * from dependencias_alertas where dependencia_alerta = '".$title_select."' and automatica = 'SI'");

						while ($rowau = $con->FetchAssoc($aertasau)) {

							$alerta = $rowau['id'];
							$gestion = $gestion_id;
							$depa = new MDependencias_alertas;
							$depa->CreateDependencias_alertas("id", $alerta);
							$fecha = date("Y-m-d");
							$fecha_c = date_create($fecha);//aca le pasas la fecha actual o ala que le queres sumar los dias.
							date_modify($fecha_c, $depa->GetDias_alerta()." day");//sumas los dias que te hacen falta.
							$fecha_a = date_format($fecha_c, "Y-m-d");//retornas la fecha en el formato que mas te guste.
							$eventoe = new MEvents_gestion;
						#	// USANDO LA FUNCION DE INSERTAR DEL OBJETO PARA ENVIAR LA INFORMACION A LA BASE DE DATOA
							$create = $eventoe->InsertEvents_gestion($_SESSION['usuario'], $gestion, $fecha_a, $depa->GetNombre(), $depa->GetDescripcion(), date("Y-m-d"), $status, date("H:i:s"), $alerted, $depa->GetDias_antes(), $type_event, $fecha_a, $alerta, $_SESSION['seccional'], $_SESSION['area_principal'], $_SESSION['area_principal'], $row['a_i'], 'ev', $gestion, $es_publica, $recordatorio, $tipoalerta);


						}
					}
				}
			}else{

				$id = $c->GetMaxIdTabla("events_gestion", "id");
				$id += 1;

				// USANDO LA FUNCION DE INSERTAR DEL OBJETO PARA ENVIAR LA INFORMACION A LA BASE DE DATOA			
				$create = $object->InsertEvents_gestion($user_id, $gestion_id, $fecha, $title, $description, $added, $status, $time, $alerted, $avisar_a, $type_event, $fecha_vencimiento, $title_select, $_SESSION['seccional'], $_SESSION['area_principal'], $_SESSION['area_principal'], $grupo, "ev",  $id, $es_publica, $recordatorio, $tipoalerta);
	
				if ($title_select != "" || $title_select != "0") {
					# code...
					$aertasau = $con->Query("Select * from dependencias_alertas where dependencia_alerta = '".$title_select."' and automatica = 'SI'");

					while ($rowau = $con->FetchAssoc($aertasau)) {

						$alerta = $rowau['id'];
						$gestion = $gestion_id;
						$depa = new MDependencias_alertas;
						$depa->CreateDependencias_alertas("id", $alerta);
						$fecha = date("Y-m-d");
						$fecha_c = date_create($fecha);//aca le pasas la fecha actual o ala que le queres sumar los dias.
						date_modify($fecha_c, $depa->GetDias_alerta()." day");//sumas los dias que te hacen falta.
						$fecha_a = date_format($fecha_c, "Y-m-d");//retornas la fecha en el formato que mas te guste.
						$eventoe = new MEvents_gestion;
					#	// USANDO LA FUNCION DE INSERTAR DEL OBJETO PARA ENVIAR LA INFORMACION A LA BASE DE DATOA
						$create = $eventoe->InsertEvents_gestion($_SESSION['usuario'], $gestion, $fecha_a, $depa->GetNombre(), $depa->GetDescripcion(), date("Y-m-d"), $status, date("H:i:s"), $alerted, $depa->GetDias_antes(), $type_event, $fecha_a, $alerta, $_SESSION['seccional'], $_SESSION['area_principal'], $_SESSION['area_principal'], $grupo, 'ev', $gestion, $es_publica, $recordatorio, $tipoalerta);

					}
				}
			}



			$idt = $con->Query("select id from dependencias_tipologias where tipologia = '".$title."' and id_dependencia = '".$g->GetTipo_documento()."'");
			$tipo_documento = $con->Result($idt, 0, "id");

			$con->Query("update gestion_anexos set nombre = '".$title."', id_event = '".$id."', tipologia = '".$tipo_documento."' 
								where id = '".$adjunto."'");


			$idt = $con->Query("select id from estados_gestion where nombre = '".$title."' and dependencia = '".$g->GetTipo_documento()."'");
			$ep = $con->Result($idt, 0, "id");

			$con->Query("update gestion set estado_personalizado = '".$ep."' where id = '".$g->GetId()."'");

			if ($es_publica == "1") {
				# code...
				$ls = $con->Query("select id_suscriptor from gestion_suscriptores where id_gestion = '".$g->GetId()."' and estado = '1' ");

				while($row = $con->FetchAssoc($ls)){

					$ids = $row['id_suscriptor'];

					$s = new MSuscriptores_contactos;
					$s->CreateSuscriptores_contactos("id", $ids);
					$sd = new MSuscriptores_contactos_direccion;
					$sd->CreateSuscriptores_contactos_direccion("id_contacto", $ids);
					$movimiento = $description;

					$radicado = "";

					if ($g->GetRadicado() != "") {
						$radicado = $g->GetRadicado();
					}else{
						$radicado = $g->GetMin_rad();
					}

					$archivos_adjuntos_ruta = array();
					$nombres_ruta = array();

					if ($adjunto != "") {
						$ge = new MGestion_anexos;
						$ge->CreateGestion_anexos("id", $adjunto);

						$ruta = $url = ROOT.DS.'archivos_uploads/gestion/'.$g->GetId().'/anexos/'.$ge->GetUrl();
						array_push($archivos_adjuntos_ruta, $ruta);
						array_push($nombres_ruta, $ge->GetNombre());
					}

					$MPlantillas_email = new MPlantillas_email;
					$MPlantillas_email->CreatePlantillas_email('id', '13');
					$contenido_email = $MPlantillas_email->GetContenido();
					$contenido_email = str_replace("[elemento]Suscriptor[/elemento]",  $s->GetNombre(),   $contenido_email );
					$contenido_email = str_replace("[elemento]rad_rapido[/elemento]",  $radicado,   $contenido_email );
					$contenido_email = str_replace("[elemento]PROJECTNAME[/elemento]", PROJECTNAME,   $contenido_email );
					$contenido_email = str_replace('"', '\"',   $contenido_email );
					$contenido_email = str_replace("[elemento]FECHA_HORA[/elemento]",  date("Y-m-d H:i:s"),     $contenido_email );
					$contenido_email = str_replace("[elemento]ASUNTO[/elemento]",  	$title,    $contenido_email );
					$contenido_email = str_replace("[elemento]MOVIMIENTO[/elemento]",  $movimiento,    $contenido_email );
					$contenido_email = str_replace("[elemento]LOGO[/elemento]",      '<img src="'.HOMEDIR.'/app/plugins/thumbnails/'.$c->getLogo().'" width="150px">',   $contenido_email );

					$correos = explode(";", $sd->GetEmail());

					for ($i=0; $i < count($correos) ; $i++) { 
						if ($correos[$i] != "") {
							$c->fnEnviaEmailGlobal(CONTACTMAIL,PROJECTNAME,"Actualizacion de un Expediente".$nr,$contenido_email, $correos[$i], $archivos_adjuntos_ruta, $nombres_ruta);
							# code...
						}
						# code...
					}



				}
			}


			echo '<script> window.location.href = "'.HOMEDIR.DS.'gestion/ver/'.$gestion_id.'/alertas/"</script>';

		}
		// FUNCION QUE RECIBE UNASERIE DE PARAMETROS Y LOS ENVIA A LA BASE DE DATOS PARA ACTUALIZAR UN REGISTRO (FUNCION ESPECIAL)		
		function Editar($constrain, $fields, $updates, $output, $gestion_id){
			$object = new MEvents_gestion;
			$create = $object->UpdateEvents_gestion($constrain, $fields, $updates, $output);
			
			echo '<script> window.location.href = "'.HOMEDIR.DS.'gestion/ver/'.$gestion_id.'/alertas/"</script>';
			
		}
		// FUCNION QUE RECIBE UN PARAMETRO Y ELIMINA EL REGISTRO DE LA BASE DE DATOS		
		function Eliminar($id){
			// DEFINIMOS UN OBJETO NUEVO						
			$object = new MEvents_gestion;
			// LLAMAMOS A LA FUNCION QUE EJECUTA LA ELIMINACION.			
			$delete = $object->DeleteEvents_gestion($id); 		
			//SI NO SE ENVIO CORRECTAMENTE ENTONCES GENERA ERROR SINO ENVIA OK
			if($delete != '1')
				echo 'ERROR AL ELIMINAR';
			else
				echo 'OK!';
		}

		function ActivarAlerta($gestion, $alerta){
			global $con;
			global $c;
			global $f;

			$depa = new MDependencias_alertas;
			$depa->CreateDependencias_alertas("id", $alerta);

			$fecha = date("Y-m-d");
			$fecha_c = date_create($fecha);//aca le pasas la fecha actual o ala que le queres sumar los dias.
			date_modify($fecha_c, $depa->GetDias_alerta()." day");//sumas los dias que te hacen falta.
			$fecha_a = date_format($fecha_c, "Y-m-d");//retornas la fecha en el formato que mas te guste.

			$object = new MEvents_gestion;
		#	// USANDO LA FUNCION DE INSERTAR DEL OBJETO PARA ENVIAR LA INFORMACION A LA BASE DE DATOA			
			$create = $object->InsertEvents_gestion($_SESSION['usuario'], $gestion, $fecha_a, $depa->GetNombre(), $depa->GetDescripcion(), date("Y-m-d"), 0, date("H:i:s"), 0, $depa->GetDias_antes(), 0, $fecha_a, $alerta, $_SESSION['seccional'], $_SESSION['area_principal'], $_SESSION['area_principal'], "*");
			
		}

		function ExportarActuaciones($gestion_id, $type = ""){
			
			global $con;
			global $c;
			global $f;

			$alow = true;
			$usuario = new MUsuarios;
			$usuario->CreateUsuarios("user_id", $_SESSION['usuario']);

			$g = new MGestion;
			$g->CreateGestion("id", $gestion_id);

			$s = new MSuscriptores_contactos;
			$s->CreateSuscriptores_contactos("id", $g->GetSuscriptor_id());
			$sd = new MSuscriptores_contactos_direccion;
			$sd->CreateSuscriptores_contactos_direccion("id_contacto", $g->GetSuscriptor_id());

			$logo = '<img src="'.HOMEDIR.'/app/plugins/thumbnails/'.$c->getLogo().'" width="150px">';

			$subs = $c->GetDataFromTable("dependencias", "id", $g->GetTipo_documento(), "nombre", " ");
			$area = $c->GetDataFromTable("areas", "id", $g->GetDependencia_destino(), "nombre", " ");

			$id_plantilla = "41";
			switch ($type) {
				case '1':
					$id_plantilla = "40";
					break;
				default:
					$id_plantilla = "41";
					break;
			}

			$MPlantillas_email = new MPlantillas_email;
			$MPlantillas_email->CreatePlantillas_email('id', $id_plantilla);
			$cmail = $MPlantillas_email->GetContenido();
/*


[elemento]ciudad[/elemento] 
[elemento]rad_externo[/elemento]
[suscriptor]1_Suscriptor[/suscriptor] 
[suscriptor]2_Suscriptor[/suscriptor] 
[elemento]campot4[/elemento]  
[elemento]campot5[/elemento]
[elemento]actuaciones[/elemento] 
*/
			$valor_elemento = $c->GetDataFromTable("city", "code", $g->GetCiudad(), "Name", "");

			$cmail = str_replace("[elemento]LOGO[/elemento]", "&nbsp;", $cmail);
			$cmail = str_replace("[elemento]Fecha[/elemento]", $f->ObtenerFecha(date("Y-m-d")), $cmail);
			$cmail = str_replace("[meta]385_descripcion[/meta]","<strong>".$c->find("385_descripcion", "meta", $g->GetId())."</strong>",$cmail);
			$cmail = str_replace("[elemento]rad_externo[/elemento]", $g->GetRadicado(), $cmail);
			$cmail = str_replace("[elemento]ciudad[/elemento]", $valor_elemento, $cmail);
			$cmail = str_replace("[suscriptor]1_Suscriptor[/suscriptor]", $c->find("1_Suscriptor", "suscriptor", $g->GetId()), $cmail);
			$cmail = str_replace("[suscriptor]2_Suscriptor[/suscriptor]", $c->find("2_Suscriptor", "suscriptor", $g->GetId()), $cmail);
			$cmail = str_replace("[elemento]campot4[/elemento]", $g->GetCampot4(), $cmail);
			$cmail = str_replace("[elemento]campot5[/elemento]", $g->GetCampot5(), $cmail);
			$cmail = str_replace("[elemento]actuaciones[/elemento]", "", $cmail);


			$stringactuaciones = $cmail;

			$name = md5($_SESSION["usuario"].date("Y-m-d H:i:s")).".pdf";
			$nameqr = md5($_SESSION["usuario"].date("Y-m-d H:i:s")).".png";

			$filename=UPLOADS.DS.$gestion_id.'/';
			if (!file_exists($filename)) {
				mkdir(UPLOADS.DS . $gestion_id, 0777);
			}
			$filename=UPLOADS.DS.$gestion_id.'/anexos/';
			if (!file_exists($filename)) {
				mkdir(UPLOADS.DS . $gestion_id.'/anexos', 0777);
			}

			$urlfile = UPLOADS.DS.$gestion_id.'/anexos/'.$name;
			$urlfilqr = FILESAT.DS.$gestion_id.'/anexos/'.$name;
			$urlqr = UPLOADS.DS.'qr/'.$nameqr;

			$sadmin = new MSuper_admin;
			$sadmin->CreateSuper_admin("id", "6");

			$config = new MPlantilla_documento_configuracion;
			$config->CreatePlantilla_documento_configuracion("id", "1");



			#QRcode::png($urlfilqr, $urlqr); // creates file 

			$string = hash("sha256", $id.$_SESSION["usuario"].date("Y-m-d").date("H:i:s").$_SERVER["REMOTE_ADDR"]); 			
		#	include(APP.'plugins/mix_images/index.php');
			$timestamp = "";
			$foot = "<div><div style='font-size:10px; float:left'>";

			$foot .= $pathp;

			#$foot .= "Este documento  se encuentra firmado digital y electrónicamente. Cuando este documento sea enviado electrónicamente como mensaje de datos generará una guía electrónica que  garantiza que es único e irrepetible.convirtiéndolo en un documento auténtico según la ley 527 de 1999.</div></div>";

			$fpath = '<html><head></head><body>'.$timestamp;
			$lpath = $foot.'</body></html>';

			
			$queryactuaciones = "";
			$ev = new MEvents_gestion;

			switch ($type) {
				case '0':
					$queryactuaciones = $ev->ListarEvents_gestion(" WHERE gestion_id = '".$gestion_id."' and type_event = '1' ", "order by fecha desc, time desc");
					break;
				case '1':
					$queryactuaciones = $ev->ListarEvents_gestion(" WHERE gestion_id = '".$gestion_id."' and type_event = '1' and es_publico = '1' ", "order by fecha desc, time desc");
					break;
				case '2':
					$queryactuaciones = $ev->ListarEvents_gestion(" WHERE gestion_id = '".$gestion_id."' and type_event = '1' and es_publico = '0' ", "order by fecha desc, time desc");
					break;	
				default:
					$queryactuaciones = $ev->ListarEvents_gestion(" WHERE gestion_id = '".$gestion_id."'", "order by fecha desc, time desc");
					break;
			}

			$stringactuaciones .= '<table style="font-size:11px" width="100%;" border="0" cellpadding="10" cellspacing="0">
										<tr>
											<th width="100px" align="left">FECHA</th>
											<th width="150px" align="left">TÍTULO</th>
											<th align="left">OBSERVACIÓN</th>
										</tr>';

			while ($ractuaciones = $con->FetchAssoc($queryactuaciones)) {
				$l = new MEvents_gestion;
				$l->Createevents_gestion('id', $ractuaciones['id']);
				/*
				$type = $type_ev[$l->GetStatus()];
				*/
				$typee = "";
				if ($l -> GetType_event() == "0") {
					$typee = "Actuación generada automaticamente";
				}

				if ($l->Getelm_type() == "lsus") {
					$userna    = $c->GetDataFromTable("suscriptores_contactos", "id", $l->GetUser_id(), "nombre", $separador = " ")." / <b>SUSCRIPTOR</b>";
				}else{

					$us = new MUsuarios;
					$us->CreateUsuarios("user_id", $l->GetUser_id());

					$userna = $us->GetP_nombre()." ".$us->GetP_apellido();
				}
				$stringactuaciones .= 	"<tr>
											<td style='border-bottom:1px solid #DEDEDE;' width='100px'>".$f->ObtenerFecha($l -> GetFecha())."</td>
											<td style='border-bottom:1px solid #DEDEDE;'  width='150px'>".$l->GetTitle()."</td>
											<td style='border-bottom:1px solid #DEDEDE;' >".$l->GetDescription()."</td>
										</tr>";
			}
			$stringactuaciones .= '</table>';


			$html = utf8_decode($fpath.html_entity_decode($stringactuaciones).$lpath);

			
			$em = new MSuper_admin;
			$em->CreateSuper_admin("id", $_SESSION['id_empresa']);

			$encabezado = HOMEDIR.DS."app/plugins/thumbnails/".$em->GetEncabezado();
			$pie_pagina = HOMEDIR.DS."app/plugins/thumbnails/".$em->GetPie_pagina();


			$m_t 	= ($config->GetM_t() * 28) -100;
			$m_r	= $config->GetM_r() * 28;
			$m_b	= 100 - ($config->GetM_b() * 28);
			$m_l	= ($config->GetM_l() * 28) -20;
			$m_e_t	= 150 - ($config->GetM_e_t() * 28);
			$m_e_b	= $config->GetM_e_b() * 28;
			$m_p_t	= $config->GetM_p_t() * 28;
			$m_p_b	= $config->GetM_p_b() * 28;
			$fuente = $config->GetFuente();
			$tamano = $config->GetTamano();

			$html2 = '
						<html>
						<head>
						  <style>
							@font-face {
								font-family: "def_font";
								src: url('.HOMEDIR.DS.'app/views/assets/fonts/'.$fuente.');
							}
						    @page { margin: 150px 0px; font-size: '.$tamano.'px; font-family: "def_font", Arial; }
						    #header { position: fixed; left: 0px; right: 0px; top:-'.$m_e_t.'px; width:120%; height: 100px; background: URL('.$encabezado.') no-repeat; background-size: contain; text-align: center; }
                            #footer { position: fixed; left: 0px; right: 0px; bottom: -130px; height: 110px; width:120%; background: URL('.$pie_pagina.') no-repeat; background-size: contain; text-align: center; }
						    #content { margin: '.$m_t.'px '.$m_r.'px -'.$m_b.'px '.$m_l.'px; font-family: "def_font", Arial; }
						  </style>
						</head> 
						<body>
						  <div id="header">&nbsp;</div>
						  <div id="footer"><p class="page">&nbsp;</p></div>
						  <div id="content">
						   '.$html.'
						  </div>
						</body>
						</html>';

            #echo $html2;
            #exit;
            
            $html2 = preg_replace('/>\s+</', '><', $html2);
			$dompdf = new DOMPDF();


			$dompdf->set_paper('letter','');
			$dompdf->load_html($html2);
			ini_set("memory_limit","512M"); 
			$dompdf->render();
			/*
				DOCUMENTAR LA SIGUIENTE LINEA AL TERMINAR
				$dompdf->stream('my.pdf',array('Attachment'=>0));
			*/

			/* 
			*/
			$pdf = $dompdf->output();


			if (file_put_contents($urlfile, $pdf)) {

				$car = new MGestion_anexos;
				$tot  = $car->ListarGestion_anexos("WHERE gestion_id = '".$gestion_id."'");

				$fol = $con->NumRows($tot);
				$fol += 1;
				$user_id = $_SESSION['usuario'];

				//base 64
				$base_file = '';
				$data_base_file = file_get_contents($_SERVER["DOCUMENT_ROOT"]."/app/archivos_uploads/gestion/".$gestion_id."/anexos".DS.$name);
				$base_file = base64_encode($data_base_file);			
				
				$con->Query("INSERT into gestion_anexos (timest, gestion_id,nombre,url,user_id, ip, fecha, hora, folio, hash,base_file) values ('".date("Y-m-d H:i:s")."', '".$gestion_id."','Actuaciones del Expediente Hasta ".date('Y-m-d H:i:s')."','".$name."','$user_id', '$_SERVER[REMOTE_ADDR]', '".date("Y-m-d")."', '".date("H:i:s")."', '".$fol."', '".$string."','".$base_file."')");

				$id = $c->GetMaxIdTabla("gestion_anexos", "id");					

				$objecte = new MEvents_gestion;
				// USANDO LA FUNCION DE INSERTAR DEL OBJETO PARA ENVIAR LA INFORMACION A LA BASE DE DATO
				$objecte->InsertEvents_gestion($_SESSION['usuario'], $gestion_id, date("Y-m-d"), "Documento Exportado", "El Documento: \"Actuaciones del Expediente Hasta ".date("Y-m-d H:i:s")."\" ha sido exportado al expediente", date("Y-m-d"), 0, date("H:i:s"), 0, 0, 0, date("Y-m-d"), 0, $_SESSION['seccional'], $_SESSION['area_principal'], $_SESSION['area_principal'], "*", "expdpc", $id);

			
				echo $idretorno."@@Documento Exportado a Anexos";

			}else{
				echo "Se produjo un error al Exportar";
			}
		}
		function GetEvento($id){
			global $con;
			global $c;
			global $f;
			include_once(VIEWS.DS.'events_gestion/Detalle_evento.php');
		}
	}
?>