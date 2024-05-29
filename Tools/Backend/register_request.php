<?php
session_start();
require_once 'conection.php';
$id_user = $_SESSION['usuario']['id_user'];
    
$id_request_tutoring = $_POST['id_request_tutoring'];


$insert = $conn->query("INSERT INTO `request`(`id_user`, `id_request_tutoring`, `date`) VALUES ('$id_user','$id_request_tutoring',NOW())");
if($insert){
    echo ("Solicitud enviada"); 
}else{
    //echo("dato id: ".$id_request_tutoring);
    echo ("Error al registar la solicitud");
}
