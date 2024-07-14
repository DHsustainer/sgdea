<?php

	$fecha = date("Y-m-d");

	$fecha_vencimiento = strtotime ( '+1 day' , strtotime ( $fecha ) ) ;

	$fecha_vencimiento = date ("Y-m-d", $fecha_vencimiento );



	/**INSERT compartido a vencer*/

	$queryddsds = $con->Query("SELECT * FROM gestion_compartir where fecha_caducidad != '0000-00-00' and fecha_caducidad = '$fecha_vencimiento' and estado = '1'");

	while ($rowssss = $con->FetchAssoc($queryddsds)) {

		$con->Query("INSERT INTO alertas (time,user_id, type, log, status, extra, id_gestion, id_act, id_evento) VALUES ('".date('Y-m-d')." 12:00:00','".$rowssss['usuario_comparte']."', '2', '".$c->GetIdLog($fecha)."', '0', 'aecv', '".$rowssss['gestion_id']."', '".$rowssss['id']."', '0')");

	}


	/**INSERT compartido a vencer 2*/

	$queryddsds = $con->Query("SELECT * FROM gestion_compartir where fecha_caducidad != '0000-00-00' and fecha_caducidad = '$fecha_vencimiento' and estado = '1'");

	while ($rowssss = $con->FetchAssoc($queryddsds)) {

		$con->Query("INSERT INTO alertas (time,user_id, type, log, status, extra, id_gestion, id_act, id_evento) VALUES ('".date('Y-m-d')." 12:00:00','".$rowssss['usuario_nuevo']."', '2', '".$c->GetIdLog($fecha)."', '0', 'aecvv', '".$rowssss['gestion_id']."', '".$rowssss['id']."', '0')");

	}







	/**INSERT ALERTA SUSCRIPTORES INCOMPLETOS*/

	$queryddsds = $con->Query("select (SELECT count(*) FROM suscriptores_contactos s inner join suscriptores_contactos_direccion sc on s.id = sc.id_contacto where s.estado = '1' and (sc.ciudad = '' or sc.direccion = '' or s.identificacion = '' or s.nombre = '' )) as cantidad, user_id from usuarios where IsAdministrador = '1'");

	while ($rowssss = $con->FetchAssoc($queryddsds)) {

		$con->Query("INSERT INTO alertas (time,user_id, type, log, status, extra, id_gestion, id_act, id_evento) VALUES ('".date('Y-m-d')." 12:00:00','".$rowssss['user_id']."', '2', '".$c->GetIdLog($fecha)."', '0', 'aisnc', '0', '".$rowssss['cantidad']."', '0')");

	}







	/*Expedientes Gestion vencimiento usuario*/







	$query = $con->Query("SELECT gestion.nombre_destino, count(*) cantidad, usuarios.user_id FROM `gestion` inner join usuarios on gestion.nombre_destino = usuarios.a_i where estado_archivo = '1' and DATE_ADD(f_recibido, INTERVAL (SELECT t_g FROM `dependencias` where id = tipo_documento) DAY) <= DATE(NOW()) group by gestion.nombre_destino");















	while ($row = $con->FetchAssoc($query)) {















		$con->Query("INSERT INTO alertas (time,user_id, type, log, status, extra, id_gestion, id_act, id_evento) VALUES ('".date('Y-m-d')." 12:00:00',".$row['user_id']."', '2', '".$c->GetIdLog($fecha)."', '0', 'aveg', '0', '".$row['cantidad']."', '0')");







	}















	/*Expedientes Centrar vencimiento usuario*/







	$query = $con->Query("SELECT gestion.nombre_destino, count(*) cantidad, usuarios.user_id FROM `gestion` inner join usuarios on gestion.nombre_destino = usuarios.a_i where estado_archivo = '2' and DATE_ADD(f_recibido, INTERVAL (SELECT t_c FROM `dependencias` where id = tipo_documento) DAY) <= DATE(NOW()) group by gestion.nombre_destino");















	while ($row = $con->FetchAssoc($query)) {







		$con->Query("INSERT INTO alertas (time,user_id, type, log, status, extra, id_gestion, id_act, id_evento) VALUES ('".date('Y-m-d')." 12:00:00',".$row['user_id']."', '2', '".$c->GetIdLog($fecha)."', '0', 'avec', '0', '".$row['cantidad']."', '0')");







	}















	/*Expedientes Gestion vencimiento jefe de area*/







	$query = $con->Query("SELECT usuarios.user_id, usuarios.regimen, count(*) as cantidad FROM usuarios inner join gestion on usuarios.regimen = gestion.dependencia_destino where usuarios.IsAdministrador = '1' and gestion.estado_archivo = '1' and DATE_ADD(gestion.f_recibido, INTERVAL (SELECT t_g FROM `dependencias` where id = gestion.tipo_documento) DAY) <= DATE(NOW()) group by usuarios.user_id, usuarios.regimen");















	while ($row = $con->FetchAssoc($query)) {







		$con->Query("INSERT INTO alertas (time,user_id, type, log, status, extra, id_gestion, id_act, id_evento) VALUES ('".date('Y-m-d')." 12:00:00',".$row['user_id']."', '2', '".$c->GetIdLog($fecha)."', '0', 'aveg', '0', '".$row['cantidad']."', '".$row['regimen']."')");







	}















	/*Expedientes Centrar vencimiento jefe de area*/







	$query = $con->Query("SELECT usuarios.user_id, usuarios.regimen, count(*) as cantidad FROM usuarios inner join gestion on usuarios.regimen = gestion.dependencia_destino where usuarios.IsAdministrador = '2' and gestion.estado_archivo = '1' and DATE_ADD(gestion.f_recibido, INTERVAL (SELECT t_c FROM `dependencias` where id = gestion.tipo_documento) DAY) <= DATE(NOW()) group by usuarios.user_id, usuarios.regimen");







	while ($row = $con->FetchAssoc($query)) {







		$con->Query("INSERT INTO alertas (time,user_id, type, log, status, extra, id_gestion, id_act, id_evento) VALUES ('".date('Y-m-d')." 12:00:00',".$row['user_id']."', '2', '".$c->GetIdLog($fecha)."', '0', 'avec', '0', '".$row['cantidad']."', '".$row['regimen']."')");







	}























	/*Expedientes por mover a archivo central*/







	$query = $con->Query("SELECT user_id,(SELECT count(*) FROM `gestion_cambio_ubicacion_archivo` where estado_archivo_destino = '2' and estado = '0') as cantidad FROM `usuarios_funcionalidades` uf inner join funcionalidades f on uf.id_funcionalidad = f.id where  f.nombre_campo = 'archivo_central' and valor = '1' and (SELECT count(*) FROM `gestion_cambio_ubicacion_archivo` where estado_archivo_destino = '2' and estado = '0') > 0");







	while ($row = $con->FetchAssoc($query)) {















		$con->Query("INSERT INTO alertas (time,user_id, type, log, status, extra, id_gestion, id_act, id_evento) VALUES ('".date('Y-m-d')." 12:00:00','".$row['user_id']."', '2', '".$c->GetIdLog($fecha)."', '0', 'avecm', '0', '".$row['cantidad']."', '0')");







	}















	/*Expedientes por mover a archivo historico*/







	$query = $con->Query("SELECT user_id,(SELECT count(*) FROM `gestion_cambio_ubicacion_archivo` where estado_archivo_destino = '3' and estado = '0') as cantidad FROM `usuarios_funcionalidades` uf inner join funcionalidades f on uf.id_funcionalidad = f.id where  f.nombre_campo = 'archivo_historico' and valor = '1' and (SELECT count(*) FROM `gestion_cambio_ubicacion_archivo` where estado_archivo_destino = '3' and estado = '0') > 0");







	while ($row = $con->FetchAssoc($query)) {







		$con->Query("INSERT INTO alertas (time,user_id, type, log, status, extra, id_gestion, id_act, id_evento) VALUES ('".date('Y-m-d')." 12:00:00','".$row['user_id']."', '2', '".$c->GetIdLog($fecha)."', '0', 'avehm', '0', '".$row['cantidad']."', '0')");







	}















?>