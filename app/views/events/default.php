<link rel='stylesheet' type='text/css' href='<?= ASSETS ?>/styles/agenda.css'/>
<div id="tools-content">
	<div class="opc-folder blue">
		<div class="ico-content-ps">
			<div class="icon schedule hight-blue"></div>
		</div>
		<div class="header-agenda">
			<div id="ajax-l-folder"><img src="<?= ASSETS ?>/images/ajax-loader-white-bgblue.gif" width="20px"></div>
			<select id="carpetasagenda" name="carpeta">
				<?
					echo $pathfolder;
				?>
			</select>
			<div id="ajax-l-process"><img src="<?= ASSETS ?>/images/ajax-loader-white-bgblue.gif" width="20px"></div>
			<select  id="listado_procesos" name="listado_procesos" >
				<option value="">Selecciona un Proceso</option>
			</select>	
		</div>
	</div>
</div>
<div id="folders-content">
	<div id="folders-list-content">
		<div class="l_col">
			<?
				global $f;
				if ($_SESSION['folder'] == "") {
			?>
				<div id="form_insert">
					<?
						include(VIEWS.DS."events".DS."FormInsertEvents.php");
					?>
				</div>
			<?
				}
			?>
			<div id="prev_month">
				<div id="btns_agenda">
					<div class="btn_agenda prev" onClick="printMonths('-1','0','<?= $current ?>','<?= $pid ?>','<?= $id ?>','<?= $action ?>')"></div>
					<div class="btn_agenda none" onClick="printMonths('0', '0','<?= $current ?>','<?= $pid ?>','<?= $id ?>','<?= $action ?>')"><?= $f->ObtenerFecha_2(date("Y-m-d")) ?></div>
					<div class="btn_agenda next" onClick="printMonths('1', '0','<?= $current ?>','<?= $pid ?>','<?= $id ?>','<?= $action ?>')"></div>
					<div class="clear"></div>			
				</div>				
				<?
				if ($action == "dia" || $action == "semana") {
					printmonthtable(0, $current, $pid, $id, $action);
				}elseif($action == "mes" || $action == "anho"){

					$datex = date("Y-m-d");
					$timex = $datex." ". date("H:i:s");
					$fecha_cx = date_create($timex);
					$fecha_cx = date_format($fecha_cx, "Y-m-d H:i:s");
					$fecha_cx = strtotime($fecha_cx);

					$nowx = $fecha_cx;
					$currentx = mktime(0, 0, 0, date("m", $nowx), date("d", $nowx), date("Y", $nowx));

					printmonthtable(0, $currentx, $pid, $id, $action);
				}


				?>
			</div>
		</div>
		<?
			if ($action == "dia") {
				include(VIEWS.DS."events".DS."OpenDay.php");
			}elseif ($action == "semana") {
				include(VIEWS.DS."events".DS."OpenWeek.php");
			}elseif ($action == "mes") {
				include(VIEWS.DS."events".DS."OpenMonth.php");
			}elseif ($action == "anho") {
				include(VIEWS.DS."events".DS."OpenYear.php");
			}else{
				include(VIEWS.DS."events".DS."OpenDay.php");
			}
		?>
	</div>
</div>
<?
	if($id != ""){
?>
		<script>
			var code = "<?= $id ?>";
			$("#ajax-l-process").css("display", "inline-block");		
			var url = "<?= DS.'agenda'.DS.'listadoprocesos'.DS.'"+code+"'.DS ?>";
			$.get(url,
				function(resultado){

					if(resultado == false){

						$('#listado_procesos').append("<option value='*'>No tienes procesos</option>");			

					}else{
						$("#listado_procesos").attr("disabled",false);
						document.getElementById("listado_procesos").options.length=1;
						$('#listado_procesos').append(resultado);			
						$("#ajax-l-process").css("display", "none");	
						$('#listado_procesos option[value="<?= $pid ?>"]').attr("selected", "selected");
	
					}
				}
			);
		</script>
<?
	}
?>
<script>
	var code = "<?= $id ?>";
	var url = "<?= DS.'agenda'.DS.'listadocarpetas'.DS ?>";
	$("#ajax-l-folder").css("display", "inline-block");
	$.get(url,
		function(resultado){

			if(resultado != false){

				$("#carpetasagenda").attr("disabled",false);
				document.getElementById("carpetasagenda").options.length=1;
				$('#carpetasagenda').append(resultado);			
				$("#ajax-l-folder").css("display", "none");
			}
		}
	);		
</script>

<script>
	
	$("#carpetasagenda").live("change", function(){
		var code = $(this).val();
		if(code == "*"){
			var url = "<?= DS.'agenda'.DS.$action.DS.$date.DS ?>";
			window.location.href= url;	
		}else{
			$("#ajax-l-process").css("display", "inline-block");		
			var url = "<?= DS.'agenda'.DS.'listadoprocesos'.DS.'"+code+"'.DS ?>";
			$.get(url,
				function(resultado){

					if(resultado == false){

						$('#listado_procesos').append("<option value='*'>No tienes procesos</option>");			

					}else{
						$("#listado_procesos").attr("disabled",false);
						document.getElementById("listado_procesos").options.length=1;
						$('#listado_procesos').append(resultado);			
						$("#ajax-l-process").css("display", "none");		
					}
				}
			);
		}
				
	});

	$("#listado_procesos").live("change", function(){
		var url = "<?= DS.'agenda'.DS.$action.DS.$date.DS ?>"+$("#carpetasagenda").val()+"."+$(this).val()+"/";		
		window.location.href= url;
	});
</script>