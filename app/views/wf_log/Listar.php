<!--
<span style='cursor:pointer'><a href='<?= HOMEDIR.'wf_log/listar/' ?>' >Listar wf_log</a></span> |
<span style='cursor:pointer'><a href='<?= HOMEDIR.'wf_log/nuevo/' ?>' >Crear wf_log</a></span>    
<hr>
<div>
	<form id='formbdata' action='<?= HOMEDIR.'wf_log'.DS.'buscar'.DS ?>' method='POST'> 
    	<input type='hidden' id='m' name='m' value='wf_log' />    
    	<input type='hidden' id='action' name='action' value='buscar' />          
        <input type='text' style='height:25px; width:300px; margin:5px; font-size:19px; color:#5C5C5C' id='id' name='id' value='<?= $_REQUEST['id'] ?>'> <br />Usuario <input type='radio' id='cn' name='cn' value='usuario'/>,Fecha <input type='radio' id='cn' name='cn' value='fecha'/>,Actividad <input type='radio' id='cn' name='cn' value='actividad'/>,Id_mapa <input type='radio' id='cn' name='cn' value='id_mapa'/>,   <input type='submit' value='Buscar wf_log'>              
	</form>	
</div>-->


	<div class='title right'>Listado de wf_log </div>
		<table border='0' cellspacing='0' cellpadding='3' width='100%' class='tabla' id='Tablawf_log'>
           	<thead>
				<tr class='encabezado'>
				
					<th class='th_act'>Usuario</th>
					<th class='th_act'>Fecha</th>
					<th class='th_act'>Actividad</th>
					<th class='th_act'>Id_mapa</th>
					<th></th>
				</tr>
			</thead>

			<tbody>

<?
		while($row = $con->FetchAssoc($query)){
			$l = new MWf_log;
			$l->Createwf_log('id', $row[id]);
?>						
			<tr id='r<?= $l->GetId() ?>' class='tblresult'> 
				<td><?php echo $l -> GetUsuario(); ?></td> 
				<td><?php echo $l -> GetFecha(); ?></td> 
				<td><?php echo $l -> GetActividad(); ?></td> 
				<td><?php echo $l -> GetId_mapa(); ?></td> 
				<td>
	                <div onclick='EditarWf_log(<?= $l->GetId() ?>)'>
						<div class='btn btn-info btn-circle' title='editar'></div>
					</div>

					<div onclick='EliminarWf_log(<?= $l->GetId() ?>)'>
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
		$('#Tablawf_log').tablesorter({sortList:[[0,0]]});
	});	
	

function EliminarWf_log(id){
	if(confirm('Esta seguro desea eliminar este wf_log')){
		var URL = '<?= HOMEDIR ?>wf_log/eliminar/'+id+'/';
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

function EditarWf_log(id){
	var URL = '<?= HOMEDIR ?>wf_log/editar/'+id+'/';
	$.ajax({
		type: 'POST',
		url: URL,
		success: function(msg){
			$('#divtoshow').html(msg);
		}
	});
}	
</script>		
