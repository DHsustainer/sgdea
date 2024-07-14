<div class="tmain">Editar Lista <?= $object->GetTitulo() ?></div>
<form id='FormUpdatemeta_listas' action='/meta_listas/actualizar/' method='POST'> 
	<input type="hidden" class="form-control " placeholder="Nombre de la Lista" value='<? echo $object -> GetId(); ?>' name="id" id="id" maxlength="200">

	<label for="dependencia">Nombre de la Lista</label>
	<input type="text" class="form-control m-b-10 " placeholder="Nombre de la Lista" value='<? echo $object -> GetTitulo(); ?>' name="titulo" id="titulo" maxlength="200">

	<label for="dependencia">Dependencia de la Lista</label>
		<select name="dependencia" id="dependencia" class="form-control m-b-10">
			<option value="0">Lista de Dependencia (Opcional)</option>
			<?
				global $con;
				$objectx = new MMeta_listas;
				$query = $objectx->ListarMeta_listas("WHERE tipo = '1'");	    
				while($row = $con->FetchAssoc($query)){
					$l = new MMeta_listas;
					$l->Createmeta_listas('id', $row[id]);
					$pathx = "";
					if ($l->GetId() == $object->GetDependencia()) {
						$pathx = "selected = 'selected'";
					}
			?>						
					<option value="<?= $l->GetId() ?>" <?= $pathx ?>><?php echo utf8_decode($l -> GetTitulo()); ?></option>
			<?
				}	
			?>		
		</select>

	<div class="form-group">
		<div class="form-group form-group-lg">
			<label class="radio-inline">
				<input type="radio" id="tipo1" name="tipo" value="1" <?= ($object->GetTipo() == "1")?"checked":"" ?>> Lista Desplegable
			</label>
		
			<label class="radio-inline">
				<input type="radio" id="tipo2" name="tipo" value="2"  <?= ($object->GetTipo() == "2")?"checked":"" ?>> Lista de Chequeo
			</label>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<button type="button" class="btn btn-success fullwidth" onclick="SendForm('FormUpdatemeta_listas', '/meta_listas/','alistas', 'body-metadatosjs')">Guardar Cambios</button>
		</div>
	</div>
</form>	
<hr>
<div class="tmain">Elementos de la Lista</div>

<?

	$elementos = new MMeta_listas_valores;
	$query = $elementos->ListarMeta_listas_valores("WHERE id_lista = '".$object->GetId()."'");	 

   		if($con->NumRows($query) <= 0 || $query !=''){

			include_once(VIEWS.DS.'meta_listas_valores/Listar.php');	   			

		}else{

			echo '<br><br><div class="alert alert-info" role="alert">No existen elementos en esta lista</div><br>';

		}
?>
<hr>
<div id="formelementoslistas">
<?
	include_once(VIEWS.DS.'meta_listas_valores/FormInsertMeta_listas_valores.php');
?>
</div>