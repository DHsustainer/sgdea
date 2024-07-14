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
				<a href="#"><?= TITULOSEGUIMIENTOESTADOS." Hoy"?></a></li>
			<li onClick="ActivarTab('tab2', 'buscartab2')" id="buscartab2" role="presentation" class="<?= $tabactiveb ?>">
				<a href="#"><?= TITULOSEGUIMIENTOESTADOS." Día 1"?></a></li>
			<li onClick="ActivarTab('tab3', 'buscartab3')" id="buscartab3" role="presentation" class="<?= $tabactivec ?>">
				<a href="#"><?= TITULOSEGUIMIENTOESTADOS." Día 2"?></a></li>
			<li onClick="ActivarTab('tab4', 'buscartab4')" id="buscartab4" role="presentation" class="<?= $tabactivec ?>">
				<a href="#"><?= TITULOSEGUIMIENTOESTADOS." Día 3"?></a></li>
		</ul>
		<div class="col-md-12 busquedaresultadotab" id="tab1" style="<?= $menuactivea ?>">
			<?
				$fecha_a = date("Y-m-d");
				$str = "select * from gestion_cambio_estado as gc inner join gestion as g on g.id = gc.id_gestion where gc.estado = '".ESTADOSEGUIMIENTOESTADOS."' and g.estado_respuesta = '".ESTADOSEGUIMIENTOESTADOS."' and gc.fecha = '".$fecha_a."' group by g.id";
				$query = $con->Query($str);
				echo "	<table class='table table-striped' widt='100%'>
							<thead>
								<tr>
									<th>Radicado</th>
									<th>Asunto</th>
								</tr>
							</thead>
							<tbody>";
				$i = 0;
				while ($row = $con->FetchAssoc($query)) {
					$i++;
					echo '	<tr>
								<td>'.$row['radicado'].'</td>
								<td>'.$row['observacion'].'</td>
							</tr>';
				}		
				if($i == 0){
					echo '<div class="alert alert-info">No hay resultados en esta tabla</div>';
				}					
				echo "		</tbody>
						</table>";		
			?>
		</div>
		<div class="busquedaresultadotab" id="tab2" style="<?= $menuactiveb ?>">
			<?
				$fecha = date("Y-m-d");
				$fecha_c = date_create($fecha);//aca le pasas la fecha actual o ala que le queres sumar los dias.
				date_modify($fecha_c, "-1 day");//sumas los dias que te hacen falta.
				$fecha_a = date_format($fecha_c, "Y-m-d");//retornas la fecha en el formato que mas te guste.
				$str = "select * from gestion_cambio_estado as gc inner join gestion as g on g.id = gc.id_gestion where gc.estado = '".ESTADOSEGUIMIENTOESTADOS."' and g.estado_respuesta = '".ESTADOSEGUIMIENTOESTADOS."' and gc.fecha = '".$fecha_a."' group by g.id";
				$query = $con->Query($str);
				echo "	<table class='table table-striped' widt='100%'>
							<thead>
								<tr>
									<th>Radicado</th>
									<th>Asunto</th>
								</tr>
							</thead>
							<tbody>";
				$i = 0;
				while ($row = $con->FetchAssoc($query)) {
					$i++;
					echo '	<tr>
								<td>'.$row['radicado'].'</td>
								<td>'.$row['observacion'].'</td>
							</tr>';
				}		
				if($i == 0){
					echo '<div class="alert alert-info">No hay resultados en esta tabla</div>';
				}					
				echo "		</tbody>
						</table>";	


			?>
		</div>
		<div class="busquedaresultadotab" id="tab3" style="<?= $menuactivec ?>">
			<?
				$fecha = date("Y-m-d");
				$fecha_c = date_create($fecha);//aca le pasas la fecha actual o ala que le queres sumar los dias.
				date_modify($fecha_c, "-2 day");//sumas los dias que te hacen falta.
				$fecha_a = date_format($fecha_c, "Y-m-d");//retornas la fecha en el formato que mas te guste.
				$str = "select * from gestion_cambio_estado as gc inner join gestion as g on g.id = gc.id_gestion where gc.estado = '".ESTADOSEGUIMIENTOESTADOS."' and g.estado_respuesta = '".ESTADOSEGUIMIENTOESTADOS."' and gc.fecha = '".$fecha_a."' group by g.id";
				$query = $con->Query($str);
				echo "	<table class='table table-striped' widt='100%'>
							<thead>
								<tr>
									<th>Radicado</th>
									<th>Asunto</th>
								</tr>
							</thead>
							<tbody>";
				$i = 0;
				while ($row = $con->FetchAssoc($query)) {
					$i++;
					echo '	<tr>
								<td>'.$row['radicado'].'</td>
								<td>'.$row['observacion'].'</td>
							</tr>';
				}		
				if($i == 0){
					echo '<div class="alert alert-info">No hay resultados en esta tabla</div>';
				}					
				echo "		</tbody>
						</table>";	
			?>
		</div>
		<div class="busquedaresultadotab" id="tab4" style="<?= $menuactivec ?>">
			<?
				$fecha = date("Y-m-d");
				$fecha_c = date_create($fecha);//aca le pasas la fecha actual o ala que le queres sumar los dias.
				date_modify($fecha_c, "-2 day");//sumas los dias que te hacen falta.
				$fecha_a = date_format($fecha_c, "Y-m-d");//retornas la fecha en el formato que mas te guste.
				$str = "select * from gestion_cambio_estado as gc inner join gestion as g on g.id = gc.id_gestion where gc.estado = '".ESTADOSEGUIMIENTOESTADOS."' and g.estado_respuesta = '".ESTADOSEGUIMIENTOESTADOS."' and gc.fecha = '".$fecha_a."' group by g.id";
				$query = $con->Query($str);
				echo "	<table class='table table-striped' widt='100%'>
							<thead>
								<tr>
									<th>Radicado</th>
									<th>Asunto</th>
								</tr>
							</thead>
							<tbody>";
				$i = 0;
				while ($row = $con->FetchAssoc($query)) {
					$i++;
					echo '	<tr>
								<td>'.$row['radicado'].'</td>
								<td>'.$row['observacion'].'</td>
							</tr>';
				}		
				if($i == 0){
					echo '<div class="alert alert-info">No hay resultados en esta tabla</div>';
				}					
				echo "		</tbody>
						</table>";	
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
		$("#buscartab4").removeClass('active');

		$("#tab1").css('display', 'none');
		$("#tab2").css('display', 'none');
		$("#tab3").css('display', 'none');
		$("#tab4").css('display', 'none');

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
