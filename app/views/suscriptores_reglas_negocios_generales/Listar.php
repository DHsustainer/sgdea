<h3>Reglas Registradas</h3>
	<div class='list-group'>
<?
	$i = 0;
	$ingresos = 0;
	$egresos = 0;
	$impuestos = 0;
	$otros = "";
	$otros_gastos = "";
	$ppago = 0;

	$ng = new MSuscriptores_paquetes_negocios;
	$ng->CreateSuscriptores_paquetes_negocios("id", $negocio);

	while($row = $con->FetchAssoc($query)){
		$i++;
		$l = new MSuscriptores_reglas_negocios_generales;
		$l->Createsuscriptores_reglas_negocios_generales('id', $row[id]);

		if (trim($l->GetTipo_regla()) == "INGRESO") {
			if ($l->GetForma_pago() == "PAGO EN EFECTIVO O CONSIGNACION BANCARIA" && $l->GetTipo_cobro() != "ANUAL") {
				# code...
				$suma = $l->GetValor() * $l->GetCantidad();
				$ingresos += $suma;
			}else{
				if ($l->GetForma_pago() == "PAGO EN EFECTIVO O CONSIGNACION BANCARIA") {
					$otros .= "$ ".number_format($l->GetValor(), "0", ",", '.')." ".$l->GetForma_pago()." - ".$l->GetTipo_cobro()." - ".$l->GetObservacion()."<br>";
				}else{
					$otros .= $l->GetValor()."% ".$l->GetForma_pago()." - ".$l->GetTipo_cobro()." - ".$l->GetObservacion()."<br>";

				}
			}
		}elseif(trim($l->GetTipo_regla()) == "PAGO A PROVEEDOR/COMISION"){
			if ($l->GetForma_pago() != "PAGO EN EFECTIVO O CONSIGNACION BANCARIA") {
				$otros_gastos .= $l->GetValor()."% ".$l->GetForma_pago()." - ".$l->GetTipo_cobro()." - ".$l->GetObservacion()."<br>";
				$ppago += $l->GetValor();
			}else{
				$egresos += $l->GetValor();
			}
		}else{
			if ($l->GetForma_pago() == "PORCENTAJE DEL TOTAL") {
				$imp = $ng->GetValor_base() * ($l->GetValor()/100);
				$impuestos += $imp;
			}else{
				if ($l->GetTipo_regla() == "INGRESO") {
					if ($l->GetForma_pago() == "PAGO EN EFECTIVO O CONSIGNACION BANCARIA") {
					$otros .= "$ ".number_format($l->GetValor(), "0", ",", '.')." ".$l->GetForma_pago()." - ".$l->GetTipo_cobro()." - ".$l->GetObservacion()."<br>";
					}else{
						$otros .= $l->GetValor()."% ".$l->GetForma_pago()." - ".$l->GetTipo_cobro()." - ".$l->GetObservacion()."<br>";

					}
				}else{
					$impuestos += $l->GetValor();
				}
				
			}
		}


		$valor = "$ ".number_format($l -> GetValor(), "0", ",", '.');;
		if (trim($l->GetForma_pago()) != "PAGO EN EFECTIVO O CONSIGNACION BANCARIA") {
			$valor = $l -> GetValor()."% ";
		}
		$cantidad = "";
		if ($l->GetCantidad() != 1) {
			$cantidad = " X ".$l->GetCantidad();
		}

?>						
		<div id='r<?= $l->GetId() ?>' class='list-group-item'> 
			<table border="0" cellpadding="0" cellspacing="0" style="margin: 0px; border:1px solid #F5F5F5" width="100%">
				<tr>
					<td width="130px" class="grayable">Tipo de Pago:</td>
					<td><?php echo $l -> GetForma_pago() ?></td>
				</tr>
				<tr>
					<td class="grayable">Periodo del Pago:</td>
					<td><?= $l -> GetTipo_cobro().$cantidad; ?></td>
				</tr>
				<tr>
					<td class="grayable">Valor del Pago:</td>
					<td><small><?php echo $valor." - ".$l->GetTipo_regla()." - ".$l->GetObservacion(); ?></small></td>
				</tr>
			</table>
			
			<!--
			<td>
                <div onclick='EditarSuscriptores_reglas_negocios_generales(<?= $l->GetId() ?>)'>
					<div class='btn btn-info btn-circle' title='editar'></div>
				</div>

				<div onclick='EliminarSuscriptores_reglas_negocios_generales(<?= $l->GetId() ?>)'>
                    <div class='btn btn-warning btn-circle mdi mdi-delete' title='eliminar'></div>
                </div>
	        </td>	       
	    	-->
		</div>
<?
	}
	if ($i == 0) {
		echo "<div class='alert alert-info' role='alert'>No Hay Reglas Creadas</div>";
	}else{

		$totalr = $ingresos - ($egresos + $impuestos);
		$putil = $totalr * ($ppago/100);
		$totalrp = $totalr - $putil;
		echo "	<div class='list-group-item'>
					<table>
						<tr>
							<td>Ingresos</td>
							<td>$ ".number_format($ingresos, "0", ",", '.')."</td>
						</tr>
						<tr style='color:#c00;'>
							<td>Impuestos</td>
							<td>$ ".number_format($impuestos, "0", ",", '.')."</td>
						</tr>
						<tr style='color:#c00'>
							<td>Gastos</td>
							<td>$ ".number_format($egresos, "0", ",", '.')."</td>
						</tr>
						<tr>
							<td>Otros Gastos</td>
							<td>".$otros_gastos."</td>
						</tr>
						<tr>
							<td><h4>Utilidad</h4></td>
							<td><h4>$ ".number_format($totalr, "0", ",", '.')."</h4></td>
						</tr>
						<tr style='color:#c00'>
							<td>Pagos de Utilidad</td>
							<td>$ ".number_format($putil, "0", ",", '.')."</td>
						</tr>
						<tr>
							<td><h4>Ingreso Total</h4></td>
							<td><h4>$ ".number_format($totalrp, "0", ",", '.')."</h4></td>
						</tr>
						<tr>
							<td>Otros Ingresos</td>
							<td>".$otros."</td>
						</tr>
					</table>
				</div>";
	}
?>			
	</div>
<script>
	$('th').parent().addClass('encabezado');
	$('tr.tblresult:not([th]):even').addClass('par');
	$('tr.tblresult:not([th]):odd').addClass('impar');
 	$('tr.tblresult:not([th])').removeClass('tblresult');		

 
 	$(function() {		
		$('#Tablasuscriptores_reglas_negocios_generales').tablesorter({sortList:[[0,0]]});
	});	
	

function EliminarSuscriptores_reglas_negocios_generales(id){
	if(confirm('Esta seguro desea eliminar este suscriptores_reglas_negocios_generales')){
		var URL = '<?= HOMEDIR ?>suscriptores_reglas_negocios_generales/eliminar/'+id+'/';
		$.ajax({
			type: 'POST',
			url: URL,
			success: function(msg){
				alert(msg);
				if(msg == 'OK!')
					$('#r'+id).slideUp();
			}
		});
	}
	
}	

function EditarSuscriptores_reglas_negocios_generales(id){
	var URL = '<?= HOMEDIR ?>suscriptores_reglas_negocios_generales/editar/'+id+'/';
	$.ajax({
		type: 'POST',
		url: URL,
		success: function(msg){
			$('#divtoshow').html(msg);
		}
	});
}	
</script>		
<style>
	.grayable{
		background-color: #F5F5F5;
	}
</style>
