<table class='table table-striped' id='tablat'>
   	<thead>
		<tr class='encabezadot'>
			<th width="50px" class="th_act">Código</th>
			<th class="th_act"><?= CAMPOAREADETRABAJO; ?></th>
			<th width="140px" class="th_act">OP</th>
		</tr>
	</thead>
	<tbody>

<?
	while($row = $con->FetchAssoc($query)){
		$l = new MAreas;
		$l->Createareas('id', $row[id]);
?>						
		<tr id='r<?= $l->GetId() ?>' class='tblresult'> 
			<td><?php echo $l -> GetPrefijo(); ?></td>
			<td><?php echo $l -> GetNombre(); ?></td> 
			<td>
				<span class="btn btn-info btn-circle mdi mdi-pencil" onclick='EditarAreas(<?= $l->GetId() ?>)'  <?= $c->Ayuda('138', 'tog') ?>>
				</span>
				<span class="btn btn-warning btn-circle mdi mdi-settings" onclick='AreasDependencias(<?= $l->GetId() ?>)' <?= $c->Ayuda('139', 'tog') ?>></span>
				<span class="btn btn-danger btn-circle mdi mdi-delete" onclick='EliminarAreas(<?= $l->GetId() ?>)' <?= $c->Ayuda('140', 'tog') ?>></span>
            </td>	       
		</tr>
<?
	}
?>			
	</tbody>
</table>
<?
	if ($_SESSION['optimizar'] == "1") {
?>
	<div class="row m-t-5">
		<div class="col-md-12">
			<div class='btn btn-warning pull-right'  <?= $c->Ayuda('141', 'tog') ?> onclick='OpenWindow("/dependencias/optimizar/")'>Optimizar</div>
		</div>
	</div>
<?
	}
?>
	<div class="row m-t-5">
		<div class="col-md-12">
			<div class='btn btn-info pull-right'  <?= $c->Ayuda('141', 'tog') ?> onclick='OpenWindow("/dependencias/TRDS/")'>Ver Todas las Tablas de Retención Documental</div>
		</div>
	</div>
<?
	if ($_SESSION['MODULES']['tabla_historica'] == "1") {
?>
	<div class="row m-t-5">
		<div class="col-md-12">
			<div class='btn btn-info pull-right'  <?= $c->Ayuda('332', 'tog') ?> onclick='OpenWindow("/dependencias/TVDS/")'>Ver Todas las Tablas de Valoración Documental</div>
		</div>
	</div>
<?
	}
?>
	<div class="row m-t-5">
		<div class="col-md-12">
			<div class='btn btn-info pull-right'  <?= $c->Ayuda('142', 'tog') ?> onclick='OpenWindow("/dependencias/CCDS/")'>Ver Todos los Cuadros de Clasificación Documental</div>
		</div>
	</div>
<script>
    $(function() {
        $('#tablat').DataTable({
        	filter: false,
        	paging: false
        });
    });
</script>
<script>


	
function EliminarAreas(id){
	if(confirm('Esta seguro desea eliminar este '+CAMPOAREADETRABAJO)){
		var URL = '/areas/eliminar/'+id+'/';
		$.ajax({
			type: 'POST',
			url: URL,
			success: function(msg){
				alert(msg);
				window.location.reload();
			}
		});
	}
}	

function EditarAreas(id){
	var URL = '/areas/editar/'+id+'/';
	LoadModal('','Editar Area',URL);
	/*$.ajax({
		type: 'POST',
		url: URL,
		success: function(msg){
			$("#editararea").html(msg);
		}
	});*/
}	

function AreasDependencias(id){
	var URL = '/areas_dependencias/listar/'+id+'/';
	$.ajax({
		type: 'POST',
		url: URL,
		success: function(msg){
			$("#configarea").html(msg);
		}
	});
}
</script>		
