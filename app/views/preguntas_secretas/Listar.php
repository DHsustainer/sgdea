<!--
<span style='cursor:pointer'><a href='<?= HOMEDIR.'preguntas_secretas/listar/' ?>' >Listar preguntas_secretas</a></span> |
<span style='cursor:pointer'><a href='<?= HOMEDIR.'preguntas_secretas/nuevo/' ?>' >Crear preguntas_secretas</a></span>    
<hr>
<div>
	<form id='formbdata' action='<?= HOMEDIR.'preguntas_secretas'.DS.'buscar'.DS ?>' method='POST'> 
    	<input type='hidden' id='m' name='m' value='preguntas_secretas' />    
    	<input type='hidden' id='action' name='action' value='buscar' />          
        <input type='text' style='height:25px; width:300px; margin:5px; font-size:19px; color:#5C5C5C' id='id' name='id' value='<?= $_REQUEST['id'] ?>'> <br />Pregunta <input type='radio' id='cn' name='cn' value='pregunta'/>,Tipo <input type='radio' id='cn' name='cn' value='tipo'/>,   <input type='submit' value='Buscar preguntas_secretas'>              
	</form>	
</div>-->


	<div class='title right'>Listado de preguntas_secretas </div>
		<table border='0' cellspacing='0' cellpadding='3' width='100%' class='tabla' id='Tablapreguntas_secretas'>
           	<thead>
				<tr class='encabezado'>
				
					<th class='th_act'>Pregunta</th>
					<th class='th_act'>Tipo</th>
					<th></th>
				</tr>
			</thead>

			<tbody>

<?
		while($row = $con->FetchAssoc($query)){
			$l = new MPreguntas_secretas;
			$l->Createpreguntas_secretas('id', $row[id]);
?>						
			<tr id='r<?= $l->GetId() ?>' class='tblresult'> 
				<td><?php echo $l -> GetPregunta(); ?></td> 
				<td><?php echo $l -> GetTipo(); ?></td> 
				<td>
	                <div onclick='EditarPreguntas_secretas(<?= $l->GetId() ?>)'>
						<div class='btn btn-info btn-circle' title='editar'></div>
					</div>

					<div onclick='EliminarPreguntas_secretas(<?= $l->GetId() ?>)'>
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
		$('#Tablapreguntas_secretas').tablesorter({sortList:[[0,0]]});
	});	
	

function EliminarPreguntas_secretas(id){
	if(confirm('Esta seguro desea eliminar este preguntas_secretas')){
		var URL = '<?= HOMEDIR ?>preguntas_secretas/eliminar/'+id+'/';
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

function EditarPreguntas_secretas(id){
	var URL = '<?= HOMEDIR ?>preguntas_secretas/editar/'+id+'/';
	$.ajax({
		type: 'POST',
		url: URL,
		success: function(msg){
			$('#divtoshow').html(msg);
		}
	});
}	
</script>		
