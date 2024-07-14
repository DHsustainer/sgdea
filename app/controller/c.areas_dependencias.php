<?
session_start();
#error_reporting(E_ALL);
#ini_set('display_errors', '1');
//Invocando archivos que seran usados en nuestro controlador generico	

	include_once('app/basePaths.inc.php');
	include_once(MODELS.DS.'Areas_dependenciasM.php');
	include_once(MODELS.DS.'AreasM.php');
	include_once(MODELS.DS.'DependenciasM.php');
	include_once(ROOT.DS.'DALC'.DS.'/mySql.php');
	include_once('consultas.php');
	include_once('funciones.php');	

	// Definiendo variables y conectandonos con la base de datos
	$con = new ConexionBaseDatos;
	$con->Connect($con);

	// Llamando al objeto a controlar		
	$ob = new CAreas_dependencias;
	$c = new Consultas;
	$f = new Funciones;

	// DEFINIMOS EN UN VECTOR LOS CAMPOS QUE VAMOS A EDITAR
	$ar2 = array('id_area', 'id_dependencia', 'usuario', 'fecha', 'id_dependencia_raiz');
	// DEFINIMOS EN OTRO VECTOR LOS NUEVOS DATOS QUE VAMOS A METER	
	$ar1 = array($c->sql_quote($_REQUEST['id_area']), $c->sql_quote($_REQUEST['id_dependencia']), $c->sql_quote($_REQUEST['usuario']), $c->sql_quote($_REQUEST['fecha']), $c->sql_quote($_REQUEST['id_dependencia_raiz']));	
	// DEFINIMOS LOS ESTADOS DE SALIDA
	$output = array('registro actualizado', 'no se pudo actualizar'); 
	// Y POR ULTIMO DEFINIMOS EL CONTRAIN PARA LA ACTUALIZACION	
	$constrain = 'WHERE id = '.$_REQUEST['id'];

	// LA FUNCION SQLQUOTE de la clase Consultas se encarga de fultrar las variables recibidas por GET o por POST para evitar la inyeccion de SQL
	// esta funcion solo funciona cuando se ha establecido conexion con la base de datos
	// SI LA ACTION CAPTURADA ES LISTAR ENTONCES LISTA
	if($c->sql_quote($_REQUEST['action']) == 'listar')
		$ob->VistaListar($_REQUEST['id']);	
		// SINO SI ES NUEVO ENTONCES CARGA EL FORMULARIO INSERTAR	
	elseif($c->sql_quote($_REQUEST['action']) == 'nuevo')	
		$ob->VistaInsertar();
		// SINO SI ES INSERTAR ENTONCES CARGA EL INSERTAR	
	elseif($c->sql_quote($_REQUEST['action']) == 'registrar')
	// CAPTURA LAS VARIAABLES Y ENVIALAS A LA FUNCION INSERTAR		
		$ob->Insertar($c->sql_quote($_REQUEST["id_area"]), $c->sql_quote($_REQUEST["id_dependencia"]), $c->sql_quote($_REQUEST["usuario"]), $c->sql_quote($_REQUEST["fecha"]), $c->sql_quote($_REQUEST["id_dependencia_raiz"]), $c->sql_quote($_REQUEST["observacion"]));
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
	elseif($c->sql_quote($_REQUEST['action']) == 'GetSeriesArea')
		$ob->GetSeriesArea($c->sql_quote($_REQUEST['id']));		
	elseif($c->sql_quote($_REQUEST['action']) == 'GetSubSeriesArea')
		$ob->GetSubSeriesArea($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['cn']));
	elseif($c->sql_quote($_REQUEST['action']) == 'GetSubseries')
		$ob->GetSubseries($c->sql_quote($_REQUEST['area']), $c->sql_quote($_REQUEST['serie']));		
	else
		$ob->VistaListar('');		

		// DEFINIENDO LA CLASE DEL CONTROLADOR DEL OBJETO QUE TIENE HERENCIA CON EL CONTROLADOR GENERICO PARA CARGAR LA INTERFAZ
	class CAreas_dependencias extends MainController{

		// DEFINIENDO LA FUNCION LISTAR 		
		function VistaListar($id){
			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL			
			global $con;
			include(VIEWS.DS."areas_dependencias".DS."FormInsertAreas_dependencias.php");
						// CARGANDO LLAMANDO LA FUNCION LSITAR LIBROS DEL MODELO (FUNCION QUE TRAE DE LA BASE DE DATOS EL LISTADO DE LIBROS
			$area = new MAreas;
			$area->CreateAreas("id", $id);
			// CREANDO UN NUEVO MODELO			
			$object = new MAreas_dependencias;
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			// DE NO RECIBIR PARAMETROS ESTA FUNCION TRAE EL LISTADO COMPLETO DE LIBROS
			$sx = "1";
			$query = $object->ListarAreas_dependencias(" WHERE id_area = '".$id."' AND id_version = '".$_SESSION['id_trd']."' group by nd,id_dependencia_raiz"," order by nd");	    
			echo '<h4 class="m-t-30 m-b-30"><b>TABLAS GENERADOS EN "'.$area->GetNombre().'"</b></h4>';
			include(VIEWS.DS."areas_dependencias".DS."Listar.php");

		}
		// FUNCION QUE CARGA LA VISTA DE INSERTAR (FORMULARIO DE INSERTAR)
		function VistaInsertar(){
			//CARGA EL TEMPLATE
			$pagina = $this->load_template('Crear Areas_dependencias');			
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();
			include_once(VIEWS.DS.'areas_dependencias/FormInsertAreas_dependencias.php');				
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
	 		$pagina = $this->load_template('Editar Areas_dependencias');			
				// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();		
	 		// INVOCAMOS UN NUEVO OBJETO
			 	$object = new MAreas_dependencias;
				// LO CREAMOS 			
			$object->CreateAreas_dependencias('id', $x);
			// Y FINALMENTE CARGAMOS LA VISTA DE EDICION QUE MUESTRA EL CONTENIDO			
			include_once(VIEWS.DS.'areas_dependencias/FormUpdateAreas_dependencias.php');		
			// OBTIENE EL CONTENIDO DEL BÚFER ACTUAL Y ELIMINA EL BÚFER DE SALIDA ACTUAL.											
			$table = ob_get_clean();	
			// ASIGNANDOLE A LA VARIABLE  EL CONTENIDO DEL BUFFER															
			$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $table  , $pagina);
			// CARGAMOS LA PAGINA EN EL BROWSER		
			$this->view_page($pagina);
	 	}	
	 	function Buscar($x, $cn = 'id'){
	 		// INVOCAMOS UN NUEVO OBJETO						
			$object = new MAreas_dependencias;
			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL						
			global $con;
			// CARGA EL TEMPLATE						
			$pagina = $this->load_template('Listado de Areas_dependencias');			
			// OBTENEMOS EL LISTADO DE LIBROS DE ACUERDO A LOS PARAMETROS QUE LE ENVIAMOS						
			$query = $object->ListarAreas_dependencias('WHERE '.$cn.' = "'.$x.'"');	    
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();		
	   		if($con->NumRows($query) <= 0 || $query !=''){
				// SI LA CONSULTA NO SE EJECUTA ENTONCES RETORNA VACIO							
				include_once(VIEWS.DS.'areas_dependencias/Listar.php');	   			
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
		function Insertar($id_area, $id_dependencia, $usuario, $fecha, $id_dependencia_raiz, $observacion){

			// DEFINIENDO EL OBJETO			
			$object = new MAreas_dependencias;
			// USANDO LA FUNCION DE INSERTAR DEL OBJETO PARA ENVIAR LA INFORMACION A LA BASE DE DATOA			
			$create = $object->InsertAreas_dependencias($id_area, $id_dependencia, $usuario, $fecha, $id_dependencia_raiz, $observacion);

			//SI NO SE ENVIO CORRECTAMENTE ENTONCES GENERA ERROR SINO ENVIA OK
			#if($create != '1')			
			#	$this->VistaListar('ERROR AL REGISTRAR');
			#else
			#	$this->VistaListar('OK!');	
			echo '<script>window.location.href = "'.HOMEDIR.DS.'herramientas/#grup"</script>';
		}
		// FUNCION QUE RECIBE UNASERIE DE PARAMETROS Y LOS ENVIA A LA BASE DE DATOS PARA ACTUALIZAR UN REGISTRO (FUNCION ESPECIAL)		
		function Editar($constrain, $fields, $updates, $output){
			$object = new MAreas_dependencias;
			$create = $object->UpdateAreas_dependencias($constrain, $fields, $updates, $output);

			//SI NO SE ENVIO CORRECTAMENTE ENTONCES GENERA ERROR SINO ENVIA OK
			if($create != '1')
				$this->VistaListar('ERROR AL REGISTRAR');
			else
				$this->VistaListar('OK!');						

		}
		// FUCNION QUE RECIBE UN PARAMETRO Y ELIMINA EL REGISTRO DE LA BASE DE DATOS		
		function Eliminar($id){
			// DEFINIMOS UN OBJETO NUEVO						
			$object = new MAreas_dependencias;
			// LLAMAMOS A LA FUNCION QUE EJECUTA LA ELIMINACION.			
			$delete = $object->DeleteAreas_dependencias($id); 		
			//SI NO SE ENVIO CORRECTAMENTE ENTONCES GENERA ERROR SINO ENVIA OK
			if($delete != '1')
				echo 'ERROR AL ELIMINAR';
				else
			echo 'OK!';			
		}
		function GetSeriesArea($id){
			global $con;
			$object = new MAreas_dependencias;
			// DE NO RECIBIR PARAMETROS ESTA FUNCION TRAE EL LISTADO COMPLETO DE LIBROS
			$query = $object->ListarAreas_dependencias(" WHERE id_area = '".$id."' and id_version='".$_SESSION['id_trd_empresa']."' group by id_dependencia_raiz");
			$select="";

			if($con->NumRows($query) == 1){

				$select = " selected ";

			}  
			while ($row = $con->FetchAssoc($query)) {
				$dep = new MDependencias;
				$dep->CreateDependencias("id", $row['id_dependencia_raiz']);
				echo "<option value='".$dep->GetId()."' $select>".$dep->GetNombre()."</option>";
			}
		}

		function GetSubSeriesArea($area, $serie){
			global $con;
			$object = new MAreas_dependencias;
			// DE NO RECIBIR PARAMETROS ESTA FUNCION TRAE EL LISTADO COMPLETO DE LIBROS
			$query = $object->ListarAreas_dependencias(" WHERE id_area = '".$area."' and id_dependencia_raiz = '".$serie."'");
			$select="";

			if($con->NumRows($query) == 1){
				$select = " selected ";
			}
			while ($row = $con->FetchAssoc($query)) {
				$dep = new MDependencias;
				$dep->CreateDependencias("id", $row['id_dependencia']);
				echo "<option value='".$dep->GetId()."' $select>".$dep->GetNombre()."</option>";
			}
		}
		function GetSubseries($area, $serie){

			global $con;
			
			$id_dependencia = $serie;
			$id = $area;

			echo "<div id='modulesubserieform'>";
			include(VIEWS.DS."dependencias/FormInsertSubseries.php");
			echo "</div>";
			
			$object = new MAreas_dependencias;
			$query = $object->ListarAreas_dependencias(" WHERE id_area = '".$area."' and id_dependencia_raiz = '".$serie."'");
			echo "<ul class='list-group' id='listsubseriesgroup'>";
				include(VIEWS.DS."areas_dependencias/ListarSubSeries.php");
			echo "</ul>";
		}
	}
?>
