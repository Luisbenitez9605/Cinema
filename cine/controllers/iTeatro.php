<?php
	ini_set('display_errors', 'on');
	session_start();
	include_once("../models/class.teatro.php");
	$obj = new teatro);
	if (isset($_POST['id']) && isset($_POST['descripcion'])&& isset($_POST['nombre'])){
		$obj->id=$_POST['id'];
		$obj->descripcion=$_POST['descripcion'];
		$obj->nombre=$_POST['nombre'];
		echo $obj->insert();
	}
	else{
		echo "-1";
	}
?>
