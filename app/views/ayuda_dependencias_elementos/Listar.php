<!--
<span style='cursor:pointer'><a href='<?= HOMEDIR.'ayuda_dependencias_elementos/listar/' ?>' >Listar ayuda_dependencias_elementos</a></span> |
<span style='cursor:pointer'><a href='<?= HOMEDIR.'ayuda_dependencias_elementos/nuevo/' ?>' >Crear ayuda_dependencias_elementos</a></span>    
<hr>
<div>
	<form id='formbdata' action='<?= HOMEDIR.'ayuda_dependencias_elementos'.DS.'buscar'.DS ?>' method='POST'> 
    	<input type='hidden' id='m' name='m' value='ayuda_dependencias_elementos' />    
    	<input type='hidden' id='action' name='action' value='buscar' />          
        <input type='text' style='height:25px; width:300px; margin:5px; font-size:19px; color:#5C5C5C' id='id' name='id' value='<?= $_REQUEST['id'] ?>'> <br />Libro_id <input type='radio' id='cn' name='cn' value='libro_id'/>,Elemento_padre_id <input type='radio' id='cn' name='cn' value='elemento_padre_id'/>,Elemento_dependencia_id <input type='radio' id='cn' name='cn' value='elemento_dependencia_id'/>,Orden <input type='radio' id='cn' name='cn' value='orden'/>,Mostrar <input type='radio' id='cn' name='cn' value='mostrar'/>,   <input type='submit' value='Buscar ayuda_dependencias_elementos'>              
	</form>	
</div>-->


	<div class='title right'>Listado de ayuda_dependencias_elementos </div>
		<table border='0' cellspacing='0' cellpadding='3' width='100%' class='tabla' id='Tablaayuda_dependencias_elementos'>
           	<thead>
				<tr class='encabezado'>
				
					<th class='th_act'>Libro_id</th>
					<th class='th_act'>Elemento_padre_id</th>
					<th class='th_act'>Elemento_dependencia_id</th>
					<th class='th_act'>Orden</th>
					<th class='th_act'>Mostrar</th>
					<th></th>
				</tr>
			</thead>

			<tbody>

<?
		while($row = $con->FetchAssoc($query)){
			$l = new MAyuda_dependencias_elementos;
			$l->Createayuda_dependencias_elementos('id', $row[id]);
?>						
			<tr id='r<?= $l->GetId() ?>' class='tblresult'> 
				<td><?php echo $l -> GetLibro_id(); ?></td> 
				<td><?php echo $l -> GetElemento_padre_id(); ?></td> 
				<td><?php echo $l -> GetElemento_dependencia_id(); ?></td> 
				<td><?php echo $l -> GetOrden(); ?></td> 
				<td><?php echo $l -> GetMostrar(); ?></td> 
				<td>
	                <div onclick='EditarAyuda_dependencias_elementos(<?= $l->GetId() ?>)'>
						<div class='btn btn-info btn-circle' title='editar'></div>
					</div>

					<div onclick='EliminarAyuda_dependencias_elementos(<?= $l->GetId() ?>)'>
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
		$('#Tablaayuda_dependencias_elementos').tablesorter({sortList:[[0,0]]});
	});	
	

function EliminarAyuda_dependencias_elementos(id){
	if(confirm('Esta seguro desea eliminar este ayuda_dependencias_elementos')){
		var URL = '<?= HOMEDIR ?>ayuda_dependencias_elementos/eliminar/'+id+'/';
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

function EditarAyuda_dependencias_elementos(id){
	var URL = '<?= HOMEDIR ?>ayuda_dependencias_elementos/editar/'+id+'/';
	$.ajax({
		type: 'POST',
		url: URL,
		success: function(msg){
			$('#divtoshow').html(msg);
		}
	});
}	
</script>		
