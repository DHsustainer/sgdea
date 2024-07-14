<?
session_start();
date_default_timezone_set('America/Bogota');
require_once('nusoap/nusoap2.php');

	if (!isset($_SESSION['VAR_SESSIONES'])) {


		$cliente = new nusoap_client("http://laws.com.co/ws/GetDetailSuscriptorKeys.wsdl", true);
        $error = $cliente->getError();

        if ($error) {
            echo "<h2>Constructor error</h2><pre>" . $error . "</pre>";
        }

        $array = array("id" => $_SERVER['HTTP_HOST'], "key" => $_SESSION['user_key']);
        $result = $cliente->call("GetDataSesion", $array);

        if ($cliente->fault) {
            echo "<h2>Fault</h2><pre>";
            echo "</pre>";
        }else{

            $error = $cliente->getError();
            if ($error) {

                echo "<h2>Error</h2><pre>" . $error . "</pre>";

            }else {

                if ($result == "") {
                    echo "No se creo el WS";
                }else{

                    $x  = explode("|,|", $result);
                    if ($x[0] != 'errno') {

	                    $_SESSION["pzhkCSC0XMwpGMT"] = desencriptar($x[0], $_SESSION['user_key']);
						$_SESSION["kYg8omRSc1EDj3u"] = desencriptar($x[1], $_SESSION['user_key']);
						$_SESSION["1oKU35BSbQ7CG5Q"] = desencriptar($x[2], $_SESSION['user_key']);
						$_SESSION["71c029wus3yJWEN"] = desencriptar($x[3], $_SESSION['user_key']);
						$elementos = explode(";", $x[4]);
						$permisos = array();
						for ($i=0; $i <  count($elementos) ; $i++) { 
							$val = explode(":", $elementos[$i]);
							$permisos[$val[0]] = $val[1];
						}
						$_SESSION['MODULES'] = $permisos;
						$_SESSION['VAR_SESSIONES'] = true;

					    $string = $x[5];
					    $elementos = explode("|", $string);
					    $vector = array();
					    for ($i=0; $i <  count($elementos) ; $i++) { 
					        $bloques = explode(";", $elementos[$i]);
					        $vector[$i] = $bloques;
					    }
					    $_SESSION['vector'] = $vector;
					    #DEFINIENDO LOS PARAMETROS PARA EL CORREO CERTIFICADO
					    $string = $x[6];					   
					    $elementos = explode("|", $string);
					    $_SESSION['variablessmtp'] = $elementos;

					    #DEFINIENDO PRA LAS EMPRESAS SIEMPRE Y CUANDO EL MODULO ESTE ACTIVADO
					    $string = $x[7];
					    $listempresas = array();
						if($string != ""){
						    $elementos = explode("|", $string);
						    for ($i=0; $i <  count($elementos) ; $i++){ 
						        $bloques = explode(";", $elementos[$i]);
						        $listempresas[$i] = $bloques;
						    }
						}
					    $_SESSION['listempresas'] = $listempresas;
                    }else{
                    	$_SESSION['VAR_SESSIONES'] = false;
                    }
                }
            }
        }
    }

	$retorno = array();
	if ($_SESSION['VAR_SESSIONES']) {

		//Invocando archivos que seran usados en nuestro controlador generico	
		include_once('../basePaths.inc.php');
		include_once("../models/Events_gestionM.php");
		include_once("../models/Usuarios_paquetesM.php");
		include_once("../models/Super_adminM.php");
		include_once("../models/UsuariosM.php");
		include_once("../DALC/mySql.php");
		include_once('../controller/consultas.php');
		include_once('../controller/funciones.php');	

		$id =  $_REQUEST["id"];
		$env = $_REQUEST["env"];

		$retorno['status'] = "success".$id;

		$con = new ConexionBaseDatos;
		$c = new Consultas;
		$f = new Funciones;
		$con->Connect($con);

		$retorno = array();

		$pasarela = array("test" => "sandbox", "prod" => "production");
		$pasarela = $pasarela[$env];

		
		$cliente = curl_init();
		curl_setopt($cliente, CURLOPT_URL, "https://production.wompi.co/v1/transactions/". $id);
		curl_setopt($cliente, CURLOPT_HEADER, 0);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); 

		#$contenido = ;
		$url = dirname(__FILE__)."/transactions/".$id.".txt";
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
		

		//$retorno["id"] = $id;
		
		$sql = "SELECT * FROM usuarios_compras where referente_pago ='".$datos->data->reference."' and estado = 'pendiente'";
		
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
									where referente_pago = "'.$datos->data->reference.'"';

			$upt = $con->Query($query);

			if ($datos->data->status == "APPROVED") {
				# code...
				$u = new MUsuarios;
				$u->CreateUsuarios("user_id", $uc['username']);

				
				$u = new MUsuarios;
				$u->CreateUsuarios("user_id", $uc['username']);

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

					$con->Query("update usuarios set f_caducidad = '".$fvencimiento."' where user_id = '".$uc['username']."'");
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

					$con->Query("update usuarios set cupo = '".$cupo."' where user_id = '".$uc['username']."'");
					
					

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

				$retorno['status'] =  "Saldo recargado";

			}else{
				$retorno['status'] =  "Transcción Rechazada REJECTED";
			}
		}else{
			$retorno['status'] =  "Transcción Rechazada EL CODIGO ".$datos->data->reference." NO ESTÁ REGISTRADO";
		}

	}else{
		$retorno['status'] =  "Transcción Rechazada NO SE PUDO ESTABLECER LA SESIÓN";
	}

	echo json_encode($retorno);
	//curl_close($cliente);
	function desencriptar($cadena, $key){

	    return str_replace("|", "", $cadena);
	}
?>