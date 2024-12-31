?php
include_once '../config.php';
include_once dirname(__DIR__) . '/templates/header.php';

// Verificar que la tabla esté definida y sea segura
$tabla = isset($_POST['tabla']) ? htmlspecialchars($_POST['tabla']) : 'PROVEEDOR';
include_once dirname(__DIR__) . '/business/' . $tabla . 'Business.php';

$businessClass = $tabla . 'Business';
$business = new $businessClass();
$registros = $business->getAll();
?>
<div class="container">
    <h1>Mantenedor de <?php echo $tabla; ?></h1>
    <div>
        <a href="<?php echo BASE_URL; ?>presentation/agregar.php?tabla=<?php echo $tabla; ?>">Agregar Registro</a>
        <a href="<?php echo BASE_URL; ?>presentation/modificar.php?tabla=<?php echo $tabla; ?>">Modificar Registro</a>
        <a href="<?php echo BASE_URL; ?>presentation/eliminar.php?tabla=<?php echo $tabla; ?>">Eliminar Registro</a>
    </div>
    <table>
        <thead>
            <tr>
                <?php if (!empty($registros)) {
                    foreach ($registros[0] as $key => $value) { ?>
                        <th><?php echo $key; ?></th>
                    <?php }
                } ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($registros as $registro) { ?>
                <tr>
                    <?php foreach ($registro as $value) { ?>
                        <td><?php echo $value; ?></td>
                    <?php } ?>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<?php include_once dirname(__DIR__) . '/templates/footer.php'; ?>