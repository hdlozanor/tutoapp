<div class="tutorial_containert">
    <ul>
        <li>
            <?php
            if (!isset($conn)) {
                session_start();
                require_once '../Backend/conection.php';
            }
            if (isset($_SESSION['usuario'])) {

                $nombre = $_POST['nombre_tutoria'];

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
                $_SESSION['idst'] = $idtu;

            ?>
                <h3><?php echo ($nombre); ?></h3>
        </li>
        <li>
            <label></label>
        </li>

        <h4>Programa academico: </h4>
        <label class="labelre"><?php echo ($nameprogram); ?></label>

        <li>
            <label></label>
        </li>
        <li>
            <h4>Docente: </h4>
            <label class="labelre"><?php echo ($nameteacher); ?></label>
        </li>
        <li>
            <label></label>
        </li>
        <li style="display:inline;">
            <h4>Tipo de horario: </h4>
            <label class="labelre"><?php echo ($tipoh); ?></label>
        </li>
        <li>
            <label></label>
        </li>
        <li>
            <h4>Horario: </h4>
            <a target="_blank" href="<?php echo ($linkt); ?>">Click aqui!, visualizar horario</a>
        </li>
        <li>
            <label></label>
        </li>
        <li>
            <h4>Salon: </h4>
            <label class="labelre"><?php echo ($salont); ?></label>
        </li>
        <li>
            <label></label>
        </li>
        <li>
            <h4>Descripcion: </h4>
            <label class="labelre"><?php echo ($descriptiont); ?></label>
        </li>
        <li>
            <label></label>
        </li>
        <li>
            <h4>Estudiantes registrados: </h4>
            <br>
            <div id="main-container">
                <table>
                    <thead>
                        <tr>
                            <th>Identificacion</th>
                            <th>Nombre completo</th>
                            <th>Programa academico</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <?php
                    if (!isset($conn)) {
                        session_start();
                        require_once '../Backend/conection.php';
                    }
                    if (isset($_SESSION['usuario'])) {
                        $re = $conn->query("SELECT * FROM `studens_has_tutoring`");
                        while ($fila = $re->fetch_assoc()) {
                            $vari = $_SESSION['idst'];
                            if ($fila['id_tutoring'] == $vari) {
                                $idstudent = $fila['id_student'];
                                $result = $conn->query("SELECT * FROM `student` WHERE `id` LIKE '$idstudent' ")->fetch_assoc();
                                $idcar = $result['id_career'];
                                $ids = $result['identificacion'];
                                $names = $result['name'];
                                $careerconsul = $conn->query("SELECT * FROM `career` WHERE `id` LIKE '$idcar' ")->fetch_assoc();
                                $nameca = $careerconsul['name'];
                    ?>
                                <tr>
                                    <td><?php echo ($ids); ?></td>
                                    <td><?php echo ($names); ?></td>
                                    <td><?php echo ($nameca); ?></td>
                                    <td><h4 onclick='eliminar_estudiante("<?php echo ($nombre); ?>","<?php echo ($ids); ?>");'  style="padding-right: 5px;cursor: pointer;color: #0080FA;">Eliminar</h4></td>
                                </tr>

                    <?php
                            }
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
            <h4>Añadir estudiantes: </h4>
        </li>
        <li>

            <form method="POST">
                <li>
                    <label class="labelre">Id estudiante: </label>    
                    <input type="text" name="palabraa" id="palabraa" required>
                </li>    
                <li>
                    <button type="button" style="cursor:pointer;" class="boton" value="Buscar" onclick='rever();'>Buscar</button>    
                    <button type="button" style="cursor:pointer;" class="boton" value="Añadir" onclick='add();'>Añadir</button>
                </li>    
        <li>
            <label></label>
        </li>
        <li>
            <div id="ver"></div>
        </li>
        </form>
        </li>
        <li>
            <label></label>
        </li>
        <li>
            <?php
            $nombretuto=$_SESSION['name_tutoring'];
            ?>
       <button style="cursor:pointer;" type="submit" onclick='solicitudes_tutoria("<?php echo ($nombretuto); ?>");' value="Enviar" class="boton">Solicitudes a la tutoria</button>
     </li>
    <li>
            <label></label>
        </li>

    <li>
            <div id="vista2"></div>
        </li>

    </ul>
</div>
<?php
            }
?>
