<div id="tools-content-ps">
	<a href="/proceso/nuevo/"><div class="opc-folder blue"><div class="ico-content-ps"><div class="icon plus hight-blue"></div></div><div class="text-folder">Crear carpeta</div></div></a>
	<div id="tools-content-ps-sub">
		<div class="opc-folder normal active" onclick="show_folder('all-fl',this);"><div class="icon users-f normal-ic"></div></div>
		<div class="opc-folder normal" onclick="show_folder('fl-jur',this);"><div class="icon juridico-f normal-ic"></div></div>
		<div class="opc-folder normal" onclick="show_folder('fl-nat',this);"><div class="icon natural-f normal-ic"></div></div>
	</div>
	
</div>
<div id="folders-content">
	<div id="folders-list-content-cara-select">
		<?=$unique?>
	</div>
	<div id="folders-list-content-cara">
		<?=$result?>
	</div>
	<div id="proces-list-content-cara">
		<div id="form">
			<form id="new_caratula" action="/caratula/registrar/" method="POST">
				<table class="tbd">
					<tr>
						<td style="width:65%">
							<div class="title" style="height:35px; line-height: 35px;">
								<div style="float:left"><b>Crear un proceso en la carpeta: "<?= $folders ?>"</b></div>
							</div>
							<input type="hidden" name="folder_id" id="folder_id" value="<?=$id?>" >
							<table class="left">
								<tr class="impar">
									<td width="150">Título del Proceso:</td>
									<td><input type='text' style="width:350px;" name='tit_demanda' class='input1_0'></td>
								</tr>
								<tr class="par">
									<td width="150">Nombre de Entidad:</td>
									<td><input type='text' style="width:350px;" name='juzgado' class='input1_0'></td>
								</tr>
								<tr class="impar">
									<td width="150">Dirección de Entidad:</td>
									<td><input type='text' style="width:350px;" name='dir_juz' class='input1_0'></td>
								</tr>
								<script>
									
									$(document).ready(function() {
										dependencia_estado('departamento');
	
										$("#departamento").change(function(){
											dependencia_ciudad("departamento","ciudad");
										});
									});

								</script>
								<tr class="par">
									<td width="150">Departamento de Entidad:</td>
									<td>
										<select style="width:350px; height:35px;" name="departamento" id="departamento" class='input1_0'>
											<option value="">Seleccione un Departamento</option>
										</select>
									</td>
								</tr>
								<tr class="impar">
									<td width="150">Ciudad de Entidad:</td>
									<td>
										<select style="width:350px; height:35px;" name="ciudad" id="ciudad" class='input1_0' disabled="disabled">
											<option value="">Seleccione una Ciudad</option>
										</select>
									</td>
								</tr>

								<tr class="par">
									<td width="150">Teléfono de Entidad:</td>
									<td><input type='text' style="width:350px;" name='tel_juz' class='input1_0'></td>
								</tr>
								<tr class="impar">
									<td width="150">Email de Entidad:</td>
									<td><input type='text' style="width:350px;" name='email_juz' class='input1_0'></td>
								</tr>
								<tr class='par'>
									<td width="150">Naturaleza:</td>
									<td><input type='text' style="width:350px;" name='tip_demanda' class='input1_0'></td>
								</tr>
								<tr class='impar'>
									<td width="150">Radicado completo:</td>
									<td><input type='text' style="width:350px;" name='rad_completo' class='input1_0'></td>
								</tr>
								<tr class='par'>
									<td width="150">Radicado:</td>
									<td><input type='text' style="width:350px;" name='rad' class='input1_0'></td>
								</tr>
								<tr class='impar'>
									<td width="150">Valor:</td>
									<td><input type='text' style="width:350px;" name='val_demanda' class='input1_0'></td>
								</tr>
								<tr class="par">
									<td width="150">Fecha de presentación:</td>
									<td><input type='text' style="width:350px;" name='fec_pres' class='input1_0 datepicker'></td>
								</tr>
								<tr class="impar">
									<td width="150">Fecha de Admisión:</td>
									<td><input type='text' style="width:350px;" name='fec_auto' class='input1_0 datepicker'></td>
								</tr>
								<tr class='par'>
									<td width="150">Número:</td>
									<td><input type='text' style="width:350px;" name='num_oficio' class='input1_0'></td>
								</tr>
								<tr class='impar'>
									<td width="150">Estado del Proceso:</td>
									<td>
										<select style="width:350px; height:35px;" name="est_proceso" id="est_proceso" class='input1_0'>
				                            <option value="DESACTIVAR">Sin Iniciar</option>
				                            <option value="ACTIVO">En Curso</option>
				                            <option value="ARCHIVADO">Archivado</option>
						                </select>
									</td>
								</tr>
								<tr>
									<td colspan="2"><input type="submit" value="Finalizar"></div></td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</div>

			<div id="dem" style="display:none">
				<table>
					<tr>
						<td>
							<span>Nombre <span class='obligatorio'>*</span></span>
						</td>
						<td>
							<span><input name='demj_nombre' id='nom_j' type='text'></span>	
						</td>
					</tr>
					<tr>
						<td>
							<span>Numero de Identificación <span class='obligatorio'>*</span></span>
						</td>
						<td>
							<span><input name='demj_id' id='nit_j' type='text'></span>	
						</td>
					</tr>
					<tr>
						<td>
							<span>Lugar de Registro</span>
						</td>
						<td>
							<span><input name='demj_exp' id='lug_j' type='text'></span>	
						</td>
					</tr>
					<tr>
						<td>
							<span>Dirección</span>
						</td>
						<td>
							<span><input name='demj_direccion' id='dir_j' type='text'></span>	
						</td>
					</tr>
					<tr>
						<td>
							<span>Ciudad</span>
						</td>
						<td>
							<span><input name='demj_ciudad' id='ciu_j' type='text'></span>	
						</td>
					</tr>
					<tr>
						<td>
							<span>Nombre del Representante Legal</span>
						</td>
						<td>
							<span><input name='demj_nombrer' id='cre_j' type='text'></span>	
						</td>
					</tr>
					<tr>
						<td>
							<span>Ciudad del Representante Legal</span>
						</td>
						<td>
							<span><input name='demj_ciur' id='rep_j' type='text'></span>	
						</td>
					</tr>
					<tr>
						<td>
							<span>Teléfono</span>
						</td>
						<td>
							<span><input name='demj_tel' id='tel_j' type='text' class='tags'></span>	
						</td>
					</tr>
					<tr>
						<td>
							<span>Email <span class='obligatorio'>*</span></span>
							
						</td>
						<td>
							<span><input name='demj_mail' id='mai_j' type='text' class='tags'></span>	
							
						</td>
					</tr>
				</table>

			</div>
		</form>

	</div>
</div>
<script>
	$(document).ready(function() {

		$('.datepicker').datepicker({
			dateFormat: 'yy-mm-dd',
			monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio', 'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
			dayNames: ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'], // For formatting
			dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'], // For formatting
			dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sa'] // Column headings for days starting at Sunday				
		});
	});
	BuscarDemandanteJuridica("1");
</script>