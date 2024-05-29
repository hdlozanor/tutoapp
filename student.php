<?php
session_start();
if (!isset($_SESSION['usuario'])) {
  header('Location: index.php');
} elseif ($_SESSION['usuario']['rol']!='student' ) {
  header('Location: '.$_SESSION['usuario']['rol'].'.php');
} else {

?>

  <!DOCTYPE html>
  <html lang="en">
  <!-- hola como vamos-->

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TUTOAPP |  Estudinate</title>
    <link rel="stylesheet" href="CSS/student.css">
    <link rel="stylesheet" href="CSS/diseño.css">
  </head>

  <body>
    <header id="header">
      <!-- Se incluye la barra de navegacion | INICIO -->
      <?php
      include 'Tools/global structure/headerest.php';
      ?>
      <!-- Se incluye la barra de navegacion | INICIO -->
    </header>
    <main>

      <!-- Contenedor de todo -->
      <div class="container_student">

        <!-- Contenedor del Menú General -->
        <div class="main_container">

          <div class="general_menu_title">
            <h3>Menú General</h3>
          </div>

          <div class="tab">

            <div class="tab_title">
              <h3 class="active" id="btn_0" onclick="Opciones(0);">Mis Tutorías</h3>
            </div>

            <div class="tab_title">
              <h3 class="deactivate" id="btn_1" onclick="Opciones(1);">Tutoría Activas</h3>
            </div>

            <div class="tab_title">
              <h3 class="deactivate" id="btn_2" onclick="Opciones(2);">Solicitar tutoría</h3>
            </div>

            <div class="tab_title">
              <h3 class="deactivate" id="btn_3" onclick="Opciones(3);">Tutoría en petición </h3>              
            </div>


          </div>

          <!-- Contenedor Tutorias -->
          <div class="secondary_container" id="secondary_container">
            <?php
            require_once 'Tools/Backend/conection.php';
            $id_user = $_SESSION['usuario']['id_user'];
            $id_student = $conn->query("SELECT * FROM `student` WHERE `id_user` LIKE '$id_user'")->fetch_assoc()['id'];
            $result = $conn->query("SELECT * FROM `studens_has_tutoring` WHERE `id_student` LIKE '$id_student'");
            while ($row = $result->fetch_assoc()) {

              $id_tutoring = $row['id_tutoring'];

              $result_tutoring = $conn->query("SELECT * FROM `tutoring` WHERE `id` LIKE '$id_tutoring'")->fetch_assoc();

              $id_teacher = $result_tutoring['id_teacher'];

              $result_teacher = $conn->query("SELECT * FROM `teacher` WHERE `id` LIKE '$id_teacher'")->fetch_assoc();

            ?>
              <div class="tutorial_container">
                <div class="tutorial_container_coumn_1">
                  <h3 onclick="open_my_tutoring(<?php echo ($id_tutoring); ?>);" style="cursor: pointer;"><?php echo ($result_tutoring['name']); ?> </h3>
                  <p><?php echo ($result_tutoring['description']); ?> </p>
                </div>
                <div class="tutorial_container_coumn_2">
                  <h4><?php echo ($result_teacher['name']); ?> </h4>
                </div>
              </div>
            <?php
            }
            ?>

          </div>
        </div>
      </div>

    </main>

    <?php
    include 'Tools/global structure/footer2.php';
    ?>

    <!-- Scripts -->
    <!-- Se Incluyen los Archivos de tipo JavaScrip | INICIO -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/35db202371.js"></script>
    <script src="JS/menu_tab.js"></script>
    <!-- Scripts -->
    <!-- Se Incluyen los Archivos de tipo JavaScrip | FIN -->
  </body>

  </html>
<?php
  mysqli_close($conn);
}
?>