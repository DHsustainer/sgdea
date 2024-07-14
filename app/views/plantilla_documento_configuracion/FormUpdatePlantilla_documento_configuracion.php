<form id='FormUpdateplantilla_documento_configuracion' action='/plantilla_documento_configuracion/actualizar/' method='POST'> 
	<input type='hidden' name='id' id='id' value='<? echo $conf->GetId(); ?>' />
	<input type='hidden' class='form-control' placeholder='ultima_modificacion' name='ultima_modificacion' id='ultima_modificacion' maxlength='' value='<? echo $conf->Getultima_modificacion(); ?>' />
	<input type='hidden' class='form-control' placeholder='tipo' name='tipo' id='tipo' maxlength='' value='<? echo $conf->Gettipo(); ?>' />

	<div class="row" style="margin:0px; margin-top: 20px;">	
		<div class="col-md-3">
			<label for="m_t">Margen Superior <?= $c->Ayuda('236') ?></label>
			<input type='text' class='form-control' placeholder='m_t' name='m_t' id='m_t' maxlength='' value='<? echo $conf->Getm_t(); ?>' />
		</div>
		<div class="col-md-3">
			<label for="m_r">Margen Derecho <?= $c->Ayuda('237') ?></label>
			<input type='text' class='form-control' placeholder='m_r' name='m_r' id='m_r' maxlength='' value='<? echo $conf->Getm_r(); ?>' />
		</div>
		<div class="col-md-3">
			<label for="m_b">Margen Inferior <?= $c->Ayuda('238') ?></label>
			<input type='text' class='form-control' placeholder='m_b' name='m_b' id='m_b' maxlength='' value='<? echo $conf->Getm_b(); ?>' />
		</div>
		<div class="col-md-3">
			<label for="m_l">Margen Izquierdo <?= $c->Ayuda('239') ?></label>
			<input type='text' class='form-control' placeholder='m_l' name='m_l' id='m_l' maxlength='' value='<? echo $conf->Getm_l(); ?>' />
		</div>
		<div class="col-md-3" style="display: none">
			<label for="m_e_t">m_e_t</label>
			<input type='text' class='form-control' placeholder='m_e_t' name='m_e_t' id='m_e_t' maxlength='' value='0.74' />
		</div>
		<div class="col-md-3" style="display: none">
			<label for="m_e_b">m_e_b</label>
			<input type='text' class='form-control' placeholder='m_e_b' name='m_e_b' id='m_e_b' maxlength='' value='0.74' />
		</div>
		<div class="col-md-3" style="display: none">
			<label for="m_p_t">m_p_t</label>
			<input type='text' class='form-control' placeholder='m_p_t' name='m_p_t' id='m_p_t' maxlength='' value='0.63' />
		</div>
		<div class="col-md-3" style="display: none">
			<label for="m_p_b">m_p_b</label>
			<input type='text' class='form-control' placeholder='m_p_b' name='m_p_b' id='m_p_b' maxlength='' value='0.63' />
		</div>
		<div class="col-md-4 m-t-20">
			<label for="fuente">Tipo de letra <?= $c->Ayuda('240') ?></label>
			<input type='text' class='form-control' placeholder='fuente' name='fuente' id='fuente' maxlength='' value='<? echo $conf->Getfuente(); ?>'	/>
		</div>
		<div class="col-md-4 m-t-20">
			<label for="tamano">Tamaño de Fuente Predeterminado <?= $c->Ayuda('241') ?></label>
			<input type='text' class='form-control' placeholder='tamano' name='tamano' id='tamano' maxlength='' value='<? echo $conf->Gettamano(); ?>' />
		</div>
		<div class="col-md-4 m-t-20">
			<input type='submit' value='Actualizar Configuración de Margenes' class="btn btn-info m-t-20"/>
		</div>
	
	</div>	

</form>

