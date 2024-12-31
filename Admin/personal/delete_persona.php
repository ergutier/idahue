<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/idahue/config.php';
include_once BASE_DR . 'Admin/Personal/PersBiz.php';

$page = 'delete_persona';
$persBiz = new PersBiz();

if (isset($_POST['rut'])) {
    $rut = htmlspecialchars(strip_tags($_POST['rut']));
    $persBiz->deletePersona($rut);
    echo "<p>Persona eliminada exitosamente.</p>";
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Eliminar Persona</title>
    <link rel="stylesheet" href="<?php echo CSS_URL; ?>">
</head>
<body>
    <?php
    $pageHeader = "Eliminar Persona";
    include HEADER_URL;
    ?>
    <main>
        <h2>Eliminar Persona</h2>
        <form action="delete_persona.php" method="post">
            <div class="form-group">
                <label for="rut">RUT de la Persona:</label>
                <input type="text" name="rut" id="rut" required>
            </div>
            <div class="form-group">
                <button type="submit" class="button-primary">Eliminar</button>
            </div>
        </form>
    </main>
    <?php include FOOTER_URL; ?>
</body>
</html>
