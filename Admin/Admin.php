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
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
        }
        header, main, footer {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        header {
            background-color: #007BFF;
            color: white;
            text-align: center;
            padding: 10px 0;
        }
        h2 {
            text-align: center;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            margin: 10px 0;
        }
        a {
            text-decoration: none;
            color: #007BFF;
            font-size: 18px;
            display: block;
            padding: 10px;
            background-color: #e0e0e0;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        a:hover {
            background-color: #d0d0d0;
        }
    </style>
</head>
<body>
    <?php
    $pageHeader = "Administración del Sistema";
    include HEADER_URL;
    ?>
    <main>
        <h2>Seleccionar Área para Administrar</h2>
        <ul>
            <li><a href="personal/Personal.php">Administración de Personal</a></li>
            <li><a href="productos/productos.php">Administración de Productos</a></li>
        </ul>
    </main>
    <?php include FOOTER_URL; ?>
</body>
</html>
