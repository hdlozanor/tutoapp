<header>
    <nav>
        <div id="masthead">
            <div class="contacto">
                <button> Contactanos </button>
            </div>
        </div>
        <div id="masthead2">
            <ul class="menu1">
                <li class="item1"><a href="#">Mis tutorias</a></li>
                <li class="item1"><a href="#">Tutorías activas</a></li>
                <li class="item1"><a href="#">Solicitar tutoría</a></li>
                <li class="item1"><a href="#">Tutoría en petición</a></li>
                <?php
                if (isset($_SESSION['usuario'])) {
                    ?>
                    <li class="item2 button2 icon"><a href="Tools/Backend/sing_off.php"><img src="IMG/cerrar-sesion3.png"
                                width="18px" height="18px"></a></li>
                    <li class="item2 button"><a href="#">
                            <?php echo ($_SESSION['usuario']['name']); ?><img src="IMG/usuario4.png" alt="" width="15px"
                                height="15px">
                        </a></li>

                    <li class="item2 button2 icon"><a href="Tools/Backend/sing_off.php"><img src="IMG/notificaciones.png"
                                width="18px" height="18px"></a></li>
                    <?php
                }
                ?>
                <li class="toggle"><a href="#"><i class="fas fa-bars"></i></a></li>
            </ul>
        </div>
    </nav>
    <script>
        $(function () {
            $(".toggle").on("click", function () {
                if ($(".item").hasClass("active")) {
                    $(".item").removeClass("active");
                    $(this).find("a").html("<i class='fas fa-bars'></i>");
                } else {
                    $(".item").addClass("active");
                    $(this).find("a").html("<i class='fas fa-times'></i>");
                }
            });
        });
    </script>
</header>