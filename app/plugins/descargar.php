<?php 

function validaFileDownload($path){

    $dir = opendir($path);

    $files = array();

    while ($current = readdir($dir)){

        if( $current != "." && $current != "..") {

            if(is_dir($path.$current)) {

                validaFileDownload($path.$current.'/');

            }

            else {

                $files[] = $current;

            }

        }

    }



    //var_dump($files);

    //echo '<br>';



    $f  = @$_GET["f"];

    $fn = @$_GET["tf"];

    $pathA = __DIR__."/../archivos_uploads/gestion/";



    $archivos = explode("/", $f);

    $file = end($archivos);

    

    $total = @count($archivos);

    

    $carpeta    = @$archivos[6];

    $subcarpeta = @$archivos[7];



    $arr = explode('.',$fn);

    $arrfile = explode('.',$file);

    if(end($arr) != end($arrfile)){        

        $fn = $fn.'.'.end($arrfile);

    }

    

    $ff = $pathA.$carpeta."/".$subcarpeta."/".$file;

    if(in_array($file, $files)){

        header("Content-type: application/octet-stream");

        header("Content-Disposition: attachment; filename=\"$fn\"\n");

        $fp=fopen("$ff", "r");

        fpassthru($fp); 

        fclose($fp);

    }



}



$idga  = $_GET["ga"];

$idg = $_GET["g"];

$dataFiles = validaFileDownload(__DIR__."/../archivos_uploads/gestion/".$idg."/anexos/");

/*

    $f = $_GET["f"];

    $fn = $_GET["tf"].".".$_GET["format"];

    header("Content-type: application/octet-stream");

    header("Content-Disposition: attachment; filename=\"$fn\"\n");

    $fp=fopen("$f", "r");

    fpassthru($fp);

*/

?>