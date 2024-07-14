<?
	global $f;
	global $c;
	global $con;

	$city = new MCity;
    $city->CreateCity("code", $_SESSION['ciudad']);

    $of = new MSeccional;
    $of->CreateSeccional("id", $_SESSION['seccional']);
    $oficina = $of->GetNombre();


	$area = new MAreas;
	$area->CreateAreas("id", $id_a);

	$usuario = new MUsuarios;
	$usuario->CreateUsuarios("a_i", $id_u);

	$archivo = array("0" => "HISTORICO" ,"2" => "CENTRAL", "3" => "HISTORICO");

?>
<div class="row" style="margin:0px; background: #FFF; padding-left:20px; margin-top:20px">
	<div class="col-md-12">
		<ol class="breadcrumb default">
		  	<li>ARCHIVO <?= $archivo[$_SESSION['typefolder']] ?></li>
		  	<li><?= $oficina ?></li>
		  	<li><?= $city->GetName() ?></li>
			<li><a href="/gestion/getareas/0/"><?= $area->GetNombre() ?></li></a>
			<li><?= $usuario->Getp_nombre().' '.$usuario->GetP_apellido() ?></li>
		</ol>
	</div>
</div>
<div class="row">
	<div class="col-md-12">		
		<div id="newbloque_formularios">
          
            <div id="" class="scrollable">

<?

	$object = new MUsuarios;
	$query = $object->ListarUsuarios("where regimen = '$id'", 'order by p_nombre');

	$path_archivo = ($_SESSION['typefolder'] != "3")?"and estado_archivo = '".$_SESSION['typefolder']."'":"and estado_archivo <= '0'";
						
	$ar = array("0" => "Baja", "1" => "Media", "2" => "Alta");
	$ar2 = array("1" => "Archivo de Gestión", "2" => "Archivo Central", "3" => "Archivo Histórico");
	

	$g = new MGestion;
	$query = $g->ListarGestion(" WHERE  nombre_destino = '".$usuario->GetA_i()."' $path_archivo ");
	$i = 0;
	$if = 0;
	while ($row = $con->FetchAssoc($query)) {
		$i++;
		$rg = new MGestion;
		$rg->CreateGestion("id", $row["id"]);

		$c->GetVistaExpedienteDefault($row["id"]);
		$if += $rg->GetFolio();
		

	}

echo '	<div style="text-align:right">
			<h3>Total de Expedientes '.$i.'</h3>					
			<h3>Total de Folios '.$if.'</h3>
		</div>';

?>            	
          
            </div>
        </div>
	</div>
</div>
<script>
	$(function () {
		$('[data-toggle="tooltip"]').tooltip()
	})
</script>










