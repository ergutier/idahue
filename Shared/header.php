<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/idahue/config.php';
$page = isset($page) ? $page : '';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?php echo $pageHeader; ?></title>
    <link rel="stylesheet" href="<?php echo CSS_URL; ?>">
</head>
<body>
    <header>
        <a href="<?php echo BASE_URL; ?>/index.php">
            <img src="<?php echo IMG_L; ?>" alt="Logo">
        </a>
        <h1><?php echo $pageHeader; ?></h1>
		<nav class="nav-menu">
			<a href="<?php echo BASE_URL; ?>/index.php" class="<?php echo $page === 'inicio' ? 'active' : ''; ?>">Página Principal</a>
			<a href="<?php echo BASE_URL; ?>/Admin/admin.php" class="<?php echo $page === 'admin' ? 'active' : ''; ?>">Administración del Sistema</a>
			<a href="<?php echo BASE_URL; ?>/Fert/fertilizacion.php" class="<?php echo $page === 'fertilizacion' ? 'active' : ''; ?>">Registro de Fertilización</a>
			<a href="<?php echo BASE_URL; ?>/RepFert/reporte.php" class="<?php echo $page === 'reporte' ? 'active' : ''; ?>">Reporte de Fertilización</a>
			<a href="<?php echo BASE_URL; ?>/Roles/asignar_roles.php" class="<?php echo $page === 'asignar_roles' ? 'active' : ''; ?>">Asignar Roles a Usuarios</a>
		</nav>
    </header>

</body>
</html>
