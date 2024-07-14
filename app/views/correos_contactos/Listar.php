
<span style='cursor:pointer'><a href='<?= HOMEDIR.'correos_contactos/listar/' ?>' >Listar correos_contactos</a></span> |
<span style='cursor:pointer'><a href='<?= HOMEDIR.'correos_contactos/nuevo/' ?>' >Crear correos_contactos</a></span>    
<hr>
<div>
	<form id='formbdata' action='<?= HOMEDIR.'correos_contactos'.DS.'buscar'.DS ?>' method='POST'> 
    	<input type='hidden' id='m' name='m' value='correos_contactos' />    
    	<input type='hidden' id='action' name='action' value='buscar' />          
        <input type='text' style='height:25px; width:300px; margin:5px; font-size:19px; color:#5C5C5C' id='id' name='id' value='<?= $_REQUEST['id'] ?>'> <br />User_id <input type='radio' id='cn' name='cn' value='user_id'/>,Mail <input type='radio' id='cn' name='cn' value='mail'/>,Nombre <input type='radio' id='cn' name='cn' value='nombre'/>,   <input type='submit' value='Buscar correos_contactos'>              
	</form>	
</div>

<div class='t'><?php echo $titulo; ?></div>
		<table border='0' cellspacing='0' cellpadding='3' width='100%' class='tabla' id='Tablacorreos_contactos'>
           	<thead>
				<tr class='encabezadot'>
				
				<th>User_id</th>
				<th>Mail</th>
				<th>Nombre</th>
					<th></th>
				</tr>
			</thead>

			<tbody>

<?
		while($row = $con->FetchAssoc($query)){
			$l = new MCorreos_contactos;
			$l->Createcorreos_contactos('id', $row[id]);
?>						
			<tr id='r<?= $l->GetId() ?>' class='tblresult'> 
				<td><?php echo $l -> GetUser_id(); ?></td> 
				<td><?php echo $l -> GetMail(); ?></td> 
				<td><?php echo $l -> GetNombre(); ?></td> 
				<td><a href='<?= HOMEDIR.'correos_contactos/editar/'.$l->GetId().'/' ?>'>Editar </a> | 
                        <a onclick='EliminarCorreos_contactos(<?= $l->GetId() ?>)'>Eliminar</a></td>	       
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
		$('#Tablacorreos_contactos').tablesorter({sortList:[[0,0]]});
	});	
	

function EliminarCorreos_contactos(id){
	if(confirm('Esta seguro desea eliminar este libro')){
		var URL = '<?= HOMEDIR ?>correos_contactos/eliminar/'+id+'/';
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
