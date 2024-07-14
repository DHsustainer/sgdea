
<script language='javascript' type='text/javascript' src='http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js'></script>
<script language='javascript' type='text/javascript' src='<?= APP.'views'.DS.'libros'.DS.'scripts'.DS ?>script.js'></script>
	<form id='FormUpdatedependencias_documentos' action='/dependencias_documentos/actualizar/' method='POST'> 
		<div class='title'>Editar Documentos Obligatorios</div>
			<input type='hidden' name='id' id='id' value='<? echo $object -> GetId(); ?>' /><br>
			<input type='hidden' class='form-control' placeholder='id_dependencia' name='id_dependencia' id='id_dependencia' maxlength='' value='<? echo $object -> Getid_dependencia(); ?>' />
			
			<input type='hidden' class='form-control' placeholder='usuario' name='usuario' id='usuario' maxlength='' value='<? echo $object -> Getusuario(); ?>' />
			
			<input type='hidden' class='form-control' placeholder='fecha' name='fecha' id='fecha' maxlength='' value='<? echo $object -> Getfecha(); ?>' />
			
			<input type='text' class='form-control' placeholder='nombre' name='nombre' id='nombre' maxlength='' value='<? echo $object -> Getnombre(); ?>' />
			<input type='button' value='Actualizar' onClick="UpdateDocumentoDependencia()"/>
	</form>
