<form id='formseccional_principal' action='/seccional_principal/registrar/' method='POST'> 
	<div class="title">Editar Ciudad</div><br>
	<input type='hidden' name='id' id='id' value='<? echo $object -> GetId(); ?>' />
	<input type='text' class="form-control" placeholder="Nombre" name='nombre' id='nombre' maxlength='100'value='<? echo $object -> Getnombre(); ?>' />
	<input type='text' class="form-control" placeholder="Sigla" name='sigla' id='sigla' maxlength='6'value='<? echo $object -> Getsigla(); ?>' />
	
<?
		$ci = new MCity;
		$ci->CreateCity("code", $object->GetCiudad_origen());

		$pr = new MProvince;
		$pr->CreateProvince("code", $ci->GetProvince());

?>
	<select class="form-control" name="departamento" id="departamento" onChange="dependencia_ciudad('departamento','ciudad_origen')">
		<option value="<?= $pr->GetCode() ?>"><?= $pr->GetName() ?></option>
	</select>
	<select class="form-control" name="ciudad_origen" id="ciudad_origen" disabled="disabled">
		<option value="<?= $ci->GetCode() ?>"><?= $ci->GetName() ?></option>
	</select>

	
	<input type='submit' style="margin:10px;" value='Actualizar Ciudad'/>
</form>

<script>
	dependencia_estado('departamento');
</script>