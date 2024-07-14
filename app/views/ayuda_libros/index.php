<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h2>
			<?
			    $permisos = $_SESSION['vector'][2];
			    $module = $_REQUEST['m'];
			    $exist = true;
			    for ($k=0; $k < count($permisos) ; $k++) { 
			    	$link = explode(":", $permisos[$k])	;
			    	if ($module == $link[1]) {
				        echo '<span class="fa '.$link[2].'"></span>'.$link[0].'';
				        $exist = true;
				        break;
			    	}else{
			    		$exist = false;
			    	}
			    }
			?>
			</h2>
		</div>
	</div>
<?
	if ($exist) {
?>	
	<div class="row">
		<div class="col-md-6" id="main_form_suscriptores_modulos">
			<?
			 	include(VIEWS.DS."ayuda_libros/FormInsertAyuda_libros.php");

				$object = new MAyuda_libros;
		    	$query = $object->ListarAyuda_libros();

		    	include(VIEWS.DS."ayuda_libros/Listar.php");
			?>			
		</div>
		<div class="col-md-6">
			<div id="gestion-actuaciones">
		        <div class="table" id="listadolibros">
				    <div class="title right">Listado de Elementos</div>
				    <br>					
					<div class="alert alert-info">Seleccione un Libro</div>
				</div>
			</div>
			
		</div>
	</div>
<?
	}
?>
</div>


<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
});
</script>