
<span style='cursor:pointer'><a href='<?= HOMEDIR.'mailer_replys/listar/' ?>' >Listar mailer_replys</a></span> |
<span style='cursor:pointer'><a href='<?= HOMEDIR.'mailer_replys/nuevo/' ?>' >Crear mailer_replys</a></span>    
<hr>
<div>
	<form id='formbdata' action='<?= HOMEDIR.'mailer_replys'.DS.'buscar'.DS ?>' method='POST'> 
    	<input type='hidden' id='m' name='m' value='mailer_replys' />    
    	<input type='hidden' id='action' name='action' value='buscar' />          
        <input type='text' style='height:25px; width:300px; margin:5px; font-size:19px; color:#5C5C5C' id='id' name='id' value='<?= $_REQUEST['id'] ?>'> <br />Receiver_id <input type='radio' id='cn' name='cn' value='receiver_id'/>,Message_id <input type='radio' id='cn' name='cn' value='message_id'/>,Receiver_token <input type='radio' id='cn' name='cn' value='receiver_token'/>,Message_status <input type='radio' id='cn' name='cn' value='message_status'/>,Reply_datetime <input type='radio' id='cn' name='cn' value='reply_datetime'/>,Reply_ip <input type='radio' id='cn' name='cn' value='reply_ip'/>,SesionID <input type='radio' id='cn' name='cn' value='sesionID'/>,Details <input type='radio' id='cn' name='cn' value='details'/>,Subject <input type='radio' id='cn' name='cn' value='subject'/>,Readed <input type='radio' id='cn' name='cn' value='readed'/>,Dns <input type='radio' id='cn' name='cn' value='dns'/>,Hostname <input type='radio' id='cn' name='cn' value='hostname'/>,Isp <input type='radio' id='cn' name='cn' value='isp'/>,Organization <input type='radio' id='cn' name='cn' value='organization'/>,Country <input type='radio' id='cn' name='cn' value='country'/>,State <input type='radio' id='cn' name='cn' value='state'/>,City <input type='radio' id='cn' name='cn' value='city'/>,Latitude <input type='radio' id='cn' name='cn' value='latitude'/>,Longitude <input type='radio' id='cn' name='cn' value='longitude'/>,Lt <input type='radio' id='cn' name='cn' value='lt'/>,Lg <input type='radio' id='cn' name='cn' value='lg'/>,   <input type='submit' value='Buscar mailer_replys'>              
	</form>	
</div>

<div class='t'><?php echo $titulo; ?></div>
		<table border='0' cellspacing='0' cellpadding='3' width='100%' class='tabla' id='Tablamailer_replys'>
           	<thead>
				<tr class='encabezadot'>
				
				<th>Receiver_id</th>
				<th>Message_id</th>
				<th>Receiver_token</th>
				<th>Message_status</th>
				<th>Reply_datetime</th>
				<th>Reply_ip</th>
				<th>SesionID</th>
				<th>Details</th>
				<th>Subject</th>
				<th>Readed</th>
				<th>Dns</th>
				<th>Hostname</th>
				<th>Isp</th>
				<th>Organization</th>
				<th>Country</th>
				<th>State</th>
				<th>City</th>
				<th>Latitude</th>
				<th>Longitude</th>
				<th>Lt</th>
				<th>Lg</th>
					<th></th>
				</tr>
			</thead>

			<tbody>

<?
		while($row = $con->FetchAssoc($query)){
			$l = new MMailer_replys;
			$l->Createmailer_replys('id', $row[id]);
?>						
			<tr id='r<?= $l->GetId() ?>' class='tblresult'> 
				<td><?php echo $l -> GetReceiver_id(); ?></td> 
				<td><?php echo $l -> GetMessage_id(); ?></td> 
				<td><?php echo $l -> GetReceiver_token(); ?></td> 
				<td><?php echo $l -> GetMessage_status(); ?></td> 
				<td><?php echo $l -> GetReply_datetime(); ?></td> 
				<td><?php echo $l -> GetReply_ip(); ?></td> 
				<td><?php echo $l -> GetSesionID(); ?></td> 
				<td><?php echo $l -> GetDetails(); ?></td> 
				<td><?php echo $l -> GetSubject(); ?></td> 
				<td><?php echo $l -> GetReaded(); ?></td> 
				<td><?php echo $l -> GetDns(); ?></td> 
				<td><?php echo $l -> GetHostname(); ?></td> 
				<td><?php echo $l -> GetIsp(); ?></td> 
				<td><?php echo $l -> GetOrganization(); ?></td> 
				<td><?php echo $l -> GetCountry(); ?></td> 
				<td><?php echo $l -> GetState(); ?></td> 
				<td><?php echo $l -> GetCity(); ?></td> 
				<td><?php echo $l -> GetLatitude(); ?></td> 
				<td><?php echo $l -> GetLongitude(); ?></td> 
				<td><?php echo $l -> GetLt(); ?></td> 
				<td><?php echo $l -> GetLg(); ?></td> 
				<td><a href='<?= HOMEDIR.'mailer_replys/editar/'.$l->GetId().'/' ?>'>Editar </a> | 
                        <a onclick='EliminarMailer_replys(<?= $l->GetId() ?>)'>Eliminar</a></td>	       
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
		$('#Tablamailer_replys').tablesorter({sortList:[[0,0]]});
	});	
	

function EliminarMailer_replys(id){
	if(confirm('Esta seguro desea eliminar este libro')){
		var URL = '<?= HOMEDIR ?>mailer_replys/eliminar/'+id+'/';
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
