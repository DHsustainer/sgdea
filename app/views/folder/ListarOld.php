
<?

	global $f;
	global $c;
	global $con;

	$usua = new MUsuarios;
	$usua->CreateUsuarios("user_id", $_SESSION['usuario']);




	$cantidad = $f->Zerofill($c->GetTotalFromTable("solicitudes_documentos", "where usuario_destino = '".$_SESSION['usuario']."' and estado = '0' "), 3);
    echo $f->DoFolder("SOLICITUDES DE EXPEDIENTES", "/solicitudes_documentos/listar/", $cantidad, "green");
	


    
?>

<div class="bloque_principal_carpetas">
	<div class="title">CARPETAS DE OTRAS AREAS.</div>
	<?
		# SERIES DOCUMENTALES 


		$query = $con->Query("	Select dependencias.id as id 
								from dependencias inner join gestion on 
									gestion.id_dependencia_raiz = dependencias.id 
									WHERE 	gestion.dependencia_destino != '".$_SESSION['area_principal']."' 
											and usuario_registra = '".$_SESSION['usuario']."' 
											and oficina = '".$_SESSION['seccional']."' 
											and id_version = '".$_SESSION['id_trd_empresa']."'
												group by gestion.id_dependencia_raiz");	    

		while($row = $con->FetchAssoc($query)){
			$d = new MDependencias;
			$d->CreateDependencias("id", $row[id]);
			$nombre = $d->GetNombre();
			$enlace = "/dependencias/nochilds/".$d->GetId()."/";
			$cantidad = $f->Zerofill($c->GetNocounter("gestion", "id_dependencia_raiz = '".$d->GetId()."'" ), 3);
			echo $f->DoFolder($nombre, $enlace, $cantidad);
		}
	?>			
</div>
