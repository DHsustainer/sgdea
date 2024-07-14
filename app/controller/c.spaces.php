<?
session_start();
date_default_timezone_set('America/Bogota');
error_reporting(E_ALL);
ini_set('display_errors', '1');
	include_once('app/basePaths.inc.php');
	include_once(MODELS.DS.'GestionM.php');
	include_once(MODELS.DS.'Gestion_anexosM.php');
	include_once(MODELS.DS.'Super_adminM.php');
	include_once(MODELS.DS.'UsuariosM.php');
	include_once(ROOT.DS.'DALC'.DS.'/mySql.php');
	//require 'vendor/autoload.php';
	//include_once(PLUGINS.DS.'aws/aws-autoloader.php');
//	include_once(PLUGINS.DS.'aws/Aws/S3/S3Client.php');
	

	include_once('consultas.php');
	include_once('funciones.php');
	// Definiendo variables y conectandonos con la base de datos

	$con = new ConexionBaseDatos;
	$con->Connect($con);
	// Llamando al objeto a controlar
	$ob = new CSpaces;
	$c = new Consultas;
	$f = new Funciones;

	switch ($c->sql_quote($_REQUEST['action'])) {
		case 'testconnect':
			$ob->Listing();
			break;
		
		default:
			$ob->Listing();
			break;
	}
	// DEFINIENDO LA CLASE DEL CONTROLADOR DEL OBJETO QUE TIENE HERENCIA CON EL CONTROLADOR GENERICO PARA CARGAR LA INTERFAZ
	class CSpaces extends MainController{

		

		// DEFINIENDO LA FUNCION LISTAR 		
		function Listing(){

			global $con;
			global $f;
			global $c;

			/* VARIABLES PARA CREAR */
			$access_key 	= 	"O4QGGFFPLIXBNOVBQOKP";
			$secret_key 	= 	"QgPyOaoop0gVW8PhT8t/6Fgy5F7PgPgSlGdrnaAs2kU";
			$host 			= 	"digitaloceanspaces.com";
			$space_name 	= 	"my-new-space";
			$server 		= 	"sfo2";


			// Included aws/aws-sdk-php via Composer's autoloader
			echo '<h2>Listado de Buckets</h2>';
			//include_once(PLUGINS.DS.'aws/aws-autoloader.php');
			//use Aws\S3\S3Client;

			$client = new Aws\S3\S3Client([
			        'version' => 'latest',
			        'region'  => 'us-east-1',
			        'endpoint' => 'https://sfo2.digitaloceanspaces.com',
			        'credentials' => [
			                'key'    => $access_key,
			                'secret' => $secret_key,
			            ],
			]);
/*

			$spaces = $client->listBuckets();
			foreach ($spaces['Buckets'] as $space){
			    echo $space['Name']."\n";
			}

*/

		}
	}

?>