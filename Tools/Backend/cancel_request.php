<?php
session_start();
require_once 'conection.php';
$id_user = $_SESSION['usuario']['id_user'];
    
$id_request_tutoring = $_POST['id_request_tutoring'];


$insert = $conn->query("DELETE FROM `request` WHERE `id_user` LIKE '$id_user' AND `id_request_tutoring` LIKE '$id_request_tutoring'");
if($insert){
    $conn->query("DELETE FROM `request_tutoring` WHERE `id_user` LIKE '$id_user' AND `id` LIKE '$id_request_tutoring'");
    echo ("Se elimino correctamente"); 
}else{
    //echo("dato id: ".$id_request_tutoring);
    echo ("Error al eliminar la solicitud");
}

