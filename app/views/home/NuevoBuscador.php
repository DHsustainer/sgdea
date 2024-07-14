<div class="row" style="margin:0px; background-color: #FFF; padding:20px;">
	<div class="col-md-12">
		<h3>RESULTADOS DE LA BUSQUEDA "<?= $id ?>"</h3>
	</div>
	<div class="col-md-12">
		<ul class="nav nav-pills m-b-30" id="tab_navegacion_widgets">
			<?
			$pathquery = ' or campot1 like "%'.$id.'%" or campot2 like "%'.$id.'%" or campot3 like "%'.$id.'%" or campot4 like "%'.$id.'%" or campot5 like "%'.$id.'%" or campot6 like "%'.$id.'%" or campot7 like "%'.$id.'%" or campot8 like "%'.$id.'%" or campot9 like "%'.$id.'%" or campot10 like "%'.$id.'%" or campot11 like "%'.$id.'%" or campot12 like "%'.$id.'%" or campot13 like "%'.$id.'%" or campot14 like "%'.$id.'%" or campot15 like "%'.$id.'%" ';
			
			$pathmulti = "";
			if ($_SESSION['MODULES']['multioficina'] == "1") {
				$pathmulti = " and oficina = '".$_SESSION['seccional']."'";
			}

			if ($id != "") {

				$itdt = $id;
		
				$tabactivea = "active";
				$s1w = "";

				
				if ($_SESSION['suscriptor_id'] != "") {
					$s1w = " gestion_suscriptores.id_suscriptor =  '".$_SESSION['suscriptor_id']."' and ";
					$paths = "inner join gestion_suscriptores on gestion_suscriptores.id_gestion = gestion.id";
				}
	
				if ($_SESSION['buscador_global'] == "1") {
					# code...
					$s1 = "select * 
								$paths
								from gestion 
									where 
										".$s1w."
										(num_oficio_respuesta like '%".$id."%' or 
										radicado like '%".$id."%' or 
										observacion like '%".$id."%' or 
										observacion2 like '%".$id."%' or 
										min_rad like '%".$id."%' $pathquery) and estado_archivo != '-99'".$pathmulti;
					$q1 = $con->Query($s1);						
					$totala = $con->NumRows($q1);
					
					$s1w = "";
					/*if ($_SESSION['suscriptor_id'] != "") {
						$s2w = " id in(select id from suscriptores_contactos where id = '".$_SESSION['suscriptor_id']."' union select id from suscriptores_contactos where dependencia = '".$_SESSION['suscriptor_id']."') and ";
					}*/
					$s2 = "select * from 
								suscriptores_contactos 
									where
										".$s2w."
										nombre like '%".$id."%' or 
										identificacion like '%".$id."%'";

					$q2 = $con->Query($s2);						
					$totalb = $con->NumRows($q2);

					if ($_SESSION['suscriptor_id'] == "") {
						$s3 = "select * from 
									gestion_anexos
										where 
											estado = 1 and
											nombre like '%".$id."%'";

						$q3 = $con->Query($s3);
						$totalc = $con->NumRows($q3);
					}
				}else{

					$s1 = "select gestion.id 
								from gestion 
									where 
										gestion.nombre_destino = '".$_SESSION['user_ai']."' and 
										(gestion.num_oficio_respuesta like '%".$id."%' or 
										gestion.radicado like '%".$id."%' or 
										gestion.observacion like '%".$id."%' or 
										gestion.observacion2 like '%".$id."%' or 
										gestion.min_rad like '%".$id."%'  $pathquery) and gestion.estado_archivo != '-99'".$pathmulti;

										/*

										or gestion_compartir.usuario_nuevo = '".$_SESSION['usuario']."' and 
											(gestion.num_oficio_respuesta like '%".$id."%' or 
											gestion.radicado like '%".$id."%' or 
											gestion.observacion like '%".$id."%' or 
											gestion.observacion2 like '%".$id."%' or 
											gestion.min_rad like '%".$id."%') and gestion.estado_archivo != '-99'
											*/
					$q1 = $con->Query($s1);						
					$totala = $con->NumRows($q1);
				}
				$totale = 0;


				$paths = "";
				$s1w = "";
                if ($_SESSION['suscriptor_id'] != "") {
					$s1w = " gestion_suscriptores.id_suscriptor =  '".$_SESSION['suscriptor_id']."' and ";
					$paths = "inner join gestion_suscriptores on gestion_suscriptores.id_gestion = gestion.id";
					
					$s1 = "select * 
								from gestion 
									".$paths."
									where 
										".$s1w."
										(num_oficio_respuesta like '%".$id."%' or 
										radicado like '%".$id."%' or 
										observacion like '%".$id."%' or 
										observacion2 like '%".$id."%' or 
										min_rad like '%".$id."%' $pathquery) and estado_archivo != '-99'".$pathmulti;
					$q1 = $con->Query($s1);						
					$totala = $con->NumRows($q1);
				}
                 #*/
				

			}else{
				
				$totala = 0;
				$totalb = 0;
				$totalc = 0;
				$totale = 0;
				
			}

				
			?>
			<li onClick="ActivarTab('/buscador/nbusquedaexpedientes/<?= urlencode($id) ?>/', 'buscartab1')" id="buscartab1" role="presentation" class="mytab <?= $tabactivea ?>">
				<a href="#">Expedientes Encontrados (<?= $totala ?>)</a>
			</li>
		<?php if ($_SESSION['buscador_global'] == "1"): ?>
				<li onClick="ActivarTab('/buscador/nbusquedasuscriptores/<?= urlencode($id) ?>/', 'buscartab5')" id="buscartab5" role="presentation" class="mytab  <?= ($_SESSION['suscriptor_id'] != "")?"dn":"" ?>"><a href="#">Suscriptores Encontrados (<?= $totalb ?>)</a></li>
				<?php if ($_SESSION['suscriptor_id'] == "") { ?>
				<li onClick="ActivarTab('/buscador/nbusquedadocumentos/<?= urlencode($id) ?>/', 'buscartab3')" id="buscartab3" role="presentation" class="mytab"><a href="#">Documentos (<?= $totalc ?>)</a></li>
				<?php } ?>
		<?php endif ?>
		<!--
			<li onClick="ActivarTab('/buscador/nbusquedametadatos/<?= urlencode($id) ?>/', 'buscartab2')" id="buscartab2" role="presentation" class="mytab"><a href="#">Metadatos (<?= $totalb ?>)</a></li>


			<li onClick="ActivarTab('/buscador/nbusquedadocumentos/<?= urlencode($id) ?>/', 'buscartab3')" id="buscartab3" role="presentation" class="mytab"><a href="#">Documentos (<?= $totalc ?>)</a></li>
		
		-->
			<li onClick="ActivarTab('/buscador/nbusquedajuridica/<?= urlencode($id) ?>/', 'buscartab4')" id="buscartab4" role="presentation" class="mytab"><a href="#">Consulta jurídica</a></li>
	</ul>		


		<!--<div class="col-md-12 busquedaresultadotab" id="tab1">-->
		<div class="col-md-12" id="tab1">
			BUSCANDO...
		</div>
	</div>

