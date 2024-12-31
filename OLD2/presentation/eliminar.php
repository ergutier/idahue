<?php
include_once '../templates/header.php';
include_once '../business/' . $_GET['tabla'] . 'Business.php';

$tabla = $_GET['tabla'];
$businessClass = $tabla . 'Business';
$business = new $businessClass();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $business->delete($id);
    header("Location: mantenedor.php?tabla=$tabla");
}

$registros = $business->getAll();
?>
<div class="container">
    <h1>Eliminar Registro en <?php echo $tabla; ?></h1>
    <form action="eliminar.php?tabla=<?php echo $tabla; ?>" method="post">
        <label for="id">Seleccione el ID del registro a eliminar:</label>
        <select id="id" name="id">
            <?php foreach ($registros as $registro) { ?>
                <option value="<?php echo $registro['id']; ?>"><?php echo $registro['id']; ?></option>
            <?php } ?>
        </select><br>
        <input type="submit" value="Eliminar">
    </form>
</div>
<?php include_once '../templates/footer.php'; ?>