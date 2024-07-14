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
		<div class="col-md-6" id="main_form_control_versiones">
			<?
				include(VIEWS.DS."control_versiones/FormInsertControl_versiones.php");
			?>			
		</div>
		<div class="col-md-6">
			<?
				include(VIEWS.DS."control_versiones/Listar.php");	   			
			?>			
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