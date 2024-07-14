<h4 class="m-t-30">Datos de Contacto</h4>
<table class='table table-striped' id='Tablasuscriptores_contactos_direccion'>
   	<thead>
		<tr class='encabezadot'>
			<th class="th_act"><?= SUSCRIPTORCAMPODIRECCION; ?></th>

			<th class="th_act">Ciudad</th>

			<th class="th_act">Telefonos</th>

			<th class="th_act">Email</th>

			<th class="th_act"></th>

		</tr>

	</thead>



	<tbody>
<?
	$SSC = new MSuscriptores_contactos_direccion;
	$query = $SSC->ListarSuscriptores_contactos_direccion("WHERE id_contacto = '".$object -> GetId()."'");	    

	while($row = $con->FetchAssoc($query)){

		$l = new MSuscriptores_contactos_direccion;

		$l->Createsuscriptores_contactos_direccion('id', $row[id]);

?>

		<tr id='rssc<?= $l->GetId() ?>' class='tblresult'> 

			<td><?php echo $l -> GetDireccion(); ?></td> 

			<td><?php echo $l -> GetCiudad(); ?></td> 

			<td><?php echo $l -> GetTelefonos(); ?></td> 

			<td><?php echo $l -> GetEmail(); ?></td> 

			<td style="width:100px"> 

				<span class="btn btn-info btn-circle mdi mdi-pencil" onclick="EditarSuscriptorcontactos_direccion(<?= $l->GetId() ?>)">
				</span>

				<span class="btn btn-danger btn-circle mdi mdi-delete" onclick="EliminarSuscriptores_contactos_direccion('<?= $l->GetId() ?>')">

                </span>


	        </td>	       

		</tr>

<?

	}

?>	



	</tbody>

</table>



<div class='tblresult' id="rowformsuscotd">

	<br>

	<form id='formsuscriptores_contactos_direccion' method='POST'> 

		<input class="form-control m-t-10" placeholder="id_contacto" type='hidden' name='id_contacto' id='form_id_contacto' maxlength='10' value="<?= $object -> GetId() ?>" />

		<input class="form-control m-t-10" placeholder="<?= SUSCRIPTORCAMPODIRECCION; ?>" type='text' name='direccion' id='form_direccion' maxlength='200' />

		<input class="form-control m-t-10" placeholder="ciudad" type='text' name='ciudad' id='form_ciudad' maxlength='200' /></td>

		<input class="form-control m-t-10" placeholder="telefonos" type='text' name='telefonos' id='form_telefonos' maxlength='100' />

		<input class="form-control m-t-10" placeholder="email" type='text' name='email' id='form_email' maxlength='400' />

		<td align='center'>

			<input type="button" title="Registrar" class="btn btn-info m-t-30" onClick="InsertSuscriptores_contactos_direccion()" value="Registrar"/>

		</td>

	</form>

</div>
<hr>
<script>

	$('th').parent().addClass('encabezado');

	$('tr.tblresult:not([th]):even').addClass('par');

	$('tr.tblresult:not([th]):odd').addClass('impar');



 </script>