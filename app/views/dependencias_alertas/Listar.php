<div class="alert alert-info">En este panel puede configurar las alertas que desee que se generen de forma predeterminada en las radicaciones creadas</div>
<div id="loadpathformtipologias">
    <div id="form-oficinas2" class="left table">
    	<? include(VIEWS.DS."dependencias_alertas".DS."FormInsertDependencias_alertas.php"); ?>
    </div>
</div>
	<h2>Listado de Alertas de la Sub-Serie <?= $dep->GetNombre()?></h2>
	<div id="listadoelementos">
		<div class="myadmin-dd-empty dd">
	        <ol class="list-group dd-list">
				<?
					$da = new MDependencias_alertas;
					$da->GetDependientesListado($id, 0, "-");	
				?>
			</ol>
		</div>
	</div>

<link rel='stylesheet' type='text/css' href='<?= HOMEDIR.DS ?>app/plugins/nestable/nestable.css'/>

<script>

function EliminarDependencias_alertas(id){
	if(confirm('¿Esta seguro desea eliminar esta alerta, Las alertas generadas anteriormente NO serán eliminadas?')){
		var URL = '/dependencias_alertas/eliminar/'+id+'/';
		$.ajax({
			type: 'POST',
			url: URL,
			success: function(msg){
				alert(msg);
				$('#row'+id).remove();
			}
		});
	}
	
}	

function EditarDependencias_alertas(id){
	var URL = '/dependencias_alertas/editar/'+id+'/';
	$.ajax({
		type: 'POST',
		url: URL,
		success: function(msg){
			$('#loadpathformtipologias').html(msg);
		}
	});
}	
</script>		
