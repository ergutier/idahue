<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/idahue/config.php';
$page = 'inicio';
?>
<!DOCTYPE html>
<html lang="es">

<body>
    <?php
    $pageHeader = "Inicio";
    include HEADER_URL;
    ?>
    <div class="main-content">
        <section class="welcome-section">
            <h2>Bienvenido a Exportadora Idahue</h2>
            <p>Utilice el menú de navegación para acceder a las diferentes secciones del sistema.</p>
        </section>
    </div>
    <?php include FOOTER_URL; ?>
</body>
</html>
