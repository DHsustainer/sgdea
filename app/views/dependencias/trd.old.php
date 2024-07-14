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







?>





		<div id="del-buscar">

			<h4 style="margin-top: -13px; margin-bottom: 0px;">Proceso: Gestión Documental</h4>

			<h3 style="margin-top: 8px; margin-bottom: 0px;">Tabla de Retención Documental</h3>

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
	<div id='content' class="app_container" style="background:#FFF;">

		<h4>OFICINA PRODUCTORA: <?= $areap->GetNombre(); ?></h4><br>
		<table border="0" cellspacing="0" cellpadding="3" width="100%" class="tabla" id="tablat">
			<thead>
				<tr>
					<th class="th_act_inner first" style="padding-left:5px; font-size: 11px;" colspan="3">Codigos</th>
					<th class="th_act_inner" style="padding-left:5px; font-size: 11px;" colspan="3">Descripción Documental</th>
					<th class="th_act_inner" style="padding-left:5px; font-size: 11px;" colspan="2">Retención</th>
					<th class="th_act_inner" style="padding-left:5px; font-size: 11px;" colspan="3">Soporte</th>
					<th class="th_act_inner" style="padding-left:5px; font-size: 11px;" colspan="5">Disposición</th>
					<th class="th_act_inner last" style="padding-left:5px; font-size: 11px;" rowspan="2">Procedimiento</th>
				</tr>
				<tr>
					<th class="th_act_inner" width="30px" style="padding-left:5px; font-size: 11px;">Depen dencia</th>
					<th class="th_act_inner" width="30px" style="padding-left:5px; font-size: 11px;">Serie</th>
					<th class="th_act_inner" width="30px" style="padding-left:5px; font-size: 11px;">Sub Serie</th>
					<th class="th_act_inner" width="160px" style="padding-left:5px; font-size: 11px;">Serie Documental</th>
					<th class="th_act_inner" width="160px" style="padding-left:5px; font-size: 11px;">Subserie Documental</th>
					<th class="th_act_inner" width="160px" style="padding-left:5px; font-size: 11px;">Tipo Documental</th>
					<th class="th_act_inner" width="60px" style="padding-left:5px; font-size: 11px;">Gestion</th>
					<th class="th_act_inner" width="60px" style="padding-left:5px; font-size: 11px;">Central</th>
					<th class="th_act_inner" width="15px" style="padding-left:5px; font-size: 11px;">P</th>
					<th class="th_act_inner" width="15px" style="padding-left:5px; font-size: 11px;">EL</th>
					<th class="th_act_inner" width="60px" style="padding-left:5px; font-size: 11px;">T</th>
					<th class="th_act_inner" width="15px" style="padding-left:5px; font-size: 11px;">CT</th>
					<th class="th_act_inner" width="15px" style="padding-left:5px; font-size: 11px;">E</th>
					<th class="th_act_inner" width="15px" style="padding-left:5px; font-size: 11px;">M</th>
					<th class="th_act_inner" width="15px" style="padding-left:5px; font-size: 11px;">D</th>
					<th class="th_act_inner" width="15px" style="padding-left:5px; font-size: 11px;">S</th>
				</tr>
			</thead>
			<tbody>
			<?

				$queryN = $con->Query("SELECT areas_dependencias.id AS idad, dependencias.nombre, areas_dependencias.id_dependencia_raiz FROM areas_dependencias INNER JOIN dependencias ON dependencias.id = areas_dependencias.id_dependencia_raiz WHERE id_area =  '".$id."' ORDER BY nombre ASC ");	    

				while ($rown = $con->FetchAssoc($queryN)) {
					$l = new MAreas_dependencias;
					$l->Createareas_dependencias('id', $rown['idad']);

					$d = new MDependencias;
					$d->CreateDependencias("id", $l->GetId_dependencia_raiz());

					$ss = new MDependencias;
					$ss->CreateDependencias("id", $l->GetId_dependencia());


					global $f;

					$fecha = date("Y-m-d H:i:s");
					$fecha_c = date_create($fecha);//aca le pasas la fecha actual o ala que le queres sumar los dias.
					$mes = $ss->GetT_g();
					date_modify($fecha_c, $mes." day");//sumas los dias que te hacen falta.
					$fecha_tg = date_format($fecha_c, "Y-m-d");//retornas la fecha en el formato que mas te guste.

					$fecha = date("Y-m-d H:i:s");
					$fecha_c = date_create($fecha);//aca le pasas la fecha actual o ala que le queres sumar los dias.
					$mes = $ss->GetT_c();
					date_modify($fecha_c, $mes." day");//sumas los dias que te hacen falta.
					$fecha_tc = date_format($fecha_c, "Y-m-d");//retornas la fecha en el formato que mas te guste.

					
					$fecha_th1 = ""; # 	CONSERVACION TOTAL
					$fecha_th2 = ""; #	ELIMINACION
					$fecha_th3 = ""; #  MICRO FILMACION
					$fecha_th4 = ""; #  DIGITALIZACION  
					$fecha_th5 = ""; #  SELECCION

					if ($ss->GetT_h() == "-1") {
						$fecha_th2 = "X"; #	ELIMINACION
					}elseif ($ss->GetT_h() == "-2") {
						$fecha_th1 = "X"; # CONSERVACION TOTAL
					}elseif ($ss->GetT_h() == "-3") {
						$fecha_th4 = "X";
					}elseif ($ss->GetT_h() == "-4") {
						$fecha_th5 = "X";
					}elseif ($ss->GetT_h() == "-5") {
						$fecha_th3 = "X";
					}

					$tges = ($ss->GetT_g() != "0")?$f->nicetime2($fecha_tg):"-";
					$tcen = ($ss->GetT_c() != "0")?$f->nicetime2($fecha_tc):"-";

					$fecha_th1 = ""; # 	CONSERVACION TOTAL
					$fecha_th2 = ""; #	ELIMINACION
					$fecha_th3 = ""; #  MICRO FILMACION
					$fecha_th4 = ""; #  DIGITALIZACION  
					$fecha_th5 = ""; #  SELECCION

					if ($ss->GetT_h() == "-1") {
						$fecha_th2 = "X"; #	ELIMINACION
					}elseif ($ss->GetT_h() == "-2") {
						$fecha_th1 = "X"; # CONSERVACION TOTAL
					}elseif ($ss->GetT_h() == "-3") {
						$fecha_th4 = "X";
					}elseif ($ss->GetT_h() == "-4") {
						$fecha_th5 = "X";
					}elseif ($ss->GetT_h() == "-5") {
						$fecha_th3 = "X";
					}

					$countertip = $con->Query("select * from dependencias_tipologias where id_dependencia = '".$l->GetId_dependencia()."'");
					$nomtipologias = "";
					$sopa = "";
					$sopb = "";
					$sopc = "";

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
						
						$nomtipologias .= "<tr><td style='".$borderbotom."'>".$riowt['tipologia']."</td></tr>";
						$sopa .= "<tr><td style='".$borderbotom."'>&nbsp;</td></tr>";
						$sopb .= "<tr><td style='".$borderbotom."'>&nbsp;</td></tr>";
						$sopc .= "<tr><td align='center' style='".$borderbotom."'>".$f->nicetime2($vencimientotip)."</td></tr>";
					}

					echo 
						'
						<tr>
							<td width="30px" style="font-size: 11px; vertical-align:middle; border-left:1px solid #ccc; border-bottom:1px solid #ccc">'.$areap->GetPrefijo().'</td>
							<td width="30px" style="font-size: 11px; vertical-align:middle; border-left:1px solid #ccc; border-bottom:1px solid #ccc">'.$d->GetId_c().'</td>
							<td width="30px" style="font-size: 11px; vertical-align:middle; border-left:1px solid #ccc; border-bottom:1px solid #ccc">'.$ss->GetId_c().'</td>
							<td width="160px" style="font-size: 11px; vertical-align:middle; border-left:1px solid #ccc; border-bottom:1px solid #ccc">'.$d->GetNombre().'</td>
							<td width="160px" style="font-size: 11px; vertical-align:middle; border-left:1px solid #ccc; border-bottom:1px solid #ccc">'.$ss->GetNombre().'</td>
							<td width="160px" style="font-size: 11px; padding:0px !important; border-left:1px solid #ccc; border-bottom:1px solid #ccc">
								<table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%" style="margin:0px; padding:0px">'.$nomtipologias.'</table>
							</td>
							<td width="50px" align="center" style="font-size: 11px; vertical-align:middle; border-left:1px solid #ccc; border-bottom:1px solid #ccc">'.$tges.'</td>
							<td width="50px" align="center" style="font-size: 11px; vertical-align:middle; border-left:1px solid #ccc; border-bottom:1px solid #ccc">'.$tcen.'</td>
							<td width="15px" style="font-size: 11px; padding:0px !important; border-left:1px solid #ccc; border-bottom:1px solid #ccc ">
								<table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin:0px; padding:0px">'.$sopa.'</table>
							</td>
							<td width="15px" style="font-size: 11px; padding:0px !important; border-left:1px solid #ccc; border-bottom:1px solid #ccc">
								<table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin:0px; padding:0px;">'.$sopb.'</table>
							</td>
							<td width="60px" style="font-size: 11px; padding:0px !important; border-left:1px solid #ccc; border-bottom:1px solid #ccc">
								<table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin:0px; padding:0px">'.$sopc.'</table>
							</td>
							<td width="15px" align="center" style="font-size: 11px; vertical-align:middle; border-left:1px solid #ccc; border-bottom:1px solid #ccc">'.$fecha_th1.'</td>
							<td width="15px" align="center" style="font-size: 11px; vertical-align:middle; border-left:1px solid #ccc; border-bottom:1px solid #ccc">'.$fecha_th2.'</td>
							<td width="15px" align="center" style="font-size: 11px; vertical-align:middle; border-left:1px solid #ccc; border-bottom:1px solid #ccc">'.$fecha_th3.'</td>
							<td width="15px" align="center" style="font-size: 11px; vertical-align:middle; border-left:1px solid #ccc; border-bottom:1px solid #ccc">'.$fecha_th4.'</td>
							<td width="15px" align="center" style="font-size: 11px; vertical-align:middle; border-left:1px solid #ccc; border-bottom:1px solid #ccc">'.$fecha_th5.'</td>
							<td style="font-size: 11px; vertical-align:middle; border-left:1px solid #ccc; border-bottom:1px solid #ccc; border-right:1px solid #CCC">'.$ss->GetObservacion().'</td>
						</tr>
						';


				}
			?>
				
			</tbody>

		</table>





