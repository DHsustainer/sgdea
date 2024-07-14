<?php


$sql = "SELECT * FROM events_gestion eg inner join alertas a on eg.id = a.id_evento where a.type = '1' and eg.user_id = 'sanderkdna@gmail.com' and a.user_id = 'sanderkdna@gmail.com' and eg.fecha_realizado = '0000-00-00 00:00:00' and 'SI' != (SELECT estado_respuesta FROM gestion where id = eg.gestion_id) group by eg.id";


?>