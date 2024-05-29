<?php
session_start();
require_once '../Backend/conection.php';
?>
<div class="container_request_tutoring">

    <div class="space"></div>

    <h4>Asignatura: </h4>

    <select id="id_course">
        <option value="0">Seleccione:</option>
        <?php
        $id_user = $_SESSION['usuario']['id_user'];
        $id_student = $conn->query("SELECT * FROM `student` WHERE `id_user` LIKE '$id_user'")->fetch_assoc()['id_career'];
        $result = $conn->query("SELECT * FROM `course` WHERE `id_career` LIKE '$id_student'");
        while ($row = $result->fetch_assoc()) {
            $id_course = $row['id'];
            $name_course = $row['name'];
        ?>
            <option value="<?php echo ($id_course); ?>"> <?php echo ($name_course); ?></option>
        <?php
        }
        ?>
    </select>

    <div class="space"></div>

    <h4> Descripcion temas:</h4>
    <textarea id="description" placeholder="Descripcion" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"></textarea>

    <div class="space"></div>

    <h4>Tema de la Tutoria: </h4>
    <input type="text" id="theme_tutoring" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" required>

    <div class="space"></div>
    <h4>Concepto de la Tutoria: </h4>
    <select id="concept">
        <option value="0">Seleccione:</option>
        <option value="dificultad">Dificultad</option>
        <option value="adquirir conocimiento">Adquirir conocimiento</option>

    </select>

    <div class="space"></div>
    <div class="btn_opcion">
        <button value="Cancelar" class="boton" onclick="close_cancelled();"><h5>Cancelar</h5></button>
        <button value="Enviar" class="boton" onclick="register_request_tutoring();" ><h5>Aceptar</h5></button>
    </div>
</div>