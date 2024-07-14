<?
while($row = $con->FetchAssoc($query)){

	$d = new MDependencias;
	$d->CreateDependencias("id", $row['id_dependencia']);

	if ($d->GetDependencia_inversa() != "0") {
		$idconsulta = $d->GetDependencia_inversa();
	}else{
		$idconsulta = $d->GetId();
	}

	echo "	<div id='e-li".$row['id']."' class='list-group-item'>";
	echo '		<div class="row">
					<div class="col-md-7">'.$d->GetId_c()." - ".$d->GetNombre().'</div>
					<div class="col-md-5">
						<span class="mdi mdi-delete btn btn-circle btn-danger pull-right  m-r-5" style="margin-top:-5px" onclick="EliminarAreas_dependencias(\''.$row['id'].'\', \''.$id.'\')" '.$c->Ayuda('280', 'tog').'></span>';	

	echo " 				<span class='mdi mdi-settings btn btn-circle btn-success pull-right  m-r-5' style='margin-top:-5px' onclick='select_gestSubs(\"".$d->GetId()."\")' ".$c->Ayuda('281', 'tog')." ></span>";

	echo "				<span class='mdi mdi-pencil btn btn-circle btn-info pull-right m-r-5' style='margin-top:-5px' onclick='EditarDependenciaPrincipal(\"".$d->GetId()."\")' ".$c->Ayuda('282', 'tog')." ></span>
					</div>
				</div>
			</div>";
}
?>