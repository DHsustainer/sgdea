


<div class="tmain">Editar Formulario <?= $object->GetTitulo() ?></div>
<form id='FormUpdatemeta_referencias_titulos' action='/meta_referencias_titulos/actualizar/' method='POST'> 
	<input type="hidden" class="form-control " placeholder="Nombre de la Lista" value='<? echo $object -> GetId(); ?>' name="id" id="id" maxlength="200">
	<div class="form-group">
		<div class="form-group form-group-lg">
			<div class="input-group" data-toggle="tooltip" data-placement="bottom" title="Nombre del Usuario">	
				<div class="input-group-addon fa fa-user iconbox"></div>
				<input type="text" class="form-control " placeholder="Nombre de la Lista" value='<? echo $object -> GetTitulo(); ?>' name="titulo" id="titulo" maxlength="200">
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<?

				$tipos = array("1" => "Formularios de Subserie", "2" => "Met. de Documento", "3" => "Metadatos del Suscriptor");
				$tipos2 = array("1" => "SI", "0" => "NO");

			?>
			<label for="tipo">Tipo de Formulario</label>
			<input type='text' disabled class='form-control' placeholder='tipo' name='tipo' id='tipo' maxlength='' value='<? echo $tipos[$object -> Gettipo()]; ?>' />
		</div>
		<div class="col-md-4">
			<label for="es_generico">Es generico</label>
			<select class='form-control' placeholder='es_generico' name='es_generico' id='es_generico' style="height: 46px;">
				<option value="SI">SI</option>
				<option value="NO" <?= ($tipos2[$object -> Getes_generico()] == "NO")?"selected='selected'":"" ?>>NO</option>
			</select>
		</div>
		<?
			if ($_SESSION['usuario'] == 'sanderkdna@gmail.com') {
		?>
			<div class="col-md-2" style="display:none">
				<label for="id_s">Id. Ext.</label>
				<input type='text' disabled class='form-control' placeholder='id_s' name='id_s' id='id_s' maxlength='' value='<? echo $object -> GetId_s(); ?>' />
			</div>
		<?
			}
		?>
	</div>

<br>


	<div class="row">
		<div class="col-md-12">
			<? 
				if ($object -> GetId_s() == "") {
			?>

					<button type="button" class="btn btn-success fullwidth" onclick="SendForm('FormUpdatemeta_referencias_titulos', '/meta_referencias_titulos/','fmeta', 'body-metadatosjs')">Guardar Cambios</button>
			<?
				}else{
			?>
					<button type="button" class="btn btn-success fullwidth" onclick="SendForm('FormUpdatemeta_referencias_titulos', '/meta_referencias_titulos/dependencia/<?= $object -> GetId_s() ?>','fmeta', 'body-metadatosjs')">Guardar Cambios</button>
			<?
				}
			?>
		</div>
	</div>
</form>	
<br>
	<div class="row">
		<div class="col-md-12">
			<a class="btn btn-primary" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
			  Ver Tipos de Suscriptor que pueden acceder al formulario
			</a><br><br>
			<div class="collapse" id="collapseExample">
			  <div class="well">
			    <?
					$lx = new MSuscriptores_tipos;
					$query_eg = $lx->ListarSuscriptores_tipos(); 
					while($row_type = $con->FetchAssoc($query_eg)){
						$check = $con->Query("select count(*) as t from meta_titulos_suscriptores where id_referencia = '".$object -> GetId()."' and tipo_suscriptor = '".$row_type['id']."'");
						$dat = $con->Result($check, 0, 't');

						$checked = ($dat > 0)?"checked='checked'":"";
						echo '<label style="margin-right:20px">
								<input type="checkbox" '.$checked.' vale="'.$row_type['id'].'" id="ts'.$row_type['id'].'" onClick="SetRefSuscrpitor(\''.$object -> GetId().'\',\''.$row_type['id'].'\')"> '.$row_type['nombre'].'
							  </label><br>';
					}

				?><br>
				<button class="btn btn-warning" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">Ocultar Listado</button>
			  </div>
			</div>
		</div>
	</div>
<hr>
<div class="tmain">Elementos del Formulario</div>

<?

	$elementos = new MMeta_referencias_campos;
	$query = $elementos->ListarMeta_referencias_campos("WHERE id_referencia = '".$object->GetId()."'", "order by orden");	 

   		if($con->NumRows($query) <= 0 || $query !=''){

			include_once(VIEWS.DS.'meta_referencias_campos/Listar.php');	   			

		}else{

			echo '<br><br><div class="alert alert-info" role="alert">No existen elementos en esta lista</div><br>';

		}
?>
<hr>
<div id="formelementoslistas">
<?
	include_once(VIEWS.DS.'meta_referencias_campos/FormInsertMeta_referencias_campos.php');
?>
</div>