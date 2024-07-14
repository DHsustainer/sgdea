	<form id='formmeta_tipos_elementos' action='/meta_tipos_elementos/registrar/' method='POST'> 
		<div class='title right'>Formulario de meta_tipos_elementos </div>
		<input type='text' class='form-control' placeholder='Nombre' name='nombre' id='nombre' maxlength='100' />
		<select class='form-control' placeholder='Tipo_lista' name='tipo_lista' id='tipo_lista'>
			<option value="0">Seleccione una Opción</option>
			<option value="0">Texto / Número</option>
			<option value="1">Lista Desplegable</option>
			<option value="2">Lista de Chequeo</option>
		</select>

		<div class="row">
			<div class="col-md-12">
				<button type="button" class="btn btn-success fullwidth" onclick="SendForm('formmeta_tipos_elementos', '/meta_tipos_elementos/','telementos', 'body-metadatosjs')">Guardar Opción</button>
			</div>
		</div>
	</form>