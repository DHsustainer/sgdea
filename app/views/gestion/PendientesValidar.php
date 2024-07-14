<script type="text/javascript">
	$(document).ready(function(){
		$(".breadcrumb li").last().addClass("active");
        $('[data-toggle="tooltip"]').tooltip(); 
        $('[data-toggle="popover"]').popover()
	});
</script>

<?    
    if ($_SESSION['ventanilla'] == "1") {
?>    
		<div class="col-md-12 m-b-20">
			<a href="/gestion/reparto/" target="_blank" class="btn btn-primary btn-lg pull-right"  <?= $c->Ayuda("94c", 'tog') ?> >Raparto Dinamico</a>
		</div>
<?
    }
?>
		<ul class="nav nav-pills m-b-30 " role="tablist" id="tab_navegacion_widgets">
<?
    #echo "select count(*) as t, tipo_documento from gestion WHERE estado_archivo = '1' and estado_respuesta in ('Pendiente', 'En Espera Correccion')' group by tipo_documento";
			$qx = $con->Query ("select count(*) as t, tipo_documento from gestion WHERE estado_archivo = '1'  and rweb = '1' and estado_respuesta in ('Pendiente', 'En Espera Correccion') group by tipo_documento");
			$i = 0;
			while ($row = $con->FetchAssoc($qx)) {
				$i++;
				$ac = "";
				if ($i == "1") {
					$ac = "active";
				}
				$dep = new MDependencias;
				$dep->CreateDependencias("id", $row['tipo_documento']);
				echo '<li onClick="ActivarTab(\'tab'.$row['tipo_documento'].'\', \'buscartab'.$row['tipo_documento'].'\')"  id="buscartab'.$row['tipo_documento'].'" role="presentation" class="'.$ac.' buscartab" '.$c->Ayuda("93", 'tog') .'>
				<a href="#">'.$dep->GetNombre().' - ('.$row['t'].')</a>
						</li>';
			}
?>
		</ul>
