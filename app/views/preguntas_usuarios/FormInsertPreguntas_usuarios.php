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
?>
		<div id="del-buscar">
		</div>
		<div id="del-right">
		</div>
	</div>
	<div id='content' class="app_container">
		
		<div id="contenido_bloque"> 
			<form id='formpreguntas_usuarios' action='/preguntas_usuarios/registrar/'  onsubmit="return CheckImportantes('formpreguntas_usuarios')" method='POST'> 
				<div class="title right">Registra tus Preguntas de Seguridad</div>
				<?= ($c->sql_quote($_GET['id']) == "error")?"<div class='da-message error'>El código de verificación ingresado es incorrecto intentelo nuevamente</div>":""; ?>
				<h5>Esta es tu primer vez creando firmas con nuestro sistema, por tu seguridad debes crear 3 preguntas de seguridad</h5>
				<table align="left" border="0">
					<tr>
						<td style="vertical-align: middle; font-weight: bold;" align="right">1 Pregunta de Seguridad</td>
						<td align="center" width="400px">
							<select id="pregunta1" name="pregunta1" class="input1 important" style="width:400px">
							<?
								$object = new MPreguntas_secretas;
								$query = $object->ListarPreguntas_secretas("where tipo = '1'");
								while ($row = $con->FetchAssoc($query)) {
									echo "<option value='".$row['id']."'>".$row['pregunta']."</option>";
								}
							?>								
							</select>
						</td>
					</tr>
					<tr>
						<td style="vertical-align: middle; font-weight: bold;" align="right">Tu Respuesta</td>
						<td align="left" width="400px">
							<input type='text' style="width:400px" class='input1 important form-control' placeholder='Tu 1 Respuesta' name='respuesta1' id='respuesta1' maxlength='200' />
						</td>
					</tr>
					<tr>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td style="vertical-align: middle; font-weight: bold;" align="right">2 Pregunta de Seguridad</td>
						<td align="center" width="400px">
							<select id="pregunta2" name="pregunta2" class="input1 important" style="width:400px">
							<?
								$object = new MPreguntas_secretas;
								$query = $object->ListarPreguntas_secretas("where tipo = '2'");
								while ($row = $con->FetchAssoc($query)) {
									echo "<option value='".$row['id']."'>".$row['pregunta']."</option>";
								}
							?>								
							</select>
						</td>
					</tr>
					<tr>
						<td style="vertical-align: middle; font-weight: bold;" align="right">Tu Respuesta</td>
						<td align="left" width="400px">
							<input type='text' style="width:400px" class='input1 important form-control' placeholder='Tu 2 Respuesta' name='respuesta2' id='respuesta2' maxlength='200' />
						</td>
					</tr>
					<tr>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td style="vertical-align: middle; font-weight: bold;" align="right">3 Pregunta de Seguridad</td>
						<td align="center" width="400px">
							<select id="pregunta3" name="pregunta3" class="input1 important" style="width:400px">
							<?
								$object = new MPreguntas_secretas;
								$query = $object->ListarPreguntas_secretas("where tipo = '3'");
								while ($row = $con->FetchAssoc($query)) {
									echo "<option value='".$row['id']."'>".$row['pregunta']."</option>";
								}
							?>								
							</select>
						</td>
					</tr>
					<tr>
						<td style="vertical-align: middle; font-weight: bold;" align="right">Tu Respuesta</td>
						<td align="left" width="400px">
							<input type='text' style="width:400px" class='input1 important form-control' placeholder='Tu 3 Respuesta' name='respuesta3' id='respuesta3' maxlength='200' />
						</td>
					</tr>
					<tr>
						<td style="vertical-align: middle; font-weight: bold;" align="right">Ingresa el<br>Código de Seguridad</td>
						<td align="center" width="400px">
							<img src="<?= HOMEDIR.DS ?>app/plugins/captcha/captcha.php" width="270" height="60" vspace="3"><br>
							<input type='text' style="width:400px" class='input1 important form-control' placeholder='Codigo de Seguridad' name='tmptxt' id='tmptxt' maxlength='200' />
						</td>
					</tr>

					<tr>
						<td colspan="2" align="right">
							<input type='submit' value='Continuar'  style='margin:10px;'/>
						</td>
					</tr>
				</table>
				
				
			</form>
			
        </div>
	</div>

	
</body>
</html>


