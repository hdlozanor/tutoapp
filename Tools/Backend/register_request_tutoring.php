<?php
session_start();
require_once 'conection.php';
$id_user = $_SESSION['usuario']['id_user'];

$id_course = $_POST['id_course'];
$description = $_POST['description'];
$theme_tutoring = $_POST['theme_tutoring'];
$concept = $_POST['concept'];

$exit_request_tutoring = $conn->query("SELECT COUNT(*) total FROM `request_tutoring` WHERE `id_user` LIKE $id_user AND `id_course` LIKE $id_course")->fetch_assoc()['total'];

if ($exit_request_tutoring == 0) {


    $insert = $conn->query("INSERT INTO `request_tutoring`(`id`, `name`, `description`, `id_course`, `id_user`,`concept`, `state`) VALUES ('null','$theme_tutoring','$description','$id_course','$id_user','$concept','Proceso')");
    if ($insert) {

        $id_request_tutoring = $conn->query("SELECT `id` FROM `request_tutoring` WHERE `id_user` LIKE '$id_user' AND `id_course` LIKE '$id_course'")->fetch_assoc()['id'];

        $hoy = getdate();
        $fecha = $hoy['year'] . "-" . $hoy['mon'] . "-" . $hoy['mday'];

        $insert = $conn->query("INSERT INTO `request`(`id_user`, `id_request_tutoring`, `date`) VALUES ('$id_user','$id_request_tutoring','$fecha')");

        if($insert){
            echo ("Solicitud enviada"); 
        }else{
            //echo("dato id: ".$id_request_tutoring);
            echo ("Error al registar la solicitud para compartir");
        }
    } else {
        echo ("Error al enviar la Solicitud");
    }
} else {
    echo ("Usted ya ha creado la Solicitud con anterioridad");
}
