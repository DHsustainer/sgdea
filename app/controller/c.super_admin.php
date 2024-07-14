<?
session_start();
date_default_timezone_set("America/Bogota");
if ($_SESSION['usuario'] == 'sanderkdna@gmail.com') {
	# code...
#error_reporting(E_ALL);
#ini_set('display_errors', '1');
}

	//Invocando archivos que seran usados en nuestro controlador generico	
	include_once('app/basePaths.inc.php');
	include_once(MODELS.DS.'Super_adminM.php');
	include_once(MODELS.DS.'UsuariosM.php');
	include_once(ROOT.DS.'DALC'.DS.'/mySql.php');
	include_once('consultas.php');
	include_once('funciones.php');	

	// Definiendo variables y conectandonos con la base de datos
	$con = new ConexionBaseDatos;
	$con->Connect($con);
	
	// Llamando al objeto a controlar		
	$ob = new CSuper_admin;
	$c = new Consultas;
	$f = new Funciones;
	
	// DEFINIMOS EN UN VECTOR LOS CAMPOS QUE VAMOS A EDITAR

	$ar2 = array('p_nombre', 'direccion', 'telefono', 'email', 'ciudad', 'cedula', 'celular', 'departamento', 'nombre_representante', 'cedula_representante', 'expedicion_cedula', 'ciudad_residencia', 'expedicion_identificacion','id_version','prefijo', 'dias_eliminacion');
	// DEFINIMOS EN OTRO VECTOR LOS NUEVOS DATOS QUE VAMOS A METER	
	$ar1 = array($c->sql_quote($_REQUEST['p_p_nombre']), $c->sql_quote($_REQUEST['p_direccion']), $c->sql_quote($_REQUEST['p_telefono']), $c->sql_quote($_REQUEST['p_email']), $c->sql_quote($_REQUEST['p_ciudad']), $c->sql_quote($_REQUEST['p_cedula']), $c->sql_quote($_REQUEST['p_celular']), $c->sql_quote($_REQUEST['p_departamento']), $c->sql_quote($_REQUEST['p_nombre_representante']), $c->sql_quote($_REQUEST['p_cedula_representante']), $c->sql_quote($_REQUEST['p_expedicion_cedula']), $c->sql_quote($_REQUEST['p_ciudad_residencia']), $c->sql_quote($_REQUEST['p_expedicion_identificacion']), $c->sql_quote($_REQUEST['p_id_version']), strtoupper($c->sql_quote($_REQUEST['p_prefijo'])), strtoupper($c->sql_quote($_REQUEST['p_dias_eliminacion'])));	
	// DEFINIMOS LOS ESTADOS DE SALIDA
	$output = array('registro actualizado', 'no se pudo actualizar'); 
	// Y POR ULTIMO DEFINIMOS EL CONTRAIN PARA LA ACTUALIZACION	
	$constrain = 'WHERE id = '.$_SESSION['id_empresa'];
	
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
			$ob->Insertar($c->sql_quote($_REQUEST["user_id"]), $c->sql_quote($_REQUEST["p_nombre"]), $c->sql_quote($_REQUEST["f_caducidad"]), $c->sql_quote($_REQUEST["password"]), $c->sql_quote($_REQUEST["direccion"]), $c->sql_quote($_REQUEST["telefono"]), $c->sql_quote($_REQUEST["email"]), $c->sql_quote($_REQUEST["ciudad"]), $c->sql_quote($_REQUEST["estado"]), $c->sql_quote($_REQUEST["sexo"]), $c->sql_quote($_REQUEST["f_registro"]), $c->sql_quote($_REQUEST["foto_perfil"]), $c->sql_quote($_REQUEST["auditoria"]), $c->sql_quote($_REQUEST["seccional"]), $c->sql_quote($_REQUEST["cedula"]), $c->sql_quote($_REQUEST["celular"]), $c->sql_quote($_REQUEST["departamento"]), $c->sql_quote($_REQUEST["nombre_representante"]), $c->sql_quote($_REQUEST["cedula_representante"]), $c->sql_quote($_REQUEST["expedicion_cedula"]), $c->sql_quote($_REQUEST["ciudad_residencia"]), $c->sql_quote($_REQUEST["expedicion_identificacion"]), $c->sql_quote($_REQUEST["cupos"]));
		// SINO SI ES EDITAR ENTONCES CARGA EL FORMULARIO EDITAR	
		elseif($c->sql_quote($_REQUEST['action']) == 'editar')
			$ob->VistaEditar($c->sql_quote($_REQUEST['id']));	
		// SINO SI ES ACTUALIZAR ENTONCES ENVIA UNA ACTUALIZACION CON LOS PARAMETROS CAPTURADOS
		elseif($c->sql_quote($_REQUEST['action']) == 'actualizar'){
			$ob->Editar($constrain, $ar2, $ar1, $output);
			$_SESSION['id_trd_empresa'] = $c->sql_quote($_REQUEST['p_id_version']);
		// SINO SI ES ELIMINAR ENTONCES CARGA LA FUNCION ELIMINAR
		}elseif($c->sql_quote($_REQUEST['action']) == 'minactualizar'){
			$ar2 = array('id_version','prefijo', 'dias_eliminacion', 'tipo_radicacion');
			// DEFINIMOS EN OTRO VECTOR LOS NUEVOS DATOS QUE VAMOS A METER	
			$ar1 = array($c->sql_quote($_REQUEST['p_id_version']), strtoupper($c->sql_quote($_REQUEST['p_prefijo'])), $c->sql_quote($_REQUEST['p_dias_eliminacion']), $c->sql_quote($_REQUEST['tipo_radicado']));	
			// DEFINIMOS LOS ESTADOS DE SALIDA
			$output = array('registro actualizado', 'no se pudo actualizar'); 
			// Y POR ULTIMO DEFINIMOS EL CONTRAIN PARA LA ACTUALIZACION	
			$constrain = 'WHERE id = '.$_SESSION['id_empresa'];
			$ob->Editar($constrain, $ar2, $ar1, $output);
			$_SESSION['id_trd_empresa'] = $c->sql_quote($_REQUEST['p_id_version']);
		// SINO SI ES ELIMINAR ENTONCES CARGA LA FUNCION ELIMINAR
		}elseif($c->sql_quote($_REQUEST['action']) == 'eliminar')
			$ob->Eliminar($c->sql_quote($_REQUEST['id']));
		// SINO SI ES NUEVO BUSCAR CARGA EL BUSCADOR			
		elseif($c->sql_quote($_REQUEST['action']) == 'buscar')
			$ob->Buscar($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['cn']));		
		
		elseif($c->sql_quote($_REQUEST['action']) == 'style'){
			$field = "estilo";
			$ar2 = array($field);
			// DEFINIMOS EN OTRO VECTOR LOS NUEVOS DATOS QUE VAMOS A METER	
			$ar1 = array($c->sql_quote($_REQUEST['id']));	
			// DEFINIMOS LOS ESTADOS DE SALIDA
			$output = array('registro actualizado', 'no se pudo actualizar'); 
			// Y POR ULTIMO DEFINIMOS EL CONTRAIN PARA LA ACTUALIZACION	
			$constrain = 'WHERE id = '.$_SESSION['id_empresa'];
			$ob->Editar($constrain, $ar2, $ar1, $output);
		
			header("Location: /herramientas/empresa/#adminis");

		}
		elseif($c->sql_quote($_REQUEST['action']) == 'upload'){
				
				$field = $c->sql_quote($_REQUEST['cn']);
				#print_r($_REQUEST);
				switch ($c->sql_quote($_REQUEST['cn'])) {
					case 'prof_text':
						$field = "foto_perfil";
						break;
					case 'prof_ima':
						$field = "imajo_tipo";
						break;
					case 'white_text':
						$field = "logo_white";
						break;
					case 'white_ima':
						$field = "image_white";
						break;
					case 'pie_pagina':
						$field = "pie_pagina";
						break;
					case 'encabezado':
						$field = "encabezado";
						break;					
					case 'logo_courrier':
						$field = "logo_courrier";
						break;						
					default:
						$field = "foto_perfil";
						# code...
						break;
				}

				$tamano = $_FILES["archivo"]['size'];
				$tipo = $_FILES["archivo"]['type'];
				$archivo = $_FILES["archivo"]['name'];
				$prefijo = substr(md5(uniqid(rand())),0,30);
				$extension = strtolower(substr($archivo,strlen($archivo)-3,strlen($archivo)));
				$name = $prefijo.".".$extension;
				$destino =  ROOT."/plugins/thumbnails/".$name;
				if($archivo == ""){
					$status = "No hay archivos que cargar <a href='inicial.php'>Intentarlo nuevamente</a>";
				}
				if (copy($_FILES['archivo']['tmp_name'],$destino)) {
					  $status = "Archivo subido: <b>".$archivo."</b><br><a href='inicial.php'>Regresar</a>";
				}else {
					$status = "Error al subir el archivo <a href='inicial.php'>Intentarlo nuevamente</a>";
				}
					$ar2 = array($field);
					// DEFINIMOS EN OTRO VECTOR LOS NUEVOS DATOS QUE VAMOS A METER	
					$ar1 = array($name);	
					// DEFINIMOS LOS ESTADOS DE SALIDA
					$output = array('registro actualizado', 'no se pudo actualizar'); 
					// Y POR ULTIMO DEFINIMOS EL CONTRAIN PARA LA ACTUALIZACION	
					$constrain = 'WHERE id = '.$_SESSION['id_empresa'];
					$ob->Editar($constrain, $ar2, $ar1, $output);

				if ($c->sql_quote($_REQUEST['id']) == "foto_perfil") {
					#header("Location: /herramientas/empresa/#adminis");
					echo '<script> window.location.href = "'.HOMEDIR.'/herramientas/empresa/#adminis" </script>';
				}else{
					#header("Location: ".HOMEDIR."");
					echo '<script> window.location.href = "'.HOMEDIR.'/herramientas/otras/oh/" </script>';
				}
				/*
				*/
		}else{
			$ob->VistaListar('');		
		}
		// SI NO ES NINGUNA DE LAS ANTERIORES ENTONCES CARGA POR DEFECTO LA VISTA DE LISTADO		
	
	// DEFINIENDO LA CLASE DEL CONTROLADOR DEL OBJETO QUE TIENE HERENCIA CON EL CONTROLADOR GENERICO PARA CARGAR LA INTERFAZ
	class CSuper_admin extends MainController{
		
		// DEFINIENDO LA FUNCION LISTAR 		
		function VistaListar(){
			// CREANDO UN NUEVO MODELO			
			$object = new MSuper_admin;
			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL			
			global $con;
			//CARGANDO LA PAGINA DE INTERFAZ			
			$pagina = $this->load_template('Listar Super_admin');			
			// CARGANDO LLAMANDO LA FUNCION LSITAR LIBROS DEL MODELO (FUNCION QUE TRAE DE LA BASE DE DATOS EL LISTADO DE LIBROS
			// DE NO RECIBIR PARAMETROS ESTA FUNCION TRAE EL LISTADO COMPLETO DE LIBROS
			$query = $object->ListarSuper_admin();	    
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();
				// SI LA CONSULTA NO SE EJECUTA ENTONCES RETORNA VACIO
		   		if($con->NumRows($query) <= 0 || $query !=''){
					// SI LA CONSULTA SE EJECUTA ENTONCES CARGA EL LISTADO DE LIBROS DE LA VISTA
					include_once(VIEWS.DS.'super_admin/Listar.php');	   			
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
			$pagina = $this->load_template('Crear Super_admin');			
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();
			include_once(VIEWS.DS.'super_admin/FormInsertSuper_admin.php');				
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
	 		$pagina = $this->load_template('Editar Super_admin');			
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();		
	 		// INVOCAMOS UN NUEVO OBJETO
		 	$object = new MSuper_admin;
			// LO CREAMOS 			
			$object->CreateSuper_admin('id', $x);
			// Y FINALMENTE CARGAMOS LA VISTA DE EDICION QUE MUESTRA EL CONTENIDO			
			include_once(VIEWS.DS.'super_admin/FormUpdateSuper_admin.php');		
			// OBTIENE EL CONTENIDO DEL BÚFER ACTUAL Y ELIMINA EL BÚFER DE SALIDA ACTUAL.											
			$table = ob_get_clean();	
			// ASIGNANDOLE A LA VARIABLE  EL CONTENIDO DEL BUFFER															
			$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $table  , $pagina);
			// CARGAMOS LA PAGINA EN EL BROWSER		
			$this->view_page($pagina);
	 	}	
	 	function Buscar($x, $cn = 'id'){
	 		// INVOCAMOS UN NUEVO OBJETO						
			$object = new MSuper_admin;
			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL						
			global $con;
			// CARGA EL TEMPLATE						
			$pagina = $this->load_template('Listado de Super_admin');			
			// OBTENEMOS EL LISTADO DE LIBROS DE ACUERDO A LOS PARAMETROS QUE LE ENVIAMOS						
			$query = $object->ListarSuper_admin('WHERE '.$cn.' = "'.$x.'"');	    
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();		
		   		if($con->NumRows($query) <= 0 || $query !=''){
					// SI LA CONSULTA NO SE EJECUTA ENTONCES RETORNA VACIO							
					include_once(VIEWS.DS.'super_admin/Listar.php');	   			
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
		function Insertar($user_id, $p_nombre, $f_caducidad, $password, $direccion, $telefono, $email, $ciudad, $estado, $sexo, $f_registro, $foto_perfil, $auditoria, $seccional, $cedula, $celular, $departamento, $nombre_representante, $cedula_representante, $expedicion_cedula, $ciudad_residencia, $expedicion_identificacion, $cupos){
			// DEFINIENDO EL OBJETO			
			$object = new MSuper_admin;
			// USANDO LA FUNCION DE INSERTAR DEL OBJETO PARA ENVIAR LA INFORMACION A LA BASE DE DATOA			
			$create = $object->InsertSuper_admin($user_id, $p_nombre, $f_caducidad, $password, $direccion, $telefono, $email, $ciudad, $estado, $sexo, $f_registro, $foto_perfil, $auditoria, $seccional, $cedula, $celular, $departamento, $nombre_representante, $cedula_representante, $expedicion_cedula, $ciudad_residencia, $expedicion_identificacion, $cupos);
			
			//SI NO SE ENVIO CORRECTAMENTE ENTONCES GENERA ERROR SINO ENVIA OK
			if($create != '1')
				$this->VistaListar('ERROR AL REGISTRAR');
			else
				$this->VistaListar('OK!');	

		}
		// FUNCION QUE RECIBE UNASERIE DE PARAMETROS Y LOS ENVIA A LA BASE DE DATOS PARA ACTUALIZAR UN REGISTRO (FUNCION ESPECIAL)		
		function Editar($constrain, $fields, $updates, $output){
			$object = new MSuper_admin;
			$create = $object->UpdateSuper_admin($constrain, $fields, $updates, $output);
		}
		// FUCNION QUE RECIBE UN PARAMETRO Y ELIMINA EL REGISTRO DE LA BASE DE DATOS		
		function Eliminar($id){
			// DEFINIMOS UN OBJETO NUEVO						
			$object = new MSuper_admin;
			// LLAMAMOS A LA FUNCION QUE EJECUTA LA ELIMINACION.			
			$delete = $object->DeleteSuper_admin($id); 		
			//SI NO SE ENVIO CORRECTAMENTE ENTONCES GENERA ERROR SINO ENVIA OK
			if($delete != '1')
				echo 'ERROR AL ELIMINAR';
			else
				echo 'OK!';			
			
		}
	}
?>