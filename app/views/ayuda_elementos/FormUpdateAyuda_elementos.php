<form id='FormUpdateayuda_elementos' action='/ayuda_elementos/actualizar/' method='POST' class="form-horizontal"> 
	<input type='hidden' name='id' id='id' value='<? echo $object -> GetId(); ?>' />

	
	<div class="form-group">
        <label class="col-md-12">Titulo (Como identificamos el Elemento)</label>
        <div class="col-md-12">
        	<input type='text' class='form-control' value='<? echo $object -> Gettitulo(); ?>' placeholder='Titulo' name='titulo' id='titulo' maxlength='400' />
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-12">Descripcion (Esto es lo que verá el Usuario)</label>
        <div class="col-md-12">
        	<input type='text' class='form-control' class='form-control'  placeholder='Descripcion' name='texto' id='texto' value='<? echo $object -> Gettexto(); ?>' />
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-12">Descripcion Detallada (Esto es lo que mostrará en la interfaz de manuales)</label>
        <div class="col-md-12">
        	<textarea class='form-control height-100' placeholder='Detalle' name='detalle' id='detalle'><? echo $object -> GetDetalle(); ?></textarea>
        </div>
    </div>
    <div class="row">
	    <div class="col-md-6">
		    <div class="form-group">
		        <label class="col-md-12">Ubicación de la Alerta</label>
		        <div class="col-md-12">
					<select placeholder='Posicion' name='posicion' id='posicion' class="form-control">
						<option value="top" <?= ($object->Getposicion() == "top")?'selected="selected"':"" ?>>Top (Arriba del Elemento)</option>
						<option value="right" <?= ($object->Getposicion() == "right")?'selected="selected"':"" ?>>Right (A la Derecha del Elemento)</option>
						<option value="bottom" <?= ($object->Getposicion() == "bottom")?'selected="selected"':"" ?>>Bottom (Abajo del Elemento)</option>
						<option value="left" <?= ($object->Getposicion() == "left")?'selected="selected"':"" ?>>Left (A la Izquierda del Elemento)</option>
					</select>
				</div>
			</div>
	    </div>
	    <div class="col-md-6">
	    	<div class="form-group">
		        <label class="col-md-12">Estado</label>
		        <div class="col-md-12">
					<select placeholder='Estado' name='estado' id='estado' class="form-control">
						<option value="1" <?= ($object->GetEstado() == "1")?'selected="selected"':"" ?>>Activo</option>
						<option value="0" <?= ($object->GetEstado() == "0")?'selected="selected"':"" ?>>Oculto</option>
					</select>
				</div>
			</div>
	    </div>
    </div>
	<div class="row">
		<div class="col-md-6">
		    <div class="form-group">
			    <label class="col-md-12">Agregar Etiqueta</label>
			    <div class="col-md-12">
			    	<input type="text" id="dtetiqueta" name="dtetiqueta" placeholder='Nombre Etiqueta' class='form-control important'>
					<div id='bloquebusquedaetiqueta'></div>
				</div>
			</div>
		</div>
		<div class="col-md-6">
		    <div class="form-group">
			    <label class="col-md-12">Listado de Etiquetas</label>
			    <div class="col-md-12">
			    	<div id="listadoetiquetas">
			    		<?php
			    			$MAyuda_etiquetas_elementos = new MAyuda_etiquetas_elementos;
							echo $MAyuda_etiquetas_elementos->Lista_ayuda_etiquetas_elementos($object -> GetId());
			    		?>
			    	</div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="row ">
    	<div class="col-md-12">
    		<button type="button" onclick="UpdateElementos()" class="btn btn-success waves-effect waves-light m-r-10 pull-right">Actualizar</button>
    	</div>
    </div>
</form>
<script type="text/javascript">
	$("#dtetiqueta").on("keyup", function(){
		$("#bloquebusquedaetiqueta").fadeIn();				
		$.ajax({
			type: "POST",
			url: '/ayuda_etiquetas/Buscarlista/'+$(this).val()+"/",
			success: function(msg){
				result = msg;
				$("#bloquebusquedaetiqueta").html(result);
			}
		});				
	});
	function AddEtiqueta(id, nombre){
		if (id == "N") {
			$.ajax({
				type: "POST",
				url: '/ayuda_etiquetas/registraretiquetaelemento/'+nombre+'/'+$('#id').val()+"/",
				success: function(msg){
					$("#listadoetiquetas").html(msg);
					$("#bloquebusquedaetiqueta").html("");
					$('#dtetiqueta').val('');
				}
			});
		}else{
			$.ajax({
				type: "POST",
				url: '/ayuda_etiquetas_elementos/registrar/'+$('#id').val()+'/'+id+"/",
				success: function(msg){
					$("#listadoetiquetas").html(msg);
					$("#bloquebusquedaetiqueta").html("");
					$('#dtetiqueta').val('');
				}
			});
		}
	}
	function EliminarAyuda_etiquetas_elementos(id){
		if(confirm('Esta seguro desea eliminar la etiqueta '+$('#p'+id).text())){
			var URL = '<?= HOMEDIR ?>/ayuda_etiquetas_elementos/eliminar/'+id+'/';
			$.ajax({
				type: 'POST',
				url: URL,
				success: function(msg){
						$('#r'+id).hide();
				}
			});
		}
		
	}
</script>