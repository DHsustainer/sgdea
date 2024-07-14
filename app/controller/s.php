<?
session_start();
#error_reporting(E_ALL);
#ini_set('display_errors', '1');


	include_once('../basePaths.inc.php');
	include_once(ROOT.DS.'DALC'.DS.'/mySql.php');
	
	$con = new ConexionBaseDatos;
	$con->Connect($con);


/*



	*/
	echo "<h3>Escaneando Directorio ammensajes.org</h3>";
	
	function search_files( $carpeta , $blacklist, $separador = '&nbsp;', $exceptions, $modif_time, $whitelist){
		global $con;
	    if (is_dir($carpeta)) {
			# code...
			$folderCont = scandir($carpeta);

			foreach ($folderCont as $clave => $valor) {


				if ($valor!='.' && $valor!='..') {
					$ext = explode(".", $valor);

					if (!in_array(end($ext), $exceptions)) {
						if(is_dir($carpeta.'/'.$valor)){
							
							search_files($carpeta.'/'.$valor, $blacklist, $separador.$separador, $exceptions, $modif_time, $whitelist);
						}else{
							$date_file = date("Y-m-d H:i:s", filectime($carpeta.'/'.$folderCont[$clave]));
							$date_create = date("Y-m-d", filectime($carpeta.'/'.$folderCont[$clave]));
							
							$date_create = strtotime($date_create);
							$rmodif_time = strtotime($modif_time);

							$amenaza = false;
							$log = "";


							if (in_array($valor, $blacklist)) {
								$log = "NIVEL: AMENAZA MALWARE";
								$amenaza = true;
							}

							$link = "p.php?id=".base64_encode($carpeta.'/'.$folderCont[$clave]);
							if ($amenaza) {
								$oid = explode("/", $carpeta);
								echo $separador."Carpeta: ".$oid[8]." - &nbsp;&nbsp;".$valor." <br>";
								echo "update gestion_anexos set gestion_id = '".$oid['8']."' where url like '%".$valor."%' <hr>";
								#$con->Query("update gestion_anexos set gestion_id = '".$oid['8']."' where url like '%".$valor."%'");
							}
						}
					}
				}

			}

		}else{
			echo "El directorio no se encuentra o no existe";
		}
	}
	

	$str = "select * from gestion_anexos where gestion_id = '4890'";
	$q = $con->Query($str);

	$blacklist = array();
	while($row = $con->FetchAssoc($q)){
		array_push($blacklist, $row[url]);
		#echo "Name: $row[url] Actual: Id: $row[gestion_id]";
	}
	
	$modif_time = "2018-12-11";
	$whitelist = array("error_log");
	$exceptions =	array();



	search_files(ROOT.DS.'archivos_uploads', $blacklist, "&nbsp;", $exceptions, $modif_time, $whitelist);
	 
?>