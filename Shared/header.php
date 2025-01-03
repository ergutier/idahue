<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?php echo $pageHeader; ?></title>
    <link rel="stylesheet" href="<?php echo CSS_URL; ?>">
</head>
<body>
    <header>
        <div class="header-content">
            <h1>Administración del Sistema</h1>
            <img src="<?php echo IMG_L; ?>" alt="Logo">
        </div>
        <nav class="nav-menu">
            <a href="<?php echo BASE_URL; ?>/index.php">Inicio</a>
            <a href="<?php echo BASE_URL; ?>/Fert/fertilizacion.php">Registro de Fertilización</a>
            <a href="<?php echo BASE_URL; ?>/RepFert/reporte.php">Reporte de Fertilización</a>
            <div class="dropdown">
                <a href="#">Admin</a>
                <div class="submenu">
                    <a href="<?php echo BASE_URL; ?>/Admin/Personal/Personal.php">Gestionar Personal</a>
                    <a href="<?php echo BASE_URL; ?>/Admin/Productos/productos.php">Gestionar Productos</a>
                </div>
            </div>
        </nav>
    </header>
