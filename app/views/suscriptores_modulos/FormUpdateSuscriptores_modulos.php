<form id='formsuscriptores_modulos' action='/suscriptores_modulos/actualizar/' method='POST'> 
	<div class='title right'>
		<div style="float:left">Actualizar Modulo</div>
		<div style="float:right"><a href="/suscriptores_modulos/listar/<?= $idp ?>/" class="link-blanco"><span class="fa fa-plus"></span> Nuevo Modulo</a></div>
		<div style="clear:both"></div>
	</div>
	<br>
	<div class="row">
		<div class="col-md-8">
			<div class="form-group">
				<label for="nombre">Nombre</label>
				<input type='text' class='form-control' placeholder='Nombre' name='nombre' id='nombre' maxlength='255' value="<? echo $object -> Getnombre(); ?>" />
				<input type='hidden' class='form-control' placeholder='Nombre' name='id' id='id' maxlength='255' value="<? echo $object -> GetId(); ?>" />

				<input type='hidden' class='form-control' placeholder='id_proyecto' name='id_proyecto' id='id_proyecto' maxlength='255' value="<? echo $object -> GetId_proyecto(); ?>" />
			</div>
		</div>
		<div class="col-md-4">
			<div class="form-group">
				<label for="nombre">Estado</label>
				<select class='form-control' placeholder='Nombre' name='estado' id='estado' value="" style="height: 45px;">
					<option <?= ($object->GetEstado() == "1")?"selected='selected'":"" ?> value="1">Activo</option>
					<option <?= ($object->GetEstado() == "0")?"selected='selected'":"" ?> value="0">Inactivo</option>
				</select>
				
			</div>
		</div>
	</div>
	
	

	<div class="row">
		<div class="col-md-12">
			<div class="form-group">	
				<label for="descripcion">Descripcion</label>
				<input type='text' class='form-control' placeholder='Descripcion' name='descripcion' id='descripcion' maxlength='' value="<? echo $object -> Getdescripcion(); ?>" />
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-4">
			<div class="form-group">	
				<label for="key_code">Palabra Clave <span class="fa fa-question-circle-o" data-toggle="tooltip" title="Código Interno identificador del modulo"></span></label>
				<input type='text' class='form-control' placeholder='Key_code' name='key_code' id='key_code' maxlength='50' value="<? echo $object -> Getkey_code(); ?>" />
			</div>
		</div>
		<div class="col-md-4">
			<div class="form-group">	
				<label for="link">Link <span class="fa fa-question-circle-o" data-toggle="tooltip" title="Enlace de acceso para modulo externo (Evitar utilizar slashes '/')"></span></label>
				<input type='text' class='form-control' placeholder='Link' name='link' id='link' maxlength='400' value="<? echo $object -> Getlink(); ?>" />
			</div>
		</div>
		<div class="col-md-4">
			<div class="form-group">	
				<label for="link">Tipo de Funcion<span class="fa fa-question-circle-o" data-toggle="tooltip" title="Describe el tipo de forma como se capturará la información"></span></label>
				<select class='form-control' placeholder='Tipo' name='tipo_elemento' id='tipo_elemento' style="height: 45px;">
					<option <?= ($object->GetTipo_elemento() == "1")?"selected='selected'":"" ?> value="1">Activar/Desactivar</option>
					<option <?= ($object->GetTipo_elemento() == "2")?"selected='selected'":"" ?> value="2">Valor Numerico</option>
				</select>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-4">
			<div class="form-group">	
				<label for="tipo">Tipo de Modulo <span class="fa fa-question-circle-o" data-toggle="tooltip" title="Define el tipo de modulo a instalar, su tipo define su ubicacion"></span></label><br>
				<select class='form-control' placeholder='Tipo' name='tipo' id='tipo' value="<? echo $object -> Gettipo(); ?>" style="height: 45px;">
					<option value="-1">Seleccione una Opción</option>
					<option <?= ($object->GetTipo() == "-1")?"selected='selected'":"" ?> value="-1">Modulo del sistema</option>
					<option <?= ($object->GetTipo() == "0")?"selected='selected'":"" ?> value="0">Modulo de Subserie G/ral o Especifica</option>
					<option <?= ($object->GetTipo() == "1")?"selected='selected'":"" ?> value="1">Modulo de Menú Principal</option>
					<option <?= ($object->GetTipo() == "2")?"selected='selected'":"" ?> value="2">Modulo de Menú Herramientas</option>
					<option <?= ($object->GetTipo() == "3")?"selected='selected'":"" ?> value="3">Modulo de Area de Suscriptores</option>
					<option <?= ($object->GetTipo() == "4")?"selected='selected'":"" ?> value="4">Modulo de Area de Usuarios</option>
				</select>
			</div>
		</div>
		<div class="col-md-4">
			<div class="form-group">	
				<label for="icono">Icono<span class="fa fa-question-circle-o" data-toggle="tooltip" title="Se utiliza Font-Awesome para manejar los iconos"></span></label>
				<input type='text' class='form-control' placeholder='Icono' name='icono' id='icono' maxlength='100' value="<? echo $object -> Geticono(); ?>" />
			</div>
		</div>
		<div class="col-md-4">
			<div class="form-group">	
				<label for="icono">Valor<span class="fa fa-question-circle-o" data-toggle="tooltip" title="Valor en pesos $ Sin puntos"></span></label>
				<input type='text' class='form-control' placeholder='Valor ' name='imagen' id='imagen' maxlength='100' value="<? echo $object -> Getimagen(); ?>" />
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-6">
			<input type='submit' value='Actualizar Modulo' />
		</div>
		<div class="col-md-6">
			<input type='button' class="red" value='Eliminar Modulo' onClick="window.location.href='/suscriptores_modulos/eliminar/<?= $object->GetId() ?>/'" />
		</div>
	</div>
	
</form>
<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
});
</script>