<?php
    session_start();
    require_once 'conection.php';

    $id_tutoring = $_POST['id_tutoring'];

    $id_user = $_SESSION['usuario']['id_user'];
    $id_student=$conn->query("SELECT * FROM `student` WHERE `id_user` LIKE '$id_user'")->fetch_assoc()['id'];


    $insert=$conn->query("DELETE FROM `student_request_tutoring` WHERE `id_student` LIKE '$id_student' AND `id_tutoring` LIKE '$id_tutoring'");
    if($insert){
        echo("Eliminada Correctamente");
    }else{
        echo("Error al Eliminar");
    }
?>