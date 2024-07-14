
<script language='javascript' type='text/javascript' src='http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js'></script>
<script language='javascript' type='text/javascript' src='<?= APP.'views'.DS.'libros'.DS.'scripts'.DS ?>script.js'></script>
	<form id='FormUpdatesuscriptores_empresas' action='/suscriptores_empresas/actualizar/' method='POST'> 
		<div class='title'>Editar suscriptores_empresas</div>
		<!--<table border='0' width='40%' cellspacing='10'>
			<tr>
				<td colspan='2' align='left' class='sub_titulo'>Editar suscriptores_empresas</td>
			</tr> -->
			<input type='hidden' name='id' id='id' value='<? echo $object -> GetId(); ?>' />
			<input type='text' class='form-control' placeholder='id_suscriptor' name='id_suscriptor' id='id_suscriptor' maxlength='' value='<? echo $object -> Getid_suscriptor(); ?>' />
			
			<input type='text' class='form-control' placeholder='id_suscriptores_accesos' name='id_suscriptores_accesos' id='id_suscriptores_accesos' maxlength='' value='<? echo $object -> Getid_suscriptores_accesos(); ?>' />
			
			<input type='text' class='form-control' placeholder='id_suscriptores_modulos_funciones' name='id_suscriptores_modulos_funciones' id='id_suscriptores_modulos_funciones' maxlength='' value='<? echo $object -> Getid_suscriptores_modulos_funciones(); ?>' />
			
			<input type='text' class='form-control' placeholder='nombre_empresa' name='nombre_empresa' id='nombre_empresa' maxlength='' value='<? echo $object -> Getnombre_empresa(); ?>' />
			
			<input type='text' class='form-control' placeholder='dominio' name='dominio' id='dominio' maxlength='' value='<? echo $object -> Getdominio(); ?>' />
			
			<input type='text' class='form-control' placeholder='d_key' name='d_key' id='d_key' maxlength='' value='<? echo $object -> Getd_key(); ?>' />
			
			<input type='text' class='form-control' placeholder='db' name='db' id='db' maxlength='' value='<? echo $object -> Getdb(); ?>' />
			
	<!--<tr>
				<td colspan='2' align='center'>
				</td>
			</tr>
		</table> -->
				<input type='submit' value='Actualizar'/>
	</form>
