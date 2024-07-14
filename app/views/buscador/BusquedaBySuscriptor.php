<?
    $s2w = "";
	/*if ($_SESSION['suscriptor_id'] != "") {
		$s2w = " id in(select id from suscriptores_contactos where id = '".$_SESSION['suscriptor_id']."' union select id from suscriptores_contactos where dependencia = '".$_SESSION['suscriptor_id']."') and ";
	}*/
	$s2 = "select * from 
					suscriptores_contactos 
						where 
							".$s2w."
							nombre like '%".$id."%' or 
							identificacion like '%".$id."%'";
	$sq = $con->Query($s2);
	$i2 = 0;

	echo '<ul class="list-group">';

	while ($roo = $con->FetchAssoc($sq)) {

		$i2++;
		$query = $con->Query("select id from gestion_suscriptores where id_suscriptor = '".$roo['id']."'");
		$cte = $con->NumRows($query);
		$cantidad = " - ".$cte." Expedientes";


		$lx = new MSuscriptores_tipos;
		$lx->CreateSuscriptores_tipos("id", $roo['type']);

		echo '	<li class="list-group-item">
					<div class="NombreSuscriptorBusqueda">
						'.$roo['nombre']." (".$lx->GetNombre().")".$cantidad.'
					    <span class="badge" style="padding:0px; float:rigth background-color: #FFF" onClick="VerExpedientesS(\''.$roo['id'].'\')">
							<button style="padding: 1px 10px;" class="btn btn-primary fa fa-search"></button>
					    </span>
				    </div>
				    <div id="LX'.$roo['id'].'" class="ResultadosExpedientesS"></div>
				 </li>';
	}
	echo '</ul>';

	if ($i2 == "0") {
		echo "<div class='alert alert-info' role='alert'>No se encontraron resultados...</div>";
	}
?>

<style>
	
	.NombreSuscriptorBusqueda{
		font-weight: bolder;
		margin-bottom: 9px;
		margin-top: 4px;
	}

</style>