<!-- VERSION ANTERIOR DE LA TRD -->

		<table border="0" cellspacing="0" cellpadding="3" width="100%" class="tabla" id="tablat">

			<thead>

				<tr class="encabezado">

					<th style="padding-left:0px" rowspan="2" class="th_act_inner first" style="width:100px">Código</th>

					<th style="padding-left:0px" rowspan="2" colspan="2" class="th_act_inner">Series, subseries y Tipos de Documento</th>

					<th style="padding-left:0px" colspan="2" class="th_act_inner">Retención</th>

					<th style="padding-left:0px" colspan="5" class="th_act_inner">Disposicion Final</th>

					<th style="padding-left:0px" rowspan="2" class="th_act_inner last">Procedimiento</th>

				</tr>

				<tr>

					<th style="padding-left:0px" class="th_act_inner">Archivo de Gestion</td>

					<th style="padding-left:0px" class="th_act_inner">Archivo Central</td>

					<th style="padding-left:0px" class="th_act_inner">CT</td>

					<th style="padding-left:0px" class="th_act_inner">E</td>

					<th style="padding-left:0px" class="th_act_inner">M</td>

					<th style="padding-left:0px" class="th_act_inner">D</td>

					<th style="padding-left:0px" class="th_act_inner">S</td>

				</tr>

			</thead>

			<tbody>



