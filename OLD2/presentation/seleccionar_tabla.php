<?php include_once '../templates/header.php'; ?>
<div class="container">
    <h1>Seleccionar Tabla</h1>
    <form action="mantenedor.php" method="post">
        <label for="tabla">Seleccione una tabla:</label>
        <select id="tabla" name="tabla">
            <option value="PROVEEDOR">Proveedor</option>
            <option value="FAM_PROD">Familia de Productos</option>
            <option value="ING_ACT">Actividad de Ingreso</option>
            <option value="PRODUCTO">Producto</option>
            <option value="ROL">Rol</option>
            <option value="PERSONA">Persona</option>
            <option value="FERTILIZACION">Fertilización</option>
        </select>
        <input type="submit" value="Seleccionar">
    </form>
</div>
<?php include_once '../templates/footer.php'; ?>