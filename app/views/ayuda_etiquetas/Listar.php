<!--
<span style='cursor:pointer'><a href='<?= HOMEDIR.'ayuda_etiquetas/listar/' ?>' >Listar ayuda_etiquetas</a></span> |
<span style='cursor:pointer'><a href='<?= HOMEDIR.'ayuda_etiquetas/nuevo/' ?>' >Crear ayuda_etiquetas</a></span>    
<hr>
<div>
	<form id='formbdata' action='<?= HOMEDIR.'ayuda_etiquetas'.DS.'buscar'.DS ?>' method='POST'> 
    	<input type='hidden' id='m' name='m' value='ayuda_etiquetas' />    
    	<input type='hidden' id='action' name='action' value='buscar' />          
        <input type='text' style='height:25px; width:300px; margin:5px; font-size:19px; color:#5C5C5C' id='id' name='id' value='<?= $_REQUEST['id'] ?>'> <br />Nombre <input type='radio' id='cn' name='cn' value='nombre'/>,   <input type='submit' value='Buscar ayuda_etiquetas'>              
	</form>	
</div>-->


	<div class='title right'>Listado de ayuda_etiquetas </div>
		<table border='0' cellspacing='0' cellpadding='3' width='100%' class='tabla' id='Tablaayuda_etiquetas'>
           	<thead>
				<tr class='encabezado'>
				
					<th class='th_act'>Nombre</th>
					<th></th>
				</tr>
			</thead>

			<tbody>

<?
		while($row = $con->FetchAssoc($query)){
			$l = new MAyuda_etiquetas;
			$l->Createayuda_etiquetas('id', $row[id]);
?>						
			<tr id='r<?= $l->GetId() ?>' class='tblresult'> 
				<td><?php echo $l -> GetNombre(); ?></td> 
				<td>
	                <div onclick='EditarAyuda_etiquetas(<?= $l->GetId() ?>)'>
						<div class='btn btn-info btn-circle' title='editar'></div>
					</div>

					<div onclick='EliminarAyuda_etiquetas(<?= $l->GetId() ?>)'>
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
		$('#Tablaayuda_etiquetas').tablesorter({sortList:[[0,0]]});
	});	
	

function EliminarAyuda_etiquetas(id){
	if(confirm('Esta seguro desea eliminar este ayuda_etiquetas')){
		var URL = '<?= HOMEDIR ?>ayuda_etiquetas/eliminar/'+id+'/';
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

function EditarAyuda_etiquetas(id){
	var URL = '<?= HOMEDIR ?>ayuda_etiquetas/editar/'+id+'/';
	$.ajax({
		type: 'POST',
		url: URL,
		success: function(msg){
			$('#divtoshow').html(msg);
		}
	});
}	
</script>		