<?

			while($row = $con->FetchAssoc($query)){



				$l = new MAreas_dependencias;

				$l->Createareas_dependencias('id', $row['idad']);



				$d = new MDependencias;

				$d->CreateDependencias("id", $l->GetId_dependencia_raiz());



?>						

				<tr class="par"> 

					<td style="border-left:1px solid #ccc; border-top:1px solid #ccc" width="100px"><?= $f->zerofill($d->GetId_c(), 3) ?></td>

					<td style="border-left:1px solid #ccc; border-top:1px solid #ccc" width="30px"><img src="<?= ASSETS.DS.'images/sr.png' ?>" title="Serie Documental" style="cursor:pointer"></td>

					<td style="border-left:1px solid #ccc; border-top:1px solid #ccc; border-right: 1px solid #ccc;" colspan="9"><b><?php echo $d->GetNombre() ?></b></td>

				</tr>

<?

					$qn = $l->ListarAreas_dependencias(" where id_area = '".$l->GetId_area()."' and id_dependencia_raiz = '".$d->GetId()."'");



					while ($ro2 = $con->FetchAssoc($qn)) {

						$s = new MDependencias;

						$s->CreateDependencias("id", $ro2['id_dependencia']);



						$rot = new MDependencias;

						$rot->CreateDependencias("id", $s->GetDependencia());



						$object = new MDependencias_tipologias;

						$query2 = $object->ListarDependencias_tipologias(" WHERE id_dependencia = '".$s->GetId()."' and estado = '1'");

						$totalr = 1+$con->NumRows($query2);



						$MDependencias_tipologias_referencias = new MDependencias_tipologias_referencias;



						$totalk = 0;

						$query22 = $object->ListarDependencias_tipologias(" WHERE id_dependencia = '".$s->GetId()."' and estado = '1'");

						while($rowt2 = $con->FetchAssoc($query22)){

							

							$MDependencias_tipologias_referencias->CreateDependencias_tipologias_referencias('dependencia_id', $rowt2['id']);

							if($MDependencias_tipologias_referencias->GetId() != ""){

								if ($MDependencias_tipologias_referencias->GetCol_1_name() != ""){$totalk++;}

								if ($MDependencias_tipologias_referencias->GetCol_2_name() != ""){$totalk++;}

								if ($MDependencias_tipologias_referencias->GetCol_3_name() != ""){$totalk++;}

								if ($MDependencias_tipologias_referencias->GetCol_4_name() != ""){$totalk++;}

								if ($MDependencias_tipologias_referencias->GetCol_5_name() != ""){$totalk++;}

								if ($MDependencias_tipologias_referencias->GetCol_6_name() != ""){$totalk++;}

								if ($MDependencias_tipologias_referencias->GetCol_7_name() != ""){$totalk++;}

								if ($MDependencias_tipologias_referencias->GetCol_8_name() != ""){$totalk++;}

								if ($MDependencias_tipologias_referencias->GetCol_9_name() != ""){$totalk++;}

								if ($MDependencias_tipologias_referencias->GetCol_10_name() != ""){$totalk++;}

								if ($MDependencias_tipologias_referencias->GetCol_11_name() != ""){$totalk++;}

								if ($MDependencias_tipologias_referencias->GetCol_12_name() != ""){$totalk++;}

								if ($MDependencias_tipologias_referencias->GetCol_13_name() != ""){$totalk++;}

								if ($MDependencias_tipologias_referencias->GetCol_14_name() != ""){$totalk++;}

								if ($MDependencias_tipologias_referencias->GetCol_15_name() != ""){$totalk++;}

							}

						}



						$totalr = $totalr+$totalk;

?>

					<tr class="impar"> 

						

						<td style="border-left:1px solid #ccc; border-bottom:1px solid #ccc;"  align="center" class="subss" rowspan="<?= $totalr ?>" width="100px"><?php echo $f->zerofill($rot->GetId_c(), 3)."-".$f->zerofill($s->GetId_c(), 3); ?></td>

						<td style="border-left:1px solid #ccc;" class="subss" width="30px"><img src="<?= ASSETS.DS.'images/subc.png' ?>" title="Sub-Serie Documental" style="cursor:pointer"></td>

						<td style="border-left:1px solid #ccc;" class="subss" ><b><?php echo $s->GetNombre() ?></b></td>

<?

						global $f;

						

						$fecha = date("Y-m-d H:i:s");

						$fecha_c = date_create($fecha);//aca le pasas la fecha actual o ala que le queres sumar los dias.

						$mes = $s->GetT_g();

						date_modify($fecha_c, $mes." day");//sumas los dias que te hacen falta.

						$fecha_tg = date_format($fecha_c, "Y-m-d");//retornas la fecha en el formato que mas te guste.



						$fecha = date("Y-m-d H:i:s");

						$fecha_c = date_create($fecha);//aca le pasas la fecha actual o ala que le queres sumar los dias.

						$mes = $s->GetT_c();

						date_modify($fecha_c, $mes." day");//sumas los dias que te hacen falta.

						$fecha_tc = date_format($fecha_c, "Y-m-d");//retornas la fecha en el formato que mas te guste.



						

						$fecha_th1 = ""; # 	CONSERVACION TOTAL

						$fecha_th2 = ""; #	ELIMINACION

						$fecha_th3 = ""; #  MICRO FILMACION

						$fecha_th4 = ""; #  DIGITALIZACION  

						$fecha_th5 = ""; #  SELECCION



						if ($s->GetT_h() == "-1") {

							$fecha_th2 = "X"; #	ELIMINACION

						}elseif ($s->GetT_h() == "-2") {

							$fecha_th1 = "X"; # CONSERVACION TOTAL

						}elseif ($s->GetT_h() == "-3") {

							$fecha_th4 = "X";

						}elseif ($s->GetT_h() == "-4") {

							$fecha_th5 = "X";

						}elseif ($s->GetT_h() == "-5") {

							$fecha_th3 = "X";

						}

?>



						<td class="subss" rowspan="<?= $totalr ?>" style="vertical-align: middle;border-left:1px solid #ccc; border-bottom:1px solid #ccc;"  width="60px"><?= ($s->GetT_g() != "0")?$f->nicetime2($fecha_tg):"-";  ?></td>

						<td class="subss" rowspan="<?= $totalr ?>" style="vertical-align: middle;border-left:1px solid #ccc; border-bottom:1px solid #ccc;"  width="60px"><?= ($s->GetT_c() != "0")?$f->nicetime2($fecha_tc):"-";  ?></td>

						<td class="subss" rowspan="<?= $totalr ?>" style="vertical-align: middle;border-left:1px solid #ccc; border-bottom:1px solid #ccc;"  align="center" width="30px"><?= $fecha_th1 ?></td>

						<td class="subss" rowspan="<?= $totalr ?>" style="vertical-align: middle;border-left:1px solid #ccc; border-bottom:1px solid #ccc;"  align="center" width="30px"><?= $fecha_th2 ?></td>

						<td class="subss" rowspan="<?= $totalr ?>" style="vertical-align: middle;border-left:1px solid #ccc; border-bottom:1px solid #ccc;"  align="center" width="30px"><?= $fecha_th3 ?></td>

						<td class="subss" rowspan="<?= $totalr ?>" style="vertical-align: middle;border-left:1px solid #ccc; border-bottom:1px solid #ccc;"  align="center" width="30px"><?= $fecha_th4 ?></td>

						<td class="subss" rowspan="<?= $totalr ?>" style="vertical-align: middle;border-left:1px solid #ccc; border-bottom:1px solid #ccc;"  align="center" width="30px"><?= $fecha_th5 ?></td>

						<td class="subss" rowspan="<?= $totalr ?>" style="vertical-align: middle;border-left:1px solid #ccc; border-bottom:1px solid #ccc; border-top:1px solid #ccc; border-right: 1px solid #ccc;" ><?= $s->GetObservacion() ?></td>

					</tr>

<?					



					$i = 0;

					while($rowt = $con->FetchAssoc($query2)){

						$i++;

						$dt = new MDependencias_tipologias;

						$dt->Createdependencias_tipologias('id', $rowt[id]);

						$sborder = "";



						if ($i == $totalr-1 ) {

							$sborder = "border-bottom:1px solid #ccc;";

						}

?>						

						<tr class="impar"> 

							<td style="border-left:1px solid #ccc; <?= $sborder ?>"><img src="<?= ASSETS.DS.'images/tip.png' ?>" title="Tipología Documental" style="cursor:pointer"></td>

							<td style="border-left:1px solid #ccc; <?= $sborder ?>">
								<?php echo $dt -> GetTipologia(); ?>
								<div style="margin-left: 10px; font-size: 9px; margin-top: -10px">
									<?php if ($dt->GetPrioridad() != ""): ?>
											<div style="width:50%; float:left;"><i>Valoracion:</i> <?= $dt->GetPrioridad() ?></div>										
									<?php endif ?>
									<?php if ($dt->GetDias_vencimiento() != ""): ?>
											<div style="width:50%; float:left;"><i>Vencimiento:</i> <?= $dt->GetDias_vencimiento() ?></div>										
									<?php endif ?>
									<?php if ($dt->GetObservacion() != ""): ?>
											<div style="width:100%; clear:both; margin-bottom:5px"><i>Observacion:</i><?= $dt->GetObservacion() ?></div>
									<?php endif ?>
								</div>
							</td> 

						</tr>

							<?php

							$ref = new MDependencias_tipologias_referencias;

							$ref->CreateDependencias_tipologias_referencias('dependencia_id', $rowt['id']);

							if($ref->GetId() != ""){  ?>

								<?php 

								if ($ref->GetCol_1_name() != ""){ 

									$i++;

									if ($i == $totalr-1 ) {$sborder = "border-bottom:1px solid #ccc;";}

									?>

								<tr class="impar"> 

									<td style="border-left:1px solid #ccc; <?= $sborder ?>"><img src="<?= ASSETS.DS.'images/matadato.png' ?>" title="MetaDatos" style="cursor:pointer"></td>

									<td style="padding-left: 20px;border-left:1px solid #ccc; <?= $sborder ?>">

										<?php echo $ref->GetCol_1_name(); ?>

									</td> 

								</tr>

								<?php } ?>

								<?php 

								if ($ref->GetCol_2_name() != ""){ 

									$i++;

									if ($i == $totalr-1 ) {$sborder = "border-bottom:1px solid #ccc;";}

									?>

								<tr class="impar"> 

									<td style="border-left:1px solid #ccc; <?= $sborder ?>"><img src="<?= ASSETS.DS.'images/matadato.png' ?>" title="MetaDatos" style="cursor:pointer"></td>

									<td style="padding-left: 20px;border-left:1px solid #ccc; <?= $sborder ?>">

										<?php echo $ref->GetCol_2_name(); ?>

									</td> 

								</tr>

								<?php } ?>

								<?php 

								if ($ref->GetCol_3_name() != ""){ 

									$i++;

									if ($i == $totalr-1 ) {$sborder = "border-bottom:1px solid #ccc;";}

									?>

								<tr class="impar"> 

									<td style="border-left:1px solid #ccc; <?= $sborder ?>"><img src="<?= ASSETS.DS.'images/matadato.png' ?>" title="MetaDatos" style="cursor:pointer"></td>

									<td style="padding-left: 20px;border-left:1px solid #ccc; <?= $sborder ?>">

										<?php echo $ref->GetCol_3_name(); ?>

									</td> 

								</tr>

								<?php } ?>

								<?php 

								if ($ref->GetCol_4_name() != ""){ 

									$i++;

									if ($i == $totalr-1 ) {$sborder = "border-bottom:1px solid #ccc;";}

									?>

								<tr class="impar"> 

									<td style="border-left:1px solid #ccc; <?= $sborder ?>"><img src="<?= ASSETS.DS.'images/matadato.png' ?>" title="MetaDatos" style="cursor:pointer"></td>

									<td style="padding-left: 20px;border-left:1px solid #ccc; <?= $sborder ?>">

										<?php echo $ref->GetCol_4_name(); ?>

									</td> 

								</tr>

								<?php } ?>

								<?php 

								if ($ref->GetCol_5_name() != ""){ 

									$i++;

									if ($i == $totalr-1 ) {$sborder = "border-bottom:1px solid #ccc;";}

									?>

								<tr class="impar"> 

									<td style="border-left:1px solid #ccc; <?= $sborder ?>"><img src="<?= ASSETS.DS.'images/matadato.png' ?>" title="MetaDatos" style="cursor:pointer"></td>

									<td style="padding-left: 20px;border-left:1px solid #ccc; <?= $sborder ?>">

										<?php echo $ref->GetCol_5_name(); ?>

									</td> 

								</tr>

								<?php } ?>	

								<?php 

								if ($ref->GetCol_6_name() != ""){ 

									$i++;

									if ($i == $totalr-1 ) {$sborder = "border-bottom:1px solid #ccc;";}

									?>

								<tr class="impar"> 

									<td style="border-left:1px solid #ccc; <?= $sborder ?>"><img src="<?= ASSETS.DS.'images/matadato.png' ?>" title="MetaDatos" style="cursor:pointer"></td>

									<td style="padding-left: 20px;border-left:1px solid #ccc; <?= $sborder ?>">

										<?php echo $ref->GetCol_6_name(); ?>

									</td> 

								</tr>

								<?php } ?>	

								<?php 

								if ($ref->GetCol_7_name() != ""){ 

									$i++;

									if ($i == $totalr-1 ) {$sborder = "border-bottom:1px solid #ccc;";}

									?>

								<tr class="impar"> 

									<td style="border-left:1px solid #ccc; <?= $sborder ?>"><img src="<?= ASSETS.DS.'images/matadato.png' ?>" title="MetaDatos" style="cursor:pointer"></td>

									<td style="padding-left: 20px;border-left:1px solid #ccc; <?= $sborder ?>">

										<?php echo $ref->GetCol_7_name(); ?>

									</td> 

								</tr>

								<?php } ?>

								<?php 

								if ($ref->GetCol_8_name() != ""){ 

									$i++;

									if ($i == $totalr-1 ) {$sborder = "border-bottom:1px solid #ccc;";}

									?>

								<tr class="impar"> 

									<td style="border-left:1px solid #ccc; <?= $sborder ?>"><img src="<?= ASSETS.DS.'images/matadato.png' ?>" title="MetaDatos" style="cursor:pointer"></td>

									<td style="padding-left: 20px;border-left:1px solid #ccc; <?= $sborder ?>">

										<?php echo $ref->GetCol_8_name(); ?>

									</td> 

								</tr>

								<?php } ?>

								<?php 

								if ($ref->GetCol_9_name() != ""){ 

									$i++;

									if ($i == $totalr-1 ) {$sborder = "border-bottom:1px solid #ccc;";}

									?>

								<tr class="impar"> 

									<td style="border-left:1px solid #ccc; <?= $sborder ?>"><img src="<?= ASSETS.DS.'images/matadato.png' ?>" title="MetaDatos" style="cursor:pointer"></td>

									<td style="padding-left: 20px;border-left:1px solid #ccc; <?= $sborder ?>">

										<?php echo $ref->GetCol_9_name(); ?>

									</td> 

								</tr>

								<?php } ?>	

								<?php 

								if ($ref->GetCol_10_name() != ""){ 

									$i++;

									if ($i == $totalr-1 ) {$sborder = "border-bottom:1px solid #ccc;";}

									?>

								<tr class="impar"> 

									<td style="border-left:1px solid #ccc; <?= $sborder ?>"><img src="<?= ASSETS.DS.'images/matadato.png' ?>" title="MetaDatos" style="cursor:pointer"></td>

									<td style="padding-left: 20px;border-left:1px solid #ccc; <?= $sborder ?>">

										<?php echo $ref->GetCol_10_name(); ?>

									</td> 

								</tr>

								<?php } ?>

								<?php 

								if ($ref->GetCol_11_name() != ""){ 

									$i++;

									if ($i == $totalr-1 ) {$sborder = "border-bottom:1px solid #ccc;";}

									?>

								<tr class="impar"> 

									<td style="border-left:1px solid #ccc; <?= $sborder ?>"><img src="<?= ASSETS.DS.'images/matadato.png' ?>" title="MetaDatos" style="cursor:pointer"></td>

									<td style="padding-left: 20px;border-left:1px solid #ccc; <?= $sborder ?>">

										<?php echo $ref->GetCol_11_name(); ?>

									</td> 

								</tr>

								<?php } ?>	

								<?php 

								if ($ref->GetCol_12_name() != ""){ 

									$i++;

									if ($i == $totalr-1 ) {$sborder = "border-bottom:1px solid #ccc;";}

									?>

								<tr class="impar"> 

									<td style="border-left:1px solid #ccc; <?= $sborder ?>"><img src="<?= ASSETS.DS.'images/matadato.png' ?>" title="MetaDatos" style="cursor:pointer"></td>

									<td style="padding-left: 20px;border-left:1px solid #ccc; <?= $sborder ?>">

										<?php echo $ref->GetCol_12_name(); ?>

									</td> 

								</tr>

								<?php } ?>	

								<?php 

								if ($ref->GetCol_13_name() != ""){ 

									$i++;

									if ($i == $totalr-1 ) {$sborder = "border-bottom:1px solid #ccc;";}

									?>

								<tr class="impar"> 

									<td style="border-left:1px solid #ccc; <?= $sborder ?>"><img src="<?= ASSETS.DS.'images/matadato.png' ?>" title="MetaDatos" style="cursor:pointer"></td>

									<td style="padding-left: 20px;border-left:1px solid #ccc; <?= $sborder ?>">

										<?php echo $ref->GetCol_13_name(); ?>

									</td> 

								</tr>

								<?php } ?>

								<?php 

								if ($ref->GetCol_14_name() != ""){ 

									$i++;

									if ($i == $totalr-1 ) {$sborder = "border-bottom:1px solid #ccc;";}

									?>

								<tr class="impar"> 

									<td style="border-left:1px solid #ccc; <?= $sborder ?>"><img src="<?= ASSETS.DS.'images/matadato.png' ?>" title="MetaDatos" style="cursor:pointer"></td>

									<td style="padding-left: 20px;border-left:1px solid #ccc; <?= $sborder ?>">

										<?php echo $ref->GetCol_14_name(); ?>

									</td> 

								</tr>

								<?php } ?>	

								<?php 

								if ($ref->GetCol_15_name() != ""){ 

									$i++;

									if ($i == $totalr-1 ) {$sborder = "border-bottom:1px solid #ccc;";}

									?>

								<tr class="impar"> 

									<td style="border-left:1px solid #ccc; <?= $sborder ?>"><img src="<?= ASSETS.DS.'images/matadato.png' ?>" title="MetaDatos" style="cursor:pointer"></td>

									<td style="padding-left: 20px;border-left:1px solid #ccc; <?= $sborder ?>">

										<?php echo $ref->GetCol_15_name(); ?>

									</td> 

								</tr>

								<?php } ?>											

							<?php

							}

							?>

<? 						



					}



				}

		}

