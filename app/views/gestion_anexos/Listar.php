
<span style='cursor:pointer'><a href='<?= HOMEDIR.'gestion_anexos/listar/' ?>' >Listar gestion_anexos</a></span> |
<span style='cursor:pointer'><a href='<?= HOMEDIR.'gestion_anexos/nuevo/' ?>' >Crear gestion_anexos</a></span>    
<hr>
<div>
	<form id='formbdata' action='<?= HOMEDIR.'gestion_anexos'.DS.'buscar'.DS ?>' method='POST'> 
    	<input type='hidden' id='m' name='m' value='gestion_anexos' />    
    	<input type='hidden' id='action' name='action' value='buscar' />          
        <input type='text' style='height:25px; width:300px; margin:5px; font-size:19px; color:#5C5C5C' id='id' name='id' value='<?= $_REQUEST['id'] ?>'> <br />Gestion_id <input type='radio' id='cn' name='cn' value='gestion_id'/>,Nombre <input type='radio' id='cn' name='cn' value='nombre'/>,Url <input type='radio' id='cn' name='cn' value='url'/>,User_id <input type='radio' id='cn' name='cn' value='user_id'/>,Fecha <input type='radio' id='cn' name='cn' value='fecha'/>,Hora <input type='radio' id='cn' name='cn' value='hora'/>,Ip <input type='radio' id='cn' name='cn' value='ip'/>,Timest <input type='radio' id='cn' name='cn' value='timest'/>,Estado <input type='radio' id='cn' name='cn' value='estado'/>,Folio <input type='radio' id='cn' name='cn' value='folio'/>,   <input type='submit' value='Buscar gestion_anexos'>              
	</form>	
</div>

<div class='t'><?php echo $titulo; ?></div>
		<table border='0' cellspacing='0' cellpadding='3' width='100%' class='tabla' id='Tablagestion_anexos'>
           	<thead>
				<tr class='encabezadot'>
				
				<th>Gestion_id</th>
				<th>Nombre</th>
				<th>Url</th>
				<th>User_id</th>
				<th>Fecha</th>
				<th>Hora</th>
				<th>Ip</th>
				<th>Timest</th>
				<th>Estado</th>
				<th>Folio</th>
					<th></th>
				</tr>
			</thead>

			<tbody>

<?
		while($row = $con->FetchAssoc($query)){
			$l = new MGestion_anexos;
			$l->Creategestion_anexos('id', $row[id]);
?>						
			<tr id='r<?= $l->GetId() ?>' class='tblresult'> 
				<td><?php echo $l -> GetGestion_id(); ?></td> 
				<td><?php echo $l -> GetNombre(); ?></td> 
				<td><?php echo $l -> GetUrl(); ?></td> 
				<td><?php echo $l -> GetUser_id(); ?></td> 
				<td><?php echo $l -> GetFecha(); ?></td> 
				<td><?php echo $l -> GetHora(); ?></td> 
				<td><?php echo $l -> GetIp(); ?></td> 
				<td><?php echo $l -> GetTimest(); ?></td> 
				<td><?php echo $l -> GetEstado(); ?></td> 
				<td><?php echo $l -> GetFolio(); ?></td> 
				<td><a href='<?= HOMEDIR.'gestion_anexos/editar/'.$l->GetId().'/' ?>'>Editar </a> | 
                        <a onclick='EliminarGestion_anexos(<?= $l->GetId() ?>)'>Eliminar</a></td>	       
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
		$('#Tablagestion_anexos').tablesorter({sortList:[[0,0]]});
	});	
	

function EliminarGestion_anexos(id){
	if(confirm('Esta seguro desea eliminar este libro')){
		var URL = '<?= HOMEDIR ?>gestion_anexos/eliminar/'+id+'/';
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
