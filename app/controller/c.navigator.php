<?
session_start();
date_default_timezone_set('America/Bogota');
if ($_REQUEST['action'] == 'registrov2' && $_SESSION['usuario'] == 'sanderkdna@gmail.com') {
	// error_reporting(E_ALL);
	// ini_set('display_errors', '1');
	// code...
}
	//Invocando archivos que seran usados en nuestro controlador generico
	include_once('app/basePaths.inc.php');
	include_once(MODELS.DS.'Areas_dependenciasM.php');
	include_once(MODELS.DS.'AreasM.php');
	include_once(MODELS.DS.'Alertas_suscriptorM.php');
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
	include_once(MODELS.DS.'Solicitudes_documentosM.php');
	include_once(MODELS.DS.'Mailer_messageM.php');
	include_once(MODELS.DS.'Mailer_attachmentsM.php');
	include_once(MODELS.DS.'Mailer_from_messageM.php');
	include_once(MODELS.DS.'Mailer_replysM.php');
	include_once(MODELS.DS.'NotificacionesM.php');
	include_once(MODELS.DS.'Gestion_anexosM.php');
	include_once(MODELS.DS.'Gestion_transferenciasM.php');
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
	include_once(MODELS.DS.'Suscriptores_tiposM.php');
	include_once(MODELS.DS.'Suscriptores_contactos_direccionM.php');
	include_once(MODELS.DS.'Wf_mapasM.php');
	include_once(MODELS.DS.'Wf_mapas_elementosM.php');
	include_once(MODELS.DS.'Wf_gestion_mapasM.php');
	include_once(MODELS.DS.'Wf_gestion_mapas_elementosM.php');
	include_once(MODELS.DS.'UsuariosM.php');
	include_once(MODELS.DS.'Plantillas_emailM.php');
	##include_once(PLUGINS.DS.'PHPMailer_5.2.4/class.phpmailer.php');
	include_once(PLUGINS.DS.'PHPExcel.php');
	include_once(PLUGINS.DS.'nusoap/nusoap.php');
	include_once(ROOT.DS.'DALC'.DS.'/mySql.php');
	include_once('consultas.php');
	include_once('funciones.php');
	include_once(MODELS.DS.'Meta_big_dataM.php');
	include_once(MODELS.DS.'Meta_referencias_camposM.php');
	include_once(MODELS.DS.'Meta_referencias_titulosM.php');
	include_once(MODELS.DS.'Meta_listas_valoresM.php');
	include_once(MODELS.DS.'Meta_listasM.php');
	require_once(PLUGINS.DS.'tcpdf/tcpdf.php');
	require_once(PLUGINS.DS.'FPDI/fpdi.php');


	include_once(MODELS.DS.'Plantilla_documento_configuracionM.php');
	include_once(PLUGINS.DS.'dompdf/dompdf_config.inc.php');
	include_once(PLUGINS.DS.'phpqrcode/qrlib.php');
	include_once(MODELS.DS.'Gestion_anexos_firmasM.php');

	// Definiendo variables y conectandonos con la base de datos
	$con = new ConexionBaseDatos;
	$con->Connect($con);

	// Llamando al objeto a controlar
	$ob = new CGestion;
	$c = new Consultas;
	$f = new Funciones;
	$au = new MAlertas_usuarios;

	
	$constrain = 'WHERE id = '.$_REQUEST['id'];

		// LA FUNCION SQLQUOTE de la clase Consultas se encarga de fultrar las variables recibidas por GET o por POST para evitar la inyeccion de SQL
		// esta funcion solo funciona cuando se ha establecido conexion con la base de datos
		// SI LA ACTION CAPTURADA ES LISTAR ENTONCES LISTA
		if($c->sql_quote($_REQUEST['action']) == 'GetFirstViewNavigation')
			$ob->GetFirstView();
		// SINO SI ES NUEVO ENTONCES CARGA EL FORMULARIO INSERTAR
        elseif($c->sql_quote($_REQUEST['action']) == 'VistaSadmin')
			$ob->ListarVistaSadmin($c->sql_quote($_REQUEST['id']));
		elseif($c->sql_quote($_REQUEST['action']) == 'VistaJefe')
			$ob->ListarVistaJefe($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['cn']));
        elseif($c->sql_quote($_REQUEST['action']) == 'VistaSimple')
			$ob->ListarExpedientesUsuario($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['cn']), $c->sql_quote($_REQUEST['p1']));
        elseif($c->sql_quote($_REQUEST['action']) == 'nuevo')
			$ob->GetFirstView();
		else
			// SI NO ES NINGUNA DE LAS ANTERIORES ENTONCES CARGA POR DEFECTO LA VISTA DE LISTADO
			$ob->GetFirstView('');

	// DEFINIENDO LA CLASE DEL CONTROLADOR DEL OBJETO QUE TIENE HERENCIA CON EL CONTROLADOR GENERICO PARA CARGAR LA INTERFAZ

	class CGestion extends MainController{

	// DEFINIENDO LA FUNCION LISTAR
        function GetFirstView(){

            //	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL

            global $con;
            global $c;
            global $f;

            //CARGANDO LA PAGINA DE INTERFAZ
            // SI LA CONSULTA SE EJECUTA ENTONCES CARGA EL LISTADO DE LIBROS DE LA VISTA
            $perfil = 'U';
            if ($_SESSION['t_cuenta'] == '1' && $_SESSION['sadmin'] == '0') {
                $perfil = 'J';
                $area = $_SESSION['area_principal'];
                $seccional = $_SESSION['seccional'];
                $this->ListarVistaJefe($area, $seccional);
                
            }
            if ($_SESSION['sadmin'] == '1' && $_SESSION['t_cuenta'] == '1' ) {
                $perfil = 'A';
                $this->ListarVistaOficinasSadmin();
                
            }
            if($perfil == 'U'){
                $area = $_SESSION['area_principal'];
                $seccional = $_SESSION['seccional'];
                $this->ListarExpedientesUsuario($_SESSION['user_ai'], $area, $seccional);
                
            }
        
        }
        function ListarVistaOficinasSadmin(){
            global $con;
            global $c;
            global $f;
            include_once(VIEWS.DS.'gestion/ListarVistaOficinasSadmin.php');

        }

        function ListarVistaSadmin($value){

            global $con;
            global $c;
            global $f;

            include_once(VIEWS.DS.'gestion/ListarVistaSadmin.php');

        }

        function ListarVistaJefe($value = '', $seccional = ''){
            global $con;
            global $c;
            global $f;

            if($value == ''){
                $value = $_SESSION['area_principal'];
            }
            if($seccional == ''){
                $seccional = $_SESSION['seccional'];
            }

            include_once(VIEWS.DS.'gestion/ListarVistaJefe.php');

        }

        function ListarExpedientesUsuario($value = '', $area = '', $seccional = ''){
            global $con;
            global $c;
            global $f;

            if($value == ''){
                $value = $_SESSION['user_ai'];
            }
            if($area == ''){
                $area = $_SESSION['area_principal'];
            }
            if($seccional == ''){
                $seccional = $_SESSION['seccional'];
            }


            include_once(VIEWS.DS.'gestion/ListarExpedientesUsuario.php');

        }
	}
?>