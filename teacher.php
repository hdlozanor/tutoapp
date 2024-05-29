<?php
session_start();
if (!isset($_SESSION['usuario'])) {
  header('Location: index.php');
} elseif ($_SESSION['usuario']['rol']!='teacher' ) {
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
    <title>TUTOAPP |  Profesor</title>
    <link rel="stylesheet" href="CSS/student.css">
    <link rel="stylesheet" href="CSS/diseño.css">
  </head>

  <body>
    <header id="header">
      <!-- Se incluye la barra de navegacion | INICIO -->
      <?php
      include 'Tools/global structure/headertutor.php';
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
              <h3 class="active" id="btn_0" onclick="Opciones_teacher();">Mis Tutorías</h3>
            </div>

          </div>

          <!-- Contenedor Tutorias -->
          <div class="secondary_container" id="secondary_container">
            <?php
            require_once 'Tools/Backend/conection.php';
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

