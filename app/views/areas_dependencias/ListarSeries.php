<?
while($row = $con->FetchAssoc($query)){
	
	$l = new MAreas_dependencias;
	$l->Createareas_dependencias('id', $row[id]);

	$d = new MDependencias;
	$d->CreateDependencias("id", $l->GetId_dependencia_raiz());

	$qn = $l->ListarAreas_dependencias(" where id_area = '".$l->GetId_area()."' and id_dependencia_raiz = '".$d->GetId()."'");
	$totalsubs = $con->NumRows($qn);
	
	echo "	<div id='e-li".$l->GetId()."' class='list-group-item'>";


	echo '		<div class="row">
					<div class="col-md-7">'.$d->GetId_c()." - ".$d->GetNombre().'</div>
					<div class="col-md-5">';


	if ($d->GetDependencia_inversa() == "0") {
		echo "	<span class='mdi mdi-sitemap btn btn-circle btn-warning pull-right  m-r-5' style='margin-top:-5px' onClick='AbrirAreaSerie(\"".$id."\",\"".$d->GetId()."\")' ".$c->Ayuda('263', 'tog')." ></span>";
		echo "<span class='mdi mdi-pencil btn btn-circle btn-info pull-right m-r-5' style='margin-top:-5px' onclick='EditarDependenciaPrincipal(\"".$d->GetId()."\")' ".$c->Ayuda('266', 'tog')."></span>";
	}else{
		$x = $con->Query("select id from dependencias where dependencia = '".$l->GetId_dependencia_raiz()."'");
		$dx = $con->Result($x, 0, 'id');
		echo '<span class="mdi mdi-delete btn btn-circle btn-danger pull-right  m-r-5" style="margin-top:-5px"  onclick="EliminarAreas_dependencias(\''.$l->GetId().'\', \''.$l->GetId().'\')" '.$c->Ayuda('264', 'tog').'></span>';

		echo " <span class='mdi mdi-settings btn btn-circle btn-success pull-right  m-r-5' style='margin-top:-5px' onclick='select_gestSubs(\"".$dx."\")'  ".$c->Ayuda('265', 'tog')."></span>";

		echo "<span class='mdi mdi-pencil btn btn-circle btn-info pull-right m-r-5' style='margin-top:-5px' onclick='EditarDependenciaPrincipal(\"".$dx."\")' ".$c->Ayuda('266', 'tog')."></span>";
	}
		echo "</div>";
		echo "</div>";
		echo "</div>";
}
?>