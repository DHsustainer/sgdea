	<div class="title right">Actualizar Formulario: <? echo $object -> Gettitle(); ?></div>
	<br>
	<form id='FormUpdateref_tables' action='<?= HOMEDIR.'ref_tables'.DS.'actualizar'.DS ?>' method='POST' method='POST'> 
		<table border='0' width='40%' cellspacing='10' style="width:100%">
				<td style='display:none;'>
					<input type='text' name='id' id='id' value='<? echo $object -> GetId(); ?>' />
					<input type='hidden' name='username' id='username' maxlength='' value='<? echo $object -> Getusername(); ?>' />
					<input type='text' name='dependencia_id' id='dependencia_id' maxlength='' value='<? echo $object -> Getdependencia_id(); ?>' />
					<input type='text' name='fecha' id='fecha' maxlength='' value='<? echo $object -> Getfecha(); ?>' />
				</td>
			<tr>
				<td align="left" width='20%'><strong>Título:</strong></td>
				<td align="left"><input type='text' name='title' id='title' maxlength='' value='<? echo $object -> Gettitle(); ?>' placeholder="Campo Vacío" class="form-control" /></td>
			</tr>
			<tr>
				<?
					$checked = ($object->GetEs_generico() == "1")?"checked='checked'":"";
				?>
				<td><input type="checkbox" id="es_generico" name="es_generico" <?= $checked ?>></td>
				<td><label for="es_generico">¿Formulario Generico? <small>El formulario se activará al crear un documento</small></label></td>
			</tr>
			<tr>
				<td align="left" width='20%'><strong>Campo #1:</strong></td>
				<td align="left"><input type='text' name='col_1' id='col_1' maxlength='' value='<? echo $object -> Getcol_1(); ?>' placeholder="Campo Vacío" class="form-control" /></td>
			</tr>
			<tr>
				<td align="left" width='20%'><strong>Campo #2:</strong></td>
				<td align="left"><input type='text' name='col_2' id='col_2' maxlength='' value='<? echo $object -> Getcol_2(); ?>' placeholder="Campo Vacío" class="form-control" /></td>
			</tr>
			<tr>
				<td align="left" width='20%'><strong>Campo #3:</strong></td>
				<td align="left"><input type='text' name='col_3' id='col_3' maxlength='' value='<? echo $object -> Getcol_3(); ?>' placeholder="Campo Vacío" class="form-control" /></td>
			</tr>
			<tr>
				<td align="left" width='20%'><strong>Campo #4:</strong></td>
				<td align="left"><input type='text' name='col_4' id='col_4' maxlength='' value='<? echo $object -> Getcol_4(); ?>' placeholder="Campo Vacío" class="form-control" /></td>
			</tr>
			<tr>
				<td align="left" width='20%'><strong>Campo #5:</strong></td>
				<td align="left"><input type='text' name='col_5' id='col_5' maxlength='' value='<? echo $object -> Getcol_5(); ?>' placeholder="Campo Vacío" class="form-control" /></td>
			</tr>
			<tr>
				<td align="left" width='20%'><strong>Campo #6:</strong></td>
				<td align="left"><input type='text' name='col_6' id='col_6' maxlength='' value='<? echo $object -> Getcol_6(); ?>' placeholder="Campo Vacío" class="form-control" /></td>
			</tr>
			<tr>
				<td align="left" width='20%'><strong>Campo #7:</strong></td>
				<td align="left"><input type='text' name='col_7' id='col_7' maxlength='' value='<? echo $object -> Getcol_7(); ?>' placeholder="Campo Vacío" class="form-control" /></td>
			</tr>
			<tr>
				<td align="left" width='20%'><strong>Campo #8:</strong></td>
				<td align="left"><input type='text' name='col_8' id='col_8' maxlength='' value='<? echo $object -> Getcol_8(); ?>' placeholder="Campo Vacío" class="form-control" /></td>
			</tr>
			<tr>
				<td align="left" width='20%'><strong>Campo #9:</strong></td>
				<td align="left"><input type='text' name='col_9' id='col_9' maxlength='' value='<? echo $object -> Getcol_9(); ?>' placeholder="Campo Vacío" class="form-control" /></td>
			</tr>
			<tr>
				<td align="left" width='20%'><strong>Campo #10:</strong></td>
				<td align="left"><input type='text' name='col_10' id='col_10' maxlength='' value='<? echo $object -> Getcol_10(); ?>' placeholder="Campo Vacío" class="form-control" /></td>
			</tr>
			<tr>
				<td align="left" width='20%'><strong>Campo #11:</strong></td>
				<td align="left"><input type='text' name='col_11' id='col_11' maxlength='' value='<? echo $object -> Getcol_11(); ?>' placeholder="Campo Vacío" class="form-control" /></td>
			</tr>
			<tr>
				<td align="left" width='20%'><strong>Campo #12:</strong></td>
				<td align="left"><input type='text' name='col_12' id='col_12' maxlength='' value='<? echo $object -> Getcol_12(); ?>' placeholder="Campo Vacío" class="form-control" /></td>
			</tr>
			<tr>
				<td align="left" width='20%'><strong>Campo #13:</strong></td>
				<td align="left"><input type='text' name='col_13' id='col_13' maxlength='' value='<? echo $object -> Getcol_13(); ?>' placeholder="Campo Vacío" class="form-control" /></td>
			</tr>
			<tr>
				<td align="left" width='20%'><strong>Campo #14:</strong></td>
				<td align="left"><input type='text' name='col_14' id='col_14' maxlength='' value='<? echo $object -> Getcol_14(); ?>' placeholder="Campo Vacío" class="form-control" /></td>
			</tr>
			<tr>
				<td align="left" width='20%'><strong>Campo #15:</strong></td>
				<td align="left"><input type='text' name='col_15' id='col_15' maxlength='' value='<? echo $object -> Getcol_15(); ?>' placeholder="Campo Vacío" class="form-control" /></td>
			</tr>
			<tr>
				<td align="left" width='20%'><strong>Campo #16:</strong></td>
				<td align="left"><input type='text' name='col_16' id='col_16' maxlength='' value='<? echo $object -> Getcol_16(); ?>' placeholder="Campo Vacío" class="form-control" /></td>
			</tr>
			<tr>
				<td align="left" width='20%'><strong>Campo #17:</strong></td>
				<td align="left"><input type='text' name='col_17' id='col_17' maxlength='' value='<? echo $object -> Getcol_17(); ?>' placeholder="Campo Vacío" class="form-control" /></td>
			</tr>
			<tr>
				<td align="left" width='20%'><strong>Campo #18:</strong></td>
				<td align="left"><input type='text' name='col_18' id='col_18' maxlength='' value='<? echo $object -> Getcol_18(); ?>' placeholder="Campo Vacío" class="form-control" /></td>
			</tr>
			<tr>
				<td align="left" width='20%'><strong>Campo #19:</strong></td>
				<td align="left"><input type='text' name='col_19' id='col_19' maxlength='' value='<? echo $object -> Getcol_19(); ?>' placeholder="Campo Vacío" class="form-control" /></td>
			</tr>
			<tr>
				<td align="left" width='20%'><strong>Campo #20:</strong></td>
				<td align="left"><input type='text' name='col_20' id='col_20' maxlength='' value='<? echo $object -> Getcol_20(); ?>' placeholder="Campo Vacío" class="form-control" /></td>
			</tr>
			<tr>
				<td align="left" width='20%'><strong>Campo #21:</strong></td>
				<td align="left"><input type='text' name='col_21' id='col_21' maxlength='' value='<? echo $object -> Getcol_21(); ?>' placeholder="Campo Vacío" class="form-control" /></td>
			</tr>
			<tr>
				<td align="left" width='20%'><strong>Campo #22:</strong></td>
				<td align="left"><input type='text' name='col_22' id='col_22' maxlength='' value='<? echo $object -> Getcol_22(); ?>' placeholder="Campo Vacío" class="form-control" /></td>
			</tr>
			<tr>
				<td align="left" width='20%'><strong>Campo #23:</strong></td>
				<td align="left"><input type='text' name='col_23' id='col_23' maxlength='' value='<? echo $object -> Getcol_23(); ?>' placeholder="Campo Vacío" class="form-control" /></td>
			</tr>
			<tr>
				<td align="left" width='20%'><strong>Campo #24:</strong></td>
				<td align="left"><input type='text' name='col_24' id='col_24' maxlength='' value='<? echo $object -> Getcol_24(); ?>' placeholder="Campo Vacío" class="form-control" /></td>
			</tr>
			<tr>
				<td align="left" width='20%'><strong>Campo #25:</strong></td>
				<td align="left"><input type='text' name='col_25' id='col_25' maxlength='' value='<? echo $object -> Getcol_25(); ?>' placeholder="Campo Vacío" class="form-control" /></td>
			</tr>
			<tr>
				<td align="left" width='20%'><strong>Campo #26:</strong></td>
				<td align="left"><input type='text' name='col_26' id='col_26' maxlength='' value='<? echo $object -> Getcol_26(); ?>' placeholder="Campo Vacío" class="form-control" /></td>
			</tr>
			<tr>
				<td align="left" width='20%'><strong>Campo #27:</strong></td>
				<td align="left"><input type='text' name='col_27' id='col_27' maxlength='' value='<? echo $object -> Getcol_27(); ?>' placeholder="Campo Vacío" class="form-control" /></td>
			</tr>
			<tr>
				<td align="left" width='20%'><strong>Campo #28:</strong></td>
				<td align="left"><input type='text' name='col_28' id='col_28' maxlength='' value='<? echo $object -> Getcol_28(); ?>' placeholder="Campo Vacío" class="form-control" /></td>
			</tr>
			<tr>
				<td align="left" width='20%'><strong>Campo #29:</strong></td>
				<td align="left"><input type='text' name='col_29' id='col_29' maxlength='' value='<? echo $object -> Getcol_29(); ?>' placeholder="Campo Vacío" class="form-control" /></td>
			</tr>
			<tr>
				<td align="left" width='20%'><strong>Campo #30:</strong></td>
				<td align="left"><input type='text' name='col_30' id='col_30' maxlength='' value='<? echo $object -> Getcol_30(); ?>' placeholder="Campo Vacío" class="form-control" /></td>
			</tr>
	<tr>
				<td colspan='2' align='center'><input type='button' value='Actualizar' onClick="UpdateFormulario()"/></td>
			</tr>
		</table>
	</form>
