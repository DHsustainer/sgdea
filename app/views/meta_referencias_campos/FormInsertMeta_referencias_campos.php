<form id='formmeta_referencias_campos' action='/meta_referencias_campos/registrar/' method='POST'> 
	<div class="tmain">Crear un nuevo Elemento</div>
	<input type='hidden' class='form-control' placeholder='Id_referencia' name='id_referencia' id='id_referencia' maxlength='45' value="<?= $object->GetId() ?>" />
	
	<div class="row">
		<div class="col-md-8">
			<input type='text' class='form-control' placeholder='Titulo_campo' name='titulo_campo' id='titulo_campo' maxlength='300' />
		</div>
		<div class="col-md-4">
			<div class="form-group">
				<div class="form-group form-group-lg">
					<select class="form-control" name='columnas' id='columnas' >
						<option value="12">Num Cols</option>
						<option value="12">12 Columnas</option>
						<option value="11">11 Columnas</option>
						<option value="10">10 Columnas</option>
						<option value="9">9 Columnas</option>
						<option value="8">8 Columnas</option>
						<option value="7">7 Columnas</option>
						<option value="6">6 Columnas</option>
						<option value="5">5 Columnas</option>
						<option value="4">4 Columnas</option>
						<option value="3">3 Columnas</option>
						<option value="2">2 Columnas</option>
						<option value="1">1 Columna</option>
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
				</script>
			</div>
		</div>
		<div class="col-md-6">

			<div class="checkbox">
				<label>
				    <input type="checkbox" name="visible" id="visible">
				    Invisible Al Publico
				</label>
			</div>
			<div class="checkbox">
			  	<label>
			    	<input type="checkbox" name="es_obligatorio" id="es_obligatorio">
			    	Campo Obligatorio
			  	</label>
			</div>
		</div>

		<div class="col-md-12">
			<input type='text' class='form-control' placeholder='Ejemplo' name='placeholder' id='placeholder' maxlength='300' />
		</div>

	</div>
	<div class="row" style="margin-top:15px;">
		<div class="col-md-12">
			<textarea class="form-control" style="height: 100px" placeholder='Observacion' name='observacion' id='observacion'></textarea>
		</div>
	</div>
	<div class="row" style="margin-top:15px">
		<div class="col-md-12" id="s_valor_generico">
			<select class='form-control' id='valor_generico' name='valor_generico' onchange="IsOtro()">
				<option value="">Valor Por Defecto</option>
				<option value="rad_externo">Radicado Externo</option>
				<option value="rad_completo">Radicado Completo</option>
				<option value="rad_rapido">Radicado Rapido</option>
				<option value="Suscriptor">Nombre del Suscriptor Principal</option>
				<option value="suscriptor_id">Identificacion del Suscriptor Principal</option>
				<option value="suscriptor_cat">Categoria del Suscriptor Principal</option>
				<option value="suscriptor_dir">Direccion del Suscriptor Principal</option>
				<option value="suscriptor_ciu">Ciudad del Suscriptor Principal</option>
				<option value="suscriptor_tel">Telefono del Suscriptor Principal</option>
				<option value="suscriptor_mail">Email del Suscriptor Principal</option>
				<option value="Estado">Estado de la Solicitud</option>
				<option value="Fecha_registro">Fecha de Ingreso</option>
				<option value="tipo_documento">Tipo de Documento</option>
				<option value="fecha_vence">Fecha de Vencimiento</option>
				<option value="Resuelto">¿Resuelto?</option>
				<option value="fecha_respuesta">Fecha de Respuesta</option>
				<option value="prioridad">Prioridad</option>
				<option value="folios"># Folios</option>
				<option value="departamento">Departamento de Origen</option>
				<option value="ciudad">Ciudad de Origen</option>
				<option value="oficina">Oficina de Origen</option>
				<option value="area">Area Asignada</option>
				<option value="responsable">Usuario Responsable</option>
				<option value="serie">Serie Documental</option>
				<option value="sub_Serie">Sub Serie Documental</option>
				<option value="observacion">Titulo del Expediente</option>
				<option value="ubicacion">Ubicación</option>
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
				<option value="existence">Existencia del Valor</option>
				<option value="unique">Campo Único</option>
            </select>
		</div>
	</div>
	<br>
	<div class="row">
		<div class="col-md-12">
			<button type="button" class="btn btn-success fullwidth" onclick="SendForm('formmeta_referencias_campos', '/meta_referencias_titulos/editar/<?= $object->GetId() ?>/','r<?= $object->GetId() ?>', 'inner-metadatosjs')">Guardar Formulario</button>
		</div>
	</div>
</form>