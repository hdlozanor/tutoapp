<?php
session_start();
require_once '../Backend/conection.php';
$id_user = $_SESSION['usuario']['id_user'];

?>
<br>
<div style="width: 100%;">
    <h4 style="color: #707070;">Tutorías que solicite</h4>
</div>
<?php
$result = $conn->query("SELECT * FROM `request` WHERE `id_user` LIKE '$id_user'");
while ($row = $result->fetch_assoc()) {

    $id_request_tutoring = $row['id_request_tutoring'];

    $result_request_tutoring = $conn->query("SELECT * FROM `request_tutoring` WHERE `id` LIKE '$id_request_tutoring'")->fetch_assoc();

    $total_request_tutoring = $conn->query("SELECT  COUNT(*) total FROM `request` WHERE `id_request_tutoring` LIKE '$id_request_tutoring'")->fetch_assoc()['total'];

    //nombre estudiante creado
    $id_user_request_tutoring=$result_request_tutoring['id_user'];
    $student_name = $conn->query("SELECT `name` FROM `student` WHERE `id_user` LIKE '$id_user_request_tutoring'")->fetch_assoc()['name'];

?>
    <div class="tutorial_container">
        <div class="tutorial_container_coumn_1">
            <h3><?php echo ($result_request_tutoring['name']); ?> </h3>
            <div style="width: 100%;display: flex;flex-direction: row;">
                <p><?php echo ("Fecha de cración: " . $row['date']); ?></p>
                <div style="width: 15px;">
                </div>
                <p><?php echo ("Creado por: " . $student_name); ?></p>
            </div>
            <br>
            <p><?php echo ($result_request_tutoring['description']); ?> </p>
        </div>
        <div class="tutorial_container_coumn_2">
            <h4><?php echo ($total_request_tutoring . "/20 Estudantes registrados"); ?> </h4>
            <div style="height: 8px;">
            </div>
            <div style="width: 100%;display: flex;flex-direction: row; justify-content: space-between;">
                <h5 onclick="cancel_request(<?php echo ($id_request_tutoring); ?>);">DARME DE BAJA</h5>
                /
                <h5>COMPARTIR</h5>
            </div>

        </div>
    </div>
<?php
}
//Tutorías en peticion
?>
<br>
<div style="width: 100%;">
    <h4 style="color: #707070;">Tutorías en peticion</h4>
</div>
<?php

$student_id_career = $conn->query("SELECT `id_career` FROM `student` WHERE `id_user` LIKE '$id_user'")->fetch_assoc()['id_career'];

$result = $conn->query("SELECT `id` FROM `course` WHERE `id_career` LIKE '$student_id_career'");
$array_id_course_of_career = array();
$i = 0;

while ($row = $result->fetch_assoc()) {
    $array_id_course_of_career[$i++] = $row['id'];
}

for ($i = 0; $i < count($array_id_course_of_career); $i++) {

    $result = $conn->query("SELECT * FROM `request_tutoring` WHERE `id_course` LIKE '$array_id_course_of_career[$i]'");

    while ($row = $result->fetch_assoc()) {

        $id_user_request_tutoring = $row['id_user'];
        if ($id_user != $id_user_request_tutoring) {
            $id = $row['id'];

            $result_request_date = $conn->query("SELECT `date` FROM `request` WHERE `id_user` LIKE '$id_user_request_tutoring' AND `id_request_tutoring` LIKE '$id' ")->fetch_assoc()['date'];

            $total_request_tutoring = $conn->query("SELECT  COUNT(*) total FROM `request` WHERE `id_request_tutoring` LIKE '$id'")->fetch_assoc()['total'];
            //nombre estudiante creado
            $student_name = $conn->query("SELECT `name` FROM `student` WHERE `id_user` LIKE '$id_user_request_tutoring'")->fetch_assoc()['name'];

            //mirar si ya esta registrado
            $Exit_user_tutoring = $conn->query("SELECT  COUNT(*) total FROM `request` WHERE `id_request_tutoring` LIKE '$id' AND  `id_user` LIKE '$id_user'")->fetch_assoc()['total'];

?>

            <div class="tutorial_container">
                <div class="tutorial_container_coumn_1">
                    <h3><?php echo ($row['name']); ?> </h3>
                    <div style="width: 100%;display: flex;flex-direction: row;">
                        <p><?php echo ("Fecha de cración: " . $result_request_date); ?></p>
                        <div style="width: 15px;">
                        </div>
                        <p><?php echo ("Creado por: " . $student_name); ?></p>
                    </div>
                    <br>
                    <p><?php echo ($row['description']); ?> </p>
                </div>
                <div class="tutorial_container_coumn_2">
                    <h4><?php echo ($total_request_tutoring . "/20 Estudantes registrados"); ?> </h4>
                    <div style="height: 8px;">
                    </div>
                    <?php
                    if ($Exit_user_tutoring == 0) {
                    ?>
                        <h5 onclick="register_request(<?php echo ($id); ?>);">SOLICITAR</h5>
                    <?php
                    } else {
                    ?>
                        <h4>Solicitud realizada</h4>
                    <?php
                    }
                    ?>

                </div>
            </div>

<?php
        }
    }
}
?>