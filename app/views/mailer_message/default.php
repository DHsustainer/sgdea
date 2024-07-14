<div class="row m-t-30">
	<div class="col-md-12 panel">
	 	<div class="white-panel p-t-30">
<?php 
	if ($action == "inbox"){
		include(VIEWS.DS."mailer_message".DS."Listar.php");
	}elseif ($action == "nuevo") {
		include(VIEWS.DS."mailer_message".DS."FormInsertMailer_message.php");
	}elseif ($action == "nuevomasivo") {
		include(VIEWS.DS."mailer_message".DS."FormInsertMailer_message_masivo.php");
	}elseif ($action == "ver") {
		include(VIEWS.DS."mailer_message".DS."ver.php");
	}elseif ($action == "veracuse") {
		include(VIEWS.DS."mailer_message".DS."veracuse.php");
	}else{
		include(VIEWS.DS."mailer_message".DS."Listar.php");
	}
?>
		</div>
	</div>
</div>

<?
	if($id != ""){
?>
		<script>
			var code = "<?= $id ?>";
			$("#ajax-l-process").css("display", "inline-block");		
			var url = "<?= HOMEDIR.DS.'agenda'.DS.'listadoprocesos'.DS.'"+code+"'.DS ?>";
			$.get(url,
				function(resultado){

					if(resultado == false){

						$('#listado_procesos').append("<option value='*'>No tienes procesos</option>");			

					}else{
						$("#listado_procesos").attr("disabled",false);
						document.getElementById("listado_procesos").options.length=1;
						$('#listado_procesos').append(resultado);			
						$("#ajax-l-process").css("display", "none");	
						$('#listado_procesos option[value="<?= $pid ?>"]').attr("selected", "selected");
	
					}
				}
			);
		</script>
<?
	}
?>
<script>
	var code = "<?= $id ?>";
	var url = "<?= HOMEDIR.DS.'agenda'.DS.'listadocarpetas'.DS ?>";
	$("#ajax-l-folder").css("display", "inline-block");
	$.get(url,
		function(resultado){

			if(resultado != false){

				$("#carpetasagenda").attr("disabled",false);
				document.getElementById("carpetasagenda").options.length=1;
				$('#carpetasagenda').append(resultado);			
				$("#ajax-l-folder").css("display", "none");
			}
		}
	);		
</script>

<script>
	
	$("#carpetasagenda").live("change", function(){
		var code = $(this).val();
		if(code == "*"){
			var url = "<?= HOMEDIR.DS.'correo'.DS.$action.DS.$date.DS.$_GET['cn'].DS ?>";
			window.location.href= url;	
		}else{
			$("#ajax-l-process").css("display", "inline-block");		
			var url = "<?= HOMEDIR.DS.'agenda'.DS.'listadoprocesos'.DS.'"+code+"'.DS ?>";
			$.get(url,
				function(resultado){

					if(resultado == false){

						$('#listado_procesos').append("<option value='*'>No tienes procesos</option>");			

					}else{
						$("#listado_procesos").attr("disabled",false);
						document.getElementById("listado_procesos").options.length=1;
						$('#listado_procesos').append(resultado);			
						$("#ajax-l-process").css("display", "none");		
					}
				}
			);
		}
				
	});

	$("#listado_procesos").live("change", function(){
		var url = "<?= HOMEDIR.DS.'correo'.DS.$action.DS ?>"+$("#carpetasagenda").val()+"."+$(this).val()+"/1/";		
		window.location.href= url;
	});
</script>