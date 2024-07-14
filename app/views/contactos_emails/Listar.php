
<span style='cursor:pointer'><a href='<?= HOMEDIR.'contactos_emails/listar/' ?>' >Listar contactos_emails</a></span> |
<span style='cursor:pointer'><a href='<?= HOMEDIR.'contactos_emails/nuevo/' ?>' >Crear contactos_emails</a></span>    
<hr>
<div>
	<form id='formbdata' action='<?= HOMEDIR.'contactos_emails'.DS.'buscar'.DS ?>' method='POST'> 
    	<input type='hidden' id='m' name='m' value='contactos_emails' />    
    	<input type='hidden' id='action' name='action' value='buscar' />          
        <input type='text' style='height:25px; width:300px; margin:5px; font-size:19px; color:#5C5C5C' id='id' name='id' value='<?= $_REQUEST['id'] ?>'> <br />Contacto_id <input type='radio' id='cn' name='cn' value='contacto_id'/>,Email <input type='radio' id='cn' name='cn' value='email'/>,   <input type='submit' value='Buscar contactos_emails'>              
	</form>	
</div>

<div class='t'><?php echo $titulo; ?></div>
		<table border='0' cellspacing='0' cellpadding='3' width='100%' class='tabla' id='Tablacontactos_emails'>
           	<thead>
				<tr class='encabezadot'>
				
				<th>Contacto_id</th>
				<th>Email</th>
					<th></th>
				</tr>
			</thead>

			<tbody>

<?
		while($row = $con->FetchAssoc($query)){
			$l = new MContactos_emails;
			$l->Createcontactos_emails('id', $row[id]);
?>						
			<tr id='r<?= $l->GetId() ?>' class='tblresult'> 
				<td><?php echo $l -> GetContacto_id(); ?></td> 
				<td><?php echo $l -> GetEmail(); ?></td> 
				<td><a href='<?= HOMEDIR.'contactos_emails/editar/'.$l->GetId().'/' ?>'>Editar </a> | 
                        <a onclick='EliminarContactos_emails(<?= $l->GetId() ?>)'>Eliminar</a></td>	       
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
		$('#Tablacontactos_emails').tablesorter({sortList:[[0,0]]});
	});	
	

function EliminarContactos_emails(id){
	if(confirm('Esta seguro desea eliminar este libro')){
		var URL = '<?= HOMEDIR ?>contactos_emails/eliminar/'+id+'/';
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
