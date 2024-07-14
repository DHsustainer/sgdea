<div class="c_col_full_width" id="c_col">
	<div></div>
	<div id="btns_agenda" style="margin-top:10px; padding-left:0px; float:left; width:auto;">
<?
		$fecha_c = date_create($date);//aca le pasas la fecha actual o ala que le queres sumar los dias.
		date_modify($fecha_c, "+1 day");//sumas los dias que te hacen falta.
		$next = date_format($fecha_c, "Y-m-d");//retornas la fecha en el formato que mas te guste.
		$fecha_d = date_create($date);//aca le pasas la fecha actual o ala que le queres sumar los dias.
		date_modify($fecha_d, "-1 day");//sumas los dias que te hacen falta.
		$prevday = date_format($fecha_d, "Y-m-d");//retornas la fecha en el formato que mas te guste.
?>
		<div style="margin-left:0px;" class="btn_agenda prev" onClick="window.location.href='<?= HOMEDIR.DS.'agenda'.DS.$action.DS.$prevday.DS.$id.'.'.$pid.DS ?>'"></div>
		<div style="margin-left:0px;" class="btn_agenda none_full">
			<?= $f->ObtenerFecha_2($date, "X") ?>
		</div>
		<div style="margin-left:0px;" class="btn_agenda next" onClick="window.location.href='<?= HOMEDIR.DS.'agenda'.DS.$action.DS.$next.DS.$id.'.'.$pid.DS ?>'"></div>
		<div class="clear"></div>		 	
	</div>	
	<div id="btns_navigation">
		<div class="btns_navigation left"><a href="<?= HOMEDIR.DS.'agenda'.DS.'anho'.DS.$date.DS.$id.'.'.$pid.DS ?>">Año</a></div>
		<div class="btns_navigation center"><a href="<?= HOMEDIR.DS.'agenda'.DS.'mes'.DS.$date.DS.$id.'.'.$pid.DS ?>">Mes</a></div>
	<!--<div class="btns_navigation center"><a href="<?= HOMEDIR.DS.'agenda'.DS.'semana'.DS.$date.DS.$id.'.'.$pid.DS ?>">Semana</a></div> -->
		<div class="btns_navigation right active"><a href="<?= HOMEDIR.DS.'agenda'.DS.'dia'.DS.date("Y-m-d").DS.$id.'.'.$pid.DS ?>">Hoy</a></div>
		<div class="clearb"></div>			
	</div>

	<table style="width:100%; margin-bottom: 10px;" border="0" cellspacing="0" cellpadding="3">
		<tr>
			<td class="tbl_header_left" width="42px" height="27px"></td>
			<td class="tbl_header_right"><?= $f->ObtenerFecha_2($date, "X") ?></td>
		</tr>
		<tr>
			<td class="tbl_line_2" style="border-bottom:1px solid #C5C8CD">Todo-dia</td>
			<td class="tbl_line" style="border-bottom:1px solid #C5C8CD"></td>
		</tr>
