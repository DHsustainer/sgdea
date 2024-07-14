<?	
	$db = new MMeta_big_data;
	
	$db->CreateMeta_big_data("grupo_id", $grupo_id);

	#echo "asdfasdf asdf asdf asd".$grupo_id;

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
			$con->Query("update meta_big_data set orden = '".$campos['orden']."' where id = '".$check['id']."' ");
		}
	}

	$primer = ' data-placement="bottom"';
	$ultimo = 'data-placement="top"';
	$default = 'data-placement="right"';

	$total = $con->NumRows($query);

	$i = 0;
	$query = $db->ListarMeta_big_data("WHERE grupo_id = '".$grupo_id."'", 'order by orden');
	
	$irow = 0;
	$rowpatho = "";
	$rowpathc = "";
	#Aqui empieza la pelicula
	#for ($i=0; $i < $con->NumRows($query) ; $i++) { 
		# code...
	#}
	while($row = $con->FetchAssoc($query)){
		$object = new MMeta_big_data;
		$object->CreateMeta_big_data("id", $row['id']);# $con->Result($query, $i, 'id'));
		$l = new MMeta_referencias_campos;
		$l->CreateMeta_referencias_campos("id", $row['campo_id']); #$con->Result($query, $i, 'campo_id'));


		$visible = ($l -> GetVisible() == "1")?"style='display:none'":"";
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
			$obligatorio = "required";
		}else{
			$obligatorio = "";
		}

		if ($l->GetValor_generico() != "") {
			$val = $object->GetValorGenerico($l->GetValor_generico(), $object->GetValor());
			$object->SetValor($val);
		}

		$validar = "";
		$dataroles = "";
		if ($l->GetValidar() != "") {
			switch ($l->GetValidar()) {
				case 'unique':
					$validar = "uniquekey";
					$dataroles = "data-role='".$l->GetId()."'";
					break;	
				
				default:
					$validar = "";
					break;
			}
		}

		switch ($l->GetTipo_elemento()) {
			case '5':
				$popover = "";
				if ($l->GetObservacion() != "") {
					$popover =  "<span $placement class='fa fa-question' style='cursor:pointer; margin-left:5px; color: #C00' data-toggle='popover' data-trigger='hover' data-content='".$l->GetObservacion()."'></span>";
				}
				$titulo = "<label for='t_".$object->GetId()."'>".$l->GetSlug()."  $popover <span id='lblt_".$object->GetId()."'></span></label>";
				$columnas = $l->GetColumnas();



				$campo = $object->GetValor();
				$nrline = "<br>";				
				break;
			case '6':
				$popover = "";
				if ($l->GetObservacion() != "") {
					$popover =  "<span $placement class='fa fa-question' style='cursor:pointer; margin-left:5px; color: #C00' data-toggle='popover' data-trigger='hover' data-content='".$l->GetObservacion()."'></span>";
				}
				$titulo = "<label for='t_".$object->GetId()."'>".$l->GetSlug()."  $popover <span id='lblt_".$object->GetId()."'></span></label>";
				$columnas = $l->GetColumnas();
				
				$campo = $object->GetValor();
				$nrline = "<br>";
				break;
			case '7':
				$popover = "";
				if ($l->GetObservacion() != "") {
					$popover =  "<span $placement class='fa fa-question' style='cursor:pointer; margin-left:5px; color: #C00' data-toggle='popover' data-trigger='hover' data-content='".$l->GetObservacion()."'></span>";
				}

				$titulo = "<label for='t_".$object->GetId()."'>".$l->GetSlug()."  $popover <span id='lblt_".$object->GetId()."'></span></label>";
				$columnas = $l->GetColumnas();

				

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
				$nrline = "<br>";
				break;
			case '8':
				$popover = "";
				if ($l->GetObservacion() != "") {
					$popover =  "<span $placement class='fa fa-question' style='cursor:pointer; margin-left:5px; color: #C00' data-toggle='popover' data-trigger='hover' data-content='".$l->GetObservacion()."'></span>";
				}
				$titulo = "<label for='t_".$object->GetId()."'>".$l->GetSlug()."  $popover <span id='lblt_".$object->GetId()."'></span></label>";
				$columnas = $l->GetColumnas();


				$campo = $object->GetValor();
				
				$nrline = "<br>";
				break;
			case '9':
				$popover = "";
				if ($l->GetObservacion() != "") {
					$popover =  "<span $placement class='fa fa-question' style='cursor:pointer; margin-left:5px; color: #C00' data-toggle='popover' data-trigger='hover' data-content='".$l->GetObservacion()."'></span>";
				}
				$titulo = "<label for='t_".$object->GetId()."'>".$l->GetSlug()."  $popover <span id='lblt_".$object->GetId()."'></span></label>";
				$columnas = $l->GetColumnas();


				$campo = $object->GetValor();
				
				$nrline = "<br>";
				break;
			case '10':
				$popover = "";
				if ($l->GetObservacion() != "") {
					$popover =  "<span $placement class='fa fa-question' style='cursor:pointer; margin-left:5px; color: #C00' data-toggle='popover' data-trigger='hover' data-content='".$l->GetObservacion()."'></span>";
				}
				$titulo = "<label for='t_".$object->GetId()."'>".$l->GetSlug()."  $popover <span id='lblt_".$object->GetId()."'></span></label>";
				$columnas = $l->GetColumnas();

				$campo = $object->GetValor();
				
				$nrline = "<br>";
				break;
			case '11':
				
				$lx = new MMeta_listas;
				$lx->CreateMeta_listas("id", $l->GetId_lista());

				$popover = "";
				if ($l->GetObservacion() != "") {
					$popover =  "<span $placement class='fa fa-question' style='cursor:pointer; margin-left:5px; color: #C00' data-toggle='popover' data-trigger='hover' data-content='".$l->GetObservacion()."'></span>";
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



					$titulo = "<label for='t_".$object->GetId()."'>".$l->GetSlug()."  $popover <span id='lblt_".$object->GetId()."'></span></label> ";
					$columnas = $l->GetColumnas();


					$myval = $con->Query("select titulo from meta_listas_valores where id_lista = '".$lx->GetId()."' and valor = '".$object->GetValor()."'");
					$dat = $con->Result($myval, 0, 'titulo');
					$campo = $dat;

					$nrline = "<br>";	
				}else{
					$columnas = "6";
					$titulo =  "<h4>".$l->GetSlug()." $popover</h4>";

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
					$campo  .= "	<select class='form-control select2_1' onChange='SetDependencia(\"".$object->GetId()."\", \"".$lx->GetId()."\")' id='dep_".$object->GetId()."' style='margin-top:0px; width:100%'><option value='0'>Seleccione una Opción</option>$mainlist</select>";
					$campo  .= "</div>
								<div class='col-md-6'>
									".$lx->GetTitulo()."<br>";
					$campo  .= "	<select class='form-control $obligatorio select2_1' $dis onChange='HideField(\"".$object->GetId()."\")' name='t_".$object->GetId()."' id='t_".$object->GetId()."' style='margin-top:0px; width:100%' >
										<option value='0'>Seleccione una Opción</option>$options</select>";
					$campo  .= "</div>
							</div>";
					$nrline = "";	
				}

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

					if (in_array(trim($rowb['titulo']), $value)) {
						$options .= $rowb['titulo'].", ";
					}					
				}
				$popover = "";
				if ($l->GetObservacion() != "") {
					$popover =  "<span $placement class='fa fa-question' style='cursor:pointer; margin-left:5px; color: #C00' data-toggle='popover' data-trigger='hover' data-content='".$l->GetObservacion()."'></span>";
				}
				$titulo = "<label for='t_".$object->GetId()."'>".$l->GetSlug()."  $popover <span id='lblt_".$object->GetId()."'></span></label>";
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
				$titulo =  "<h2>".$l->GetSlug()."</h2>";
				$nrline = "";
				break;
			case '15':
				$popover = "";
				$campo = "";
				$columnas = 12;
				$titulo =  "<h4>".$l->GetSlug()."</h4>";
				$nrline = "";
				break;
			default:
				$popover = "";
				if ($l->GetObservacion() != "") {
					$popover =  "<span $placement class='fa fa-question' style='cursor:pointer; margin-left:5px; color: #C00' data-toggle='popover' data-trigger='hover' data-content='".$l->GetObservacion()."'></span>";
				}
				$titulo = "<label for='t_".$object->GetId()."'>".$l->GetSlug()."  $popover <span id='lblt_".$object->GetId()."'></span></label>";
				$columnas = $l->GetColumnas();


				$campo = $object->GetValor();

				$nrline = "<br>";
				break;
		}

		echo '	<div class="col-md-12">
						<b>{'.$titulo.'}</b> : '.$campo.' \ '.$nrline.'
				</div>';
		#echo $rowpathc;


		#echo $row['campo_id'].'<br>';
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
	}
	.texto-danger {
	    color: #f44336;
	}
	.texto-success {
	    color: #4caf50;
	}
</style>
