<?php
include ("conexion.php");

$cliente = $_POST['cliente'];
$dni = $_POST['dni'];
$pizza = $_POST['pizza'];
$cantidad = $_POST['cantidad'];

// Primero verificamos si el cliente ya existe
$check_cliente = "SELECT * FROM TBCLIENTES WHERE DNI = '$dni'";
$result_check = mysqli_query($con, $check_cliente);

if (mysqli_num_rows($result_check) == 0) {
    // Si el cliente no existe, lo registramos
    $sql_cliente = "INSERT INTO TBCLIENTES (NOMBRE, DNI) VALUES ('$cliente', '$dni')";
    mysqli_query($con, $sql_cliente);
}

// Luego registramos el pedido
$sql_pedido = "INSERT INTO TBPEDIDOS(CLIENTE, DNI, ID_PIZZA, CANTIDAD)
    VALUES('$cliente', '$dni', '$pizza', '$cantidad');";
$result_pedido = mysqli_query($con, $sql_pedido);

if($result_pedido){
    header ("Location: zona_caja.php");
    exit();
}else{
    header ("Location: zona_pedidos.php?error=1");
    exit();
}
?>