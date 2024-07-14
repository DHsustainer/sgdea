<?
session_start();
#error_reporting(E_ALL);
#ini_set('display_errors', '1');

	//Invocando archivos que seran usados en nuestro controlador generico	

	include_once('app/basePaths.inc.php');

	include_once(MODELS.DS.'Gestion_tipologias_big_dataM.php');

	include_once(MODELS.DS.'Dependencias_tipologias_referenciasM.php');

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

	include_once(MODELS.DS.'Gestion_anexos_firmasM.php');



	require_once(PLUGINS.DS.'tcpdf/tcpdf.php');

	require_once(PLUGINS.DS.'FPDI/fpdi.php');

	

	include_once(MODELS.DS.'Mailer_messageM.php');

	include_once(MODELS.DS.'Mailer_attachmentsM.php');

	include_once(MODELS.DS.'Mailer_from_messageM.php');

	include_once(MODELS.DS.'Mailer_replysM.php');



	include_once(MODELS.DS.'NotificacionesM.php');



	include_once(MODELS.DS.'Gestion_anexosM.php');

	include_once(MODELS.DS.'Gestion_anexos_permisosM.php');

	include_once(MODELS.DS.'Gestion_compartirM.php');

	include_once(MODELS.DS.'Gestion_folderM.php');

	include_once(MODELS.DS.'Gestion_suscriptoresM.php');

	include_once(MODELS.DS.'ProvinceM.php');

	include_once(MODELS.DS.'Ref_tablesM.php');

	include_once(MODELS.DS.'Seccional_principalM.php');

	include_once(MODELS.DS.'SeccionalM.php');

	include_once(MODELS.DS.'Super_adminM.php');

	include_once(MODELS.DS.'Suscriptores_contactosM.php');

	include_once(MODELS.DS.'Suscriptores_contactos_direccionM.php');

	include_once(MODELS.DS.'UsuariosM.php');



	include_once(PLUGINS.DS.'nusoap/nusoap.php');



	include_once(ROOT.DS.'DALC'.DS.'/mySql.php');

	include_once('consultas.php');

	include_once('funciones.php');	



	// Definiendo variables y conectandonos con la base de datos

	$con = new ConexionBaseDatos;

	$con->Connect($con);

	

	// Llamando al objeto a controlar		

	$ob = new CGestion_anexos;

	$c = new Consultas;

	$f = new Funciones;

	

	// DEFINIMOS EN UN VECTOR LOS CAMPOS QUE VAMOS A EDITAR

	$ar2 = array('gestion_id', 'nombre', 'url', 'user_id', 'fecha', 'hora', 'ip', 'timest', 'estado', 'folio');

	// DEFINIMOS EN OTRO VECTOR LOS NUEVOS DATOS QUE VAMOS A METER	

	$ar1 = array($c->sql_quote($_REQUEST['gestion_id']), $c->sql_quote($_REQUEST['nombre']), $c->sql_quote($_REQUEST['url']), $c->sql_quote($_REQUEST['user_id']), $c->sql_quote($_REQUEST['fecha']), $c->sql_quote($_REQUEST['hora']), $c->sql_quote($_REQUEST['ip']), $c->sql_quote($_REQUEST['timest']), $c->sql_quote($_REQUEST['estado']), $c->sql_quote($_REQUEST['folio']));	

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

			$ob->INSERTAR($c->sql_quote($_REQUEST["gestion_id"]), $c->sql_quote($_REQUEST["nombre"]), $c->sql_quote($_REQUEST["url"]), $c->sql_quote($_REQUEST["user_id"]), $c->sql_quote($_REQUEST["fecha"]), $c->sql_quote($_REQUEST["hora"]), $c->sql_quote($_REQUEST["ip"]), $c->sql_quote($_REQUEST["timest"]), $c->sql_quote($_REQUEST["estado"]), $c->sql_quote($_REQUEST["folio"]));

		// SINO SI ES EDITAR ENTONCES CARGA EL FORMULARIO EDITAR	

		elseif($c->sql_quote($_REQUEST['action']) == 'editar')

			$ob->VistaEditar($c->sql_quote($_REQUEST['id']));	

		// SINO SI ES ACTUALIZAR ENTONCES ENVIA UNA ACTUALIZACION CON LOS PARAMETROS CAPTURADOS

		elseif($c->sql_quote($_REQUEST['action']) == 'actualizar'){

			$ar2 = array('nombre', 'folder_id');

			// DEFINIMOS EN OTRO VECTOR LOS NUEVOS DATOS QUE VAMOS A METER	

			$ar1 = array($c->sql_quote($_REQUEST['nombre']), $c->sql_quote($_REQUEST['folder_id']));	

			// DEFINIMOS LOS ESTADOS DE SALIDA

			$output = array('registro actualizado', 'no se pudo actualizar'); 

			// Y POR ULTIMO DEFINIMOS EL CONTRAIN PARA LA ACTUALIZACION	

			$constrain = 'WHERE id = '.$_REQUEST['id'];



			$ob->EditarDatosBasicos($constrain, $ar2, $ar1, $output, $_REQUEST['id']);



		}

			#$ob->Editar($constrain, $ar2, $ar1, $output);

		// SINO SI ES ELIMINAR ENTONCES CARGA LA FUNCION ELIMINAR

		elseif($c->sql_quote($_REQUEST['action']) == 'eliminar')

			$ob->Eliminar($c->sql_quote($_REQUEST['id']));

		// SINO SI ES NUEVO BUSCAR CARGA EL BUSCADOR			

		elseif($c->sql_quote($_REQUEST['action']) == 'buscar')

			$ob->Buscar($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['cn']));		

		elseif($c->sql_quote($_REQUEST['action']) == 'cargar')

			$ob->CargarAnexos();

		elseif($c->sql_quote($_REQUEST['action']) == 'updatephoto')

			$ob->UpdatePhoto($c->sql_quote($_REQUEST['id']));		

		elseif($c->sql_quote($_REQUEST['action']) == 'actualizartipologia')

			$ob->UpdateTipologia($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['cn']));		

		elseif($c->sql_quote($_REQUEST['action']) == 'actualizarpublic')

			$ob->UpdateIsPublic($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['cn']));		

		elseif($c->sql_quote($_REQUEST['action']) == 'actualizarInOut')

			$ob->ActualizarInOut($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['cn']), $c->sql_quote($_REQUEST['p1']));		

		elseif($c->sql_quote($_REQUEST['action']) == 'GetAnexosCarpeta')

			$ob->GetAnexosCarpeta($c->sql_quote($_REQUEST['dtf']));

		elseif($c->sql_quote($_REQUEST['action']) == 'vermetadatos')

			$ob->VerMetaDatos($c->sql_quote($_REQUEST['id']));



		

		elseif($c->sql_quote($_REQUEST['action']) == 'UpdateFolios')

			$ob->UpdateFolios($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['cn']), $c->sql_quote($_REQUEST['p1']));		

		elseif($c->sql_quote($_REQUEST['action']) == 'organizar_orden')

			$ob->UpdateOrden($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['orden']), $c->sql_quote($_REQUEST['act']), $c->sql_quote($_REQUEST['folder']));		

		elseif($c->sql_quote($_REQUEST['action']) == 'buscador')

			$ob->BuscarAnexos($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['cn']));		

		elseif($c->sql_quote($_REQUEST['action']) == 'organizar_folio')

			$ob->OrganizarFolio($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['from']), $c->sql_quote($_REQUEST['to']), $c->sql_quote($_REQUEST['total']));

		elseif($c->sql_quote($_REQUEST['action']) == "compartir")

			$ob->CompartirDocumento($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['cn']));		

		elseif($c->sql_quote($_REQUEST['action']) == "ChangeStatusDoc")

			$ob->EliminarDocumento();

		elseif($c->sql_quote($_REQUEST['action']) == "eliminardocumentos")

			$ob->EliminarDocumentos();

		elseif($c->sql_quote($_REQUEST['action']) == "descargarfullexpediente")
			$ob->DescargarFullExpediente($c->sql_quote($_REQUEST['id']));
		else

		// SI NO ES NINGUNA DE LAS ANTERIORES ENTONCES CARGA POR DEFECTO LA VISTA DE LISTADO		

			$ob->VistaListar('');		

	

	// DEFINIENDO LA CLASE DEL CONTROLADOR DEL OBJETO QUE TIENE HERENCIA CON EL CONTROLADOR GENERICO PARA CARGAR LA INTERFAZ

	class CGestion_anexos extends MainController{

		

		// DEFINIENDO LA FUNCION LISTAR 		

		function VistaListar(){

			// CREANDO UN NUEVO MODELO			

			$object = new MGestion_anexos;

			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL			

			global $con;

			//CARGANDO LA PAGINA DE INTERFAZ			

			$pagina = $this->load_template('Listar Gestion_anexos');			

			// CARGANDO LLAMANDO LA FUNCION LSITAR LIBROS DEL MODELO (FUNCION QUE TRAE DE LA BASE DE DATOS EL LISTADO DE LIBROS

			// DE NO RECIBIR PARAMETROS ESTA FUNCION TRAE EL LISTADO COMPLETO DE LIBROS

			$query = $object->ListarGestion_anexos();	    

			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.

			ob_start();

				// SI LA CONSULTA NO SE EJECUTA ENTONCES RETORNA VACIO

		   		if($con->NumRows($query) <= 0 || $query !=''){

					// SI LA CONSULTA SE EJECUTA ENTONCES CARGA EL LISTADO DE LIBROS DE LA VISTA

					include_once(VIEWS.DS.'gestion_anexos/Listar.php');	   			

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

			$pagina = $this->load_template('Crear Gestion_anexos');			

			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.

			ob_start();

			include_once(VIEWS.DS.'gestion_anexos/FormInsertGestion_anexos.php');				

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

	 		$pagina = $this->load_template('Editar Gestion_anexos');			

			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.

			ob_start();		

	 		// INVOCAMOS UN NUEVO OBJETO

		 	$object = new MGestion_anexos;

			// LO CREAMOS 			

			$object->CreateGestion_anexos('id', $x);

			// Y FINALMENTE CARGAMOS LA VISTA DE EDICION QUE MUESTRA EL CONTENIDO			

			include_once(VIEWS.DS.'gestion_anexos/FormUpdateGestion_anexos.php');		

			// OBTIENE EL CONTENIDO DEL BÚFER ACTUAL Y ELIMINA EL BÚFER DE SALIDA ACTUAL.											

			$table = ob_get_clean();	

			// ASIGNANDOLE A LA VARIABLE  EL CONTENIDO DEL BUFFER															

			$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $table  , $pagina);

			// CARGAMOS LA PAGINA EN EL BROWSER		

			$this->view_page($pagina);

	 	}	

	 	function Buscar($x, $cn = 'id'){

	 		// INVOCAMOS UN NUEVO OBJETO						

			$object = new MGestion_anexos;

			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL						

			global $con;

			// CARGA EL TEMPLATE						

			$pagina = $this->load_template('Listado de Gestion_anexos');			

			// OBTENEMOS EL LISTADO DE LIBROS DE ACUERDO A LOS PARAMETROS QUE LE ENVIAMOS						

			$query = $object->ListarGestion_anexos('WHERE '.$cn.' = "'.$x.'"');	    

			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.

			ob_start();		

		   		if($con->NumRows($query) <= 0 || $query !=''){

					// SI LA CONSULTA NO SE EJECUTA ENTONCES RETORNA VACIO							

					include_once(VIEWS.DS.'gestion_anexos/Listar.php');	   			

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

		function Insertar($gestion_id, $nombre, $url, $user_id, $fecha, $hora, $ip, $timest, $estado, $folio){

			// DEFINIENDO EL OBJETO			

			$object = new MGestion_anexos;

			// USANDO LA FUNCION DE INSERTAR DEL OBJETO PARA ENVIAR LA INFORMACION A LA BASE DE DATOA			

			$create = $object->InsertGestion_anexos($gestion_id, $nombre, $url, $user_id, $fecha, $hora, $ip, $timest, $estado, $folio);

			

			//SI NO SE ENVIO CORRECTAMENTE ENTONCES GENERA ERROR SINO ENVIA OK

			if($create != '1')

				$this->VistaListar('ERROR AL REGISTRAR');

			else

				$this->VistaListar('OK!');	



		}

		// FUNCION QUE RECIBE UNASERIE DE PARAMETROS Y LOS ENVIA A LA BASE DE DATOS PARA ACTUALIZAR UN REGISTRO (FUNCION ESPECIAL)		

		function Editar($constrain, $fields, $updates, $output){

			$object = new MGestion_anexos;

			$create = $object->UpdateGestion_anexos($constrain, $fields, $updates, $output);

			echo $create;

			//SI NO SE ENVIO CORRECTAMENTE ENTONCES GENERA ERROR SINO ENVIA OK

			#if($create != '1')

			#	$this->VistaListar('ERROR AL REGISTRAR');

			#else

			#	$this->VistaListar('OK!');						

			

		}

		// FUCNION QUE RECIBE UN PARAMETRO Y ELIMINA EL REGISTRO DE LA BASE DE DATOS		

		function Eliminar($id){

			// DEFINIMOS UN OBJETO NUEVO						

			$object = new MGestion_anexos;

			// LLAMAMOS A LA FUNCION QUE EJECUTA LA ELIMINACION.			

			$delete = $object->DeleteGestion_anexos($id); 		

			//SI NO SE ENVIO CORRECTAMENTE ENTONCES GENERA ERROR SINO ENVIA OK

			if($delete != '1')

				echo 'ERROR AL ELIMINAR';

			else

				echo 'OK!';			

			

		}



		function CargarAnexos(){
			
			global $con;
			global $c;

			$us = new MUsuarios;
			$us->CreateUsuarios("user_id", $_SESSION['usuario']);


			$g = new MGestion;
			$g->CreateGestion("id", $_GET['id']);

			$car = new MGestion_anexos;
			$tot  = $con->Query("select max(folio_final) as max from gestion_anexos WHERE gestion_id = '".$_GET['id']."' and folder_id = '".$_SESSION["folder_exp"]."'");
			$fol = $con->Result($tot, 0, "max");
			$fol += 1;

			$ordenq  = $con->Query("select count(*) as max from gestion_anexos WHERE gestion_id = '".$_GET['id']."' and folder_id = '".$_SESSION["folder_exp"]."'");
			$orden = $con->Result($ordenq, 0, "max");
			$orden += 1;

			$indice = $orden;

			$user_id = $_SESSION['usuario'];

			$filename=UPLOADS.DS.$_GET['id'].'/';
			if (!file_exists($filename)) {
			    mkdir(UPLOADS.DS . $_GET['id'], 0777);
			}

			$filename=UPLOADS.DS.$_GET['id'].'/anexos/';
			if (!file_exists($filename)) {
			    mkdir(UPLOADS.DS . $_GET['id'].'/anexos', 0777);
			}

			$backupname=UPLOADS.DS.$_GET['id'].'/backup/';
			if (!file_exists($backupname)) {
			    mkdir(UPLOADS.DS . $_GET['id'].'/backup', 0777);
			}

			$error = 0;


			if(isset($_FILES['upl']) && $_FILES['upl']['error'] == 0){
			
				$rand = md5(date('Y-m-d').rand().$_SESSION[usuario]);
				$ext = end(explode(".", $_FILES['upl']['name']));
				$fname = $rand.".".$ext;
				$textname = $rand.".txt";


		      	$viewer =   array(	"doc", "docx", "zip", "rar", "tar", "xls", "xlsx", "ppt", "pps", "pptx", "ppsx", "pdf",
									"txt", "jpg", "jpeg", "bmp", "gif", "png", "dib", "tif", "tiff", "mpeg", "avi", "mp4",
									"midi", "acc", "wma", "ogg", "mp3", "flv", "wmv", "csv", "DOC", "DOCX", "ZIP", "RAR",
									"TAR", "XLS", "XLSX", "PPT", "PPS", "PPTX", "PPSX", "PDF", "TXT", "JPG", "JPEG", "BMP",
									"GIF", "PNG", "DIV", "TIF", "TIFF", "MPEG", "AVI", "MP4", "MIDI", "ACC", "WMA", "OGG",
									"MP3", "FLV", "WMV", "CSV" );

				if (in_array($ext, $viewer)) {
					
					echo "1";
					
					if(move_uploaded_file($_FILES['upl']['tmp_name'], UPLOADS.DS.$_GET['id'].'/anexos/'.$fname)){
					#if(move_uploaded_file($_FILES['pictures']['tmp_name'][$key], UPLOADS.DS.$user_id.'/anexos/'.$fname)){

						
						$is_publico = ($_SESSION['suscriptor_id'] == "")?"0":"1";
                        #echo "Voy en esta parte";
						$x = @stat (ROOT.DS."archivos_uploads/gestion/".$_GET['id'].trim("/anexos/ ").$fname);
						$size = $x["size"];					
						$hash = hash("sha256", $_FILES['upl']['name'].$fname.$user_id.$_SERVER[REMOTE_ADDR].date("Y-m-d").date("H:i:s").$size);
						$pagecount = 1;

                        #echo "Genero el nuevo codigo de encriptación";
						try {
                            #   echo "Entro al Try";
							if (strtolower($ext) == "pdf") {

								$pdf = new FPDI(); 
							    $path_file2 = $url;
							    $path_file2 = $_SERVER["DOCUMENT_ROOT"]."app/archivos_uploads/gestion/".$_GET['id'].trim("/anexos/ ").$fname;
							    $file = realpath($path_file2);
							    $pagecount = $pdf->setSourceFile($file);
                                
                                #     echo "Es un PDF: Retorno el total de paginas";

							    /*
							    $linkfile = HOMEDIR.DS."app/archivos_uploads/gestion/".$g->GetId().trim("/anexos/ ").$fname;

							     for($i = 1 ; $i <= $pagecount ; $i++){

						            $tpl  = $pdf->importPage($i);
						            $size = $pdf->getTemplateSize($tpl);
						            $orientation = $size['h'] > $size['w'] ? 'P':'L';

									$pdf->Rect(3, 4, 180, 4, 'F', array(), array(255,255,255));						
						            $pdf->SetFont('Helvetica', 0, '10');
						            $pdf->SetTextColor(0, 0, 0);
						            $pdf->SetXY(3, 4);
						            $pdf->Write(0, 'Documento Cargado por el usuario '.$_SESSION['nombre']." con el Indice ".$g->GetMin_rad()."-".$indice);

									$pdf->Image('http://chart.googleapis.com/chart?chs=50x50&cht=qr&chl='.$linkfile,180,2,25,25);


						            $pdf->AddPage($orientation);
						            $pdf->useTemplate($tpl, null, null, $size['w'], $size['h'], true);
						        }

							    $pdf->Output($path_file2, 'F');
						        */

							}

						} catch (Exception $e) {
                            #   echo "Exception! $e";
							$pagecount = 2;
						}
						
                        #echo "Salgo del Try!";
						//base 64
                        $base_file = '';
                        $data_base_file = file_get_contents($_SERVER["DOCUMENT_ROOT"]."/app/archivos_uploads/gestion/".$_GET['id'].trim("/anexos/ ").$fname);
                        $base_file = base64_encode($data_base_file);

                        $file = fopen(UPLOADS.DS.$_GET['id'].'/backup/'.$textname, "w");
                        fwrite($file, $base_file . PHP_EOL);
                        fclose($file);




						$folfinal = $fol + $pagecount;
                        # echo "Ejecuto el Query";
						$con->Query("INSERT into gestion_anexos (timest, gestion_id, nombre,						 url,		user_id, 	ip, 						fecha, 				hora, 				folio, 		 folder_id, 					folio_final, is_publico, 	   cantidad,	  orden, 		hash, base_file, typefile, peso, indice) values 
																('".date("Y-m-d H:i:s")."', '$_GET[id]','".$_FILES['upl']['name']."','".$fname."','$user_id', '$_SERVER[REMOTE_ADDR]', '".date("Y-m-d")."', '".date("H:i:s")."', '".$fol."', '".$_SESSION["folder_exp"]."', '".$folfinal."', '".$is_publico."', '".$pagecount."', '".$orden."', '".$hash."','".$textname."','".$_FILES['upl']['type']."' ,'".$_FILES['upl']['size']."', '".$indice."')");

                                    #            echo "Salgo del Query";
						$id = $c->GetMaxIdTabla("gestion_anexos", "id");
						$objecte = new MEvents_gestion;
						// USANDO LA FUNCION DE INSERTAR DEL OBJETO PARA ENVIAR LA INFORMACION A LA BASE DE DATO
						/*
							InsertEvents_gestion(	usuario_registra, 	gestion_id, 	fecha_evento, titulo, 	descripcion, 	fecha_creacion, estado(0 por defecto ignorar),  hora, 	$alerted = validar si alertado(0 = sin avisar, 1 = avisado), 	$avisar_a = dias para avisar, 	$type_event (ignorar), 	$fecha_vencimiento, $id_generico = si viene de alerta generica (0 =  ninguna), 	$seccional, 	$oficina, 	$area, 	$grupo = a que usuarios notificar (* = todos, B = Jefe de Area, B-X = Jefe de Area y x = otro usuario))
						*/

						$c->SendContabilizadorDocumentos($pagecount, $g->GetTipo_documento(), $g->GetId(), "AN");	

						if ($_SESSION['suscriptor_id'] == "") {
							# code...
							$objecte->InsertEvents_gestion($_SESSION['usuario'], $_GET['id'], date("Y-m-d"), "Carga de Documento", "Se ha cargado un documento llamado: \"".$_FILES['upl']['name']."\"", date("Y-m-d"), 0, date("H:i:s"), 0, 0, 0, date("Y-m-d"), 0, $_SESSION['seccional'], $_SESSION['area_principal'], $_SESSION['area_principal'], "*", "an", $id);
						}else{
							$objecte->InsertEvents_gestion($_SESSION['suscriptor_id'], $_GET['id'], date("Y-m-d"), "Carga de Documento", "Se ha cargado un documento llamado: \"".$_FILES['upl']['name']."\"", date("Y-m-d"), 0, date("H:i:s"), 0, 0, 0, date("Y-m-d"), 0, $_SESSION['seccional'], $_SESSION['area_principal'], $_SESSION['area_principal'], "*", "lsus", $id);
						}
						exit;
					}
				}else{
					echo "Error! al subir: ".$_FILES['upl']['name']." Formato de archivo no valido";
				}
			}
		}
		function UpdatePhoto($id){

			global $con; 

			global $c;



			$ga = new MGestion_anexos;

			$ga->CreateGestion_anexos("id", $id);



			$g = new MGestion;

			$g->CreateGestion("id", $ga->GetGestion_id());



			$id = $ga->GetId();



			$oldurl = $ga->GetUrl();





			$user_id = $_SESSION['usuario'];



			$filename=UPLOADS.DS.$ga->GetGestion_id().'/';

			if (!file_exists($filename)) {

			    mkdir(UPLOADS.DS . $ga->GetGestion_id(), 0777);

			}

			$filename=UPLOADS.DS.$ga->GetGestion_id().'/anexos/';

			if (!file_exists($filename)) {

			    mkdir(UPLOADS.DS . $ga->GetGestion_id().'/anexos', 0777);

			}



			if(isset($_FILES['archivo']) && $_FILES['archivo']['error'] == 0){

			

				$rand = md5(date('Y-m-d').rand().$_SESSION[usuario]);

				$ext = end(explode(".", $_FILES['archivo']['name']));

				$fname = $rand.".".$ext;



				$peso = $_FILES['archivo']['size'];

				



				if(move_uploaded_file($_FILES['archivo']['tmp_name'], UPLOADS.DS.$ga->GetGestion_id().'/anexos/'.$fname)){



					try {

						if (strtolower($ext) == "pdf") {



							$pdf = new FPDI(); 

						    $path_file2 = $url;

						    $path_file2 = $_SERVER["DOCUMENT_ROOT"]."app/archivos_uploads/gestion/".$ga->GetGestion_id().trim("/anexos/ ").$fname;

						    $file = realpath($path_file2);

						    $pagecount = $pdf->setSourceFile($file);



						}



					} catch (Exception $e) {

						$pagecount = 2;

					}



					$in_out = $c->GetDataFromTable("dependencias_tipologias", "id", $ga->GetTipologia(), "es_entrada", "");
					$in_out = ($in_out == "0")?"-1":"1";


					$ar2 = array('nombre', 'url', 'fecha', 'hora', 'cantidad', 'in_out', 'timest', 'peso');

					// DEFINIMOS EN OTRO VECTOR LOS NUEVOS DATOS QUE VAMOS A METER	

					$ar1 = array($ga->GetNombre().'.'.$ext, $fname, date("Y-m-d"), date("H:i:s"), $pagecount, $in_out, date("Y-m-d H:i:s"), $peso);	

					// DEFINIMOS LOS ESTADOS DE SALIDA

					$output = array('registro actualizado', 'no se pudo actualizar'); 

					// Y POR ULTIMO DEFINIMOS EL CONTRAIN PARA LA ACTUALIZACION	

					$constrain = 'WHERE id = '.$id;

					$this->Editar($constrain, $ar2, $ar1, $output);



					$path = "Se ha cargado/actualizado el contenido del documento: ".$ga->GetNombre()." de <a href='".HOMEDIR.DS."app/archivos_uploads/gestion/".$ga->GetGestion_id().DS."anexos".DS.$oldurl."' target='_blank'>este</a> por <a href='".HOMEDIR.DS."app/archivos_uploads/gestion/".$ga->GetGestion_id().DS."anexos".DS.$fname."' target='_blank'>este</a>";



					$tipologia = new MDependencias_tipologias;

					$tipologia->CreateDependencias_tipologias("id", $ga->GetTipologia());



					if ($tipologia->GetInmaterial() == "1") {

						$c->SendContabilizadorDocumentos($pagecount, $g->GetTipo_documento(), $g->GetId(), "AN", $ga->GetId());	

					}



#					$id = $c->GetMaxIdTabla("gestion_anexos", "id");

					$objecte = new MEvents_gestion;



					// USANDO LA FUNCION DE INSERTAR DEL OBJETO PARA ENVIAR LA INFORMACION A LA BASE DE DATO

					/*

						InsertEvents_gestion(	usuario_registra, 	gestion_id, 	fecha_evento, titulo, 	descripcion, 	fecha_creacion, estado(0 por defecto ignorar),  hora, 	$alerted = validar si alertado(0 = sin avisar, 1 = avisado), 	$avisar_a = dias para avisar, 	$type_event (ignorar), 	$fecha_vencimiento, $id_generico = si viene de alerta generica (0 =  ninguna), 	$seccional, 	$oficina, 	$area, 	$grupo = a que usuarios notificar (* = todos, B = Jefe de Area, B-X = Jefe de Area y x = otro usuario))

					*/

					$objecte->InsertEvents_gestion($_SESSION['usuario'], $ga->GetGestion_id(), date("Y-m-d"), "Actualización de Documento", $c->sql_quote($path), date("Y-m-d"), 0, date("H:i:s"), 0, 0, 0, date("Y-m-d"), 0, $_SESSION['seccional'], $_SESSION['area_principal'], $_SESSION['area_principal'], "*", "anu", $id);



					$getp = $con->Query("Select * from gestion_anexos_permisos where id_documento = '".$id."'");



					while ($rowp = $con->FetchAssoc($getp)) {

						$con->Query("update gestion_anexos_permisos set estado = '0' where id = '".$rowp['id']."'");

						$usuario = new MUsuarios;

						$usuario->CreateUsuarios("user_id", $rowp['usuario_permiso']);

						$objecte->InsertEvents_gestion($_SESSION['usuario'], $ga->GetGestion_id(), date("Y-m-d"), "Solicitúd de Revisión de Documento", "Se ha compartido un documento \"".$ga->GetNombre()."\" con el usuario ".$responsablea." para que sea revisado" , date("Y-m-d"), 0, date("H:i:s"), 0, $diasmaxtoresponse, 0, $fecha_vencimiento, 0, $_SESSION['seccional'], $_SESSION['area_principal'], $_SESSION['area_principal'], $usuario->GetA_i(), "rdoc", $id);

					}



					echo "	<script>

								window.location.href = '".HOMEDIR."/gestion/ver/".$ga->GetGestion_id()."/';

							</script>";

				}

			}

		}



		function GetAnexosCarpeta($id){

			global $con;

			global $c;



			$g = new MGestion;

			$g->CreateGestion("id", $id);



			$id = $g->GetId();



			echo 	"	<li class='TituloCarpeta'>

							<div class='titulotitulo'>Carpeta Externa</div>

							<ul>";

				$v = $con->Query("select * from gestion_anexos where gestion_id = '".$id."' and  folder_id = '0'  and (estado = '1' or estado = '3')  order by orden");

				$i = 0;

				$last = $con->NumRows($v);

				while ($col = $con->FetchAssoc($v)) {

					$type=explode('.', strtolower($col[url]));

	                $type=array_pop($type);



	                $file = $col["url"];

	                if ($file != "") {

	                	

		                $ruta = HOMEDIR.DS."app/archivos_uploads/gestion/".$id.trim("/anexos/ ").$file."";

		                $cadena_nombre = substr($file,0,200);

		                $extension = substr($cadena_nombre, strlen($cadena_nombre)-4, strlen($cadena_nombre));  



						$bad = (strlen($col[nombre]) > 40)?"...":"";

					 	$nombredoc = substr($col[nombre], 0, 40).$bad;



		                echo "  <li class='anexos-li' id='$col[id]'>

								".'	

									<input type="checkbox" name="servicio[]" id="a'.$col['id'].'" value="'.$ruta.'" class="active_check" onclick="ActiveCheck(\'a'.$col['id'].'\')" title="'.$titulo.'" style="float:left" />

								'."

		  							<div style='padding-top:0px;' class='img-icon $type' style='width:30px' ></div>

		                            <div class='nom_anexo' title='$col[nombre]' onclick='AbrirDocumento(\"".$ruta."\",\"".$viewer[$extension]."\",\"".$col["nombre"]."\", \"4\", \"".$col["id"]."\")'>$nombredoc</div>

		                        </li>";

	                }

				}

				echo "		</ul>

						</li>";



			$c->GetAnexosGesetionElectronico($id, 0, "-"); 



		}



		function UpdateFolios($id, $start, $finish){

			$ar2 = array('folio', 'folio_final');

			// DEFINIMOS EN OTRO VECTOR LOS NUEVOS DATOS QUE VAMOS A METER	

			$ar1 = array($start, $finish);	

			// DEFINIMOS LOS ESTADOS DE SALIDA

			$output = array('registro actualizado', 'no se pudo actualizar'); 

			// Y POR ULTIMO DEFINIMOS EL CONTRAIN PARA LA ACTUALIZACION	

			$constrain = 'WHERE id = '.$id;

			$this->Editar($constrain, $ar2, $ar1, $output);	



			echo "Folios Actualizados";

		}



		function BuscarAnexos($id, $x){

			global $c;

			global $f;

			global $con;



			if ($x != "") {



		      	$viewer =   array(".doc" => "google"                        , "docx" => "google"                        , ".zip" => "google"                        , ".rar" => "google"                        ,

	                              ".tar" => "google"                        , ".xls" => "google"                        , "xlsx" => "google"                        , ".ppt" => "google"                        ,

	                              ".pps" => "google"                        , "pptx" => "google"                        , "ppsx" => "google"                        , ".pdf" => "google"                        ,

	                              ".txt" => "google"                        , ".jpg" => "image"                         , "jpeg" => "image"                         , ".bmp" => "image"                         ,

	                              ".gif" => "image"                         , ".png" => "image"                         , ".dib" => "image"                         , ".tif" => "image"                         ,

	                              "tiff" => "image"                         , "mpeg" => "video"                         , ".avi" => "video"                         , ".mp4" => "video"                         ,

	                              "midi" => "audio"                         , ".acc" => "audio"                         , ".wma" => "audio"                         , ".ogg" => "audio"                         ,

	                              ".mp3" => "audio"                         , ".flv" => "video"                         , ".wmv" => "video"							, ".csv" => "google"                        ,

	                              ".DOC" => "google"                        , "DOCX" => "google"                        , ".ZIP" => "google"                        , ".RAR" => "google"                        ,

	                              ".TAR" => "google"                        , ".XLS" => "google"                        , "XLSX" => "google"                        , ".PPT" => "google"                        ,

	                              ".PPS" => "google"                        , "PPTX" => "google"                        , "PPSX" => "google"                        , ".PDF" => "google"                        ,

	                              ".TXT" => "google"                        , ".JPG" => "image"                         , "JPEG" => "image"                         , ".BMP" => "image"                         ,

	                              ".GIF" => "image"                         , ".PNG" => "image"                         , ".DIV" => "image"                         , ".TIF" => "image"                         ,

	                              "TIFF" => "image"                         , "MPEG" => "video"                         , ".AVI" => "video"                         , ".MP4" => "video"                         ,

	                              "MIDI" => "audio"                         , ".ACC" => "audio"                         , ".WMA" => "audio"                         , ".OGG" => "audio"                         ,

	                              ".MP3" => "audio"                         , ".FLV" => "video"                         , ".WMV" => "video"							, ".CSV" => "google");

				

				$ang = new MGestion_anexos;



	    		$query = $ang->ListarGestion_anexos("WHERE gestion_id = '".$id."' and estado = '1' and nombre like '%$x%' ", "", "");



	    		$ge = new MGestion;

	    		$ge->CreateGestion("id", $gestion);



	    		$dep = new MDependencias;

	    		$dep->CreateDependencias("id", $ge->GetTipo_documento());



				while ($col=$con->FetchAssoc($query)) {

	              



	$type=explode('.', strtolower($col[url]));

    $type=array_pop($type);



    $file = $col["url"];

    $idb = $col[0];

    $propietario_documento = false;



    if ($file != "") {



        $ruta = HOMEDIR.DS."app/archivos_uploads/gestion/".$id.trim("/anexos/ ").$file."";

        $cadena_nombre = substr($file,0,200);

        $extension = substr($cadena_nombre, strlen($cadena_nombre)-4, strlen($cadena_nombre));  



        if ($_SESSION[usuario]==$_SESSION[sadminid] || $_SESSION[sadmin]!=1) {

            if ($_SESSION['folder'] == '') {

                $path = "onclick='changetext(this)'";

            }

        }



        $tipo = new MDependencias_tipologias;

		$tipo->CreateDependencias_Tipologias("id", $col['tipologia']);



		$listado = $tipo->ListarDependencias_tipologias("WHERE id_dependencia = '".$dep->GetId()."'");



		if ($tipo->GetTipologia() != "") {

			$tipologia = $tipo->GetTipologia();

		}else{

			$tipologia = "-";

		}



		$bad = (strlen($col[nombre]) > 40)?"...":"";

	 	$nombredoc = substr($col[nombre], 0, 40).$bad;





		if (($_SESSION['t_cuenta'] == "1" && $_SESSION['suscriptor_id'] == "") || ($col['user_id'] == $_SESSION['usuario'] && $_SESSION['suscriptor_id'] == "")){

			if ($_SESSION['sadminid'] == "1" || $tipologia == "-" || $col['user_id'] == $_SESSION['usuario']) {

				# code...

				$tipologia = '<select style="width:100px; height:35px;" id="changetypedoc'.$idb.'" onChange="changetypedoc(\''.$idb.'\', \''.$ge->GetId().'\', this.value)">';

				if ($tipo->GetTipologia() == "") {

					$tipologia .=  "<option value=''>Seleccione una Topología</option>";	

				}else{

					$tipologia .=  "<option value='".$tipo->GetId()."'>".$tipo->GetTipologia()."</option>";	

				}



				while ($rl = $con->FetchAssoc($listado)) {

					$tipologia .=  "<option value='".$rl['id']."'>".$rl['tipologia']."</option>";	

				}

				$tipologia .= "</select>";

			}

		}else{

			if ($tipo->GetTipologia() == "" || $tipo->GetTipologia() == "0") {

				$tipologia = "-";

			}else{

				$tipologia = $tipo->GetTipologia();

			}

		}



		if ($tipologia != "-") {



			$fecha_firma    = $c->GetDataFromTable("gestion_anexos_firmas", "anexo_id", $col['id'], "fecha_firma", $separador = " ");

			$usuario_fir    = $c->GetDataFromTable("gestion_anexos_firmas", "anexo_id", $col['id'], "usuario_firma", $separador = " ");

			$usuario_fir    = $c->GetDataFromTable("usuarios", "user_id", $usuario_fir, "p_nombre, p_apellido", $separador = " ");



			$ar_firmo = array(	"" => HOMEDIR.DS."app/views/assets/images/white_spot.png", 

								"-" => HOMEDIR.DS."app/views/assets/images/white_spot.png", 

								"0" => HOMEDIR.DS."app/views/assets/images/firmaw.png", 

								"1" => HOMEDIR.DS."app/views/assets/images/firmao.png", 

								"2" => HOMEDIR.DS."app/views/assets/images/firmae.png");



			$ar_title = array(	""  => "", 

								"-" => "", 

								"0" => "Documento Pendiente de Firma", 

								"1" => "Documento Firmado por $usuario_fir el $fecha_firma", 

								"2" => "Firma Rechazada por $usuario_fir el $fecha_firma");



			$se_firmo    = $c->GetDataFromTable("gestion_anexos_firmas", "anexo_id", $col['id'], "estado_firma", $separador = " ");

			$se_firmo = "<img src='".$ar_firmo[$se_firmo]."' title='".$ar_title[$se_firmo]."' style='margin-left:10px;' >";



			$tipologia .= $se_firmo;



		}else{

			$se_firmo = "<img src='".HOMEDIR."/app/views/assets/images/white_spot.png'>";

			$tipologia .= $se_firmo;

		}



        echo "  <li class='anexos-li' id='file_$col[0]'>

                    <!--<input type='checkbox' value='".$file."' name='servicio[]'  class='album_inner_button active_check' />-->

                    <div style='padding-top:0px;' class='img-icon $type' style='width:30px' ></div>

                    <div class='nom_anexo' title='$col[nombre]' onclick='AbrirDocumento(\"".$ruta."\",\"".$viewer[$extension]."\",\"".$col["nombre"]."\", \"4\", \"".$col["id"]."\")'>$nombredoc</div>

                        <div class='nom_anexo' style='float:right'>

					        <div class='impr_box'>";

		

		if ($_SESSION['suscriptor_id'] == "") {

			echo "				<ul>

					                <li class='bl_pro properties' id='sowitem1_$col[0]' title='Ver Propiedades del Documento' onClick='shoideitem(\"detail_$col[0]\", \"sowitem1_$col[0]\")'>Propiedades del Documento</li>         

					                <li class='bl_pro share' id='sowitem2_$col[0]' title='Compartir Documento' onClick='shoideitem(\"share_$col[0]\", \"sowitem2_$col[0]\")'>Compartir Documento</li>";



        		$GetDoc_shared = $con->Result($con->Query('select count(*) as t from gestion_anexos_permisos where id_documento = "'.$col[0].'" and usuario_permiso = "'.$_SESSION['usuario'].'"'), 0, 't');



        		if (($_SESSION['usuario'] == $col['user_id'] || $GetDoc_shared >= 1) && $_SESSION['suscriptor_id'] == "" ) {

            		if ($GetDoc_shared >= 1) {

            			$propietario_documento = false;

        				$gap = new MGestion_anexos_permisos;

			        	$qgap = $gap->ListarGestion_anexos_permisos("where id_documento = '".$col[0]."' and usuario_permiso = '".$_SESSION['usuario']."'");



			        	while ($rogap = $con->FetchAssoc($qgap)) {



				        	$objectgap = new MGestion_anexos_permisos;

				        	$objectgap->CreateGestion_anexos_permisos("id", $rogap['id']);



				        	if ($_SESSION['MODULES']['firma_electronica'] == "1" || $_SESSION['MODULES']['firma_digital'] == "1") {

					        	if ($objectgap->GetEstado() == '0') {

				        			echo "<li class='bl_pro needtocheck' id='sowitem3_$col[0]' onClick='shoideitem(\"lookfor_$col[0]\", \"sowitem3_$col[0]\")'>Firmas del Documento</li>";

					        	}else{

				        			echo "<li class='bl_pro check' id='sowitem3_$col[0]' onClick='shoideitem(\"lookfor_$col[0]\", \"sowitem3_$col[0]\")'>Firmas del Documento</li>";

					        	}

				        	}

			        	}



            		}else{



            			if ($_SESSION['MODULES']['firma_electronica'] == "1" || $_SESSION['MODULES']['firma_digital'] == "1") {

                			$Getstatusfile = $con->Result($con->Query('select count(*) as t from gestion_anexos_permisos where id_documento = "'.$col[0].'" and estado != "0"'), 0, 't');

                			if ($Getstatusfile >= 1 && $col['estado'] == "3") {

                				echo "<li class='bl_pro warning' id='sowitem3_$col[0]' onClick='shoideitem(\"lookfor_$col[0]\", \"sowitem3_$col[0]\")'>Firmas del Documento</li>";

                			}else{

                				$Getcerocounter = $con->Result($con->Query('select count(*) as t from gestion_anexos_permisos where id_documento = "'.$col[0].'" and estado = "0"'), 0, 't');

            					if ($Getcerocounter >= 1) {

            						echo "<li class='bl_pro waiting' id='sowitem3_$col[0]' onClick='shoideitem(\"lookfor_$col[0]\", \"sowitem3_$col[0]\")'>Firmas del Documento</li>";

            					}else{

            						echo "<li class='bl_pro check' id='sowitem3_$col[0]' onClick='shoideitem(\"lookfor_$col[0]\", \"sowitem3_$col[0]\")'>Firmas del Documento</li>";

            					}

                			}

                			$propietario_documento = true;

            			}

            		}	



            		$timessent = $con->Result($con->Query('select count(*) as t from mailer_attachments where alt = "'.$col[0].'" '), 0, 't');

					if ($timessent >= 1) {

            			echo "<li class='bl_pro at' id='sowitem4_$col[0]' onClick='shoideitem(\"mailer_$col[0]\", \"sowitem4_$col[0]\")'>Envíos</li>";

        			}







        			$timessent = $con->Result($con->Query('select count(*) as t from notificaciones_attachments where id_anexo = "'.$col[0].'" '), 0, 't');



					if ($timessent >= 1) {



            			echo "<li class='bl_pro messenger' id='sowitem5_$col[0]' onClick='shoideitem(\"mensajeria_$col[0]\", \"sowitem5_$col[0]\")'>Envíos</li>";



        			}











        		}else{







        			if ($col['estado'] == "3") {



        				echo "<li class='bl_pro warning' id='sowitem3_$col[0]'>documento en revisión</li>";



        			}



        			



        		}







        echo "      		</ul>";



    }



		echo "	        </div>



				    </div>



				    <div class='nom_anexo' style='float:right'>$tipologia</div>



                    <div class='bloq_data_anexo'>



                    	<div class='inner_item_anexo' id='detail_$col[0]' style='display:none'>";



		if ($_SESSION['usuario'] == $col['user_id']) {



			echo    '<div class="title">Editar Documento</div>



						<div style="float:left">



							<form id="fromupdatedoc_'.$col[0].'">



							<table border="0" style="margin-left:30px">



								<tr>



									<td width="70px"><b>Nombre:</b></td>



									<td align="left"><input type="text" value="'.$col['nombre'].'" name="nombre" class="form-control" style="width:400px; height:27px;"></td>



								</tr>



								<tr>



									<td><b>Carpeta:</b></td>



									<td align="left">



										<select style="width:410px; height:35px;" id="changetypedoc'.$idb.'" name="folder_id" class="form-control">';



										if ($col['folder_id'] == "0") {



											echo "<option value='0'>Carpeta Principal</option>";



										}else{



											$idf = $c->GetDataFromTable("gestion_folder", "id", $col['folder_id'], "nombre", "");



											echo "<option value='".$col['folder_id']."'>".$idf."</option>";



											echo "<option value='0'>Carpeta Principal</option>";



										}



									echo 	



											$c->GetArbolCarpetasSelect($col['gestion_id'], 0, "-"); 



			echo '						</select>



									</td>



								</tr>



								<tr>



									<td colspan="2" align="right"><input type="button" value="Actualizar Documento" onclick="UpdateGAnexo(\''.$col[0].'\')"></td>



								</tr>



							</table>



							</form>';



				echo 	'	



						</div>



						<div class="clear"></div>';



		}	                            	



        echo          		"<div class='title'>Propiedades del Documento</div>";



						



/*	



						*/



					if ($_SESSION['sadminid'] == "1"){



								$pathtype =  "<div>Tipología Documental: ";



								



								if ($tipo->GetTipologia() == "") {



									$pathtype .=  "-";	



								}else{



									$pathtype .=  $tipo->GetTipologia();	



								}







								$pathtype .= "</div><div>El Doc. Publico:";







								$pathtype .= '<select style="width:100px; height:35px;" id="changePublic'.$idb.'" onChange="changePublic(\''.$idb.'\')" class="form-control">';



								if ($col["is_publico"] == "0") {



									$pathtype .=  "<option value='0'>NO</option>";	



									$pathtype .=  "<option value='1'>SI</option>";	



								}else{



									$pathtype .=  "<option value='1'>SI</option>";	



									$pathtype .=  "<option value='0'>NO</option>";	



								}







								$pathtype .= "</select></div>";







						}else{



							$pathtype =  "<div style='float:left'>";



							if ($tipo->GetTipologia() == "" || $tipo->GetTipologia() == "0") {



								$nomt = "-";



							}else{



								$nomt = $tipo->GetTipologia();



							}



							$pathtype .=  "Tipología Documental: <b>".$nomt."</b>";







							$pathtype .= "</div><div style=' margin-left:15px'>Permisos del Documento: ";







								if ($col["is_publico"] == "0") {



									$pathtype .=  "<b>El documento es público</b>";	



								}else{



									$pathtype .=  "<b>ES un documento privado</b>";	



								}







								$pathtype .= "</div>";



						}







						$pathtype .= "<div>Fecha de Creación: ";



							$pathtype .=  "<b>".$col['fecha']."</b>";	



						$pathtype .= "</div>";







# AQUI DEBO PONER LA FECHA NUEVA



						echo	$pathtype;



						if ($col['origen'] == "0") {



							$origen = "<div style='float:left'><b> Propio</b></div>";



						}else{







							$doco = new MGestion_anexos;



							$doco->CreateGestion_anexos("id", $col['origen']);







							$ng = new MGestion;



							$ng->CreateGestion("id", $doco->GetGestion_id());







							$origen = "<div style='float:left'><a href='/gestion/ver/".$ng->GetId()."/' target='_blank'>".$ng->GetNum_oficio_respuesta()."</a></div>";



						}



						$x = @stat (ROOT.DS."archivos_uploads/gestion/".$id.trim("/anexos/ ").$file);



						$size = round($x["size"] / 1024, 2)." Kb (".$x["size"]." Bytes)";







						$responsablea = $c->GetDataFromTable("usuarios", "user_id", $col['user_id'], "p_nombre, p_apellido", $separador = " ");



						echo "<div class='clear'></div>";



						echo "<div style='float:left'>Origen:&nbsp;</div>".$origen;



						if ($origen != "<div style='float:left'><b> Propio</b></div>") {



							echo "<div class='clear'></div>";



						}



						echo "<div style='float:left; margin-left:15px'>Peso:&nbsp;<b>".$size."</b></div>";







						echo "<div style='float:left; margin-left:15px'>Folios:&nbsp;<b>".$col['cantidad']."</b></div>";



						



						echo "<div class='clear'></div>";







						echo "<div style='float:left;'>Cod Encriptacion:&nbsp;<b>".$col['hash']."</b></div>";



						



						echo "<div class='clear'></div>";







						echo "<div style='float:left'> Cargado por: <b>".$responsablea."</b> el día ".$f->ObtenerFecha4($col['timest'])."</div>";



						echo "<div class='clear'></div>";



						if ($propietario_documento && $_SESSION['suscriptor_id'] == "") {



							if($_SESSION['eliminar'] == 1){



								echo "<input type='button' value='Eliminar Documento' style='margin-left:10px; margin-right:10px' class='btn_red' onClick='ChangeStatusDoc(\"".$col[0]."\", \"0\")'>";



							}



						}







						if ($col['tipologia'] != "0") {



							if($_SESSION['MODULES']['metadatos'] == "1"){



								echo "<input type='button' value='Ver Metadatos' class='btn_red' onClick='OpenWindow(\"/gestion_anexos/vermetadatos/".$col[0]."/\")'>";



							}



						}



						echo "<div class='clear'></div>";







        echo "			</div>



                    	<div class='inner_item_anexo' id='share_$col[0]' style='display:none'>";



		echo "				<div class='title'>Compartir Documento</div>";



		if ($_SESSION['mayedit'] == "1") {



			# code...



			echo "				<input type='text' id='whoishare_$col[0]' placeholder='Escriba el numero de radicado rápido del expediente a compartir' style='width:425px; height:25px'>



								<input type='button' value='Compartir' onClick='shareDocumento($col[0])'>";



		}



		echo "					<div class='clear'></div>



		



								<ul class='sharelistdoc' id='listshare$col[0]'>";



									$queryxtt = $con->Query("select gestion_id from gestion_anexos where origen = '".$col[0]."' group by gestion_id");



									$i = 0;



									while ($rxt = $con->FetchAssoc($queryxtt)) {



										$i++;



										$gx = new MGestion;



										$gx->CreateGestion("id", $rxt[gestion_id]);



										echo "<li>".$gx->GetNum_oficio_respuesta()."</li>";



									}



									if ($i <= 0) {



										echo '<li><div class="da-message warning">Este documento no se está compartiendo con ningún expediente</div></li>';



									}



		echo "					</ul>



				";											



		echo "				<div class='clear'></div>";



        echo "         	</div>



                    	<div class='inner_item_anexo' id='lookfor_$col[0]' style='display:none'>";



        echo "				<div class='title'>Revisar Documento</div>";



				        if ($propietario_documento) {



	    echo '              <div id="listado_solicitudes">



						    	<div class="listado_seleccion">



						    		<select id="diasmaxtoresponse_'.$col[0].'" name="diasmaxtoresponse" style="width:160px; height:42px" class="important">



						    			<option value="0">Seleccione los días maximos para revisar el documento</option>



						    			<option value="1">1 Días</option>



						    			<option value="2">2 Días</option>



						    			<option value="3">3 Días</option>



						    			<option value="7">7 Días</option>



						    			<option value="15">15 Días</option>



						    			<option value="30">1 Mes</option>



						    		</select>



						    		<input type="text" alt="'.$col[0].'" id="searchbform" style="width:375px; height:35px;" class="form-control searchbform_'.$col[0].' activarbuscador important" placeholder="Solicitar Revisión a:" >



						    		<div id="bloquebusqueda" class="bloquebusqueda_'.$col[0].' bloquebusqueda"></div>



						    		<!--<textarea id="observacion" name="observacion" class="form-control" placeholder="Observacion" style="width:550px; height:70px; resize:none"></textarea>-->';



										$gap = new MGestion_anexos_permisos;



							        	$qgap = $gap->ListarGestion_anexos_permisos("where id_documento = '".$col[0]."'");



							        	$yz = 0;



							        	$ct = 0;



							        	$cp = 0;



							        	while ($rogap = $con->FetchAssoc($qgap)) {



							        		$ct++;



							        		if ($rogap['estado'] == "2") {



							        			$yz++;



							        		}



							        		if ($rogap['estado'] == "1") {



							        			$cp++;



							        		}



								        	$objectgap = new MGestion_anexos_permisos;



								        	$objectgap->CreateGestion_anexos_permisos("id", $rogap['id']);







							        		include(VIEWS.DS.'gestion_anexos_permisos/Listar.php');







							        	}				    



		echo '			    	</div>';



								if ($yz >= '1') {



								echo '		



										<form action="/gestion_anexos/updatephoto/'.$col[0].'/" id="formpicture'.$col[0].'"  name="formpicture'.$col[0].'" method="post" enctype="multipart/form-data">



									        <b><i>Volver a Cargar el Documento</i></b>



									        <input name="archivo" id="selfile'.$col[0].'" type="file" size="35"/>



							      		</form>



							      	<script>



							      		$("#selfile'.$col[0].'").change(function() {



							      			$("#formpicture'.$col[0].'").submit();



							      		});



							      	</script>';



								}elseif ($cp == $ct  && $col['estado'] == 3) {



									echo "<input type='button' value='Activar Documento' onClick='ChangeStatusDoc(\"".$col[0]."\", \"1\")'>";



								}



		echo '			    </div>  ';



				        }else{



				        	$gap = new MGestion_anexos_permisos;



				        	#if ($col['user_id'] == $_SESSION['usuario']) {



				        	#	$qgap = $gap->ListarGestion_anexos_permisos("where id_documento = '".$col[0]."'");



				        	#}else{



					        	$qgap = $gap->ListarGestion_anexos_permisos("where id_documento = '".$col[0]."' and usuario_permiso = '".$_SESSION['usuario']."'");



				        		



				        	#}



				        	while ($rogap = $con->FetchAssoc($qgap)) {



				        		



					        	$objectgap = new MGestion_anexos_permisos;



					        	$objectgap->CreateGestion_anexos_permisos("id", $rogap['id']);







					        	if ($objectgap->GetEstado() == '0') {



				        			include_once(VIEWS.DS.'gestion_anexos_permisos/FormUpdateGestion_anexos_permisos.php');



					        	}else{



					        		include_once(VIEWS.DS.'gestion_anexos_permisos/Listar.php');



					        	}



				        	}



				        	



				        }







        echo "        		



        					<ul class='sharelistdoc' id='listlookfor_$col[0]'></ul>



        				</div>











						<div class='inner_item_anexo' id='mailer_$col[0]' style='display:none'>";



		echo "				<div class='title'>Correos electrónicos a los que se ha enviado este documento</div>";



		echo "					<div class='clear'></div>



									<ul class='sharelistdoc' id='listshare$col[0]'>";



									$queryxtt = $con->Query("select * from mailer_attachments where alt = '".$col[0]."'");



									$i = 0;



									while ($rxtt = $con->FetchAssoc($queryxtt)) {



										$i++;



										$ma = new MMailer_attachments;



										$ma->CreateMailer_attachments("id", $rxtt['id']);







										$fm = new MMailer_from_message;



										$fm->CreateMailer_from_message("message_code", $ma->GetMessage_id());







										$mm = new MMailer_message;



										$mm->CreateMailer_message("message_id", $ma->GetMessage_id());







										$mr = new MMailer_replys;



										$mr->CreateMailer_replys("message_id", $ma->GetMessage_id());



										



										$rstatus = array("0" => "Mensaje Sin Leer", "1" => "El mensaje fue <strong>Abierto</strong>", "2" => "El mensaje ah sido <strong>Rehusado</strong>", "3" => "El mensaje fue <strong>abierto</strong> con anterioridad");



										



										echo 	"<li>".



														"<b>Asunto:</b> ".$mm->GetSubject().



														" / <b>Estado:</b> ".$rstatus[$mr->GetReaded()].



														" / <b>Enviado a:</b> ".$fm->GetEmail()."<hr>";







												"</li>";



									}



									if ($i <= 0) {



										echo '<li><div class="da-message warning">Este documento no se ha enviado a ninguna dirección de correo</div></li>';



									}



		echo "					</ul>







							<div class='clear'></div>";



        echo "         	</div>



















						<div class='inner_item_anexo' id='mensajeria_$col[0]' style='display:none'>";



		echo "				<div class='title'>Correos Fisicos a los que se ha enviado este documento</div>";



		echo "					<div class='clear'></div>



									<ul class='sharelistdoc' id='listshare$col[0]'>";



									$queryxtty = $con->Query("select * from notificaciones_attachments inner join notificaciones on notificaciones.id = notificaciones_attachments.id_notificacion where notificaciones_attachments.id_anexo = '".$col[0]."'");



									$i = 0;



									while ($rxtty = $con->FetchAssoc($queryxtty)) {



										$i++;



										$not = new MNotificaciones;



										$not->CreateNotificaciones("id", $rxtty['id_notificacion']);







										if ($not->GetNom_archivo() == "") {



											$estadonot = "Enviada a Operador Postal";



										}else{



											$estadonot = $not->GetNom_archivo();



										}







										if ($not->GetGuia_id() == "") {



											$guiaid = "N/A";



										}else{



											$guiaid = $not->GetGuia_id();



										}



										echo 	"<li>".



														"<b>Num. Guia: </b> ".$guiaid." / ".



														"<b>Estado Actual: </b> ".$estadonot." / ".



														"<b>Fecha Envio: </b> ".$not->GetF_citacion()."<hr>".



												"</li>";



									}



									if ($i <= 0) {



										echo '<li><div class="da-message warning">Este documento no se ha enviado a ninguna dirección de correo</div></li>';



									}



		echo "					</ul>







							<div class='clear'></div>";



        echo "         	</div>



                    </div>



                </li>";



    }else{



    	echo "  <li class='anexos-li' id='ppic$col[0]'>



                    <input type='checkbox' name='servicio[]'  class='album_inner_button active_check' />



                    <div style='padding-top:0px;' class='img-icon unknow' style='width:30px' ></div>



                    <div class='nom_anexo' title='$col[nombre]'>$col[nombre]</div>



                    <div class='nom_anexo' style='float:right'>$col[fecha]</div>



                    <div class='nom_anexo' title='Tipología Documental' style='float:right'>".$tipologia."</div>";



		echo '		



						<form action="/gestion_anexos/updatephoto/'.$col[0].'/" id="formpicture'.$col[0].'"  name="formpicture'.$col[0].'" method="post" enctype="multipart/form-data">



					        <input name="archivo" id="selfile'.$col[0].'" type="file" size="35"/>



			      		</form>



		      	</li>







		      	<script>



		      		$("#selfile'.$col[0].'").change(function() {



		      			$("#formpicture'.$col[0].'").submit();



		      		});



		      	</script>';



    }







	            }



        	}else{

        		echo '<li class="anexos-li"><div class="alert alert-info">Debe escribir algo :P</div<</li>';

        	}

		}



		function UpdateOrden($id, $orden, $act, $folder = '0'){

			global $con; 

			global $f;



			$object = new MGestion_anexos;

			$object->CreateGestion_anexos("id", $id);



			$co = $con->FetchAssoc($con->Query("Select * from gestion_anexos where orden = '$orden' and gestion_id = '".$object->GetGestion_id()."' and folder_id = '".$folder."'"));



			echo "->".$act."-";

			if ($act == "1") {

				$norden = $orden + 1;

			}else{

				$norden = $orden - 1;

			}





			$ar22 = array('orden');

			$ar12 = array($norden);	

			$output = array('registro actualizado', 'no se pudo actualizar'); 

			$constrain2 = 'WHERE id = '.$co['id'];

			$this->Editar($constrain2, $ar22, $ar12, $output);





			$ar2 = array('orden');

			$ar1 = array($orden);	

			$output = array('registro actualizado', 'no se pudo actualizar'); 

			$constrain = 'WHERE id = '.$id;

			$this->Editar($constrain, $ar2, $ar1, $output);

		}



		function CompartirDocumento($rad, $doc){

			global $con;

			global $f;

			global $c;



			$g = new MGestion;

			$g->CreateGestion("min_rad", trim($doc));



			$ga = new MGestion_anexos;

			$ga->CreateGestion_anexos("id", $rad);



			if ($g->GetId() != "") {

				# code...

				copy ( ROOT.DS."/archivos_uploads/gestion/".$ga->GetGestion_id()."/anexos".DS.$ga->GetUrl(),  ROOT.DS."/archivos_uploads/gestion/".$g->GetId()."/anexos".DS.$ga->GetUrl() );

				

				//base 64

				$base_file = '';

				$data_base_file = file_get_contents($_SERVER["DOCUMENT_ROOT"]."/app/archivos_uploads/gestion/".$g->GetId()."/anexos".DS.$ga->GetUrl());

				$base_file = base64_encode($data_base_file);



				$con->Query("INSERT into gestion_anexos 

													(timest, gestion_id,  		nombre,					url,				user_id, 					ip, 						fecha, 				hora, 			folio, folder_id, folio_final, is_publico, origen,base_file) 

											values  ('".date("Y-m-d H:i:s")."', '".$g->GetId()."','".$ga->GetNombre()."','".$ga->GetUrl()."','".$_SESSION['usuario']."', '$_SERVER[REMOTE_ADDR]', '".date("Y-m-d")."', '".date("H:i:s")."', '0', '0', '0', '0', '".$ga->GetId()."','".$base_file."')");



				$id = $c->GetMaxIdTabla("gestion_anexos", "id");

				$objecte = new MEvents_gestion;

			

				echo "ok|".$g->GetNum_oficio_respuesta();

				$objecte->InsertEvents_gestion($_SESSION['usuario'], $g->GetId(), date("Y-m-d"), "Se ha Compartido un Documento", "Se ha compartido un documento hacia este expediente llamado: \"".$ga->GetNombre()."\"", date("Y-m-d"), 0, date("H:i:s"), 0, 0, 0, date("Y-m-d"), 0, $_SESSION['seccional'], $_SESSION['area_principal'], $_SESSION['area_principal'], "*", "ans", $id);

			}else{

				echo "error";

			}



		}



		function VerMetaDatos($id){

			global $con;

			global $c;

			global $f;

			if($_SESSION['MODULES']['metadatos'] == "1"){

				$ga = new MGestion_anexos;

				$ga->CreateGestion_anexos("id", $id);



				$object = new MGestion_tipologias_big_data;

				$object->CreateGestion_tipologias_big_data("proceso_id", $ga->GetId());



				if ($object->GetId() == "") {

					$object->InsertGestion_tipologias_big_data($_SESSION['usuario'], $ga->GetId(), $ga->GetTipologia(), $col_1, $col_2, $col_3, $col_4, $col_5, $col_6, $col_7, $col_8, $col_9, $col_10, $col_11, $col_12, $col_13, $col_14, $col_15);



					$object->CreateGestion_tipologias_big_data("proceso_id", $ga->GetId());	

				}



				include(VIEWS.DS.'gestion_tipologias_big_data/FormUpdateGestion_tipologias_big_data.php');

			}else{

				include(VIEWS.DS.'template/error_view.php');

			}



		}



		function EditarDatosBasicos($constrain, $fields, $updates, $output, $id){

			global $c; 

			global $con;



			$ga = new MGestion_anexos;

			$ga->CreateGestion_anexos("id", $id);



			$object = new MGestion;

			$object->CreateGestion("id", $ga->GetGestion_id());



			$changes = false;

			$path = "";



			$nombre = $c->sql_quote($_REQUEST['nombre']); 

			$folder_id = $c->sql_quote($_REQUEST['folder_id']);





			if ($ga->GetNombre() != $nombre) {

				$changes = true;

				$path .= "<li>Se edito el campo Nombre del Documento de '".$ga->GetNombre()."' por '".$nombre."' </li>";  

			}



			if ($ga->GetFolder_id() != $folder_id) {

				

				if ($ga->GetFolder_id()  == "0") {

					$foname = "Carpeta Principal";

				}else{

					$foname = $c->GetDataFromTable("gestion_folder", "id", $ga->GetFolder_id(), "nombre", "");

				}



				if ($folder_id == "0") {

					$fnname = "Carpeta Principal";

				}else{

					$fnname = $c->GetDataFromTable("gestion_folder", "id", $folder_id, "nombre", "");

				}





    			$path .= "<li>Se edito la Carpeta del '".$foname."' por '".$fnname."' </li>";  



				$changes = true;

			}





			if ($changes) {

				#echo $path;

				$this->Editar($constrain, $fields, $updates, $output);



				$objecte = new MEvents_gestion;

				// USANDO LA FUNCION DE INSERTAR DEL OBJETO PARA ENVIAR LA INFORMACION A LA BASE DE DATO

				/*  InsertEvents_gestion(	usuario_registra , 	gestion_id, 	fecha_evento, titulo, 	descripcion, 	fecha_creacion, estado(0 por defecto echo),  hora, 	$alerted = validar si alertado(0 = sin avisar, 1 = avisado), 	$avisar_a = dias para avisar, 	$type_event (ignorar), 	$fecha_vencimiento, $id_generico = si viene de alerta generica (0 =  ninguna), 	$seccional, 	$oficina, 	$area, 	$grupo = a que usuarios notificar (* = todos, B = Jefe de Area, B-X = Jefe de Area y x = otro usuario)) */

				$objecte->InsertEvents_gestion($_SESSION['usuario'], $object->GetId (), date("Y-m-d"), "Se ha editado un documento", "Se ha editado la informacion del documento  <ul>".$c->sql_quote($path)."</ul>", date("Y-m-d"), 0, date("H:i:s"), 0, 0, 0, date("Y-m-d"), 0, $_SESSION['seccional'], $_SESSION['area_principal'], $_SESSION['area_principal'], "*", "edoc", $ga->GetId());

			}





		}



		function UpdateTipologia($id, $tipo){

			global $c; 

			global $con;

			global $f;



			$ga = new MGestion_anexos;

			$ga->CreateGestion_anexos("id", $id);



			$object = new MGestion;

			$object->CreateGestion("id", $ga->GetGestion_id());



			$u = new MUsuarios;

			$u->CreateUsuarios("user_id", $_SESSION['usuario']);



			$seccional = $u->GetSeccional();

			$area = $u->GetRegimen();



			$changes = false;

			$path = "";



			if ($ga->GetTipologia() != $tipo) {

				if ($tipo == "0") {

					$tiporigen = "Sin Asignar";

				}else{

					$typol = new MDependencias_tipologias;

					$typol->CreateDependencias_tipologias("id", $tipo) ;



					$tiporigen = $c->GetDataFromTable("dependencias_tipologias", "id", $ga->GetTipologia(), "tipologia", "");

					$in_out = $c->GetDataFromTable("dependencias_tipologias", "id", $tipo, "es_entrada", "");



					

					$q = $con->Query("Select * from usuarios where seccional = '".$seccional."' and regimen = '".$area."' and estado = '1' and IsAdministrador = '1' ");

					while ($row = $con->FetchAssoc($q)) {

						$usuario_firma = $row['user_id'];						

					}



					if ($typol->GetRequiere_firma() == "SI") {

						$gaf = new MGestion_anexos_firmas;

						$gaf->InsertGestion_anexos_firmas($object->GetId(), $ga->GetId(), $typol->GetId(), date("Y-m-d H:i:s"), $_SESSION['usuario'], $usuario_firma, $fecha_firma, $codigo_firma, $clave_primaria, "0", $repo_1, $repo_2);





						$gestion_id = $ga->GetGestion_id();

						$fields = array('estado', 'in_out');

						$updates = array('3', $in_out);	

						$output = array('', ''); 

						$constrain = 'WHERE id = '.$ga->GetId();

						$ga->UpdateGestion_anexos($constrain, $fields, $updates, $output);



						$object = new MGestion_anexos_permisos;

						// USANDO LA FUNCION DE INSERTAR DEL OBJETO PARA ENVIAR LA INFORMACION A LA BASE DE DATOA			

						$create = $object->InsertGestion_anexos_permisos($ga->GetId(), $usuario_firma, "0", date("Y-m-d"), "", "<b>".$_SESSION['usuario']." dice:</b> ".$c->sql_quote($_REQUEST['p1']), $gestion_id);



						$id = $c->GetMaxIdTabla("documentos_gestion", "id");



						

						$fecha = date("Y-m-d");

						$fecha_c = date_create($fecha);//aca le pasas la fecha actual o ala que le queres sumar los dias.

						date_modify($fecha_c, "+3 day");//sumas los dias que te hacen falta.

						$fecha_vencimiento = date_format($fecha_c, "Y-m-d");//retornas la fecha en el formato que mas te guste.



						$objecte = new MEvents_gestion;

						// USANDO LA FUNCION DE INSERTAR DEL OBJETO PARA ENVIAR LA INFORMACION A LA BASE DE DATO

						/*

							InsertEvents_gestion(	usuario_registra, 	gestion_id, 	fecha_evento, titulo, 	descripcion, 	fecha_creacion, estado(0 por defecto echo),  hora, 	$alerted = validar si alertado(0 = sin avisar, 1 = avisado), 	$avisar_a = dias para avisar, 	$type_event (ignorar), 	$fecha_vencimiento, $id_generico = si viene de alerta generica (0 =  ninguna), 	$seccional, 	$oficina, 	$area, 	$grupo = a que usuarios notificar (* = todos, B = Jefe de Area, B-X = Jefe de Area y x = otro usuario))

						*/

						$responsablea = $c->GetDataFromTable("usuarios", "user_id", $usuario_firma, "p_nombre, p_apellido", $separador = " ");

						$usuario_permiso = $c->GetDataFromTable("usuarios", "user_id", $usuario_firma, "a_i", $separador = " ");

						$objecte->InsertEvents_gestion($_SESSION['usuario'], $gestion_id, date("Y-m-d"), "Solicitúd de Revisión de Documento", "Se ha compartido un documento \"".$ga->GetNombre()."\" con el usuario ".$responsablea." para que sea revisado" , date("Y-m-d"), 0, date("H:i:s"), 0, "3", 0, $fecha_vencimiento, 0, $_SESSION['seccional'], $_SESSION['area_principal'], $_SESSION['area_principal'], $usuario_permiso, "rdoc", $id_documento);

						$con->Query("insert into gestion_compartir (usuario_comparte, usuario_nuevo, gestion_id, fecha, type) VALUES ('".$_SESSION['usuario']."', '".$usuario_firma."', '".$id_documento."', '".date("Y-m-d")."', '0')");

						//SI NO SE ENVIO CORRECTAMENTE ENTONCES GENERA ERROR SINO ENVIA OK



					

						if ($typol->GetInmaterial() == "1") {

							$c->SendContabilizadorDocumentos($ga->Getcantidad(), $object->GetTipo_documento(), $object->GetId(), "AN", $ga->GetId());	

						}





						

						#echo "\nSe notificará al Jefe de ".CAMPOAREADETRABAJO." para que firme este documento";

					}else{

						#echo "\nNo se notificará al Jefe de ".CAMPOAREADETRABAJO." para que firma de este documento";

					}



				}





				



				$tipname = $c->GetDataFromTable("dependencias_tipologias", "id", $tipo, "tipologia", "");

				$path .= "<li>Se edito el campo tipología Documental de '".$tiporigen."' por '".$tipname."' </li>";  

				$changes = true;

			}



			if ($changes) {



				$in_out = $c->GetDataFromTable("dependencias_tipologias", "id", $ga->GetTipologia(), "es_entrada", "");



				$ar2 = array('tipologia', 'in_out');

				// DEFINIMOS EN OTRO VECTOR LOS NUEVOS DATOS QUE VAMOS A METER	

				$ar1 = array($tipo, $in_out);	

				// DEFINIMOS LOS ESTADOS DE SALIDA

				$output = array('registro actualizado', 'no se pudo actualizar'); 

				// Y POR ULTIMO DEFINIMOS EL CONTRAIN PARA LA ACTUALIZACION	

				$constrain = 'WHERE id = '.$id;

				$this->Editar($constrain, $ar2, $ar1, $output);



				$objecte = new MEvents_gestion;

				// USANDO LA FUNCION DE INSERTAR DEL OBJETO PARA ENVIAR LA INFORMACION A LA BASE DE DATO

				/*  InsertEvents_gestion(	usuario_registra , 	gestion_id, 	fecha_evento, titulo, 	descripcion, 	fecha_creacion, estado(0 por defecto echo),  hora, 	$alerted = validar si alertado(0 = sin avisar, 1 = avisado), 	$avisar_a = dias para avisar, 	$type_event (ignorar), 	$fecha_vencimiento, $id_generico = si viene de alerta generica (0 =  ninguna), 	$seccional, 	$oficina, 	$area, 	$grupo = a que usuarios notificar (* = todos, B = Jefe de Area, B-X = Jefe de Area y x = otro usuario)) */

				$objecte->InsertEvents_gestion($_SESSION['usuario'], $object->GetId (), date("Y-m-d"), "Se ha editado un documento ".$ga->GetNombre(), "Se ha editado la informacion del documento  <ul>".$c->sql_quote($path)."</ul>", date("Y-m-d"), 0, date("H:i:s"), 0, 0, 0, date("Y-m-d"), 0, $_SESSION['seccional'], $_SESSION['area_principal'], $_SESSION['area_principal'], "*", "edoc", $ga->GetId());



			}



		}

		function UpdateIsPublic($id, $tipo){

				global $c; 
				global $con;

				$ga = new MGestion_anexos;
				$ga->CreateGestion_anexos("id", $id);

				$object = new MGestion;
				$object->CreateGestion("id", $ga->GetGestion_id());

				$changes = false;
				$path = "";

				if ($ga->GetIs_publico() != $tipo) {
					if ($ga->GetIs_publico() == "0") {
						$tiporigen = "El Documento es Privado";
					}else{
						$tiporigen = "El Documento es Publico";
					}

					if ($tipo == "0") {
						$tipname = "El Documento es Privado";
					}else{
						$tipname = "El Documento es Publico";
					}
					$path .= "<li>Se edito el campo visibilidad del Documento de '".$tiporigen."' por '".$tipname."' </li>";  
					$changes = true;
				}

				if ($changes) {
					$ar2 = array('is_publico');
					// DEFINIMOS EN OTRO VECTOR LOS NUEVOS DATOS QUE VAMOS A METER	
					$ar1 = array($tipo);	
					// DEFINIMOS LOS ESTADOS DE SALIDA
					$output = array('registro actualizado', 'no se pudo actualizar'); 
					// Y POR ULTIMO DEFINIMOS EL CONTRAIN PARA LA ACTUALIZACION	
					$constrain = 'WHERE id = '.$id;
					$this->Editar($constrain, $ar2, $ar1, $output);
					$objecte = new MEvents_gestion;
					// USANDO LA FUNCION DE INSERTAR DEL OBJETO PARA ENVIAR LA INFORMACION A LA BASE DE DATO
					/*  InsertEvents_gestion(	usuario_registra , 	gestion_id, 	fecha_evento, titulo, 	descripcion, 	fecha_creacion, estado(0 por defecto echo),  hora, 	$alerted = validar si alertado(0 = sin avisar, 1 = avisado), 	$avisar_a = dias para avisar, 	$type_event (ignorar), 	$fecha_vencimiento, $id_generico = si viene de alerta generica (0 =  ninguna), 	$seccional, 	$oficina, 	$area, 	$grupo = a que usuarios notificar (* = todos, B = Jefe de Area, B-X = Jefe de Area y x = otro usuario)) */
					$objecte->InsertEvents_gestion($_SESSION['usuario'], $object->GetId (), date("Y-m-d"), "Se ha editado un documento ".$ga->GetNombre(), "Se ha editado la informacion del documento  <ul>".$c->sql_quote($path)."</ul>", date("Y-m-d"), 0, date("H:i:s"), 0, 0, 0, date("Y-m-d"), 0, $_SESSION['seccional'], $_SESSION['area_principal'], $_SESSION['area_principal'], "*", "edoc", $ga->GetId());
				}
		}


		function ActualizarInOut($id, $tipo, $estampar = "0"){

			global $c; 
			global $con;
			global $f;

			$ga = new MGestion_anexos;
			$ga->CreateGestion_anexos("id", $id);
			$in_out = $tipo;

			$object = new MGestion;
			$object->CreateGestion("id", $ga->GetGestion_id());

			$changes = false;
			$path = "";

			if ($ga->GetIn_out() != $tipo) {
				if ($ga->GetIn_out() == "-1") {
					$tiporigen = "El Documento es de Entrada";
				}else{
					$tiporigen = "El Documento es de Salida";
				}

				if ($tipo == "0") {
					$tipname = "El Documento es de Salida";
				}else{
					$tipname = "El Documento es de Entrada";
				}
				$path .= "<li>Se edito el campo Origen del Documento de '".$tiporigen."' por '".$tipname."' </li>";  
				$changes = true;
			}

			if ($changes) {
				$ar2 = array('in_out');
				// DEFINIMOS EN OTRO VECTOR LOS NUEVOS DATOS QUE VAMOS A METER	
				$ar1 = array($tipo);	
				// DEFINIMOS LOS ESTADOS DE SALIDA
				$output = array('registro actualizado', 'no se pudo actualizar'); 
				// Y POR ULTIMO DEFINIMOS EL CONTRAIN PARA LA ACTUALIZACION	
				$constrain = 'WHERE id = '.$id;
				$this->Editar($constrain, $ar2, $ar1, $output);
				$objecte = new MEvents_gestion;
				// USANDO LA FUNCION DE INSERTAR DEL OBJETO PARA ENVIAR LA INFORMACION A LA BASE DE DATO
				/*  InsertEvents_gestion(	usuario_registra , 	gestion_id, 	fecha_evento, titulo, 	descripcion, 	fecha_creacion, estado(0 por defecto echo),  hora, 	$alerted = validar si alertado(0 = sin avisar, 1 = avisado), 	$avisar_a = dias para avisar, 	$type_event (ignorar), 	$fecha_vencimiento, $id_generico = si viene de alerta generica (0 =  ninguna), 	$seccional, 	$oficina, 	$area, 	$grupo = a que usuarios notificar (* = todos, B = Jefe de Area, B-X = Jefe de Area y x = otro usuario)) */
				$objecte->InsertEvents_gestion($_SESSION['usuario'], $object->GetId (), date("Y-m-d"), "Se ha editado un documento ".$ga->GetNombre(), "Se ha editado la informacion del documento  <ul>".$c->sql_quote($path)."</ul>", date("Y-m-d"), 0, date("H:i:s"), 0, 0, 0, date("Y-m-d"), 0, $_SESSION['seccional'], $_SESSION['area_principal'], $_SESSION['area_principal'], "*", "edoc", $ga->GetId());
			}

			$ext = end(explode(".", $ga->GetUrl()));

			if ($estampar == "1") {
				if (strtolower($ext) == "pdf") {
					if ($in_out == "-1") {
						#$mensaje = "Estampar como Salida";
						$mensaje = 'Documento De Salida Creado por el usuario '.$_SESSION['nombre']." con el Indice ".$object->GetMin_rad()."-".$f->zerofill($ga->GetIndice(), 5)." En el Expediente ".$object->GetMin_rad();
					}else{
						$mensaje = 'Documento Cotejado por el usuario '.$_SESSION['nombre']." con el Indice ".$object->GetMin_rad()."-".$f->zerofill($ga->GetIndice(), 5)." En el Expediente ".$object->GetMin_rad();
					}

					$pdf = new FPDI(); 
				    $path_file2 = $ga->GetUrl();
				    $path_file2 = $_SERVER["DOCUMENT_ROOT"]."app/archivos_uploads/gestion/".$ga->GetGestion_id().trim("/anexos/ ").$ga->GetUrl();
				    
				    $file = realpath($path_file2);
				    $pagecount = $pdf->setSourceFile($file);

				    $linkfile = HOMEDIR.DS."app/archivos_uploads/gestion/".$ga->GetGestion_id().trim("/anexos/ ").$ga->GetUrl();

				    for($i = 1 ; $i <= $pagecount ; $i++){

			            $tpl  = $pdf->importPage($i);
			            $size = $pdf->getTemplateSize($tpl);
			            $orientation = $size['h'] > $size['w'] ? 'P':'L';

						$pdf->Rect(3, 4, 180, 4, 'F', array(), array(255,255,255));						
			            $pdf->SetFont('Helvetica', 0, '10');
			            $pdf->SetTextColor(0, 0, 0);
			            $pdf->SetXY(3, 4);
			            $pdf->Write(0, $mensaje);
						#$pdf->Image('http://chart.googleapis.com/chart?chs=50x50&cht=qr&chl='.$linkfile,180,2,25,25);

			            $pdf->AddPage($orientation);
			            $pdf->useTemplate($tpl, null, null, $size['w'], $size['h'], true);
			        }
				    
				    $pdf->Output($path_file2, 'F');

				}else{
					echo "El documento no es un PDF y no puede ser estampado";
				}
			}
		}



		function OrganizarFolio($id, $from, $to, $total){





				global $c; 

				global $con;



				$ga = new MGestion_anexos;

				$ga->CreateGestion_anexos("id", $id);



				$object = new MGestion;

				$object->CreateGestion("id", $ga->GetGestion_id());



				$changes = false;

				$path = "";



				if ($ga->GetCantidad() != $total) {



					$path .= "<li>Se edito la cantidad de folios del  documento de '".$ga->GetCantidad()."' por '".$total."' </li>";  

					$changes = true;



				}



				if ($changes) {



					// DEFINIMOS EN UN VECTOR LOS CAMPOS QUE VAMOS A EDITAR

					$ar2 = array('folio', 'folio_final', 'cantidad');

					// DEFINIMOS EN OTRO VECTOR LOS NUEVOS DATOS QUE VAMOS A METER	

					$ar1 = array($from, $to, $total);	

					// DEFINIMOS LOS ESTADOS DE SALIDA

					$output = array('registro actualizado', 'no se pudo actualizar'); 

					// Y POR ULTIMO DEFINIMOS EL CONTRAIN PARA LA ACTUALIZACION	

					$constrain = 'WHERE id = '.$id;



					$this->Editar($constrain, $ar2, $ar1, $output);





					$objecte = new MEvents_gestion;

					// USANDO LA FUNCION DE INSERTAR DEL OBJETO PARA ENVIAR LA INFORMACION A LA BASE DE DATO

					/*  InsertEvents_gestion(	usuario_registra , 	gestion_id, 	fecha_evento, titulo, 	descripcion, 	fecha_creacion, estado(0 por defecto echo),  hora, 	$alerted = validar si alertado(0 = sin avisar, 1 = avisado), 	$avisar_a = dias para avisar, 	$type_event (ignorar), 	$fecha_vencimiento, $id_generico = si viene de alerta generica (0 =  ninguna), 	$seccional, 	$oficina, 	$area, 	$grupo = a que usuarios notificar (* = todos, B = Jefe de Area, B-X = Jefe de Area y x = otro usuario)) */

					$objecte->InsertEvents_gestion($_SESSION['usuario'], $object->GetId (), date("Y-m-d"), "Se ha editado un documento ".$ga->GetNombre(), "Se ha editado la informacion del documento  <ul>".$c->sql_quote($path)."</ul>", date("Y-m-d"), 0, date("H:i:s"), 0, 0, 0, date("Y-m-d"), 0, $_SESSION['seccional'], $_SESSION['area_principal'], $_SESSION['area_principal'], "*", "edoc", $ga->GetId());



				}

		}



		function EliminarDocumento(){

			global $c; 

			global $con;



			$ga = new MGestion_anexos;

			$ga->CreateGestion_anexos("id", $_REQUEST['iddoc']);



			$object = new MGestion;

			$object->CreateGestion("id", $ga->GetGestion_id());

			$estado = ($c->sql_quote($_REQUEST['estado']) == "0")?"ELIMINADO":$c->sql_quote($_REQUEST['estado']);


			$path = "<li>El documento ha sido: '".$estado."'</li>";  

			$changes = true;



			if ($changes) {



				$ar2 = array('estado');

				// DEFINIMOS EN OTRO VECTOR LOS NUEVOS DATOS QUE VAMOS A METER	

				$ar1 = array($c->sql_quote($_REQUEST['estado']));	

				// DEFINIMOS LOS ESTADOS DE SALIDA

				$output = array('registro actualizado', 'no se pudo actualizar'); 

				// Y POR ULTIMO DEFINIMOS EL CONTRAIN PARA LA ACTUALIZACION	

				$constrain = 'WHERE id = '.$_REQUEST['iddoc'];



				$this->Editar($constrain, $ar2, $ar1, $output);

				$objecte = new MEvents_gestion;

				// USANDO LA FUNCION DE INSERTAR DEL OBJETO PARA ENVIAR LA INFORMACION A LA BASE DE DATO

				/*  InsertEvents_gestion(	usuario_registra , 	gestion_id, 	fecha_evento, titulo, 	descripcion, 	fecha_creacion, estado(0 por defecto echo),  hora, 	$alerted = validar si alertado(0 = sin avisar, 1 = avisado), 	$avisar_a = dias para avisar, 	$type_event (ignorar), 	$fecha_vencimiento, $id_generico = si viene de alerta generica (0 =  ninguna), 	$seccional, 	$oficina, 	$area, 	$grupo = a que usuarios notificar (* = todos, B = Jefe de Area, B-X = Jefe de Area y x = otro usuario)) */
	
				$objecte->InsertEvents_gestion($_SESSION['usuario'], $object->GetId(), date("Y-m-d"), "Se ha actualizado el estado del documento ".$ga->GetNombre(), "<ul>".$c->sql_quote($path)."</ul>", date("Y-m-d"), 0, date("H:i:s"), 0, 0, 0, date("Y-m-d"), 0, $_SESSION['seccional'], $_SESSION['area_principal'], $_SESSION['area_principal'], "*", "edoc", $ga->GetId());



			}
		}

		function DescargarFullExpediente($id){
			// drvy
			global $con;
			global $c;
			global $f;


			//CARGANDO LA PAGINA DE INTERFAZ			
			$object = new MSuscriptores_Contactos;
	    	#$query = $object->ListarSuscriptores_modulos();

			$pagina = $this->load_template_limpia('Descarga del Expediente');			

			// CARGANDO LLAMANDO LA FUNCION LSITAR LIBROS DEL MODELO (FUNCION QUE TRAE DE LA BASE DE DATOS EL LISTADO DE LIBROS

			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.

			ob_start();

		
			include(VIEWS.DS.'gestion_anexos/vista_descarga_expediente.php');

			$table = ob_get_clean();	

			// SI NO TRAE NINGUNA VARIABLE ENTONCES GENERA UN ERROR

			if($message != '')

			$pagina = $this->replace_content('/\#ERROR_MESSAGE\#/ms', $message , $pagina);

			// DE LO CONTRARIO ENTONCES CARGA EL CONTENIDO DE LA PAGINA																

			$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $table , $pagina);

			// RETORNAME LA PAGINA CARGADA		

			$this->view_page($pagina);

			 
		}

		function EliminarDocumentos(){

			global $c; 
			global $f;
			global $con;

			$elementos = implode(',', $_REQUEST['campos']);
			$listaelementos = explode(",", $elementos);
			echo "Los Documentos Eliminados";
			for ($j=0; $j < count($listaelementos) ; $j++) { 
				
				$ga = new MGestion_anexos;
				$ga->CreateGestion_anexos("id", $listaelementos[$j]);
				$object = new MGestion;
				$object->CreateGestion("id", $ga->GetGestion_id());

				$estado = "ELIMINADO DEL SISTEMA POR EL ADMINISTRADOR";

				$path = "<li>El documento ha sido: '".$estado."'</li>";  
				$changes = true;

				if ($changes) {

					$ar2 = array('estado');
					// DEFINIMOS EN OTRO VECTOR LOS NUEVOS DATOS QUE VAMOS A METER	
					$ar1 = array("-1");	
					// DEFINIMOS LOS ESTADOS DE SALIDA
					$output = array('registro actualizado', 'no se pudo actualizar'); 
					// Y POR ULTIMO DEFINIMOS EL CONTRAIN PARA LA ACTUALIZACION	
					$constrain = 'WHERE id = '.$listaelementos[$j];
					$this->Editar($constrain, $ar2, $ar1, $output);

					$objecte = new MEvents_gestion;
					$objecte->InsertEvents_gestion($_SESSION['usuario'], $object->GetId(), date("Y-m-d"), "Se ha actualizado el estado del documento ".$ga->GetNombre(), "<ul>".$c->sql_quote($path)."</ul>", date("Y-m-d"), 0, date("H:i:s"), 0, 0, 0, date("Y-m-d"), 0, $_SESSION['seccional'], $_SESSION['area_principal'], $_SESSION['area_principal'], "*", "edoc", $ga->GetId());
				}
			}
			/*
			*/

		}

	}

?>
