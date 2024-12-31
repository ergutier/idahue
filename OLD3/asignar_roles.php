<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Asignar Roles a Personas</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/skeleton/2.0.4/skeleton.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="styles.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#persona').change(function() {
                var persona = $(this).val();
                $.ajax({
                    type: 'POST',
                    url: 'business.php',
                    data: { persona: persona },
                    success: function(response) {
                        var rolesAsignados = JSON.parse(response);
                        $('#roles option').each(function() {
                            $(this).prop('selected', false); // Desmarcar todos los roles
                        });
                        $.each(rolesAsignados, function(index, rolId) {
                            $('#roles option[value="' + rolId + '"]').prop('selected', true); // Marcar roles asignados
                        });
                    }
                });
            });
        });
    </script>
</head>
<body>
    <?php
    $pageHeader = "Asignar Roles a Personas";
    include 'header.php';
    ?>
    <main>
        <h2>Asignar Roles a Personas</h2>
        <form action="asignar_roles.php" method="post">
            <label for="persona">Selecciona la Persona:</label>
            <select name="persona" id="persona">
				<option selected>Elija una persona</option>
                <?php
                include_once 'database.php';
                $database = new Database();
                $db = $database->getConnection();
                $stmt = $database->getPersonas();
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<option value='" . htmlspecialchars($row['rut']) . "'>" . htmlspecialchars($row['nombre']) . "</option>";
                }
                ?>
            </select>

            <label for="roles">Selecciona los Roles:</label>
            <select name="roles[]" id="roles" multiple class="role-selector">
                <?php
                $stmt = $database->getRoles();
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<option value='" . htmlspecialchars($row['id']) . "'>" . htmlspecialchars($row['nombre']) . "</option>";
                }
                ?>
            </select>

            <button type="submit" class="button-primary">Asignar Roles</button>
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $persona = htmlspecialchars(strip_tags($_POST['persona']));
            $roles = $_POST['roles'];

            $database->deleteRolesPersona($persona);

            foreach ($roles as $rol) {
                $database->assignRolesPersona($persona, $rol);
            }

            echo "<p>Roles asignados correctamente.</p>";
        }
        ?>
    </main>
    <?php include 'footer.php'; ?>
</body>
</html>