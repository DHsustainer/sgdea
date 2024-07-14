<?
session_start();

#error_reporting(E_ALL);

#ini_set('display_errors', '1');

	//Invocando archivos que seran usados en nuestro controlador generico	
	include_once('app/basePaths.inc.php');
	include_once(MODELS.DS.'Wf_mapas_elementosM.php');
	include_once(MODELS.DS.'Wf_elementosM.php');
	include_once(ROOT.DS.'DALC'.DS.'/mySql.php');
	include_once('consultas.php');
	include_once('funciones.php');	

	// Definiendo variables y conectandonos con la base de datos
	$con = new ConexionBaseDatos;
	$con->Connect($con);
	
	// Llamando al objeto a controlar		
	$ob = new CWf_mapas_elementos;
	$c = new Consultas;
	$f = new Funciones;
	
	// DEFINIMOS EN UN VECTOR LOS CAMPOS QUE VAMOS A EDITAR
	$ar2 = array('titulo', 'titulo_conector');
	// DEFINIMOS EN OTRO VECTOR LOS NUEVOS DATOS QUE VAMOS A METER	
	$ar1 = array($c->sql_quote($_REQUEST['titulo']), $c->sql_quote($_REQUEST['titulo_conector']));	
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
			$ob->Insertar($c->sql_quote($_REQUEST["id_mapa"]), $c->sql_quote($_REQUEST["id_elemento"]), $c->sql_quote($_REQUEST["titulo"]), date("Y-d-m H:i:s"), $_SESSION['usuario'], "0", $c->sql_quote($_REQUEST["id_dependencia"]),$c->sql_quote($_REQUEST["titulo_conector"]));
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
		elseif($c->sql_quote($_REQUEST['action']) == 'GetListadoDependencias')
			$ob->GetListadoDependencias($c->sql_quote($_REQUEST['id']));
		else
		// SI NO ES NINGUNA DE LAS ANTERIORES ENTONCES CARGA POR DEFECTO LA VISTA DE LISTADO		
			$ob->VistaListar('');		
	
	// DEFINIENDO LA CLASE DEL CONTROLADOR DEL OBJETO QUE TIENE HERENCIA CON EL CONTROLADOR GENERICO PARA CARGAR LA INTERFAZ
	class CWf_mapas_elementos extends MainController{
		
		// DEFINIENDO LA FUNCION LISTAR 		
		function VistaListar(){
			// CREANDO UN NUEVO MODELO			
			$object = new MWf_mapas_elementos;
			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL			
			global $con;
			//CARGANDO LA PAGINA DE INTERFAZ			
			$pagina = $this->load_template('Listar Wf_mapas_elementos');			
			// CARGANDO LLAMANDO LA FUNCION LSITAR LIBROS DEL MODELO (FUNCION QUE TRAE DE LA BASE DE DATOS EL LISTADO DE LIBROS
			// DE NO RECIBIR PARAMETROS ESTA FUNCION TRAE EL LISTADO COMPLETO DE LIBROS
			$query = $object->ListarWf_mapas_elementos();	    
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();
				// SI LA CONSULTA NO SE EJECUTA ENTONCES RETORNA VACIO
		   		if($con->NumRows($query) <= 0 || $query !=''){
					// SI LA CONSULTA SE EJECUTA ENTONCES CARGA EL LISTADO DE LIBROS DE LA VISTA
					include_once(VIEWS.DS.'wf_mapas_elementos/Listar.php');	   			
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
			$pagina = $this->load_template('Crear Wf_mapas_elementos');			
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();
			include_once(VIEWS.DS.'wf_mapas_elementos/FormInsertWf_mapas_elementos.php');				
			// OBTIENE EL CONTENIDO DEL BÚFER ACTUAL Y ELIMINA EL BÚFER DE SALIDA ACTUAL.						
			$path = ob_get_clean();	
			// ASIGNANDOLE A LA VARIABLE  EL CONTENIDO DEL BUFFER																																																															
			$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $path  , $pagina);
			// CARGAMOS LA PAGINA EN EL BROWSER	
			$this->view_page($pagina);		
		}
		// FUCNION QUE CARGA LA VISTA PARA EDITAR EL CONTENIDO DE UN REGISTRO
		function VistaEditar($x){
			global $con; 
			global $f;
			global $c;

		 	$object = new MWf_mapas_elementos;
			// LO CREAMOS 			
			$object->CreateWf_mapas_elementos('id', $x);
			// Y FINALMENTE CARGAMOS LA VISTA DE EDICION QUE MUESTRA EL CONTENIDO			
			include_once(VIEWS.DS.'wf_mapas_elementos/FormUpdateWf_mapas_elementos.php');		
			
	 	}	
	 	function Buscar($x, $cn = 'id'){
	 		// INVOCAMOS UN NUEVO OBJETO						
			$object = new MWf_mapas_elementos;
			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL						
			global $con;
			// CARGA EL TEMPLATE						
			$pagina = $this->load_template('Listado de Wf_mapas_elementos');			
			// OBTENEMOS EL LISTADO DE LIBROS DE ACUERDO A LOS PARAMETROS QUE LE ENVIAMOS						
			$query = $object->ListarWf_mapas_elementos('WHERE '.$cn.' = "'.$x.'"');	    
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();		
		   		if($con->NumRows($query) <= 0 || $query !=''){
					// SI LA CONSULTA NO SE EJECUTA ENTONCES RETORNA VACIO							
					include_once(VIEWS.DS.'wf_mapas_elementos/Listar.php');	   			
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
		function Insertar($id_mapa, $id_elemento, $titulo, $fecha, $usuario, $id_evento, $id_dependencia, $titulo_conector){
			// DEFINIENDO EL OBJETO			

			$elemento = new MWf_elementos;
			$elemento->CreateWf_elementos("id", $id_elemento);


			$object = new MWf_mapas_elementos;
			// USANDO LA FUNCION DE INSERTAR DEL OBJETO PARA ENVIAR LA INFORMACION A LA BASE DE DATOA			
			$create = $object->InsertWf_mapas_elementos($id_mapa, $id_elemento, $titulo, $fecha, $usuario, $id_evento, $id_dependencia, $elemento->GetDescripcion());
			

			//SI NO SE ENVIO CORRECTAMENTE ENTONCES GENERA ERROR SINO ENVIA OK
			$query = $object->ListarWf_mapas_elementos("where id_dependencia = '".$id_dependencia."'");	    			

			echo '	<div class="mapa_elemento elementonodo scrollable"  id="node'.$id_dependencia.'" >
						<ul class="nav nav-pills nav-stacked">';
						while ($row = $con->FetchAssoc($query)) {

							$popover = "";
							if ($row['titulo_conector'] != "") {
								$popover = 'data-toggle="popover" data-trigger="hover" data-content="'.$row['titulo_conector'].'"';
							}

							echo '  <li role="presentation" '.$popover.' id="xnode'.$row['id'].$row['id'].'" data-role="'.$row['id'].'" class="elementodelista dropdown" style="clear:both">
										<a href="#" onClick="ElementodeLista(\''.$row['id'].'\')" style="float:left; border-top-right-radius: 0px; border-bottom-right-radius: 0px;" id="textnode'.$row['id'].'">
											'.$row['titulo'].'
										</a>
										<a style="float:left; padding-top: 20px; padding-bottom: 16px; border-bottom-left-radius: 0px; border-top-left-radius: 0px;" class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><span class="caret"></span></a>
											<ul class="dropdown-menu">
												<li><a href="#" onClick="LoadEditar(\'wf_mapas_elementos\', \''.$row['id'].'\')"  data-target="#myModal" data-toggle="modal" >Editar</a></li>
												<li><a href="#" onClick="Eliminar(\'wf_mapas_elementos\', \''.$row['id'].'\')">Eliminar</a></li>
	    									</ul>
									</li>';
						}


						
							
			echo '		</ul>
					</div>';

			echo '	<script>
						$(document).ready(function(){
	    					$(\'[data-toggle="popover"]\').popover();
						});
					</script>';

		}
		// FUNCION QUE RECIBE UNASERIE DE PARAMETROS Y LOS ENVIA A LA BASE DE DATOS PARA ACTUALIZAR UN REGISTRO (FUNCION ESPECIAL)		
		function Editar($constrain, $fields, $updates, $output){
			$object = new MWf_mapas_elementos;
			$create = $object->UpdateWf_mapas_elementos($constrain, $fields, $updates, $output);
			
			echo ":-D";					
			
		}
		// FUCNION QUE RECIBE UN PARAMETRO Y ELIMINA EL REGISTRO DE LA BASE DE DATOS		
		function Eliminar($id){
			// DEFINIMOS UN OBJETO NUEVO						
			$object = new MWf_mapas_elementos;
			// LLAMAMOS A LA FUNCION QUE EJECUTA LA ELIMINACION.			
			$delete = $object->DeleteWf_mapas_elementos($id); 		
			//SI NO SE ENVIO CORRECTAMENTE ENTONCES GENERA ERROR SINO ENVIA OK
			if($delete != '1')
				echo 'ERROR AL ELIMINAR';
			else
				echo 'OK!';			
			
		}
		function GetListadoDependencias($id){

// CREANDO UN NUEVO MODELO			
			$object = new MWf_mapas_elementos;
			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL			
			global $con;
			// CARGANDO LLAMANDO LA FUNCION LSITAR LIBROS DEL MODELO (FUNCION QUE TRAE DE LA BASE DE DATOS EL LISTADO DE LIBROS
			// DE NO RECIBIR PARAMETROS ESTA FUNCION TRAE EL LISTADO COMPLETO DE LIBROS
			$query = $object->ListarWf_mapas_elementos("where id_dependencia = '".$id."'");	    			

			if ($con->NumRows($query) >= 1) {
				# code...
			echo '	<div class="mapa_elemento elementonodo scrollable"  id="node'.$id.'" >
						<ul class="nav nav-pills nav-stacked">';
						while ($row = $con->FetchAssoc($query)) {

							$popover = "";
							if ($row['titulo_conector'] != "") {
								$popover = 'data-toggle="popover" data-trigger="hover" data-content="'.$row['titulo_conector'].'"';
							}

							echo '  <li role="presentation" '.$popover.' id="xnode'.$row['id'].$row['id'].'" data-role="'.$row['id'].'" class="elementodelista dropdown" style="clear:both">
										<a href="#" onClick="ElementodeLista(\''.$row['id'].'\')" style="float:left; border-top-right-radius: 0px; border-bottom-right-radius: 0px;" id="textnode'.$row['id'].'">
											'.$row['titulo'].'
										</a>
										<a style="float:left; padding-top: 20px; padding-bottom: 16px; border-bottom-left-radius: 0px; border-top-left-radius: 0px;" class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><span class="caret"></span></a>
											<ul class="dropdown-menu">
												<li><a href="#" onClick="LoadEditar(\'wf_mapas_elementos\', \''.$row['id'].'\')"  data-target="#myModal" data-toggle="modal" >Editar</a></li>
												<li><a href="#" onClick="Eliminar(\'wf_mapas_elementos\', \''.$row['id'].'\')">Eliminar</a></li>
	    									</ul>
									</li>';
						}
							
			echo '		</ul>
					</div>';

			echo '	<script>
						$(document).ready(function(){
	    					$(\'[data-toggle="popover"]\').popover();
						});
					</script>';
			}else{
				echo '	<script>
							alert("Actualmente, No hay nodos asociados a este flujo")
						</script>';
			}

					/*
<li role="presentation" class="">
    <a >
      Dropdown ></span>
    </a>
    
  </li>

					*/
		}
	}
?>