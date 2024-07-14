<form id='formsuscriptores_tipos' action='/suscriptores_tipos/registrar/' method='POST'> 
	<div class='title right'>Crear Tipo de <?= SUSCRIPTORCAMPONOMBRE ?></div>
	<div class="row" style="margin:0">
		<div class="col-md-12">
			<label>Nombre del Tipo de <?= SUSCRIPTORCAMPONOMBRE ?>:</label>
			<input type='text' class='form-control' placeholder='Nombre' name='nombre' id='nombre' maxlength='300' />
		</div>
		<div class="col-md-6 m-t-10">
			<label>Seleccione si el estado es para registros web</label>
			<select class='form-control' placeholder='Es_web' name='es_web' id='es_web' style="height: 35px">
				<option value="0">Seleccione una opción</option>
				<option value="0">NO</option>
				<option value="1">SI</option>
			</select>
			<input type='button' onClick="InsertTipoSuscriptor()"  class="btn btn-info m-t-20" value='Crear Tipo de <?= SUSCRIPTORCAMPONOMBRE ?>' />
		</div>
		<div class="col-md-6 m-t-10">
			<label>Seleccione si el Tipo de <?= SUSCRIPTORCAMPONOMBRE ?> será Remitente o Destinatario</label>
			<select class='form-control' placeholder='correspondencia' name='correspondencia' id='correspondencia' style="height: 35px">
				<option value="0">Seleccione una opción</option>
				<option value="0">No Aplica</option>
				<option value="2">Destinatario</option>
				<option value="1">Remitente</option>
			</select>
		</div>
	</div>
</form>

<script type="text/javascript">
	
function InsertTipoSuscriptor(){

    if (confirm("¿Esta seguro que desea una nueva tipo de <?= SUSCRIPTORCAMPONOMBRE ?>?")) {

        var URL = '/suscriptores_tipos/registrar/';
        var str = $("#formsuscriptores_tipos").serialize();
        $.ajax({
            type: 'POST',
            url: URL,
            data: str,
            success:function(msg){
                alert("Tipo de <?= SUSCRIPTORCAMPONOMBRE ?> Creado");

                $.ajax({
		            type: 'POST',
		            url: "/suscriptores_tipos/listar/",
		            success:function(msg){
		            	$("#listadosuscriptorestipos").html(msg);
		            }
		        });   
            }
        });   
    }
}

</script>