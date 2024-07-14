<?
session_start();
#error_reporting(E_ALL);
#ini_set('display_errors', '1');
date_default_timezone_set("America/Bogota");
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
	include_once(MODELS.DS.'Dependencias_versionM.php');
	include_once(MODELS.DS.'Events_gestionM.php');
	include_once(MODELS.DS.'Estados_gestionM.php');
	include_once(MODELS.DS.'FolderM.php');
	include_once(MODELS.DS.'GestionM.php');
	include_once(MODELS.DS.'Solicitudes_documentosM.php');
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
	include_once(MODELS.DS.'FuentesM.php');
	include_once(MODELS.DS.'Usuarios_configurar_accesosM.php');
#	#include_once(PLUGINS.DS.'PHPMailer_5.2.4/class.phpmailer.php');	include_once(PLUGINS.DS.'PHPExcel.php');
	include_once(PLUGINS.DS.'nusoap/nusoap.php');
	include_once(ROOT.DS.'DALC'.DS.'/mySql.php');
	include_once('consultas.php');
	include_once('funciones.php');

	$con = new ConexionBaseDatos;
	$con->Connect($con);
	$ob = new CConsultapublica;
	$c = new Consultas;
	$f = new Funciones;
	$mail = new PHPMailer;	
	$action = $c->sql_quote($_REQUEST["action"]);

	switch ($action) {
		case 'radicado':
		$ob->Getradicado();
			break;
		case 'boletin':
			$ob->GetBoletin();
		break;	
		case 'identificacion':
		$ob->Getidentificacion();
			break;
		case 'registro':
		$ob->Getregistro();
			break;
		case 'registro_usuarios':
		$ob->GetregistroUsuarios();
			break;
		case 'registrosuscriptor':
			$ob->RegistrarSuscriptor($c->sql_quote($_REQUEST['identificacion']), $c->sql_quote($_REQUEST['nombre']), $c->sql_quote($_REQUEST['email']), $c->sql_quote($_REQUEST['ciudad']), $c->sql_quote($_REQUEST['direccion']), $c->sql_quote($_REQUEST['telefonos']), $c->sql_quote($_REQUEST['type']));
			break;	
		case 'registarusuario':
			$ob->RegistrarFuncionario($c->sql_quote($_REQUEST['identificacion']), $c->sql_quote($_REQUEST['pnombre']), $c->sql_quote($_REQUEST['papellido']), $c->sql_quote($_REQUEST['ciudad']), $c->sql_quote($_REQUEST['email']), $c->sql_quote($_REQUEST['direccion']), $c->sql_quote($_REQUEST['celular']), $c->sql_quote($_REQUEST['seccional_siamm']), $c->sql_quote($_REQUEST['universidad']));
			break;
		case 'resultados_radicado':
			$id = $c->sql_quote($_REQUEST['id_consulta']);
				
			if ($id == "") {
				$id = $c->sql_quote($_REQUEST['id']);
			}

			$ob->Getresultados_radicado($id);
			break;
		case 'resultados_identificacion':
		$id = $c->sql_quote($_REQUEST['id_consulta']);
			$ob->Getresultados_identificacion($id);
			break;
		case 'terminos_y_condiciones':
		$ob->Getterminos_y_condiciones();
			break;
		case 'privacidad_de_datos':
		$ob->Getprivacidad_de_datos();
			break;
		case 'licencia_de_uso':
		$ob->Getlicencia_de_uso();
			break;
		case 'trd':
			$ob->GetTRDS();
			break;
		case 'consultahistorica':
			$ob->GetConsultaHistorica();
			break;	
		case 'informehistorico':
			$ob->GetResultadoConsultaHistorica();
			break;		
		case 'GetProvincesinExistence':
			$ob->GetProvincesinExistence($c->sql_quote($_REQUEST['id']));
			break;		
		case 'GetCitysinExistence':
			$ob->GetCitysinExistence($c->sql_quote($_REQUEST['id']));
			break;	
		case 'listadooficinasseccional':
			$ob->VistaOficinasSeccional($c->sql_quote($_REQUEST['id']));
			break;				
		case 'listadoareasoficinas':
			$ob->ListadoAreasOficinaNew($c->sql_quote($_REQUEST['id']));
			break;					
		case 'GetSeriesArea':
			$ob->GetSeriesArea($c->sql_quote($_REQUEST['id']));
			break;						
		case 'GetSubSeriesArea':
			$ob->GetSubSeriesArea($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['cn']));
			break;						
		case 'PruebaRegistroExitoso':
			$ob->PruebaRegistro($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['cn']));
			break;	
		case 'estados':
			$ob->GetEstados();
			break;		
		case 'calculopapel':
			$ob->GetCalculoPapel();
			break;			
		case 'GetDependencias':
			$ob->GetDependencias($c->sql_quote($_REQUEST['id']));
			break;
		case 'GetInforme':
			$ob->GetInforme();
			break;	
			
		case 'resultados_estados':
			$id = $c->sql_quote($_REQUEST['id_consulta']);
			$tipo = $c->sql_quote($_REQUEST['tipoalerta']);
			$ob->Getresultados_estados($id, $tipo);
			break;							
		default:
			header("Location: ".HOMEDIR."/login/");
			break;
	}

	class CConsultapublica extends MainController{
		function Getradicado(){
			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL			
			global $con;
			$pagina = $this->load_template_limpiaAmple(PROJECTNAME.' Getradicado');			
			// CARGANDO LLAMANDO LA FUNCION LSITAR LIBROS DEL MODELO (FUNCION QUE TRAE DE LA BASE DE DATOS EL LISTADO DE LIBROS
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();
			// SI LA CONSULTA NO SE EJECUTA ENTONCES RETORNA VACIO
			// SI LA CONSULTA SE EJECUTA ENTONCES CARGA EL LISTADO DE LIBROS DE LA VISTA
		    			include_once(VIEWS.DS.'consultapublica'.DS."Getradicado.php");
		    	    	include_once(VIEWS.DS.'consultapublica'.DS."footer.php");
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
		function Getidentificacion(){
			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL			
			global $con;
			$pagina = $this->load_template_limpiaAmple(PROJECTNAME.' Getidentificacion');			
			// CARGANDO LLAMANDO LA FUNCION LSITAR LIBROS DEL MODELO (FUNCION QUE TRAE DE LA BASE DE DATOS EL LISTADO DE LIBROS
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();
			// SI LA CONSULTA NO SE EJECUTA ENTONCES RETORNA VACIO
			// SI LA CONSULTA SE EJECUTA ENTONCES CARGA EL LISTADO DE LIBROS DE LA VISTA
		    	include_once(VIEWS.DS.'consultapublica'.DS."Getidentificacion.php");
		    	    	include_once(VIEWS.DS.'consultapublica'.DS."footer.php");
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
		function Getregistro(){
			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL			
			global $con;
			$pagina = $this->load_template_limpiaAmple(PROJECTNAME.' Getregistro');			
			// CARGANDO LLAMANDO LA FUNCION LSITAR LIBROS DEL MODELO (FUNCION QUE TRAE DE LA BASE DE DATOS EL LISTADO DE LIBROS
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();
			// SI LA CONSULTA NO SE EJECUTA ENTONCES RETORNA VACIO
			// SI LA CONSULTA SE EJECUTA ENTONCES CARGA EL LISTADO DE LIBROS DE LA VISTA
		    	include_once(VIEWS.DS.'consultapublica'.DS."Getregistro.php");
		    	    	#include_once(VIEWS.DS.'consultapublica'.DS."footer.php");
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

		function GetregistroUsuarios(){
			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL			
			global $con;
			$pagina = $this->load_template_limpiaAmple(PROJECTNAME.' Registro de Usuarios');			
			// CARGANDO LLAMANDO LA FUNCION LSITAR LIBROS DEL MODELO (FUNCION QUE TRAE DE LA BASE DE DATOS EL LISTADO DE LIBROS
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();
			// SI LA CONSULTA NO SE EJECUTA ENTONCES RETORNA VACIO
			// SI LA CONSULTA SE EJECUTA ENTONCES CARGA EL LISTADO DE LIBROS DE LA VISTA
		    	include_once(VIEWS.DS.'consultapublica'.DS."GetregistroUsuarios.php");
		    	    	#include_once(VIEWS.DS.'consultapublica'.DS."footer.php");
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


		function Registrarsuscriptor($identificacion, $nombre, $email, $ciudad, $direccion, $telefonos, $type){
			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL			
			global $con;
			global $c;
			global $f;

			// CARGANDO LLAMANDO LA FUNCION LSITAR LIBROS DEL MODELO (FUNCION QUE TRAE DE LA BASE DE DATOS EL LISTADO DE LIBROS
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();
			$pagina = $this->load_template_limpiaAmple(PROJECTNAME.' Getregistro');			

			$object = new MSuscriptores_contactos;
			$object->CreateSuscriptores_contactos("identificacion", $identificacion);
			
			$registrar = 0;
			
			if ($object->GetId() <= 0) {
				$registrar = 1;

			}else{

				$objectd = new MSuscriptores_contactos_direccion;
				$objectd->CreateSuscriptores_contactos_direccion("id_contacto", $object->GetId());

				if ($objectd->GetEmail() == "") {
					$registrar = 2;
				}else{
					$registrar = 3;
				}

			}
			// SI LA CONSULTA NO SE EJECUTA ENTONCES RETORNA VACIO
			// SI LA CONSULTA SE EJECUTA ENTONCES CARGA EL LISTADO DE LIBROS DE LA VISTA
		    	include_once(VIEWS.DS.'consultapublica'.DS."RegistrarSuscriptor.php");
		    	include_once(VIEWS.DS.'consultapublica'.DS."footer.php");
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

		function Getresultados_radicado($id){


		//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL			

			global $con;

			global $c;

			$pagina = $this->load_template_limpiaAmple(PROJECTNAME.' Getresultados_radicado');			

			// CARGANDO LLAMANDO LA FUNCION LSITAR LIBROS DEL MODELO (FUNCION QUE TRAE DE LA BASE DE DATOS EL LISTADO DE LIBROS

			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.

			ob_start();

			// SI LA CONSULTA NO SE EJECUTA ENTONCES RETORNA VACIO

			// SI LA CONSULTA SE EJECUTA ENTONCES CARGA EL LISTADO DE LIBROS DE LA VISTA

			$radicado = $id;

			$s1 = "select id from gestion where num_oficio_respuesta = '".$id."' or radicado = '".$id."' or min_rad = '".$id."'";	

			$query = $con->Query($s1);
					$row = $con->FetchAssoc($query);
					$id = $row['id'];

	    	

	    	include_once(VIEWS.DS.'consultapublica'.DS."Getresultados_radicado.php");

	    	include_once(VIEWS.DS.'consultapublica'.DS."footer.php");

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
		function Getresultados_identificacion($id){
			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL			
			global $con;
			global $c;
			global $f;
			$pagina = $this->load_template_limpiaAmple(PROJECTNAME.' Getresultados_identificacion');			
			// CARGANDO LLAMANDO LA FUNCION LSITAR LIBROS DEL MODELO (FUNCION QUE TRAE DE LA BASE DE DATOS EL LISTADO DE LIBROS
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();
			// SI LA CONSULTA NO SE EJECUTA ENTONCES RETORNA VACIO
			// SI LA CONSULTA SE EJECUTA ENTONCES CARGA EL LISTADO DE LIBROS DE LA VISTA
			if ($id >= 1) {
					$susc = new MSuscriptores_contactos;
					$susc->CreateSuscriptores_contactos("identificacion", $id);
				}else{
						$id = 0;
					}
		    	include_once(VIEWS.DS.'consultapublica'.DS."Getresultados_identificacion.php");
		    	    	include_once(VIEWS.DS.'consultapublica'.DS."footer.php");
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
		function Getterminos_y_condiciones(){
			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL			
			global $con;
			$pagina = $this->load_template_limpiaAmple(PROJECTNAME.' Getterminos_y_condiciones');			
			// CARGANDO LLAMANDO LA FUNCION LSITAR LIBROS DEL MODELO (FUNCION QUE TRAE DE LA BASE DE DATOS EL LISTADO DE LIBROS
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();
			// SI LA CONSULTA NO SE EJECUTA ENTONCES RETORNA VACIO
			// SI LA CONSULTA SE EJECUTA ENTONCES CARGA EL LISTADO DE LIBROS DE LA VISTA
		    	include_once(VIEWS.DS.'consultapublica'.DS."Getterminos_y_condiciones.php");
		    	    	include_once(VIEWS.DS.'consultapublica'.DS."footer.php");
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
		function Getprivacidad_de_datos(){
			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL			
			global $con;
			$pagina = $this->load_template_limpiaAmple(PROJECTNAME.' Getprivacidad_de_datos');			
			// CARGANDO LLAMANDO LA FUNCION LSITAR LIBROS DEL MODELO (FUNCION QUE TRAE DE LA BASE DE DATOS EL LISTADO DE LIBROS
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();
			// SI LA CONSULTA NO SE EJECUTA ENTONCES RETORNA VACIO
			// SI LA CONSULTA SE EJECUTA ENTONCES CARGA EL LISTADO DE LIBROS DE LA VISTA
		    	include_once(VIEWS.DS.'consultapublica'.DS."Getprivacidad_de_datos.php");
		    	    	include_once(VIEWS.DS.'consultapublica'.DS."footer.php");
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
		function Getlicencia_de_uso(){
			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL			
			global $con;
			$pagina = $this->load_template_limpiaAmple(PROJECTNAME.' Getlicencia_de_uso');			
			// CARGANDO LLAMANDO LA FUNCION LSITAR LIBROS DEL MODELO (FUNCION QUE TRAE DE LA BASE DE DATOS EL LISTADO DE LIBROS
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();
			// SI LA CONSULTA NO SE EJECUTA ENTONCES RETORNA VACIO
			// SI LA CONSULTA SE EJECUTA ENTONCES CARGA EL LISTADO DE LIBROS DE LA VISTA
		    	include_once(VIEWS.DS.'consultapublica'.DS."Getlicencia_de_uso.php");
		    	    	include_once(VIEWS.DS.'consultapublica'.DS."footer.php");
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
		function GetConsultaHistorica(){
			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL			
			global $con;
			global $c;
			global $f;

			$pagina = $this->load_template_limpiaAmple(PROJECTNAME.' Getregistro');			
			// CARGANDO LLAMANDO LA FUNCION LSITAR LIBROS DEL MODELO (FUNCION QUE TRAE DE LA BASE DE DATOS EL LISTADO DE LIBROS
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();
			// SI LA CONSULTA NO SE EJECUTA ENTONCES RETORNA VACIO
			// SI LA CONSULTA SE EJECUTA ENTONCES CARGA EL LISTADO DE LIBROS DE LA VISTA
			
	    	include_once(VIEWS.DS.'consultapublica'.DS."GetFormConsultaHistorica.php");
		    	    	#include_once(VIEWS.DS.'consultapublica'.DS."footer.php");
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
		function GetResultadoConsultaHistorica(){
			global $con;
			global $c;
			global $f;

			$departamento 			= trim($c->sql_quote($_REQUEST['departamento']));
			$ciudad 				= trim($c->sql_quote($_REQUEST['ciudad']));
			$oficina 				= trim($c->sql_quote($_REQUEST['oficina']));
			$dependencia_destino 	= trim($c->sql_quote($_REQUEST['dependencia_destino']));
			$id_dependencia_raiz 	= trim($c->sql_quote($_REQUEST['id_dependencia_raiz']));
			$tipo_documento 		= trim($c->sql_quote($_REQUEST['tipo_documento']));
			$f_inicio 				= trim($c->sql_quote($_REQUEST['f_inicio']));
			$f_corte 				= trim($c->sql_quote($_REQUEST['f_corte']));

			include_once(VIEWS.DS.'informes/resumenpublico.php');
		}
		function GetProvincesinExistence($id){
			global $con;

			$listado = $con->Query("SELECT s.ciudad, c.Province, p.Name FROM seccional as s inner join city as c on c.code = s.ciudad inner join province as p on p.code = c.Province group by c.Province");

			while($row = $con->FetchAssoc($listado)){
				echo "<option value='".$row['Province']."'>".$row['Name']."</option>";
			}

		}
		function GetCitysinExistence($id){
			global $con;
			$prov = new MCity;
			$listado = $con->Query("SELECT s.ciudad, c.Name  FROM seccional as s inner join city as c on c.code = s.ciudad WHERE c.Province = '".$id."' group by c.Name");

			while($row = $con->FetchAssoc($listado)){
				echo "<option value='".$row['ciudad']."'>".$row['Name']."</option>";
			}

		}
		function VistaOficinasSeccional($code){

			global $con;
			$s = new MSeccional;
			$lits = $s->ListarSeccional("WHERE ciudad = '".$code."'");
			$select="";
			if($con->NumRows($lits) == 1){
				$select = " selected ";
			}
			while ($row = $con->FetchAssoc($lits)) {
				echo "<option value='".$row['id']."' $select>".$row["nombre"]."</option>";
			}
		}
		function ListadoAreasOficinaNew($id){

			global $con;

			$q_str = "
			SELECT a.id, a.nombre 
			FROM `usuarios_configurar_accesos` uc inner join areas a on uc.id_tabla = concat(a.id,'".$id."')
			where uc.tabla = 'area'
			group by a.id, a.nombre";
			$lits = $con->Query($q_str);
			$select="";
			if($con->NumRows($lits) == 1){
				$select = " selected ";
			}
			while ($row = $con->FetchAssoc($lits)) {
				$r = new MAreas;
				$r->CreateAreas("id", $row['id']);
				echo "<option value='".$r->GetId()."' $select>".$r->GetNombre()."</option>";
			}
		}
		function GetSeriesArea($id){
			global $con;
			$object = new MAreas_dependencias;
			// DE NO RECIBIR PARAMETROS ESTA FUNCION TRAE EL LISTADO COMPLETO DE LIBROS
			$query = $object->ListarAreas_dependencias(" WHERE id_area = '".$id."' and id_version='".$_SESSION['id_trd_empresa']."' group by id_dependencia_raiz");
			$select="";

			if($con->NumRows($query) == 1){

				$select = " selected ";

			}  
			while ($row = $con->FetchAssoc($query)) {
				$dep = new MDependencias;
				$dep->CreateDependencias("id", $row['id_dependencia_raiz']);
				echo "<option value='".$dep->GetId()."' $select>".$dep->GetNombre()."</option>";
			}
		}
		function GetSubSeriesArea($area, $serie){
			global $con;
			$object = new MAreas_dependencias;
			// DE NO RECIBIR PARAMETROS ESTA FUNCION TRAE EL LISTADO COMPLETO DE LIBROS
			$query = $object->ListarAreas_dependencias(" WHERE id_area = '".$area."' and id_dependencia_raiz = '".$serie."'");
			$select="";

			if($con->NumRows($query) == 1){
				$select = " selected ";
			}
			while ($row = $con->FetchAssoc($query)) {
				$dep = new MDependencias;
				$dep->CreateDependencias("id", $row['id_dependencia']);
				echo "<option value='".$dep->GetId()."' $select>".$dep->GetNombre()."</option>";
			}
		}

		function RegistrarFuncionario($identificacion, $p_nombre, $p_apellido, $ciudad, $email, $direccion, $celular, $seccional_siamm, $tp){
			global $con;
			global $c;
			global $f;

			ob_start();
			$pagina = $this->load_template_limpiaAmple(PROJECTNAME.' Getregistro');		

			$u = new MUsuarios;
			$u->CreateUsuarios("id", $identificacion);	

			$registrar = 0;
			
			if ($u->GetId() <= 0) {
				$registrar = 1;
			}else{

				$objectd = new MUsuarios;
				$objectd->CreateUsuarios("user_id", $email);

				if ($objectd->GetEmail() == "") {
					$registrar = 2;
				}else{
					$registrar = 3;
				}
			}
			// SI LA CONSULTA NO SE EJECUTA ENTONCES RETORNA VACIO
			// SI LA CONSULTA SE EJECUTA ENTONCES CARGA EL LISTADO DE LIBROS DE LA VISTA
		    	include_once(VIEWS.DS.'consultapublica'.DS."RegistrarUsuario.php");
		    	include_once(VIEWS.DS.'consultapublica'.DS."footer.php");
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
		function PruebaRegistro($user, $pass){

			global $con;
			global $c;
			global $f;

			ob_start();
			$pagina = $this->load_template_limpiaAmple(PROJECTNAME.' Getregistro');		

			$u = new MUsuarios;
			$u->CreateUsuarios("user_id", $user);	

			$registrar = 0;
			
			if ($u->GetId() <= 0) {
				$registrar = 1;
			}else{

				$objectd = new MUsuarios;
				$objectd->CreateUsuarios("user_id", $email);

				if ($objectd->GetEmail() == "") {
					$registrar = 2;
				}else{
					$registrar = 3;
				}
			}
			// SI LA CONSULTA NO SE EJECUTA ENTONCES RETORNA VACIO
			// SI LA CONSULTA SE EJECUTA ENTONCES CARGA EL LISTADO DE LIBROS DE LA VISTA
		    	include_once(VIEWS.DS.'consultapublica'.DS."PruebaRegistro.php");
		    	include_once(VIEWS.DS.'consultapublica'.DS."footer.php");
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

		function Getestados(){
			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL			
			global $con;
			$pagina = $this->load_template_limpiaAmple(PROJECTNAME.' Getradicado');			
			// CARGANDO LLAMANDO LA FUNCION LSITAR LIBROS DEL MODELO (FUNCION QUE TRAE DE LA BASE DE DATOS EL LISTADO DE LIBROS
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();
			// SI LA CONSULTA NO SE EJECUTA ENTONCES RETORNA VACIO
			// SI LA CONSULTA SE EJECUTA ENTONCES CARGA EL LISTADO DE LIBROS DE LA VISTA
		    			include_once(VIEWS.DS.'consultapublica'.DS."Getestados.php");
		    	    	include_once(VIEWS.DS.'consultapublica'.DS."footer.php");
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

		function Getresultados_estados($id, $tipo){


		//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL			

			global $con;

			global $c;

			$pagina = $this->load_template_limpiaAmple(PROJECTNAME.' Getresultados_radicado');			

			// CARGANDO LLAMANDO LA FUNCION LSITAR LIBROS DEL MODELO (FUNCION QUE TRAE DE LA BASE DE DATOS EL LISTADO DE LIBROS

			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.

			ob_start();

			// SI LA CONSULTA NO SE EJECUTA ENTONCES RETORNA VACIO

			// SI LA CONSULTA SE EJECUTA ENTONCES CARGA EL LISTADO DE LIBROS DE LA VISTA

			$radicado = $id;

			$path = "";
	        if ($tipo != "") {
	            $path = " and tipoalerta = '$tipo'";
	        }else{
	        	$tipo = "Todas las Actuaciones";
	        }

			$s1 = "select * from events_gestion where fecha = '".$id."' and es_publico = '1' $path ";	

			$query = $con->Query($s1);

	    	include_once(VIEWS.DS.'consultapublica'.DS."Getresultados_estados.php");

	    	include_once(VIEWS.DS.'consultapublica'.DS."footer.php");

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
		function GetCalculoPapel(){
			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL			
			global $con;
			global $c;
			global $f;
			//CARGANDO LA PAGINA DE INTERFAZ			
			$pagina = $this->load_template_limpiaAmple('Listar Suscriptores_modulos');			
			// CARGANDO LLAMANDO LA FUNCION LSITAR LIBROS DEL MODELO (FUNCION QUE TRAE DE LA BASE DE DATOS EL LISTADO DE LIBROS
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();
			// SI LA CONSULTA NO SE EJECUTA ENTONCES RETORNA VACIO
			// SI LA CONSULTA SE EJECUTA ENTONCES CARGA EL LISTADO DE LIBROS DE LA VISTA
	    	include(VIEWS.DS."informes/ResumenAhorro.php");	   			
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

		function GetBoletin(){
			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL			
			global $con;
			$pagina = $this->load_template_limpiaAmple(PROJECTNAME.' Getradicado');			
			// CARGANDO LLAMANDO LA FUNCION LSITAR LIBROS DEL MODELO (FUNCION QUE TRAE DE LA BASE DE DATOS EL LISTADO DE LIBROS
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();
			// SI LA CONSULTA NO SE EJECUTA ENTONCES RETORNA VACIO
			// SI LA CONSULTA SE EJECUTA ENTONCES CARGA EL LISTADO DE LIBROS DE LA VISTA
		    			include_once(VIEWS.DS.'consultapublica'.DS."boletin.php");
		    	    	include_once(VIEWS.DS.'consultapublica'.DS."footer.php");
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


		function GetDependencias($id){

			global $con;
			global $c;

			$query = $con->Query("select tipo_documento from gestion where id_dependencia_raiz = '".$id."' and es_publico = '1' group by tipo_documento");

			while ($row = $con->FetchAssoc($query)) {
				$d = new MDependencias;
				$d->CreateDependencias("id", $row['tipo_documento']);
				echo '<option value="'.$d->GetId().'">'.$d->GetNombre().'</option>';
			}


		}
		function GetInforme(){
			global $con;
			global $c;

			include_once(VIEWS.DS.'consultapublica'.DS."informeboletin.php");
		}
	}
?>