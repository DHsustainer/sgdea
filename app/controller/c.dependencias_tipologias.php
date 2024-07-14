<?

	session_start();

#error_reporting(E_ALL);

#ini_set('display_errors', '1');



	//Invocando archivos que seran usados en nuestro controlador generico	

	include_once('app/basePaths.inc.php');

	include_once(MODELS.DS.'UsuariosM.php');

	include_once(MODELS.DS.'CaratulaM.php');

	include_once(VIEWS.DS.'events'.DS.'calendar.php');	

	include_once(MODELS.DS.'Super_adminM.php');

	include_once(MODELS.DS.'NotificacionesM.php');

	include_once(MODELS.DS.'Demandado_procesoM.php');

	include_once(MODELS.DS.'GestionM.php');

	include_once(MODELS.DS.'Gestion_suscriptoresM.php');

	include_once(MODELS.DS.'SeccionalM.php');

	include_once(MODELS.DS.'AreasM.php');

	include_once(MODELS.DS.'Seccional_principalM.php');

	include_once(MODELS.DS.'Suscriptores_contactosM.php');

	include_once(MODELS.DS.'Suscriptores_contactos_direccionM.php');

	include_once(MODELS.DS.'Suscriptores_referenciasM.php');

	include_once(MODELS.DS.'Suscriptores_big_dataM.php');

	include_once(MODELS.DS.'Areas_dependenciasM.php');

	include_once(MODELS.DS.'Alertas_usuariosM.php');

	include_once(MODELS.DS.'DependenciasM.php');

	include_once(MODELS.DS.'Dependencias_tipologiasM.php');

	include_once(MODELS.DS.'FolderM.php');

	include_once(MODELS.DS.'CityM.php');

	include_once(MODELS.DS.'ProvinceM.php');

	##include_once(PLUGINS.DS.'PHPMailer_5.2.4/class.phpmailer.php');	

	include_once(PLUGINS.DS.'PHPExcel/IOFactory.php');

	include_once(ROOT.DS.'DALC'.DS.'/mySql.php');

	include_once('consultas.php');

	include_once('funciones.php');	

	include_once(MODELS.DS.'Dependencias_tipologiasM.php');

	include_once(MODELS.DS.'Dependencias_tipologias_referenciasM.php');

	include_once(MODELS.DS.'Dependencias_documentosM.php');





	// Definiendo variables y conectandonos con la base de datos

	$con = new ConexionBaseDatos;

	$con->Connect($con);

	

	// Llamando al objeto a controlar		

	$ob = new CDependencias_tipologias;

	$c = new Consultas;

	$f = new Funciones;

	// DEFINIMOS EN UN VECTOR LOS CAMPOS QUE VAMOS A EDITAR

	$ar2 = array('id_dependencia', 'usuario', 'fecha', 'tipologia', 'requiere_firma', 'es_inmaterial', 'es_obligatorio', 'es_entrada', 'es_publico', 'observacion', 'prioridad', 'dias_vencimiento', 'soporte', 'formato');

	// DEFINIMOS EN OTRO VECTOR LOS NUEVOS DATOS QUE VAMOS A METER	

	$ar1 = array($c->sql_quote($_REQUEST['id_dependencia']), $c->sql_quote($_REQUEST['usuario']), $c->sql_quote($_REQUEST['fecha']), $c->sql_quote($_REQUEST['tipologia']), $c->sql_quote($_REQUEST['requiere_firma']), $c->sql_quote($_REQUEST['is_inm']), $c->sql_quote($_REQUEST['is_obl']), $c->sql_quote($_REQUEST['is_entrada']), $c->sql_quote($_REQUEST['is_pbl']), $c->sql_quote($_REQUEST['observacion']), $c->sql_quote($_REQUEST['prioridad']), $c->sql_quote($_REQUEST['dias_vencimiento']), $c->sql_quote($_REQUEST['soporte']), $c->sql_quote($_REQUEST['updateformato']));	

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

			$ob->Insertar($c->sql_quote($_REQUEST["id_dependencia"]), $c->sql_quote($_REQUEST["usuario"]), $c->sql_quote($_REQUEST["fecha"]), $c->sql_quote($_REQUEST["tipologia"]), $c->sql_quote($_REQUEST['requiere_firma']), $c->sql_quote($_REQUEST["is_inm"]), $c->sql_quote($_REQUEST["is_obl"]), $c->sql_quote($_REQUEST["is_entrada"]), $c->sql_quote($_REQUEST["formato"]), $c->sql_quote($_REQUEST["is_pbl"]), $c->sql_quote($_REQUEST["observacion"]), $c->sql_quote($_REQUEST["prioridad"]), $c->sql_quote($_REQUEST["dias_vencimiento"]), $c->sql_quote($_REQUEST["soporte"]));

		elseif($c->sql_quote($_REQUEST['action']) == 'miregistrar')

		// CAPTURA LAS VARIAABLES Y ENVIALAS A LA FUNCION INSERTAR		

			$ob->MiInsertar();

		// SINO SI ES EDITAR ENTONCES CARGA EL FORMULARIO EDITAR	

		elseif($c->sql_quote($_REQUEST['action']) == 'editar')

			$ob->VistaEditar($c->sql_quote($_REQUEST['id']));	

		// SINO SI ES ACTUALIZAR ENTONCES ENVIA UNA ACTUALIZACION CON LOS PARAMETROS CAPTURADOS

		elseif($c->sql_quote($_REQUEST['action']) == 'actualizar')

			$ob->Editar($constrain, $ar2, $ar1, $output);

		// SINO SI ES ELIMINAR ENTONCES CARGA LA FUNCION ELIMINAR

		elseif($c->sql_quote($_REQUEST['action']) == 'eliminar')

			$ob->Eliminar($c->sql_quote($_REQUEST['id']));

		elseif($c->sql_quote($_REQUEST['action']) == 'eliminarx')

			$ob->Eliminarx($c->sql_quote($_REQUEST['id']));

		// SINO SI ES NUEVO BUSCAR CARGA EL BUSCADOR			

		elseif($c->sql_quote($_REQUEST['action']) == 'buscar')

			$ob->Buscar($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['cn']));		

		elseif($c->sql_quote($_REQUEST['action']) == 'GetListadoTipologias')

			$ob->GetListadoTipologias($c->sql_quote($_REQUEST['id']));

		elseif($c->sql_quote($_REQUEST['action']) == 'getmetadatos')

			$ob->GetListadoMetadatos($c->sql_quote($_REQUEST['id']));

		elseif($c->sql_quote($_REQUEST['action']) == 'GetListado')

			$ob->GetListado($c->sql_quote($_REQUEST['id']));

		elseif($c->sql_quote($_REQUEST['action']) == 'metadatos')

			$ob->metadatos($c->sql_quote($_REQUEST['id']));
		elseif($c->sql_quote($_REQUEST['action']) == 'ordenar')
			$ob->Ordenar($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['list']));		

		elseif($c->sql_quote($_REQUEST['action']) == 'cargarformato'){

			$uploaddir = PLUGINS.DS.'./uploadsfiles/'; 



			$tmp_name = $_FILES["uploadfile"]["tmp_name"];

			$name = $_FILES["uploadfile"]["name"];

			$newname = $f->GenerarNuevoId($name);

			$destino =  $uploaddir.$newname;

			 

			if (move_uploaded_file($_FILES['uploadfile']['tmp_name'], $destino)) { 

			  echo $newname; 

			} else {

				echo $newname;

			}



		}else

		// SI NO ES NINGUNA DE LAS ANTERIORES ENTONCES CARGA POR DEFECTO LA VISTA DE LISTADO		

			$ob->VistaListar('');		

	

	// DEFINIENDO LA CLASE DEL CONTROLADOR DEL OBJETO QUE TIENE HERENCIA CON EL CONTROLADOR GENERICO PARA CARGAR LA INTERFAZ

	class CDependencias_tipologias extends MainController{

		

		// DEFINIENDO LA FUNCION LISTAR 		

		function VistaListar(){

			// CREANDO UN NUEVO MODELO			

			$object = new MDependencias_tipologias;

			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL			

			global $con;

			//CARGANDO LA PAGINA DE INTERFAZ			

			$pagina = $this->load_template('Listar Dependencias_tipologias');			

			// CARGANDO LLAMANDO LA FUNCION LSITAR LIBROS DEL MODELO (FUNCION QUE TRAE DE LA BASE DE DATOS EL LISTADO DE LIBROS

			// DE NO RECIBIR PARAMETROS ESTA FUNCION TRAE EL LISTADO COMPLETO DE LIBROS

			$query = $object->ListarDependencias_tipologias();	    

			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.

			ob_start();

				// SI LA CONSULTA NO SE EJECUTA ENTONCES RETORNA VACIO

		   		if($con->NumRows($query) <= 0 || $query !=''){

					// SI LA CONSULTA SE EJECUTA ENTONCES CARGA EL LISTADO DE LIBROS DE LA VISTA

					include_once(VIEWS.DS.'dependencias_tipologias/Listar.php');	   			

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

			$pagina = $this->load_template('Crear Dependencias_tipologias');			

			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.

			ob_start();

			include_once(VIEWS.DS.'dependencias_tipologias/FormInsertDependencias_tipologias.php');				

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

		 	$object = new MDependencias_tipologias;

			// LO CREAMOS 			

			$object->CreateDependencias_tipologias('id', $x);

			// Y FINALMENTE CARGAMOS LA VISTA DE EDICION QUE MUESTRA EL CONTENIDO			

			include_once(VIEWS.DS.'dependencias_tipologias/FormUpdateDependencias_tipologias.php');	



			/*if ($_SESSION['MODULES']['metadatos'] == "1") {

				# code...

				$objectx = new MDependencias_tipologias_referencias;

				$objectx->CreateDependencias_tipologias_referencias("dependencia_id", $x);	



				include_once(VIEWS.DS.'dependencias_tipologias_referencias/FormUpdateDependencias_tipologias_referencias.php');		

			}*/

	 	}	

	 	function Buscar($x, $cn = 'id'){

	 		// INVOCAMOS UN NUEVO OBJETO						

			$object = new MDependencias_tipologias;

			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL						

			global $con;

			// CARGA EL TEMPLATE						

			$pagina = $this->load_template('Listado de Dependencias_tipologias');			

			// OBTENEMOS EL LISTADO DE LIBROS DE ACUERDO A LOS PARAMETROS QUE LE ENVIAMOS						

			$query = $object->ListarDependencias_tipologias('WHERE '.$cn.' = "'.$x.'"');	    

			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.

			ob_start();		

		   		if($con->NumRows($query) <= 0 || $query !=''){

					// SI LA CONSULTA NO SE EJECUTA ENTONCES RETORNA VACIO							

					include_once(VIEWS.DS.'dependencias_tipologias/Listar.php');	   			

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

		function Insertar($id_dependencia, $usuario, $fecha, $tipologia, $requiere_firma, $inm, $obl, $ise, $formato, $is_pbl, $observacion, $prioridad, $dias_vencimiento, $soporte){

			// DEFINIENDO EL OBJETO			

			global $con; 

			global $c;



			$inm = ($inm == "on")?"1":"0";

			$obl = ($obl == "on")?"1":"0";

			$ise = ($ise == "on")?"1":"0";

			$is_pbl = ($is_pbl == "on")?"1":"0";

			# ENTRADA = 0

			# SALIDA = 1





		#	echo "Valor de OBL: ".$obl." \n";

			$object = new MDependencias_tipologias;

			// USANDO LA FUNCION DE INSERTAR DEL OBJETO PARA ENVIAR LA INFORMACION A LA BASE DE DATOA			

			$create = $object->InsertDependencias_tipologias($id_dependencia, $usuario, $fecha, trim($tipologia), $requiere_firma, $inm, $obl, $ise, $is_pbl, $observacion, $formato, $prioridad, $dias_vencimiento, $soporte);

			

			$id = $c->GetMaxIdTabla("dependencias_tipologias", "id");



			if ($obl == "1") {

				$object2 = new MDependencias_documentos;

			// USANDO LA FUNCION DE INSERTAR DEL OBJETO PARA ENVIAR LA INFORMACION A LA BASE DE DATOA			

				$create2 = $object2->InsertDependencias_documentos($id_dependencia, $usuario, $fecha, trim($tipologia), $id);

			}


/*
			$dept = new MDependencias_tipologias_referencias;

			$dept->InsertDependencias_tipologias_referencias($_SESSION['usuario'], $id, "Metadatos de $tipologia", $col_1_name, $col_1_type, $col_1_size, $col_2_name, $col_2_type, $col_2_size, $col_3_name, $col_3_type, $col_3_size, $col_4_name, $col_4_type, $col_4_size, $col_5_name, $col_5_type, $col_5_size, $col_6_name, $col_6_type, $col_6_size, $col_7_name, $col_7_type, $col_7_size, $col_8_name, $col_8_type, $col_8_size, $col_9_name, $col_9_type, $col_9_size, $col_10_name, $col_10_type, $col_10_size, $col_11_name, $col_11_type, $col_11_size, $col_12_name, $col_12_type, $col_12_size, $col_13_name, $col_13_type, $col_13_size, $col_14_name, $col_14_type, $col_14_size, $col_15_name, $col_15_type, $col_15_size, date("Y-m-d"));
*/


			echo $id;





		}

		// FUNCION QUE RECIBE UNASERIE DE PARAMETROS Y LOS ENVIA A LA BASE DE DATOS PARA ACTUALIZAR UN REGISTRO (FUNCION ESPECIAL)		

		function Editar($constrain, $fields, $updates, $output){

			$object = new MDependencias_tipologias;

			$create = $object->UpdateDependencias_tipologias($constrain, $fields, $updates, $output);

			

			//SI NO SE ENVIO CORRECTAMENTE ENTONCES GENERA ERROR SINO ENVIA OK

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



			echo "registro actualizado";



			$this->Editar($constrain, $ar2, $ar1, $output);

		}

		function Eliminarx($id){
			global $con;

			$con->Query("Update gestion_anexos set tipologia = '0' where tipologia = '$id'");
			$con->Query("delete from dependencias_tipologias where id = '$id'");

			echo "Tipología Documental Eliminada!";
		}



		function GetListadoTipologias($id){

			global $con;

			global $c;

			global $f;



			$tipo = new MDependencias_tipologias;

			$listado = $tipo->ListarDependencias_tipologias("WHERE id_dependencia = '".$id."'", "order by orden, id");

			$pathtype = "";



			while ($rl = $con->FetchAssoc($listado)) {

				echo  "<option value='".$rl['id']."'>".$rl['tipologia']."</option>";	



			}



		}



		function GetListado($id){

			global $con;

			global $c;

			global $f;



			$tipo = new MDependencias_tipologias;

			$listado = $tipo->ListarDependencias_tipologias("WHERE id_dependencia = '".$id."'");

			$pathtype = "";

			$i = 0;
			echo "<label>Documentos que Componen el Expediente</label>";
			echo "<div class='list-group' ".$c->Ayuda('45', 'tog').">";

			while ($rl = $con->FetchAssoc($listado)) {

				$i++;
				$checked = "";

				if ($rl['es_obligatorio'] == "1") {
					$checked = "Checked='checked'";
				}

				echo "<div class='list-group-item'>";
				echo "<input type='checkbox' $checked id='elm".$rl['id']."' name='elementos[]' value='".$rl['id']."'>";
				echo "<label for='elm".$rl['id']."' style='margin-left:10px;margin-right:10px;'>".$rl['tipologia']."</label>";
				echo "(".$rl['prioridad'].")";
				echo " - ".$rl['observacion'];
				echo "</div>";

			}
			echo "</div>";

			if ($i == 0) {

				echo '<tr><td><div class="alert alert-info" role="alert">No se encuentran tipos de documentos especificados en esta categoría documental</div></td></tr>';

			}
		}

		function GetListadoMetadatos($id){

			global $con;

			global $c;

			global $f;



			$ids = $id;
			$consulta = $con->Query("Select * from meta_referencias_titulos where id_s = '".$id."' and tipo = '2'");
			while ($row = $con->FetchAssoc($consulta)) {
				echo "<option value='".$row['id']."'>".$row['titulo']."</option>";
			}

		}



		function metadatos($id){



			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL			

			global $con;

			//CARGANDO LA PAGINA DE INTERFAZ			

			$object = new MSuscriptores_Contactos;

	    	#$query = $object->ListarSuscriptores_modulos();

			

			$pagina = $this->load_template_limpia('Administracion de Metadatos');			

			// CARGANDO LLAMANDO LA FUNCION LSITAR LIBROS DEL MODELO (FUNCION QUE TRAE DE LA BASE DE DATOS EL LISTADO DE LIBROS

			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.

			ob_start();

			// SI LA CONSULTA NO SE EJECUTA ENTONCES RETORNA VACIO

			// SI LA CONSULTA SE EJECUTA ENTONCES CARGA EL LISTADO DE LIBROS DE LA VISTA



	    	include(VIEWS.DS."metadatos/index2.php");	   			

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

		function MiInsertar(){

			// DEFINIENDO EL OBJETO			

			global $con; 

			global $c;


			$idd = "42";
			$usua = "sanderkdna@gmail.com"; 
			$fecha = date("Y-m-d"); 
			$requiere_firma = "NO"; 
			$inm = ""; 
			$obl = "on"; 
			$ise = "on"; 
			$formato = ""; 
			$is_pbl = "on"; 
			$observacion = ""; 
			$prioridad = "ALTA"; 
			$dias_vencimiento = ""; 
			$soporte = "2"; 

			$ar = array(
					"FOTOCOPIA DE LA IDENTIFICACION AMPLIADA AL 150%", 
					"FOTOCOPIA DE LA IDENTIFICACION DEL CONYUGUE DEL TRABAJADOR(A) AMPLIADA AL 150%", 
					"PARTIDA DE MATRIMONIO O FORMATO DE DECLARACION JURAMENTADA (PARA UNION LIBRE"
				);

			for ($i=0; $i < count($ar) ; $i++) { 
				$tipologia = $ar[$i];
				
				$inm = ($inm == "on")?"1":"0";
				$obl = ($obl == "on")?"1":"0";
				$ise = ($ise == "on")?"1":"0";
				$is_pbl = ($is_pbl == "on")?"1":"0";

				$object = new MDependencias_tipologias;
				$create = $object->InsertDependencias_tipologias($idd, $usua, $fecha, trim($tipologia), $requiere_firma, $inm, $obl, $ise, $is_pbl, $observacion, $formato, $prioridad, $dias_vencimiento, $soporte);

				$id = $c->GetMaxIdTabla("dependencias_tipologias", "id");

				if ($obl == "1") {
					$object2 = new MDependencias_documentos;
					$create2 = $object2->InsertDependencias_documentos($idd, $usua, $fecha, trim($tipologia), $id);
				}

				echo $id."<br>";
			}


		}

		function Ordenar($id, $list){
			global $con;
			global $f;
			global $c;

			$norden = explode(",", $list);
			for ($i=0; $i < count($norden) ; $i++) { 
				if ($norden[$i] != "") {
					$datos = explode(":", $norden[$i]);
					#echo "update meta_referencias_campos set orden = '".$datos[1]."' where id = '$datos[0]' \n ";
					$con->Query("update dependencias_tipologias set orden = '".$datos[1]."' where id = '$datos[0]'");
					/*
					$ar1 = array('orden' => $datos[1]);	
					$constrain = array('id' => $datos[0]);
					$PDO->Update('prestamos', $ar1, $constrain, array());*/


				}
			}

		}

	}

?>