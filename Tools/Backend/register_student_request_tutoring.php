<?php
    require_once 'conection.php';

    $id_tutoring = $_POST['id_tutoring'];
    $id_student = $_POST['id_student'];


    $hoy = getdate();

    $fecha=$hoy['year']."-".$hoy['mon']."-".$hoy['mday'];


    $insert=$conn->query("INSERT INTO `student_request_tutoring`(`fecha`, `id_student`, `id_tutoring`, `state`) VALUES ('$fecha','$id_student','$id_tutoring','Proceso')");
    if($insert){
        echo("Solicitud enviada");
    }else{
        echo("Error al Solicitar");
    }
?>