<?php
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

    include_once('../app/basePaths.inc.php');
    include_once(ROOT.DS.'DALC'.DS.'/mySql.php');
    include_once('../app/controller/consultas.php');
    include_once('../app/controller/funciones.php');

    
    $con = new ConexionBaseDatos;
    $con->Connect($con);

    $c = new Consultas;
    $f = new Funciones;

    function GetCOS($var) {

        global $con;
        global $c;
        global $f;

        $emptyfields = array();
        $validationdata = true;

		foreach ($var as $key => $value) {
            $response = $f->ValidarXMLField(trim($key), trim($value));
            if ($response['respuesta'] == "0") {
            	array_push($emptyfields, $response['mensaje']);
           		$validationdata = false;
           		break;
            }
        }


		if(!$validationdata){
			return array('respuesta' => '1', 'mensaje' => $emptyfields);
		}else{
			$str = $f->GetCOS($var);
			
			$sfile= ROOT."/plugins/facturasXML/ws_cos114322419900000000001.xml";			
			$fp = fopen($sfile,"w");
			fwrite($fp,$str);
			fclose($fp);

			return array('respuesta' => '1', 'mensaje' => "Archivo XML Generado Correctamente $sfile");
		}
		
    }
    $var = array(
    	'UBLVersionID' => "UBL 2.0", 		'ProfileID' => "DIAN 1.0", 'ID' => "0001", 'UUID' => "ed296ca29ce9e886b2b6b3f2d6ea189eca1ebba1", 				
		'IssueDate' => "2016-07-01",		'IssueTime' => "15:03:00", 
		'Note' => "Nota Crédito 1021 de la factura 45910281427&#13;
		NumFac: 1021&#13;
		FecFac: 20150716000252&#13;
		ValFac: 149212.50&#13;
		CodImp1: 01&#13;
		ValImp1: 0.00&#13;
		CodImp2: 02&#13;
		ValImp2: 0.00&#13;
		CodImp3: 03&#13;
		ValImp3: 0.00&#13;
		ValImp: 149212.5&#13;
		NitOFE: 700085371&#13;
		TipAdq: 22&#13;
		NumAdq: 8355990&#13;
		String: 102120150716000252149212.50010.00020.00030.00149212.50700085371228355990&#13;",					
		'DocumentCurrencyCode' => "COP",	'ResponseCode' => "4", 
		'AdditionalAccountID' => "1",		'ID2' => "700085371", 				'Name' => "PJ - 700085371 - Adquiriente FE", 
		'Department' => "Bolivar",			'CitySubdivisionName' => "Centro", 	'CityName' => "Pasa Caballos", 
		'Line' => "carrera 8 Nº 6C - 60", 	'IdentificationCode' => "CO", 	'TaxLevelCode' => "0", 
		'RegistrationName' => "PJ - 700085371",		'AdditionalAccountID2' => "2",	'ID3' => "8355990", 
		'Department2' => "Tolima",			'CitySubdivisionName2' => "Centro",	'CityName2' => "Guamo", 
		'Line2' => "carrera 8 Nº 6C - 39",				'IdentificationCode2' => "CO",	'TaxLevelCode2' => "0", 
		'FirstName' => "SANDER",			'FamilyName' => "CADENA",			'MiddleName' => "DAVID", 
		'currency' => "COP",				'LineExtensionAmount' => "149212.5",	'TaxExclusiveAmount' => "0", 
		'PayableAmount' => "149212",		'ID4' => "A1", 				'Note2' => "Línea-1 45910281427 fos0001_700085371_f7999_R469910-459-27223", 
		'CreditedQuantity' => "34.5", 	'LineExtensionAmount' => "149212.5",	'AccountingCostCode' => "2815050102-0001", 
		'Description' => "Línea-1 45910281427 fos0001_700085371_f7999_R469910-459-27223",			'PriceAmount' => "4325");
    print_r(GetCOS($var));

    function desencriptar($cadena, $key){
        $decrypted = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode($cadena), MCRYPT_MODE_CBC, md5(md5($key))), "\0");
        return $decrypted;  //Devuelve el string desencriptado
    }
      
    #ESTA FUNCION NOS GENERA EL ARCHIVO WSDL QUE ES EL ARCHIVO DE CONFIGURACION DEL SEBSER
    $server = new soap_server();
    $server->configureWSDL("CrearExpedienteExterno", "urn:CrearExpedienteExterno");
    $server->register("GetCrearExpedienteExterno",
        array("cedula" => "xsd:string","nit_suscriptor" => "xsd:string","nombre_suscriptor" => "xsd:string","tipo_suscriptor" => "xsd:string","Direccion_suscriptor" => "xsd:string","Telefonos_suscriptor" => "xsd:string","Email_suscriptor" => "xsd:string","radicado" => "xsd:string","dependencia_destino" => "xsd:string","observacion" => "xsd:string","archivo" => "xsd:string","archivo_nombre" => "xsd:string","como_enviar_expediente" => "xsd:string"),
        array("return" => "xsd:string"),
        "urn:CrearExpedienteExterno",
        "urn:CrearExpedienteExterno#GetCrearExpedienteExterno",
        "rpc",
        "encoded",
        "Registra un expediente");
      
    $server->service($HTTP_RAW_POST_DATA);
?>