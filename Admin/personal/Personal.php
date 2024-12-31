<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/idahue/config.php';
include_once BASE_DR . 'Admin/Personal/PersBiz.php';
include_once BASE_DR . 'Roles/RolesBiz.php';

$persBiz = new PersBiz();
$rolesBiz = new RolesBiz();
$personas = $persBiz->getPersonas();
$roles = $rolesBiz->getRoles();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
    $fono = isset($_POST['fono']) ? $_POST['fono'] : '';
    $rut = isset($_POST['rut']) ? $_POST['rut'] : '';
    $ROL_id = isset($_POST['ROL_id']) ? $_POST['ROL_id'] : '';

    if (isset($_POST['action']) && $_POST['action'] == 'delete') {
        // Eliminar persona
        $persBiz->deletePersona($rut);
        echo "<p>Persona eliminada exitosamente.</p>";
    } else {
        // Agregar persona
        $data = [
            'rut' => $rut,
            'nombre' => $nombre,
            'fono' => $fono
        ];

        $persBiz->addPersona($data);

        foreach ($ROL_id as $rol) {
            $roleData = [
                'PERSONA_rut' => $rut,
                'ROL_id' => htmlspecialchars(strip_tags($rol))
            ];
            $persBiz->assignRole($roleData);
        }

        echo "<p>Persona y roles agregados exitosamente.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Administración de Personal</title>
    <link rel="stylesheet" href="<?php echo CSS_URL; ?>">
</head>
<body>
    <?php
    $pageHeader = "Administración de Personal";
    include BASE_DR . 'shared/header.php';
    ?>
    <main>
        <h2>Administrar Personas</h2>
        
        <!-- Botón para agregar personas -->
        <button class="button-primary" onclick="document.getElementById('addPersonForm').style.display='block'">Agregar Persona</button>

        <!-- Formulario para agregar personas y roles -->
        <div id="addPersonForm" style="display:none;">
            <h2>Agregar Nueva Persona</h2>
            <form action="Personal.php" method="post">
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
                    <select name="ROL_id[]" id="ROL_id" multiple required>
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
        </div>
        
        <!-- Mostrar registros de personas -->
        <table>
            <thead>
                <tr>
                    <th>RUT</th>
                    <th>Nombre</th>
                    <th>Fono</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($persona = $personas->fetch(PDO::FETCH_ASSOC)) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($persona['rut']); ?></td>
                        <td><?php echo htmlspecialchars($persona['nombre']); ?></td>
                        <td><?php echo htmlspecialchars($persona['fono']); ?></td>
                        <td class="table-actions">
                            <!-- Botón Editar -->
                            <form action="edit_persona.php" method="get" style="display:inline;">
                                <input type="hidden" name="rut" value="<?php echo htmlspecialchars($persona['rut']); ?>">
                                <button type="submit" class="button-secondary">Editar</button>
                            </form>
                            <!-- Botón Eliminar -->
                            <form action="Personal.php" method="post" style="display:inline;" onsubmit="return confirm('¿Está seguro de que desea eliminar esta persona?');">
                                <input type="hidden" name="action" value="delete">
                                <input type="hidden" name="rut" value="<?php echo htmlspecialchars($persona['rut']); ?>">
                                <button type="submit" class="button-danger">Eliminar</button>
                            </form>
                            <!-- Botón Asignar Rol -->
                            <button class="button-secondary" onclick="document.getElementById('assignRoleForm<?php echo $persona['rut']; ?>').style.display='block'">Asignar Rol</button>
                        </td>
                    </tr>
                    <!-- Formulario para asignar roles -->
                    <tr id="assignRoleForm<?php echo $persona['rut']; ?>" style="display:none;">
                        <td colspan="4">
                            <form action="Personal.php" method="post">
                                <input type="hidden" name="rut" value="<?php echo htmlspecialchars($persona['rut']); ?>">
                                <div class="form-group">
                                    <label for="ROL_id">Roles:</label>
                                    <select name="ROL_id[]" id="ROL_id" multiple required>
                                        <?php
                                        // Obtener roles disponibles
                                        $roles = $rolesBiz->getRoles();
                                        while ($row = $roles->fetch(PDO::FETCH_ASSOC)) {
                                            echo "<option value='" . htmlspecialchars($row['id']) . "'>" . htmlspecialchars($row['nombre']) . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="button-primary">Asignar Roles</button>
                                </div>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </main>
    <?php include BASE_DR . 'shared/footer.php'; ?>
    <footer>
        <p>Footer Content</p>
    </footer>
</body>
</html>
