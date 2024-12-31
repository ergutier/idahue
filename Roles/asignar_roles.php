<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/idahue/config.php';
include_once BASE_DR . 'Roles/RolesBiz.php';
$rolesBiz = new RolesBiz();
$page = 'asignar_roles';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Asignar Roles a Usuarios</title>
    <link rel="stylesheet" href="<?php echo CSS_URL; ?>">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#persona').change(function() {
                var persona = $(this).val();
                $.ajax({
                    type: 'POST',
                    url: 'get_roles_asignados.php',
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
    $pageHeader = "Asignar Roles a Usuarios";
    include HEADER_URL;
    ?>
    <main>
        <h2>Asignar Roles a Personas</h2>
        <form action="asignar_roles.php" method="post">
            <label for="persona">Selecciona la Persona:</label>
            <select name="persona" id="persona">
                <?php
                $stmt = $rolesBiz->getPersonas();
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<option value='" . htmlspecialchars($row['rut']) . "'>" . htmlspecialchars($row['nombre']) . "</option>";
                }
                ?>
            </select>

            <label for="roles">Selecciona los Roles:</label>
            <select name="roles[]" id="roles" multiple class="role-selector">
                <?php
                $stmt = $rolesBiz->getRoles();
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
            $rolesBiz->asignarRoles($persona, $roles);
            echo "<p>Roles asignados correctamente.</p>";
        }
        ?>
    </main>
    <?php include FOOTER_URL; ?>
</body>
</html>
