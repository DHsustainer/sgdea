
<span style='cursor:pointer'><a href='<?= HOMEDIR.'gestion/listar/' ?>' >Listar gestion</a></span> |
<span style='cursor:pointer'><a href='<?= HOMEDIR.'gestion/nuevo/' ?>' >Crear gestion</a></span>    
<hr>
<div>
	<form id='formbdata' action='<?= HOMEDIR.'gestion'.DS.'buscar'.DS ?>' method='POST'> 
    	<input type='hidden' id='m' name='m' value='gestion' />    
    	<input type='hidden' id='action' name='action' value='buscar' />          
        <input type='text' style='height:25px; width:300px; margin:5px; font-size:19px; color:#5C5C5C' id='id' name='id' value='<?= $_REQUEST['id'] ?>'> <br />Radicado <input type='radio' id='cn' name='cn' value='radicado'/>,F_recibido <input type='radio' id='cn' name='cn' value='f_recibido'/>,Nombre_radica <input type='radio' id='cn' name='cn' value='nombre_radica'/>,Folio <input type='radio' id='cn' name='cn' value='folio'/>,Tipo_documento <input type='radio' id='cn' name='cn' value='tipo_documento'/>,Dependencia_destino <input type='radio' id='cn' name='cn' value='dependencia_destino'/>,Nombre_destino <input type='radio' id='cn' name='cn' value='nombre_destino'/>,Fecha_vencimiento <input type='radio' id='cn' name='cn' value='fecha_vencimiento'/>,Estado_respuesta <input type='radio' id='cn' name='cn' value='estado_respuesta'/>,Num_oficio_respuesta <input type='radio' id='cn' name='cn' value='num_oficio_respuesta'/>,Fecha_respuesta <input type='radio' id='cn' name='cn' value='fecha_respuesta'/>,Observacion <input type='radio' id='cn' name='cn' value='observacion'/>,Prioridad <input type='radio' id='cn' name='cn' value='prioridad'/>,Estado_solicitud <input type='radio' id='cn' name='cn' value='estado_solicitud'/>,Suscriptor_id <input type='radio' id='cn' name='cn' value='suscriptor_id'/>,Ciudad <input type='radio' id='cn' name='cn' value='ciudad'/>,Usuario_registra <input type='radio' id='cn' name='cn' value='usuario_registra'/>,Estado_archivo <input type='radio' id='cn' name='cn' value='estado_archivo'/>,   <input type='submit' value='Buscar gestion'>              
	</form>	
</div>

<div class='t'><?php echo $titulo; ?></div>
		<table border='0' cellspacing='0' cellpadding='3' width='100%' class='tabla' id='Tablagestion'>
           	<thead>
				<tr class='encabezadot'>
				
				<th>Radicado</th>
				<th>F_recibido</th>
				<th>Nombre_radica</th>
				<th>Folio</th>
				<th>Tipo_documento</th>
				<th>Dependencia_destino</th>
				<th>Nombre_destino</th>
				<th>Fecha_vencimiento</th>
				<th>Estado_respuesta</th>
				<th>Num_oficio_respuesta</th>
				<th>Fecha_respuesta</th>
				<th>Observacion</th>
				<th>Prioridad</th>
				<th>Estado_solicitud</th>
				<th>Suscriptor_id</th>
				<th>Ciudad</th>
				<th>Usuario_registra</th>
				<th>Estado_archivo</th>
					<th></th>
				</tr>
			</thead>

			<tbody>

<?
		while($row = $con->FetchAssoc($query)){
			$l = new MGestion;
			$l->Creategestion('id', $row[id]);
?>						
			<tr id='r<?= $l->GetId() ?>' class='tblresult'> 
				<td><?php echo $l -> GetRadicado(); ?></td> 
				<td><?php echo $l -> GetF_recibido(); ?></td> 
				<td><?php echo $l -> GetNombre_radica(); ?></td> 
				<td><?php echo $l -> GetFolio(); ?></td> 
				<td><?php echo $l -> GetTipo_documento(); ?></td> 
				<td><?php echo $l -> GetDependencia_destino(); ?></td> 
				<td><?php echo $l -> GetNombre_destino(); ?></td> 
				<td><?php echo $l -> GetFecha_vencimiento(); ?></td> 
				<td><?php echo $l -> GetEstado_respuesta(); ?></td> 
				<td><?php echo $l -> GetNum_oficio_respuesta(); ?></td> 
				<td><?php echo $l -> GetFecha_respuesta(); ?></td> 
				<td><?php echo $l -> GetObservacion(); ?></td> 
				<td><?php echo $l -> GetPrioridad(); ?></td> 
				<td><?php echo $l -> GetEstado_solicitud(); ?></td> 
				<td><?php echo $l -> GetSuscriptor_id(); ?></td> 
				<td><?php echo $l -> GetCiudad(); ?></td> 
				<td><?php echo $l -> GetUsuario_registra(); ?></td> 
				<td><?php echo $l -> GetEstado_archivo(); ?></td> 
				<td><a href='<?= HOMEDIR.'gestion/editar/'.$l->GetId().'/' ?>'>Editar </a> | 
                        <a onclick='EliminarGestion(<?= $l->GetId() ?>)'>Eliminar</a></td>	       
			</tr>
<?
		}
?>			</tbody>
		</table>
<script>
	$('th').parent().addClass('encabezado');
	$('tr.tblresult:not([th]):even').addClass('par');
	$('tr.tblresult:not([th]):odd').addClass('impar');
 	$('tr.tblresult:not([th])').removeClass('tblresult');		

 
 	$(function() {		
		$('#Tablagestion').tablesorter({sortList:[[0,0]]});
	});	
	

function EliminarGestion(id){
	if(confirm('Esta seguro desea eliminar este libro')){
		var URL = '<?= HOMEDIR ?>gestion/eliminar/'+id+'/';
		$.ajax({
			type: 'POST',
			url: URL,
			success: function(msg){
				alert(msg);
				if(msg == 'OK!')
					$('#r'+id).slideUp();
			}
		});
	}
	
}	
</script>		
