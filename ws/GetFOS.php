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

    function GetFOS($var) {

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
			$str = $f->GetFOS($var);
			
			$sfile= ROOT."/plugins/facturasXML/ws_cos114322419900000000001.xml";			
			$fp = fopen($sfile,"w");
			fwrite($fp,$str);
			fclose($fp);

			return array('respuesta' => '1', 'mensaje' => "Archivo XML Generado Correctamente $sfile");
		}
		
    }
    $var = array(
    	"UBLVersionID" => "UBL 2.0", 	"ProfileID" => "DIAN 1.0", 	"ID" => "45910281428", 	"UUID" => "ae0869bcc9044db987aecbe976187fd3ba0937c", 
		"IssueDate" => "2015-07-20", 	"IssueTime" => "00:00:00", 	"InvoiceTypeCode" => "1", 		
		"Note" => "Set de pruebas =  fos0001_700085371_f7999_R469910-459-27223_0C_700085371  2015-07-20 -- número factura fuera de rango&#13;
					NumFac: 45910281428&#13;
					FecFac: 20150720000000&#13;
					ValFac: 97128.00&#13;
					CodImp1: 01&#13;
					ValImp1: 15540.48&#13;
					CodImp2: 02&#13;
					ValImp2: 0.00&#13;
					CodImp3: 03&#13;
					ValImp3: 4021.09&#13;
					ValImp: 116689.57&#13;
					NitOFE: 700085371&#13;
					TipAdq: 22&#13;
					NumAdq: 11222333&#13;
					String: 459102814282015072000000097128.000115540.48020.00034021.09116689.577000853712211222333693ff6f2a553c3646a063436fd4dd9ded0311471&#13;",
		"DocumentCurrencyCode" => "COP", "AdditionalAccountID" => "1", 	"ID2" => "700085371", 	"Name" => "PJ - 700085371 - Adquiriente FE", 
		"Department" => "Bolivar", "CitySubdivisionName" => "Centro", 	"CityName" => "Pasa Caballos", 		"Line" => "	carrera 8 Nº 6C - 60", 
		"IdentificationCode" => "CO", 	"TaxLevelCode" => "0", 	"RegistrationName" => "PJ - 700085371", 	"AdditionalAccountID2" => "2", 
		"ID3" => "11222333", 			"Department2" => "Huila", "CitySubdivisionName2" => "Centro", 	"CityName2" => "Aipe", 
		"Line2" => "	carrera 8 Nº 6C - 40", 	"IdentificationCode2" => "CO", 	"TaxLevelCode2" => "0", 	"FirstName" => "Primer-N", 	
		"FamilyName" => "Apellido-11222333", 	"MiddleName" => "Segundo-N", 	"TaxAmount" => "15540.48", 		"TaxEvidenceIndicator" => "FALSE", 
		"TaxableAmount" => "97128", 	"TaxAmount2" => "15540.48", 		"Percent" => "16", 		"ID4" => "01", 	"TaxAmount3" => "4021.09", 
		"TaxEvidenceIndicator2" => "FALSE", 	"TaxableAmount2" => "97128", 		"TaxAmount4" => "4021.09", 		"Percent2" => "4.14", 
		"ID5" => "03", 	"LineExtensionAmount" => "97128", 		"TaxExclusiveAmount" => "19561.57", 	"PayableAmount" => "116689.57", 
		"ID6" => "01", 	"InvoicedQuantity" => "456", 	"LineExtensionAmount2" => "97128", 	"Description" => "Línea-1 45910281428 fos0001_700085371_f7999_R469910-459-27223", 
		"PriceAmount" => "213"
		);
    print_r(GetFOS($var));

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