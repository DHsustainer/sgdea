<?
global $c;
?>
<script type="text/javascript">
  $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip(); 
        $('[data-toggle="popover"]').popover()
  });
</script>
<ul class="nav nav-pills m-b-20 " role="tablist" id="tab_navegacion_widgets">
<?

	$itdt = $id;
	$totd = 1;
	$tots = 1;
	$totc = 1;

	$menuactivea = "display:block";
	$menuactiveb = "display:none";
	$menuactivec = "";

	$tabactivea = "active";
	$tabactiveb = "";
	$tabactivec = "";


	$nsp = $con->Query("select count(*) as t from gestion_transferencias  inner join gestion on gestion.id = gestion_transferencias.gestion_id where user_transfiere = '".$_SESSION['usuario']."' and gestion_transferencias.estado = '0'");
    $nspr = $con->FetchAssoc($nsp); 

	$nspx = $con->Query("select count(*) as t from gestion_transferencias  inner join gestion on gestion.id = gestion_transferencias.gestion_id where user_transfiere = '".$_SESSION['usuario']."' and  gestion_transferencias.estado = '2'");
    $nsprx = $con->FetchAssoc($nspx); 

    $nsr = $con->Query("select count(*) as t from gestion_transferencias  inner join gestion on gestion.id = gestion_transferencias.gestion_id where user_recibe = '".$_SESSION['user_ai']."' and gestion_transferencias.estado = '0'");
    $nsrr = $con->FetchAssoc($nsr);

	$object = new MGestion_transferencias;	
	// CARGANDO LLAMANDO LA FUNCION LSITAR LIBROS DEL MODELO (FUNCION QUE TRAE DE LA BASE DE DATOS EL LISTADO DE LIBROS
	// DE NO RECIBIR PARAMETROS ESTA FUNCION TRAE EL LISTADO COMPLETO DE LIBROS
	$query = $object->ListarGestion_transferencias("WHERE user_recibe = '".$_SESSION['user_ai']."' and estado = '0'", "order by id DESC");	 

	$i = 0; 	
	$y = $query;
	$t = $con->NumRows($y);

?>
	<li <?= $c->Ayuda('167', 'tog') ?> onClick="ActivarTab('tab1', 'buscartab1')" id="buscartab1" role="presentation" class="<?= $tabactivea ?>"><a href="#">Transferencias Recibidas (<?= $nsrr['t'] ?>)</a></li>
	<li <?= $c->Ayuda('168', 'tog') ?> onClick="ActivarTab('tab2', 'buscartab2')" id="buscartab2" role="presentation" class="<?= $tabactiveb ?>"><a href="#">Transferencias Enviadas (<?= $nspr['t'] ?>)</a></li>
	<li <?= $c->Ayuda('168', 'tog') ?> onClick="ActivarTab('tab3', 'buscartab3')" id="buscartab3" role="presentation" class="<?= $tabactivec ?>"><a href="#">Transferencias Rechazadas (<?= $nsprx['t'] ?>)</a></li>
</ul>
<div id="tab1" style="<?= $menuactivea ?>">
	<div class="row m-b-20">
		<div class="col-md-6">
		</div>
		<div class="col-md-6">
			<input type="hidden" id="dependencia_destino" value="<?= $_SESSION['area_principal'] ?>">
			<button class="btn btn-info pull-right" onclick='OpenWindow("/gestion_transferencias/historial/2/");' <?= $c->ayuda('29', 'tog') ?> >
				<span class="fa fa-history"></span> Historial de Transferencias
			</button>
		</div>
	</div>
	<div class="list-group">
