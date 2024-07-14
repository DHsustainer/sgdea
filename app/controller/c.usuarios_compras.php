<?
	session_start();
	//Invocando archivos que seran usados en nuestro controlador generico	
#	error_reporting(E_ALL);
#	ini_set('display_errors', '1');

		include_once('app/basePaths.inc.php');
	include_once(MODELS.DS.'UsuariosM.php');
	include_once(MODELS.DS.'CaratulaM.php');

	include_once(MODELS.DS.'Super_adminM.php');
	include_once(MODELS.DS.'NotificacionesM.php');
	include_once(MODELS.DS.'Demandado_procesoM.php');
	include_once(MODELS.DS.'GestionM.php');
	include_once(MODELS.DS.'FuentesM.php');
	include_once(MODELS.DS.'Mailer_messageM.php');
	include_once(MODELS.DS.'Mailer_from_messageM.php');
	include_once(MODELS.DS.'Gestion_compartirM.php');
	include_once(MODELS.DS.'Areas_dependenciasM.php');
	include_once(MODELS.DS.'DependenciasM.php');
	include_once(MODELS.DS.'Dependencias_tipologiasM.php');
	include_once(MODELS.DS.'FolderM.php');
	include_once(MODELS.DS.'CityM.php');
	include_once(MODELS.DS.'LibrosM.php');
	include_once(MODELS.DS.'ProvinceM.php');
	include_once(ROOT.DS.'DALC'.DS.'/mySql.php');
	include_once('consultas.php');
	include_once('funciones.php');	
	##include_once(PLUGINS.DS.'PHPMailer_5.2.4/class.phpmailer.php');	
	include_once(MODELS.DS.'Gestion_anexosM.php');
	include_once(MODELS.DS.'Gestion_anexos_permisosM.php');
	include_once(MODELS.DS.'Gestion_suscriptoresM.php');
	include_once(MODELS.DS.'Gestion_transferenciasM.php');
	include_once(MODELS.DS.'Dependencias_alertasM.php');
	include_once(MODELS.DS.'Events_gestionM.php');
	include_once(MODELS.DS.'Big_dataM.php');
	include_once(MODELS.DS.'Ref_tablesM.php');
	include_once(MODELS.DS.'Suscriptores_contactosM.php');
	include_once(MODELS.DS.'Suscriptores_tiposM.php');
	include_once(MODELS.DS.'Documentos_gestionM.php');
	include_once(MODELS.DS.'Dependencias_documentosM.php');
	include_once(MODELS.DS.'AreasM.php');
	include_once(MODELS.DS.'Alertas_usuariosM.php');
	include_once(MODELS.DS.'Documentos_gestion_permisosM.php');
	include_once(MODELS.DS.'Dependencias_permisos_documentoM.php');
	include_once(MODELS.DS.'Suscriptores_contactos_direccionM.php');
	include_once(MODELS.DS.'Seccional_principalM.php');
	include_once(MODELS.DS.'SeccionalM.php');	
	include_once(MODELS.DS.'Solicitudes_documentosM.php');	
	include_once(MODELS.DS.'Gestion_tipologias_big_dataM.php');
	include_once(MODELS.DS.'Dependencias_tipologias_referenciasM.php');	
	include_once(MODELS.DS.'Meta_big_dataM.php');	
	include_once(MODELS.DS.'Meta_referencias_camposM.php');	
	include_once(MODELS.DS.'Meta_referencias_titulosM.php');	
	include_once(MODELS.DS.'Meta_listas_valoresM.php');	
	include_once(MODELS.DS.'Meta_listasM.php');	
	include_once(MODELS.DS.'Usuarios_configurar_firma_digitalM.php');	
	include_once(MODELS.DS.'Gestion_anexos_permisos_documentosM.php');	
	include_once(MODELS.DS.'Gestion_anexos_firmasM.php');	
	include_once(MODELS.DS.'Gestion_favoritosM.php');	
	include_once(MODELS.DS.'Usuarios_comprasM.php');
	include_once(MODELS.DS.'Usuarios_paquetesM.php');
	

	// Definiendo variables y conectandonos con la base de datos
	$con = new ConexionBaseDatos;
	$con->Connect($con);
	
	// Llamando al objeto a controlar		
	$ob = new CUsuarios_compras;
	$c = new Consultas;
	$f = new Funciones;
	
	// DEFINIMOS EN UN VECTOR LOS CAMPOS QUE VAMOS A EDITAR
	$ar2 = array('username', 'estado', 'descripcion', 'total', 'registro_saldo', 'fecha_pago', 'medio_pago', 'medio_pago_comprobante', 'medio_pago_imagen', 'codigoAutorizacion', 'numeroTransaccion', 'FechaActualizacion', 'referente_pago');
	// DEFINIMOS EN OTRO VECTOR LOS NUEVOS DATOS QUE VAMOS A METER	
	$ar1 = array($c->sql_quote($_REQUEST['username']), $c->sql_quote($_REQUEST['estado']), $c->sql_quote($_REQUEST['descripcion']), $c->sql_quote($_REQUEST['total']), $c->sql_quote($_REQUEST['registro_saldo']), $c->sql_quote($_REQUEST['fecha_pago']), $c->sql_quote($_REQUEST['medio_pago']), $c->sql_quote($_REQUEST['medio_pago_comprobante']), $c->sql_quote($_REQUEST['medio_pago_imagen']), $c->sql_quote($_REQUEST['codigoAutorizacion']), $c->sql_quote($_REQUEST['numeroTransaccion']), $c->sql_quote($_REQUEST['FechaActualizacion']), $c->sql_quote($_REQUEST['referente_pago']));	
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
			$ob->VistaInsertar($c->sql_quote($_REQUEST['id']));
		// SINO SI ES INSERTAR ENTONCES CARGA EL INSERTAR	
		elseif($c->sql_quote($_REQUEST['action']) == 'registrar')
		// CAPTURA LAS VARIAABLES Y ENVIALAS A LA FUNCION INSERTAR		
			$ob->Insertar($_SESSION['usuario'], "pendiente", "", "", "", "", "", "", "", "", "", "", "", $c->sql_quote($_REQUEST["paquete_id"]),  $c->sql_quote($_REQUEST['nombre_pago']), $c->sql_quote($_REQUEST['identificacion_pago']), $c->sql_quote($_REQUEST['telefono_pago']), $c->sql_quote($_REQUEST['email_pago']));
		// SINO SI ES EDITAR ENTONCES CARGA EL FORMULARIO EDITAR	
		elseif($c->sql_quote($_REQUEST['action']) == 'editar')
			$ob->VistaEditar($c->sql_quote($_REQUEST['id']));	
		// SINO SI ES ACTUALIZAR ENTONCES ENVIA UNA ACTUALIZACION CON LOS PARAMETROS CAPTURADOS
		elseif($c->sql_quote($_REQUEST['action']) == 'actualizar')
			$ob->Editar($constrain, $ar2, $ar1, $output);
		// SINO SI ES ELIMINAR ENTONCES CARGA LA FUNCION ELIMINAR
		elseif($c->sql_quote($_REQUEST['action']) == 'eliminar')
			$ob->Eliminar($c->sql_quote($_REQUEST['id']));
		// SINO SI ES NUEVO BUSCAR CARGA EL BUSCADOR			
		elseif($c->sql_quote($_REQUEST['action']) == 'buscar')
			$ob->Buscar($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['cn']));		
		elseif($c->sql_quote($_REQUEST['action']) == 'confirmar')
			$ob->Checkout();

		else
		// SI NO ES NINGUNA DE LAS ANTERIORES ENTONCES CARGA POR DEFECTO LA VISTA DE LISTADO		
			$ob->VistaListar('');		
	
	// DEFINIENDO LA CLASE DEL CONTROLADOR DEL OBJETO QUE TIENE HERENCIA CON EL CONTROLADOR GENERICO PARA CARGAR LA INTERFAZ
	class CUsuarios_compras extends MainController{
		
		// DEFINIENDO LA FUNCION LISTAR 		
		function VistaListar(){
			// CREANDO UN NUEVO MODELO			
			$object = new MUsuarios_compras;
			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL			
			global $con;
			//CARGANDO LA PAGINA DE INTERFAZ			
			$pagina = $this->load_template('Listar Usuarios_compras');			
			// CARGANDO LLAMANDO LA FUNCION LSITAR LIBROS DEL MODELO (FUNCION QUE TRAE DE LA BASE DE DATOS EL LISTADO DE LIBROS
			// DE NO RECIBIR PARAMETROS ESTA FUNCION TRAE EL LISTADO COMPLETO DE LIBROS
			$query = $object->ListarUsuarios_compras();	    
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();
				// SI LA CONSULTA NO SE EJECUTA ENTONCES RETORNA VACIO
		   		if($con->NumRows($query) <= 0 || $query !=''){
					// SI LA CONSULTA SE EJECUTA ENTONCES CARGA EL LISTADO DE LIBROS DE LA VISTA
					include_once(VIEWS.DS.'usuarios_compras/Listar.php');	   			
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
		function VistaInsertar($val){
			global $con;
			global $c;
			global $f;

			$_SESSION['deuda_actual'] = $val * -1;

			include_once(VIEWS.DS.'usuarios_compras/FormInsertUsuarios_compras.php');				
		}
		// FUCNION QUE CARGA LA VISTA PARA EDITAR EL CONTENIDO DE UN REGISTRO
		function VistaEditar($x){
			// CARGA EL TEMPLATE			
	 		$pagina = $this->load_template('Editar Usuarios_compras');			
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();		
	 		// INVOCAMOS UN NUEVO OBJETO
		 	$object = new MUsuarios_compras;
			// LO CREAMOS 			
			$object->CreateUsuarios_compras('id', $x);
			// Y FINALMENTE CARGAMOS LA VISTA DE EDICION QUE MUESTRA EL CONTENIDO			
			include_once(VIEWS.DS.'usuarios_compras/FormUpdateUsuarios_compras.php');		
			// OBTIENE EL CONTENIDO DEL BÚFER ACTUAL Y ELIMINA EL BÚFER DE SALIDA ACTUAL.											
			$table = ob_get_clean();	
			// ASIGNANDOLE A LA VARIABLE  EL CONTENIDO DEL BUFFER															
			$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $table  , $pagina);
			// CARGAMOS LA PAGINA EN EL BROWSER		
			$this->view_page($pagina);
	 	}	
	 	function Buscar($x, $cn = 'id'){
	 		// INVOCAMOS UN NUEVO OBJETO						
			$object = new MUsuarios_compras;
			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL						
			global $con;
			// CARGA EL TEMPLATE						
			$pagina = $this->load_template('Listado de Usuarios_compras');			
			// OBTENEMOS EL LISTADO DE LIBROS DE ACUERDO A LOS PARAMETROS QUE LE ENVIAMOS						
			$query = $object->ListarUsuarios_compras('WHERE '.$cn.' = "'.$x.'"');	    
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();		
		   		if($con->NumRows($query) <= 0 || $query !=''){
					// SI LA CONSULTA NO SE EJECUTA ENTONCES RETORNA VACIO							
					include_once(VIEWS.DS.'usuarios_compras/Listar.php');	   			
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
		function Insertar($username, $estado, $descripcion, $total, $registro_saldo, $fecha_pago, $medio_pago, $medio_pago_comprobante, $medio_pago_imagen, $codigoAutorizacion, $numeroTransaccion, $FechaActualizacion, $referente_pago, $paquete_id, $nombre_pago, $identificacion_pago, $telefono_pago, $email_pago){
			// DEFINIENDO EL OBJETO			

			global $con;
			global $c;
			global $f;
			$object = new MUsuarios_compras;

			$paq = new MUsuarios_paquetes;
			$paq->CreateUsuarios_paquetes("id", $paquete_id);

			$u = new MUsuarios;
			$u->CreateUsuarios("user_id", $_SESSION['usuario']);

			if ($paquete_id == "NA") {
				$descripcion = "PAGO DE SALDO PENDIENTE ".$_SESSION['deuda_actual'];
				$total = $_SESSION['deuda_actual'];
			}else{
				$descripcion = $paq->GetNombre();
				$total = $paq->GetValor();

			}

			$token = $c->GetIdRecursivoTabla("token_id", "usuarios_compras", "");

			$token = $token.md5(HOMEDIR);
			$token = md5($token);

			$key_secret = KEYWOMPI;

		#	if ($_SESSION['sid'] == $token) {
			$data =  array	(	"ip" => $_SERVER['REMOTE_ADDR'],
								"token" => $key_secret,
								"email" => $email_pago,
								"nombre" => $nombre_pago,
								"identificacion" => $identificacion_pago,
								"telefono" => $telefono_pago,
								"seccional" => $u->GetSeccional_siamm(),
								"username" => $_SESSION['usuario'],
								"descripcion" => $descripcion,
								"total" => $total,
								"referente_pago" => $token,
								"estado" => "PENDIENTE",
								"dominio" => $_SERVER['HTTP_HOST']
							);

			$url = "https://pasarela.admhost.site/ext/rest/SetPay.php";
			//create a new cURL resource
			$ch = curl_init($url);	
			$payload = json_encode(array("user" => $data));
			//attach encoded JSON string to the POST fields
			curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
			//set the content type to application/json
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
			//return response instead of outputting
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			//execute the POST request
			$result = curl_exec($ch);

			$var = json_decode($result);

			if ($var->status == "success") {

				$token_id = $var->comercio;
				$codigoAutorizacion = $var->resourceId;
				$url_retorno = $var->redirectUrl;
				
				// USANDO LA FUNCION DE INSERTAR DEL OBJETO PARA ENVIAR LA INFORMACION A LA BASE DE DATOA			
				$create = $object->InsertUsuarios_compras($username, $estado, $descripcion, $total, $registro_saldo, $fecha_pago, $medio_pago, $medio_pago_comprobante, $medio_pago_imagen, $codigoAutorizacion, $numeroTransaccion, $FechaActualizacion, $token, $paquete_id, $token, date("Y-m-d H:i:s"), $nombre_pago, $identificacion_pago, $telefono_pago, $email_pago);
				$id = $c->GetMaxIdTabla("usuarios_compras", "id");

				//SI NO SE ENVIO CORRECTAMENTE ENTONCES GENERA ERROR SINO ENVIA OK
				if($create != '1'){
					$pagina = $this->load_template('Ups! Error');
					// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
					ob_start();

					include_once(VIEWS.DS.'usuarios_compras/error_registro.php');

					$table = ob_get_clean();
					// ASIGNANDOLE A LA VARIABLE  EL CONTENIDO DEL BUFFER
					$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $table  , $pagina);
					// CARGAMOS LA PAGINA EN EL BROWSER
					$this->view_page($pagina);
				}else{
					// CARGA EL TEMPLATE	
			 		$pagina = $this->load_template('Editar Usuarios_compras');			
					// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
					ob_start();		
			 		// INVOCAMOS UN NUEVO OBJETO
					// Y FINALMENTE CARGAMOS LA VISTA DE EDICION QUE MUESTRA EL CONTENIDO			
					include_once(VIEWS.DS.'usuarios_compras/Redirect.php');		
					// OBTIENE EL CONTENIDO DEL BÚFER ACTUAL Y ELIMINA EL BÚFER DE SALIDA ACTUAL.											
					$table = ob_get_clean();	
					// ASIGNANDOLE A LA VARIABLE  EL CONTENIDO DEL BUFFER															
					$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $table  , $pagina);
					// CARGAMOS LA PAGINA EN EL BROWSER		
					$this->view_page($pagina);
				}

/* */
			}else{
				$pagina = $this->load_template('Ups! Error');
				// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
				ob_start();

				include_once(VIEWS.DS.'usuarios_compras/error_registro.php');

				$table = ob_get_clean();
				// ASIGNANDOLE A LA VARIABLE  EL CONTENIDO DEL BUFFER
				$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $table  , $pagina);
				// CARGAMOS LA PAGINA EN EL BROWSER
				$this->view_page($pagina);
			}


		}
		// FUNCION QUE RECIBE UNASERIE DE PARAMETROS Y LOS ENVIA A LA BASE DE DATOS PARA ACTUALIZAR UN REGISTRO (FUNCION ESPECIAL)		
		function Editar($constrain, $fields, $updates, $output){
			$object = new MUsuarios_compras;
			$create = $object->UpdateUsuarios_compras($constrain, $fields, $updates, $output);
			
			//SI NO SE ENVIO CORRECTAMENTE ENTONCES GENERA ERROR SINO ENVIA OK
			if($create != '1')
				$this->VistaListar('ERROR AL REGISTRAR');
			else
				$this->VistaListar('OK!');						
			
		}
		// FUCNION QUE RECIBE UN PARAMETRO Y ELIMINA EL REGISTRO DE LA BASE DE DATOS		
		function Eliminar($id){
			// DEFINIMOS UN OBJETO NUEVO						
			$object = new MUsuarios_compras;
			// LLAMAMOS A LA FUNCION QUE EJECUTA LA ELIMINACION.			
			$delete = $object->DeleteUsuarios_compras($id); 		
			//SI NO SE ENVIO CORRECTAMENTE ENTONCES GENERA ERROR SINO ENVIA OK
			if($delete != '1')
				echo 'ERROR AL ELIMINAR';
			else
				echo 'OK!';			
			
		}
		function Checkout(){
			echo "Hola!";
			print_r($_REQUEST);
		}
	}
?>	