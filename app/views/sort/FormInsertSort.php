<script language='javascript' type='text/javascript' src='http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js'></script>
<script language='javascript' type='text/javascript' src='<?= APP.'views'.DS.'sort'.DS.'scripts'.DS ?>script.js'></script>
	<form id='formsort' action='/sort/registrar/' method='POST'> 
		<!--
    	<input type='hidden' id='m' name='m' value='sort' />     
    	<input type='hidden' id='action' name='action' value='registrar' />     
			<table border='0' cellspacing='3' cellpadding='0' class='tabla' width='40%'>
			<tr>
				<td colspan='2' align='left' class='sub_titulo'>{Formulariosort}</td>
			</tr>-->
		<div class='title right'>Formulario de sort </div>
		<input type='text' class='form-control' placeholder='Code' name='code' id='code' maxlength='255' />
		<input type='text' class='form-control' placeholder='Url' name='url' id='url' maxlength='8000' />
		<input type='text' class='form-control' placeholder='Fecha' name='fecha' id='fecha' maxlength='' />
		<input type='submit' value='Insertar'  style='margin:10px;'/>
	</form>