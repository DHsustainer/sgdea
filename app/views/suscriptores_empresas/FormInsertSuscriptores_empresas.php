<script language='javascript' type='text/javascript' src='http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js'></script>
<script language='javascript' type='text/javascript' src='<?= APP.'views'.DS.'suscriptores_empresas'.DS.'scripts'.DS ?>script.js'></script>
	<form id='formsuscriptores_empresas' action='/suscriptores_empresas/registrar/' method='POST'> 
		<!--
    	<input type='hidden' id='m' name='m' value='suscriptores_empresas' />     
    	<input type='hidden' id='action' name='action' value='registrar' />     
			<table border='0' cellspacing='3' cellpadding='0' class='tabla' width='40%'>
			<tr>
				<td colspan='2' align='left' class='sub_titulo'>{Formulariosuscriptores_empresas}</td>
			</tr>-->
		<input style="display:none" type='text' class='form-control' placeholder='Id_suscriptor' name='id_suscriptor' id='id_suscriptor' value="<?php echo $id; ?>" maxlength='10' />
		<input style="display:none" type='text' class='form-control' placeholder='Id_suscriptores_accesos' name='id_suscriptores_accesos' value="0" id='id_suscriptores_accesos' maxlength='10' />
		<input style="display:none" type='text' class='form-control' placeholder='Id_suscriptores_modulos_funciones' name='id_suscriptores_modulos_funciones' id='id_suscriptores_modulos_funciones' maxlength='10' />
		<input style="width:110px;" type='text' class='form-control' placeholder='Nombre_empresa' name='nombre_empresa' id='nombre_empresa' maxlength='200' />
		<input style="width:110px;" type='text' class='form-control' placeholder='Dominio' name='dominio' id='dominio' value="" maxlength='300' />
		<input style="display:none" type='text' class='form-control' placeholder='D_key' name='d_key' id='d_key' value="0" maxlength='300' />
		<input style="width:110px;" type='text' class='form-control' placeholder='Db' name='db' id='db' maxlength='255' />
		<input type='submit' value='Crear Empresa'  style='margin:10px;'/>
	</form>