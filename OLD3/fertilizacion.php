<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Fertilización</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php
    $pageHeader = "Registro de Fertilización";
    include 'header.php';
    ?>
    <main>
        <h2>Registrar Actividad de Fertilización</h2>
        <form action="fertilizacion.php" method="post">
            <label for="ID_pers">Persona:</label>
            <select name="ID_pers" id="ID_pers">
                <?php
                include_once 'business.php';
                $negocio = new Negocio();
                $stmt = $negocio->getPersonas();
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<option value='" . htmlspecialchars($row['rut']) . "'>" . htmlspecialchars($row['nombre']) . "</option>";
                }
                ?>
            </select>

            <label for="ID_prod">Producto:</label>
            <select name="ID_prod" id="ID_prod">
                <?php
                $stmt = $negocio->getRoles();
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<option value='" . htmlspecialchars($row['id']) . "'>" . htmlspecialchars($row['nombre']) . "</option>";
                }
                ?>
            </select>

            <label for="fecha">Fecha:</label>
            <input type="date" name="fecha" id="fecha" required>

            <label for="hora_i">Hora de Inicio:</label>
            <input type="time" name="hora_i" id="hora_i" required>

            <label for="hora_f">Hora de Fin:</label>
            <input type="time" name="hora_f" id="hora_f" required>

            <label for="conc_prod">Concentración del Producto:</label>
            <input type="text" name="conc_prod" id="conc_prod" required>

            <label for="dosis">Dosis:</label>
            <input type="text" name="dosis" id="dosis" required>

            <button type="submit" class="button-primary">Registrar</button>
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

            $negocio->registrarFertilizacion($ID_pers, $ID_prod, $fecha, $hora_i, $hora_f, $conc_prod, $dosis);
            echo "<p>Registro de fertilización exitoso.</p>";
        }
        ?>
    </main>
    <?php include 'footer.php'; ?>
</body>
</html>
