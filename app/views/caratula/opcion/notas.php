<link href="<?=ASSETS?>/styles/bootstrap.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="<?=ASSETS?>/styles/summernote.css">
<script src="<?=ASSETS?>/js/summernote.js"></script>
<div id="form">
	<table class="tbd">
		<tr>
			<td style="width:65%">
				<div id="crear-nota" class="left table">
					<form action="/caratula/opcion/<?=$_GET[id]?>/guardar_nota/" method="POST">
						<div class="title" id="newnote">Crear una nueva nota</span></div>
						<input type="text" placeholder="Título de la nota" class="title_nota" name="title_nota" id="title_nota">
						<input type="hidden" name="id_nota" id="id_nota">
						<textarea name="summernote_nota" id="summernote_nota" placeholder="Describe yourself with 4 words..." data-bind='value:   Description'></textarea>
					<?php if ($_SESSION[usuario]==$_SESSION[sadminid] || $_SESSION[sadmin]!=1): ?>
					<?
						if ($_SESSION['folder'] == '') {
					?>
							<input type="submit" value="Guardar" style="margin:10px;">
					<?
						}
					?>
					<?php endif ?>
					</form>	
					
				</div>
			</td>
			<td rowspan="2" style="width:33%">
				<div class="title right">Notas del Proceso</div>
				<div class="table">
					<?php 
						while ($col=$con->FetchAssoc($notes)) {
							if ($_SESSION[usuario]==$_SESSION[sadminid] || $_SESSION[sadmin]!=1){
								if ($_SESSION['folder'] == '') {
									$path = "<a onclick='EliminarNotas(\"".$col[id]."\")'>Eliminar</a>";
								}							
							}
							echo "	<div id='r".$col[id]."' class='item-plantilla' onclick='shownote($col[id])'>
										$col[titulo]
			                        	$path
									</div>";
						} 
					?>
				</div>
				
				
			</td>
		</tr>
	</table>
</div>
<script>
	$(document).ready(function() {
		$('#summernote_nota').summernote({
			toolbar: [
				['style', ['fontname', 'bold', 'italic', 'underline']],
				['para', ['ul', 'ol', 'paragraph']],
			],
		});


		$("#newnote").click(function() {
			$('#summernote_nota').code("");
			$('#title_nota').val("");
			$('#id_nota').val("");
			$('#title_nota').focus();
		});
	});
	function shownote(id){
		$.ajax({
			url:'<?=HOMEDIR?>/caratula/opcion/<?=$_GET[id]?>/get_nota/',
			type:'POST',
			data:{id_nota:id},
			success:function(msg){
				var dat = eval('('+msg+')');
				$('#summernote_nota').code(dat['texto']);
				$('#title_nota').val(dat['title']);
				$('#id_nota').val(dat['id']);
			}
		})
	}
	function EliminarNotas(id){
		if(confirm('Esta seguro desea eliminar esta nota')){
			var URL = '<?= HOMEDIR ?>/notas/eliminar/'+id+'/';
			$.ajax({
				type: 'POST',
				url: URL,
				success: function(msg){
					alert(msg);

					window.location.reload();
				}
			});
		}
		
	}	
</script>