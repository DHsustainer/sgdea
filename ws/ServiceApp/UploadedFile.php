<?php
session_start();
#error_reporting(E_ALL);
#ini_set('display_errors', '1');
date_default_timezone_set("America/Bogota");
include_once('../../app/basePaths.inc.php');
$min_rad = "temporal";
$filename=UPLOADS.DS.$min_rad.'/';
if (!file_exists($filename)) {
    mkdir(UPLOADS.DS . $min_rad, 0777);
}
$target_path = $filename.basename( $_FILES['uploadedfile']['name']);
if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) {
    $datosreturno['mensaje'] = "Archivo ". $target_path . "subido correctamente";
    $datosreturno['continuar'] = 'S';
} else{
    $datosreturno['mensaje'] = "Error al subir el archivo";
    $datosreturno['continuar'] = 'N';
}
echo json_encode($datosreturno);

exit();

?>