<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/idahue/config.php';
include_once BASE_DR . 'Admin/Personal/PersBiz.php';
include_once BASE_DR . 'Roles/RolesBiz.php';

$persBiz = new PersBiz();
$rolesBiz = new RolesBiz();

try {
    $personas = $persBiz->getPersonas();
    $roles = $rolesBiz->getRoles();
} catch (Exception $e) {
    echo "Error al obtener datos: " . $e->getMessage();
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $rut = isset($_POST['rut']) ? htmlspecialchars(strip_tags($_POST['rut'])) : '';

    if (isset($_POST['action']) && $_POST['action'] == 'delete') {
        // Eliminar persona
        try {
            $persBiz->deletePersona($rut);
            echo "<p>Persona eliminada exitosamente.</p>";
        } catch (Exception $e) {
            echo "Error al eliminar persona: " . $e->getMessage();
        }
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

        <!-- Enlace al formulario de agregar persona -->
        <a href="add_persona.php" class="button-primary">Agregar Persona</a>

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
            <tbody id="personasTableBody">
                <?php 
                if ($personas) {
                    while ($persona = $personas->fetch(PDO::FETCH_ASSOC)) { ?>
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
                        <tr id="assignRoleForm<?php echo htmlspecialchars($persona['rut']); ?>" style="display:none;">
                            <td colspan="4">
                                <form action="Personal.php" method="post">
                                    <input type="hidden" name="rut" value="<?php echo htmlspecialchars($persona['rut']); ?>">
                                    <div class="form-group">
                                        <label for="ROL_id">Roles:</label>
                                        <select name="ROL_id[]" id="ROL_id" class="select-multiple" multiple required>
                                            <?php
                                            // Obtener roles asignados
                                            try {
                                                $rolesAsignadosStmt = $rolesBiz->getRolesAsignados($persona['rut']);
                                                $rolesAsignados = [];
                                                while ($row = $rolesAsignadosStmt->fetch(PDO::FETCH_ASSOC)) {
                                                    $rolesAsignados[] = $row['id'];
                                                }

                                                // Obtener todos los roles
                                                $roles = $rolesBiz->getRoles();
                                                while ($row = $roles->fetch(PDO::FETCH_ASSOC)) {
                                                    $selected = in_array($row['id'], $rolesAsignados) ? 'selected' : '';
                                                    echo "<option value='" . htmlspecialchars($row['id']) . "' $selected>" . htmlspecialchars($row['nombre']) . "</option>";
                                                }
                                            } catch (Exception $e) {
                                                echo "Error al obtener roles: " . $e->getMessage();
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
                    <?php } 
                } else {
                    echo "<tr><td colspan='4'>No se encontraron registros de personas.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </main>
    <?php include BASE_DR . 'shared/footer.php'; ?>
</body>
</html>