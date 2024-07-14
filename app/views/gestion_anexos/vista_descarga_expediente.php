<div class="row" style="margin:0px; padding:50px;background: #FFF">
	<div class="col-md-12">

<?
	if ($_SESSION['sadmin'] == "1") {
		# code...
		$g = new MGestion;
		$g->CreateGestion("id", $id);

		$carpeta = $_SERVER["DOCUMENT_ROOT"]."app/archivos_uploads/gestion/".$id.trim("/anexos/ ");
		$permitidos = array('pdf','jpg','png','doc', 'docx', 'xls', 'xlsx');

		$backupname=UPLOADS.DS.$id.'/zip/';
		if (!file_exists($backupname)) {
		    mkdir(UPLOADS.DS . $id.'/zip', 0777);
		}

		#$carpeta = ;
		$nombreArchivo = "Expediente_".$g->GetMin_rad()."_".date("Y-m-d_H:i:s").'.zip';
		$archivo_final = $_SERVER["DOCUMENT_ROOT"]."app/archivos_uploads/gestion/".$id.trim("/zip/ ").$nombreArchivo;

		$zip = new ZipArchive();
		if ($zip->open($archivo_final, ZIPARCHIVE::CREATE)==TRUE){
			if ($abrir = opendir($carpeta)) {
				while (false !== ($archivo = readdir($abrir))) {
					$extension = substr($archivo, strrpos($archivo, '.') + 1);
					$cons = "select id from gestion_anexos where gestion_id = '".$id."' and url = '".$archivo."'";
					$q = $con->Query($cons);

					$idg = $con->Result($q, 0, 'id');

					$ga = new MGestion_anexos;
					$ga->CreateGestion_anexos("id", $idg);

					if ($ga->GetId() > "0") {
						if ($ga->GetEstado() == "1") {
							if (in_array($extension, $permitidos)) {
								$zip->addFile($carpeta.$archivo,$ga->GetNombre());
							}
						}
					}
				}
				closedir($abrir);
			} else {echo ' no se ha podido abrir la carpeta';}
		} else {echo 'No se ha podido crear un archivo zip!';}
		$zip->close();
		echo '<div class="da-message success">Se ha Generado el archivo comprimido haga click <a href="'.HOMEDIR.'/app/archivos_uploads/gestion/'.$g->GetId().'/zip/'.$nombreArchivo.'">aqui</a> Para iniciar la descarga</div>';

		$object = new MGestion;
		$object->CreateGestion("id", $g->GetId());

		$objecte = new MEvents_gestion;

		// USANDO LA FUNCION DE INSERTAR DEL OBJETO PARA ENVIAR LA INFORMACION A LA BASE DE DATO

		/*  InsertEvents_gestion(	usuario_registra , 	gestion_id, 	fecha_evento, titulo, 	descripcion, 	fecha_creacion, estado(0 por defecto echo),  hora, 	$alerted = validar si alertado(0 = sin avisar, 1 = avisado), 	$avisar_a = dias para avisar, 	$type_event (ignorar), 	$fecha_vencimiento, $id_generico = si viene de alerta generica (0 =  ninguna), 	$seccional, 	$oficina, 	$area, 	$grupo = a que usuarios notificar (* = todos, B = Jefe de Area, B-X = Jefe de Area y x = otro usuario)) */

		$responsablea = $c->GetDataFromTable("usuarios", "user_id", $_SESSION['usuario'], "p_nombre, p_apellido", $separador = "");


		$objecte->InsertEvents_gestion($_SESSION['usuario'], $object->GetId(), date("Y-m-d"), "Se ha Descargado el Expediente", "El usuario ".$responsablea." ha descargado el expediente", date("Y-m-d"), 0, date("H:i:s"), 0, 0, 0, date("Y-m-d"), 0, $_SESSION['seccional'], $_SESSION['area_principal'], $_SESSION['area_principal'], "*", "dexpm", $g->GetId());


	}else{
?>
		<div class="da-message success">No tiene permisos para descargar expedientes</div>	
<?
	}


?>
	</div>	
</div>
