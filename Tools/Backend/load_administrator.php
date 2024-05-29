
<?php
session_start();
require_once 'conection.php';

if (isset($_SESSION['usuario'])) {
  //add programa
  $name_career = $_POST['name_career'];
  $codigo = $_POST['snies'];
  $id_login = $_SESSION['id_user'];

  //add asignatura
  $name_course = $_POST['name_course'];
  $id_carrera = $_POST['programas'];

  //add docente o estudiante
  $rol = $_POST['rol'];
  $nombrec = $_POST['name_completo'];
  $idenc = $_POST['identificacion'];
  $emailc = $_POST['email_completo'];
  $id_carrerae = $_POST['programas_e'];
  $passwordc = $_POST['password_completo'];

  //add tutoria
  $nombret = $_POST['name_tutoring'];
  $id_docentet = $_POST['docentes'];
  $id_courset = $_POST['asig_tutoring'];
  $descriptiont = $_POST['description'];
  $opcionh = $_POST['opcion_horario'];
  $link = $_POST['link'];
  $salon = $_POST['salon'];

  
  if (isset($name_career)) {
    $sql = "INSERT INTO career(id,snies,name,id_administrator) VALUES (default,'$codigo','$name_career', '$id_login')";

    if (mysqli_query($conn, $sql)) {
      header("location:../../administrator.php");
    } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
  } else if (isset($name_course)) {
    $sq = "INSERT INTO course(id,name,id_career) VALUES (default,'$name_course', '$id_carrera')";
    if (mysqli_query($conn, $sq)) {
      header("location:../../administrator.php");
    } else {
      echo "Error: " . $sq . "<br>" . mysqli_error($conn);
    }
  } else if (isset($nombrec)) {
    if ($rol == "docente") {

      $sq = "INSERT INTO user(id,email,password) VALUES (default,'$emailc', '$passwordc')";
      if (mysqli_query($conn, $sq)) {
        $us = $conn->query("SELECT * FROM user WHERE `email` LIKE '$emailc' ");
        $idc = $us->fetch_assoc()['id'];
        $sql = "INSERT INTO teacher(id,identificacion,name,id_user) VALUES (default,'$idenc','$nombrec', '$idc')";
        if (mysqli_query($conn, $sql)) {
          header("location:../../administrator.php");
        } else {
          echo "Error: " . $sq . "<br>" . mysqli_error($conn);
        }
      } else {
        echo "Error: " . $sq . "<br>" . mysqli_error($conn);
      }
    } else if ($rol == "estudiante") {
      $sq = "INSERT INTO user(id,email,password) VALUES (default,'$emailc', '$passwordc')";
      if (mysqli_query($conn, $sq)) {
      } else {
        echo "Error: " . $sq . "<br>" . mysqli_error($conn);
      }
      $us = $conn->query("SELECT * FROM user WHERE `email` LIKE '$emailc' ");
      $idc = $us->fetch_assoc()['id'];
      $sql = "INSERT INTO student(id,identificacion,name,id_career,id_user) VALUES (default,'$idenc','$nombrec', '$id_carrerae', '$idc')";
      if (mysqli_query($conn, $sql)) {
        header("location:../../administrator.php");
      } else {
        echo "Error: " . $sq . "<br>" . mysqli_error($conn);
      }
    }
  } else if (isset($nombret)) {
    
    //$sql = "INSERT INTO tutoring(id,name,description,id_teacher,id_course) VALUES (default,'$nombret','$descriptiont', '$id_docentet','$id_courset')";
    $sql="INSERT INTO `tutoring`(`id`, `name`, `description`, `id_teacher`, `id_course`) VALUES ('null','$nombret','$descriptiont','$id_docentet','$id_courset')";
    if (mysqli_query($conn, $sql)) {
    } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    $us = $conn->query("SELECT * FROM tutoring WHERE `name` LIKE '$nombret' ");
    $idt = $us->fetch_assoc()['id'];
    $sq = "INSERT INTO schedule(id,opening_date,closing_date,url_calendar,salon,type_schedule,id_tutoring) VALUES (default,NOW(),'null', '$link','null','$opcionh','$idt')";
    if (mysqli_query($conn, $sq)) {
      header("location:../../administrator.php");
    } else {
      echo "Error: " . $sq . "<br>" . mysqli_error($conn);
    }
  }

}


mysqli_close($conn);

