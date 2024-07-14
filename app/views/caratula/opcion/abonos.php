<link href="<?= ASSETS ?>/styles/bootstrap.css" rel="stylesheet">
<style type="text/css">
div#list{
	margin: 10px;
}
#list .item-ga div{
	display: inline-block;
}
#list .item-ga div.mot{
	width: 59%;
}
#list .item-ga div.fec,#list .item-ga div.val{
	width: 19.2%;
}
div.table{
	background-color: #fff;
}
</style>
<div id="form">
	<table class="tbd">
		<tr>
			<td>
				<table  class="left nopadding">
					<tr>
						<td>
							<div class="table_2">
								<div class="title">Crear Abonos</div>
								<?php 

									if ($_SESSION[usuario]==$_SESSION[sadminid] || $_SESSION[sadmin]!=1){ 
										if ($_SESSION['folder'] == '') {
								?>
											<form method="post" action="/caratula/opcion/<?=$_GET[id]?>/guardar_abono/">
												<input name="motivo" type="text" placeholder="Motivo" style="width:calc(100% - 30px);margin:10px;">
												<input name="valor" type="text" placeholder="Valor"  style="margin:0px 10px; width:40%">
												<input name="fecha" id="fecha" type="text" placeholder="Fecha"  style="margin:0px 10px; width:40%">
												<input type="submit" value="Registrar Abono" style="width:calc(100% - 15px);margin:10px;">
											</form>		
								<?
										}
									}

									if ($_SESSION[usuario]==$_SESSION[sadminid] || $_SESSION[sadmin]!=1) {
						                if ($_SESSION['folder'] == '') {
						                	$path = "<td style='width:20px' class='mot'></td>";
						                }
						            }

								?>
								

								
								<div id="list">

									<table style="width:100%" cellpadding="0" cellspacing="0">
										<tr>
											<td class="mot">Motivo</td>
											<td class="mot" width="60px">Valor</td>
											<td class="mot" width="70px">Fecha</td>
											<?= $path; ?>
										</tr>	
									<?php 
										$sum = 0;
										while ($col=$con->FetchAssoc($abonos)) {
								            if ($_SESSION[usuario]==$_SESSION[sadminid] || $_SESSION[sadmin]!=1) {
								                if ($_SESSION['folder'] == '') {
								                    $links  ="	<td>
									                    			<div style='float:left;' onClick='EliminarAbonosTexto(\"".$col['id']."\")'>
									                    				<div class='btn btn-warning btn-circle mdi mdi-delete' title='eliminar'></div>
									                    			</div>
								                    			</td>";
								                }
								            }
											$sum += $col['valor'];
											echo "	<tr id='r$col[id]'>
														<td>$col[motivo]</td>
														<td align='right'>$col[valor]</td>
														<td align='right'>$col[fecha]</td>
														$links
													</tr>";
										} 
									?>
									<tr>
											<td class="mot">Total de abonos en el proceso:</td>
											<td class="mot" align='right' ><?= $sum; ?></td>
											<td class="mot" ></td>
											<?= $path; ?>
										</tr>
								</table>
							</div>
						</td>
						<td  style="width:50%">
							<div class="table">
								<div class="title">Cargar Soportes</div>
								<?php if ($_SESSION[usuario]==$_SESSION[sadminid] || $_SESSION[sadmin]!=1): ?>
									<form id="upload" method="post" action="/caratula/opcion/<?=$_GET[id]?>/subir_abono/" enctype="multipart/form-data">
								        <div id="drop">
								            Soltar Aqui

								            <a>Buscar</a>
								            <input type="file" name="upl" multiple />
								        </div>

								        <ul>
								            <!-- The file uploads will be shown here -->
								        </ul>

								    </form>
								<?php endif ?>

					<div class="title">
						<div style="float:left">Soportes de Abonos</div>
						<div style='float:right; font-weight: normal' class="opc" onclick="DescargarAbonos()">Descargar</div>
						<?
						if ($_SESSION[usuario]==$_SESSION[sadminid] || $_SESSION[sadmin]!=1) {
				            if ($_SESSION['folder'] == '') {
				                echo '<div style="float:right; font-weight: normal" class="opc" onclick="EliminarAbonos()">Eliminar</div>';
				            }
				        }
						?>
						<div class="clear"></div>
					</div>
					<form id="abonosdescargas" name="abonosdescargas">
