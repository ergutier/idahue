<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/idahue/config.php';
include_once BASE_DR . 'Admin/Personal/PersBiz.php';
include_once BASE_DR . 'Roles/RolesBiz.php';

$persBiz = new PersBiz();
$rolesBiz = new RolesBiz();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = isset($_POST['nombre']) ? htmlspecialchars(strip_tags($_POST['nombre'])) : '';
    $fono = isset($_POST['fono']) ? htmlspecialchars(strip_tags($_POST['fono'])) : '';
    $rut = isset($_POST['rut']) ? htmlspecialchars(strip_tags($_POST['rut'])) : '';
    $ROL_id = isset($_POST['ROL_id']) ? array_map('htmlspecialchars', array_map('strip_tags', $_POST['ROL_id'])) : [];

    // Agregar persona
    $data = [
        'rut' => $rut,
        'nombre' => $nombre,
        'fono' => $fono
    ];

    try {
        $persBiz->addPersona($data);

        foreach ($ROL_id as $rol) {
            $roleData = [
                'PERSONA_rut' => $rut,
                'ROL_id' => $rol
            ];
            $persBiz->assignRole($roleData);
        }

        echo "<p>Persona y roles agregados exitosamente.</p>";
        header("Location: Personal.php"); // Redirigir de nuevo a la página de administración de personal
        exit;
    } catch (Exception $e) {
        echo "Error al agregar persona: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Nueva Persona</title>
    <link rel="stylesheet" href="path/to/styles.css"> <!-- Asegúrate de incluir el enlace correcto -->
</head>
<body>
    <main>
        <h2>Agregar Nueva Persona</h2>
        <form action="add_persona.php" method="post">
            <div class="form-group">
                <label for="rut">RUT:</label>
                <input type="text" name="rut" id="rut" required>
            </div>
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" id="nombre" required>
            </div>
            <div class="form-group">
                <label for="fono">Fono:</label>
                <input type="text" name="fono" id="fono" required>
            </div>
            <div class="form-group">
                <label for="ROL_id">Roles:</label>
                <select name="ROL_id[]" id="ROL_id" class="select-multiple" multiple required>
                    <?php
                    while ($row = $roles->fetch(PDO::FETCH_ASSOC)) {
                        echo "<option value='" . htmlspecialchars($row['id']) . "'>" . htmlspecialchars($row['nombre']) . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <button type="submit" class="button-primary">Agregar</button>
            </div>
        </form>
    </main>
</body>
</html>