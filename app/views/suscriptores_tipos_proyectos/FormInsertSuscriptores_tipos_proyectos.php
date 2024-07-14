<script language='javascript' type='text/javascript' src='http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js'></script>
<script language='javascript' type='text/javascript' src='<?= APP.'views'.DS.'suscriptores_tipos_proyectos'.DS.'scripts'.DS ?>script.js'></script>
	<form id='formsuscriptores_tipos_proyectos' action='/suscriptores_tipos_proyectos/registrar/' method='POST'> 

		<div class='title right'>Formulario de suscriptores_tipos_proyectos </div>
		<br>
		<div class="row">
			<div class="col-md-12">
					<div class="form-group">
						<label for="nombre">Nombre del Proyecto</label>
						<input type='text' class='form-control' placeholder='Nombre' name='nombre' id='nombre' maxlength='255' />
					</div>
				</div>
			</div>
		<input type='submit' value='Crear Proyecto'  style='margin:10px;'/>
	</form>