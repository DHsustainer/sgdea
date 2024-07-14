<form id='formfolder_ciudadano' action='<?= HOMEDIR.DS.'folder_ciudadano/NuevoFolder/' ?>' method='POST'> 
	<table border='0' cellspacing='3' cellpadding='5' class='tabla' width='40%' style="margin-left:7px;">
		<tr>
			<td width='30%'><strong>Titulo:</strong></td>
			<td><input type='text' name='titulo' id='titulo' maxlength='' /></td>
		</tr>
		<tr>
			<td colspan='2' align='right'>
				<input type='button' value='Cancelar' id='btn_cancel_crear_folder'/>
				<input type='submit' value='Guardar'/>
			</td>
		</tr>
	</table>
</form>