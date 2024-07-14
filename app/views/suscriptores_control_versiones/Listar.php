<!--
<span style='cursor:pointer'><a href='<?= HOMEDIR.'suscriptores_control_versiones/listar/' ?>' >Listar suscriptores_control_versiones</a></span> |
<span style='cursor:pointer'><a href='<?= HOMEDIR.'suscriptores_control_versiones/nuevo/' ?>' >Crear suscriptores_control_versiones</a></span>    
<hr>
<div>
	<form id='formbdata' action='<?= HOMEDIR.'suscriptores_control_versiones'.DS.'buscar'.DS ?>' method='POST'> 
    	<input type='hidden' id='m' name='m' value='suscriptores_control_versiones' />    
    	<input type='hidden' id='action' name='action' value='buscar' />          
        <input type='text' style='height:25px; width:300px; margin:5px; font-size:19px; color:#5C5C5C' id='id' name='id' value='<?= $_REQUEST['id'] ?>'> <br />Id_version <input type='radio' id='cn' name='cn' value='id_version'/>,Id_suscriptor <input type='radio' id='cn' name='cn' value='id_suscriptor'/>,Fecha <input type='radio' id='cn' name='cn' value='fecha'/>,Estado <input type='radio' id='cn' name='cn' value='estado'/>,Activo <input type='radio' id='cn' name='cn' value='activo'/>,   <input type='submit' value='Buscar suscriptores_control_versiones'>              
	</form>	
</div>-->
	<div class='title right'>Versión Actual: </div>

	<div class='title right'>Listado de versiones </div>
		<table border='0' cellspacing='0' cellpadding='3' width='100%' class='tabla' id='Tablasuscriptores_control_versiones'>
           	<thead>
				<tr class='encabezado'>
				
					<th class='th_act'>Id_version</th>
					<th class='th_act'>Id_suscriptor</th>
					<th class='th_act'>Fecha</th>
					<th class='th_act'>Estado</th>
					<th class='th_act'>Activo</th>
					<th></th>
				</tr>
			</thead>

			<tbody>

<?
		while($row = $con->FetchAssoc($query)){
			$l = new MSuscriptores_control_versiones;
			$l->Createsuscriptores_control_versiones('id', $row[id]);
?>						
			<tr id='r<?= $l->GetId() ?>' class='tblresult'> 
				<td><?php echo $l -> GetId_version(); ?></td> 
				<td><?php echo $l -> GetId_suscriptor(); ?></td> 
				<td><?php echo $l -> GetFecha(); ?></td> 
				<td><?php echo $l -> GetEstado(); ?></td> 
				<td><?php echo $l -> GetActivo(); ?></td> 
				<td>
	                <div onclick='EditarSuscriptores_control_versiones(<?= $l->GetId() ?>)'>
						<div class='btn btn-info btn-circle' title='editar'></div>
					</div>

					<div onclick='EliminarSuscriptores_control_versiones(<?= $l->GetId() ?>)'>
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
		$('#Tablasuscriptores_control_versiones').tablesorter({sortList:[[0,0]]});
	});	
	

function EliminarSuscriptores_control_versiones(id){
	if(confirm('Esta seguro desea eliminar este suscriptores_control_versiones')){
		var URL = '<?= HOMEDIR ?>suscriptores_control_versiones/eliminar/'+id+'/';
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

function EditarSuscriptores_control_versiones(id){
	var URL = '<?= HOMEDIR ?>suscriptores_control_versiones/editar/'+id+'/';
	$.ajax({
		type: 'POST',
		url: URL,
		success: function(msg){
			$('#divtoshow').html(msg);
		}
	});
}	
</script>		