<?
			
			$log  = $c->GetFechaLog();
			$alog = $c->consultarlog();
			$dif  = $c->Diferencia($date, $log);
			$dia  = $dif + $alog;		

			for ($i=0; $i < 24; $i++) { 
				if ($i <= 9) {
					$rt = "0".$i;
				}else{
					$rt = $i;
				}


				if($pid == ""){
					$q_str = "SELECT * FROM events WHERE date = '".$dia."' and  time LIKE  '".$rt.":%' AND user_id =  '".$_SESSION["usuario"]."' ORDER BY time";
				}else{
					if($pid == "*"){

						$q_str_folder= "select * from folder_demanda where user_id = '".$_SESSION["usuario"]."' AND folder_id ='".$id."'";
						$query_folder = $con->Query($q_str_folder);

						$path  = "(";
						$total_rows = $con->NumRows($query_folder);
						
						for ($j=0 ; $j<$total_rows ; $j++){

							$q_str = "SELECT * FROM caratula WHERE proceso_id= '".$con->Result($query_folder, $j, 'proceso_id')."' AND user_id = '".$_SESSION["usuario"]."'";
							$queryx = $con->Query($q_str);
							if($total_rows == 1){
								$path .= "proceso_id = ".$con->Result($queryx, 0, 'id');	
							}else{
								if($j == $total_rows -1){
									$path .= "proceso_id = ".$con->Result($queryx, 0, 'id');	
								}else{
									$path .= "proceso_id = ".$con->Result($queryx, 0, 'id')." OR ";	
								}
							}
						}	
						$path  .= ") AND ";
						$q_str = "SELECT * FROM events WHERE $path date = '".$dia."' and time LIKE  '".$rt.":%' AND user_id =  '".$_SESSION["usuario"]."' ORDER BY time";
					}else{
						$q_str = "SELECT * FROM events WHERE date = '".$dia."' and time LIKE  '".$rt.":%' AND user_id =  '".$_SESSION["usuario"]."' and proceso_id = '".$pid."' ORDER BY time";
					}
				}


				$query = $con->Query($q_str);

				if ($query) {
					echo "$ok";
					# code...
				}else{
					$con->Error();
				}
				$ie = 0;
				while ($rowev = $con->FetchAssoc($query)) {
					$ie++;
					if ($rowev['deadline'] == "1") {
						$color = "#009C58;";
						$title = "Evento creado por el cliente";
					}elseif($rowev['deadline'] == "2"){
						$color = "#FFBB04;";
						$title = "Evento creado por el administrador";
					}else{
						$title = "";
						$color = "#000;";
					}
					$statusmk = "";
					if ($rowev["echo"] == "1" ) {
						$statusmk = "text-decoration:line-through";
					}

					$prid = $rowev['proceso_id'];
					$pr_id = $con->Result($con->Query("select proceso_id from caratula where id = '".$prid."'"), 0, 'proceso_id');
					$folder = $con->Result($con->Query("select folder_id from folder_demanda where proceso_id = '".$pr_id."' and user_id = '".$_SESSION['usuario']."'"), 0, 'folder_id');

				$c=array(HOMEDIR.DS."correo/ver/".$folder.".".$prid.".", "/' target='_blank'>Ver confirmacion</a>");
		        $b=array("ReadMessage.php?id=inbox&message_id=", "'>Ver confirmacion</a>");
					
		        $filter = $rowev["description"];
	            $filter = str_replace($b,$c,$filter);   


					$box_path = '<span style="color:'.$color.'"  title="'.$title.'" class="hora_evento">'.substr($rowev["time"], 0, 5).'</span>'.$rowev["title"].': '.$filter;
					if ($ie == "1") {
						echo '	<tr>
								<td class="tbl_line_2">'.$rt.':</td>
								<td class="tbl_line" style="color:'.$color.$statusmk.'"  title="'.$title.'" onClick="OpenEvent(\''.$rowev["id"].'\')">'.$box_path.'</td>
							</tr>';
					}else{
						echo '	<tr>
									<td class="tbl_line_2"></td>
									<td style="color:'.$color.$statusmk.'"  title="'.$title.'" class="tbl_line" onClick="OpenEvent(\''.$rowev["id"].'\')">'.$box_path.'</td>
								</tr>';
					}
				}
				if ($ie == 0) {
					echo '	<tr>
								<td class="tbl_line_2">'.$rt.':00</td>
								<td class="tbl_line"></td>
							</tr>';
					echo '	<tr>
								<td class="tbl_line_2">&nbsp;</td>
								<td class="tbl_line"></td>
							</tr>';						
				}elseif ($ie == 1) {
					echo '	<tr>
								<td class="tbl_line_2">&nbsp;</td>
								<td class="tbl_line"></td>
							</tr>';						
				}
			}
?>
		<tr>
			<td class="tbl_line_2" style="border-top:3px double #C5C8CD; border-right:none">&nbsp;</td>
			<td class="tbl_line" style="border-top:3px double #C5C8CD"></td>
		</tr>
	</table>

</div>