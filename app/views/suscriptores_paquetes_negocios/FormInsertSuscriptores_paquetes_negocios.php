
	<form id='formsuscriptores_paquetes_negocios' action='/suscriptores_paquetes_negocios/registrar/' method='POST'> 
		<div class='title right'>Crear Paquete de Negocios</div>
		<input type='hidden' class='form-control' value='<?= $_SESSION['usuario'] ?>' name='usuario' id='usuario' maxlength='200' />
		<input type='hidden' class='form-control' value='<?= date("Y-m-d") ?>' name='fecha' id='fecha' maxlength='' />
		<br>
		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					<label for="nombre">Nombre</label>
					<input type='text' class='form-control' placeholder='Nombre' name='nombre' id='nombre' maxlength='200' />
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					<label for="Valor_base">Valor Base del Negocio (sin puntos)</label>
					<input type='text' class='form-control' placeholder='Valor Base' name='valor_base' id='valor_base' maxlength='10' />
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label for="tipo_negocio">Tipo de Negocio</label>
					<select name="tipo_negocio" id="tipo_negocio" class='form-control' style="height: 45px;">
						<option value="1">Seleccione un Tipo de Negocio</option>
						<?
							$ex = new MEstadosx;
							$q = $ex->ListarEstadosx("WHERE tipo = 'tipo_negocio'");

							while ($row = $con->FetchAssoc($q)){
								echo '<option value="'.$row['valor'].'">'.$row['nombre'].'</option>';
							}
						?>
					</select>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label for="tipo_proyecto">Proyecto</label>
					<select name="tipo_proyecto" id="tipo_proyecto" class='form-control' style="height: 45px;">
						<option value="1">Seleccione un Proyecto</option>
						<?
							$ex = new MSuscriptores_tipos_proyectos;
							$q = $ex->ListarSuscriptores_tipos_proyectos();

							while ($row = $con->FetchAssoc($q)){
								echo '<option value="'.$row['id'].'">'.$row['nombre'].'</option>';
							}
						?>
					</select>
				</div>
			</div>
		</div>
		<input type='submit' value='Crear Paquete'  style='margin:10px;'/>
	</form>