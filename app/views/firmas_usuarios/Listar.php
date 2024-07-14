<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Reparto del Expediente</title>
    <!-- <link rel='stylesheet' type='text/css' href='http://assets.audiosjuridicos.com/styles/comunes.css'/>
    <link rel='stylesheet' type='text/css' href='http://assets.audiosjuridicos.com/styles/formularios.css'/> -->
    <link rel='stylesheet' type='text/css' href='<?=ASSETS?>/styles/del.mini.css'/>
    <script src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
	<link rel='stylesheet' href='https://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css' />
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css"> -->
    <script language='javascript' type='text/javascript' src='https://code.jquery.com/ui/1.10.3/jquery-ui.js'></script>

    <script language='javascript' type='text/javascript' src='<?=ASSETS?>/js/jscripts.js'></script>
	<link href="<?=ASSETS?>/images/favicon.png" rel='icon' type='image/x-icon'/>

	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!–[if lt IE 8]>
    <script src="https://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
    <![endif]–>

</head>
<body>
	<div id="header">
<?
	$me = new MUsuarios;
	$me->CreateUsuarios("user_id", $_SESSION["usuario"]);

	global $c;

 	$nombre_usuario = $me->GetP_nombre()." ".$me->GetP_apellido();

 	if ($_SESSION["suscriptor_id"] != "") {
 		
 		$sus = new MSuscriptores_contactos;
 		$sus->CreateSuscriptores_contactos("id", $_SESSION['suscriptor_id']);

 		$nombre_usuario = $sus->GetNombre();

 	}

	if ($_SESSION['folder'] == "") {
        $u = new MUsuarios;
        $u->CreateUsuarios("user_id", $_SESSION['usuario']);

        if ($u->GetId_empresa() != "0") {
	        $sadmin = new MSuper_admin;
	        $sadmin->CreateSuper_admin("id", $u->GetId_empresa());

	        if ($sadmin->GetFoto_perfil() == "") {
	          	echo '<div id="del-logo"></div>';
	        }else{
	        	#echo '<div id="del-logo"></div>';
	        	echo '<div id="del-logo" style="background: URL('.HOMEDIR.DS.'app/plugins/thumbnails/'.$sadmin->GetFoto_perfil().') no-repeat; background-size: 170px 80px; margin-top:0px; height:70px"></div>';
	        }
        	
        }else{
        	echo '<div id="del-logo"></div>';
        }
    }else{
        $u = new MUsuarios;
        $u->CreateUsuarios("user_id", $_SESSION['usuario']);

        $sadmin = new MSuper_admin;
        $sadmin->CreateSuper_admin("id", $u->GetId_empresa());

        if ($sadmin->GetFoto_perfil() == "") {
          	echo '<div id="del-logo" onClick="window.location.href=\''.HOMEDIR.DS.'dashboard/\'"></div>';
        }else{
        	echo '<div id="del-logo" onClick="window.location.href=\''.HOMEDIR.DS.'dashboard/\'" style="background: URL('.HOMEDIR.DS.'app/plugins/thumbnails/'.$sadmin->GetFoto_perfil().')  no-repeat;  background-size: 170px 80px; margin-top:0px; height:70px"></div>';
        }
    }


    $archivoloc = array("*" => "Todo el archivo", "1" => "Archivo de Gestión", "2" => "Archivo Central", "3" => "Archivo Histórico");


    $pathsearch = " and estado_archivo = '$p1' ";
    if ($p1 == "*") {
    	$pathsearch = "";
    }

    $u = $_SESSION['usuario'];
    $xp = explode("@", $u);
    $varxy = $xp[0];
    $varxy = str_split($varxy);
    $mail = "";
    for ($i=0; $i < count($varxy) ; $i++) { 
    	if ($i <= 1) {
    		$mail .= $varxy[$i];
    	}else{
    		$mail .= "*";
    	}
    }
    $mail .= "@".$xp[1];

?>
		<div id="del-buscar">
		</div>
		<div id="del-right">
		</div>
	</div>
	<div id='content' class="app_container">
		
		<div id="contenido_bloque"> 
			<div class="title right">Activación de Segunda Clave</div>
			<div style="width:600px; text-align: justify; margin-left: 50px; line-height: 25px;">
				<p >
					Estimado, <b><?= $nombre_usuario; ?></b>,
				</p>
				<p>
					Por su seguridad, en este momento se le ha enviado a su correo electrónico <b><?= $mail; ?></b> su segunda clave.
				</p>
				<p>
					Tenga en cuenta que esta clave estará disponible únicamente para ser utilizada en este dispositivo y estará activa durante los siguientes 60 minutos.
				</p>
				<p>
					En caso de no recibir el correo con su segunda clave, no olvide revisar su <b>carpeta de correo no deseado o SPAM</b>
				</p>

				<p>
					<h3>Puede Cerrar Esta Ventana</h3>
				</p>
			</div>
        </div>
	</div>

	
</body>
</html>


