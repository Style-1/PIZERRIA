<?php
include("conexion.php");

if (isset($_GET['id'])) {
    $id_pedido = intval($_GET['id']);

    // Verificar si el pedido existe antes de eliminarlo
    $verificar_sql = "SELECT * FROM TBPEDIDOS WHERE ID_PEDIDO = $id_pedido";
    $resultado = mysqli_query($con, $verificar_sql);

    if (mysqli_num_rows($resultado) > 0) {
        $sql = "DELETE FROM TBPEDIDOS WHERE ID_PEDIDO = $id_pedido";
        if (mysqli_query($con, $sql)) {
            // Eliminado correctamente
            header("Location: zona_caja.php?mensaje=eliminado");
            exit();
        } else {
            echo "Error  " . mysqli_error($con);
        }
    
    }
}
?>
