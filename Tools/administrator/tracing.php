<div class="tutorial_containert">
    <ul>
        <li>
            <?php
            if (!isset($conn)) {
                session_start();
                require_once '../Backend/conection.php';
            }
            if (isset($_SESSION['usuario'])) {
                $cant=0;
/*                 $nombre = $_POST['nombre_tutoria'];

                $sql = $conn->query("SELECT * FROM `tutoring` WHERE `name` LIKE '$nombre' ")->fetch_assoc();
                $idcourse = $sql['id_course'];
                $_SESSION['name_tutoring'] = $sql['name'];
                $iddocente = $sql['id_teacher'];
                $descriptiont = $sql['description'];
                $idtu = $sql['id'];
                $horariot = $conn->query("SELECT * FROM `schedule` WHERE `id_tutoring` LIKE '$idtu' ")->fetch_assoc();
                $tipoh = $horariot['type_schedule'];
                if ($tipoh == 'virtual') {
                    $salont = 'No necesario';
                } else {
                    $salont = $horariot['salon'];
                }
                $linkt = $horariot['url_calendar'];
                $teacher = $conn->query("SELECT * FROM `teacher` WHERE `id` LIKE '$iddocente' ")->fetch_assoc();
                $nameteacher = $teacher['name'];

                $asig = $conn->query("SELECT * FROM `course` WHERE `id` LIKE '$idcourse' ")->fetch_assoc();
                $idcareer = $asig['id_career'];
                $programa = $conn->query("SELECT * FROM `career` WHERE `id` LIKE '$idcareer' ")->fetch_assoc();
                $nameprogram = $programa['name'];
                $_SESSION['idst'] = $idtu; */
            ?>
                 <!-- <h3><?php echo ($nombre); ?></h3>  -->
            <br>
            <div id="main-container">
                <table>
                    <thead>
                        <tr>
                            <th>Nombre Universidad</th>
                            <th>Programas con la estrategia de tutoria</th>
                        </tr>
                    </thead>
                    <?php
                    if (!isset($conn)) {
                        session_start();
                        require_once '../Backend/conection.php';
                    }
                    if (isset($_SESSION['usuario'])) {
                        $re = $conn->query("SELECT * FROM `career`");
                        while ($fila = $re->fetch_assoc()) {  
                            $cant=$cant+1;

                            }
                            ?>
                                <tr>
                                    <td>UNIVERSIDAD DISTRITAL FRANCISCO JOSE DE CALDAS</td>
                                    <td onclick='ver_programas();'  style="padding-right: 5px;cursor: pointer;color: #0080FA;" ><?php echo ($cant); ?></td>
                                 </tr>
                    <?php
                        }
                    }
                    ?>

                </table>
            </div>
        </li>
        <li>
            <label></label>
        </li>

        <li>
            <div id="tracing"></div>
        </li>

        </li>

    <li>
            <label></label>
        </li>

    <li>
            <div id="tracing2"></div>
        </li>

        <li>
            <label></label>
        </li>

    <li>
            <div id="tracing3"></div>
        </li>

        <li>
            <label></label>
        </li>

    <li>
            <div id="tracing4"></div>
        </li>


    </ul>
</div>