<script language='javascript' type='text/javascript' src='http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js'></script>
<script language='javascript' type='text/javascript' src='<?= APP.'views'.DS.'dian_facturacion'.DS.'scripts'.DS ?>script.js'></script>
	<form id='formdian_facturacion' action='/dian_facturacion/registrar/' method='POST'> 
		<!--
    	<input type='hidden' id='m' name='m' value='dian_facturacion' />     
    	<input type='hidden' id='action' name='action' value='registrar' />     
			<table border='0' cellspacing='3' cellpadding='0' class='tabla' width='40%'>
			<tr>
				<td colspan='2' align='left' class='sub_titulo'>{Formulariodian_facturacion}</td>
			</tr>-->
		<div class='title right'>Formulario de dian_facturacion </div>
		<input type='text' class='form-control' placeholder='Nombre' name='nombre' id='nombre' maxlength='255' />
		<input type='text' class='form-control' placeholder='Nit' name='nit' id='nit' maxlength='255' />
		<input type='text' class='form-control' placeholder='Num_resolucion' name='num_resolucion' id='num_resolucion' maxlength='10' />
		<input type='text' class='form-control' placeholder='Fecha_resolucion' name='fecha_resolucion' id='fecha_resolucion' maxlength='' />
		<input type='text' class='form-control' placeholder='Prefijo' name='prefijo' id='prefijo' maxlength='255' />
		<input type='text' class='form-control' placeholder='Rango_desde' name='rango_desde' id='rango_desde' maxlength='10' />
		<input type='text' class='form-control' placeholder='Rango_hasta' name='rango_hasta' id='rango_hasta' maxlength='10' />
		<input type='text' class='form-control' placeholder='Clave_tecnica' name='clave_tecnica' id='clave_tecnica' maxlength='255' />
		<input type='text' class='form-control' placeholder='Fecha_vigencia_desde' name='fecha_vigencia_desde' id='fecha_vigencia_desde' maxlength='' />
		<input type='text' class='form-control' placeholder='Fecha_vigencia_hasta' name='fecha_vigencia_hasta' id='fecha_vigencia_hasta' maxlength='' />
		<input type='text' class='form-control' placeholder='Software_id' name='software_id' id='software_id' maxlength='255' />
		<input type='text' class='form-control' placeholder='Pin' name='pin' id='pin' maxlength='255' />
		<input type='text' class='form-control' placeholder='Nombre_software' name='nombre_software' id='nombre_software' maxlength='255' />
		<input type='text' class='form-control' placeholder='Fecha_registro' name='fecha_registro' id='fecha_registro' maxlength='' />
		<input type='text' class='form-control' placeholder='Estado' name='estado' id='estado' maxlength='255' />
		<input type='text' class='form-control' placeholder='Url' name='url' id='url' maxlength='255' />
		<input type='text' class='form-control' placeholder='Usuario' name='usuario' id='usuario' maxlength='255' />
		<input type='text' class='form-control' placeholder='Clave' name='clave' id='clave' maxlength='255' />
		<input type='submit' value='Insertar'  style='margin:10px;'/>
	</form>