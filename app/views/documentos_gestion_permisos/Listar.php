<!--
<span style='cursor:pointer'><a href='<?= HOMEDIR.'documentos_gestion_permisos/listar/' ?>' >Listar documentos_gestion_permisos</a></span> |
<span style='cursor:pointer'><a href='<?= HOMEDIR.'documentos_gestion_permisos/nuevo/' ?>' >Crear documentos_gestion_permisos</a></span>    
<hr>
<div>
	<form id='formbdata' action='<?= HOMEDIR.'documentos_gestion_permisos'.DS.'buscar'.DS ?>' method='POST'> 
    	<input type='hidden' id='m' name='m' value='documentos_gestion_permisos' />    
    	<input type='hidden' id='action' name='action' value='buscar' />          
        <input type='text' style='height:25px; width:300px; margin:5px; font-size:19px; color:#5C5C5C' id='id' name='id' value='<?= $_REQUEST['id'] ?>'> <br />Id_documento <input type='radio' id='cn' name='cn' value='id_documento'/>,Usuario_permiso <input type='radio' id='cn' name='cn' value='usuario_permiso'/>,Estado <input type='radio' id='cn' name='cn' value='estado'/>,Fecha_solicitud <input type='radio' id='cn' name='cn' value='fecha_solicitud'/>,Fecha_actualizacion <input type='radio' id='cn' name='cn' value='fecha_actualizacion'/>,   <input type='submit' value='Buscar documentos_gestion_permisos'>              
	</form>	
</div>-->


	<div class='title right'>Listado de documentos_gestion_permisos </div>
		<table border='0' cellspacing='0' cellpadding='3' width='100%' class='tabla' id='Tabladocumentos_gestion_permisos'>
           	<thead>
				<tr class='encabezado'>
				
					<th class='th_act'>Id_documento</th>
					<th class='th_act'>Usuario_permiso</th>
					<th class='th_act'>Estado</th>
					<th class='th_act'>Fecha_solicitud</th>
					<th class='th_act'>Fecha_actualizacion</th>
					<th></th>
				</tr>
			</thead>

			<tbody>

<?
		while($row = $con->FetchAssoc($query)){
			$l = new MDocumentos_gestion_permisos;
			$l->Createdocumentos_gestion_permisos('id', $row[id]);
?>						
			<tr id='r<?= $l->GetId() ?>' class='tblresult'> 
				<td><?php echo $l -> GetId_documento(); ?></td> 
				<td><?php echo $l -> GetUsuario_permiso(); ?></td> 
				<td><?php echo $l -> GetEstado(); ?></td> 
				<td><?php echo $l -> GetFecha_solicitud(); ?></td> 
				<td><?php echo $l -> GetFecha_actualizacion(); ?></td> 
				<td>
	                <div onclick='EditarDocumentos_gestion_permisos(<?= $l->GetId() ?>)'>
						<div class='btn btn-info btn-circle' title='editar'></div>
					</div>

					<div onclick='EliminarDocumentos_gestion_permisos(<?= $l->GetId() ?>)'>
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
		$('#Tabladocumentos_gestion_permisos').tablesorter({sortList:[[0,0]]});
	});	
	

function EliminarDocumentos_gestion_permisos(id){
	if(confirm('Esta seguro desea eliminar este documentos_gestion_permisos')){
		var URL = '<?= HOMEDIR ?>documentos_gestion_permisos/eliminar/'+id+'/';
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

function EditarDocumentos_gestion_permisos(id){
	var URL = '<?= HOMEDIR ?>documentos_gestion_permisos/editar/'+id+'/';
	$.ajax({
		type: 'POST',
		url: URL,
		success: function(msg){
			$('#divtoshow').html(msg);
		}
	});
}	
</script>		
