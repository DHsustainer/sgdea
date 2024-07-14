			<div id="tools-content">
				<div class="opc-folder blue">
					<div class="header-agenda">
						<div class="boton-new-proces-blankspace" style="float: left"></div>
						<div id="boton-new-proces" style="float: right">
							<a class="no_link" href="/solicitudes_documentos/nuevo/">
								<div >Crear Solicitud</div>
							</a>
						</div>

						<div class="boton-new-proces-blankspace" style="float: right"></div>
						<div id="boton-new-proces" style="float: right">
							<a class="no_link" href="/solicitudes_documentos/listar/">
								<div  class="active">Solicitudes Pendientes</div>
							</a>
						</div>

					</div>
				</div>
			</div>
			<div id="folders-content">
				<div id="folders-list-content">
					<br>
					<form action="/solicitudes_documentos/buscar/" method="POST">
						<div class='title right'>Buscar Solicitudes</div>
						<div class="row" style="margin-left:0px; margin-top: 0px;">
							<div class="2u 12u(narrower) ">
								<input type="text" name="fechai" id="fechai" style="height:35px;" placeholder="Fecha de inicio" class="datepicker input1_0 form-control important">
							</div>
							<div class="2u 12u(narrower) ">
								<input type="text" name="fechaf" id="fechaf" style="height:35px;" placeholder="Fecha de Corte" class="datepicker input1_0 form-control important">
							</div>
							<div class="2u 12u(narrower) ">
								<select id="filtro" name="filtro" class="input1_0 form-control"  style="height:45px;">
									<option value="1">Solicitudes Nuevas</option>
									<option value="2">Solicitudes Realizadas por mi</option>
									<option value="3">Solicitudes Rechazadas</option>
									<option value="4">Solicitudes Aceptadas</option>
								</select>
							</div>
							<div class="2u 12u(narrower) ">
								<input type="submit" value="Buscar">
							</div>
						</div>
					</form>
					<br>
					<hr>
					<br>
					<div class='title right'>Solicitudes de Documentos</div>
					<table border='0' cellspacing='0' cellpadding='3' width='100%' class='tabla' id='Tablasolicitudes_documentos'>
			           	<thead>
							<tr class='encabezado'>
							
								<th width="170px"class='th_act'>Solicitante</th>
								<th width="120px" class='th_act'>Fecha Solicitud</th>
								<th width="120px" class='th_act'>Compartido Desde</th>
								<th width="120px" class='th_act'>Hasta</th>
								<th width="100px" class='th_act'>Expediente</th>
								<th class='th_act'>Observacion</th>
								<th width="120px" class='th_act'>Estado</th>
								<th width="80px" class='th_act'></th>
							</tr>
						</thead>

						<tbody>

<?
		$estados = array("0" => "Pendiente por Aprobar", "1" => "Compartido", "2" => "Rechazado", "3" => "Vencido");
		while($row = $con->FetchAssoc($query)){
			$l = new MSolicitudes_documentos;
			$l->Createsolicitudes_documentos('id', $row[id]);

			$fecha_solicitud = $l -> GetFecha_solicitud();
			$fecha_respuesta = $l -> GetFecha_respuesta();
			$fecha_caducidad = $l -> GetFecha_caducidad();
			
			$usuarios_s = new MUsuarios;
			$usuarios_s->CreateUsuarios("user_id", $l->GetUsuario_solicita());

			$area = $c->GetDataFromTable("areas", "id", $usuarios_s->GetRegimen(), "nombre", $separador = " ");
			$usuario = $usuarios_s->GetP_nombre()." ".$usuarios_s->GetP_apellido()."<br> ($area)";

			$gestion_id = "NS";
			if ($l->GetGestion_id() != "0") {
				$g = new MGestion;
				$g->CreateGestion("id", $l->GetGestion_id());
				$gestion_id = "<a href='/gestion/ver/".$g->GetId()."/' target='_blank'>".$g->GetMin_rad()."</a>";
			}

			if ($fecha_respuesta == "0000-00-00 00:00:00") {
				$fecha_respuesta = "-";
			}
			
			if ($fecha_caducidad == "0000-00-00") {
				$fecha_caducidad = "-";
			}
?>						
							<tr id='r<?= $l->GetId() ?>' class='tblresult'> 
								<td><?php echo $usuario; ?></td> 
								<td><?php echo $fecha_solicitud; ?></td> 
								<td><?php echo $fecha_respuesta; ?></td> 
								<td><?php echo $fecha_caducidad; ?></td> 
								<td><?php echo $gestion_id; ?></td> 
								<td><?php echo $l -> GetObservacion(); ?></td> 
								<td><?php echo $estados[$l -> GetEstado()]; ?></td> 
								<td>
					                <div style='float:left; margin-right:5px;'>
										<a href="/solicitudes_documentos/editar/<?= $l->GetId() ?>/">
											<div class='btn btn-info btn-circle' title='editar'></div>
										</a>
									</div>

									<div onclick='EliminarSolicitudes_documentos(<?= $l->GetId() ?>)'>
					                    <div class='btn btn-warning btn-circle mdi mdi-delete' title='eliminar'></div>
					                </div>
						        </td>	       
							</tr>
<?
		}
?>			
						</tbody>
					</table>
				</div>
			</div>
<script>
	$(document).ready(function() {
		$('.datepicker').datepicker({
			dateFormat: 'yy-mm-dd',
			monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio', 'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
			dayNames: ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'], // For formatting
			dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'], // For formatting
			dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sa'] // Column headings for days starting at Sunday				
		});
	});	

	$('th').parent().addClass('encabezado');
	$('tr.tblresult:not([th]):even').addClass('par');
	$('tr.tblresult:not([th]):odd').addClass('impar');
 	$('tr.tblresult:not([th])').removeClass('tblresult');		

 	
function EliminarSolicitudes_documentos(id){
	if(confirm('¿Esta Seguro Desea Rechazar esta Solicitud?')){
		var cn = prompt("Escriba el motivo del rechazo a esta solicitud")
		var URL = '/solicitudes_documentos/eliminar/'+id+'/'+cn+'/';
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

function EditarSolicitudes_documentos(id){
	var URL = '<?= HOMEDIR ?>solicitudes_documentos/editar/'+id+'/';
	$.ajax({
		type: 'POST',
		url: URL,
		success: function(msg){
			$('#divtoshow').html(msg);
		}
	});
}	
</script>		
