<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/idahue/config.php';
$page = 'fertilizacion';
include_once BASE_DR . 'Fert/FertBiz.php';
$fertBiz = new FertBiz();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Fertilización</title>
    <link rel="stylesheet" href="<?php echo CSS_URL; ?>">
</head>
<body>
    <?php
    $pageHeader = "Registro de Fertilización";
    include HEADER_URL;
    ?>
    <main>
        <h2>Registrar Actividad de Fertilización</h2>
        <form action="fertilizacion.php" method="post">
            <div class="form-group">
                <label for="ID_pers">Persona:</label>
                <select name="ID_pers" id="ID_pers">
                    <?php
                    $stmt = $fertBiz->getPersonas();
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<option value='" . htmlspecialchars($row['rut']) . "'>" . htmlspecialchars($row['nombre']) . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="ID_prod">Producto:</label>
                <select name="ID_prod" id="ID_prod">
                    <?php
                    $stmt = $fertBiz->getProductos();
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<option value='" . htmlspecialchars($row['id']) . "'>" . htmlspecialchars($row['especie']) . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="fecha">Fecha:</label>
                <input type="date" name="fecha" id="fecha" required>
            </div>
            <div class="form-group">
                <label for="hora_i">Hora de Inicio:</label>
                <input type="time" name="hora_i" id="hora_i" required>
            </div>
            <div class="form-group">
                <label for="hora_f">Hora de Fin:</label>
                <input type="time" name="hora_f" id="hora_f" required>
            </div>
            <div class="form-group">
                <label for="conc_prod">Concentración del Producto:</label>
                <input type="text" name="conc_prod" id="conc_prod" required>
            </div>
            <div class="form-group">
                <label for="dosis">Dosis:</label>
                <input type="text" name="dosis" id="dosis" required>
            </div>
            <div class="form-group">
                <button type="submit" class="button-primary">Registrar</button>
            </div>
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $ID_pers = htmlspecialchars(strip_tags($_POST['ID_pers']));
            $ID_prod = htmlspecialchars(strip_tags($_POST['ID_prod']));
            $fecha = htmlspecialchars(strip_tags($_POST['fecha']));
            $hora_i = htmlspecialchars(strip_tags($_POST['hora_i']));
            $hora_f = htmlspecialchars(strip_tags($_POST['hora_f']));
            $conc_prod = htmlspecialchars(strip_tags($_POST['conc_prod']));
            $dosis = htmlspecialchars(strip_tags($_POST['dosis']));

            $fertBiz->registrarFertilizacion($ID_pers, $ID_prod, $fecha, $hora_i, $hora_f, $conc_prod, $dosis);
            echo "<p>Registro de fertilización exitoso.</p>";
        }
        ?>
    </main>
    <?php include FOOTER_URL; ?>
</body>
</html>
