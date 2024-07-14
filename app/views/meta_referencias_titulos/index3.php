	<div class="tmain">Formularios de la Subserie Creados</div>
	<div class="row">
		<div class="col-md-5">
			<div class="input-group">
		      	<div class="input-group-addon"><span class="fa fa-search"></span></div>
	      		<select class="form-control" id="gettypeform" onChange="GetListadoFormularios()">
	      			<option value="1">Formularios</option>
	      		</select>
		    </div>
		</div>
		<div class="col-md-7">
			<div class="align-right margin_bottom">
				<div class="btn-group">
					<a class="btn btn-success" onclick="OpenForm()">
						<span class="fa fa-plus-circle"></span>
						<span>Nuevo Form de Metadatos</span>
					</a>
				</div>    
			</div>
		</div>
	</div>

	<div id="Listado"></div>
<script>
	function GetListadoFormularios(){
		var op = $("#gettypeform").val();
		var URL = "/meta_referencias_titulos/Listadodependencia/<?= $id ?>/"+op+"/";
		$.ajax({
	        url: URL,
	        success: function(msg){
	            result = msg;
	            $('#Listado').html(result);
	        }
    	}); 
	}

	function OpenForm(){
		var op = $("#gettypeform").val();
		GetQuery('/meta_referencias_titulos/nuevo/1/<?= $id ?>/'+op+'/','fmeta', 'inner-metadatosjs')
	}

	GetListadoFormularios();
</script>		
