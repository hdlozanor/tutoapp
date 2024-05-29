<header>

    <nav>
        <div id="masthead">
            <div class="contacto">
                <button> Contactanos </button>
            </div>
        </div>
        <div id="masthead2">
            <ul class="menu1">
                    <li class="item1"><a href="#">Inicio</a></li>
                    <li class="item1"><a href="#">Nosotros</a></li>
                    <li class="item1"><a href="#">Servicios</a></li>
                    <li class="item1"><a href="#">Blog</a></li>
                    <li class="item1"><a href="#">Contáctenos</a></li>
                    <li class="item2 button secondary"><a href="Tools/Backend/sing_off.php">Registro</a></li>
                    <li class="item2 button"><a href="#">Inicio Sesion</a></li>                    
                    <li class="toggle"><a href="#"><i class="fas fa-bars"></i></a></li>
            </ul>
        </div>
    </nav>
    <script>
        $(function () {
            $(".toggle").on("click", function () {
                if ($(".item1").hasClass("active")) {
                    $(".item1").removeClass("active");
                    $(this).find("a").html("<i class='fas fa-bars'></i>");
                } else {
                    $(".item1").addClass("active");
                    $(this).find("a").html("<i class='fas fa-times'></i>");
                }
            });
        });
    </script>
</header>