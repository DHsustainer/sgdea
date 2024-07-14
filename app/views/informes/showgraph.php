<?
	$nombre = "Informe_".date("Y-m-d");
	$nombre2 = "Informe_".date("Y-m-d")."_detalle";
?>
<div class="row" style="margin-top:40px">
	<div class="col-md-12">
		<button class="btn btn-primary">
            <a href="<?= HOMEDIR.DS.'app/plugins/files/'.$nombre.".csv" ?>" style="color:#FFF">Descargar Informe en Excel</a>
        </button>
        <br>
	</div>
	<div class="col-md-5 scrollable"  style="max-height: 400px; overflow: hidden; overflow-y: auto; overflow-x: auto">
<?
	$idform 				= trim($c->sql_quote($_REQUEST['idform']));
	$f_inicio 				= trim($c->sql_quote($_REQUEST['f_inicio']));
	$f_corte 				= trim($c->sql_quote($_REQUEST['f_corte']));
	$typechart 				= trim($c->sql_quote($_REQUEST['typechart']));
	$main_ref 				= trim($c->sql_quote($_REQUEST['main_ref']));
	$main_ref_values 		= "'".implode("','", $_REQUEST['main_ref_values'])."'";
	$main_ref_values_ar 	= $_REQUEST['main_ref_values'];
	$seccond_ref 			= trim($c->sql_quote($_REQUEST['seccond_ref']));
	$seccond_ref_values 	= "'".implode("','", $_REQUEST['seccond_ref_values'])."'";
	$seccond_ref_values_ar 	= $_REQUEST['seccond_ref_values'];
	$third_ref 				= trim($c->sql_quote($_REQUEST['third_ref']));
	$third_ref_values 		= "'".implode("','", $_REQUEST['third_ref_values'])."'";
	$third_ref_values_ar 	= $_REQUEST['third_ref_values'];
	$base 					= base64_decode($_REQUEST['base']);
	$consultaglobal 		= $_REQUEST['cglobal'];

	$campoa = new MMeta_referencias_campos;
	$campoa->CreateMeta_referencias_campos("id", $main_ref);

	$campob = new MMeta_referencias_campos;
	$campob->CreateMeta_referencias_campos("id", $seccond_ref);

	$campoc = new MMeta_referencias_campos;
	$campoc->CreateMeta_referencias_campos("id", $third_ref);

	if ($campoa->GetId() == $campob->GetId() || $campoa->GetId() == $campoc->GetId()) {
		echo "<div class='alert alert-danger'>Referencia Duplicada</div>";
		exit;
	}

	if ($third_ref != '*') {
		if ($campoc->GetTipo_elemento() != '8' ) {
			echo "<div class='alert alert-danger'>Debe seleccionar un campo para Cuantificar Valores</div>";
			exit;
		}
	}

	if (count($main_ref_values_ar) > 1 && count($seccond_ref_values_ar) > 1 && $typechart == "pie") {
		echo "<div class='alert alert-danger'>Para los Graficos de Torta no se recomienda usar multiples valores en las referencias primaria y secundaria</div>";
	}	

	
	$labels = "";
	echo '<h4>Detalle del Informe</h4>
			<table id="datatable" class="table table-striped">
			    <thead>
			        <tr class="encabezado">
			            <th>Leyenda</th>';
	if (count($seccond_ref_values_ar) > 1) {
        $valor = Inverse(" - ");
    	$archivo_csv .= $valor.";";    	# code...
		for ($k=0; $k < count($seccond_ref_values_ar) ; $k++) { 

					echo '	<th width="100px" align="center">'.$seccond_ref_values_ar[$k].'</th>';
					$valor = Inverse($seccond_ref_values_ar[$k]);
                	$archivo_csv .= $valor.";";
		}
    }else{
    	echo '	<th width="100px" align="center">Valor</th>';
    	$valor = Inverse('valor');
        $archivo_csv .= "Leyenda;".$valor.";";
    }
    $archivo_csv .= "\n";
	echo '
			        </tr>
			    </thead>
			    <tbody>';

	$tpath = "";
	if ($third_ref != '*') {
		$tpath = "campo_id = '".$third_ref."' and ";
	}
	if (count($seccond_ref_values_ar) > 1) {
		for ($k=0; $k < count($main_ref_values_ar) ; $k++) { 
			echo '	<tr>';
			echo '		<td>'.$main_ref_values_ar[$k].'</td>';
				$valor = Inverse($main_ref_values_ar[$k]);
                $archivo_csv .= $valor.";";
			for ($z=0; $z < count($seccond_ref_values_ar) ; $z++) { 
				if ($third_ref != '*') {
					if ($consultaglobal == "1") {
						$str = "select sum(valor) as t from meta_big_data where $tpath grupo_id in (SELECT grupo_id from meta_big_data where campo_id = '".$seccond_ref."' and valor = '".$seccond_ref_values_ar[$z]."' and grupo_id in (select grupo_id from meta_big_data inner join gestion on gestion.id = meta_big_data.type_id where campo_id = '".$main_ref."' and valor = '".$main_ref_values_ar[$k]."' and ref_id = '".$idform."' and gestion.f_recibido between '".$f_inicio."' AND '".$f_corte."'))";
					}else{
						$str = "select sum(valor) as t from meta_big_data where $tpath grupo_id in (SELECT grupo_id from meta_big_data where campo_id = '".$seccond_ref."' and valor = '".$seccond_ref_values_ar[$z]."' and grupo_id in (select grupo_id from meta_big_data inner join gestion on gestion.id = meta_big_data.type_id where campo_id = '".$main_ref."' and valor = '".$main_ref_values_ar[$k]."' and ref_id = '".$idform."' $base))";
					}
				}else{
					if ($consultaglobal == "1") {
						$str = "SELECT grupo_id from meta_big_data where campo_id = '".$seccond_ref."' and valor = '".$seccond_ref_values_ar[$z]."' and grupo_id in (select grupo_id from meta_big_data inner join gestion on gestion.id = meta_big_data.type_id where campo_id = '".$main_ref."' and valor = '".$main_ref_values_ar[$k]."' and ref_id = '".$idform."' and gestion.f_recibido between '".$f_inicio."' AND '".$f_corte."')";
					}else{
						$str = "SELECT grupo_id from meta_big_data where campo_id = '".$seccond_ref."' and valor = '".$seccond_ref_values_ar[$z]."' and grupo_id in (select grupo_id from meta_big_data inner join gestion on gestion.id = meta_big_data.type_id where campo_id = '".$main_ref."' and valor = '".$main_ref_values_ar[$k]."' and ref_id = '".$idform."' $base )";
					}
				}

				$qx = $con->Query($str);
				$res = $con->NumRows($qx);
				if ($res == "") {
					$res = 0;
				}
				echo '		<td width="100px" class="numero">'.$res.'</td>';
				$valor = Inverse($res);
                $archivo_csv .= $valor.";";
			}
			echo '	</tr>';
			$archivo_csv .= "\n";
		}
    }else{

    	if ($third_ref != '*') {

	    	for ($k=0; $k < count($main_ref_values_ar) ; $k++) { 
				echo '	<tr>';
				echo '		<td>'.$main_ref_values_ar[$k].'</td>';

				if ($consultaglobal == "1") {
					$str = "select sum(valor) as t from meta_big_data where $tpath grupo_id in (select grupo_id from meta_big_data inner join gestion on gestion.id = meta_big_data.type_id where campo_id = '".$main_ref."' and valor = '".$main_ref_values_ar[$k]."' and ref_id = '".$idform."' and gestion.f_recibido between '".$f_inicio."' AND '".$f_corte."')";
				}else{
					$str = "select sum(valor) as t from meta_big_data where $tpath grupo_id in (select grupo_id from meta_big_data inner join gestion on gestion.id = meta_big_data.type_id where campo_id = '".$main_ref."' and valor = '".$main_ref_values_ar[$k]."' and ref_id = '".$idform."' $base )";
				}
				
				$qx = $con->Query($str);
				$res = $con->Result($qx, 0, 't');
				if ($res == "") {
						$res = 0;
					}
				echo '		<td width="100px" class="numero">'.$res.'</td>';
				echo '	</tr>';
				$valor = Inverse($res);
	            $archivo_csv .= $valor.";";
			}
    	}else{
    		for ($k=0; $k < count($main_ref_values_ar) ; $k++) { 
				echo '	<tr>';
				echo '		<td>'.$main_ref_values_ar[$k].'</td>';

					if ($consultaglobal == "1") {

						$str = "select count(*) as t from meta_big_data where grupo_id in (select grupo_id from meta_big_data inner join gestion on gestion.id = meta_big_data.type_id where campo_id = '".$main_ref."' and valor = '".$main_ref_values_ar[$k]."' and ref_id = '".$idform."' and gestion.f_recibido between '".$f_inicio."' AND '".$f_corte."' group by grupo_id) group by grupo_id";

					}else{
						$str = "select count(*) as t from meta_big_data where grupo_id in (select grupo_id from meta_big_data inner join gestion on gestion.id = meta_big_data.type_id where campo_id = '".$main_ref."' and valor = '".$main_ref_values_ar[$k]."' and ref_id = '".$idform."' $base group by grupo_id) group by grupo_id";
					}
				$qx = $con->Query($str);
				$res = $con->NumRows($qx);
				if ($res == "") {
						$res = 0;
					}
				echo '		<td width="100px" class="numero">'.$res.'</td>';
				echo '	</tr>';
				$valor = Inverse($res);
	            $archivo_csv .= $valor.";";
			}
    	}
		$archivo_csv .= "\n";
    }
	echo '		</tbody>';
	$strx = '</tfoot><tr class="total"><td>TOTALES</td>';
		if (count($seccond_ref_values_ar) > 1) {	
			for ($z=0; $z < count($seccond_ref_values_ar) ; $z++) { 
				$strx .= '<td width="100px">0</td>';
			}
	    }else{
			$strx .= '<td width="100px">0</td>';
	    }
	$strx .= '</tr></tfoot>';
	echo '	</table><div class="row"><div class="col-md-6">Total Sumado</div><div "col-md-6" id="totalsumado"></div></div>';

	$f->fichero_csv($archivo_csv,$nombre);

	function Inverse($temp){

        $b=array("&OACUTE;","&EACUTE;","&AACUTE;","&NTILDE;","&IACUTE;","&UACUTE;","&oacute;","&eacute;","&aacute;","&ntilde;","&iacute;","&uacute;", "&Oacute;","&Eacute;","&Aacute;","&Ntilde;","&Iacute;","&Uacute;");
        $c=array("O"       ,"E"       ,"A"       ,"N"       ,"I"       ,"U"       ,"o"       ,"e"       ,"a"       ,"n"       ,"i"       ,"u", "O"       ,"E"       ,"A"       ,"N"       ,"I"       ,"U");
        $temp=str_replace($b,$c,$temp);
        return $temp;

    }

