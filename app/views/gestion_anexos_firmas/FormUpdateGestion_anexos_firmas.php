
<script language='javascript' type='text/javascript' src='http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js'></script>
<script language='javascript' type='text/javascript' src='<?= APP.'views'.DS.'libros'.DS.'scripts'.DS ?>script.js'></script>
	<form id='FormUpdategestion_anexos_firmas' action='/gestion_anexos_firmas/actualizar/' method='POST'> 
		<div class='title'>Editar gestion_anexos_firmas</div>
		<!--<table border='0' width='40%' cellspacing='10'>
			<tr>
				<td colspan='2' align='left' class='sub_titulo'>Editar gestion_anexos_firmas</td>
			</tr> -->
			<input type='hidden' name='id' id='id' value='<? echo $object -> GetId(); ?>' />
			<input type='text' class='form-control' placeholder='gestion_id' name='gestion_id' id='gestion_id' maxlength='' value='<? echo $object -> Getgestion_id(); ?>' />
			
			<input type='text' class='form-control' placeholder='anexo_id' name='anexo_id' id='anexo_id' maxlength='' value='<? echo $object -> Getanexo_id(); ?>' />
			
			<input type='text' class='form-control' placeholder='tipologia_id' name='tipologia_id' id='tipologia_id' maxlength='' value='<? echo $object -> Gettipologia_id(); ?>' />
			
			<input type='text' class='form-control' placeholder='fecha_solicitud' name='fecha_solicitud' id='fecha_solicitud' maxlength='' value='<? echo $object -> Getfecha_solicitud(); ?>' />
			
			<input type='text' class='form-control' placeholder='usuario_solicita' name='usuario_solicita' id='usuario_solicita' maxlength='' value='<? echo $object -> Getusuario_solicita(); ?>' />
			
			<input type='text' class='form-control' placeholder='usuario_firma' name='usuario_firma' id='usuario_firma' maxlength='' value='<? echo $object -> Getusuario_firma(); ?>' />
			
			<input type='text' class='form-control' placeholder='fecha_firma' name='fecha_firma' id='fecha_firma' maxlength='' value='<? echo $object -> Getfecha_firma(); ?>' />
			
			<input type='text' class='form-control' placeholder='codigo_firma' name='codigo_firma' id='codigo_firma' maxlength='' value='<? echo $object -> Getcodigo_firma(); ?>' />
			
			<input type='text' class='form-control' placeholder='clave_primaria' name='clave_primaria' id='clave_primaria' maxlength='' value='<? echo $object -> Getclave_primaria(); ?>' />
			
			<input type='text' class='form-control' placeholder='estado_firma' name='estado_firma' id='estado_firma' maxlength='' value='<? echo $object -> Getestado_firma(); ?>' />
			
			<input type='text' class='form-control' placeholder='repo_1' name='repo_1' id='repo_1' maxlength='' value='<? echo $object -> Getrepo_1(); ?>' />
			
			<input type='text' class='form-control' placeholder='repo_2' name='repo_2' id='repo_2' maxlength='' value='<? echo $object -> Getrepo_2(); ?>' />
			
	<!--<tr>
				<td colspan='2' align='center'>
				</td>
			</tr>
		</table> -->
				<input type='submit' value='Actualizar'/>
	</form>
