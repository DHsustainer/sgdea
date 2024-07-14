<?

#if ($nobtn != 'ocultar') {

	# code...

	if($nooptions != "1"){





?>

<div class="row m-t-20 m-b-20">

	<div class="col-md-6" align="left">

		<button onclick="ExportarBigData('<?= $grupo_id ?>')" class="btn btn-info">Exportar al Expediente</button>

		<div id="mypanelresult"></div>

	</div>

<?

	

	if($_SESSION['eliminar_formulario'] == "1"){ 

?>

	<div class="col-md-6" align="right">

		<button onclick="EliminarBigData('<?= $grupo_id ?>')" class="btn btn-danger">Eliminar Formulario</button>

		<div id="mypanelresult"></div>

	</div>

<?

	}

?>

</div>

<?

	}

#}



	$db = new MMeta_big_data;

	

	$db->CreateMeta_big_data("grupo_id", $grupo_id);



	$id_exp = $db->GetType_id();

	$id_form = $db->GetRef_id();

	$tipo = $db->GetTipo_form();

	$metacampos = new MMeta_referencias_campos;

	$validarcampos = $metacampos->ListarMeta_referencias_campos("where id_referencia = '$id_form'");





	while ($campos = $con->FetchAssoc($validarcampos)) {

		$existe = $con->Query("Select id, orden from meta_big_data where campo_id = '".$campos['id']."' and ref_id = '".$campos['id_referencia']."' and type_id = '".$id_exp."' and tipo_form = '".$tipo."'");

		$check = $con->FetchAssoc($existe);





		if ($check['id'] <= "0") {



			$con->Query("INSERT INTO meta_big_data (type_id,   ref_id, campo_id, valor, grupo_id, tipo_form, orden) VALUES ('".$id_exp."', '".$campos['id_referencia']."', '".$campos['id']."', '', '".$grupo_id."', '1', '".$campos['orden']."')");

	

			echo "<div class='alert alert-info'>Se han detectado y registrado nuevos campos en el formulario</div><br>";

		}else{

			#echo "update meta_big_data set orden = '".$campos['orden']."' where id = '".$check['id']."' ";

			$con->Query("update meta_big_data set orden = '".$campos['orden']."' where id = '".$check['id']."' ");

		}

	}



	$primer = ' data-placement="bottom"';

	$ultimo = 'data-placement="top"';

	$default = 'data-placement="right"';



	$total = $con->NumRows($querymdb);



	$i = 0;

	$querymdb = $db->ListarMeta_big_data("WHERE grupo_id = '".$grupo_id."'", 'order by orden');



	

	while($rowmbd = $con->FetchAssoc($querymdb)){



		$object = new MMeta_big_data;

		$object->CreateMeta_big_data("id", $rowmbd['id']);

		$l = new MMeta_referencias_campos;

		$l->CreateMeta_referencias_campos("id", $rowmbd['campo_id']);





		$visible = ($l -> GetVisible() == "1")?"1":"0";

		$obligatorio = ($l -> GetEs_obligatorio() == "1")?'1':'0';



		$titulo = "";

		$campo = "";

		$columnas = "12";



		if ($i == 0) {

			$placement = $default;

		}elseif($i-1 == $total){

			$placement = $default; 

		}else{

			$placement = $default;

		}



		if ($obligatorio == "1") {

			$obligatorio = "importante";

		}else{

			$obligatorio = "";

		}





		if ($l->GetValor_generico() != "") {

			if ($object->GetValor() == "") {
				$val = $object->GetValorGenerico($l->GetValor_generico(), $object->GetValor());
				$object->SetValor($val);
			}	

		}



		switch ($l->GetTipo_elemento()) {

			case '5':

				$popover = "";

				if ($l->GetObservacion() != "") {

					$popover =  "<span $placement class='fa fa-question-circle-o' style='cursor:pointer' data-toggle='popover' data-trigger='hover' data-content='".$l->GetObservacion()."'></span>";

				}

				$titulo = "<label for='elm".$l->GetId()."'>".$l->GetTitulo_campo()."  $popover</label>";

				$columnas = $l->GetColumnas();





				if ($mayeditform == true) {

					$campo = "<input type='text' style='margin-top:0px' class='form-control $obligatorio'  onBlur='HideField(\"".$object->GetId()."\")' name='t_".$object->GetId()."' id='t_".$object->GetId()."'  placeholder='".$l->GetPlaceholder()."' value='".$object->GetValor()."'>";

				}else{

					$campo = $object->GetValor();

				}

				$nrline = "<br>";				



				break;

			case '6':

				$popover = "";

				if ($l->GetObservacion() != "") {

					$popover =  "<span $placement class='fa fa-question-circle-o' style='cursor:pointer' data-toggle='popover' data-trigger='hover' data-content='".$l->GetObservacion()."'></span>";

				}

				$titulo = "<label for='elm".$l->GetId()."'>".$l->GetTitulo_campo()."  $popover</label> ";

				$columnas = $l->GetColumnas();

				

				if ($mayeditform == true) {

					$campo = "<textarea  class='form-control $obligatorio' style='height:100px; margin-top:0px' onBlur='HideField(\"".$object->GetId()."\")' name='t_".$object->GetId()."' id='t_".$object->GetId()."'  placeholder='".$l->GetPlaceholder()."' >".$object->GetValor()."</textarea>";

				}else{

					$campo = $object->GetValor();

				}

				$nrline = "<br>";				



				break;

			case '7':

				$popover = "";

				if ($l->GetObservacion() != "") {

					$popover =  "<span $placement class='fa fa-question-circle-o' style='cursor:pointer' data-toggle='popover' data-trigger='hover' data-content='".$l->GetObservacion()."'></span>";

				}



				$titulo = "<label for='elm".$l->GetId()."'>".$l->GetTitulo_campo()."  $popover</label>";

				$columnas = $l->GetColumnas();



				if ($mayeditform == true) {

					$campo =  '

								<div class="row">

									<div class="col-md-4">

										<br>

										<button style="width:95%" type="button" id="buscarimagenes'.$object->GetId().'" class="btn btn-primary"><span class="fa fa-search"></span> Buscar</button><br><br>

										<button style="width:95%" type="button" id="enviarboton'.$object->GetId().'" class="btn btn-success"><span class="fa fa-upload"></span> Cargar Documentos</button>



										<input type="hidden" id="mylist'.$object->GetId().'" value="'.$object->GetValor().'">

									</div>

									<div class="col-md-8">

										<div id="minilista'.$object->GetId().'" style="margin-top:15px;">

											<!--<ul id="innerlista'.$object->GetId().'"> -->';



							/*for ($i=0; $i < count($ima) ; $i++) { 

								if (trim($ima[$i]) != "") {

									$nom = $c->GetDataFromTable('meta_documentos', 'url', $ima[$i], 'nombre', " ");

									$URL = HOMEDIR.DS.'app/plugins/meta_uploads/'.$ima[$i];

									$campo .= '  <li class="item '.$active.'">

												<a href="'.$URL.'" target="_blank">'.$nom.'</a>

											</li>';

								}

							} */

					$campo .= '		<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">

								    	<!-- Wrapper for slides -->

								    	<div class="carousel-inner" role="listbox">';



											#$ima = explode(";", $bigd['Fotografia']['value']);

											$ima = explode(";", $object->GetValor());

											for ($i=0; $i < count($ima) ; $i++) { 

												if (trim($ima[$i]) != "") {

													if ($i == 0) {

														$active = "active";

													}else{

														$active = "";

													}



													$ext = strtolower(end(explode(".", $ima[$i])));



													switch ($ext) {

														case 'pdf':  $URLIM = HOMEDIR.DS.'app/views/assets/images/im_pdf.png';   break;

														case 'doc':  $URLIM = HOMEDIR.DS.'app/views/assets/images/im_doc.png';   break;

														case 'docx': $URLIM = HOMEDIR.DS.'app/views/assets/images/im_doc.png';   break;

														case 'avi':  $URLIM = HOMEDIR.DS.'app/views/assets/images/im_video.png'; break;

														case 'mp4':  $URLIM = HOMEDIR.DS.'app/views/assets/images/im_video.png'; break;

														case 'xls':  $URLIM = HOMEDIR.DS.'app/views/assets/images/im_xls.png';   break;

														case 'xlsx': $URLIM = HOMEDIR.DS.'app/views/assets/images/im_xls.png';   break;

														case 'mp3':  $URLIM = HOMEDIR.DS.'app/views/assets/images/im_audio.png'; break;

														case 'zip':  $URLIM = HOMEDIR.DS.'app/views/assets/images/im_zip.png';   break;

														case 'rar':  $URLIM = HOMEDIR.DS.'app/views/assets/images/im_zip.png';   break;

														case 'ppt':  $URLIM = HOMEDIR.DS.'app/views/assets/images/im_ppt.png';   break;

														case 'pptx': $URLIM = HOMEDIR.DS.'app/views/assets/images/im_ppt.png';   break;

														default:     $URLIM = HOMEDIR.DS.'app/plugins/meta_uploads/'.$ima[$i];   break;

													}

													$nom = $c->GetDataFromTable('meta_documentos', 'url', $ima[$i], 'nombre', " ");

													$URL = HOMEDIR.DS.'app/plugins/meta_uploads/'.$ima[$i];

													$campo .= '  <div class="item '.$active.'">

		      													<img src="'.$URLIM.'" alt="..." title="'.$nom.'" width="100%">

		      													<div class="carousel-caption" style="padding:0px; background-color: rgba(0,0,0, 0.5);">'.$nom.' <a href="'.$URL.'" target="_blank" style="color:#FB8902"><b>Descargar</b></a></div>

		    												</div>';

												}

											}



					$campo .= '			</div>

										    <!-- Controls -->

											<a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">

										    	<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>

										    	<span class="sr-only">Previous</span>

										  	</a>

											<a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">

											    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>

											    <span class="sr-only">Next</span>

											</a>

									</div>

									<!--</ul>-->

								</div>

								<script type="text/javascript">

									

									$("#buscarimagenes'.$object->GetId().'").click(function() {

										$(".selfile").click();

										$("#fmid").html("'.$object->GetId().'")

									});

									$("#enviarboton'.$object->GetId().'").click(function(){

										$("body").css("cursor", "wait");

								    	$("#sendfiles").submit();

								    })



								</script>

						 		'."<input type='hidden' class='form-control' name='C_F_".$object->GetId()."' id='elm".$object->GetId()."' placeholder='".$l->GetPlaceholder()."'  value='".$object->GetValor()."'>

						 		</div>

						 		</div>

							";

				}else{



					$campo .= '		<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">

								    	<!-- Wrapper for slides -->

								    	<div class="carousel-inner" role="listbox">';



											#$ima = explode(";", $bigd['Fotografia']['value']);

											$ima = explode(";", $object->GetValor());

											for ($i=0; $i < count($ima) ; $i++) { 

												if (trim($ima[$i]) != "") {

													if ($i == 0) {

														$active = "active";

													}else{

														$active = "";

													}



													$ext = strtolower(end(explode(".", $ima[$i])));



													switch ($ext) {

														case 'pdf':  $URLIM = HOMEDIR.DS.'app/views/assets/images/im_pdf.png';   break;

														case 'doc':  $URLIM = HOMEDIR.DS.'app/views/assets/images/im_doc.png';   break;

														case 'docx': $URLIM = HOMEDIR.DS.'app/views/assets/images/im_doc.png';   break;

														case 'avi':  $URLIM = HOMEDIR.DS.'app/views/assets/images/im_video.png'; break;

														case 'mp4':  $URLIM = HOMEDIR.DS.'app/views/assets/images/im_video.png'; break;

														case 'xls':  $URLIM = HOMEDIR.DS.'app/views/assets/images/im_xls.png';   break;

														case 'xlsx': $URLIM = HOMEDIR.DS.'app/views/assets/images/im_xls.png';   break;

														case 'mp3':  $URLIM = HOMEDIR.DS.'app/views/assets/images/im_audio.png'; break;

														case 'zip':  $URLIM = HOMEDIR.DS.'app/views/assets/images/im_zip.png';   break;

														case 'rar':  $URLIM = HOMEDIR.DS.'app/views/assets/images/im_zip.png';   break;

														case 'ppt':  $URLIM = HOMEDIR.DS.'app/views/assets/images/im_ppt.png';   break;

														case 'pptx': $URLIM = HOMEDIR.DS.'app/views/assets/images/im_ppt.png';   break;

														default:     $URLIM = HOMEDIR.DS.'app/plugins/meta_uploads/'.$ima[$i];   break;

													}

													$nom = $c->GetDataFromTable('meta_documentos', 'url', $ima[$i], 'nombre', " ");

													$URL = HOMEDIR.DS.'app/plugins/meta_uploads/'.$ima[$i];

													$campo .= '  <div class="item '.$active.'">

		      													<img src="'.$URLIM.'" alt="..." title="'.$nom.'" width="100%">

		      													<div class="carousel-caption" style="padding:0px; background-color: rgba(0,0,0, 0.5);">'.$nom.' <a href="'.$URL.'" target="_blank" style="color:#FB8902"><b>Descargar</b></a></div>

		    												</div>';

												}

											}



					$campo .= '			</div>

										    <!-- Controls -->

											<a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">

										    	<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>

										    	<span class="sr-only">Previous</span>

										  	</a>

											<a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">

											    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>

											    <span class="sr-only">Next</span>

											</a>

									</div>

									<!--</ul>-->

								</div>

						 		';

				}

				$nrline = "<br>";	



				break;

			case '8':

				$popover = "";

				if ($l->GetObservacion() != "") {

					$popover =  "<span $placement class='fa fa-question-circle-o' style='cursor:pointer' data-toggle='popover' data-trigger='hover' data-content='".$l->GetObservacion()."'></span>";

				}

				$titulo = "<label for='elm".$l->GetId()."'>".$l->GetTitulo_campo()."  $popover</label> ";

				$columnas = $l->GetColumnas();



				if ($mayeditform == true) {

					$campo =  "<input type='number' style='height: 34px !important; margin-top:0px' class='form-control $obligatorio'  onBlur='HideField(\"".$object->GetId()."\")' name='t_".$object->GetId()."' id='t_".$object->GetId()."'  placeholder='".$l->GetPlaceholder()."'  value='".$object->GetValor()."'>";

				}else{

					$campo = $object->GetValor();

				}

				

				$nrline = "<br>";				

				break;

			case '9':

				$popover = "";

				if ($l->GetObservacion() != "") {

					$popover =  "<span $placement class='fa fa-question-circle-o' style='cursor:pointer' data-toggle='popover' data-trigger='hover' data-content='".$l->GetObservacion()."'></span>";

				}

				$titulo = "<label for='elm".$l->GetId()."'>".$l->GetTitulo_campo()."  $popover</label> ";

				$columnas = $l->GetColumnas();



				if ($mayeditform == true) {

					$campo =  "<input type='date' style='height: 34px !important; margin-top:0px' class='form-control $obligatorio'  onBlur='HideField(\"".$object->GetId()."\")' name='t_".$object->GetId()."' id='t_".$object->GetId()."'  placeholder='".$l->GetPlaceholder()."'  value='".$object->GetValor()."'>";

				}else{

					$campo = $object->GetValor();

				}

				

				$nrline = "<br>";



				break;

			case '10':

				$popover = "";

				if ($l->GetObservacion() != "") {

					$popover =  "<span $placement class='fa fa-question-circle-o' style='cursor:pointer' data-toggle='popover' data-trigger='hover' data-content='".$l->GetObservacion()."'></span>";

				}

				$titulo = "<label for='elm".$l->GetId()."'>".$l->GetTitulo_campo()."  $popover</label> ";

				$columnas = $l->GetColumnas();



				if ($mayeditform == true) {

					$campo =  "<input type='email' style='height: 34px !important; margin-top:0px' class='form-control $obligatorio'  onBlur='HideField(\"".$object->GetId()."\")' name='t_".$object->GetId()."' id='t_".$object->GetId()."'  placeholder='".$l->GetPlaceholder()."' value='".$object->GetValor()."'>";

				}else{

					$campo = $object->GetValor();

				}

				

				$nrline = "<br>";	



				break;

			case '11':



				$lx = new MMeta_listas;

				$lx->CreateMeta_listas("id", $l->GetId_lista());



				$popover = "";

				if ($l->GetObservacion() != "") {

					$popover =  "<span $placement class='fa fa-question-circle-o' style='cursor:pointer' data-toggle='popover' data-trigger='hover' data-content='".$l->GetObservacion()."'></span>";

				}

				if ($lx->GetDependencia() == "0") {



					$lista = new MMeta_Listas_valores;

					$ql = $lista->ListarMeta_listas_valores("where id_lista = '".$l->GetId_lista()."'");



					$options = "";

					while ($rowb = $con->FetchAssoc($ql)) {

						$checkedcheck = "";

						if ($rowb['valor'] == $object->GetValor()) {

							$checkedcheck = "selected='selected'";

						}

						$options .= "<option value='".$rowb['valor']."' $checkedcheck>".$rowb['titulo']."</option>";

					}







					$titulo = "<label for='elm".$l->GetId()."'>".$l->GetTitulo_campo()."  $popover</label> ";

					$columnas = $l->GetColumnas();



					if ($mayeditform == true) {

						$campo  = "<select class='form-control $obligatorio select2_1'  onChange='HideField(\"".$object->GetId()."\")' name='t_".$object->GetId()."' id='t_".$object->GetId()."' style='margin-top:0px' ><option value='0'>Seleccione una Opción</option>$options</select>";

					}else{

						$myval = $con->Query("select titulo from meta_listas_valores where id_lista = '".$lx->GetId()."' and valor = '".$object->GetValor()."'");

						$dat = $con->Result($myval, 0, 'titulo');

						$campo = $dat;

					}

					$nrline = "<br>";	

				}else{

					$columnas = "6";

					$titulo =  "<h4>".$l->GetTitulo_campo()." $popover</h4>";



					$dep = new MMeta_listas;

					$dep->CreateMeta_listas("id", $lx->GetDependencia());



					

					//este valor se define para cargar de manera predeterminada la dependencia principal, se colocara igual abajo para cargar la dependencia raiz

					$dis = "";

					if ($object->GetValor() == "") {

						$dis = "disabled";



						$listadep = new MMeta_Listas_valores;

						$qldep = $listadep->ListarMeta_listas_valores("where id_lista = '".$dep->GetId()."'");



						$mainlist = "";

						while ($rowbdep = $con->FetchAssoc($qldep)) {

							$mainlist .= "<option value='".$rowbdep['valor']."'>".$rowbdep['titulo']."</option>";

						}

					}else{

						$myval = $con->Query("select dependencia from meta_listas_valores where id_lista = '".$lx->GetId()."' and valor = '".$object->GetValor()."'");

						$dat = $con->Result($myval, 0, 'dependencia');



						$listadep = new MMeta_Listas_valores;

						$qldep = $listadep->ListarMeta_listas_valores("where id_lista = '".$dep->GetId()."'");



						$mainlist = "";

						while ($rowbdep = $con->FetchAssoc($qldep)) {

							$sel = "";

							if ($dat == $rowbdep['valor']) {

								$sel = "selected = 'selected'";

							}

							$mainlist .= "<option value='".$rowbdep['valor']."' $sel>".$rowbdep['titulo']."</option>";

						}





						$lista = new MMeta_Listas_valores;

						$ql = $lista->ListarMeta_listas_valores("where id_lista = '".$l->GetId_lista()."' and dependencia = '$dat'");



						$options = "";

						while ($rowb = $con->FetchAssoc($ql)) {

							$checkedcheck = "";

							if ($rowb['valor'] == $object->GetValor()) {

								$checkedcheck = "selected='selected'";

							}

							$options .= "<option value='".$rowb['valor']."' $checkedcheck>".$rowb['titulo']."</option>";

						}



						#"mostrar lista de dependencia seleccionar campo activo y activar dependencia de abajo";

					}

					

					$campo  = "<div class='row'>

								<div class='col-md-6'>

									".$dep->GetTitulo()."<br>";

					$campo  .= "	<select class='form-control select2_1' onChange='SetDependencia(\"".$object->GetId()."\", \"".$lx->GetId()."\")' id='dep_".$object->GetId()."' style='margin-top:0px'><option value='0'>Seleccione una Opción</option>$mainlist</select>";

					$campo  .= "</div>

								<div class='col-md-6'>

									".$lx->GetTitulo()."<br>";

					$campo  .= "	<select class='form-control $obligatorio select2_1' $dis onChange='HideField(\"".$object->GetId()."\")' name='t_".$object->GetId()."' id='t_".$object->GetId()."' style='margin-top:0px' >

										<option value='0'>Seleccione una Opción</option>$options</select>";

					$campo  .= "</div>

							</div>";

					$nrline = "";	

				}

				

				#  value='".$object->GetValor()."'



				break;

			case '12':

				$lista = new MMeta_Listas_valores;

				$ql = $lista->ListarMeta_listas_valores("where id_lista = '".$l->GetId_lista()."'");



				$value= explode(",", $object->GetValor());



				$options = "";



				for ($i=0; $i < count($value) ; $i++) { 

					$value[$i] = trim($value[$i]);

				}



				while ($rowb = $con->FetchAssoc($ql)) {

					$checkedcheck = "";



					if ($mayeditform == true) {

						if (in_array(trim($rowb['valor']), $value)) {

							$checkedcheck = "checked='checked'";

						}

						$options .= "<div><label><input type='checkbox' class='mychecklist".$object->GetId()."' name='t_".$object->GetId()."[]' id='t_".$object->GetId()."' onClick='EnviarElementosListas(\"".$object->GetId()."\")' value='".$rowb['valor']."' $checkedcheck><span class='p-l-10'>".$rowb['titulo']."</span></label></div>";

					}else{

						if (in_array(trim($rowb['titulo']), $value)) {

							$options .= $rowb['titulo'].", ";

						}

					}



					

					

				}

				$popover = "";

				if ($l->GetObservacion() != "") {

					$popover =  "<span $placement class='fa fa-question-circle-o' style='cursor:pointer' data-toggle='popover' data-trigger='hover' data-content='".$l->GetObservacion()."'></span>";

				}

				$titulo = "<label for='elm".$l->GetId()."'>".$l->GetTitulo_campo()."  $popover</label> ";

				$columnas = $l->GetColumnas();



				$campo =  $options;

				$nrline = "<br>";	



				break;

			case '13':

				$popover = "";

				$campo = "";

				$columnas = 12;

				$titulo =  "<hr style='width:100%'>";

				$nrline = "";				



				break;

			case '14':

				$popover = "";

				$campo = "";

				$columnas = 12;

				$titulo =  "<h2>".$l->GetTitulo_campo()."</h2>";

				$nrline = "";				



				break;

			case '15':

				$popover = "";

				$campo = "";

				$columnas = 12;

				$titulo =  "<h4>".$l->GetTitulo_campo()."</h4>";

				$nrline = "";				



				break;

			default:

				$popover = "";

				if ($l->GetObservacion() != "") {

					$popover =  "<span $placement class='fa fa-question-circle-o' style='cursor:pointer' data-toggle='popover' data-trigger='hover' data-content='".$l->GetObservacion()."'></span>";

				}

				$titulo = "<label for='elm".$l->GetId()."'>".$l->GetTitulo_campo()."  $popover</label> ";

				$columnas = $l->GetColumnas();



				if ($mayeditform == true) {

					$campo =  "<input type='text' style='margin-top:0px' class='form-control $obligatorio'  onBlur='HideField(\"".$object->GetId()."\")' name='t_".$object->GetId()."' id='t_".$object->GetId()."'  placeholder='".$l->GetPlaceholder()."'  value='".$object->GetValor()."'>";

				}else{

					$campo = $object->GetValor();

				}

				

				$nrline = "<br>";				

				break;

		}



		if ($vista == "small") {

			$columnas = "12";

		}

		$validar = "";

		if ($l->GetValidar() != "") {

			switch ($l->GetValidar()) {

				case 'existence':

					$sel = $con->Query("select * from meta_big_data where campo_id = '".$l->GetId()."' and valor = '".$object->GetValor()."'");

					$selt = $con->NumRows($sel);

					if ($selt > 1) {

						$listadoe = "";

						while ($rx = $con->FetchAssoc($sel)) {

							if ($rx['id'] != $object->GetId()) {

								$listadoe .= $c->GetDataFromTable("gestion", "id", $rx['type_id'], "observacion, min_rad", " - ");

								$listadoe .= ",";

							

							}

						}

						$validar = "<span style='color:#F00'>ENTRADA DUPLICADA <span $placement class='fa fa-question-circle-o' style='cursor:pointer' data-toggle='popover' data-trigger='hover' data-content='".$listadoe."'></span></span>";

					}

					break;



				case 'unique':

					$validar = "ay ay ay!";

					break;	

				

				default:

					$validar = "";

					break;

			}

		}

		echo '

				

					<!--<div class="col-md-'.$columnas.' col-xs-12 col-sm-12" align="right" style="margin-top: 5px;">

					</div>-->

					<div class="col-md-'.$columnas.' m-b-10">

						<b>'.$titulo." ".$validar.'</b>'.$nrline.'

						'.$campo .'

					</div>

				';





		#echo "hola: ".$rowmbd['campo_id'].'<br>';

		$i++;

	}





