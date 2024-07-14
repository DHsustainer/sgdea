<form id='formgestion_seguimiento' action='/gestion_seguimiento/registrar/' method='POST'> 
	<div class="alert alert-info m-b-10">
		Bienvenido al sistema de seguimiento, a partir de aqui el sistema se conectará para enviarle información..........
	</div>
	<!--
	<input type='hidden' id='m' name='m' value='gestion_seguimiento' />     
	<input type='hidden' id='action' name='action' value='registrar' />     
		<table border='0' cellspacing='3' cellpadding='0' class='tabla' width='40%'>
		<tr>
			<td colspan='2' align='left' class='sub_titulo'>{Formulariogestion_seguimiento}</td>
		</tr>-->

<?		
	$MPlantillas_email = new MPlantillas_email;
	$MPlantillas_email->CreatePlantillas_email('id', '58');
	$contenido = $MPlantillas_email->GetContenido();
	$contenido = explode("|", $contenido); 

    $MUsuarios = new MUsuarios;
    $MUsuarios->CreateUsuarios("user_id", $_SESSION['usuario']);
  

   	$city = new MCity;
    $city->CreateCity("code", $g->GetCiudad());

    $dp = new MProvince;
    $dp->CreateProvince("code", $city->GetProvince());

    $province = $dp->GetName();

    $ciudad = $city->GetName()." - ".$province;

	for ($i=0; $i < count($contenido) ; $i++) { 
		
		$elm = $contenido[$i];
		$tit = $contenido[$i];

		switch ($contenido[$i]) {
			case 'MIN_RADICADO': $tit = "RADICADO OBLIGATORIO"; $elm = $g->GetMin_rad(); break;
			case 'RADICADO_EXTERNO': $tit = "RADICADO ADCICIONAL"; $elm = $g->GetRadicado(); break;
			case 'ASUNTO': $tit = "ASUNTO"; $elm = $g->GetObservacion(); break;
			case 'SUSCRIPTOR_NOMBRE': $tit = "SUSCRIPTOR PRINCIPAL"; $elm = $g->GetNombre_radica(); break;
			case 'RESPONSABLE': $tit = "RESPONSABLE"; $elm = $MUsuarios->GetP_nombre()." ".$MUsuarios->GetP_apellido(); break;
			case 'CIUDAD': $tit = "CIUDAD"; $elm = $ciudad; break;
			case 'CAMPOT1': $tit = CAMPOT1; $elm = $g->GetCampot1(); break;
			case 'CAMPOT2': $tit = CAMPOT2; $elm = $g->GetCampot2(); break;
			case 'CAMPOT3': $tit = CAMPOT3; $elm = $g->GetCampot3(); break;
			case 'CAMPOT4': $tit = CAMPOT4; $elm = $g->GetCampot4(); break;
			case 'CAMPOT5': $tit = CAMPOT5; $elm = $g->GetCampot5(); break;
			case 'CAMPOT6': $tit = CAMPOT6; $elm = $g->GetCampot6(); break;
			case 'CAMPOT7': $tit = CAMPOT7; $elm = $g->GetCampot7(); break;
			case 'CAMPOT8': $tit = CAMPOT8; $elm = $g->GetCampot8(); break;
			case 'CAMPOT9': $tit = CAMPOT9; $elm = $g->GetCampot9(); break;
			case 'CAMPOT10': $tit = CAMPOT10; $elm = $g->GetCampot10(); break;
			case 'CAMPOT11': $tit = CAMPOT11; $elm = $g->GetCampot11(); break;
			case 'CAMPOT12': $tit = CAMPOT12; $elm = $g->GetCampot12(); break;
			case 'CAMPOT13': $tit = CAMPOT13; $elm = $g->GetCampot13(); break;
			case 'CAMPOT14': $tit = CAMPOT14; $elm = $g->GetCampot14(); break;
			case 'CAMPOT15': $tit = CAMPOT15; $elm = $g->GetCampot15(); break;
			default 	   : $tit = "";	 	 $elm = ""; 			   break;

		}

		echo '	<div class="row m-b-10">
					<div class="col-md-5" style="text-transform:uppercase"><b>'.$tit.':</b></div>
					<div class="col-md-7"><input type="text" class="form-control" name="SEG_'.$contenido[$i].'" id="'.$contenido[$i].'" value="'.$elm.'"></div>
				</div>';

	}
?>
	<div class="row m-t-20">
		<div class="col-md-12">
			<label for="observacion">OBSERVACION:</label>
			<textarea class="form-control" id="observacion" name="observacion"></textarea>
		</div>
	</div>
	<div class="row m-t-20">
		<div class="col-md-12">
			<input type='hidden' class='title_act' placeholder='Id_gestion' name='id_gestion' id='id_gestion' maxlength='10' value="<?= $g->GetId() ?>" />
			<input type='button' value='Solicitar Seguimiento' class="btn btn-info" onclick="InsertarSeguimientoGestion()" />
		</div>
	</div>
	
</form>

<script type="text/javascript">
	

function InsertarSeguimientoGestion(){

	if (confirm("¿Esta seguro que desea solicitar seguimiento a este expediente?")) {
	
        var URL = '/gestion_seguimiento/registrar/';
        var str = $("#formgestion_seguimiento").serialize();
        $.ajax({
                type: 'POST',
                url: URL,
                data: str,
                success:function(msg){
	                Alert2(msg);
                }
        });   
    }
}






</script>