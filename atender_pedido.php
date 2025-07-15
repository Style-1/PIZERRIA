<?php
include("conexion.php");

$id = $_GET["id"];

if (isset($id)) {
    // Cambiar estado a '2' para marcar como atendido
    $sql = "UPDATE TBPEDIDOS SET ESTADO = '2' WHERE ID_PEDIDO = " . intval($id);
    $result = mysqli_query($con, $sql);

    if ($result) {
        // Redirige a zona_cocina.php después de atender
        header("Location: zona_cocina.php");
        exit();
    } else {
        echo "Error al atender el pedido.";
    }
} 
?>
