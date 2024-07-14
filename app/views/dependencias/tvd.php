<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>

<html xmlns='http://www.w3.org/1999/xhtml'>

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <title>Tabla de Retención documental</title>

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

	        	echo '<div id="del-logo" style="background: URL('.HOMEDIR.DS.'app/plugins/thumbnails/'.$sadmin->GetFoto_perfil().') no-repeat; background-size: 170px 50px; margin-top:13px; height:50px"></div>';

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



	$d = new MDependencias();
	$d->CreateDependencias("id", $g -> Gettipo_documento());

	$dr = new MDependencias();
	$dr->CreateDependencias("id", $g -> GetId_dependencia_raiz());





?>





		<div id="del-buscar">

			<h4 style="margin-top: -13px; margin-bottom: 0px;">Proceso: Gestión Documental</h4>

			<h3 style="margin-top: 8px; margin-bottom: 0px;">Tabla de Valoración Documental</h3>

		</div>

		<div id="del-right">

			<div id="del-user">

				<div id="del-user-info">

					<?

						#echo $nombre_usuario

					    if ($_SESSION["usuario"] != ""){



							$cit = new MCity;

							$cit->CreateCity("code", $_SESSION['ciudad']);



							$area = new MAreas;

							$area->CreateAreas("id", $_SESSION['area_principal']);



							$of = new MSeccional;

							$of->CreateSeccional("id", $_SESSION['seccional']);



							echo $cit->GetName().", <br><b>".$of->GetNombre()." (".$area->GetNombre().")</b>";



						}

					?>

				</div>

			</div>

		</div>

	</div>
	<div id='content' class="app_container" style="background:#FFF; padding-top:20px;">
		<table border="0" cellspacing="0" cellpadding="3" width="100%" class="tabla" id="tablat">
			<tr>
				<td style="width:220px; text-align: left" class="th_act_inner">OFICINA PRODUCTORA / CÓDIGO :</td>
				<td style="font-size: 11px; vertical-align:middle; border-right:1px solid #ccc; border-bottom:1px solid #ccc; border-top:1px solid #ccc"><?= $areap->GetNombre(); ?> / <?= $areap->GetPrefijo() ?></td>
			</tr>
			<tr>
				<td style="width:220px; text-align: left" class="th_act_inner">SERIE DOCUMENTAL / CÓDIGO :</td>
				<td style="font-size: 11px; vertical-align:middle; border-right:1px solid #ccc; border-bottom:1px solid #ccc"><?= $dr->GetNombre(); ?> / <?= $dr->GetId_c() ?></td>
			</tr>
			<tr>
				<td style="width:220px; text-align: left" class="th_act_inner">SUBSERIE DOCUMENTAL / CÓDIGO :</td>
				<td style="font-size: 11px; vertical-align:middle; border-right:1px solid #ccc; border-bottom:1px solid #ccc"><?= $d->GetNombre(); ?> / <?= $d->GetId_c() ?></td>
			</tr>
		</table>
		
		<table border="0" cellspacing="0" cellpadding="3" width="100%" class="tabla" id="tablat">
			<thead>
				<tr>
					<th width="200px" class="th_act_inner" style="padding-left:5px; font-size: 11px; border-right:1px solid  #fff;" rowspan="2">TIPO DOCUMENTAL</th>
					<th width="160px" class="th_act_inner" style="padding-left:5px; font-size: 11px; border-right:1px solid  #fff;" rowspan="2" >Tiempo de Conservacion / Gestion</th>
					<th class="th_act_inner" style="padding-left:5px; font-size: 11px; border-right:1px solid  #fff;" colspan="2">Soporte</th>
					<th class="th_act_inner" style="padding-left:5px; font-size: 11px; border-right:1px solid  #fff;" colspan="3">Disposición</th>
					<th class="th_act_inner" style="padding-left:5px; font-size: 11px; border-right:1px solid  #fff;" colspan="2">Propiedades</th>
					<th width="70px" class="th_act_inner" style="padding-left:5px; font-size: 11px;border-right:1px solid  #fff;" rowspan="2">Formato</th>
					<th class="th_act_inner last" style="padding-left:5px; font-size: 11px;" rowspan="2">Procedimiento</th>
				</tr>
				<tr>

					<th class="th_act_inner" width="25px" style="padding-left:5px; font-size: 11px;border-right:1px solid  #fff;; border-top:1px solid #FFF">SP</th>
					<th class="th_act_inner" width="25px" style="padding-left:5px; font-size: 11px;border-right:1px solid  #fff;; border-top:1px solid #FFF">SE</th>

					<th class="th_act_inner" width="25px" style="padding-left:5px; font-size: 11px;border-right:1px solid  #fff; border-top:1px solid #FFF">CT</th>
					<th class="th_act_inner" width="25px" style="padding-left:5px; font-size: 11px;border-right:1px solid  #fff; border-top:1px solid #FFF">E</th>
					<th class="th_act_inner" width="25px" style="padding-left:5px; font-size: 11px;border-right:1px solid  #fff; border-top:1px solid #FFF">P</th>

					<th class="th_act_inner" width="25px" style="padding-left:5px; font-size: 11px;border-right:1px solid  #fff;; border-top:1px solid #FFF">DP</th>
					<th class="th_act_inner" width="25px" style="padding-left:5px; font-size: 11px;border-right:1px solid  #fff;; border-top:1px solid #FFF">DO</th>
				</tr>
			</thead>
			<tbody>
			<?

				$queryN = $con->Query("SELECT * from dependencias where id = '".$d->GetId()."' ORDER BY nombre ASC ");	    

				while ($rown = $con->FetchAssoc($queryN)) {

					$d = new MDependencias;
					$d->CreateDependencias("id", $rown['dependencia']);

					$ss = new MDependencias;
					$ss->CreateDependencias("id", $rown['id']);


					global $f;

					$fecha = date("Y-m-d H:i:s");
					$fecha_c = date_create($fecha);//aca le pasas la fecha actual o ala que le queres sumar los dias.
					$mes = $ss->GetT_g();
					date_modify($fecha_c, $mes." day");//sumas los dias que te hacen falta.
					$fecha_tg = date_format($fecha_c, "Y-m-d");//retornas la fecha en el formato que mas te guste.


					$countertip = $con->Query("select * from dependencias_tipologias where id_dependencia = '".$ss->GetId()."' and estado = '1'");


					$totrow = $con->NumRows($countertip);
					$counter = 0;

					while ($riowt = $con->FetchAssoc($countertip)) {
						$counter++;

						$borderbotom = "border-bottom:1px solid #ccc;";
						if ($counter == $totrow) {
							$borderbotom = "";
						}

						$fecha = date("Y-m-d");
						
						$fecha_c = date_create($fecha);//aca le pasas la fecha actual o ala que le queres sumar los dias.
						$mes = $riowt['dias_vencimiento'];
						date_modify($fecha_c, $mes." day");//sumas los dias que te hacen falta.
						$vencimientotip = date_format($fecha_c, "Y-m-d");//retornas la fecha en el formato que mas te guste.
						
						$vencimiento = "-";
						if ($mes > 0) {
							$vencimiento = $f->nicetime2($vencimientotip);
						}

						$soportea = "&nbsp;";
						$soporteb = "&nbsp;";

						if ($riowt['soporte'] == 0) {
							$soportea = "X";
						}elseif($riowt['soporte'] == 1){
							$soporteb = "X";
						}else{
							$soportea = "X";
							$soporteb = "X";
						}

						$dpa = "&nbsp;";
						$dpb = "&nbsp;";
						$dpc = "&nbsp;";

						if ($riowt['prioridad'] == "Conservacion" || $riowt['prioridad'] == "Conservaci" ) {
							$dpa = "X";
						}elseif($riowt['prioridad'] == "Eliminacion" || $riowt['prioridad'] == "Eliminacio" ){
							$dpb = "X";
						}elseif($riowt['prioridad'] == "Preservacion" || $riowt['prioridad'] == "Preservaci"  ){
							$dpc = "X";
						}else{
							$dpb = "X";
						}

						$dp = "-";
						$do = "-";
						if ($riowt['es_publico'] == "1") {
							$dp = "X";
						}
						if ($riowt['es_obligatorio'] == "1") {
							$dp = "X";
						}

						$formato = "-";


						$formato = ($riowt['formato'] != "")?"<a href='".HOMEDIR.DS."app/plugins/uploadsfiles/".$riowt['formato']."' target='_blank'>Ver Formato</a>":"-";


					echo 
						'
						<tr>
							<td width="300px" style="vertical-align:middle; font-size: 11px; border-left:1px solid #ccc; border-bottom:1px solid #ccc">'.$riowt['tipologia'].'</td>
							<td width="50px" align="center" style="font-size: 11px; vertical-align:middle; border-left:1px solid #ccc; border-bottom:1px solid #ccc">'.$vencimiento.'</td>

							<td width="15px" style="vertical-align:middle; font-size: 11px; padding:0px !important; border-left:1px solid #ccc; border-bottom:1px solid #ccc " align="center">'.$soportea.'</td>
							<td width="15px" style="vertical-align:middle; font-size: 11px; padding:0px !important; border-left:1px solid #ccc; border-bottom:1px solid #ccc" align="center">'.$soporteb.'</td>
							
							<td width="15px" align="center" style="font-size: 11px; vertical-align:middle; border-left:1px solid #ccc; border-bottom:1px solid #ccc">'.$dpa.'</td>
							<td width="15px" align="center" style="font-size: 11px; vertical-align:middle; border-left:1px solid #ccc; border-bottom:1px solid #ccc">'.$dpb.'</td>
							<td width="15px" align="center" style="font-size: 11px; vertical-align:middle; border-left:1px solid #ccc; border-bottom:1px solid #ccc">'.$dpc.'</td>

							<td width="15px" style="vertical-align:middle; font-size: 11px; padding:0px !important; border-left:1px solid #ccc; border-bottom:1px solid #ccc " align="center">'.$dp.'</td>
							<td width="15px" style="vertical-align:middle; font-size: 11px; padding:0px !important; border-left:1px solid #ccc; border-bottom:1px solid #ccc" align="center">'.$do.'</td>

							<td style="font-size: 11px; vertical-align:middle; border-left:1px solid #ccc; border-bottom:1px solid #ccc; border-right:1px solid #CCC">'.$formato.'</td>

							<td style="font-size: 11px; vertical-align:middle; border-left:1px solid #ccc; border-bottom:1px solid #ccc; border-right:1px solid #CCC">'.$riowt['observacion'].'</td>
						</tr>
						';

					}

				}
			?>
				
			</tbody>

		</table>


		<table border="0" style="border:1px solid #ccc;">

			<tbody><tr>

				<td class="impar" colspan="4"><b>CONVENCIONES:</b></td>

			</tr>

			<tr>

				<td class="impar"><b>CT</b></td>

				<td class="impar">= Conservación Total</td>

				<td class="impar">SP</td>

				<td class="impar">= Soporte en Papel</td>

			</tr>

			<tr>

				<td class="impar"><b>E</b></td>

				<td class="impar">= Eliminación</td>

				<td class="impar">SE</td>

				<td class="impar">= Soporte Electrónico</td>

			</tr>

			<tr>

				<td class="impar"><b>P</b></td>

				<td class="impar">= Preservación</td>

				<td class="impar"></td>

				<td class="impar"></td>

			</tr>

			<tr>

				<td class="impar"><b>DP</b></td>

				<td class="impar">= Documento Publico</td>

				<td class="impar"></td>

				<td class="impar"></td>

			</tr>

			<tr>

				<td class="impar"><b>DO</b></td>

				<td class="impar">= Documento Obligatorio</td>

				<td class="impar"></td>

				<td class="impar"></td>

			</tr>

		</tbody></table>

	</div>

		

	<script>



	$('tr.tblresult:not([th]):even').addClass('par');

	$('tr.tblresult:not([th]):odd').addClass('impar');

	</script>



	<style>

		.subss{

			border-top: 1px solid #CCC;

		}

	</style>

</body>

</html>

