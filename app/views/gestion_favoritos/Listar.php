<!--
<span style='cursor:pointer'><a href='<?= HOMEDIR.'gestion_favoritos/listar/' ?>' >Listar gestion_favoritos</a></span> |
<span style='cursor:pointer'><a href='<?= HOMEDIR.'gestion_favoritos/nuevo/' ?>' >Crear gestion_favoritos</a></span>    
<hr>
<div>
	<form id='formbdata' action='<?= HOMEDIR.'gestion_favoritos'.DS.'buscar'.DS ?>' method='POST'> 
    	<input type='hidden' id='m' name='m' value='gestion_favoritos' />    
    	<input type='hidden' id='action' name='action' value='buscar' />          
        <input type='text' style='height:25px; width:300px; margin:5px; font-size:19px; color:#5C5C5C' id='id' name='id' value='<?= $_REQUEST['id'] ?>'> <br />User_id <input type='radio' id='cn' name='cn' value='user_id'/>,Gestion_id <input type='radio' id='cn' name='cn' value='gestion_id'/>,Tipo_user <input type='radio' id='cn' name='cn' value='tipo_user'/>,Fecha <input type='radio' id='cn' name='cn' value='fecha'/>,   <input type='submit' value='Buscar gestion_favoritos'>              
	</form>	
</div>-->


	<div class='title right'>Listado de gestion_favoritos </div>
		<table border='0' cellspacing='0' cellpadding='3' width='100%' class='tabla' id='Tablagestion_favoritos'>
           	<thead>
				<tr class='encabezado'>
				
					<th class='th_act'>User_id</th>
					<th class='th_act'>Gestion_id</th>
					<th class='th_act'>Tipo_user</th>
					<th class='th_act'>Fecha</th>
					<th></th>
				</tr>
			</thead>

			<tbody>

<?
		while($row = $con->FetchAssoc($query)){
			$l = new MGestion_favoritos;
			$l->Creategestion_favoritos('id', $row[id]);
?>						
			<tr id='r<?= $l->GetId() ?>' class='tblresult'> 
				<td><?php echo $l -> GetUser_id(); ?></td> 
				<td><?php echo $l -> GetGestion_id(); ?></td> 
				<td><?php echo $l -> GetTipo_user(); ?></td> 
				<td><?php echo $l -> GetFecha(); ?></td> 
				<td>
	                <div style='float:left; margin-right:5px;' onclick='EditarGestion_favoritos(<?= $l->GetId() ?>)'>
						<div class='mini-ico green-editar' title='editar'></div>
					</div>

					<div style='float:left; margin-right:5px;'  onclick='EliminarGestion_favoritos(<?= $l->GetId() ?>)'>
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
		$('#Tablagestion_favoritos').tablesorter({sortList:[[0,0]]});
	});	
	

function EliminarGestion_favoritos(id){
	if(confirm('Esta seguro desea eliminar este gestion_favoritos')){
		var URL = '<?= HOMEDIR ?>gestion_favoritos/eliminar/'+id+'/';
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

function EditarGestion_favoritos(id){
	var URL = '<?= HOMEDIR ?>gestion_favoritos/editar/'+id+'/';
	$.ajax({
		type: 'POST',
		url: URL,
		success: function(msg){
			$('#divtoshow').html(msg);
		}
	});
}	
</script>		
