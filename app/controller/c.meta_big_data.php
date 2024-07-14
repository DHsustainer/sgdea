<?
session_start();
#error_reporting(E_ALL);
#ini_set('display_errors', '1');

	//Invocando archivos que seran usados en nuestro controlador generico	
	include_once('app/basePaths.inc.php');
	include_once(MODELS.DS.'Meta_big_dataM.php');
	include_once(MODELS.DS.'Meta_referencias_titulosM.php');
	include_once(MODELS.DS.'Meta_referencias_camposM.php');
	include_once(MODELS.DS.'Meta_tipos_elementosM.php');
	include_once(MODELS.DS.'Meta_listasM.php');
	include_once(MODELS.DS.'Meta_listas_valoresM.php');
	include_once(MODELS.DS.'GestionM.php');

	include_once(ROOT.DS.'DALC'.DS.'/mySql.php');
	include_once('consultas.php');
	include_once('funciones.php');	

	include_once(MODELS.DS.'DependenciasM.php');
	include_once(MODELS.DS.'Areas_dependenciasM.php');
	include_once(MODELS.DS.'CityM.php');
	include_once(MODELS.DS.'SeccionalesM.php');
	include_once(MODELS.DS.'Gestion_anexosM.php');
	include_once(MODELS.DS.'Events_gestionM.php');
	include_once(MODELS.DS.'Plantilla_dependenciaM.php');
	include_once(MODELS.DS.'UsuariosM.php');
	include_once(MODELS.DS.'Super_adminM.php');
	include_once(MODELS.DS.'Suscriptores_contactosM.php');
	include_once(MODELS.DS.'Documentos_gestion_permisosM.php');
	include_once(MODELS.DS.'Dependencias_permisos_documentoM.php');
	include_once(MODELS.DS.'AreasM.php');
	include_once(MODELS.DS.'Alertas_usuariosM.php');
	include_once(MODELS.DS.'Gestion_anexos_permisosM.php');
	include_once(MODELS.DS.'Gestion_anexos_firmasM.php');
	include_once(MODELS.DS.'Plantilla_documento_configuracionM.php');
	include_once(MODELS.DS.'Big_dataM.php');
	include_once(MODELS.DS.'Documentos_gestionM.php');
	include_once(MODELS.DS.'Dependencias_documentosM.php');
	include_once(MODELS.DS.'Dependencias_tipologiasM.php');
	include_once(MODELS.DS.'Documentos_gestion_permisosM.php');
	include_once(MODELS.DS.'Events_gestionM.php');
	include_once(MODELS.DS.'FolderM.php');
	include_once(MODELS.DS.'Gestion_compartirM.php');
	include_once(MODELS.DS.'Gestion_folderM.php');
	include_once(MODELS.DS.'Gestion_suscriptoresM.php');
	include_once(MODELS.DS.'ProvinceM.php');
	include_once(MODELS.DS.'Ref_tablesM.php');
	include_once(MODELS.DS.'Seccional_principalM.php');
	include_once(MODELS.DS.'SeccionalM.php');
	include_once(MODELS.DS.'Suscriptores_contactos_direccionM.php');
	##include_once(PLUGINS.DS.'PHPMailer_5.2.4/class.phpmailer.php');	
	include_once(PLUGINS.DS.'dompdf/dompdf_config.inc.php');
	include_once(PLUGINS.DS.'phpqrcode/qrlib.php');



	// Definiendo variables y conectandonos con la base de datos
	$con = new ConexionBaseDatos;
	$con->Connect($con);
	
	// Llamando al objeto a controlar		
	$ob = new CMeta_big_data;
	$c = new Consultas;
	$f = new Funciones;
	
	// DEFINIMOS EN UN VECTOR LOS CAMPOS QUE VAMOS A EDITAR
	$ar2 = array('valor', 'modif_usuario');
	// DEFINIMOS EN OTRO VECTOR LOS NUEVOS DATOS QUE VAMOS A METER	
	$ar1 = array($c->sql_quote($_REQUEST['valor']), '1');	
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
			$ob->VistaInsertar($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['cn']));
		// SINO SI ES INSERTAR ENTONCES CARGA EL INSERTAR	
		elseif($c->sql_quote($_REQUEST['action']) == 'registrar'){

			$ob->Insertar();

		}
		// SINO SI ES EDITAR ENTONCES CARGA EL FORMULARIO EDITAR	
		elseif($c->sql_quote($_REQUEST['action']) == 'ver')
			$ob->VistaEditar($c->sql_quote($_REQUEST['id']));	
		// SINO SI ES ACTUALIZAR ENTONCES ENVIA UNA ACTUALIZACION CON LOS PARAMETROS CAPTURADOS
		elseif($c->sql_quote($_REQUEST['action']) == 'actualizar')
			$ob->Editar($constrain, $ar2, $ar1, $output);
		// SINO SI ES ELIMINAR ENTONCES CARGA LA FUNCION ELIMINAR
		elseif($c->sql_quote($_REQUEST['action']) == 'eliminar')
			$ob->Eliminar($c->sql_quote($_REQUEST['id']));

		elseif($c->sql_quote($_REQUEST['action']) == 'carga')
			$ob->cargararchivo();
		elseif($c->sql_quote($_REQUEST['action']) == 'doform')
			$ob->DoForm($c->sql_quote($_REQUEST['id']));
		elseif($c->sql_quote($_REQUEST['action']) == 'upload'){


			$uploads_dir = ROOT."/plugins/meta_uploads/";

			$i = "";

			foreach ($_FILES["pictures"]["error"] as $key => $error) {
			    if ($error == UPLOAD_ERR_OK) {
			        $tmp_name = $_FILES["pictures"]["tmp_name"][$key];
			        $name = $_FILES["pictures"]["name"][$key];


			        $rand = md5(date('Y-m-d').rand().$_SESSION[usuario]);
					$ext = end(explode(".", $_FILES['pictures']['name'][$key]));
					$fname = $rand.".".$ext;


			        copy($tmp_name, $uploads_dir."/".$fname);
			        #move_uploaded_file($tmp_name, "$uploads_dir/$name");

					$i .= $fname.";";

					$con->Query("INSERT INTO meta_documentos (nombre, url, fecha) VALUES('$name','$fname', '".date("Y-m-d H:i:s")."')");
			    }
			}

			echo $i.";";
		

		}elseif($c->sql_quote($_REQUEST['action']) == 'buscar'){
			$ob->Buscar($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['cn']));		

		}elseif($c->sql_quote($_REQUEST['action']) == 'validarunique'){
			$ob->ValidarUnique($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['cn']));		
		}elseif($c->sql_quote($_REQUEST['action']) == 'validarcodigo'){
			$ob->ValidarCodigo($c->sql_quote($_REQUEST['id']));		

		}elseif($c->sql_quote($_REQUEST['action']) == 'exportar'){
			$ob->Exportar($c->sql_quote($_REQUEST['id']));		
		}elseif($c->sql_quote($_REQUEST['action']) == 'detdependencia'){
			$ob->GetDependencias($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['cn']));		
		}else
		// SI NO ES NINGUNA DE LAS ANTERIORES ENTONCES CARGA POR DEFECTO LA VISTA DE LISTADO		
			$ob->VistaListar('');		
	
	// DEFINIENDO LA CLASE DEL CONTROLADOR DEL OBJETO QUE TIENE HERENCIA CON EL CONTROLADOR GENERICO PARA CARGAR LA INTERFAZ
	class CMeta_big_data extends MainController{
		
		// DEFINIENDO LA FUNCION LISTAR 		
		function VistaListar(){
			// CREANDO UN NUEVO MODELO			
			$object = new MMeta_big_data;
			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL			
			global $con;
			//CARGANDO LA PAGINA DE INTERFAZ			
			$pagina = $this->load_template('Listar Meta_big_data');			
			// CARGANDO LLAMANDO LA FUNCION LSITAR LIBROS DEL MODELO (FUNCION QUE TRAE DE LA BASE DE DATOS EL LISTADO DE LIBROS
			// DE NO RECIBIR PARAMETROS ESTA FUNCION TRAE EL LISTADO COMPLETO DE LIBROS
			$query = $object->ListarMeta_big_data();	    
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();
				// SI LA CONSULTA NO SE EJECUTA ENTONCES RETORNA VACIO
		   		if($con->NumRows($query) <= 0 || $query !=''){
					// SI LA CONSULTA SE EJECUTA ENTONCES CARGA EL LISTADO DE LIBROS DE LA VISTA
					include_once(VIEWS.DS.'meta_big_data/Listar.php');	   			
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
		function VistaInsertar($ref_id, $type_id){
			global $con;
			global $f;
			global $c;

			include_once(VIEWS.DS.'meta_big_data/FormInsertMeta_big_data.php');				

		}
		// FUCNION QUE CARGA LA VISTA PARA EDITAR EL CONTENIDO DE UN REGISTRO
		function VistaEditar($x){
			global $con;
			global $c;
			global $f;
			// CARGA EL TEMPLATE			
	 		$pagina = $this->load_template_limpia('Editar Meta_big_data');			
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();	

			$grupo_id = $x;

			$gid = $con->Query("select type_id from meta_big_data where grupo_id = '".$grupo_id."'");
			$bgestion  = $con->FetchAssoc($gid);
			$object = new Mgestion;
			$object->CreateGestion("id", $bgestion['type_id']);

			$mayeditform = false;

			if ($_SESSION['user_ai'] == $object->GetNombre_destino() || $_SESSION['usuario'] == $object->GetUsuario_registra()) {
				$mayeditform = true;
			}else{

				$gc = new MGestion_compartir;
		        $qn = $gc->ListarGestion_compartir(" where usuario_nuevo = '".$_SESSION['usuario']."' and gestion_id = '".$object->GetId()."'");
	        	$com = $con->FetchAssoc($qn);
	        	
		        if ($com['type'] >= 1) {
		            $mayeditform = true;
		        }else{
		        	$mayeditform = false;
		        }
			}

			if ($object->GetEstado_archivo() != "1") {
				$mayeditform = false;
			}

	        if ($_SESSION['suscriptor_id'] != "") {
	        	$mayeditform = false;
	        }

			/*
	        $vista = "small";
			*/
			$nooptions = "1";
			echo "<div class='row' style='background-color:#FFF; padding:50px'><div class='col-md-12'>";
			include_once(VIEWS.DS."meta_big_data/FormUpdateMeta_big_data.php");
			echo "</div></div>";

			$table = ob_get_clean();	
			// ASIGNANDOLE A LA VARIABLE  EL CONTENIDO DEL BUFFER															
			$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $table  , $pagina);
			// CARGAMOS LA PAGINA EN EL BROWSER		
			$this->view_page($pagina);
	 	}	
	 	function Buscar($x, $cn = 'id'){
	 		// INVOCAMOS UN NUEVO OBJETO						
			$object = new MMeta_big_data;
			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL						
			global $con;
			// CARGA EL TEMPLATE						
			$pagina = $this->load_template('Listado de Meta_big_data');			
			// OBTENEMOS EL LISTADO DE LIBROS DE ACUERDO A LOS PARAMETROS QUE LE ENVIAMOS						
			$query = $object->ListarMeta_big_data('WHERE '.$cn.' = "'.$x.'"');	    
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();		
		   		if($con->NumRows($query) <= 0 || $query !=''){
					// SI LA CONSULTA NO SE EJECUTA ENTONCES RETORNA VACIO							
					include_once(VIEWS.DS.'meta_big_data/Listar.php');	   			
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
		function Insertar($type_id, $ref_id, $campo_id, $valor){
			// DEFINIENDO EL OBJETO			
			global $con;
			global $f;
			global $c;

			#$c->sql_quote($_REQUEST["type_id"]), $c->sql_quote($_REQUEST["ref_id"]), $c->sql_quote($_REQUEST["campo_id"]), $c->sql_quote($_REQUEST["valor"])
			$object = new MMeta_big_data;
			

			$id_form  = $c->sql_quote($_REQUEST["id_form"]);
			$id_suscriptor =  $c->sql_quote($_REQUEST["id_suscriptor"]);
			$grupo_id = $c->sql_quote($_REQUEST["grupo_id"]);
			
			$vector = array();
			foreach ($_REQUEST as $key => $value) {
				$recorte = substr($key, 0,2);
				$recorte2 = substr($key, 0,3);
				if($recorte == "C_") {
					$campo_id = substr($key, 4);

					switch ($recorte2) {
						case 'C_T':
							#echo "{$key} => {$value} (TEXTO)<br>";
							$val = $value;
							break;
						case 'C_C':
							#echo "{$key} => {$value} (CHECKBOX)<br>";
							$val = implode(", ", $value);
							break;
						case 'C_F':
							$val = $value;
							#echo "{$key} => {$value} (FILE) :: ";
							break;
						default:
							$val = $value;
							#echo "{$key} => {$value} (TEXTO)<br>";
							break;
					}
				 					 	
					#echo "Insertando => Type(S,F,M): $id_suscriptor - ref_id: $id_form - Campo: $campo_id - Valor: ".$val." - Grupo: $grupo_id";
					$object->InsertMeta_big_data($id_suscriptor, $id_form, $campo_id, $c->sql_quote($val), $grupo_id);
					
				}
			}
			header("Location: ".HOMEDIR."/suscriptores_contactos/dependencias/".$id_suscriptor."/");
			//echo "<script>window.location.href</script>";
			
		}
		// FUNCION QUE RECIBE UNASERIE DE PARAMETROS Y LOS ENVIA A LA BASE DE DATOS PARA ACTUALIZAR UN REGISTRO (FUNCION ESPECIAL)		
		function Editar($constrain, $fields, $updates, $output){
			$object = new MMeta_big_data;
			$create = $object->UpdateMeta_big_data($constrain, $fields, $updates, $output);
			
			echo $create;				
			
		}
		// FUCNION QUE RECIBE UN PARAMETRO Y ELIMINA EL REGISTRO DE LA BASE DE DATOS		
		function Eliminar($id){
			global $con;
			if ($_SESSION['eliminar_formulario']) {
				# code...
				// DEFINIMOS LA CONSULTA
				$q_str= 'delete from meta_big_data where grupo_id = "'.$id.'"';
				// EJECUTAMOS LA CONSULTA
				$query = $con->Query($q_str); 
				//SI NO SE ENVIO CORRECTAMENTE ENTONCES GENERA ERROR SINO ENVIA OK
				echo 'Eliminado!';			
			}else{
				echo "No tiene Permisos para eliminar el formulario";
			}
			
		}

		function cargararchivo(){
			echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Upload de Archivos</title>
</head>
<!--AUTOR: SANDER CADENA -->
<body>
   
      <form action="/meta_big_data/upload/" method="post" enctype="multipart/form-data">
        <input name="archivo" type="file" size="35"/><br />
        <input name="mytext" type="text" value="Archivo nuevo" /><br />
        <input name="enviar" type="submit" value="Cargar Archivo" /><br />
        <input name="action" type="hidden" value="upload" />     
   
      </form>


</body>
</html>
';
		}

		function DoForm($tipo_documento){
			global $con;
			global $f;
			global $c;

			$_SESSION['ssubid'] = $c->sql_quote($_REQUEST['cn']);
#			echo $tipo_documento;

			$con->Query("delete from meta_big_data where grupo_id = '".$_SESSION['smallid']."'");
//			$con->Query("delete from gestion_anexos where id_servicio = '".$_SESSION['smallid']."'");

#			echo "delete from gestion_anexos where id_servicio = '".$_SESSION['smallid']."'";

			$condocs = $con->Query("select id from meta_referencias_titulos where id_s = '$tipo_documento' and tipo = '1' and es_generico = '1'");
			$idref = $con->FetchAssoc($condocs);
			#echo $idref['id'];
			#echo "select id from meta_referencias_titulos where id_s = '$tipo_documento' and tipo = '1' and es_generico = '1'";

			if ($idref > 0) {
				$checkInsert = $con->Query("select * from meta_referencias_campos where id_referencia = '".$idref['id']."'");
				while ($rrrx = $con->FetchAssoc($checkInsert)) {
					$val = "";
					$con->Query("INSERT INTO meta_big_data (type_id, ref_id, campo_id, valor, grupo_id, tipo_form, fecha_registro, orden) VALUES ('0', '".$idref['id']."', '".$rrrx['id']."', '".$val."', '".$_SESSION['smallid']."', '1', '".date("Y-m-d")."', '".$rrrx['orden']."')");
				}
				$grupo_id = $_SESSION['smallid'];

				$gid = $con->Query("select type_id from meta_big_data where grupo_id = '".$grupo_id."'");
#				echo "select type_id from meta_big_data where grupo_id = '".$grupo_id."'";
				$bgestion  = $con->FetchAssoc($gid);

				$object = new Mgestion;
				$object->CreateGestion("id", $bgestion['type_id']);

				$mayeditform = true;
				#echo "select * from dependencias_tipologias where id_dependencia = '".$tipo_documento."' and es_obligatorio = '1' and estado = '1'";
				include_once(VIEWS.DS."meta_big_data/FormUpdatePublicMeta_big_data.php");


				$elem = $con->Query("select * from dependencias_tipologias where id_dependencia = '".$tipo_documento."' and es_obligatorio = '1' and estado = '1'");

				while ($row = $con->FetchAssoc($elem)) {
					
					$dogc = new MDependencias_tipologias;
					$dogc->CreateDependencias_Tipologias("id", $row['id']);

					$an = new MGestion_anexos;
					$in_out = $c->GetDataFromTable("dependencias_tipologias", "id", $dogc->GetTipologia(), "es_entrada", "");
					$in_out = ($in_out == "0")?"-1":"1";

					$exs = $con->Query("select count(*) as t from gestion_anexos where tipologia = '".$dogc->GetId()."' and id_servicio = '$grupo_id'");
					$tt = $con->Result($exs, 0, 't');

					if ($tt == "0") {
						$an->InsertGestion_anexos("0", $dogc->GetTipologia(), "", $_SESSION['usuario'], date("Y-m-d"), date("H:i:s"), $_SERVER['REMOTE_ADDR'], "", "1", "0", "0", "1", $dogc->GetId(), $in_out, $grupo_id, "2");
					}
					

				}

				

			}else{

				$elem = $con->Query("select * from dependencias_tipologias where id_dependencia = '".$tipo_documento."' and es_obligatorio = '1' and estado = '1'");

				$grupo_id = $_SESSION['smallid'];

				while ($row = $con->FetchAssoc($elem)) {
					
					$dogc = new MDependencias_tipologias;
					$dogc->CreateDependencias_Tipologias("id", $row['id']);

					$an = new MGestion_anexos;
					$in_out = $c->GetDataFromTable("dependencias_tipologias", "id", $dogc->GetTipologia(), "es_entrada", "");
					$in_out = ($in_out == "0")?"-1":"1";

					$exs = $con->Query("select count(*) as t from gestion_anexos where tipologia = '".$dogc->GetId()."' and id_servicio = '$grupo_id'");
					$tt = $con->Result($exs, 0, 't');

					if ($tt == "0") {
						$an->InsertGestion_anexos("0", $dogc->GetTipologia(), "", $_SESSION['usuario'], date("Y-m-d"), date("H:i:s"), $_SERVER['REMOTE_ADDR'], "", "1", "0", "0", "1", $dogc->GetId(), $in_out, $grupo_id, "2");
					}
					

				}
				echo "No hay formulario";
			}

		}

		function Exportar($grupo_id){
			global $c;
			global $f;
			global $con;

			$db = new MMeta_big_data;
			$metacampos = new MMeta_referencias_campos;
			$form = new MMeta_referencias_titulos;

			$db->CreateMeta_big_data("grupo_id", $grupo_id);
			
			$id_exp = $db->GetType_id();
			$id_form = $db->GetRef_id();

			$form->CReateMeta_referencias_titulos("id", $id_form);

			$querymdb = $db->ListarMeta_big_data("WHERE grupo_id = '".$grupo_id."'");

			$html = '<div style="width:100% !important">';
			while($rowmbd = $con->FetchAssoc($querymdb)){
				
				$object = new MMeta_big_data;
				$object->CreateMeta_big_data("id", $rowmbd['id']);
				$l = new MMeta_referencias_campos;
				$l->CreateMeta_referencias_campos("id", $rowmbd['campo_id']);

				$titulo = "";
				$campo = "";
				$columnas = "12";

				switch ($l->GetTipo_elemento()) {
					case '7':
						$titulo = "<label for='elm".$l->GetId()."'>".$l->GetTitulo_campo()."</label>";
						$columnas = $l->GetColumnas();
						$campo .= '	<ul>';
						$ima = explode(";", $object->GetValor());
						for ($i=0; $i < count($ima) ; $i++) { 
							if (trim($ima[$i]) != "") {

								$nom = $c->GetDataFromTable('meta_documentos', 'url', $ima[$i], 'nombre', " ");
								$URL = HOMEDIR.DS.'app/plugins/meta_uploads/'.$ima[$i];
								$campo .= ' <li><a href="'.$URL.'" target="_blank" style="color:#FB8902">'.$nom.'</a></li>';
							}
						}
						$campo .= '	</ul>';
						break;
					case '12':
						$lista = new MMeta_Listas_valores;
						$ql = $lista->ListarMeta_listas_valores("where id_lista = '".$l->GetId_lista()."'");
						$value= explode(",", $object->GetValor());
						$options = "";
						while ($rowb = $con->FetchAssoc($ql)) {
							if (in_array(trim($rowb['titulo']), $value)) {
								$options .= $rowb['titulo'].", ";
							}
						}
						$titulo = "<label for='elm".$l->GetId()."'>".$l->GetTitulo_campo()."</label> ";
						$columnas = $l->GetColumnas();
						$campo =  $options;
						break;
					case '13':
						$titulo = "";
						$columnas = 12;
						$campo =  "<hr style='width:100%'>";
						break;
					default:
						$titulo = "<label for='elm".$l->GetId()."'>".$l->GetTitulo_campo()."</label> ";
						$columnas = $l->GetColumnas();
						$campo = $object->GetValor();
						break;
				}
				$colx = "";
				switch ($columnas) {

				case '1':  $colx = "font-size:18px; padding-right: 15px; padding-left: 15px; width: 8.33333333% !important;"; break;
				case '2':  $colx = "font-size:18px; padding-right: 15px; padding-left: 15px; width: 16.66666667%; !important;"; break;
				case '3':  $colx = "font-size:18px; padding-right: 15px; padding-left: 15px; width: 25% !important;"; break;
				case '4':  $colx = "font-size:18px; padding-right: 15px; padding-left: 15px; width: 33.33333333% !important;"; break;
				case '5':  $colx = "font-size:18px; padding-right: 15px; padding-left: 15px; width: 41.66666667% !important;"; break;
				case '6':  $colx = "font-size:18px; padding-right: 15px; padding-left: 15px; width: 50% !important;"; break;
				case '7':  $colx = "font-size:18px; padding-right: 15px; padding-left: 15px; width: 58.33333333% !important;"; break;
				case '8':  $colx = "font-size:18px; padding-right: 15px; padding-left: 15px; width: 66.66666667% !important;"; break;
				case '9':  $colx = "font-size:18px; padding-right: 15px; padding-left: 15px; width: 75% !important;"; break;
				case '10': $colx = "font-size:18px; padding-right: 15px; padding-left: 15px; width: 83.33333333% !important;"; break;
				case '11': $colx = "font-size:18px; padding-right: 15px; padding-left: 15px; width: 91.66666667% !important;"; break;
				case '12': $colx = "font-size:18px; padding-right: 15px; padding-left: 15px; width: 100% !important;"; break;
				default:   $colx = "font-size:18px; padding-right: 15px; padding-left: 15px; width: 100% !important;"; break;
				}

				$html .= '  <div style="'.$colx.'">
								<b>'.$titulo.'</b><br><span style="padding-left:20px">'.$campo .'</span>
							</div>
							';
			}
			$html .= '</div>';

			$f->PlantillaDocumento($html, $form->GetTitulo(), $id_exp );
		}

		function GetDependencias($valor, $listap){
			global $con;
			global $f;
			global $c;
			
			$listado = $con->Query("select * from meta_listas_valores where id_lista = '$listap' and dependencia = '$valor'");

			while($row = $con->FetchAssoc($listado)){
				echo "<option value='".$row['valor']."'>".$row['titulo']."</option>";
			}
		}

		function ValidarUnique($id, $cn){
			global $con;
			#echo "select * from meta_big_data where campo_id = '".$id."' and valor = '".$cn."'";
			$sel = $con->Query("select * from meta_big_data where campo_id = '".$id."' and valor = '".$cn."'  and grupo_id != '".$_SESSION['smallid']."'");
			$selt = $con->NumRows($sel);
			if ($selt >= 1) {
				echo "0";
			}else{
				echo "1";
			}
			
		}

		function ValidarCodigo($id){
			global $con;
			#echo "select * from meta_big_data where campo_id = '".$id."' and valor = '".$cn."'";
			#echo "select * from suscriptores_contactos where codigo_niu = '".$id."'";
			#if ($_SESSION['counter'] < 1000) {

				$sel = $con->Query("select * from suscriptores_contactos where codigo_niu = '".$id."'");
				$selt = $con->NumRows($sel);
				$ro = $con->FetchAssoc($sel);

				if ($selt > 0) {
					echo "1";
					$_SESSION['suscriptor_id'] = $ro['id'];
				}else{
					echo "0";
					$_SESSION['counter'] += $_SESSION['counter'] + 1;
				}
			#}else{
			#	echo "5";
			#}
		}
	}
?>