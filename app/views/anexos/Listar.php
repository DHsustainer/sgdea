
<span style='cursor:pointer'><a href='<?= HOMEDIR.'anexos/listar/' ?>' >Listar anexos</a></span> |
<span style='cursor:pointer'><a href='<?= HOMEDIR.'anexos/nuevo/' ?>' >Crear anexos</a></span>    
<hr>
<div>
	<form id='formbdata' action='<?= HOMEDIR.'anexos'.DS.'buscar'.DS ?>' method='POST'> 
    	<input type='hidden' id='m' name='m' value='anexos' />    
    	<input type='hidden' id='action' name='action' value='buscar' />          
        <input type='text' style='height:25px; width:300px; margin:5px; font-size:19px; color:#5C5C5C' id='id' name='id' value='<?= $_REQUEST['id'] ?>'> <br />Proceso_id <input type='radio' id='cn' name='cn' value='proceso_id'/>,Nom_palabra <input type='radio' id='cn' name='cn' value='nom_palabra'/>,Nom_img <input type='radio' id='cn' name='cn' value='nom_img'/>,User_id <input type='radio' id='cn' name='cn' value='user_id'/>,   <input type='submit' value='Buscar anexos'>              
	</form>	
</div>

<div class='t'><?php echo $titulo; ?></div>
		<table border='0' cellspacing='0' cellpadding='3' width='100%' class='tabla' id='Tablaanexos'>
           	<thead>
				<tr class='encabezadot'>
				
				<th>Proceso_id</th>
				<th>Nom_palabra</th>
				<th>Nom_img</th>
				<th>User_id</th>
					<th></th>
				</tr>
			</thead>

			<tbody>

<?
		while($row = $con->FetchAssoc($query)){
			$l = new MAnexos;
			$l->Createanexos('id', $row[id]);
?>						
			<tr id='r<?= $l->GetId() ?>' class='tblresult'> 
				<td><?php echo $l -> GetProceso_id(); ?></td> 
				<td><?php echo $l -> GetNom_palabra(); ?></td> 
				<td><?php echo $l -> GetNom_img(); ?></td> 
				<td><?php echo $l -> GetUser_id(); ?></td> 
				<td><a href='<?= HOMEDIR.'anexos/editar/'.$l->GetId().'/' ?>'>Editar </a> | 
                        <a onclick='EliminarAnexos(<?= $l->GetId() ?>)'>Eliminar</a></td>	       
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
		$('#Tablaanexos').tablesorter({sortList:[[0,0]]});
	});	
	

function EliminarAnexos(id){
	if(confirm('Esta seguro desea eliminar este libro')){
		var URL = '<?= HOMEDIR ?>anexos/eliminar/'+id+'/';
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
