<?php
include_once '../templates/header.php';
include_once '../business/' . $_POST['tabla'] . 'Business.php';

$tabla = $_POST['tabla'];
$businessClass = $tabla . 'Business';
$business = new $businessClass();
$registros = $business->getAll();

?>
<div class="container">
    <h1>Mantenedor de <?php echo $tabla; ?></h1>
    <div>
        <a href="agregar.php?tabla=<?php echo $tabla; ?>">Agregar Registro</a>
        <a href="modificar.php?tabla=<?php echo $tabla; ?>">Modificar Registro</a>
        <a href="eliminar.php?tabla=<?php echo $tabla; ?>">Eliminar Registro</a>
    </div>
    <table>
        <thead>
            <tr>
                <?php foreach ($registros[0] as $key => $value) { ?>
                    <th><?php echo $key; ?></th>
                <?php } ?>
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
<?php include_once '../templates/footer.php'; ?>