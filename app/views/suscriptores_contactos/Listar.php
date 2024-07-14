<?
global $c;
?>
<script type="text/javascript">
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip(); 
        $('[data-toggle="popover"]').popover()
    });
</script>

<table class='table table-striped' id='Tablasuscriptores_contactos'>

   	<thead>

		<tr class='encabezadot'>

			<th class="th_act"><?= SUSCRIPTORCAMPONOMBRE; ?></th>

			<th class="th_act" width="120px"><?= SUSCRIPTORCAMPOIDENTIFICACION; ?></th>
			<!--<th class="th_act" width="100px">Estado</th>-->
			<th class="th_act" width="100px"></th>

		</tr>

	</thead>



	<tbody>



<?

	while($row = $con->FetchAssoc($query)){

		$l = new MSuscriptores_contactos;

		$l->Createsuscriptores_contactos('id', $row[id]);

		$lx = new MSuscriptores_tipos;
		$lx->CreateSuscriptores_tipos("id", $l->GetType());
?>						

		<tr id='rsc<?= $l->GetId() ?>' class='tblresult'> 

			<td style="padding-left: 5px">
				<?php echo $l->GetNombre(); ?><br>
				<small><em><?php echo $lx->GetNombre(); ?></em></small>
				</td> 

			<td><?php echo $l->GetIdentificacion(); ?></td> 


			<!--<td><?php if($l->GetEstado() == '1'){echo 'Activo';}else{echo 'Inactivo';}; ?></td> -->

			<td>

				<span class="btn btn-info btn-circle mdi mdi-pencil"  <?= $c->Ayuda('199', 'tog') ?> onclick="EditarSuscriptor(<?= $l->GetId() ?>)">
				</span>

				<span class="btn btn-danger btn-circle mdi mdi-delete"  <?= $c->Ayuda('200', 'tog') ?> onclick="EliminarSuscriptores_contactos('<?= $l->GetId() ?>')">

                </span>

            </td>

		</tr>

<?

	}

?>			

	</tbody>

</table>



<?

	if ($bon == "1") {

		$querypag="SELECT count(*) as t from suscriptores_contactos $where ";

	}else{

    	$querypag="SELECT count(*) as t from suscriptores_contactos";

	}



    echo '<div class="btn-group m-t-30">';

        $NroRegistros = $con->Result($con->Query($querypag), 0, 't');



        if($NroRegistros == 0){

        echo '<div class="texto_italic">No hay registros de ingresos de este item</div><br><br>';

        }



        $PagAnt=$PagAct-1;

        $PagSig=$PagAct+1;

        $PagUlt=$NroRegistros/$RegistrosAMostrar;



        $Res=$NroRegistros%$RegistrosAMostrar;

		if ($bon == "1") {

	        if($Res>0) $PagUlt=floor($PagUlt)+1;
		        echo "<button type='button' class='btn btn-default btn-outline waves-effect' onclick='showqanexos(\"/suscriptores_contactos/BuscarXSuscriptor2/".$id."/1/\", \"cargador_box_upfiles_menu\")' >Pag. 1</button> ";

	        if($PagAct>1) 
		        echo "<button type='button' class='btn btn-default btn-outline waves-effect' onclick='showqanexos(\"/suscriptores_contactos/BuscarXSuscriptor2/".$id."/".$PagAnt."/\", \"cargador_box_upfiles_menu\")'>Pag. Ant.</button> ";
		        echo "<button type='button' class='btn btn-info waves-effect'>Pagina ".$PagAct." de ".$PagUlt."</button>";

	        if($PagAct<$PagUlt)  
		        echo " <button type='button' class='btn btn-default btn-outline waves-effect' onclick='showqanexos(\"/suscriptores_contactos/BuscarXSuscriptor2/".$id."/".$PagSig."/\", \"cargador_box_upfiles_menu\")'>Pag. Sig.</button>  ";
		        echo " <button type='button' class='btn btn-default btn-outline waves-effect' onclick='showqanexos(\"/suscriptores_contactos/BuscarXSuscriptor2/".$id."/".$PagUlt."/\", \"cargador_box_upfiles_menu\")'>Pag. $PagUlt</button> ";

		}else{

	        if($Res>0) $PagUlt=floor($PagUlt)+1;

		        echo "<button type='button' class='btn btn-default btn-outline waves-effect' onclick='showqanexos(\"/suscriptores_contactos/GetListado/1/\", \"cargador_box_upfiles_menu\")' >Pag. 1</button> ";

	        if($PagAct>1) 
		        echo "<button type='button' class='btn btn-default btn-outline waves-effect' onclick='showqanexos(\"/suscriptores_contactos/GetListado/".$PagAnt."/\", \"cargador_box_upfiles_menu\")'>Pag. Ant.</button> ";
		        echo "<button type='button' class='btn btn-info waves-effect'>Pagina ".$PagAct." de ".$PagUlt."</button>";

	        if($PagAct<$PagUlt)  
		        echo " <button type='button' class='btn btn-default btn-outline waves-effect' onclick='showqanexos(\"/suscriptores_contactos/GetListado/".$PagSig."/\", \"cargador_box_upfiles_menu\")'>Pag. Sig.</button>  ";
		        echo " <button type='button' class='btn btn-default btn-outline waves-effect' onclick='showqanexos(\"/suscriptores_contactos/GetListado/".$PagUlt."/\", \"cargador_box_upfiles_menu\")'>Pag. $PagUlt</button> ";

		}


    echo '</div>';

?>

<script>

	$('th').parent().addClass('encabezado');

	$('tr.tblresult:not([th]):even').addClass('par');

	$('tr.tblresult:not([th]):odd').addClass('impar');

 	$('tr.tblresult:not([th])').removeClass('tblresult');		



 	//var pos = $("#menu_tab").offset().top - 120;

    //$('#content').animate({ scrollTop : pos }, 'slow');

 

 	//$(function() {		

	//	$('#Tablasuscriptores_contactos').tablesorter({sortList:[[0,0]]});

	//});	

	



function EliminarSuscriptores_contactos(id){

	if(confirm('Esta seguro desea eliminar este Suscriptor')){

		var URL = '/suscriptores_contactos/eliminar/'+id+'/';

		$.ajax({

			type: 'POST',

			url: URL,

			success: function(msg){

				alert(msg);

				$('#rsc'+id).remove();

			}

		});

	}

	

}	



function EditarSuscriptor(id){

	var URL = '/suscriptores_contactos/editar/'+id+'/';

	$.ajax({

		type: 'POST',

		url: URL,

		success: function(msg){

			$('#formeditsuscriptores').html(msg);

		}

	});

}	



</script>