
<span style='cursor:pointer'><a href='<?= HOMEDIR.'mailer_attachments/listar/' ?>' >Listar mailer_attachments</a></span> |
<span style='cursor:pointer'><a href='<?= HOMEDIR.'mailer_attachments/nuevo/' ?>' >Crear mailer_attachments</a></span>    
<hr>
<div>
	<form id='formbdata' action='<?= HOMEDIR.'mailer_attachments'.DS.'buscar'.DS ?>' method='POST'> 
    	<input type='hidden' id='m' name='m' value='mailer_attachments' />    
    	<input type='hidden' id='action' name='action' value='buscar' />          
        <input type='text' style='height:25px; width:300px; margin:5px; font-size:19px; color:#5C5C5C' id='id' name='id' value='<?= $_REQUEST['id'] ?>'> <br />Message_id <input type='radio' id='cn' name='cn' value='message_id'/>,Filename <input type='radio' id='cn' name='cn' value='filename'/>,Size <input type='radio' id='cn' name='cn' value='size'/>,Alt <input type='radio' id='cn' name='cn' value='alt'/>,Type <input type='radio' id='cn' name='cn' value='type'/>,Title <input type='radio' id='cn' name='cn' value='title'/>,At_id <input type='radio' id='cn' name='cn' value='at_id'/>,Folio <input type='radio' id='cn' name='cn' value='folio'/>,   <input type='submit' value='Buscar mailer_attachments'>              
	</form>	
</div>

<div class='t'><?php echo $titulo; ?></div>
		<table border='0' cellspacing='0' cellpadding='3' width='100%' class='tabla' id='Tablamailer_attachments'>
           	<thead>
				<tr class='encabezadot'>
				
				<th>Message_id</th>
				<th>Filename</th>
				<th>Size</th>
				<th>Alt</th>
				<th>Type</th>
				<th>Title</th>
				<th>At_id</th>
				<th>Folio</th>
					<th></th>
				</tr>
			</thead>

			<tbody>

<?
		while($row = $con->FetchAssoc($query)){
			$l = new MMailer_attachments;
			$l->Createmailer_attachments('id', $row[id]);
?>						
			<tr id='r<?= $l->GetId() ?>' class='tblresult'> 
				<td><?php echo $l -> GetMessage_id(); ?></td> 
				<td><?php echo $l -> GetFilename(); ?></td> 
				<td><?php echo $l -> GetSize(); ?></td> 
				<td><?php echo $l -> GetAlt(); ?></td> 
				<td><?php echo $l -> GetType(); ?></td> 
				<td><?php echo $l -> GetTitle(); ?></td> 
				<td><?php echo $l -> GetAt_id(); ?></td> 
				<td><?php echo $l -> GetFolio(); ?></td> 
				<td><a href='<?= HOMEDIR.'mailer_attachments/editar/'.$l->GetId().'/' ?>'>Editar </a> | 
                        <a onclick='EliminarMailer_attachments(<?= $l->GetId() ?>)'>Eliminar</a></td>	       
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
		$('#Tablamailer_attachments').tablesorter({sortList:[[0,0]]});
	});	
	

function EliminarMailer_attachments(id){
	if(confirm('Esta seguro desea eliminar este libro')){
		var URL = '<?= HOMEDIR ?>mailer_attachments/eliminar/'+id+'/';
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
