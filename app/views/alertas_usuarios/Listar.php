
<span style='cursor:pointer'><a href='<?= HOMEDIR.'alertas_usuarios/listar/' ?>' >Listar alertas_usuarios</a></span> |
<span style='cursor:pointer'><a href='<?= HOMEDIR.'alertas_usuarios/nuevo/' ?>' >Crear alertas_usuarios</a></span>    
<hr>
<div>
	<form id='formbdata' action='<?= HOMEDIR.'alertas_usuarios'.DS.'buscar'.DS ?>' method='POST'> 
    	<input type='hidden' id='m' name='m' value='alertas_usuarios' />    
    	<input type='hidden' id='action' name='action' value='buscar' />          
        <input type='text' style='height:25px; width:300px; margin:5px; font-size:19px; color:#5C5C5C' id='id' name='id' value='<?= $_REQUEST['id'] ?>'> <br />User_id <input type='radio' id='cn' name='cn' value='user_id'/>,Dias <input type='radio' id='cn' name='cn' value='dias'/>,Titulo <input type='radio' id='cn' name='cn' value='titulo'/>,Type <input type='radio' id='cn' name='cn' value='type'/>,   <input type='submit' value='Buscar alertas_usuarios'>              
	</form>	
</div>

<div class='t'><?php echo $titulo; ?></div>
		<table border='0' cellspacing='0' cellpadding='3' width='100%' class='tabla' id='Tablaalertas_usuarios'>
           	<thead>
				<tr class='encabezadot'>
				
				<th>User_id</th>
				<th>Dias</th>
				<th>Titulo</th>
				<th>Type</th>
					<th></th>
				</tr>
			</thead>

			<tbody>

<?
		while($row = $con->FetchAssoc($query)){
			$l = new MAlertas_usuarios;
			$l->Createalertas_usuarios('id', $row[id]);
?>						
			<tr id='r<?= $l->GetId() ?>' class='tblresult'> 
				<td><?php echo $l -> GetUser_id(); ?></td> 
				<td><?php echo $l -> GetDias(); ?></td> 
				<td><?php echo $l -> GetTitulo(); ?></td> 
				<td><?php echo $l -> GetType(); ?></td> 
				<td><a href='<?= HOMEDIR.'alertas_usuarios/editar/'.$l->GetId().'/' ?>'>Editar </a> | 
                        <a onclick='EliminarAlertas_usuarios(<?= $l->GetId() ?>)'>Eliminar</a></td>	       
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
		$('#Tablaalertas_usuarios').tablesorter({sortList:[[0,0]]});
	});	
	

function EliminarAlertas_usuarios(id){
	if(confirm('Esta seguro desea eliminar este libro')){
		var URL = '<?= HOMEDIR ?>alertas_usuarios/eliminar/'+id+'/';
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
