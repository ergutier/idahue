<?php 
	$pageTitle = "IDAHUE - Sistema de Gestión"; 
	$pageHeader = "IDAHUE - Sistema de Gestión"; 
	include 'header.php'; 
?>
    <main>
        <h2>Bienvenido al Sistema de Gestión de IDAHUE</h2>
        <p>Seleccione una opción:</p>
        <a href="mantenedor.php" class="button-primary">Administración de Sistema</a>
        <a href="fertilizacion.php" class="button-primary">Registro de Fertilización</a>
		<a href="reporte_fertilizacion.php" class="button-primary">REPORTE de Fertilización</a>
		<a href="asignar_roles.php" class="button-primary">Asignar Roles a Usuarios</a>
    </main>
<?php include 'footer.php'; ?>