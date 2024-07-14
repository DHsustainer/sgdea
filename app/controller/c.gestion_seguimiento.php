<?
	session_start();
	//Invocando archivos que seran usados en nuestro controlador generico	
	include_once('app/basePaths.inc.php');
	include_once(MODELS.DS.'Gestion_seguimientoM.php');
	include_once(MODELS.DS.'Events_gestionM.php');
	include_once(MODELS.DS.'Estados_gestionM.php');
	include_once(MODELS.DS.'Plantillas_emailM.php');
	include_once(MODELS.DS.'GestionM.php');
	include_once(MODELS.DS.'Super_adminM.php');
	include_once(MODELS.DS.'CityM.php');
	include_once(MODELS.DS.'ProvinceM.php');
	include_once(MODELS.DS.'UsuariosM.php');

	include_once(ROOT.DS.'DALC'.DS.'/mySql.php');
	include_once('consultas.php');
	include_once('funciones.php');	

	// Definiendo variables y conectandonos con la base de datos
	$con = new ConexionBaseDatos;
	$con->Connect($con);
	
	// Llamando al objeto a controlar		
	$ob = new CGestion_seguimiento;
	$c = new Consultas;
	$f = new Funciones;
	
	// DEFINIMOS EN UN VECTOR LOS CAMPOS QUE VAMOS A EDITAR
	$ar2 = array('id_gestion', 'user_id', 'fecha_solicitud', 'estado_solicitud', 'id_seguimiento');
	// DEFINIMOS EN OTRO VECTOR LOS NUEVOS DATOS QUE VAMOS A METER	
	$ar1 = array($c->sql_quote($_REQUEST['id_gestion']), $c->sql_quote($_REQUEST['user_id']), $c->sql_quote($_REQUEST['fecha_solicitud']), $c->sql_quote($_REQUEST['estado_solicitud']), $c->sql_quote($_REQUEST['id_seguimiento']));	
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
			$ob->Insertar($c->sql_quote($_REQUEST["id_gestion"]), $_SESSION['usuario'], date("Y-m-d H:i:s"), "0", "", $c->sql_quote($_REQUEST["observacion"]));
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
		else
		// SI NO ES NINGUNA DE LAS ANTERIORES ENTONCES CARGA POR DEFECTO LA VISTA DE LISTADO		
			$ob->VistaListar('');		
	
	// DEFINIENDO LA CLASE DEL CONTROLADOR DEL OBJETO QUE TIENE HERENCIA CON EL CONTROLADOR GENERICO PARA CARGAR LA INTERFAZ
	class CGestion_seguimiento extends MainController{
		
		// DEFINIENDO LA FUNCION LISTAR 		
		function VistaListar(){
			// CREANDO UN NUEVO MODELO			
			$object = new MGestion_seguimiento;
			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL			
			global $con;
			//CARGANDO LA PAGINA DE INTERFAZ			
			$pagina = $this->load_template('Listar Gestion_seguimiento');			
			// CARGANDO LLAMANDO LA FUNCION LSITAR LIBROS DEL MODELO (FUNCION QUE TRAE DE LA BASE DE DATOS EL LISTADO DE LIBROS
			// DE NO RECIBIR PARAMETROS ESTA FUNCION TRAE EL LISTADO COMPLETO DE LIBROS
			$query = $object->ListarGestion_seguimiento();	    
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();
				// SI LA CONSULTA NO SE EJECUTA ENTONCES RETORNA VACIO
		   		if($con->NumRows($query) <= 0 || $query !=''){
					// SI LA CONSULTA SE EJECUTA ENTONCES CARGA EL LISTADO DE LIBROS DE LA VISTA
					include_once(VIEWS.DS.'gestion_seguimiento/Listar.php');	   			
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
		function VistaInsertar($gestion_id){
			
			global $con;
			global $c;
			global $f;
			
			$g = new MGestion;
			$g->CreateGestion("id", $gestion_id);

			$gs = new MGestion_seguimiento;
			$gs->CreateGestion_seguimiento("id_gestion", $g->GetId());

			if($gs->GetId() == "0") {
				include_once(VIEWS.DS.'gestion_seguimiento/FormUpdateGestion_seguimiento.php');
			}else{
				include_once(VIEWS.DS.'gestion_seguimiento/FormInsertGestion_seguimiento.php');

			}
			
		}
		// FUCNION QUE CARGA LA VISTA PARA EDITAR EL CONTENIDO DE UN REGISTRO
		function VistaEditar($x){
			// CARGA EL TEMPLATE			
	 		$pagina = $this->load_template('Editar Gestion_seguimiento');			
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();		
	 		// INVOCAMOS UN NUEVO OBJETO
		 	$object = new MGestion_seguimiento;
			// LO CREAMOS 			
			$object->CreateGestion_seguimiento('id', $x);
			// Y FINALMENTE CARGAMOS LA VISTA DE EDICION QUE MUESTRA EL CONTENIDO			
			include_once(VIEWS.DS.'gestion_seguimiento/FormUpdateGestion_seguimiento.php');		
			// OBTIENE EL CONTENIDO DEL BÚFER ACTUAL Y ELIMINA EL BÚFER DE SALIDA ACTUAL.											
			$table = ob_get_clean();	
			// ASIGNANDOLE A LA VARIABLE  EL CONTENIDO DEL BUFFER															
			$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $table  , $pagina);
			// CARGAMOS LA PAGINA EN EL BROWSER		
			$this->view_page($pagina);
	 	}	
	 	function Buscar($x, $cn = 'id'){
	 		// INVOCAMOS UN NUEVO OBJETO						
			$object = new MGestion_seguimiento;
			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL						
			global $con;
			// CARGA EL TEMPLATE						
			$pagina = $this->load_template('Listado de Gestion_seguimiento');			
			// OBTENEMOS EL LISTADO DE LIBROS DE ACUERDO A LOS PARAMETROS QUE LE ENVIAMOS						
			$query = $object->ListarGestion_seguimiento('WHERE '.$cn.' = "'.$x.'"');	    
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();		
		   		if($con->NumRows($query) <= 0 || $query !=''){
					// SI LA CONSULTA NO SE EJECUTA ENTONCES RETORNA VACIO							
					include_once(VIEWS.DS.'gestion_seguimiento/Listar.php');	   			
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
		function Insertar($id_gestion, $user_id, $fecha_solicitud, $estado_solicitud, $id_seguimiento, $observacion){
			// DEFINIENDO EL OBJETO			
			global $con;
			global $c;
			global $f;
			$object = new MGestion_seguimiento;
			// USANDO LA FUNCION DE INSERTAR DEL OBJETO PARA ENVIAR LA INFORMACION A LA BASE DE DATOA			
			
			$create = $object->InsertGestion_seguimiento($id_gestion, $user_id, $fecha_solicitud, $estado_solicitud, $id_seguimiento, $observacion);
			$max = $c->GetMaxIdTabla("gestion_seguimiento", "id");

			$url = "http://seguimiento.hitracker.org/ext/ws/servidor/InsertNotification.ws.wsdl";

			$cliente = new nusoap_client($url, true);
		    $error = $cliente->getError();
		    if ($error) {
		        echo "<h2>Constructor error</h2><pre>" . $error . "</pre>";
		    }

		    $s = new MSuper_admin;
		    $s->CreateSuper_admin("id", "6");
			
			
			$SEG_CAMPOT1 = ($_REQUEST['SEG_CAMPOT1'] != "")?"Campo T1: ".$c->sql_quote($_REQUEST['SEG_CAMPOT1'])."||":"";
			$SEG_CAMPOT2 = ($_REQUEST['SEG_CAMPOT2'] != "")?"Campo T2: ".$c->sql_quote($_REQUEST['SEG_CAMPOT2'])."||":"";
			$SEG_CAMPOT3 = ($_REQUEST['SEG_CAMPOT3'] != "")?"Campo T3: ".$c->sql_quote($_REQUEST['SEG_CAMPOT3'])."||":"";
			$SEG_CAMPOT4 = ($_REQUEST['SEG_CAMPOT4'] != "")?"Campo T4: ".$c->sql_quote($_REQUEST['SEG_CAMPOT4'])."||":"";
			$SEG_CAMPOT5 = ($_REQUEST['SEG_CAMPOT5'] != "")?"Campo T5: ".$c->sql_quote($_REQUEST['SEG_CAMPOT5'])."||":"";
			$SEG_CAMPOT6 = ($_REQUEST['SEG_CAMPOT6'] != "")?"Campo T6: ".$c->sql_quote($_REQUEST['SEG_CAMPOT6'])."||":"";
			$SEG_CAMPOT7 = ($_REQUEST['SEG_CAMPOT7'] != "")?"Campo T7: ".$c->sql_quote($_REQUEST['SEG_CAMPOT7'])."||":"";
			$SEG_CAMPOT8 = ($_REQUEST['SEG_CAMPOT8'] != "")?"Campo T8: ".$c->sql_quote($_REQUEST['SEG_CAMPOT8'])."||":"";
			$SEG_CAMPOT9 = ($_REQUEST['SEG_CAMPOT9'] != "")?"Campo T9: ".$c->sql_quote($_REQUEST['SEG_CAMPOT9'])."||":"";
			$SEG_CAMPOT10 = ($_REQUEST['SEG_CAMPOT10'] != "")?"Campo T10: ".$c->sql_quote($_REQUEST['SEG_CAMPOT10'])."||":"";
			$SEG_CAMPOT11 = ($_REQUEST['SEG_CAMPOT11'] != "")?"Campo T11: ".$c->sql_quote($_REQUEST['SEG_CAMPOT11'])."||":"";
			$SEG_CAMPOT12 = ($_REQUEST['SEG_CAMPOT12'] != "")?"Campo T12: ".$c->sql_quote($_REQUEST['SEG_CAMPOT12'])."||":"";
			$SEG_CAMPOT13 = ($_REQUEST['SEG_CAMPOT13'] != "")?"Campo T13: ".$c->sql_quote($_REQUEST['SEG_CAMPOT13'])."||":"";
			$SEG_CAMPOT14 = ($_REQUEST['SEG_CAMPOT14'] != "")?"Campo T14: ".$c->sql_quote($_REQUEST['SEG_CAMPOT14'])."||":"";
			$SEG_CAMPOT15 = ($_REQUEST['SEG_CAMPOT15'] != "")?"Campo T15: ".$c->sql_quote($_REQUEST['SEG_CAMPOT15'])."||":"";		

			$data = "Radicado Interno: ".$c->sql_quote($_REQUEST['SEG_MIN_RADICADO'])."||".
					"Radicado Externo: ".$c->sql_quote($_REQUEST['SEG_RADICADO_EXTERNO'])."||".
					"Asunto: ".$c->sql_quote($_REQUEST['SEG_ASUNTO'])."||".
					"Suscriptor Principal: ".$c->sql_quote($_REQUEST['SEG_SUSCRIPTOR_NOMBRE'])."||".
					"Responsable: ".$c->sql_quote($_REQUEST['SEG_RESPONSABLE'])."||".
					"Ciudad: ".$c->sql_quote($_REQUEST['SEG_CIUDAD'])."||".
					"Observacion: ".$c->sql_quote($_REQUEST['observacion'])."||".$SEG_CAMPOT1.$SEG_CAMPOT2.$SEG_CAMPOT3.$SEG_CAMPOT4.$SEG_CAMPOT5.$SEG_CAMPOT6.$SEG_CAMPOT7.$SEG_CAMPOT8.$SEG_CAMPOT9.$SEG_CAMPOT10.$SEG_CAMPOT11.$SEG_CAMPOT12.$SEG_CAMPOT13.$SEG_CAMPOT14.$SEG_CAMPOT15;


			$b64Doc = base64_encode($data);

			$array = array(	"uri" => $_SERVER['HTTP_HOST'],
							"id_externo" => $max, 
							"data" =>  $b64Doc, 
							"user_externo" => $_SESSION['usuario'], 
							"nombre" =>  $s->GetP_nombre() ,
							"direccion" => $s->GetDireccion() 	, 
							"telefono" => $s->GetTelefono() ,
							"ciudad" => $s->GetCiudad(),
							"mail" => $s->GetEmail()
						);
	
			#print_r($array);		   	

		    $result = $cliente->call("InsertNotification", $array);	    

		    if ($cliente->fault) {
		        echo "<h2>Fault</h2><pre>";
		        echo "</pre>";
		    }else{
		        $error = $cliente->getError();
		        if ($error) {
		            echo "<h2>Error</h2><pre>" . $error . "</pre>";
		        }else {
					if ($result == "") {
						echo "No se creo el WS";
					}else{
						echo "Solicitud de Seguimiento Realizada" ;
					}
		        }
		    }
		}
		// FUNCION QUE RECIBE UNASERIE DE PARAMETROS Y LOS ENVIA A LA BASE DE DATOS PARA ACTUALIZAR UN REGISTRO (FUNCION ESPECIAL)		
		function Editar($constrain, $fields, $updates, $output){
			$object = new MGestion_seguimiento;
			$create = $object->UpdateGestion_seguimiento($constrain, $fields, $updates, $output);
			
			//SI NO SE ENVIO CORRECTAMENTE ENTONCES GENERA ERROR SINO ENVIA OK
			if($create != '1')
				$this->VistaListar('ERROR AL REGISTRAR');
			else
				$this->VistaListar('OK!');						
			
		}
		// FUCNION QUE RECIBE UN PARAMETRO Y ELIMINA EL REGISTRO DE LA BASE DE DATOS		
		function Eliminar($id){
			// DEFINIMOS UN OBJETO NUEVO						
			$object = new MGestion_seguimiento;
			// LLAMAMOS A LA FUNCION QUE EJECUTA LA ELIMINACION.			
			$delete = $object->DeleteGestion_seguimiento($id); 		
			//SI NO SE ENVIO CORRECTAMENTE ENTONCES GENERA ERROR SINO ENVIA OK
			if($delete != '1')
				echo 'ERROR AL ELIMINAR';
			else
				echo 'OK!';			
			
		}
	}
?>