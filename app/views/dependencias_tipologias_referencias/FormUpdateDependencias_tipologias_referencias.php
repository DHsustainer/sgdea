	<form id='FormUpdatedependencias_tipologias_referencias' action='/dependencias_tipologias_referencias/actualizar/' method='POST'> 
		<div class='title'>Editar METADATOS</div>
			<?
				$com1 = '<option value="text">Texto</option><option value="number">Numérico</option><option value="date">Fecha</option>';
				$com2 = '<option value="number">Numérico</option><option value="text">Texto</option><option value="date">Fecha</option>';
				$com3 = '<option value="date">Fecha</option><option value="text">Texto</option><option value="number">Numérico</option>';
			?>
			<input type='hidden' name='id' id='id' value='<? echo $objectx -> GetId(); ?>' />
			<input type='hidden' class='form-control' style="width:25%" placeholder='username' name='username' id='username' maxlength='' value='<? echo $objectx -> Getusername(); ?>' />
			
			<input type='hidden' class='form-control' style="width:25%" placeholder='dependencia_id' name='dependencia_id' id='dependencia_id' maxlength='' value='<? echo $objectx -> Getdependencia_id(); ?>' />
			
			<input type='text' class='form-control disabled' style="width:90%" placeholder='title' name='title' id='title' maxlength='' value='<? echo $objectx -> Gettitle(); ?>' />
			<br>
			<input type='text' class='form-control' style="width:25%" placeholder='Título' name='col_1_name' id='col_1_name' maxlength='' value='Origen' readonly="readonly" />
			
			<select class='form-control' style="width:25%" placeholder='col_1_type' name='col_1_type' id='col_1_type' >
				<option value='origen'> Seleccionable</option>
			</select>
			
			<input type='text' class='form-control' style="width:25%" placeholder='Maximo de Caracteres' name='col_1_size' id='col_1_size' maxlength='' value='2' readonly />
			
			<input type='text' class='form-control' style="width:25%" placeholder='Título' name='col_2_name' id='col_2_name' maxlength='' value='<? echo $objectx -> Getcol_2_name(); ?>' />
			
			<select class='form-control' style="width:25%" placeholder='col_2_type' name='col_2_type' id='col_2_type' >
				<?
					if ($objectx -> Getcol_2_type() == "date") { 
						echo $com3;
					}elseif($objectx -> Getcol_2_type() == "number"){
						echo $com2;
					}else{
						echo $com1;
					}
				?>
			</select>
			
			<input type='text' class='form-control' style="width:25%" placeholder='Maximo de Caracteres' name='col_2_size' id='col_2_size' maxlength='' value='<? echo $objectx -> Getcol_2_size(); ?>' />
			
			<input type='text' class='form-control' style="width:25%" placeholder='Título' name='col_3_name' id='col_3_name' maxlength='' value='<? echo $objectx -> Getcol_3_name(); ?>' />
			
			<select class='form-control' style="width:25%" placeholder='col_3_type' name='col_3_type' id='col_3_type' >
				<?
					if ($objectx -> Getcol_3_type() == "date") { 
						echo $com3;
					}elseif($objectx -> Getcol_3_type() == "number"){
						echo $com2;
					}else{
						echo $com1;
					}
				?>
			</select>
			
			<input type='text' class='form-control' style="width:25%" placeholder='Maximo de Caracteres' name='col_3_size' id='col_3_size' maxlength='' value='<? echo $objectx -> Getcol_3_size(); ?>' />
			
			<input type='text' class='form-control' style="width:25%" placeholder='Título' name='col_4_name' id='col_4_name' maxlength='' value='<? echo $objectx -> Getcol_4_name(); ?>' />
			
			<select class='form-control' style="width:25%" placeholder='col_4_type' name='col_4_type' id='col_4_type' >
				<?
					if ($objectx -> Getcol_4_type() == "date") { 
						echo $com3;
					}elseif($objectx -> Getcol_4_type() == "number"){
						echo $com2;
					}else{
						echo $com1;
					}
				?>
			</select>
			
			<input type='text' class='form-control' style="width:25%" placeholder='Maximo de Caracteres' name='col_4_size' id='col_4_size' maxlength='' value='<? echo $objectx -> Getcol_4_size(); ?>' />
			
			<input type='text' class='form-control' style="width:25%" placeholder='Título' name='col_5_name' id='col_5_name' maxlength='' value='<? echo $objectx -> Getcol_5_name(); ?>' />
			
			<select class='form-control' style="width:25%" placeholder='col_5_type' name='col_5_type' id='col_5_type' >
				<?
					if ($objectx -> Getcol_5_type() == "date") { 
						echo $com3;
					}elseif($objectx -> Getcol_5_type() == "number"){
						echo $com2;
					}else{
						echo $com1;
					}
				?>
			</select>
			
			<input type='text' class='form-control' style="width:25%" placeholder='Maximo de Caracteres' name='col_5_size' id='col_5_size' maxlength='' value='<? echo $objectx -> Getcol_5_size(); ?>' />
			
			<input type='text' class='form-control' style="width:25%" placeholder='Título' name='col_6_name' id='col_6_name' maxlength='' value='<? echo $objectx -> Getcol_6_name(); ?>' />
			
			<select class='form-control' style="width:25%" placeholder='col_6_type' name='col_6_type' id='col_6_type' >
				<?
					if ($objectx -> Getcol_6_type() == "date") { 
						echo $com3;
					}elseif($objectx -> Getcol_6_type() == "number"){
						echo $com2;
					}else{
						echo $com1;
					}
				?>
			</select>
			
			<input type='text' class='form-control' style="width:25%" placeholder='Maximo de Caracteres' name='col_6_size' id='col_6_size' maxlength='' value='<? echo $objectx -> Getcol_6_size(); ?>' />
			
			<input type='text' class='form-control' style="width:25%" placeholder='Título' name='col_7_name' id='col_7_name' maxlength='' value='<? echo $objectx -> Getcol_7_name(); ?>' />
			
			<select class='form-control' style="width:25%" placeholder='col_7_type' name='col_7_type' id='col_7_type' >
				<?
					if ($objectx -> Getcol_7_type() == "date") { 
						echo $com3;
					}elseif($objectx -> Getcol_7_type() == "number"){
						echo $com2;
					}else{
						echo $com1;
					}
				?>
			</select>
			
			<input type='text' class='form-control' style="width:25%" placeholder='Maximo de Caracteres' name='col_7_size' id='col_7_size' maxlength='' value='<? echo $objectx -> Getcol_7_size(); ?>' />
			
			<input type='text' class='form-control' style="width:25%" placeholder='Título' name='col_8_name' id='col_8_name' maxlength='' value='<? echo $objectx -> Getcol_8_name(); ?>' />
			
			<select class='form-control' style="width:25%" placeholder='col_8_type' name='col_8_type' id='col_8_type' >
				<?
					if ($objectx -> Getcol_8_type() == "date") { 
						echo $com3;
					}elseif($objectx -> Getcol_8_type() == "number"){
						echo $com2;
					}else{
						echo $com1;
					}
				?>
			</select>
			
			<input type='text' class='form-control' style="width:25%" placeholder='Maximo de Caracteres' name='col_8_size' id='col_8_size' maxlength='' value='<? echo $objectx -> Getcol_8_size(); ?>' />
			
			<input type='text' class='form-control' style="width:25%" placeholder='Título' name='col_9_name' id='col_9_name' maxlength='' value='<? echo $objectx -> Getcol_9_name(); ?>' />
			
			<select class='form-control' style="width:25%" placeholder='col_9_type' name='col_9_type' id='col_9_type' >
				<?
					if ($objectx -> Getcol_9_type() == "date") { 
						echo $com3;
					}elseif($objectx -> Getcol_9_type() == "number"){
						echo $com2;
					}else{
						echo $com1;
					}
				?>
			</select>
			
			<input type='text' class='form-control' style="width:25%" placeholder='Maximo de Caracteres' name='col_9_size' id='col_9_size' maxlength='' value='<? echo $objectx -> Getcol_9_size(); ?>' />
			
			<input type='text' class='form-control' style="width:25%" placeholder='Título' name='col_10_name' id='col_10_name' maxlength='' value='<? echo $objectx -> Getcol_10_name(); ?>' />
			
			<select class='form-control' style="width:25%" placeholder='col_10_type' name='col_10_type' id='col_10_type' >
				<?
					if ($objectx -> Getcol_10_type() == "date") { 
						echo $com3;
					}elseif($objectx -> Getcol_10_type() == "number"){
						echo $com2;
					}else{
						echo $com1;
					}
				?>
			</select>
			
			<input type='text' class='form-control' style="width:25%" placeholder='Maximo de Caracteres' name='col_10_size' id='col_10_size' maxlength='' value='<? echo $objectx -> Getcol_10_size(); ?>' />
			
			<input type='text' class='form-control' style="width:25%" placeholder='Título' name='col_11_name' id='col_11_name' maxlength='' value='<? echo $objectx -> Getcol_11_name(); ?>' />
			
			<select class='form-control' style="width:25%" placeholder='col_11_type' name='col_11_type' id='col_11_type' >
				<?
					if ($objectx -> Getcol_11_type() == "date") { 
						echo $com3;
					}elseif($objectx -> Getcol_11_type() == "number"){
						echo $com2;
					}else{
						echo $com1;
					}
				?>
			</select>
			
			<input type='text' class='form-control' style="width:25%" placeholder='Maximo de Caracteres' name='col_11_size' id='col_11_size' maxlength='' value='<? echo $objectx -> Getcol_11_size(); ?>' />
			
			<input type='text' class='form-control' style="width:25%" placeholder='Título' name='col_12_name' id='col_12_name' maxlength='' value='<? echo $objectx -> Getcol_12_name(); ?>' />
			
			<select class='form-control' style="width:25%" placeholder='col_12_type' name='col_12_type' id='col_12_type' >
				<?
					if ($objectx -> Getcol_12_type() == "date") { 
						echo $com3;
					}elseif($objectx -> Getcol_12_type() == "number"){
						echo $com2;
					}else{
						echo $com1;
					}
				?>
			</select>
			
			<input type='text' class='form-control' style="width:25%" placeholder='Maximo de Caracteres' name='col_12_size' id='col_12_size' maxlength='' value='<? echo $objectx -> Getcol_12_size(); ?>' />
			
			<input type='text' class='form-control' style="width:25%" placeholder='Título' name='col_13_name' id='col_13_name' maxlength='' value='<? echo $objectx -> Getcol_13_name(); ?>' />
			
			<select class='form-control' style="width:25%" placeholder='col_13_type' name='col_13_type' id='col_13_type' >
				<?
					if ($objectx -> Getcol_13_type() == "date") { 
						echo $com3;
					}elseif($objectx -> Getcol_13_type() == "number"){
						echo $com2;
					}else{
						echo $com1;
					}
				?>
			</select>
			
			<input type='text' class='form-control' style="width:25%" placeholder='Maximo de Caracteres' name='col_13_size' id='col_13_size' maxlength='' value='<? echo $objectx -> Getcol_13_size(); ?>' />
			
			<input type='text' class='form-control' style="width:25%" placeholder='Título' name='col_14_name' id='col_14_name' maxlength='' value='<? echo $objectx -> Getcol_14_name(); ?>' />
			
			<select class='form-control' style="width:25%" placeholder='col_14_type' name='col_14_type' id='col_14_type' >
				<?
					if ($objectx -> Getcol_14_type() == "date") { 
						echo $com3;
					}elseif($objectx -> Getcol_14_type() == "number"){
						echo $com2;
					}else{
						echo $com1;
					}
				?>
			</select>
			
			<input type='text' class='form-control' style="width:25%" placeholder='Maximo de Caracteres' name='col_14_size' id='col_14_size' maxlength='' value='<? echo $objectx -> Getcol_14_size(); ?>' />
			
			<input type='text' class='form-control' style="width:25%" placeholder='Título' name='col_15_name' id='col_15_name' maxlength='' value='<? echo $objectx -> Getcol_15_name(); ?>' />
			
			<select class='form-control' style="width:25%" placeholder='col_15_type' name='col_15_type' id='col_15_type' >
				<?
					if ($objectx -> Getcol_15_type() == "date") { 
						echo $com3;
					}elseif($objectx -> Getcol_15_type() == "number"){
						echo $com2;
					}else{
						echo $com1;
					}
				?>
			</select>
			
			<input type='text' class='form-control' style="width:25%" placeholder='Maximo de Caracteres' name='col_15_size' id='col_15_size' maxlength='' value='<? echo $objectx -> Getcol_15_size(); ?>' />
			
			<input type='hidden' class='form-control' style="width:25%" placeholder='fecha' name='fecha' id='fecha' maxlength='' value='<? echo $objectx -> Getfecha(); ?>' />
			
	<!--<tr>
				<td colspan='2' align='center'>
				</td>
			</tr>
		</table> -->
				<input type='button' value='Actualizar' onClick="UpdateDependenciaTipologiaReferencia()"/>
	</form>
