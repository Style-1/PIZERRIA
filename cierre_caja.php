<?php
include("conexion.php");

// Obtener pedidos con estado 2 (atendidos en cocina)
$sql_pedidos = "SELECT * FROM TBPEDIDOS WHERE ESTADO = '2'";
$result_pedidos = mysqli_query($con, $sql_pedidos);

if (!$result_pedidos || mysqli_num_rows($result_pedidos) == 0) {
    // Redirigir con mensaje de error
    header("Location: boleta.php?error=no_pedidos");
    exit();
}

// Obtener serie y número de boleta
$sql_serie = "SELECT SERIE, NUMERO FROM TBSERIE WHERE SERIE = 'B001'";
$result_serie = mysqli_query($con, $sql_serie);
$row_serie = mysqli_fetch_assoc($result_serie);
$serie = $row_serie['SERIE'];
$numero = $row_serie['NUMERO'] + 1;
$numero_formato = str_pad($numero, 8, '0', STR_PAD_LEFT);
$numero_completo = $serie . '-' . $numero_formato;

// Actualizar el número de serie
$sql_update_serie = "UPDATE TBSERIE SET NUMERO = $numero WHERE SERIE = 'B001'";
mysqli_query($con, $sql_update_serie);

// Variables para boleta cabecera
$fecha = date('Y-m-d');
$subtotal = 0;
$detalle_items = [];

// Agrupar pedidos por DNI de cliente
$pedidos_por_dni = [];

// Calcular totales y preparar detalle
while ($row = mysqli_fetch_assoc($result_pedidos)) {
    $id_pedido = $row['ID_PEDIDO'];
    $dni = $row['DNI'];
    $id_pizza = $row['ID_PIZZA'];
    $cantidad = $row['CANTIDAD'];

    // Obtener precio de la pizza
    $sql_precio = "SELECT PRECIO FROM TBPIZZA WHERE ID_PIZZA = '$id_pizza'";
    $res_precio = mysqli_query($con, $sql_precio);
    $row_precio = mysqli_fetch_assoc($res_precio);
    $precio = $row_precio['PRECIO'];

    $importe = $cantidad * $precio;
    $subtotal += $importe;

    $detalle_items[] = [
        'id_pedido' => $id_pedido,
        'id_pizza' => $id_pizza,
        'cantidad' => $cantidad,
        'precio' => $precio,
        'importe' => $importe,
        'dni' => $dni
    ];
    
    // Agrupar por DNI
    if (!isset($pedidos_por_dni[$dni])) {
        $pedidos_por_dni[$dni] = [];
    }
    $pedidos_por_dni[$dni][] = $id_pedido;
}

$igv = $subtotal * 0.18;
$total = $subtotal + $igv;

// Insertar en TBBOLETA_CAB
$primer_dni = $detalle_items[0]['dni'];
$sql_cab = "INSERT INTO TBBOLETA_CAB (NUMERO, FECHA, DNI_CLIENTES, SUBTOTAL, IGV, TOTAL)
            VALUES ('$numero_completo', '$fecha', '$primer_dni', '$subtotal', '$igv', '$total')";
$result_cab = mysqli_query($con, $sql_cab);

if (!$result_cab) {
    echo "Error al crear la boleta: " . mysqli_error($con);
    exit();
}

// Insertar detalles en TBBOLETA_DET
foreach ($detalle_items as $item) {
    $sql_det = "INSERT INTO TBBOLETA_DET (NUMERO, FECHA, ID_PIZZA, CANTIDAD, PRECIO, IMPORTE)
                VALUES ('$numero_completo', '$fecha', '{$item['id_pizza']}', '{$item['cantidad']}', '{$item['precio']}', '{$item['importe']}')";
    $result_det = mysqli_query($con, $sql_det);
    
    if (!$result_det) {
        echo "Error al insertar detalle: " . mysqli_error($con);
        continue;
    }

    // Actualizar estado del pedido
    $sql_update = "UPDATE TBPEDIDOS SET ESTADO = '3' WHERE ID_PEDIDO = '{$item['id_pedido']}'";
    mysqli_query($con, $sql_update);
}

// Redirigir a boleta
header("Location: boleta.php?success=1");
exit();
?>