<!--
<span style='cursor:pointer'><a href='<?= HOMEDIR.'keywords/listar/' ?>' >Listar keywords</a></span> |
<span style='cursor:pointer'><a href='<?= HOMEDIR.'keywords/nuevo/' ?>' >Crear keywords</a></span>    
<hr>
<div>
	<form id='formbdata' action='<?= HOMEDIR.'keywords'.DS.'buscar'.DS ?>' method='POST'> 
    	<input type='hidden' id='m' name='m' value='keywords' />    
    	<input type='hidden' id='action' name='action' value='buscar' />          
        <input type='text' style='height:25px; width:300px; margin:5px; font-size:19px; color:#5C5C5C' id='id' name='id' value='<?= $_REQUEST['id'] ?>'> <br />Termino <input type='radio' id='cn' name='cn' value='termino'/>,P_clave <input type='radio' id='cn' name='cn' value='p_clave'/>,Mostrar <input type='radio' id='cn' name='cn' value='mostrar'/>,F_update <input type='radio' id='cn' name='cn' value='f_update'/>,Username <input type='radio' id='cn' name='cn' value='username'/>,   <input type='submit' value='Buscar keywords'>              
	</form>	
</div>-->


	<div class='title right'>Listado de keywords </div>
		<table border='0' cellspacing='0' cellpadding='3' width='100%' class='tabla' id='Tablakeywords'>
           	<thead>
				<tr class='encabezado'>
				
					<th class='th_act'>Termino</th>
					<th class='th_act'>P_clave</th>
					<th class='th_act'>Mostrar</th>
					<th class='th_act'>F_update</th>
					<th class='th_act'>Username</th>
					<th></th>
				</tr>
			</thead>

			<tbody>

<?
		while($row = $con->FetchAssoc($query)){
			$l = new MKeywords;
			$l->Createkeywords('id', $row[id]);
?>						
			<tr id='r<?= $l->GetId() ?>' class='tblresult'> 
				<td><?php echo $l -> GetTermino(); ?></td> 
				<td><?php echo $l -> GetP_clave(); ?></td> 
				<td><?php echo $l -> GetMostrar(); ?></td> 
				<td><?php echo $l -> GetF_update(); ?></td> 
				<td><?php echo $l -> GetUsername(); ?></td> 
				<td>
	                <div style='float:left; margin-right:5px;' onclick='EditarKeywords(<?= $l->GetId() ?>)'>
						<div class='mini-ico green-editar' title='editar'></div>
					</div>

					<div style='float:left; margin-right:5px;'  onclick='EliminarKeywords(<?= $l->GetId() ?>)'>
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
		$('#Tablakeywords').tablesorter({sortList:[[0,0]]});
	});	
	

function EliminarKeywords(id){
	if(confirm('Esta seguro desea eliminar este keywords')){
		var URL = '<?= HOMEDIR ?>keywords/eliminar/'+id+'/';
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

function EditarKeywords(id){
	var URL = '<?= HOMEDIR ?>keywords/editar/'+id+'/';
	$.ajax({
		type: 'POST',
		url: URL,
		success: function(msg){
			$('#divtoshow').html(msg);
		}
	});
}	
</script>		
