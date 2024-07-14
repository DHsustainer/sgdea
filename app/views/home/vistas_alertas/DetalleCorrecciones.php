<?
	$RegistrosAMostrar = 30;
	if(isset($pagina)){
		$RegistrosAEmpezar=($pagina-1)*$RegistrosAMostrar;
		$PagAct=$pagina;
	}else{
		$RegistrosAEmpezar=0;
		$PagAct=1;
	}	

	$qr = $con->Query("select gestion.id from gestion inner join gestion_suscriptores on gestion_suscriptores.id_gestion = gestion.id where gestion_suscriptores.id_suscriptor = '".$_SESSION['suscriptor_id']."' and estado_archivo = '1' and estado_respuesta != 'cerrado' $of $doc order by id desc limit $RegistrosAEmpezar, $RegistrosAMostrar");


	while ($row = $con->FetchAssoc($qr)) {
		$c->GetVistaMailExpediente($row['id']);
	}


	$querypag = $con->Query("select count(*) as t from gestion inner join gestion_suscriptores on gestion_suscriptores.id_gestion = gestion.id where gestion_suscriptores.id_suscriptor = '".$_SESSION['suscriptor_id']."' and estado_archivo = '1' and estado_respuesta != 'cerrado' $of $doc");

    $NroRegistros = $con->Result($querypag, 0, 't');
    if($NroRegistros == 0){
        echo '<tr>
                <td colspan="5">
                    <div class="alert alert-info">No hay registros de ingresos de este item</div>
                </td>
            </tr>';
    }


    $PagAnt=$PagAct-1;
    $PagSig=$PagAct+1;

    $PagUlt=$NroRegistros/$RegistrosAMostrar;
    $Res=$NroRegistros%$RegistrosAMostrar;

?>
<script type="text/javascript">
  $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip(); 
        $('[data-toggle="popover"]').popover()
  });
</script>

<input type="hidden" id="pag_oficina" value="<?= $oficina ?>" >
<input type="hidden" id="pag_tipo_documento" value="<?= $tipo_documento ?>" >
<input type="hidden" id="pag_pagina" value="<?= $pagina ?>" >
<input type="hidden" id="PagAnt" value="<?= $PagAnt ?>" >
<input type="hidden" id="PagSig" value="<?= $PagSig ?>" >
<input type="hidden" id="PagUlt" value="<?= $PagUlt ?>" >
