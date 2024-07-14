<!--
<span style='cursor:pointer'><a href='<?= HOMEDIR.'ws_servicios/listar/' ?>' >Listar ws_servicios</a></span> |
<span style='cursor:pointer'><a href='<?= HOMEDIR.'ws_servicios/nuevo/' ?>' >Crear ws_servicios</a></span>    
<hr>
<div>
	<form id='formbdata' action='<?= HOMEDIR.'ws_servicios'.DS.'buscar'.DS ?>' method='POST'> 
    	<input type='hidden' id='m' name='m' value='ws_servicios' />    
    	<input type='hidden' id='action' name='action' value='buscar' />          
        <input type='text' style='height:25px; width:300px; margin:5px; font-size:19px; color:#5C5C5C' id='id' name='id' value='<?= $_REQUEST['id'] ?>'> <br />Nombre <input type='radio' id='cn' name='cn' value='nombre'/>,Url <input type='radio' id='cn' name='cn' value='url'/>,Descripcion <input type='radio' id='cn' name='cn' value='descripcion'/>,Estado <input type='radio' id='cn' name='cn' value='estado'/>,Usuario <input type='radio' id='cn' name='cn' value='usuario'/>,Publicacion <input type='radio' id='cn' name='cn' value='publicacion'/>,   <input type='submit' value='Buscar ws_servicios'>              
	</form>	
</div>-->


	<div class='title right'>Listado de ws_servicios </div>
		<table border='0' cellspacing='0' cellpadding='3' width='100%' class='tabla' id='Tablaws_servicios'>
           	<thead>
				<tr class='encabezado'>
				
					<th class='th_act'>Nombre</th>
					<th class='th_act'>Url</th>
					<th class='th_act'>Descripcion</th>
					<th class='th_act'>Estado</th>
					<th class='th_act'>Usuario</th>
					<th class='th_act'>Publicacion</th>
					<th></th>
				</tr>
			</thead>

			<tbody>

<?
		while($row = $con->FetchAssoc($query)){
			$l = new MWs_servicios;
			$l->Createws_servicios('id', $row[id]);
?>						
			<tr id='r<?= $l->GetId() ?>' class='tblresult'> 
				<td><?php echo $l -> GetNombre(); ?></td> 
				<td><?php echo $l -> GetUrl(); ?></td> 
				<td><?php echo $l -> GetDescripcion(); ?></td> 
				<td><?php echo $l -> GetEstado(); ?></td> 
				<td><?php echo $l -> GetUsuario(); ?></td> 
				<td><?php echo $l -> GetPublicacion(); ?></td> 
				<td>
	                <div onclick='EditarWs_servicios(<?= $l->GetId() ?>)'>
						<div class='btn btn-info btn-circle' title='editar'></div>
					</div>

					<div onclick='EliminarWs_servicios(<?= $l->GetId() ?>)'>
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
		$('#Tablaws_servicios').tablesorter({sortList:[[0,0]]});
	});	
	

function EliminarWs_servicios(id){
	if(confirm('Esta seguro desea eliminar este ws_servicios')){
		var URL = '<?= HOMEDIR ?>ws_servicios/eliminar/'+id+'/';
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

function EditarWs_servicios(id){
	var URL = '<?= HOMEDIR ?>ws_servicios/editar/'+id+'/';
	$.ajax({
		type: 'POST',
		url: URL,
		success: function(msg){
			$('#divtoshow').html(msg);
		}
	});
}	
</script>		
