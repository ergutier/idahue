<?php
include_once '../templates/header.php';
include_once '../business/' . $_GET['tabla'] . 'Business.php';

$tabla = $_GET['tabla'];
$businessClass = $tabla . 'Business';
$business = new $businessClass();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = $_POST;
    $business->update($data);
    header("Location: mantenedor.php?tabla=$tabla");
}

$registros = $business->getAll();
?>
<div class="container">
    <h1>Modificar Registro en <?php echo $tabla; ?></h1>
    <form action="modificar.php?tabla=<?php echo $tabla; ?>" method="post">
        <label for="id">Seleccione el ID del registro a modificar:</label>
        <select id="id" name="id">
            <?php foreach ($registros as $registro) { ?>
                <option value="<?php echo $registro['id']; ?>"><?php echo $registro['id']; ?></option>
            <?php } ?>
        </select><br>
        <?php foreach ($registros[0] as $key => $value) { ?>
            <label for="<?php echo $key; ?>"><?php echo $key; ?>:</label>
            <input type="text" id="<?php echo $key; ?>" name="<?php echo $key; ?>"><br>
        <?php } ?>
        <input type="submit" value="Modificar">
    </form>
</div>
<?php include_once '../templates/footer.php'; ?>