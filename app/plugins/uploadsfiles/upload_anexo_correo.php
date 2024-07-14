<?php
include_once('../../../app/basePaths.inc.php');
#error_reporting(E_ALL);
#ini_set('display_errors', '1');

$uploads_dir = 'files/';


$tmp_name = $_FILES["userfile"]["tmp_name"];
$name = $_FILES["userfile"]["name"];
$newname = GenerarNuevoId($name);

	$exts = array("jpg","png","jpeg","gif","bmp");

	if (move_uploaded_file($tmp_name, "$uploads_dir/".$newname)) {
		
		$extt = explode(".", $newname);

		if (in_array(strtolower(end($extt)), $exts)) {
			echo "<img class='resizable' src='".dameURL().$newname."' >";
		}else{
			if (strtolower(end($extt)) == "mp3" || strtolower(end($extt)) == "wav") {
				echo '<br>'.$name.': <br><audio controls >
				  	<source src="'.dameURL().$newname.'">
				  	    <object type="application/x-shockwave-flash" data="player.swf?soundFile='.dameURL().$newname.'">
					        <param name="movie" value="player.swf?soundFile='.dameURL().$newname.'" />
					        <a href="'.dameURL().$newname.'">Descargar el archivo de audio</a>
					    </object>
					Tu navegador no soporta la reproduccion de audio
				</audio><br><br>&nbsp;';
			}else{
				echo "<a href='".dameURL().$newname."' target='_blank' >$name</a>";
			}
		}
	}else{
		echo "error";
	}

	function GenerarNuevoId($name){
		$nuevo_id = "";
		$ext = explode(".", $name);
		$ext = end($ext);

		for ($i=0; $i<32; $i++){
			$num = rand(0, 3);
			if($num %2){
				$nuevo_id .= strtoupper(substr(md5(uniqid(rand())),0,1));
			}else{
				$nuevo_id .= substr(md5(uniqid(rand())),0,1);
			}
		}
		return $nuevo_id.".".$ext;
	}

	function dameURL(){
		#$url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		$url = HOMEDIR.'/app/plugins/uploadsfiles/files/';
		return $url;
	}
?>