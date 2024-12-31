<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/idahue/config.php';
include_once BASE_DR . 'Admin/Personal/PersBiz.php';

$page = 'assign_role';
$persBiz = new PersBiz();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $rut = htmlspecialchars(strip_tags($_POST['rut']));
    $ROL_id = htmlspecialchars(strip_tags($_POST['ROL_id']));
    $data = [
        'PERSONA_rut' => $rut,
        'ROL_id' => $ROL_id
    ];
    $persBiz->assignRole($data);
    echo "<p>Rol asignado exitosamente.</p>";
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Asignar Rol</title>
    <link rel="stylesheet" href="<?php echo CSS_URL; ?>">
</head>
<body>
    <?php
    $pageHeader = "Asignar Rol a Persona";
    include HEADER_URL;
    ?>
    <main>
        <h2>Asignar Rol a Persona</h2>
        <form action="assign_role.php" method="post">
            <div class="form-group">
                <label for="rut">RUT de la Persona:</label>
                <input type="text" name="rut" id="rut" required>
            </div>
            <div class="form-group">
                <label for="ROL_id">Rol:</label>
                <select name="ROL_id" id="ROL_id" required>
                    <?php
                    $stmt = $persBiz->getRoles();
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<option value='" . htmlspecialchars($row['id']) . "'>" . htmlspecialchars($row['nombre']) . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <button type="submit" class="button-primary">Asignar Rol</button>
            </div>
        </form>
    </main>
    <?php include FOOTER_URL; ?>
</body>
</html>
