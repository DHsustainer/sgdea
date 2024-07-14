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
			<li onClick="ActivarTab('tab1', 'buscartab1')" id="buscartab1" role="presentation" class="<?= $tabactivea ?>"><a href="#">Tab 1 - (<?= $totd ?> Resultados encontados)</a></li>
			<li onClick="ActivarTab('tab2', 'buscartab2')" id="buscartab2" role="presentation" class="<?= $tabactiveb ?>"><a href="#">Tab 2 - (<?= $tots ?> Resultados encontrados)</a></li>
			<li onClick="ActivarTab('tab3', 'buscartab3')" id="buscartab3" role="presentation" class="<?= $tabactivec ?>"><a href="#">Tab 3 - (<?= $totc ?> Resultados encontrados)</a></li>
		</ul>
		<div class="col-md-12 busquedaresultadotab" id="tab1" style="<?= $menuactivea ?>">
			RESULTADOS TAB 1
		</div>
		<div class="busquedaresultadotab" id="tab2" style="<?= $menuactiveb ?>">
			RESULTADOS TAB 2
		</div>
		<div class="busquedaresultadotab" id="tab3" style="<?= $menuactivec ?>">
			RESULTADOS TAB 3
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
