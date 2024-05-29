<?php
session_start();
require_once 'conection.php';
if(isset($_SESSION['usuario'])){


    $carrera=$_POST['carrera'];
	$sql= $conn->query("SELECT * FROM `course` WHERE `id_career` LIKE '$carrera' ");

	$cadena="<select id='lista2' name='asig_tutoring'>";

	while ($ver=mysqli_fetch_row($sql) ){
		$cadena=$cadena.'<option value='.$ver[0].'>'.$ver[1].'</option>';
	}

	echo  $cadena."</select>";
}
?>