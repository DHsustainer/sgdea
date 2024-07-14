
<span style='cursor:pointer'><a href='<?= HOMEDIR.'mailer_from_message/listar/' ?>' >Listar mailer_from_message</a></span> |
<span style='cursor:pointer'><a href='<?= HOMEDIR.'mailer_from_message/nuevo/' ?>' >Crear mailer_from_message</a></span>    
<hr>
<div>
	<form id='formbdata' action='<?= HOMEDIR.'mailer_from_message'.DS.'buscar'.DS ?>' method='POST'> 
    	<input type='hidden' id='m' name='m' value='mailer_from_message' />    
    	<input type='hidden' id='action' name='action' value='buscar' />          
        <input type='text' style='height:25px; width:300px; margin:5px; font-size:19px; color:#5C5C5C' id='id' name='id' value='<?= $_REQUEST['id'] ?>'> <br />Message_id <input type='radio' id='cn' name='cn' value='message_id'/>,Message_code <input type='radio' id='cn' name='cn' value='message_code'/>,SID <input type='radio' id='cn' name='cn' value='sID'/>,Token_ID <input type='radio' id='cn' name='cn' value='token_ID'/>,User_ID <input type='radio' id='cn' name='cn' value='user_ID'/>,Email <input type='radio' id='cn' name='cn' value='email'/>,Size <input type='radio' id='cn' name='cn' value='size'/>,Message <input type='radio' id='cn' name='cn' value='message'/>,Clean_message <input type='radio' id='cn' name='cn' value='clean_message'/>,Type_message <input type='radio' id='cn' name='cn' value='type_message'/>,Name <input type='radio' id='cn' name='cn' value='name'/>,Dns <input type='radio' id='cn' name='cn' value='dns'/>,   <input type='submit' value='Buscar mailer_from_message'>              
	</form>	
</div>

<div class='t'><?php echo $titulo; ?></div>
		<table border='0' cellspacing='0' cellpadding='3' width='100%' class='tabla' id='Tablamailer_from_message'>
           	<thead>
				<tr class='encabezadot'>
				
				<th>Message_id</th>
				<th>Message_code</th>
				<th>SID</th>
				<th>Token_ID</th>
				<th>User_ID</th>
				<th>Email</th>
				<th>Size</th>
				<th>Message</th>
				<th>Clean_message</th>
				<th>Type_message</th>
				<th>Name</th>
				<th>Dns</th>
					<th></th>
				</tr>
			</thead>

			<tbody>

<?
		while($row = $con->FetchAssoc($query)){
			$l = new MMailer_from_message;
			$l->Createmailer_from_message('id', $row[id]);
?>						
			<tr id='r<?= $l->GetId() ?>' class='tblresult'> 
				<td><?php echo $l -> GetMessage_id(); ?></td> 
				<td><?php echo $l -> GetMessage_code(); ?></td> 
				<td><?php echo $l -> GetSID(); ?></td> 
				<td><?php echo $l -> GetToken_ID(); ?></td> 
				<td><?php echo $l -> GetUser_ID(); ?></td> 
				<td><?php echo $l -> GetEmail(); ?></td> 
				<td><?php echo $l -> GetSize(); ?></td> 
				<td><?php echo $l -> GetMessage(); ?></td> 
				<td><?php echo $l -> GetClean_message(); ?></td> 
				<td><?php echo $l -> GetType_message(); ?></td> 
				<td><?php echo $l -> GetName(); ?></td> 
				<td><?php echo $l -> GetDns(); ?></td> 
				<td><a href='<?= HOMEDIR.'mailer_from_message/editar/'.$l->GetId().'/' ?>'>Editar </a> | 
                        <a onclick='EliminarMailer_from_message(<?= $l->GetId() ?>)'>Eliminar</a></td>	       
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
		$('#Tablamailer_from_message').tablesorter({sortList:[[0,0]]});
	});	
	

function EliminarMailer_from_message(id){
	if(confirm('Esta seguro desea eliminar este libro')){
		var URL = '<?= HOMEDIR ?>mailer_from_message/eliminar/'+id+'/';
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
