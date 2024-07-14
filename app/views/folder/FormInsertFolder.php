<div id="full-content">
	<form action="/proceso/registrar/<?=($_REQUEST[id]!='')?"$_REQUEST[id]/":''?>" method="POST">
		<div id="form-folder">
			<?php if ($_REQUEST[id] !=''): ?>	
				<h4 class="title" style="height:35px; line-height: 35px;">
					<div style="float:left"><b>EDITAR CARPETA</b></div>
				</h4>
				<!--<h3 class=""></h3> -->
			<?php else: ?>
				<h4 class="title" style="height:35px; line-height: 35px;">
					<div style="float:left"><b>CREAR CARPETA</b></div>
				</h4>
				<!--<h3 class="title-form-ps">CREAR CARPETA</h3> -->
			<?php endif ?>

			<input type="hidden" value="<?=(isset($_REQUEST[id])&& is_array($natural))?'0':'1'?>" id="tfol" name="type_f">
			<div class="form-item">
	      		<span class="title-item">Nombre de la carpeta</span>
	      		<div class="input-item"><input type="text" name="nombre" value="<?=$folder[nom]?>"></div>	
	      	</div>
	      	<div class="form-item">
	      	<?php if ($_REQUEST[id]==''): ?>	      	
	      		<span class="title-item">Tipo de carpeta</span>
	      		<div class="input-item">
	      			<a onclick="$('#folder-jur').hide(500);$('#folder-nat').show(500);$('#tfol').val(0);">Natural</a> 
	      			<a onclick="$('#folder-jur').show(500);$('#folder-nat').hide(500);$('#tfol').val(1);"> Jurídica</a>
	      		</div>		
	      	<?php endif ?>
	      	</div>
	      	<div class="form-item">
	      		<span class="title-item">Código de Ingreso </span>
	      		<div class="input-item"><input type="text" readonly="readonly" style="border:1px solid #FFF; font-weight: bold" value="<?=$folder[cod_ingreso]?>"></div>	
	      	</div> 
	      	<div class="form-item">
	      		<span class="title-item">Contraseña: <b><?=$folder[dec_pass]?></b></span>
	      	</div>	   


	      	<?php if ($_REQUEST[id] !=''): ?>	 
	      	<style>
				.link_mail{
					float: right;
					margin-right: 20px;
				}
	      	</style>
	      	<div class="link_mail">
	      		<input type="button" onClick="SendDataCliente('<?= $_REQUEST[id] ?>')" value="Enviar datos de acceso a mi cliente" class="submit" style="width:auto;">
	      	</div>     	
	      	<div class="clear"></div>
	      	<?php endif ?>


	      	<div id="folder-jur" style="display:<?=((isset($_REQUEST[id])&& is_array($juridico)) || !isset($_REQUEST[id]))?'block':'none'?>">
				<h4 class="title" style="height:35px; line-height: 35px;">
					<div style="float:left"><b>CARPETA JURÍDICA</b></div>
				</h4>
	      		<div class="form-item">
		      		<span class="title-item">NIT</span>
		      		<div class="input-item"><input type="text" id="nit_j" name="nit_j" value="<?=$juridico[nit_entidad]?>" onblur='BuscarCarpetaExist("1")'></div>	
		      	</div>
		      	<div class="form-item">
		      		<span class="title-item">Dirección</span>
		      		<div class="input-item"><input type="text" name="dir_j" id="dir_j" value="<?=$juridico[dir_entidad]?>"></div>	
		      	</div>
		      	<div class="form-item">
		      		<span class="title-item">Ciudad</span>
		      		<div class="input-item"><input type="text" name="ciu_j" id="ciu_j" value="<?=$juridico[ciu_entidad]?>"></div>	
		      	</div>
		      	<div class="form-item">
		      		<span class="title-item">Teléfono</span>
		      		<div class="input-item"><input type="text" name="tel_j" id="tel_j" value="<?=$juridico[telefonos]?>"></div>	
		      	</div>
		      	<div class="form-item">
		      		<span class="title-item">Email</span>
		      		<div class="input-item"><input type="text" name="mai_j" id="mai_j" value="<?=$juridico[email]?>"></div>	
		      	</div>
		      	<div class="form-item">
		      		<span class="title-item">Primer nombre del R/L</span>
		      		<div class="input-item"><input type="text" name="pno_j" id="pno_j" value="<?=$juridico[p_nom_repres]?>"></div>	
		      	</div>
		      	<div class="form-item">
		      		<span class="title-item">Segundo nombre del R/L</span>
		      		<div class="input-item"><input type="text" name="sno_j" id="sno_j" value="<?=$juridico[s_nom_repres]?>"></div>	
		      	</div>
		      	<div class="form-item">
		      		<span class="title-item">Primer apellido del R/L</span>
		      		<div class="input-item"><input type="text" name="pap_j" id="pap_j" value="<?=$juridico[p_ape_repres]?>"></div>	
		      	</div>
		      	<div class="form-item">
		      		<span class="title-item">Segundo apellido del R/L</span>
		      		<div class="input-item"><input type="text" name="sap_j" id="sap_j" value="<?=$juridico[s_ape_repres]?>"></div>	
		      	</div>
		      	<div class="form-item">
		      		<span class="title-item">Ciudad del R/L</span>
		      		<div class="input-item"><input type="text" name="cir_j" id="cir_j" value="<?=$juridico[ciu_repres]?>"></div>	
		      	</div>
	      	</div>
	      	<div id="folder-nat" style="display:<?=(isset($_REQUEST[id])&& is_array($natural))?'block':'none'?>;">
	      		<h4 class="title" style="height:35px; line-height: 35px;">
					<div style="float:left"><b>CARPETA NATURAL</b></div>
				</h4>
	      		<div class="form-item">
		      		<span class="title-item">Identificacion</span>
		      		<div class="input-item"><input type="text" id="ide_n" name="ide_n" value="<?=$natural[cedula]?>"  onblur='BuscarCarpetaExist("2")'></div>	
		      	</div>
		      	<div class="form-item">
		      		<span class="title-item">Lugar de expedición</span>
		      		<div class="input-item"><input type="text" name="lug_n" id="lug_n" value="<?=$natural[ciudad_expedicion]?>"></div>	
		      	</div>
		      	<div class="form-item">
		      		<span class="title-item">Dirección</span>
		      		<div class="input-item"><input type="text" name="dir_n" id="dir_n" value="<?=$natural[direccion]?>"></div>	
		      	</div>
		      	<div class="form-item">
		      		<span class="title-item">Ciudad</span>
		      		<div class="input-item"><input type="text" name="ciu_n" id="ciu_n" value="<?=$natural[ciudad]?>"></div>	
		      	</div>
		      	<div class="form-item">
		      		<span class="title-item">Primer nombre</span>
		      		<div class="input-item"><input type="text" name="pno_n" id="pno_n" value="<?=$natural[p_nombre]?>"></div>	
		      	</div>
		      	<div class="form-item">
		      		<span class="title-item">Segundo nombre</span>
		      		<div class="input-item"><input type="text" name="sno_n" id="sno_n" value="<?=$natural[s_nombre]?>"></div>	
		      	</div>
		      	<div class="form-item">
		      		<span class="title-item">Primer apellido</span>
		      		<div class="input-item"><input type="text" name="pap_n" id="pap_n" value="<?=$natural[p_apellido]?>"></div>	
		      	</div>
		      	<div class="form-item">
		      		<span class="title-item">Segundo apellido</span>
		      		<div class="input-item"><input type="text" name="sap_n" id="sap_n" value="<?=$natural[s_apellido]?>"></div>	
		      	</div>
		      	<div class="form-item">
		      		<span class="title-item">Teléfono</span>
		      		<div class="input-item"><input type="text" name="tel_n" id="tel_n" value="<?=$natural[telefonos]?>"></div>	
		      	</div>
		      	<div class="form-item">
		      		<span class="title-item">Email</span>
		      		<div class="input-item"><input type="text" name="mai_n" id="mai_n" value="<?=$natural[email]?>"></div>	
		      	</div>
	      	</div>
	      	<input type="submit" value="Guardar" class="submit">
	</form>	
	
		<h4 class="title" style="height:35px; line-height: 35px;">
			<div style="float:left"><b>TRANSFERIR ESTA CARPETA</b></div>
		</h4>
		<form action="/caratula/transferircarpeta/<?=$_GET['id']?>/" method="POST">
			<div class="form-item">
			    <span class="title-item">Trasnferir A </span>
			    <div class="input-item" id="field_transfer">
			    	<select name="transferir" id="transferir">
			    		<option value="">Seleccione un usuario</option>
			    		<?
			    			$s= $con->Query("select user_id, p_nombre, p_apellido from usuarios where id_empresa = '".$_SESSION['id_empresa']."'");	
			    			while ($xrow = $con->FetchAssoc($s)) {
			    				echo '<option value="'.$xrow['user_id'].'">'.$xrow['p_nombre'].' '.$xrow['p_apellido'].'</option>';
			    			}
			    		?>
			    		<option value="Other">Transferir a otro usuario</option>
			    	</select>
					<script>
						$("#transferir").on('change', function() {
							if ($(this).val() == "Other") {
								$("#field_transfer").html("<input type='text' id='transferir' name='transferir' placeholder='Escriba el nombre de usuario (email) del usuario a transferir' >");
							}
						});
					</script>
			    </div>    
			</div>
			<br>

			    <input type="submit" name="submit" class="submit" Value="Transferir Carpeta">  
			<br>
		</form>
	</div>
</div>