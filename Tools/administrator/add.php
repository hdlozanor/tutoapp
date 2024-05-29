<?php
  if (!isset($conn)) {
    session_start();
    require_once '../Backend/conection.php';
}
if (isset($_SESSION['usuario'])) {  
        ?>
        <li>
                <h4>Añadir estudiante a la tutoria y al sistema: </h4>
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
                            <label class="labelre">Semestre: </label>
                            <input type="text" id="semestre_ex" name="semestre_ex" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
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
      }
?>