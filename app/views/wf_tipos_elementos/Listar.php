<!--
<span style='cursor:pointer'><a href='<?= HOMEDIR.'wf_tipos_elementos/listar/' ?>' >Listar wf_tipos_elementos</a></span> |
<span style='cursor:pointer'><a href='<?= HOMEDIR.'wf_tipos_elementos/nuevo/' ?>' >Crear wf_tipos_elementos</a></span>    
<hr>
<div>
	<form id='formbdata' action='<?= HOMEDIR.'wf_tipos_elementos'.DS.'buscar'.DS ?>' method='POST'> 
    	<input type='hidden' id='m' name='m' value='wf_tipos_elementos' />    
    	<input type='hidden' id='action' name='action' value='buscar' />          
        <input type='text' style='height:25px; width:300px; margin:5px; font-size:19px; color:#5C5C5C' id='id' name='id' value='<?= $_REQUEST['id'] ?>'> <br />Nombre <input type='radio' id='cn' name='cn' value='nombre'/>,   <input type='submit' value='Buscar wf_tipos_elementos'>              
	</form>	
</div>-->


	<div class='title right'>Listado de wf_tipos_elementos </div>
		<table border='0' cellspacing='0' cellpadding='3' width='100%' class='tabla' id='Tablawf_tipos_elementos'>
           	<thead>
				<tr class='encabezado'>
				
					<th class='th_act'>Nombre</th>
					<th></th>
				</tr>
			</thead>

			<tbody>

<?
		while($row = $con->FetchAssoc($query)){
			$l = new MWf_tipos_elementos;
			$l->Createwf_tipos_elementos('id', $row[id]);
?>						
			<tr id='r<?= $l->GetId() ?>' class='tblresult'> 
				<td><?php echo $l -> GetNombre(); ?></td> 
				<td>
	                <div onclick='EditarWf_tipos_elementos(<?= $l->GetId() ?>)'>
						<div class='btn btn-info btn-circle' title='editar'></div>
					</div>

					<div onclick='EliminarWf_tipos_elementos(<?= $l->GetId() ?>)'>
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
		$('#Tablawf_tipos_elementos').tablesorter({sortList:[[0,0]]});
	});	
	

function EliminarWf_tipos_elementos(id){
	if(confirm('Esta seguro desea eliminar este wf_tipos_elementos')){
		var URL = '<?= HOMEDIR ?>wf_tipos_elementos/eliminar/'+id+'/';
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

function EditarWf_tipos_elementos(id){
	var URL = '<?= HOMEDIR ?>wf_tipos_elementos/editar/'+id+'/';
	$.ajax({
		type: 'POST',
		url: URL,
		success: function(msg){
			$('#divtoshow').html(msg);
		}
	});
}	
</script>		
