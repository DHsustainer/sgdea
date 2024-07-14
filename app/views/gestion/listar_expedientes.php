<div class="row m-t-30 m-b-30 p-b-30" style="margin:0px; background: #FFF;">
	<div class="col-md-12">		
		
		<h3>Listado de Expedientes</h3>
		<?
		// DE NO RECIBIR PARAMETROS ESTA FUNCION TRAE EL LISTADO COMPLETO DE LIBROS

			$RegistrosAMostrar = 30;
			if(isset($pag)){
				$RegistrosAEmpezar=($pag-1)*$RegistrosAMostrar;
				$PagAct=$pag;
			}else{
				$RegistrosAEmpezar=0;
				$PagAct=1;
			}	
						
			$ar = array("0" => "Baja", "1" => "Media", "2" => "Alta");
			
			$usua = new MUsuarios;
			$usua->CreateUsuarios("user_id", $_SESSION['usuario']);
			
			$g = new MGestion;
			$qn = $con->Query("SELECT * FROM gestion where (usuario_registra = '".$_SESSION['usuario']."' or nombre_destino = '".$_SESSION['user_ai']."') and dependencia_destino = '".$_SESSION['area_principal']."' and oficina = '".$_SESSION['seccional']."' and version = '".$_SESSION['active_vista']."' and estado_archivo = '".$_SESSION['typefolder']."' $pathfiltro order by id limit $RegistrosAEmpezar, $RegistrosAMostrar ");


			$qx = "SELECT count(*) as t FROM gestion where (usuario_registra = '".$_SESSION['usuario']."' or nombre_destino = '".$_SESSION['user_ai']."') and dependencia_destino = '".$_SESSION['area_principal']."' and oficina = '".$_SESSION['seccional']."' and version = '".$_SESSION['active_vista']."' and estado_archivo = '".$_SESSION['typefolder']."' $pathfiltro";

			$NroRegistros = $con->Result($con->Query($qx), 0, 't');

	        if($NroRegistros == 0){
	        	echo '<div class="alert alert-info" role="alert">No hay registros de ingresos de este item</div><br><br>';
	        }

	        $PagAnt=$PagAct-1;
	        $PagSig=$PagAct+1;
	        $PagUlt=$NroRegistros/$RegistrosAMostrar;

	        $Res=$NroRegistros%$RegistrosAMostrar;
	        #echo '<div class="list-group">';
			while ($row = $con->FetchAssoc($qn)) {
				$c->GetVistaAmple($row["id"]);
			}
			#echo '</div>';

			$url = "/gestion/myfiles";
			echo "<div class='paginator'>";
			if($Res>0) $PagUlt=floor($PagUlt)+1;
		        echo "<a href='$url/1/' class='pag'>Pag. 1</button> ";

	        if($PagAct>1) 
		        echo "<a href='$url/$PagAnt/' class='pag'>Pag. Ant.</button> ";
		        echo "<button type='button' class='btn btn-info waves-effect'>Pagina ".$PagAct." de ".$PagUlt."</button>";

	        if($PagAct<$PagUlt)  
		        echo " <a href='$url/$PagSig/' class='pag'>Pag. Sig.</button>  ";
		        echo " <a href='$url/$PagUlt/' class='pag'>Pag. $PagUlt</button> ";

		    echo "</div>";
		?>
	</div>
</div>
