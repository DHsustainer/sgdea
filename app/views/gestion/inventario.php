<?

	if ($_SESSION['mayedit'] == "1") {

		if ($_SESSION['MODULES']['foleado_electronico'] == "1") {

?>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h2>
				Inventario de Carpetas		
			</h2>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
		
			Fecha <?= date("Y-m-d") ?><br>

			Radicado # <b><?= $g->GetMin_rad(); ?></b><br><br>

			<button class="btn btn-success">Ver Formato Unico de Inventario Documental</button><br><br>

			<table border="0" cellspacing="0" cellpadding="3" width="100%" style="width:100%" class="tabla" id="tablat">

				<tr class="encabezado" id="articulo-0">

					<th style="padding: 8px " class="th_act_inner first" width="32px" colspan='2' >Orden</th>

					<th style="padding: 8px " class="th_act_inner"></th>

					<th style="padding: 8px " class="th_act_inner" >Nombre</th>

					<th style="padding: 8px " class="th_act_inner" width="200px">Tipología</th>

					<th style="padding: 8px " class="th_act_inner" width="100px">Fecha de Carga</th>

					<th style="padding: 8px " class="th_act_inner" width="150px">Usuario</th>

					<th style="padding: 8px " class="th_act_inner" width="150px">Peso</th>

					<th style="padding: 8px " class="th_act_inner" width="50px">Cantidad de Folios</th>

					<th style="padding: 8px " class="th_act_inner" width="50px">Folios</th>

					<th style="padding: 8px " class="th_act_inner last" width="50px"></th>

				</tr>

				<? 

					echo "	<tr id='articulo-00'>";

					echo 	"	<td colspan='3' class='th_act' style='text-align:left'></td>";

					echo 	"	<td colspan='6' class='th_act' style='text-align:left'>Carpeta Exterior</td>";

					echo 	"	<td class='th_act' style='text-align:center; padding:8px;'>Pr/Últ</td>";

					echo 	"	<td class='th_act' style='text-align:left; padding:8px;'></td>";

					echo "	</tr>";

					$v = $con->Query("select * from gestion_anexos where gestion_id = '".$id."' and  folder_id = '0' and (estado = '1' or estado = '3') order by orden");

					$i = 0;

					$last = $con->NumRows($v);

					while ($row = $con->FetchAssoc($v)) {

						$i++;

						if ($row['tipologia'] != "") {

							$tipologia = $con->Result($con->Query("select tipologia from dependencias_tipologias where id = '".$row['tipologia']."'"), 0, 'tipologia');

						}else{

							$tipologia = "";

						}

						$orden = $row['orden'];

						if ($orden == '0') {

							$orden = $i;

						}



						$next = $orden+1;

						$prev = $orden-1;

						echo "<tr class='tblresult'>";

							echo "	

										<td width='15px;' style='border-right:1px solid #CCC' align='center'><b>".$orden."</b></td>";

							if ($i != $last) {

								echo "	<td width='16px' style='border-right:1px solid #CCC'><img style='cursor:pointer;' id='mybtnorden".$row['id']."' onClick='UpdateOrden(\"".$row['id']."\", \"".$next."\", \"0\", \"0\" )' src='".ASSETS."/images/arrow_down.png' width='16px' title='Bajar una posición'></td>";

							}else{

								echo "	<td width='16px' style='border-right:1px solid #CCC'></td>";

							}

							if ($i != 1) {

								echo "	<td width='16px' style='border-right:1px solid #CCC'>	<img style='cursor:pointer;' id='mybtnorden".$row['id']."' onClick='UpdateOrden(\"".$row['id']."\", \"".$prev."\", \"1\", \"0\" )' src='".ASSETS."/images/arrow_up.png' width='16px' title='Subir una posición'></td>";

							}else{

								echo "	<td width='16px' style='border-right:1px solid #CCC'></td>";

							}



							$x = $row['peso'];# @stat (ROOT.DS."archivos_uploads/gestion/".$id.trim("/anexos/ ").$row['url']);


							$size = round($x / 1024, 2)." Kb (".$x." Bytes)";
							#$size = round($x / 1024, 2)." Kb (".$x." Bytes)";



	#						echo "	<td style='border-right:1px solid #CCC' ></td>";

							echo "	<td style='border-right:1px solid #CCC' >$row[nombre]</td>";

							echo "	<td style='border-right:1px solid #CCC' >$tipologia</td>";

							echo "	<td style='border-right:1px solid #CCC' >$row[fecha]</td>";

							echo "	<td style='border-right:1px solid #CCC' >$row[user_id]</td>";

							echo "	<td style='border-right:1px solid #CCC' >$size</td>";

							echo "	<td style='border-right:1px solid #CCC'  align='center'>

										<input type='text' class='calcval' id='calc".$row['id']."' alt='".$row['id']."' style='width:30px; text-align:center' value='$row[cantidad]'>

										<input type='hidden' class='firstone' id='first".$row['id']."' style='width:30px' placeholder='Pr'>

										<input type='hidden' class='lastone' id='last".$row['id']."' style='width:30px' placeholder='F'>

									</td>";

							echo "	<td align='center' style='border-right:1px solid #CCC' >$row[folio] - $row[folio_final]</td>";

							echo "	<td align='center'><img style='cursor:pointer; display:none' class='mybtn' id='mybtn".$row['id']."' onClick='UpdateFolio(\"".$row['id']."\")' src='".ASSETS."/images/gckeck.png' width='20px'></td>";

						echo "</tr>";

					}

					$c->GetArbolDocumentos($id, 0, "-"); 



					if($_SESSION['editar'] == 1){

						echo "	<tr>";

						echo 	"	<td colspan='8' class='th_act' style='text-align:left'></td>";

						echo 	"	<td colspan='2' class='th_act' style='text-align:center'> 

										<div class='opc' onclick='CalcularFolios()' style='width:auto; font-wight:bold'>Calcular Folios</div>

									</td>";

						echo 	"	<td class='th_act' style='text-align:left'></td>";

						echo "	</tr>";

					} else {

						echo "	<tr>";

						echo 	"	<td colspan='8' class='th_act' style='text-align:left'></td>";

						echo 	"	<td colspan='2' class='th_act' style='text-align:center'> 

										

									</td>";

						echo 	"	<td class='th_act' style='text-align:left'></td>";

						echo "	</tr>";

					}



				?>

			</table>

			<div id="msg"></div>


			</div>
		</div>
	</div>
		
</div>

	<script>



	$('tr.tblresult:not([th]):even').addClass('par');

	$('tr.tblresult:not([th]):odd').addClass('impar');



	function CalcularFolios(){

		$('.calcval').each(function(key, value) {

			var first = $(".firstone").eq(key).val();

			var last = 0;

			if (first == 0) {

				first = 1;

			}

			var pages = parseInt($(this).val());

			var firstvalue = parseInt(first);



			last =  pages + firstvalue - 1;



			$(".firstone").eq(key).val(first);

			$(".lastone").eq(key).val(last);

			$(this).parent().next().html(first+" - "+last);



			var nextfolf = last+1;

			var nextnode = key+1;

			$(".firstone").eq(nextnode).val(nextfolf);

			



		});



		$(".mybtn").css("display", 'block');

	}



	function UpdateFolio(id){

		//alert("Actualizar "+id+" Con los siguientes valores:\nDesde:"++"\nHasta:"++"\nCantidad de Folios"+);

		var URL = '/gestion_anexos/organizar_folio/'+id+'/';

	    var str = "from="+$("#first"+id).val()+"&to="+$("#last"+id).val()+"&total="+$("#calc"+id).val();

	    $.ajax({

	        type: 'POST',

	        url: URL,

	        data: str,

	        success:function(msg){

//		            alert(msg);

	            $("#mybtn"+id).remove();

	        }

	    }); 

	}





	function UpdateOrden(id, orden, action, folder){

		//alert("Actualizar "+id+" Con los siguientes valores:\nDesde:"++"\nHasta:"++"\nCantidad de Folios"+);

		var URL = '/gestion_anexos/organizar_orden/'+id+'/';

	    var str = "orden="+orden+"&act="+action+"&folder="+folder;

	    $.ajax({

	        type: 'POST',

	        url: URL,

	        data: str,

	        success:function(msg){

	            //alert("Folio Actualizado");

	            window.location.reload();

	        }

	    }); 

	}



	</script>



<?

		}else{

			include(VIEWS.DS.'template/error_view.php');

		}

	}else{

?>

		<script type="text/javascript">

			alert("No tiene permisos para ingresar a esta sección");

			window.close();

		</script>

<?

	}

?>

