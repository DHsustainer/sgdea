
<span style='cursor:pointer'><a href='<?= HOMEDIR.'folder_ciudadano/listar/' ?>' >Listar folder_ciudadano</a></span> |
<span style='cursor:pointer'><a href='<?= HOMEDIR.'folder_ciudadano/nuevo/' ?>' >Crear folder_ciudadano</a></span>    
<hr>
<div>
	<form id='formbdata' action='<?= HOMEDIR.'folder_ciudadano'.DS.'buscar'.DS ?>' method='POST'> 
    	<input type='hidden' id='m' name='m' value='folder_ciudadano' />    
    	<input type='hidden' id='action' name='action' value='buscar' />          
        <input type='text' style='height:25px; width:300px; margin:5px; font-size:19px; color:#5C5C5C' id='id' name='id' value='<?= $_REQUEST['id'] ?>'> <br />User_id <input type='radio' id='cn' name='cn' value='user_id'/>,Titulo <input type='radio' id='cn' name='cn' value='titulo'/>,Fecha <input type='radio' id='cn' name='cn' value='fecha'/>,Type <input type='radio' id='cn' name='cn' value='type'/>,Estado <input type='radio' id='cn' name='cn' value='estado'/>,   <input type='submit' value='Buscar folder_ciudadano'>              
	</form>	
</div>

<div class='t'><?php echo $titulo; ?></div>
		<table border='0' cellspacing='0' cellpadding='3' width='100%' class='tabla' id='Tablafolder_ciudadano'>
           	<thead>
				<tr class='encabezadot'>
				
				<th>User_id</th>
				<th>Titulo</th>
				<th>Fecha</th>
				<th>Type</th>
				<th>Estado</th>
					<th></th>
				</tr>
			</thead>

			<tbody>

<?
		while($row = $con->FetchAssoc($query)){
			$l = new MFolder_ciudadano;
			$l->Createfolder_ciudadano('id', $row[id]);
?>						
			<tr id='r<?= $l->GetId() ?>' class='tblresult'> 
				<td><?php echo $l -> GetUser_id(); ?></td> 
				<td><?php echo $l -> GetTitulo(); ?></td> 
				<td><?php echo $l -> GetFecha(); ?></td> 
				<td><?php echo $l -> GetType(); ?></td> 
				<td><?php echo $l -> GetEstado(); ?></td> 
				<td><a href='<?= HOMEDIR.'folder_ciudadano/editar/'.$l->GetId().'/' ?>'>Editar </a> | 
                        <a onclick='EliminarFolder_ciudadano(<?= $l->GetId() ?>)'>Eliminar</a></td>	       
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
		$('#Tablafolder_ciudadano').tablesorter({sortList:[[0,0]]});
	});	
	

function EliminarFolder_ciudadano(id){
	if(confirm('Esta seguro desea eliminar este libro')){
		var URL = '<?= HOMEDIR ?>folder_ciudadano/eliminar/'+id+'/';
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
