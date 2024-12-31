<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mantenedor de Tablas</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/skeleton/2.0.4/skeleton.min.css">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-image: url('background.jpg');
            background-size: cover;
            color: #333;
            margin: 0;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        header {
            width: 100%;
            background-color: #4CAF50;
            padding: 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        header img {
            height: 40px;
        }
        header h1 {
            color: #fff;
            font-size: 24px;
            margin: 0;
        }
        main {
            width: 80%;
            margin-top: 20px;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        footer {
            margin-top: 20px;
            padding: 10px;
            background-color: #4CAF50;
            width: 100%;
            text-align: center;
            color: #fff;
        }
        .button-primary {
            background-color: #4CAF50;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }
        .button-primary:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <header>
        <img src="logo.png" alt="Logo">
        <h1>Mantenedor de Tablas</h1>
    </header>
    <main>
        <form action="index.php" method="post">
            <label for="table">Selecciona la tabla:</label>
            <select name="table" id="table">
                <option value="PROVEEDOR">PROVEEDOR</option>
                <option value="FAM_PROD">FAM_PROD</option>
                <option value="ING_ACT">ING_ACT</option>
                <option value="PRODUCTO">PRODUCTO</option>
                <option value="ROL">ROL</option>
                <option value="PERSONA">PERSONA</option>
                <option value="FERTILIZACION">FERTILIZACION</option>
                <option value="PRODUCTO_ING_ACT">PRODUCTO_ING_ACT</option>
                <option value="PRODUCTO_PROVEEDOR">PRODUCTO_PROVEEDOR</option>
                <option value="ROL_PERSONA">ROL_PERSONA</option>
            </select>
            <button type="submit" class="button-primary">Mostrar</button>
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST" && !isset($_POST['action'])) {
            include_once 'database.php';
            include_once 'mantenedor.php';

            $database = new Database();
            $db = $database->getConnection();
            $mantenedor = new Mantenedor($db);

            $table = $_POST['table'];
            $stmt = $mantenedor->read($table);
            $num = $stmt->rowCount();

            if ($num > 0) {
                echo "<h2>Tabla: " . htmlspecialchars($table) . "</h2>";
                echo "<table class='u-full-width'>";
                echo "<thead>";
                echo "<tr>";

                $columns = array();
                for ($i = 0; $stmt->columnCount(); $i++) {
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
                    echo "<form action='index.php' method='post' style='display:inline;'>";
                    echo "<input type='hidden' name='table' value='" . htmlspecialchars($table) . "'>";
                    echo "<input type='hidden' name='id' value='" . htmlspecialchars($row['id']) . "'>";
                    echo "<button type='submit' name='action' value='edit' class='button-primary'>Editar</button>";
                    echo "</form>";
                    echo "<form action='index.php' method='post' style='display:inline;'>";
                    echo "<input type='hidden' name='table' value='" . htmlspecialchars($table) . "'>";
                    echo "<input type='hidden' name='id' value='" . htmlspecialchars($row['id']) . "'>";
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
            include_once 'database.php';
            include_once 'mantenedor.php';

            $database = new Database();
            $db = $database->getConnection();
            $mantenedor = new Mantenedor($db);

            $action = $_POST['action'];
            $table = $_POST['table'];
            $id = $_POST['id'];

            if ($action == 'edit') {
                // Aquí puedes agregar el código para editar el registro
                echo "<h2>Editar Registro</h2>";
                $stmt = $mantenedor->read($table);
                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                echo "<form action='index.php' method='post'>";
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
                header("Location: index.php");
            } elseif ($action == 'update') {
                $data = array();
                foreach ($_POST as $key => $value) {
                    if ($key != 'table' && $key != 'id' && $key != 'action') {
                        $data[$key] = $value;
                    }
                }
                $mantenedor->update($table, $data, $id);
                header("Location: index.php");
            }
        }
        ?>
    </main>
    <footer>
        &copy; 2024 Tu Nombre. Todos los derechos reservados.
    </footer>
</body>
</html>
