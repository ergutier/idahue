<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/idahue/config.php';
$page = 'admin';
include_once BASE_DR . 'Admin/AdminBiz.php';
$adminBiz = new AdminBiz();
$tablaSeleccionada = isset($_POST['tabla']) ? $_POST['tabla'] : '';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Administración del Sistema</title>
    <link rel="stylesheet" href="<?php echo CSS_URL; ?>">
    <style>
        .button-group {
            display: flex;
            gap: 10px;
        }
    </style>
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
    $pageHeader = "Administración del Sistema";
    include HEADER_URL;
    ?>
    <main>
        <h2>Seleccionar Tabla para Administrar</h2>
        <form action="admin.php" method="post">
            <div class="form-group">
                <label for="tabla">Tabla:</label>
                <select name="tabla" id="tabla">
                    <option value="">Seleccione una tabla</option>
                    <?php
                    $tablas = $adminBiz->getTablas();
                    foreach ($tablas as $tabla) {
                        $selected = ($tabla == $tablaSeleccionada) ? 'selected' : '';
                        echo "<option value='" . htmlspecialchars($tabla) . "' $selected>" . htmlspecialchars($tabla) . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group button-group">
                <button type="submit" name="action" value="mostrar" class="button-primary">Mostrar Datos</button>
                <button type="submit" name="action" value="agregar" class="button-primary">Agregar Registros</button>
            </div>
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($tablaSeleccionada)) {
            $primaryKey = $adminBiz->getPrimaryKey($tablaSeleccionada);

            if ($_POST['action'] == 'mostrar') {
                $stmt = $adminBiz->getTablaData($tablaSeleccionada);
                $columns = $adminBiz->getColumnas($tablaSeleccionada);
                echo "<h2>Datos de la Tabla: " . $tablaSeleccionada . "</h2>";
                echo "<table id='data-table' class='display'>";
                echo "<thead><tr>";
                $columnNames = [];
                while ($column = $columns->fetch(PDO::FETCH_ASSOC)) {
                    echo "<th>" . htmlspecialchars($column['Field']) . "</th>";
                    $columnNames[] = $column['Field'];
                }
                echo "<th>Acciones</th></tr></thead>";
                echo "<tbody>";
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>";
                    foreach ($row as $value) {
                        echo "<td>" . htmlspecialchars($value) . "</td>";
                    }
                    echo "<td class='table-actions'>
                        <form action='admin.php' method='post' style='display:inline;'>
                            <input type='hidden' name='tabla' value='" . $tablaSeleccionada . "'>
                            <input type='hidden' name='id' value='" . $row[$primaryKey] . "'>
                            <input type='hidden' name='primaryKey' value='" . $primaryKey . "'>
                            <button type='submit' name='action' value='edit' class='button-primary'>Editar</button>
                        </form>
                        <form action='admin.php' method='post' style='display:inline;'>
                            <input type='hidden' name='tabla' value='" . $tablaSeleccionada . "'>
                            <input type='hidden' name='id' value='" . $row[$primaryKey] . "'>
                            <input type='hidden' name='primaryKey' value='" . $primaryKey . "'>
                            <button type='submit' name='action' value='delete' class='button-primary'>Eliminar</button>
                        </form>
                    </td>";
                    echo "</tr>";
                }
                echo "</tbody></table>";//////////////////////////////////////////////////////
            } elseif ($_POST['action'] == 'agregar') {
                $columns = $adminBiz->getColumnas($tablaSeleccionada);
                echo "<h2>Agregar Nuevo Registro en la Tabla: " . $tablaSeleccionada . "</h2>";
                echo "<form action='admin.php' method='post'>";
                while ($column = $columns->fetch(PDO::FETCH_ASSOC)) {
                    if ($column['Field'] != $primaryKey) {
                        echo "<div class='form-group'>";
                        echo "<label for='" . $column['Field'] . "'>" . $column['Field'] . "</label>";
                        if ($column['Key'] == 'MUL') {
                            // Campo FK, obtener y mostrar valores legibles de la tabla foránea
                            $foreignTableInfo = $adminBiz->getForeignTable($column['Field']);
                            if ($foreignTableInfo) {
                                $foreignTable = $foreignTableInfo['table'];
                                $friendlyName = $foreignTableInfo['friendlyName'];
                                $stmtForanea = $adminBiz->getForeignKeyData($foreignTable);
                                echo "<label for='" . $column['Field'] . "'>" . $friendlyName . "</label>";
                                echo "<select name='" . $column['Field'] . "'>";
                                while ($rowForanea = $stmtForanea->fetch(PDO::FETCH_ASSOC)) {
                                    // Muestra un valor legible (por ejemplo, nombre en lugar de ID)
                                    $valorLegible = isset($rowForanea['Nombre']) ? $rowForanea['Nombre'] : $rowForanea['id']; // Asegúrate de que 'Nombre' o un campo legible exista
                                    echo "<option value='" . htmlspecialchars($rowForanea['id']) . "'>" . htmlspecialchars($valorLegible) . "</option>";
                                }
                                echo "</select>";
                            }
                        } else {
                            echo "<input type='text' name='" . $column['Field'] . "'>";
                        }
                        echo "</div>";
                    }
                }
                echo "<input type='hidden' name='tabla' value='" . $tablaSeleccionada . "'>";
                echo "<input type='hidden' name='primaryKey' value='" . $primaryKey . "'>";
                echo "<button type='submit' name='action' value='insert' class='button-primary'>Agregar</button>";
                echo "</form>";
            }

            if (isset($_POST['action']) && $_POST['action'] == 'edit') {
                $id = htmlspecialchars(strip_tags($_POST['id']));
                $primaryKey = htmlspecialchars(strip_tags($_POST['primaryKey']));
                $data = $adminBiz->getTablaData($tablaSeleccionada);
                $rowData = $data->fetch(PDO::FETCH_ASSOC);
                echo "<h2>Editar Registro</h2>";
                echo "<form action='admin.php' method='post'>";
                foreach ($rowData as $key => $value) {
                    echo "<div class='form-group'>";
                    echo "<label for='" . $key . "'>" . $key . "</label>";
                    echo "<input type='text' name='" . $key . "' value='" . htmlspecialchars($value) . "'>";
                    echo "</div>";
                }
                echo "<input type='hidden' name='tabla' value='" . $tablaSeleccionada . "'>";
                echo "<input type='hidden' name='id' value='" . $id . "'>";
                echo "<input type='hidden' name='primaryKey' value='" . $primaryKey . "'>";
				//////////////////////////////////////////
				echo "<button type='submit' name='action' value='update' class='button-primary'>Actualizar</button>";
                echo "</form>";
            }

            if (isset($_POST['action']) && $_POST['action'] == 'delete') {
                $id = htmlspecialchars(strip_tags($_POST['id']));
                $primaryKey = htmlspecialchars(strip_tags($_POST['primaryKey']));
                $adminBiz->eliminarRegistro($tablaSeleccionada, $id, $primaryKey);
                echo "<p>Registro eliminado correctamente.</p>";
            }

            if (isset($_POST['action']) && $_POST['action'] == 'update') {
                $id = htmlspecialchars(strip_tags($_POST['id']));
                $primaryKey = htmlspecialchars(strip_tags($_POST['primaryKey']));
                $datos = [];
                foreach ($_POST as $key => $value) {
                    if ($key != 'tabla' && $key != 'id' && $key != 'action' && $key != 'primaryKey') {
                        $datos[$key] = htmlspecialchars(strip_tags($value));
                    }
                }
                $adminBiz->actualizarRegistro($tablaSeleccionada, $id, $datos, $primaryKey);
                echo "<p>Registro actualizado correctamente.</p>";
            }

            if (isset($_POST['action']) && $_POST['action'] == 'insert') {
                $datos = [];
                $primaryKey = htmlspecialchars(strip_tags($_POST['primaryKey']));
                foreach ($_POST as $key => $value) {
                    if ($key != 'tabla' && $key != 'action' && $key != 'primaryKey') {
                        $datos[$key] = htmlspecialchars(strip_tags($value));
                    }
                }
                $adminBiz->insertarRegistro($tablaSeleccionada, $datos);
                echo "<p>Registro agregado correctamente.</p>";
            }
        }
        ?>
    </main>
    <?php include FOOTER_URL; ?>
</body>
</html>
