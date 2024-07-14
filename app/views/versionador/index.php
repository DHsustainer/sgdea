<div id="tools-content">
	<div class="opc-folder blue">
		<ol class="breadcrumb">
		  		<?
				    $permisos = $_SESSION['vector'][1];
				    $module = $_REQUEST['m'];
				    $exist = true;
				    for ($k=0; $k < count($permisos) ; $k++) { 
				    	$link = explode(":", $permisos[$k])	;
				    	if ($module == $link[1]) {
					        echo '<li class="breadcrumb-item "><span class="fa  '.$link[2].'"></span> '.$link[0].'</li>';
					        $exist = true;
					        break;
				    	}else{
				    		$exist = false;
				    	}
				    }

				    if ($exist) {
				    	# code...
				    }
				?>
		  	<li class="breadcrumb-item">Administrar Versiónes</li>
		</ol>
	</div>
</div>
<div id="folders-content">
	<div id="folders-list-content">
<?
	if ($exist) {
?>
		<div class="row">
			<div class="col-md-7">
				<div class="row mid-height">
					<div class="col-md-12"></div>
				</div>
				<div class="row mid-height">
					<div class="col-md-12"></div>
				</div>
			</div>
			<div class="col-md-5">
				mundo
			</div>
		</div>
<?
	}
?>
	</div>
</div>
<style type="text/css">

</style>