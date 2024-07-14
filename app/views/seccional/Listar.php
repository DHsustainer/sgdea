<script type="text/javascript">
	$(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip(); 
        $('[data-toggle="popover"]').popover()
	});
</script>
<?
global $c;
	$sp = new MSeccional_Principal;
	$sp->CreateSeccional_principal("id", $_REQUEST['id']);

?>
<h4 class="m-t-20 m-b-20"><b>Administrar Oficinas en la Ciudad <?= $sp->GetNombre() ?>  <?= $c->Ayuda('132') ?></b></h4>
<h5><b>Listado de Oficinas en <?= $sp->GetNombre() ?></b></h5>
<table class='table table-striped' id='Tablaseccional'>
   	<thead>
		<tr class='encabezadot'>
			<!-- <th class="th_act">ID</th> -->
			<th class="th_act">Nombre</th>
			<th class="th_act">Direccion</th>
			<th class="th_act">Telefono</th>
			<th class="th_act" style="width:100px"></th>
		</tr>
	</thead>
	<tbody>
<?
	while($row = $con->FetchAssoc($query)){
		$l = new MSeccional;
		$l->Createseccional('id', $row[id]);
?>						
		<tr id='r<?= $l->GetId() ?>' class='tblresult'> 
			<!-- <td><?php echo $l -> GetId(); ?></td>  -->
			<td><?php echo $l -> GetNombre(); ?></td> 
			<td><?php echo $l -> GetDireccion(); ?></td> 
			<td><?php echo $l -> GetTelefono(); ?></td> 
			<td>
                <span onclick='EditarSeccional(<?= $l->GetId() ?>)' <?= $c->Ayuda('133', 'tog') ?>>
					<div class="mdi mdi-pencil btn btn-circle btn-info" title="editar"></div>
				</span>

				<span  onclick='EliminarSeccional(<?= $l->GetId() ?>)' <?= $c->Ayuda('134', 'tog') ?>>
                    <div class="mdi mdi-delete btn btn-circle btn-danger" title="eliminar"></div>
                </span>

            </td>	       
		</tr>
<?
	}
?>			
	</tbody>
</table>
<script>
function EliminarSeccional(id){
	if(confirm('Esta seguro desea eliminar esta oficina')){
		var URL = '/seccional/eliminar/'+id+'/';
		$.ajax({
			type: 'POST',
			url: URL,
			success: function(msg){
				alert(msg);
				$('#r'+id).slideUp();
			}
		});
	}
	
}	

function EditarSeccional(id){
	var URL = '/seccional/editar/'+id+'/';
	$.ajax({
		type: 'POST',
		url: URL,
		success: function(msg){
			$("#form-oficinas2").html(msg);
		}
	});
}	
</script>		
<?
	include(VIEWS.DS."seccional".DS."FormInsertSeccional.php");
?>