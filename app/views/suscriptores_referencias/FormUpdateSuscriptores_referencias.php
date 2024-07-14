
<script language='javascript' type='text/javascript' src='http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js'></script>
<script language='javascript' type='text/javascript' src='<?= APP.'views'.DS.'libros'.DS.'scripts'.DS ?>script.js'></script>
	<form id='FormUpdatesuscriptores_referencias' action='/suscriptores_referencias/actualizar/' method='POST'> 
		<div class='title'>Editar suscriptores_referencias</div>
		<!--<table border='0' width='40%' cellspacing='10'>
			<tr>
				<td colspan='2' align='left' class='sub_titulo'>Editar suscriptores_referencias</td>
			</tr> -->
			<input type='hidden' name='id' id='id' value='<? echo $object -> GetId(); ?>' />
			<input type='text' class='form-control' placeholder='username' name='username' id='username' maxlength='' value='<? echo $object -> Getusername(); ?>' />
			
			<input type='text' class='form-control' placeholder='title' name='title' id='title' maxlength='' value='<? echo $object -> Gettitle(); ?>' />
			
			<input type='text' class='form-control' placeholder='col_1' name='col_1' id='col_1' maxlength='' value='<? echo $object -> Getcol_1(); ?>' />
			
			<input type='text' class='form-control' placeholder='col_2' name='col_2' id='col_2' maxlength='' value='<? echo $object -> Getcol_2(); ?>' />
			
			<input type='text' class='form-control' placeholder='col_3' name='col_3' id='col_3' maxlength='' value='<? echo $object -> Getcol_3(); ?>' />
			
			<input type='text' class='form-control' placeholder='col_4' name='col_4' id='col_4' maxlength='' value='<? echo $object -> Getcol_4(); ?>' />
			
			<input type='text' class='form-control' placeholder='col_5' name='col_5' id='col_5' maxlength='' value='<? echo $object -> Getcol_5(); ?>' />
			
			<input type='text' class='form-control' placeholder='col_6' name='col_6' id='col_6' maxlength='' value='<? echo $object -> Getcol_6(); ?>' />
			
			<input type='text' class='form-control' placeholder='col_7' name='col_7' id='col_7' maxlength='' value='<? echo $object -> Getcol_7(); ?>' />
			
			<input type='text' class='form-control' placeholder='col_8' name='col_8' id='col_8' maxlength='' value='<? echo $object -> Getcol_8(); ?>' />
			
			<input type='text' class='form-control' placeholder='col_9' name='col_9' id='col_9' maxlength='' value='<? echo $object -> Getcol_9(); ?>' />
			
			<input type='text' class='form-control' placeholder='col_10' name='col_10' id='col_10' maxlength='' value='<? echo $object -> Getcol_10(); ?>' />
			
			<input type='text' class='form-control' placeholder='col_11' name='col_11' id='col_11' maxlength='' value='<? echo $object -> Getcol_11(); ?>' />
			
			<input type='text' class='form-control' placeholder='col_12' name='col_12' id='col_12' maxlength='' value='<? echo $object -> Getcol_12(); ?>' />
			
			<input type='text' class='form-control' placeholder='col_13' name='col_13' id='col_13' maxlength='' value='<? echo $object -> Getcol_13(); ?>' />
			
			<input type='text' class='form-control' placeholder='col_14' name='col_14' id='col_14' maxlength='' value='<? echo $object -> Getcol_14(); ?>' />
			
			<input type='text' class='form-control' placeholder='col_15' name='col_15' id='col_15' maxlength='' value='<? echo $object -> Getcol_15(); ?>' />
			
			<input type='text' class='form-control' placeholder='col_16' name='col_16' id='col_16' maxlength='' value='<? echo $object -> Getcol_16(); ?>' />
			
			<input type='text' class='form-control' placeholder='col_17' name='col_17' id='col_17' maxlength='' value='<? echo $object -> Getcol_17(); ?>' />
			
			<input type='text' class='form-control' placeholder='col_18' name='col_18' id='col_18' maxlength='' value='<? echo $object -> Getcol_18(); ?>' />
			
			<input type='text' class='form-control' placeholder='col_19' name='col_19' id='col_19' maxlength='' value='<? echo $object -> Getcol_19(); ?>' />
			
			<input type='text' class='form-control' placeholder='col_20' name='col_20' id='col_20' maxlength='' value='<? echo $object -> Getcol_20(); ?>' />
			
			<input type='text' class='form-control' placeholder='col_21' name='col_21' id='col_21' maxlength='' value='<? echo $object -> Getcol_21(); ?>' />
			
			<input type='text' class='form-control' placeholder='col_22' name='col_22' id='col_22' maxlength='' value='<? echo $object -> Getcol_22(); ?>' />
			
			<input type='text' class='form-control' placeholder='col_23' name='col_23' id='col_23' maxlength='' value='<? echo $object -> Getcol_23(); ?>' />
			
			<input type='text' class='form-control' placeholder='col_24' name='col_24' id='col_24' maxlength='' value='<? echo $object -> Getcol_24(); ?>' />
			
			<input type='text' class='form-control' placeholder='col_25' name='col_25' id='col_25' maxlength='' value='<? echo $object -> Getcol_25(); ?>' />
			
			<input type='text' class='form-control' placeholder='col_26' name='col_26' id='col_26' maxlength='' value='<? echo $object -> Getcol_26(); ?>' />
			
			<input type='text' class='form-control' placeholder='col_27' name='col_27' id='col_27' maxlength='' value='<? echo $object -> Getcol_27(); ?>' />
			
			<input type='text' class='form-control' placeholder='col_28' name='col_28' id='col_28' maxlength='' value='<? echo $object -> Getcol_28(); ?>' />
			
			<input type='text' class='form-control' placeholder='col_29' name='col_29' id='col_29' maxlength='' value='<? echo $object -> Getcol_29(); ?>' />
			
			<input type='text' class='form-control' placeholder='col_30' name='col_30' id='col_30' maxlength='' value='<? echo $object -> Getcol_30(); ?>' />
			
			<input type='text' class='form-control' placeholder='type_1' name='type_1' id='type_1' maxlength='' value='<? echo $object -> Gettype_1(); ?>' />
			
			<input type='text' class='form-control' placeholder='type_2' name='type_2' id='type_2' maxlength='' value='<? echo $object -> Gettype_2(); ?>' />
			
			<input type='text' class='form-control' placeholder='type_3' name='type_3' id='type_3' maxlength='' value='<? echo $object -> Gettype_3(); ?>' />
			
			<input type='text' class='form-control' placeholder='type_4' name='type_4' id='type_4' maxlength='' value='<? echo $object -> Gettype_4(); ?>' />
			
			<input type='text' class='form-control' placeholder='type_5' name='type_5' id='type_5' maxlength='' value='<? echo $object -> Gettype_5(); ?>' />
			
			<input type='text' class='form-control' placeholder='type_6' name='type_6' id='type_6' maxlength='' value='<? echo $object -> Gettype_6(); ?>' />
			
			<input type='text' class='form-control' placeholder='type_7' name='type_7' id='type_7' maxlength='' value='<? echo $object -> Gettype_7(); ?>' />
			
			<input type='text' class='form-control' placeholder='type_8' name='type_8' id='type_8' maxlength='' value='<? echo $object -> Gettype_8(); ?>' />
			
			<input type='text' class='form-control' placeholder='type_9' name='type_9' id='type_9' maxlength='' value='<? echo $object -> Gettype_9(); ?>' />
			
			<input type='text' class='form-control' placeholder='type_10' name='type_10' id='type_10' maxlength='' value='<? echo $object -> Gettype_10(); ?>' />
			
			<input type='text' class='form-control' placeholder='type_11' name='type_11' id='type_11' maxlength='' value='<? echo $object -> Gettype_11(); ?>' />
			
			<input type='text' class='form-control' placeholder='type_12' name='type_12' id='type_12' maxlength='' value='<? echo $object -> Gettype_12(); ?>' />
			
			<input type='text' class='form-control' placeholder='type_13' name='type_13' id='type_13' maxlength='' value='<? echo $object -> Gettype_13(); ?>' />
			
			<input type='text' class='form-control' placeholder='type_14' name='type_14' id='type_14' maxlength='' value='<? echo $object -> Gettype_14(); ?>' />
			
			<input type='text' class='form-control' placeholder='type_15' name='type_15' id='type_15' maxlength='' value='<? echo $object -> Gettype_15(); ?>' />
			
			<input type='text' class='form-control' placeholder='type_16' name='type_16' id='type_16' maxlength='' value='<? echo $object -> Gettype_16(); ?>' />
			
			<input type='text' class='form-control' placeholder='type_17' name='type_17' id='type_17' maxlength='' value='<? echo $object -> Gettype_17(); ?>' />
			
			<input type='text' class='form-control' placeholder='type_18' name='type_18' id='type_18' maxlength='' value='<? echo $object -> Gettype_18(); ?>' />
			
			<input type='text' class='form-control' placeholder='type_19' name='type_19' id='type_19' maxlength='' value='<? echo $object -> Gettype_19(); ?>' />
			
			<input type='text' class='form-control' placeholder='type_20' name='type_20' id='type_20' maxlength='' value='<? echo $object -> Gettype_20(); ?>' />
			
			<input type='text' class='form-control' placeholder='type_21' name='type_21' id='type_21' maxlength='' value='<? echo $object -> Gettype_21(); ?>' />
			
			<input type='text' class='form-control' placeholder='type_22' name='type_22' id='type_22' maxlength='' value='<? echo $object -> Gettype_22(); ?>' />
			
			<input type='text' class='form-control' placeholder='type_23' name='type_23' id='type_23' maxlength='' value='<? echo $object -> Gettype_23(); ?>' />
			
			<input type='text' class='form-control' placeholder='type_24' name='type_24' id='type_24' maxlength='' value='<? echo $object -> Gettype_24(); ?>' />
			
			<input type='text' class='form-control' placeholder='type_25' name='type_25' id='type_25' maxlength='' value='<? echo $object -> Gettype_25(); ?>' />
			
			<input type='text' class='form-control' placeholder='type_26' name='type_26' id='type_26' maxlength='' value='<? echo $object -> Gettype_26(); ?>' />
			
			<input type='text' class='form-control' placeholder='type_27' name='type_27' id='type_27' maxlength='' value='<? echo $object -> Gettype_27(); ?>' />
			
			<input type='text' class='form-control' placeholder='type_28' name='type_28' id='type_28' maxlength='' value='<? echo $object -> Gettype_28(); ?>' />
			
			<input type='text' class='form-control' placeholder='type_29' name='type_29' id='type_29' maxlength='' value='<? echo $object -> Gettype_29(); ?>' />
			
			<input type='text' class='form-control' placeholder='type_30' name='type_30' id='type_30' maxlength='' value='<? echo $object -> Gettype_30(); ?>' />
			
	<!--<tr>
				<td colspan='2' align='center'>
				</td>
			</tr>
		</table> -->
				<input type='submit' value='Actualizar'/>
	</form>
