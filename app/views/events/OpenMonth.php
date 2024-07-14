<div class="c_col_full_width" id="c_col" >

	<div id="btns_agenda" style="margin-top:10px; padding-left:0px; float:left; width:auto;">
<?
		$fecha_c = date_create($date);//aca le pasas la fecha actual o ala que le queres sumar los dias.
		date_modify($fecha_c, "+1 month");//sumas los dias que te hacen falta.
		$next = date_format($fecha_c, "Y-m-d");//retornas la fecha en el formato que mas te guste.
		$fecha_d = date_create($date);//aca le pasas la fecha actual o ala que le queres sumar los dias.
		date_modify($fecha_d, "-1 month");//sumas los dias que te hacen falta.
		$prevday = date_format($fecha_d, "Y-m-d");//retornas la fecha en el formato que mas te guste.
?>
		<div style="margin-left:0px;" class="btn_agenda prev" onClick="window.location.href='<?= HOMEDIR.DS.'agenda'.DS.$action.DS.$prevday.DS.$id.'.'.$pid.DS ?>'"></div>
		<div style="margin-left:0px;" class="btn_agenda none_full">
			<?= $f->ObtenerFecha_2($date, "mes") ?>
		</div>
		<div style="margin-left:0px;" class="btn_agenda next" onClick="window.location.href='<?= HOMEDIR.DS.'agenda'.DS.$action.DS.$next.DS.$id.'.'.$pid.DS ?>'"></div>
		<div class="clear"></div>		 	
	</div>	
	<div id="btns_navigation">
		<div class="btns_navigation left"><a href="<?= HOMEDIR.DS.'agenda'.DS.'anho'.DS.$date.DS.$id.'.'.$pid.DS ?>">Año</a></div>
		<div class="btns_navigation center active"><a href="<?= HOMEDIR.DS.'agenda'.DS.'mes'.DS.$date.DS.$id.'.'.$pid.DS ?>">Mes</a></div>
		<!--<div class="btns_navigation center"><a href="<?= HOMEDIR.DS.'agenda'.DS.'semana'.DS.$date.DS.$id.'.'.$pid.DS ?>">Semana</a></div> -->
		<div class="btns_navigation right"><a href="<?= HOMEDIR.DS.'agenda'.DS.'dia'.DS.date("Y-m-d").DS.$id.'.'.$pid.DS ?>">Hoy</a></div>
		<div class="clearb"></div>			
	</div>
	<div class="clear"></div>

	<?
		printmonthtable_2(0, $current, $pid, $id, $action);
	?>
	
	<div class="clear"></div>
</div>

