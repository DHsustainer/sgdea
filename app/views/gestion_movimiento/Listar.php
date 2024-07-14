
<span style='cursor:pointer'><a href='<?= HOMEDIR.'gestion_movimiento/listar/' ?>' >Listar gestion_movimiento</a></span> |
<span style='cursor:pointer'><a href='<?= HOMEDIR.'gestion_movimiento/nuevo/' ?>' >Crear gestion_movimiento</a></span>    
<hr>
<div>
	<form id='formbdata' action='<?= HOMEDIR.'gestion_movimiento'.DS.'buscar'.DS ?>' method='POST'> 
    	<input type='hidden' id='m' name='m' value='gestion_movimiento' />    
    	<input type='hidden' id='action' name='action' value='buscar' />          
        <input type='text' style='height:25px; width:300px; margin:5px; font-size:19px; color:#5C5C5C' id='id' name='id' value='<?= $_REQUEST['id'] ?>'> <br />Id_seguimiento <input type='radio' id='cn' name='cn' value='id_seguimiento'/>,Usuario <input type='radio' id='cn' name='cn' value='usuario'/>,Fecha <input type='radio' id='cn' name='cn' value='fecha'/>,Movimiento <input type='radio' id='cn' name='cn' value='movimiento'/>,   <input type='submit' value='Buscar gestion_movimiento'>              
	</form>	
</div>

<div class='t'><?php echo $titulo; ?></div>
		<table border='0' cellspacing='0' cellpadding='3' width='100%' class='tabla' id='Tablagestion_movimiento'>
           	<thead>
				<tr class='encabezadot'>
				
				<th>Id_seguimiento</th>
				<th>Usuario</th>
				<th>Fecha</th>
				<th>Movimiento</th>
					<th></th>
				</tr>
			</thead>

			<tbody>

<?
		while($row = $con->FetchAssoc($query)){
			$l = new MGestion_movimiento;
			$l->Creategestion_movimiento('id', $row[id]);
?>						
			<tr id='r<?= $l->GetId() ?>' class='tblresult'> 
				<td><?php echo $l -> GetId_seguimiento(); ?></td> 
				<td><?php echo $l -> GetUsuario(); ?></td> 
				<td><?php echo $l -> GetFecha(); ?></td> 
				<td><?php echo $l -> GetMovimiento(); ?></td> 
				<td><a href='<?= HOMEDIR.'gestion_movimiento/editar/'.$l->GetId().'/' ?>'>Editar </a> | 
                        <a onclick='EliminarGestion_movimiento(<?= $l->GetId() ?>)'>Eliminar</a></td>	       
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
		$('#Tablagestion_movimiento').tablesorter({sortList:[[0,0]]});
	});	
	

function EliminarGestion_movimiento(id){
	if(confirm('Esta seguro desea eliminar este libro')){
		var URL = '<?= HOMEDIR ?>gestion_movimiento/eliminar/'+id+'/';
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