</div>


	

<script type="text/javascript">
	$(document).ready(function(){
		$(".breadcrumb li").last().addClass("active");
	});

	function ActivarTab(tab, selector){
		$("#tab1").html("BUSCANDO...");
		$(".mytab").removeClass('active');
		$("#tab1").css('display', 'none');

		$("#"+selector).addClass("active");
		$("#tab1").css("display", 'block');

		var URL = tab;
        $.ajax({
            type: 'POST',
            url: URL,
            success:function(msg){
				$("#tab1").html(msg);
            }
        }); 

	}

	function VerExpedientesS(ids, selector){
		$(".ResultadosExpedientesS").slideUp();
		var URL = "/buscador/sbyid/"+ids+"/";
        $.ajax({
            type: 'POST',
            url: URL,
            success:function(msg){
            	$("#LX"+ids).slideDown();
				$("#LX"+ids).html(msg);
            }
        }); 

	}
</script>
<style type="text/css">
	
	.busquedaresultadotab{
		/*
		*/
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

</style>

<?
	echo "<script>ActivarTab('/buscador/nbusquedaexpedientes/".urlencode($id)."/1/', 'buscartab1')</script>";
	/*if ($id != "") {
		if ($totala > 0) {
			echo "<script>ActivarTab('/buscador/nbusquedaexpedientes/$id/1/', 'buscartab1')</script>";
		}else{

			if ($totalb > 0) {
				echo "<script>ActivarTab('/buscador/nbusquedasuscriptores/$id/', 'buscartab5')</script>";
			}
			if ($totalc > 0) {
				echo "<script>ActivarTab('/buscador/nbusquedadocumentos/$id/', 'buscartab3')</script>";
			}
			if ($totald > 0) {
				echo "<script>ActivarTab('/buscador/nbusquedametadatos/$id/', 'buscartab2')</script>";
			}else{
				echo "<script>ActivarTab('/buscador/nbusquedaexpedientes/$id/1/', 'buscartab1')</script>";
			}

		}
	}else{
		echo "<script>ActivarTab('/buscador/nulled/$id/1/', 'buscartab1')</script>";
	}*/
?>