?>			

	</div>
	<div class="col-md-7" id="ct-chart<?= $rx ?>"  style="height: 400px"></div>
</div>
<div class="row" style="margin-top:40px">
	<div class="col-md-12">
		<button class="btn btn-primary">
            <a href="<?= HOMEDIR.DS.'app/plugins/files/'.$nombre2.".csv" ?>" style="color:#FFF">Descargar Informe en Excel</a>
        </button>
        <br>
	</div>
</div>
<div class="row" style="margin-top:40px">
	<div class="col-md-12">
		<table border='0' cellspacing='0' cellpadding='3' class='table table-striped' id='Tablagestion' style="width:auto">
        	<thead>
            	<tr>
                	<th class='th_act' style=' font-size: 12px; border-bottom:1px solid #008FC9;'>RADICADO</th>
<?
	    			$q = $con->Query("select * from meta_referencias_campos where id_referencia = '".$idform."' order by orden");
                    while ($row = $con->FetchAssoc($q)) {
                        echo "<th class='th_act' style=' font-size: 12px; border-bottom:1px solid #008FC9;'>".$row['titulo_campo']."</th>";
                        $archivo_csv2 .= $f->Reemplazo2($row['titulo_campo']).";";
                    }
                    $archivo_csv2 .= "\n";
?>
                </tr>
            </thead>
         	<tbody>
