<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/idahue/config.php';
$page = 'personal';
include_once BASE_DR . 'Admin/Personal/PersBiz.php';

$persBiz = new PersBiz();
$personas = $persBiz->getPersonas();
$roles = $persBiz->getRoles();

function validateInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Administración de Personal</title>
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
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input, .form-group select {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }
        .button-primary {
            background-color: #007BFF;
            color: white;
            padding: 10px 15px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }
        .button-primary:hover {
            background-color: #0056b3;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f4f4f9;
        }
        a {
            text-decoration: none;
            color: #007BFF;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
    <script>
    function validateForm() {
        var nombre = document.forms["adminForm"]["nombre"].value;
        if (nombre == "") {
            alert("El nombre debe ser llenado");
            return false;
        }
        // Agregar más validaciones según sea necesario
    }
    function toggleForm() {
        var form = document.getElementById('addPersonForm');
        form.style.display = form.style.display === 'none' ? 'block' : 'none';
    }
    </script>
</head>
<body>
    <?php
    $pageHeader = "Administración de Personal";
    include HEADER_URL;
    ?>
    <main>
        <h2>Administrar Personas</h2>
        
        <!-- Botón para agregar personas -->
        <button class="button-primary" onclick="toggleForm()">Agregar Persona</button>

        <!-- Formulario para agregar personas y roles -->
        <div id="addPersonForm" style="display:none;">
            <h2>Agregar Nueva Persona</h2>
            <form name="adminForm" action="Personal.php" method="post" onsubmit="return validateForm()">
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
            $rut = validateInput($_POST['rut']);
            $nombre = validateInput($_POST['nombre']);
            $fono = validateInput($_POST['fono']);
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
                    'ROL_id' => validateInput($rol)
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
