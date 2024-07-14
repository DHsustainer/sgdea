<div class="row m-t-30">
	<div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
		<div class="white-box">
	        <h3 class="box-title"><span class="fa fa-leaf"></span> Consumo Responsable</h3>
			<table width="100%" cellspacing="4" cellpadding="4" class="table">
				<tr>
					<td><b> 1 Tonelada de Papel</b></td>
					<td><b> =</b></td>
					<td align="right"><span class="text-danger"><b>150.000</b></span> Lt Agua + <span class="text-danger"><b>22.344.000</b></span> Kw Electricidad</td>
				</tr>
				<tr>
					<td><b>1 Tonelada Papel</b></td>
					<td><b> =</b></td>
					<td align="right"><span class="text-danger"><b>400</b></span> Resmas de Papel</td>
				</tr>
				<tr>
					<td><b>1 Resma de Papel</b></td>
					<td><b> =</b></td>
					<td align="right"><span class="text-danger"><b>375</b></span> Lt Agua +  <span class="text-danger"><b>55.860</b></span> Kw Electricidad</td>
				</tr>
				<tr>
					<td><b>1 Resma de Papel</b></td>
					<td><b> =</b></td>
					<td align="right"><span class="text-danger"><b>500</b></span> Hojas</td>
				</tr>
				<tr>
					<td><b>1 Hoja de Papel</b></td>
					<td><b> =</b></td>
					<td align="right"><span class="text-danger"><b>0,75</b></span> Lt Agua +  <span class="text-danger"><b>111,72</b></span> Kw Electricidad</td>
				</tr>
			</table>
			<hr class="m-t-30 m-b-30">
	        <table width="100%" class="table table-striped">
	        	<thead>					
					<tr>
						<th  align="center" width="250px"><b>Titulo</b></th>
						<th  align="center" width="80px"><b>Cantidad</b></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td width="250px"><b>Menos Papel: </b></td>
						<td align="right"><span class="text-success"><b><?= $c->GetCalculoPapel("a") ?></b></span></td>
					</tr>
					<tr>
						<td><b>Menos Resmas: </b></td>
						<td align="right"><span class="text-success"><b><?= $c->GetCalculoPapel("b") ?></b></span></td>
					</tr>
					<tr>
						<td><b>Más Arboles: </b></td>
						<td align="right"><span class="text-success"><b><?= $c->GetCalculoPapel("c") ?></b></span></td>
					</tr>
					<tr>
						<td  width="300px"><b>Ahorro en Lts de Agua: </b></td>
						<?

							$ahorroagua = number_format($c->GetCalculoPapel("b") * 375);
						?>
						<td align="right"><span class="text-success"><b><?= $ahorroagua ?></b></span></td>
					</tr>
					<tr>
						<td><b>Ahorro en Kws de Electricidad: </b></td>
						<?

							$ahorroluz = number_format($c->GetCalculoPapel("b") * 55.860);
						?>
						<td align="right"><span class="text-success"><b><?= $ahorroluz ?></b></span></td>
					</tr>
	        	</tbody>
			</table>
	    </div>
	</div>	
	<div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
	    <div class="white-box">
	        <h3 class="box-title"><span class="fa fa-paper-plane-o "></span> Documentos Gestionados</h3>
			<table width="100%" class="table table-striped">
				<thead>					
					<tr>
						<th  align="center" width="250px"><b>Titulo</b></th>
						<th  align="center" width="80px"><b>Cantidad</b></th>
						<th  align="center" width="80px"><b>Folios</b></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td><b>Documentos de Entrada</b></td>
						<td align="right"><span class="text-success"><b><?= $con->Result($con->Query('select count(*) as t from gestion_anexos WHERE in_out = "0" '), 0, 't') ?></b></span></td>
						<td align="right"><span class="text-success"><b><?= $con->Result($con->Query('select sum(cantidad) as t from gestion_anexos WHERE in_out = "0"  '), 0, 't') ?></b></span></td>
					</tr>
					<tr>
						<td><b>Documentos de Salida</b></td>
						<td align="right"><span class="text-success"><b><?= $con->Result($con->Query('select count(*) as t from gestion_anexos WHERE  in_out = "1" '), 0, 't') ?></b></span></td>
						<td align="right"><span class="text-success"><b><?= $con->Result($con->Query('select sum(cantidad) as t from gestion_anexos WHERE  in_out = "1" '), 0, 't') ?></b></span></td>
					</tr>
					<tr>
						<td><b>Documentos Totales</b></td>
						<td align="right"><span class="text-success"><b><?= $con->Result($con->Query('select count(*) as t from gestion_anexos'), 0, 't') ?></b></span></td>
						<td align="right"><span class="text-success"><b><?= $con->Result($con->Query('select sum(cantidad) as t from gestion_anexos'), 0, 't') ?></b></span></td>
					</tr>
				</tbody>
			</table>
	    </div>

	    <div class="white-box">
	        <h3 class="box-title"><span class="fa fa-at"></span> Correspondencia Electrónica Enviada</h3>
	        <table width="100%" class="table table-striped">
	        	<thead>					
					<tr>
						<th  align="center" width="250px"><b>Titulo</b></th>
						<th  align="center" width="80px"><b>Cantidad</b></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td  width="250px"><b>Correos Electrónicos Enviados: </b></td>
						<td align="right"><span class="text-success"><b><?= $con->Result($con->Query('select count(*) as t from notificaciones'), 0, 't') ?></b></span></td>
					</tr>
					<tr>
						<td><b>Documentos Enviados Electrónicamente: </b></td>
						<td align="right"><span class="text-success"><b><?= $con->Result($con->Query('select count(*) as t from contador_inmaterializacion where type = "NT" '), 0, 't') ?></b></span></td>
					</tr>
					<tr>
						<td><b>Folios Enviados Electrónicamente: </b></td>
						<td align="right"><span class="text-success"><b><?= $con->Result($con->Query('select sum(cantidad) as t from contador_inmaterializacion where type = "NT" '), 0, 't') ?></b></span></td>
					</tr>
				</tbody>
			</table>
	    </div>
	</div>
</div>



<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
});
</script>

<style>	
.box-content-gap{
	border:1px solid #ccc;
	margin-bottom:15px;
	margin-top:15px;
}
</style>