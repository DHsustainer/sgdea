<?
	if ($_SESSION['usuario'] == "sanderkdna@gmail.com" || $_SESSION['usuario'] == "soporte1@laws.com.co") {
?>
<form id='FormUpdatesuscriptores_accesos' action='/suscriptores_accesos/actualizar/' method='POST'> 
	<div class='title right'>Datos de Claves</div>
		<input type='hidden' name='id' id='id' value='<? echo $suscaccs -> GetId(); ?>' />
		<input type='hidden' class='form-control' placeholder='id_suscriptor' name='id_suscriptor' id='id_suscriptor' maxlength='' value='<? echo $suscaccs -> Getid_suscriptor(); ?>' />

		<br>
		<div class="row">
			<div class="col-md-6">
				<h4><b>Datos de Configuración de Correo Electrónico</b></h4>
				<hr>
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label for="host_correo">Host:</label>
							<input type='text' class='form-control' placeholder='Host de Correo electrónico' name='host_correo' id='host_correo' maxlength='' value='<? echo $suscaccs -> GetHost_correo(); ?>' />
						</div>
					</div> 
				</div>

				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label for="puerto_correo">Puerto</em></label>
							<input type='text' class='form-control' placeholder='Puerto de Conexión' name='puerto_correo' id='puerto_correo' maxlength='' value='<? echo $suscaccs -> GetPuerto_correo(); ?>' />
						</div>
					</div> 
				</div>		

				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label for="usuario_correo">Usuario:</label>
							<input type='text' class='form-control' placeholder='Nombre de usuario' name='usuario_correo' id='usuario_correo' maxlength='' value='<? echo $suscaccs -> GetUsuario_correo(); ?>' />
						</div>
					</div> 
				</div>		

				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label for="clave_correo">Clave:</label>
							<input type='text' class='form-control' placeholder='Clave' name='clave_correo' id='clave_correo' maxlength='' value='<? echo $suscaccs -> GetClave_correo(); ?>' />
						</div>
					</div> 
				</div>		

				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="autenticacion_correo">Requiere Autenticacion:</label>
							<select class='form-control' placeholder='Requiere Autenticacion' name='autenticacion_correo' id='autenticacion_correo'>
								<option <?= ($suscaccs->GetAutenticacion_correo() == "1")?"selected='selected'":"" ?> value="1">SI</option>
								<option <?= ($suscaccs->GetAutenticacion_correo() == "0")?"selected='selected'":"" ?> value="0">NO</option>
							</select>

						</div>
					</div> 
					<div class="col-md-6">
						<div class="form-group">
							<label for="smtp_correo">Es SMTP:</label>
							<select class='form-control' placeholder='La conexión es SMTP' name='smtp_correo' id='smtp_correo'>
								<option <?= ($suscaccs->GetSmtp_correo() == "1")?"selected='selected'":"" ?> value="1">SI</option>
								<option <?= ($suscaccs->GetSmtp_correo() == "0")?"selected='selected'":"" ?> value="0">NO</option>
							</select>
						</div>
					</div> 
				</div>
				
			</div>
			<div class="col-md-6">
				<h4><b>Datos de Base de Datos</b></h4>
				<hr>
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label for="dominio">Nombre de Dominio/FTP:</label>
							<input type='text' class='form-control' placeholder='Dominio' name='dominio' id='dominio' maxlength='' value='<? echo $suscaccs -> Getdominio(); ?>' />
						</div>
					</div> 
				</div>

				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label for="host">Nombre Servidor</b> <em>("localhost" por defecto):</em></label>
							<input type='text' class='form-control' placeholder='Servidor' name='host' id='host' maxlength='' value='<? echo $suscaccs -> Gethost(); ?>' />
						</div>
					</div> 
				</div>		

				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label for="usuario">Usuario de Servidor:</label>
							<input type='text' class='form-control' placeholder='Usuario de S' name='usuario' id='usuario' maxlength='' value='<? echo $suscaccs -> Getusuario(); ?>' />
						</div>
					</div> 
				</div>		

				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label for="clave">Clave de Servidor:</label>
							<input type='text' class='form-control' placeholder='Clave de S' name='clave' id='clave' maxlength='' value='<? echo $suscaccs -> Getclave(); ?>' />
						</div>
					</div> 
				</div>		

				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label for="db_nombre">Nombre de Base de Datos:</label>
							<input type='text' class='form-control' placeholder='Nombre de Base de Datos' name='db_nombre' id='db_nombre' maxlength='' value='<? echo $suscaccs -> Getdb_nombre(); ?>' />
						</div>
					</div> 
				</div>	
			</div>
		</div>
		<br><br>
		<div class="row">
			<div class="col-md-6">
				<h4><b>Datos FTP</b></h4>
				<hr>
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label for="usuario_ftp">Usuario FTP:</label>
							<input type='text' class='form-control' placeholder='Nombre de usuario ftp  Ej: usuario@ftp.modiminio.com' name='usuario_ftp' id='usuario_ftp' maxlength='' value='<? echo $suscaccs->GetUsuario_ftp(); ?>' />
						</div>
					</div> 
				</div>	
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label for="clave_ftp">Clave FTP:</label>
							<input type='text' class='form-control' placeholder='Clave de Acceso al servidor' name='clave_ftp' id='clave_ftp' maxlength='' value='<? echo $suscaccs -> GetClave_ftp(); ?>' />
						</div>
					</div> 
				</div>		

				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label for="puerto_ftp">Puerto FTP:</label>
							<input type='text' class='form-control' placeholder='Puerto de Conexión (21)' name='puerto_ftp' id='puerto_ftp' maxlength='' value='<? echo $suscaccs -> GetPuerto_ftp(); ?>' />
						</div>
					</div> 
				</div>		

				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label for="path_ftp">Path...: <span class="fa fa-question-circle-o" data-toggle="tooltip" title="Lugar donde se alojaran los archivos"></span></label>
							<input type='text' class='form-control' placeholder='Path Ej: public_html/' name='path_ftp' id='path_ftp' maxlength='' value='<? echo $suscaccs -> GetPath_ftp(); ?>' />
						</div>
					</div> 
				</div>
				
			</div>
			<div class="col-md-6">
				<h4><b>Configuración General</b></h4>
				<hr>
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label for="d_key">Key de Instalación:</label>
							<input type='text' class='form-control' placeholder='Key de Instalación' name='d_key' id='d_key' maxlength='' value='<? echo $suscaccs->GetkeyUser(); ?>' />
						</div>
					</div> 
				</div>	
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label for="url1">url1: WS de Actualizacion:</label>
							<input type='text' class='form-control' placeholder='url1: WS de Actualizacion' name='url1' id='url1' maxlength='' value='<? echo $suscaccs -> Geturl1(); ?>' />
						</div>
					</div> 
				</div>		

				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label for="url2">url2: WS de Creación de Guía:</label>
							<input type='text' class='form-control' placeholder='url2: WS de Creación de Guía' name='url2' id='url2' maxlength='' value='<? echo $suscaccs -> Geturl2(); ?>' />
						</div>
					</div> 
				</div>		

				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label for="url3">url3: WS de Rastreo de Guía:</label>
							<input type='text' class='form-control' placeholder='url3: WS de Rastreo de Guía' name='url3' id='url3' maxlength='' value='<? echo $suscaccs -> Geturl3(); ?>' />
						</div>
					</div> 
				</div>
			</div>
		</div>
		<input type='submit' value='Actualizar'/>

</form>


<?
	}
?>