<!--
<span style='cursor:pointer'><a href='<?= HOMEDIR.'gestion_seguimiento/listar/' ?>' >Listar gestion_seguimiento</a></span> |
<span style='cursor:pointer'><a href='<?= HOMEDIR.'gestion_seguimiento/nuevo/' ?>' >Crear gestion_seguimiento</a></span>    
<hr>
<div>
	<form id='formbdata' action='<?= HOMEDIR.'gestion_seguimiento'.DS.'buscar'.DS ?>' method='POST'> 
    	<input type='hidden' id='m' name='m' value='gestion_seguimiento' />    
    	<input type='hidden' id='action' name='action' value='buscar' />          
        <input type='text' style='height:25px; width:300px; margin:5px; font-size:19px; color:#5C5C5C' id='id' name='id' value='<?= $_REQUEST['id'] ?>'> <br />Id_gestion <input type='radio' id='cn' name='cn' value='id_gestion'/>,User_id <input type='radio' id='cn' name='cn' value='user_id'/>,Fecha_solicitud <input type='radio' id='cn' name='cn' value='fecha_solicitud'/>,Estado_solicitud <input type='radio' id='cn' name='cn' value='estado_solicitud'/>,Id_seguimiento <input type='radio' id='cn' name='cn' value='id_seguimiento'/>,   <input type='submit' value='Buscar gestion_seguimiento'>              
	</form>	
</div>-->


	<div class='title right'>Listado de gestion_seguimiento </div>
		<table border='0' cellspacing='0' cellpadding='3' width='100%' class='tabla' id='Tablagestion_seguimiento'>
           	<thead>
				<tr class='encabezado'>
				
					<th class='th_act'>Id_gestion</th>
					<th class='th_act'>User_id</th>
					<th class='th_act'>Fecha_solicitud</th>
					<th class='th_act'>Estado_solicitud</th>
					<th class='th_act'>Id_seguimiento</th>
					<th></th>
				</tr>
			</thead>

			<tbody>

<?
		while($row = $con->FetchAssoc($query)){
			$l = new MGestion_seguimiento;
			$l->Creategestion_seguimiento('id', $row[id]);
?>						
			<tr id='r<?= $l->GetId() ?>' class='tblresult'> 
				<td><?php echo $l -> GetId_gestion(); ?></td> 
				<td><?php echo $l -> GetUser_id(); ?></td> 
				<td><?php echo $l -> GetFecha_solicitud(); ?></td> 
				<td><?php echo $l -> GetEstado_solicitud(); ?></td> 
				<td><?php echo $l -> GetId_seguimiento(); ?></td> 
				<td>
	                <div style='float:left; margin-right:5px;' onclick='EditarGestion_seguimiento(<?= $l->GetId() ?>)'>
						<div class='mini-ico green-editar' title='editar'></div>
					</div>

					<div style='float:left; margin-right:5px;'  onclick='EliminarGestion_seguimiento(<?= $l->GetId() ?>)'>
	                    <div class='mini-ico green-eli' title='eliminar'></div>
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
		$('#Tablagestion_seguimiento').tablesorter({sortList:[[0,0]]});
	});	
	

function EliminarGestion_seguimiento(id){
	if(confirm('Esta seguro desea eliminar este gestion_seguimiento')){
		var URL = '<?= HOMEDIR ?>gestion_seguimiento/eliminar/'+id+'/';
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

function EditarGestion_seguimiento(id){
	var URL = '<?= HOMEDIR ?>gestion_seguimiento/editar/'+id+'/';
	$.ajax({
		type: 'POST',
		url: URL,
		success: function(msg){
			$('#divtoshow').html(msg);
		}
	});
}	
</script>		
