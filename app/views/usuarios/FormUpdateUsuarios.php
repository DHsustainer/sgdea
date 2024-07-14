<script type="text/javascript" src="http://www.bichlmeier.info/sha256.js"></script>
<form id='FormUpdateusuarios' method='POST'> 
<div align='left' class='titulo_principal'>Configuración General de la Cuenta</div>
	

<fieldset>
   <div class="main_title">Foto de Perfil</div>

	<div class="bloq_edit_profile last">
		<div id="main_profile_block" class="nobackground">
			<em>Puedes seleccionar un avatar del listado de imagenes</em>
			<div id="bloque_display">
				<div class="shadowbox"></div>
				<img src="http://assets.audiocodigosjuridicos.com/thumbnail/<?= $object->GetFoto_perfil(); ?>" width="100%;">
			</div>
		</div>
		<div id="datos_perfil" class="avatars">
			<div id="veravatars" class="scrollable">

<?
$avatars = array (
		  	"F02.png"  	, 	"A01.png"	, 	"A02.png"	, 	"A03.png"	, 	"A04.png"	, "A05.png"	 , 	"B01.png"	, 	"B02.png"	, 	"B03.png"	, 	"B04.png"	, 
		 	"B05.png"	, 	"C01.png"	, 	"C02.png"	, 	"C03.png"	,	"C04.png"	, "C05.png"	 ,  "D01.png"	,  	"D02.png"	, 	"D03.png"	, 	"D04.png"	, 
			"D05.png"	,  	"E01.png"	,  	"E02.png"	, 	"E03.png"	, 	"E04.png"	, "E05.png"	 ,  "F01.png"	, 	"F03.png"	, 	"F04.png"	, 	"F05.png"	, 
			"FA01.png"	, 	"FA02.png"	, 	"FA03.png"	,	"FA04.png"	, 	"FA05.png"	, "FB01.png" , 	"FB02.png"	, 	"FB03.png"	,	"FB04.png"	, 	"FB05.png"	, 
			"FC01.png"	, 	"FC02.png"	, 	"FC03.png"	,	"FC04.png"	, 	"FC05.png"	, "FD01.png" , 	"FD02.png"	, 	"FD03.png"	,	"FD04.png"	, 	"FD05.png"	, 
			"FE01.png"	, 	"FE02.png"	, 	"FE03.png"	,	"FE04.png"	, 	"FE05.png"	, "FG01.png" , 	"FG02.png"	, 	"FG03.png"	,	"FG04.png"	, 	"FG05.png"	, 
			"FH01.png"	, 	"FH02.png"	, 	"FH03.png"	,	"FH04.png"	, 	"FH05.png"	, "FI01.png" , 	"FI02.png"	, 	"FI03.png"	,	"FI04.png"	,  	"FI05.png"	, 
			"G01.png"	,  	"G02.png"	,  	"G03.png"	, 	"G04.png"	, 	"G05.png"	, "H01.png"	 ,  "H02.png"	,  	"H03.png"	, 	"H04.png"	, 	"H05.png"	, 
			"I01.png"	, 	"I02.png"	, 	"I03.png"	, 	"I04.png"	, 	"I05.png"	, "J01.png"	 , 	"J02.png"	, 	"J03.png"	, 	"J04.png"	, 	"J05.png"	, 
			"K01.png"	,  	"K02.png"	,  	"K03.png"	, 	"K04.png"	, 	"K05.png"	, "L01.png"	 ,  "L02.png"	,  	"L03.png"	, 	"L04.png"	, 	"L05.png"	, 
			"M01.png"	, 	"M02.png"	, 	"M03.png"	,  	"M04.png"	, 	"M05.png"	, "O01.png"	 ,	"O02.png"	,	"O03.png"	, 	"O04.png"	,	"O05.png"	);

		for ($i=0; $i < count($avatars); $i++) { 
			#echo $avatars[$i]."<br>"; 
			echo '<img onClick="ChangeAvatar(\''.$avatars[$i].'\')" src="http://assets.audiocodigosjuridicos.com/thumbnail/'.$avatars[$i].'" width="70px" />';
			# code...
		}
?>
			</div>
		</div>
	</div>
	<!--
	<input type='button' value='Guardar Cambios' id='updatephotoprofile' onClick="Data_Loader('usuarios/editar/', 'profile')"/>

<script>




</script>
	<form method="post" id="sendfiles" enctype="multipart/form-data"> 
    	<input type="file" name="pictures[]" id="pictures[]" multiple/>
        <input type="submit" value="Cambian Imagen" id="enviarboton"/>
    </form>
    <div id="output1"></div> -->