<?
		if (count($seccond_ref_values_ar) > 1) {
			for ($k=0; $k < count($main_ref_values_ar) ; $k++) { 


				$valoresk = "'".implode("','",$seccond_ref_values_ar)."'";
				if ($third_ref != '*') {
					if ($consultaglobal == "1") {
						$str = "select sum(valor) as t from meta_big_data where $tpath grupo_id in (SELECT grupo_id from meta_big_data where campo_id = '".$seccond_ref."' and valor = '".$seccond_ref_values_ar[$z]."' and grupo_id in (select grupo_id from meta_big_data inner join gestion on gestion.id = meta_big_data.type_id where campo_id = '".$main_ref."' and valor in (".$valoresk.") and ref_id = '".$idform."' and gestion.f_recibido between '".$f_inicio."' AND '".$f_corte."'))";
					}else{
						$str = "select sum(valor) as t from meta_big_data where $tpath grupo_id in (SELECT grupo_id from meta_big_data where campo_id = '".$seccond_ref."' and valor in (".$valoresk.") and grupo_id in (select grupo_id from meta_big_data inner join gestion on gestion.id = meta_big_data.type_id where campo_id = '".$main_ref."' and valor = '".$main_ref_values_ar[$k]."' and ref_id = '".$idform."' $base))";
					}
				}else{
					if ($consultaglobal == "1") {
						$str = "SELECT grupo_id from meta_big_data where campo_id = '".$seccond_ref."' and valor = '".$seccond_ref_values_ar[$z]."' and grupo_id in (select grupo_id from meta_big_data inner join gestion on gestion.id = meta_big_data.type_id where campo_id = '".$main_ref."' and valor in (".$valoresk.") and ref_id = '".$idform."' and gestion.f_recibido between '".$f_inicio."' AND '".$f_corte."')";
					}else{
						$str = "SELECT grupo_id from meta_big_data where campo_id = '".$seccond_ref."' and valor = '".$seccond_ref_values_ar[$z]."' and grupo_id in (select grupo_id from meta_big_data inner join gestion on gestion.id = meta_big_data.type_id where campo_id = '".$main_ref."' and valor in (".$valoresk.") and ref_id = '".$idform."' $base )";
					}
				}
			}
	    }else{

	    	$valores = "'".implode("','",$main_ref_values_ar)."'";
	    	if ($third_ref != '*') {

				if ($consultaglobal == "1") {
					$str = "select grupo_id, type_id from meta_big_data where $tpath grupo_id in (select grupo_id from meta_big_data inner join gestion on gestion.id = meta_big_data.type_id where campo_id = '".$main_ref."' and valor in (".$valores.") and ref_id = '".$idform."' and gestion.f_recibido between '".$f_inicio."' AND '".$f_corte."')";
				}else{
					$str = "select grupo_id, type_id from meta_big_data where $tpath grupo_id in (select grupo_id from meta_big_data inner join gestion on gestion.id = meta_big_data.type_id where campo_id = '".$main_ref."' and valor in (".$valores.") and ref_id = '".$idform."' $base )";
				}
	    	}else{

				if ($consultaglobal == "1") {
					$str = "select grupo_id, type_id from meta_big_data where grupo_id in (select grupo_id from meta_big_data inner join gestion on gestion.id = meta_big_data.type_id where campo_id = '".$main_ref."' and valor in (".$valores.") and ref_id = '".$idform."' and gestion.f_recibido between '".$f_inicio."' AND '".$f_corte."' group by grupo_id) group by grupo_id";

				}else{
					$str = "select grupo_id, type_id from meta_big_data where grupo_id in (select grupo_id from meta_big_data inner join gestion on gestion.id = meta_big_data.type_id where campo_id = '".$main_ref."' and valor in (".$valores.") and ref_id = '".$idform."' $base group by grupo_id) group by grupo_id";
				}
	    	}
	    }

		$q = $con->Query($str);
		while ($rol = $con->FetchAssoc($q)) {
	        
	        $consul = "select * from meta_big_data where grupo_id = '".$rol['grupo_id']."' order by orden";
	        $q2 = $con->Query($consul);
	        $minr = $c->GetDataFromTable("gestion", "id", $rol['type_id'], "min_rad", $separador = " ");
	        $idr  = $c->GetDataFromTable("gestion", "id", $rol['type_id'], "id", $separador = " ");

	        if ($minr != "") {
	            
	            echo "<tr>";
	            echo "<td><a href='/gestion/ver/$idr/' target='_blank'>$minr</a></td>";

	            while ($rowx = $con->FetchAssoc($q2)) {
	                echo "<td>".$rowx['valor']."</td>";
	                $valor = Inverse($rowx['valor']);
	                $archivo_csv2 .= $valor.";";
	            }

	            echo "</tr>";
	            $archivo_csv2 .= "\n";
	        }
	    }

	    $f->fichero_csv($archivo_csv2,$nombre2);
