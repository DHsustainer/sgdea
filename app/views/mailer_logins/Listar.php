
<span style='cursor:pointer'><a href='<?= HOMEDIR.'mailer_logins/listar/' ?>' >Listar mailer_logins</a></span> |
<span style='cursor:pointer'><a href='<?= HOMEDIR.'mailer_logins/nuevo/' ?>' >Crear mailer_logins</a></span>    
<hr>
<div>
	<form id='formbdata' action='<?= HOMEDIR.'mailer_logins'.DS.'buscar'.DS ?>' method='POST'> 
    	<input type='hidden' id='m' name='m' value='mailer_logins' />    
    	<input type='hidden' id='action' name='action' value='buscar' />          
        <input type='text' style='height:25px; width:300px; margin:5px; font-size:19px; color:#5C5C5C' id='id' name='id' value='<?= $_REQUEST['id'] ?>'> <br />Nick <input type='radio' id='cn' name='cn' value='nick'/>,Ip <input type='radio' id='cn' name='cn' value='ip'/>,Date <input type='radio' id='cn' name='cn' value='date'/>,   <input type='submit' value='Buscar mailer_logins'>              
	</form>	
</div>

<div class='t'><?php echo $titulo; ?></div>
		<table border='0' cellspacing='0' cellpadding='3' width='100%' class='tabla' id='Tablamailer_logins'>
           	<thead>
				<tr class='encabezadot'>
				
				<th>Nick</th>
				<th>Ip</th>
				<th>Date</th>
					<th></th>
				</tr>
			</thead>

			<tbody>

<?
		while($row = $con->FetchAssoc($query)){
			$l = new MMailer_logins;
			$l->Createmailer_logins('id', $row[id]);
?>						
			<tr id='r<?= $l->GetId() ?>' class='tblresult'> 
				<td><?php echo $l -> GetNick(); ?></td> 
				<td><?php echo $l -> GetIp(); ?></td> 
				<td><?php echo $l -> GetDate(); ?></td> 
				<td><a href='<?= HOMEDIR.'mailer_logins/editar/'.$l->GetId().'/' ?>'>Editar </a> | 
                        <a onclick='EliminarMailer_logins(<?= $l->GetId() ?>)'>Eliminar</a></td>	       
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
		$('#Tablamailer_logins').tablesorter({sortList:[[0,0]]});
	});	
	

function EliminarMailer_logins(id){
	if(confirm('Esta seguro desea eliminar este libro')){
		var URL = '<?= HOMEDIR ?>mailer_logins/eliminar/'+id+'/';
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
