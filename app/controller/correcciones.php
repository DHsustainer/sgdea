<?
session_start();
date_default_timezone_set('America/Bogota');
error_reporting(E_ALL);
ini_set('display_errors', '1');
	include_once('app/basePaths.inc.php');
	include_once(MODELS.DS.'GestionM.php');
	include_once(MODELS.DS.'Gestion_anexosM.php');
	include_once(MODELS.DS.'Super_adminM.php');
	include_once(MODELS.DS.'Gestion_suscriptoresM.php');
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
	$ob = new CCorrecciones;
	$c = new Consultas;
	$f = new Funciones;

	switch ($c->sql_quote($_REQUEST['action'])) {
		case 'unificarduplicados':
			$ob->UnificarSuscriptoresDuplicados();
			break;
		case 'recuperardocumentosborados':
			$ob->QuePaso();
			break;
		case 'ActualizarIdGestionAnexos':
			$ob->ActualizarIdGestionAnexos();
			break;
		case 'EliminarExpedientesDuplicados':
			$ob->EliminarExpedientesDuplicados();
			break;
		case 'EliminarDocumentosSinArchivos':
			$ob->EliminarDocumentosSinArchivos();
			break;
		case 'eliminarexpediente':
			$con->Query("update gestion set estado_archivo = '-99' where id = '".$c->sql_quote($_REQUEST['id'])."'");
			echo 'Expediente Elimiando';
			break;
		case 'leercarpetas':
			$ob->LeerCarpetas();
			break;	
		case 'eliminarbackups':
			$ob->EliminarBackups();
			break;		
	
		default:
			$ob->Listing();
			break;
	}
	// DEFINIENDO LA CLASE DEL CONTROLADOR DEL OBJETO QUE TIENE HERENCIA CON EL CONTROLADOR GENERICO PARA CARGAR LA INTERFAZ
	class CCorrecciones extends MainController{

		

		// DEFINIENDO LA FUNCION LISTAR 		
		function Listing(){

			// Included aws/aws-sdk-php via Composer's autoloader
			$link = HOMEDIR.DS.'correcciones/';

			echo '<h2>Listado de Correcciones</h2>
					<ul>
						<li>
							<a href="'.$link.'unificarduplicados/" target="_blank">
								Unificar Suscriptores Duplicados
							</a>
						</li>
						<li>
							<a href="'.$link.'recuperardocumentosborados/" target="_blank">
								Recuperar Documentos Eliminados
							</a>
						</li>
						<li>
							<a href="'.$link.'ActualizarIdGestionAnexos/" target="_blank">
								Actualizar Id_gestion de Events Gestion a Gestion Anexos
							</a>
						</li>
						<li>
							<a href="'.$link.'EliminarExpedientesDuplicados/" target="_blank">
								Eliminar Expedientes Duplicados</a>
						</li>
						<li>
							<a href="'.$link.'EliminarDocumentosSinArchivos/" target="_blank">
								Eliminar Registros de Documentos Sin URL
							</a>
						</li>
					</ul>';

			//include_once(PLUGINS.DS.'aws/aws-autoloader.php');
			//use Aws\S3\S3Client;

		}

		function UnificarSuscriptoresDuplicados(){

			global $con;
			global $f;
			global $c;

			$q = $con->Query("select count(*) as t, nombre, id, identificacion from suscriptores_contactos group by nombre order by t desc");

			echo '	<table border="1">
						<tr>
							<th>T</th>
							<th>id</th>
							<th>Nombre</th>
							<th>identificacion</th>
							<th>gestion_id</th>
							<th>IDO</th>
						</tr>';

			$gs = new MGestion_suscriptores;
			while ($row = $con->FetchAssoc($q)) {
				$nombre = trim($row['nombre']);
				if ($row['t'] > 1) {
					echo '	<tr>
								<td>'.$row['t'].'</td>
								<td>'.$row['id'].'</td>
								<td>'.$row['nombre'].'</td>
								<td>'.$row['identificacion'].'</td>
								<td></td>
								<td></td>
							</tr>';

					$str = "select * from suscriptores_contactos where nombre = '".$nombre."' and id != '".$row['id']."' ";
					$qr = $con->Query($str);

					while ($ron = $con->FetchAssoc($qr)) {

						$con->Query('update gestion set suscriptor_id = "'.$row['id'].'" where suscriptor_id = "'.$ron['id'].'"');

						$qgs = $con->Query('select * from gestion_suscriptores where id_suscriptor = "'.$ron['id'].'"');
						
						while ($roli = $con->FetchAssoc($qgs)) {
							# code...
							$qgo = $con->Query('select count(*) as t from gestion_suscriptores where id_suscriptor = "'.$row['id'].'" and id_gestion = "'.$roli['id_gestion'].'" ');
							$totalo = $con->FetchAssoc($qgo);

							if ($totalo['t'] == "0") {
								$gs->InsertGestion_suscriptores($roli['id_gestion'], $row['id'], $roli['usuario_id'], "1", "1", "");
							}
							echo '	<tr>
										<td></td>
										<td>'.$ron['id'].'</td>
										<td>'.$ron['nombre'].'</td>
										<td>'.$ron['identificacion'].'</td>
										<td>'.$roli['id_gestion'].'</td>
										<td>'.$totalo['t'].'</td>
									</tr>';
						}

						$con->Query('delete from gestion_suscriptores where id_suscriptor = "'.$ron['id'].'"');
						$con->Query('delete from suscriptores_contactos_direccion where id_contacto = "'.$ron['id'].'"');
						$con->Query('delete from suscriptores_contactos where id = "'.$ron['id'].'"');

					}
				}
			}
			echo '</table>';


		}

		function QuePaso(){
			global $con;

			$query = $con->Query('SELECT t1.id, t1.gestion_id, t1.description, t1.fecha, t1.time, t1.user_id, t1.id_ext FROM events_gestion as t1 LEFT JOIN gestion_anexos as t2 ON t2.id = t1.id_ext WHERE t2.id IS NULL and t1.gestion_id != "" and t1.title = "CARGA DE DOCUMENTO" ORDER BY t1.gestion_id DESC');

			$vector = array();
			while($row = $con->FetchAssoc($query)){

				$nom = explode('Se ha cargado un documento llamado: "' , $row['description']);
				$nom = substr($nom[1], 0, -1);
				array_push($vector, array($row['gestion_id'], $nom, $row['fecha'], $row['time'], $row['user_id'], $row['id_ext'], $row['id']) );
			}

			echo '<table border="1">
					</tr>
						<td>i</td>
						<td>id_gestion</td>
						<td>nombre_archivo</td>
						<td>fecha_hora</td>
						<td>archivo_encontrado</td>
					</tr>';
			for($i = 0; $i < count($vector); $i++){
				$interno = $vector[$i];

				$q = $con->Query("select * from gestion_anexos where id = '".$interno[5]."'");
				$r = $con->FetchAssoc($q);

				if ($r['id'] == "") {
					$path = ROOT.DS."archivos_uploads/gestion/".$interno[0]."/anexos";
					$dir = opendir($path);
				    // Leo todos los ficheros de la carpeta
				    $archivos = "";
				    while ($elemento = readdir($dir)){
				        // Tratamos los elementos . y .. que tienen todas las carpetas
				        if( $elemento != "." && $elemento != ".."){
				            // Si es una carpeta
				            if( is_dir($path.$elemento) ){
				                // Muestro la carpeta
				            // Si es un fichero
				            } else {
				                // Muestro el fichero
				                
				                $qbusc = $con->Query("select * from gestion_anexos where url = '$elemento' and gestion_id = '".$interno[0]."'");
				                $qrs = $con->FetchAssoc($qbusc);
				                if ($qrs['id'] == "") {

				                	$fecha = date("Y-m-d H:i:s", filectime($path."/".$elemento));
									$masuno = strtotime ( '+1 second' , strtotime ( $fecha ) ) ;
									$masuno = date ( 'Y-m-d H:i:s' , $masuno );

									$fecha = date("Y-m-d H:i:s", filectime($path."/".$elemento));
									$menosuno = strtotime ( '-1 second' , strtotime ( $fecha ) ) ;
									$menosuno = date ( 'Y-m-d H:i:s' , $menosuno );
				                	# PASO 1
				                	/*
				                	if($interno[2].' '.$interno[3] == date("Y-m-d H:i:s", filectime($path."/".$elemento))){
				                		//$archivos.= "<br>".$elemento." - ".date("Y-m-d H:i:s", filectime($path."/".$elemento));
				                		$archivos.= $elemento;
				                	}
				                	*/
				                	# PASO 2
				                	if($interno[2].' '.$interno[3] >= $menosuno && $interno[2].' '.$interno[3] <= $masuno){

				                		$extb = explode(".", $elemento);
						                $extb = end($extb);

						                $extr = explode(".", $interno[1]);
						                $extr = end($extr);
						                if ($extr == $extb) {
						                }
						                $archivos.= $elemento;
						                break;
				                	}
				                	#*/
				                	/*
				                	if ($interno[0] == "21094") {
				                		$archivos.= "5210491156ea47e89f7b6e88f38409c4.pdf";
				                	}
				                	if ($interno[0] == "17620") {
				                		$archivos.= "ee631c8d963bb5223c36c6846f684842.pdf";
				                	}
				                	*/
				                }
/*
						    	if (trim($archivos) == "") {
						    		$qbusc = $con->Query("select * from gestion_anexos_firmas where anexo_id =  '".$interno[5]."' order by id desc limit 0,1");
					                $qrs = $con->FetchAssoc($qbusc);
					                if ($qrs['id'] != "") {
					                	$fecha = date("Y-m-d H:i:s", filectime($path."/".$elemento));
										$masuno = strtotime ( '+10 second' , strtotime ( $fecha ) ) ;
										$masuno = date ( 'Y-m-d H:i:s' , $masuno );

										$fecha = date("Y-m-d H:i:s", filectime($path."/".$elemento));
										$menosuno = strtotime ( '-10 second' , strtotime ( $fecha ) ) ;
										$menosuno = date ( 'Y-m-d H:i:s' , $menosuno );

					                	if($qrs['fecha_firma'] >= $menosuno && $qrs['fecha_firma'] <= $masuno){
					                		//$archivos.= "<br>".$elemento." - ".$menosuno;
					                		$archivos.= $elemento;
					                	}
					                	//$archivos.= "<br>".$elemento." - ".date("Y-m-d H:i:s", filectime($path."/".$elemento));
					                	$interno[2] = $qrs['fecha_firma'];
					                	$interno[3] = "";
					                }
						    	}
						    	*/
				            }
				        }
				    }


				    if (strlen(trim($archivos)) == 36 || strlen(trim($archivos)) == 37) {
				    /*
					*/
				    	$con->Query("INSERT into gestion_anexos (id, timest, gestion_id, nombre, url, user_id, 	ip, fecha,hora,folio, 		 folder_id,	folio_final, is_publico, cantidad, orden, hash, base_file, typefile, peso, indice, hashx, soporte, checked, id_servicio) values ('$interno[5]', '".$interno[2].' '.$interno[3]."', '$interno[0]','".$interno[1]."','".$archivos."','$interno[4]', '$_SERVER[REMOTE_ADDR]', '".$interno[2]."', '".$interno[3]."', '1', '0', '0', '0', '0', '0', '','','application/PDF' ,'', '', '', '0', '0', '1')");
				    }

					echo '</tr>
							<td>'.$i.'</td>
							<td>'.$interno[0].' - '.$interno[5].'</td>
							<td>'.$interno[1].'</td>
							<td>'.$interno[2].' '.$interno[3].'</td>
							<td>'.$archivos.'</td>
						</tr>';
				}else{
					/*
					*/
					echo '</tr>
							<td style="background-color:#0F0">'.$i.'</td>
							<td style="background-color:#0F0">'.$interno[0].'</td>
							<td style="background-color:#0F0">'.$interno[1].'</td>
							<td style="background-color:#0F0">'.$interno[2].' '.$interno[3].'</td>
							<td style="background-color:#0F0"></td>
						</tr>';
				}
			}
			echo '</table>';

		}

		function ActualizarIdGestionAnexos(){
			global $con;
			global $c;
			global $f;

			$query = $con->Query("SELECT * FROM events_gestion where title = 'Carga de Documento'");

			echo "<table border='1'>
					<tr>
						<td>EG -> ID</td>
						<td>EG -> ID ANEXO</td>
						<td>EG -> ID GESTION</td>
						<td>G -> ID GESTION</td>
					</tr>";
			$i = 0;
			while ($row = $con->FetchAssoc($query)) {
				$style = "";

				$queryq = $con->Query("select gestion_id from gestion_anexos where id = '".$row['id_ext']."'");
				$rs = $con->FetchAssoc($queryq);

				if ($rs['gestion_id'] != $row['gestion_id']) {
					$i++;
				//	$style = 'style="background-color:#F00"';

				echo "<tr>
						<td $style >".$row['id']."</td>
						<td $style >".$row['id_ext']."</td>
						<td $style >".$row['gestion_id']."</td>
						<td $style >".$rs['gestion_id']."</td>
					</tr>";

					$con->Query("update gestion_anexos set gestion_id = '".$row['gestion_id']."' where id = '".$row['id_ext']."'");
				}

			}
			echo '</table>';
			echo "Elementos no relacionados: ".$i;

		}

		function EliminarExpedientesDuplicados(){
			global $con;
			global $c;
			global $f;

			$query = $con->Query("SELECT count(*) as t, radicado, ts FROM gestion where estado_archivo = '1' group by radicado ORDER BY t DESC");

			echo "<table border='1'>
					<tr>
						<td>T</td>
						<td>RADICADO</td>
						<td>TS</td>
					</tr>";
			$i = 0;
			$j = 0;
			while ($row = $con->FetchAssoc($query)) {

				$style = "";

				if ($row['t'] > 1) {
				
					echo "<tr>
							<td><b>".$row['t']."</b></td>
							<td><b>".$row['radicado']."</b></td>
							<td><b>".$row['ts']."</b></td>
						</tr>
						<tr>
							<td colspan='3'>
								<table border='1' style='font-size:9px' width='100%'>
									<tr>
										<td>ID</td>
										<td>RADICADO</td>
										<td>FECHA_REGISTRO</td>
										<td>NOMBRE_RADICA</td>
										<td>OBSERVACION</td>
										<td>TIPO_DOCUMENTO</td>
										<td>NOMBRE_DESTINO</td>
										<td>SUSCRIPTOR_ID</td>
										<td>USUARIO_REGISTRA</td>
										<td>TS</td>
										<td>ESTADO_ARCHIVO</td>
										<td>NUM_ARCHIVOS</td>
										<td></td>
									</tr>";


					$str = "SELECT * FROM gestion where radicado = '".$row['radicado']."' and estado_archivo = '1'";
					$ck = $con->Query($str);

					$observacion = array();
					while ($rs = $con->FetchAssoc($ck)) {
						
						$q = $con->Query("select count(*) as t from gestion_anexos where gestion_id = '".$rs['id']."'");
						$tga = $con->FetchAssoc($q);

						$tiene_archivos = $tga['t'];
						
						$style = "";
						$i++; 
						if (in_array($rs[strtolower("OBSERVACION")], $observacion)) {
							$style = 'style="background-color:#F00"';
							if ($tiene_archivos == "0") {
								$con->Query("UPDATE gestion set estado_archivo = '-99' where id = '".$rs['id']."'");
							}
						}

						echo "<tr>
								<td $style>".$rs[strtolower("ID")]."</td>
								<td $style>".$rs[strtolower("RADICADO")]."</td>
								<td $style>".$rs[strtolower("FECHA_REGISTRO")]."</td>
								<td $style>".$rs[strtolower("NOMBRE_RADICA")]."</td>
								<td $style>".$rs[strtolower("OBSERVACION")]."</td>
								<td $style>".$rs[strtolower("TIPO_DOCUMENTO")]."</td>
								<td $style>".$rs[strtolower("NOMBRE_DESTINO")]."</td>
								<td $style>".$rs[strtolower("SUSCRIPTOR_ID")]."</td>
								<td $style>".$rs[strtolower("USUARIO_REGISTRA")]."</td>
								<td $style>".$rs[strtolower("TS")]."</td>
								<td $style>".$rs[strtolower("ESTADO_ARCHIVO")]."</td>
								<td $style>".$tiene_archivos."</td>
								<td $style>
									<a href='/correcciones/eliminarexpediente/".$rs['id']."/' target='_blank'>eliminar</a>
								</td>
							</tr>";
						array_push($observacion, $rs[strtolower("OBSERVACION")]);
					}

					echo "				
								</table>
							</td>
						</tr>";
				}

			}

			echo '</table>';
			echo "Elementos Duplicados: ".$i."<br>";
			//echo "Elementos Duplicados No Eliminados: ".$j;


		}

		function EliminarDocumentosSinArchivos(){

		}

		function LeerCarpetas(){
			global $con;
			$listado = array('2858', '2861', '2862', '2863', '2864', '2865', '2866', '2868', '2870', '2871', '2873', '2874', '2875', '2876', '2877', '2879', '2880', '2883', '2884', '2885', '2886', '2887', '2888', '2889', '2890', '2891', '2892', '2893', '2894', '2895', '2896', '2897', '2898', '2899', '2900', '2901', '2902', '2903', '2907', '2910', '2911', '2912', '2915', '2917', '2924', '2928', '2929', '2930', '2931', '2932', '2933', '2935', '2938', '2940', '2941', '2942', '2943', '2944', '2949', '2999', '3000', '3001', '3002', '3003', '3004', '3005', '3006', '3007', '3008', '3009', '3012', '3013', '3014', '3016', '3017', '3019', '3020', '3021', '3022', '3032', '3033', '3034', '3038', '3039', '3040', '3041', '3052', '3054', '3063', '3065', '3073', '3074', '3084', '3085', '3086', '3088', '3089', '3090', '3091', '3095', '3096', '3097', '3098', '3102', '3103', '3105', '3106', '3107', '3108', '3110', '3111', '3112', '3113', '3114', '3115', '3116', '3117', '3118', '3119', '3120', '3123', '3124', '3125', '3127', '3128', '3130', '3131', '3132', '3133', '3143', '3144', '3145', '3149', '3150', '3151', '3152', '3163', '3165', '3174', '3176', '3184', '3185', '3195', '3196', '3197', '3199', '3200', '3201', '3202', '3206', '3207', '3208', '3209', '3213', '3214', '3216', '3217', '3218', '3219');

			for($i = 0; $i < count($listado); $i++){
				$g = new MGestion;
				$g->CreateGestion("id", $listado[$i]);
				echo "<h3>".$listado[$i]." -> ".$g->GetRadicado()."</h3>";
				$carpeta =  ROOT."/archivos_uploads/gestion/".$listado[$i]."/anexos/";
				echo $this->listarArchivos($carpeta);
				echo '<hr>';

			}


		}

		function listarArchivos( $path ){
		    // Abrimos la carpeta que nos pasan como parámetro
		    $dir = opendir($path);
		    // Leo todos los ficheros de la carpeta
		    while ($elemento = readdir($dir)){
		        // Tratamos los elementos . y .. que tienen todas las carpetas
		        if( $elemento != "." && $elemento != ".."){
		            // Si es una carpeta
		            if( is_dir($path.$elemento) ){
		                // Muestro la carpeta
		                echo "<p><strong>CARPETA: ". $elemento ."</strong></p>";
		            // Si es un fichero
		            } else {
		                // Muestro el fichero
		                echo "<br />". $elemento;
		            }
		        }
		    }
		}

		function EliminarBackups(){
			global $con;
			
			$q = $con->Query("select * from gestion");
			
			
			echo '	<table border="1">
						<tr>
							<td>#</td>
							<td>Id</td>
							<td>files</td>
						</tr>';
			$i = 0;
			$pesototal = "";
			while($row = $con->FetchAssoc($q)){
				$i++;
				$path = ROOT.DS."archivos_uploads/gestion/".$row['id'].'/backup/';
				$dir = @opendir($path);
				
				$files = "";
				while ($current = @readdir($dir)){
					if( $current != "." && $current != "..") {
						if ($path.$current != "") {
							$files .= $path.$current;
						#	unlink($path.$current);
							$pesototal += @filesize($path.$current);
						}
					}
				}
				echo '	<tr>
							<td>'.$i.'</td>
							<td>'.$row['id'].'</td>
							<td>'.$files.'</td>
						</tr>';
				#break;
			}
			echo '</table>';
			$pesototal = $pesototal / 1024;
			$pesototal = $pesototal / 1024;
			echo "Peso Total: ".$pesototal;
		}
		
	}
?>