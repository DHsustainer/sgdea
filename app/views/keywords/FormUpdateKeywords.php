<form id='FormUpdatekeywords<? echo $kw -> GetId(); ?>' action='/keywords/actualizar/' method='POST'> 
	<?php
		$highlight = array("86");
		$color = "";
		if (in_array($kw -> GetId(), $highlight)) {
			$color = " bg-warning text-white";
		}
	?>
	<tr>
		<td class='<?= $color ?>'>
			<? echo $kw -> Gettermino(); ?>
			<input type='hidden' name='id' id='id' value='<? echo $kw -> GetId(); ?>' />
			<input type='hidden' readonly="readonly" class='form-control' placeholder='termino' name='termino' id='termino' maxlength='' value='<? echo $kw -> Gettermino(); ?>' />
		</td>
		<td align="center" class='<?= $color ?>'>
			<span class="mdi mdi-help-circle-outline" style="cursor:pointer" data-toggle="popover" data-trigger="hover" data-content="<? echo $kw->GetAyuda() ?>" data-placement="top" data-original-title="" title=""></span>
		</td>
		<td class='<?= $color ?>'>
			<?php if ($kw -> GetId() == "84"): ?>
				<select class='form-control' placeholder='Palabra Clave' name='p_clave' id='p_clave' >
					<?
						$q = $con->Query("SELECT * FROM seccional");
						while ($row = $con->FetchAssoc($q)) {
							$pq = ($kw->Getp_clave() == $row['id'])?" selected = 'selected'":"";
							echo "<option value='".$row['id']."' $pq>".$row['nombre']."</option>";
						}
					?>
				</select>
			<?php else: ?>
				<input type='text' class='form-control' placeholder='Palabra Clave' name='p_clave' id='p_clave' maxlength='' value='<? echo $kw -> Getp_clave(); ?>' />
				
			<?php endif ?>
		</td>
		<td class='<?= $color ?>'>
			<? echo $kw -> GetCodeword(); ?>
		</td>
		<td align="center" class='<?= $color ?>'>
			<?php if ($kw->Getmostrar() != "-1"): ?>
				<select class='form-control' placeholder='mostrar' name='mostrar' id='mostrar'>
					<?php if ($kw -> Getmostrar() == "1"): ?>
						<option value="1">SI</option>
						<option value="dn">NO</option>
					<?php else: ?>
						<option value="dn">NO</option>
						<option value="1">SI</option>
					<?php endif ?>
				</select>
			<?php else: ?>	
				SI
				<input type='hidden' name='mostrar' id='mostrar' value='-1' />
			<?php endif ?>
			
		</td>
		<td class='<?= $color ?>'>
			<span class="btn btn-info btn-circle" onclick="EditarKeywords('FormUpdatekeywords<? echo $kw -> GetId(); ?>')">
				<span class="mdi mdi-content-save" title="Guardar"></span>
			</span>
		</td>	
	</tr>
</form>




