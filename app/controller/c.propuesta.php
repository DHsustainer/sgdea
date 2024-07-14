<?
	session_start();
	//Invocando archivos que seran usados en nuestro controlador generico	
	include_once('app/basePaths.inc.php');
	include_once(ROOT.DS.'DALC'.DS.'/mySql.php');
	include_once('consultas.php');
	include_once('funciones.php');	


	
	// Llamando al objeto a controlar		
	$ob = new CAc;
	$c = new Consultas;
	$f = new Funciones;


	#	$ob->send_email($_REQUEST['action']);
	
	echo "hola mundo";	
	
	// DEFINIENDO LA CLASE DEL CONTROLADOR DEL OBJETO QUE TIENE HERENCIA CON EL CONTROLADOR GENERICO PARA CARGAR LA INTERFAZ
	class CAc extends MainController{
		
		function send_email($email){
			$send_email_to = "sander.cadena@laws.com.co";
			$subject = "Confirmacion de Lectura de Mensaje";
			
			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
			$headers .= "From: ".$email. "\r\n";

			$message = "<strong>Email = </strong>".$email."<br>";  
			$message .= "<strong>Asunto = </strong>".$subject."<br>";     
			$message .= "<strong>Carpeta Ciudadana le informa que </strong>".$email." ha leido la propuesta enviada y visito nuestra web<br>";

			@mail($send_email_to, $subject, $message,$headers);
		}
	}
?>