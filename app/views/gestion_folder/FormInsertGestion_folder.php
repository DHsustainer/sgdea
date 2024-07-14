<?
	$ge = new MGestion;
	$ge->CreateGestion("id", $id);

	$dep = new MDependencias;
	$dep->CreateDependencias("id", $ge->GetTipo_documento());
?>
<form id='formgestion_folder' action='/gestion_folder/registrar/' method='POST'> 
	<input type='hidden' name='folder_id' id='folder_id' maxlength='10' value="<?= $folder ?>" />
	<input type='hidden' name='gestion_id' id='gestion_id' maxlength='10' value="<?= $id ?>" />
	<input type='hidden' name='user_id' id='user_id' maxlength='100' value="<?= $_SESSION["usuario"] ?>" />
	<input type='hidden' name='fecha' id='fecha' maxlength='' value="<?= date("Y-m-d") ?>" />
	<input type='hidden' name='estado' id='estado' maxlength='1' value="1" />
	<div class="row">
		<div class="col-md-6">
			<label>NOMBRE DE LA CARPETA</label>
			<select style="width:100%;display:none;" class='form-control' placeholder='Nombre de la Carpeta' name='nombre_carpeta2' id='nombre_carpeta2' onchange="fnfnotrosformulario('nombre_carpeta')" >
			<?
				echo  "<option value='Otro'>OTRO</option>";	
				echo  "<option value=''>Seleccione El nombre de la carpeta</option>";	
				$tipo = new MDependencias_tipologias;
				$listado = $tipo->ListarDependencias_tipologias("WHERE id_dependencia = '".$dep->GetId()."'");
				while ($rl = $con->FetchAssoc($listado)) {
					if ($rl['tipologia'] != "") {
						echo  "<option value='".$rl['tipologia']."'>".$rl['tipologia']."</option>";	
					}
				}
			?>
			</select>
			<input type="text" style="width:100%;" class='form-control' placeholder='Nombre de la Carpeta'  name="nombre_carpeta" id="nombre_carpeta" value="">
		</div>
		<div class="col-md-6">
			<label>TIPO DE CARPETA</label>
			<select class='form-control' style="width:100%;" placeholder='Tipo' name='tipo' id='tipo' >
				<option value="1">Carpeta Publica</option>
				<option value="2">Carpeta Privada</option>			
			</select>
		</div>
	</div>
	<div class="row m-t-10">
		<div class="col-md-6">
			<input type='button' id="btnInsertGestionFolder" value='Guardar Carpeta' class="btn btn-primary" onClick="InsertGestionFolder()"/>
		</div>
	</div>
</form>