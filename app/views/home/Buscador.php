<link rel='stylesheet' type='text/css' href='<?= ASSETS ?>/styles/agenda.css'/>
<div id="tools-content">
	<div class="opc-folder blue">
		<div class="ico-content-ps">
			<div class="icon white_contacto search_icon"></div>
			<div class="text-folder">Resultados de busqueda: "<?= $attr; ?>"</div>
		</div>
		<div class="header-agenda">
			
		</div>
	</div>
</div>
<div class="container">
	<div id="folders-content">
		<div id="folders-list-content">
			<div class="contact-list_main_2">
				



	<div class="row autoheight">
		<div class="col-md-12 breadcrumb_menu">
		</div>
	</div>
	<div class="row fullheight">
		<div class="col-md-12">
			<ul class="nav nav-tabs">
				<?

					if ($_SESSION['suscriptor_id'] == "") {
						# code...
						$itdt = $attr;
						/*
						$querytd = $PDO->Query('select count(*) as t from documentos where nombre like "%'.$itdt.'%"');
						$rtd = $querytd['data'];
						foreach ($rtd as $ftd) {
							$totd = $ftd['t'];
						}

						$queryts = $PDO->Query('select count(*) as t from suscriptores where nombre like "%'.$itdt.'%" or identificacion = "'.$itdt.'" ');
						$rts = $queryts['data'];
						foreach ($rts as $fts) {
							$tots = $fts['t'];
						}

						$querytc = $PDO->Query('select count(*) as t from carpetas where nombre like "%'.$itdt.'%"');
						$rtc = $querytc['data'];
						foreach ($rtc as $ftc) {
							$totc = $ftc['t'];
						}
						*/
						$totd = 3;
						$tots = 5;
						$totc = 0;

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
					}

				?>
				<li onClick="ActivarTab('tabdocumentos', 'buscardocumentos')" id="buscardocumentos" role="presentation" class="<?= $tabactivea ?>"><a href="#">MENU TIPO A - (<?= $totd ?> Resultados encontados)</a></li>
				<li <?= $disp; ?> onClick="ActivarTab('tabsuscriptores', 'buscarsuscriptores')" id="buscarsuscriptores" role="presentation" class="<?= $tabactiveb ?>"><a href="#">MENU TIPO B - (<?= $tots ?> Resultados encontrados)</a></li>
				<li <?= $disp; ?> onClick="ActivarTab('tabcarpetas', 'buscarcarpetas')" id="buscarcarpetas" role="presentation" class="<?= $tabactivec ?>"><a href="#">MENU TIPO C (<?= $totc ?> Resultados encontrados)</a></li>
			</ul>
			<div class="col-md-12 busquedaresultadotab" id="tabdocumentos" style="<?= $menuactivea ?>">
				RESULTADOS DE CONSULTA TIPO A
			</div>
			<div class="busquedaresultadotab" id="tabsuscriptores" style="<?= $menuactiveb ?>">
				RESULTADOS DE CONSULTA TIPO B
			</div>
			<div class="busquedaresultadotab" id="tabcarpetas" style="<?= $menuactivec ?>">
				RESULTADOS DE CONSULTA TIPO C
			</div>
		</div>
	</div>
</div>


<script type="text/javascript">
	$(document).ready(function(){
		$(".breadcrumb li").last().addClass("active");
	});

	function ActivarTab(tab, selector){

		$("#buscardocumentos").removeClass('active');
		$("#buscarsuscriptores").removeClass('active');
		$("#buscarcarpetas").removeClass('active');

		$("#tabdocumentos").css('display', 'none');
		$("#tabsuscriptores").css('display', 'none');
		$("#tabcarpetas").css('display', 'none');

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

</style>









		</div>
	</div>
</div>

<style type="text/css">
	
	.title_rad{
		float:left;
		font-weight: bold;
		font-size:16px;
		line-height: 20px;
		margin-bottom: 10px;
	}

	.alt_rad{
		float:left;
		font-size:14px;
		line-height: 20px;
		margin-bottom: 10px;
	}

	.title2{
		height: 30px;
		line-height: 30px;
	}
	.width60{ width:57%; float:left; text-align: left }
	.width50{ width:47%; float:left; text-align: left }
	.width30{ width:27%; float:left; text-align: left }
	.width40{ width:37%; float:left; text-align: left }
	.width25{ width:22%; float:left; text-align: left }

	.search_result{
		padding: 30px;
	}
	.contact-list_main_2{
		padding:20px;
	}
</style>
