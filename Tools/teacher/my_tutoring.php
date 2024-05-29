<?php
session_start();
require_once '../Backend/conection.php';
$id_user = $_SESSION['usuario']['id_user'];
$id_teacher=$conn->query("SELECT `id` FROM `teacher` WHERE `id_user` LIKE '$id_user'")->fetch_assoc()['id'];
$result = $conn->query("SELECT * FROM `tutoring` WHERE `id_teacher` LIKE '$id_teacher'");
while ($row = $result->fetch_assoc()) {
?>
  <div class="tutorial_container">
    <div class="tutorial_container_coumn_1">
      <h3 onclick="open_tutoring_teacher(<?php echo($row['id']);?>);" style="cursor: pointer;"><?php echo ($row['name']); ?> </h3>
      <p><?php echo ($row['description']); ?> </p>
    </div>
    <div class="tutorial_container_coumn_2">
      <h4 onclick="open_tutoring_teacher(<?php echo($row['id']);?>);" style="cursor: pointer;color: #0080FA;">Abrir</h4>
    </div>
  </div>
<?php
}
?>
