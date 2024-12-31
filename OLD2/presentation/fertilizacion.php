<?php
include_once '../config.php';
include_once dirname(__DIR__) . '/templates/header.php'; 

// Asegúrate de que $_POST['tabla'] esté definido y sea seguro
$tabla = isset($_POST['tabla']) ? htmlspecialchars($_POST['tabla']) : 'FERTILIZACION';
include_once dirname(__DIR__) . '/business/' . $tabla . 'Business.php';
?>
<div class="container">
    <h1>Registro de Fertilización</h1>
    <form action="procesar_fertilizacion.php" method="post">
        <label for="ID_pers">ID Persona:</label>
        <input type="text" id="ID_pers" name="ID_pers"><br>
        <label for="ID_prod">ID Producto:</label>
        <input type="text" id="ID_prod" name="ID_prod"><br>
        <label for="fecha">Fecha:</label>
        <input type="date" id="fecha" name="fecha"><br>
        <label for="hora_i">Hora Inicio:</label>
        <input type="time" id="hora_i" name="hora_i"><br>
        <label for="hora_f">Hora Fin:</label>
        <input type="time" id="hora_f" name="hora_f"><br>
        <label for="conc_prod">Concentrado del Producto:</label>
        <input type="text" id="conc_prod" name="conc_prod"><br>
        <label for="dosis">Dosis:</label>
        <input type="text" id="dosis" name="dosis"><br>
        <input type="submit" value="Registrar">
    </form>
</div>
<?php include_once dirname(__DIR__) . '/templates/footer.php'; ?>