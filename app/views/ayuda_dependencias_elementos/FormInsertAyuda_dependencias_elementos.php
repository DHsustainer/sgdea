<script language='javascript' type='text/javascript' src='http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js'></script>
<script language='javascript' type='text/javascript' src='<?= APP.'views'.DS.'ayuda_dependencias_elementos'.DS.'scripts'.DS ?>script.js'></script>
	<form id='formayuda_dependencias_elementos' action='/ayuda_dependencias_elementos/registrar/' method='POST'> 
		<!--
    	<input type='hidden' id='m' name='m' value='ayuda_dependencias_elementos' />     
    	<input type='hidden' id='action' name='action' value='registrar' />     
			<table border='0' cellspacing='3' cellpadding='0' class='tabla' width='40%'>
			<tr>
				<td colspan='2' align='left' class='sub_titulo'>{Formularioayuda_dependencias_elementos}</td>
			</tr>-->
		<div class='title right'>Formulario de ayuda_dependencias_elementos </div>
		<input type='text' class='form-control' placeholder='Libro_id' name='libro_id' id='libro_id' maxlength='10' />
		<input type='text' class='form-control' placeholder='Elemento_padre_id' name='elemento_padre_id' id='elemento_padre_id' maxlength='10' />
		<input type='text' class='form-control' placeholder='Elemento_dependencia_id' name='elemento_dependencia_id' id='elemento_dependencia_id' maxlength='10' />
		<input type='text' class='form-control' placeholder='Orden' name='orden' id='orden' maxlength='10' />
		<input type='text' class='form-control' placeholder='Mostrar' name='mostrar' id='mostrar' maxlength='11' />
		<input type='submit' value='Insertar'  style='margin:10px;'/>
	</form>