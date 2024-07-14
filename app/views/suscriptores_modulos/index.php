<div class="row">
	<div class="col-md-12">
		<h2>
		    <span class="fa fa-cogs"></span>Modulos de Configuración
		</h2>
	</div>
	<div classs="col-md-12">
		
		<div class="form-group" style="margin-left: 10px;">
			<label for="nombre">Seleccione un Proyecto</label>
			<select name="id_proyecto_main" id="id_proyecto_main" style="width:400px" onChange="ChangeProyecto(this)">
				<option value="0">Seleccione un Proyecto</option>
				<?
					$tp = new MSuscriptores_tipos_proyectos;
					$q = $tp->ListarSuscriptores_tipos_proyectos();

					while ($row = $con->FetchAssoc($q)) {
						$selected = ($id == $row['id'])?"selected='selected'":"";
						echo "<option value='".$row['id']."' ".$selected.">".$row['nombre']."</option>";
					}
				?>
			</select>
		</div>

	</div>
</div>
<?
	if ($id) {

		$pro = new MSuscriptores_tipos_proyectos;
		$pro->CreateSuscriptores_tipos_proyectos("id", $id);

?>
		<div class="row">
			<div class="col-md-7">
				<?
					include(VIEWS.DS."suscriptores_modulos/Listar.php");	   			
				?>			
			</div>
			<div class="col-md-5" id="main_form_suscriptores_modulosx">
				<?
					include(VIEWS.DS."suscriptores_modulos/FormInsertSuscriptores_modulos.php");
				?>			
			</div>
		</div>
<?
	}else{
?>
		<div class="row">
			<div class="col-md-12">
				<div class="alert alert-info" role="alert">Seleccione un Proyecto para ver sus modulos disponibles</div>
			</div>
		</div>
<?	
	}
?>
<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
});

	function ChangeProyecto(vd){
		window.location.href = '/suscriptores_modulos/listar/'+vd.value+'/';
	}
</script>