<!--
<span style='cursor:pointer'><a href='<?= HOMEDIR.'wf_gestion_mapas_elementos/listar/' ?>' >Listar wf_gestion_mapas_elementos</a></span> |
<span style='cursor:pointer'><a href='<?= HOMEDIR.'wf_gestion_mapas_elementos/nuevo/' ?>' >Crear wf_gestion_mapas_elementos</a></span>    
<hr>
<div>
	<form id='formbdata' action='<?= HOMEDIR.'wf_gestion_mapas_elementos'.DS.'buscar'.DS ?>' method='POST'> 
    	<input type='hidden' id='m' name='m' value='wf_gestion_mapas_elementos' />    
    	<input type='hidden' id='action' name='action' value='buscar' />          
        <input type='text' style='height:25px; width:300px; margin:5px; font-size:19px; color:#5C5C5C' id='id' name='id' value='<?= $_REQUEST['id'] ?>'> <br />Id_mapa <input type='radio' id='cn' name='cn' value='id_mapa'/>,Id_elemento <input type='radio' id='cn' name='cn' value='id_elemento'/>,Titulo <input type='radio' id='cn' name='cn' value='titulo'/>,Fecha <input type='radio' id='cn' name='cn' value='fecha'/>,Usuario <input type='radio' id='cn' name='cn' value='usuario'/>,Id_evento <input type='radio' id='cn' name='cn' value='id_evento'/>,Id_dependencia <input type='radio' id='cn' name='cn' value='id_dependencia'/>,Id_mapas_elementos <input type='radio' id='cn' name='cn' value='id_mapas_elementos'/>,Estado <input type='radio' id='cn' name='cn' value='estado'/>,Titulo_conector <input type='radio' id='cn' name='cn' value='titulo_conector'/>,   <input type='submit' value='Buscar wf_gestion_mapas_elementos'>              
	</form>	
</div>-->


	<div class='title right'>Listado de wf_gestion_mapas_elementos </div>
		<table border='0' cellspacing='0' cellpadding='3' width='100%' class='tabla' id='Tablawf_gestion_mapas_elementos'>
           	<thead>
				<tr class='encabezado'>
				
					<th class='th_act'>Id_mapa</th>
					<th class='th_act'>Id_elemento</th>
					<th class='th_act'>Titulo</th>
					<th class='th_act'>Fecha</th>
					<th class='th_act'>Usuario</th>
					<th class='th_act'>Id_evento</th>
					<th class='th_act'>Id_dependencia</th>
					<th class='th_act'>Id_mapas_elementos</th>
					<th class='th_act'>Estado</th>
					<th class='th_act'>Titulo_conector</th>
					<th></th>
				</tr>
			</thead>

			<tbody>

<?
		while($row = $con->FetchAssoc($query)){
			$l = new MWf_gestion_mapas_elementos;
			$l->Createwf_gestion_mapas_elementos('id', $row[id]);
?>						
			<tr id='r<?= $l->GetId() ?>' class='tblresult'> 
				<td><?php echo $l -> GetId_mapa(); ?></td> 
				<td><?php echo $l -> GetId_elemento(); ?></td> 
				<td><?php echo $l -> GetTitulo(); ?></td> 
				<td><?php echo $l -> GetFecha(); ?></td> 
				<td><?php echo $l -> GetUsuario(); ?></td> 
				<td><?php echo $l -> GetId_evento(); ?></td> 
				<td><?php echo $l -> GetId_dependencia(); ?></td> 
				<td><?php echo $l -> GetId_mapas_elementos(); ?></td> 
				<td><?php echo $l -> GetEstado(); ?></td> 
				<td><?php echo $l -> GetTitulo_conector(); ?></td> 
				<td>
	                <div onclick='EditarWf_gestion_mapas_elementos(<?= $l->GetId() ?>)'>
						<div class='btn btn-info btn-circle' title='editar'></div>
					</div>

					<div onclick='EliminarWf_gestion_mapas_elementos(<?= $l->GetId() ?>)'>
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
		$('#Tablawf_gestion_mapas_elementos').tablesorter({sortList:[[0,0]]});
	});	
	

function EliminarWf_gestion_mapas_elementos(id){
	if(confirm('Esta seguro desea eliminar este wf_gestion_mapas_elementos')){
		var URL = '<?= HOMEDIR ?>wf_gestion_mapas_elementos/eliminar/'+id+'/';
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

function EditarWf_gestion_mapas_elementos(id){
	var URL = '<?= HOMEDIR ?>wf_gestion_mapas_elementos/editar/'+id+'/';
	$.ajax({
		type: 'POST',
		url: URL,
		success: function(msg){
			$('#divtoshow').html(msg);
		}
	});
}	
</script>		
