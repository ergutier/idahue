<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/idahue/config.php';
include_once BASE_DR . 'Admin/Personal/PersBiz.php';

$page = 'edit_persona';
$persBiz = new PersBiz();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $rut = htmlspecialchars(strip_tags($_POST['rut']));
    $nombre = htmlspecialchars(strip_tags($_POST['nombre']));
    $fono = htmlspecialchars(strip_tags($_POST['fono']));
    $persona = [
        'rut' => $rut,
        'nombre' => $nombre,
        'fono' => $fono
    ];
    $persBiz->updatePersona($persona);
    echo "<p>Persona actualizada exitosamente.</p>";
} elseif (isset($_GET['rut'])) {
    $rut = htmlspecialchars(strip_tags($_GET['rut']));
    $stmt = $persBiz->getPersonas();
    $persona = null;
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        if ($row['rut'] === $rut) {
            $persona = $row;
            break;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Persona</title>
    <link rel="stylesheet" href="<?php echo CSS_URL; ?>">
</head>
<body>
    <?php
    $pageHeader = "Editar Persona";
    include HEADER_URL;
    ?>
    <main>
        <h2>Editar Persona</h2>
        <?php if ($persona) { ?>
            <form action="edit_persona.php" method="post">
                <div class="form-group">
                    <label for="rut">RUT:</label>
                    <input type="text" name="rut" id="rut" value="<?php echo htmlspecialchars($persona['rut']); ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="nombre">Nombre:</label>
                    <input type="text" name="nombre" id="nombre" value="<?php echo htmlspecialchars($persona['nombre']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="fono">Fono:</label>
                    <input type="text" name="fono" id="fono" value="<?php echo htmlspecialchars($persona['fono']); ?>" required>
                </div>
                <div class="form-group">
                    <button type="submit" class="button-primary">Actualizar</button>
                </div>
            </form>
        <?php } else { ?>
            <p>Persona no encontrada.</p>
        <?php } ?>
    </main>
    <?php include FOOTER_URL; ?>
</body>
</html>
