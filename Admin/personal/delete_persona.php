<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/idahue/config.php';
include_once BASE_DR . 'Admin/Personal/PersBiz.php';

$page = 'delete_persona';
$persBiz = new PersBiz();

// Generar un nuevo token CSRF
$_SESSION['csrf_token'] = bin2hex(random_bytes(32));
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validar token CSRF
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        die("Token CSRF inválido.");
    }

    // Validar RUT
    if (isset($_POST['rut']) && !empty($_POST['rut'])) {
        $rut = htmlspecialchars(strip_tags($_POST['rut']));
        
        // Comprobar si la persona existe antes de eliminar
        $persona = $persBiz->getPersonaByRut($rut);
        if ($persona) {
            $persBiz->deletePersona($rut);
            echo "<p>Persona eliminada exitosamente.</p>";
        } else {
            echo "<p>La persona con RUT $rut no existe.</p>";
        }
    } else {
        echo "<p>Por favor, ingrese un RUT válido.</p>";
    }
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
        <form action="delete_persona.php" method="post" onsubmit="return confirm('¿Está seguro de que desea eliminar esta persona?');">
            <div class="form-group">
                <label for="rut">RUT de la Persona:</label>
                <input type="text" name="rut" id="rut" required>
            </div>
            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
            <div class="form-group">
                <button type="submit" class="button-primary">Eliminar</button>
            </div>
        </form>
    </main>
    <?php include FOOTER_URL; ?>
</body>
</html>