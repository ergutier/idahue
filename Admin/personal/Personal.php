<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/idahue/config.php';
$page = 'personal';
include_once BASE_DR . 'Admin/Personal/PersBiz.php';

$persBiz = new PersBiz();
$personas = $persBiz->getPersonas();
$roles = $persBiz->getRoles();
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
    include HEADER_URL;
    ?>
    <main>
        <h2>Administrar Personas</h2>
        
        <!-- Botón para agregar personas -->
        <button onclick="document.getElementById('addPersonForm').style.display='block'">Agregar Persona</button>

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
                        <td>
                            <a href="edit_persona.php?rut=<?php echo $persona['rut']; ?>">Editar</a>
                            <a href="delete_persona.php?rut=<?php echo $persona['rut']; ?>">Eliminar</a>
                            <a href="assign_role.php?rut=<?php echo $persona['rut']; ?>">Asignar Rol</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $rut = htmlspecialchars(strip_tags($_POST['rut']));
            $nombre = htmlspecialchars(strip_tags($_POST['nombre']));
            $fono = htmlspecialchars(strip_tags($_POST['fono']));
            $ROL_id = $_POST['ROL_id'];

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
        ?>
    </main>
    <?php include FOOTER_URL; ?>
</body>
</html>
