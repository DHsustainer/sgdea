<h2>Listado de Actuaciones</h2>

<div class="row">
	<form action="<?= HOMEDIR.DS ?>gestion/ver/<?= $object->GetId() ?>/actuaciones/" method="POST" id="formfilterexp">
		
	<div class="col-md-4">
		<input type="date" class="form-control" name="fechai" id="fechai" value="<?= $fi ?>">
	</div>
	<div class="col-md-4">
		<input type="date" class="form-control" name="fechaf" id="fechaf" value="<?= $ff ?>">
	</div>
	<div class="col-md-2">
		<select id="type" name="type"  class="form-control" >
			<option value="0">Mostrar...</option>
			<option <?= ($type == "0")?"selected='selected'":"" ?> value="0">Todas las Actuaciones</option>
			<option <?= ($type == "1")?"selected='selected'":"" ?> value="1">Actuaciones Publicas</option>
			<option <?= ($type == "2")?"selected='selected'":"" ?> value="2">Actuaciones Privadas</option>
		</select>
	</div>
	<div class="col-md-2">
		<input type="button" onClick="GetFilterdAnexos()" value="Buscar" class="btn btn-info">
	</div>
	<div class="col-md-12 m-t-10">
		<label><input type="checkbox" name="filter" id="filter"  <?= ($filter == "on")?"checked='checked'":"" ?>>
			Ignorar Actuaciones Automaticas
		</label>
	</div>

	</form>

</div>
<div class="row">
	<div class="col-md-12 m-t-10 m-b-20">
		<button type="button" class="btn btn-primary" onclick='ExportarActuaciones(<?= $object->GetId() ?>)'>Exportar Actuaciones</button>
	</div>
</div>



<div class="row">
	<div class="col-md-12 m-t-10 m-b-20">
		<div class="list-group">
<?

	global $f;
	global $c;

	$type_ev = array("1" => "activo", "0" => "echo", "2" => "anulado", "3" => "retrasado");

	while($row = $con->FetchAssoc($query)){

		$l = new MEvents_gestion;
		$l->Createevents_gestion('id', $row[id]);

		$type = $type_ev[$l->GetStatus()];
		$typee = "";
		if ($l -> GetType_event() == "0") {
			$typee = "Actuación generada automaticamente";
		}

		if ($l->Getelm_type() == "lsus") {
			$userna    = $c->GetDataFromTable("suscriptores_contactos", "id", $l->GetUser_id(), "nombre", $separador = " ")." / <b>SUSCRIPTOR</b>";
		}else{
			$us = new MUsuarios;
			$us->CreateUsuarios("user_id", $l->GetUser_id());
			$userna = $us->GetP_nombre()." ".$us->GetP_apellido();
		}
?>			
		<div id='row<?= $l->GetId() ?>' class="looksuscriptor <?= $type ?> list-group-item">	  
			<div class="titulo"><?php echo $l -> GetTitle(); ?></div>
			<div class="sub_titulo">Creado <?php echo $f->ObtenerFecha4($l -> GetFecha()." ".$l -> GetTime())." Por ".$userna ?> <span class="footevento">(<?php echo $typee; ?>)</span></div>
			<div class="bg-warning descripcion <?= $type ?>"><?php echo $l -> GetDescription(); ?></div>
		</div>			
<?
	}
?>
		</div>
<?
		
		$querypag="SELECT count(*) as t from events_gestion WHERE gestion_id = '".$object->GetId()."' and fecha between '$fi' and '$ff' $pathtype $pathfilter ";

        echo '<div class="btn-group m-t-30">';

        $NroRegistros = $con->Result($con->Query($querypag), 0, 't');
        if($NroRegistros == 0){
	        echo '<div class="texto_italic">No hay registros de ingresos de este item</div><br><br>';
        }

        $PagAnt=$PagAct-1;
        $PagSig=$PagAct+1;
        $PagUlt=$NroRegistros/$RegistrosAMostrar;
        $Res=$NroRegistros%$RegistrosAMostrar;

        if($Res>0) $PagUlt=floor($PagUlt)+1;
            echo "<button type='button' class='btn btn-default btn-outline waves-effect' onclick='showfiles(\"/gestion/GetActuaciones/".$id."/1/\", \"cargador_box_actuaciones\")' >Pagina 1</a> ";

        if($PagAct>1) 
        	echo "<button type='button' class='btn btn-default btn-outline waves-effect' onclick='showfiles(\"/gestion/GetActuaciones/".$id."/".$PagAnt."/\", \"cargador_box_actuaciones\")'>Pagina Anterior.</a> ";

        echo "<button type='button' class='btn btn-info waves-effect'>Pagina ".$PagAct." de ".$PagUlt."</button>";

        if($PagAct<$PagUlt)  
        	echo " <button type='button' class='btn btn-default btn-outline waves-effect' onclick='showfiles(\"/gestion/GetActuaciones/".$id."/".$PagSig."/\", \"cargador_box_actuaciones\")'>Pagina Siguiente.</a> ";

        echo " <button type='button' class='btn btn-default btn-outline waves-effect' onclick='showfiles(\"/gestion/GetActuaciones/".$id."/".$PagUlt."/\", \"cargador_box_actuaciones\")'>Pagina. $PagUlt</a>";

        echo '</div>';

?>
	</div>
</div>
<style type="text/css">
	.sub_titulo{
		margin-left: 5px;
		font-size: 12px;
	}
	.descripcion{
		margin: 10px;
		margin-left: 20px;
		border: 1px dashed #EDEDED;
		padding:10px;
	}
	.looksuscriptor:hover{ background-color: #f5f5f5; }
	.looksuscriptor.activo{ border-left:4px solid #0C0; }
	.looksuscriptor.echo{ border-left:4px solid #00C; }
	.looksuscriptor.anulado{ border-left:4px solid #CCC; }
	.looksuscriptor.retrasado{ border-left:4px solid #C00; }
	.footevento{ margin-left: 10px; }
</style>
<script>
function EditarEvents_gestion(id){
	var URL = '/events_gestion/editar/'+id+'/';
	$.ajax({
		type: 'POST',
		url: URL,
		success: function(msg){
			$('#row'+id).html(msg);
		}
	});
}
</script>		