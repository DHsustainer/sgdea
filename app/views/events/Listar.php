
<span style='cursor:pointer'><a href='<?= HOMEDIR.'events/listar/' ?>' >Listar events</a></span> |
<span style='cursor:pointer'><a href='<?= HOMEDIR.'events/nuevo/' ?>' >Crear events</a></span>    
<hr>
<div>
	<form id='formbdata' action='<?= HOMEDIR.'events'.DS.'buscar'.DS ?>' method='POST'> 
    	<input type='hidden' id='m' name='m' value='events' />    
    	<input type='hidden' id='action' name='action' value='buscar' />          
        <input type='text' style='height:25px; width:300px; margin:5px; font-size:19px; color:#5C5C5C' id='id' name='id' value='<?= $_REQUEST['id'] ?>'> <br />User_id <input type='radio' id='cn' name='cn' value='user_id'/>,Date <input type='radio' id='cn' name='cn' value='date'/>,Title <input type='radio' id='cn' name='cn' value='title'/>,Description <input type='radio' id='cn' name='cn' value='description'/>,Added <input type='radio' id='cn' name='cn' value='added'/>,Status <input type='radio' id='cn' name='cn' value='status'/>,Deadline <input type='radio' id='cn' name='cn' value='deadline'/>,Dayevent <input type='radio' id='cn' name='cn' value='dayevent'/>,Time <input type='radio' id='cn' name='cn' value='time'/>,Proceso_id <input type='radio' id='cn' name='cn' value='proceso_id'/>,Alerted <input type='radio' id='cn' name='cn' value='alerted'/>,Avisar_a <input type='radio' id='cn' name='cn' value='avisar_a'/>,Echo <input type='radio' id='cn' name='cn' value='echo'/>,Type_event <input type='radio' id='cn' name='cn' value='type_event'/>,Fecha_vencimiento <input type='radio' id='cn' name='cn' value='fecha_vencimiento'/>,   <input type='submit' value='Buscar events'>              
	</form>	
</div>

<div class='t'><?php echo $titulo; ?></div>
		<table border='0' cellspacing='0' cellpadding='3' width='100%' class='tabla' id='Tablaevents'>
           	<thead>
				<tr class='encabezadot'>
				
				<th>User_id</th>
				<th>Date</th>
				<th>Title</th>
				<th>Description</th>
				<th>Added</th>
				<th>Status</th>
				<th>Deadline</th>
				<th>Dayevent</th>
				<th>Time</th>
				<th>Proceso_id</th>
				<th>Alerted</th>
				<th>Avisar_a</th>
				<th>Echo</th>
				<th>Type_event</th>
				<th>Fecha_vencimiento</th>
					<th></th>
				</tr>
			</thead>

			<tbody>

<?
		while($row = $con->FetchAssoc($query)){
			$l = new MEvents;
			$l->Createevents('id', $row[id]);
?>						
			<tr id='r<?= $l->GetId() ?>' class='tblresult'> 
				<td><?php echo $l -> GetUser_id(); ?></td> 
				<td><?php echo $l -> GetDate(); ?></td> 
				<td><?php echo $l -> GetTitle(); ?></td> 
				<td><?php echo $l -> GetDescription(); ?></td> 
				<td><?php echo $l -> GetAdded(); ?></td> 
				<td><?php echo $l -> GetStatus(); ?></td> 
				<td><?php echo $l -> GetDeadline(); ?></td> 
				<td><?php echo $l -> GetDayevent(); ?></td> 
				<td><?php echo $l -> GetTime(); ?></td> 
				<td><?php echo $l -> GetProceso_id(); ?></td> 
				<td><?php echo $l -> GetAlerted(); ?></td> 
				<td><?php echo $l -> GetAvisar_a(); ?></td> 
				<td><?php echo $l -> GetEcho(); ?></td> 
				<td><?php echo $l -> GetType_event(); ?></td> 
				<td><?php echo $l -> GetFecha_vencimiento(); ?></td> 
				<td><a href='<?= HOMEDIR.'events/editar/'.$l->GetId().'/' ?>'>Editar </a> | 
                        <a onclick='EliminarEvents(<?= $l->GetId() ?>)'>Eliminar</a></td>	       
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
		$('#Tablaevents').tablesorter({sortList:[[0,0]]});
	});	
	

function EliminarEvents(id){
	if(confirm('Esta seguro desea eliminar este libro')){
		var URL = '<?= HOMEDIR ?>events/eliminar/'+id+'/';
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
</script>		
