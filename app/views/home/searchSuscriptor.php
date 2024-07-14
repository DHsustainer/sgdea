<link rel='stylesheet' type='text/css' href='<?= ASSETS ?>/styles/agenda.css'/>

<?php if ($_SESSION['usuario'] == ""): ?>
	<style type="text/css">
		#left-bar{
			display: none
		}

		#content, #tools-content, #folders-content{
			left:0px !important;
		}

		#folders-list-content{
			padding-left: 0px;
		}

		.search_result{
			width: 96%;
		}

		#tablat{
			width: 100%;
		}
	</style>
<?php endif ?>
<div id="tools-content">
	<div class="opc-folder blue">
		<div class="ico-content-ps">
			<div class="icon white_contacto search_icon"></div>
			<div class="text-folder">Resultados de busqueda por Nombre o cédula: "<?= $attr; ?>"</div>
		</div>
		<div class="header-agenda">
			
		</div>
	</div>
</div>
<div id="folders-content">
	<div id="folders-list-content">
		<div class="contact-list_main_2">
<?
	

	$id = trim($attr);
	$us = $_SESSION["usuario"];


		if($id == ""){
			echo "<div class='da-message error'>Resultados: Debe ingresar algo para buscar</div>";
		}else{
			$sql = "Select * from suscriptores_contactos where MATCH (nombre) AGAINST ('$id') or identificacion = '$id'";
			$query_sql = $con->Query($sql);
		    while ($row = $con->FetchAssoc($query_sql)){
		    	$contact = new MSuscriptores_contactos;
		    	$contact->CreateSuscriptores_contactos("id", $row['id']);

		    	$ccontat = new MSuscriptores_contactos_direccion;
		    	$ccontat->CreateSuscriptores_contactos_direccion("id_contacto", $row['id']);


		   		echo '<div class="main_contact_bloc" style="border-bottom:2px solid #009CDE; border-right:1px solid #009CDE">';
			    	echo '<div class="contact_photo">';
			    		echo '<img src="'.ASSETS.DS.'images'.DS.'icon_image.png">';
			    	echo '</div>';
			    	echo '<div class="contact_data">';
			    		
		    			echo '<div class="item-title">'.$contact->GetNombre()."</div>" ;
		    			echo '<div class="table-data scrollable">';
		    			echo '	<table width="100%">
									<tr>
										<td class="table_title" valign="top">Identificacion</td>
										<td class="table_text">'.$contact->GetIdentificacion().'</td>
									</tr>
									<tr>
										<td class="table_title" valign="top">Direccion</td>
										<td class="table_text">'.$ccontat->GetDireccion().'</td>
									</tr>
									<tr>
										<td class="table_title" valign="top">Ciudad</td>
										<td class="table_text">'.$ccontat->GetCiudad().'</td>
									</tr>
									<tr>
										<td class="table_title" valign="top">E-mail</td>
										<td class="table_text">'.$ccontat->GetEmail().'</td>
									</tr>
									<tr>
										<td class="table_title" valign="top">Telefono</td>
										<td class="table_text">'.$ccontat->GetTelefonos().'</td>
									</tr>
								</table>';
						echo '</div>';
			    	echo '</div>';
					echo '<div class="clear"></div>';			
					

		    	echo '</div>';
		    }


		}
?>

		</div>
	</div>
</div>

