<div class="row">
	<div class="col-md-12">
		<h2>
		    <span class="fa fa-puzzle-piece"></span>Reglas de los Negocios
		</h2>
	</div>
</div>
<div class="row">
	<div class="col-md-5">
		
		<div class="form-group" style="margin-left: 10px;">
			<label for="id_proyecto_main">Seleccione un Proyecto</label>
			<select name="id_proyecto_main" id="id_proyecto_main" style="width:400px" onChange="dependencia_item('id_proyecto_main', 'id_negocio', '/suscriptores_paquetes_negocios/listarnegocios/')">
				<option value="0">Seleccione un Proyecto</option>
				<?
					$tp = new MSuscriptores_tipos_proyectos;
					$q = $tp->ListarSuscriptores_tipos_proyectos();

					while ($row = $con->FetchAssoc($q)) {
						$selected = ($proyecto == $row['id'])?"selected='selected'":"";
						echo "<option value='".$row['id']."' ".$selected.">".$row['nombre']."</option>";
					}
				?>
			</select>
		</div>

	</div>
	<div classs="col-md-7">
		<div class="form-group" style="margin-left: 10px;">
			<label for="id_negocio">Seleccione un Negocio</label><br>
			<select name="id_negocio" id="id_negocio" style="width:400px" disabled="disabled" onChange="ChangeProyecto(this)">
				<option value="0">Seleccione un Negocio</option>
			</select>
		</div>

	</div>
</div>
<div class="row">
	<div class="col-md-7">
		<?
			include(VIEWS.DS."suscriptores_reglas_negocios_generales/Listar.php");	   			
		?>			
	</div>
	<div class="col-md-5" id="main_form_suscriptores_modulosx">
		<?
			if ($negocio != "") {
				# code...
				include(VIEWS.DS."suscriptores_reglas_negocios_generales/FormInsertSuscriptores_reglas_negocios_generales.php");
			}
		?>			
	</div>
</div>

<script>
function ChangeProyecto(vd){
}
/*
*/
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 

    $("#id_negocio").change(function(){
		window.location.href = '/suscriptores_reglas_negocios_generales/listar/'+$("#id_proyecto_main").val()+'/'+$("#id_negocio").val()+'/';
    })
});

<?
	if (trim($proyecto) != "") {
?>
		dependencia_item('id_proyecto_main', 'id_negocio', '/suscriptores_paquetes_negocios/listarnegocios/')

		setTimeout(function(){ 
			var elemento= <?= $negocio ?>;
			$("#id_negocio").val(elemento);
		}, 500);

<?		
	}
?>

</script>