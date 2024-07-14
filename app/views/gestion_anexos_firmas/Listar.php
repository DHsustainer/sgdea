<?
	$i = 0;
	global $c;

	while($row = $con->FetchAssoc($query)){

		$i++;

		$l = new MGestion_anexos_firmas;
		$l->Creategestion_anexos_firmas('id', $row[id]);


    	$g = new MGestion;
		$g->CreateGestion("id", $row['gestion_id']);

		$mens = $con->Query("select observacion from gestion_anexos_permisos where id_documento = '".$row['anexo_id']."' and usuario_permiso = '".$_SESSION['usuario']."' and estado = '0'");

		$mensaje = $con->FetchAssoc($mens);
		$mensaje = $mensaje['observacion'];

		$ga = new MGestion_anexos;
		$ga->CreateGestion_anexos("id", $row['anexo_id']);

		$ruta = HOMEDIR.DS."app/archivos_uploads/gestion/".$g->GetId().trim("/anexos/ ").$ga->GetUrl()."";
		$extension = substr($ga->GetUrl(), strlen($ga->GetUrl())-4, strlen($ga->GetUrl()));  

		$NOMUSUARIO    = $c->GetDataFromTable("usuarios", "user_id", $row['usuario_solicita'], "p_nombre, p_apellido", $separador = " ");
		$TIPOLOGIA    = $c->GetDataFromTable("dependencias_tipologias", "id", $l -> GetTipologia_id(), "tipologia", $separador = " ");
		$NOMDOCUMENTO  = "<span class='btn btn-primary' onClick='AbrirDocumento(\"".$ruta."\", \"".$viewer[$extension]."\", \"".$ga->GetNombre()."\", \"4\", \"".$ga->GetId()."\")'>".$ga->GetNombre()."</span>";
		$NUMRADICACION = "<a href='/gestion/ver/".$g->GetId()."/'>".$g->GetNum_oficio_respuesta()."</a>";

		$path = '
		<div>
			<div class="row">
				<div class="col-md-4">
					<h5>
					<b>Documento Para Firmar:</b>
					</h5>
					<h5>
					'.$NOMDOCUMENTO.' 
					</h5>
				</div>
			</div>
			';
		if ($firmar == true) {
			# code...
		$path .= '<div class="row m-t-10">
					<div class="col-md-9">
						<h5>Solicitud Realizada <b>'.$f->nicetime($l -> GetFecha_solicitud()).' </b>
						Por <b> '.$NOMUSUARIO.' </b> </h5>
						<h5>
						'.$mensaje.' 
						</h5>
					</div>
					<div class="col-md-3 pull-right">';
	if($_SESSION['firmar_documentos'] == 1){
		if (strtolower($extension) == ".pdf") {
			if($_SESSION['MODULES']['firma_digital'] == "1"){
				$path .= '<button type="button" class="btn btn-success btn-circle m-r-5 " onclick="OpenWindow(\'/firmas_usuarios/firmar/'.$l->GetId().'/\')" '.$c->ayuda('22', 'tog').'>
						<i class="mdi mdi-pencil-lock"></i> 
					</button>';
			}
		}
	}	
		$path .= '<button type="button" class="btn btn-info btn-circle  m-r-5  " onclick="EditarGestion_anexos_firmas(\''.$l->GetId().'\')"  '.$c->ayuda('23', 'tog').'>
						<i class="fa fa-check"></i> 
					</button>
					<button type="button" class="btn btn-warning btn-circle " onclick="EliminarGestion_anexos_firmas(\''.$l->GetId().'\')"  '.$c->ayuda('24', 'tog').'>
						<i class="fa fa-times"></i> 
					</button>
				</div>
			</div>';
		}


		
		$path .= "
	    </div>";


		$c->GetVistaAmple($g->GetId(), $path, 'min');

	}
	if ($i == 0) {
		echo "<div class='alert alert-info' role='alert'>No Tiene Documentos...</div>";
	}

?>
<script type="text/javascript">
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip(); 
        $('[data-toggle="popover"]').popover()
    });
</script>
<script>
	
function EliminarGestion_anexos_firmas(id){
	if(confirm('¿Esta seguro desea cancelar esta firma?')){
		ob = prompt("¿Algúna Observación para esta firma?");
		var URL = '/gestion_anexos_firmas/eliminar/'+id+'/'+$("#pass"+id).val()+'/'+ob+'/';
		$.ajax({
			type: 'POST',
			url: URL,
			success: function(msg){
				if (msg.trim() == "1") {
					alert("Firma de Documento Cancelada");
					window.location.reload()
				}else{
					window.location.reload()
				}
			}
		});
	}
}	

function EditarGestion_anexos_firmas(id){
	if(confirm('¿Esta seguro marcar como verificado este documento?')){
		ob = prompt("¿Algúna Observación para esta firma?");
		var URL = '/gestion_anexos_firmas/actualizar/'+id+'/'+$("#pass"+id).val()+'/'+ob+'/';
		$.ajax({
			type: 'POST',
			url: URL,
			success: function(msg){
				if (msg.trim() == "1") {
					alert("Documento Verificado");
					window.location.reload()
				}else{
					alert(msg.trim());
				}
			}
		});
	}
}	
</script>		