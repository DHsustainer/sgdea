<?
	session_start();
#error_reporting(E_ALL);
#ini_set('display_errors', '1');
	//Invocando archivos que seran usados en nuestro controlador generico	
	include_once('app/basePaths.inc.php');
	include_once(MODELS.DS.'Wf_gestion_mapas_elementosM.php');
	include_once(MODELS.DS.'Wf_mapas_elementosM.php');
	include_once(MODELS.DS.'Alertas_usuariosM.php');
	include_once(MODELS.DS.'Events_gestionM.php');

	include_once(ROOT.DS.'DALC'.DS.'/mySql.php');
	include_once('consultas.php');
	include_once('funciones.php');	

	// Definiendo variables y conectandonos con la base de datos
	$con = new ConexionBaseDatos;
	$con->Connect($con);
	
	// Llamando al objeto a controlar		
	$ob = new CWf_gestion_mapas_elementos;
	$au = new MAlertas_usuarios;

	$c = new Consultas;
	$f = new Funciones;
	
	// DEFINIMOS EN UN VECTOR LOS CAMPOS QUE VAMOS A EDITAR
	$ar2 = array('id_mapa', 'id_elemento', 'titulo', 'fecha', 'usuario', 'id_evento', 'id_dependencia', 'id_mapas_elementos', 'estado', 'titulo_conector');
	// DEFINIMOS EN OTRO VECTOR LOS NUEVOS DATOS QUE VAMOS A METER	
	$ar1 = array($c->sql_quote($_REQUEST['id_mapa']), $c->sql_quote($_REQUEST['id_elemento']), $c->sql_quote($_REQUEST['titulo']), $c->sql_quote($_REQUEST['fecha']), $c->sql_quote($_REQUEST['usuario']), $c->sql_quote($_REQUEST['id_evento']), $c->sql_quote($_REQUEST['id_dependencia']), $c->sql_quote($_REQUEST['id_mapas_elementos']), $c->sql_quote($_REQUEST['estado']), $c->sql_quote($_REQUEST['titulo_conector']));	
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
			$ob->Insertar($c->sql_quote($_REQUEST["id_mapa"]), $c->sql_quote($_REQUEST["id_elemento"]), $c->sql_quote($_REQUEST["titulo"]), $c->sql_quote($_REQUEST["fecha"]), $c->sql_quote($_REQUEST["usuario"]), $c->sql_quote($_REQUEST["id_evento"]), $c->sql_quote($_REQUEST["id_dependencia"]), $c->sql_quote($_REQUEST["id_mapas_elementos"]), $c->sql_quote($_REQUEST["estado"]), $c->sql_quote($_REQUEST["titulo_conector"]));
		// SINO SI ES EDITAR ENTONCES CARGA EL FORMULARIO EDITAR	
		elseif($c->sql_quote($_REQUEST['action']) == 'editar')
			$ob->VistaEditar($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['cn']), $c->sql_quote($_REQUEST['p1']));	
		// SINO SI ES ACTUALIZAR ENTONCES ENVIA UNA ACTUALIZACION CON LOS PARAMETROS CAPTURADOS
		elseif($c->sql_quote($_REQUEST['action']) == 'actualizar')
			$ob->Editar($c->sql_quote($_REQUEST["user_id"]), $c->sql_quote($_REQUEST["gestion_id"]), $c->sql_quote($_REQUEST["fecha"]), $c->sql_quote($_REQUEST["title"]), $c->sql_quote($_REQUEST["description"]), $c->sql_quote($_REQUEST["added"]), $c->sql_quote($_REQUEST["status"]), $c->sql_quote($_REQUEST["time"]), $c->sql_quote($_REQUEST["alerted"]), $c->sql_quote($_REQUEST["avisar_a"]), $c->sql_quote($_REQUEST["type_event"]), $c->sql_quote($_REQUEST["fecha_vencimiento"]), '0', '0', '0', '0',  $c->sql_quote($_REQUEST["grupo"]),  $c->sql_quote($_REQUEST["es_publico"]),  $c->sql_quote($_REQUEST["id_elemento"]),  $c->sql_quote($_REQUEST["estado"]));
		// SINO SI ES ELIMINAR ENTONCES CARGA LA FUNCION ELIMINAR
		elseif($c->sql_quote($_REQUEST['action']) == 'eliminar')
			$ob->Eliminar($c->sql_quote($_REQUEST['id']));
		// SINO SI ES NUEVO BUSCAR CARGA EL BUSCADOR			
		elseif($c->sql_quote($_REQUEST['action']) == 'buscar')
			$ob->Buscar($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['cn']));		
		elseif($c->sql_quote($_REQUEST['action']) == 'GetListadoDependencias')
			$ob->GetListadoDependencias($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['cn']));
		else
		// SI NO ES NINGUNA DE LAS ANTERIORES ENTONCES CARGA POR DEFECTO LA VISTA DE LISTADO		
			$ob->VistaListar('');		
	
	// DEFINIENDO LA CLASE DEL CONTROLADOR DEL OBJETO QUE TIENE HERENCIA CON EL CONTROLADOR GENERICO PARA CARGAR LA INTERFAZ
	class CWf_gestion_mapas_elementos extends MainController{
		
		// DEFINIENDO LA FUNCION LISTAR 		
		function VistaListar(){
			// CREANDO UN NUEVO MODELO			
			$object = new MWf_gestion_mapas_elementos;
			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL			
			global $con;
			//CARGANDO LA PAGINA DE INTERFAZ			
			$pagina = $this->load_template('Listar Wf_gestion_mapas_elementos');			
			// CARGANDO LLAMANDO LA FUNCION LSITAR LIBROS DEL MODELO (FUNCION QUE TRAE DE LA BASE DE DATOS EL LISTADO DE LIBROS
			// DE NO RECIBIR PARAMETROS ESTA FUNCION TRAE EL LISTADO COMPLETO DE LIBROS
			$query = $object->ListarWf_gestion_mapas_elementos();	    
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();
				// SI LA CONSULTA NO SE EJECUTA ENTONCES RETORNA VACIO
		   		if($con->NumRows($query) <= 0 || $query !=''){
					// SI LA CONSULTA SE EJECUTA ENTONCES CARGA EL LISTADO DE LIBROS DE LA VISTA
					include_once(VIEWS.DS.'wf_gestion_mapas_elementos/Listar.php');	   			
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
			$pagina = $this->load_template('Crear Wf_gestion_mapas_elementos');			
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();
			include_once(VIEWS.DS.'wf_gestion_mapas_elementos/FormInsertWf_gestion_mapas_elementos.php');				
			// OBTIENE EL CONTENIDO DEL BÚFER ACTUAL Y ELIMINA EL BÚFER DE SALIDA ACTUAL.						
			$path = ob_get_clean();	
			// ASIGNANDOLE A LA VARIABLE  EL CONTENIDO DEL BUFFER																																																															
			$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $path  , $pagina);
			// CARGAMOS LA PAGINA EN EL BROWSER	
			$this->view_page($pagina);		
		}
		// FUCNION QUE CARGA LA VISTA PARA EDITAR EL CONTENIDO DE UN REGISTRO
		function VistaEditar($id, $id_gestion, $id_elemento){

		#	echo $id."º--º".$id_gestion."º--º".$id_elemento."º--";
			global $con; 
			global $c;
			global $f;
			// INVOCAMOS UN NUEVO OBJETO
		 	$object = new MWf_gestion_mapas_elementos;
			// LO CREAMOS 			
			$object->CreateWf_gestion_mapas_elementos('id', $id_elemento);
			// Y FINALMENTE CARGAMOS LA VISTA DE EDICION QUE MUESTRA EL CONTENIDO			
			include_once(VIEWS.DS.'wf_gestion_mapas_elementos/FormUpdateWf_gestion_mapas_elementos.php');		
			
	 	}	
	 	function Buscar($x, $cn = 'id'){
	 		// INVOCAMOS UN NUEVO OBJETO						
			$object = new MWf_gestion_mapas_elementos;
			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL						
			global $con;
			// CARGA EL TEMPLATE						
			$pagina = $this->load_template('Listado de Wf_gestion_mapas_elementos');			
			// OBTENEMOS EL LISTADO DE LIBROS DE ACUERDO A LOS PARAMETROS QUE LE ENVIAMOS						
			$query = $object->ListarWf_gestion_mapas_elementos('WHERE '.$cn.' = "'.$x.'"');	    
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();		
		   		if($con->NumRows($query) <= 0 || $query !=''){
					// SI LA CONSULTA NO SE EJECUTA ENTONCES RETORNA VACIO							
					include_once(VIEWS.DS.'wf_gestion_mapas_elementos/Listar.php');	   			
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
		function Insertar($id_mapa, $id_elemento, $titulo, $fecha, $usuario, $id_evento, $id_dependencia, $id_mapas_elementos, $estado, $titulo_conector){
			// DEFINIENDO EL OBJETO			
			$object = new MWf_gestion_mapas_elementos;
			// USANDO LA FUNCION DE INSERTAR DEL OBJETO PARA ENVIAR LA INFORMACION A LA BASE DE DATOA			
			$create = $object->InsertWf_gestion_mapas_elementos($id_mapa, $id_elemento, $titulo, $fecha, $usuario, $id_evento, $id_dependencia, $id_mapas_elementos, $estado, $titulo_conector);
			
			//SI NO SE ENVIO CORRECTAMENTE ENTONCES GENERA ERROR SINO ENVIA OK
			if($create != '1')
				$this->VistaListar('ERROR AL REGISTRAR');
			else
				$this->VistaListar('OK!');	

		}
		// FUNCION QUE RECIBE UNASERIE DE PARAMETROS Y LOS ENVIA A LA BASE DE DATOS PARA ACTUALIZAR UN REGISTRO (FUNCION ESPECIAL)		
		

		function Editar($user_id, $gestion_id, $fecha, $title, $description, $added, $status, $time, $alerted, $avisar_a, $type_event, $fecha_vencimiento, $id_generico = "0", $seccional = "0", $oficina = "0", $area = "0", $grupo = "0", $es_publico, $id_elemento, $estado){
			
			global $con;
			global $c;
			global $f;

		#	print_r($_REQUEST);

			$object = new MEvents_gestion;

			$id = $c->GetMaxIdTabla("events_gestion", "id");
			$id += 1;
			// USANDO LA FUNCION DE INSERTAR DEL OBJETO PARA ENVIAR LA INFORMACION A LA BASE DE DATOA			
			$insertar = $object->InsertEvents_gestion($user_id, $gestion_id, $fecha, $title, $description, $added, $status, $time, $alerted, $avisar_a, $type_event, $fecha_vencimiento, 0, $_SESSION['seccional'], $_SESSION['area_principal'], $_SESSION['area_principal'], $grupo, "ev",  $id, $es_publico);

			
			
			$ar2 = array('id_evento', 'estado');
			// DEFINIMOS EN OTRO VECTOR LOS NUEVOS DATOS QUE VAMOS A METER	
			$ar1 = array($id, "1");	
			// DEFINIMOS LOS ESTADOS DE SALIDA
			$output = array('registro actualizado', 'no se pudo actualizar'); 
			// Y POR ULTIMO DEFINIMOS EL CONTRAIN PARA LA ACTUALIZACION	
			$constrain = 'WHERE id = '.$id_elemento;
	

			$object2 = new MWf_gestion_mapas_elementos;
			$create = $object2->UpdateWf_gestion_mapas_elementos($constrain, $ar2, $ar1, $output);
			
			//SI NO SE ENVIO CORRECTAMENTE ENTONCES GENERA ERROR SINO ENVIA OK
			
			
		}
		// FUCNION QUE RECIBE UN PARAMETRO Y ELIMINA EL REGISTRO DE LA BASE DE DATOS		
		function Eliminar($id){
			// DEFINIMOS UN OBJETO NUEVO						
			$object = new MWf_gestion_mapas_elementos;
			// LLAMAMOS A LA FUNCION QUE EJECUTA LA ELIMINACION.			
			$delete = $object->DeleteWf_gestion_mapas_elementos($id); 		
			//SI NO SE ENVIO CORRECTAMENTE ENTONCES GENERA ERROR SINO ENVIA OK
			if($delete != '1')
				echo 'ERROR AL ELIMINAR';
			else
				echo 'OK!';			
			
		}

		function GetListadoDependencias($id, $id_gestion){

// CREANDO UN NUEVO MODELO			
			#echo $id.$id_gestion;
			$object = new MWf_gestion_mapas_elementos;
			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL			
			global $con;
			// CARGANDO LLAMANDO LA FUNCION LSITAR LIBROS DEL MODELO (FUNCION QUE TRAE DE LA BASE DE DATOS EL LISTADO DE LIBROS
			// DE NO RECIBIR PARAMETROS ESTA FUNCION TRAE EL LISTADO COMPLETO DE LIBROS
			$id_nodo_padre = $id;
			$query  = $object->ListarWf_gestion_mapas_elementos("where id_dependencia = '".$id."' and id_gestion = '".$id_gestion."'");	    			
			$query2 = $object->ListarWf_gestion_mapas_elementos("where id_elemento_mapa_elemento = '".$id."' and id_gestion = '".$id_gestion."'");

			$rx = $con->FetchAssoc($query2);
			$evento = $rx['id_evento'];



			if ($con->NumRows($query) >= 1) {
				# code...
				#echo "si encontre";
				
			//	$id = $rx['id_elemento_mapa_elemento'];
			echo '	<div class="mapa_elemento elementonodo scrollable"  id="node'.$id.'" >
						<ul class="nav nav-pills nav-stacked">';
						while ($row = $con->FetchAssoc($query)) {
							#echo "entro a la lista";
							$id = $row['id_elemento_mapa_elemento'];
							$popover = "";
							if ($row['titulo_conector'] != "") {
								$popover = 'data-toggle="popover" data-trigger="hover" data-content="'.$row['titulo_conector'].'"';
							}

							$angle = "";
							$tiene = $con->Query("Select count(*) as t from wf_gestion_mapas_elementos where  id_dependencia = '".$id."' and id_gestion = '".$id_gestion."' ");
							$tiene_hijos = $con->FetchAssoc($tiene);

							if ($tiene_hijos['t'] > 0) {
								$angle = '<span class="fa fa-chevron-right" style="margin-left:7px"></span>';
							}


							if ($row['id_evento'] != "1") {
								$color = "<span class='fa fa-check' style='margin-left:7px;'></span>"; #'<span class="fa fa-chack">ok!</span>';
							}

							echo '  <li role="presentation" '.$popover.' id="xnode'.$id.$id.'" data-role="'.$id.'" class="elementodelista dropdown" style="clear:both">
										<a href="#" onClick="ElementodeLista(\''.$id.'\')" style="float:left; border-top-right-radius: 0px; border-bottom-right-radius: 0px; '.$color.'" id="textnode'.$id.'">
											<span>'.$row['titulo'].$color.$angle.'</span>
										</a>';

							#echo $evento;
							if ($evento > 1 ) {


								if ($row['id_evento'] > 1) {
									# code...
									if ($row['estado'] == "1") {
										echo '
												<a style="float:left; padding-top: 20px; padding-bottom: 16px; border-bottom-left-radius: 0px; border-top-left-radius: 0px;" class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
													<span class="caret"></span>
												</a>
												<ul class="dropdown-menu">
													<li><a href="#" onClick="Editaractividad(\''.$id.'\', \''.$id_gestion.'\', \''.$row['id'].'\', \'1\')"  data-target="#myModal" data-toggle="modal" >Completar Actividad</a></li>
													<li><a href="#" onClick="Editaractividad(\''.$id.'\', \''.$id_gestion.'\', \''.$row['id'].'\', \'2\')"  data-target="#myModal" data-toggle="modal" >Cancelar Actividad</a></li>
		    									</ul> ';
									#MOSTRAR MENSAJE DE ACTIVIDAD FINALIZADA	
									}else{
										echo '
												<a style="float:left; padding-top: 20px; padding-bottom: 16px; border-bottom-left-radius: 0px; border-top-left-radius: 0px;" class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><span class="caret"></span></a>
												<ul class="dropdown-menu">
													<li>Actividad Finalizada</li>
		    									</ul>';
										
									}
								}else{
									
									echo '
											<a style="float:left; padding-top: 20px; padding-bottom: 16px; border-bottom-left-radius: 0px; border-top-left-radius: 0px;" class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><span class="caret"></span></a>
											<ul class="dropdown-menu">
												<li><a href="#" onClick="ActivarActividad(\''.$id.'\', \''.$id_gestion.'\', \''.$row['id'].'\')"  data-target="#myModal" data-toggle="modal" >Iniciar Actividad</a></li>
	    									</ul>';
								}

								
							
							
							}

							echo '	</li>';
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
							alert("Este es el ultimo elemento.")
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
		