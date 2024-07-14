<form id='formmeta_listas_valores' action='/meta_listas_valores/registrar/' method='POST'> 
	<div class="tmain">Agregar un nuevo Elemento a la Lista</div>
	<input type='hidden' class='form-control' placeholder='Id_lista' value="<?= $object->GetId() ?>" name='id_lista' id='id_lista' maxlength='4' />
	<div class="row">
		<div class="col-md-6">
			<input type='text' class='form-control' placeholder='Titulo' name='titulo' id='titulo' maxlength='45' />		
		</div>
		<div class="col-md-6">
			<input type='text' class='form-control' placeholder='Valor' name='valor' id='valor' maxlength='45' />		
		</div>
		<?
			if ($object->GetDependencia() != "0") {
		?>
			<div class="col-md-12">
				<label for="dependencia">Valor de Dependencia
					<select name="dependencia" id="dependencia" class='form-control'>
					<?
						$elementos = new MMeta_listas_valores;
						$query = $elementos->ListarMeta_listas_valores("WHERE id_lista = '".$object->GetDependencia()."'");	 
						while($row = $con->FetchAssoc($query)){
							$l = new MMeta_listas_valores;
							$l->Createmeta_listas_valores('id', $row[id]);
							echo "<option value='".$l->GetValor()."'>".$l->GetTitulo()."</option>";
						}
					?>
					</select>
				</label>
			</div>
		<?
			}
		?>
	</div>

	<div class="row">
		<div class="col-md-12">
			<button type="button" class="btn btn-success fullwidth" onclick="SendForm('formmeta_listas_valores', '/meta_listas/editar/<?= $object->GetId() ?>/','r<?= $object->GetId() ?>', 'inner-metadatosjs')">Guardar Lista</button>
		</div>
	</div>
</form>