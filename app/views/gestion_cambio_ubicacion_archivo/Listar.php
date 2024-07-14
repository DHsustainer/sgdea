<!--
<span style='cursor:pointer'><a href='<?= HOMEDIR.'gestion_cambio_ubicacion_archivo/listar/' ?>' >Listar gestion_cambio_ubicacion_archivo</a></span> |
<span style='cursor:pointer'><a href='<?= HOMEDIR.'gestion_cambio_ubicacion_archivo/nuevo/' ?>' >Crear gestion_cambio_ubicacion_archivo</a></span>    
<hr>
<div>
	<form id='formbdata' action='<?= HOMEDIR.'gestion_cambio_ubicacion_archivo'.DS.'buscar'.DS ?>' method='POST'> 
    	<input type='hidden' id='m' name='m' value='gestion_cambio_ubicacion_archivo' />    
    	<input type='hidden' id='action' name='action' value='buscar' />          
        <input type='text' style='height:25px; width:300px; margin:5px; font-size:19px; color:#5C5C5C' id='id' name='id' value='<?= $_REQUEST['id'] ?>'> <br />Id_gestion <input type='radio' id='cn' name='cn' value='id_gestion'/>,Nombre_destino <input type='radio' id='cn' name='cn' value='nombre_destino'/>,Estado_archivo_origen <input type='radio' id='cn' name='cn' value='estado_archivo_origen'/>,Estado_archivo_destino <input type='radio' id='cn' name='cn' value='estado_archivo_destino'/>,Estado <input type='radio' id='cn' name='cn' value='estado'/>,Fecha <input type='radio' id='cn' name='cn' value='fecha'/>,   <input type='submit' value='Buscar gestion_cambio_ubicacion_archivo'>              
	</form>	
</div>-->


	<div class='title right'>Listado de gestion_cambio_ubicacion_archivo </div>
		<table border='0' cellspacing='0' cellpadding='3' width='100%' class='tabla' id='Tablagestion_cambio_ubicacion_archivo'>
           	<thead>
				<tr class='encabezado'>
				
					<th class='th_act'>Id_gestion</th>
					<th class='th_act'>Nombre_destino</th>
					<th class='th_act'>Estado_archivo_origen</th>
					<th class='th_act'>Estado_archivo_destino</th>
					<th class='th_act'>Estado</th>
					<th class='th_act'>Fecha</th>
					<th></th>
				</tr>
			</thead>

			<tbody>

<?
		while($row = $con->FetchAssoc($query)){
			$l = new MGestion_cambio_ubicacion_archivo;
			$l->Creategestion_cambio_ubicacion_archivo('id', $row[id]);
?>						
			<tr id='r<?= $l->GetId() ?>' class='tblresult'> 
				<td><?php echo $l -> GetId_gestion(); ?></td> 
				<td><?php echo $l -> GetNombre_destino(); ?></td> 
				<td><?php echo $l -> GetEstado_archivo_origen(); ?></td> 
				<td><?php echo $l -> GetEstado_archivo_destino(); ?></td> 
				<td><?php echo $l -> GetEstado(); ?></td> 
				<td><?php echo $l -> GetFecha(); ?></td> 
				<td>
	                <div onclick='EditarGestion_cambio_ubicacion_archivo(<?= $l->GetId() ?>)'>
						<div class='btn btn-info btn-circle' title='editar'></div>
					</div>

					<div onclick='EliminarGestion_cambio_ubicacion_archivo(<?= $l->GetId() ?>)'>
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
		$('#Tablagestion_cambio_ubicacion_archivo').tablesorter({sortList:[[0,0]]});
	});	
	

function EliminarGestion_cambio_ubicacion_archivo(id){
	if(confirm('Esta seguro desea eliminar este gestion_cambio_ubicacion_archivo')){
		var URL = '<?= HOMEDIR ?>gestion_cambio_ubicacion_archivo/eliminar/'+id+'/';
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

function EditarGestion_cambio_ubicacion_archivo(id){
	var URL = '<?= HOMEDIR ?>gestion_cambio_ubicacion_archivo/editar/'+id+'/';
	$.ajax({
		type: 'POST',
		url: URL,
		success: function(msg){
			$('#divtoshow').html(msg);
		}
	});
}	
</script>		
