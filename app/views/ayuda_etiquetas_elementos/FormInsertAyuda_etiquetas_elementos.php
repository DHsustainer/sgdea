<script language='javascript' type='text/javascript' src='http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js'></script>
<script language='javascript' type='text/javascript' src='<?= APP.'views'.DS.'ayuda_etiquetas_elementos'.DS.'scripts'.DS ?>script.js'></script>
	<form id='formayuda_etiquetas_elementos' action='/ayuda_etiquetas_elementos/registrar/' method='POST'> 
		<!--
    	<input type='hidden' id='m' name='m' value='ayuda_etiquetas_elementos' />     
    	<input type='hidden' id='action' name='action' value='registrar' />     
			<table border='0' cellspacing='3' cellpadding='0' class='tabla' width='40%'>
			<tr>
				<td colspan='2' align='left' class='sub_titulo'>{Formularioayuda_etiquetas_elementos}</td>
			</tr>-->
		<div class='title right'>Formulario de ayuda_etiquetas_elementos </div>
		<input type='text' class='form-control' placeholder='Id_elemento' name='id_elemento' id='id_elemento' maxlength='10' />
		<input type='text' class='form-control' placeholder='Id_etiqueta' name='id_etiqueta' id='id_etiqueta' maxlength='10' />
		<input type='submit' value='Insertar'  style='margin:10px;'/>
	</form>