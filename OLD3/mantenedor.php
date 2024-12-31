<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mantenedor de Tablas</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/skeleton/2.0.4/skeleton.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="styles.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#data-table').DataTable({
                "paging": true,
                "lengthMenu": [10, 20, 50, 100]
            });
        });
    </script>
</head>
<body>
    <?php
    $pageHeader = "Mantenedor de Tablas";
    include 'header.php';
    ?>

    <main>
        <form action="mantenedor.php" method="post">
            <label for="table">Selecciona la tabla:</label>
            <select name="table" id="table">
                <option value="PROVEEDOR">PROVEEDOR</option>
                <option value="FAM_PROD">FAM_PROD</option>
                <option value="ING_ACT">ING_ACT</option>
                <option value="PRODUCTO">PRODUCTO</option>
                <option value="ROL">ROL</option>
                <option value="PERSONA">PERSONA</option>
            </select>
            <button type="submit" class="button-primary">Mostrar</button>
            <button type="submit" name="action" value="add" class="button-primary">Agregar</button>
        </form>

        <?php
        include_once 'database.php';
        include_once 'mantenedor_class.php';

        $database = new Database();
        $db = $database->getConnection();
        $mantenedor = new Mantenedor($db);

        if ($_SERVER["REQUEST_METHOD"] == "POST" && !isset($_POST['action'])) {
            $table = $_POST['table'];
            $stmt = $mantenedor->read($table);
            $num = $stmt->rowCount();

            if ($num > 0) {
                echo "<h2>Tabla: " . htmlspecialchars($table) . "</h2>";
                echo "<table id='data-table' class='display'>";
                echo "<thead>";
                echo "<tr>";

                $columns = array();
                for ($i = 0; $i < $stmt->columnCount(); $i++) {
                    $column = $stmt->getColumnMeta($i);
                    $columns[] = $column['name'];
                    echo "<th>" . htmlspecialchars($column['name']) . "</th>";
                }

                echo "<th>Acciones</th>";
                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";

                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>";
                    foreach ($columns as $column) {
                        echo "<td>" . htmlspecialchars($row[$column]) . "</td>";
                    }
                    echo "<td>";
                    echo "<form action='mantenedor.php' method='post' style='display:inline;'>";
                    echo "<input type='hidden' name='table' value='" . htmlspecialchars($table) . "'>";
                    if (isset($row['id'])) {
                        echo "<input type='hidden' name='id' value='" . htmlspecialchars($row['id']) . "'>";
                    } else {
                        echo "<input type='hidden' name='id' value='" . htmlspecialchars($row[array_key_first($row)]) . "'>";
                    }
                    echo "<button type='submit' name='action' value='edit' class='button-primary'>Editar</button>";
                    echo "</form>";
                    echo "<form action='mantenedor.php' method='post' style='display:inline;'>";
                    echo "<input type='hidden' name='table' value='" . htmlspecialchars($table) . "'>";
                    if (isset($row['id'])) {
                        echo "<input type='hidden' name='id' value='" . htmlspecialchars($row['id']) . "'>";
                    } else {
                        echo "<input type='hidden' name='id' value='" . htmlspecialchars($row[array_key_first($row)]) . "'>";
                    }
                    echo "<button type='submit' name='action' value='delete' class='button-primary'>Eliminar</button>";
                    echo "</form>";
                    echo "</td>";
                    echo "</tr>";
                }

                echo "</tbody>";
                echo "</table>";
            } else {
                echo "<p>No se encontraron registros en la tabla " . htmlspecialchars($table) . ".</p>";
            }
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action'])) {
            $action = $_POST['action'];
            $table = $_POST['table'];
            $id = $_POST['id'] ?? null;

            if ($action == 'edit') {
                echo "<h2>Editar Registro</h2>";
                $query = "SELECT * FROM " . $table . " WHERE ";
                if ($table == "PROVEEDOR" || $table == "PERSONA") {
                    $query .= "rut = :id";
                } else {
                    $query .= "id = :id";
                }
                $stmt = $db->prepare($query);
                $stmt->bindParam(':id', $id);
                $stmt->execute();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                echo "<form action='mantenedor.php' method='post'>";
                foreach ($row as $column => $value) {
                    echo "<label for='" . htmlspecialchars($column) . "'>" . htmlspecialchars($column) . "</label>";
                    echo "<input type='text' name='" . htmlspecialchars($column) . "' value='" . htmlspecialchars($value) . "'>";
                }
                echo "<input type='hidden' name='table' value='" . htmlspecialchars($table) . "'>";
                echo "<input type='hidden' name='id' value='" . htmlspecialchars($id) . "'>";
                echo "<button type='submit' name='action' value='update' class='button-primary'>Actualizar</button>";
                echo "</form>";
            } elseif ($action == 'delete') {
                $mantenedor->delete($table, $id);
                header("Location: mantenedor.php");
            } elseif ($action == 'update') {
                $data = array();
                foreach ($_POST as $key => $value) {
                    if ($key != 'table' && $key != 'id' && $key != 'action') {
                        $data[$key] = $value;
                    }
                }
                $mantenedor->update($table, $data, $id);
                header("Location: mantenedor.php");
            } elseif ($action == 'add') {
                echo "<h2>Agregar Registro</h2>";
                echo "<form action='mantenedor.php' method='post'>";
                $query = "DESCRIBE " . $table;
                $stmt = $db->prepare($query);
                $stmt->execute();
                while ($column = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    if ($column['Field'] != 'id') {
                        echo "<label for='" . htmlspecialchars($column['Field']) . "'>" . htmlspecialchars($column['Field']) . "</label>";
                        echo "<input type='text' name='" . htmlspecialchars($column['Field']) . "'>";
                    }
                }
                echo "<input type='hidden' name='table' value='" . htmlspecialchars($table) . "'>";
                echo "<button type='submit' name='action' value='insert' class='button-primary'>Agregar</button>";
                echo "</form>";
            } elseif ($action == 'insert') {
                $data = array();
                foreach ($_POST as $key => $value) {
                    if ($key != 'table' && $key != 'action') {
                        $data[$key] = $value;
                    }
                }
                $mantenedor->create($table, $data);
                header("Location: mantenedor.php");
            }
        }
        ?>
    </main>

    <?php include 'footer.php'; ?>
</body>
</html>