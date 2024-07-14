<?
session_start();
#error_reporting(E_ALL);
#ini_set('display_errors', '1');

	//Invocando archivos que seran usados en nuestro controlador generico	
	include_once('app/basePaths.inc.php');
	include_once(MODELS.DS.'Meta_referencias_titulosM.php');
	include_once(MODELS.DS.'Meta_referencias_camposM.php');
	include_once(MODELS.DS.'Meta_tipos_elementosM.php');
	include_once(MODELS.DS.'Suscriptores_tiposM.php');
	include_once(MODELS.DS.'Meta_listasM.php');
	include_once(PLUGINS.DS.'PHPExcel.php');
	include_once(ROOT.DS.'DALC'.DS.'/mySql.php');
	include_once('consultas.php');
	include_once('funciones.php');	

	// Definiendo variables y conectandonos con la base de datos
	$con = new ConexionBaseDatos;
	$con->Connect($con);
	
	// Llamando al objeto a controlar		
	$ob = new CMeta_referencias_titulos;
	$c = new Consultas;
	$f = new Funciones;
	
	// DEFINIMOS EN UN VECTOR LOS CAMPOS QUE VAMOS A EDITAR
	$ar2 = array('titulo');
	// DEFINIMOS EN OTRO VECTOR LOS NUEVOS DATOS QUE VAMOS A METER	
	$ar1 = array($c->sql_quote($_REQUEST['titulo']));	
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
			$ob->Insertar($c->sql_quote($_REQUEST["titulo"]), $c->sql_quote($_REQUEST["tipo"]), $c->sql_quote($_REQUEST["es_generico"]), $c->sql_quote($_REQUEST["id_s"]));
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
		elseif($c->sql_quote($_REQUEST['action']) == 'GetListado')
			$ob->GetListado($c->sql_quote($_REQUEST['id']));
		elseif($c->sql_quote($_REQUEST['action']) == 'dependencia')
			$ob->VistaListar2($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['cn']));
		elseif($c->sql_quote($_REQUEST['action']) == 'descarga')
			$ob->DescargarFormato($c->sql_quote($_REQUEST['id']));
		elseif($c->sql_quote($_REQUEST['action']) == 'Listadodependencia')
			$ob->GetListadoDependencia($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['cn']));
		elseif($c->sql_quote($_REQUEST['action']) == 'setrfs')
			$ob->SetRefSuscrpitor($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['cn']));
		else
		// SI NO ES NINGUNA DE LAS ANTERIORES ENTONCES CARGA POR DEFECTO LA VISTA DE LISTADO		
			$ob->VistaListar('');		
	
	// DEFINIENDO LA CLASE DEL CONTROLADOR DEL OBJETO QUE TIENE HERENCIA CON EL CONTROLADOR GENERICO PARA CARGAR LA INTERFAZ
	class CMeta_referencias_titulos extends MainController{
		
		// DEFINIENDO LA FUNCION LISTAR 		
		function VistaListar(){
			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL			
			global $con;
			// CREANDO UN NUEVO MODELO			
			$object = new MMeta_referencias_titulos;
			// DE NO RECIBIR PARAMETROS ESTA FUNCION TRAE EL LISTADO COMPLETO DE LIBROS
			$query = $object->ListarMeta_referencias_titulos();	    
	   		#if($con->NumRows($query) <= 0 || $query !=''){
			include_once(VIEWS.DS.'meta_referencias_titulos/index.php');	   			
		}

		function GetListado($id){
			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL			
			global $con;
			// CREANDO UN NUEVO MODELO			
			$object = new MMeta_referencias_titulos;
			// DE NO RECIBIR PARAMETROS ESTA FUNCION TRAE EL LISTADO COMPLETO DE LIBROS
			$path  = ($id != "0")?"WHERE tipo='".$id."'":"";

			$query = $object->ListarMeta_referencias_titulos($path);	    

	   		#if($con->NumRows($query) <= 0 || $query !=''){
			include_once(VIEWS.DS.'meta_referencias_titulos/Listar.php');
		}

		function VistaListar2($id, $tipo = ""){
			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL			
			global $con;
			// CREANDO UN NUEVO MODELO			
			$object = new MMeta_referencias_titulos;
			// DE NO RECIBIR PARAMETROS ESTA FUNCION TRAE EL LISTADO COMPLETO DE LIBROS
			$query = $object->ListarMeta_referencias_titulos();	    
	   		#if($con->NumRows($query) <= 0 || $query !=''){
			if ($tipo == "form") {
				include_once(VIEWS.DS.'meta_referencias_titulos/index3.php');	   			
			}else{
				include_once(VIEWS.DS.'meta_referencias_titulos/index2.php');	   			
			}
		}

		function GetListadoDependencia($id, $tipo = "2"){
			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL			
			global $con;
			// CREANDO UN NUEVO MODELO			
			$object = new MMeta_referencias_titulos;
			// DE NO RECIBIR PARAMETROS ESTA FUNCION TRAE EL LISTADO COMPLETO DE LIBROS

			$path  = "WHERE tipo='".$tipo."' and id_s = '".$id."'";
			$query = $object->ListarMeta_referencias_titulos($path);	    

	   		#if($con->NumRows($query) <= 0 || $query !=''){
			include_once(VIEWS.DS.'meta_referencias_titulos/Listar.php');
		}
		
		// FUNCION QUE CARGA LA VISTA DE INSERTAR (FORMULARIO DE INSERTAR)
		function VistaInsertar(){
			
			global $con;

			include_once(VIEWS.DS.'meta_referencias_titulos/FormInsertMeta_referencias_titulos.php');				
			
		}
		// FUCNION QUE CARGA LA VISTA PARA EDITAR EL CONTENIDO DE UN REGISTRO
		function VistaEditar($x){
			global $con;

		 	$object = new MMeta_referencias_titulos;
			// LO CREAMOS 			
			$object->CreateMeta_referencias_titulos('id', $x);
			// Y FINALMENTE CARGAMOS LA VISTA DE EDICION QUE MUESTRA EL CONTENIDO			
			include_once(VIEWS.DS.'meta_referencias_titulos/FormUpdateMeta_referencias_titulos.php');		

	 	}	
	 	function Buscar($x, $cn = 'id'){
	 		// INVOCAMOS UN NUEVO OBJETO						
			$object = new MMeta_referencias_titulos;
			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL						
			global $con;
			// CARGA EL TEMPLATE						
			$pagina = $this->load_template('Listado de Meta_referencias_titulos');			
			// OBTENEMOS EL LISTADO DE LIBROS DE ACUERDO A LOS PARAMETROS QUE LE ENVIAMOS						
			$query = $object->ListarMeta_referencias_titulos('WHERE '.$cn.' = "'.$x.'"');	    
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();		
		   		if($con->NumRows($query) <= 0 || $query !=''){
					// SI LA CONSULTA NO SE EJECUTA ENTONCES RETORNA VACIO							
					include_once(VIEWS.DS.'meta_referencias_titulos/Listar.php');	   			
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
		function Insertar($titulo, $tipo, $es_generico, $id_s){
			// DEFINIENDO EL OBJETO			
			$object = new MMeta_referencias_titulos;

			// USANDO LA FUNCION DE INSERTAR DEL OBJETO PARA ENVIAR LA INFORMACION A LA BASE DE DATOA			
			$create = $object->InsertMeta_referencias_titulos($titulo, $tipo, $es_generico, $id_s);
			
			if ($id_s == "0") {
				echo "Registro Exitoso";
			}else{
				echo "Registro exitoso 2";
			}

		}
		// FUNCION QUE RECIBE UNASERIE DE PARAMETROS Y LOS ENVIA A LA BASE DE DATOS PARA ACTUALIZAR UN REGISTRO (FUNCION ESPECIAL)		
		function Editar($constrain, $fields, $updates, $output){
			$object = new MMeta_referencias_titulos;
			$create = $object->UpdateMeta_referencias_titulos($constrain, $fields, $updates, $output);
			
			//SI NO SE ENVIO CORRECTAMENTE ENTONCES GENERA ERROR SINO ENVIA OK
			if($create != '1')
				$this->VistaListar('ERROR AL REGISTRAR');
			else
				$this->VistaListar('OK!');						
			
		}
		// FUCNION QUE RECIBE UN PARAMETRO Y ELIMINA EL REGISTRO DE LA BASE DE DATOS		
		function Eliminar($id){
			// DEFINIMOS UN OBJETO NUEVO						
			$object = new MMeta_referencias_titulos;
			// LLAMAMOS A LA FUNCION QUE EJECUTA LA ELIMINACION.			
			$delete = $object->DeleteMeta_referencias_titulos($id); 		
			//SI NO SE ENVIO CORRECTAMENTE ENTONCES GENERA ERROR SINO ENVIA OK
			if($delete != '1')
				echo 'ERROR AL ELIMINAR';
			else
				echo 'OK!';			
			
		}

		function SetRefSuscrpitor($id_ref, $t_suscriptor){
			global $con;
			global $f;
			global $c;

			echo "Ref: $id_ref T_Sus: $t_suscriptor ";

			$check = $con->Query("select count(*) as t from meta_titulos_suscriptores where id_referencia = '".$id_ref."' and tipo_suscriptor = '".$t_suscriptor."'");
			$dat = $con->Result($check, 0, 't');
			
			if ($dat >= "1") {
				$con->Query("delete from meta_titulos_suscriptores where id_referencia = '".$id_ref."' and tipo_suscriptor = '".$t_suscriptor."'");
			}else{
				$con->Query("insert into meta_titulos_suscriptores (id_referencia, tipo_suscriptor) values ('".$id_ref."', '".$t_suscriptor."')");
			}
		}

		function DescargarFormato($id){
			global $con;
			global $f;
			global $c;

			$idref = $id;

			$form = new MMeta_referencias_titulos;
			$form->CreateMeta_referencias_titulos("id", $idref);
			$titulo = str_replace(" ", "_", $form->GetTitulo()).".xlsx";

			// Crea un nuevo objeto PHPExcel
			$objPHPExcel = new PHPExcel();

			// Establecer propiedades
			$objPHPExcel->getProperties()
			->setCreator(PROJECTNAME)
			->setLastModifiedBy($_SESSION['USUARIO'])
			->setTitle($form->GetTitulo())
			->setSubject($form->GetTitulo())
			->setDescription($form->GetTitulo()." Generado por ".PROJECTNAME)
			->setKeywords($form->GetTitulo())
			->setCategory($form->GetTitulo());
			$ar = array("1" => "A", "2" => "B", "3" => "C", "4" => "D", "5" => "E", "6" => "F", "7" => "G", "8" => "H", 
						"9" => "I", "10" => "J", "11" => "K", "12" => "L", "13" => "M", "14" => "N", "15" => "O", "16" => "P", 
						"17" => "Q", "18" => "R", "19" => "S", "20" => "T", "21" => "U", "22" => "V", "23" => "W", 
						"24" => "X", "25" => "Y", "26" => "Z");
			
			$checkInsert = $con->Query("select * from meta_referencias_campos where id_referencia = '".$idref."' and visible = '0' and tipo_elemento not in (13, 14, 15) order by orden");

			$i = 0;
			#$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', "IDENTIFICACION_EMPLEADO");
            #$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A2', "Escriba numero de identificacion del suscriptor");
			while($row = $con->FetchAssoc($checkInsert)){
				$i++;
				$l = new MMeta_referencias_campos;
				$l->CreateMeta_referencias_campos("id", $row['id']);

				$mint = strtolower($l->GetTitulo_campo());
				$b=array(" ", "\'","'","&OACUTE",",",";","&OACUTE","&oacute","&Oacute","&eacute","&Eacute","&EACUTE","&AACUTE","&Aacute","&Eacute","&ntilde","&Iacute","&QUOT;","&quot;","&#8216;","&8216;","º",'Ã','Á','á','É','é','Í','í','Ó','ó','Ñ','ñ','Ú','ú','ü','Ü','"',"'","`","´","‘","’","“","”","„","&NTILDE","&iacute","Ã","ƒ","˜","â","€","&#8216;", "\t", "\n", ".");

				$c=array("_", "", "" ,"o" ,"" ,"" ,"o","o","o","e","e","e","a","a","e","n","i","","","","","","","a","a","e","e","i","i","o","o","n","n","u","u","u","u",'',"",'',"","","","","",",","n","i","","","","","","","","","");
				
				$slug=str_replace($b,$c,$mint);
				$slug = strtoupper($slug);

				$con->Query("UPDATE meta_referencias_campos set slug = '$slug' where id = '".$l->GetId()."'");

				// Agregar Informacion
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($ar[$i].'1', $slug);
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue($ar[$i].'2', $l->GetObservacion());
			}
			$t = $i+1;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($ar[$t].'1', "ANEXOS");
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue($ar[$t].'2', "Coloque el nombre del archivo a cargar incluyendo la extensión Ej: 18922101.pdf");

			// Renombrar Hoja
			$objPHPExcel->getActiveSheet()->setTitle("Hoja 1");
			// Establecer la hoja activa, para que cuando se abra el documento se muestre primero.
			$objPHPExcel->setActiveSheetIndex(0);

			// Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.
			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header('Content-Disposition: attachment;filename="'.$titulo.'"');
			header('Cache-Control: max-age=0');
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
			$objWriter->save('php://output');

		}
	}
?>