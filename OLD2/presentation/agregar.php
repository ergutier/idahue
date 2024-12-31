<?php
include_once '../templates/header.php';
include_once '../business/' . $_GET['tabla'] . 'Business.php';

$tabla = $_GET['tabla'];
$businessClass = $tabla . 'Business';
$business = new $businessClass();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = $_POST;
    $business->create($data);
    header("Location: mantenedor.php?tabla=$tabla");
}

?>
<div class="container">
    <h1>Agregar Registro en <?php echo $tabla; ?></h1>
    <form action="agregar.php?tabla=<?php echo $tabla; ?>" method="post">
        <?php foreach ($business->getAll()[0] as $key => $value) { ?>
            <label for="<?php echo $key; ?>"><?php echo $key; ?>:</label>
            <input type="text" id="<?php echo $key; ?>" name="<?php echo $key; ?>"><br>
        <?php } ?>
        <input type="submit" value="Agregar">
    </form>
</div>
<?php include_once '../templates/footer.php'; ?>