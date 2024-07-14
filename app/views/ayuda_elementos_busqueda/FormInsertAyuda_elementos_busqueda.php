<script language='javascript' type='text/javascript' src='http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js'></script>
<script language='javascript' type='text/javascript' src='<?= APP.'views'.DS.'ayuda_elementos_busqueda'.DS.'scripts'.DS ?>script.js'></script>
	<form id='formayuda_elementos_busqueda' action='/ayuda_elementos_busqueda/registrar/' method='POST'> 
		<!--
    	<input type='hidden' id='m' name='m' value='ayuda_elementos_busqueda' />     
    	<input type='hidden' id='action' name='action' value='registrar' />     
			<table border='0' cellspacing='3' cellpadding='0' class='tabla' width='40%'>
			<tr>
				<td colspan='2' align='left' class='sub_titulo'>{Formularioayuda_elementos_busqueda}</td>
			</tr>-->
		<div class='title right'>Formulario de ayuda_elementos_busqueda </div>
		<input type='text' class='form-control' placeholder='Titulo' name='titulo' id='titulo' maxlength='200' />
		<input type='text' class='form-control' placeholder='Pista' name='pista' id='pista' maxlength='45' />
		<input type='text' class='form-control' placeholder='Texto' name='texto' id='texto' maxlength='' />
		<input type='text' class='form-control' placeholder='Fecha_registro' name='fecha_registro' id='fecha_registro' maxlength='' />
		<input type='text' class='form-control' placeholder='Fecha_actualizacion' name='fecha_actualizacion' id='fecha_actualizacion' maxlength='' />
		<input type='text' class='form-control' placeholder='Libro_id' name='libro_id' id='libro_id' maxlength='10' />
		<input type='text' class='form-control' placeholder='Categoria' name='categoria' id='categoria' maxlength='10' />
		<input type='text' class='form-control' placeholder='Error' name='error' id='error' maxlength='1' />
		<input type='text' class='form-control' placeholder='Error_descripcion' name='error_descripcion' id='error_descripcion' maxlength='' />
		<input type='submit' value='Insertar'  style='margin:10px;'/>
	</form>