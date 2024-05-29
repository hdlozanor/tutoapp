<div class="tutorial_containert">
    <ul>
        <li>
            <div id="main-container">
                <table>
                    <thead>
                        <tr>
                            <th>Nombre de la asignatura</th>  
                            <th>Accion</th>   
                        </tr>
                    </thead>
                    <?php
                    if (!isset($conn)) {
                        session_start();
                        require_once '../Backend/conection.php';
                    }
                    if (isset($_SESSION['usuario'])) 
                    {
                        $idcarrera=$_POST['idcarrer'];
                        $re = $conn->query("SELECT * FROM `course`");
                        while ($fila = $re->fetch_assoc()) {  
                            if($fila['id_career']==$idcarrera){

                            
                            $nameprogram = $fila['name'];
                            $id=$fila['id'];
                            
                            ?>
                                <tr>
                                    <td><?php echo($nameprogram); ?></td>
                                    <td onclick='ver_tutorias(<?php echo($id) ?>);'  style="padding-right: 5px;cursor: pointer;color: #0080FA;" >ver</td>
                           </tr>
                           <?php
                            }
                        }
                        }
                    ?>

                </table>
            </div>
        </li>
    </ul>
</div>