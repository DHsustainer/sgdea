<?
session_start();

date_default_timezone_set("America/Bogota");

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

	include_once(MODELS.DS.'Firmas_usuariosM.php');

	include_once(MODELS.DS.'Gestion_anexos_firmasM.php');

	include_once(MODELS.DS.'Mailer_messageM.php');

	include_once(MODELS.DS.'Mailer_attachmentsM.php');

	include_once(MODELS.DS.'Mailer_from_messageM.php');

	include_once(MODELS.DS.'Mailer_replysM.php');

	include_once(PLUGINS.DS.'messages.php');

	##include_once(PLUGINS.DS.'PHPMailer_5.2.4/class.phpmailer.php');	

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

	include_once(MODELS.DS.'Usuarios_configurar_firma_digitalM.php');

	include_once(MODELS.DS.'SortM.php');

	require_once(PLUGINS.DS.'tcpdf/tcpdf.php');

	require_once(PLUGINS.DS.'FPDI/fpdi.php');

	include_once(ROOT.DS.'DALC'.DS.'/mySql.php');

	include_once('consultas.php');

	include_once('funciones.php');	

	class PDFI extends FPDI
	            {
	                public function Footer() {}
	                public function Header() {}
	            }

	// Definiendo variables y conectandonos con la base de datos

	$con = new ConexionBaseDatos;

	$con->Connect($con);

	// Llamando al objeto a controlar		

	$ob = new CFirmas_usuarios;

	$c = new Consultas;

	$f = new Funciones;

	$m = new Messages;

	// DEFINIMOS EN UN VECTOR LOS CAMPOS QUE VAMOS A EDITAR

	$ar2 = array('username', 'SID', 'fecha_firma', 'fecha_expiracion', 'firma', 'estado_firma');

	// DEFINIMOS EN OTRO VECTOR LOS NUEVOS DATOS QUE VAMOS A METER	

	$ar1 = array($c->sql_quote($_REQUEST['username']), $c->sql_quote($_REQUEST['SID']), $c->sql_quote($_REQUEST['fecha_firma']), $c->sql_quote($_REQUEST['fecha_expiracion']), $c->sql_quote($_REQUEST['firma']), $c->sql_quote($_REQUEST['estado_firma']));	

	// DEFINIMOS LOS ESTADOS DE SALIDA

	$output = array('registro actualizado', 'no se pudo actualizar'); 

	// Y POR ULTIMO DEFINIMOS EL CONTRAIN PARA LA ACTUALIZACION	

	$constrain = 'WHERE id = '.$_REQUEST['id'];

		// LA FUNCION SQLQUOTE de la clase Consultas se encarga de fultrar las variables recibidas por GET o por POST para evitar la inyeccion de SQL

		// esta funcion solo funciona cuando se ha establecido conexion con la base de datos

		// SI LA ACTION CAPTURADA ES LISTAR ENTONCES LISTA

		if($c->sql_quote($_REQUEST['action']) == 'listar')

			$ob->VistaListar();	

		// SINO SI ES NUEVO ENTONCES CARGA EL FORMULARIO INSERTAR	

		elseif($c->sql_quote($_REQUEST['action']) == 'nuevo')	

			$ob->VistaInsertar();

		// SINO SI ES INSERTAR ENTONCES CARGA EL INSERTAR	

		elseif($c->sql_quote($_REQUEST['action']) == 'registrar')

		// CAPTURA LAS VARIAABLES Y ENVIALAS A LA FUNCION INSERTAR		

			$ob->Insertar($c->sql_quote($_REQUEST["username"]), $c->sql_quote($_REQUEST["SID"]), $c->sql_quote($_REQUEST["fecha_firma"]), $c->sql_quote($_REQUEST["fecha_expiracion"]), $c->sql_quote($_REQUEST["firma"]), $c->sql_quote($_REQUEST["estado_firma"]));

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

		elseif($c->sql_quote($_REQUEST['action']) == 'firmar')

			$ob->GetPanelFirma($c->sql_quote($_REQUEST['id']));	

		elseif($c->sql_quote($_REQUEST['action']) == 'EnviarFirma')

			$ob->FirmaDigital();	

		else

		// SI NO ES NINGUNA DE LAS ANTERIORES ENTONCES CARGA POR DEFECTO LA VISTA DE LISTADO		

			$ob->VistaListar();		

	// DEFINIENDO LA CLASE DEL CONTROLADOR DEL OBJETO QUE TIENE HERENCIA CON EL CONTROLADOR GENERICO PARA CARGAR LA INTERFAZ

	class CFirmas_usuarios extends MainController{

		// DEFINIENDO LA FUNCION LISTAR 		

		function VistaListar(){

			global $con;
			global $f;
			global $c;

			// CREANDO UN NUEVO MODELO	

			$sent = false;
			if (!isset($_SESSION['ACTIVEKEY'])) {
				if($_SESSION['MODULES']['firma_electronica'] == "1"){
					$sent = true;
				}
			}		
			if ($_SESSION['MODULES']['firma_electronica'] == "1" || $_SESSION['MODULES']['firma_digital'] == "1") {
				$object = new MGestion_anexos_firmas;
				if ($_SESSION['suscriptor_id'] == "") {
					$query = $object->ListarGestion_anexos_firmas("where usuario_firma = '".$_SESSION['usuario']."' and estado_firma = '0'");
				}else{
					$query = $object->ListarGestion_anexos_firmas("where usuario_firma = '".$_SESSION['suscriptor_id']."' and estado_firma = '0'");
				}	
				include_once(VIEWS.DS.'gestion_anexos_firmas/Listar.php');
			}else{
				echo "<div class='alert alert-info'>Este modulo no se encuentra activo</div>";
			}


		}

		// FUNCION QUE CARGA LA VISTA DE INSERTAR (FORMULARIO DE INSERTAR)

		function VistaInsertar(){

			//CARGA EL TEMPLATE

			$pagina = $this->load_template('Crear Firmas_usuarios');			

			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.

			ob_start();

			include_once(VIEWS.DS.'firmas_usuarios/FormInsertFirmas_usuarios.php');				

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

	 		$pagina = $this->load_template('Editar Firmas_usuarios');			

			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.

			ob_start();		

	 		// INVOCAMOS UN NUEVO OBJETO

		 	$object = new MFirmas_usuarios;

			// LO CREAMOS 			

			$object->CreateFirmas_usuarios('id', $x);

			// Y FINALMENTE CARGAMOS LA VISTA DE EDICION QUE MUESTRA EL CONTENIDO			

			include_once(VIEWS.DS.'firmas_usuarios/FormUpdateFirmas_usuarios.php');		

			// OBTIENE EL CONTENIDO DEL BÚFER ACTUAL Y ELIMINA EL BÚFER DE SALIDA ACTUAL.											

			$table = ob_get_clean();	

			// ASIGNANDOLE A LA VARIABLE  EL CONTENIDO DEL BUFFER															

			$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $table  , $pagina);

			// CARGAMOS LA PAGINA EN EL BROWSER		

			$this->view_page($pagina);

	 	}	

	 	function Buscar($x, $cn = 'id'){

	 		// INVOCAMOS UN NUEVO OBJETO						

			$object = new MFirmas_usuarios;

			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL						

			global $con;

			// CARGA EL TEMPLATE						

			$pagina = $this->load_template('Listado de Firmas_usuarios');			

			// OBTENEMOS EL LISTADO DE LIBROS DE ACUERDO A LOS PARAMETROS QUE LE ENVIAMOS						

			$query = $object->ListarFirmas_usuarios('WHERE '.$cn.' = "'.$x.'"');	    

			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.

			ob_start();		

		   		if($con->NumRows($query) <= 0 || $query !=''){

					// SI LA CONSULTA NO SE EJECUTA ENTONCES RETORNA VACIO							

					include_once(VIEWS.DS.'firmas_usuarios/Listar.php');	   			

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

		function Insertar($username, $SID, $fecha_firma, $fecha_expiracion, $firma, $estado_firma){

			// DEFINIENDO EL OBJETO			

			$object = new MFirmas_usuarios;

			// USANDO LA FUNCION DE INSERTAR DEL OBJETO PARA ENVIAR LA INFORMACION A LA BASE DE DATOA			

			$create = $object->InsertFirmas_usuarios($username, $SID, $fecha_firma, $fecha_expiracion, $firma, $estado_firma);

			//SI NO SE ENVIO CORRECTAMENTE ENTONCES GENERA ERROR SINO ENVIA OK

			if($create != '1')

				$this->VistaListar('ERROR AL REGISTRAR');

			else

				$this->VistaListar('OK!');	

		}

		// FUNCION QUE RECIBE UNASERIE DE PARAMETROS Y LOS ENVIA A LA BASE DE DATOS PARA ACTUALIZAR UN REGISTRO (FUNCION ESPECIAL)		

		function Editar($constrain, $fields, $updates, $output){

			$object = new MFirmas_usuarios;

			$create = $object->UpdateFirmas_usuarios($constrain, $fields, $updates, $output);

			//SI NO SE ENVIO CORRECTAMENTE ENTONCES GENERA ERROR SINO ENVIA OK

			if($create != '1')

				$this->VistaListar('ERROR AL REGISTRAR');

			else

				$this->VistaListar('OK!');						

		}

		// FUCNION QUE RECIBE UN PARAMETRO Y ELIMINA EL REGISTRO DE LA BASE DE DATOS		

		function Eliminar($id){

			// DEFINIMOS UN OBJETO NUEVO						

			$object = new MFirmas_usuarios;

			// LLAMAMOS A LA FUNCION QUE EJECUTA LA ELIMINACION.			

			$delete = $object->DeleteFirmas_usuarios($id); 		

			//SI NO SE ENVIO CORRECTAMENTE ENTONCES GENERA ERROR SINO ENVIA OK

			if($delete != '1')

				echo 'ERROR AL ELIMINAR';

			else

				echo 'OK!';			

		}

		function GetPanelFirma($id){

			global $con;

			global $c;

			global $f;


			// CARGA EL TEMPLATE			
	 		$pagina = $this->load_template_limpiaAmple('Firmar Documento');			
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();	

			$ganf = new MGestion_anexos_firmas;
			$ganf->CreateGestion_anexos_firmas("id", $id);

			$ga = new MGestion_anexos;
			$ga->CreateGestion_anexos("id", $ganf->GetAnexo_id());

			include_once(VIEWS.DS.'firmas_usuarios/panel_firma.php');	   			

			$table = ob_get_clean();	
			// ASIGNANDOLE A LA VARIABLE  EL CONTENIDO DEL BUFFER															
			$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $table  , $pagina);
			// CARGAMOS LA PAGINA EN EL BROWSER		
			$this->view_page($pagina);


		}		

		function FirmaDigital(){

			global $con;

			global $c;

			global $f;

			#Array ( [m] => firmas_usuarios [action] => EnviarFirma 

			$id = $c->sql_quote($_REQUEST['id']);

			$keyf = $c->sql_quote($_REQUEST['clave_firma']);

			$posf = $c->sql_quote($_REQUEST['posfirma']);

			$sqr = $c->sql_quote($_REQUEST['showqr']);

			$tpaper = $c->sql_quote($_REQUEST['type_paper']);

			$surl = $c->sql_quote($_REQUEST['showurl']);

			$ganf = new MGestion_anexos_firmas;

			$ganf->CreateGestion_anexos_firmas("id", $id);

			$ga = new MGestion_anexos;

			$ga->CreateGestion_anexos("id", $ganf->GetAnexo_id());

			if ($_SESSION["suscriptor_id"] != "") {

		        $sus = new MSuscriptores_contactos;

		        $sus->CreateSuscriptores_contactos("id", $_SESSION['suscriptor_id']);

		        $MSuscriptores_contactos_direccion = new MSuscriptores_contactos_direccion;

	        	$MSuscriptores_contactos_direccion->CreateSuscriptores_contactos_direccion("id_contacto", $sus->GetId());

		        $nombre_usuario_firma = $sus->GetNombre();

		        $email_firma = $MSuscriptores_contactos_direccion->GetEmail();

		        $celular_firma = $MSuscriptores_contactos_direccion->GetTelefonos();

		        $profesional_firma = $sus->GetType();

		        $firma_firma = $MSuscriptores_contactos_direccion->GetFirma();

		        $nombre_area = "";

		    }else{
		    	global $f;

		    	$user = new MUsuarios;

				$user->CreateUsuarios("user_id", $_SESSION['usuario']);

				$nombre_usuario_firma = $user->GetP_nombre().' '.$user->GetP_apellido();

				$email_firma = $user->GetEmail();

				$celular_firma = $user->GetCelular();

				$profesional_firma = strtoupper($f->ReemplazoXX($user->GetT_profesional()));

				$firma_firma = $user->GetFirma();

				$base_file2 = $user->Getbase_file();

				$clave_firma2 = $user->Getclave_firma();

				$regimen = $user->GetRegimen();

				$MAreas = new MAreas;

				$MAreas->CreateAreas("id", $regimen);

				 $nombre_area = strtoupper($f->ReemplazoXX($MAreas->GetNombre()));

				$dato_base_file = file_get_contents($_FILES["archivo"]['tmp_name']);

				// if ($base_file2 != $dato_base_file) {

				// 	$status = "Este documento no puede ser firmado. <br>La clave y/o La Firma no son correctos.";

				// 	include_once(VIEWS.DS.'firmas_usuarios/signaturedDoc.php');	

				// 	exit;

				// }

				// if ($clave_firma2 != $keyf) {

				// 	$status = "Este documento no puede ser firmado. <br>La clave y/o La Firma no son correctos.";

				// 	include_once(VIEWS.DS.'firmas_usuarios/signaturedDoc.php');	

				// 	exit;

				// }

	    	}

			$sadmin = new MSuper_admin;

            $sadmin->CreateSuper_admin("id", "6");

			$tamano = $_FILES["archivo"]['size'];

			$tipo = $_FILES["archivo"]['type'];

			$archivo = $_FILES["archivo"]['name'];

			$prefijo = "f".md5($_SESSION['usuario'].date("Y-m-d H:i:s"));

			$extension = "crt";

			/*

			*/

			// if ($clave_firma != "") {

			// 	$status = "Este documento no puede ser firmado. <br>El documento ya fue firmado anteriormente.";

			// 	include_once(VIEWS.DS.'firmas_usuarios/signaturedDoc.php');	

			// 	exit;

			// }

			// if ($extension != "crt") {

			// 	$status = "Extensión de archivo de firma incorrecto";

			// }else{

			// 	$name = $prefijo.'.'.$extension;

			// 	$destino =  ROOT."/plugins/firmasdigitales/".$name;

			// 	if($archivo == ""){

			// 		$status = "No Se seleccionó ningun archivo de firma <a href='".HOMEDIR.DS."firmas_usuarios/firmar/".$ganf->GetId()."/'>Volver</a>";

			// 	}

			// 	if (!copy($_FILES['archivo']['tmp_name'],$destino)) {

			// 		$status = "Error al cargar la firma <a href='".HOMEDIR.DS."firmas_usuarios/firmar/".$ganf->GetId()."/'>Volver</a>";

			// 	} else {

			// 		$status = true;

			// 	}

			// }

			$status = true;
			$valor_ancho = 70;
			$valor_alto = 33;

			if (true == $status) {

				$px = 0;
				$py = 0;
				#$posf = "43,90";

				$posf = explode(",", $posf);

				$px = ($valor_ancho * $posf[0]);
				$py = ($valor_alto * $posf[1]);
				//echo $px.' * '.$py;
	
				/*if ($tpaper == "A4") {
					if ($posf[1] <= 210 ) {
						$divy = 2.25;
					}elseif ($posf[1] > 211 and $posf[1] <= 270 ) {
						$divy = 2.1;
					}else{
						$divy = 2.1;
					}
					# code...
				}else{

					if ($posf[1] <= 210 ) {
						$divy = 2.25;
					}elseif ($posf[1] > 211 and $posf[1] <= 270 ) {
						$divy = 2.1;
					}else{
						$divy = 1.75;
					}
				}

				
				$px = $posf[0] / 3 ;
				$py = $posf[1] / $divy;

				if ($py < 1) {
					$py = 0;
				}*/

				#echo "Firmando en X: $px y Y: $py / Originales X: $posf[0], Y: $posf[1]";
				### INCIO DEL PROCESO DE FIRMA ###
				
				$pdf = new PDFI();  

			    $numero_aleatorio=time()."-".strtoupper($f->randomText(3)); 
			    $xnum = $numero_aleatorio;

			    $fillx = $px;

			    $filly = $py;

			    $fillh = "100";

			    $fillw = "35";

			    $sellox = $fillx + 5;

			    $selloy = $filly + 3;

			    $x = $fillx + 4;

			    $y = $filly + 12;

			    $h = $fillh - 10;

			    $w = $fillw - 20;

			    $x2 = $fillx + 7;

			    $y2 = $filly + 14;

			    $h2 = $fillh - 20;

			    $w2 = $fillw - 23;

			    $filename = $ga->GetUrl();

			    $linkfile = HOMEDIR.DS."app/archivos_uploads/gestion/".$ga->GetGestion_id().trim("/anexos/ ").$ga->GetUrl();

			    $linkfile2 = "app/archivos_uploads/gestion/".$ga->GetGestion_id().trim("/anexos/ ").$ga->GetUrl();

			    $linkfile3 = "app/archivos_uploads/gestion/".$ga->GetGestion_id().trim("/anexos/OLD_").$ga->GetUrl();
		        // pdf version information
                 $filepdf = fopen($linkfile2,"r");
                 if ($filepdf) {
                      $line_first = fgets($filepdf);
                      fclose($filepdf);
                 } else{
                      echo "error opening the file.";
                      exit;
                 }

                 // extract number such as 1.4 ,1.5 from first read line of pdf file
                 preg_match_all('!\d+!', $line_first, $matches);
				 
	     		// save that number in a variable
                 $pdfversion = implode('.', $matches[0]);

                 // compare that number from 1.4(if greater than proceed with ghostscript)
                 if($pdfversion >= "1.4"){
                 	shell_exec('gs -dBATCH -dNOPAUSE -q -sDEVICE=pdfwrite -sOutputFile="'.$linkfile3.'" "'.$linkfile2.'"');
                 	copy($linkfile3,$linkfile2);
                 }
			    //$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false, true);

			    $path_file2 = $_SERVER["DOCUMENT_ROOT"]."app/archivos_uploads/gestion/".$ga->GetGestion_id().trim("/anexos/ ").$ga->GetUrl()."";

			    $file = realpath($path_file2);

			    $pagecount = $pdf->setSourceFile($file);

			        for($i = 1 ; $i <= $pagecount ; $i++){

			            $tpl  = $pdf->importPage($i);

			            $size = $pdf->getTemplateSize($tpl);

			            $orientation = $size['h'] > $size['w'] ? 'P':'L';

						$pdf->Rect(3, 4, 180, 4, 'F', array(), array(255,255,255));						

			            $pdf->SetFont('Helvetica', 0, '8');

			            $pdf->SetTextColor(0, 0, 0);

			            $pdf->SetXY(3, 4);

			            $pdf->Write(0, 'Firmado Digitalmente con Código '.$numero_aleatorio. " El día: ".date('d-m-Y')." a las: ".date('h:i:s'));

			            #$pdf->SetFont('helvetica', '', 8); 

			            #$pdf->write1DBarcode($numero_aleatorio, 'C93', 170, 2, 40, 10, 0.4, array('border'=>true,'text'=>true,'stretchtext'=>0,'fitwidth'=>true), 'N'); 

						if ($sqr == "on") {

							$pdf->Image('http://chart.googleapis.com/chart?chs=50x50&cht=qr&chl='.$linkfile,189,2,25,25);

						}

						if ($surl == "1") {

							$pdf->Rect(3, 254, 180, 4, 'F', array(), array(255,255,255));

						    $pdf->SetXY(3,254); 

						    $pdf->SetFont('Helvetica', 0, '8');
			            	$pdf->SetTextColor(0, 0, 0);
						    $pdf->Cell(0, 0, "Autenticidad del documento: ".HOMEDIR.DS."sort/".$numero_aleatorio."/ Firma digital según decreto 2364 de 2012"); 

						}

			            $pdf->AddPage($orientation);

			            $pdf->useTemplate($tpl, null, null, $size['w'], $size['h'], true);

			        }

			    $certificate = 'file://'.$_SERVER["DOCUMENT_ROOT"]."/app/plugins/firmasdigitales/".$name; 

			    $info = array(

			        'Name' => $nombre_usuario_firma,

			        'Location' => $sadmin->GetCiudad(),

			        'Reason' => $sadmin->GetP_nombre(),

			        'ContactInfo' => $email_firma,

			        );

			    $celular_firma = 'Teléfono: (+57) '.$celular_firma;

			    $email_firma = 'E-mail: '.$email_firma;

			    $numero_aleatorio = 'Código de Firma: '.$numero_aleatorio. "   ".date('d/m/Y')." ".date('h:i:s');

			    /*ARRAY DATOS*/

			    $ARRAY_FIRMA = array();

			    if ($_SESSION["suscriptor_id"] != "") {


			    	$ARRAY_FIRMA = array($nombre_usuario_firma,$profesional_firma, $nombre_area, $celular_firma, $email_firma, $numero_aleatorio);

			    	$rfd_img = 22;

			    }else{

			   		$MUsuarios_configurar_firma_digital = new MUsuarios_configurar_firma_digital;

					$MUsuarios_configurar_firma_digital->CreateUsuarios_configurar_firma_digital("user_id",$_SESSION["usuario"]);

					$rfd = 0;

					$rfd_img = 0;

					if(strlen($MUsuarios_configurar_firma_digital->GetCampo1()) != 0){

						$ARRAY_FIRMA[$rfd] = ${$MUsuarios_configurar_firma_digital->GetCampo1()};

						$rfd++;

					}

					if(strlen($MUsuarios_configurar_firma_digital->GetCampo2()) != 0){

						$ARRAY_FIRMA[$rfd] = ${$MUsuarios_configurar_firma_digital->GetCampo2()};

						$rfd++;

					}

					if(strlen($MUsuarios_configurar_firma_digital->GetCampo3()) != 0){

						$ARRAY_FIRMA[$rfd] = ${$MUsuarios_configurar_firma_digital->GetCampo3()};

						$rfd++;

					}

					if(strlen($MUsuarios_configurar_firma_digital->GetCampo4()) != 0){

						$ARRAY_FIRMA[$rfd] = ${$MUsuarios_configurar_firma_digital->GetCampo4()};

						$rfd++;

					}

					if(strlen($MUsuarios_configurar_firma_digital->GetCampo5()) != 0){

						$ARRAY_FIRMA[$rfd] = ${$MUsuarios_configurar_firma_digital->GetCampo5()};

						$rfd++;

					}

					if(strlen($MUsuarios_configurar_firma_digital->GetCampo6()) != 0){

						$ARRAY_FIRMA[$rfd] = ${$MUsuarios_configurar_firma_digital->GetCampo6()};

						$rfd++;

					}

					if(strlen($MUsuarios_configurar_firma_digital->GetCampo7()) != 0){

						$ARRAY_FIRMA[$rfd] = ${$MUsuarios_configurar_firma_digital->GetCampo7()};

						$rfd++;

					}

					$rfd_img = (count($ARRAY_FIRMA)-1) * 4;

				}

				$posicion_y = 2;

			    if($pdf->setSignature($certificate, $certificate, $keyf, '', 1, $info)){

			   		//$pdf->AddPage($orientation);

				    $pdf->Rect($x, $y, $h, $w+$rfd_img, 'F', array(), array(255,255,255));

				    $bg_url = ASSETS."/images/signature_bg.png";

					$user_url = PLUGINS.trim("/thumbnails/ ").$firma_firma;

				    $pdf->Image($bg_url, $x, $y, $h, $w, 'PNG', '', '', false, 300, '', false, false, 0, false, false, false);

				    $pdf->Image($user_url, $x2, $y2, $h2, $w2, 'JPG', '', '', false, 300, '', false, false, 0, false, false, false);

				    // Set Code in Signature image

				    if($ARRAY_FIRMA[0] != ''){

					    $pdf->SetFont('Helvetica', 'B', '12');

					    $pdf->SetTextColor(0, 0, 0);

					    $pdf->SetXY($x2, $y2+($posicion_y+5));

					    $pdf->Write(0, $ARRAY_FIRMA[0]);

					    $posicion_y = $posicion_y + 5;

					}

					if($ARRAY_FIRMA[1] != ''){

					    $pdf->SetFont('Helvetica', 0, '10');

					    $pdf->SetTextColor(0, 0, 0);

					    $pdf->SetXY($x2, $y2+($posicion_y+5));

					    $pdf->Write(0, $ARRAY_FIRMA[1]);

					    $posicion_y = $posicion_y + 5;

					}

					if($ARRAY_FIRMA[2] != ''){

					    $pdf->SetFont('Helvetica', 0, '10');

					    $pdf->SetTextColor(0, 0, 0);

					    $pdf->SetXY($x2, $y2+($posicion_y+5));

					    $pdf->Write(0, $ARRAY_FIRMA[2]);

					    $posicion_y = $posicion_y + 5;

					}

					if($ARRAY_FIRMA[3] != ''){

					    $pdf->SetFont('Helvetica', 0, '10');

					    $pdf->SetTextColor(0, 0, 0);

					    $pdf->SetXY($x2, $y2+($posicion_y+5));

					    $pdf->Write(0, $ARRAY_FIRMA[3]);

					    $posicion_y = $posicion_y + 5;

					}

					if($ARRAY_FIRMA[4] != ''){

					    $pdf->SetFont('Helvetica', 0, '10');

					    $pdf->SetTextColor(0, 0, 0);

					    $pdf->SetXY($x2, $y2+($posicion_y+5));

					    $pdf->Write(0, $ARRAY_FIRMA[4]);

					    $posicion_y = $posicion_y + 5;

					}

					if($ARRAY_FIRMA[5] != ''){

					    $pdf->SetFont('Helvetica', 0, '10');

			            $pdf->SetTextColor(0, 0, 0);

			            $pdf->SetXY($x2, $y2+($posicion_y+5));

			            $pdf->Write(0, $ARRAY_FIRMA[5]);

					    $posicion_y = $posicion_y + 5;

			        }

				    // Set Code in Signature image

				    // define active area for signature appearance 

				    // print autencitity log text

		            $pdf->Rect(3, 4, 180, 4, 'F', array(), array(255,255,255));	

				    $pdf->SetFont('Helvetica', 0, '8');

		            $pdf->SetTextColor(0, 0, 0);

		            $pdf->SetXY(3, 4);

		            $numero_aleatorio = $xnum;
		            $pdf->Write(0, 'Firmado Digitalmente con Código '.$numero_aleatorio. " El día: ".date('d-m-Y')." a las: ".date('h:i:s'));

					if ($sqr == "on") {

						$pdf->Image('http://chart.googleapis.com/chart?chs=50x50&cht=qr&chl='.$linkfile,189,2,25,25);

					}

				    $pdf->setSignatureAppearance($fillx,$filly,$fillh,$fillw); 

					if ($surl != "0") {

						$pdf->Rect(3, 254, 180, 4, 'F', array(), array(255,255,255));

					    $pdf->SetXY(3,254); 

					   	$pdf->SetFont('Helvetica', 0, '8');
		            	$pdf->SetTextColor(0, 0, 0);
					    $pdf->Cell(0, 0, "Autenticidad del documento: ".HOMEDIR.DS."sort/".$numero_aleatorio."/ Firma digital según decreto 2364 de 2012"); 
					   

					}
#COMENTAR LA LINEA DE ABAJO #
#				    $pdf->Output();
#exit;
				    $pdf->Output($path_file2, 'F');

				    $status = "Documento Generado y Firmado Digitalmente Puede Descargar este Documento <a href='".HOMEDIR.DS."app/archivos_uploads/gestion/".$ga->GetGestion_id().trim("/anexos/ ").$ga->GetUrl()."'>Aqui</a>";

				    /*Se guarda la url corta*/

				    $MSort = new MSort;

					$MSort->InsertSort($numero_aleatorio,  $linkfile2, date('Y-m-d H:i:s'));

		##ALMACENANDO LA FIRMA EN LA BASE DE DATOS

					/*$objectfirma = new MGestion_anexos_firmas;

					$objectfirma->CreateGestion_anexos_firmas("id", $c->sql_quote($id));*/

					if ($_SESSION["suscriptor_id"] != "") {

						$id = $con->Result($con->Query("select id from gestion_anexos_permisos where usuario_permiso = '".$_SESSION['suscriptor_id']."' and id_documento = '".$ganf->GetAnexo_id()."'"), 0, "id");

					} else {

						$id = $con->Result($con->Query("select id from gestion_anexos_permisos where usuario_permiso = '".$_SESSION['usuario']."' and id_documento = '".$ganf->GetAnexo_id()."'"), 0, "id");

					}

					$object = new MGestion_anexos_permisos;

					$object->CreateGestion_anexos_permisos("id", $c->sql_quote($id));

					$estadodc = "1";

					$ar1x = array($estadodc, date("Y-m-d H:i:s"), $object->GetObservacion()."<br><b>".$_SESSION['usuario']." dice: </b> El documento ha sido Firmado Digitalmente");	

					$create = $object->UpdateGestion_anexos_permisos('WHERE id = '.$id, array('estado','fecha_actualizacion', 'observacion'), $ar1x,  array('registro actualizado', 'no se pudo actualizar'));

					/*$doc = new MGestion_anexos;

					$doc->CreateGestion_anexos("id", $object->GetId_documento());*/

					$gestion_id = $ga->GetGestion_id();
					$g = new Mgestion;
					$g->CreateGestion("id", $gestion_id);

					$objecte = new MEvents_gestion;

					$estado = array("0" => "Pendiente por Revisar", "1" => "Aprobado", "2" => "Rechazado");

					$estado = $estado[$estadodc];

					if ($_SESSION["suscriptor_id"] != "") {

						$responsablea = $c->GetDataFromTable("Suscriptores_contactos", "id", $_SESSION['suscriptor_id'], "nombre", $separador = " ");

						$objecte->InsertEvents_gestion($_SESSION['suscriptor_id'], $gestion_id, date("Y-m-d"), "Se firmado un documento", "El documento ".$ga->GetNombre()." ha sido firmado digitalmente por el suscriptor ".$responsablea." " , date("Y-m-d"), 0, date("H:i:s"), 0, 0, 0, date("Y-m-d"), 0, $_SESSION['seccional'], $_SESSION['area_principal'], $_SESSION['area_principal'], $ga->GetUser_id(), "crdocs", $id);

					} else {

						$responsablea = $c->GetDataFromTable("usuarios", "user_id", $_SESSION['usuario'], "p_nombre, p_apellido", $separador = " ");

						$objecte->InsertEvents_gestion($_SESSION['usuario'], $gestion_id, date("Y-m-d"), "Se firmado un documento", "El documento ".$ga->GetNombre()." ha sido firmado digitalmente por el usuario ".$responsablea." " , date("Y-m-d"), 0, date("H:i:s"), 0, 0, 0, date("Y-m-d"), 0, $_SESSION['seccional'], $_SESSION['area_principal'], $_SESSION['area_principal'], $g->GetNombre_destino(), "crdoc", $id);

					}

					$fields = array('fecha_firma', 'codigo_firma', 'clave_primaria', 'estado_firma', 'repo_1', 'repo_2', 'firma_crt', 'ip', 'cod_alt');

					$updates = array(date("Y-m-d H:i:s"), $_SESSION["ACTIVEKEY"], $_SESSION["SID"], "1", "", "", $name, $_SERVER['REMOTE_ADDR'], $numero_aleatorio);	

					$output = array('Documento Actualizado', 'no se pudo actualizar'); 

					$constrain = 'WHERE id = '.$_REQUEST['id'];

					//$objectfirma = new MGestion_anexos_firmas;

					$status .= "<br>".$ganf->UpdateGestion_anexos_firmas($constrain, $fields, $updates, $output);

					/*actualizar archivo contenido*/

					//base 64

					$base_file = '';

					$data_base_file = file_get_contents($_SERVER["DOCUMENT_ROOT"]."/app/archivos_uploads/gestion/".$ga->GetGestion_id()."/anexos".DS.$ga->GetUrl());

					$base_file = base64_encode($data_base_file);

					$fields = array('base_file');

					$updates = array($base_file);	

					$output = array('Documento Actualizado', 'no se pudo actualizar'); 

					$constrain = 'WHERE id = '.$ganf->GetAnexo_id();

					### FIN DEL PROCESO DE FIRMA ###
			#DECOMENTAR EL SIGUIENTE
					include_once(VIEWS.DS.'firmas_usuarios/signaturedDoc.php');	   			

					$ga->UpdateGestion_anexos($constrain, $fields, $updates, $output);

					$doc = new MGestion_anexos;

					$doc->CreateGestion_anexos("id", $ga->GetId_documento());


					$gestion_id = $ga->GetGestion_id();
					$g = new Mgestion;
					$g->CreateGestion("id", $gestion_id);

					$objecte = new MEvents_gestion;

					// USANDO LA FUNCION DE INSERTAR DEL OBJETO PARA ENVIAR LA INFORMACION A LA BASE DE DATO

					/*

						InsertEvents_gestion(	usuario_registra, 	gestion_id, 	fecha_evento, titulo, 	descripcion, 	fecha_creacion, estado(0 por defecto echo),  hora, 	$alerted = validar si alertado(0 = sin avisar, 1 = avisado), 	$avisar_a = dias para avisar, 	$type_event (ignorar), 	$fecha_vencimiento, $id_generico = si viene de alerta generica (0 =  ninguna), 	$seccional, 	$oficina, 	$area, 	$grupo = a que usuarios notificar (* = todos, B = Jefe de Area, B-X = Jefe de Area y x = otro usuario))

					*/

					$responsablea = $c->GetDataFromTable("usuarios", "user_id", $_SESSION['usuario'], "p_nombre, p_apellido", $separador = " ");

					$estado = array("0" => "Pendiente por Revisar", "1" => "Aprobado", "2" => "Rechazado");

					$estado = $estado[$estadodc];

					$objecte->InsertEvents_gestion($_SESSION['usuario'], $gestion_id, date("Y-m-d"), "Se ha revisado un documento", "El documento ".$ga->GetNombre()." ha sido firmado digitalmente por el usuario ".$responsablea , date("Y-m-d"), 0, date("H:i:s"), 0, 0, 0, date("Y-m-d"), 0, $_SESSION['seccional'], $_SESSION['area_principal'], $_SESSION['area_principal'], $g->GetNombre_destino(), "crdoc", $id);

		    }else{

			    	$status = "Error al firmar";### FIN DEL PROCESO DE FIRMA ###

				include_once(VIEWS.DS.'firmas_usuarios/signaturedDoc.php');	   			

			    }

			}

		}

		function FormEnviarClave(){

			global $con;

			global $c;

			global $f;

			global $m;

			$object = new MUsuarios;

			$object->CreateUsuarios("user_id", $_SESSION['usuario']);

			$text = $f->randomText(8);

			$np = hash("sha512", $text);

	 		$_SESSION['ACTIVEKEY'] = $np;

	 		$_SESSION['LAST_ACTIVITY'] = time();

		 	$fecha = date("Y-m-d H:i:s");

			$fecha_c = date_create($fecha);//aca le pasas la fecha actual o ala que le queres sumar los dias.

			date_modify($fecha_c, "+4 hour");//sumas los dias que te hacen falta.

			$fcaduca = date_format($fecha_c, "Y-m-d H:i:s");//retornas la fecha en el formato que mas te guste.

			$firmas = new MFirmas_usuarios;

			$con->Query("update firmas_usuarios set estado_firma = '0' where username = '".$_SESSION['usuario']."'");

			$con->Query("update usuarios set s_password = '".$np."' where user_id = '".$_SESSION['usuario']."'");



			$MPlantillas_email = new MPlantillas_email;

			$MPlantillas_email->CreatePlantillas_email('id', '5');

			$contenido_email = $MPlantillas_email->GetContenido();

			$contenido_email = str_replace("[elemento]fecha_vence[/elemento]",      $fcaduca,     $contenido_email );

			$contenido_email = str_replace("[elemento]responsable[/elemento]", $object->GetP_nombre()." ".$object->GetP_apellido(),     	   $contenido_email );

			$contenido_email = str_replace("[elemento]CLAVE_USUARIO[/elemento]",      $text,   $contenido_email );



			$c->fnEnviaEmailGlobal(CONTACTMAIL,PROJECTNAME,"Restablecimiento de clave",$contenido_email,$_SESSION['usuario']);

			#include_once(VIEWS.DS.'firmas_usuarios/Listar.php');

		}

	}

?>