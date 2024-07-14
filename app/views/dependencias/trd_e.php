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

			<h3 style="margin-top: 8px; margin-bottom: 0px;">Tabla de Retención Documental Versión: <?= $MDependencias_version->GetNombre(); ?></h3>

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





	<div id='content' class="app_container">

	
		<h4>OFICINA PRODUCTORA: <?= $areap->GetNombre(); ?></h4><br>

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

					$qn = $l->ListarAreas_dependencias(" where id_area = '".$l->GetId_area()."' and id_dependencia_raiz = '".$d->GetId()."' and id_dependencia = '".$MGestion->GetTipo_documento()."'");



					while ($ro2 = $con->FetchAssoc($qn)) {

						$s = new MDependencias;

						$s->CreateDependencias("id", $ro2['id_dependencia']);



						$rot = new MDependencias;

						$rot->CreateDependencias("id", $s->GetDependencia());



						$object = new MDependencias_tipologias;

						$query2 = $object->ListarDependencias_tipologias(" WHERE id_dependencia = '".$s->GetId()."' and estado = '1' and id in(SELECT tipologia FROM gestion_anexos where gestion_id = '".$MGestion->GetId()."' group by tipologia)");



						$totalr = 1+$con->NumRows($query2);



						$MGestion_anexos = new MGestion_anexos;

						$query3 = $MGestion_anexos->ListarGestion_anexos(" WHERE gestion_id = '".$MGestion->GetId()."' and tipologia in(SELECT tipologia FROM gestion_anexos where gestion_id = '".$MGestion->GetId()."' and tipologia <> '0' group by tipologia)");



						$totalr = $totalr+$con->NumRows($query3);



						$MGestion_tipologias_big_data = new MGestion_tipologias_big_data;

						$query6 = $MGestion_tipologias_big_data->ListarGestion_tipologias_big_data(" WHERE proceso_id in(SELECT id FROM gestion_anexos where gestion_id = '".$MGestion->GetId()."' group by tipologia)");

						$totalr = $totalr+$con->NumRows($query6);



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

							<td style="border-left:1px solid #ccc; <?= $sborder ?>"><?php echo $dt -> GetTipologia(); ?></td> 

						</tr>

						<?php



						$query4 = $MGestion_anexos->ListarGestion_anexos(" WHERE gestion_id = '".$MGestion->GetId()."' and tipologia = '".$rowt['id']."' ");

						while($rowt4 = $con->FetchAssoc($query4)){

							$i++;

							if ($i == $totalr-1 ) {

								$sborder = "border-bottom:1px solid #ccc;";

							}

						?>

						<tr class="impar"> 

							<td style="border-left:1px solid #ccc; <?= $sborder ?>"><img src="<?= ASSETS.DS.'images/documento.png' ?>" title="Documento" style="cursor:pointer"></td>

							<td style="    padding-left: 20px;border-left:1px solid #ccc; <?= $sborder ?>"><?php echo $rowt4['nombre']; ?></td> 

						</tr>

							<?php

							$MGestion_tipologias_big_data = new MGestion_tipologias_big_data;

							$MGestion_tipologias_big_data->CreateGestion_tipologias_big_data("proceso_id", $rowt4['id']);

							if ($MGestion_tipologias_big_data->GetId() != "")

							{

								$i++;

								if ($i == $totalr-1 ) {

									$sborder = "border-bottom:1px solid #ccc;";

								}

							?>

							<tr class="impar"> 

								<td style="border-left:1px solid #ccc; <?= $sborder ?>"><img src="<?= ASSETS.DS.'images/matadato.png' ?>" title="MetaDatos" style="cursor:pointer"></td>

								<td style="padding-left: 40px;border-left:1px solid #ccc; <?= $sborder ?>">

									<b style="text-decoration: underline;">Metadatos</b>:<br>

									<?php



										$ref = new MDependencias_tipologias_referencias;

										$ref->CreateDependencias_tipologias_referencias('dependencia_id', $MGestion_tipologias_big_data->GetTipologia_referencia_id());



										$path = "";



										if ($ref->GetCol_1_name() != "") {



											$path .= '<b>'.$ref->GetCol_1_name().': </b>'.$MGestion_tipologias_big_data->GetCol_1().'<br>';

										}

										

										$path .= ($ref->GetCol_2_name() != "")  ? '<b>'.$ref->GetCol_2_name().': </b>'.$MGestion_tipologias_big_data->Getcol_2().'<br>' : '';

										$path .= ($ref->GetCol_3_name() != "")  ? '<b>'.$ref->GetCol_3_name().': </b>'.$MGestion_tipologias_big_data->Getcol_3().'<br>' : '';

										$path .= ($ref->GetCol_4_name() != "")  ? '<b>'.$ref->GetCol_4_name().': </b>'.$MGestion_tipologias_big_data->Getcol_4().'<br>' : '';

										$path .= ($ref->GetCol_5_name() != "")  ? '<b>'.$ref->GetCol_5_name().': </b>'.$MGestion_tipologias_big_data->Getcol_5().'<br>' : '';

										$path .= ($ref->GetCol_6_name() != "")  ? '<b>'.$ref->GetCol_6_name().': </b>'.$MGestion_tipologias_big_data->Getcol_6().'<br>' : '';

										$path .= ($ref->GetCol_7_name() != "")  ? '<b>'.$ref->GetCol_7_name().': </b>'.$MGestion_tipologias_big_data->Getcol_7().'<br>' : '';

										$path .= ($ref->GetCol_8_name() != "")  ? '<b>'.$ref->GetCol_8_name().': </b>'.$MGestion_tipologias_big_data->Getcol_8().'<br>' : '';

										$path .= ($ref->GetCol_9_name() != "")  ? '<b>'.$ref->GetCol_9_name().': </b>'.$MGestion_tipologias_big_data->Getcol_9().'<br>' : '';

										$path .= ($ref->GetCol_10_name() != "")  ? '<b>'.$ref->GetCol_10_name().': </b>'.$MGestion_tipologias_big_data->Getcol_10().'<br>' : '';

										$path .= ($ref->GetCol_11_name() != "")  ? '<b>'.$ref->GetCol_11_name().': </b>'.$MGestion_tipologias_big_data->Getcol_11().'<br>' : '';

										$path .= ($ref->GetCol_12_name() != "")  ? '<b>'.$ref->GetCol_12_name().': </b>'.$MGestion_tipologias_big_data->Getcol_12().'<br>' : '';

										$path .= ($ref->GetCol_13_name() != "")  ? '<b>'.$ref->GetCol_13_name().': </b>'.$MGestion_tipologias_big_data->Getcol_13().'<br>' : '';

										$path .= ($ref->GetCol_14_name() != "")  ? '<b>'.$ref->GetCol_14_name().': </b>'.$MGestion_tipologias_big_data->Getcol_14().'<br>' : '';

										$path .= ($ref->GetCol_15_name() != "")  ? '<b>'.$ref->GetCol_15_name().': </b>'.$MGestion_tipologias_big_data->Getcol_15().'<br>' : '';



										if($path == ""){

											$path = "<b>Sin metadatos ingresados</b>";

										}

										echo $path;



									?>

								</td>

							</tr>

<? 

							}

						}



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

