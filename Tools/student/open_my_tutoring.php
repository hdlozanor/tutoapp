<?php
session_start();
require_once '../Backend/conection.php';

$id_tutoring = $_POST['id_tutoring'];

$id_user = $_SESSION['usuario']['id_user'];

$tutoring = $conn->query("SELECT * FROM `tutoring` WHERE `id` LIKE '$id_tutoring'")->fetch_assoc();

$id_course = $tutoring['id_course'];
$course = $conn->query("SELECT * FROM `course` WHERE `id` LIKE '$id_course'")->fetch_assoc();

$id_career = $course['id_career'];
$career = $conn->query("SELECT * FROM `career` WHERE `id` LIKE '$id_career'")->fetch_assoc();

$id_teacher = $tutoring['id_teacher'];
$teacher = $conn->query("SELECT * FROM `teacher` WHERE `id` LIKE '$id_teacher'")->fetch_assoc();

$schedule = $conn->query("SELECT * FROM `schedule` WHERE `id_tutoring` LIKE '$id_tutoring'")->fetch_assoc();

$student_id = $conn->query("SELECT `id` FROM `student` WHERE `id_user` LIKE '$id_user'")->fetch_assoc()['id'];

$studens_has_tutoring_total = $conn->query("SELECT  COUNT(*) total FROM `studens_has_tutoring` WHERE `id_student` LIKE '$student_id' AND `id_tutoring` LIKE '$id_tutoring'")->fetch_assoc()['total'];

?>
<div class="container_open_my_tutoring">

    <div class="btn_open_my_tutoring">
        <?php
        if ($studens_has_tutoring_total == 0) {

            $resgitrado_student_request_tutoring = $conn->query("SELECT COUNT(*) total FROM `student_request_tutoring` WHERE `id_tutoring` LIKE '$id_tutoring' AND `id_student` LIKE '$student_id'")->fetch_assoc()['total'];
            if ($resgitrado_student_request_tutoring['total'] == 0) {
        ?>
                <h5 style="color:#0080FA ;cursor: pointer;" onclick="register_student_request_tutoring(<?php echo ($id_tutoring . ',' . $student_id); ?>);">Solicitar</h5>
            <?php
            } else {
            ?>
                <h4 style="color:#3C9B61 ;">En proceso</h4>
                <h4 onclick="cancel_student_request_tutoring(<?php echo($id_tutoring);?>);" style="color:#3C9B61;margin-left: 10px;cursor: pointer;">Cancelar solicitud</h4>
            <?php
            }
            ?>

        <?php
        } else {
        ?>
            <img src="IMG/chat.png" alt="" srcset="" style="cursor: pointer;" onclick="messenger();">
            <h4 onclick="cancel_student_has_tutoring(<?php echo($id_tutoring);?>);" style="color:#3C9B61;margin-left: 10px;cursor: pointer;">Darme de baja</h4>
        <?php
        }
        ?>
    </div>

    <div class="title_open_my_tutoring">
        <h3><?php echo ($tutoring['name']); ?></h3>
    </div>

    <div class="space"></div>

    <div style="width: 100%;display: flex; justify-content: center;">
        <img src="IMG/banner2.png" alt="" srcset="" width="70%">
    </div>

    <div class="space"></div>

    <div style="display: flex;flex-direction: row; align-items: center;">
        <h3>Programa: </h3>
        <h4 style="padding-left: 5px;"><?php echo ($career['name']); ?> </h4>
    </div>

    <div class="space"></div>

    <div style="display: flex;flex-direction: row; align-items: center;">
        <h3>Tutor: </h3>
        <h4 style="padding-left: 5px;"><?php echo ($teacher['name']); ?></h4>
    </div>

    <div class="space"></div>

    <h3>Horario: </h3>
    <div style="width: 100%;display: flex; justify-content: center;">
        <?php
        echo ($schedule['url_calendar']);
        ?>
    </div>

    <div class="space"></div>

    <p>
        <?php
        echo ($tutoring['description']);
        ?>
    </p>

    <div class="space"></div>
    <div style="width: 100%; display: flex; justify-content: center;">
        <div style="width: 90%;border-top: 1px solid #707070; border-left: 1px solid #707070 ;border-right: 1px solid #707070 ;">
            <div style="width: 100%; padding: 10px; background-color: #3C9B61;border-bottom: 1px solid #707070 ;">
                <h4 style="color:#FFFBFB ;">CONTENIDO TEORICO</h4>
            </div>
            <?php
            $result = $conn->query("SELECT * FROM `content` WHERE `id_tutoring` LIKE '$id_tutoring'");
            while ($row = $result->fetch_assoc()) {

                $id_files = $row['id_files'];
                $file = $conn->query("SELECT * FROM `files` WHERE `id` LIKE '$id_files'")->fetch_assoc();
            ?>
                <div style="width: 100%; padding: 10px;border-bottom: 1px solid #707070 ;">
                    <h4 onclick="messenger();" style="color:#3C9B61; cursor: pointer;"><?php echo ($file['name']); ?></h4>
                </div>
            <?php

            }
            ?>
        </div>
    </div>

</div>