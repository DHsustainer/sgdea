<form id='formayuda_libros' action='/ayuda_libros/registrar/' method='POST' class="form-horizontal"> 

	<div class="form-group">
        <label class="col-md-12">Titulo</label>
        <div class="col-md-12">
        	<input type='text' class='form-control' placeholder='Titulo' name='titulo' id='titulo' maxlength='400' />
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-12">Descripcion</label>
        <div class="col-md-12">
        	<textarea class='form-control' placeholder='Descripcion' name='descripcion' id='descripcion' style="height: 130px" ></textarea>
        </div>
    </div>
    <div class="row">
    	<div class="col-md-6">
		    <div class="form-group">
		        <label class="col-md-12">URL de Video (Si aplica...)</label>
		        <div class="col-md-12">
		        	<input type='text' class='form-control' placeholder='Video' name='video' id='video' maxlength='100' />
		        </div>
		    </div>
    	</div>
    	<div class="col-md-6">
		    <div class="form-group">
		        <label class="col-md-12">Dependencia (Solo para Subtitulos)</label>
		        <div class="col-md-12">
		        	<select name='dependencia' id='dependencia' class="form-control" >
		        		<option value="0">Seleccione una Opción </option>
						<?
							global $con;
							$xs = $con->Query("select * from ayuda_libros where dependencia = '0'");
							while ($row = $con->FetchAssoc($xs)) {
								echo "<option value='".$row['id']."'>".$row['titulo']."</option>";
							}
						?>
					</select>
		        </div>
		    </div>
    	</div>
    </div>
    <div class="row">
    	<div class="col-md-12">
    		<button type="submit" class="btn btn-success waves-effect waves-light m-r-10 pull-right">Insertar</button>
    	</div>
    </div>
</form>