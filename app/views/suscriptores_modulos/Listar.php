
	<h3>Listado de Modulos Del Proyecto <?= $pro->GetNombre() ?> </h3>
		<table border='0' cellspacing='0' cellpadding='10' width='100%' class='tabla' id='Tablasuscriptores_modulos'>
           	<thead>
				<tr class='encabezadot'>
					<th class='th_act'>Nombre</th>
					<th class='th_act'>Tipo de Modulo</th>
					<th class='th_act'>Descripcion</th>
					<th class='th_act'>OP.</th>
				</tr>
			</thead>

			<tbody>

<?
	$tipos = array("-1" => "Modulo del sistema", 
					"0" => "Modulo de Subserie G/ral o Especifica", 
					"1" => "Modulo de Menú Principal", 
					"2" => "Modulo de Menú Herramientas", 
					"3" => "Modulo de Area de Suscriptores", 
					"4" => "Modulo de Area de Usuarios" );

		while($row = $con->FetchAssoc($query)){
			$l = new MSuscriptores_modulos;
			$l->Createsuscriptores_modulos('id', $row[id]);
?>						
			<tr id='r<?= $l->GetId() ?>' class='tblresult'> 
				<td>
					<span class="fa <?= $l->GetIcono() ?>"></span>
					<a href="#" onClick="FormEditar('<?= $l->GetId() ?>', '<?= $pro->GetId() ?>')">
						<?php echo $l -> GetNombre(); ?>
					</a>
				</td> 
				<td><?= $tipos[$l->GetTipo()] ?></td>
				<td align="center"><span class="fa fa-question-circle-o" data-toggle="tooltip" title="<?= $l->GetDescripcion(); ?>"></span></td>
				<td>
					<div style="float:right" data-role="<?= $l->GetEstado() ?>" id="option<?= $l->GetId() ?>" onclick='EditarSuscriptores_modulos(<?= $l->GetId() ?>, <?= $pro->GetId() ?>)' title="Activar/Desactivar Modulo" class="on_off_icon <?= ($l->GetEstado()== '1')?'on':'off' ?>"></div>
		        </td>	       
			</tr>
<?
		}
?>			</tbody>
		</table>
<script>
	$('th').parent().addClass('encabezadot');
	$('tr.tblresult:not([th]):even').addClass('par');
	$('tr.tblresult:not([th]):odd').addClass('impar');
 	$('tr.tblresult:not([th])').removeClass('tblresult');		

 
 	$(function() {		
		$('#Tablasuscriptores_modulos').tablesorter({sortList:[[0,0]]});
	});	
	
function EditarSuscriptores_modulos(id, pro){


	if ($("#option"+id).attr("data-role") == "1") {
		$("#option"+id).attr("data-role", "0");
		valor = 0;
	}else{
		$("#option"+id).attr("data-role", "1");
		valor = 1;
	}
	var URL = '/suscriptores_modulos/actdesactivar/'+id+'/'+valor+'/'+pro+'/';
	$.ajax({
		type: 'POST',
		url: URL,
		success: function(msg){
			if (valor == "1") {
				$("#option"+id).removeClass("off");
				$("#option"+id).addClass("on");
			}else{
				$("#option"+id).removeClass("on");
				$("#option"+id).addClass("off");
			}
		}
	});
}	

function FormEditar(id, pro){
	
	var URL = '/suscriptores_modulos/editar/'+id+'/'+pro+'/';
	$.ajax({
		type: 'POST',
		url: URL,
		success: function(msg){
			$("#main_form_suscriptores_modulosx").html(msg)

		}
	});
}	
</script>		
