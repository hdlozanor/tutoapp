<?php
session_start();
if (!isset($_SESSION['usuario'])) {
  header('Location: index.php');
} elseif ($_SESSION['usuario']['rol']!='administrator' ) {
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
    <title>TUTOAPP |  Administrador</title>
    <link rel="stylesheet" href="CSS/administrator.css">
    <link rel="stylesheet" href="CSS/diseño.css">


  </head>

  <body>
    <header>
      <!-- Se incluye la barra de navegacion | INICIO -->
      <?php
      include 'Tools/global structure/headeradmin.php';
      ?>
      <!-- Se incluye la barra de navegacion | INICIO -->
    </header>
    <main>

      <!-- Contenedor de todo -->
      <div class="container_teacher">

        <!-- Contenedor del Menú General -->
        <div class="main_container">

          <div class="general_menu_title">
            <h3>Menú General</h3>

            <!-- <h2> Sesion: <?php echo $_SESSION['usuario']['rol']; ?> </h2> -->
          </div>

          <div class="tab">

            <div class="tab_title">
              <h3 class="active" id="btn_0" onclick="administrator();">Tutoría Activas</h3>
            </div>

            <div class="tab_title">
              <h3 class="deactivate" id="btn_1" onclick="Opciones(1);">Nueva Tutorías</h3>
            </div>


            <div class="tab_title">
              <h3 class="deactivate" id="btn_2" onclick="Opciones(2);">Seguimiento</h3>
            </div>

            <div class="tab_title">
              <h3 class="deactivate" id="btn_3" onclick="Opciones(3);">Administrador</h3>
            </div>

          </div>

          <!-- Contenedor nueva Tutoria -->
          <div class="new_tutorials">

            <div id="vista">
              <?php
              if (!isset($conn)) {
                //session_start();
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
    <script src="JS/menu_tab_administrator.js"></script>
    <!-- Scripts -->
    <!-- Se Incluyen los Archivos de tipo JavaScrip | FIN -->
  </body>

  </html>
<?php
  mysqli_close($conn);
}
?>