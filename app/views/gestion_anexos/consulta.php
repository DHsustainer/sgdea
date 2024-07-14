<? 
	$ga = new MGestion_anexos;
	$ga->CreateGestion_anexos("id", $id);
?>
<div class="row" style="background: #FFF">
	<div class="col-md-12" style="padding:50px">
		<h4><?= "Frecuencia de Consulta del Documento '".$ga->GetNombre()."'" ?></h4>
		<br>
		<table>
			<thead class='encabezado'>
				<th class="th_act" width="400px">Usuario</th>
				<th class="th_act" width="150px">Fecha</th>
				<th class="th_act" width="120px">Direccion IP</th>
			</thead>
			<tbody>
				
<?
	$cx = $con->Query("Select * from gestion_anexos_consultas where id_anexo = '$id'");

	while ($row = $con->FetchAssoc($cx)) {

		
        $usuario = $c->GetDataFromTable("usuarios", "user_id", $row['usuario'], "p_nombre, p_apellido", $separador = " ");


		echo "<tr class='tblresult'>";
		echo "		<td>$usuario</td>";
		echo "		<td>".$row['fecha']."</td>";
		echo "		<td>".$row['ip']."</td>";
		echo "</tr>";
	}
?>
			</tbody>
		</table>
	</div>
</div>
<script>
	$('th').parent().addClass('encabezado');
	$('tr.tblresult:not([th]):even').addClass('par');
	$('tr.tblresult:not([th]):odd').addClass('impar');
 	$('tr.tblresult:not([th])').removeClass('tblresult');		
</script>