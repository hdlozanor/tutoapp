<?php
  if (!isset($conn)) {
    session_start();
    require_once '../Backend/conection.php';
}
if (isset($_SESSION['usuario']) && $_POST["palabra"]!="") {  
    
    $buscar = $_POST["palabra"];
     
    $resul = $conn->query("SELECT * FROM `student` WHERE `identificacion` LIKE '$buscar' ")->fetch_assoc();
    
    if(isset($resul['id_career'])){

        $idd=$resul['id_career'];

        $result = $conn->query("SELECT * FROM `career` WHERE `id` LIKE '$idd' ")->fetch_assoc();

        ?>
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
                <tr>
                    <td  align="center" id="identificacions"><?php echo($resul['identificacion']); ?></td>
                    <td  align="center"><?php echo($resul['name']); ?></td>
                    <td  align="center"><?php echo($result['name']); ?></td>
                    <td  align="center"><h4 onclick='new_estudiante_a_tutoria("<?php echo($_SESSION['name_tutoring']); ?>","<?php echo($resul['identificacion']); ?>"); return null;'   style="padding-right: 5px;cursor: pointer;color: #0080FA;">Añadir</h4> </td>          
                </tr> 
        </table>
        <?php
    }else {
        ?>
        <li>
                <h4>El estudiante no existe - Añadir a la tutoria y al sistema: </h4>
            </li>
        <?php
    }
}
?>