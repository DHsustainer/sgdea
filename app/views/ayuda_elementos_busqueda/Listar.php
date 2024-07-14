<!--
<span style='cursor:pointer'><a href='<?= HOMEDIR.'ayuda_elementos_busqueda/listar/' ?>' >Listar ayuda_elementos_busqueda</a></span> |
<span style='cursor:pointer'><a href='<?= HOMEDIR.'ayuda_elementos_busqueda/nuevo/' ?>' >Crear ayuda_elementos_busqueda</a></span>    
<hr>
<div>
	<form id='formbdata' action='<?= HOMEDIR.'ayuda_elementos_busqueda'.DS.'buscar'.DS ?>' method='POST'> 
    	<input type='hidden' id='m' name='m' value='ayuda_elementos_busqueda' />    
    	<input type='hidden' id='action' name='action' value='buscar' />          
        <input type='text' style='height:25px; width:300px; margin:5px; font-size:19px; color:#5C5C5C' id='id' name='id' value='<?= $_REQUEST['id'] ?>'> <br />Titulo <input type='radio' id='cn' name='cn' value='titulo'/>,Pista <input type='radio' id='cn' name='cn' value='pista'/>,Texto <input type='radio' id='cn' name='cn' value='texto'/>,Fecha_registro <input type='radio' id='cn' name='cn' value='fecha_registro'/>,Fecha_actualizacion <input type='radio' id='cn' name='cn' value='fecha_actualizacion'/>,Libro_id <input type='radio' id='cn' name='cn' value='libro_id'/>,Categoria <input type='radio' id='cn' name='cn' value='categoria'/>,Error <input type='radio' id='cn' name='cn' value='error'/>,Error_descripcion <input type='radio' id='cn' name='cn' value='error_descripcion'/>,   <input type='submit' value='Buscar ayuda_elementos_busqueda'>              
	</form>	
</div>-->


	<div class='title right'>Listado de ayuda_elementos_busqueda </div>
		<table border='0' cellspacing='0' cellpadding='3' width='100%' class='tabla' id='Tablaayuda_elementos_busqueda'>
           	<thead>
				<tr class='encabezado'>
				
					<th class='th_act'>Titulo</th>
					<th class='th_act'>Pista</th>
					<th class='th_act'>Texto</th>
					<th class='th_act'>Fecha_registro</th>
					<th class='th_act'>Fecha_actualizacion</th>
					<th class='th_act'>Libro_id</th>
					<th class='th_act'>Categoria</th>
					<th class='th_act'>Error</th>
					<th class='th_act'>Error_descripcion</th>
					<th></th>
				</tr>
			</thead>

			<tbody>

<?
		while($row = $con->FetchAssoc($query)){
			$l = new MAyuda_elementos_busqueda;
			$l->Createayuda_elementos_busqueda('id', $row[id]);
?>						
			<tr id='r<?= $l->GetId() ?>' class='tblresult'> 
				<td><?php echo $l -> GetTitulo(); ?></td> 
				<td><?php echo $l -> GetPista(); ?></td> 
				<td><?php echo $l -> GetTexto(); ?></td> 
				<td><?php echo $l -> GetFecha_registro(); ?></td> 
				<td><?php echo $l -> GetFecha_actualizacion(); ?></td> 
				<td><?php echo $l -> GetLibro_id(); ?></td> 
				<td><?php echo $l -> GetCategoria(); ?></td> 
				<td><?php echo $l -> GetError(); ?></td> 
				<td><?php echo $l -> GetError_descripcion(); ?></td> 
				<td>
	                <div onclick='EditarAyuda_elementos_busqueda(<?= $l->GetId() ?>)'>
						<div class='btn btn-info btn-circle' title='editar'></div>
					</div>

					<div onclick='EliminarAyuda_elementos_busqueda(<?= $l->GetId() ?>)'>
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
		$('#Tablaayuda_elementos_busqueda').tablesorter({sortList:[[0,0]]});
	});	
	

function EliminarAyuda_elementos_busqueda(id){
	if(confirm('Esta seguro desea eliminar este ayuda_elementos_busqueda')){
		var URL = '<?= HOMEDIR ?>ayuda_elementos_busqueda/eliminar/'+id+'/';
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

function EditarAyuda_elementos_busqueda(id){
	var URL = '<?= HOMEDIR ?>ayuda_elementos_busqueda/editar/'+id+'/';
	$.ajax({
		type: 'POST',
		url: URL,
		success: function(msg){
			$('#divtoshow').html(msg);
		}
	});
}	
</script>		
