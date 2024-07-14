<script language='javascript' type='text/javascript' src='http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js'></script>
<script language='javascript' type='text/javascript' src='<?= APP.'views'.DS.'gestion_transferencias'.DS.'scripts'.DS ?>script.js'></script>
	<form id='formgestion_transferencias' action='/gestion_transferencias/registrar/' method='POST'> 
		<!--
    	<input type='hidden' id='m' name='m' value='gestion_transferencias' />     
    	<input type='hidden' id='action' name='action' value='registrar' />     
			<table border='0' cellspacing='3' cellpadding='0' class='tabla' width='40%'>
			<tr>
				<td colspan='2' align='left' class='sub_titulo'>{Formulariogestion_transferencias}</td>
			</tr>-->
		<div class='title right'>Formulario de gestion_transferencias </div>
		<input type='text' class='form-control' placeholder='Gestion_id' name='gestion_id' id='gestion_id' maxlength='10' />
		<input type='text' class='form-control' placeholder='User_transfiere' name='user_transfiere' id='user_transfiere' maxlength='100' />
		<input type='text' class='form-control' placeholder='User_recibe' name='user_recibe' id='user_recibe' maxlength='100' />
		<input type='text' class='form-control' placeholder='Fecha_transferencia' name='fecha_transferencia' id='fecha_transferencia' maxlength='' />
		<input type='text' class='form-control' placeholder='Fecha_aceptacion' name='fecha_aceptacion' id='fecha_aceptacion' maxlength='' />
		<input type='text' class='form-control' placeholder='Observaciona' name='observaciona' id='observaciona' maxlength='' />
		<input type='text' class='form-control' placeholder='Observacionb' name='observacionb' id='observacionb' maxlength='' />
		<input type='text' class='form-control' placeholder='Estado' name='estado' id='estado' maxlength='1' />
		<input type='submit' value='Insertar'  style='margin:10px;'/>
	</form>