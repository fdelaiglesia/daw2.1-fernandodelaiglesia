<nav class="navbar navbar-dark bg-danger">
    <a id="agenda" class="navbar-brand">Videoclub</a>
    <?php if (isset($_SESSION['usuario'])) { ?>
        <p id="usuario" class="my-2 my-sm-0 mr-sm-2"><?= $_SESSION["usuario"] ?></p>

        <a id="logout" href="logout.php" class="btn btn-secondary">
            <img src="assets/img/logout.png" width="20" height="20">
            Cerrar sesion</a>
    <?php } ?>
</nav>