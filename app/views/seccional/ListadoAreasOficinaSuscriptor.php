<?
	$var = ($type == "1")?" que tengo expedientes creados":" que soy suscriptor";
	$qpath = ($type == "1")?" WHERE suscriptor_id = '".$_SESSION['suscriptor_id']."' and oficina = '".$_SESSION['seccional']."' group by dependencia_destino":" inner join gestion_suscriptores as gs on gs.id_gestion = gestion.id WHERE gs.id_suscriptor = '".$_SESSION['suscriptor_id']."' and gestion.oficina = '".$_SESSION['seccional']."' group by gestion.dependencia_destino";

	$sc = new MSeccional;
	$sc->CreateSeccional("id", $_SESSION['seccional']);

	$c = new MCity;
	$c->CreateCity("code", $_SESSION['ciudad']);			
?>		
<div id="tools-content">
	<div class="opc-folder blue">
		<div class="ico-content-ps">
			<a href="/gestion/nuevo/"><div class="icon schedule hight-blue"></div></a>
		</div>
		<div class="header-agenda">

			<div class="boton-new-proces-blankspace" style="float: left"></div>
			
			<div id="boton-new-proces" style="float: left">
				<a class="no_link" href="/dashboard/">
					<div ><?= $_SESSION['nombre'] ?></div>
				</a>
			</div>

			<div class="boton-new-proces-blankspace" style="float: left"></div>
			
			<div id="boton-new-proces" style="float: left">
				<a class="no_link" href="/city/childs/<?= $c->GetCode()  ?>/0/">
					<div >
						<?= $c->GetName(); ?>
					</div>
				</a>
			</div>

			<div class="boton-new-proces-blankspace" style="float: left"></div>
			
			<div id="boton-new-proces" style="float: left">
				<a class="no_link" href="/seccional/childs/<?= $sc->GetId()  ?>/0/">
					<div >
						<?= $sc->GetNombre(); ?>
					</div>
				</a>
			</div>

		</div>
	</div>
</div>
<div id="folders-content">
	<div id="folders-list-content">
		<div class="title right">Listado de <?= CAMPOAREADETRABAJO; ?> en <?= $sc->GetNombre()." " ?> en las<?= $var ?></div>
		<br>
<!--
-->
<?
		$object = new MGestion;
		$query = $object->ListarGestion($qpath, "", "");	    

		global $f;
		while($row = $con->FetchAssoc($query)){

			$ob = new MAreas;
			$ob->CreateAreas("id", $row['dependencia_destino']);
?>					
			<div class='newblock_suscriptor' onclick='window.location.href ="/areas/childs/<?= $ob->GetId() ?>/<?= $type ?>/"'>
				<div class='icono'>
					<div class="myicon"></div>
				</div>
				<div class='nombre'><?= $ob->GetNombre() ?></div>
				<div class='num_exp'>&nbsp;</div>
			</div>	
<?
		}
?>			

	</div>
</div>