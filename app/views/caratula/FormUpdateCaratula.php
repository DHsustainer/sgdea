
<script language='javascript' type='text/javascript' src='http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js'></script>
<script language='javascript' type='text/javascript' src='<?= APP.'views'.DS.'libros'.DS.'scripts'.DS ?>script.js'></script>
	<form id='FormUpdatecaratula' action='<?= HOMEDIR.'caratula'.DS.'actualizar'.DS ?>' method='POST' method='POST'> 
    	<input type='hidden' id='action' name='action' value='actualizar' />    
		
		
		<table border='0' width='40%' cellspacing='10'>
			<tr>
				<td colspan='2' align='left' class='sub_titulo'>Editar caratula</td>
			</tr>
				<td style='display:none;'><input type='text' name='id' id='id' value='<? echo $object -> GetId(); ?>' /></td>
			<tr>
				<td width='30%'><strong>User_id:</strong></td>
				<td><input type='text' name='user_id' id='user_id' maxlength='' value='<? echo $object -> Getuser_id(); ?>' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Proceso_id:</strong></td>
				<td><input type='text' name='proceso_id' id='proceso_id' maxlength='' value='<? echo $object -> Getproceso_id(); ?>' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Tip_demanda:</strong></td>
				<td><input type='text' name='tip_demanda' id='tip_demanda' maxlength='' value='<? echo $object -> Gettip_demanda(); ?>' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Juzgado:</strong></td>
				<td><input type='text' name='juzgado' id='juzgado' maxlength='' value='<? echo $object -> Getjuzgado(); ?>' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Rad:</strong></td>
				<td><input type='text' name='rad' id='rad' maxlength='' value='<? echo $object -> Getrad(); ?>' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Dir_juz:</strong></td>
				<td><input type='text' name='dir_juz' id='dir_juz' maxlength='' value='<? echo $object -> Getdir_juz(); ?>' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Tel_juz:</strong></td>
				<td><input type='text' name='tel_juz' id='tel_juz' maxlength='' value='<? echo $object -> Gettel_juz(); ?>' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Email_juz:</strong></td>
				<td><input type='text' name='email_juz' id='email_juz' maxlength='' value='<? echo $object -> Getemail_juz(); ?>' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Est_proceso:</strong></td>
				<td><input type='text' name='est_proceso' id='est_proceso' maxlength='' value='<? echo $object -> Getest_proceso(); ?>' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Tit_demanda:</strong></td>
				<td><input type='text' name='tit_demanda' id='tit_demanda' maxlength='' value='<? echo $object -> Gettit_demanda(); ?>' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Fec_pres:</strong></td>
				<td><input type='text' name='fec_pres' id='fec_pres' maxlength='' value='<? echo $object -> Getfec_pres(); ?>' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Val_demanda:</strong></td>
				<td><input type='text' name='val_demanda' id='val_demanda' maxlength='' value='<? echo $object -> Getval_demanda(); ?>' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Tipo_demandante:</strong></td>
				<td><input type='text' name='tipo_demandante' id='tipo_demandante' maxlength='' value='<? echo $object -> Gettipo_demandante(); ?>' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Fec_auto:</strong></td>
				<td><input type='text' name='fec_auto' id='fec_auto' maxlength='' value='<? echo $object -> Getfec_auto(); ?>' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Num_oficio:</strong></td>
				<td><input type='text' name='num_oficio' id='num_oficio' maxlength='' value='<? echo $object -> Getnum_oficio(); ?>' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Contenido:</strong></td>
				<td><input type='text' name='contenido' id='contenido' maxlength='' value='<? echo $object -> Getcontenido(); ?>' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Costas:</strong></td>
				<td><input type='text' name='costas' id='costas' maxlength='' value='<? echo $object -> Getcostas(); ?>' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Edit_juz:</strong></td>
				<td><input type='text' name='edit_juz' id='edit_juz' maxlength='' value='<? echo $object -> Getedit_juz(); ?>' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Tracking:</strong></td>
				<td><input type='text' name='tracking' id='tracking' maxlength='' value='<? echo $object -> Gettracking(); ?>' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Rad_completo:</strong></td>
				<td><input type='text' name='rad_completo' id='rad_completo' maxlength='' value='<? echo $object -> Getrad_completo(); ?>' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Fecha_creacion:</strong></td>
				<td><input type='text' name='fecha_creacion' id='fecha_creacion' maxlength='' value='<? echo $object -> Getfecha_creacion(); ?>' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Type_proceso:</strong></td>
				<td><input type='text' name='type_proceso' id='type_proceso' maxlength='' value='<? echo $object -> Gettype_proceso(); ?>' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Usuario_registra:</strong></td>
				<td><input type='text' name='usuario_registra' id='usuario_registra' maxlength='' value='<? echo $object -> Getusuario_registra(); ?>' /></td>
			</tr>
	<tr>
				<td colspan='2' align='center'><input type='submit' value='Actualizar'/></td>
			</tr>
		</table>
	</form>
