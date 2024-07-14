<!--
<span style='cursor:pointer'><a href='<?= HOMEDIR.'gestion_anexos_permisos_documentos/listar/' ?>' >Listar gestion_anexos_permisos_documentos</a></span> |
<span style='cursor:pointer'><a href='<?= HOMEDIR.'gestion_anexos_permisos_documentos/nuevo/' ?>' >Crear gestion_anexos_permisos_documentos</a></span>    
<hr>
<div>
	<form id='formbdata' action='<?= HOMEDIR.'gestion_anexos_permisos_documentos'.DS.'buscar'.DS ?>' method='POST'> 
    	<input type='hidden' id='m' name='m' value='gestion_anexos_permisos_documentos' />    
    	<input type='hidden' id='action' name='action' value='buscar' />          
        <input type='text' style='height:25px; width:300px; margin:5px; font-size:19px; color:#5C5C5C' id='id' name='id' value='<?= $_REQUEST['id'] ?>'> <br />Id_documento <input type='radio' id='cn' name='cn' value='id_documento'/>,Usuario_permiso <input type='radio' id='cn' name='cn' value='usuario_permiso'/>,Estado <input type='radio' id='cn' name='cn' value='estado'/>,Fecha_solicitud <input type='radio' id='cn' name='cn' value='fecha_solicitud'/>,Fecha_actualizacion <input type='radio' id='cn' name='cn' value='fecha_actualizacion'/>,Observacion <input type='radio' id='cn' name='cn' value='observacion'/>,Gestion_id <input type='radio' id='cn' name='cn' value='gestion_id'/>,Id_folder <input type='radio' id='cn' name='cn' value='id_folder'/>,   <input type='submit' value='Buscar gestion_anexos_permisos_documentos'>              
	</form>	
</div>-->


	<div class='title right'>Listado de gestion_anexos_permisos_documentos </div>
		<table border='0' cellspacing='0' cellpadding='3' width='100%' class='tabla' id='Tablagestion_anexos_permisos_documentos'>
           	<thead>
				<tr class='encabezado'>
				
					<th class='th_act'>Id_documento</th>
					<th class='th_act'>Usuario_permiso</th>
					<th class='th_act'>Estado</th>
					<th class='th_act'>Fecha_solicitud</th>
					<th class='th_act'>Fecha_actualizacion</th>
					<th class='th_act'>Observacion</th>
					<th class='th_act'>Gestion_id</th>
					<th class='th_act'>Id_folder</th>
					<th></th>
				</tr>
			</thead>

			<tbody>

<?
		while($row = $con->FetchAssoc($query)){
			$l = new MGestion_anexos_permisos_documentos;
			$l->Creategestion_anexos_permisos_documentos('id', $row[id]);
?>						
			<tr id='r<?= $l->GetId() ?>' class='tblresult'> 
				<td><?php echo $l -> GetId_documento(); ?></td> 
				<td><?php echo $l -> GetUsuario_permiso(); ?></td> 
				<td><?php echo $l -> GetEstado(); ?></td> 
				<td><?php echo $l -> GetFecha_solicitud(); ?></td> 
				<td><?php echo $l -> GetFecha_actualizacion(); ?></td> 
				<td><?php echo $l -> GetObservacion(); ?></td> 
				<td><?php echo $l -> GetGestion_id(); ?></td> 
				<td><?php echo $l -> GetId_folder(); ?></td> 
				<td>
	                <div onclick='EditarGestion_anexos_permisos_documentos(<?= $l->GetId() ?>)'>
						<div class='btn btn-info btn-circle' title='editar'></div>
					</div>

					<div onclick='EliminarGestion_anexos_permisos_documentos(<?= $l->GetId() ?>)'>
	                    <div class='btn btn-warning btn-circle mdi mdi-delete' title='eliminar'></div>
	                </div>
		        </td>	       
			</tr>
<?
		}
?>			</tbody>
		</table>
<script>
	$('th').parent().addClass('encabezado');
	$('tr.tblresult:not([th]):even').addClass('par');
	$('tr.tblresult:not([th]):odd').addClass('impar');
 	$('tr.tblresult:not([th])').removeClass('tblresult');		

 
 	$(function() {		
		$('#Tablagestion_anexos_permisos_documentos').tablesorter({sortList:[[0,0]]});
	});	
	

function EliminarGestion_anexos_permisos_documentos(id){
	if(confirm('Esta seguro desea eliminar este gestion_anexos_permisos_documentos')){
		var URL = '<?= HOMEDIR ?>gestion_anexos_permisos_documentos/eliminar/'+id+'/';
		$.ajax({
			type: 'POST',
			url: URL,
			success: function(msg){
				alert(msg);
				if(msg == 'OK!')
					$('#r'+id).slideUp();
			}
		});
	}
	
}	

function EditarGestion_anexos_permisos_documentos(id){
	var URL = '<?= HOMEDIR ?>gestion_anexos_permisos_documentos/editar/'+id+'/';
	$.ajax({
		type: 'POST',
		url: URL,
		success: function(msg){
			$('#divtoshow').html(msg);
		}
	});
}	
</script>		
