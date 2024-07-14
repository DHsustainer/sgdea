<div id="photo_profile">
	<div id="ppic"  class="imtochange">
		<input type="button" value="Instalar Fuente" class="btn btn-info">		
	</div>
	<form action="<?= HOMEDIR; ?>/fuentes/registrar/" id="formpicture" method="post" enctype="multipart/form-data">
        <div style="display:none">
	        <input name="archivo" id="selfile" type="file" size="35"/>
        </div>
  	</form>
</div>

<script type="text/javascript">
	
	$("#ppic").click(function() {
		$("#selfile").click();
	});

	$("#selfile").change(function() {
		$("#formpicture").submit();
	});

</script>