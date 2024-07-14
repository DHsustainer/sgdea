<!--
<span style='cursor:pointer'><a href='<?= HOMEDIR.'wf_mapas/listar/' ?>' >Listar wf_mapas</a></span> |
<span style='cursor:pointer'><a href='<?= HOMEDIR.'wf_mapas/nuevo/' ?>' >Crear wf_mapas</a></span>    
<hr>
<div>
	<form id='formbdata' action='<?= HOMEDIR.'wf_mapas'.DS.'buscar'.DS ?>' method='POST'> 
    	<input type='hidden' id='m' name='m' value='wf_mapas' />    
    	<input type='hidden' id='action' name='action' value='buscar' />          
        <input type='text' style='height:25px; width:300px; margin:5px; font-size:19px; color:#5C5C5C' id='id' name='id' value='<?= $_REQUEST['id'] ?>'> <br />Titulo <input type='radio' id='cn' name='cn' value='titulo'/>,Descripcion <input type='radio' id='cn' name='cn' value='descripcion'/>,Usuario <input type='radio' id='cn' name='cn' value='usuario'/>,Fecha <input type='radio' id='cn' name='cn' value='fecha'/>,Id_dependencia <input type='radio' id='cn' name='cn' value='id_dependencia'/>,Tipo_dependencia <input type='radio' id='cn' name='cn' value='tipo_dependencia'/>,   <input type='submit' value='Buscar wf_mapas'>              
	</form>	
</div>-->


	<div class='title right'>Listado de wf_mapas </div>
		<table border='0' cellspacing='0' cellpadding='3' width='100%' class='tabla' id='Tablawf_mapas'>
           	<thead>
				<tr class='encabezado'>
				
					<th class='th_act'>Titulo</th>
					<th class='th_act'>Descripcion</th>
					<th class='th_act'>Usuario</th>
					<th class='th_act'>Fecha</th>
					<th class='th_act'>Id_dependencia</th>
					<th class='th_act'>Tipo_dependencia</th>
					<th></th>
				</tr>
			</thead>

			<tbody>

<?
		while($row = $con->FetchAssoc($query)){
			$l = new MWf_mapas;
			$l->Createwf_mapas('id', $row[id]);
?>						
			<tr id='r<?= $l->GetId() ?>' class='tblresult'> 
				<td><?php echo $l -> GetTitulo(); ?></td> 
				<td><?php echo $l -> GetDescripcion(); ?></td> 
				<td><?php echo $l -> GetUsuario(); ?></td> 
				<td><?php echo $l -> GetFecha(); ?></td> 
				<td><?php echo $l -> GetId_dependencia(); ?></td> 
				<td><?php echo $l -> GetTipo_dependencia(); ?></td> 
				<td>
	                <div onclick='EditarWf_mapas(<?= $l->GetId() ?>)'>
						<div class='btn btn-info btn-circle' title='editar'></div>
					</div>

					<div onclick='EliminarWf_mapas(<?= $l->GetId() ?>)'>
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
		$('#Tablawf_mapas').tablesorter({sortList:[[0,0]]});
	});	
	

function EliminarWf_mapas(id){
	if(confirm('Esta seguro desea eliminar este wf_mapas')){
		var URL = '<?= HOMEDIR ?>wf_mapas/eliminar/'+id+'/';
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

function EditarWf_mapas(id){
	var URL = '<?= HOMEDIR ?>wf_mapas/editar/'+id+'/';
	$.ajax({
		type: 'POST',
		url: URL,
		success: function(msg){
			$('#divtoshow').html(msg);
		}
	});
}	
</script>		
