<?php
	ini_set('display_errors', 'on');
	session_start();
	include_once("../models/class.ubicacion.php");
	$obj = new actividad();
if (isset($_POST['id']) && isset($_POST['ciudad'])&& isset($_POST['barrio']))´{
		$obj->id=$_POST['id'];
		$obj->barrio=$_POST['barrio'];
    $obj->ciudad=$_POST['ciudad'];
		echo $obj->insert();
	}
	else{
		echo "-1";
	}
?>
