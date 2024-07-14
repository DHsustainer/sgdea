<?
#session_start();
#error_reporting(E_ALL);
#ini_set('display_errors', '1');

	//Invocando archivos que seran usados en nuestro controlador generico	

	include_once('app/basePaths.inc.php');

	include_once(MODELS.DS.'Areas_dependenciasM.php');

	include_once(MODELS.DS.'AreasM.php');

	include_once(MODELS.DS.'Alertas_usuariosM.php');

	include_once(MODELS.DS.'Big_dataM.php');

	include_once(MODELS.DS.'CityM.php');

	include_once(MODELS.DS.'Documentos_gestionM.php');

	include_once(MODELS.DS.'Dependencias_documentosM.php');

	include_once(MODELS.DS.'Dependencias_tipologiasM.php');

	include_once(MODELS.DS.'Documentos_gestion_permisosM.php');

	include_once(MODELS.DS.'Dependencias_permisos_documentoM.php');

	include_once(MODELS.DS.'DependenciasM.php');

	include_once(MODELS.DS.'Dependencias_alertasM.php');

	include_once(MODELS.DS.'Events_gestionM.php');

	include_once(MODELS.DS.'Estados_gestionM.php');

	include_once(MODELS.DS.'FolderM.php');

	include_once(MODELS.DS.'GestionM.php');

	include_once(MODELS.DS.'Gestion_anexosM.php');

	include_once(MODELS.DS.'Gestion_compartirM.php');

	include_once(MODELS.DS.'Gestion_folderM.php');

	include_once(MODELS.DS.'Gestion_suscriptoresM.php');

	include_once(MODELS.DS.'Plantilla_dependenciaM.php');

	include_once(MODELS.DS.'ProvinceM.php');

	include_once(MODELS.DS.'Ref_tablesM.php');

	include_once(MODELS.DS.'Seccional_principalM.php');

	include_once(MODELS.DS.'SeccionalM.php');

	include_once(MODELS.DS.'Super_adminM.php');

	include_once(MODELS.DS.'Suscriptores_contactosM.php');

	include_once(MODELS.DS.'Suscriptores_contactos_direccionM.php');

	include_once(MODELS.DS.'Dependencias_tipologias_referenciasM.php');

	include_once(MODELS.DS.'Gestion_tipologias_big_dataM.php');

	include_once(MODELS.DS.'UsuariosM.php');

	include_once(MODELS.DS.'Dependencias_versionM.php');

	include_once(MODELS.DS.'Meta_referencias_titulosM.php');
	include_once(MODELS.DS.'Meta_referencias_camposM.php');
	include_once(MODELS.DS.'Meta_tipos_elementosM.php');
	include_once(MODELS.DS.'Meta_listasM.php');


	##include_once(PLUGINS.DS.'PHPMailer_5.2.4/class.phpmailer.php');	

	include_once(ROOT.DS.'DALC'.DS.'/mySql.php');

	include_once('consultas.php');

	include_once('funciones.php');	



	// Definiendo variables y conectandonos con la base de datos

	$con = new ConexionBaseDatos;

	$con->Connect($con);

	

	// Llamando al objeto a controlar		

	$ob = new CDependencias;

	$c = new Consultas;

	$f = new Funciones;

	

	// DEFINIMOS EN UN VECTOR LOS CAMPOS QUE VAMOS A EDITAR

	$ar2 = array('nombre', 't_g', 't_c', 't_h', 'observacion', 'id_c', 'es_inmaterial', 'es_publico', 'titulo_publico', 'dias_vencimiento');

	// DEFINIMOS EN OTRO VECTOR LOS NUEVOS DATOS QUE VAMOS A METER	

	$ar1 = array($c->sql_quote($_REQUEST['nombre']), $c->sql_quote($_REQUEST["t_g"]), $c->sql_quote($_REQUEST["t_c"]), $c->sql_quote($_REQUEST["t_h"]), $c->sql_quote($_REQUEST["observacion"]), $c->sql_quote($_REQUEST["id_c"]), $c->sql_quote($_REQUEST["is_inmx"]), $c->sql_quote($_REQUEST["es_publicox"]), $c->sql_quote($_REQUEST["titulo_publicox"]), $c->sql_quote($_REQUEST["dias_vencimiento"]));	

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
		elseif($c->sql_quote($_REQUEST['action']) == 'registrarseriesimple'){
		// CAPTURA LAS VARIAABLES Y ENVIALAS A LA FUNCION INSERTAR
			global $con;
			$areap = new MAreas;
			$query = $areap->ListarAreas('');
			while($row_ss = $con->FetchAssoc($query)){
				$ob->Insertar('DOCUMENTO SIN CLASIFICAR', '', 'sanderkdna@gmail.com', '2019-04-01', '1', '0', '0', '0', '', '', '','on', $row_ss['id'], 'N', '', '', '');
			}
			echo "realizado";
			exit;
		}elseif($c->sql_quote($_REQUEST['action']) == 'registrar')
		// CAPTURA LAS VARIAABLES Y ENVIALAS A LA FUNCION INSERTAR		
			$ob->Insertar($c->sql_quote($_REQUEST["nombre"]), $c->sql_quote($_REQUEST["dependencia"]), $c->sql_quote($_REQUEST["usuario"]), $c->sql_quote($_REQUEST["fecha"]), $c->sql_quote($_REQUEST["estado"]), $c->sql_quote($_REQUEST["t_g"]), $c->sql_quote($_REQUEST["t_c"]), $c->sql_quote($_REQUEST["t_h"]), $c->sql_quote($_REQUEST["observacion"]), $c->sql_quote($_REQUEST["id_c"]), $c->sql_quote($_REQUEST["is_inm"]), $c->sql_quote($_REQUEST["no_s"]), $c->sql_quote($_REQUEST["id"]), $c->sql_quote($_REQUEST["serie_id"]), $c->sql_quote($_REQUEST["es_publico"]), $c->sql_quote($_REQUEST["titulo_publico"]), $c->sql_quote($_REQUEST["dias_vencimiento"]));
		elseif($c->sql_quote($_REQUEST['action']) == 'registrarss')
		// CAPTURA LAS VARIAABLES Y ENVIALAS A LA FUNCION INSERTAR		
			$ob->Insertarss($c->sql_quote($_REQUEST["nombre"]), $c->sql_quote($_REQUEST["dependencia"]), $c->sql_quote($_REQUEST["usuario"]), $c->sql_quote($_REQUEST["fecha"]), $c->sql_quote($_REQUEST["estado"]), $c->sql_quote($_REQUEST["t_g"]), $c->sql_quote($_REQUEST["t_c"]), $c->sql_quote($_REQUEST["t_h"]), $c->sql_quote($_REQUEST["observacion"]), $c->sql_quote($_REQUEST["id_c"]), $c->sql_quote($_REQUEST["is_inm"]), $c->sql_quote($_REQUEST["no_s"]), $c->sql_quote($_REQUEST["id"]),  $c->sql_quote($_REQUEST["es_publico"]), $c->sql_quote($_REQUEST["titulo_publico"]), $c->sql_quote($_REQUEST["dias_vencimiento"]));
		// SINO SI ES EDITAR ENTONCES CARGA EL FORMULARIO EDITAR	
		elseif($c->sql_quote($_REQUEST['action']) == 'editar')

			$ob->VistaEditar($c->sql_quote($_REQUEST['id']));	

		// SINO SI ES ACTUALIZAR ENTONCES ENVIA UNA ACTUALIZACION CON LOS PARAMETROS CAPTURADOS

		elseif($c->sql_quote($_REQUEST['action']) == 'actualizar')

			$ob->Editar($constrain, $ar2, $ar1, $output, $c->sql_quote($_REQUEST["dependencia"]));

		// SINO SI ES ELIMINAR ENTONCES CARGA LA FUNCION ELIMINAR

		elseif($c->sql_quote($_REQUEST['action']) == 'eliminar')

			$ob->Eliminar($c->sql_quote($_REQUEST['id']));

		// SINO SI ES ELIMINAR ENTONCES CARGA LA FUNCION ELIMINAR

		elseif($c->sql_quote($_REQUEST['action']) == 'optiondependencias')

			$ob->OptionDependencias($c->sql_quote($_REQUEST['id']));

		

		elseif($c->sql_quote($_REQUEST['action']) == 'activar')

			$ob->Activar($c->sql_quote($_REQUEST['id']));
		elseif($c->sql_quote($_REQUEST['action']) == 'creados')
			$ob->VerCreados();
		// SINO SI ES NUEVO BUSCAR CARGA EL BUSCADOR			

		elseif($c->sql_quote($_REQUEST['action']) == 'childs')

			$ob->GetChildsDependencia($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['cn']));		

		elseif($c->sql_quote($_REQUEST['action']) == 'nochilds')

			$ob->GetNoChildsDependencia($c->sql_quote($_REQUEST['id']));		

		elseif($c->sql_quote($_REQUEST['action']) == 'explorar')

			$ob->Explorar($c->sql_quote($_REQUEST['id']));				

		elseif($c->sql_quote($_REQUEST['action']) == 'NoExplorar')

			$ob->NoExplorar($c->sql_quote($_REQUEST['id']));				

		elseif($c->sql_quote($_REQUEST['action']) == 'verradicaciones')

			$ob->VerRadicaciones($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['cn']));				

		elseif($c->sql_quote($_REQUEST['action']) == 'verradicaciones2')

			$ob->VerRadicaciones2($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['cn']));				

		elseif($c->sql_quote($_REQUEST['action']) == 'configurar')

			$ob->Configurar($c->sql_quote($_REQUEST['id']));	

		elseif($c->sql_quote($_REQUEST['action']) == 'views_formularios')

			$ob->views_formularios($c->sql_quote($_REQUEST['id']));	

		elseif($c->sql_quote($_REQUEST['action']) == 'views_minutas')

			$ob->views_minutas($c->sql_quote($_REQUEST['id']));							



		elseif($c->sql_quote($_REQUEST['action']) == 'views_tipologias')

			$ob->views_tipologias($c->sql_quote($_REQUEST['id']));							

		elseif($c->sql_quote($_REQUEST['action']) == 'views_estados')

			$ob->views_estados($c->sql_quote($_REQUEST['id']));							

		elseif($c->sql_quote($_REQUEST['action']) == 'views_alertas_subs')

			$ob->views_alertas_subs($c->sql_quote($_REQUEST['id']));							

		elseif($c->sql_quote($_REQUEST['action']) == 'views_permisos_doc')

			$ob->views_permisos_doc($c->sql_quote($_REQUEST['id']));							

		elseif($c->sql_quote($_REQUEST['action']) == 'views_doc_obligatorios')

			$ob->views_doc_obligatorios($c->sql_quote($_REQUEST['id']));	

		elseif($c->sql_quote($_REQUEST['action']) == 'GetProcedimiento')

			$ob->GetProcedimiento($c->sql_quote($_REQUEST['id']));	

		elseif($c->sql_quote($_REQUEST['action']) == 'TRD')

			$ob->GetTRD($c->sql_quote($_REQUEST['id']));

		elseif($c->sql_quote($_REQUEST['action']) == 'TVD')

			$ob->GetTVD($c->sql_quote($_REQUEST['id']));


		elseif($c->sql_quote($_REQUEST['action']) == 'TRDS')

			$ob->GetTRDS($c->sql_quote($_REQUEST['id']));

		elseif($c->sql_quote($_REQUEST['action']) == 'TVDS')
			$ob->GetTVDS($c->sql_quote($_REQUEST['id']));

		elseif($c->sql_quote($_REQUEST['action']) == 'CCD')

			$ob->GetCCD($c->sql_quote($_REQUEST['id']));

		elseif($c->sql_quote($_REQUEST['action']) == 'CCDS')

			$ob->GetCCDS($c->sql_quote($_REQUEST['id']));

		elseif($c->sql_quote($_REQUEST['action']) == 'TRD_E')

			$ob->GetTRD_E($c->sql_quote($_REQUEST['id']),$c->sql_quote($_REQUEST['cn']));	

		elseif($c->sql_quote($_REQUEST['action']) == 'GetNuevaDependencia')

			$ob->GetNuevaDependencia();

		elseif($c->sql_quote($_REQUEST['action']) == 'metadatos')

			$ob->metadatos($c->sql_quote($_REQUEST['id']));		

		elseif($c->sql_quote($_REQUEST['action']) == 'UsuariosAreas')

			$ob->UsuariosAreas($c->sql_quote($_REQUEST['id']));

		elseif($c->sql_quote($_REQUEST['action']) == 'SeriesUsuariosAreas')

			$ob->SeriesUsuariosAreas($c->sql_quote($_REQUEST['id']));

		elseif($c->sql_quote($_REQUEST['action']) == 'buscar')

			$ob->BuscarSeries($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['cn']), $c->sql_quote($_REQUEST['p1']));

		elseif($c->sql_quote($_REQUEST['action']) == 'buscarJsdependencia')

			$ob->buscarJsdependencia($c->sql_quote($_REQUEST['id']));
		elseif($c->sql_quote($_REQUEST['action']) == 'getfechavencimiento')

			$ob->GetDiasVencimiento($c->sql_quote($_REQUEST['id']));
		elseif($c->sql_quote($_REQUEST['action']) == 'optimizar')
			$ob->OptimizarDependencias($c->sql_quote($_REQUEST['id']));		
		elseif($c->sql_quote($_REQUEST['action']) == 'estadosdependencias')
			$ob->estadosdependencias($c->sql_quote($_REQUEST['id']));		
		else

		// SI NO ES NINGUNA DE LAS ANTERIORES ENTONCES CARGA POR DEFECTO LA VISTA DE LISTADO		

			$ob->VistaListar('');		

	

	// DEFINIENDO LA CLASE DEL CONTROLADOR DEL OBJETO QUE TIENE HERENCIA CON EL CONTROLADOR GENERICO PARA CARGAR LA INTERFAZ

	class CDependencias extends MainController{

		

		// DEFINIENDO LA FUNCION LISTAR 		

		function VistaListar($id){

			// CREANDO UN NUEVO MODELO			

			global $con;

			$id_dependencia = $id;

			echo "<div id='formupdatedep'>";

			include(VIEWS.DS."dependencias".DS."FormInsertDependencias.php");

			echo "</div>";

			#echo VIEWS.DS."seccional_principal".DS."Listar.php";

			$areas = new MDependencias;

			$areas->CreateDependencias("id", $id);

			// DE NO RECIBIR PARAMETROS ESTA FUNCION TRAE EL LISTADO COMPLETO DE LIBROS

			$query = $areas->ListarDependencias(" WHERE dependencia = '".$id_dependencia."'");	    

			echo '<div class="title right">Sub-Series Documentales de la serie "'.$areas->GetNombre().'"</div>	';

			include(VIEWS.DS."dependencias".DS."Listar.php");

		

		}

		// FUNCION QUE CARGA LA VISTA DE INSERTAR (FORMULARIO DE INSERTAR)

		function VistaInsertar(){

			//CARGA EL TEMPLATE

			$pagina = $this->load_template('Crear Dependencias');			

			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.

			ob_start();

			include_once(VIEWS.DS.'dependencias/FormInsertDependencias.php');				

			// OBTIENE EL CONTENIDO DEL BÚFER ACTUAL Y ELIMINA EL BÚFER DE SALIDA ACTUAL.						

			$path = ob_get_clean();	

			// ASIGNANDOLE A LA VARIABLE  EL CONTENIDO DEL BUFFER																																																															

			$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $path  , $pagina);

			// CARGAMOS LA PAGINA EN EL BROWSER	

			$this->view_page($pagina);		

		}

		// FUCNION QUE CARGA LA VISTA PARA EDITAR EL CONTENIDO DE UN REGISTRO

		function VistaEditar($x){

	 		// INVOCAMOS UN NUEVO OBJETO

	 		global $f;

	 		global $con;

	 		global $c;



		 	$object = new MDependencias;

			// LO CREAMOS 			

			$object->CreateDependencias('id', $x);

			// Y FINALMENTE CARGAMOS LA VISTA DE EDICION QUE MUESTRA EL CONTENIDO			

			include_once(VIEWS.DS.'dependencias/FormUpdateDependencias.php');		

	 	}	

	 	function Buscar($x, $cn = 'id'){

	 		// INVOCAMOS UN NUEVO OBJETO						

			$object = new MDependencias;

			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL						

			global $con;

			// CARGA EL TEMPLATE						

			$pagina = $this->load_template('Listado de Dependencias');			

			// OBTENEMOS EL LISTADO DE LIBROS DE ACUERDO A LOS PARAMETROS QUE LE ENVIAMOS						

			$query = $object->ListarDependencias('WHERE '.$cn.' = "'.$x.'"');	    

			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.

			ob_start();		

		   		if($con->NumRows($query) <= 0 || $query !=''){

					// SI LA CONSULTA NO SE EJECUTA ENTONCES RETORNA VACIO							

					include_once(VIEWS.DS.'dependencias/Listar.php');	   			

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

		function Insertar($nombre, $dependencia, $usuario, $fecha, $estado, $t_g, $t_c, $t_h, $obsevacion, $id_c, $inm, $no_s = "0", $id = "0", $id_serie = "N", $es_publico = "0", $titulo_publico = "", $dias_vencimiento = "0"){

			// DEFINIENDO EL OBJETO
			global $con;
			global $c;
			global $f;
			$object = new MDependencias;
			$query = $object->ListarDependencias(" WHERE dependencia = '".$dependencia."' ");

			if ($id_c == "" || $id_c == "0") {
				$id_c = $f->zerofill($con->NumRows($query)+1, 3);
			}
			// USANDO LA FUNCION DE INSERTAR DEL OBJETO PARA ENVIAR LA INFORMACION A LA BASE DE DATOA			
			$inm = ($inm == "on")?"1":"0";
			$es_publico = ($es_publico == "on")?"1":"0";
			$no_s = ($no_s == "on")?"1":"0";

			if ($id_serie == "N") {
				# code...
				$create = $object->InsertDependencias($nombre, $dependencia, $usuario, $fecha, $estado, $id_c, $t_g, $t_c, $t_h, $obsevacion, $inm, $no_s, $es_publico, $titulo_publico, $dias_vencimiento);
				$dependencia = $c->GetMaxIdTabla("dependencias", "id");

				if($no_s == "1") {
					$dependencia = $c->GetMaxIdTabla("dependencias", "id");
					$object->InsertDependencias($nombre, $dependencia, $usuario, $fecha, $estado, $id_c, $t_g, $t_c, $t_h, $obsevacion, $inm, $no_s, $es_publico, $titulo_publico, $dias_vencimiento);
					
					$ndependencia = $c->GetMaxIdTabla("dependencias", "id");
					$con->Query("update dependencias set dependencia_inversa = '".$ndependencia."' where id = '".$dependencia."'");
					
					#echo "update dependencias set dependencia_inversa = '".$ndependencia."' where id = '".$dependencia."";
					
					// DEFINIENDO EL OBJETO			
					$areasd = new MAreas_dependencias;
					// USANDO LA FUNCION DE INSERTAR DEL OBJETO PARA ENVIAR LA INFORMACION A LA BASE DE DATOA			
					$careasd = $areasd->InsertAreas_dependencias($id, $ndependencia, $_SESSION['usuario'], date("Y-m-d"), $dependencia, $obsevacion);
				}

			}else{

				$dependencia = $id_serie;
				$dep = new MDependencias();
				$dep->CreateDependencias("id", $dependencia);

				if ($dep->GetDependencia_inversa() == "0") {
					$no_s = "0";
				}else{
					$no_s = "1";

					// DEFINIENDO EL OBJETO			
					$areasd = new MAreas_dependencias;
					// USANDO LA FUNCION DE INSERTAR DEL OBJETO PARA ENVIAR LA INFORMACION A LA BASE DE DATOA			
					$careasd = $areasd->InsertAreas_dependencias($id, $dep->GetDependencia_inversa(), $_SESSION['usuario'], date("Y-m-d"), $dependencia, $dep->GetObservacion());
				}
			}

			$d = new MDependencias;
			$d->CreateDependencias("id", $dependencia);

				if ($no_s == "0") {
					echo "	<div id='e-li".$d->GetId()."' class='list-group-item'>";
					echo "		<span class='mdi mdi-sitemap btn btn-circle btn-warning pull-right  m-r-5' style='margin-top:-3px' onClick='AbrirAreaSerie(\"".$id."\",\"".$d->GetId()."\")'></span>";
					echo "		<span class='mdi mdi-pencil btn btn-info btn-circle pull-right m-r-5' style='margin-top:-3px'   onclick='EditarDependenciaPrincipal(\"".$d->GetId()."\")'></span>";
					echo "		".$d->GetNombre()." 
							</div>";				
				}else{
					//if ($crearsd == "1") {
						$id_a_d = $c->GetMaxIdTabla("areas_dependencias", "id");
						echo "	<div id='e-li".$id_a_d."' class='list-group-item'>";
						echo '		<span class="mdi mdi-delete btn btn-circle btn-danger pull-right  m-r-5" title="eliminar" onclick="EliminarAreas_dependencias(\''.$id_a_d.'\', \''.$id_a_d.'\')" style="margin-top:-3px;" '.$c->Ayuda('264', 'tog').'></span>';

						echo "		<span class='mdi mdi-settings btn btn-circle btn-success pull-right m-r-5' style='margin-top:-3px;' onClick='select_gestSubs(\"".$d->GetDependencia_inversa()."\")' ".$c->Ayuda('265', 'tog')."></span>";

						echo "		<span class='mdi mdi-pencil btn btn-info btn-circle pull-right m-r-5' style='float:right; margin-top:-3px;' onclick='EditarDependenciaPrincipal(\"".$d->GetId()."\")' ".$c->Ayuda('266', 'tog')."></span>";
						echo "		".$d->GetNombre()." 
								</div>";
				}
		}

		function Insertarss($nombre, $dependencia, $usuario, $fecha, $estado, $t_g, $t_c, $t_h, $obsevacion, $id_c, $inm, $no_s = "0", $id = "0", $es_publico = "0", $titulo_publico = "", $dias_vencimiento = "0"){

			// DEFINIENDO EL OBJETO
			global $con;
			global $c;
			global $f;
			$object = new MDependencias;
			$query = $object->ListarDependencias(" WHERE dependencia = '".$dependencia."' ");

			if ($id_c == "" || $id_c == "0") {
				$id_c = $f->zerofill($con->NumRows($query)+1, 3);
			}
			// USANDO LA FUNCION DE INSERTAR DEL OBJETO PARA ENVIAR LA INFORMACION A LA BASE DE DATOA			
			$inm = ($inm == "on")?"1":"0";
			$es_publico = ($es_publico == "on")?"1":"0";
			$no_s = "0";

			$create = $object->InsertDependencias($nombre, $dependencia, $usuario, $fecha, $estado, $id_c, $t_g, $t_c, $t_h, $obsevacion, $inm, $no_s, $es_publico, $titulo_publico, $dias_vencimiento);
			
			$ndependencia = $c->GetMaxIdTabla("dependencias", "id");				
			// DEFINIENDO EL OBJETO			
			$areasd = new MAreas_dependencias;
			// USANDO LA FUNCION DE INSERTAR DEL OBJETO PARA ENVIAR LA INFORMACION A LA BASE DE DATOA			
			$careasd = $areasd->InsertAreas_dependencias($id, $ndependencia, $_SESSION['usuario'], date("Y-m-d"), $dependencia, $obsevacion);

			
			$object = new MAreas_dependencias;
			$query = $object->ListarAreas_dependencias(" WHERE id_area = '".$id."' and id_dependencia_raiz = '".$dependencia."'");
			
			include(VIEWS.DS."areas_dependencias/ListarSubSeries.php");
			
			//SI NO SE ENVIO CORRECTAMENTE ENTONCES GENERA ERROR SINO ENVIA OK
/*			if ($dependencia == "0") {
				#echo VIEWS.DS."seccional_principal".DS."Listar.php";
				$areas = new MDependencias;
				// DE NO RECIBIR PARAMETROS ESTA FUNCION TRAE EL LISTADO COMPLETO DE LIBROS
				$query = $areas->ListarDependencias(" WHERE dependencia = '0' and id_version = '".$_SESSION['id_trd']."'");	    
				echo '<div class="title right">Listado de Series Documentales</div>	';
				include(VIEWS.DS."dependencias".DS."Listar.php");
			}*/
		}

		// FUNCION QUE RECIBE UNASERIE DE PARAMETROS Y LOS ENVIA A LA BASE DE DATOS PARA ACTUALIZAR UN REGISTRO (FUNCION ESPECIAL)		

		function Editar($constrain, $fields, $updates, $output, $dependencia = "0"){

			$object = new MDependencias;


			$create = $object->UpdateDependencias($constrain, $fields, $updates, $output);

			if ($dependencia == "0") {
				$object->CreateDependencias("id", $_REQUEST['id']);
				if ($object->GetDependencia_inversa() != "0") {
					//$constrain = 'WHERE id = '.$object->GetDependencia_inversa();
					//$create = $object->UpdateDependencias($constrain, $fields, $updates, $output);
				}
			}
			$constrain = 'WHERE dependencia_inversa = '.$_REQUEST['id'];
			$create = $object->UpdateDependencias($constrain, $fields, $updates, $output);

			//SI NO SE ENVIO CORRECTAMENTE ENTONCES GENERA ERROR SINO ENVIA OK

#			if($create != '1')

#				$this->VistaListar('ERROR AL REGISTRAR');

#			else

#				$this->VistaListar('OK!');

			if ($dependencia == "0") {

				echo '<script> window.location.href = "'.HOMEDIR.DS.'herramientas/#proce"</script>';

			}else{

				


				echo '<script> DependenciaDependencias("'.$dependencias.'")</script>';

					

			}

			

		}

		// FUCNION QUE RECIBE UN PARAMETRO Y ELIMINA EL REGISTRO DE LA BASE DE DATOS		

		function Eliminar($id){

				// DEFINIMOS EN UN VECTOR LOS CAMPOS QUE VAMOS A EDITAR

			$ar2 = array('estado');

			// DEFINIMOS EN OTRO VECTOR LOS NUEVOS DATOS QUE VAMOS A METER	

			$ar1 = array("0");	

			// DEFINIMOS LOS ESTADOS DE SALIDA

			$output = array('registro actualizado', 'no se pudo actualizar'); 

			// Y POR ULTIMO DEFINIMOS EL CONTRAIN PARA LA ACTUALIZACION	

			$constrain = 'WHERE id = '.$id;

			$object = new MDependencias;
			$object->CreateDependencias("id", $id);


			$this->Editar($constrain, $ar2, $ar1, $output, $object->GetId());

		}

		// FUCNION QUE RECIBE UN PARAMETRO Y ELIMINA EL REGISTRO DE LA BASE DE DATOS		

		function Activar($id){

				// DEFINIMOS EN UN VECTOR LOS CAMPOS QUE VAMOS A EDITAR

			$ar2 = array('estado');

			// DEFINIMOS EN OTRO VECTOR LOS NUEVOS DATOS QUE VAMOS A METER	

			$ar1 = array("1");	

			// DEFINIMOS LOS ESTADOS DE SALIDA

			$output = array('registro actualizado', 'no se pudo actualizar'); 

			// Y POR ULTIMO DEFINIMOS EL CONTRAIN PARA LA ACTUALIZACION	

			$constrain = 'WHERE id = '.$id;

			$object = new MDependencias;
			$object->CreateDependencias("id", $id);



			$this->Editar($constrain, $ar2, $ar1, $output, $object->GetId());

		}	

		function OptionDependencias($id){

			// DEFINIENDO EL OBJETO			

			global $con;

			$object = new MDependencias;

			$query = $object->ListarDependencias(" WHERE dependencia = '".$id."' ");

			while ($row = $con->FetchAssoc($query)) {

				echo "<option value='".$row['id']."'>".$row['nombre']."</option>";

			}

			

		}	

		function GetChildsDependencia($serie, $area){



			global $con;

			global $f;

			global $c;

			// CREANDO UN NUEVO MODELO	

			$_SESSION['area_principal'] = $area;

			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL			

			$pagina = $this->load_template(PROJECTNAME.ST." Sub Series");

			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.

			ob_start();				

			// SI LA CONSULTA SE EJECUTA ENTONCES CARGA EL LISTADO DE LIBROS DE LA VISTA

#			include_once(VIEWS.DS.'events/default.php');	   			



				$d = new MDependencias;
				$d->CreateDependencias("id", $serie);

				$a = new MAreas;
				$a->CreateAreas("id", $area);

			

			$l = new MAreas_dependencias;

			$qn = $l->ListarAreas_dependencias(" where id_area = '".$_SESSION['area_principal']."' and id_dependencia_raiz = '".$serie."' and id_version = '".$_SESSION['active_vista']."'");
			
			include_once(VIEWS.DS.'gestion/FiltroGestion.php');
			echo '	
<div class="panel panel-default block1 m-t-30">
    <div class="panel-wrapper collapse in">
        <div class="panel-body">


				<div class="row">
					<div class="col-md-12">
						<ol class="breadcrumb default">
						  	<li><a href="/gestion/getareas/'.$a->GetId().'/">AREA: '.$a->GetNombre().'</a></li>
						  	<li class="active">SERIE: '.$d->GetNombre().'</li>
						</ol>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">		
						<h3>Listado de subseries en "'.$d->GetNombre().'"</h3>';

						while ($ro2 = $con->FetchAssoc($qn)) {

							$s = new MDependencias;
							$s->CreateDependencias("id", $ro2['id_dependencia']);
							$nombre = $s->GetNombre();
							$enlace = "/dependencias/explorar/".$s->GetId()."/";
							$cantidad = $f->Zerofill($c->Getcounter_v2("gestion", "tipo_documento = '".$s->GetId()."'", $_REQUEST['id']), 3);
							echo $f->DoFolder($nombre, $enlace, $cantidad);	

						}
        echo '
        			</div>
        		</div>
		</div>
    </div>
</div>
';

						// OBTIENE EL CONTENIDO DEL BÚFER ACTUAL Y ELIMINA EL BÚFER DE SALIDA ACTUAL.			

			$table = ob_get_clean();	

			// SI NO TRAE NINGUNA VARIABLE ENTONCES GENERA UN ERROR

			// DE LO CONTRARIO ENTONCES CARGA EL CONTENIDO DE LA PAGINA																

			$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $table , $pagina);

			// RETORNAME LA PAGINA CARGADA		

			$this->view_page($pagina);





		}



		function Explorar($id){

			global $con;

			global $f;

			global $c;

			// CREANDO UN NUEVO MODELO	



			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL			

			$pagina = $this->load_template(PROJECTNAME.ST." Sub Series");

			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.

			ob_start();				

			// SI LA CONSULTA SE EJECUTA ENTONCES CARGA EL LISTADO DE LIBROS DE LA VISTA

#			include_once(VIEWS.DS.'events/default.php');	   			



			$dep = new MDependencias;

			$dep->CreateDependencias("id", $id);



			$draiz = new MDependencias;

			$draiz->CreateDependencias("id", $dep->GetDependencia());

			

			$g = new MGestion;

			

			$uaid = $con->Result($con->Query("select a_i from usuarios where user_id = '".$_SESSION['usuario']."'"), 0,'a_i');


			include_once(VIEWS.DS.'gestion/FiltroGestion.php');

			$qn = $g->ListarGestion(" where ciudad = '".$_SESSION['ciudad']."' and oficina = '".$_SESSION['seccional']."' and dependencia_destino = '".$_SESSION['area_principal']."' and id_dependencia_raiz = '".$draiz->GetId()."' and tipo_documento = '".$id."'  and estado_archivo = '".$_SESSION['typefolder']."' and nombre_destino = '".$uaid."' $pathfiltro and version = '".$_SESSION['active_vista']."' group by suscriptor_id", "order by nombre_radica asc", "");

			include_once(VIEWS.DS."dependencias/listadosuscriptores.php");



						// OBTIENE EL CONTENIDO DEL BÚFER ACTUAL Y ELIMINA EL BÚFER DE SALIDA ACTUAL.			

			$table = ob_get_clean();	

			// SI NO TRAE NINGUNA VARIABLE ENTONCES GENERA UN ERROR

			// DE LO CONTRARIO ENTONCES CARGA EL CONTENIDO DE LA PAGINA																

			$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $table , $pagina);

			// RETORNAME LA PAGINA CARGADA		

			$this->view_page($pagina);

		}


		function VerCreados(){

			global $con;
			global $c;
			global $f;
			// CREANDO UN NUEVO MODELO	
			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL			
			$pagina = $this->load_template(PROJECTNAME.ST." Sub Series");
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();				
			// SI LA CONSULTA SE EJECUTA ENTONCES CARGA EL LISTADO DE LIBROS DE LA VISTA
#			include_once(VIEWS.DS.'events/default.php');	   			
			$area = $_SESSION['area_principal'];
			$a = new MAreas;
			$a->CreateAreas("id", $area);
			include_once(VIEWS.DS.'gestion/FiltroGestion.php');

			$g = new MGestion;
			$qn = $con->Query("SELECT * FROM gestion where usuario_registra = '".$_SESSION['usuario']."' and estado_archivo = '".$_SESSION['typefolder']."' $pathfiltro ");

			$cant = $con->NumRows($qn);
			
echo '	
<div class="panel panel-default block1 m-t-30">
    <div class="panel-wrapper collapse in">
        <div class="panel-body">
			<div class="row">
				<div class="col-md-12">		
			
					<h3>Expedientes Creados por mi ('.$cant.')</h3>';

						$ar = array("0" => "Baja", "1" => "Media", "2" => "Alta");
						$i = 0;
						while ($ro2 = $con->FetchAssoc($qn)) {
							$i++;

							$c->GetVistaAmple($ro2["id"]);

						}
						if ($i <= 0) {
							echo '<div class="alert alert-info">No tienes expedientes Creados</div>';
						}
echo '
				</div>
			</div>					
		</div>
	</div>
</div>';

						// OBTIENE EL CONTENIDO DEL BÚFER ACTUAL Y ELIMINA EL BÚFER DE SALIDA ACTUAL.			
			$table = ob_get_clean();	
			// SI NO TRAE NINGUNA VARIABLE ENTONCES GENERA UN ERROR
			// DE L CONTRARIO ENTONCES CARGA EL CONTENIDO DE LA PAGINA															
			$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $table , $pagina);
			// RETORNAME LA PAGINA CARGADA		
			$this->view_page($pagina);
		}


		function VerRadicaciones($id, $ids){

			global $con;
			global $c;
			global $f;
			// CREANDO UN NUEVO MODELO	
			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL			
			$pagina = $this->load_template(PROJECTNAME.ST." Sub Series");
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();				
			// SI LA CONSULTA SE EJECUTA ENTONCES CARGA EL LISTADO DE LIBROS DE LA VISTA
#			include_once(VIEWS.DS.'events/default.php');	   			
			$area = $_SESSION['area_principal'];
			$a = new MAreas;
			$a->CreateAreas("id", $area);
			$dep = new MDependencias;
			$dep->CreateDependencias("id", $id);
			$draiz = new MDependencias;
			$draiz->CreateDependencias("id", $dep->GetDependencia());
			$csusc = new MSuscriptores_contactos;
			$csusc->CreateSuscriptores_contactos("id", $ids);
			$uaid = $con->Result($con->Query("select a_i from usuarios where user_id = '".$_SESSION['usuario']."'"), 0,'a_i');
			include_once(VIEWS.DS.'gestion/FiltroGestion.php');

			$g = new MGestion;
			$qn = $g->ListarGestion(" where ciudad = '".$_SESSION['ciudad']."' and oficina = '".$_SESSION['seccional']."' and dependencia_destino = '".$_SESSION['area_principal']."' and id_dependencia_raiz = '".$draiz->GetId()."' and tipo_documento = '".$id."' and suscriptor_id = '".$ids."' and version = '".$_SESSION['active_vista']."' and estado_archivo = '".$_SESSION['typefolder']."' and nombre_destino = '".$uaid."' $pathfiltro ");
		/*
				CIUDAD  = CIUDAD
				OFICINA = OFICINA
				AREA PRINCIPAL = DEPENDENCIA_DESTINO
				SERIE = ID_DEPENDENCIA_RAIZ
				SUBSERIE = TIPO_DOCUMENTO				
				SUSCRIPTOR = SUSCRIPTOR_ID				
	*/
echo '	
<div class="panel panel-default block1 m-t-30">
    <div class="panel-wrapper collapse in">
        <div class="panel-body">

			<div class="row">
				<div class="col-md-12">
					<ol class="breadcrumb default">
					  	<li><a href="/gestion/getareas/'.$a->GetId().'/">AREA: '.$a->GetNombre().'</a></li>
					  	<li><a href="/dependencias/childs/'.$draiz->GetId().'/'.$a->GetId().'/">SERIE: '.$draiz->GetNombre().'</a></li>
						<li><a href="'.HOMEDIR.'/dependencias/explorar/'.$dep->GetId().'/">SUBSERIE: '.$dep->GetNombre().'</a></li>
						<li class="active">'.$csusc->GetNombre().'</li>
					</ol>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">		
					<h3>Listado de Expedientes Registrados</h3>';

						$ar = array("0" => "Baja", "1" => "Media", "2" => "Alta");
						while ($ro2 = $con->FetchAssoc($qn)) {

							$c->GetVistaAmple($ro2["id"]);

						}
echo '
				</div>
			</div>
		</div>
	</div>					
</div>';

						// OBTIENE EL CONTENIDO DEL BÚFER ACTUAL Y ELIMINA EL BÚFER DE SALIDA ACTUAL.			
			$table = ob_get_clean();	
			// SI NO TRAE NINGUNA VARIABLE ENTONCES GENERA UN ERROR
			// DE L CONTRARIO ENTONCES CARGA EL CONTENIDO DE LA PAGINA															
			$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $table , $pagina);
			// RETORNAME LA PAGINA CARGADA		
			$this->view_page($pagina);
		}

		function GetNoChildsDependencia($id_area){



			global $con;

			global $f;

			global $c;

			// CREANDO UN NUEVO MODELO	

			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL			

			$pagina = $this->load_template(PROJECTNAME.ST." Sub Series");

			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.

			ob_start();				

			// SI LA CONSULTA SE EJECUTA ENTONCES CARGA EL LISTADO DE LIBROS DE LA VISTA

#			include_once(VIEWS.DS.'events/default.php');	   			



			$d = new MDependencias;

			$d->CreateDependencias("id", $id_area);

		

			$l = new MAreas_dependencias;



			$qn = $con->Query("Select tipo_documento

									from gestion

										WHERE 	dependencia_destino != '".$_SESSION['area_principal']."' 

												and usuario_registra = '".$_SESSION['usuario']."' 

												and oficina = '".$_SESSION['seccional']."' 

												and id_dependencia_raiz = '".$d->GetId()."' 

													group by tipo_documento");	







			echo '	

					<div id="tools-content">

						<div class="opc-folder blue">

							<ol class="breadcrumb">

							  <a href="/proceso/1/"><li class="breadcrumb-item fa fa-archive"></li></a>

							  <li></li>

							  <li class="breadcrumb-item active">'.$d->GetNombre().'</li>

							</ol>

						</div>

					</div>



					<div id="folders-content">

						<div id="folders-list-content">

						<div class="title">Listado de Sub Series</div><br>';

			while ($ro2 = $con->FetchAssoc($qn)) {

				$s = new MDependencias;

				$s->CreateDependencias("id", $ro2['tipo_documento']);



				$nombre = $s->GetNombre();

				$enlace = "/dependencias/NoExplorar/".$s->GetId()."/";

				$cantidad = $f->Zerofill($c->GetNocounter("gestion", "tipo_documento = '".$s->GetId()."'"), 3);

				echo $f->DoFolder($nombre, $enlace, $cantidad);

		

			}

			echo '		</div>

					</div>';



						// OBTIENE EL CONTENIDO DEL BÚFER ACTUAL Y ELIMINA EL BÚFER DE SALIDA ACTUAL.			

			$table = ob_get_clean();	

			// SI NO TRAE NINGUNA VARIABLE ENTONCES GENERA UN ERROR

			// DE LO CONTRARIO ENTONCES CARGA EL CONTENIDO DE LA PAGINA																

			$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $table , $pagina);

			// RETORNAME LA PAGINA CARGADA		

			$this->view_page($pagina);

		}





		function NoExplorar($id){

			global $con;

			global $f;

			global $c;

			// CREANDO UN NUEVO MODELO	



			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL			

			$pagina = $this->load_template(PROJECTNAME.ST." Sub Series");

			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.

			ob_start();				

			// SI LA CONSULTA SE EJECUTA ENTONCES CARGA EL LISTADO DE LIBROS DE LA VISTA

#			include_once(VIEWS.DS.'events/default.php');	   			



			$dep = new MDependencias;

			$dep->CreateDependencias("id", $id);



			$draiz = new MDependencias;

			$draiz->CreateDependencias("id", $dep->GetDependencia());

			

			$g = new MGestion;

			

#			$qn = $g->ListarGestion(" where ciudad = '".$_SESSION['ciudad']."' and oficina = '".$_SESSION['seccional']."' and dependencia_destino = '".$_SESSION['area_principal']."' and id_dependencia_raiz = '".$draiz->GetId()."' and tipo_documento = '".$id."'  and estado_archivo = '".$_SESSION['typefolder']."' and (nombre_destino = '".$uaid."' or usuario_registra = '".$_SESSION['usuario']."') group by suscriptor_id");

			

			$qn = $con->Query("Select suscriptor_id

									from gestion

										WHERE 	dependencia_destino != '".$_SESSION['area_principal']."' 

												and usuario_registra = '".$_SESSION['usuario']."' 

												and oficina = '".$_SESSION['seccional']."' 

												and tipo_documento = '".$dep->GetId()."' 

													group by suscriptor_id");	



		/*

				CIUDAD  = CIUDAD

				OFICINA = OFICINA

				AREA PRINCIPAL = DEPENDENCIA_DESTINO

				SERIE = ID_DEPENDENCIA_RAIZ

				SUBSERIE = TIPO_DOCUMENTO				

		*/

			include_once(VIEWS.DS."dependencias/listadosuscriptores2.php");



						// OBTIENE EL CONTENIDO DEL BÚFER ACTUAL Y ELIMINA EL BÚFER DE SALIDA ACTUAL.			

			$table = ob_get_clean();	

			// SI NO TRAE NINGUNA VARIABLE ENTONCES GENERA UN ERROR

			// DE LO CONTRARIO ENTONCES CARGA EL CONTENIDO DE LA PAGINA																

			$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $table , $pagina);

			// RETORNAME LA PAGINA CARGADA		

			$this->view_page($pagina);

		}



		function VerRadicaciones2($id, $ids){

			global $con;

			global $f;

			// CREANDO UN NUEVO MODELO	



			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL			

			$pagina = $this->load_template(PROJECTNAME.ST." Sub Series");

			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.

			ob_start();				

			// SI LA CONSULTA SE EJECUTA ENTONCES CARGA EL LISTADO DE LIBROS DE LA VISTA

#			include_once(VIEWS.DS.'events/default.php');	   			



			$dep = new MDependencias;

			$dep->CreateDependencias("id", $id);



			$draiz = new MDependencias;

			$draiz->CreateDependencias("id", $dep->GetDependencia());



			$csusc = new MSuscriptores_contactos;

			$csusc->CreateSuscriptores_contactos("id", $ids);

			

			$uaid = $con->Result($con->Query("select a_i from usuarios where user_id = '".$_SESSION['usuario']."'"), 0,'a_i');

	

			$g = new MGestion;



			$qn = $con->Query("Select id

									from gestion

										WHERE 	dependencia_destino != '".$_SESSION['area_principal']."' 

												and usuario_registra = '".$_SESSION['usuario']."' 

												and oficina = '".$_SESSION['seccional']."' 

												and id_dependencia_raiz = '".$draiz->GetId()."' 

												and tipo_documento = '".$id."' 

												and suscriptor_id = '".$ids."' 

												and estado_archivo = '".$_SESSION['typefolder']."'");	

			echo '	

					<div id="tools-content">

						<div class="opc-folder blue">

							<ol class="breadcrumb">

								<a href="/proceso/1/"><li class="breadcrumb-item fa fa-archive"></li></a>

								<li></li>

								<li class="breadcrumb-item"><a href="/dependencias/childs/'.$draiz->GetId().'/">'.$draiz->GetNombre().'</a></li>

								<li class="breadcrumb-item"><a href="'.HOMEDIR.'/dependencias/explorar/'.$dep->GetId().'/">'.$dep->GetNombre().'</a></li>

								<li class="breadcrumb-item active">'.$csusc->GetNombre().'</li>

							</ol>

						</div>

					</div>

					<div id="folders-content" style="background-color: #f0f0f0">

						<div id="folders-list-content" style="margin-top:0px; background-color: #f0f0f0" class="scrollable">

							<div class="title right">Listado de Radicaciones Registradas</div>

							<div class="table">';

			global $c;

			$ar = array("0" => "Baja", "1" => "Media", "2" => "Alta");



			while ($ro2 = $con->FetchAssoc($qn)) {

				

				$c->GetVistaExpedienteDefault($ro2["id"]);



			}

			echo '					

							</div>

						</div>

					</div>';



						// OBTIENE EL CONTENIDO DEL BÚFER ACTUAL Y ELIMINA EL BÚFER DE SALIDA ACTUAL.			

			$table = ob_get_clean();	

			// SI NO TRAE NINGUNA VARIABLE ENTONCES GENERA UN ERROR

			// DE LO CONTRARIO ENTONCES CARGA EL CONTENIDO DE LA PAGINA																

			$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $table , $pagina);

			// RETORNAME LA PAGINA CARGADA		

			$this->view_page($pagina);

		}

		function Configurar($id){
	    	//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL			
			global $con;
			global $f;
			global $c;
			//CARGANDO LA PAGINA DE INTERFAZ			
			$dep = new MDependencias;
			$dep->CreateDependencias("id", $id);
	    	#$query = $object->ListarSuscriptores_modulos();
			$pagina = $this->TemplateAmplelimpia('Configurar Dependencia');			
			// CARGANDO LLAMANDO LA FUNCION LSITAR LIBROS DEL MODELO (FUNCION QUE TRAE DE LA BASE DE DATOS EL LISTADO DE LIBROS
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();
			// SI LA CONSULTA NO SE EJECUTA ENTONCES RETORNA VACIO
			// SI LA CONSULTA SE EJECUTA ENTONCES CARGA EL LISTADO DE LIBROS DE LA VISTA
	    	include(VIEWS.DS."dependencias/DepDependencias.php");
			// OBTIENE EL CONTENIDO DEL BÚFER ACTUAL Y ELIMINA EL BÚFER DE SALIDA ACTUAL.			
			$table = ob_get_clean();	
			// SI NO TRAE NINGUNA VARIABLE ENTONCES GENERA UN ERROR
			if($message != '')
			$pagina = $this->replace_content('/\#ERROR_MESSAGE\#/ms', $message , $pagina);
			// DE LO CONTRARIO ENTONCES CARGA EL CONTENIDO DE LA PAGINA																
			$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $table , $pagina);
			// RETORNAME LA PAGINA CARGADA		
			$this->view_page($pagina);
		}
		function views_minutas($id){
			global $con; 
			$pagina = $this->TemplateAmplelimpia('Listar Plantilla');			
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();
			$dep = new MDependencias;
			$dep->CreateDependencias("id", $id);
			// SI LA CONSULTA SE EJECUTA ENTONCES CARGA EL LISTADO DE LIBROS DE LA VISTA
			#include_once(VIEWS.DS.'herramientas/Listar.php');	
			#include(VIEWS.DS."dependencias/DepDependencias.php");
			include_once(VIEWS.DS.'plantilla_dependencia/FormInsertPlantilla_dependencia.php');
			// OBTIENE EL CONTENIDO DEL BÚFER ACTUAL Y ELIMINA EL BÚFER DE SALIDA ACTUAL.			
			$table = ob_get_clean();	
			// DE LO CONTRARIO ENTONCES CARGA EL CONTENIDO DE LA PAGINA														
			$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $table , $pagina);
			// RETORNAME LA PAGINA CARGADA		
			$this->view_page($pagina);
		}



		function views_formularios($id){



			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL			

			global $con;



			$object = new MRef_tables;



			$dep = new MDependencias;

			$dep->CreateDependencias("id", $id);

			

			// DE NO RECIBIR PARAMETROS ESTA FUNCION TRAE EL LISTADO COMPLETO DE LIBROS

			$query = $object->ListarRef_tables(" WHERE dependencia_id = '".$id."'");	    

			// SI LA CONSULTA SE EJECUTA ENTONCES CARGA EL LISTADO DE LIBROS DE LA VISTA

			include_once(VIEWS.DS.'ref_tables/Listar.php');

		}



		function views_tipologias($id){

						//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL			

			global $con;



			$object = new MDependencias_tipologias;



			$dep = new MDependencias;

			$dep->CreateDependencias("id", $id);

			

			// DE NO RECIBIR PARAMETROS ESTA FUNCION TRAE EL LISTADO COMPLETO DE LIBROS

			$query = $object->ListarDependencias_tipologias(" WHERE id_dependencia = '".$id."' and estado = '1'", "order by orden");	    

			// SI LA CONSULTA SE EJECUTA ENTONCES CARGA EL LISTADO DE LIBROS DE LA VISTA

			include_once(VIEWS.DS.'dependencias_tipologias/Listar.php');

		}

		function views_estados($id){
			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL			
			global $con;
			global $c;
			global $f;

			$dep = new MDependencias;
			$dep->CreateDependencias("id", $id);
			
			echo "<div id='insertdependenciafirst'>";
			echo '<div class="da-message success">En este panel puede configurar Estados Personalizados relacionadas con cada Sub-Serie</div>';
			include(VIEWS.DS."estados_gestion".DS."FormInsertEstados_gestion.php");
			echo "</div>
				<div id='listadodependencias'>";
			#echo VIEWS.DS."seccional_principal".DS."Listar.php";
			$areas = new MEstados_gestion;
			// DE NO RECIBIR PARAMETROS ESTA FUNCION TRAE EL LISTADO COMPLETO DE LIBROS
			$query = $areas->ListarEstados_gestion("WHERE dependencia = '$id'");	    
			echo '<div class="title right">Listado de Origen de los Expedientes</div>	';
			include(VIEWS.DS."estados_gestion".DS."Listar.php");
			echo "</div>";

		}

		function views_alertas_subs($id){

						//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL			

			global $con;



			$object = new MDependencias_alertas;



			$dep = new MDependencias;

			$dep->CreateDependencias("id", $id);

			

			// DE NO RECIBIR PARAMETROS ESTA FUNCION TRAE EL LISTADO COMPLETO DE LIBROS

			$query = $object->ListarDependencias_alertas(" WHERE id_dependencia = '".$id."'");	    

			// SI LA CONSULTA SE EJECUTA ENTONCES CARGA EL LISTADO DE LIBROS DE LA VISTA

			include_once(VIEWS.DS.'dependencias_alertas/Listar.php');

		}

		function views_doc_obligatorios($id){

						//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL			

			global $con;



			$object = new MDependencias_documentos;



			$dep = new MDependencias;

			$dep->CreateDependencias("id", $id);

			

			// DE NO RECIBIR PARAMETROS ESTA FUNCION TRAE EL LISTADO COMPLETO DE LIBROS

			$query = $object->ListarDependencias_documentos(" WHERE id_dependencia = '".$id."'");	    

			// SI LA CONSULTA SE EJECUTA ENTONCES CARGA EL LISTADO DE LIBROS DE LA VISTA

			include_once(VIEWS.DS.'dependencias_documentos/Listar.php');

		}

		function views_permisos_doc($id){

									//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL			

			global $con;



			$object = new MPlantilla_dependencia;



			$dep = new MDependencias;

			$dep->CreateDependencias("id", $id);

			

			// DE NO RECIBIR PARAMETROS ESTA FUNCION TRAE EL LISTADO COMPLETO DE LIBROS

			$query = $object->ListarPlantilla_dependencia(" WHERE dependencia_id = '".$id."'");	    

			// SI LA CONSULTA SE EJECUTA ENTONCES CARGA EL LISTADO DE LIBROS DE LA VISTA

			include_once(VIEWS.DS.'plantilla_dependencia/Listar.php');

		}



		function GetProcedimiento($id){

			global $con;



			$dep = new MDependencias;

			$dep->CreateDependencias("id", $id);

			

			echo $dep->GetObservacion();

		}



		function GetTRD($id){

			global $con;

			global $c;

			global $f;

			// CARGA EL TEMPLATE			
	 		$pagina = $this->load_template_limpiaAmple('Tabla de Retencion Documental');			
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();	


			$areap = new MAreas;
			$areap->CreateAreas("id", $id);
			// CREANDO UN NUEVO MODELO			
			$object = new MAreas_dependencias;
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			// DE NO RECIBIR PARAMETROS ESTA FUNCION TRAE EL LISTADO COMPLETO DE LIBROS
			#$query = $object->ListarAreas_dependencias(" WHERE id_area = '".$id."' group by id_dependencia_raiz");	    
			$query = $con->Query("SELECT areas_dependencias.id AS idad, dependencias.nombre, areas_dependencias.id_dependencia_raiz FROM areas_dependencias INNER JOIN dependencias ON dependencias.id = areas_dependencias.id_dependencia_raiz WHERE id_area =  '".$id."' GROUP BY id_dependencia_raiz ORDER BY nombre ASC ");	    
			include_once(VIEWS.DS.'dependencias/trd.php');


			$table = ob_get_clean();	
			// ASIGNANDOLE A LA VARIABLE  EL CONTENIDO DEL BUFFER															
			$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $table  , $pagina);
			// CARGAMOS LA PAGINA EN EL BROWSER		
			$this->view_page($pagina);

		}


		function GetTVD($id){

			global $con;

			global $c;

			global $f;

			// CARGA EL TEMPLATE			
	 		$pagina = $this->load_template_limpiaAmple('Tabla de Retencion Documental');			
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();	


			$areap = new MAreas;
			$areap->CreateAreas("id", $id);
			// CREANDO UN NUEVO MODELO			
			$object = new MAreas_dependencias;
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			// DE NO RECIBIR PARAMETROS ESTA FUNCION TRAE EL LISTADO COMPLETO DE LIBROS
			#$query = $object->ListarAreas_dependencias(" WHERE id_area = '".$id."' group by id_dependencia_raiz");	    
			$query = $con->Query("SELECT areas_dependencias.id AS idad, dependencias.nombre, areas_dependencias.id_dependencia_raiz FROM areas_dependencias INNER JOIN dependencias ON dependencias.id = areas_dependencias.id_dependencia_raiz WHERE id_area =  '".$id."' GROUP BY id_dependencia_raiz ORDER BY nombre ASC ");	    
			include_once(VIEWS.DS.'dependencias/tvdx.php');


			$table = ob_get_clean();	
			// ASIGNANDOLE A LA VARIABLE  EL CONTENIDO DEL BUFFER															
			$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $table  , $pagina);
			// CARGAMOS LA PAGINA EN EL BROWSER		
			$this->view_page($pagina);

		}


		function GetTRDS(){

			global $con;

			global $c;

			global $f;

			// CARGA EL TEMPLATE			
	 		$pagina = $this->load_template_limpiaAmple('Tabla de Retencion Documental');			
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();	


			// CREANDO UN NUEVO MODELO			
			$object = new MAreas_dependencias;
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			// DE NO RECIBIR PARAMETROS ESTA FUNCION TRAE EL LISTADO COMPLETO DE LIBROS
			#$query = $object->ListarAreas_dependencias(" WHERE id_area = '".$id."' group by id_dependencia_raiz");	    
			$query = $con->Query("SELECT areas_dependencias.id AS idad, dependencias.nombre, areas_dependencias.id_dependencia_raiz FROM areas_dependencias INNER JOIN dependencias ON dependencias.id = areas_dependencias.id_dependencia_raiz WHERE id_area =  '".$id."' GROUP BY id_dependencia_raiz ORDER BY nombre ASC ");	    
			include_once(VIEWS.DS.'dependencias/trds.php');


			$table = ob_get_clean();	
			// ASIGNANDOLE A LA VARIABLE  EL CONTENIDO DEL BUFFER															
			$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $table  , $pagina);
			// CARGAMOS LA PAGINA EN EL BROWSER		
			$this->view_page($pagina);
		}

		function GetTVDS(){

			global $con;

			global $c;

			global $f;

			// CARGA EL TEMPLATE			
	 		$pagina = $this->load_template_limpiaAmple('Tabla de Retencion Documental');			
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();	


			// CREANDO UN NUEVO MODELO			
			$object = new MAreas_dependencias;
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			// DE NO RECIBIR PARAMETROS ESTA FUNCION TRAE EL LISTADO COMPLETO DE LIBROS
			#$query = $object->ListarAreas_dependencias(" WHERE id_area = '".$id."' group by id_dependencia_raiz");	    
			$query = $con->Query("SELECT areas_dependencias.id AS idad, dependencias.nombre, areas_dependencias.id_dependencia_raiz FROM areas_dependencias INNER JOIN dependencias ON dependencias.id = areas_dependencias.id_dependencia_raiz WHERE id_area =  '".$id."' GROUP BY id_dependencia_raiz ORDER BY nombre ASC ");	    
			include_once(VIEWS.DS.'dependencias/tvds.php');


			$table = ob_get_clean();	
			// ASIGNANDOLE A LA VARIABLE  EL CONTENIDO DEL BUFFER															
			$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $table  , $pagina);
			// CARGAMOS LA PAGINA EN EL BROWSER		
			$this->view_page($pagina);
		}

		function GetCCDS(){

			global $con;

			global $c;

			global $f;

			// CREANDO UN NUEVO MODELO			
			$object = new MAreas_dependencias;
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			// DE NO RECIBIR PARAMETROS ESTA FUNCION TRAE EL LISTADO COMPLETO DE LIBROS
			#$query = $object->ListarAreas_dependencias(" WHERE id_area = '".$id."' group by id_dependencia_raiz");	    
			$sx = "1";
			$query = $con->Query("SELECT areas_dependencias.id AS idad, dependencias.nombre, areas_dependencias.id_dependencia_raiz FROM areas_dependencias INNER JOIN dependencias ON dependencias.id = areas_dependencias.id_dependencia_raiz WHERE id_area =  '".$id."' GROUP BY id_dependencia_raiz ORDER BY nombre ASC ");	    
			include_once(VIEWS.DS.'dependencias/ccds.php');
		}

		function GetCCD($id){

			global $con;

			global $c;

			global $f;

			// CREANDO UN NUEVO MODELO			
			$object = new MAreas_dependencias;
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			// DE NO RECIBIR PARAMETROS ESTA FUNCION TRAE EL LISTADO COMPLETO DE LIBROS
			#$query = $object->ListarAreas_dependencias(" WHERE id_area = '".$id."' group by id_dependencia_raiz");	    
			$query = $con->Query("SELECT areas_dependencias.id AS idad, dependencias.nombre, areas_dependencias.id_dependencia_raiz FROM areas_dependencias INNER JOIN dependencias ON dependencias.id = areas_dependencias.id_dependencia_raiz WHERE id_area =  '".$id."' GROUP BY id_dependencia_raiz ORDER BY nombre ASC ");	    
			 $sx = "0";
			include_once(VIEWS.DS.'dependencias/ccd.php');
		}



		function GetTRD_E($id,$id_gestion){

			global $con;

			global $c;

			global $f;



			$MGestion = new MGestion;

			$MGestion->CreateGestion("id", $id_gestion);



			$areap = new MAreas;

			$areap->CreateAreas("id", $id);

			// CREANDO UN NUEVO MODELO			

			$object = new MAreas_dependencias;

			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.



			// DE NO RECIBIR PARAMETROS ESTA FUNCION TRAE EL LISTADO COMPLETO DE LIBROS

			#$query = $object->ListarAreas_dependencias(" WHERE id_area = '".$id."' group by id_dependencia_raiz");	    

			$querywww = $con->Query("SELECT dependencias.id_version FROM areas_dependencias INNER JOIN dependencias ON dependencias.id = areas_dependencias.id_dependencia_raiz WHERE id_area =  '".$id."' GROUP BY dependencias.id_version ");

			while($row = $con->FetchAssoc($querywww)){

				$id_version = $row['id_version'];

			}

			$MDependencias_version = new MDependencias_version;

			$MDependencias_version->CreateDependencias_version("id", $id_version);



			$query = $con->Query("SELECT areas_dependencias.id AS idad, dependencias.nombre, areas_dependencias.id_dependencia_raiz FROM areas_dependencias INNER JOIN dependencias ON dependencias.id = areas_dependencias.id_dependencia_raiz WHERE id_area =  '".$id."' and dependencias.id_version = '$id_version' GROUP BY id_dependencia_raiz ORDER BY nombre ASC ");



			include_once(VIEWS.DS.'dependencias/trd_e.php');

		}



		function GetNuevaDependencia(){

			global $con;

			echo $con->Result($con->Query("select max(id) as id from dependencias"), 0, 'id');

		}



		function UsuariosAreas($id){

			global $con;

			//CARGANDO LA PAGINA DE INTERFAZ			

			$pagina = $this->load_template('Listar Carpetas');			

			ob_start();



			include_once(VIEWS.DS.'folder/ListarAreasUsuariosCentral.php');



			$table = ob_get_clean();	

			// DE LO CONTRARIO ENTONCES CARGA EL CONTENIDO DE LA PAGINA																

			$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $table , $pagina);

			// RETORNAME LA PAGINA CARGADA		

			$this->view_page($pagina);



		}



		function SeriesUsuariosAreas($id){

			global $con;

			$vars = explode(".", $id);



			$id_u = $vars[0];

			$id_a = $vars[1];



			//CARGANDO LA PAGINA DE INTERFAZ			

			$pagina = $this->load_template('Listar Carpetas');			

			ob_start();



			include_once(VIEWS.DS.'folder/ListarAreasUsuariosSeriesCentral.php');



			$table = ob_get_clean();	

			// DE LO CONTRARIO ENTONCES CARGA EL CONTENIDO DE LA PAGINA																

			$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $table , $pagina);

			// RETORNAME LA PAGINA CARGADA		

			$this->view_page($pagina);



		}

		function metadatos($id){

			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL			
			global $con;
			//CARGANDO LA PAGINA DE INTERFAZ			

			$object = new MDependencias;
			$object->CreateDependencias("id", $id);
	    	#$query = $object->ListarSuscriptores_modulos();

			$pagina = $this->load_template_limpia('Administracion de Metadatos');			
			// CARGANDO LLAMANDO LA FUNCION LSITAR LIBROS DEL MODELO (FUNCION QUE TRAE DE LA BASE DE DATOS EL LISTADO DE LIBROS
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();
			// SI LA CONSULTA NO SE EJECUTA ENTONCES RETORNA VACIO
			// SI LA CONSULTA SE EJECUTA ENTONCES CARGA EL LISTADO DE LIBROS DE LA VISTA

	    	include(VIEWS.DS."metadatos/index3.php");	   			
			// OBTIENE EL CONTENIDO DEL BÚFER ACTUAL Y ELIMINA EL BÚFER DE SALIDA ACTUAL.			
			$table = ob_get_clean();	
			// SI NO TRAE NINGUNA VARIABLE ENTONCES GENERA UN ERROR
			if($message != '')
			$pagina = $this->replace_content('/\#ERROR_MESSAGE\#/ms', $message , $pagina);
			// DE LO CONTRARIO ENTONCES CARGA EL CONTENIDO DE LA PAGINA																
			$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $table , $pagina);
			// RETORNAME LA PAGINA CARGADA		
			$this->view_page($pagina);
		
		}

		function BuscarSeries($x, $dependencia = "0", $area = ""){

			global $con;

			$object = new MDependencias;

			if ($dependencia != "0") {
				$xq = $con->Query("select id_dependencia from areas_dependencias WHERE id_area = '".$area."' and id_dependencia_raiz = '".$dependencia."'");
				$nxq = $con->NumRows($xq);
				if ($nxq == "0") {
					$path = "where nombre like '%".$x."%' and dependencia = '".$dependencia."'";
				}else{
					$path = "where nombre like '%".$x."%' and dependencia = '".$dependencia."' and id  in( select id_dependencia from areas_dependencias WHERE id_area = '".$area."' and id_dependencia_raiz = '".$dependencia."')";
					
				}
			}else{
				$path = "where nombre like '%".$x."%' and dependencia = '".$dependencia."' and id_version = '".$_SESSION['id_trd']."'";
			}

			$query = $object->ListarDependencias($path);
		
			while ($row = $con->FetchArray($query)) {

				if ($dependencia != "0") {
					echo "<a href='#' class='list-group-item' onClick='AddSubSerieToList(\"".$row['id']."\", \"".$row['nombre']."\", \"formsubdependencias\")'>".$row['nombre']."</a>";
					# code...
				}else{
					echo "<a href='#' class='list-group-item' onClick='AddSerieToList(\"".$row['id']."\", \"".$row['nombre']."\", \"formdependencias\")'>".$row['nombre']."</a>";
				}
				# code...
			}


		}

		function buscarJsdependencia($id){
			global $con;

			$object = new MDependencias;
			$object->CreateDependencias("id", $id);

			$arr = array(	"id_c" => $object->GetId_c(), 
							"subserie_id" => $object->GetId(), 
							"t_g" => $object->GetT_g(), 
							"t_c" => $object->GetT_c(), 
							"t_h" => $object->GetT_h(), 
							"is_inm" => $object->GetEs_inmaterial(),
							"observacion" => $object->GetObservacion()
						);

 		 	echo json_encode($arr);

		}

		function GetDiasVencimiento($id){
			global $con;

			$object = new MDependencias;
			$object->CreateDependencias("id", $id);

			$fecha = date("Y-m-d");

			$fecha_c = date_create($fecha);//aca le pasas la fecha actual o ala que le queres sumar los dias.
			date_modify($fecha_c, $object->GetDias_vencimiento()." day");//sumas los dias que te hacen falta.
			$fecha_a = date_format($fecha_c, "Y-m-d");//retornas la fecha en el formato que mas te guste.

			if ($fecha_a == date("Y-m-d")) {
				echo "";
			}else{
 		 		echo $fecha_a;
				
			}

		}

		function OptimizarDependencias($id = "0"){
	    	//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL			
			global $con;
			global $f;
			global $c;
			//CARGANDO LA PAGINA DE INTERFAZ			

			$dep = new MDependencias;
			$dep->CreateDependencias("id", $id);
	    	#$query = $object->ListarSuscriptores_modulos();

			$pagina = $this->load_template_limpia('Optimizar Series y Subseries Documentales');			
			// CARGANDO LLAMANDO LA FUNCION LSITAR LIBROS DEL MODELO (FUNCION QUE TRAE DE LA BASE DE DATOS EL LISTADO DE LIBROS
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();
			// SI LA CONSULTA NO SE EJECUTA ENTONCES RETORNA VACIO
			// SI LA CONSULTA SE EJECUTA ENTONCES CARGA EL LISTADO DE LIBROS DE LA VISTA
	    	include(VIEWS.DS."dependencias/optimizar.php");
			// OBTIENE EL CONTENIDO DEL BÚFER ACTUAL Y ELIMINA EL BÚFER DE SALIDA ACTUAL.			
			$table = ob_get_clean();	
			// SI NO TRAE NINGUNA VARIABLE ENTONCES GENERA UN ERROR
			if($message != '')
			$pagina = $this->replace_content('/\#ERROR_MESSAGE\#/ms', $message , $pagina);
			// DE LO CONTRARIO ENTONCES CARGA EL CONTENIDO DE LA PAGINA																
			$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $table , $pagina);
			// RETORNAME LA PAGINA CARGADA		
			$this->view_page($pagina);			
		}
		function estadosdependencias($id){
			global $con;
			global $f;
			global $c;
	        
	        $estados_gestion = new MEstados_gestion;
            // DE NO RECIBIR PARAMETROS ESTA FUNCION TRAE EL LISTADO COMPLETO DE LIBROS
            $query_eg = $estados_gestion->ListarEstados_gestion("WHERE dependencia = '$id'");      
            while($row_estados = $con->FetchAssoc($query_eg)){
                $estado_gestion = new MEstados_gestion;
                $estado_gestion->Createestados_gestion('id', $row_estados[id]);
                echo "<option value='".$estado_gestion->GetId()."'>".$estado_gestion->GetNombre()."</option>";
            }
		}
	}
?>