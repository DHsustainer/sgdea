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

	$_SESSION["intentos"] = 0;

	if (!isset($_SESSION["intentos"])) {

	}

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
			<form id='formpreguntas_usuarios' action='/preguntas_usuarios/validar/'  onsubmit="return CheckImportantes('formpreguntas_usuarios')" method='POST'> 
				<div class="title right">Registra tus Preguntas de Seguridad</div>
				<?
					if ($c->sql_quote($_GET['id']) != "") {
						$intentos = $_SESSION["intentos"] + 1;
						$_SESSION["intentos"] = $intentos;

						$tres = 3;
						$tres = $tres-$intentos;
						if (($c->sql_quote($_GET['id']) == "error")) {
							echo "<div class='da-message error'>El código de verificación ingresado es incorrecto intentelo nuevamente. (Intentos disponibles $tres)</div>";
						}elseif ($c->sql_quote($_GET['id']) == "errorv") {
							echo "<div class='da-message error'>Una o mas de sus respuestas se encuentra(n), por favor intentelo nuevamente. (Intentos disponibles $tres)</div>";
						}
					}else{
						$tres = 3;
					}

					if ($tres > 0) {
						# code...
					
				?>
				<h5>Por favor responde correctamente a las tres preguntas de seguridad, te recomendamos que cambies estas preguntas periodicamente haciendo clic <a href='/preguntas_usuarios/editar/'>aqui</a></h5>
				<table align="left" border="0">
				<?
					$i = 0;					
					while ($row = $con->FetchAssoc($query)) {
						$i++;
						$object = new MPreguntas_secretas;
						$object->CreatePreguntas_secretas("id", $row['id_pregunta']);

						echo "	<tr>
									<td width='400px' style='font-weight:bold'>
										".$object->GetPregunta()."<br>
										<input type='password' style='width:400px' class='input1 important form-control' placeholder='Tu ".$i." Respuesta' name='respuesta".$i."' id='respuesta".$i."' maxlength='200' />
									</td>
								</tr>";
					}
				?>
					<tr>
						<td align="center" width="400px">
							<b>Ingresa el Código de Seguridad</b>
							<img src="<?= HOMEDIR.DS ?>app/plugins/captcha/captcha.php" width="270" height="60" vspace="3"><br>
							<input type='text' style="width:400px" class='input1 important form-control' placeholder='Codigo de Seguridad' name='tmptxt' id='tmptxt' maxlength='200' />
						</td>
					</tr>

					<tr>
						<td align="right">
							<input type='submit' value='Continuar'  style='margin:10px;'/>
						</td>
					</tr>
				</table>
<?
				}else{

					echo "<br><br><br><div class='da-message warning'>Usted ha excedido el numero de intentos de validación de firma, este proceso quedará bloqueado durante 1 hora</div>";

				}
?>				
				
			</form>
			
        </div>
	</div>

	
</body>
</html>


