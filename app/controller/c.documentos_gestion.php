<?
session_start();
#error_reporting(E_ALL);
#ini_set('display_errors', '1');

	//Invocando archivos que seran usados en nuestro controlador generico	

	include_once('app/basePaths.inc.php');

	include_once(MODELS.DS.'Documentos_gestionM.php');

	include_once(ROOT.DS.'DALC'.DS.'/mySql.php');

	include_once('consultas.php');

	include_once('funciones.php');	

	include_once(MODELS.DS.'GestionM.php');

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


	include_once(MODELS.DS.'Meta_referencias_titulosM.php');
	include_once(MODELS.DS.'Meta_referencias_camposM.php');
	include_once(MODELS.DS.'Meta_tipos_elementosM.php');
	include_once(MODELS.DS.'Meta_listasM.php');




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

	$ob = new CDocumentos_gestion;

	$c = new Consultas;

	$f = new Funciones;

	

	// DEFINIMOS EN UN VECTOR LOS CAMPOS QUE VAMOS A EDITAR

	$ar2 = array('user_id', 'gestion_id', 'nombre', 'f_creacion', 'f_actualizacion', 'contenido', 'tipo_doc');

	// DEFINIMOS EN OTRO VECTOR LOS NUEVOS DATOS QUE VAMOS A METER	

	$ar1 = array($c->sql_quote($_REQUEST['user_id']), $c->sql_quote($_REQUEST['gestion_id']), $c->sql_quote($_REQUEST['nombre']), $c->sql_quote($_REQUEST['f_creacion']), $c->sql_quote($_REQUEST['f_actualizacion']), $c->sql_quote($_REQUEST['descripcion']), $c->sql_quote($_REQUEST['tipo_doc']) );	

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

			$ob->Insertar($c->sql_quote($_REQUEST["user_id"]), $c->sql_quote($_REQUEST["gestion_id"]), $c->sql_quote($_REQUEST["nombre"]), $c->sql_quote($_REQUEST["f_creacion"]), $c->sql_quote($_REQUEST["f_actualizacion"]), $c->sql_quote($_REQUEST["descripcion"]), $c->sql_quote($_REQUEST["tipo_doc"]), $c->sql_quote($_REQUEST["emails_listado_seleccion"]), $c->sql_quote($_REQUEST["diasmaxtoresponse"]), $c->sql_quote($_REQUEST["observacion"]), $c->sql_quote($_REQUEST["titx"]));

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

		elseif($c->sql_quote($_REQUEST['action']) == 'exportardocumento')

			$ob->ExportarDocumento($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['cn']), $c->sql_quote($_REQUEST['p1']));		

		else

		// SI NO ES NINGUNA DE LAS ANTERIORES ENTONCES CARGA POR DEFECTO LA VISTA DE LISTADO		

			$ob->VistaListar('');		

	

	// DEFINIENDO LA CLASE DEL CONTROLADOR DEL OBJETO QUE TIENE HERENCIA CON EL CONTROLADOR GENERICO PARA CARGAR LA INTERFAZ

	class CDocumentos_gestion extends MainController{

		

		// DEFINIENDO LA FUNCION LISTAR 		

		function VistaListar(){

			// CREANDO UN NUEVO MODELO			

			$object = new MDocumentos_gestion;

			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL			

			global $con;

			//CARGANDO LA PAGINA DE INTERFAZ			

			$pagina = $this->load_template('Listar Documentos_gestion');			

			// CARGANDO LLAMANDO LA FUNCION LSITAR LIBROS DEL MODELO (FUNCION QUE TRAE DE LA BASE DE DATOS EL LISTADO DE LIBROS

			// DE NO RECIBIR PARAMETROS ESTA FUNCION TRAE EL LISTADO COMPLETO DE LIBROS

			$query = $object->ListarDocumentos_gestion();	    

			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.

			ob_start();

				// SI LA CONSULTA NO SE EJECUTA ENTONCES RETORNA VACIO

		   		if($con->NumRows($query) <= 0 || $query !=''){

					// SI LA CONSULTA SE EJECUTA ENTONCES CARGA EL LISTADO DE LIBROS DE LA VISTA

					include_once(VIEWS.DS.'documentos_gestion/Listar.php');	   			

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

		function VistaInsertar($id){



			global $con;

			global $f;

			// CREANDO UN NUEVO MODELO	

			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL			

			$pagina = $this->load_template(PROJECTNAME.ST." Ver Gestion el Radicado $id");

			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.

			ob_start();				

			// SI LA CONSULTA SE EJECUTA ENTONCES CARGA EL LISTADO DE LIBROS DE LA VISTA

			$object = new MGestion;

			// LO CREAMOS 			

			$object->CreateGestion('id', $id);

			// Y FINALMENTE CARGAMOS LA VISTA DE EDICION QUE MUESTRA EL CONTENIDO			

			include_once(VIEWS.DS.'documentos_gestion/FormInsertDocumentos_gestion.php');



			// OBTIENE EL CONTENIDO DEL BÚFER ACTUAL Y ELIMINA EL BÚFER DE SALIDA ACTUAL.			

			$table = ob_get_clean();	

			// SI NO TRAE NINGUNA VARIABLE ENTONCES GENERA UN ERROR

			// DE LO CONTRARIO ENTONCES CARGA EL CONTENIDO DE LA PAGINA																

			$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $table , $pagina);

			// RETORNAME LA PAGINA CARGADA		

			$this->view_page($pagina);







		}

		// FUCNION QUE CARGA LA VISTA PARA EDITAR EL CONTENIDO DE UN REGISTRO

		function VistaEditar($x){

			// CARGA EL TEMPLATE			

	 		$pagina = $this->load_template('Editar Documentos_gestion');			

			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.

			ob_start();		

	 		// INVOCAMOS UN NUEVO OBJETO

		 	$object = new MDocumentos_gestion;

			// LO CREAMOS 			

			$object->CreateDocumentos_gestion('id', $x);

			// Y FINALMENTE CARGAMOS LA VISTA DE EDICION QUE MUESTRA EL CONTENIDO			

			include_once(VIEWS.DS.'documentos_gestion/FormUpdateDocumentos_gestion.php');		

			// OBTIENE EL CONTENIDO DEL BÚFER ACTUAL Y ELIMINA EL BÚFER DE SALIDA ACTUAL.											

			$table = ob_get_clean();	

			// ASIGNANDOLE A LA VARIABLE  EL CONTENIDO DEL BUFFER															

			$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $table  , $pagina);

			// CARGAMOS LA PAGINA EN EL BROWSER		

			$this->view_page($pagina);

	 	}	

	 	function Buscar($x, $cn = 'id'){

	 		// INVOCAMOS UN NUEVO OBJETO						

			$object = new MDocumentos_gestion;

			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL						

			global $con;

			// CARGA EL TEMPLATE						

			$pagina = $this->load_template('Listado de Documentos_gestion');			

			// OBTENEMOS EL LISTADO DE LIBROS DE ACUERDO A LOS PARAMETROS QUE LE ENVIAMOS						

			$query = $object->ListarDocumentos_gestion('WHERE '.$cn.' = "'.$x.'"');	    

			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.

			ob_start();		

		   		if($con->NumRows($query) <= 0 || $query !=''){

					// SI LA CONSULTA NO SE EJECUTA ENTONCES RETORNA VACIO							

					include_once(VIEWS.DS.'documentos_gestion/Listar.php');	   			

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

		function Insertar($user_id, $gestion_id, $nombre, $f_creacion, $f_actualizacion, $contenido, $tipo_doc, $emails_listado_seleccion, $diasmaxtoresponse, $observacion, $tipologia){

			// DEFINIENDO EL OBJETO

			global $con;

			global $c;		

			if ($nombre == "") {
				$nombre = "Documento sin titulo";
			}

			$object = new MDocumentos_gestion;

			// USANDO LA FUNCION DE INSERTAR DEL OBJETO PARA ENVIAR LA INFORMACION A LA BASE DE DATOA			

			$create = $object->InsertDocumentos_gestion($user_id, $gestion_id, $nombre, $f_creacion, $f_actualizacion, $contenido, $tipo_doc, $tipologia);



			

			$id = $c->GetMaxIdTabla("documentos_gestion", "id");



			$listado = explode(";", $emails_listado_seleccion);



			$fecha = date("Y-m-d");

			$fecha_c = date_create($fecha);//aca le pasas la fecha actual o ala que le queres sumar los dias.

			date_modify($fecha_c, "+$diasmaxtoresponse day");//sumas los dias que te hacen falta.

			$fecha_vencimiento = date_format($fecha_c, "Y-m-d");//retornas la fecha en el formato que mas te guste.

		

			

			$objecte = new MEvents_gestion;

			// USANDO LA FUNCION DE INSERTAR DEL OBJETO PARA ENVIAR LA INFORMACION A LA BASE DE DATO

			/*

				InsertEvents_gestion(	usuario_registra, 	gestion_id, 	fecha_evento, titulo, 	descripcion, 	fecha_creacion, estado(0 por defecto echo),  hora, 	$alerted = validar si alertado(0 = sin avisar, 1 = avisado), 	$avisar_a = dias para avisar, 	$type_event (ignorar), 	$fecha_vencimiento, $id_generico = si viene de alerta generica (0 =  ninguna), 	$seccional, 	$oficina, 	$area, 	$grupo = a que usuarios notificar (* = todos, B = Jefe de Area, B-X = Jefe de Area y x = otro usuario))

			*/

			$objecte->InsertEvents_gestion($_SESSION['usuario'], $gestion_id, date("Y-m-d"), "Nuevo Documento", "Se ha creado un nuevo documento llamado: \"".$nombre."\"", date("Y-m-d"), 0, date("H:i:s"), 0, $diasmaxtoresponse, 0, $fecha_vencimiento, 0, $_SESSION['seccional'], $_SESSION['area_principal'], $_SESSION['area_principal'], "*", "doc", $id);





			for ($i=0; $i < count($listado); $i++) { 

				# code...

				if ($listado[$i] != "") {

					$estado = 0;



					if ($listado[$i] == $_SESSION['usuario']) {



						$estado = "1";

						$fecha_actualizacion = date("Y-m-d H:i:s");

					}else{

						$fecha_actualizacion = "";

						$con->Query("INSERT INTO alertas (fechahora, user_id, type, log, status, extra, id_gestion, id_act) VALUES ('".date("Y-m-d H:i:s")."','".$listado[$i]."', '1', '".$c->GetIdLog($fecha_vencimiento)."', '0', 'pr', '$gestion_id', '$id')");



					}

					$pdoc = new MDocumentos_gestion_permisos;

					$pdoc->InsertDocumentos_gestion_permisos($id, $listado[$i], $estado, date("Y-m-d"), $fecha_actualizacion, $observacion);



				}

			}



			echo '<script> window.location.href = "'.HOMEDIR.DS.'gestion/ver/'.$gestion_id.'/documentos/"</script>';					

#			echo '<script> window.location.href = "'.HOMEDIR.DS.'gestion/ver/'.$gestion_id.'/"</script>';					



		}

		// FUNCION QUE RECIBE UNASERIE DE PARAMETROS Y LOS ENVIA A LA BASE DE DATOS PARA ACTUALIZAR UN REGISTRO (FUNCION ESPECIAL)		

		function Editar($constrain, $fields, $updates, $output){

			global $con;

			

			$object = new MDocumentos_gestion;

			$create = $object->UpdateDocumentos_gestion($constrain, $fields, $updates, $output);

			

			$object->CreateDocumentos_gestion("id", $_REQUEST['id']);



			$objecte = new MEvents_gestion;

			// USANDO LA FUNCION DE INSERTAR DEL OBJETO PARA ENVIAR LA INFORMACION A LA BASE DE DATO

			/*

				InsertEvents_gestion(	usuario_registra, 	gestion_id, 	fecha_evento, titulo, 	descripcion, 	fecha_creacion, estado(0 por defecto echo),  hora, 	$alerted = validar si alertado(0 = sin avisar, 1 = avisado), 	$avisar_a = dias para avisar, 	$type_event (ignorar), 	$fecha_vencimiento, $id_generico = si viene de alerta generica (0 =  ninguna), 	$seccional, 	$oficina, 	$area, 	$grupo = a que usuarios notificar (* = todos, B = Jefe de Area, B-X = Jefe de Area y x = otro usuario))

			*/

			$objecte->InsertEvents_gestion($_SESSION['usuario'], $object->GetGestion_id(), date("Y-m-d"), "Documento Editado", "Se ha editado el documento: ".$object->GetNombre(), date("Y-m-d"), 0, date("H:i:s"), 0, 0, 0, date("Y-m-d"), 0, $_SESSION['seccional'], $_SESSION['area_principal'], $_SESSION['area_principal'], "*", "doc", $object->GetId());



			$con->Query("update documentos_gestion_permisos set estado = '0' where id_documento = '".$object->GetId()."'");

			

			//SI NO SE ENVIO CORRECTAMENTE ENTONCES GENERA ERROR SINO ENVIA OK

			echo '<script> window.location.href = "/gestion/ver/'.$_REQUEST['gestion_id'].'/documentos/"</script>';					

		}

		// FUCNION QUE RECIBE UN PARAMETRO Y ELIMINA EL REGISTRO DE LA BASE DE DATOS		

		function Eliminar($id){

			// DEFINIMOS UN OBJETO NUEVO						

			$object = new MDocumentos_gestion;

			// LLAMAMOS A LA FUNCION QUE EJECUTA LA ELIMINACION.			

			$delete = $object->DeleteDocumentos_gestion($id); 		

			//SI NO SE ENVIO CORRECTAMENTE ENTONCES GENERA ERROR SINO ENVIA OK

			if($delete != '1')

				echo 'ERROR AL ELIMINAR';

			else

				echo 'OK!';			

			

		}



		function ExportarDocumento($id, $gestion_id, $exportar){

			global $con;
			global $c;
			global $f;

			$doc = new MDocumentos_gestion;
			$doc->CreateDocumentos_gestion("id", $id);

			$pdoc = new MDocumentos_gestion_permisos;
			$listado_permisos = $pdoc->ListarDocumentos_gestion_permisos("where id_documento = '".$id."'");
			$alow = true;

			if ($con->NumRows($listado_permisos) > 0) {
				# code...
				$pathp = "Documento Revisado por Los usuarios: <br>";

				while ($row = $con->FetchAssoc($listado_permisos)) {

					$usuario = new MUsuarios;
					$usuario->CreateUsuarios("user_id", $row["usuario_permiso"]);

					$pathp .= ucwords(strtolower($usuario->GetP_nombre()." ".$usuario->GetP_apellido()))." el día ".$f->ObtenerFecha4($row['fecha_actualizacion'])." <br>";

	            	$estado = "Sin Activar";
	            	if ($row[estado] != 1) {
	            		$alow = false;
	            	}
	            	
	            }
			}


 			if ($alow) {
    			
				$name = md5($_SESSION["usuario"].date("Y-m-d H:i:s")).".pdf";
				$nameqr = md5($_SESSION["usuario"].date("Y-m-d H:i:s")).".png";

				$urlfile = UPLOADS.DS.$gestion_id.'/anexos/'.$name;
				$urlfilqr = FILESAT.DS.$gestion_id.'/anexos/'.$name;
				$urlqr = UPLOADS.DS.'qr/'.$nameqr;

				$sadmin = new MSuper_admin;
				$sadmin->CreateSuper_admin("id", "6");

				$config = new MPlantilla_documento_configuracion;
				$config->CreatePlantilla_documento_configuracion("id", "1");



				QRcode::png($urlfilqr, $urlqr); // creates file 

				$string = hash("sha256", $id.$_SESSION["usuario"].date("Y-m-d").date("H:i:s").$_SERVER["REMOTE_ADDR"]); 
			#	include(APP.'plugins/mix_images/index.php');
				$timestamp = "";
				$foot = "<div><div style='font-size:10px; float:left'>";

				$foot .= $pathp;

				#$foot .= "Este documento  se encuentra firmado digital y electrónicamente. Cuando este documento sea enviado electrónicamente como mensaje de datos generará una guía electrónica que  garantiza que es único e irrepetible.convirtiéndolo en un documento auténtico según la ley 527 de 1999.</div></div>";

				$fpath = '<html><head></head><body>'.$timestamp;
				$lpath = $foot.'</body></html>';

				$html = utf8_decode($fpath.html_entity_decode($doc->GetContenido()).$lpath);
				
				$em = new MSuper_admin;
				$em->CreateSuper_admin("id", $_SESSION['id_empresa']);

				$encabezado = HOMEDIR.DS."app/plugins/thumbnails/".$em->GetEncabezado();
				$pie_pagina = HOMEDIR.DS."app/plugins/thumbnails/".$em->GetPie_pagina();


				$m_t 	= ($config->GetM_t() * 28) -100;
				$m_r	= $config->GetM_r() * 28;
				$m_b	= 100 - ($config->GetM_b() * 28);
				$m_l	= ($config->GetM_l() * 28) -20;
				$m_e_t	= 150 - ($config->GetM_e_t() * 28);
				$m_e_b	= $config->GetM_e_b() * 28;
				$m_p_t	= $config->GetM_p_t() * 28;
				$m_p_b	= $config->GetM_p_b() * 28;
				$fuente = $config->GetFuente();
				$tamano = $config->GetTamano();

				$html2 = '
							<html>
							<head>
							  <style>
								@font-face {
									font-family: "def_font";
									src: url('.HOMEDIR.DS.'app/views/assets/fonts/'.$fuente.');
								}
							    @page { margin: 150px 0px; font-size: '.$tamano.'px; font-family: "def_font", Arial; }
							    #header { position: fixed; left: 0px; right: 0px; top:-'.$m_e_t.'px; width:120%; height: 100px; background: URL('.$encabezado.') no-repeat; background-size: contain; text-align: center; }
                                #footer { position: fixed; left: 0px; right: 0px; bottom: -130px; height: 110px; width:120%; background: URL('.$pie_pagina.') no-repeat; background-size: contain; text-align: center; }
							    #content { margin: '.$m_t.'px '.$m_r.'px -'.$m_b.'px '.$m_l.'px; font-family: "def_font", Arial; }
							  </style>
							</head> 
							<body>
							  <div id="header">&nbsp;</div>
							  <div id="footer"><p class="page">&nbsp;</p></div>
							  <div id="content">
							   '.$html.'
							  </div>
							</body>
							</html>';

                #echo $html2;
                
                $html2 = preg_replace('/>\s+</', '><', $html2);
				$dompdf = new DOMPDF();


				$dompdf->set_paper('letter','');
				$dompdf->load_html($html2);
				ini_set("memory_limit","512M"); 
				$dompdf->render();
				/*
					DOCUMENTAR LA SIGUIENTE LINEA AL TERMINAR
					$dompdf->stream('my.pdf',array('Attachment'=>0));
				*/

				/* 
				*/
				$pdf = $dompdf->output();

				if (file_put_contents($urlfile, $pdf)) {

					$car = new MGestion_anexos;
					$tot  = $car->ListarGestion_anexos("WHERE gestion_id = '".$gestion_id."'");

					$fol = $con->NumRows($tot);
					$fol += 1;
					$user_id = $_SESSION['usuario'];

					//base 64
					$base_file = '';
					$data_base_file = file_get_contents($_SERVER["DOCUMENT_ROOT"]."/app/archivos_uploads/gestion/".$gestion_id."/anexos".DS.$name);

					$base_file = base64_encode($data_base_file);			
					
					$con->Query("INSERT into gestion_anexos (timest, gestion_id,nombre,url,user_id, ip, fecha, hora, folio, hash,base_file, tipologia) values ('".date("Y-m-d H:i:s")."', '".$gestion_id."','".$doc->GetNombre().".pdf','".$name."','$user_id', '$_SERVER[REMOTE_ADDR]', '".date("Y-m-d")."', '".date("H:i:s")."', '".$fol."', '".$string."','".$base_file."', '".$doc->GetTipologia()."')");


					$id = $c->GetMaxIdTabla("gestion_anexos", "id");					

					$objecte = new MEvents_gestion;
					// USANDO LA FUNCION DE INSERTAR DEL OBJETO PARA ENVIAR LA INFORMACION A LA BASE DE DATO
					$objecte->InsertEvents_gestion($_SESSION['usuario'], $gestion_id, date("Y-m-d"), "Documento Exportado", "El Documento: \"".$doc->GetNombre()."\" ha sido exportado al expediente", date("Y-m-d"), 0, date("H:i:s"), 0, 0, 0, date("Y-m-d"), 0, $_SESSION['seccional'], $_SESSION['area_principal'], $_SESSION['area_principal'], "*", "expdpc", $id);


					/* AQUI INICIA PROCESO DE FIRMA DIGITAL DEL DOCUMENTO*/
					$doc = new MGestion_anexos;
					$doc->CreateGestion_anexos("id", $id);


						$object = new MGestion_anexos_permisos;
						// USANDO LA FUNCION DE INSERTAR DEL OBJETO PARA ENVIAR LA INFORMACION A LA BASE DE DATOA			
						$create = $object->InsertGestion_anexos_permisos($id, $_SESSION['usuario'], 0, date("Y-m-d"), "", "<b>".$_SESSION['usuario']." dice:</b> Documento generado desde el sistema y firmado digitalmente ", $gestion_id);

						
						if ($exportar == "1") {
							#SOLICITUD DE FIRMA DEL DOCUMENTO
							$typol = new MDependencias_tipologias;
							$typol->CreateDependencias_tipologias("id", $doc->GetTipologia()) ;
							$tiporigen = $c->GetDataFromTable("dependencias_tipologias", "id", $doc->GetTipologia(), "tipologia", "");

							$gaf = new MGestion_anexos_firmas;
							$gaf->InsertGestion_anexos_firmas($gestion_id, $doc->GetId(), $typol->GetId(), date("Y-m-d H:i:s"), $_SESSION['usuario'], $_SESSION['usuario'], "", "", "", "0", "", "");
							
							$query = $gaf->ListarGestion_anexos_firmas("where usuario_firma = '".$_SESSION['usuario']."' and estado_firma = '0' and gestion_id = '$gestion_id' and anexo_id='".$doc->GetId()."'");

							$row = $con->FetchAssoc($query);
							$idretorno = $row['id'];
							#FIN SOLICITUD DE FIRMA DEL DOCUMENTO		
						}else{
							$idretorno = "0";
						}

						$fecha = date("Y-m-d");
						$fecha_c = date_create($fecha);//aca le pasas la fecha actual o ala que le queres sumar los dias.
						date_modify($fecha_c, "+$diasmaxtoresponse day");//sumas los dias que te hacen falta.
						$fecha_vencimiento = date_format($fecha_c, "Y-m-d");//retornas la fecha en el formato que mas te guste.
						
						$objecte = new MEvents_gestion;

						$responsablea = $c->GetDataFromTable("usuarios", "user_id", $_SESSION['usuario'], "p_nombre, p_apellido", $separador = " ");
						$usuario_permiso = $_SESSION['usuario'];
						$objecte->InsertEvents_gestion($_SESSION['usuario'], $gestion_id, date("Y-m-d"), "Solicitúd de Revisión de Documento", "Se ha compartido un documento \"".$doc->GetNombre()."\" con el usuario ".$responsablea." para que sea revisado" , date("Y-m-d"), 0, date("H:i:s"), 0, $diasmaxtoresponse, 0, $fecha_vencimiento, 0, $_SESSION['seccional'], $_SESSION['area_principal'], $_SESSION['area_principal'], $usuario_permiso, "rdoc", $id_documento);

						$con->Query("insert into gestion_compartir (usuario_comparte, usuario_nuevo, gestion_id, fecha, type) VALUES ('".$_SESSION['usuario']."', '".$usuario_permiso_username."', '".$id_documento."', '".date("Y-m-d")."', '0')");



					echo $idretorno."@@Documento Exportado a Anexos";



				}
			}else{
				echo "El documento aun no ha sido habilitado para ser exportado.";	                	
            }

		}
	}
?>