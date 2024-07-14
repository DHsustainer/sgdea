<div class="tmain">Crear una nueva Lista</div>
<form id='formmeta_listas' action='/meta_listas/registrar/' method='POST'> 

	<input type="text" class="form-control m-b-10 " placeholder="Nombre de la Lista" name="titulo" id="titulo" maxlength="200">
	
	<select name="dependencia" id="dependencia" class="form-control m-b-10">
		<option value="0">Lista de Dependencia (Opcional)</option>
		<?
			global $con;
			$object = new MMeta_listas;
			$query = $object->ListarMeta_listas("WHERE tipo = '1'");	    
			while($row = $con->FetchAssoc($query)){
				$l = new MMeta_listas;
				$l->Createmeta_listas('id', $row[id]);
		?>						
				<option value="<?= $l->GetId() ?>"><?php echo utf8_decode($l -> GetTitulo()); ?></option>
		<?
			}	
		?>		
	</select>

	<div class="form-group">
		<div class="form-group form-group-lg">
			<label class="radio-inline">
				<input type="radio" id="tipo1" name="tipo" value="1" checked> Lista Desplegable
			</label>
		
			<label class="radio-inline">
				<input type="radio" id="tipo2" name="tipo" value="2"> Lista de Chequeo
			</label>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<button type="button" class="btn btn-success fullwidth" onclick="SendForm('formmeta_listas', '/meta_listas/','alistas', 'body-metadatosjs')">Guardar Lista</button>
		</div>
	</div>
</form>