<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/idahue/config.php';
$page = 'productos';
include_once BASE_DR . 'Admin/Productos/prodBiz.php';

$prodBiz = new ProdBiz();
$productos = $prodBiz->getProductos();
$proveedores = $prodBiz->getProveedores();
$ingredientesActivos = $prodBiz->getIngredientesActivos();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Administración de Productos</title>
    <link rel="stylesheet" href="<?php echo CSS_URL; ?>">
</head>
<body>
    <?php
    $pageHeader = "Administración de Productos";
    include HEADER_URL;
    ?>
    <main>
        <h2>Administrar Productos</h2>
        
        <!-- Botón para agregar productos -->
        <button onclick="document.getElementById('addProductForm').style.display='block'">Agregar Producto</button>

        <!-- Formulario para agregar productos y asignar ingredientes activos -->
        <div id="addProductForm" style="display:none;">
            <h2>Agregar Nuevo Producto</h2>
            <form action="productos.php" method="post">
                <div class="form-group">
                    <label for="nombre">Nombre:</label>
                    <input type="text" name="nombre" id="nombre" required>
                </div>
                <div class="form-group">
                    <label for="ID_Fam">Familia:</label>
                    <select name="ID_Fam" id="ID_Fam" required>
                        <?php
                        $stmtFam = $prodBiz->getFamilias();
                        while ($row = $stmtFam->fetch(PDO::FETCH_ASSOC)) {
                            echo "<option value='" . htmlspecialchars($row['id']) . "'>" . htmlspecialchars($row['Nombre']) . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="ID_PROV">Proveedor:</label>
                    <select name="ID_PROV" id="ID_PROV" required>
                        <?php
                        $stmtProv = $prodBiz->getProveedores();
                        while ($row = $stmtProv->fetch(PDO::FETCH_ASSOC)) {
                            echo "<option value='" . htmlspecialchars($row['rut']) . "'>" . htmlspecialchars($row['nombre']) . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="ID_INGACT">Ingrediente Activo:</label>
                    <select name="ID_INGACT[]" id="ID_INGACT" multiple required>
                        <?php
                        $stmtIngAct = $prodBiz->getIngredientesActivos();
                        while ($row = $stmtIngAct->fetch(PDO::FETCH_ASSOC)) {
                            echo "<option value='" . htmlspecialchars($row['id']) . "'>" . htmlspecialchars($row['nombre']) . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="cantidad">Cantidad:</label>
                    <input type="number" name="cantidad" id="cantidad" required>
                </div>
                <div class="form-group">
                    <label for="Fecha_venc">Fecha de Vencimiento:</label>
                    <input type="date" name="Fecha_venc" id="Fecha_venc" required>
                </div>
                <div class="form-group">
                    <label for="especie">Especie:</label>
                    <input type="text" name="especie" id="especie" required>
                </div>
                <div class="form-group">
                    <button type="submit" class="button-primary">Agregar</button>
                </div>
            </form>
        </div>

        <!-- Mostrar registros de productos -->
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Familia</th>
                    <th>Proveedor</th>
                    <th>Cantidad</th>
                    <th>Fecha de Vencimiento</th>
                    <th>Especie</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($producto = $productos->fetch(PDO::FETCH_ASSOC)) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($producto['id']); ?></td>
                        <td><?php echo htmlspecialchars($producto['nombre']); ?></td>
                        <td><?php echo htmlspecialchars($producto['ID_Fam']); ?></td>
                        <td><?php echo htmlspecialchars($producto['ID_PROV']); ?></td>
                        <td><?php echo htmlspecialchars($producto['cantidad']); ?></td>
                        <td><?php echo htmlspecialchars($producto['Fecha_venc']); ?></td>
						<td><?php echo htmlspecialchars($producto['especie']); ?></td>
                        <td>
                            <a href="edit_producto.php?id=<?php echo $producto['id']; ?>">Editar</a>
                            <a href="delete_producto.php?id=<?php echo $producto['id']; ?>">Eliminar</a>
                            <a href="manage_ingredientes.php?id=<?php echo $producto['id']; ?>">Gestionar Ingredientes</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nombre = htmlspecialchars(strip_tags($_POST['nombre']));
            $ID_Fam = htmlspecialchars(strip_tags($_POST['ID_Fam']));
            $ID_PROV = htmlspecialchars(strip_tags($_POST['ID_PROV']));
            $ID_INGACT = $_POST['ID_INGACT'];
            $cantidad = htmlspecialchars(strip_tags($_POST['cantidad']));
            $Fecha_venc = htmlspecialchars(strip_tags($_POST['Fecha_venc']));
            $especie = htmlspecialchars(strip_tags($_POST['especie']));

            $data = [
                'nombre' => $nombre,
                'ID_Fam' => $ID_Fam,
                'ID_PROV' => $ID_PROV,
                'ID_INGACT' => $ID_INGACT,
                'cantidad' => $cantidad,
                'Fecha_venc' => $Fecha_venc,
                'especie' => $especie
            ];

            $prodBiz->addProducto($data);

            foreach ($ID_INGACT as $ing_act) {
                $ingredienteData = [
                    'PRODUCTO_ID_INGACT' => $productoId,
                    'ING_ACT_id' => htmlspecialchars(strip_tags($ing_act))
                ];
                $prodBiz->addProductoIngrediente($ingredienteData);
            }

            echo "<p>Producto agregado exitosamente.</p>";
        }
        ?>
    </main>
    <?php include FOOTER_URL; ?>
</body>
</html>
