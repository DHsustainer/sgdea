<!--
<span style='cursor:pointer'><a href='<?= HOMEDIR.'suscriptores_empresas/listar/' ?>' >Listar suscriptores_empresas</a></span> |
<span style='cursor:pointer'><a href='<?= HOMEDIR.'suscriptores_empresas/nuevo/' ?>' >Crear suscriptores_empresas</a></span>    
<hr>
<div>
	<form id='formbdata' action='<?= HOMEDIR.'suscriptores_empresas'.DS.'buscar'.DS ?>' method='POST'> 
    	<input type='hidden' id='m' name='m' value='suscriptores_empresas' />    
    	<input type='hidden' id='action' name='action' value='buscar' />          
        <input type='text' style='height:25px; width:300px; margin:5px; font-size:19px; color:#5C5C5C' id='id' name='id' value='<?= $_REQUEST['id'] ?>'> <br />Id_suscriptor <input type='radio' id='cn' name='cn' value='id_suscriptor'/>,Id_suscriptores_accesos <input type='radio' id='cn' name='cn' value='id_suscriptores_accesos'/>,Id_suscriptores_modulos_funciones <input type='radio' id='cn' name='cn' value='id_suscriptores_modulos_funciones'/>,Nombre_empresa <input type='radio' id='cn' name='cn' value='nombre_empresa'/>,Dominio <input type='radio' id='cn' name='cn' value='dominio'/>,D_key <input type='radio' id='cn' name='cn' value='d_key'/>,Db <input type='radio' id='cn' name='cn' value='db'/>,   <input type='submit' value='Buscar suscriptores_empresas'>              
	</form>	
</div>-->

	
	<div class='title right'>Listado de Empresas</div>
		<?php include(VIEWS.DS."suscriptores_empresas/FormInsertSuscriptores_empresas.php"); ?>
		<table border='0' cellspacing='0' cellpadding='3' width='100%' class='tabla' id='Tablasuscriptores_empresas'>
           	<thead>
				<tr class='encabezado'>
					<th class='th_act'>Nombre empresa</th>
					<th class='th_act'>Db</th>
					<th class='th_act'>Dominio</th>
					<th class='th_act'></th>
				</tr>
			</thead>

			<tbody>

<?
		while($row = $con->FetchAssoc($query)){
			$l = new MSuscriptores_empresas;
			$l->Createsuscriptores_empresas('id', $row[id]);
?>						
			<tr id='r<?= $l->GetId() ?>' class='tblresult'> 
				<td><?php echo $l -> GetNombre_empresa(); ?></td>  
				<td><?php echo $l -> GetDb(); ?></td> 
				<td><?php echo $l -> GetDominio(); ?></td> 
				<td>
	                <!--<div onclick='EditarSuscriptores_empresas(<?= $l->GetId() ?>)'>
						<div class='btn btn-info btn-circle' title='editar'></div>
					</div>
--> 
					<div onclick='EliminarSuscriptores_empresas(<?= $l->GetId() ?>)'>
	                    <div class='btn btn-warning btn-circle mdi mdi-delete' title='eliminar'></div>
	                </div>
		        </td>	      
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
		$('#Tablasuscriptores_empresas').tablesorter({sortList:[[0,0]]});
	});	
	

function EliminarSuscriptores_empresas(id){
	if(confirm('Esta seguro desea eliminar este suscriptores_empresas')){
		var URL = '<?= HOMEDIR ?>suscriptores_empresas/eliminar/'+id+'/';
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

function EditarSuscriptores_empresas(id){
	var URL = '<?= HOMEDIR ?>suscriptores_empresas/editar/'+id+'/';
	$.ajax({
		type: 'POST',
		url: URL,
		success: function(msg){
			$('#divtoshow').html(msg);
		}
	});
}	
</script>		
