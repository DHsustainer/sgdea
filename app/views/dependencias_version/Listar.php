
<h2>Listado de Versiones de la Tabla de Retención Documental <?= $c->Ayuda("216") ?></h2>
<div class="list-group" id="navlist3">	
<?
		while($row = $con->FetchAssoc($query)){
			$l = new MDependencias_version;
			$l->Createdependencias_version('id', $row[id]);

			echo '	<div class="list-group-item" id="mark'.$l->GetId().'" style="cursor:pointer" onClick="AbrirVersion(\''.$l->GetId().'\')">
						<div class="waves-effect">'.$l -> GetNombre(); 

			if($_SESSION['id_trd_empresa'] == $l -> GetEstado()){
				echo 	'	<span class="fa fa-star" style="color:#FFE700"></span>';
			} 
				echo '</div>';

			echo '	</div>';
		}
?>
	</div>

<script>
	
function AbrirVersion(id){
    $('#navlist3 > div').removeClass('active');
    $("#mark"+id).addClass('active');
	var URL = '/dependencias_version/verversion/'+id+'/';

    $.ajax({
        type: 'POST',
        url: URL,
        success: function(msg){
            $(".AbrirVersion").html(msg);
        }
    }); 
}
</script>