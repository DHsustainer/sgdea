<?
session_start();
date_default_timezone_set('America/Bogota');
#error_reporting(E_ALL);
ini_set('display_errors', '0');
	//Invocando archivos que seran usados en nuestro controlador generico	
	include_once('../basePaths.inc.php');
	include_once("../models/Events_gestionM.php");
	include_once("../models/Usuarios_paquetesM.php");
	include_once("../models/Super_adminM.php");
	include_once("../models/UsuariosM.php");
	include_once("../DALC/mySql.php");
	include_once('../controller/consultas.php');
	include_once('../controller/funciones.php');	


	//Invocando archivos que seran usados en nuestro controlador generico	
	
	#include_once('../plugins/PHPMailer_5.2.4/class.phpmailer.php');	
	// Definiendo variables y conectandonos con la base de datos
	$con = new ConexionBaseDatos;
	$c = new Consultas;
	$f = new Funciones;
	$con->Connect($con);

	#print_r($_REQUEST);
	#echo "URL: "."https://sandbox.wompi.co/v1/transactions/". $_GET['id'];
	$cliente = curl_init();
	curl_setopt($cliente, CURLOPT_URL, "https://production.wompi.co/v1/transactions/". $_GET['id']);
	curl_setopt($cliente, CURLOPT_HEADER, 0);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); 

	#$contenido = ;
	$url = dirname(__FILE__)."/transactions/".$_GET['id'].".txt";
	#echo $url;
	$fp = fopen($url, "w");

	curl_setopt($cliente, CURLOPT_FILE, $fp);
	curl_setopt($cliente, CURLOPT_HEADER, 0);

	curl_exec($cliente);
	curl_close($cliente);
	fclose($fp);

	$fp = fopen($url, "r");
	while(!feof($fp)) {
		$linea = fgets($fp);
	}
	fclose($fp);


	$datos = json_decode($linea);
	
	#print_r($datos);
	#exit;

	

	$sql = "SELECT * FROM usuarios_compras where referente_pago ='".$datos->data->reference."' and username = '".$_SESSION['usuario']."' and estado = 'pendiente'";
	
	$listado = $con->Query($sql);
	if($con->NumRows($listado) > 0){

		$uc = $con->FetchAssoc($listado);

		$query = 'UPDATE usuarios_compras 
						set 
							medio_pago = "'.$datos->data->payment_method_type.'", 
							numeroTransaccion = "'.$datos->data->id.'", 
							estado = "Pagado",
							fecha_pago = "'.$datos->data->created_at.'",
							fechaActualizacion = "'.date("Y-m-d H:i:s").'",
							medio_pago_comprobante = "'.htmlspecialchars($linea).'"
								where referente_pago = "'.$datos->data->reference.'" and username = "'.$_SESSION['usuario'].'"';

		$upt = $con->Query($query);

		if ($datos->data->status == "APPROVED") {


			$u = new MUsuarios;
			$u->CreateUsuarios("user_id", $_SESSION['usuario']);

			if ($_SESSION['MODULES']['configuracion_pagos'] == "1"){
				
				$paq = new MUsuarios_paquetes;
				$paq->CreateUsuarios_paquetes("id", $uc['paquete_id']);
				
				$valor = $paq->GetExtra();
				$caducidad = date("Y-m-d");

				if ($u->GetF_caducidad() > $caducidad) {
					$caducidad = substr($u->GetF_caducidad(), 0, 10);
				}
				
				$fecha = $caducidad;
				$fecha_c = date_create($fecha);//aca le pasas la fecha actual o ala que le queres sumar los dias.
				date_modify($fecha_c, "+".$valor." day");//sumas los dias que te hacen falta.
				$fvencimiento = date_format($fecha_c, "Y-m-d");//retornas la fecha en el formato que mas te guste.

				$con->Query("update usuarios set f_caducidad = '".$fvencimiento."' where user_id = '".$_SESSION['usuario']."'");
				$observacion = 'El Usuario realizo una compra por un valor de '.$uc['total'].' su nueva fecha de corte es'.$fvencimiento;


			}else{
				
				if ($uc['paquete_id'] == "NA") {
					$valor = $uc['total'];
				}else{
					
					$paq = new MUsuarios_paquetes;
					$paq->CreateUsuarios_paquetes("id", $uc['paquete_id']);
					
					$valor = $paq->GetValor();
				}

				$cupo = $u->GetCupo();
				$cupo += $valor;

				$con->Query("update usuarios set cupo = '".$cupo."' where user_id = '".$_SESSION['usuario']."'");
				
				

				if ($_SESSION['MODULES']['tipo_negocio_correpondencia'] == "3") {
					
					$sadmin = new MSuper_admin;
	    			$sadmin->CreateSuper_admin("id", "6");

	    			$cupo = $valor + $sadmin->Getcupo_cuenta();

					$c->DescontarCupo($cupo, "cupo_cuenta", "add");

				}

				$observacion = 'El Usuario realizo una compra por un valor de '.$uc['total'].' su nuevo saldo es de '.$cupo;
				

			}

			$q_str = "INSERT INTO usuarios_seguimiento (usuario_seguimiento, username, observacion, fecha, tipo_seguimiento) VALUES ('".$u->GetUser_id()."', '".$u->GetUser_id()."', '$observacion', '".date("Y-m-d H:i:s")."', '2')";
			// EJECUTAMOS LA CONSULTA
			$query = $con->Query($q_str); 


			$MPlantillas_email = new MPlantillas_email;
			$MPlantillas_email->CreatePlantillas_email('id', '75');
			$contenido_email = $MPlantillas_email->GetContenido();

			$contenido_email = str_replace("[elemento]USUARIO[/elemento]", $u->GetP_nombre()." ".$u->GetP_apellido(),$contenido_email );
			$contenido_email = str_replace("[elemento]MENSAJE[/elemento]",$observacion,     	   $contenido_email );
			$contenido_email = str_replace("[elemento]PROJECTNAME[/elemento]",      PROJECTNAME,   $contenido_email );
			$contenido_email = str_replace("[elemento]LOGO[/elemento]",      '<img src="'.HOMEDIR.'/app/plugins/thumbnails/'.$c->getLogo().'" width="150px">',   $contenido_email );

			$c->fnEnviaEmailGlobal(CONTACTMAIL,PROJECTNAME,$MPlantillas_email->GetNombre(),$contenido_email,$u->GetUser_id());
			
		}

		if ($upt) {
			header("LOCATION: ".HOMEDIR."/gestion/correo/");
			#echo "<div class='alert alert-info' role='alert'>Su pago fue procesado exitosamente</div>";
		}else{
			echo '	<div class="row">
				<div class="col-md-12">
					<div class="white-box m-l-10 m-r-20 m-t-10">';

			echo '<div class="alert alert-warning" role="alert">No se pudo procesar su pago</div>';
			echo '<a href="https://siamm.co/a/index.php?uri=mispagos">Volver al Sistema</a>';
			echo '		</div>
					</div>	
				</div>';
		}
	}else{
		header("LOCATION: ".HOMEDIR."/gestion/correo/");
		/*echo '	<div class="row">
					<div class="col-md-12">
						<div class="white-box m-l-10 m-r-20 m-t-10">';
		echo "				<div class='alert alert-warning' role='alert'>El pago realizado no está referenciado al usuario con la sesión iniciada.</div>";
								'<a href="https://siamm.co/a/index.php?uri=mispagos">Volver al Sistema</a>';
			echo '		</div>
					</div>	
				</div>';*/
	}
	//curl_close($cliente);
?>