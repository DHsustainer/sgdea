<?php 
session_start();

#error_reporting(E_ALL);
#ini_set('display_errors', '1');
	include_once('../DALC/mySql2.php');


	// Definiendo variables y conectandonos con la base de datos
	$con = new ConexionBaseDatos;
	$con->Connect($con);

	echo "<h3>Consulta simple!</h3>";
	$query = $con->Query("Select * from estadosy");

	if ($query) {
		echo $con->Error($query);
	}else{
		echo "Consulta Ejecutada Correctamente";
	}

	echo "<hr>";
	echo "<h3>Demo FetchAssoc</h3>";
	
	$query = $con->Query("Select * from estadosx");
	while ($row = $con->FetchAssoc($query)) {
		echo $row['nombre']." - ".$row['valor']."<br>";
	}
	echo "<hr>";
	echo "<h3>Demo FetchArray</h3>";
	
	$query = $con->Query("Select * from estadosx");
	while ($row = $con->FetchArray($query)) {
		echo $row[1]." - ".$row[2]."<br>";
	}
	echo "<hr>";
	echo "<h3>Demo Result</h3>";
	
	$query = $con->Query("Select * from estadosx");
		
	for ($i=0; $i < $con->NumRows($query) ; $i++) { 
		echo $con->Result($query, $i, 'nombre')." - ".$con->Result($query, $i, 'valor')."<br>";
	}
	echo "<hr>";
	echo "<h3>Demo FetchArray</h3>";
	
	$query = $con->Query("Select * from estadosx");
	while ($row = $con->RowsRestults($query)) {
		echo $row[1]." - ".$row[2]."<br>";
	}
	echo "<hr>";
	echo "Num Rows: Resultados Encontrados: ".$con->NumRows($query);

?>

