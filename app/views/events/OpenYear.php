<div class="c_col_full_width" id="c_col" >

	<div id="btns_agenda" style="margin-top:10px; padding-left:0px; float:left; width:auto;">
<?
		$fecha_c = date_create($date);//aca le pasas la fecha actual o ala que le queres sumar los dias.
		date_modify($fecha_c, "+1 year");//sumas los dias que te hacen falta.
		$next = date_format($fecha_c, "Y-m-d");//retornas la fecha en el formato que mas te guste.
		$fecha_d = date_create($date);//aca le pasas la fecha actual o ala que le queres sumar los dias.
		date_modify($fecha_d, "-1 year");//sumas los dias que te hacen falta.
		$prevday = date_format($fecha_d, "Y-m-d");//retornas la fecha en el formato que mas te guste.
?>
		<div style="margin-left:0px;" class="btn_agenda prev" onClick="window.location.href='<?= HOMEDIR.DS.'agenda'.DS.$action.DS.$prevday.DS.$id.'.'.$pid.DS ?>'"></div>
		<div style="margin-left:0px;" class="btn_agenda none_full">
			Calendario <?= $f->ObtenerFecha_2($date, "year") ?>
		</div>
		<div style="margin-left:0px;" class="btn_agenda next" onClick="window.location.href='<?= HOMEDIR.DS.'agenda'.DS.$action.DS.$next.DS.$id.'.'.$pid.DS ?>'"></div>
		<div class="clear"></div>		 	
	</div>	
	<div id="btns_navigation">
		<div class="btns_navigation left active"><a href="<?= HOMEDIR.DS.'agenda'.DS.'anho'.DS.$date.DS.$id.'.'.$pid.DS ?>">Año</a></div>
		<div class="btns_navigation center"><a href="<?= HOMEDIR.DS.'agenda'.DS.'mes'.DS.$date.DS.$id.'.'.$pid.DS ?>">Mes</a></div>
		<!--<div class="btns_navigation center"><a href="<?= HOMEDIR.DS.'agenda'.DS.'semana'.DS.$date.DS.$id.'.'.$pid.DS ?>">Semana</a></div> -->
		<div class="btns_navigation right"><a href="<?= HOMEDIR.DS.'agenda'.DS.'dia'.DS.date("Y-m-d").DS.$id.'.'.$pid.DS ?>">Hoy</a></div>
		<div class="clearb"></div>			
	</div>
	<div class="clear"></div>

	<?
		$an = explode("-", $date);
		for ($i=1; $i < 13 ; $i++) { 
			# code...
			$month = $i - $an[1];
			echo '<div class="month_box">';
			printmonthtable_3($month, $current, $pid, $id, $action);
			echo '</div>';
			if ($i == 4 || $i == 8 || $i == 12) {
				echo "<div class='clear'></div>";
				# code...
			}
		}
	?>
	
	<div class="clear"></div>
</div>