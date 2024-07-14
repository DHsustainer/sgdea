<?
session_start();
#header('Content-Type: text/html; charset=utf-8');
#error_reporting(E_ALL);
ini_set('display_errors', '1');

//invocando archivos que seran usados en nuestro controlador generico
	include_once('app/basePaths.inc.php');
	include_once(ROOT.DS.'DALC'.DS.'/mySql.php');
	include_once('consultas.php');
	include_once('funciones.php');	
	include_once(MODELS.DS."Super_adminM.php");
	//definiendo variables y conectandonos con la base de datos
	$con = new ConexionBaseDatos;
	$con->Connect($con);
	
	$ob = new MainController;
	$c = new Consultas;
	$f = new Funciones;
	
	#if (!isset($_SESSION['VAR_SESSIONES'])) {
				
	#}
	class MainController{
		//cargando pagina de prueba de inicio
		function CargarHome(){
			global $c;
			$c->crearLog();
			header("Location: ".HOMEDIR.DS."login/");
			include(VIEWS.DS.'default'.DS.'/templates/blue/index.php');
		}
		function Que_es(){
			global $c;
			$c->crearLog();

			include(VIEWS.DS.'default'.DS.'/templates/blue/que_es.php');
		}
		function Como_funciona(){
			global $c;
			$c->crearLog();

			include(VIEWS.DS.'default'.DS.'/templates/blue/como_funciona.php');
		}
		function Dirigido(){
			global $c;
			$c->crearLog();

			include(VIEWS.DS.'default'.DS.'/templates/blue/dirigido.php');
		}
		function Ecologico(){
			global $c;
			$c->crearLog();

			include(VIEWS.DS.'default'.DS.'/templates/blue/ecologico.php');
		}
		function Marco_legal(){
			global $c;
			$c->crearLog();

			include(VIEWS.DS.'default'.DS.'/templates/blue/marco_legal.php');
		}
		function Precios(){
			global $c;
			$c->crearLog();

			include(VIEWS.DS.'default'.DS.'/templates/blue/precios.php');
		}
		//cargando pagina de prueba de contacto
		function Contacto(){
			$pagina = $this->load_template('Pagina de Contacto');			
			$html = $this->load_page(VIEWS.DS.'default'.DS.'contacto.php');
			$pagina = $this->replace_content('/\#CONTENIDO\#/ms' ,$html , $pagina);
			$this->view_page($pagina);
		}

		function CargarNavegadorObsoleto(){
			global $c;
			$c->crearLog();
			$pagina = $this->load_templateLogin('Parece que usas un navegador obsoleto');			
			$html = $this->load_page(VIEWS.DS.'default'.DS.'navegador_obsoleto.php');
			$pagina = $this->replace_content('/\#CONTENIDO\#/ms' ,$html , $pagina);
			$this->view_page($pagina);
		}
		

		/* METODO QUE CARGA LAS PARTES PRINCIPALES DE LA PAGINA WEB
		INPUT
			$title | titulo en string del header
		OUTPUT
			$pagina | string que contiene toda el cocigo HTML de la plantilla 
		*/
		function load_template2($title='Sin Titulo', $page = "body.php"){
			//cargando el cuerpo principal de la pagina
			$pagina = $this->load_page(VIEWS.DS.'default'.DS.$page);
			//reemplazando el contenido por el texto que obtenemos (titulo del pagina)
			$pagina = $this->replace_content('/\#TITLE\#/ms' ,$title , $pagina);		
			//cargando el archivo de cabezeras					
			$header = $this->load_page('app/views/default/sections/s.header.php');
			//colocando el contenido de las cabezeras en nuestro archivo principal
			$pagina = $this->replace_content('/\#HEADER\#/ms' ,$header , $pagina);
			$pagina = $this->replace_content('/\#TITLE\#/ms' ,$title , $pagina);	
			//cargando el footer de nuestra pagina			
			$footer = $this->load_page('app/views/default/sections/s.footer.php');
			// colocando el footer en nuestra pagina nueva
			$pagina = $this->replace_content('/\#FOOTER\#/ms' ,$footer , $pagina);
			//retornando la pagina cargada
			return $pagina;
		}
		function load_templateLogin($title='Sin Titulo', $page = "body.php"){
			//cargando el cuerpo principal de la pagina
			$pagina = $this->load_page(VIEWS.DS.'login'.DS.$page);
			//reemplazando el contenido por el texto que obtenemos (titulo del pagina)
			$pagina = $this->replace_content('/\#TITLE\#/ms' ,$title , $pagina);		
			//cargando el footer de nuestra pagina			
			$footer = $this->load_page(VIEWS.DS.'login'.DS.'footer.php');
			// colocando el footer en nuestra pagina nueva
			$pagina = $this->replace_content('/\#FOOTER\#/ms' ,$footer , $pagina);
			//retornando la pagina cargada
			return $pagina;
		}

		function acerca(){
			$pagina = $this->load_templateLogin(PROJECTNAME);			
			$html = $this->load_page(VIEWS.DS.'default'.DS.'about.php');
			$pagina = $this->replace_content('/\#CONTENIDO\#/ms' ,$html , $pagina);
			$this->view_page($pagina);
		}


		// FUCNION PARA CARGAR EL TEMPLATE DE LA APLICACION WEB (LOGIN)
		function load_template($title='Sin Titulo'){
			global $con;
			//cargando el cuerpo principal de la pagina
			ob_start();
			include VIEWS.DS.'template'.DS.'ample/admin/body.php';
			$pagina = ob_get_clean();
			//reemplazando el contenido por el texto que obtenemos (titulo del pagina)
			$pagina = $this->replace_content('/\#TITLE\#/ms' ,$title , $pagina);		
			//cargando el archivo de cabezeras					
			ob_start();
			if ($_SESSION[sadmin]==1) {
				$user_list=$con->Query("SELECT u.user_id, concat(u.p_nombre,' ',u.p_apellido) as nombre from usuarios u, arbol_super_admin asa where asa.id_usuario=u.user_id and asa.id_super_admin='$_SESSION[sadminidnum]'");
			}			

			include VIEWS.DS.'template'.DS.'ample/admin/header.php';
			$header = ob_get_clean();			
			//colocando el contenido de las cabezeras en nuestro archivo principal
			$pagina = $this->replace_content('/\#HEADER\#/ms' ,$header , $pagina);
			$pagina = $this->replace_content('/\#TITLE\#/ms' ,$title , $pagina);	
			//cargando el footer de nuestra pagina			
			$footer = $this->load_page(VIEWS.DS.'template'.DS.'footer.php');
			// colocando el footer en nuestra pagina nueva
			$pagina = $this->replace_content('/\#FOOTER\#/ms' ,$footer , $pagina);
			//retornando la pagina cargada
			return $pagina;
		}

		function load_templateAmpleApp($title = "Sin T&iacute;tulo"){
			global $con;
			//cargando el cuerpo principal de la pagina
			ob_start();
			include VIEWS.DS.'template'.DS.'ample/body.php';
			$pagina = ob_get_clean();
			//reemplazando el contenido por el texto que obtenemos (titulo del pagina)
			$pagina = $this->replace_content('/\#TITLE\#/ms' ,$title , $pagina);		
			//cargando el archivo de cabezeras					
			ob_start();
			if ($_SESSION[sadmin]==1) {
				$user_list=$con->Query("SELECT u.user_id, concat(u.p_nombre,' ',u.p_apellido) as nombre from usuarios u, arbol_super_admin asa where asa.id_usuario=u.user_id and asa.id_super_admin='$_SESSION[sadminidnum]'");
			}			

			include VIEWS.DS.'template'.DS.'ample/header.php';
			$header = ob_get_clean();			
			//colocando el contenido de las cabezeras en nuestro archivo principal
			$pagina = $this->replace_content('/\#HEADER\#/ms' ,$header , $pagina);
			$pagina = $this->replace_content('/\#TITLE\#/ms' ,$title , $pagina);	
			//cargando el footer de nuestra pagina			
			$footer = $this->load_page(VIEWS.DS.'template'.DS.'ample/footer.php');
			// colocando el footer en nuestra pagina nueva
			$pagina = $this->replace_content('/\#FOOTER\#/ms' ,$footer , $pagina);
			//retornando la pagina cargada
			return $pagina;
		}

		function load_template_limpia($title='Sin Titulo'){
			global $con;
			//cargando el cuerpo principal de la pagina
			ob_start();
			include VIEWS.DS.'template'.DS.'body_template.php';
			$pagina = ob_get_clean();
			//reemplazando el contenido por el texto que obtenemos (titulo del pagina)
			$pagina = $this->replace_content('/\#TITLE\#/ms' ,$title , $pagina);		
			//cargando el archivo de cabezeras					
			ob_start();
			if ($_SESSION[sadmin]==1) {
				$user_list=$con->Query("SELECT u.user_id, concat(u.p_nombre,' ',u.p_apellido) as nombre from usuarios u, arbol_super_admin asa where asa.id_usuario=u.user_id and asa.id_super_admin='$_SESSION[sadminidnum]'");
			}			

			include VIEWS.DS.'template'.DS.'header_template.php';
			$header = ob_get_clean();			
			//colocando el contenido de las cabezeras en nuestro archivo principal
			$pagina = $this->replace_content('/\#HEADER\#/ms' ,$header , $pagina);
			$pagina = $this->replace_content('/\#TITLE\#/ms' ,$title , $pagina);	
			//cargando el footer de nuestra pagina			
			$footer = $this->load_page(VIEWS.DS.'template'.DS.'footer.php');
			// colocando el footer en nuestra pagina nueva
			$pagina = $this->replace_content('/\#FOOTER\#/ms' ,$footer , $pagina);
			//retornando la pagina cargada
			return $pagina;
		}

		function TemplateAmplelimpia($title='Sin Titulo'){
			global $con;
			//cargando el cuerpo principal de la pagina
			ob_start();
			include VIEWS.DS.'template'.DS.'ample/admin/body_limpio.php';
			$pagina = ob_get_clean();
			//reemplazando el contenido por el texto que obtenemos (titulo del pagina)
			$pagina = $this->replace_content('/\#TITLE\#/ms' ,$title , $pagina);		
			//cargando el archivo de cabezeras					
			ob_start();
			if ($_SESSION[sadmin]==1) {
				$user_list=$con->Query("SELECT u.user_id, concat(u.p_nombre,' ',u.p_apellido) as nombre from usuarios u, arbol_super_admin asa where asa.id_usuario=u.user_id and asa.id_super_admin='$_SESSION[sadminidnum]'");
			}			

			include VIEWS.DS.'template'.DS.'ample/admin/header_limpio.php';
			$header = ob_get_clean();			
			//colocando el contenido de las cabezeras en nuestro archivo principal
			$pagina = $this->replace_content('/\#HEADER\#/ms' ,$header , $pagina);
			$pagina = $this->replace_content('/\#TITLE\#/ms' ,$title , $pagina);	
			//cargando el footer de nuestra pagina			
			$footer = $this->load_page(VIEWS.DS.'template'.DS.'ample/footer.php');
			// colocando el footer en nuestra pagina nueva
			$pagina = $this->replace_content('/\#FOOTER\#/ms' ,$footer , $pagina);
			//retornando la pagina cargada
			return $pagina;
		}

		function load_template_limpiaAmple($title='Sin Titulo'){
			global $con;
			//cargando el cuerpo principal de la pagina
			ob_start();
			include VIEWS.DS.'template/ample/'.DS.'body_limpio.php';
			$pagina = ob_get_clean();
			//reemplazando el contenido por el texto que obtenemos (titulo del pagina)
			$pagina = $this->replace_content('/\#TITLE\#/ms' ,$title , $pagina);		
			//cargando el archivo de cabezeras					
			ob_start();
			if ($_SESSION[sadmin]==1) {
				$user_list=$con->Query("SELECT u.user_id, concat(u.p_nombre,' ',u.p_apellido) as nombre from usuarios u, arbol_super_admin asa where asa.id_usuario=u.user_id and asa.id_super_admin='$_SESSION[sadminidnum]'");
			}			

			include VIEWS.DS.'template/ample'.DS.'header_limpio.php';
			$header = ob_get_clean();			
			//colocando el contenido de las cabezeras en nuestro archivo principal
			$pagina = $this->replace_content('/\#HEADER\#/ms' ,$header , $pagina);
			$pagina = $this->replace_content('/\#TITLE\#/ms' ,$title , $pagina);	
			//cargando el footer de nuestra pagina			
			$footer = $this->load_page(VIEWS.DS.'template'.DS.'footer.php');
			// colocando el footer en nuestra pagina nueva
			$pagina = $this->replace_content('/\#FOOTER\#/ms' ,$footer , $pagina);
			//retornando la pagina cargada
			return $pagina;
		}

		function load_template_limpiaAmpleNoPreLoad($title='Sin Titulo'){
			global $con;
			//cargando el cuerpo principal de la pagina
			ob_start();
			include VIEWS.DS.'template/ample/'.DS.'body_limpio_no_preload.php';
			$pagina = ob_get_clean();
			//reemplazando el contenido por el texto que obtenemos (titulo del pagina)
			$pagina = $this->replace_content('/\#TITLE\#/ms' ,$title , $pagina);		
			//cargando el archivo de cabezeras					
			ob_start();
			if ($_SESSION[sadmin]==1) {
				$user_list=$con->Query("SELECT u.user_id, concat(u.p_nombre,' ',u.p_apellido) as nombre from usuarios u, arbol_super_admin asa where asa.id_usuario=u.user_id and asa.id_super_admin='$_SESSION[sadminidnum]'");
			}			

			include VIEWS.DS.'template/ample'.DS.'header_limpio.php';
			$header = ob_get_clean();			
			//colocando el contenido de las cabezeras en nuestro archivo principal
			$pagina = $this->replace_content('/\#HEADER\#/ms' ,$header , $pagina);
			$pagina = $this->replace_content('/\#TITLE\#/ms' ,$title , $pagina);	
			//cargando el footer de nuestra pagina			
			$footer = $this->load_page(VIEWS.DS.'template'.DS.'footer.php');
			// colocando el footer en nuestra pagina nueva
			$pagina = $this->replace_content('/\#FOOTER\#/ms' ,$footer , $pagina);
			//retornando la pagina cargada
			return $pagina;
		}

		function load_template_config($title='Sin Titulo'){
			global $con;
			//cargando el cuerpo principal de la pagina
			ob_start();
			include VIEWS.DS.'template'.DS.'body_template_config.php';
			$pagina = ob_get_clean();
			//reemplazando el contenido por el texto que obtenemos (titulo del pagina)
			$pagina = $this->replace_content('/\#TITLE\#/ms' ,$title , $pagina);		
			//cargando el archivo de cabezeras					
			ob_start();
			if ($_SESSION[sadmin]==1) {
				$user_list=$con->Query("SELECT u.user_id, concat(u.p_nombre,' ',u.p_apellido) as nombre from usuarios u, arbol_super_admin asa where asa.id_usuario=u.user_id and asa.id_super_admin='$_SESSION[sadminidnum]'");
			}			

			include VIEWS.DS.'template'.DS.'header_template.php';
			$header = ob_get_clean();			
			//colocando el contenido de las cabezeras en nuestro archivo principal
			$pagina = $this->replace_content('/\#HEADER\#/ms' ,$header , $pagina);
			$pagina = $this->replace_content('/\#TITLE\#/ms' ,$title , $pagina);	
			//cargando el footer de nuestra pagina			
			$footer = $this->load_page(VIEWS.DS.'template'.DS.'footer.php');
			// colocando el footer en nuestra pagina nueva
			$pagina = $this->replace_content('/\#FOOTER\#/ms' ,$footer , $pagina);
			//retornando la pagina cargada
			return $pagina;
		}		


		// FUCNION PARA CARGAR EL TEMPLATE DE LA APLICACION WEB (LOGIN)
		function TemplateAcuse($title='Sin Titulo'){
			//cargando el cuerpo principal de la pagina
			ob_start();
			include VIEWS.DS.'template'.DS.'Acusebody.php';
			$pagina = ob_get_clean();
			//reemplazando el contenido por el texto que obtenemos (titulo del pagina)
			$pagina = $this->replace_content('/\#TITLE\#/ms' ,$title , $pagina);		
			//cargando el archivo de cabezeras					
			ob_start();
			include VIEWS.DS.'template'.DS.'Acuseheader.php';
			$header = ob_get_clean();			
			//colocando el contenido de las cabezeras en nuestro archivo principal
			$pagina = $this->replace_content('/\#HEADER\#/ms' ,$header , $pagina);
			$pagina = $this->replace_content('/\#TITLE\#/ms' ,$title , $pagina);	
			//cargando el footer de nuestra pagina			
			$footer = $this->load_page(VIEWS.DS.'template'.DS.'Acusetemplate.php');
			// colocando el footer en nuestra pagina nueva
			$pagina = $this->replace_content('/\#FOOTER\#/ms' ,$footer , $pagina);
			//retornando la pagina cargada
			return $pagina;
		}		


		function load_templateRegister($title='Sin Titulo'){
			//cargando el cuerpo principal de la pagina
			$pagina = $this->load_page(VIEWS.DS.'login'.DS.'body.php');
			//reemplazando el contenido por el texto que obtenemos (titulo del pagina)
			$pagina = $this->replace_content('/\#TITLE\#/ms' ,$title , $pagina);		
			//cargando el archivo de cabezeras					
			$header = "";
			include_once (VIEWS.DS.'login'.DS.'header.php');			
			//colocando el contenido de las cabezeras en nuestro archivo principal
			$pagina = $this->replace_content('/\#HEADER\#/ms' ,$header , $pagina);
			$pagina = $this->replace_content('/\#TITLE\#/ms' ,$title , $pagina);	
			//cargando el footer de nuestra pagina			
			$footer = $this->load_page(VIEWS.DS.'login'.DS.'footer.php');
			// colocando el footer en nuestra pagina nueva
			$pagina = $this->replace_content('/\#FOOTER\#/ms' ,$footer , $pagina);
			//retornando la pagina cargada
			return $pagina;
		}
		function load_Clean_Template($title='Sin Titulo'){
			//cargando el cuerpo principal de la pagina
			$pagina = $this->load_page(VIEWS.DS.'dashboard'.DS.'dashboard.php');
			//reemplazando el contenido por el texto que obtenemos (titulo del pagina)
			$pagina = $this->replace_content('/\#BODY\#/ms' ,$title , $pagina);		
			//cargando el archivo de cabezeras					
			$pagina = $this->replace_content('/\#TITLE\#/ms' ,$title , $pagina);	
			//cargando el footer de nuestra pagina			
			//retornando la pagina cargada
			return $pagina;
		}
		
		/* METODO QUE CARGA UNA PAGINA DE LA SECCION VIEW Y LA MANTIENE EN MEMORIA
			INPUT
			$page | direccion de la pagina 
			OUTPUT
			STRING | devuelve un string con el codigo html cargado
		*/	
		public function load_page($page)
		{
			ob_start();
			include $page;			
			return ob_get_clean();
		}
		
		/* METODO QUE ESCRIBE EL CODIGO PARA QUE SEA VISTO POR EL USUARIO
			INPUT
			$html | codigo html
			OUTPUT
			HTML | codigo html		
		*/
		public function view_page($html)
		{
			echo $html;
		}
		
		/* PARSEA LA PAGINA CON LOS NUEVOS DATOS ANTES DE MOSTRARLA AL USUARIO
			INPUT
			$out | es el codigo html con el que sera reemplazada la etiqueta CONTENIDO
			$pagina | es el codigo html de la pagina que contiene la etiqueta CONTENIDO
			OUTPUT
			HTML 	| cuando realiza el reemplazo devuelve el codigo completo de la pagina
		*/
		public function replace_content($in='/\#CONTENIDO\#/ms', $out,$pagina)
		{
			 return preg_replace($in, $out, $pagina);	 	
		}
		/*
			CAPTURA EL IDIOMA DEL SERVIDOR O EL RECIBIDO Y TRADUCE LA WEB 
			
			EN EL OUTPUT
		*/
		public function get_idioma($component)
		{
			global $f;  
			
			$key = $f->getUserLanguage();         
			#Si achivo de idioma es correcto
			$file = WEBROOT.DS.'components'.DS.$component.DS.'lang'.DS.$key.'.inc.php';
			if ( is_file( $file ) ){        
				include_once $file;
			}else{
				include_once WEBROOT.DS.'components'.DS.$component.DS.'lang'.DS.'es.inc.php';                
			}
			return $id;
	    }		

	    function ErrorToken(){
	    	global $c;
	    	global $f;
	    	global $con;
	    	
	    	include_once(MODELS.DS."UsuariosM.php");
	    	include_once(MODELS.DS.'Suscriptores_contactosM.php');
			include_once(MODELS.DS.'Suscriptores_tiposM.php');

	    	$pagina = $this->load_template_limpiaAmple('Ups! Error');
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();

			include_once(VIEWS.DS.'template/error_token.php');

			$table = ob_get_clean();
			// ASIGNANDOLE A LA VARIABLE  EL CONTENIDO DEL BUFFER
			$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $table  , $pagina);
			// CARGAMOS LA PAGINA EN EL BROWSER
			$this->view_page($pagina);
	    }

	}