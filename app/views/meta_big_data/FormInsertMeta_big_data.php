<?
	$formulario = new MMeta_referencias_titulos;
	$formulario->CreateMeta_referencias_titulos("id", $ref_id);

	$campos = new MMeta_referencias_campos;
	$query = $campos->ListarMeta_referencias_campos("where id_referencia = '".$formulario->GetId()."'");

?>
	<form id='formmeta_big_data' action='/meta_big_data/registrar/' method='POST'> 
		<div class="row" class="margin:0px;">
			<div class="col-md-12">
				<div class="col-md-12">
					<?= "<h3 style='text-transform:uppercase'>REGISTRAR UN NUEVO ".$formulario->GetTitulo()."</h3>"; ?>
				</div>
			</div>
		</div>
		<div class="row" class="margin:0px;">
			<div class="col-md-12">
				<div class="col-md-12">

					<div class='col-md-4' style='margin-bottom:15px; display:none'>
						<label for='elmref'>Id del Formulario</label><br>
						<input type='text' class='form-control' name='id_form' id='elmref'  value="<?= $formulario->GetId() ?>">
					</div>
					<div class='col-md-4' style='margin-bottom:15px; display:none'>
						<label for='elmref'>Id del Suscriptor o Tipología o Form</label><br>
						<input type='text' class='form-control' name='id_suscriptor' id='elmref'  value="<?= $type_id ?>">
					</div>
					<div class='col-md-4' style='margin-bottom:15px; display:none'>
						<label for='elmref'>TOKEN DE GRUPO DE ELEMENTO.</label><br>
						<input type='text' class='form-control' name='grupo_id' id='elmref'  value="<?= $f->GenerarSmallId() ?>">
					</div>
		<?
			

			if($con->NumRows($query) <= 0 || $query !=''){

				while($row = $con->FetchAssoc($query)){
					$i++;
					$l = new MMeta_referencias_campos;
					$l->Createmeta_referencias_campos('id', $row[id]);

					$visible = ($l -> GetVisible() == "1")?"1":"0";
					$obligatorio = ($l -> GetEs_obligatorio() == "1")?'1':'0';

					$typeelm   = array("5"=>"fa-font", "6"=>"fa-font", "7"=>"fa-paperclip", "8"=>"fa-sort-numeric-asc", "9"=>"fa-calendar", "10"=>"fa-at", "11"=>"fa-list", "12"=>"fa-check-square-o");
					$typeelm_d = $c->GetDataFromTable("meta_tipos_elementos", "id", $l->GetTipo_elemento(), "nombre", "");

					switch ($l->GetTipo_elemento()) {
						case '5':
							echo "	<div class='col-md-4' style='margin-bottom:15px;'>
										<label for='elm".$l->GetId()."'>".$l->GetTitulo_campo()."</label> <span class='fa fa-question-circle-o' style='cursor:pointer' data-toggle='popover' data-trigger='hover' title='".$l->GetTitulo_campo()."' data-content='".$l->GetObservacion()."'></span><br>
										<input type='text' class='form-control' name='C_T_".$l->GetId()."' id='elm".$l->GetId()."' placeholder='".$l->GetTitulo_campo()."'>
									</div>";
							break;
						case '6':
							echo "	<div class='col-md-8' style='margin-bottom:15px;'>
										<label for='elm".$l->GetId()."'>".$l->GetTitulo_campo()."</label> <span class='fa fa-question-circle-o' style='cursor:pointer' data-toggle='popover' data-trigger='hover' title='".$l->GetTitulo_campo()."' data-content='".$l->GetObservacion()."'></span><br>
										<textarea  class='form-control' name='C_T_".$l->GetId()."' id='elm".$l->GetId()."' placeholder='".$l->GetTitulo_campo()."'></textarea>
									</div>";
							break;
						case '7':
							echo "	<div class='col-md-4' style='margin-bottom:15px;'>
										<label for='elm".$l->GetId()."'>".$l->GetTitulo_campo()."</label> <span class='fa fa-question-circle-o' style='cursor:pointer' data-toggle='popover' data-trigger='hover' title='".$l->GetTitulo_campo()."' data-content='".$l->GetObservacion()."'></span><br>".'

										<button  type="button" id="buscarimagenes'.$l->GetId().'" class="btn btn-primary"><span class="fa fa-search"></span> Buscar</button>
										<button  type="button" id="enviarboton'.$l->GetId().'" class="btn btn-success"><span class="fa fa-upload"></span> Cargar Documentos</button>
										<div id="minilista'.$l->GetId().'">
											<ul id="innerlista'.$l->GetId().'">
												<li>No sea han seleccionado archivos</li>
											</ul>
										</div>
										<script type="text/javascript">
											
											$("#buscarimagenes'.$l->GetId().'").click(function() {
												$(".selfile").click();
												$("#fmid").html("'.$l->GetId().'")
											});
											$("#enviarboton'.$l->GetId().'").click(function(){
												$("body").css("cursor", "wait");
										    	$("#sendfiles").submit();
										    })

										</script>
								 		'."<input type='hidden' class='form-control' name='C_F_".$l->GetId()."' id='elm".$l->GetId()."' placeholder='".$l->GetTitulo_campo()."'>
									</div>";
							break;
						case '8':
							echo "	<div class='col-md-4' style='margin-bottom:15px;'>
										<label for='elm".$l->GetId()."'>".$l->GetTitulo_campo()."</label> <span class='fa fa-question-circle-o' style='cursor:pointer' data-toggle='popover' data-trigger='hover' title='".$l->GetTitulo_campo()."' data-content='".$l->GetObservacion()."'></span><br>
										<input type='number' style='height: 34px !important;' class='form-control' name='C_T_".$l->GetId()."' id='elm".$l->GetId()."' placeholder='".$l->GetTitulo_campo()."'>
									</div>";
							break;
						case '9':
							echo "	<div class='col-md-4' style='margin-bottom:15px;'>
										<label for='elm".$l->GetId()."'>".$l->GetTitulo_campo()."</label> <span class='fa fa-question-circle-o' style='cursor:pointer' data-toggle='popover' data-trigger='hover' title='".$l->GetTitulo_campo()."' data-content='".$l->GetObservacion()."'></span><br>
										<input type='date' style='height: 34px !important;' class='form-control' name='C_T_".$l->GetId()."' id='elm".$l->GetId()."' placeholder='".$l->GetTitulo_campo()."'>
									</div>";
							break;
						case '10':
							echo "	<div class='col-md-4' style='margin-bottom:15px;'>
										<label for='elm".$l->GetId()."'>".$l->GetTitulo_campo()."</label> <span class='fa fa-question-circle-o' style='cursor:pointer' data-toggle='popover' data-trigger='hover' title='".$l->GetTitulo_campo()."' data-content='".$l->GetObservacion()."'></span><br>
										<input type='email' style='height: 34px !important;' class='form-control' name='C_T_".$l->GetId()."' id='elm".$l->GetId()."' placeholder='".$l->GetTitulo_campo()."'>
									</div>";
							break;
						case '11':
							$lista = new MMeta_Listas_valores;
							$ql = $lista->ListarMeta_listas_valores("where id_lista = '".$l->GetId_lista()."'");

							$options = "<option value='0'>Seleccione una Opción</option>";
							while ($rowb = $con->FetchAssoc($ql)) {
								$options .= "<option value='".$rowb['titulo']."'>".$rowb['titulo']."</option>";
								# code...
							}
							echo "	<div class='col-md-4' style='margin-bottom:15px;'>
										<label for='elm".$l->GetId()."'>".$l->GetTitulo_campo()."</label> <span class='fa fa-question-circle-o' style='cursor:pointer' data-toggle='popover' data-trigger='hover' title='".$l->GetTitulo_campo()."' data-content='".$l->GetObservacion()."'></span><br>
										<select class='form-control' name='C_T_".$l->GetId()."' id='elm".$l->GetId()."' placeholder='".$l->GetTitulo_campo()."'>$options</select>
									</div>";
							break;
						case '12':
							$lista = new MMeta_Listas_valores;
							$ql = $lista->ListarMeta_listas_valores("where id_lista = '".$l->GetId_lista()."'");

							$options = "<b>".$l->GetTitulo_campo()."</b> <span class='fa fa-question-circle-o' style='cursor:pointer' data-toggle='popover' data-trigger='hover' title='".$l->GetTitulo_campo()."' data-content='".$l->GetObservacion()."'></span><br>";
							while ($rowb = $con->FetchAssoc($ql)) {
								$options .= "<div class='checkbox'><label><input type='checkbox' name='C_C_".$l->GetId()."[]' value='".$rowb['valor']."'>".$rowb['titulo']."</label></div>";
								
							}
							echo "	<div class='col-md-4' style='margin-bottom:15px;'>".$options."</div>";
							break;
						default:
							echo "	<div class='col-md-4' style='margin-bottom:15px;'>
										<label for='elm".$l->GetId()."'>".$l->GetTitulo_campo()."</label> <span class='fa fa-question-circle-o' style='cursor:pointer' data-toggle='popover' data-trigger='hover' title='".$l->GetTitulo_campo()."' data-content='".$l->GetObservacion()."'></span><br>
										<input type='text' class='form-control' name='C_".$l->GetId()."' id='elm".$l->GetId()."' placeholder='".$l->GetTitulo_campo()."'>
									</div>";
							break;
					}

					#echo "Campo: ".$l->GetTitulo_campo()." - Tipo de Elemento: ".$typeelm_d." - Campo Obligatorio: ".$obligatorio." Observacion: ".$l->GetObservacion()."<hr>";

				}
				echo '	<div class="row">
								<div class="col-md-12">
									<button type="submit" class="btn btn-success">Formulario</button>
								</div>
							</div><br>
				';
			}else{
				echo '<br><br><div class="alert alert-info" role="alert">No existen elementos en esta lista</div><br>';
			}
		?>
<!--		<div class='title right'>Formulario de meta_big_data </div>
		<input type='text' class='form-control' placeholder='Type_id' name='type_id' id='type_id' maxlength='10' />
		<input type='text' class='form-control' placeholder='Ref_id' name='ref_id' id='ref_id' maxlength='10' />
		<input type='text' class='form-control' placeholder='Campo_id' name='campo_id' id='campo_id' maxlength='10' />
		<input type='text' class='form-control' placeholder='Valor' name='valor' id='valor' maxlength='' />
		<input type='submit' value='Insertar'  style='margin:10px;'/>-->
				</div>
			</div>
		</div>
	</form>