?>	

			</tbody>

			

		</table>



		<table border="0" style="border:1px solid #ccc;">

			<tr>

				<td class="impar" colspan="4"><b>CONVENCIONES:</b></td>

			</tr>

			<tr>

				<td class="impar"><b>CT</b></td>

				<td class="impar">= Conservación Total</td>

				<td class="impar"><img src="<?= ASSETS.DS.'images/sr.png' ?>"></td>

				<td class="impar">Serie Documental</td>

			</tr>

			<tr>

				<td class="impar"><b>E</b></td>

				<td class="impar">= Eliminación</td>

				<td class="impar"><img src="<?= ASSETS.DS.'images/subc.png' ?>"></td>

				<td class="impar">Sub-Serie Documental</td>

			</tr>

			<tr>

				<td class="impar"><b>M</b></td>

				<td class="impar">= Microfilmación</td>

				<td class="impar"><img src="<?= ASSETS.DS.'images/tip.png' ?>"></td>

				<td class="impar">Tipología Documental</td>

			</tr>

			<tr>

				<td class="impar"><b>S</b></td>

				<td class="impar">= Selección</td>

				<td class="impar"><img src="<?= ASSETS.DS.'images/documento.png' ?>"></td>

				<td class="impar">Documento</td>

			</tr>

			<tr>

				<td class="impar"><b>D</b></td>

				<td class="impar">= Digitalizacion</td>

				<td class="impar"><img src="<?= ASSETS.DS.'images/matadato.png' ?>"></td>

				<td class="impar">Matedatos</td>

			</tr>

		</table>

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