?>



<style type="text/css">

	

	.text_regular{

		font-weight: bold;

		color: #000;

		cursor: pointer;

		border:1px dashed #CCC;

		height: 30px;

		line-height: 30px;

		padding-left:7px !important;

		border-radius: 4px;

	}

	.text_regular:hover{

		text-decoration: underline;

	}

	.input_regular{

		display: none;

	}



	.popover{

		z-index: 99999;

		width: 300px !important;

	}

	.select2-selection__rendered{

		display:none;

	}



</style>

<script>

$(document).ready(function(){



    $('[data-toggle="tooltip"]').tooltip(); 

    $('[data-toggle="popover"]').popover();

});

(function($) {



	if ($('.select2_1').length) $(".select2_1").select2();



})(jQuery);











	function ShowField(id){

		$("#text_"+id).css("display", "none");

		$("#input_"+id).css("display", "block");

		$("#t_"+id).focus();

	}



	function HideField(id){

		$("#text_"+id).css("display", "block");

		$("#input_"+id).css("display", "none");



		var val = $("#t_"+id).val();

		str = "valor="+val+"&id="+id;



		$("#text_"+id).html(val);

		$.ajax({

			type: "POST",

			url: "/meta_big_data/actualizar/",

			data: str,

			success:function(msg){

				result = msg;

				//$("#update_field").html("<div class='alert alert-info'>"+result+"</div>");

			}

		});

	}



	function EnviarElementosListas(id){



		var selected = ''; 

        

		var selected = '';    

        $('.mychecklist'+id+'').each(function(){

            if (this.checked) {

                selected += $(this).val()+', ';

            }

        }); 





		str = "valor="+selected+"&id="+id;



		$.ajax({

			type: "POST",

			url: "/meta_big_data/actualizar/",

			data: str,

			success:function(msg){

				result = msg;

				//$("#update_field").html("<div class='alert alert-info'>"+result+"</div>");

			}

		});

	}



	function SetDependencia(lista, id_lista){



	    var code = $("#dep_"+lista).val();



	    $.get("/meta_big_data/detdependencia/"+code+"/"+id_lista+"/", { code: code }, function(resultado){

	        if(resultado == false){

	            $("#t_"+lista).attr("disabled",true);

	            $("#t_"+lista).addClass("disabled");

	        }else{

	            $("#t_"+lista).attr("disabled",false);

	            $("#t_"+lista).removeClass("disabled");

	            document.getElementById("t_"+lista).options.length=1;

	            $('#t_'+lista).append(resultado);            

	        }

	    }); 





	}





</script>