
<script language='javascript' type='text/javascript' src='http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js'></script>
<script language='javascript' type='text/javascript' src='<?= APP.'views'.DS.'libros'.DS.'scripts'.DS ?>script.js'></script>
	<form id='FormUpdatewf_gestion_mapas' action='/wf_gestion_mapas/actualizar/' method='POST'> 
		<div class='title'>Editar wf_gestion_mapas</div>
		<!--<table border='0' width='40%' cellspacing='10'>
			<tr>
				<td colspan='2' align='left' class='sub_titulo'>Editar wf_gestion_mapas</td>
			</tr> -->
			<input type='hidden' name='id' id='id' value='<? echo $object -> GetId(); ?>' />
			<input type='text' class='form-control' placeholder='titulo' name='titulo' id='titulo' maxlength='' value='<? echo $object -> Gettitulo(); ?>' />
			
			<input type='text' class='form-control' placeholder='descripcion' name='descripcion' id='descripcion' maxlength='' value='<? echo $object -> Getdescripcion(); ?>' />
			
			<input type='text' class='form-control' placeholder='usuario' name='usuario' id='usuario' maxlength='' value='<? echo $object -> Getusuario(); ?>' />
			
			<input type='text' class='form-control' placeholder='fecha' name='fecha' id='fecha' maxlength='' value='<? echo $object -> Getfecha(); ?>' />
			
			<input type='text' class='form-control' placeholder='id_dependencia' name='id_dependencia' id='id_dependencia' maxlength='' value='<? echo $object -> Getid_dependencia(); ?>' />
			
			<input type='text' class='form-control' placeholder='id_gestion' name='id_gestion' id='id_gestion' maxlength='' value='<? echo $object -> Getid_gestion(); ?>' />
			
			<input type='text' class='form-control' placeholder='tipo_dependencia' name='tipo_dependencia' id='tipo_dependencia' maxlength='' value='<? echo $object -> Gettipo_dependencia(); ?>' />
			
			<input type='text' class='form-control' placeholder='id_mapa' name='id_mapa' id='id_mapa' maxlength='' value='<? echo $object -> Getid_mapa(); ?>' />
			
	<!--<tr>
				<td colspan='2' align='center'>
				</td>
			</tr>
		</table> -->
				<input type='submit' value='Actualizar'/>
	</form>
