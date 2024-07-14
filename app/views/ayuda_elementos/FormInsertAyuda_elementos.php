<form id='formayuda_elementos' action='/ayuda_elementos/registrar/' method='POST' class="form-horizontal"> 
	<input type='hidden' class='form-control' placeholder='Libro_id' name='libro_id' id='libro_id' value="<?= $id ?>" />

	
	<div class="form-group">
        <label class="col-md-12">Titulo (Como identificamos el Elemento)</label>
        <div class="col-md-12">
        	<input type='text' class='form-control' placeholder='Titulo' name='titulo' id='titulo' />
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-12">Descripcion (Esto es lo que verá el Usuario)</label>
        <div class="col-md-12">
        	<input type='text' class='form-control' class='form-control'  placeholder='Descripcion' name='texto' id='texto' value="Informacion de prueba" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-12">Ubicación de la Alerta en la Ventana</label>
        <div class="col-md-12">
			<select placeholder='Posicion' name='posicion' id='posicion' class="form-control">
				<option value="right">Seleccione una Opción</option>
				<option value="top">Top (Arriba del Elemento)</option>
				<option value="right">Right (A la Derecha del Elemento)</option>
				<option value="bottom">Bottom (Abajo del Elemento)</option>
				<option value="left">Left (A la Izquierda del Elemento)</option>
			</select>
		</div>
	</div>

	<div class="row ">
    	<div class="col-md-12">
    		<button type="button" onclick="InsertAyudaElementos()" class="btn btn-success waves-effect waves-light m-r-10 pull-right">Insertar</button>
    	</div>
    </div>
</form>