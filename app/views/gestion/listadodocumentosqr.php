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

	if ($_SESSION['folder'] == "") {
        $u = new MUsuarios;
        $u->CreateUsuarios("user_id", $_SESSION['usuario']);

        if ($u->GetId_empresa() != "0") {
	        $sadmin = new MSuper_admin;
	        $sadmin->CreateSuper_admin("id", 6);

	        if ($sadmin->GetFoto_perfil() == "") {
	          	echo '<div id="del-logo"></div>';
	        }else{
	        	#echo '<div id="del-logo"></div>';
	        	echo '<div id="del-logo" style="background: URL('.HOMEDIR.DS.'app/plugins/thumbnails/'.$sadmin->GetFoto_perfil().') no-repeat; background-size: 170px 70px; margin-top:0px; height:70px"></div>';
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
        	echo '<div id="del-logo" onClick="window.location.href=\''.HOMEDIR.DS.'dashboard/\'" style="background: URL('.HOMEDIR.DS.'app/plugins/thumbnails/'.$sadmin->GetFoto_perfil().')  no-repeat; background-size: 170px; margin-top:13px; height:50px"></div>';
        }
    }

   
?>
		<div id="del-buscar">
		</div>
		<div id="del-right">
			<div id="del-user">
				<div id="del-user-info"></div>
			</div>
		</div>
	</div>
	<div id='content' class="app_container">
		<div id="contenido_bloque">
			<div class="titulolista">Listado de Documentos del QR</div>
				<ol>
				<?
					$qan = $con->Query("update consultas_varias set estado = '1' where id = '".$id."'");
					$qan = $con->Query("select * from consultas_varias where id = '".$id."'");
					$rowan2 = $con->FetchAssoc($qan);	
                                   
	            	$qan = $con->Query("select * from consultas_varias_anexo where id_consultas_varias = '".$id."'");

	                while ($rowan = $con->FetchAssoc($qan)) {

	                    $ga = new MGestion_anexos;
	                    $ga->CreateGestion_anexos("id", $rowan['id_anexo']);

	                    $ruta = HOMEDIR.DS."app/archivos_uploads/gestion/".$rowan2['gestion_id'].trim("/anexos/ ").$ga->GetUrl()."";

	                    
	                    echo "<li><a href='".HOMEDIR."/dashboard/descargar/".$ga->GetGestion_id()."/".$ga->GetUrl()."/".$ga->GetNombre()."/'>".$ga->GetNombre()."</a></li>";

	                }



				?>
				</ol>
		</div>
	</div>
	
</body>
</html>
<style>
	
	li{
		line-height: 32px;
	}

</style>