<?
session_start();
date_default_timezone_set("America/Bogota");

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
	include_once(MODELS.DS.'Suscriptores_tiposM.php');
	include_once(MODELS.DS.'Areas_dependenciasM.php');
	include_once(MODELS.DS.'Alertas_usuariosM.php');
	include_once(MODELS.DS.'DependenciasM.php');
	include_once(MODELS.DS.'Dependencias_tipologiasM.php');
	include_once(MODELS.DS.'FolderM.php');
	include_once(MODELS.DS.'CityM.php');
	include_once(MODELS.DS.'ProvinceM.php');
	#include_once(PLUGINS.DS.'PHPMailer_5.2.4/class.phpmailer.php');	
	include_once(PLUGINS.DS.'PHPExcel/IOFactory.php');
	include_once(MODELS.DS.'Meta_referencias_titulosM.php');
	include_once(MODELS.DS.'Meta_referencias_camposM.php');
	include_once(MODELS.DS.'Meta_tipos_elementosM.php');
	include_once(MODELS.DS.'Meta_listasM.php');
	include_once(MODELS.DS.'Meta_listas_valoresM.php');
	include_once(MODELS.DS.'Meta_big_dataM.php');
	include_once(ROOT.DS.'DALC'.DS.'/mySql.php');
	include_once('consultas.php');
	include_once('funciones.php');	

	// Definiendo variables y conectandonos con la base de datos
		$con = new ConexionBaseDatos;
		$con->Connect($con);
		// Llamando al objeto a controlar		
		$ob = new CSuscriptores_contactos;
		$c = new Consultas;
		$f = new Funciones;
		// DEFINIMOS EN UN VECTOR LOS CAMPOS QUE VAMOS A EDITAR
		$ar2 = array('identificacion', 'nombre', 'type', 'estado', 'dependencia');
		// DEFINIMOS EN OTRO VECTOR LOS NUEVOS DATOS QUE VAMOS A METER	
		$ar1 = array($c->sql_quote($_REQUEST['identificacion']), $c->sql_quote($_REQUEST['nombre']), $c->sql_quote($_REQUEST['type']), $c->sql_quote($_REQUEST['estado']), $c->sql_quote($_REQUEST['dependencia']));	
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
		$ob->Insertar(
						$c->sql_quote($_REQUEST["identificacion"]), 
						$c->sql_quote($_REQUEST["nombre"]), 
						$c->sql_quote($_REQUEST["type"]), 
						$c->sql_quote($_REQUEST["user_id"]), 
						$c->sql_quote($_REQUEST["fecha"]), 
						$c->sql_quote($_REQUEST["email"]),
						$c->sql_quote($_REQUEST["direccion"]),
						$c->sql_quote($_REQUEST["ciudad"]),
						$c->sql_quote($_REQUEST["telefonos"]),
						$c->sql_quote($_REQUEST["dependencia"])
					);
		// SINO SI ES EDITAR ENTONCES CARGA EL FORMULARIO EDITAR	
		elseif($c->sql_quote($_REQUEST['action']) == 'editar')
			$ob->VistaEditar($c->sql_quote($_REQUEST['id']));	
		// SINO SI ES ACTUALIZAR ENTONCES ENVIA UNA ACTUALIZACION CON LOS PARAMETROS CAPTURADOS
		elseif($c->sql_quote($_REQUEST['action']) == 'actualizar')
			$ob->Editar($constrain, $ar2, $ar1, $output);
		// SINO SI ES ELIMINAR ENTONCES CARGA LA FUNCION ELIMINAR
		elseif($c->sql_quote($_REQUEST['action']) == 'eliminar')
			$ob->Eliminar($c->sql_quote($_REQUEST['id']));
		elseif($c->sql_quote($_REQUEST['action']) == 'listarx')
			$ob->ListadoSuscriptoresSucursal($c->sql_quote($_REQUEST['id']));
		elseif($c->sql_quote($_REQUEST['action']) == 'dependenciassus')
			$ob->ListadoSuscriptoresDependencias($c->sql_quote($_REQUEST['id']));
		elseif($c->sql_quote($_REQUEST['action']) == 'dependenciassus2')
			$ob->ListadoSuscriptoresDependencias2($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['cn']));
		// SINO SI ES NUEVO BUSCAR CARGA EL BUSCADOR			
		elseif($c->sql_quote($_REQUEST['action']) == 'buscar')
			$ob->Buscar($c->sql_quote($_REQUEST['id']));	
		elseif($c->sql_quote($_REQUEST['action']) == 'destbuscar')
			$ob->BuscarDestinatario($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['cn']));	
		elseif($c->sql_quote($_REQUEST['action']) == 'buscarsuscriptor')
			$ob->BuscarSuscriptor($c->sql_quote($_REQUEST['id']));	
		elseif($c->sql_quote($_REQUEST['action']) == 'buscarsuscriptortipo')
			$ob->BuscarSuscriptorTipo($c->sql_quote($_REQUEST['id']));	
		elseif($c->sql_quote($_REQUEST['action']) == 'unificarsuscriptor')
			$ob->UnificarSuscriptor($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['cn']));	
		elseif($c->sql_quote($_REQUEST['action']) == 'verradicaciones')
			$ob->VerRadicaciones($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['cn']), $c->sql_quote($_REQUEST['p1']));				
		elseif ($c->sql_quote($_REQUEST['action']) == "sendDatamail") 
			$ob->sendDatamail($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['cn']));
		elseif ($c->sql_quote($_REQUEST['action']) == "GetListado") 
			$ob->GetListado($c->sql_quote($_REQUEST['id']));
		elseif ($c->sql_quote($_REQUEST['action']) == "checkifexists") 
			$ob->CheckIfExists($c->sql_quote($_REQUEST['id']));
		elseif ($c->sql_quote($_REQUEST['action']) == "buscarJsuscriptor") 
			$ob->GetJSuscriptor($c->sql_quote($_REQUEST['id']));
		elseif ($c->sql_quote($_REQUEST['action']) == "BuscarXSuscriptor") 
			$ob->BuscarXSuscriptor($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['cn']));
		elseif ($c->sql_quote($_REQUEST['action']) == "BuscarXSuscriptor2") 
			$ob->BuscarXSuscriptor2($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['cn']));
		elseif ($c->sql_quote($_REQUEST['action']) == "EnviarClaves") 
			$ob->EnviarClaves();
		elseif ($c->sql_quote($_REQUEST['action']) == "dependencias") 
			$ob->GetDependenciasSuscriptor($c->sql_quote($_REQUEST['id']));

		elseif ($c->sql_quote($_REQUEST['action']) == "estandarizar") 
			$ob->GetEstandarizar();
		elseif ($c->sql_quote($_REQUEST['action']) == "changetype") 
			$ob->CambiarStatusSuscriptor($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['cn']));

		elseif ($c->sql_quote($_REQUEST['action']) == "importar") {
						$uploads_dir = PLUGINS.DS.'files/';
						$tmp_name = $_FILES["userfile"]["tmp_name"];
						$name = $_FILES["userfile"]["name"];
						$newname = $f->GenerarNuevoId($name);
						if (move_uploaded_file($tmp_name, $uploads_dir.$newname)) {
								echo "Archivo cargado";
							}else{
								echo 'error al cargar el archivo';
							}
						$archivoList = $uploads_dir.$newname;
						if(file_exists($archivoList)){

				$objPHPExcel = PHPExcel_IOFactory::load($archivoList);
				#foreach que leer el archivo de excel.
				foreach ($objPHPExcel->getWorksheetIterator() as $worksheet){

					$worksheetTitle     = $worksheet->getTitle();
					$highestRow         = $worksheet->getHighestRow();
					$highestColumn      = $worksheet->getHighestColumn();
					$highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
					$total_lineas = $highestRow;

					for ($row = 1; $row <= $total_lineas; ++ $row){

						$k++;
						$arrFilas = array();

						for ($col = 0; $col < $highestColumnIndex; ++ $col){

							$val = "";
							$cell = $worksheet->getCellByColumnAndRow( $col , $row );
							$val = $cell->getValue();
							$dataType = PHPExcel_Cell_DataType::dataTypeForValue($val);

							if($row == 1 && strlen($val) > 0)
							{
								$arrCabecera[$col] = $val;
							}
							if($row > 1 && strlen($val) > 0)
							{
								$arrFilas[$col] = $val;
							}
						}
						if($row == 1){
							if(in_array("IDENTIFICACION", $arrCabecera)){$col_IDENTIFICACION = array_search("IDENTIFICACION", $arrCabecera);}
							if(in_array("NOMBRE", $arrCabecera)){$col_NOMBRE = array_search("NOMBRE", $arrCabecera);}
							if(in_array("EMAIL", $arrCabecera)){$col_EMAIL = array_search("EMAIL", $arrCabecera);}
							if(in_array("DIRECCION", $arrCabecera)){$col_DIRECCION = array_search("DIRECCION", $arrCabecera);}
							if(in_array("CIUDAD", $arrCabecera)){$col_CIUDAD = array_search("CIUDAD", $arrCabecera);}
							if(in_array("TELEFONO", $arrCabecera)){$col_TELEFONO = array_search("TELEFONO", $arrCabecera);}
							if(in_array("TIPO_SUSCRIPTOR", $arrCabecera)){$col_TIPO_SUSCRIPTOR = array_search("TIPO_SUSCRIPTOR", $arrCabecera);}
						}
						if($row > 1){
							if(isset($col_IDENTIFICACION) ){$IDENTIFICACION = $c->sql_quote(trim( $arrFilas[$col_IDENTIFICACION]));}
							if(isset($col_NOMBRE) ){$NOMBRE = $c->sql_quote(trim( $arrFilas[$col_NOMBRE]));}
							if(isset($col_EMAIL) ){$EMAIL = $c->sql_quote(trim( $arrFilas[$col_EMAIL]));}
							if(isset($col_DIRECCION) ){$DIRECCION = $c->sql_quote(trim( $arrFilas[$col_DIRECCION]));}
							if(isset($col_CIUDAD) ){$CIUDAD = $c->sql_quote(trim( $arrFilas[$col_CIUDAD]));}
							if(isset($col_TELEFONO) ){$TELEFONO = $c->sql_quote(trim( $arrFilas[$col_TELEFONO]));}
							if(isset($col_TIPO_SUSCRIPTOR) ){$TIPO_SUSCRIPTOR = $c->sql_quote(trim( $arrFilas[$col_TIPO_SUSCRIPTOR]));}
						}	
						$ob->Insertar($c->sql_quote($IDENTIFICACION), 
			        			  $c->sql_quote($NOMBRE), 
			        			  $c->sql_quote($TIPO_SUSCRIPTOR), 
			        			  $c->sql_quote($_SESSION['usuario']), 
			        			  $c->sql_quote(date("Y-m-d")), 
			        			  $c->sql_quote($EMAIL),
			        			  $c->sql_quote($DIRECCION),
			        			  $c->sql_quote($CIUDAD),
			        			  $c->sql_quote($TELEFONO)
			        			  );
						/*echo "<tr>";
				        	echo  "<td>".$IDENTIFICACION."<td>".
			        			  "<td>".$NOMBRE."<td>".
			        			  "<td>".$EMAIL."<td>".
			        			  "<td>".$DIRECCION."<td>".
			        			  "<td>".$CIUDAD."<td>".
			        			  "<td>".$TELEFONO."<td>".
			        			  "<td>".$TIPO_SUSCRIPTOR."<td>";
			        	echo "</tr>";*/

					}
				}
			}
		}elseif($c->sql_quote($_REQUEST['action']) == 'buscarremitente')
			$ob->BuscarRemitente($c->sql_quote($_REQUEST['id']));	
		else
		// SI NO ES NINGUNA DE LAS ANTERIORES ENTONCES CARGA POR DEFECTO LA VISTA DE LISTADO		
			$ob->VistaListar('');		
		// DEFINIENDO LA CLASE DEL CONTROLADOR DEL OBJETO QUE TIENE HERENCIA CON EL CONTROLADOR GENERICO PARA CARGAR LA INTERFAZ
	class CSuscriptores_contactos extends MainController{
				// DEFINIENDO LA FUNCION LISTAR 		
		function VistaListar(){
			// CREANDO UN NUEVO MODELO			
			$object = new MSuscriptores_contactos;
			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL			
			global $con;
			//CARGANDO LA PAGINA DE INTERFAZ			
			$pagina = $this->load_template('Listar Suscriptores_contactos');			
			// CARGANDO LLAMANDO LA FUNCION LSITAR LIBROS DEL MODELO (FUNCION QUE TRAE DE LA BASE DE DATOS EL LISTADO DE LIBROS
			// DE NO RECIBIR PARAMETROS ESTA FUNCION TRAE EL LISTADO COMPLETO DE LIBROS
			$query = $object->ListarSuscriptores_contactos("WHERE dependencia = '0'");	    
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();
				// SI LA CONSULTA NO SE EJECUTA ENTONCES RETORNA VACIO
			   		if($con->NumRows($query) <= 0 || $query !=''){
								// SI LA CONSULTA SE EJECUTA ENTONCES CARGA EL LISTADO DE LIBROS DE LA VISTA
							include_once(VIEWS.DS.'suscriptores_contactos/Listar.php');	   			
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
			$pagina = $this->load_template('Crear Suscriptores_contactos');			
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();
			include_once(VIEWS.DS.'suscriptores_contactos/FormInsertSuscriptores_contactos.php');				
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
			global $c;
		 	$object = new MSuscriptores_contactos;
				// LO CREAMOS 			
			$object->CreateSuscriptores_contactos('id', $x);
			// Y FINALMENTE CARGAMOS LA VISTA DE EDICION QUE MUESTRA EL CONTENIDO			
			include_once(VIEWS.DS.'suscriptores_contactos/FormUpdateSuscriptores_contactos.php');		
	 	}	
	 	function Buscar($x){
	 		global $c;
	 		global $con;
	 		global $f;
	 		// INVOCAMOS UN NUEVO OBJETO						
			$object = new MSuscriptores_contactos;
			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL						
			global $con;
			// OBTENEMOS EL LISTADO DE LIBROS DE ACUERDO A LOS PARAMETROS QUE LE ENVIAMOS						
			if ($_SESSION['buscador_global'] == "1") {

				$str = 'Select sc.id, sc.nombre, sc.type from suscriptores_contactos as sc inner join suscriptores_tipos as st on st.id = sc.type where sc.identificacion like "%'.$x.'%" or sc.nombre like "%'.$x.'%"';					
			}else{
				$str = 'Select sc.id, sc.nombre, sc.type from suscriptores_contactos as sc inner join suscriptores_tipos as st on st.id = sc.type where (sc.identificacion like "%'.$x.'%" or sc.nombre like "%'.$x.'%") and sc.user_id = "'.$_SESSION['usuario'].'"';					

			}
			#echo $str;
			$query = $con->Query($str);	    
			echo "<ul class=list-group>";
			$i = 0;
			while ($roe = $con->FetchAssoc($query)) {
					$i++;
					$ts = $c->GetDataFromTable("suscriptores_tipos", "id", $roe['type'], "nombre"," ");

					echo "<li class='list-group-item' onclick='AddSuscriptor(\"".$roe['id']."\", \"".$roe['nombre']."\")'>".$roe['nombre']." (".$ts.")</li>";
				}
			if ($i == 0) {
				if ($_REQUEST['cn'] == "1") {
					echo "<li class='list-group-item'>".$x." (No se encontraron resultados)</li>";
				}else{
					echo "<li class='list-group-item' onclick='AddSuscriptor(\"N\", \"".$x."\")'>".$x." (Crear este suscriptor)</li>";	
				}
				
					#echo "<li onclick='Hideform()'>No se encontraron resultados</li>";
				}
			echo "</ul>";
	 	}	

	 	function BuscarRemitente($x){
	 		global $c;
	 		global $con;
	 		global $f;
	 		// INVOCAMOS UN NUEVO OBJETO						
			$object = new MSuscriptores_contactos;
			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL						
			// OBTENEMOS EL LISTADO DE LIBROS DE ACUERDO A LOS PARAMETROS QUE LE ENVIAMOS	
			if ($_SESSION['buscador_global'] == "1") {

				$str = 'Select sc.id, sc.nombre, sc.type from suscriptores_contactos as sc inner join suscriptores_tipos as st on st.id = sc.type where sc.identificacion like "%'.$x.'%" or sc.nombre like "%'.$x.'%" and st.correspondencia = "2"';					
			}else{
					$str = 'Select sc.id, sc.nombre, sc.type from suscriptores_contactos as sc inner join suscriptores_tipos as st on st.id = sc.type where  (sc.identificacion like "%'.$x.'%" or sc.nombre like "%'.$x.'%")  and st.correspondencia = "2" and sc.user_id = "'.$_SESSION['usuario'].'"';					

			}
			
			$query = $con->Query($str);	

			echo "<ul class=list-group>";
			$i = 0;
			while ($roe = $con->FetchAssoc($query)) {
					$i++;
					$ts = $c->GetDataFromTable("suscriptores_tipos", "id", $roe['type'], "nombre"," ");

					echo "<li class='list-group-item' onclick='AddSuscriptor(\"".$roe['id']."\", \"".$roe['nombre']."\")'>".$roe['nombre']." (".$ts.")</li>";
				}
			if ($i == 0) {
				if ($_REQUEST['cn'] == "1") {
					echo "<li class='list-group-item'>".$x." (No se encontraron resultados)</li>";
				}else{
					echo "<li class='list-group-item' onclick='AddSuscriptor(\"N\", \"".$x."\")'>".$x." (Crear este suscriptor)</li>";	
				}
				
					#echo "<li onclick='Hideform()'>No se encontraron resultados</li>";
				}
			echo "</ul>";
	 	}	

	 	function BuscarDestinatario($x, $role){
	 		global $c;
	 		global $con;
	 		global $f;
	 		// INVOCAMOS UN NUEVO OBJETO						
			$object = new MSuscriptores_contactos;
			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL						
			// OBTENEMOS EL LISTADO DE LIBROS DE ACUERDO A LOS PARAMETROS QUE LE ENVIAMOS						
			if ($_SESSION['buscador_global'] == "1") {

				$str = 'Select sc.id, sc.nombre, sc.type from suscriptores_contactos as sc inner join suscriptores_tipos as st on st.id = sc.type where sc.identificacion like "%'.$x.'%" or sc.nombre like "%'.$x.'%" and st.correspondencia = "2"';					
			}else{
				$str = 'Select sc.id, sc.nombre, sc.type from suscriptores_contactos as sc inner join suscriptores_tipos as st on st.id = sc.type where  (sc.identificacion like "%'.$x.'%" or sc.nombre like "%'.$x.'%")  and st.correspondencia = "2" and sc.user_id = "'.$_SESSION['usuario'].'"';					

			}

			$query = $con->Query($str);	    
			echo "<ul class=list-group>";
			$i = 0;
			while ($roe = $con->FetchAssoc($query)) {
					$i++;
					$ts = $c->GetDataFromTable("suscriptores_tipos", "id", $roe['type'], "nombre"," ");

					echo "<li class='list-group-item' onclick='AddDestinatarioRole(\"".$roe['id']."\", \"".$roe['nombre']."\", \"".$role."\")'>".$roe['nombre']." (".$ts.")</li>";
				}
			if ($i == 0) {
				if ($_REQUEST['cn'] == "1") {
					echo "<li class='list-group-item'>".$x." (No se encontraron resultados)</li>";
				}else{
					echo "<li class='list-group-item' onclick='AddDestinatarioRole(\"N\", \"".$x."\", \"".$role."\")'>".$x." (Crear este suscriptor)</li>";	
				}
				
					#echo "<li onclick='Hideform()'>No se encontraron resultados</li>";
				}
			echo "</ul>";
	 	}	


	 	function BuscarSuscriptor($id){

	 		global $con;

	 		$sc = new MSuscriptores_contactos;

	 		$sc->CreateSuscriptores_contactos("id", $id);

	 		$sd = new MSuscriptores_contactos_direccion;

	 		$query = $sd->ListarSuscriptores_contactos_direccion("WHERE id_contacto = '".$id."'");

	 		if ($sc->GetNombre() != "") {

			# code...

	 			$path = "";

				$path .= "<h3>".$sc->GetNombre()."</h3>";

 			 	$i = 0;

 			 	while ($row = $con->FetchAssoc($query)) {

 				 			$i++;

 				 			$path .= "<b>Direccion: </b>".$row[direccion]." - ".$row[ciudad]."<br>";

 				 			$path .= "<b>Telefono: </b>".$row[telefonos]."<br>";

 				 			$path .= "<b>E-mail: </b>".$row[email]."<br>";

 				 			$path .= "<hr>";

 		 		}



 		 		$arr = array("a" => $path);



 		 		echo json_encode($arr);

 		 		

 		 	}else{

 		 		$arr = array("a" => "vacio");

 			 		echo json_encode($arr);

 		 	}

 	 	}
 		function BuscarSuscriptorTipo($x){
		 		// INVOCAMOS UN NUEVO OBJETO						
				$object = new MSuscriptores_contactos;
			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL						
			global $con;
			// OBTENEMOS EL LISTADO DE LIBROS DE ACUERDO A LOS PARAMETROS QUE LE ENVIAMOS						
			$query = $object->ListarSuscriptores_contactos(' group by type having type like "%'.$x.'%"');	    
			echo "<ul>";
			$i = 0;
			while ($roe = $con->FetchAssoc($query)) {
					$i++;
					echo "<li onclick='AddSuscriptorTipo(\"".$roe['type']."\")'>".$roe['type']."</li>";
				}
			if ($i == 0) {
					echo "<li onclick='AddSuscriptorTipo(\"".$x."\")'>Crear ".$x."</li>";
				}
			echo "</ul>";
	 	}
		 function GetJSuscriptor($id){
			global $con;
			global $c;
	 		$sc = new MSuscriptores_contactos;
	 		$sc->CreateSuscriptores_contactos("id", $id);
	 		$sd = new MSuscriptores_contactos_direccion;
	 		$query = $sd->ListarSuscriptores_contactos_direccion("WHERE id_contacto = '".$id."'");
			$Identificacion_suscriptor = $sc->GetIdentificacion();
			$Type_suscriptor = $sc->GetType();
			$nombre_suscriptor = html_entity_decode($sc->GetNombre());
			while ($row = $con->FetchAssoc($query)) {
				$Direccion_suscriptor 	= html_entity_decode($row[direccion]);
				$Ciudad_suscriptor 		= html_entity_decode($row[ciudad]);
				$Telefonos_suscriptor 	= html_entity_decode($row[telefonos]);
				$Email_suscriptor 		= html_entity_decode($row[email]);
				$natural_juridica 		= html_entity_decode($row[natural_juridica]);
				$municipio 				= html_entity_decode($row[municipio]);
				$departamento 			= html_entity_decode($row[departamento]);
			}	
			$_SESSION['ssubid'] = $c->sql_quote($id);
			$arr = array('Identificacion_suscriptor' => $Identificacion_suscriptor, 'Type_suscriptor' => $Type_suscriptor, 'Direccion_suscriptor' => $Direccion_suscriptor, 'Ciudad_suscriptor' => $Ciudad_suscriptor, 'Telefonos_suscriptor' => $Telefonos_suscriptor, 'Email_suscriptor' => $Email_suscriptor, 'nombre_suscriptor' => $nombre_suscriptor, 'natural_juridica' => $natural_juridica, 'municipio' => $municipio, 'departamento' => $departamento);
			echo json_encode($arr);	
		}
		// FUNCION QUE OBTIENE UNA SERIE DE DATOS Y LOS INSERTA EN LA BASE DE DATOS	

		function Insertar($identificacion, $nombre, $type, $user_id, $fecha, $email, $direccion="", $ciudad="", $telefono="",  $dependencia = ""){
			// DEFINIENDO EL OBJETO			
			global $c;
			global $con;
			$object = new MSuscriptores_contactos;
			// USANDO LA FUNCION DE INSERTAR DEL OBJETO PARA ENVIAR LA INFORMACION A LA BASE DE DATOA			
			$create = $object->InsertSuscriptores_contactos($identificacion, $nombre, $type, $user_id, $fecha, $dependencia);
			$suscriptor_id = $c->GetMaxIdTabla("suscriptores_contactos", "id");

			$dir = explode(";", $direccion);
			$ciu = explode(";", $ciudad);
			$tel = explode(";", $telefono);
			$ema = explode(";", $email);

			for ($i=0; $i < count($dir) ; $i++) { 
				$suscrd = new MSuscriptores_contactos_direccion;
				$suscrd->InsertSuscriptores_contactos_direccion($suscriptor_id, $dir[$i], $ciu[$i], $tel[$i], $ema[$i], "");
			}
			echo '<script> window.location.href = "'.HOMEDIR.DS.'herramientas/#contacts"</script>';					
		}
		// FUNCION QUE RECIBE UNASERIE DE PARAMETROS Y LOS ENVIA A LA BASE DE DATOS PARA ACTUALIZAR UN REGISTRO (FUNCION ESPECIAL)		
		function Editar($constrain, $fields, $updates, $output){
			$object = new MSuscriptores_contactos;
			$create = $object->UpdateSuscriptores_contactos($constrain, $fields, $updates, $output);
			echo '<script> window.location.href = "'.HOMEDIR.$_REQUEST['geturl'].'"</script>';						
		}
	// FUCNION QUE RECIBE UN PARAMETRO Y ELIMINA EL REGISTRO DE LA BASE DE DATOS		
		function Eliminar($id){
			// DEFINIMOS UN OBJETO NUEVO						
			$object = new MSuscriptores_contactos;
			// LLAMAMOS A LA FUNCION QUE EJECUTA LA ELIMINACION.			
			$delete = $object->DeleteSuscriptores_contactos($id); 		
			//SI NO SE ENVIO CORRECTAMENTE ENTONCES GENERA ERROR SINO ENVIA OK
			if($delete != '1')
				echo 'ERROR AL ELIMINAR';
				else
				echo 'OK!';			
		}
		function ListadoSuscriptoresSucursal($id){
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
$uaid = $con->Result($con->Query("select a_i from usuarios where user_id = '".$_SESSION['usuario']."'"), 0,'a_i');
			$g = new MGestion;
			$qn = $g->ListarGestion(" where ciudad = '".$_SESSION['ciudad']."' and oficina = '".$_SESSION['seccional']."' and dependencia_destino = '".$_SESSION['area_principal']."' and (nombre_destino = '".$uaid."' or usuario_registra = '".$_SESSION['usuario']."')  and id_dependencia_raiz in(select id from dependencia where id_version='".$_SESSION['id_trd_empresa']."') group by suscriptor_id");
		/*
			CIUDAD  = CIUDAD
					OFICINA = OFICINA
					AREA PRINCIPAL = DEPENDENCIA_DESTINO
					SERIE = ID_DEPENDENCIA_RAIZ
					SUBSERIE = TIPO_DOCUMENTO				
			*/
		echo '	
					<div id="tools-content">
								<div class="opc-folder blue">
										<ol class="breadcrumb">
											  <a href="/proceso/1/" class="active"><li class="breadcrumb-item active fa fa-archive"></li></a>
				  							  <li></li>
				  							</ol>
										</div>
								</div>
							<div id="folders-content">
								<div id="folders-list-content">
									<div class="title">Listado de Sucriptores</div><br>';
									?>
			<script type="text/javascript">
$(document).ready(function(){
$('#filter').keyup(function () { 
	$('.media').each(function() {
		    var filter = $("#filter").val();
		    //alert( $( this ).text() );
		    filter = filter.toUpperCase();
	        $(this).find("a.nombre:not(:contains('" + filter + "'))").parent().parent().parent().hide();
	        $(this).find("a.nombre:contains('" + filter + "')").parent().parent().parent().show();
		});
});
});	
</script>
<div class='newblock_suscriptor2'>
			<input type="text" class="form-control" id="filter" name="filter" placeholder="Escriba el nombre de un suscriptor para buscarlo	">
		</div>
		<?
while ($ro2 = $con->FetchAssoc($qn)) {
					$s = new MSuscriptores_contactos;
					$s->CreateSuscriptores_contactos("id", $ro2['suscriptor_id']);
					$cantidad = $f->Zerofill($c->Getcounter("gestion", "suscriptor_id = '".$ro2['suscriptor_id']."'"), 3);
					$nombre = $s->GetNombre();
					$enlace = "/suscriptores_contactos/dependenciassus/".$s->GetId()."/";
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
		function ListadoSuscriptoresDependencias($id){
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
$uaid = $con->Result($con->Query("select a_i from usuarios where user_id = '".$_SESSION['usuario']."'"), 0,'a_i');
			$g = new MGestion;
			$qn = $g->ListarGestion(" where ciudad = '".$_SESSION['ciudad']."' and oficina = '".$_SESSION['seccional']."' and dependencia_destino = '".$_SESSION['area_principal']."' and suscriptor_id = '".$id."' and nombre_destino = '".$uaid."' group by id_dependencia_raiz");
		/*
			CIUDAD  = CIUDAD
					OFICINA = OFICINA
					AREA PRINCIPAL = DEPENDENCIA_DESTINO
					SERIE = ID_DEPENDENCIA_RAIZ
					SUBSERIE = TIPO_DOCUMENTO				
			*/
		$csusc = new MSuscriptores_contactos;
			$csusc->CreateSuscriptores_contactos("id", $id);
			echo '	
					<div id="tools-content">
								<div class="opc-folder blue">
										<ol class="breadcrumb">
											  <a href="/suscriptores_contactos/listarx/"><li class="breadcrumb-item fa fa-archive"></li></a>
				  							  <li></li>
				  							  <li class="breadcrumb-item active">'.$csusc->GetNombre().'</li>
				  							</ol>
										</div>
								</div>
							<div id="folders-content">
								<div id="folders-list-content">
									<div class="title">Listado de Series</div><br>';
						while ($ro2 = $con->FetchAssoc($qn)) {
					$s = new MDependencias;
					$s->CreateDependencias("id", $ro2['id_dependencia_raiz']);
					$cantidad = $f->Zerofill($c->Getcounter("gestion", "suscriptor_id = '".$ro2['suscriptor_id']."' and dependencia_destino = '".$_SESSION['area_principal']."'  "), 3);
					$nombre = $s->GetNombre();
					$enlace = "/suscriptores_contactos/dependenciassus2/".$id."/".$s->GetId()."/";
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
		function ListadoSuscriptoresDependencias2($id, $idd){
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
			$uaid = $con->Result($con->Query("select a_i from usuarios where user_id = '".$_SESSION['usuario']."'"), 0,'a_i');
			$g = new MGestion;
			$qn = $g->ListarGestion("inner join gestion_suscriptores on gestion_suscriptores.id_gestion = gestion.id  where ciudad = '".$_SESSION['ciudad']."' and oficina = '".$_SESSION['seccional']."' and dependencia_destino = '".$_SESSION['area_principal']."' and gestion_suscriptores.id_suscriptor = '".$id."' and id_dependencia_raiz = '".$idd."'  group by tipo_documento", "", "");
			#$qn = $g->ListarGestion("inner join gestion_suscriptores on gestion_suscriptores.id_gestion = gestion.id where ciudad = '".$_SESSION['ciudad']."' and oficina = '".$_SESSION['seccional']."' and dependencia_destino = '".$_SESSION['area_principal']."' and gestion_suscriptores.id_suscriptor = '".$_SESSION['suscriptor_id']."' group by id_dependencia_raiz", "", "");
		/*
			CIUDAD  = CIUDAD
					OFICINA = OFICINA
					AREA PRINCIPAL = DEPENDENCIA_DESTINO
					SERIE = ID_DEPENDENCIA_RAIZ
					SUBSERIE = TIPO_DOCUMENTO				
			*/
		$csusc = new MSuscriptores_contactos;
			$csusc->CreateSuscriptores_contactos("id", $id);
			$draiz = new MDependencias;
			$draiz->CreateDependencias("id", $idd);
			$sc = new MSeccional;
			$sc->CreateSeccional("id", $_SESSION['seccional']);
			$cit = new MCity;
			$cit->CreateCity("code", $_SESSION['ciudad']);			
			$ar = new MAreas;
			$ar->CreateAreas("id", $_SESSION['area_principal']);
			if ($_SESSION['suscriptor_id'] == "") {
					echo 	'	
							<div id="tools-content">
										<div class="opc-folder blue">
												<ol class="breadcrumb">
														<a href="/suscriptores_contactos/listarx/"><li class="breadcrumb-item fa fa-archive"></li></a>
															<li></li>
															<li class="breadcrumb-item"><a href="/suscriptores_contactos/dependenciassus/'.$id.'/">'.$csusc->GetNombre().'</a></li>
															<li class="breadcrumb-item active">'.$draiz->GetNombre().'</li>
														</ol>
												</div>
										</div>
									<div id="folders-content">
										<div id="folders-list-content">
											<div class="title">Listado de Sub-Series</div><br>';
							}else{
					echo 	'	
							<div id="tools-content">
										<div class="opc-folder blue">
												<ol class="breadcrumb">
														<a href="/dashboard/"><li class="breadcrumb-item fa fa-archive"></li></a>
															<li></li>
															<li class="breadcrumb-item"><a href="/city/childs/'.$cit->GetCode().'/0/">'.$cit->GetName().'</a></li>
															<li class="breadcrumb-item"><a href="/seccional/childs/'.$sc->GetId().'/0/">'.$sc->GetNombre().'</a></li>
															<li class="breadcrumb-item"><a href="/areas/childs/'.$ar->GetId().'/0/">'.$ar->GetNombre().'</a></li>
															<li class="breadcrumb-item active">'.$draiz->GetNombre().'</li>
														</ol>
												</div>
										</div>
									<div id="folders-content">
										<div id="folders-list-content">
											<div class="title">Listado de Sub-Series Documentales</div><br>';
							}
			while ($ro2 = $con->FetchAssoc($qn)) {
					$s = new MDependencias;
					$s->CreateDependencias("id", $ro2['tipo_documento']);
					$cantidad = $f->Zerofill($c->Getcounter("gestion", "suscriptor_id = '".$id."' and tipo_documento = '". $ro2['tipo_documento']."' "), 3);
					$nombre = $s->GetNombre();
					$enlace = "/suscriptores_contactos/verradicaciones/".$s->GetId()."/".$id."/";
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
		function VerRadicaciones($id, $ids, $fechas){
			global $con;
			global $f;
			global $c;
			$wherefecha = '';
			$fecha_inicio = '';
			$fecha_fin = '';
			if($fechas != ''){
					$fecha = explode('|',$fechas);
					$wherefecha = " and gestion.f_recibido between '$fecha[0]' and '$fecha[1]' ";
					$fecha_inicio = $fecha[0];
					$fecha_fin = $fecha[1];
				}
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
			$g = new MGestion;
			$qn = $con->Query("SELECT gestion.id FROM gestion inner join gestion_suscriptores on gestion_suscriptores.id_gestion = gestion.id   where ciudad = '".$_SESSION['ciudad']."' and oficina = '".$_SESSION['seccional']."' and dependencia_destino = '".$_SESSION['area_principal']."' and id_dependencia_raiz = '".$draiz->GetId()."' and tipo_documento = '".$id."' and gestion_suscriptores.id_suscriptor = '".$ids."' $wherefecha ", '', '');
			#$qn = $g->ListarGestion("inner join gestion_suscriptores on gestion_suscriptores.id_gestion = gestion.id  where ciudad = '".$_SESSION['ciudad']."' and oficina = '".$_SESSION['seccional']."' and dependencia_destino = '".$_SESSION['area_principal']."' and gestion_suscriptores.id_suscriptor = '".$id."' and id_dependencia_raiz = '".$idd."' group by tipo_documento", "", "");
		/*
			CIUDAD  = CIUDAD
					OFICINA = OFICINA
					AREA PRINCIPAL = DEPENDENCIA_DESTINO
					SERIE = ID_DEPENDENCIA_RAIZ
					SUBSERIE = TIPO_DOCUMENTO				
					SUSCRIPTOR = SUSCRIPTOR_ID				
			*/
	if ($_SESSION['suscriptor_id'] == "") {
			echo '	
					<div id="tools-content">
								<div class="opc-folder blue">
										<ol class="breadcrumb">
												<a href="/suscriptores_contactos/listarx/"><li class="breadcrumb-item fa fa-archive"></li></a>
													<li></li>
													<li class="breadcrumb-item"><a href="/suscriptores_contactos/dependenciassus/'.$ids.'/">'.$csusc->GetNombre().'</a></li>
													<li class="breadcrumb-item"><a href="/suscriptores_contactos/dependenciassus2/'.$ids.'/'.$draiz->GetId().'/">'.$draiz->GetNombre().'</a></li>
													<li class="breadcrumb-item active">'.$dep->GetNombre().'</li>
												</ol>
										</div>
								</div>';
				}else{
				$sc = new MSeccional;
					$sc->CreateSeccional("id", $_SESSION['seccional']);
					$cit = new MCity;
					$cit->CreateCity("code", $_SESSION['ciudad']);			
					$ar = new MAreas;
					$ar->CreateAreas("id", $_SESSION['area_principal']);
					echo 	'	
							<div id="tools-content">
										<div class="opc-folder blue">
												<div class="ico-content-ps">
														<a href="/gestion/nuevo/"><div class="icon schedule hight-blue"></div></a>
														</div>
													<div class="header-agenda">
														<div id="boton-new-proces" style="float: left">
																<a class="no_link" href="/dashboard/">
																		<div>'.$_SESSION['nombre'].'</div>
																		</a>
																</div>
															<div class="boton-new-proces-blankspace" style="float: left"></div>
															<div id="boton-new-proces" style="float: left">
																<a class="no_link" href="/city/childs/'.$cit->GetCode().'/0/">
																		<div>
																				'.$cit->GetName().'
																				</div>
																		</a>
																</div>
															<div class="boton-new-proces-blankspace" style="float: left"></div>
															<div id="boton-new-proces" style="float: left">
																<a class="no_link" href="/seccional/childs/'.$sc->GetId().'/0/">
																		<div>
																				'.$sc->GetNombre().'
																				</div>
																		</a>
																</div>
															<div class="boton-new-proces-blankspace" style="float: left"></div>			
															<div id="boton-new-proces" style="float: left">
																<a class="no_link" href="/areas/childs/'.$ar->GetId().'/0/">
																		<div>
																				'.$ar->GetNombre().'
																				</div>
																		</a>
																</div>
															<div class="boton-new-proces-blankspace" style="float: left"></div>
															<div id="boton-new-proces" style="float: left">
																<a class="no_link" href="'.HOMEDIR.'/suscriptores_contactos/dependenciassus2/'.$id.'/'.$idd.'/">
																		<div>'.$draiz->GetNombre().'</div>
																		</a>
																</div>
															<div class="boton-new-proces-blankspace" style="float: left"></div>
															<div id="boton-new-proces" style="float: left">
																<a class="no_link" href="'.HOMEDIR.'/suscriptores_contactos/verradicaciones/'.$id.'/'.$ids.'/">
																		<div>'.$dep->GetNombre().'</div>
																		</a>
																</div>
														</div>
												</div>
										</div>';
					}
		echo '	<div id="folders-content" style="background-color: #f0f0f0">
						<div id="folders-list-content" style="margin-top:20px; background-color: #f0f0f0" class="scrollable">
										<div>
											Fecha inicio:
											<input style="height:35px;width:200px" class="form-control datepicker hasDatepicker" type="text" name="fecha_inicio" id="fecha_inicio" placeholder="Fecha de Inicio:" maxlength="" value="'.$fecha_inicio.'">
											Fecha fin:
											<input style="height:35px;width:200px" class="form-control datepicker hasDatepicker" type="text" name="fecha_fin" id="fecha_fin" placeholder="Fecha de Fin:" maxlength="" value="'.$fecha_fin.'">
											<input type="button" value="Filtrar por Fecha" onclick="fnsuscriptores_contactos_verradicaciones('.$id.','.$ids.')">
											</div>
											<div class="title right">Listado de Radicaciones Registradas</div>
											<div class="table">
												';
								global $c;
			$ar = array("0" => "Baja", "1" => "Media", "2" => "Alta");
			while ($ro2 = $con->FetchAssoc($qn)) {
					$c->GetVistaExpedienteDefault($ro2["id"]);
				}
			echo '					
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
		function sendDatamail($id, $id_gestion = "0"){

			global $con;
			global $c;
			global $f;

			$objectx = new MSuscriptores_contactos;;
			$objectx->CreateSuscriptores_contactos("id", $id);
			$usuario = $objectx->GetCod_ingreso();
			$clave = $objectx->GetDec_pass();

			if ($id_gestion != "0") {
				# code...
				$gestion = new MGestion;
				$gestion->CreateGestion("id", $id_gestion);

				$rad = $gestion->GetNum_oficio_respuesta();

				$idp = '9';
			}else{
				$idp = "8";
			}

			$SSC = new MSuscriptores_contactos_direccion;
			$query = $SSC->ListarSuscriptores_contactos_direccion("WHERE id_contacto = '".$objectx -> GetId()."'");	    
			$email = $con->Result($query, 0, 'email'); 

			$m = new MUsuarios;
			$m->CreateUsuarios("user_id", $_SESSION['usuario']);

			$MPlantillas_email = new MPlantillas_email;
			$MPlantillas_email->CreatePlantillas_email('id', $idp);
			$contenido_email = $MPlantillas_email->GetContenido();
			$contenido_email = str_replace("[elemento]Suscriptor[/elemento]",      $objectx->GetNombre(),     $contenido_email );
			$contenido_email = str_replace("[elemento]PROJECTNAME[/elemento]",      PROJECTNAME,     $contenido_email );
			$contenido_email = str_replace("[elemento]rad_completo[/elemento]",      $rad,     $contenido_email );
			$contenido_email = str_replace("[elemento]responsable[/elemento]", $_SESSION['nombre'],     	   $contenido_email );
			$contenido_email = str_replace("[elemento]USUARIO[/elemento]",      $usuario,   $contenido_email );
			$contenido_email = str_replace("[elemento]CLAVE_USUARIO[/elemento]",      $clave,   $contenido_email );
			$contenido_email = str_replace("[elemento]HOMEDIR[/elemento]",      HOMEDIR,   $contenido_email );
			$contenido_email = str_replace("[elemento]observacion[/elemento]",      $gestion->GetObservacion(),   $contenido_email );
			$contenido_email = str_replace("[elemento]rad_externo[/elemento]",      $gestion->GetRadicado(),   $contenido_email );
			$contenido_email = str_replace("[elemento]LOGO[/elemento]",      '<img src="'.HOMEDIR.'/app/plugins/thumbnails/'.$c->getLogo().'" width="150px">',   $contenido_email );

			$exito = $c->fnEnviaEmailGlobal(CONTACTMAIL,PROJECTNAME,$MPlantillas_email->GetNombre(),$contenido_email,$email);

			if ($exito) {
				# code...
				echo 'Se han enviado los datos de acceso al suscriptor '.$email;
			}else{
				echo 'No se pudo enviar la clave al suscriptor';
			}
		}

		function EnviarClaves(){

			global $con;
			global $f;
			global $c;

			$vcampos_reporte = $_REQUEST["gestion"];
			$campos_reporte = implode(',',$vcampos_reporte);
			$arr_campos = explode(",", $campos_reporte);
			#print_r($arr_campos);
			$ids = "";
			for ($i=0; $i < count($arr_campos) ; $i++) { 
				$ids .= $arr_campos[$i].",";
			}
			$ids = substr($ids, 0, -1);
			$query = $con->Query("SELECT * FROM gestion WHERE id in($ids) group by suscriptor_id");

			while ($row = $con->FetchAssoc($query)) {
				$this->sendDatamail($row['suscriptor_id']);
				$con->Query("insert consultas_varias (suscriptor_id, gestion_id, fecha, ip, type, estado) VALUES ('".$row['suscriptor_id']."', '".$row['id']."', '".date("Y-m-d H:i:s")."', '".$_SERVER['REMOTE_ADDR']."', 'IE', '0')");

				echo "\n";
			}
		}
		function GetListado($pag = "1"){
			global $con;
			$suscriptores = new MSuscriptores_contactos;
			// DE NO RECIBIR PARAMETROS ESTA FUNCION TRAE EL LISTADO COMPLETO DE LIBROS
			$RegistrosAMostrar = 12;
			if(isset($pag)){
					$RegistrosAEmpezar=($pag-1)*$RegistrosAMostrar;
					$PagAct=$pag;
				}else{
					$RegistrosAEmpezar=0;
					$PagAct=1;
				}	
			$query = $suscriptores->ListarSuscriptores_contactos("", "order by nombre", "limit $RegistrosAEmpezar, $RegistrosAMostrar");	    
			include(VIEWS.DS."suscriptores_contactos".DS."Listar.php");
		}
		function BuscarXSuscriptor($id, $pag = "1"){
			global $con;
			$suscriptores = new MSuscriptores_contactos;
			// DE NO RECIBIR PARAMETROS ESTA FUNCION TRAE EL LISTADO COMPLETO DE LIBROS
			$bon = "1";
			$RegistrosAMostrar = 12;
			if(isset($pag)){
					$RegistrosAEmpezar=($pag-1)*$RegistrosAMostrar;
					$PagAct=$pag;
				}else{
					$RegistrosAEmpezar=0;
					$PagAct=1;
				}	
			$query = $suscriptores->ListarSuscriptores_contactos("WHERE nombre like '%".$id."%'", "order by nombre", "limit $RegistrosAEmpezar, $RegistrosAMostrar");	    
			include(VIEWS.DS."suscriptores_contactos".DS."Listar.php");			
		}
		function BuscarXSuscriptor2($id, $pag = "1"){
			global $con;
			$arr = explode('|', $id);
			$suscriptores = new MSuscriptores_contactos;
			// DE NO RECIBIR PARAMETROS ESTA FUNCION TRAE EL LISTADO COMPLETO DE LIBROS
			$bon = "1";
			$RegistrosAMostrar = 12;
			if(isset($pag)){
					$RegistrosAEmpezar=($pag-1)*$RegistrosAMostrar;
					$PagAct=$pag;
				}else{
					$RegistrosAEmpezar=0;
					$PagAct=1;
				}	
			$where = " where 1=1 ";
			if($arr[0] != ''){
					$where .= " and (nombre like '%".$arr[0]."%' or identificacion like '%".$arr[0]."%' )";
				}
			if($arr[1] != ''){
					$where .= " and type = '".$arr[1]."' ";
				}
			if($arr[2] != ''){
					if($arr[2] == '1'){
							$where .= " and estado = '".$arr[2]."' ";
						}
					if($arr[2] == '0'){
							$where .= " and estado <> '1' ";
						}
				}
			$query = $suscriptores->ListarSuscriptores_contactos($where, "order by nombre", "limit $RegistrosAEmpezar, $RegistrosAMostrar");
			include(VIEWS.DS."suscriptores_contactos".DS."Listar.php");			
		}
		function CheckIfExists($id){
			global $con;
			$x = $con->Result($con->Query("select count(*) as t from suscriptores_contactos where identificacion = '".$id."'"), 0, 't');
			if ($x >= 1) {
					echo "false";
				}else{
					echo "true";
				}
		}


		function UnificarSuscriptor($susc,$suse){
			global $con;

			$con->Query("update gestion set suscriptor_id='$susc' where suscriptor_id='$suse'");
			$con->Query("update gestion_suscriptores set id_suscriptor='$susc' where id_suscriptor='$suse'");
			$con->Query("delete from  suscriptores_contactos_direccion where id_contacto='$suse'");
			$con->Query("delete from  suscriptores_contactos where id='$suse'");

		}




		function GetDependenciasSuscriptor($id){
			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL			
			global $con;
			global $c;
			global $f;
			//CARGANDO LA PAGINA DE INTERFAZ			
			$object = new MSuscriptores_Contactos;
	    	#$query = $object->ListarSuscriptores_modulos();
			$pagina = $this->load_template_limpia('Listar Dependencias del Suscriptor');			
			// CARGANDO LLAMANDO LA FUNCION LSITAR LIBROS DEL MODELO (FUNCION QUE TRAE DE LA BASE DE DATOS EL LISTADO DE LIBROS
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();
			// SI LA CONSULTA NO SE EJECUTA ENTONCES RETORNA VACIO
			// SI LA CONSULTA SE EJECUTA ENTONCES CARGA EL LISTADO DE LIBROS DE LA VISTA
	    	include(VIEWS.DS."suscriptores_contactos/dependencias.php");	   			
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

		function GetEstandarizar(){
			global $con;
			global $f;
			global $c;


			$q = $con->Query("Select * from suscriptores_contactos group by type");

			while ($row = $con->FetchAssoc($q)) {
				$scat  =  strtoupper(trim($row['type']));
				$scat_ref = "";
				if ($scat != '') {
					$scat_ref =  strtoupper($scat);
				}else{
					$scat = "SUSCRIPTOR SIN CLASIFICAR";
				}
				$con->Query("UPDATE suscriptores_contactos set type = '".$scat."' where type = '".$scat_ref."'");

				$es_web = ($scat == "Registro Externo")?"1":"0";

				$type = $c->GetDataFromTable("suscriptores_tipos", "nombre", $scat, "id", "");
				$byid = $c->GetDataFromTable("suscriptores_tipos", "id", $scat, "id", "");
				if ($type == "" && $byid == "") {
					echo "Categoria $scat no existe<br>";
					$con->Query("INSERT suscriptores_tipos (nombre, es_web) VALUES ('$scat', '$es_web')");
				#	$type = $c->GetMaxIdTabla("suscriptores_tipos", "id");

				}else{
					echo "Categoria $scat si existe<br>";
				}
				#;
			}

			$qx = $con->Query("select * from suscriptores_tipos");
			while ($r = $con->FetchAssoc($qx)) {
				$con->Query("UPDATE suscriptores_contactos set type = '".$r['id']."' where type = '".$r['nombre']."'");
			}

			$ext = $c->GetDataFromTable("suscriptores_tipos", "es_web", "1", "id", "");
			if ($ext == "") {
				$con->Query("INSERT suscriptores_tipos (nombre, es_web) VALUES ('REGISTRO EXTERNO', '1')");
			}

		}

		function CambiarStatusSuscriptor($id, $status){

			global $con;
			global $f;
			global $c;

			$con->Query("UPDATE suscriptores_contactos set type = '".$status."' where id = '".$id."'");

			#echo "UPDATE suscriptores_contactos set type = '".$status."' where id = '".$id."'";

			echo "Tipo de Suscriptor Cambiado";

		}
	}
?>