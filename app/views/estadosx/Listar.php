<!--
<span style='cursor:pointer'><a href='<?= HOMEDIR.'estadosx/listar/' ?>' >Listar estadosx</a></span> |
<span style='cursor:pointer'><a href='<?= HOMEDIR.'estadosx/nuevo/' ?>' >Crear estadosx</a></span>    
<hr>
<div>
	<form id='formbdata' action='<?= HOMEDIR.'estadosx'.DS.'buscar'.DS ?>' method='POST'> 
    	<input type='hidden' id='m' name='m' value='estadosx' />    
    	<input type='hidden' id='action' name='action' value='buscar' />          
        <input type='text' style='height:25px; width:300px; margin:5px; font-size:19px; color:#5C5C5C' id='id' name='id' value='<?= $_REQUEST['id'] ?>'> <br />Nombre <input type='radio' id='cn' name='cn' value='nombre'/>,Valor <input type='radio' id='cn' name='cn' value='valor'/>,Tipo <input type='radio' id='cn' name='cn' value='tipo'/>,Estado <input type='radio' id='cn' name='cn' value='estado'/>,   <input type='submit' value='Buscar estadosx'>              
	</form>	
</div>-->


	<div class='title right'>Listado de estadosx </div>
		<table border='0' cellspacing='0' cellpadding='3' width='100%' class='tabla' id='Tablaestadosx'>
           	<thead>
				<tr class='encabezado'>
				
					<th class='th_act'>Nombre</th>
					<th class='th_act'>Valor</th>
					<th class='th_act'>Tipo</th>
					<th class='th_act'>Estado</th>
					<th></th>
				</tr>
			</thead>

			<tbody>

<?
		while($row = $con->FetchAssoc($query)){
			$l = new MEstadosx;
			$l->Createestadosx('id', $row[id]);
?>						
			<tr id='r<?= $l->GetId() ?>' class='tblresult'> 
				<td><?php echo $l -> GetNombre(); ?></td> 
				<td><?php echo $l -> GetValor(); ?></td> 
				<td><?php echo $l -> GetTipo(); ?></td> 
				<td><?php echo $l -> GetEstado(); ?></td> 
				<td>
	                <div onclick='EditarEstadosx(<?= $l->GetId() ?>)'>
						<div class='btn btn-info btn-circle' title='editar'></div>
					</div>

					<div onclick='EliminarEstadosx(<?= $l->GetId() ?>)'>
	                    <div class='btn btn-warning btn-circle mdi mdi-delete' title='eliminar'></div>
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
		$('#Tablaestadosx').tablesorter({sortList:[[0,0]]});
	});	
	

function EliminarEstadosx(id){
	if(confirm('Esta seguro desea eliminar este estadosx')){
		var URL = '<?= HOMEDIR ?>estadosx/eliminar/'+id+'/';
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

function EditarEstadosx(id){
	var URL = '<?= HOMEDIR ?>estadosx/editar/'+id+'/';
	$.ajax({
		type: 'POST',
		url: URL,
		success: function(msg){
			$('#divtoshow').html(msg);
		}
	});
}	
</script>		
