<h4 class="m-t-30" style="text-transform: uppercase"><b>Datos de Contacto</b></h4>
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



<div class='tblresult' id="rowformsuscotd"></div>
<script>
	$('th').parent().addClass('encabezado');
	$('tr.tblresult:not([th]):even').addClass('par');
	$('tr.tblresult:not([th]):odd').addClass('impar');
 </script>