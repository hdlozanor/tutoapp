<div class="tutorial_containert">
    <ul>
        <li>
            <div id="main-container">
                <table>
                    <thead>
                        <tr>
                            <th>Nombre de la tutoria</th>  
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
                        $idc=$_POST['idcu'];
                        $re = $conn->query("SELECT * FROM `tutoring`");
                        while ($fila = $re->fetch_assoc()) {  
                            if($fila['id_course']==$idc){
                            
                            $nametu = $fila['name'];
                            $id=$fila['id'];
                            
                            ?>
                                <tr>
                                    <td><?php echo($nametu); ?></td>
                                    <td onclick='activas2("<?php echo($nametu); ?>")' style="padding-right: 5px;cursor: pointer;color: #0080FA;"  >ver</td>
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