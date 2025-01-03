<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/idahue/config.php';
include_once BASE_DR . 'Admin/productos/ProdBiz.php';

$prodBiz = new ProdBiz();
$editingProduct = null;

try {
    $productos = $prodBiz->getProductos();
    $familias = $prodBiz->getFamilias();
    $proveedores = $prodBiz->getProveedores();
    $ingredientesActivos = $prodBiz->getIngredientesActivos();
} catch (Exception $e) {
    echo "Error al obtener datos: " . $e->getMessage();
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = isset($_POST['id']) ? htmlspecialchars(strip_tags($_POST['id'])) : '';
    $nombre = isset($_POST['nombre']) ? htmlspecialchars(strip_tags($_POST['nombre'])) : '';
    $cantidad = isset($_POST['cantidad']) ? htmlspecialchars(strip_tags($_POST['cantidad'])) : '';
    $fecha_venc = isset($_POST['fecha_venc']) ? htmlspecialchars(strip_tags($_POST['fecha_venc'])) : '';
    $especie = isset($_POST['especie']) ? htmlspecialchars(strip_tags($_POST['especie'])) : '';
    $ID_Fam = isset($_POST['ID_Fam']) ? htmlspecialchars(strip_tags($_POST['ID_Fam'])) : '';
    $ID_PROV = isset($_POST['ID_PROV']) ? htmlspecialchars(strip_tags($_POST['ID_PROV'])) : '';
    $ID_INGACT = isset($_POST['ID_INGACT']) ? htmlspecialchars(strip_tags($_POST['ID_INGACT'])) : '';

    if (isset($_POST['action'])) {
        if ($_POST['action'] == 'add') {
            // Agregar producto
            try {
                $prodBiz->addProducto([
                    'nombre' => $nombre,
                    'cantidad' => $cantidad,
                    'Fecha_venc' => $fecha_venc,
                    'especie' => $especie,
                    'ID_Fam' => $ID_Fam,
                    'ID_PROV' => $ID_PROV,
                    'ID_INGACT' => $ID_INGACT
                ]);
                echo "<p>Producto agregado exitosamente.</p>";
            } catch (Exception $e) {
                echo "Error al agregar producto: " . $e->getMessage();
            }
        } elseif ($_POST['action'] == 'edit') {
            // Editar producto
            try {
                $prodBiz->updateProducto([
                    'id' => $id,
                    'nombre' => $nombre,
                    'cantidad' => $cantidad,
                    'Fecha_venc' => $fecha_venc,
                    'especie' => $especie,
                    'ID_Fam' => $ID_Fam,
                    'ID_PROV' => $ID_PROV,
                    'ID_INGACT' => $ID_INGACT
                ]);
                echo "<p>Producto actualizado exitosamente.</p>";
            } catch (Exception $e) {
                echo "Error al actualizar producto: " . $e->getMessage();
            }
        } elseif ($_POST['action'] == 'delete') {
            // Eliminar producto
            try {
                $prodBiz->deleteProducto($id);
                echo "<p>Producto eliminado exitosamente.</p>";
            } catch (Exception $e) {
                echo "Error al eliminar producto: " . $e->getMessage();
            }
        }
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['edit'])) {
    $id = htmlspecialchars(strip_tags($_GET['edit']));
    try {
        $stmt = $prodBiz->getProductos();
        while ($producto = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if ($producto['id'] == $id) {
                $editingProduct = $producto;
                break;
            }
        }
    } catch (Exception $e) {
        echo "Error al obtener datos del producto: " . $e->getMessage();
    }
}
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
    include BASE_DR . 'shared/header.php';
    ?>
    <main>
        <h2>Administrar Productos</h2>

        <!-- Formulario para agregar y editar producto -->
        <form method="post" action="Productos.php">
            <input type="hidden" name="action" value="<?php echo $editingProduct ? 'edit' : 'add'; ?>">
            <?php if ($editingProduct): ?>
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($editingProduct['id']); ?>">
            <?php endif; ?>
            <label>Nombre:</label><br>
            <input type="text" name="nombre" value="<?php echo $editingProduct ? htmlspecialchars($editingProduct['nombre']) : ''; ?>" required><br>
            <label>Cantidad:</label><br>
            <input type="number" name="cantidad" value="<?php echo $editingProduct ? htmlspecialchars($editingProduct['cantidad']) : ''; ?>" required><br>
            <label>Fecha de Vencimiento:</label><br>
            <input type="date" name="fecha_venc" value="<?php echo $editingProduct ? htmlspecialchars($editingProduct['Fecha_venc']) : ''; ?>" required><br>
            <label>Especie:</label><br>
            <input type="text" name="especie" value="<?php echo $editingProduct ? htmlspecialchars($editingProduct['especie']) : ''; ?>" required><br>
            <label>Familia:</label><br>
            <select name="ID_Fam" required>
                <?php while ($familia = $familias->fetch(PDO::FETCH_ASSOC)): ?>
                    <option value="<?php echo htmlspecialchars($familia['id']); ?>" 
                        <?php echo $editingProduct && $editingProduct['ID_Fam'] == $familia['id'] ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($familia['nombre']); ?>
                    </option>
                <?php endwhile; ?>
            </select><br>
            <label>Proveedor:</label><br>
            <select name="ID_PROV" required>
                <?php while ($proveedor = $proveedores->fetch(PDO::FETCH_ASSOC)): ?>
                    <option value="<?php echo htmlspecialchars($proveedor['rut']); ?>" 
                        <?php echo $editingProduct && $editingProduct['ID_PROV'] == $proveedor['rut'] ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($proveedor['nombre']); ?>
                    </option>
                <?php endwhile; ?>
            </select><br>
            <label>Ingrediente Activo:</label><br>
            <select name="ID_INGACT" required>
                <?php while ($ingrediente = $ingredientesActivos->fetch(PDO::FETCH_ASSOC)): ?>
                    <option value="<?php echo htmlspecialchars($ingrediente['id']); ?>" 
                        <?php echo $editingProduct && $editingProduct['ID_INGACT'] == $ingrediente['id'] ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($ingrediente['nombre']); ?>
                    </option>
                <?php endwhile; ?>
            </select><br>
            <button type="submit" class="button-primary"><?php echo $editingProduct ? 'Actualizar Producto' : 'Agregar Producto'; ?></button>
        </form>

        <h2>Lista de Productos</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Cantidad</th>
                    <th>Fecha de Vencimiento</th>
                    <th>Especie</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="productosTableBody">
                <?php
                if ($productos) {
                    while ($producto = $productos->fetch(PDO::FETCH_ASSOC)) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($producto['id']); ?></td>
                            <td><?php echo htmlspecialchars($producto['nombre']); ?></td>
                            <td><?php echo htmlspecialchars($producto['cantidad']); ?></td>
                            <td><?php echo htmlspecialchars($producto['Fecha_venc']); ?></td>
                            <td><?php echo htmlspecialchars($producto['especie']); ?></td>
                            <td class="table-actions">
                                <!-- Botón Editar -->
                                <form action="Productos.php" method="get" style="display:inline;">
                                    <input type="hidden" name="edit" value="<?php echo htmlspecialchars($producto['id']); ?>">
                                    <button type="submit" class="button-secondary">Editar</button>
                                </form>
                                <!-- Botón Eliminar -->
                                <form action="Productos.php" method="post" style="display:inline;" onsubmit="return confirm('¿Está seguro de que desea eliminar este producto?');">
                                    <input type="hidden" name="action" value="delete">
                                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($producto['id']); ?>">
                                    <button type="submit" class="button-danger">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    <?php }
                } else {
                    echo "<tr><td colspan='6'>No se encontraron registros de productos.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </main>
    <?php include BASE_DR . 'shared/footer.php'; ?>
</body>
</html>