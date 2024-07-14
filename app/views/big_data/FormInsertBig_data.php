	<form id='formbig_data' action='/big_data/registrar/' method='POST'> 
		<div class="title right">Crear Formulario</div>
		<br>

		<input type='hidden' class='form-control' placeholder='Username' value="<?= $_SESSION['usuario'] ?>" name='username' id='username' maxlength='50' />
		<input type='hidden' class='form-control' placeholder='Proceso_id' value="<?= $id_gestion ?>" name='proceso_id' id='proceso_id' maxlength='10' />
		<input type='hidden' class='form-control' placeholder='Combinar' name='combinar' id='combinar' maxlength='11' value="0" />
		<select class='form-control' name='ref_tables_id' id='ref_tables_id'>
			<option>Listado de Formularios</option>
<?
		while($row = $con->FetchAssoc($query)){
			$l = new MRef_tables;
			$l->Createref_tables('id', $row[id]);
			echo '<option value="'.$l->GetId().'" >'.$l -> GetTitle().'</option>';
		}
?>
		</select>
		<input type='button' value='Insertar'  style='margin:10px;' onClick='InsertBigData("<?= $id_gestion ?>", "<?= $id_dependencia?>")'/>
	</form>