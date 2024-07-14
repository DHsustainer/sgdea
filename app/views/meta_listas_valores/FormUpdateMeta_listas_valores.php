<form id='FormUpdatemeta_listas_valores' action='/meta_listas_valores/actualizar/' method='POST'> 
	<div class="tmain">Editar Elemento</div>
	<input type='hidden' name='id' id='id' value='<? echo $object -> GetId(); ?>' />
	<input type='hidden' class='form-control' placeholder='Id_lista' value="<?= $object->GetId_lista() ?>" name='id_lista' id='id_lista' maxlength='4' value='<? echo $object -> Getid_lista(); ?>' />
	<div class="row">
		<div class="col-md-6">
			Titulo<br>
			<input type='text' class='form-control' placeholder='Titulo' name='titulo' id='titulo' maxlength='45' value='<? echo $object -> Gettitulo(); ?>' />		
		</div>
		<div class="col-md-6">
			Valor<br>
			<input type='text' class='form-control' placeholder='Valor' name='valor' id='valor' maxlength='45' value='<? echo $object -> Getvalor(); ?>' />		
		</div>
		<?
			global $con;
			$listad = new MMeta_listas;
			$listad->CreateMeta_listas('id', $object->GetId_lista());
			if ($listad->GetDependencia() != "0") {
		?>
			<div class="col-md-12">
				<label for="dependencia">Valor de Dependencia
					<select name="dependencia" id="dependencia" class='form-control'>
						<option value="0">Valor de la Dependencia</option>
					<?

						$elementos = new MMeta_listas_valores;
						$query = $elementos->ListarMeta_listas_valores("WHERE id_lista = '".$listad->GetDependencia()."'");	 
						while($row = $con->FetchAssoc($query)){
							$l = new MMeta_listas_valores;
							$l->Createmeta_listas_valores('id', $row[id]);

							$pathx = "";
							if ($l->GetValor() == $object->GetDependencia()) {
								$pathx = "selected = 'selected'";
							}
							echo "<option value='".$l->GetValor()."' $pathx > ".$l->GetTitulo()."</option>";
						}
					?>
					</select>
				</label>
			</div>
		<?
			}
		?>
	</div>

	<div class="row m-t-20">
		<div class="col-md-12">
			<button type="button" class="btn btn-success fullwidth" onclick="SendForm('FormUpdatemeta_listas_valores', '/meta_listas/editar/<?= $object->GetId_lista() ?>/','r<?= $object->GetId_lista() ?>', 'inner-metadatosjs')">Guardar Lista</button>
		</div>
	</div>
</form>