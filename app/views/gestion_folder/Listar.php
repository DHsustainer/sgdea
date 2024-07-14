<!--
<span style='cursor:pointer'><a href='<?= HOMEDIR.'gestion_folder/listar/' ?>' >Listar gestion_folder</a></span> |
<span style='cursor:pointer'><a href='<?= HOMEDIR.'gestion_folder/nuevo/' ?>' >Crear gestion_folder</a></span>    
<hr>
<div>
	<form id='formbdata' action='<?= HOMEDIR.'gestion_folder'.DS.'buscar'.DS ?>' method='POST'> 
    	<input type='hidden' id='m' name='m' value='gestion_folder' />    
    	<input type='hidden' id='action' name='action' value='buscar' />          
        <input type='text' style='height:25px; width:300px; margin:5px; font-size:19px; color:#5C5C5C' id='id' name='id' value='<?= $_REQUEST['id'] ?>'> <br />Nombre <input type='radio' id='cn' name='cn' value='nombre'/>,Folder_id <input type='radio' id='cn' name='cn' value='folder_id'/>,Gestion_id <input type='radio' id='cn' name='cn' value='gestion_id'/>,User_id <input type='radio' id='cn' name='cn' value='user_id'/>,Fecha <input type='radio' id='cn' name='cn' value='fecha'/>,Estado <input type='radio' id='cn' name='cn' value='estado'/>,Tipo <input type='radio' id='cn' name='cn' value='tipo'/>,   <input type='submit' value='Buscar gestion_folder'>              
	</form>	
</div>-->


	<div class='title right'>Listado de gestion_folder </div>
		<table border='0' cellspacing='0' cellpadding='3' width='100%' class='tabla' id='Tablagestion_folder'>
           	<thead>
				<tr class='encabezado'>
				
					<th class='th_act'>Nombre</th>
					<th class='th_act'>Folder_id</th>
					<th class='th_act'>Gestion_id</th>
					<th class='th_act'>User_id</th>
					<th class='th_act'>Fecha</th>
					<th class='th_act'>Estado</th>
					<th class='th_act'>Tipo</th>
					<th></th>
				</tr>
			</thead>

			<tbody>

<?
		while($row = $con->FetchAssoc($query)){
			$l = new MGestion_folder;
			$l->Creategestion_folder('id', $row[id]);
?>						
			<tr id='r<?= $l->GetId() ?>' class='tblresult'> 
				<td><?php echo $l -> GetNombre(); ?></td> 
				<td><?php echo $l -> GetFolder_id(); ?></td> 
				<td><?php echo $l -> GetGestion_id(); ?></td> 
				<td><?php echo $l -> GetUser_id(); ?></td> 
				<td><?php echo $l -> GetFecha(); ?></td> 
				<td><?php echo $l -> GetEstado(); ?></td> 
				<td><?php echo $l -> GetTipo(); ?></td> 
				<td>
	                <div onclick='EditarGestion_folder(<?= $l->GetId() ?>)'>
						<div class='btn btn-info btn-circle' title='editar'></div>
					</div>

					<div onclick='EliminarGestion_folder(<?= $l->GetId() ?>)'>
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
		$('#Tablagestion_folder').tablesorter({sortList:[[0,0]]});
	});	
	

function EliminarGestion_folder(id){
	if(confirm('Esta seguro desea eliminar este gestion_folder')){
		var URL = '<?= HOMEDIR ?>gestion_folder/eliminar/'+id+'/';
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

function EditarGestion_folder(id){
	var URL = '<?= HOMEDIR ?>gestion_folder/editar/'+id+'/';
	$.ajax({
		type: 'POST',
		url: URL,
		success: function(msg){
			$('#divtoshow').html(msg);
		}
	});
}	
</script>		
