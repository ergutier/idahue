<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/idahue/config.php';
include_once BASE_DR . 'Admin/AdminBiz.php';

$page = 'admin';
$adminBiz = new AdminBiz();
$tablas = $adminBiz->getTablas();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Administración del Sistema</title>
    <link rel="stylesheet" href="<?php echo CSS_URL; ?>">
</head>
<body>
    <?php
    $pageHeader = "Administración del Sistema";
    include HEADER_URL;
    ?>
    <main>
        <h2>Seleccionar Área para Administrar</h2>
        <ul>
            <li><a href="Personal/Personal.php">Administración de Personal</a></li>
            <li><a href="Productos/productos.php">Administración de Productos</a></li>
        </ul>
    </main>
    <?php include FOOTER_URL; ?>
</body>
</html>
