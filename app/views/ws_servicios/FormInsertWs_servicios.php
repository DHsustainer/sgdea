<script language='javascript' type='text/javascript' src='http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js'></script>
<script language='javascript' type='text/javascript' src='<?= APP.'views'.DS.'ws_servicios'.DS.'scripts'.DS ?>script.js'></script>
	<form id='formws_servicios' action='/ws_servicios/registrar/' method='POST'> 
		<!--
    	<input type='hidden' id='m' name='m' value='ws_servicios' />     
    	<input type='hidden' id='action' name='action' value='registrar' />     
			<table border='0' cellspacing='3' cellpadding='0' class='tabla' width='40%'>
			<tr>
				<td colspan='2' align='left' class='sub_titulo'>{Formulariows_servicios}</td>
			</tr>-->
		<div class='title right'>Formulario de ws_servicios </div>
		<input type='text' class='form-control' placeholder='Nombre' name='nombre' id='nombre' maxlength='300' />
		<input type='text' class='form-control' placeholder='Url' name='url' id='url' maxlength='256' />
		<input type='text' class='form-control' placeholder='Descripcion' name='descripcion' id='descripcion' maxlength='' />
		<input type='text' class='form-control' placeholder='Estado' name='estado' id='estado' maxlength='1' />
		<input type='text' class='form-control' placeholder='Usuario' name='usuario' id='usuario' maxlength='200' />
		<input type='text' class='form-control' placeholder='Publicacion' name='publicacion' id='publicacion' maxlength='' />
		<input type='submit' value='Insertar'  style='margin:10px;'/>
	</form>