<?
					$qx = $con->Query ("select count(*) as t, tipo_documento from gestion WHERE estado_archivo = '1'  and rweb = '1' and estado_respuesta in ('Pendiente', 'En Espera Correccion') group by tipo_documento");

					$k = 0;
					while ($r = $con->FetchAssoc($qx)) {
						$k++;
						$ac = "";
						if ($k == "1") {
							$ac = "display:block";
						}
						$dep = new MDependencias;
						$dep->CreateDependencias("id", $r['tipo_documento']);

					echo '<div class="busquedaresultadotab tab" id="tab'.$r['tipo_documento'].'" style="'.$ac.'">';
?>


						<div>
						  <!-- Nav tabs -->

						  <ul class="nav customtab nav-tabs" role="tablist" id="list<?= $r['tipo_documento'] ?>">
<?
	$query = $object->ListarGestion("WHERE tipo_documento = ".$r['tipo_documento']." and estado_archivo = '1' and rweb = '1' and estado_respuesta = 'Pendiente'");

	$p1 = $con->NumRows($query);

	$query = $object->ListarGestion("WHERE tipo_documento = ".$r['tipo_documento']." and estado_archivo = '1' and  rweb = '1' and estado_respuesta = 'En Espera Correccion'");	 

	$p2 = $con->NumRows($query);
?>
						    <li role="presentation" class="active buscartab"  <?= $c->Ayuda("91", 'tog') ?>>
						    	<a href="#home<?= $r['tipo_documento'] ?>" aria-controls="home<?= $r['tipo_documento'] ?>" role="tab" data-toggle="tab" style="padding: 10px 15px;">Solicitudes Nuevas - Sin Revisar (<?= $p1 ?> Expediente/s )</a>
						    </li>
						    <li role="presentation"  <?= $c->Ayuda("92", 'tog') ?>>
						    	<a href="#profile<?= $r['tipo_documento'] ?>" aria-controls="profile<?= $r['tipo_documento'] ?>" role="tab" data-toggle="tab" style="padding: 10px 15px;">Solicitudes Revisadas (Aun sin Iniciar) (<?= $p2 ?> Expediente/s )</a>
						    </li>
						  </ul>

						  <!-- Tab panes -->
						  <div class="tab-content">
						    <div role="tabpanel" class="tab-pane active" id="home<?= $r['tipo_documento'] ?>">
						    	
<?
	$query = $object->ListarGestion("WHERE tipo_documento = ".$r['tipo_documento']." and estado_archivo = '1' and  rweb = '1' and estado_respuesta = 'Pendiente'");	 
	$i = 0; 	
	echo '<div class="list-group">';
	while($row = $con->FetchAssoc($query)){
		$i++;
		$j++;
				
		$q = $con->Query("Select * from gestion_anexos where gestion_id = '".$row['id']."' and checked = '-1' ");

		while ($col = $con->FetchAssoc($q)) {
			$tit = $col["nombre"];
			$type=explode('.', strtolower($col[url]));
			$idb = $col["id"];
			break;
		}
		$queryforms = $con->Query("select grupo_id from meta_big_data where type_id = '".$row['id']."' and tipo_form = '1' group by grupo_id");
		while ($rowform = $con->FetchAssoc($queryforms)) {
            $grupo_id = $rowform['grupo_id'];
        }

		$bt = "	<button class='btn btn-primary btn-lg' onClick='osxDocumentos(\"".$row['id']."\", \"".$tit."\", \"".$idb."\")'>Ver Documentos</button> 
				<button class='btn btn-primary btn-lg' onClick='OpenWindow(\"/meta_big_data/ver/".$grupo_id."/\")'>Ver Formulario</button>";
			
		$path = '';
		$path .= '<div class="col-md-12" style="padding-bottom: 20px !important">'.$bt.'</div>
				<div class="col-md-4">
				 	<label>'.CAMPOAREADETRABAJO.': </label>
				 	<select name="dependencia_destino_'.$row['id'].'" id="dependencia_destino_'.$row['id'].'" class="form-control">
						<option value="Seleccione una Serie">Selecciona un Area</option>';

				$sarea = $con->Query("select * from areas");
				while ($rareas = $con->FetchAssoc($sarea)) {
					$sel = "";
					if ($row['dependencia_destino'] == $rareas['id']) {
						$sel = "selected = 'selected'";
					}
					$path .= '<option value="'.$rareas['id'].'" '.$sel.'>'.$rareas['nombre'].'</option>';
				}		
		$path .=	'</select><br>	
					<label>'.RESPONSABLE.': </label>
					<select name="nombre_destino_'.$row['id'].'" id="nombre_destino_'.$row['id'].'" class="form-control">
						<option value="Seleccione una Sub-Serie">Selecciona una Usuario</option>
					</select>
				</div>
				<div class="col-md-4">
					<label>'.SERIE.': </label>
					<select name="id_dependencia_raiz_'.$row['id'].'" id="id_dependencia_raiz_'.$row['id'].'" class="form-control">
						<option value="Seleccione una Serie">Selecciona una Serie</option>
					</select><br>
					<label>'.SUBSERIE.': </label>
					<select name="tipo_documento_'.$row['id'].'" id="tipo_documento_'.$row['id'].'" class="form-control">
						<option value="Seleccione una Sub-Serie">Selecciona una Sub Serie</option>
					</select>
				</div>
				<div class="col-md-4 p-t-20">
					<button type="button" class="btn btn-danger btn-circle   m-r-10 pull-right " onclick="RechazarSolicitud(\''.$row['id'].'\')"  '.$c->ayuda('27', 'tog').'>
						<i class="fa fa-times"></i> 
					</button>
					<button type="button" class="btn btn-success btn-circle    m-r-10 pull-right " onclick="PendienteSolicitud(\''.$row['id'].'\')" '.$c->ayuda('28', 'tog').'>
						<i class="fa fa-clock-o"></i> 
					</button>
					<button type="button" class="btn btn-info btn-circle  m-r-10  pull-right  " onclick="AceptarSolicitud(\''.$row['id'].'\')"  '.$c->ayuda('26', 'tog').'>
						<i class="fa fa-check"></i> 
					</button>
				</div>';


		
		$elemento = "";
		$elemento = $c->GetVistaExpedienteValidarNuevo($row['id'], $path);

		echo "	<div class='row'>";
		echo 		"<div class='col-md-12' style=''>".$elemento."</div>
				</div>";

		echo '
				<script>
				dependencia_item("dependencia_destino_'.$row['id'].'","nombre_destino_'.$row['id'].'", "/usuarios/ListadoUsuariosAreasOficina3New/"+$("#oficina").val());
					
		            dependencia_item(\'dependencia_destino_'.$row['id'].'\',\'id_dependencia_raiz_'.$row['id'].'\',\'/areas_dependencias/GetSeriesArea/\');
		            setTimeout(function(){
						if($("#id_dependencia_raiz_'.$row['id'].'").val() != "" && $("#id_dependencia_raiz_'.$row['id'].'").val()  != "Seleccione una Serie"){
							$("#id_dependencia_raiz_'.$row['id'].'").change();
						}

					}, 1000);

				setTimeout(function(){
					$("#id_dependencia_raiz_'.$row['id'].' option[value=\''.$row['id_dependencia_raiz'].'\']").attr("selected", true);
					$("#tipo_documento_'.$row['id'].' option[value=\''.$row['tipo_documento'].'\']").attr("selected", true);
					$("#nombre_destino_'.$row['id'].' option[value=\''.$row['nombre_destino'].'\']").attr("selected", true);
				}, 2000);

				$("#dependencia_destino_'.$row['id'].'").change(function(){
					dependencia_item("dependencia_destino_'.$row['id'].'","nombre_destino_'.$row['id'].'", "/usuarios/ListadoUsuariosAreasOficina3New/"+$("#oficina").val());
					
		            dependencia_item(\'dependencia_destino_'.$row['id'].'\',\'id_dependencia_raiz_'.$row['id'].'\',\'/areas_dependencias/GetSeriesArea/\');
		            setTimeout(function(){
						if($("#id_dependencia_raiz_'.$row['id'].'").val() != "" && $("#id_dependencia_raiz_'.$row['id'].'").val()  != "Seleccione una Serie"){
							$("#id_dependencia_raiz_'.$row['id'].'").change();
						}
					}, 1000);
				});

				$("#id_dependencia_raiz_'.$row['id'].'").change(function(){
					dependencia_item2("dependencia_destino_'.$row['id'].'", "id_dependencia_raiz_'.$row['id'].'","tipo_documento_'.$row['id'].'", "/areas_dependencias/GetSubSeriesArea/");
					setTimeout(function(){
						if($("#tipo_documento_'.$row['id'].'").val() != "" && $("#tipo_documento_'.$row['id'].'").val()  != "Seleccione una Sub-Serie"){
							$("#tipo_documento_'.$row['id'].'").change();
						}
					}, 1000);
				});

				</script>';
	}
?>	
	</div>		
	<?php if ($i == "0"): ?>
			<div class="alert alert-info" role="alert">Enhorabuena!, no tienes solicitudes entrantes pendientes</div>
	<?php endif ?>

    </div>
    <div role="tabpanel" class="tab-pane" id="profile<?= $r['tipo_documento'] ?>">

<?
	$query = $object->ListarGestion("WHERE tipo_documento = ".$r['tipo_documento']." and estado_archivo = '1' and  rweb = '1' and estado_respuesta = 'En Espera Correccion'");	 
	$i = 0; 	
	echo '<div class="list-group">';
	while($row = $con->FetchAssoc($query)){
		$i++;
		$j++;
				
		$q = $con->Query("Select * from gestion_anexos where gestion_id = '".$row['id']."' ");

		while ($col = $con->FetchAssoc($q)) {
			$tit = $col["nombre"];
			$type=explode('.', strtolower($col[url]));
			$idb = $col["id"];
			break;
		}
		$queryforms = $con->Query("select grupo_id from meta_big_data where type_id = '".$row['id']."' and tipo_form = '1' group by grupo_id");
		while ($rowform = $con->FetchAssoc($queryforms)) {
            $grupo_id = $rowform['grupo_id'];
        }

		$bt = "	<button class='btn btn-primary btn-lg' onClick='osxDocumentos(\"".$row['id']."\", \"".$tit."\", \"".$idb."\")'>Ver Documentos</button> 
				<button class='btn btn-primary btn-lg' onClick='OpenWindow(\"/meta_big_data/ver/".$grupo_id."/\")'>Ver Formulario</button>";

		$path = '';
		$path .= '<div class="col-md-12" style="padding-bottom: 20px !important">'.$bt.'</div>
				<div class="col-md-4">
					<label>'.CAMPOAREADETRABAJO.': </label>
				 	<select name="dependencia_destino_'.$row['id'].'" id="dependencia_destino_'.$row['id'].'" class="form-control">';

				$sarea = $con->Query("select * from areas");
				
				while ($rareas = $con->FetchAssoc($sarea)) {
					$path .= '<option value="'.$rareas['id'].'">'.$rareas['nombre'].'</option>';
				}		
		$path .=	'</select><br>	
					<label>'.RESPONSABLE.': </label>
					<select name="nombre_destino_'.$row['id'].'" id="nombre_destino_'.$row['id'].'" class="form-control">
						<option value="Seleccione una Sub-Serie">Selecciona una Usuario</option>
					</select>
				</div>
				<div class="col-md-4">
					<label>'.SERIE.': </label>
					<select name="id_dependencia_raiz_'.$row['id'].'" id="id_dependencia_raiz_'.$row['id'].'" class="form-control">
						<option value="Seleccione una Serie">Selecciona una Serie</option>
					</select><br>
					<label>'.SUBSERIE.': </label>
					<select name="tipo_documento_'.$row['id'].'" id="tipo_documento_'.$row['id'].'" class="form-control">
						<option value="Seleccione una Sub-Serie">Selecciona una Sub Serie</option>
					</select>
				</div>
				<div class="col-md-4 p-t-20">
					<button type="button" class="btn btn-danger btn-circle btn-lg  m-r-20 pull-right " onclick="RechazarSolicitud(\''.$row['id'].'\')"  '.$c->ayuda('27', 'tog').'>
						<i class="fa fa-times"></i> 
					</button>
					<button type="button" class="btn btn-info btn-circle btn-lg m-r-20  pull-right  " onclick="AceptarSolicitud(\''.$row['id'].'\')"  '.$c->ayuda('26', 'tog').'>
						<i class="fa fa-check"></i> 
					</button>
				</div>';	

		$elemento = "";
		$elemento = $c->GetVistaExpedienteValidarNuevo($row['id'], $path);
		echo "	<div class='row'>";
		echo 		"<div class='col-md-12' style=''>".$elemento."</div>
				</div>";

		echo '
				<script>
				
				$("#dependencia_destino_'.$row['id'].'").change(function(){
					dependencia_item("dependencia_destino_'.$row['id'].'","nombre_destino_'.$row['id'].'", "/usuarios/ListadoUsuariosAreasOficina3New/"+$("#oficina").val());
					
		            dependencia_item(\'dependencia_destino_'.$row['id'].'\',\'id_dependencia_raiz_'.$row['id'].'\',\'/areas_dependencias/GetSeriesArea/\');
		            setTimeout(function(){
						if($("#id_dependencia_raiz_'.$row['id'].'").val() != "" && $("#id_dependencia_raiz_'.$row['id'].'").val()  != "Seleccione una Serie"){
							$("#id_dependencia_raiz_'.$row['id'].'").change();
						}
					}, 1000);
				});

				$("#id_dependencia_raiz_'.$row['id'].'").change(function(){
					dependencia_item2("dependencia_destino_'.$row['id'].'", "id_dependencia_raiz_'.$row['id'].'","tipo_documento_'.$row['id'].'", "/areas_dependencias/GetSubSeriesArea/");
					setTimeout(function(){
						if($("#tipo_documento_'.$row['id'].'").val() != "" && $("#tipo_documento_'.$row['id'].'").val()  != "Seleccione una Sub-Serie"){
							$("#tipo_documento_'.$row['id'].'").change();
						}
					}, 1000);
				});


	            

				</script>';
	}
?>	
	</div>		
	<?php if ($i == "0"): ?>
			<div class="alert alert-info" role="alert">Enhorabuena!, no tienes solicitudes entrantes pendientes</div>
	<?php endif ?>
						    	
						    </div>
						  </div>

						</div>


<?						
		echo '</div>';
	}
?>
				

				
			</div>
		</div>
<input type="hidden" id="oficina" value="<?= $_SESSION['seccional'] ?>">
<div id="salidadedato"></div>
<script type="text/javascript">
	$(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip(); 
        $('[data-toggle="popover"]').popover()
    });
</script>
<script>

function RechazarSolicitud(id){
	if(confirm('Esta seguro desea Rechazar este expediente')){
		t = prompt("Escriba porque desea rechazar esta solicitud");
		var URL = '/gestion/rechazarsolicitud/'+id+'/';
		var st = "observacion2="+t
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

function PendienteSolicitud(id){
	if(confirm('Esta seguro desea marcar este expediente como "En Espera"')){
		t = prompt("Escriba porque desea colocar esta solicitud en espera");
		var URL = '/gestion/esperasolicitud/'+id+'/';
		var st = "observacion2="+t
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
	if(confirm('Esta seguro desea Aceptar esta solicitud de este expediente')){
		area     = $("#dependencia_destino_"+id).val();
		user     = $("#nombre_destino_"+id).val();
		serie    = $("#id_dependencia_raiz_"+id).val();
		subserie = $("#tipo_documento_"+id).val();

		if (serie == "Seleccione una Serie" || subserie == "Seleccione una Sub-Serie") {
			alert("Debe seleccionar una serie y una subserie documental");
		}else{
			
			observacion = prompt("多Desea escribir alguna observacion adicional en el expediente?");
			
			var URL = '/gestion/aceptarsolicitud/'+id+'/';
			var st = "area="+area+"&serie="+serie+"&subserie="+subserie+"&user="+user+"&observacion2="+observacion;

			$.ajax({
				type: 'POST',
				url: URL,
				data: st,
				success: function(msg){
					alert("Solicitud Aceptada!");
					$("#salidadedato").html(msg);
					$('#pp'+id).remove();
				}
			});
		}
	}
}
</script>		

<script type="text/javascript">
	$(document).ready(function(){
		$(".breadcrumb li").last().addClass("active");
	});

	function ActivarTab(tab, selector){

		$(".buscartab").removeClass('active');
		$(".tab").css('display', 'none');

		$("#"+selector).addClass("active");
		$("#"+tab).css("display", 'block');

	}
</script>
<style type="text/css">
	
	.busquedaresultadotab{
	    min-height: 400px;
	    border-top: none;
	    margin-top: -1px;
	    display: none;
	}

	#tab_navegacion_widgets.nav>li>a {
	    position: relative;
	    display: block;
	    padding: 10px 15px;
	}
</style>