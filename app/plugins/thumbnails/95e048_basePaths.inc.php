<?
	//funcion que define la estructura de archivos de la aplicacion
	if(!defined('ROOT')){
    define('ROOT',dirname(__FILE__));
	}
	if(!defined('HOMEDIR')){
		define('HOMEDIR', 'https://expedientesdigitales.com');
	}	
	if(!defined('ASSETS')){
		define('ASSETS', 'https://expedientesdigitales.com/app/views/assets/');
	}	
	if(!defined('DS')){
	    define('DS',DIRECTORY_SEPARATOR); // Abreviacion mas comoda
	}
	if(!defined('APP')){
		define('APP', HOMEDIR.DS.'app'.DS);
	}	
	if(!defined('UPLOADS')){
	    define('UPLOADS',ROOT . DS . 'archivos_uploads/gestion');
	}		
	if(!defined('FILESAT')){
	    define('FILESAT', 'http://files.expedientesdigitales.com');
	}		
	if(!defined('CONTROLLERS')){
	    define('CONTROLLERS',ROOT . DS . 'controllers');
	}
	if(!defined('MODELS')){
	    define('MODELS',ROOT . DS . 'models');
	}
	if(!defined('VIEWS')){
	    define('VIEWS',ROOT . DS . 'views');
	}
	if(!defined('ENTITIES')){
	    define('ENTITIES',ROOT . DS . 'entities');
	}	
	if(!defined('WEBROOT')){
	    define('WEBROOT',ROOT . DS . 'webroot');
	}
	if(!defined('PLUGINS')){
	    #define('PLUGINS', 'https://expedientesdigitales.com/app/plugins/');
	   	define('PLUGINS',ROOT . DS . 'plugins');
	}
	if(!defined('THUMBS')){
	    define('THUMBS','http://thumbnails.expedientesdigitales.com');
	}
	if(!defined('PROJECTNAME')){
	    define('PROJECTNAME', 'SGDEA LAWS');
	}
	if(!defined('PROJECTNAMEINICIALES')){
		define("PROJECTNAMEINICIALES", "LAWS");
	}
	if(!defined('ST')){
	    define('ST', ' &brvbar; ');
	}
	if(!defined('CONTACTMAIL')){
		define("CONTACTMAIL", "info@expedientesdigitales.com");
	}

	if(!defined('SUSCRIPTORCAMPOIDENTIFICACION')){
		define("SUSCRIPTORCAMPOIDENTIFICACION", "Identificacion");//Codigo NIU
	}
	if(!defined('SUSCRIPTORCAMPONOMBRE')){
		define("SUSCRIPTORCAMPONOMBRE", "Suscriptor");// Direccion de Lectura
	}
	if(!defined('SUSCRIPTORCAMPODIRECCION')){
		define("SUSCRIPTORCAMPODIRECCION", "Direccion");//Nombre
	}
	if(!defined('CAMPOAREADETRABAJO')){
		define("CAMPOAREADETRABAJO", "Area de Trabajo");//Proceso
	}

?>