-<?php
ini_set('display_errors', 'off');
include_once("resources/class.database.php");

class teatro{
	var $id_teatro;
  	var $nombre_teatro;



function teatro(){
}

function select($id_teatro){
	$sql =  "SELECT * FROM pelicula.tbl_teatro WHERE id = '$id_teatro'";
	try {
		$row = pg::query($sql);
		$row=pg_fetch_array($row);
		$this->id_teatro = $row['id_teatro'];
		$this->nombre_teatro = $row['nombre_teatro'];
		return true;
	}
	catch (DependencyException $e) {
	}
}

function delete($id_teatro){
	$sql = "DELETE FROM pelicula.tbl_teatro WHERE id = '$id_teatro'";
	try {
		pg::query("begin");
		$row = pg::query($sql);
		pg::query("commit");
		return "1";
	}
	catch (DependencyException $e) {
		pg::query("rollback");
		return "-1";
	}
}

function insert(){
//echo "me llamo";
	if ($this->validaP($this->id) == false){
		$sql = "INSERT INTO pelicula.tbl_teatro( id, nombre,descripcion) VALUES ( '$this->id', '$this->nombre')";
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
	else{
		$sql="UPDATE pelicula.tbl_teatro set nombre_teatro='" . $this->nombre_teatro . "' WHERE id_teatro='" . $this->id_teatro."'";
		pg::query("begin");
		$row = pg::query($sql);
		pg::query("commit");
		echo "2";
	}
}

function validaP ($id_teatro){
      $sql =  "SELECT * FROM pelicula.tbl_teatro WHERE id_teatro = '$id_teatro'";
      try {
		$row = pg::query($sql);
		if(pg_num_rows($row) == 0){
		        return false;
	        }
		else{
			return true;
		 }
		}
		catch (DependencyException $e) {
			//pg::query("rollback");
			return false;
		}
}

function getTabla(){

	$sql="SELECT * FROM pelicula.tbl_teatro";
	try {
		echo "<div class='container' style='margin-top: 10px'>";
		echo "<table cellpadding='0' cellspacing='0' border='0' class='table table-striped table-bordered' id='example'>";
		echo "<thead>";
		echo "<tr>";
		echo "	<th>id</th>";
		echo "	<th>nombre</th>";
    echo "	<th>descripcion</th>";
		echo "	<th>.</th>";
		echo "</tr>";
		echo "</thead>";
		echo "<tbody>";
		$result = pg::query($sql);
		while ($row= pg_fetch_array($result)){
			echo "<tr class='gradeA'>";
			echo "	<th>" . $row['id_teatro'] . "</th>";
			echo "	<th>" . $row['nombre_teatro'] . "</th>";
			echo "	<th><a href='#' class='btn btn-danger' onclick='elimina(\"" . $row['id'] . "\")'>X<i class='icon-white icon-trash'></i></a>.<a href='#' class='btn btn-primary' onclick='edit(\"" . $row['id'] . "\", \"" . $row['nombre'] . "\",  "\")'>E<i class='icon-white icon-refresh'></i></a></th>";
			echo "</tr>";
		}
		echo "</tbody>";
		echo "</table>";
		echo "</div>";
	}
	catch (DependencyException $e) {
		echo "Procedimiento sql invalido en el servidor";
	}
}

function getTablaInicianPorA(){

	$sql="select * from pelicula.tbl_teatro where nombre like 'A%'";
	try {
		echo "<div class='container' style='margin-top: 10px'>";
		echo "<table cellpadding='0' cellspacing='0' border='0' class='table table-striped table-bordered' id='example'>";
		echo "<thead>";
		echo "<tr>";
		echo "	<th>id</th>";
		echo "	<th>nombre</th>";
		echo "	<th>descripcion</th>";

		echo "</tr>";
		echo "</thead>";
		echo "<tbody>";
		$result = pg::query($sql);
		while ($row= pg_fetch_array($result)){
			echo "<tr class='gradeA'>";
			echo "	<th>" . $row['id_teatro'] . "</th>";
			echo "	<th>" . $row['nombre_teatro'] . "</th>";
			echo "</tr>";
		}
		echo "</tbody>";
		echo "</table>";
		echo "</div>";
	}
	catch (DependencyException $e) {
		echo "Procedimiento sql invalido en el servidor";
	}
}

function getTablaPDF(){

	$sql="select * from pelicula.tbl_teatro";
	$tabla="";
	try {
		$tabla="<table>";
		$tabla=$tabla . "<tr>";
		$tabla=$tabla . "	<td>id</td>";
		$tabla=$tabla . "	<td>nombre</td>";
		$tabla=$tabla . "	<td>descripcion</td>";

		$tabla=$tabla . "</tr>";

		$result = pg::query($sql);
		while ($row= pg_fetch_array($result)){
			$tabla=$tabla . "<tr>";
			$tabla=$tabla . "	<td>" . $row['id_teatro'] . "</td>";
			$tabla=$tabla . "	<td>" . $row['nombre_teatro'] . "</td>";
			$tabla=$tabla . "</tr>";
		}
		$tabla=$tabla . "</table>";
	}
	catch (DependencyException $e) {
		echo "Procedimiento sql invalido en el servidor";
	}
	return $tabla;
}

function getLista(){

	$sql="SELECT * FROM pelicula.tbl_teatro";
	try {
		echo "<SELECT id_teatro='id_teatro'>";
		$result = pg::query($sql);
		while ($row= pg_fetch_array($result)){
			echo "<OPTION value='".$row['id_teatro']."'> ".$row['nombre_teatro']." </OPTION>";

		}
		echo "</SELECT>";
	}
	catch (DependencyException $e) {
		pg::query("rollback");
	}
}

function getAutocomplete(){
	$res="";
	$sql="SELECT * FROM pelicula.tbl_teatro";
	try {
		$result = pg::query($sql);
		while ($row= pg_fetch_array($result)){
			$res .= '"' . $row['id_teatro'] . ', ' . $row['nombre_teatro'] .'"';
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
