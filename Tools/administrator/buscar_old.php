<?php
  if (!isset($conn)) {
    session_start();
    require_once '../Backend/conection.php';
}
if (isset($_SESSION['usuario']) && $_POST["palabra"]!="") {  
    
    $buscar = $_POST["palabra"];
     
    $resul = $conn->query("SELECT * FROM `student` WHERE `identificacion` LIKE '$buscar' ")->fetch_assoc();
    
    $idd=$resul['id_career'];

    $result = $conn->query("SELECT * FROM `career` WHERE `id` LIKE '$idd' ")->fetch_assoc();
       
      if(!isset($result)){
        ?>
        <li>
                <h4>El estudiante no existe - Añadir a la tutoria y al sistema: </h4>
            </li>
            <li>
                <form  method="POST">
                    <ul>
                        <li>
                            <label class="labelre">Identificacion: </label>
                            <input type="number" id="identificacionx" name="identificacionx"  required>
                        </li>
                        <li>
                            <label class="labelre">Nombre completo: </label>
                            <input type="text" id="name_completox" name="name_completox" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                        </li>
                        <li>
                            <label class="labelre">Programa academico:</label>
                            <select id="programas_ex" name="programas_ex">
                                <option value="0">Seleccione:</option>

                                <?php
                                if (!isset($conn)) {
                                    session_start();
                                    require_once '../Backend/conection.php';
                                }
                                if (isset($_SESSION['usuario'])) {
                                    $id = $_SESSION['id_user'];
                                    $result = $conn->query("SELECT * FROM `career` WHERE `id_administrator` LIKE '$id' ");
                                    var_dump($result);
                                    while ($fila = $result->fetch_assoc()) {
                                        $idc = $fila['id'];
                                        $namec = $fila['name'];
                                ?>
                                        <option value="<?php echo ($idc); ?>"> <?php echo ($namec); ?></option>
                                <?php
                                    }
                                }
                                ?>

                            </select>
                        </li>
                        <li>
                            <label class="labelre">Correo electronico: </label>
                            <input type="text" id="email_completox" name="email_completox" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                        </li>
                        <li>
                            <label class="labelre">Contraseña: </label>
                            <input type="text" id="password_completox" name="password_completox" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                        </li>
                        <li>
                        <button type="submit" onclick='new_estudiante_us_tutoria("<?php echo($_SESSION['name_tutoring']); ?>");' value="Enviar" class="boton">Agregar</button>
                        </li>
                    </ul>
                </form>
        <?php
      }else{
   ?>

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
           <tr>
               <td  align="center" id="identificacions"><?php echo($resul['identificacion']); ?></td>
               <td  align="center"><?php echo($resul['name']); ?></td>
               <td  align="center"><?php echo($result['name']); ?></td>
               <td  align="center"><h4 onclick='new_estudiante_a_tutoria("<?php echo($_SESSION['name_tutoring']); ?>","<?php echo($resul['identificacion']); ?>"); return null;'   style="padding-right: 5px;cursor: pointer;color: #0080FA;">Añadir</h4> </td>
                        
           </tr> 
   
    </table>
    <?php 
      }
} // fin if 
?>