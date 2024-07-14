<!--
<span style='cursor:pointer'><a href='<?= HOMEDIR.'wf_elementos_conexion/listar/' ?>' >Listar wf_elementos_conexion</a></span> |
<span style='cursor:pointer'><a href='<?= HOMEDIR.'wf_elementos_conexion/nuevo/' ?>' >Crear wf_elementos_conexion</a></span>    
<hr>
<div>
	<form id='formbdata' action='<?= HOMEDIR.'wf_elementos_conexion'.DS.'buscar'.DS ?>' method='POST'> 
    	<input type='hidden' id='m' name='m' value='wf_elementos_conexion' />    
    	<input type='hidden' id='action' name='action' value='buscar' />          
        <input type='text' style='height:25px; width:300px; margin:5px; font-size:19px; color:#5C5C5C' id='id' name='id' value='<?= $_REQUEST['id'] ?>'> <br />Id_inicial <input type='radio' id='cn' name='cn' value='id_inicial'/>,Id_final <input type='radio' id='cn' name='cn' value='id_final'/>,Titulo <input type='radio' id='cn' name='cn' value='titulo'/>,   <input type='submit' value='Buscar wf_elementos_conexion'>              
	</form>	
</div>-->


	<div class='title right'>Listado de wf_elementos_conexion </div>
		<table border='0' cellspacing='0' cellpadding='3' width='100%' class='tabla' id='Tablawf_elementos_conexion'>
           	<thead>
				<tr class='encabezado'>
				
					<th class='th_act'>Id_inicial</th>
					<th class='th_act'>Id_final</th>
					<th class='th_act'>Titulo</th>
					<th></th>
				</tr>
			</thead>

			<tbody>

<?
		while($row = $con->FetchAssoc($query)){
			$l = new MWf_elementos_conexion;
			$l->Createwf_elementos_conexion('id', $row[id]);
?>						
			<tr id='r<?= $l->GetId() ?>' class='tblresult'> 
				<td><?php echo $l -> GetId_inicial(); ?></td> 
				<td><?php echo $l -> GetId_final(); ?></td> 
				<td><?php echo $l -> GetTitulo(); ?></td> 
				<td>
	                <div onclick='EditarWf_elementos_conexion(<?= $l->GetId() ?>)'>
						<div class='btn btn-info btn-circle' title='editar'></div>
					</div>

					<div onclick='EliminarWf_elementos_conexion(<?= $l->GetId() ?>)'>
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
		$('#Tablawf_elementos_conexion').tablesorter({sortList:[[0,0]]});
	});	
	

function EliminarWf_elementos_conexion(id){
	if(confirm('Esta seguro desea eliminar este wf_elementos_conexion')){
		var URL = '<?= HOMEDIR ?>wf_elementos_conexion/eliminar/'+id+'/';
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

function EditarWf_elementos_conexion(id){
	var URL = '<?= HOMEDIR ?>wf_elementos_conexion/editar/'+id+'/';
	$.ajax({
		type: 'POST',
		url: URL,
		success: function(msg){
			$('#divtoshow').html(msg);
		}
	});
}	
</script>		
