<!--
<span style='cursor:pointer'><a href='<?= HOMEDIR.'wf_gestion_mapas/listar/' ?>' >Listar wf_gestion_mapas</a></span> |
<span style='cursor:pointer'><a href='<?= HOMEDIR.'wf_gestion_mapas/nuevo/' ?>' >Crear wf_gestion_mapas</a></span>    
<hr>
<div>
	<form id='formbdata' action='<?= HOMEDIR.'wf_gestion_mapas'.DS.'buscar'.DS ?>' method='POST'> 
    	<input type='hidden' id='m' name='m' value='wf_gestion_mapas' />    
    	<input type='hidden' id='action' name='action' value='buscar' />          
        <input type='text' style='height:25px; width:300px; margin:5px; font-size:19px; color:#5C5C5C' id='id' name='id' value='<?= $_REQUEST['id'] ?>'> <br />Titulo <input type='radio' id='cn' name='cn' value='titulo'/>,Descripcion <input type='radio' id='cn' name='cn' value='descripcion'/>,Usuario <input type='radio' id='cn' name='cn' value='usuario'/>,Fecha <input type='radio' id='cn' name='cn' value='fecha'/>,Id_dependencia <input type='radio' id='cn' name='cn' value='id_dependencia'/>,Id_gestion <input type='radio' id='cn' name='cn' value='id_gestion'/>,Tipo_dependencia <input type='radio' id='cn' name='cn' value='tipo_dependencia'/>,Id_mapa <input type='radio' id='cn' name='cn' value='id_mapa'/>,   <input type='submit' value='Buscar wf_gestion_mapas'>              
	</form>	
</div>-->


	<div class='title right'>Listado de wf_gestion_mapas </div>
		<table border='0' cellspacing='0' cellpadding='3' width='100%' class='tabla' id='Tablawf_gestion_mapas'>
           	<thead>
				<tr class='encabezado'>
				
					<th class='th_act'>Titulo</th>
					<th class='th_act'>Descripcion</th>
					<th class='th_act'>Usuario</th>
					<th class='th_act'>Fecha</th>
					<th class='th_act'>Id_dependencia</th>
					<th class='th_act'>Id_gestion</th>
					<th class='th_act'>Tipo_dependencia</th>
					<th class='th_act'>Id_mapa</th>
					<th></th>
				</tr>
			</thead>

			<tbody>

<?
		while($row = $con->FetchAssoc($query)){
			$l = new MWf_gestion_mapas;
			$l->Createwf_gestion_mapas('id', $row[id]);
?>						
			<tr id='r<?= $l->GetId() ?>' class='tblresult'> 
				<td><?php echo $l -> GetTitulo(); ?></td> 
				<td><?php echo $l -> GetDescripcion(); ?></td> 
				<td><?php echo $l -> GetUsuario(); ?></td> 
				<td><?php echo $l -> GetFecha(); ?></td> 
				<td><?php echo $l -> GetId_dependencia(); ?></td> 
				<td><?php echo $l -> GetId_gestion(); ?></td> 
				<td><?php echo $l -> GetTipo_dependencia(); ?></td> 
				<td><?php echo $l -> GetId_mapa(); ?></td> 
				<td>
	                <div onclick='EditarWf_gestion_mapas(<?= $l->GetId() ?>)'>
						<div class='btn btn-info btn-circle' title='editar'></div>
					</div>

					<div onclick='EliminarWf_gestion_mapas(<?= $l->GetId() ?>)'>
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
		$('#Tablawf_gestion_mapas').tablesorter({sortList:[[0,0]]});
	});	
	

function EliminarWf_gestion_mapas(id){
	if(confirm('Esta seguro desea eliminar este wf_gestion_mapas')){
		var URL = '<?= HOMEDIR ?>wf_gestion_mapas/eliminar/'+id+'/';
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

function EditarWf_gestion_mapas(id){
	var URL = '<?= HOMEDIR ?>wf_gestion_mapas/editar/'+id+'/';
	$.ajax({
		type: 'POST',
		url: URL,
		success: function(msg){
			$('#divtoshow').html(msg);
		}
	});
}	
</script>		
