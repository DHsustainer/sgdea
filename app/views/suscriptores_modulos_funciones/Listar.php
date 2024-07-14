<?
$tipos = array("-1" => "Modulo del sistema", 
				"0" => "Modulo de Subserie G/ral o Especifica", 
				"1" => "Modulo de Menú Principal", 
				"2" => "Modulo de Menú Herramientas", 
				"3" => "Modulo de Area de Suscriptores", 
				"4" => "Modulo de Area de Usuarios" );
?>
	<div class='title right'>Modulos Disponibles en: <?= $tipos[$tipo] ?></div>
	<?
		$cont = $con->NumRows($query);

		if ($cont >= "1") {
			# code...
		
	?>
		<table border='0' cellspacing='0' cellpadding='10' width='100%' class='tabla' id='Tablasuscriptores_modulos_funciones'>
           	<thead>
				<tr class='encabezado'>
				
					<th class='th_act'>Nombre</th>
					<th class='th_act'>Valor</th>
					<th class='th_act'>Descripcion</th>
					<th class='th_act'>Act/Dact</th>
				</tr>
			</thead>

			<tbody>

<?
		while($row = $con->FetchAssoc($query)){
			$l = new MSuscriptores_modulos_funciones;
			$l->Createsuscriptores_modulos_funciones('id', $row[id]);

			$sm = new MSuscriptores_modulos;
			$sm->CreateSuscriptores_modulos('id', $l->GetId_suscriptores_modulos());
?>						
			<tr id='r<?= $l->GetId() ?>' class='tblresult'> 
				<td>
					<span class="fa <?= $sm->GetIcono() ?>"></span>
					<?php echo $sm -> GetNombre(); ?>
				</td> 
				<td><?= $sm->GetImagen() ?></td>
				<td align="center"><span class="fa fa-question-circle-o" data-toggle="tooltip" title="<?= $sm->GetDescripcion(); ?>"></span></td>


				<td width="100px">
<?	
					if ($sm->GetId() == "8" || $sm->GetId() == "9" || $sm->GetId() == "14" || $sm->GetId() == "15" || $sm->GetId() == "16") {
?>						
						<input type="text" id="val<?= $l->GetId() ?>" maxlength="" value="<?= $l->GetValor() ?>" style="width:30px">
						<div style="float:right"  id="option<?= $l->GetId() ?>" onclick='ChangeValue(<?= $l->GetId() ?>)' title="Activar/Desactivar Modulo" class="mini-ico green-act"></div>
<?		
					}else{
?>
						<div style="float:right"  id="option<?= $l->GetId() ?>" onclick='EditarSuscriptores_modulos_funciones(<?= $l->GetId() ?>, <?= ($l->GetValor()== '1')?'0':'1' ?>)' title="Activar/Desactivar Modulo" class="on_off_icon <?= ($l->GetValor()== '1')?'on':'off' ?>"></div>
<?
					}
?>
		        </td>	       
			</tr>
<?
		}
?>			</tbody>
		</table>
<?
	}else{
		echo "<div class='da-message warning'>No hay Modulos diponibles de este tipo</div><br>";
	}
?>
<script>
	$('th').parent().addClass('encabezado');
	$('tr.tblresult:not([th]):even').addClass('par');
	$('tr.tblresult:not([th]):odd').addClass('impar');
 	$('tr.tblresult:not([th])').removeClass('tblresult');		

 
 	$(function() {		
		$('#Tablasuscriptores_modulos_funciones').tablesorter({sortList:[[0,0]]});
	});	
	

function EditarSuscriptores_modulos_funciones(id, valor){
	var URL = '/suscriptores_modulos_funciones/actualizar/'+id+'/'+valor+'/';
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

function ChangeValue(id){
	valor = $("#val"+id).val();
	if (!isNaN(valor)) {
		var URL = '/suscriptores_modulos_funciones/actualizar/'+id+'/'+valor+'/';
		$.ajax({
			type: 'POST',
			url: URL,
			success: function(msg){
				alert("Valor Actualizado")
			}
		});
	}else{
		alert("El Valor Ingresado NO es un número")
	}
}
</script>		
