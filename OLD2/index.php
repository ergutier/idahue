<?php 
include_once 'config.php';
include_once HEADER; 


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once 'config.php';
include_once HEADER; 

?>

<div class="container">
    <h1>Bienvenido a Idahue</h1>
    <p>Seleccione una opción de administración:</p>
    <ul>
        <li><a href="presentation/seleccionar_tabla.php">Mantenedor de Tablas</a></li>
        <li><a href="presentation/fertilizacion.php">Registro de Fertilización</a></li>
    </ul>
</div>
<?php include_once FOOTER; ?>