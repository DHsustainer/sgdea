<?
	# SI LA CONSULTA NO RETORNA DATOS O ERROR ARROJA UN MENSAJE DE ERROR

	echo '<div class="alert alert-warning" role="alert">NO SE ENCONTRARON RESULTADOS</div>';
	# REALIZA EL DEBUG DE LOS DATOS DE ERROR DE LA CONSULTA
	echo '<div class="alert alert-danger" role="alert">Status: '.$query['status'].' Error Message: '.$query['message'].'</div>';
	echo '<button class="btn btn-default"><a href="'.$_SERVER['HTTP_REFERER'].'">Regresar a la pagina anterior</a></button>';
?>
