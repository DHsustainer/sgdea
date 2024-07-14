<?php

session_start();

#error_reporting(E_ALL);

#ini_set('display_errors', '1');



date_default_timezone_set("America/Bogota");

require_once ("lib/nusoap.php");

if (!isset($_SESSION['VAR_SESSIONES'])) {

    $cliente = new nusoap_client("http://laws.com.co/ws/GetDetailSuscriptorKeys.wsdl", true);

    $error = $cliente->getError();

    if ($error) {

        echo "<h2>Constructor error</h2><pre>" . $error . "</pre>";

    }

    $array = array("id" => $_SERVER['HTTP_HOST'], "key" => $_SESSION['user_key']);

    $result = $cliente->call("GetDataSesion", $array);

    if ($cliente->fault) {

		$datosreturno['iten']['continuar'] = 'N';

		$datosreturno['iten']['mensaje'] = "No se conectar";

		$return['vDATOS'] = $datosreturno;/*almanecena lo datos en un array*/

		$return['error'] = 1;

		echo json_encode($return);

		exit();

    }else{

        $error = $cliente->getError();

        if ($error) {

            $datosreturno['iten']['continuar'] = 'N';

			$datosreturno['iten']['mensaje'] = "No se conectar";

			$return['vDATOS'] = $datosreturno;/*almanecena lo datos en un array*/

			$return['error'] = 1;

			echo json_encode($return);

			exit();

        }else {

            if ($result == "") {

            	$datosreturno['iten']['continuar'] = 'N';

				$datosreturno['iten']['mensaje'] = "No se creo el WS";

				$return['vDATOS'] = $datosreturno;/*almanecena lo datos en un array*/

				$return['error'] = 1;

				echo json_encode($return);

				exit();

            }else{

                $x  = explode(",", $result);

                if ($x[0] != 'errno') {

                    $_SESSION["pzhkCSC0XMwpGMT"] = desencriptar($x[0], $_SESSION['user_key']);

                    $_SESSION["kYg8omRSc1EDj3u"] = desencriptar($x[1], $_SESSION['user_key']);

                    $_SESSION["1oKU35BSbQ7CG5Q"] = desencriptar($x[2], $_SESSION['user_key']);

                    $_SESSION["71c029wus3yJWEN"] = desencriptar($x[3], $_SESSION['user_key']);

                    $_SESSION['VAR_SESSIONES'] = true;

                }else{

                    $_SESSION['VAR_SESSIONES'] = false;

                }

            }

        }

    }

}



function desencriptar($cadena, $key){

    $decrypted = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode($cadena), MCRYPT_MODE_CBC, md5(md5($key))), "\0");

    return $decrypted;  //Devuelve el string desencriptado

}





include_once('../app/basePaths.inc.php');

#include_once(PLUGINS.DS.'phpmailer/class.phpmailer.php');	

#include_once(PLUGINS.DS.'phpmailer/PHPMailerAutoload.php');

require_once(PLUGINS.DS.'tcpdf/tcpdf.php');

require_once(PLUGINS.DS.'FPDI/fpdi.php');

require_once(PLUGINS.DS.'phpqrcode/qrlib.php');

include_once(ROOT.DS.'DALC'.DS.'/mySql.php');

include_once('../app/controller/consultas.php');

include_once('../app/controller/funciones.php');









$con = new ConexionBaseDatos;

$con->Connect($con);

$c = new Consultas;

$f = new Funciones;



$r = $_REQUEST['r'].'.php';/*archivo d ela clase*/

$cls = $_REQUEST['c'];/*nombre d el aclase*/

$fn = $_REQUEST['f'];/*funcion*/

$p = $_REQUEST['p'];/*parametros*/

if($p == '_POST')

{

    $p = $_POST['p'];   

}

include($r);/*llama el archivo*/

$server = new $cls();/*invoca la clase o crea le objeto*/



unset($datos);

if($p != '')

{

	$datos = $server -> $fn($p);/*llam la funcion o el metodo pasando los parametros*/

}

else

{

	$datos = $server -> $fn();/*llam la funcion o el metodo*/

}

unset($return);

$return['vDATOS'] = $datos;/*almanecena lo datos en un array*/

$return['error'] = 1;



/*se describe que es tipo del archivo y loq ue retorna es json y s everifica si el servidor tiene habilitado la liberia gzip para hacer la compresion d elos datos retornado*/

header('Content-Type: application/json');

if (strstr($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')) 

{ 

		header("Content-Encoding: gzip"); 

}

function encode($output)

{    // We can perform additional manipulation on $output here, such    // as stripping whitespace, etc.    

	return gzencode($output,9);

}

ob_start();

ob_implicit_flush(0);

echo json_encode($return);

$json=ob_get_contents();

ob_end_clean();

if (strstr($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')) 

{  

	header("Content-Encoding: gzip");  

	$sale=encode($json);  

	echo $sale;

} else 

{  

	echo $json;

}

?>