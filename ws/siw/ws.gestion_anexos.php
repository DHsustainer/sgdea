<?
include('headers.php');

    include_once(MODELS.DS.'UsuariosM.php');

	include_once(MODELS.DS.'GestionM.php');
	include_once(MODELS.DS.'Events_gestionM.php');
	include_once(MODELS.DS.'Gestion_anexosM.php');

	require_once(PLUGINS.DS.'tcpdf/tcpdf.php');
	require_once(PLUGINS.DS.'FPDI/fpdi.php');



	class Gestion_anexos{

		public function Upload($key, $archivo_nombre, $data_archivo, $id_externo, $id_anexo_externo) {
			
			global $con;
			global $c;
			global $f;

			try {

				$checkKey = $c->wscontrol($key);
				$output = array();

				if ($checkKey) {
			        $output['0'] = "logged";

			        #CODE STARTS HERE
			        $g = new MGestion;
			        $g->CreateGestion("id_servicio", $id_externo);

			        $id_gestion = $g->GetId();

#/*
					$ges = $con->FetchAssoc($con->Query("select * from gestion where id = '".$id_gestion."'"));
					$id_gestion = $ges['id'];

			        if($id_gestion <= 0){
			            return "El expediente no existe";
			            exit;
			        }
			        $us = $con->FetchAssoc($con->Query("select * from usuarios where user_id = '".$ges['user_id']."'"));

			        $filename=UPLOADS.DS.$id_gestion.'/';
			        if (!file_exists($filename)) {
			            mkdir(UPLOADS.DS . $id_gestion, 0777);
			        }
			        $filename=UPLOADS.DS.$id_gestion.'/anexos/';
			        if (!file_exists($filename)) {
			            mkdir(UPLOADS.DS . $id_gestion.'/anexos', 0777);
			        }

			        $rand = $c->GetIdRecursivoTabla("url","gestion_anexos",$ext);
			        $arrarch = explode(".", $archivo_nombre);
			        $ext = end($arrarch);
			        $fname = $rand.".".$ext;
			        
			        $fh = fopen(UPLOADS.DS . $id_gestion.'/anexos/'.$fname, 'w');
			        fwrite($fh, base64_decode($data_archivo));
			        fclose($fh);

			        $cantidad = 1;

					try {
						if (strtolower($ext) == "pdf") {

							$pdf = new FPDI(); 
						    $path_file2 = $url;
						    $path_file2 = $_SERVER["DOCUMENT_ROOT"]."app/archivos_uploads/gestion/".$id_gestion.trim("/anexos/ ").$fname;
						    $file = realpath($path_file2);
						    $cantidad = $pdf->setSourceFile($file);

						}

					} catch (Exception $e) {
						$cantidad = 2;
					}


			        $an = new MGestion_anexos;
			        $an->InsertGestion_anexos($id_gestion, $archivo_nombre, $fname, $row['user_id'], date("Y-m-d"), date("H:i:s"), $_SERVER['REMOTE_ADDR'], "", "1", $i, $i,$cantidad, $tipoarchi, "1", $id_anexo_externo);
			        $id_gestion_anexos = $c->GetMaxIdTabla("gestion_anexos", "id");
			        $c->SendContabilizadorDocumentos($cantidad, $ges['tipo_documento'], $ge['id'], "AN");
			        #$c->SendContabilizadorDocumentos($gestion_anexo->GetCantidad(), $gestion->GetTipo_documento(), $gestion->GetId(), "CE");    
			        $MEvents_gestion = new MEvents_gestion;
			        $title = "Nuevo Documento";
			        $description = "Se ha creado un nuevo documento llamado: \"".$archivo_nombre."\"";

     			   $MEvents_gestion->InsertEvents_gestion($row['user_id'], $id_gestion, date("Y-m-d"), $title, $description, date("Y-m-d"), 0, date("H:i:s"), 0, 0, 0, date("Y-m-d"), 0, $ges['oficina'], $ges['dependencia_destino'], $ges['dependencia_destino'], $us['a_i'], "dfis", $id_notificacion);

#*/

					$output['1'] = "1";
					$output['2'] = "Carga Exitosa!";
					$output['3'] = $id_gestion_anexos;

					return join(",", $output );
				}else{
					$output[0] = "invalid Key";
					return join(",", $output );
				}
				
			}catch(Exception $e){
				$output[0] = "some Exception $e";
				return join(",", $output );
			}

	    }



	}
	
	#ESTA FUNCION NOS GENERA EL ARCHIVO WSDL QUE ES EL ARCHIVO DE CONFIGURACION DEL SEBSER
    $server = new soap_server();
    $server->configureWSDL("siw.anexos", "urn:siw.anexos");

    $server->register("Gestion_anexos.Upload",
    			        array("key" => "xsd:string","archivo_nombre" => "xsd:string","data_archivo" => "xsd:string","id_externo" => "xsd:string","id_anexo_externo" => "xsd:string"),
				        array("return" => "xsd:string"),
				        "urn:Siw.Gestion_anexos",
				        "urn:Siw.Gestion_anexos#Upload",
				        "rpc",
				        "encoded",
				        "Servicio de prueba");

      
    $server->service($HTTP_RAW_POST_DATA);

?>