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
    

    $f  = @$_GET["f"];
    $fn = @$_GET["tf"].".".@$_GET["format"];
    if(in_array($f, $files)){
        header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename=\"$fn\"\n");
        $fp=fopen($f, "r");
        fpassthru($fp); 
        fclose($fp);
    }

}

$dataFiles = validaFileDownload(__DIR__."/../archivos_uploads/gestion/");

?>