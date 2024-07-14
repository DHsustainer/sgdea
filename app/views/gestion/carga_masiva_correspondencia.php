<div id="content" class="app_container">
	<div class="row" style="margin:0px; background: #FFF; padding-left:20px; margin-top:20px">
		<div class="col-md-12">
			<ol class="breadcrumb default">
			  	<li>
			  		<a href="/gestion/correspondencia/">Correspondencia de Entrada</a>
			  	</li>
			  	<li class="active">
			  		<a href="/gestion/CargaMasivaCorrespondencia/"  class="active">Carga Masiva de Correspondencia</a>
			  	</li>
			</ol>
		</div>
	</div>
</div>


	<div id="folders-list-content" class="scrollable">
		<div class="form">
			<div class="row">
				<div class="col-md-5">
					<div class="btn_check"  style='float:left; margin-left: 30px; margin-top:10px;'>
						<h4>
							CONFIGURACIÓN DEL PROCESO DE CARGA
						</h4>
						<p>
							<ol style="width: 95%">
								<li style="margin-top:10px; text-align: justify">									
								Estimado Administrador, Se recomienda diligenciar el formato en su totalidad teniendo en cuenta la información sumistrada y los IDs correspondientes de base de datos.
								</li>
								<li style="margin-top:10px; text-align: justify">
								Los Archivos Cargados por FTP en la carpeta app/archivos_uploads/gestion/
								</li>
								<li style="margin-top:10px; text-align: justify">
									Cada carpeta debe ser identificada con un numero consecutivo que será el mismo que se indique en el campo ID del formato de datos para poder ser relacionado con el expediente.
								</li>
								<li style="margin-top:10px; text-align: justify">
									Cada Carpeta contendrá una subcarpeta llamada "anexos", la cual será la que finalmente contenga los archivos asociados al expediente. es decir; <b>app/archivos_uploads/gestion/XXX/anexos/mi_archivo.pdf</b>
								</li>
								
							</ol>
						</p>
					</div>
				</div>
				<div class="col-md-7">
					<div class="accionesformulario">
					    <div id="container_activities" style="width: 100%;">
						    <div id="cargador_box_upfiles">
						       
						    </div>
						</div>
					    <div class="btn_check"  style='float:left; margin-left: 10px; margin-top:10px;'>
					    	<h4>
								Cargar archivo El archivo de base de datos, Puede descargar el formato de datos aqui <a target="_black" href="<?php echo  HOMEDIR.DS.'app/views/gestion/BASE_PRUEBA_CARGA.xlsx'; ?>">Descargar Formato de Datos</a>
					    	</h4>
						</div><br><br> 
						<div class="white">
							<form id="upload2" method="post" action="/gestion/CargarArchivoCorrespondenciaProcesar/" enctype="multipart/form-data">
							<div id="drop" style="margin-left: auto; margin-right: auto;width:100%;">
			                    <a><br>Cargar archivo base<br><br></a>
			                    <input type="file" name="upl" multiple />
			                </div>
			            	</form>
						</div>

					</div>
					
				</div>
			</div>
		</div>
	</div>
<script src="<?=ASSETS?>/js/jquery.knob.js"></script>

<!-- jQuery File Upload Dependencies -->
<script src="<?=ASSETS?>/js/jquery.ui.widget.js"></script>
<script src="<?=ASSETS?>/js/jquery.iframe-transport.js"></script>
<script src="<?=ASSETS?>/js/jquery.fileupload2.js"></script>
<script src="<?=ASSETS?>/js/script.js"></script>