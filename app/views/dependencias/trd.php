<link rel='stylesheet' type='text/css' href='<?=ASSETS?>/styles/del.mini.css'/>
	<style>
		@media print {
		    body {
		        margin:0px !important;
		        padding:0px !important;
		    }

		    .saltoDePagina{
				display:block;
				page-break-before:always;
			}
		    
		}
	</style>
	<script type="text/javascript">
	  $(document).ready(function(){
	        $('[data-toggle="tooltip"]').tooltip(); 
	        $('[data-toggle="popover"]').popover()
	  });
	</script>
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

	        $MDependencias_version = new MDependencias_version;
    		$MDependencias_version->CreateDependencias_version("id", $sadmin->Getid_version());

        }
    }else{

        $u = new MUsuarios;
        $u->CreateUsuarios("user_id", $_SESSION['usuario']);

        $sadmin = new MSuper_admin;
        $sadmin->CreateSuper_admin("id", $u->GetId_empresa());

	        $MDependencias_version = new MDependencias_version;
    		$MDependencias_version->CreateDependencias_version("id", $sadmin->Getid_version());
    }
?>
<div class="row" style="background-color: #FFF">
	<div class="col-md-12">
		
	
		<div id="del-buscar">
			<h4 style="margin-top: -13px; margin-bottom: 0px;">Proceso: Gestión Documental</h4>
			<h3 style="margin-top: 8px; margin-bottom: 0px;">Tabla de Retención Documental, Versión <?= $MDependencias_version->GetNombre() ?></h3>
		</div>
					<?
						#echo $nombre_usuario
					    if ($_SESSION["usuario"] != ""){

							$cit = new MCity;
							$cit->CreateCity("code", $_SESSION['ciudad']);

							$area = new MAreas;
							$area->CreateAreas("id", $_SESSION['area_principal']);

							$of = new MSeccional;
							$of->CreateSeccional("id", $_SESSION['seccional']);
						}
					?>
	</div>
	<div id='content' class="app_container" style="padding:15px">
		<h4>OFICINA PRODUCTORA: <?= $areap->GetNombre(); ?></h4>
		<table border="1" cellspacing="0" cellpadding="3" width="100%" class="tabla" id="tablat">
			<thead>
				<tr>
					<th class="th_act_inner first" style="padding-left:5px; font-size: 8px;" colspan="3">Codigos</th>
					<th class="th_act_inner" style="padding-left:5px; font-size: 8px;" colspan="3">Descripción Documental</th>
					<th class="th_act_inner" style="padding-left:5px; font-size: 8px;" colspan="5">Soporte / Formato</th>
					<th class="th_act_inner" style="padding-left:5px; font-size: 8px;" colspan="2">Retención</th>
					<th class="th_act_inner" style="padding-left:5px; font-size: 8px;" colspan="5">Disposición</th>
					<th class="th_act_inner last" width="200px" style="padding-left:5px; font-size: 8px;" rowspan="2">Procedimiento</th>
				</tr>
				<tr>
					<th class="th_act_inner" width="30px" style="padding-left:5px; font-size: 8px;">Depen dencia</th>
					<th class="th_act_inner" width="30px" style="padding-left:5px; font-size: 8px;">Serie</th>
					<th class="th_act_inner" width="30px" style="padding-left:5px; font-size: 8px;">Sub Serie</th>
					<th class="th_act_inner" width="100px" style="padding-left:5px; font-size: 8px;">Serie Documental</th>
					<th class="th_act_inner" width="100px" style="padding-left:5px; font-size: 8px;">Subserie Documental</th>
					<th class="th_act_inner" width="100px" style="padding-left:5px; font-size: 8px;">Tipo Documental</th>
					<th class="th_act_inner" width="15px"  style="padding-left:5px; font-size: 8px; text-align: center">P</th>
					<th class="th_act_inner" width="15px"  style="padding-left:5px; font-size: 8px; text-align: center">EL</th>
					<th class="th_act_inner" width="15px"  style="padding-left:5px; font-size: 8px; text-align: center">XML</th>
					<th class="th_act_inner" width="30px"  style="padding-left:5px; font-size: 8px; text-align: center">T</th>
					<th class="th_act_inner" width="100px"  style="padding-left:5px; font-size: 8px; text-align: center">Procedimiento del Tipo Documental</th>
					<th class="th_act_inner" width="20px" style="padding-left:5px; font-size: 8px;">Gestion</th>
					<th class="th_act_inner" width="20px" style="padding-left:5px; font-size: 8px;">Central</th>
					<th class="th_act_inner" width="15px" style="padding-left:5px; font-size: 8px;">CT</th>
					<th class="th_act_inner" width="15px" style="padding-left:5px; font-size: 8px;">E</th>
					<th class="th_act_inner" width="15px" style="padding-left:5px; font-size: 8px;">M</th>
					<th class="th_act_inner" width="15px" style="padding-left:5px; font-size: 8px;">D</th>
					<th class="th_act_inner" width="15px" style="padding-left:5px; font-size: 8px;">S</th>
				</tr>
			</thead>
			<tbody>
			<?

				$queryN = $con->Query("SELECT areas_dependencias.id AS idad, dependencias.nombre, areas_dependencias.id_dependencia_raiz,(select nombre from dependencias where id = areas_dependencias.id_dependencia) as nd FROM areas_dependencias INNER JOIN dependencias ON dependencias.id = areas_dependencias.id_dependencia_raiz WHERE id_area =  '".$id."' AND areas_dependencias.id_version = '".$_SESSION['id_trd']."' ORDER BY  dependencias.nombre ASC,nd ASC  ");	    

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
					}elseif ($ss->GetT_h() == "-6" || $ss->GetT_h() == "-7") {
						$fecha_th2 = "X"; #	ELIMINACION
						$fecha_th4 = "X";
					}elseif ($ss->GetT_h() == "-8") {
						$fecha_th5 = "X"; #	ELIMINACION
						$fecha_th4 = "X";
					}elseif ($ss->GetT_h() == "-9") {
						$fecha_th1 = "X"; #	ELIMINACION
						$fecha_th4 = "X";
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
					}elseif ($ss->GetT_h() == "-6" || $ss->GetT_h() == "-7") {
						$fecha_th2 = "X"; #	ELIMINACION
						$fecha_th4 = "X";
					}elseif ($ss->GetT_h() == "-8") {
						$fecha_th5 = "X"; #	ELIMINACION
						$fecha_th4 = "X";
					}elseif ($ss->GetT_h() == "-9") {
						$fecha_th1 = "X"; #	ELIMINACION
						$fecha_th4 = "X";
					}

					$countertip = $con->Query("select * from dependencias_tipologias where id_dependencia = '".$l->GetId_dependencia()."' and estado = '1' ORDER BY orden");
					$nomtipologias = "";
					$sopa = "";
					$sopb = "";
					$sopc = "";
					$sopd = "";

					$totrow = $con->NumRows($countertip);
					$counter = 0;

					while ($riowt = $con->FetchAssoc($countertip)) {
						$counter++;

						$borderbotom = "border-bottom:1px solid #ccc;";
						if ($counter == $totrow) {
							$borderbotom = "";
						}
						$soportea = "&nbsp;";
						$soporteb = "&nbsp;";
						$soportec = "&nbsp;";

						if ($riowt['soporte'] == 0) {
							$soportea = "X";
						}elseif($riowt['soporte'] == 1){
							$soporteb = "X";
						}elseif($riowt['soporte'] == 2){
							$soportea = "X";
							$soporteb = "X";
						}elseif($riowt['soporte'] == 3){
							$soporteb = "X";
							$soportec = "X";
						}else{
							$soportec = "X";
							$soportea = "X";
							$soporteb = "X";
						}

						$fecha = date("Y-m-d");
						
						$fecha_c = date_create($fecha);//aca le pasas la fecha actual o ala que le queres sumar los dias.
						$mes = $riowt['dias_vencimiento'];
						date_modify($fecha_c, $mes." day");//sumas los dias que te hacen falta.
						$vencimientotip = date_format($fecha_c, "Y-m-d");//retornas la fecha en el formato que mas te guste.
						
						$mvencimiento = "-";

						if ($mes != "0") {
							$mvencimiento = $f->nicetime2($vencimientotip);
						}
						$ntipologia = ($riowt['formato'] != "")?"<a href='".HOMEDIR.DS."app/plugins/uploadsfiles/".$riowt['formato']."' target='_blank'>".$riowt['tipologia']."</a>":$riowt['tipologia'];
						$nomtipologias .= "<tr style='border-bottom:1px solid #ccc'>
											<td width='100px' style='border-right:1px solid #ccc'>".$ntipologia."</td>";
						$nomtipologias .= "<td width='15px' align='center' style='border-right:1px solid #ccc'>".$soportea."</td>";
						$nomtipologias .= "<td width='15px' align='center' style='border-right:1px solid #ccc'>".$soporteb."</td>";
						$nomtipologias .= "<td width='15px' align='center' style='border-right:1px solid #ccc'>".$soportec."</td>";
						$nomtipologias .= "<td width='30px' align='center' style='border-right:1px solid #ccc'>".$mvencimiento."</td>";
						$nomtipologias .= "<td width='100px' align='center' >".$riowt['observacion']."</td>";
						$nomtipologias .= "</tr>";
					}

					$nomdep = $ss->GetNombre();
					$coddep = $ss->GetId_c();

					if ($d->GetDependencia_inversa() != "0") {
						$nomdep = "";
						$coddep = "";
					}
					echo 
						'
						<tr>
							<td width="30px" style="font-size: 8px; vertical-align:middle; border-left:1px solid #ccc; border-bottom:1px solid #ccc">'.$areap->GetPrefijo().'</td>
							<td width="30px" style="font-size: 8px; vertical-align:middle; border-left:1px solid #ccc; border-bottom:1px solid #ccc">'.$d->GetId_c().'</td>
							<td width="30px" style="font-size: 8px; vertical-align:middle; border-left:1px solid #ccc; border-bottom:1px solid #ccc">'.$coddep.'</td>
							<td width="100px" style="font-size: 8px; vertical-align:middle; border-left:1px solid #ccc; border-bottom:1px solid #ccc">'.$d->GetNombre().'</td>
							<td width="100px" style="font-size: 8px; vertical-align:middle; border-left:1px solid #ccc; border-bottom:1px solid #ccc">'.$nomdep.'</td>
							<td width="270px" colspan="6" style="font-size: 8px; padding:0px !important; border-left:1px solid #ccc; border-bottom:1px solid #ccc">
								<table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%" style="margin:0px; padding:0px">'.$nomtipologias.'</table>
							</td>
							<!--<td width="15px" style="font-size: 8px; padding:0px !important; border-left:1px solid #ccc; border-bottom:1px solid #ccc ">
								<table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin:0px; padding:0px">'.$sopa.'</table>
							</td>
							<td width="15px" style="font-size: 8px; padding:0px !important; border-left:1px solid #ccc; border-bottom:1px solid #ccc">
								<table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin:0px; padding:0px;">'.$sopb.'</table>
							</td>
							<td width="15px" style="font-size: 8px; padding:0px !important; border-left:1px solid #ccc; border-bottom:1px solid #ccc">
								<table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin:0px; padding:0px;">'.$sopd.'</table>
							</td>
							<td width="30px" style="font-size: 8px; padding:0px !important; border-left:1px solid #ccc; border-bottom:1px solid #ccc">
								<table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin:0px; padding:0px">'.$sopc.'</table>
							</td> -->
							<td width="30px" align="center" style="font-size: 8px; vertical-align:middle; border-left:1px solid #ccc; border-bottom:1px solid #ccc">'.$tges.'</td>
							<td width="30px" align="center" style="font-size: 8px; vertical-align:middle; border-left:1px solid #ccc; border-bottom:1px solid #ccc">'.$tcen.'</td>
							<td width="15px" align="center" style="font-size: 8px; vertical-align:middle; border-left:1px solid #ccc; border-bottom:1px solid #ccc">'.$fecha_th1.'</td>
							<td width="15px" align="center" style="font-size: 8px; vertical-align:middle; border-left:1px solid #ccc; border-bottom:1px solid #ccc">'.$fecha_th2.'</td>
							<td width="15px" align="center" style="font-size: 8px; vertical-align:middle; border-left:1px solid #ccc; border-bottom:1px solid #ccc">'.$fecha_th3.'</td>
							<td width="15px" align="center" style="font-size: 8px; vertical-align:middle; border-left:1px solid #ccc; border-bottom:1px solid #ccc">'.$fecha_th4.'</td>
							<td width="15px" align="center" style="font-size: 8px; vertical-align:middle; border-left:1px solid #ccc; border-bottom:1px solid #ccc">'.$fecha_th5.'</td>
							<td style="font-size: 9px; vertical-align:middle; border-left:1px solid #ccc; border-bottom:1px solid #ccc; border-right:1px solid #CCC">'.$ss->GetObservacion().'</td>
						</tr>
						';
				}
			?>
			</tbody>
		</table>
		<div class="saltoDePagina"></div>
		<table border="0" style="border:1px solid #ccc;">
			<tr>
				<td class="impar" colspan="4"><b>CONVENCIONES:</b></td>
			</tr>
			<tr>
				<td class="impar"><b>CT</b></td>
				<td class="impar">= Conservación Total</td>
				<td class="impar">P</td>
				<td class="impar">= Soporte en Papel</td>
			</tr>
			<tr>
				<td class="impar"><b>E</b></td>
				<td class="impar">= Eliminación</td>
				<td class="impar">EL</td>
				<td class="impar">= Soporte Electrónico</td>
			</tr>
			<tr>
				<td class="impar"><b>M</b></td>
				<td class="impar">= Microfilmación</td>
				<td class="impar">T</td>
				<td class="impar">= Tiempo de Retención del Documento</td>
			</tr>
			<tr>
				<td class="impar"><b>S</b></td>
				<td class="impar">= Selección</td>
				<td class="impar">XML</td>
				<td class="impar">= Documento de Interoperabilidad</td>
			</tr>
			<tr>
				<td class="impar"><b>D</b></td>
				<td class="impar">= Digitalizacion</td>
				<td class="impar"></td>
				<td class="impar"></td>
			</tr>
		</table>
	</div>
	</div>
</div>
	<style>
		.subss{
			border-top: 1px solid #CCC;
		}
	</style>