</fieldset>	
<style>
	.avatars{
		margin-top: -20px;
	}

	.avatars img{
		margin:6px; 
		padding: 4px;
		border:4px solid #FFF; /* Borde */
		background-color: #FFF;
		-moz-border-radius: 45px;
	    -webkit-border-radius: 45px;	
		border-radius: 45px;

		-webkit-opacity: 0.75;
		-moz-opacity: 0.75;
		opacity: 0.75;

		-webkit-transition: all 1s ease;
	  	-moz-transition: all 1s ease;
	  	-ms-transition: all 1s ease;
	  	-o-transition: all 1s ease;
	  	transition: all 1s ease;
	}

	.avatars img:hover{
		-webkit-opacity: 1;
		-moz-opacity: 1;
		opacity: 1;

		background-color: #FFF;
		border:4px solid #CFCFCF; /* Borde */
	}

	#veravatars{
		height: 195px;
		overflow-y: auto;
	}
</style>

<fieldset>
   <div class="main_title">Datos de Usuario</div>

	<div class="bloq_edit_profile">
		<div class="nameelmento">Nombre:</div>
		<div class="elemento"><input type='text' name='nombre_completo' id='nombre_completo' maxlength='' value='<? echo $object -> Getnombre_completo(); ?>' size="50" class="importante" /></div>
	</div>

	<div class="bloq_edit_profile">
		<div class="nameelmento">Alias:</div>
		<div class="elemento"><input type='text' name='usuarioscol' id='usuarioscol' maxlength='' value='<? echo $object -> Getusuarioscol(); ?>' size="50" class="importante"/></div>
		<div class="clear"></div>
		<div class="nameelmento">&nbsp;</div>
		<div class="elemento subtitulo_italic_black">Como te ven los otros usuarios en los conversatorios</div>
	</div>

	<div class="bloq_edit_profile">
		<div class="nameelmento">&nbsp;</div>
		<div class="elemento subtitulo_italic_black">Si desea cambiar su contraseña debe escribir primero su contraseña actual...</div>		
		<div class="clear"></div>
		<div class="nameelmento">Clave Actual:</div>
		<div class="elemento"><input type='password' name='verifpassword' id='verifpassword' maxlength='' placeholder="Escribe tu contraseña actual" size="50"/></div>
		<div class="clear marginbottom_2"></div>

		<div class="nameelmento">Nueva Clave:</div>
		<div class="elemento"><input type='password' name='newpassword' id='newpassword' maxlength='' placeholder="Escribe tu nueva contraseña" size="50"/></div>
		<div class="clear marginbottom_2"></div>

		<div class="nameelmento">Confirmar Clave:</div>
		<div class="elemento"><input type='password' name='checkpassword' id='checkpassword' maxlength='' placeholder="Vuelve a escribir tu nueva contraseña" size="50"/></div>
		<div class="clear marginbottom_2"></div>		
	</div>

	<div class="bloq_edit_profile last">
		<div class="nameelmento">Identificación:</div>
		<div class="elemento"><input type='text' name='identificacion' id='identificacion' maxlength='' value='<? echo $object -> Getidentificacion(); ?>' size="50"/></div>
	</div>

</fieldset>	

<fieldset>
   <div class="main_title">Información De Contacto</div>


	<div class="bloq_edit_profile">
		<div class="nameelmento">Email:</div>
		<div class="elemento"><input type='text' name='email' id='email' maxlength='' value='<? echo $object -> Getemail(); ?>' class="importante" size="50"/></div>
	</div>

	<div class="bloq_edit_profile">
		<div class="nameelmento">Ciudad:</div>
		<div class="elemento"><input type='text' name='ciudad' id='ciudad' maxlength='' value='<? echo $object -> Getciudad(); ?>' class="importante" size="50"/></div>
	</div>

	<div class="bloq_edit_profile">
		<div class="nameelmento">Dirección:</div>
		<div class="elemento"><input type='text' name='direccion' id='direccion' maxlength='' value='<? echo $object -> Getdireccion(); ?>' size="50"/></div>
	</div>

	<div class="bloq_edit_profile last">
		<div class="nameelmento">Telefono:</div>
		<div class="elemento"><input type='text' name='telefono' id='telefono' maxlength='' value='<? echo $object -> Gettelefono(); ?>' size="50"/></div>
	</div>
</fieldset>	

<fieldset>
   <div class="main_title">Información General</div>

	<div class="bloq_edit_profile">
		<div class="nameelmento">Universidad:</div>
		<div class="elemento"><input type='text' name='universidad' id='universidad' maxlength='' value='<? echo $object -> Getuniversidad(); ?>' class="importante" size="50"/></div>
	</div>

	<div class="bloq_edit_profile">
		<div class="nameelmento">Profesión:</div>
		<div class="elemento"><input type='text' name='profesion' id='profesion' maxlength='' value='<? echo $object -> GetProfesion(); ?>' class="importante" size="50"/></div>
	</div>

	<div class="bloq_edit_profile last">
		<div class="nameelmento">Trabajo Actual:</div>
		<div class="elemento"><input type='text' name='trabajo_actual' id='trabajo_actual' maxlength='' value='<? echo $object -> GetTrabajo_actual(); ?>' size="50"/></div>
	</div>
				
</fieldset>	

	<div class="bloq_edit_profile_save">
		<input type='button' value='Guardar Cambios' id='updateprofile'/>
	</div>

	<input type='hidden' name='password' id='password' maxlength='' value='<? echo $object -> Getpassword(); ?>' size="50"/>
</form>