<?
	while($row = $con->FetchAssoc($query)){
		$i++;

		$us = new MUsuarios;
		$us->createUsuarios("user_id", $row['user_transfiere']);
		$j++;
		$path = "";

		$g = new Mgestion;
		$g->CreateGestion("id", $row['gestion_id']);
		// echo "Select * from gestion_anexos where gestion_id = '".$row['gestion_id']."' and estado = '1' ";
		$q = $con->Query("Select * from gestion_anexos where gestion_id = '".$row['gestion_id']."' and estado = '1' ");


		$bt = '<h4>Documentos Adjuntos al Expediente:</h4>';

		$i = 0;
		$bt .= "<div class='list-group'>";
		while ($rowDocumentos = $con->FetchAssoc($q)) {
			$i++;
			$fname = $rowDocumentos['url'];
			$linkfile = HOMEDIR.DS."app/archivos_uploads/gestion/".$g->GetId().trim("/anexos/ ").$fname;
			$ext = end(explode(".", $fname));
				$bt .= "<div class='list-group-item' style='cursor:pointer'  onclick='AbrirDocumento(\"".$linkfile."\",\"google\",\"".$rowDocumentos["nombre"]."\", \"4\", \"".$rowDocumentos["id"]."\")'>".$rowDocumentos["nombre"]."</div>";
			// $bt .= "<a href='/app/plugins/descargar.php?f=".$linkfile."&tf=".$rowDocumentos['nombre']."&format=pdf&g=".$g->GetId()."' target='_blank' class='list-group-item'>".$rowDocumentos['nombre']."</a>";
		}
		if ($i == 0) {
			$bt .= "<div class='alert alert-info'>No se encontraron documentos publicados</div>";
		}
			
		$path .= '<div class="col-md-12" style="padding-bottom: 20px !important">'.$bt.'</div>';

		echo "<div id='pp".$row['id']."'>";

				$path .= '
				<div class="col-md-4">
				 	<h5><b>Transferido por:</b></h5><h5>
					'.$us->GetP_nombre().' '.$us->GetP_apellido().' '.$f->nicetime($row['fecha_transferencia']).' </h5>
				</div>
				<div class="col-md-3 p-t-20 pull-right">
					<input type="hidden" id="root_val_'.$row['id'].'" value="'.$g->GetId_dependencia_raiz().'" >
					<button type="button" class="btn btn-danger " onclick="RechazarSolicitud(\''.$row['id'].'\')"  '.$c->ayuda('31', 'tog').'>
						<i class="fa fa-times"></i> 
						Rechazar Transferencia
					</button>
				</div>
				<div class="col-md-3 p-t-20 pull-right">
					<button type="button" class="btn btn-info  " onclick="AceptarSolicitud(\''.$row['id'].'\')"  '.$c->ayuda('30', 'tog').'>
						<i class="fa fa-check"></i> 
						Aceptar Transferencia
					</button>
				</div>';		


		echo $c->GetVistaAmple($row['gestion_id'], $path);
		echo "</div>";
		
	}
?>			
	<?php if ($i == "0"): ?>
			<div class="alert alert-info" role="alert">Enhorabuena!, no tienes solicitudes entrantes pendientes</div>
	<?php endif ?>		
	</div>
</div>
<?
	$enviadas = new MGestion_transferencias;
	$consulta = $enviadas->ListarGestion_transferencias("WHERE user_transfiere = '".$_SESSION['usuario']."' and estado = '0' ");
	$j = 0;
	
	$y = $consulta;
	$t = $con->NumRows($y);
?>
<div id="tab2" style="<?= $menuactiveb ?>">
	<div class="row m-b-20">
		<div class="col-md-6">
			<h4 ><?= $t ?> Resultados Encontrados.</h4>
		</div>
		<div class="col-md-6">
			<input type="hidden" id="dependencia_destino" value="<?= $_SESSION['area_principal'] ?>">
			<button class="btn btn-info pull-right" onclick='OpenWindow("/gestion_transferencias/historial/1/");' <?= $c->ayuda('29', 'tog') ?> >
				<span class="fa fa-history"></span> Historial de Transferencias
			</button>
		</div>
	</div>
	<div class="list-group">
<?
		
	while ($rx = $con->FetchAssoc($consulta)) {
		$u = new MUsuarios;
		$u->createUsuarios("a_i", $rx['user_recibe']);
		$j++;
		$path = "";
		$xpath = "";
		echo "<div id='r".$rx['id']."'>";

		if ($rx['estado'] == "2") {
			$xpath = '	<div class="col-md-12">
						 	<h5><b>Rechazado Por:</b> </h5>
							<h5>'.$rx['observaciona'].' el '.$rx['fecha_aceptacion'].'</h5>
						</div>';
		}

		$path .= '
				<div class="col-md-4">
				 	<h5><b>Transferido a:</b> </h5>
					<h5>'.$u->GetP_nombre().' '.$u->GetP_apellido().' </h5>
				</div>
				<div class="col-md-4">
					<h5><b>Fecha de Transferencia:</b> <br></h5>
					<h5>'.$rx['fecha_transferencia'].' </h5>
				</div>
				<div class="col-md-4">
					<button type="button" class="btn btn-danger btn-circle btn-lg  m-r-20 pull-right " onclick="EliminarGestion_transferencias(\''.$rx['id'].'\')"  '.$c->ayuda('32', 'tog').'>
						<i class="fa fa-times"></i> 
					</button>
				</div>';

		echo $c->GetVistaAmple($rx['gestion_id'], $path.$xpath);
		echo "</div>";
	}
