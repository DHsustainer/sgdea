<div class="row" style="margin:0px; background-color:#FFF">
	
	<div class="col-md-6" style="padding:20px !important">
		<h2>Transferencias Recibidas</h2>



		
	</div>
	<div class="col-md-6" style="padding:20px !important">
		<h2>Transferencias Enviadas o Rechazadas <button class="btn btn-info" title="Ver Historial de Transferencias" onclick='OpenWindow("/gestion_transferencias/historial/1/");'><span class="fa fa-history"></span></button></h2>
		<br>

		<div class="list-group">
				
<?
		$query = $object->ListarGestion_transferencias("WHERE user_recibe = '$myid' and estado = '0'");	 
		$enviadas = new MGestion_transferencias;
		$consulta = $enviadas->ListarGestion_transferencias("WHERE user_transfiere = '".$_SESSION['usuario']."' and (estado = '0' or estado = '2') ");
		$j = 0;
		
		$y = $consulta;
		$t = $con->NumRows($y);
		echo '<h4>'.$t.' Resultados Encontrados.</h4>';

		while ($rx = $con->FetchAssoc($consulta)) {
			$u = new MUsuarios;
			$u->createUsuarios("a_i", $rx['user_recibe']);
			$j++;
			$path = "";
			$xpath = "";
			echo "<div class='list-group-item' id='r".$rx['id']."'>";

			if ($rx['estado'] == "2") {
				$xpath = '	<div class="col-md-12">
							 	<b>Rechazado Por:</b> <br>
								'.$rx['observaciona'].' el '.$rx['fecha_aceptacion'].'
							</div>';
			}

			$path = '
					<div class="col-md-7">
					 	<b>Transferido a:</b> <br>
						'.$u->GetP_nombre().' '.$u->GetP_apellido().' 
					</div>
					<div class="col-md-4">
						<b>Fecha de Transferencia:</b> <br>
						'.$rx['fecha_transferencia'].' 
					</div>
					<div class="col-md-1">';		

			$path .= "	<br><div onclick='EliminarGestion_transferencias(\"".$rx['id']."\")'>
		                    <div class='btn btn-warning btn-circle mdi mdi-delete' title='Cancelar Solicitud'></div>
		                </div>
					</div>";

			echo $c->GetVistaExpedienteReducida($rx['gestion_id'], $path.$xpath);
			echo "</div>";
		}
?>
		</div>
<?
		if ($j == "0"){
			echo '<div class="alert alert-info" role="alert">Enhorabuena!, no tienes enviadas</div>';
		}
?>
	</div>
</div>
<div id="salidadedato"></div>
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
		serie    = $("#id_dependencia_raiz_"+id).val();
		subserie = $("#tipo_documento_"+id).val();
		if (serie == "Seleccione una Serie" || subserie == "Seleccione una Sub-Serie") {
			alert("Debe seleccionar una serie y una subserie documental");
		}else{

			var URL = '/gestion_transferencias/aceptarsolicitud/'+id+'/';
			var st = "area="+area+"&serie="+serie+"&subserie="+subserie;

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
}
</script>		
