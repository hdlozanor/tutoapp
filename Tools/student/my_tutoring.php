<?php
session_start();
require_once '../Backend/conection.php';
$id_user = $_SESSION['usuario']['id_user'];
$id_student=$conn->query("SELECT * FROM `student` WHERE `id_user` LIKE '$id_user'")->fetch_assoc()['id'];
$result = $conn->query("SELECT * FROM `studens_has_tutoring` WHERE `id_student` LIKE '$id_student'");
while ($row = $result->fetch_assoc()) {

  $id_tutoring = $row['id_tutoring'];

  $result_tutoring = $conn->query("SELECT * FROM `tutoring` WHERE `id` LIKE '$id_tutoring'")->fetch_assoc();

  $id_teacher = $result_tutoring['id_teacher'];

  $result_teacher = $conn->query("SELECT * FROM `teacher` WHERE `id` LIKE '$id_teacher'")->fetch_assoc();

?>
  <div class="tutorial_container">
    <div class="tutorial_container_coumn_1">
      <h3 onclick="open_my_tutoring(<?php echo($id_tutoring);?>);" style="cursor: pointer;"><?php echo($result_tutoring['name']); ?> </h3>
      <p><?php echo($result_tutoring['description']); ?> </p>
    </div>
    <div class="tutorial_container_coumn_2">
      <h4><?php echo($result_teacher['name']); ?> </h4>
    </div>
  </div>
<?php
}
?>
