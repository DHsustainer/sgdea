<!--
<span style='cursor:pointer'><a href='<?= HOMEDIR.'sort/listar/' ?>' >Listar sort</a></span> |
<span style='cursor:pointer'><a href='<?= HOMEDIR.'sort/nuevo/' ?>' >Crear sort</a></span>    
<hr>
<div>
	<form id='formbdata' action='<?= HOMEDIR.'sort'.DS.'buscar'.DS ?>' method='POST'> 
    	<input type='hidden' id='m' name='m' value='sort' />    
    	<input type='hidden' id='action' name='action' value='buscar' />          
        <input type='text' style='height:25px; width:300px; margin:5px; font-size:19px; color:#5C5C5C' id='id' name='id' value='<?= $_REQUEST['id'] ?>'> <br />Code <input type='radio' id='cn' name='cn' value='code'/>,Url <input type='radio' id='cn' name='cn' value='url'/>,Fecha <input type='radio' id='cn' name='cn' value='fecha'/>,   <input type='submit' value='Buscar sort'>              
	</form>	
</div>-->


<!--	<div class='title right'>Listado de sort </div>
		<table border='0' cellspacing='0' cellpadding='3' width='100%' class='tabla' id='Tablasort'>
           	<thead>
				<tr class='encabezado'>
				
					<th class='th_act'>Code</th>
					<th class='th_act'>Url</th>
					<th class='th_act'>Fecha</th>
					<th></th>
				</tr>
			</thead>

			<tbody>-->

<?
		while($row = $con->FetchAssoc($query)){

			$url = $row[url];
		}

		if($url == ""){
			echo '<h1>No existen resultados</h1>';
			exit;
		}
?>			
<script type="text/javascript">
	document.location.href='<?php echo HOMEDIR.DS.''.$url; ?>';
</script>
