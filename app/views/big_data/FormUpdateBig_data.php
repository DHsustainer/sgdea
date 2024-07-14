
<script language='javascript' type='text/javascript' src='http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js'></script>
<script language='javascript' type='text/javascript' src='<?= APP.'views'.DS.'libros'.DS.'scripts'.DS ?>script.js'></script>
	<form id='FormUpdatebig_data' action='/big_data/actualizar/' method='POST'> 
		<div class='title'>Editar big_data</div>
		<!--<table border='0' width='40%' cellspacing='10'>
			<tr>
				<td colspan='2' align='left' class='sub_titulo'>Editar big_data</td>
			</tr> -->
			<input type='hidden' name='id' id='id' value='<? echo $object -> GetId(); ?>' />
			<input type='text' class='form-control' placeholder='username' name='username' id='username' maxlength='' value='<? echo $object -> Getusername(); ?>' />
			
			<input type='text' class='form-control' placeholder='proceso_id' name='proceso_id' id='proceso_id' maxlength='' value='<? echo $object -> Getproceso_id(); ?>' />
			
			<input type='text' class='form-control' placeholder='ref_tables_id' name='ref_tables_id' id='ref_tables_id' maxlength='' value='<? echo $object -> Getref_tables_id(); ?>' />
			
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
			
			<input type='text' class='form-control' placeholder='combinar' name='combinar' id='combinar' maxlength='' value='<? echo $object -> Getcombinar(); ?>' />
			
	<!--<tr>
				<td colspan='2' align='center'>
				</td>
			</tr>
		</table> -->
				<input type='submit' value='Actualizar'/>
	</form>
