<div class="tutorial_containert">
    <ul>
        <li>
            <div id="main-container">
                <table>
                    <thead>
                        <tr>
                            <th>Codigo SNIES</th>
                            <th>Nombre del programa</th>  
                            <th>Accion</th>   
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
                            
                            $nameprogram = $fila['name'];
                            $sniesprogram = $fila['snies'];
                            $id=$fila['id'];
                            
                            ?>
                                <tr>
                                    <td><?php echo($sniesprogram); ?></td>
                                    <td><?php echo($nameprogram); ?></td>
                                    <td onclick='ver_cursos(<?php echo($id) ?>);'  style="padding-right: 5px;cursor: pointer;color: #0080FA;" >ver</td>
                           </tr>
                           <?php
                        }
                        }
                    ?>

                </table>
            </div>
        </li>
    </ul>
</div>
