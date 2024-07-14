<?
include('headers.php');

    include_once(MODELS.DS.'UsuariosM.php');

	include_once(MODELS.DS.'GestionM.php');
	include_once(MODELS.DS.'DependenciasM.php');
	include_once(MODELS.DS.'Dependencias_tipologiasM.php');
	include_once(MODELS.DS.'Events_gestionM.php');
	include_once(MODELS.DS.'Gestion_anexosM.php');
	include_once(MODELS.DS.'Mailer_messageM.php');
	include_once(MODELS.DS.'Mailer_attachmentsM.php');
	include_once(MODELS.DS.'Mailer_from_messageM.php');
	include_once(MODELS.DS.'Mailer_loginsM.php');
	include_once(MODELS.DS.'Mailer_replysM.php');
	include_once(MODELS.DS.'Super_adminM.php');
	include_once(MODELS.DS.'Suscriptores_contactosM.php');
	include_once(MODELS.DS.'NotificacionesM.php');

	require_once(PLUGINS.DS.'tcpdf/tcpdf.php');
	require_once(PLUGINS.DS.'FPDI/fpdi.php');



	class Gestion_anexos{

		public function Upload($key, $archivo_nombre, $data_archivo, $radicado, $tipoarchi) {
			
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
			        $g->CreateGestion("min_rad", $radicado);
			        $id_gestion = $g->GetId();

			        $GetTipologia = $con->Query("select id from dependencias_tipologias where tipologia = '".$tipoarchi."' and id_dependencia = '".$g->GetTipo_documento()."'");

#			        return "select id from dependencias_tipologias where tipologia like '%".$tipoarchi."%' and id_dependencia = '".$g->GetTipo_documento()."'";

			        $tipologia = $con->Result($GetTipologia, 0, "id");


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

			        $rand = md5(date('Y-m-d').rand().$row['user_id']);
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
			        $an->InsertGestion_anexos($id_gestion, $archivo_nombre, $fname, $row['user_id'], date("Y-m-d"), date("H:i:s"), $_SERVER['REMOTE_ADDR'], "", "1", $i, $i,$cantidad, $tipologia, "1", "");
			        
			        $c->SendContabilizadorDocumentos($cantidad, $ges['tipo_documento'], $ge['id'], "AN");
			        #$c->SendContabilizadorDocumentos($gestion_anexo->GetCantidad(), $gestion->GetTipo_documento(), $gestion->GetId(), "CE");    
			        $MEvents_gestion = new MEvents_gestion;
			        $title = "Nuevo Documento";
			        $description = "Se ha creado un nuevo documento llamado: \"".$archivo_nombre."\"";

     			   $MEvents_gestion->InsertEvents_gestion($row['user_id'], $id_gestion, date("Y-m-d"), $title, $description, date("Y-m-d"), 0, date("H:i:s"), 0, 0, 0, date("Y-m-d"), 0, $ges['oficina'], $ges['dependencia_destino'], $ges['dependencia_destino'], $us['a_i'], "dfis", $id_notificacion);
/*
*/
					$output['1'] = "1";
					$output['2'] = "Carga Exitosa!";

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

	    public function GetListadoTipologias($key, $radicado = "0"){

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
			        $g->CreateGestion("min_rad", $radicado);

			        if ($g->GetId() != "") {
			        	# code...
				        $dep = new MDependencias;
				        $dep->CreateDependencias("id", $g->GetTipo_documento());

				        $tipo = new MDependencias_tipologias;


						$listado = $tipo->ListarDependencias_tipologias("WHERE id_dependencia = '".$dep->GetId()."'");

						$vector = "";
						while ($rl = $con->FetchAssoc($listado)) {
							$vector .= $rl['id']."::".$rl['tipologia'].";";
						}

						$output[1] = $vector;
					}else{
						$output[1] = "El numero de radicado consultado no existe";
					}

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
	
/*
$ca = new Gestion_anexos;
 	$archivo_nombre = "mi_archivo_nuevo.pdf";
    $archivo = "JVBERi0xLjQKJeLjz9MKMyAwIG9iago8PC9MZW5ndGggMTcwNC9GaWx0ZXIvRmxhdGVEZWNvZGU+PnN0cmVhbQp4nM1ayXLbNhi+6ykw00tysIKVFH2jJTqVK1GJlhzS9MBQjMKWIh1KSqcP2YfoA/TUFygWilpsgpRBzcT2GL9NAB//Bf8GfevczTvEApaNwHzZ8ead9x0MHsR/EYD8W/y2oQ3m686bewQQBPMvnVev57+Lufxv/p2vOr/+xqctD3/zaZaFwbpjYSappKTOx1A+saFVzBHU+RiKDdWUgjgdwj1gsidOh7Dz5fCKe64gCNfHfIq5vV6XkD2vtmAVyqecpVf+bh3lGVhG/GfzGIRfs1shBghWShQn+xZoQpR6RNuuRryPwq8B+At8zfKgVVxGFKusAng29EF/4s8mo+HAnbaBJtisQru5uWkI8Sef9FCsnL7dPyMId5WdrAtamcKs2fsRTGoUH2+56BPQT+Io3Uam0qeU6qXvQIgJtBEzBJKMOY6GsWz9OY9a501AVvHmjsHY82fugzcDs67bnXVfgtj+xHN7taxqHsbewBuN/vbBp1euPx9O3i+G7qfXLfgCAVqlq368WwZLkOXxKkrbcDw6w1iksQDjLieNVlkYt+NxdIjv3PcLb+5Nh24bRq8V5I4begDyaB1vWzN5i3VJbw/YOwVEDnYohI1gYNdBtsUAHzFithwZdcQ+sEu4/8PP+D+hTSqcnwWxpJKSOh9D9YSVc1jx7GhUwZQVwVYQp0O4B0z2xOkggu0P90qzBvGfGw7VmOg0WkebwNhcLD1KDzmEQscyPXCcGYKrYQbRZhun5ueaw0BUDTPKVv9yoDBoAQdp2PHSbR6tAhCl4C5bcsqUMSyyT60A4zwKw1ZgdIypFLAd0yMM67Wl3H60aQVIb32Pb7bGxidhsAbmQ5BkeSsoOhX90uX6CRJzxwD1QlMZQCswOqHN48cMDLKQVzupuY4kXI30PmSJADNWlGMr867K25DpYaVIaagKoO9Op97UBQz8BOgNxuDdZPrB84emFRS2bCXEKmDI3vAfDJFp2HCQHsifmCqph/UynPGU2vUHnqnMJBDWAPEqq1lOVoOh1Yvp6XGoXlp3C25z7tj135rmzYzUyGvqjb2ZMQqukZjpGaWWXmBcVAtvBN5O/I/uyPsI/KE/AfzLH85vQbpLEkN8m+p9kPEBkg4V1vnvWZR/j1uo26S+INTxMx27ox+uhpd5lTbKRcYBW4YD3YkhEFoY9ShzGiE1TYSZA6v5mnzecNUHXPXpC/O4l7ygbvPzDrFOZYxaXVzW0dZZiyD4tou25tkpJrYEIhU4xmmChfWM/NFOwogdqOXDOLohqueDp27fW0rdGL6qSoht61mRTjNaPwoTa/nUlCcAdll1A4dxZ6K6JYJKSup8bK1bomAK4nRo1C2RKnN0NV6QLzPzUpIn9RLmWimWyK21AIXbuWqIO3eDOrlKU81baQhIrJ4GaxqFwW75siyijZggWqCMsOpz2+c1qrqTyx6jnIe9/1JxSyZaW6ayYUQPrXoyG1OYHtPD7KOesTN3OA6txuEVv5duTVEoq0UZRN9Nm4GoxihUh/9dsAqWTfs/qrv+3O0iZuJGkVHI/XNBkye3i5rlPSqXC/de0AQ1X05Qr1xe0BctpwpdXMUX9CUvLwOCiFt8tU0Kujm4TUrJFfQl745gybkiL1ss5h/eXNLNVzPrgK3op+B6A8UaAy1uhECza+86CZGDhPAlplFqpNTOJcsPYilF9HR5jWdHGhm119ngEV5EOC2acYIJ4fUxSD2Gcc7P6mXV9CZTb7X4YLXocqvFR1Z7yfKDpZZWe9Fy7lXQkT9Ez/hDrXABtWllldPOZyNOchhAHfGKJx/eOgDeD6djF9wv/P5w4rvT4aRpolehG15b0CJcMBsW9BPxVIXZci0mTtVarWivwqpOtrYGcN7vN0So+AhddblIEZez0xNSxopKSup8DOUTRvZzBHU+hnJHNWdPnY9hiZqU1PkoLv5/3HdrUNOqDbGmTZBtgwS0k/lT25Fg1+p5yP3xlfdH1fsb332I/eEV90e2lE+Nsi+qv9SZfc69SdOS+bs6GYp+Eni0y+HRcnjZcltVDuJcKlqdlobeVYoK1YrqLsvWvAhPV21oBtbCqQZTG3rBR4LFzwi2KmZxn49VjSFab/iZEkMTP2y723OALtGac1luHrN8K8rYAPSFdMOYc97Pkmz9OQ5klgBm8WYbreUHhIfplyxfqzbIz1HO3RS4AQAsNrsgj7NbwPOLgTsezx4AOFwZ89B1y5xbanp3zBjpCu+u6WX8s4rTgE9dvqiddozVs3RAzXzb/482kGUKZW5kc3RyZWFtCmVuZG9iagoxIDAgb2JqCjw8L0dyb3VwPDwvVHlwZS9Hcm91cC9DUy9EZXZpY2VSR0IvUy9UcmFuc3BhcmVuY3k+Pi9QYXJlbnQgNCAwIFIvQ29udGVudHMgMyAwIFIvVHlwZS9QYWdlL1Jlc291cmNlczw8L1Byb2NTZXQgWy9QREYgL1RleHQgL0ltYWdlQiAvSW1hZ2VDIC9JbWFnZUldL0NvbG9yU3BhY2U8PC9DUy9EZXZpY2VSR0I+Pi9Gb250PDwvRjEgMiAwIFI+Pj4+L01lZGlhQm94WzAgMCA2MTIgNzA3XT4+CmVuZG9iago1IDAgb2JqClsxIDAgUi9YWVogMCA3MTcgMF0KZW5kb2JqCjIgMCBvYmoKPDwvQmFzZUZvbnQvSGVsdmV0aWNhL1R5cGUvRm9udC9FbmNvZGluZy9XaW5BbnNpRW5jb2RpbmcvU3VidHlwZS9UeXBlMT4+CmVuZG9iago0IDAgb2JqCjw8L0lUWFQoMi4xLjcpL1R5cGUvUGFnZXMvQ291bnQgMS9LaWRzWzEgMCBSXT4+CmVuZG9iago2IDAgb2JqCjw8L05hbWVzWyhKUl9QQUdFX0FOQ0hPUl8wXzEpIDUgMCBSXT4+CmVuZG9iago3IDAgb2JqCjw8L0Rlc3RzIDYgMCBSPj4KZW5kb2JqCjggMCBvYmoKPDwvTmFtZXMgNyAwIFIvVHlwZS9DYXRhbG9nL1ZpZXdlclByZWZlcmVuY2VzPDwvUHJpbnRTY2FsaW5nL0FwcERlZmF1bHQ+Pi9QYWdlcyA0IDAgUj4+CmVuZG9iago5IDAgb2JqCjw8L0NyZWF0b3IoSmFzcGVyUmVwb3J0cyBcKENvbnNvbGlkYWRvXCkpL1Byb2R1Y2VyKGlUZXh0IDIuMS43IGJ5IDFUM1hUKS9Nb2REYXRlKEQ6MjAxNjA1MDUxMDU5NDYtMDUnMDAnKS9DcmVhdGlvbkRhdGUoRDoyMDE2MDUwNTEwNTk0Ni0wNScwMCcpPj4KZW5kb2JqCnhyZWYKMCAxMAowMDAwMDAwMDAwIDY1NTM1IGYgCjAwMDAwMDE3ODcgMDAwMDAgbiAKMDAwMDAwMjA1NiAwMDAwMCBuIAowMDAwMDAwMDE1IDAwMDAwIG4gCjAwMDAwMDIxNDQgMDAwMDAgbiAKMDAwMDAwMjAyMSAwMDAwMCBuIAowMDAwMDAyMjA3IDAwMDAwIG4gCjAwMDAwMDIyNjEgMDAwMDAgbiAKMDAwMDAwMjI5MyAwMDAwMCBuIAowMDAwMDAyMzk2IDAwMDAwIG4gCnRyYWlsZXIKPDwvUm9vdCA4IDAgUi9JRCBbPDkxNjcyODYyNjUyMzc2MjMyZTU5MDVmOGU1YTA1NzliPjw3MWRmMDBlMjA4YWE1M2VkMGI2MmE3MjZkYmI5YzE0ZT5dL0luZm8gOSAwIFIvU2l6ZSAxMD4+CnN0YXJ0eHJlZgoyNTU3CiUlRU9GCg==";
    $radicado = "1-17";
    $tipologia = "levantamiento";
echo $ca->Upload('vk85xbo0sg7', $archivo_nombre, $archivo, $radicado, $tipologia);
*/
	#ESTA FUNCION NOS GENERA EL ARCHIVO WSDL QUE ES EL ARCHIVO DE CONFIGURACION DEL SEBSER
    $server = new soap_server();
    $server->configureWSDL("moduledigitalizacion", "urn:moduledigitalizacion");

    $server->register("Gestion_anexos.Upload",
    			        array("key" => "xsd:string","archivo_nombre" => "xsd:string","data_archivo" => "xsd:string","radicado" => "xsd:string","tipoarchi" => "xsd:string"),
				        array("return" => "xsd:string"),
				        "urn:Gestion_anexos",
				        "urn:Gestion_anexos#Upload",
				        "rpc",
				        "encoded",
				        "Servicio de prueba");


	$server->register("Gestion_anexos.GetListadoTipologias",
    			        array("key" => "xsd:string","radicado" => "xsd:string"),
				        array("return" => "xsd:string"),
				        "urn:Gestion_anexos", "urn:Gestion_anexos#GetListadoTipologias", "rpc", "encoded", "Servicio de prueba");


      
    $server->service($HTTP_RAW_POST_DATA);

?>