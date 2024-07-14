<?
	global $con;
	global $f;
	global $c;
	$wherefecha = '';
	$fecha_inicio = '';
	$fecha_fin = '';
	if($fechas != ''){
		$fecha = explode('|',$fechas);
		$wherefecha = " and gestion.f_recibido between '$fecha[0]' and '$fecha[1]' ";
		$fecha_inicio = $fecha[0];
		$fecha_fin = $fecha[1];
	}

	$dep = new MDependencias;
	$dep->CreateDependencias("id", $id);
	$draiz = new MDependencias;
	$draiz->CreateDependencias("id", $dep->GetDependencia());
	$csusc = new MSuscriptores_contactos;
	$csusc->CreateSuscriptores_contactos("id", $ids);
	$g = new MGestion;
	$qerrors = $con->Query("SELECT gestion.id FROM gestion inner join gestion_suscriptores on gestion_suscriptores.id_gestion = gestion.id   where gestion_suscriptores.id_suscriptor = '".$_SESSION['suscriptor_id']."' $wherefecha and estado_respuesta = 'Pendiente' and estado_archivo = '-1'  ", '', '');

	$qactive = $con->Query("SELECT gestion.id FROM gestion inner join gestion_suscriptores on gestion_suscriptores.id_gestion = gestion.id   where gestion_suscriptores.id_suscriptor = '".$_SESSION['suscriptor_id']."' $wherefecha and estado_respuesta in ('Abierto', 'Pendiente')  and estado_archivo = '1'  ", '', '');

	$qclosed = $con->Query("SELECT gestion.id FROM gestion inner join gestion_suscriptores on gestion_suscriptores.id_gestion = gestion.id   where gestion_suscriptores.id_suscriptor = '".$_SESSION['suscriptor_id']."' $wherefecha and estado_respuesta = 'Cerrado'  and estado_archivo = '1'", '', '');

	$ar = array("0" => "Baja", "1" => "Media", "2" => "Alta");
?>
<div class="row fullheight">
		<div class="col-md-12">
			<ul class="nav nav-pills m-b-30 " role="tablist" id="tab_navegacion_widgets">
				<?

						$itdt = $id;
						$totd = 1;
						$tots = 1;
						$totc = 1;
				
						$menuactivea = "display:block";
						$menuactiveb = "";
						$menuactivec = "";

						$tabactivea = "active";
						$tabactiveb = "";
						$tabactivec = "";

						if ($totd <= 0) {
							if ($tots > 0) {
								$menuactiveb = "display:block;";
								$tabactiveb = "active";

								$menuactivea = "";
								$tabactivea = "";
								$menuactivec = "";
								$tabactivec = "";

							}elseif ($totc > 0) {
								$menuactivec = "display:block;";
								$tabactivec = "active";

								$menuactivea = "";
								$tabactivea = "";
								$menuactiveb = "";
								$tabactiveb = "";
							}else{

								$menuactivea = "display:block";
								$menuactiveb = "";
								$menuactivec = "";

								$tabactivea = "active";
								$tabactiveb = "";
								$tabactivec = "";

							}
						}
					

				?>
				<li onClick="ActivarTab('tab1', 'buscartab1')" id="buscartab1" role="presentation" class="<?= $tabactivea ?>">
					<a href="#">Expedientes Rechazados / Por Corregir</a>
				</li>
				<li onClick="ActivarTab('tab2', 'buscartab2')" id="buscartab2" role="presentation" class="<?= $tabactiveb ?>">
					<a href="#">Expedientes Activos / En Tramite</a>
				</li>
				<li onClick="ActivarTab('tab3', 'buscartab3')" id="buscartab3" role="presentation" class="<?= $tabactivec ?>">
					<a href="#">Expedientes Completados</a>
				</li>
			</ul>
			<div class="col-md-12 busquedaresultadotab" id="tab1" style="<?= $menuactivea ?>">
			<?

				$i = 0;

				while ($ro2 = $con->FetchAssoc($qerrors)) {
					$i++;
					$c->GetVistaExpedienteDefault($ro2["id"]);
				}

				if ($i == 0) {
					echo "<br><br><div class='alert alert-info' role='alert'>Aún no tienes expedientes registrados <a href='/gestion/nuevo/'>¿Deseas crear uno?</a> </div><br><br>";

				}
			?>
			</div>
			<div class="busquedaresultadotab" id="tab2" style="<?= $menuactiveb ?>">
			<?

				$i = 0;

				while ($ro2 = $con->FetchAssoc($qactive)) {
					$i++;
					$c->GetVistaExpedienteDefault($ro2["id"]);
				}

				if ($i == 0) {
					echo "<br><br><div class='alert alert-info' role='alert'>Aún no tienes expedientes registrados <a href='/gestion/nuevo/'>¿Deseas crear uno?</a> </div><br><br>";

				}
			?>
			</div>
			<div class="busquedaresultadotab" id="tab3" style="<?= $menuactivec ?>">
			<?

				$i = 0;

				while ($ro2 = $con->FetchAssoc($qclosed)) {
					$i++;
					$c->GetVistaExpedienteDefault($ro2["id"]);
				}

				if ($i == 0) {
					echo "<br><br><div class='alert alert-info' role='alert'>Aún no tienes expedientes registrados <a href='/gestion/nuevo/'>¿Deseas crear uno?</a> </div><br><br>";

				}
			?>
			</div>
		</div>
	</div>


	

<script type="text/javascript">
	$(document).ready(function(){
		$(".breadcrumb li").last().addClass("active");
	});

	function ActivarTab(tab, selector){

		$("#buscartab1").removeClass('active');
		$("#buscartab2").removeClass('active');
		$("#buscartab3").removeClass('active');

		$("#tab1").css('display', 'none');
		$("#tab2").css('display', 'none');
		$("#tab3").css('display', 'none');

		$("#"+selector).addClass("active");
		$("#"+tab).css("display", 'block');

	}
</script>
<style type="text/css">
	
	.busquedaresultadotab{
		border: 1px solid #CCC;
	    min-height: 400px;
	    border-top: none;
	    margin-top: -1px;
	    display: none;
	    padding: 20px;
	}

	#tab_navegacion_widgets.nav>li>a {
	    position: relative;
	    display: block;
	    padding: 10px 15px;
	}
	#tab_navegacion_widgets.nav>li>a:hover {
		color:#FFF;
	}


</style>
