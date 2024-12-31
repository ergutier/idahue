<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Fertilizaciones</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#data-table').DataTable({
                "paging": true,
                "lengthMenu": [10, 20, 50, 100]
            });
        });
    </script>
</head>
<body>
    <?php
    $pageHeader = "Reporte de Fertilizaciones";
    include 'header.php';
    ?>
    <main>
        <h2>Reporte de Fertilizaciones Realizadas</h2>
        <?php
        include_once 'business.php';
        $negocio = new Negocio();
        $stmt = $negocio->getFertilizaciones();

        if ($stmt->rowCount() > 0) {
            echo "<table id='data-table' class='display'>";
            echo "<thead>";
            echo "<tr>";
            echo "<th>Persona</th>";
            echo "<th>Producto</th>";
            echo "<th>Fecha</th>";
            echo "<th>Hora de Inicio</th>";
            echo "<th>Hora de Fin</th>";
            echo "<th>Concentración del Producto</th>";
            echo "<th>Dosis</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['nombre_persona']) . "</td>";
                echo "<td>" . htmlspecialchars($row['nombre_producto']) . "</td>";
                echo "<td>" . htmlspecialchars($row['fecha']) . "</td>";
                echo "<td>" . htmlspecialchars($row['hora_i']) . "</td>";
                echo "<td>" . htmlspecialchars($row['hora_f']) . "</td>";
                echo "<td>" . htmlspecialchars($row['conc_prod']) . "</td>";
                echo "<td>" . htmlspecialchars($row['dosis']) . "</td>";
                echo "</tr>";
            }

            echo "</tbody>";
            echo "</table>";
        } else {
            echo "<p>No se encontraron registros de fertilización.</p>";
        }
        ?>
    </main>
    <?php include 'footer.php'; ?>
</body>
</html>
