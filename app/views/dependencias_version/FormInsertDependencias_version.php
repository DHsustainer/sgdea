
<form id='formdependencias_version' action='/dependencias_version/registrar/' method='POST'> 
	
	<input type='text' class='form-control' placeholder='Escriba el nombre de la nueva versión' name='nombre' id='nombre' maxlength='255' />
	<input style="display: none;" type='text' class='form-control' placeholder='Estado' name='estado' id='estado' maxlength='11' />
	<input style="display: none;" type='text' class='form-control' placeholder='Fecha_inicio' name='fecha_inicio' id='fecha_inicio' maxlength='' />
	<input style="display: none;" type='text' class='form-control' placeholder='Fecha_fin' name='fecha_fin' id='fecha_fin' maxlength='' />
	<input type='button' value='Crear Versión Nueva' onclick="InsrtarDependencias_version();" class="btn btn-info m-t-30 m-b-30"/>
</form>

<script type="text/javascript">
function InsrtarDependencias_version(){
	var URL = '<?= HOMEDIR ?>/dependencias_version/registrar/';
	var str = $('#formdependencias_version').serialize();
	$.ajax({
		type: 'POST',
		url: URL,
		data: str,
		success: function(msg){
			var arr = msg.split('|');
			Alert2(arr[0]);
			$('#Tabladependencias_version').append("<tr class='tblresult'><td>"+arr[1]+"</td></tr>");
		}
	});
}	
</script>