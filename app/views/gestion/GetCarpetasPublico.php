<?
    $ang = new MGestion_anexos;
	$object = new MGestion;
    $fol = new MGestion_folder;
	$object->CreateGestion("id", $id);
	$usua = new MUsuarios;
	$usua->CreateUsuarios("user_id", $_SESSION['usuario']);
    $isboss = false;
    $insuscriptor = false;
	$inshare = false;
 	$haveshared = false;
 	$haveshared2 = false;


    if (($_SESSION['t_cuenta'] == "1" && $usua->GetRegimen() == $object->GetDependencia_destino()) || $_SESSION['sadminid'] == "1") {
        $isboss = true;
    }

	$gc = new MGestion_compartir;
	$qn = $gc->ListarGestion_compartir(" where usuario_nuevo = '".$_SESSION['usuario']."' and gestion_id = '".$object->GetId()."'");
	$com = $con->NumRows($qn);

	if ($com >= 1) {
	    $inshare = true;
	    $gc->CreateGestion_compartirQuery("usuario_nuevo ='".$_SESSION['usuario']."' and gestion_id = '".$object->GetId()."'");
	    $_SESSION['mayedit'] = $gc->GetType();
	}

	if ($_SESSION['usuario'] == $object->GetUsuario_registra() || $usua->GetA_i() == $object->GetNombre_destino()) {
		$_SESSION['mayedit'] = "1";
	}

	$sg = new MGestion_suscriptores;
	$qns = $sg->ListarGestion_suscriptores(" where id_suscriptor = '".$_SESSION['suscriptor_id']."' and id_gestion = '".$object->GetId()."'");
	$coms = $con->NumRows($qns);

	if ($coms >= 1) {
	    $insuscriptor = true;
	}

    $conx = $con->NumRows($con->Query("select * from gestion_anexos_permisos where gestion_id = '".$object->GetId()."' and usuario_permiso = '".$_SESSION['usuario']."'"));

    if ($conx >= 1) {
        $haveshared = true;
    }

    $conx = $con->NumRows($con->Query("select * from gestion_anexos_permisos_documentos where gestion_id = '".$object->GetId()."' and usuario_permiso = '".$_SESSION['usuario']."'"));
    if ($conx >= 1) {
        $haveshared2 = true;
    }
   
	if ($object->Getnombre_destino() == $usua->GetA_i() || $insuscriptor || $inshare || $object->GetUsuario_registra() == $usua->GetUser_id() || $isboss) {
		$queryf = $fol->ListarGestion_folder("WHERE gestion_id = '".$id."' and folder_id = '".$folder."' and (estado = '1' or estado = '3')");
	}else{
		if($haveshared2 == true){
			$sql_a =" UNION SELECT ga.*,gap.* FROM gestion_anexos as ga inner join gestion_anexos_permisos_documentos as gap on gap.id_documento=ga.id left join gestion_anexos_permisos k on gap.id_documento=k.id_documento WHERE k.id_documento is null and ga.gestion_id = '".$id."' and ga.folder_id = '".$folder."' and gap.usuario_permiso = '".$_SESSION['usuario']."' and (ga.estado = '1' or ga.estado = '3')";
		}
		$queryf = $fol->ListarGestion_folder("WHERE gestion_id = '".$id."' and folder_id = '".$folder."' and (estado = '1' or estado = '3')");
	}

	$fol->CreateGestion_folder("id", $folder);

	if ($folder != "0") {
		$typefol = ($fol->GetTipo() == "1")?"mdi-folder":"mdi-folder-lock";
?>
<div class="row">
	<div class="col-md-12">
		<h4><span class="mdi <?= $typefol ?> "></span> <?= $fol->GetNombre(); ?></h4>
	</div>
</div>

<?
	}

	echo '<ul class="list-group">';

	while($rfolder = $con->FetchAssoc($queryf)){
		$typefol = ($rfolder["tipo"] == "1")?"mdi-folder":"mdi-folder-lock";

        echo "  <li class='list-group-item' onclick='showfiles(\"/gestion/GetAnexos/".$id."/".$rfolder['id']."/1/\", \"cargador_box_upfiles_menu\")' >
					<div class='row'>
						<div class='col-md-10 col-sm-12 waves-effect'>
		                    <span class='mdi $typefol text-warning'></span><span> $rfolder[nombre]</span>
						</div>
						<div class='col-md-2 hidden-sm'>
                    		<div class='text-muted'>$rfolder[fecha]</div>
						</div>
					</div>
                </li>";
	}
    echo "</ul>";
?>
<script type="text/javascript">
	$(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip(); 
        $('[data-toggle="popover"]').popover()
    });
</script>