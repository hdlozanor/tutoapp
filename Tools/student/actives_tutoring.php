<?php

session_start();
require_once '../Backend/conection.php';
$id_user = $_SESSION['usuario']['id_user'];
$student = $conn->query("SELECT * FROM `student` WHERE `id_user` LIKE '$id_user'")->fetch_assoc();

$id_career=$student['id_career'];
$id_student=$student['id'];

$result = $conn->query("SELECT * FROM `course` WHERE `id_career` LIKE '$id_career'");
while ($row = $result->fetch_assoc()) {

  $id_course = $row['id'];

  $result_tutoring = $conn->query("SELECT * FROM `tutoring` WHERE `id_course` LIKE '$id_course'");
  if ($result_tutoring) {
    $result_tutoring = $result_tutoring->fetch_assoc();
    $id_teacher = $result_tutoring['id_teacher'];
    $result_teacher = $conn->query("SELECT * FROM `teacher` WHERE `id` LIKE '$id_teacher'")->fetch_assoc();


?>
    <div class="tutorial_container">
      <div class="tutorial_container_coumn_1">
        <h3 onclick="open_my_tutoring(<?php echo($result_tutoring['id']);?>);" style="cursor: pointer;"><?php echo ($result_tutoring['name']); ?> </h3>
        <p><?php echo ($result_tutoring['description']); ?> </p>
      </div>
      <div class="tutorial_container_coumn_2">
        <h4><?php echo ($result_teacher['name']); ?> </h4>
        <br>
        <?php
        $id_tutoring=$result_tutoring['id'];
        $resgitrado_user = $conn->query("SELECT COUNT(*) total FROM `studens_has_tutoring` WHERE `id_tutoring` LIKE '$id_tutoring' AND `id_student` LIKE '$id_student'")->fetch_assoc();
        if($resgitrado_user['total']==0){
          $resgitrado_student_request_tutoring= $conn->query("SELECT COUNT(*) total FROM `student_request_tutoring` WHERE `id_tutoring` LIKE '$id_tutoring' AND `id_student` LIKE '$id_student'")->fetch_assoc();
          if($resgitrado_student_request_tutoring['total']==0){
            ?>
            <h5 onclick="register_student_request_tutoring(<?php echo($id_tutoring.','.$id_student);?>);">Solicitar</h5>
            <?php
          }else{
            ?>
            <h4>En proceso</h4>
            <?php
          }
        }else{
          ?>
          <h4>Registrado</h4>
          <?php
        }
        ?>
        
      </div>
    </div>
<?php
  }
}
?>


