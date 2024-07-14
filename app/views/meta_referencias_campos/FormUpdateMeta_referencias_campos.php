	
	<form id='FormUpdatemeta_referencias_campos' action='/meta_referencias_campos/actualizar/' method='POST'> 

		<div class="tmain">Actualizar Elemento un nuevo Elemento</div>
		<div class="row">
			<div class="col-md-8">
				<input type='hidden' name='id' id='id' value='<? echo $object -> GetId(); ?>' />
				<input type='text' class='form-control' placeholder='Titulo_campo' name='titulo_campo' id='titulo_campo' maxlength='300'  value='<? echo $object -> Gettitulo_campo(); ?>'  />
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<div class="form-group form-group-lg">
						<select class="form-control" name='columnas' id='columnas' >
							<option value="12" <?= ($object->GetColumnas() == "12" || $object->GetColumnas() == "0")?"selected='selected'":"" ?>>12 Columnas</option>
							<option value="11" <?= ($object->GetColumnas() == "11")?"selected='selected'":"" ?>>11 Columnas</option>
							<option value="10" <?= ($object->GetColumnas() == "10")?"selected='selected'":"" ?>>10 Columnas</option>
							<option value="9" <?= ($object->GetColumnas() == "9")?"selected='selected'":"" ?>>9 Columnas</option>
							<option value="8" <?= ($object->GetColumnas() == "8")?"selected='selected'":"" ?>>8 Columnas</option>
							<option value="7" <?= ($object->GetColumnas() == "7")?"selected='selected'":"" ?>>7 Columnas</option>
							<option value="6" <?= ($object->GetColumnas() == "6")?"selected='selected'":"" ?>>6 Columnas</option>
							<option value="5" <?= ($object->GetColumnas() == "5")?"selected='selected'":"" ?>>5 Columnas</option>
							<option value="4" <?= ($object->GetColumnas() == "4")?"selected='selected'":"" ?>>4 Columnas</option>
							<option value="3" <?= ($object->GetColumnas() == "3")?"selected='selected'":"" ?>>3 Columnas</option>
							<option value="2" <?= ($object->GetColumnas() == "2")?"selected='selected'":"" ?>>2 Columnas</option>
							<option value="1" <?= ($object->GetColumnas() == "1")?"selected='selected'":"" ?>>1 Columna</option>
						</select>
					</div>
				</div>
			</div>
		</div>
		<br>

		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<div class="form-group form-group-lg">
						<select class="form-control" name='tipo_elemento' id='tipo_elemento' >
							<option value="5">Tipo de Elemento</option>		
							<?
								$lis = new MMeta_tipos_elementos;
								$q = $lis->ListarMeta_tipos_elementos();
								while ($row = $con->FetchAssoc($q)) {

									echo "<option value='".$row['id']."'>".$row['nombre']."</option>";
								}
							?>			
						</select>
					</div>
					<select name="id_lista" id="id_lista" class="form-control input-sm" style="display: none">
						<option value="0">Seleccione una Lista</option>
					</select>
					<script type="text/javascript">

						$("#tipo_elemento").change(function(){
							var idr = 0;
							$("#id_lista").css("display", "none");
							
							if ($(this).val() == "11") {
								idr = "1";
								$("body").css("cursor", "wait");
							}else if($(this).val() == "12"){
								idr = "2";
								$("body").css("cursor", "wait");
							}else{
								idr = "0";
								$("body").css("cursor", "default");
							}

							if (idr != "0") {
								alert("Cargando lista de opciones...");
								$.ajax({
							        type: 'POST',
							        url: "/meta_listas/GetListax/"+idr+"/",
							        success: function(msg){
							            result = msg;
							            $('#id_lista').html(result);
							            $("#id_lista").css("display", "block");
							            $("body").css("cursor", "default");
							            //$('#'+where).slideDown('fast');
							        }
							    }); 
							};

						})

						$("#tipo_elemento option[value=<?= $object -> Gettipo_elemento() ?>]").attr("selected","selected");
						<?
							if ($object -> Gettipo_elemento() == "11") {
						?>
								alert("Cargando lista de opciones...");
								$.ajax({
							        type: 'POST',
							        url: "/meta_listas/GetListax/1/",
							        success: function(msg){
							            result = msg;
							            $('#id_lista').html(result);
							            $("#id_lista").css("display", "block");
							            $("#id_lista option[value=<?= $object -> GetId_lista() ?>]").attr("selected","selected");
							            //$('#'+where).slideDown('fast');
							        }
							    }); 
						<?
							}elseif($object -> Gettipo_elemento() == "12") {
						?>
								alert("Cargando lista de opciones...");
								$.ajax({
							        type: 'POST',
							        url: "/meta_listas/GetListax/2/",
							        success: function(msg){
							            result = msg;
							            $('#id_lista').html(result);
							            $("#id_lista").css("display", "block");
							            $("#id_lista option[value=<?= $object -> GetId_lista() ?>]").attr("selected","selected");
							            //$('#'+where).slideDown('fast');
							        }
							    }); 

						<?
							}
						?>
					</script>
				</div>
			</div>
			<div class="col-md-6">

				<div class="checkbox">
					<label>
					    <input type="checkbox" name="visible" id="visible" <?= ($object->Getvisible() == "1")?"checked":"" ?>>
					    Invisible Al Publico
					</label>
				</div>
				<div class="checkbox">
				  	<label>
				    	<input type="checkbox" name="es_obligatorio" id="es_obligatorio" <?= ($object->Getes_obligatorio() == "1")?"checked":"" ?>>
				    	Campo Obligatorio
				  	</label>
				</div>
			</div>
			<div class="col-md-12">
				<input type='text' class='form-control' placeholder='Ejemplo' name='placeholder' id='placeholder' maxlength='300' value="<? echo $object->GetPlaceholder() ?>" />
			</div>
		</div>
		<div class="row"  style="margin-top:15px;">
			<div class="col-md-12">
				<textarea class="form-control" placeholder='Observacion' style="height: 100px;" name='observacion' id='observacion'><? echo $object -> Getobservacion(); ?></textarea>
			</div>
		</div>
		<div class="row" style="margin-top:15px">
			<div class="col-md-12" id="s_valor_generico">
				<select class='form-control' id='valor_generico' name='valor_generico' onchange="IsOtro()">
					<option value="<?= $object->GetValor_generico() ?>"><?= $object->GetValor_generico() ?></option>
					<option value="" <?= ("suscriptor" == $object->GetValor_generico()) ? 'selected' : ''; ?> >Valor Por Defecto</option>
					<option value="rad_externo" <?= ("rad_externo" == $object->GetValor_generico()) ? 'selected' : ''; ?> >Radicado Externo</option>
					<option value="rad_completo" <?= ("rad_completo" == $object->GetValor_generico()) ? 'selected' : ''; ?> >Radicado Completo</option>
					<option value="rad_rapido" <?= ("rad_rapido" == $object->GetValor_generico()) ? 'selected' : ''; ?> >Radicado Rapido</option>
					<option value="suscriptor" <?= ("suscriptor" == $object->GetValor_generico()) ? 'selected' : ''; ?> >Nombre del Suscriptor Principal</option>

					<option value="suscriptor_id" <?= ("suscriptor_id" == $object->GetValor_generico()) ? 'selected' : ''; ?> >Identificacion del Suscriptor Principal</option>
					<option value="suscriptor_cat" <?= ("suscriptor_cat" == $object->GetValor_generico()) ? 'selected' : ''; ?> >Categoria del Suscriptor Principal</option>
					<option value="suscriptor_dir" <?= ("suscriptor_dir" == $object->GetValor_generico()) ? 'selected' : ''; ?> >Direccion del Suscriptor Principal</option>
					<option value="suscriptor_ciu" <?= ("suscriptor_ciu" == $object->GetValor_generico()) ? 'selected' : ''; ?> >Ciudad del Suscriptor Principal</option>
					<option value="suscriptor_tel" <?= ("suscriptor_tel" == $object->GetValor_generico()) ? 'selected' : ''; ?> >Telefono del Suscriptor Principal</option>
					<option value="suscriptor_mail" <?= ("suscriptor_mail" == $object->GetValor_generico()) ? 'selected' : ''; ?> >Email del Suscriptor Principal</option>


					<option value="Estado" <?= ("Estado" == $object->GetValor_generico()) ? 'selected' : ''; ?> >Estado de la Solicitud</option>
					<option value="Fecha_registro" <?= ("Fecha_registro" == $object->GetValor_generico()) ? 'selected' : ''; ?> >Fecha de Ingreso</option>
					<option value="tipo_documento" <?= ("tipo_documento" == $object->GetValor_generico()) ? 'selected' : ''; ?> >Tipo de Documento</option>
					<option value="fecha_vence" <?= ("fecha_vence" == $object->GetValor_generico()) ? 'selected' : ''; ?> >Fecha de Vencimiento</option>
					<option value="Resuelto" <?= ("Resuelto" == $object->GetValor_generico()) ? 'selected' : ''; ?> >¿Resuelto?</option>
					<option value="fecha_respuesta" <?= ("fecha_respuesta" == $object->GetValor_generico()) ? 'selected' : ''; ?> >Fecha de Respuesta</option>
					<option value="prioridad" <?= ("prioridad" == $object->GetValor_generico()) ? 'selected' : ''; ?> >Prioridad</option>
					<option value="folios" <?= ("folios" == $object->GetValor_generico()) ? 'selected' : ''; ?> ># Folios</option>
					<option value="departamento" <?= ("departamento" == $object->GetValor_generico()) ? 'selected' : ''; ?> >Departamento de Origen</option>
					<option value="ciudad" <?= ("ciudad" == $object->GetValor_generico()) ? 'selected' : ''; ?> >Ciudad de Origen</option>
					<option value="oficina" <?= ("oficina" == $object->GetValor_generico()) ? 'selected' : ''; ?> >Oficina de Origen</option>
					<option value="area" <?= ("area" == $object->GetValor_generico()) ? 'selected' : ''; ?> >Area Asignada</option>
					<option value="responsable" <?= ("responsable" == $object->GetValor_generico()) ? 'selected' : ''; ?> >Usuario Responsable</option>
					<option value="serie" <?= ("serie" == $object->GetValor_generico()) ? 'selected' : ''; ?> >Serie Documental</option>
					<option value="sub_Serie" <?= ("sub_Serie" == $object->GetValor_generico()) ? 'selected' : ''; ?> >Sub Serie Documental</option>
					<option value="observacion" <?= ("observacion" == $object->GetValor_generico()) ? 'selected' : ''; ?> >Titulo del Expediente</option>
					<option value="ubicacion" <?= ("ubicacion" == $object->GetValor_generico()) ? 'selected' : ''; ?> >Ubicación</option>
					<option value="otro">otro</option>
			    </select>

			</div>

			<script>
	            	function IsOtro(){
	            		if ($("#valor_generico option:selected").val() == "otro") {
	            			$("#s_valor_generico").html("<input type='text' class='form-control' placeholder='Escriba el Valor por defecto para el Campo' name='valor_generico' id='valor_generico' maxlength='300' />");
	            		}
	            	}
	            </script>
		</div>
		<div class="row" style="margin-top:15px">
			<div class="col-md-12">
				<select class='form-control' id='validar' name='validar'>
					<option value="">No Validar</option>
					<option value="existence" <?= ("existence" == $object->GetValidar()) ? 'selected' : ''; ?> >Existencia del Valor</option>
					<option value="unique" <?= ("unique" == $object->GetValidar()) ? 'selected' : ''; ?> >Campo Único</option>
	            </select>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-md-8">
				<button type="button" class="btn btn-success fullwidth" onclick="SendForm('FormUpdatemeta_referencias_campos', '/meta_referencias_titulos/editar/<?= $object->GetId_referencia() ?>/','r<?= $object->GetId_referencia() ?>', 'inner-metadatosjs')">Guardar Formulario</button>
			</div>
			<div class="col-md-4">
				<button type="button" class="btn btn-danger fullwidth" onclick='EliminarMeta_referencias_campos(<?= $object->GetId() ?>)'>Eliminar</button>
			</div>
		</div>
	</form>