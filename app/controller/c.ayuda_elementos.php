<?
session_start();
#error_reporting(E_ALL);
#ini_set('display_errors', '1');
	//Invocando archivos que seran usados en nuestro controlador generico	
	include_once('app/basePaths.inc.php');
	include_once(MODELS.DS.'Ayuda_elementosM.php');
	include_once(MODELS.DS.'Ayuda_librosM.php');
	include_once(MODELS.DS.'Ayuda_etiquetasM.php');
	include_once(MODELS.DS.'Ayuda_etiquetas_elementosM.php');
	include_once(MODELS.DS.'Super_adminM.php');
	include_once(MODELS.DS.'UsuariosM.php');
	include_once(ROOT.DS.'DALC'.DS.'/mySql.php');
	include_once('consultas.php');
	include_once('funciones.php');	

	// Definiendo variables y conectandonos con la base de datos
	$con = new ConexionBaseDatos;
	$con->Connect($con);
	
	// Llamando al objeto a controlar		
	$ob = new CAyuda_elementos;
	$c = new Consultas;
	$f = new Funciones;
	
	// DEFINIMOS EN UN VECTOR LOS CAMPOS QUE VAMOS A EDITAR
	$ar2 = array('titulo', 'texto', 'posicion', 'detalle', 'estado');
	// DEFINIMOS EN OTRO VECTOR LOS NUEVOS DATOS QUE VAMOS A METER	
	$ar1 = array($c->sql_quote($_REQUEST['titulo']), $c->sql_quote($_REQUEST['texto']), $c->sql_quote($_REQUEST['posicion']), $c->sql_quote($_REQUEST['detalle']), $c->sql_quote($_REQUEST['estado']));	
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
			$ob->Insertar($c->sql_quote($_REQUEST["titulo"]), $c->sql_quote($_REQUEST["texto"]), date("Y-m-d"), date("Y-m-d H:i:s"), $c->sql_quote($_REQUEST["libro_id"]), $c->sql_quote($_REQUEST["posicion"]));
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
			$ob->Buscar($c->sql_quote($_REQUEST['id']), "0");		
		elseif($c->sql_quote($_REQUEST['action']) == 'buscarpublic')
			$ob->Buscar($c->sql_quote($_REQUEST['id']), "1");
		else
		// SI NO ES NINGUNA DE LAS ANTERIORES ENTONCES CARGA POR DEFECTO LA VISTA DE LISTADO		
			$ob->VistaListar('');		
	
	// DEFINIENDO LA CLASE DEL CONTROLADOR DEL OBJETO QUE TIENE HERENCIA CON EL CONTROLADOR GENERICO PARA CARGAR LA INTERFAZ
	class CAyuda_elementos extends MainController{
		
		// DEFINIENDO LA FUNCION LISTAR 		
		function VistaListar(){
			// CREANDO UN NUEVO MODELO			
			$object = new MAyuda_elementos;
			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL			
			global $con;
			//CARGANDO LA PAGINA DE INTERFAZ			
			$pagina = $this->TemplateAmplelimpia('Listar Ayuda_elementos');			
			ob_start();
				
			$query = $object->ListarAyuda_elementos();	    
			include_once(VIEWS.DS.'ayuda_elementos/Listar.php');	   			
			$table = ob_get_clean();
			// SI NO TRAE NINGUNA VARIABLE ENTONCES GENERA UN ERROR
			// DE LO CONTRARIO ENTONCES CARGA EL CONTENIDO DE LA PAGINA
			$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $table , $pagina);
			$this->view_page($pagina);

		}
		// FUNCION QUE CARGA LA VISTA DE INSERTAR (FORMULARIO DE INSERTAR)
		function VistaInsertar($id){
			//CARGA EL TEMPLATE
			include_once(VIEWS.DS.'ayuda_elementos/FormInsertAyuda_elementos.php');				
		}
		// FUCNION QUE CARGA LA VISTA PARA EDITAR EL CONTENIDO DE UN REGISTRO
		function VistaEditar($x){		
	 		// INVOCAMOS UN NUEVO OBJETO
		 	$object = new MAyuda_elementos;
			// LO CREAMOS 			
			$object->CreateAyuda_elementos('id', $x);
			include_once(VIEWS.DS.'ayuda_elementos/FormUpdateAyuda_elementos.php');		
	 		
	 	}	
	 	function Buscar($x, $pub = "0"){
			global $con;
			global $c;
			global $f;
	 		// INVOCAMOS UN NUEVO OBJETO						
			$object = new MAyuda_elementos;
			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL						
			// CARGA EL TEMPLATE						
			$query = $object->ListarAyuda_elementos('WHERE libro_id = "'.$x.'"');	    
			if ($pub == "0") {
				include_once(VIEWS.DS.'ayuda_elementos/Listar_elementos.php');	   			
				# code...
			}else{
				include_once(VIEWS.DS.'ayuda_elementos/Listar_elementosPublicos.php');
			}

	 	}		
		// FUNCION QUE OBTIENE UNA SERIE DE DATOS Y LOS INSERTA EN LA BASE DE DATOS		
		function Insertar($titulo, $texto, $fecha_registro, $fecha_actualizacion, $libro_id, $posicion){
			global $con;
			global $c;
			global $f;
			// DEFINIENDO EL OBJETO			
			$object = new MAyuda_elementos;
			// USANDO LA FUNCION DE INSERTAR DEL OBJETO PARA ENVIAR LA INFORMACION A LA BASE DE DATOA			
			$create = $object->InsertAyuda_elementos($titulo, $texto, $fecha_registro, $fecha_actualizacion, $libro_id, $posicion);
			
			//SI NO SE ENVIO CORRECTAMENTE ENTONCES GENERA ERROR SINO ENVIA OK
			$id = $c->GetMaxIdTabla("ayuda_elementos", "id");
			echo $id;
			

		}
		// FUNCION QUE RECIBE UNASERIE DE PARAMETROS Y LOS ENVIA A LA BASE DE DATOS PARA ACTUALIZAR UN REGISTRO (FUNCION ESPECIAL)		
		function Editar($constrain, $fields, $updates, $output){
			$object = new MAyuda_elementos;
			$create = $object->UpdateAyuda_elementos($constrain, $fields, $updates, $output);
			
			echo "OK!";
			
		}
		// FUCNION QUE RECIBE UN PARAMETRO Y ELIMINA EL REGISTRO DE LA BASE DE DATOS		
		function Eliminar($id){
			// DEFINIMOS UN OBJETO NUEVO						
			$object = new MAyuda_elementos;
			// LLAMAMOS A LA FUNCION QUE EJECUTA LA ELIMINACION.			
			$delete = $object->DeleteAyuda_elementos($id); 		
			//SI NO SE ENVIO CORRECTAMENTE ENTONCES GENERA ERROR SINO ENVIA OK
			if($delete != '1')
				echo 'ERROR AL ELIMINAR';
			else
				echo 'OK!';			
			
		}
	}
?>