
<?php
session_start();
require_once 'conection.php';

if (isset($_SESSION['usuario'])) {
  
  $nombrecx = $_POST['name_completox'];
  $idencx = $_POST['identificacionx'];
  $emailcx = $_POST['email_completox'];
  $semestre_ex = $_POST['semestre_ex'];
  $id_carreraex = $_POST['programas_ex'];
  $passwordcx = $_POST['password_completox'];
 
  $idestu = $_POST['identificacions'];
  $idestue = $_POST['identificacione'];

  //aprobar en la tutoria
  $idestudiante=$_POST['id_estudentt'];
  $idtutoria=$_POST['id_tutoriatt'];

   if (isset($nombrecx) ){
     $sq = "INSERT INTO user(id,email,password) VALUES (default,'$emailcx', '$passwordcx')";
     if (mysqli_query($conn, $sq)) {
     } else {
       echo "Error: " . $sq . "<br>" . mysqli_error($conn);
     }
     $us = $conn->query("SELECT * FROM user WHERE `email` LIKE '$emailcx' ");
     $idc = $us->fetch_assoc()['id'];
     $sql = "INSERT INTO student(id,identificacion,name,semester,id_career,id_user) VALUES (default,'$idencx','$nombrecx','$semestre_ex','$id_carreraex', '$idc')";
     if (mysqli_query($conn, $sql)) {
     } else {
       echo "Error: " . $sql . "<br>" . mysqli_error($conn);
     }
     $usa = $conn->query("SELECT * FROM student WHERE `identificacion` LIKE '$idencx' ");
     $idca = $usa->fetch_assoc()['id'];
     $vara=$_SESSION['idst'];
     $sqla = "INSERT INTO studens_has_tutoring(id,id_student,id_tutoring) VALUES (default,'$idca','$vara')";
     if (mysqli_query($conn, $sqla)) {
     } else {
       echo "Error: " . $sqla . "<br>" . mysqli_error($conn);
     }
   }else if(isset($idestue)){
    $use= $conn->query("SELECT * FROM student WHERE `identificacion` LIKE '$idestue' ");
     $idd = $use->fetch_assoc()['id'];
    $sqle=$conn->query("DELETE FROM studens_has_tutoring WHERE `id_student` LIKE '$idd' ");
    if (mysqli_query($conn, $sqle)) {
    } else {
      echo "Error: " . $sqle . "<br>" . mysqli_error($conn);
    }
   }else if(isset($idestudiante)){
    
    $sqla = "INSERT INTO studens_has_tutoring(id,id_student,id_tutoring) VALUES (default,'$idestudiante','$idtutoria')";
    if (mysqli_query($conn, $sqla)) {
    } else {
      echo "Error: " . $sqla . "<br>" . mysqli_error($conn);
    }
    $sq = $conn->query("DELETE FROM `student_request_tutoring` WHERE `id_student` LIKE '$idestudiante' AND `id_tutoring` LIKE '$idtutoria'");
  
   }else{
    $usa = $conn->query("SELECT * FROM student WHERE `identificacion` LIKE '$idestu' ");
    $idca = $usa->fetch_assoc()['id'];
    $vara=$_SESSION['idst'];
    $sqla = "INSERT INTO studens_has_tutoring(id,id_student,id_tutoring) VALUES (default,'$idca','$vara')";
    if (mysqli_query($conn, $sqla)) {
    } else {
      echo "Error: " . $sqla . "<br>" . mysqli_error($conn);
    }
   }
}

mysqli_close($conn);
