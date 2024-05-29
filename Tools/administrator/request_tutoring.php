<!-- el resultado de la búsqueda lo encapsularemos en un tabla -->
<table width="40%" border="0" align="rigth" cellpadding="1" cellspacing="1">
    <thead>
        <tr>
            <!--creamos los títulos de nuestras dos columnas de nuestra tabla -->
            <td width="100" align="center"><strong>Identificacion</strong></td>
            <td width="100" align="center"><strong>Nombre</strong></td>
            <td width="100" align="center"><strong>Programa</strong></td>
            <td width="100" align="center"><strong>Accion</strong></td>
        </tr>
    </thead>
    <?php
    if (!isset($conn)) {
        session_start();
        require_once '../Backend/conection.php';
    }
    if (isset($_SESSION['usuario'])) {
        $buscar = $_POST["nametutori"];

        $resul = $conn->query("SELECT * FROM `tutoring` WHERE `name` LIKE '$buscar' ")->fetch_assoc();
        $idd = $resul['id'];
        $result = $conn->query("SELECT * FROM `student_request_tutoring` ");
        if (isset($result)) {
            while ($fila = $result->fetch_assoc()) {
                if ($fila['id_tutoring'] == $idd) {
                    $idstudent = $fila['id_student'];
                    $resu = $conn->query("SELECT * FROM `student` WHERE `id` LIKE '$idstudent' ")->fetch_assoc();
                    $idcar = $resu['id_career'];
                    $ids = $resu['identificacion'];
                    $names = $resu['name'];
                    $careerconsul = $conn->query("SELECT * FROM `career` WHERE `id` LIKE '$idcar' ")->fetch_assoc();
                    $nameca = $careerconsul['name'];
    ?>
                    <tr>
                        <td align="center" id="identificacions"><?php echo ($ids); ?></td>
                        <td align="center"><?php echo ($names); ?></td>
                        <td align="center"><?php echo ($nameca); ?></td>
                        <td align="center"> <h4  onclick='aprobar("<?php echo ($idstudent); ?>","<?php echo ($idd); ?>","<?php echo ($buscar); ?>"); return null;'  style="padding-right: 5px;cursor: pointer;color: #0080FA;">Añadir</h4> </td>

                    </tr>


    <?php
                }
            }
        }
    }
    ?>
</table>