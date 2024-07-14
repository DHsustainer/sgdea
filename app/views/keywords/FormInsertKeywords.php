<script language='javascript' type='text/javascript' src='http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js'></script>
<script language='javascript' type='text/javascript' src='<?= APP.'views'.DS.'keywords'.DS.'scripts'.DS ?>script.js'></script>
	<form id='formkeywords' action='/keywords/registrar/' method='POST'> 
		<!--
    	<input type='hidden' id='m' name='m' value='keywords' />     
    	<input type='hidden' id='action' name='action' value='registrar' />     
			<table border='0' cellspacing='3' cellpadding='0' class='tabla' width='40%'>
			<tr>
				<td colspan='2' align='left' class='sub_titulo'>{Formulariokeywords}</td>
			</tr>-->
		<div class='title right'>Formulario de keywords </div>
		<input type='text' class='title_act' placeholder='Termino' name='termino' id='termino' maxlength='200' />
		<input type='text' class='title_act' placeholder='P_clave' name='p_clave' id='p_clave' maxlength='200' />
		<input type='text' class='title_act' placeholder='Mostrar' name='mostrar' id='mostrar' maxlength='1' />
		<input type='text' class='title_act' placeholder='F_update' name='f_update' id='f_update' maxlength='' />
		<input type='text' class='title_act' placeholder='Username' name='username' id='username' maxlength='200' />
		<input type='submit' value='Insertar'  style='margin:10px;'/>
	</form>