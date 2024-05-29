<?php
if (!isset($conn)) {
  session_start();
  require_once 'Tools/Backend/conection.php';
}
if (isset($_SESSION['usuario'])) {
  $result = $conn->query("SELECT * FROM `tutoring`");
  if(!isset($result)){
    ?>
    <div class="tutorial_container">
      <div class="tutorial_container_coumn_1">
        <h3 id="nombre_tu"> ¡Informacion! </h3>
        <p>Aun no hay tutorias activas en el sistemas </p>
      </div>
     
    </div>
    <?php
  }
  while ($row = $result->fetch_assoc()) {

    $id_tutoring = $row['id'];

    $result_tutoring = $conn->query("SELECT * FROM `tutoring` WHERE `id` LIKE '$id_tutoring'")->fetch_assoc();

    $id_teacher = $result_tutoring['id_teacher'];

    $result_teacher = $conn->query("SELECT * FROM `teacher` WHERE `id` LIKE '$id_teacher'")->fetch_assoc();

?>
    <div class="tutorial_container">
      <div class="tutorial_container_coumn_1">
        <h3 id="nombre_tu" onclick='activas("<?php echo ($row['name']); ?>");'><?php echo ($row['name']); ?> </h3>
        <p><?php echo ($row['description']); ?> </p>
      </div>
      <div class="tutorial_container_coumn_2">
        <h4><?php echo ($result_teacher['name']); ?> </h4>
      </div>
    </div>
<?php
  }
}
?>