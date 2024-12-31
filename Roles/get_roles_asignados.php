<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/idahue/config.php';
include_once BASE_DR . 'Roles/RolesBiz.php';

$rolesBiz = new RolesBiz();

if (isset($_POST['persona'])) {
    $persona = htmlspecialchars(strip_tags($_POST['persona']));
    $stmt = $rolesBiz->getRolesAsignados($persona);
    $roles_asignados = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $roles_asignados[] = $row['ROL_id'];
    }

    echo json_encode($roles_asignados);
}
?>
