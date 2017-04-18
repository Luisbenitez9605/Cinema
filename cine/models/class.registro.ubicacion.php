<?php
ini_set('display_errors', 'off');
include_once("resources/class.database.php");

class registro_ubicacion{
	var $fecha;
  	var $id;

function registro_ubicacion(){
}

function insert(){
	$sql = "INSERT INTO pelicula.tbl_registro_ubicacion( fecha, id) VALUES ( '$this->fecha', '$this->id')";
	try {
		pg::query("begin");
		$row = pg::query($sql);
		pg::query("commit");
		echo "1";
	}
	catch (DependencyException $e) {
		echo "Error: " . $e;
		pg::query("rollback");
		echo "-1";
	}
}

function getLista(){

	$sql="SELECT * FROM pelicula.tbl_registro_ubicacion";
	try {
		echo "<SELECT id='id_r'>";
		$result = pg::query($sql);
		while ($row= pg_fetch_array($result)){
			echo "<OPTION value='".$row['id']."'> ".$row['´barrio']."".$row['ciudad']." </OPTION>";
		}
		echo "</SELECT>";
	}
	catch (DependencyException $e) {
		pg::query("rollback");
	}
}

function getAutocomplete(){
	$res="";
	$sql="SELECT * FROM pelicula.tbl_registro_ubicacion";
	try {
		$result = pg::query($sql);
		while ($row= pg_fetch_array($result)){
			$res .= '"' . $row['id'] . ', ' . $row['barrio'] .',' .  $row['ciudad'] .'"';
			$res .= ',';
		}
		$res = substr ($res, 0, -2);
		$res = substr ($res, 1);
	}
	catch (DependencyException $e) {
	}
	return $res;
}
}
?>
