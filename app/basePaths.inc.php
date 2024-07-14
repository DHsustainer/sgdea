<?
//funcion que define la estructura de archivos de la aplicacion
if(!defined('ROOT')){
	define('ROOT',dirname(__FILE__));
}
if(!defined('HOMEDIR')){
	define('HOMEDIR', 'https://'.$_SERVER['HTTP_HOST']);
}	
if(!defined('ASSETS')){
	define('ASSETS', HOMEDIR.'/app/views/assets/');
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
if(!defined('UPVERSION')){
    define('UPVERSION',ROOT . DS . 'archivos_uploads/version');
}
if(!defined('UPFIRMASCRT')){
    define('UPFIRMASCRT',ROOT . DS . 'archivos_uploads/firmascrt');
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
   	define('PLUGINS',ROOT . DS . 'plugins');
}
if(!defined('ST')){
    define('ST', ' &brvbar; ');
}
if(!defined('SUSCRIPTORDEPENDENCIA')){
	define("SUSCRIPTORDEPENDENCIA", "Mascota");//Proceso
}

 $viewer =  array(     ".doc" => "google" , "docx" => "google" , ".zip" => "google" , ".rar" => "google" , ".tar" => "google" 
, ".xls" => "google" , "xlsx" => "google" , ".ppt" => "google" , ".pps" => "google" , "pptx" => "google" , "ppsx" => "google" 
, ".pdf" => "google" , ".txt" => "google" , ".jpg" => "image"  , "jpeg" => "image"  , ".bmp" => "image"  , ".gif" => "image"  
, ".png" => "image"  , ".dib" => "image"  , ".tif" => "image"  , "tiff" => "image"  , "mpeg" => "video"  , ".avi" => "video"  
, ".mp4" => "video"  , "midi" => "audio"  , ".acc" => "audio"  , ".wma" => "audio"  , ".ogg" => "audio"  , ".mp3" => "audio"  
, ".flv" => "video"  , ".wmv" => "video"  , ".csv" => "google" , ".DOC" => "google" , "DOCX" => "google" , ".ZIP" => "google" 
, ".RAR" => "google" , ".TAR" => "google" , ".XLS" => "google" , "XLSX" => "google" , ".PPT" => "google" , ".PPS" => "google" 
, "PPTX" => "google" , "PPSX" => "google" , ".PDF" => "google" , ".TXT" => "google" , ".JPG" => "image"  , "JPEG" => "image"  
, ".BMP" => "image"  , ".GIF" => "image"  , ".PNG" => "image"  , ".DIV" => "image"  , ".TIF" => "image"  , "TIFF" => "image"  
, "MPEG" => "video"  , ".AVI" => "video"  , ".MP4" => "video"  , "MIDI" => "audio"  , ".ACC" => "audio"  , ".WMA" => "audio"  
, ".OGG" => "audio"  , ".MP3" => "audio"  , ".FLV" => "video"  , ".WMV" => "video"  , ".CSV" => "google" );

if(!defined('VIEWER')){
    define("VIEWER", $viewer);//Proceso
}

?>