<?

        $viewer =       array(".doc" => "google"                        , "docx" => "google"                        , ".zip" => "google"                        , ".rar" => "google"                        ,
                              ".tar" => "google"                        , ".xls" => "google"                        , "xlsx" => "google"                        , ".ppt" => "google"                        ,
                              ".pps" => "google"                        , "pptx" => "google"                        , "ppsx" => "google"                        , ".pdf" => "google"                        ,
                              ".txt" => "google"                        , ".jpg" => "image"                         , "jpeg" => "image"                         , ".bmp" => "image"                         ,
                              ".gif" => "image"                         , ".png" => "image"                         , ".dib" => "image"                         , ".tif" => "image"                         ,
                              "tiff" => "image"                         , "mpeg" => "video"                         , ".avi" => "video"                         , ".mp4" => "video"                         ,
                              "midi" => "audio"                         , ".acc" => "audio"                         , ".wma" => "audio"                         , ".ogg" => "audio"                         ,
                              ".mp3" => "audio"                         , ".flv" => "video"                         , ".wmv" => "video");
?>								
							    <?php 

							    while ($col=$con->FetchAssoc($query)) {
							        $type=explode('.', $col[nom_img]);
							        $type=array_pop($type);
							    #	echo "	<div class='anexos-div' id='$col[id]'><div class='img-icon $type'></div><div>$col[nom_palabra]</div></div>";
							    
								    $type=explode('.', $col[nom_img]);
								    $type=array_pop($type);

								    $file = $col["nom_img"];
								    $ruta = HOMEDIR.DS."app/archivos_uploads/".$_SESSION["usuario"].trim("/abonos/ ").$file."";
								    $cadena_nombre = substr($file,0,200);
								    $extension = substr($cadena_nombre, strlen($cadena_nombre)-4, strlen($cadena_nombre));  

								    if ($_SESSION[usuario]==$_SESSION[sadminid] || $_SESSION[sadmin]!=1) {
								        if ($_SESSION['folder'] == '') {
								            $path = "onclick='changetext(this)'";
								        }
								    }

								    echo "  <div class='anexos-div' id='$col[id]'>
								                <input type='checkbox' value='".$file."' name='servicio[]'  class='album_inner_button active_check' />
								                <div style='padding-top:0px; margin-top:-15px;' class='img-icon $type' onclick='AbrirDocumento(\"".$ruta."\",\"".$viewer[$extension]."\",\"".$col["nom_palabra"]."\",\"2\",\"".$col["id"]."\")'></div>
								                <div class='clear'></div>
								                <div class='nom_anexo' title='$col[nom_palabra]'>
								                    <input title='$col[nom_palabra]' type='text' id='$col[id]' readonly class='no_editable nanexo' value='$col[nom_palabra]' $path>
								                </div>
								            </div>";

							    } 

							    ?>
							</form>
							</div>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</div>
<script src="<?=ASSETS?>/js/jquery.knob.js"></script>

<!-- jQuery File Upload Dependencies -->
<script src="<?=ASSETS?>/js/jquery.ui.widget.js"></script>
<script src="<?=ASSETS?>/js/jquery.iframe-transport.js"></script>
<script src="<?=ASSETS?>/js/jquery.fileupload.js"></script>

<!-- Our main JS file -->
<script src="<?=ASSETS?>/js/script.js"></script>

<script>
	
$(document).ready(function(){

	$('#fecha').datepicker({
		dateFormat: 'yy-mm-dd',
		monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio', 'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],		
		dayNames: ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'], // For formatting
		dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'], // For formatting
		dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sa'] // Column headings for days starting at Sunday		
	});
});	

/*
*/
function EliminarAbonosTexto(id){

	if(confirm('Esta seguro desea eliminar este abono')){
		var URL = '/abonos/eliminar/'+id+'/';
		$.ajax({
			type: 'POST',
			url: URL,
			data: "",
			success: function(msg){
				if(msg == 'OK!')
					alert("Abono eliminado");
					window.location.reload();
			}
		});
	}
	
}	

function DescargarAbonos(){
        var str = $("#abonosdescargas").serialize();
        $.ajax({
            url:'/abonos_img/descargar/',
            data:str,
            type:'POST',
            success:function(msg){
            	//alert(msg)
                window.location.href = msg;
            }
        })
    }

    function EliminarAbonos(){
        var str = $("#abonosdescargas").serialize();
        $.ajax({
            url:'/abonos_img/eliminar/',
            data:str,
            type:'POST',
            success:function(msg){
                alert("Archivos eliminados");
                window.location.reload();
            }
        })
    }



</script>