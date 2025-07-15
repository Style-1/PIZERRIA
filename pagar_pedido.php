<?php
    include("conexion.php");

    $id = isset($_GET["id"]) ? intval($_GET["id"]) : 0;
    
    if($id > 0) {
        // Get pizza information before updating status
        $sql_info = "SELECT P.ID_PIZZA, P.CANTIDAD, Z.PRECIO, P.DNI 
                    FROM TBPEDIDOS P 
                    JOIN TBPIZZA Z ON P.ID_PIZZA = Z.ID_PIZZA 
                    WHERE P.ID_PEDIDO = " . $id;
        $result_info = mysqli_query($con, $sql_info);
        
        if($result_info && mysqli_num_rows($result_info) > 0) {
            // Update status to "paid" (1)
            $sql_update = "UPDATE TBPEDIDOS SET ESTADO='1' WHERE ID_PEDIDO=" . $id;
            $result_update = mysqli_query($con, $sql_update);

            if($result_update) {
                header("Location: zona_caja.php");
                exit();
            } else {
                echo "Error al actualizar el estado del pedido: " . mysqli_error($con);
            }
        } else {
            echo "Error al obtener información del pedido: " . mysqli_error($con);
        }
    } else {
        echo "ID de pedido no válido";
    }
?>