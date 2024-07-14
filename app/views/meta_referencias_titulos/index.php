	<div class="tmain">Formularios de Metadatos Creados</div>
	<div class="row">
		<div class="col-md-5">
			<div class="input-group">
		      	<div class="input-group-addon"><span class="fa fa-search"></span></div>
	      		<select class="form-control" id="gettypeform" onChange="GetListadoFormularios()">
	      			<option value="0">Todos</option>
	      			<option value="1">Formularios</option>
	      			<option value="2">Tipologías</option>
	      			<option value="3">Suscriptores</option>
	      		</select>
		    </div>
		</div>
		<div class="col-md-7">
			<div class="align-right margin_bottom">
				<div class="btn-group">
					<a class="btn btn-success" onclick="GetQuery('/meta_referencias_titulos/nuevo/','fmeta', 'inner-metadatosjs')">
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
		var op = $("#gettypeform");
		var URL = "/meta_referencias_titulos/GetListado/"+op.val()+"/";
		$.ajax({
	        url: URL,
	        success: function(msg){
	            result = msg;
	            $('#Listado').html(result);
	        }
    	}); 
	}

	GetListadoFormularios();
</script>		