?>
	</div>
<?
		if ($j == "0"){
			echo '<div class="alert alert-info" role="alert">Enhorabuena!, no tienes Transferencias enviadas</div>';
		}
?>
</div>


<?
	$enviadas = new MGestion_transferencias;
	$consulta = $enviadas->ListarGestion_transferencias("WHERE user_transfiere = '".$_SESSION['usuario']."' and estado = '2' ");
	$j = 0;
	
	$y = $consulta;
	$t = $con->NumRows($y);
?>
<div id="tab3" style="<?= $menuactiveb ?>">
	<div class="row m-b-20">
		<div class="col-md-6">
			<h4 ><?= $t ?> Resultados Encontrados.</h4>
		</div>
		<div class="col-md-6">
			<input type="hidden" id="dependencia_destino" value="<?= $_SESSION['area_principal'] ?>">
			<button class="btn btn-info pull-right" onclick='OpenWindow("/gestion_transferencias/historial/1/");' <?= $c->ayuda('29', 'tog') ?> >
				<span class="fa fa-history"></span> Historial de Transferencias
			</button>
		</div>
	</div>
	<div class="list-group">
<?
		
	while ($rx = $con->FetchAssoc($consulta)) {
		$u = new MUsuarios;
		$u->createUsuarios("a_i", $rx['user_recibe']);
		$j++;
		$path = "";
		$xpath = "";
		echo "<div id='r".$rx['id']."'>";

		if ($rx['estado'] == "2") {
			$xpath = '	<div class="col-md-12">
						 	<h5><b>Rechazado Por:</b> </h5>
							<h5>'.$rx['observaciona'].' el '.$rx['fecha_aceptacion'].'</h5>
						</div>';
		}

		$path .= '
				<div class="col-md-4">
				 	<h5><b>Transferido a:</b> </h5>
					<h5>'.$u->GetP_nombre().' '.$u->GetP_apellido().' </h5>
				</div>
				<div class="col-md-4">
					<h5><b>Fecha de Transferencia:</b> <br></h5>
					<h5>'.$rx['fecha_transferencia'].' </h5>
				</div>
				<div class="col-md-4">
					<button type="button" class="btn btn-danger btn-circle btn-lg  m-r-20 pull-right " onclick="EliminarGestion_transferencias(\''.$rx['id'].'\')"  '.$c->ayuda('32', 'tog').'>
						<i class="fa fa-times"></i> 
					</button>
				</div>';

		echo $c->GetVistaAmple($rx['gestion_id'], $path.$xpath);
		echo "</div>";
	}
?>
	</div>
<?
		if ($j == "0"){
			echo '<div class="alert alert-info" role="alert">Enhorabuena!, no tienes Transferencias enviadas</div>';
		}
?>
</div>



	
<script type="text/javascript">
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip(); 
        $('[data-toggle="popover"]').popover()
    });
</script>
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

</style>

<script>


function EliminarGestion_transferencias(id){
	if(confirm('Esta seguro desea eliminar esta solicitud de transferencia')){
		var URL = '/gestion_transferencias/eliminar/'+id+'/';
		$.ajax({
			type: 'POST',
			url: URL,
			success: function(msg){
				alert(msg);
				$('#r'+id).remove();
			}
		});
	}
	
}

function RechazarSolicitud(id){
	if(confirm('Esta seguro desea Rechazar esta solicitud de transferencia')){
		t = prompt("Escriba porque desea rechazar esta solicitud");
		var URL = '/gestion_transferencias/rechazar/'+id+'/';
		var st = "observaciona="+t
		$.ajax({
			type: 'POST',
			url: URL,
			data: st,
			success: function(msg){
				alert(msg);
				$('#pp'+id).remove();
			}
		});
	}
}	

function AceptarSolicitud(id){
	if(confirm('Esta seguro desea Aceptar esta solicitud de transferencia')){
			area     = $("#dependencia_destino").val();

			var URL = '/gestion_transferencias/aceptarsolicitud/'+id+'/';
			var st = "area="+area;

			$.ajax({
				type: 'POST',
				url: URL,
				data: st,
				success: function(msg){
					alert("Solicitud Aceptada!");
					$("#salidadedato").html(msg);
					//$('#pp'+id).remove();
				}
			});
	}
}
</script>		
