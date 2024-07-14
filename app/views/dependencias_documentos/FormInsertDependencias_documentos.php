<form id='formdependencias_documentos' action='/dependencias_documentos/registrar/' method='POST'> 
	<div class='title right'>Crear Documento Obligatorio </div><br>
	
	<input type='hidden' value="<?= $dep->GetId(); ?>" class='form-control' placeholder='Id_dependencia' name='id_dependencia' id='id_dependencia' maxlength='10' />
	<input type='hidden' value="<?= $_SESSION['usuario'] ?>" class='form-control' placeholder='Usuario' name='usuario' id='usuario' maxlength='50' />
	<input type='hidden' value="<?= date('Y-m-d') ?>" class='form-control' placeholder='Fecha' name='fecha' id='fecha' maxlength='' />
	<input type='text' class='form-control important' placeholder='Nombre' name='nombre' id='nombre' maxlength='400' />
	<input type='button' value='Insertar'  style='margin:10px;' onClick="InsertarDocumentodependencia()"/>
</form>