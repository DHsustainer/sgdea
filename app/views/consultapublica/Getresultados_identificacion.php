<?
  	$sadmin = new MSuper_admin;
    $sadmin->CreateSuper_admin("id", "6");
    $uri = "";
    if ($sadmin->GetFoto_perfil() == "") {
      	$uri = HOMEDIR.DS."app/views/assets/images/logo_expedientes2.png";
    }else{
    	$uri = HOMEDIR.DS.'app/plugins/thumbnails/'.$sadmin->GetFoto_perfil();
    }
?>
<div class="container bodycontainer">
	<div class="row">
		<div class="col-md-12">
			<h2>
				
			</h2>
		</div>
	</div>

	<div class="jumbotron">
	  	<h1><span class="fa fa-cogs"></span> Resultados de Consulta</h1>
		<p>Resultados de la consulta realizado por número de identificación en el <?= PROJECTNAME ?></p>
		<p>Identificación Número: <?= $susc->GetIdentificacion()?></p>
		<div class="bloque_radicado_detalle">
			<div align="right" style="padding-right: 120px">

				<button type="button" class="btn btn-primary btn-lg fullwidth" onclick="printDiv('containerpdf')"><span class="fa fa-print"></span> Generar PDF</button>
				
			</div>

			<?php
				if ($id >= 1) {

					$sx = $con->Query("select * from certificados_generados where fecha = '".date("Y-m-d")."' and identificacion = '".$attr."'");
					$isx = $con->NumRows($sx);

					if ($isx >= "1") {
						$num_Dcto = $con->Result($sx, 0, 'id');
					}else{
						$sx = $con->Query("INSERT INTO certificados_generados (fecha, identificacion) VALUES ('".date("Y-m-d")."','".$attr."')");
						$num_Dcto = $c->GetMaxIdTabla("certificados_generados", "id");
					}

?>

						<div id="containerpdf" style="width: 780px; border: 1px solid #CCC; margin: 0 auto; margin-top: 25px; margin-bottom: 25px; padding:10px;">
							<div id="headerpdf" style="margin-left: 30px; width: 250px; height: 90px; float:left; display: inline-block; cursor: pointer; text-align: center;">
								<img src="<?= $uri; ?>" style="width: 200px;">
							</div>
							<div id="headerdatacertificadopdf" style="width: 180px; float: right; font-size: 12px; background-color: #f5f5f5; padding: 6px; border:1px solid #CCC">
								<b>Certificado Ordinario Via Web</b><br><br>
								<table width="70%" border="0" style="margin:0 auto;">
									<tr>
										<td width="50%" align="left"><b>N°</b></td>
										<td width="50%" align="right"><?= $f->zerofill($num_Dcto, 5) ?></td>
									</tr>
								</table>
							</div>

							<div class='clear' style="clear:both"><br></div>
								<h4 align="center"><?= $sadmin->Getp_nombre(); ?></h4>

								<div class="datacertificado" style="text-align: justify; width: 98%; margin: 0 auto;">
									Que una vez consultado el sistema de Procesos en Vigilancia de <?= $sadmin->Getp_nombre(); ?>, la cédula de ciudadanía No: <b><?= $id  ?> </b> perteneciente a <b><?= $susc->GetNombre() ?></b> registra los siguientes procesos disciplinarios:
								</div>

<?
					$q1 = $con->Query("Select id from gestion where suscriptor_id = '".$susc->GetId()."' ");
					$i1 = $con->NumRows($q1);

					if ($i1 >= "1") {
						echo "<div class='search_result' style='background-color: #FFF; margin: 0 auto;	 margin-top: 30px; margin-bottom: 30px; width: 90%;'>
								<div class='header_result' style='background-color: #FFF;'>";


								$ar = array("0" => "Baja", "1" => "Media", "2" => "Alta");
								$ar2 = array("1" => "Archivo de Gestión", "2" => "Archivo Central", "3" => "Archivo Histórico");

								while ($row = $con->FetchAssoc($q1)) {
									echo $c->GetVistaPublicaExpedienteResumida($row["id"]);
									echo "<hr>";
								}

						echo "<div class='clear'></div>
							</div>
							<div class='clear'></div>
						</div>";
					}else{
						echo "<h4>NO REGISTRA SANCIONES NI INHABILIDADES VIGENTES</h4>";
					}
?>
						<div class="firma" style="height: 60px;"></div>
						<div class="footerpdf">
							<ul>
								<li style="display: inline; border-right: 1px solid #CCC; list-style: circle; margin-left: 10px; padding-right: 10px; font-size: 13px;"><?= $sadmin->GetDireccion() ?></li>
								<li style="display: inline; border-right: 1px solid #CCC; list-style: circle; margin-left: 10px; padding-right: 10px; font-size: 13px;">Telefono: (57)(4) <?= $sadmin->GetTelefono() ?> Fax: (57)(4) <?= $sadmin->GetCelular() ?></li>
								<li style="display: inline; border-right: 1px solid #CCC; list-style: circle; margin-left: 10px; padding-right: 10px; font-size: 13px;">E-mail: <?= $sadmin->GetEmail() ?></li>
							</ul>
						</div>
					</div>


<?						
				}else{
					echo "<br><br><br><div class='alert alert-warning' role='alert'>El numero consultado no se encuentra registrado</diV><br><br>";
				}
			?>
		</div>
		<br>
		<form action="<?= HOMEDIR.DS ?>consultapublica/radicado/">
			<button type="submit" class="btn btn-primary btn-lg fullwidth">Volver a Consultar a Consulta</button>
		</form>
	</div>
</div>


<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
});

function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}

</script>

