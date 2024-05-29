<?php
session_start();
require_once '../Backend/conection.php';

$id_tutoring = $_POST['id_tutoring'];


$tutoring = $conn->query("SELECT * FROM `tutoring` WHERE `id` LIKE '$id_tutoring'")->fetch_assoc();

$id_course = $tutoring['id_course'];
$course = $conn->query("SELECT * FROM `course` WHERE `id` LIKE '$id_course'")->fetch_assoc();

$id_career = $course['id_career'];
$career = $conn->query("SELECT * FROM `career` WHERE `id` LIKE '$id_career'")->fetch_assoc();

$id_teacher = $tutoring['id_teacher'];
$teacher = $conn->query("SELECT * FROM `teacher` WHERE `id` LIKE '$id_teacher'")->fetch_assoc();

$schedule = $conn->query("SELECT * FROM `schedule` WHERE `id_tutoring` LIKE '$id_tutoring'")->fetch_assoc();


?>
<div class="container_open_my_tutoring">

    <div class="btn_open_my_tutoring">
        <img src="IMG/chat.png" alt="" srcset="" style="cursor: pointer;" onclick="messenger();">
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

    <h3>Estudantes: </h3>
    <div style="width: 100%; display: flex; justify-content: center;">
        <div style="width: 90%;border: 1px solid #707070;">
            <table style="width: 100%;">

                <tr style="background-color: #3C9B61;">

                    <td style="padding: 10px;color:#FFFBFB ;">NOMBRE COMPLETO</td>

                    <td style="padding: 10px; color:#FFFBFB ;">SEMESTRE</td>

                    <td style="padding: 10px; color:#FFFBFB ;">ACCIONES</td>

                </tr>


                <?php

                $result = $conn->query("SELECT * FROM `studens_has_tutoring` WHERE `id_tutoring` LIKE '$id_tutoring'");
                while ($row = $result->fetch_assoc()) {

                    $id_student = $row['id_student'];
                    $student = $conn->query("SELECT * FROM `student` WHERE `id` LIKE '$id_student'")->fetch_assoc();
                ?>
                    <tr>
                        <td style="padding: 10px;"><?php echo ($student['name']); ?></td>
                        <td style="padding: 10px;"><?php echo ($student['semester']); ?></td>
                        <td style="padding: 10px;">
                            <div style="display: flex;flex-direction: row;">
                                <h4 style="padding-right: 5px;cursor: pointer;color: #0080FA;">Editar</h4> / <h4 style="padding-left: 5px;cursor: pointer;color: #0080FA;">Eliminar</h4>
                            </div>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </table>
        </div>
    </div>


    <div class="space"></div>

    <h3>Contenido: </h3>

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
    <div class="space"></div>
    <div style="width: 95%; display: flex; justify-content: flex-end;">
        <button style="padding: 5px; border-radius: 5px; cursor: pointer;" class="boton" onclick="messenger();">
            <h5>AGREGAR CONTENIDO TEORICO</h5>
        </button>
    </div>
</div>