<?php
session_start();
require_once 'conection.php';

if (isset($_POST)) {

    $email = $_POST['email'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM `user` WHERE `email` LIKE '$email' AND `password` LIKE '$password'";
    //$sql="SELECT * FROM `account` WHERE `email` LIKE 'asarabias@unicesar.edu.co' AND `password` LIKE '12345'";
    $login = mysqli_query($conn, $sql);

    if ($login && mysqli_num_rows($login) == 1) {

        $id_login = $login->fetch_assoc()['id'];

        $person = $conn->query("SELECT COUNT(*) total FROM `student` WHERE `id_user` LIKE '$id_login' ");
        $name = "";
        $users="";
        if ($person->fetch_assoc()['total']==1) {
            $users="`student`";
        } else {
            $person = $conn->query("SELECT COUNT(*) total FROM `administrator` WHERE `id_user` LIKE '$id_login' ");
            if ($person->fetch_assoc()['total']==1) {
                $users="`administrator`";
            } else {
                $users="`teacher`";
            }
        }
        $person = $conn->query("SELECT * FROM $users WHERE `id_user` LIKE '$id_login' ");
        $name = $person->fetch_assoc()['name'];

        $_SESSION['usuario'] = [
            'id_user' => $id_login,
            'email' => $email,
            'password' => $password,
            'name' => $name,
            'rol' => substr($users,1,(strlen($input)-1)),
        ];
        $_SESSION['id_user'] = $id_login;

         switch ($users) {
            case "`student`":
                header('location: ../../student.php');
                break;
             case "`teacher`":
                header('location: ../../teacher.php');
                break;
             case "`administrator`":
                header('location: ../../administrator.php');
                break;
         }
       
        
    } else {
        $_SESSION['error_login'] = "login incorrecto";
        echo '<script type="text/javascript">
            alert("No registrado");
            window.location.href="../../index.php";
            </script>';
    }
}
mysqli_close($conn);