?>            
         	</tbody>
        </table>

	</div>
</div>
<script>
	Highcharts.chart('ct-chart<?= $rx ?>', {
	    data: {
	        table: 'datatable'
	    },
	    chart: {
	        type: '<?= $typechart ?>'
	    },
	     title: {
	        text: 'Representación Grafica de la Tabla'
	    },
	    yAxis: {
	        allowDecimals: false,
	        title: {
	            text: 'Units'
	        }
	    },
	    tooltip: {
	        formatter: function () {
	            return '<b>' + this.series.name + '</b><br/>' +
	                this.point.y + ' ' + this.point.name.toLowerCase();
	        }
	    }
	});

	$(document).ready(function() {
		CalcularTotal();
		$("#datatable tbody tr").find(".numero").each(function() {
	    	$(this).html(formatNumber($(this).html()));
        });

    }); 


	function formatNumber(num) {
	    if (!num || num == 'NaN') return '-';
	    if (num == 'Infinity') return '&#x221e;';
	    num = num.toString().replace(/\$|\,/g, '');
	    if (isNaN(num))
	        num = "0";
	    sign = (num == (num = Math.abs(num)));
	    num = Math.floor(num * 100 + 0.50000000001);
	    cents = num % 100;
	    num = Math.floor(num / 100).toString();
	    if (cents < 10)
	        cents = "0" + cents;
	    for (var i = 0; i < Math.floor((num.length - (1 + i)) / 3) ; i++)
	        num = num.substring(0, num.length - (4 * i + 3)) + '.' + num.substring(num.length - (4 * i + 3));
	    return (((sign) ? '' : '-') + num);
	}
	function CalcularTotal(){
		$("#datatable").append('<?= $strx ?>');
		var totals = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0 ,0 ,0, 0, 0, 0, 0, 0,0,0,0,0,0,0,0,0,0,0,0 ];
		var $filas= $("#datatable tr:not('.total, .encabezado')");
		var tx = 0;
		  $filas.each(function() {
		    $(this).find('td').each(function(i) {
		      if (i != 0)
		        totals[i - 1] += parseInt($(this).html());
		  		//tx += parseInt($(this).html());
		  		if (!isNaN(parseInt($(this).html()))) {
		  			tx += parseInt($(this).html());
		  		}

		    });
		  });
		  $(".total td").each(function(i) {
		    if (i != 0)
		      $(this).html(formatNumber(totals[i - 1]));
		  });
		  $("#totalsumado").html(formatNumber(tx));
		}
</script>