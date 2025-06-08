<nav class="navbar navbar-expand-lg navbar-custom text-white w-100">
    <div class="container-fluid">
        <a class="navbar-brand logo text-white ms-3 fs-1" href="inicio.php">SPOT<span>LIFE</span></a>
        <div class="collapse navbar-collapse justify-content-end">
            <ul class="navbar-nav fs-4">
                <?php if($_SESSION['rol'] == 2 || $_SESSION['rol'] == 3) { ?>
                <li class="nav-item"><a class="nav-link text-white" href="inventario.php">Inventario</a></li>
                <?php } ?>
                
                <?php if ($_SESSION['rol'] == 1) {
                    ?>
                <li class="nav-item"><a class="nav-link text-white" href="listado_campanias.php">Campañas</a></li>
                <?php }elseif ($_SESSION['rol'] == 2){
                    ?>
                 <li class="nav-item"><a class="nav-link text-white" href="registrar_campania.php">Campañas</a></li>
                <?php } ?>
                <li class="nav-item"><a class="nav-link text-white" href="cita_menu.php">Donar</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="historial.php">Historial</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="solicitar_menu.php">Solicitar donantes</a>
                </li>
                <li class="nav-item"><a class="nav-link text-white" href="cerrar_sesion.php">Cerrar sesión</a></li>
            </ul>
        </div>
    </div>
</nav>