<form id='formsuscriptores_modulos' action='/suscriptores_modulos/registrar/' method='POST'> 

	<h3>Registar Modulo</h3>
	<br>
	<input type='hidden' class='form-control' placeholder='Estado' name='estado' id='estado' maxlength='1' value="1" />
	<input type='hidden' class='form-control' placeholder='Usuario' name='usuario' id='usuario' maxlength='200' value="<?= $_SESSION['usuario'] ?>" />
	<input type='hidden' class='form-control' placeholder='Fecha' name='fecha' id='fecha' maxlength='' value="<?= date("Y-m-d") ?>" />

	<div class="row">
		<div class="col-md-12">
			<div class="form-group">
				<label for="nombre">Poyecto</label>
				<select name="id_proyecto" id="id_proyecto" class='form-control' style="height: 45px;">
					<?
						$tp = new MSuscriptores_tipos_proyectos;
						$q = $tp->ListarSuscriptores_tipos_proyectos("where id = '".$id."'");

						while ($row = $con->FetchAssoc($q)) {
							echo "<option value='".$row['id']."'>".$row['nombre']."</option>";
						}
					?>
				</select>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="form-group">
				<label for="nombre">Nombre</label>
				<input type='text' class='form-control' placeholder='Nombre' name='nombre' id='nombre' maxlength='255' />
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<div class="form-group">	
				<label for="descripcion">Descripcion</label>
				<input type='text' class='form-control' placeholder='Descripcion' name='descripcion' id='descripcion' maxlength='' />
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-4">
			<div class="form-group">	
				<label for="key_code">Palabra Clave <span class="fa fa-question-circle-o" data-toggle="tooltip" title="Código Interno identificador del modulo"></span></label>
				<input type='text' class='form-control' placeholder='Key_code' name='key_code' id='key_code' maxlength='50' />
			</div>
		</div>
		<div class="col-md-4">
			<div class="form-group">	
				<label for="link">Link <span class="fa fa-question-circle-o" data-toggle="tooltip" title="Enlace de acceso para modulo externo (Evitar utilizar slashes '/')"></span></label>
				<input type='text' class='form-control' placeholder='Link' name='link' id='link' maxlength='400' />
			</div>
		</div>
		<div class="col-md-4">
			<div class="form-group">	
				<label for="link">Tipo de Funcion<span class="fa fa-question-circle-o" data-toggle="tooltip" title="Describe el tipo de forma como se capturará la información"></span></label>
				<select class='form-control' placeholder='Tipo' name='tipo_elemento' id='tipo_elemento' style="height: 45px;">
					<option value="1">Seleccione una Opción</option>
					<option value="1">Activar/Desactivar</option>
					<option value="2">Valor Numerico</option>
				</select>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-4">
			<div class="form-group">	
				<label for="tipo">Tipo de Modulo <span class="fa fa-question-circle-o" data-toggle="tooltip" title="Define el tipo de modulo a instalar, su tipo define su ubicacion"></span></label><br>
				<select class='form-control' placeholder='Tipo' name='tipo' id='tipo' style="height: 45px;">
					<option value="-1">Seleccione una Opción</option>
					<option value="-1">Modulo del sistema</option>
					<option value="0">Modulo de Subserie G/ral o Especifica</option>
					<option value="1">Modulo de Menú Principal</option>
					<option value="2">Modulo de Menú Herramientas</option>
					<option value="3">Modulo de Area de Suscriptores</option>
					<option value="4">Modulo de Area de Usuarios</option>
				</select>
			</div>
		</div>
		<div class="col-md-4">
			<div class="form-group">	
				<label for="icono">Icono<span class="fa fa-question-circle-o" data-toggle="tooltip" title="Se utiliza Font-Awesome para manejar los iconos"></span></label>
				<input type='text' class='form-control' placeholder='Icono' name='icono' id='icono' maxlength='100' />
			</div>
		</div>
		<div class="col-md-4">
			<div class="form-group">	
				<label for="icono">Valor<span class="fa fa-question-circle-o" data-toggle="tooltip" title="Valor en pesos $ Sin puntos"></span></label>
				<input type='text' class='form-control' placeholder='Valor ' name='imagen' id='imagen' maxlength='100' />
			</div>
		</div>
	</div>
	
	<input type='submit' value='Registrar Modulo'/>
</form>

