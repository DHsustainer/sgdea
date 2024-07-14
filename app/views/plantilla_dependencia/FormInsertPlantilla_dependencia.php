<div  style="display:none">
<div class="title right">Configurar Sub-Serie</div>
<select style="width:250px; height:35px;" class="form-control" id="id_dependencia_raiz" name="id_dependencia_raiz" onchange="dependencia_item('id_dependencia_raiz','tipo_documento','/dependencias/optiondependencias/')">
	<option>Seleccione una Serie</option>
	<?
		$s = new MDependencias;
		$q = $s->ListarDependencias(" where dependencia = '0'");

		while ($row = $con->FetchAssoc($q)) {
			if ($id != ""){
				if ($dep->GetDependencia() == $row['id']) {
					echo "<option value='".$row['id']."' selected = 'selected'> ".$row['nombre']."</option>";
				}else{
					echo "<option value='".$row['id']."'> ".$row['nombre']."</option>";
				}
			}else{
				echo "<option value='".$row['id']."'> ".$row['nombre']."</option>";
			}
		}
	?>
</select>
<select style="width:250px; height:35px;" class="form-control" id="tipo_documento" name="tipo_documento">
	<option>Seleccione una Sub-Serie</option>
	<?
		if ($id != ""){

			$s = new MDependencias;
			$q = $s->ListarDependencias(" where dependencia = '".$dep->GetDependencia()."'");

			while ($row = $con->FetchAssoc($q)) {
				if ($dep->GetId() == $row['id']) {
					echo "<option value='".$row['id']."' selected = 'selected'> ".$row['nombre']."</option>";
				}else{
					echo "<option value='".$row['id']."'> ".$row['nombre']."</option>";
				}
			}

		}
	?>
</select>
<input type="button" onClick="GetDetailDependencia()" value="Cambiar">	
</div>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default block1 m-t-30">
			<div class="panel-wrapper collapse in">
				<div class="panel-body">
					<div id="LoadDetailDependencia">
						<?
							if ($id != "") {
								include(VIEWS.DS."dependencias/PanelDependencias2.php");
							}else{
								echo "<div class='alert alert-info'>Seleccione una Serie y Sub-serie</div>";
							}
						?>	
					</div>
				</div>
			</div>
		</div>
	</div>
</div>